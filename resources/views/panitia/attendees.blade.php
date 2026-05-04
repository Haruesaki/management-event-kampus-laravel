@extends('panitia.layout')

@section('content')

<div class="bg-gradient-to-br from-[#0B0B0F] via-[#12121A] to-[#0B0B0F] p-8 rounded-2xl">

```

<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-2xl font-semibold">Attendee Registry</h1>
        <p class="text-xs text-purple-400 tracking-widest mt-1">NEON MASQUERADE 2024</p>
    </div>

    <div class="flex items-center gap-4">
        <input type="text" placeholder="Search attendees..."
            class="bg-[#15151D] px-4 py-2 rounded-lg text-sm w-64 outline-none border border-[#1c1c24] focus:ring-2 focus:ring-purple-500" />

        <div class="w-8 h-8 rounded-full bg-[#1c1c24] flex items-center justify-center">🔔</div>
        <div class="w-8 h-8 rounded-full bg-[#1c1c24] flex items-center justify-center">⚙️</div>
    </div>
</div>


<div class="grid grid-cols-4 gap-6 mb-8">
    <div class="bg-[#15151D] p-5 rounded-2xl shadow-lg hover:shadow-purple-500/20 transition">
        <p class="text-gray-400 text-sm">Total Sales</p>
        <p class="text-2xl font-bold mt-1">$12,450</p>
    </div>

    <div class="bg-[#15151D] p-5 rounded-2xl shadow-lg hover:shadow-purple-500/20 transition">
        <p class="text-gray-400 text-sm">Confirmed</p>
        <p class="text-2xl font-bold mt-1">342</p>
    </div>

    <div class="bg-[#15151D] p-5 rounded-2xl shadow-lg hover:shadow-purple-500/20 transition">
        <p class="text-gray-400 text-sm">Action Req.</p>
        <p class="text-2xl font-bold mt-1">18</p>
    </div>

    <div class="bg-[#15151D] p-5 rounded-2xl shadow-lg hover:shadow-purple-500/20 transition">
        <p class="text-gray-400 text-sm">Conversion</p>
        <p class="text-2xl font-bold mt-1">84%</p>
        <div class="w-full bg-[#1c1c24] h-2 rounded mt-2">
            <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-2 rounded" style="width:84%"></div>
        </div>
    </div>
</div>


<div class="grid grid-cols-3 gap-6">

    
    <div class="col-span-2 bg-[#15151D] rounded-2xl overflow-hidden">

        <div class="p-4 border-b border-[#1c1c24] flex gap-2">
            <button class="bg-purple-500/20 text-purple-400 px-3 py-1 rounded-lg text-xs">All</button>
            <button class="bg-[#1c1c24] px-3 py-1 rounded-lg text-xs">Pending</button>
            <button class="bg-[#1c1c24] px-3 py-1 rounded-lg text-xs">Waitlist</button>
        </div>

        <table class="w-full text-sm">
            <thead class="text-gray-400 text-xs">
                <tr class="border-b border-[#1c1c24]">
                    <th class="text-left p-4">Participant</th>
                    <th>Ticket</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>

                <tr class="border-b border-[#1c1c24] hover:bg-[#1a1a22] transition">
                    <td class="p-4 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-purple-600 flex items-center justify-center text-xs">AV</div>
                        <div>
                            <p>Aria Vance</p>
                            <p class="text-gray-400 text-xs">aria@email.com</p>
                        </div>
                    </td>
                    <td><span class="bg-purple-500/20 text-purple-400 px-2 py-1 rounded-md text-xs">Seminar</span></td>
                    <td><span class="text-green-400">● Confirmed</span></td>
                    <td>Oct 12</td>
                </tr>

                <tr class="border-b border-[#1c1c24] hover:bg-[#1a1a22] transition">
                    <td class="p-4 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-gray-600 flex items-center justify-center text-xs">KM</div>
                        <div>
                            <p>Kaelen Moore</p>
                            <p class="text-gray-400 text-xs">kaelen@email.com</p>
                        </div>
                    </td>
                    <td><span class="bg-gray-500/20 text-gray-300 px-2 py-1 rounded-md text-xs">CSS</span></td>
                    <td><span class="text-yellow-400">● Pending</span></td>
                    <td>Oct 14</td>
                </tr>

                <tr class="hover:bg-[#1a1a22] transition">
                    <td class="p-4 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-red-600 flex items-center justify-center text-xs">LR</div>
                        <div>
                            <p>Lydia Reyes</p>
                            <p class="text-gray-400 text-xs">lydia@email.com</p>
                        </div>
                    </td>
                    <td><span class="bg-red-500/20 text-red-400 px-2 py-1 rounded-md text-xs">GEMASTIK</span></td>
                    <td><span class="text-red-400">● Failed</span></td>
                    <td>Oct 14</td>
                </tr>

            </tbody>
        </table>

    </div>

    
    <div class="bg-[#15151D] rounded-2xl p-4">
        <p class="text-sm text-gray-400 mb-3">Venue Map</p>
        <img src="https://images.unsplash.com/photo-1557683316-973673baf926"
            class="rounded-xl w-full h-48 object-cover opacity-70 hover:opacity-100 transition">
    </div>

</div>
```

</div>

@endsection
