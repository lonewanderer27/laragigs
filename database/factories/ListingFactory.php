<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // list of all frontend frameworks
        $frontendFrameworks = [
            'React',
            'Angular',
            'Vue.js',
            'Ember.js',
            'Backbone.js',
            'Bootstrap',
            'Foundation',
            'Materialize',
            'Semantic UI',
            'Bulma',
            'Tailwind CSS',
        ];
        // backend or frontend
        $choice = rand(1,2);

        // randomly choose the frontend framework
        // then concat it to a new tag
        $tags = '';
        if ($choice == 1) {
            $tags = "laravel, " . $this->faker->randomElement($frontendFrameworks) . ", frontend";
        } else {
            $tags = "laravel, api, backend";
        }

        return [
            'title' => $this->faker->sentence(),
            'tags' => $tags,
            'company' => $this->faker->company(),
            'email' => $this->faker->companyEmail(),
            'website' => $this->faker->url(),
            'location' => $this->faker->city(),
            'description' => $this->faker->paragraph(5),
        ];
    }
}
