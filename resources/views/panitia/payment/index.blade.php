@extends('panitia.layout')

@section('content')

<h1 class="text-2xl font-bold mb-6">Payment Confirmation</h1>

<div class="card">
<table class="w-full">
    <thead>
        <tr>
            <th>User</th>
            <th>Proof</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($payments as $p)
        <tr>
            <td>{{ $p->user->name }}</td>
            <td>
                <img src="{{ asset('storage/'.$p->proof) }}" width="80">
            </td>
            <td>
                <form method="POST" action="/confirm/{{$p->id}}">
                    @csrf
                    <button class="btn-primary px-3 py-1 rounded">
                        Confirm
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection
