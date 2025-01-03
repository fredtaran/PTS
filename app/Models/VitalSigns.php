<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VitalSigns extends Model
{
    use HasFactory;

    protected $table = 'vital_signs';
    protected $fillable = [
        'patient_id',
        'bps',
        'bpd',
        'respiratory_rate',
        'body_temperature',
        'heart_rate',
        'normal_rate',
        'regular_rhythm',
        'pulse_rate',
        'oxygen_saturation',
        'administered_by',
        'encoded_by',
        'created_at',
        'updated_at',
        'consolidation_date',
        'void',
        'remarks',
        'consultation_date'
    ];
}
