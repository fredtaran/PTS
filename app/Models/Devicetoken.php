<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devicetoken extends Model
{
    use HasFactory;

    protected $table = 'devicetoken';
    protected $fillable = ['facility_id','token'];
}
