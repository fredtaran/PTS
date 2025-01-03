<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryLogs extends Model
{
    use HasFactory;

    protected $table = 'inventory_logs';
    protected $guarded = array();
}
