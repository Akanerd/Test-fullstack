<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skillset extends Model
{
    use HasFactory;

    protected $fillable = ['candidate_id', 'skill_id'];

    // /**
    //  * The candidate that belong to the Skillset
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    //  */
    // public function Candidates()
    // {
    //     return $this->belongsToMany(Candidate::class, 'skillset');
    // }

    /**
     * The candidate that belong to the Skillset
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function candidates()
    {
        return $this->belongsToMany(Candidate::class, 'skillsets');
    }

    /**
     * The skill that belong to the Skillset
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}
