<?php

namespace Database\Seeders;

use App\Models\CategoryFile;
use Illuminate\Database\Seeder;

class CategoryFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryFile::factory(100)->create();
    }
}
