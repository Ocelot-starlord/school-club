<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // เพิ่ม fillable เพื่ออนุญาตให้กำหนด id, name, classroom
    protected $fillable = ['id', 'name', 'classroom'];
    public function user()
    {
        return $this->hasOne(User::class, 'student_id', 'id');
    }

}
