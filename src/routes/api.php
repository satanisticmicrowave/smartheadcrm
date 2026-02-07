<?php

use Illuminate\Support\Facades\Route;

Route::prefix('widget')->group(function () {
    Route::get('/', "App\Http\Controllers\WidgetController@getWidget");
});

Route::prefix('ticket')->middleware([])->group(function () {
    Route::get('/', 'App\Http\Controllers\TicketController@sendTicket');
    Route::get('/statistics', "App\Http\Controllers\TicketController@getTicketStatistics");
});
