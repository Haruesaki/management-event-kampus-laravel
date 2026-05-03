<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Dummy events for UI preview (no database needed yet).
     */
    private function dummyEvents(): array
    {
        return [
            [
                'id'       => 1,
                'name'     => 'Future Tech Summit',
                'subtitle' => 'Innovation & Beyond',
                'date'     => '2026-05-15',
                'category' => 'Technology',
                'venue'    => 'Main Engineering Hall',
                'address'  => 'Engineering Building, North Campus',
                'price'    => 25,
                'color'    => 'linear-gradient(135deg,#0d1525,#1a1030)',
            ],
            [
                'id'       => 2,
                'name'     => 'Canvas of Dreams',
                'subtitle' => 'Fine Arts Exhibition',
                'date'     => '2026-06-02',
                'category' => 'Art',
                'venue'    => 'Fine Arts Pavilion',
                'address'  => 'Arts Faculty, West Campus',
                'price'    => 0,
                'color'    => 'linear-gradient(135deg,#1e2a1a,#2a3520)',
            ],
            [
                'id'       => 3,
                'name'     => 'Neon Nocturne',
                'subtitle' => 'Digital Symphony',
                'date'     => '2026-06-10',
                'category' => 'Music',
                'venue'    => 'Main Plaza Auditorium',
                'address'  => 'Central Plaza, Main Campus',
                'price'    => 24,
                'color'    => 'linear-gradient(135deg,#1a1030,#2a1060)',
            ],
            [
                'id'       => 4,
                'name'     => 'Shadows & Strings',
                'subtitle' => 'Classical Fusion',
                'date'     => '2026-06-15',
                'category' => 'Music',
                'venue'    => 'The Velvet Chamber',
                'address'  => 'Music Conservatory, East Campus',
                'price'    => 18,
                'color'    => 'linear-gradient(135deg,#0d1f1a,#1a3530)',
            ],
            [
                'id'       => 5,
                'name'     => 'Midnight Poetry & Jazz',
                'subtitle' => 'Literary Evening',
                'date'     => '2026-06-22',
                'category' => 'Literary Arts',
                'venue'    => 'Founders Library',
                'address'  => 'Library Complex, South Campus',
                'price'    => 15,
                'color'    => 'linear-gradient(135deg,#1f1510,#3a2508)',
            ],
            [
                'id'       => 6,
                'name'     => 'Future Forms',
                'subtitle' => 'Kinetic Art Expo',
                'date'     => '2026-06-25',
                'category' => 'Visual Media',
                'venue'    => 'Design Atrium',
                'address'  => 'Design Faculty, West Campus',
                'price'    => 10,
                'color'    => 'linear-gradient(135deg,#0d1a1f,#0a2a35)',
            ],
        ];
    }

    /**
     * Display a listing of events.
     */
    public function index(Request $request)
    {
        $events = $this->dummyEvents();
        $faculties = [];

        // Simple category filter
        if ($request->filled('category')) {
            $events = array_filter($events, function ($e) use ($request) {
                return strtolower($e['category']) === strtolower($request->category);
            });
        }

        // Simple search filter
        if ($request->filled('search')) {
            $q = strtolower($request->search);
            $events = array_filter($events, function ($e) use ($q) {
                return str_contains(strtolower($e['name']), $q)
                    || str_contains(strtolower($e['venue']), $q);
            });
        }

        return view('events.index', 
        [
        'events'    => array_values($events),
        'faculties' => $faculties,]);
    }

    /**
     * Display the specified event.
     */
    public function show($id)
    {
        $events = $this->dummyEvents();

        // Find by id
        $event = collect($events)->firstWhere('id', (int) $id);

        if (!$event) {
            // Fallback to first event so the view always renders
            $event = $events[0];
        }

        // Convert array to object so blade can use -> syntax
        $event = (object) $event;

        return view('events.show', compact('event'));
    }
}
