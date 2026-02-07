<?php

namespace App\Services\TicketService;

use App\Models\Ticket;

interface ITicketService
{

    /**
     * Возвращает тикет если он есть или вызывает исключение
     *
     * @param int $ticketId
     * @return Ticket
     * @throws TicketNotFoundException
     */
    public function getTicket(int $ticketId): Ticket;

    /**
     * Возвращает тикеты по фильтру если они есть или вызывает исключение
     * @param TicketFilter $filter
     * @return array
     * @throws TicketNotFoundException
     */
    public function getTicketsByFilter(TicketFilter $filter): array;

    /**
     * Создает тикет и вызывает исключение при нарушении валидации или если клиент отправил слишком много
     * тикетов за некоторое количество времени
     *
     * @param int $customerId
     * @param string $title
     * @param string $text
     * @return Ticket
     * @throws InvalidTicketDataException
     * @throws TooManyTicketsException
     * @throws TicketNotSavedException
     */
    public function createTicket(int $customerId, string $title, string $text): Ticket;

    /**
     * Обновляет статус тикета или вызывает исключение если его нет или тикет уже в этом состоянии/закрыт
     *
     * @param int $ticketId
     * @param TicketStatus $ticketStatus
     * @return void
     * @throws TicketNotFoundException
     * @throws InvalidTicketDataException
     * @throws TicketIsClosedException
     * @throws TicketNotSavedException
     */
    public function updateTicket(int $ticketId, TicketStatus $ticketStatus): void;


}
