<?php

namespace Database\Factories;

use App\Models\Curriculum;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurriculumFactory extends Factory
{
    protected $model = Curriculum::class;

    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(2, 11),
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'zip_code' => $this->faker->postcode,
            'linkedin' => $this->faker->url,
            'github' => $this->faker->url,
            'portfolio' => $this->faker->url,
            'objective' => $this->faker->sentence,
        ];
    }
}
