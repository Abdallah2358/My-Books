<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $count =  User::count();
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $count),
            'update_user_id' => $this->faker->numberBetween($min = 1, $count),
            'category_id' => $this->faker->numberBetween($min = 1, Category::count()),
            'name' => $this->faker->name(),
            'descripto' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'rating' => $this->faker->numberBetween($min = 1, $max = 5),
        ];
    }
}
