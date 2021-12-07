<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function weights()
    {
        return $this->hasMany(Weight::class);
    }

    public function criterias()
    {
        return $this->morphedByMany(Criteria::class, 'categoryable');
    }

    public function votables()
    {
        return $this->hasMany(CanVote::class);
    }

    public function isEligibleToBeVotedFor($gradeId)
    {
        return $this->votables->contains('grade_level_id', $gradeId);
    }

    public function hasCriteria($criteria)
    {
        if (is_string($criteria)) {
            return $this->criterias->contains('label', $criteria);
        }

        foreach ($criteria as $c) {
            if ($this->hasCriteria($c->label)) {
                return true;
            }
        }

        return false;
    }
}
