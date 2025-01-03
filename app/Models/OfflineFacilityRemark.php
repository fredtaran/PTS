<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfflineFacilityRemark extends Model
{
    use HasFactory;

    protected $table = 'offline_remarks';
    protected $guarded = array();
}
