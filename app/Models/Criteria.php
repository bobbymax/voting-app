<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function weights()
    {
        return $this->hasMany(Weight::class);
    }

    public function category()
    {
        return $this->morphToMany(Category::class, 'categoryable');
    }
}
