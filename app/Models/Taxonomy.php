<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wpqs_term_taxonomy';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'term_taxonomy_id';
}
