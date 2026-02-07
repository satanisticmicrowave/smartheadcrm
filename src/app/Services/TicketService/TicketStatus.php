<?php

namespace App\Services\TicketService;

enum TicketStatus: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case PROCESSED = 'processed';

}
