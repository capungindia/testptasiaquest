<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'title', 'description', 'price', 'stock', 'publisher',
    ];

    // relation
    public function categories() {
    	return $this->hasMany('App\Models\BooksCategories', 'bookid');
    }

    public function keywords() {
    	return $this->hasMany('App\Models\BookKeywords', 'bookid');
    }
}
