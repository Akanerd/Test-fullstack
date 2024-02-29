<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'job_id' ,'email', 'phone', 'year', 'created_by', 'updated_by', 'deleted_by'];

    /**
     * The skillset that belong to the Candidate
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    // public function Skillsets()
    // {
    //     return $this->belongsToMany(Skillset::class, 'skillset');
    // }

    /**
     * The skillset that belong to the Candidate
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function skillsets()
    {
        return $this->belongsToMany(Skillset::class, 'skill_set');
    }
    /**
     * Get the job that owns the Candidate
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, "skill_set", "candidate_id",  "skillset_id");
    }
    
}
