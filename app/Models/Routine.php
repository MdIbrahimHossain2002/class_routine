<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routine extends Model
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
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
    public function routineDetails(){
        return $this->hasmany(RoutineDetail::class);
    }
    protected $fillable = [
        'faculty_id',
        'department_id',
        'program_id',
        'semester_id',
        'section_id',
    ];
    
    
}
