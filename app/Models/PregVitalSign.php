<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PregVitalSign extends Model
{
    use HasFactory;

    protected $table = 'preg_vital_signs';
    protected $guarded = array();
}
