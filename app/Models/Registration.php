<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    public function student()
        {
            return $this->belongsTo(Student::class);
        }

    public function club()
        {
            return $this->belongsTo(Club::class);
        }

    // ✅ อนุญาตให้กำหนดค่าเหล่านี้แบบ mass assignment ได้
    protected $fillable = ['student_id', 'club_id'];
}
