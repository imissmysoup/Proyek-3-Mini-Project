<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = ['laporan_id', 'user_id', 'old_status', 'new_status'];
}
