<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignSymptoms extends Model
{
    use HasFactory;

    protected $table = 'sign_and_symptoms';
    protected $guarded = array();
}
