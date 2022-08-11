<?php

use Illuminate\Database\Seeder;

class BooksCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$dummies = [
    		[
	    		'bookid' => 1,
		        'categoryid' => 1,
	        ],
    		[
	    		'bookid' => 1,
		        'categoryid' => 2,
	        ],
    		[
	    		'bookid' => 1,
		        'categoryid' => 3,
	        ],
    	];

    	foreach ($dummies as $dummy) {
    		$dummy["created_at"] = now();
    		$dummy["updated_at"] = now();

    		DB::table('bookscategories')->insert($dummy);
    	}
    }
}
