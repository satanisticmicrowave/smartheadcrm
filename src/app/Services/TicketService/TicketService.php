<?php

namespace App\Services\TicketService;

use App\Models\Ticket;
use App\Services\TicketService\ITicketService;
use Illuminate\Database\Query\Builder;

class TicketService implements ITicketService
{

    /**
     * @inheritDoc
     */
    public function getTicket(int $ticketId): Ticket
    {
        $builder = Ticket::query();
        $filter = new TicketFilter();
        $filter->setTicketId($ticketId);
        $filter->apply($builder);

        $result = $builder->first();

        if (!$result) {
            throw new TicketNotFoundException("Тикет не найден!");
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getTicketsByFilter(TicketFilter $filter): array
    {
        $builder = Ticket::query();
        $filter->apply($builder);

        $result = $builder->get();

        if ($result->isEmpty()) {
            throw new TicketNotFoundException("Тикет не найден!");
        }

        return $result->toArray();
    }

    /**
     * @inheritDoc
     */
    public function createTicket(int $customerId, string $title, string $text): Ticket
    {
        $ticket = Ticket::factory()->ticket()->withCustomer($customerId)->withContent($title, $text)->make();
        $result = $ticket->save();

        if (!$result) {
            throw new TicketNotSavedException("Не удалось создать тикет!");
        }

        return $ticket;
    }

    /**
     * @inheritDoc
     */
    public function updateTicket(int $ticketId, TicketStatus $ticketStatus): void
    {
        $ticket = $this->getTicket($ticketId);

        if ($ticket->getAttribute('status') == $ticketStatus) {
            throw new InvalidTicketDataException("Тикет уже в этом состоянии!");
        }

        if ($ticket->getAttribute('status') == TicketStatus::PROCESSED) {
            throw new TicketIsClosedException("Тикет уже закрыт!");
        }

        $ticket->setAttribute('status', $ticketStatus);
        $result = $ticket->save();

        if (!$result) {
            throw new TicketNotSavedException("Не удалось обновить тикет!");
        }

    }
}
