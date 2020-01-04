<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermService extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'administrative_name', 'content', 'published', 'publication_date'
    ];

}
