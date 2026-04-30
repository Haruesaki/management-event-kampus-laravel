@extends('panitia.layout')

@section('content')

<h1 class="text-2xl font-bold mb-6">Create New Event</h1>

<form method="POST" enctype="multipart/form-data">
@csrf

<div class="grid grid-cols-2 gap-6">

    <!-- Upload Poster -->
    <div class="card col-span-2">
        <label>Upload Poster</label>
        <input type="file" name="poster" class="mt-2">
    </div>

    <!-- Event Name -->
    <div class="card">
        <label>Event Name</label>
        <input type="text" name="name" class="w-full mt-2 bg-black p-2">
    </div>

    <!-- Category -->
    <div class="card">
        <label>Category</label>
        <input type="text" name="category" class="w-full mt-2 bg-black p-2">
    </div>

    <!-- Date -->
    <div class="card">
        <label>Date</label>
        <input type="date" name="date" class="w-full mt-2 bg-black p-2">
    </div>

    <!-- Location -->
    <div class="card col-span-2">
        <label>Location</label>
        <input type="text" name="location" class="w-full mt-2 bg-black p-2">
    </div>

    <!-- Pricing -->
    <div class="card col-span-2">
        <label>Ticket Price</label>
        <input type="number" name="price" class="w-full mt-2 bg-black p-2">
    </div>

</div>

<button class="btn-primary px-6 py-2 mt-6 rounded-lg">
    Launch Event
</button>

</form>

@endsection
