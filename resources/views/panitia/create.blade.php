@extends('panitia.layouts')

@section('content')

<h1 class="text-2xl font-bold mb-6">Create Event Page</h1>

<a href="{{ route('panitia.attendees') }}"
   class="bg-gray-700 px-6 py-3 rounded-lg inline-block">
   Back to Attendees
</a>

@endsection