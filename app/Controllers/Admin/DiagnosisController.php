<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\Admin;
use App\Models\BasisPengetahuan;
use App\Models\Diagnosis;
use App\Models\Gejala;
use App\Models\Penyakit;
use CodeIgniter\HTTP\ResponseInterface;

class DiagnosisController extends BaseController
{
    protected $basisPengetahuanModel;
    protected $penyakitModel;
    protected $gejalaModel;
    protected $diagnosisResultModel;

    public function __construct()
    {
        $this->basisPengetahuanModel = new BasisPengetahuan();
        $this->penyakitModel = new Penyakit();
        $this->gejalaModel = new Gejala();
        $this->diagnosisResultModel = new Diagnosis();
    }


    // public function displayDiagnosis()
    // {
    //     $judul = 'Daftar Hasil Diagnosis';
    //     $diagnosisModel = new Diagnosis();
    //     $diagnosis = $diagnosisModel->orderBy('tanggal_diagnosis', 'DESC')->findAll();
    //     // dd($diagnosis);


    //     // dd($gejala);

    //     return view('admin/diagnosis/index', compact('diagnosis', 'judul'));


    // }

    public function displayDiagnosis()
    {
        $judul = 'Daftar Hasil Diagnosis';

        // Get all diagnosis results with disease details
        $diagnosis = $this->diagnosisResultModel->getDiagnosisWithDetails();

        // Get diagnosis statistics
        $stats = $this->diagnosisResultModel->getDiagnosisStats();

        return view('admin/diagnosis/index', [
            'diagnosis' => $diagnosis,
            'stats' => $stats,
            'judul' => $judul
        ]);
    }
    public function Diagnosis()
    {
        // dd(session('id'));
        $judul = 'Halaman Diagnosis';

        // Get all symptoms with knowledge base data for diagnosis
        $symptoms = $this->basisPengetahuanModel->getAllSymptomsWithKnowledge();

        // Get diseases with their symptoms for the diagnosis logic
        $diseases = $this->basisPengetahuanModel->getKnowledgeGroupedByDisease();

        return view('admin/diagnosis/diagnosis', [
            'judul' => $judul,
            'symptoms' => $symptoms,
            'diseases' => $diseases
        ]);
    }

    // public function displayDiagnosis()
    // {
    //     $judul = 'Daftar Hasil Diagnosis';

    //     // Get all diagnosis results with disease details
    //     $diagnosis = $this->diagnosisResultModel->getDiagnosisWithDetails();

    //     // Get diagnosis statistics
    //     $stats = $this->diagnosisResultModel->getDiagnosisStats();

    //     return view('admin/diagnosis/index', [
    //         'diagnosis' => $diagnosis,
    //         'stats' => $stats,
    //         'judul' => $judul
    //     ]);
    // }

    public function tambahDiagnosis()
    {
        $judul = 'Tambah Diagnosis Baru';

        // Get all diseases for selection
        $penyakit = $this->penyakitModel->findAll();

        // Get all symptoms for knowledge base
        $gejala = $this->gejalaModel->findAll();

        return view('admin/diagnosis/tambah', [
            'judul' => $judul,
            'penyakit' => $penyakit,
            'gejala' => $gejala
        ]);
    }

