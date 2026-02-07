<?php

namespace App\Services\TicketService;

use DateTime;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class TicketFilter
{

    private array $filter_actions;

    private function addAction(callable $action): self
    {
        $this->filter_actions[] = $action;
        return $this;
    }

    public function setTicketId(int $ticketId): self
    {
        return $this->addAction(
    fn(Builder $builder) => $builder->where('id', $ticketId)
        );
    }

    /**
     * @throws Exception
     */
    public function setStartDate(DateTime|string $date): self
    {
        $date = $date instanceof DateTime ? $date : new DateTime($date);

        return $this->addAction(
            fn(Builder $builder) => $builder->where('created_at', '>=', $date->format('Y-m-d H:i:s'))
        );
    }

    /**
     * @throws Exception
     */
    public function setEndDate(DateTime|string $date): self
    {
        $date = $date instanceof DateTime ? $date : new DateTime($date);

        return $this->addAction(
            fn(Builder $builder) => $builder->where('created_at', '<=', $date->format('Y-m-d H:i:s'))
        );
    }

    public function setStatus(array $status): self
    {
        return $this->addAction(
            fn(Builder $builder) => $builder->whereIn('status', $status)
        );
    }

    /**
     * Фильтр по ID клиента
     */
    public function setCustomerId(int $customerId): self
    {
        return $this->addAction(
            fn(Builder $builder) => $builder->where('customer_id', $customerId)
        );
    }

    public function apply(Builder $builder): void
    {
        foreach ($this->filter_actions as $action) {
            $action($builder);
        }
    }

}
