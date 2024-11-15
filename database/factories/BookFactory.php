<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'num_of_pages' => $this->faker->numberBetween(50, 500),
            'picture_url' => $this->faker->imageUrl(),
            'category_id' => $this->faker->numberBetween(1,7)
        ];
    }
}
