<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpcenClient extends Model
{
    use HasFactory;

    protected $table = 'opcen_client';
    protected $guarded = array();
}
