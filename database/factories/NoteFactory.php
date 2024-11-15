<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\notes>
 */
class NoteFactory extends Factory
{
    protected $model = Note::class;

    public function definition()
    {
        return [
            'note' => fake()->text(5, 10)
        ];
    }
}
