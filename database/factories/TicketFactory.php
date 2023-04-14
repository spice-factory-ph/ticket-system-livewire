<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Priority;
use App\Models\Project;
use App\Models\Status;
use App\Models\Type;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => fake()->randomElement(Project::all()->pluck('id')),
            'type_id' => fake()->randomElement(Type::all()->pluck('id')),
            'title' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'priority_id' => fake()->randomElement(Priority::all()->pluck('id')),
            'status_id' => fake()->randomElement(Status::all()->pluck('id')),
            'assigned_to' => fake()->randomElement(User::all()->pluck('id')),
            'created_by' => fake()->randomElement(User::all()->pluck('id')),
        ];
    }
}
