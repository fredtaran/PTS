<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAddendum extends Model
{
    use HasFactory;

    protected $table = 'client_addendum';
    protected $guarded = array();
}
