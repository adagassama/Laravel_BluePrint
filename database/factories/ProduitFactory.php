<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Produit;

class ProduitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Produit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titre' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'slug' => $this->faker->slug,
            'prix' => $this->faker->randomNumber(),
            'is_available' => $this->faker->boolean,
        ];
    }
}
