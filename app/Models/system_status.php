<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class system_status extends Model
{
    use HasFactory;
    protected $table = 'system_statuses';
    protected $fillable = ['modul','idx','nameStatus','activeStatus'];    
}
