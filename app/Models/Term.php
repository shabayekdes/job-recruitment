<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wpqs_terms';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'term_id';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public $timestamps = false;

    /**
     * Get all of the tags for the post.
     */
    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'wpqs_term_relationships', 'term_taxonomy_id', 'object_id')->withPivot('term_order');
    }

    /**
     * Get all of the tags for the post.
     */
    public function taxonomy()
    {
        return $this->hasMany(Taxonomy::class, 'term_id');
        // return $this->hasManyThrough(Relationship::class, Taxonomy::class, 'term_id', 'term_taxonomy_id', 'term_id', 'term_taxonomy_id');
    }
}
