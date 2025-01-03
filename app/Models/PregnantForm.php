<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PregnantForm extends Model
{
    use HasFactory;
    
    protected $table = 'pregnant_form';
    protected $guarded = array();
}
