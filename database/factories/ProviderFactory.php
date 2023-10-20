<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Provider;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provider>
 */
class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nit_empresa' => $this->faker->unique()->randomNumber(),
            'razon_social' => $this->faker->unique()->name(),
            'departamento' => $this->faker->state(),
            'municipio' => $this->faker->city(),
            'direccion' => $this->faker->address(),
            'celular' => $this->faker->unique()->phoneNumber(),
            'telefono' => $this->faker->unique()->phoneNumber(),
            'email' => $this->faker->email(),
            'password' => $this->faker->numberBetween(10000000, 99999999),
            'rut' => $this->faker->name(),
            'camara_comercio' => $this->faker->name(),
            'estado' => $this->faker->randomElement([0, 1]),
        ];
    }
}
