<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobMeta extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wpqs_postmeta';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'meta_id';

    public $timestamps = false;

}
