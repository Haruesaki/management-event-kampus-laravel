<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Tampilan form buat event.
     */
    public function create()
    {
        return view('panitia.create');
    }

    /**
     * Simpan data event ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'event_date' => 'required|date',
            'gates_open' => 'nullable|string|max:100',
            'duration' => 'nullable|string|max:100',
            'location' => 'required|string',
            'google_maps_url' => 'nullable|url',
            'description' => 'required|string',
            'poster_data' => 'required|string', 
            'tickets' => 'required|string',    
        ]);

        try {
            DB::beginTransaction();

            // 2. Proses Poster (Base64 -> File di public/images)
            $posterData = $request->poster_data;
            
            // Ekstrak informasi gambar
            if (preg_match('/^data:image\/(\w+);base64,/', $posterData, $type)) {
                $image = substr($posterData, strpos($posterData, ',') + 1);
                $extension = strtolower($type[1]); // png, jpg, etc.

                if (!in_array($extension, ['jpg', 'jpeg', 'gif', 'png', 'webp'])) {
                    throw new \Exception('Format gambar tidak didukung.');
                }

                $image = base64_decode($image);
                if ($image === false) {
                    throw new \Exception('Gagal mendekode data gambar.');
                }
            } else {
                throw new \Exception('Data gambar tidak valid.');
            }

            $imageName = 'poster_' . time() . '_' . Str::random(5) . '.' . $extension;
            $imagePath = public_path('images/' . $imageName);

            // Simpan file secara manual ke folder public/images
            if (!file_exists(public_path('images'))) {
                mkdir(public_path('images'), 0777, true);
            }
            file_put_contents($imagePath, $image);
            
            $posterUrl = 'images/' . $imageName;

            // 3. Simpan Event Utama
            $event = Event::create([
                'created_by'      => Auth::id(),
                'title'           => $request->title,
                'category'        => $request->category,
                'event_date'      => $request->event_date,
                'gates_open'      => $request->gates_open,
                'duration'        => $request->duration,
                'location'        => $request->location,
                'google_maps_url' => $request->google_maps_url,
                'description'     => $request->description,
                'poster_url'      => $posterUrl,
            ]);

            // 4. Simpan Tiket
            $tickets = json_decode($request->tickets, true);
            if (is_array($tickets)) {
                foreach ($tickets as $ticket) {
                    EventTicket::create([
                        'event_id' => $event->id,
                        'name'     => $ticket['name'],
                        'type'     => $ticket['type'],
                        'price'    => $ticket['type'] === 'Gratis' ? 0 : ($ticket['price'] ?? 0),
                        'quota'    => $ticket['quota'],
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('panitia.dashboard')->with('success', 'Event berhasil dipublikasikan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    /**
     * Tampilan daftar event berlangsung (Ongoing).
     */
    public function index()
    {
        $events = Event::with('tickets')
            ->where('created_by', Auth::id())
            ->latest()
            ->get();
        return view('panitia.events.index', compact('events'));
    }

    /**
     * Tampilan halaman kelola event.
     */
    public function manage()
    {
        $events = Event::with('tickets')
            ->where('created_by', Auth::id())
            ->latest()
            ->get();
        return view('panitia.events.manage', compact('events'));
    }
/**
 * Tampilan form edit event.
 */
public function edit($id)
{
    $event = Event::with('tickets')
        ->where('id', $id)
        ->where('created_by', Auth::id())
        ->firstOrFail();

    return view('panitia.events.edit', compact('event'));
}

/**
 * Perbarui data event di database.
 */
public function update(Request $request, $id)
{
    $event = Event::where('id', $id)
        ->where('created_by', Auth::id())
        ->firstOrFail();

    $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string',
        'event_date' => 'required|date',
        'gates_open' => 'nullable|string|max:100',
        'duration' => 'nullable|string|max:100',
        'location' => 'required|string',
        'google_maps_url' => 'nullable|url',
        'description' => 'required|string',
        'poster_data' => 'nullable|string', 
        'tickets' => 'required|string',    
    ]);

    try {
        DB::beginTransaction();

        $data = [
            'title'           => $request->title,
            'category'        => $request->category,
            'event_date'      => $request->event_date,
            'gates_open'      => $request->gates_open,
            'duration'        => $request->duration,
            'location'        => $request->location,
            'google_maps_url' => $request->google_maps_url,
            'description'     => $request->description,
        ];

        // 2. Proses Poster jika ada yang baru
        if ($request->filled('poster_data') && str_starts_with($request->poster_data, 'data:image')) {
            $posterData = $request->poster_data;
            preg_match('/^data:image\/(\w+);base64,/', $posterData, $type);
            $image = substr($posterData, strpos($posterData, ',') + 1);
            $extension = strtolower($type[1]);
            $imageName = 'poster_' . time() . '_' . Str::random(5) . '.' . $extension;

            // Hapus poster lama jika bukan placeholder
            if ($event->poster_url && file_exists(public_path($event->poster_url))) {
                @unlink(public_path($event->poster_url));
            }

            file_put_contents(public_path('images/' . $imageName), base64_decode($image));
            $data['poster_url'] = 'images/' . $imageName;
        }

        $event->update($data);

        // 3. Update Tiket (Hapus lama, simpan baru)
        $event->tickets()->delete();
        $tickets = json_decode($request->tickets, true);
        if (is_array($tickets)) {
            foreach ($tickets as $ticket) {
                EventTicket::create([
                    'event_id' => $event->id,
                    'name'     => $ticket['name'],
                    'type'     => $ticket['type'],
                    'price'    => $ticket['type'] === 'Gratis' ? 0 : ($ticket['price'] ?? 0),
                    'quota'    => $ticket['quota'],
                ]);
            }
        }

        DB::commit();
        return redirect()->route('panitia.manage_event')->with('success', 'Event berhasil diperbarui!');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withInput()->with('error', 'Gagal memperbarui: ' . $e->getMessage());
    }
}

/**
 * Menutup event (Selesai).
...
     */
    public function close($id)
    {
        $event = Event::where('id', $id)
            ->where('created_by', Auth::id())
            ->firstOrFail();
            
        $event->update(['is_closed' => true]);

        return back()->with('success', 'Event telah berhasil ditutup.');
    }
}
