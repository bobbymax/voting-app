<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeLevel extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function employees()
    {
        return $this->hasMany(User::class);
    }

    public function eligibilities()
    {
        return $this->hasMany(Eligibility::class);
    }
}
