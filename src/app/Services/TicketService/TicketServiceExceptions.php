<?php

namespace App\Services\TicketService;
use Exception;

class TicketNotFoundException extends Exception
{
}

class InvalidTicketDataException extends Exception
{
}

class TicketIsClosedException extends Exception
{
}

class TooManyTicketsException extends Exception
{
}

class TicketNotSavedException extends Exception
{
}
