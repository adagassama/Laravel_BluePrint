<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Facture;

class FactureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Facture::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'facture_number' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'total' => $this->faker->randomFloat(2, 0, 999999.99),
            'status' => $this->faker->randomElement(["failed","successful","pending"]),
        ];
    }
}
