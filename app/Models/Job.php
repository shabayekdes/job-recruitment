<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wpqs_posts';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'post_date'
    ];

    /**
     * Get the comments for the blog post.
     */
    public function meta()
    {
        return $this->hasMany(JobMeta::class, 'post_id', 'ID');
    }

    /**
     * Get the comments for the blog post.
     */
    public function term()
    {
        return $this->belongsToMany(Term::class, 'wpqs_term_relationships', 'object_id', 'term_taxonomy_id');
    }

    public function delete()
    {
        JobMeta::where("post_id", $this->id)->delete();

        // delete the user
        return parent::delete();
    }
}
