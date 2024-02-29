<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'created_by', 'updated_by', 'deleted_by'];

    /**
     * The skillset that belong to the Skill
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function skillsets()
    {
        return $this->belongsToMany(skillset::class,'skill_set');
    }
}
