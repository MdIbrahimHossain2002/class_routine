<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
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
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    
}
