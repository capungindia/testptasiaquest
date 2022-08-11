<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BooksCategories extends Model
{
    protected $table = 'bookscategories';

    protected $fillable = [
        'bookid', 'categoryid',
    ];

    // relation
    public function book() {
    	return $this->belongsTo('App\Models\Books', 'bookid');
    }

    public function category() {
    	return $this->belongsTo('App\Models\Categories', 'categoryid');
    }
}
