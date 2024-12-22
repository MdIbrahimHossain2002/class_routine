<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutineDetail extends Model
{
    use HasFactory;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }
    
    protected $fillable = [
        'routine_id',
        'course_id',
        'teacher_id',
        'day_one',
        'day_two',
        'time',
        'room_id',
    ];
    
    
}
