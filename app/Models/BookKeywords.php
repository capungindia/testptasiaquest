<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookKeywords extends Model
{
    protected $table = 'bookkeywords';

    protected $fillable = [
        'bookid', 'name', 'description',
    ];

    public function book() {
    	return $this->belongsTo('App\Models\Books', 'bookid');
    }
}
