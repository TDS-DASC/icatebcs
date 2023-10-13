<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\City;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $city = City::find(19)->id;
        return [
            'colonia' => $this->faker->address(),
            'calle' => $this->faker->streetName(),
            'codigo_postal' => $this->faker->postcode(),
            'numero' => $this->faker->buildingNumber(),
            'city_id' => $city,
        ];
    }
}
