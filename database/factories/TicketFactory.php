<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    {
        $ticket_types = ['VIP', 'Regular'];
        return [
            'ticket_type' => $this->faker->randomElement($ticket_types),
            'event_id' => function () {
                return Event::all()->random();
            },
            'User_id' => function () {
                return User::all()->random();
            },
        ];
    }
}
