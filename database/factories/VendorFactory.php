<?php

namespace Database\Factories;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Vendor::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'email' => $this->faker->email(),
            'telephone' => $this->faker->word(),
            'password' => $this->faker->password(),


        ];
    }
}
