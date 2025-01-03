<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceNumber extends Model
{
    use HasFactory;

    protected $table = 'reference_number';
    protected $guarded = array();
}
