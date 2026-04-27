<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EventsExport;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::with('creator')
            ->orderByDesc('event_date')
            ->paginate(15);

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'event_date'   => ['required', 'date', 'after:now'],
            'location'     => ['required', 'string', 'max:255'],
            'quota'        => ['required', 'integer', 'min:1'],
            'ticket_price' => ['required', 'numeric', 'min:0'],
            'poster'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('poster')) {
            $data['poster_url'] = $request->file('poster')->store('posters', 'public');
        }

        $data['created_by'] = auth()->id();
        unset($data['poster']);

        Event::create($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil dibuat.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'event_date'   => ['required', 'date'],
            'location'     => ['required', 'string', 'max:255'],
            'quota'        => ['required', 'integer', 'min:1'],
            'ticket_price' => ['required', 'numeric', 'min:0'],
            'poster'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('poster')) {
            // Hapus poster lama jika ada
            if ($event->poster_url) {
                Storage::disk('public')->delete($event->poster_url);
            }
            $data['poster_url'] = $request->file('poster')->store('posters', 'public');
        }

        unset($data['poster']);
        $event->update($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        if ($event->poster_url) {
            Storage::disk('public')->delete($event->poster_url);
        }
        $event->delete();

        return back()->with('success', 'Event berhasil dihapus.');
    }

    public function uploadPoster(Request $request, Event $event)
    {
        $request->validate([
            'poster' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($event->poster_url) {
            Storage::disk('public')->delete($event->poster_url);
        }

        $path = $request->file('poster')->store('posters', 'public');
        $event->update(['poster_url' => $path]);

        return back()->with('success', 'Poster berhasil diupload.');
    }

    public function export()
    {
        return Excel::download(new EventsExport, 'events.xlsx');
    }
}