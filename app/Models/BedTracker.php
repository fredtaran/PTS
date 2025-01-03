<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedTracker extends Model
{
    use HasFactory;

    protected $table = 'bed_tracker';
    protected $guarded = array();
}
