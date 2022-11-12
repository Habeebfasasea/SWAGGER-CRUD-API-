<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'document_name' => $this->faker->company,
            'document_type' => $this->faker->randomElement(['Quote', 'Proposal', 'Logo', 'Resume', 'Presentation', 'Invoice']),
            'document_url' => 'Documents/document1.pdf',

        ];
    }
}
