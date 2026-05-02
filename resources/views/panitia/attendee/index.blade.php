@extends('panitia.layout')

@section('content')

<h1 class="text-2xl font-bold mb-6">Attendee Registry</h1>

<div class="card">
<table class="w-full text-left">
    <thead>
        <tr>
            <th>Name</th>
            <th>Event</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($attendees as $a)
        <tr>
            <td>{{ $a->name }}</td>
            <td>{{ $a->event }}</td>
            <td>{{ $a->status }}</td>
            <td>{{ $a->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection
