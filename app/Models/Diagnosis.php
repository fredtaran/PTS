<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    protected $table = 'ref_diagnosis';
    protected $fillable = [
        'diagcode',
        'diagdesc',
        'diagcategory',
        'diagsubcat',
        'diagpriority',
        'diagmaincat',
        'updated_at',
        'created_at',
        'void'
    ];
}
