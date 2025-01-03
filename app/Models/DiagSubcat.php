<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagSubcat extends Model
{
    use HasFactory;

    protected $table = 'ref_diagsubcat';
    protected $fillable = [
        'diagmcat',
        'diagsubcat',
        'diagscatdesc',
        'updated_at',
        'created_at',
        'void'
    ];
}
