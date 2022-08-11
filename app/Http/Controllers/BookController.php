<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Categories;
use App\Models\BooksCategories;
use App\Models\BookKeywords;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$books = Books::all();

        return view('contents.books.index')
        	->with('books', $books);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function data(Request $request)
    {
    	$books = [];
    	if($request->has('bookid')){
    		$books = Books::find($request->bookid);

    		if(is_null($books)) $books = [];
    	} else {
    		$books = Books::all();
    	}

        return json_encode([
        		'data'		=> $books,
        	]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request)
    {
    	$categories = Categories::all();

        return view('contents.books.create')
        	->with('categories', $categories);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function change(Request $request)
    {
		$book = Books::findOrfail($request->bookid);
		$categories = Categories::all();

        return view('contents.books.change')
        	->with('book', $book)
        	->with('categories', $categories);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request)
    {
    	$book = Books::findOrfail($request->bookid);
		$book->title 		= $request->title;
		$book->description 	= $request->description;
		$book->price 		= $request->price;
		$book->stock 		= $request->stock;
		$book->publisher 	= $request->publisher;
        $book->save();

		$bookkeywords = BookKeywords::where('bookid', $request->bookid)->first();
		$bookkeyword = new BookKeywords();

		if(!is_null($bookkeywords))
			$bookkeyword = BookKeywords::find($bookkeywords->id);

		$bookkeyword->bookid 		= $request->bookid;
		$bookkeyword->name 			= $request->keywords;
		$bookkeyword->description	= $request->keywords;
		$bookkeyword->save();
            
        return redirect()
        	->route('book.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function save(Request $request)
    {
    	// dd($request->all());

    	$book = new Books();
		$book->title 		= $request->title;
		$book->description 	= $request->description;
		$book->price 		= $request->price;
		$book->stock 		= $request->stock;
		$book->publisher 	= $request->publisher;
        $book->save();

        $bookscategories = new BooksCategories();
        $bookscategories->bookid		= $book->id;
        $bookscategories->categoryid	= $request->categoryid;
		$bookscategories->save();

		$bookkeywords = new BookKeywords();
		$bookkeywords->bookid		= $book->id;
		$bookkeywords->name 		= $request->keywords;
		$bookkeywords->description	= $request->keywords;
		$bookkeywords->save();
            
        return redirect()
        	->route('book.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete(Request $request)
    {
    	$book = Books::findOrfail($request->bookid);

    	$bookscategories = BooksCategories::where('bookid', $request->bookid);
    	foreach ($bookscategories as $bookscategory) {
    		$bookscategory->delete();
    	}

    	$bookkeywords = BookKeywords::where('bookid', $request->bookid);
    	foreach ($bookkeywords as $bookkeyword) {
    		$bookkeyword->delete();
    	}

		$book->delete();
            
        return redirect()
        	->route('book.index');
    }
}
