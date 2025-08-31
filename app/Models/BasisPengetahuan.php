<?php

namespace App\Models;

use CodeIgniter\Model;

class BasisPengetahuan extends Model
{
    protected $table = 'basispengetahuans';
    protected $primaryKey = 'kode_pengetahuan';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    // HANYA field ini yang boleh di-insert/update
    protected $protectFields = true;
    protected $allowedFields = [
        'kode_pengetahuan',
        'kode_penyakit',
        'kode_gejala',
        'mb',
        'md',
        'cf'
    ];

    // Matikan timestamps jika tabel tidak punya kolomnya
    protected $useTimestamps = false;


    public function getKnowledgeWithDetails()
    {
        return $this->select('basispengetahuans.*, penyakits.nama_penyakit, gejala.nama_gejala')
            ->join('penyakits', 'penyakits.kode_penyakit = basispengetahuans.kode_penyakit')
            ->join('gejala', 'gejala.kode_gejala = basispengetahuans.kode_gejala')
            ->findAll();
    }

    /**
     * Get symptoms by disease code
     */
    public function getSymptomsByDisease($kodePenyakit)
    {
        return $this->select('basispengetahuans.*, gejala.nama_gejala')
            ->join('gejala', 'gejala.kode_gejala = basispengetahuans.kode_gejala')
            ->where('basispengetahuans.kode_penyakit', $kodePenyakit)
            ->findAll();
    }

    /**
     * Get diseases by symptom code
     */
    public function getDiseasesBySymptom($kodeGejala)
    {
        return $this->select('basispengetahuans.*, penyakits.nama_penyakit, penyakits.det_penyakit, penyakits.srn_penyakit')
            ->join('penyakits', 'penyakits.kode_penyakit = basispengetahuans.kode_penyakit')
            ->where('basispengetahuans.kode_gejala', $kodeGejala)
            ->findAll();
    }

    /**
     * Get all symptoms with their knowledge base values
     */
    public function getAllSymptomsWithKnowledge()
    {
        return $this->db->table('gejala')
            ->select('gejala.kode_gejala, gejala.nama_gejala, basispengetahuans.mb, basispengetahuans.md, basispengetahuans.cf')
            ->join('basispengetahuans', 'basispengetahuans.kode_gejala = gejala.kode_gejala', 'left')
            ->orderBy('gejala.kode_gejala')
            ->get()
            ->getResultArray();
    }

    /**
     * Get knowledge base grouped by disease
     */
    public function getKnowledgeGroupedByDisease()
    {
        $results = $this->select('basispengetahuans.*, penyakits.nama_penyakit, penyakits.det_penyakit, penyakits.srn_penyakit, gejala.nama_gejala')
            ->join('penyakits', 'penyakits.kode_penyakit = basispengetahuans.kode_penyakit')
            ->join('gejala', 'gejala.kode_gejala = basispengetahuans.kode_gejala')
            ->orderBy('basispengetahuans.kode_penyakit')
            ->findAll();

        $grouped = [];
        foreach ($results as $row) {
            $diseaseCode = $row['kode_penyakit'];
            if (!isset($grouped[$diseaseCode])) {
                $grouped[$diseaseCode] = [
                    'kode_penyakit' => $row['kode_penyakit'],
                    'nama_penyakit' => $row['nama_penyakit'],
                    'det_penyakit' => $row['det_penyakit'],
                    'srn_penyakit' => $row['srn_penyakit'],
                    'symptoms' => []
                ];
            }
            $grouped[$diseaseCode]['symptoms'][] = [
                'kode_gejala' => $row['kode_gejala'],
                'nama_gejala' => $row['nama_gejala'],
                'mb' => $row['mb'],
                'md' => $row['md'],
                'cf' => $row['cf']
            ];
        }

        return $grouped;
    }
}