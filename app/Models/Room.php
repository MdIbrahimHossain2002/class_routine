<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
}
