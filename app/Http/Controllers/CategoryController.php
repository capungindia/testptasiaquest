<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
    	$categories = Categories::all();
        return view('contents.categories.index')
        	->with('categories', $categories);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function data(Request $request)
    {
    	$categories = [];
    	if($request->has('categoryid')){
    		$categories = Categories::find($request->categoryid);

    		if(is_null($categories))
    			$categories = [];

    	} else {
    		$categories = Categories::all();
    	}

        return json_encode([
        		'data'		=> $categories,
        	]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request)
    {
        return view('contents.categories.create');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function save(Request $request)
    {
    	$validated = $request->validate([
	        'name'			=> 'required',
	        'description' 	=> 'required',
	    ]);

        $categories = new Categories($request->all());
        $categories->save();
            
        return redirect()
        	->route('category.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function change(Request $request)
    {
    	$category = Categories::findOrFail($request->categoryid);

        return view('contents.categories.change')
        	->with('category', $category);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request)
    {
    	$category = Categories::findOrFail($request->categoryid);
    	$category->name 		= $request->name;
    	$category->description 	= $request->description;
    	$category->save();

        return redirect()
        	->route('category.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete(Request $request)
    {
    	$category = Categories::findOrFail($request->categoryid);
    	$category->delete(0);

        return redirect()
        	->route('category.index');
    }
}
