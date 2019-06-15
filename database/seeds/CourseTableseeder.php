<?php

use Illuminate\Database\Seeder;
use App\Models\Course;
class CourseTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Course::truncate();
        factory(Course::class,10)->create();
    }
    
}
