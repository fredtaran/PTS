<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filetypes extends Model
{
    use HasFactory;

    protected $table = 'filetypes';
    protected $guarded = array();
}
