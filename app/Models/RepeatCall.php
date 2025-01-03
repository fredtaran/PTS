<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepeatCall extends Model
{
    use HasFactory;

    protected $table = 'repeat_call';
    protected $guarded = array();
}
