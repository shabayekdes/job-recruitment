<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wpqs_term_relationships';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'object_id';
}
