<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident_type extends Model
{
    use HasFactory;

    protected $table = 'incident_type';
    protected $guarded = array();
}
