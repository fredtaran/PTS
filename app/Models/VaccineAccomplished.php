<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineAccomplished extends Model
{
    use HasFactory;

    protected $table = 'vaccine_accomplish';
    protected $guarded = array();
}
