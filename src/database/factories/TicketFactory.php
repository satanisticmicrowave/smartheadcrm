<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Services\TicketService\TicketStatus;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{

    /**
     * @inheritDoc
     */
    public function definition()
    {
        return [
            'customer_id' => $this->faker->uuid(),
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'status' => $this->faker->randomElement([
                TicketStatus::PENDING,
                TicketStatus::IN_PROGRESS,
                TicketStatus::PROCESSED
            ]),
            'processed_at' => $this->faker->dateTime(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime()
        ];
    }

    public function ticket(): static
    {
        return $this->state(
            fn(array $attributes) => [
                'status' => TicketStatus::PENDING,
                'created_at' => new DateTime('now'),
                'updated_at' => new DateTime('now'),
                'processed_at' => null
            ]
        );
    }

    public function withCustomer(int $customer_id): static
    {
        return $this->state(fn(array $attributes) => [
            'customer_id' => $customer_id,
        ]);
    }

    public function withAttachments(): static
    {
        return $this->afterCreating(function(Ticket $ticket){
            $attachmentCount = 1;

            for ($i = 0; $i < $attachmentCount; $i++) {
                // TODO: Обработка файлов
            }
        });
    }

    public function withContent(string $title, string $text): static
    {
        return $this->state(fn(array $attributes) => [
            'title' => $title,
            'description' => $text,
        ]);
    }
}
