@extends('panitia.layout')

@section('content')

<h1 class="text-3xl font-bold mb-6">Dashboard Panitia</h1>

<!-- STATISTICS -->
<div class="grid grid-cols-3 gap-6 mb-8">

    <div class="card">
        <p class="text-sm text-gray-400">Total Sales</p>
        <h2 class="text-2xl font-bold mt-2">Rp {{ number_format($totalSales ?? 0) }}</h2>
    </div>

    <div class="card">
        <p class="text-sm text-gray-400">Confirmed</p>
        <h2 class="text-2xl font-bold mt-2">{{ $confirmed ?? 0 }}</h2>
    </div>

    <div class="card">
        <p class="text-sm text-gray-400">Pending</p>
        <h2 class="text-2xl font-bold mt-2">{{ $pending ?? 0 }}</h2>
    </div>

</div>

<!-- EVENT LIST -->
<div class="card mb-8">
    <h2 class="text-xl font-semibold mb-4">Event Kamu</h2>

    <table class="w-full text-left">
        <thead>
            <tr class="text-gray-400">
                <th>Nama Event</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events ?? [] as $event)
            <tr>
                <td>{{ $event->name }}</td>
                <td>{{ $event->date }}</td>
                <td>{{ $event->location }}</td>
                <td>Rp {{ number_format($event->price) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Belum ada event</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- ACTION BUTTON -->
<div class="flex gap-4">
    <a href="{{ route('panitia.event.create') }}"
       class="btn-primary px-6 py-3 rounded-lg">
        + Create Event
    </a>

    <a href="{{ route('panitia.attendee') }}"
       class="bg-gray-700 px-6 py-3 rounded-lg">
        Lihat Attendees
    </a>
</div>

@endsection
