<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function voteable()
    {
        return $this->morphTo();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'criteria_id');
    }

    public function caster()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
