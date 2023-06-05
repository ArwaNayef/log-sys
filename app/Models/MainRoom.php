<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainRoom extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'customer_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

//    public function activities()
//    {
//        return $this->hasMany(ActivityLog::class);
//    }


    public function activities()
    {
        return $this->morphMany(ActivityLog::class, 'subject');
    }
}
