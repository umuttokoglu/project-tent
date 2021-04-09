<?php

namespace Database\Factories;

use App\Constants\MigrationConstants;
use App\Models\CategoryFile;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryFile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween(1, 50),
            'path' => $this->faker->filePath(),
            'file_extension' =>  'pdf',
            'type' => MigrationConstants::ENUM_PDF,
        ];
    }
}
