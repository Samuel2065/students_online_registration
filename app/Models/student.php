<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'picture',
        'dob',
        'birth_certificate',
        'father_name',
        'father_tel',
        'mother_name',
        'mother_tel',
        'tutor_name',
        'tutor_tel',
        'urgence_tel',
        'school_name',
        'academic_background',
        'gce_alevel_papers',
        'gce_alevel_grades',
        'gce_alevel_slip',
        'gce_olevel_papers',
        'gce_olevel_grades',
        'gce_olevel_slip',
        'bacc_serie',
        'bacc_average',
        'bacc_slip',
        'field',
        'speciality',
        'motivation_reason',
        'other_background'
    ];

    protected $casts = [
        'gce_alevel_papers' => 'array',
        'gce_alevel_grades' => 'array',
        'gce_olevel_papers' => 'array',
        'gce_olevel_grades' => 'array',
        // 'bacc_average' => 'decimal:2'
    ];

    /**
     * Get decoded A-Level subjects
     */
    public function getGceAlevelPapersAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    /**
     * Get decoded O-Level subjects
     */
    public function getGceOlevelPapersAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

}
