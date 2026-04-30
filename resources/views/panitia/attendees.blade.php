<!-- resources/views/panitia/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Central</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .glow-card{box-shadow: 0 0 0 1px rgba(255,255,255,0.04), 0 10px 30px rgba(124,58,237,0.15);} 
        .glow-hover:hover{box-shadow: 0 0 0 1px rgba(255,255,255,0.06), 0 15px 40px rgba(168,85,247,0.25);} 
        .soft-border{border:1px solid #1c1c24}
        .neon-text{color:#c084fc}
    </style>
</head>
<body class="bg-[#0B0B0F] text-white font-[Inter]">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#0F0F14] p-6 flex flex-col justify-between soft-border border-l-0">
        <div>
            <h1 class="text-lg font-semibold mb-10 tracking-wide">Event Central</h1>

            <ul class="space-y-5 text-sm">
                <li class="text-gray-400 hover:text-white transition">Dashboard</li>
                <li class="text-gray-400 hover:text-white transition">Ongoing Event</li>
                <li class="text-purple-400">Attendees</li>
            </ul>
        </div>

        <div class="space-y-4">
            <button class="w-full bg-gradient-to-r from-purple-500 to-pink-500 py-2 rounded-xl font-medium hover:scale-105 transition">
                + Create Event
            </button>
            <p class="text-xs text-gray-500">Logout</p>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-8 bg-gradient-to-br from-[#0B0B0F] via-[#12121A] to-[#0B0B0F]">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-semibold">Attendee Registry</h1>
                <p class="text-xs text-purple-400 tracking-widest mt-1">NEON MASQUERADE 2024</p>
            </div>

            <div class="flex items-center gap-4">
                <input type="text" placeholder="Search attendees..."
                    class="bg-[#15151D] px-4 py-2 rounded-lg text-sm w-64 outline-none soft-border focus:ring-2 focus:ring-purple-500 transition" />

                <div class="w-8 h-8 rounded-full bg-[#1c1c24] flex items-center justify-center hover:bg-purple-500/20 transition">🔔</div>
                <div class="w-8 h-8 rounded-full bg-[#1c1c24] flex items-center justify-center hover:bg-purple-500/20 transition">⚙️</div>
            </div>
        </div>

        <!-- STATS -->
        <div class="grid grid-cols-4 gap-6 mb-8">
            <div class="bg-[#15151D] p-5 rounded-2xl glow-card glow-hover">
                <p class="text-gray-400 text-sm">Total Sales</p>
                <p class="text-2xl font-bold mt-1">$12,450</p>
            </div>
            <div class="bg-[#15151D] p-5 rounded-2xl glow-card glow-hover">
                <p class="text-gray-400 text-sm">Confirmed</p>
                <p class="text-2xl font-bold mt-1">342</p>
            </div>
            <div class="bg-[#15151D] p-5 rounded-2xl glow-card glow-hover">
                <p class="text-gray-400 text-sm">Action Req.</p>
                <p class="text-2xl font-bold mt-1">18</p>
            </div>
            <div class="bg-[#15151D] p-5 rounded-2xl glow-card glow-hover">
                <p class="text-gray-400 text-sm">Conversion</p>
                <p class="text-2xl font-bold mt-1">84.2%</p>
                <div class="w-full bg-[#1c1c24] h-2 rounded mt-2 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-2" style="width:84%"></div>
                </div>
            </div>
        </div>

        <!-- TABLE + MAP -->
        <div class="grid grid-cols-3 gap-6">

            <!-- TABLE -->
            <div class="col-span-2 bg-[#15151D] rounded-2xl glow-card overflow-hidden">

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

            <!-- MAP CARD -->
            <div class="bg-[#15151D] rounded-2xl glow-card p-4">
                <p class="text-sm text-gray-400 mb-3">Venue Map</p>
                <div class="rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1557683316-973673baf926" class="w-full h-48 object-cover opacity-70 hover:opacity-100 transition">
                </div>
            </div>

        </div>

    </main>
</div>

</body>
</html>
