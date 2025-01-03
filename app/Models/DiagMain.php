<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagMain extends Model
{
    use HasFactory;

    protected $table = 'ref_daigmaincategory';
    protected $fillable = [
        'diagcat',
        'catdesc',
        'updated_at',
        'created_at',
        'void'
    ];
}
