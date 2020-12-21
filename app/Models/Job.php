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
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public $timestamps = false;

    /**
     * Get the comments for the blog post.
     */
    public function meta()
    {
        return $this->hasMany(JobMeta::class, 'post_id', 'ID');
    }
}
