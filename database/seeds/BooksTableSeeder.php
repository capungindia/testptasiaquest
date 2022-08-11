<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
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
	    		'title' => 'Kepemimpinan dan seni bicara',
		        'description' => 'Kepemimpinan dan seni bicaraUmum',
		        'price'	=> 50000,
		        'stock'	=> 50,
		        'publisher'	=> 'Gramedia',
	        ],
    	];

    	foreach ($dummies as $dummy) {
    		$dummy["created_at"] = now();
    		$dummy["updated_at"] = now();

    		DB::table('books')->insert($dummy);
    	}
    }
}
