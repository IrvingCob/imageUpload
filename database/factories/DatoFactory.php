<?php

namespace Database\Factories;

use App\Models\Dato;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DatoFactory extends Factory
{
    protected $model = Dato::class;

    public function definition()
    {
        return [
			'dato' => $this->faker->name,
        ];
    }
}
