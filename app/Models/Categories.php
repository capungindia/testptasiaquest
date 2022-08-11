<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name', 'description',
    ];

    // relation
    public function books() {
    	return $this->hasMany('App\Models\BooksCategories', 'bookid');
    }
}
