<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalExam extends Model
{
    use HasFactory;

    protected $table = 'physical_exam';
    protected $fillable = [
        'patient_id',
        'heigth',
        'weigth',
        'head',
        'conjunctiva',
        'conjunctiva_remarks',
        'neck',
        'chest',
        'breast',
        'breast_remarks',
        'thorax',
        'thorax_remarks',
        'abdomen',
        'abdomen_remarks',
        'genitals',
        'genitals_remarks',
        'extremities',
        'extremities_remarks',
        'others',
        'administered_by',
        'created_at',
        'updated_at',
        'encoded_by',
        'waist_circumference',
        'consulidation_date',
        'consultation_date',
        'void'
    ];
}
