<?php

namespace App\Models;

use CodeIgniter\Model;

class Penyakit extends Model
{
    protected $table = 'penyakits';
    protected $primaryKey = 'kode_penyakit';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function getDiseaseWithSymptomsCount()
    {
        return $this->select('penyakits.*, COUNT(basispengetahuans.kode_gejala) as symptoms_count')
            ->join('basispengetahuans', 'basispengetahuans.kode_penyakit = penyakits.kode_penyakit', 'left')
            ->groupBy('penyakits.kode_penyakit')
            ->findAll();
    }

    /**
     * Get disease with all related symptoms
     */
    public function getDiseaseWithSymptoms($kodePenyakit = null)
    {
        $builder = $this->select('penyakits.*, gejala.kode_gejala, gejala.nama_gejala, basispengetahuans.mb, basispengetahuans.md, basispengetahuans.cf')
            ->join('basispengetahuans', 'basispengetahuans.kode_penyakit = penyakits.kode_penyakit', 'left')
            ->join('gejala', 'gejala.kode_gejala = basispengetahuans.kode_gejala', 'left');

        if ($kodePenyakit) {
            $builder->where('penyakits.kode_penyakit', $kodePenyakit);
        }

        return $builder->findAll();
    }

    /**
     * Get recommendations (srn_penyakit) as array
     */
    public function getRecommendationsArray($kodePenyakit)
    {
        $disease = $this->find($kodePenyakit);
        if (!$disease) {
            return [];
        }

        // Split recommendations by newline or semicolon
        $recommendations = preg_split('/[\r\n;]+/', trim($disease['srn_penyakit']));
        return array_filter(array_map('trim', $recommendations));
    }
}