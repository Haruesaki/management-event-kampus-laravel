<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function dashboard()
    {
        $upcomingEvents = Event::where('event_date', '>=', now())
            ->orderBy('event_date')
            ->take(6)
            ->get();

        return view('dashboard', compact('upcomingEvents'));
    }

    public function index(Request $request)
    {
        $query = Event::query()->where('event_date', '>=', now());

        if ($request->search) {
            $query->where('title', 'like', "%{$request->search}%")
                  ->orWhere('location', 'like', "%{$request->search}%");
        }

        if ($request->date === 'today') {
            $query->whereDate('event_date', today());
        } elseif ($request->date === 'week') {
            $query->whereBetween('event_date', [now(), now()->endOfWeek()]);
        } elseif ($request->date === 'month') {
            $query->whereMonth('event_date', now()->month);
        }

        if ($request->price === 'free') {
            $query->where('ticket_price', 0);
        } elseif ($request->price === 'paid') {
            $query->where('ticket_price', '>', 0);
        }

        $events = $query->orderBy('event_date')->paginate(9);

        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }
}