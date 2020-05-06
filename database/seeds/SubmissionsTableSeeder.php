<?php

use App\Submission;
use Illuminate\Database\Seeder;

class SubmissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(Submission::class,10)->create();
    }
}
