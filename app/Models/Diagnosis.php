<?php

namespace App\Models;

use CodeIgniter\Model;

class Diagnosis extends Model
{
    protected $table = 'diagnosis_results';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'user_id',
        'nama_pasien',
        'alamat_lahan',
        'luas_lahan',
        'hasil_diagnosis',
        'penyakit_terdiagnosis',
        'nilai_cf_tertinggi'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'tanggal_diagnosis';
    protected $updatedField = '';

    // Validation
    protected $validationRules = [
        'nama_pasien' => 'required|max_length[100]',
        'alamat_lahan' => 'max_length[200]',
        'luas_lahan' => 'max_length[50]',
        'hasil_diagnosis' => 'required'
    ];
    protected $validationMessages = [
        'nama_pasien' => [
            'required' => 'Nama pasien harus diisi'
        ],
        'hasil_diagnosis' => [
            'required' => 'Hasil diagnosis harus ada'
        ]
    ];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['setTimestamp'];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = ['decodeJsonFields'];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Set timestamp before insert
     */
    protected function setTimestamp(array $data)
    {
        if (!isset($data['data']['tanggal_diagnosis'])) {
            $data['data']['tanggal_diagnosis'] = date('Y-m-d H:i:s');
        }
        return $data;
    }

    /**
     * Decode JSON fields after find
     */
    protected function decodeJsonFields(array $data)
    {
        if (isset($data['data'])) {
            // Single record
            if (isset($data['data']['hasil_diagnosis'])) {
                $data['data']['hasil_diagnosis'] = json_decode($data['data']['hasil_diagnosis'], true);
            }
        } else {
            // Multiple records
            foreach ($data['data'] as &$record) {
                if (isset($record['hasil_diagnosis'])) {
                    $record['hasil_diagnosis'] = json_decode($record['hasil_diagnosis'], true);
                }
            }
        }
        return $data;
    }

    /**
     * Get diagnosis results with disease details
     */
    public function getDiagnosisWithDetails()
    {
        return $this->select('diagnosis_results.*, penyakits.nama_penyakit, penyakits.det_penyakit')
            ->join('penyakits', 'penyakits.kode_penyakit = diagnosis_results.penyakit_terdiagnosis', 'left')
            ->orderBy('diagnosis_results.tanggal_diagnosis', 'DESC')
            ->findAll();
    }

    /**
     * Get diagnosis statistics
     */
    public function getDiagnosisStats()
    {
        // Total diagnoses
        $totalDiagnoses = $this->countAll();

        // Diagnoses by disease
        $diseaseStats = $this->select('penyakit_terdiagnosis, penyakits.nama_penyakit, COUNT(*) as count')
            ->join('penyakits', 'penyakits.kode_penyakit = diagnosis_results.penyakit_terdiagnosis', 'left')
            ->where('penyakit_terdiagnosis IS NOT NULL')
            ->groupBy('penyakit_terdiagnosis')
            ->orderBy('count', 'DESC')
            ->findAll();

        // Monthly statistics (last 12 months)
        $monthlyStats = $this->select('YEAR(tanggal_diagnosis) as year, MONTH(tanggal_diagnosis) as month, COUNT(*) as count')
            ->where('tanggal_diagnosis >=', date('Y-m-d', strtotime('-12 months')))
            ->groupBy('YEAR(tanggal_diagnosis), MONTH(tanggal_diagnosis)')
            ->orderBy('year DESC, month DESC')
            ->findAll();

        return [
            'total' => $totalDiagnoses,
            'by_disease' => $diseaseStats,
            'monthly' => $monthlyStats
        ];
    }

    /**
     * Save diagnosis result
     */
    public function saveDiagnosis($patientData, $diagnosisResults, $userId = null)
    {
        // Find the highest CF value and corresponding disease
        $highestCF = 0;
        $topDisease = null;

        foreach ($diagnosisResults as $diseaseCode => $result) {
            if (abs($result['cf']) > $highestCF) {
                $highestCF = abs($result['cf']);
                $topDisease = $diseaseCode;
            }
        }

        $data = [
            'user_id' => $userId,
            'nama_pasien' => $patientData['nama_pasien'],
            'alamat_lahan' => $patientData['alamat_lahan'] ?? null,
            'luas_lahan' => $patientData['luas_lahan'] ?? null,
            'hasil_diagnosis' => json_encode($diagnosisResults),
            'penyakit_terdiagnosis' => $topDisease,
            'nilai_cf_tertinggi' => $highestCF
        ];

        return $this->insert($data);
    }

    /**
     * Get recent diagnoses
     */
    public function getRecentDiagnoses($limit = 10)
    {
        return $this->select('diagnosis_results.*, penyakits.nama_penyakit')
            ->join('penyakits', 'penyakits.kode_penyakit = diagnosis_results.penyakit_terdiagnosis', 'left')
            ->orderBy('diagnosis_results.tanggal_diagnosis', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Search diagnoses
     */
    public function searchDiagnoses($keyword, $dateFrom = null, $dateTo = null)
    {
        $builder = $this->select('diagnosis_results.*, penyakits.nama_penyakit')
            ->join('penyakits', 'penyakits.kode_penyakit = diagnosis_results.penyakit_terdiagnosis', 'left');

        if ($keyword) {
            $builder->groupStart()
                ->like('diagnosis_results.nama_pasien', $keyword)
                ->orLike('diagnosis_results.alamat_lahan', $keyword)
                ->orLike('penyakits.nama_penyakit', $keyword)
                ->groupEnd();
        }

        if ($dateFrom) {
            $builder->where('diagnosis_results.tanggal_diagnosis >=', $dateFrom);
        }

        if ($dateTo) {
            $builder->where('diagnosis_results.tanggal_diagnosis <=', $dateTo . ' 23:59:59');
        }

        return $builder->orderBy('diagnosis_results.tanggal_diagnosis', 'DESC')
            ->findAll();
    }
}