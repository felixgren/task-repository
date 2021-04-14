<?php

namespace Database\Factories;

use App\Models\Assignment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssignmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Assignment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = str_pad(rand(1, 29), 2, '0', STR_PAD_LEFT);
        $month = str_pad(rand(5, 12), 2, '0', STR_PAD_LEFT);
        return [
            "title" => $this->faker->sentence(5),
            "description" => $this->faker->paragraph(50),
            "due_date" => "2021-$month-$date",
            "user_id" => rand(1, 5),
        ];
    }
}
