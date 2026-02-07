<?php

namespace App\Http\Controllers;

use App\Services\TicketService\TicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    private TicketService $ticketService;

    public function __construct() {
        $this->ticketService = new TicketService();
    }

    public function sendTicket(Request $request): JsonResponse
    {
        $ticket = $this->ticketService->createTicket(1, "Test", "Тестовый тикет");
        return response()->json([
            "success" => true,
            "ticketId" => $ticket->getAttribute('id')
        ]);
    }

    public function getTicketStatistics(Request $request): JsonResponse
    {
        return response()->json([]);
    }

    public function getTickets(Request $request): JsonResponse
    {
        return response()->json([]);
    }
}
