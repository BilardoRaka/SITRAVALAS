<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(9, true),
            'nama' => $this->faker->name(),
            'alamat' => $this->faker->address(),
            'tempatlahir' => $this->faker->city(),
            'tgllahir' => $this->faker->date(),
            'nohp' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->email()
        ]; 
    }
}
