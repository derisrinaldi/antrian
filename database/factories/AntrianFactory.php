<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AntrianFactory extends Factory
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
            'unit_id'=>rand(1,3),
            'antrian'=>rand(1,100),
            'loket_id'=>rand(1,2),
            'queue_date'=>Carbon::create($this->faker->dateTimeBetween('-1 months', '+1 week'))->toDateString(),
            'status'=>'2'
        ];
    }
}