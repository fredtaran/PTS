<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $table = 'tracking';
    protected $fillable = [
        'patient_id',
        'code',
        'date_referred',
        'date_transferred',
        'date_arrived',
        'date_seen',
        'mode_transportation',
        'date_accepted',
        'referred_from',
        'referred_to',
        'department_id',
        'remarks',
        'referring_md',
        'action_md',
        'status',
        'type',
        'form_id',
        'walkin',
        'source'
    ];
}
