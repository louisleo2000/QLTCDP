<?php

namespace Database\Factories;

use App\Models\Vaccine;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'vaccine_id' =>Vaccine::all()->random()->id,
             'date_time'=> $this->faker->dateTimeBetween('now', '+1 years'),
        ];
    }
}
