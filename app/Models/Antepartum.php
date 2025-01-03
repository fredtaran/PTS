<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antepartum extends Model
{
    use HasFactory;

    protected $table = 'antepartum_conditions';
    protected $guarded = array();
}
