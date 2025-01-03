<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PregOutcome extends Model
{
    use HasFactory;

    protected $table = 'preg_outcome';
    protected $guarded = array();
}
