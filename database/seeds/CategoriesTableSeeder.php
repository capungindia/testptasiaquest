<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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
	    		'name' => 'Umum',
		        'description' => 'Umum',
	        ],
	        [
	    		'name' => 'Interaksi',
		        'description' => 'Interaksi',
	        ],
	        [
	    		'name' => 'Keluarga',
		        'description' => 'Keluarga',
	        ],
	        [
	    		'name' => 'Remaja',
		        'description' => 'Remaja',
	        ],
    	];

    	foreach ($dummies as $dummy) {
    		$dummy["created_at"] = now();
    		$dummy["updated_at"] = now();

    		DB::table('categories')->insert($dummy);
    	}
    }
}
