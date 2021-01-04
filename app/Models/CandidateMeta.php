<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateMeta extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wpqs_usermeta';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'umeta_id';

    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