    public function storeDiagnosis()
    {
        $db = \Config\Database::connect();

        // Validate patient information
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_pasien' => 'required|min_length[3]|max_length[100]',
            'alamat_lahan' => 'max_length[200]',
            'luas_lahan' => 'max_length[50]',
            'gejala_values' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $validation->getErrors()
            ]);
        }

        try {
            $db->transStart();

            // Get patient data
            $patientData = [
                'nama_pasien' => $this->request->getPost('nama_pasien'),
                'alamat_lahan' => $this->request->getPost('alamat_lahan'),
                'luas_lahan' => $this->request->getPost('luas_lahan')
            ];

            // Get symptom values from user input
            $gejalaValues = json_decode($this->request->getPost('gejala_values'), true);

            if (empty($gejalaValues)) {
                throw new \Exception('Tidak ada gejala yang dipilih');
            }

            // Perform diagnosis calculation
            $diagnosisResults = $this->performDiagnosisCalculation($gejalaValues);

            // Save diagnosis result
            $userId = session()->get('user_id') ?? null;
            $diagnosisId = $this->diagnosisResultModel->saveDiagnosis($patientData, $diagnosisResults, $userId);

            if (!$diagnosisId) {
                throw new \Exception('Gagal menyimpan hasil diagnosis');
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaksi database gagal');
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Diagnosis berhasil disimpan',
                'diagnosis_id' => $diagnosisId,
                'results' => $diagnosisResults
            ]);

        } catch (\Throwable $e) {
            $db->transRollback();
            log_message('error', 'Error storeDiagnosis: ' . $e->getMessage());

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Perform diagnosis calculation using Certainty Factor method
     */
    private function performDiagnosisCalculation($userInputs)
    {
        // Get knowledge base grouped by disease
        $diseases = $this->basisPengetahuanModel->getKnowledgeGroupedByDisease();
        $results = [];

        foreach ($diseases as $diseaseCode => $diseaseData) {
            $combinedCF = 0;
            $firstCF = true;
            $matchingSymptoms = 0;

            foreach ($diseaseData['symptoms'] as $symptom) {
                $userValue = $userInputs[$symptom['kode_gejala']] ?? 0;

                if ($userValue > 0) {
                    $matchingSymptoms++;

                    // Calculate CF using: CF = (MB - MD) * User_CF
                    $cf = ($symptom['mb'] - $symptom['md']) * $userValue;

                    if ($firstCF) {
                        $combinedCF = $cf;
                        $firstCF = false;
                    } else {
                        // Combine CF values using CF combination formula
                        if ($combinedCF > 0 && $cf > 0) {
                            $combinedCF = $combinedCF + $cf - ($combinedCF * $cf);
                        } elseif ($combinedCF < 0 && $cf < 0) {
                            $combinedCF = $combinedCF + $cf + ($combinedCF * $cf);
                        } else {
                            $combinedCF = ($combinedCF + $cf) / (1 - min(abs($combinedCF), abs($cf)));
                        }
                    }
                }
            }

            // Get recommendations for this disease
            $recommendations = $this->penyakitModel->getRecommendationsArray($diseaseCode);

            $results[$diseaseCode] = [
                'name' => $diseaseData['nama_penyakit'],
                'detail' => $diseaseData['det_penyakit'],
                'cf' => $combinedCF,
                'percentage' => abs($combinedCF * 100),
                'matching_symptoms' => $matchingSymptoms,
                'total_symptoms' => count($diseaseData['symptoms']),
                'recommendations' => $recommendations
            ];
        }

        return $results;
    }

    public function editDiagnosis($id)
    {
        $judul = 'Edit Hasil Diagnosis';
        $diagnosis = $this->diagnosisResultModel->find($id);

        if (!$diagnosis) {
            return redirect()->to(url_to('diagnosis.index'))->with('error', 'Data diagnosis tidak ditemukan');
        }

        return view('admin/diagnosis/edit', [
            'judul' => $judul,
            'diagnosis' => $diagnosis
        ]);
    }

    public function updateDiagnosis($id)
    {
        $diagnosis = $this->diagnosisResultModel->find($id);

        if (!$diagnosis) {
            return redirect()->to(url_to('diagnosis.index'))->with('error', 'Data diagnosis tidak ditemukan');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_pasien' => 'required|min_length[3]|max_length[100]',
            'alamat_lahan' => 'max_length[200]',
            'luas_lahan' => 'max_length[50]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama_pasien' => $this->request->getPost('nama_pasien'),
            'alamat_lahan' => $this->request->getPost('alamat_lahan'),
            'luas_lahan' => $this->request->getPost('luas_lahan')
        ];

        if ($this->diagnosisResultModel->update($id, $data)) {
            return redirect()->to(url_to('diagnosis.index'))->with('success', 'Data diagnosis berhasil diupdate');
        } else {
            return redirect()->back()->with('error', 'Gagal mengupdate data diagnosis');
        }
    }

    public function hapusDiagnosis($id)
    {
        $diagnosis = $this->diagnosisResultModel->find($id);

        if (!$diagnosis) {
            return redirect()->to(url_to('diagnosis.index'))->with('error', 'Data diagnosis tidak ditemukan');
        }

        if ($this->diagnosisResultModel->delete($id)) {
            return redirect()->to(url_to('diagnosis.index'))->with('success', 'Data diagnosis berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data diagnosis');
        }
    }

    /**
     * Get symptoms data for AJAX request
     */
    public function getSymptomsData()
    {
        // dd('asdas');
        try {
            $symptoms = $this->basisPengetahuanModel->getAllSymptomsWithKnowledge();

            return $this->response->setJSON([
                'success' => true,
                'data' => $symptoms
            ]);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Get diseases data for AJAX request
     */
    public function getDiseasesData()
    {
        try {
            $diseases = $this->basisPengetahuanModel->getKnowledgeGroupedByDisease();

            return $this->response->setJSON([
                'success' => true,
                'data' => $diseases
            ]);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Process diagnosis via AJAX
     */
    public function processDiagnosis()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(404);
        }

        try {
            // Validate input
            $validation = \Config\Services::validation();
            $validation->setRules([
                'nama_pasien' => 'required|min_length[3]',
                'gejala_values' => 'required'
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Data tidak valid',
                    'errors' => $validation->getErrors()
                ]);
            }

            // Get input data
            $gejalaValues = json_decode($this->request->getPost('gejala_values'), true);

            if (empty($gejalaValues) || !array_filter($gejalaValues)) {
                throw new \Exception('Mohon pilih minimal satu gejala');
            }

            // Perform diagnosis
            $results = $this->performDiagnosisCalculation($gejalaValues);

            // Sort by CF value descending
            uasort($results, function ($a, $b) {
                return $b['percentage'] <=> $a['percentage'];
            });

            return $this->response->setJSON([
                'success' => true,
                'results' => $results
            ]);

        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Save diagnosis result via AJAX
     */
    public function saveDiagnosisResult()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(404);
        }

        $db = \Config\Database::connect();

        try {
            $db->transStart();

            $validation = \Config\Services::validation();
            $validation->setRules([
                'nama_pasien' => 'required|min_length[3]',
                'diagnosis_results' => 'required'
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                throw new \Exception('Data tidak valid');
            }

            // Get data
            $patientData = [
                'user_id' => session('id'),
                'nama_pasien' => $this->request->getPost('nama_pasien'),
                'alamat_lahan' => $this->request->getPost('alamat_lahan'),
                'luas_lahan' => $this->request->getPost('luas_lahan')
            ];

            $diagnosisResults = json_decode($this->request->getPost('diagnosis_results'), true);

            if (empty($diagnosisResults)) {
                throw new \Exception('Hasil diagnosis tidak valid');
            }

            // Save to database
            $userId = session()->get('user_id') ?? null;
            $diagnosisId = $this->diagnosisResultModel->saveDiagnosis($patientData, $diagnosisResults, $userId);

            if (!$diagnosisId) {
                throw new \Exception('Gagal menyimpan hasil diagnosis');
            }

            $db->transComplete();

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Hasil diagnosis berhasil disimpan',
                'redirect' => route_to('diagnosis.index'),
                'diagnosis_id' => $diagnosisId
            ]);

        } catch (\Throwable $e) {
            $db->transRollback();
            log_message('error', 'Error saveDiagnosisResult: ' . $e->getMessage());

            return $this->response->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Search diagnosis results
     */
    public function searchDiagnosis()
    {
        $keyword = $this->request->getGet('keyword');
        $dateFrom = $this->request->getGet('date_from');
        $dateTo = $this->request->getGet('date_to');

        $results = $this->diagnosisResultModel->searchDiagnoses($keyword, $dateFrom, $dateTo);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => true,
                'data' => $results
            ]);
        }

        $judul = 'Hasil Pencarian Diagnosis';
        return view('admin/diagnosis/index', [
            'diagnosis' => $results,
            'judul' => $judul,
            'search_params' => [
                'keyword' => $keyword,
                'date_from' => $dateFrom,
                'date_to' => $dateTo
            ]
        ]);
    }

    /**
     * Get diagnosis details
     */
    public function getDiagnosisDetail($id)
    {
        $diagnosis = $this->diagnosisResultModel->find($id);

        if (!$diagnosis) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $diagnosis
        ]);
    }
}