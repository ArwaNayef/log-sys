<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class ActivityLog extends Activity
{
    use HasFactory;
    protected $fillable = ['version','properties','causer','causer_type', 'causer_id'];



}
