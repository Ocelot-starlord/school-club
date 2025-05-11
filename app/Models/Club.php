<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Registration;

class Club extends Model
{
    protected $fillable = ['name', 'teacher_name', 'capacity'];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

}
