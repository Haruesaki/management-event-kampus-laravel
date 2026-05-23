@extends('panitia.layout')

@section('content')

<div class="p-8 bg-gradient-to-br from-[#0B0B0F] via-[#12121A] to-[#0B0B0F] min-h-screen text-white">

    <!-- HEADER -->
    <div class="mb-8">
        <p class="text-xs text-purple-400 tracking-widest mb-1">STUDIO PRODUKSI</p>
        <h1 class="text-3xl font-semibold">Buat Event Baru</h1>
        <p class="text-gray-400 text-sm mt-1">Ciptakan pengalaman luar biasa Anda berikutnya dengan presisi dan gaya.</p>
    </div>

    <!-- MAIN GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- LEFT LABEL -->
        <div class="space-y-12 text-sm text-gray-400">

            <div>
                <p class="text-white font-medium mb-1">Identitas Event</p>
                <p>Tetapkan atribut visual dan kunci. Pastikan koherensi di semua titik kontak.</p>
            </div>

            <div>
                <p class="text-white font-medium mb-1">Waktu & Tempat</p>
                <p>Tentukan jadwal dan lokasi untuk event Anda.</p>
            </div>

            <div>
                <p class="text-white font-medium mb-1">Akses & Harga</p>
                <p>Atur tingkatan tiket dan ketersediaan.</p>
            </div>

            <div>
                <p class="text-white font-medium mb-1">Narasi</p>
                <p>Ceritakan kisah di balik event Anda.</p>
            </div>

        </div>

        <!-- RIGHT CONTENT -->
        <div class="lg:col-span-2 space-y-10">

            <!-- EVENT IDENTITY -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- UPLOAD -->
                <div class="border border-dashed border-[#2a2a35] rounded-2xl h-56 flex items-center justify-center bg-[#15151D] hover:bg-[#1a1a25] transition">
                    <p class="text-gray-500 text-sm">Unggah Poster Event</p>
                </div>

                <!-- INPUT -->
                <div class="space-y-4">
                    <input type="text" placeholder="Nama Event"
                        class="w-full bg-[#15151D] p-3 rounded-lg outline-none border border-[#1c1c24] focus:ring-2 focus:ring-purple-500" />

                    <input type="text" placeholder="Kategori"
                        class="w-full bg-[#15151D] p-3 rounded-lg outline-none border border-[#1c1c24]" />
                </div>

            </div>

            <!-- TIME & PLACE -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <input type="datetime-local"
                    class="bg-[#15151D] p-3 rounded-lg border border-[#1c1c24]" />

                <input type="text" placeholder="Pintu Dibuka"
                    class="bg-[#15151D] p-3 rounded-lg border border-[#1c1c24]" />

                <input type="text" placeholder="Durasi"
                    class="bg-[#15151D] p-3 rounded-lg border border-[#1c1c24]" />

                <input type="text" placeholder="Cari Alamat Lokasi..."
                    class="md:col-span-3 bg-[#15151D] p-3 rounded-lg border border-[#1c1c24]" />

                <!-- MAP -->
                <div class="md:col-span-3 h-48 rounded-xl bg-gradient-to-r from-purple-500/20 to-pink-500/20 flex items-center justify-center">
                    <p class="text-gray-400 text-sm">Pratinjau Peta</p>
                </div>

            </div>

            <!-- TICKETS -->
            <div class="space-y-4">

                <div class="bg-[#15151D] p-4 rounded-xl border border-[#1c1c24] flex justify-between">
                    <div>
                        <p class="font-medium">Tingkat Standar</p>
                        <p class="text-xs text-gray-400">Jml: 200</p>
                    </div>
                    <p>$50</p>
                </div>

                <div class="bg-[#15151D] p-4 rounded-xl border border-[#1c1c24] flex justify-between">
                    <div>
                        <p class="font-medium">Tingkat Premium</p>
                        <p class="text-xs text-gray-400">Jml: 50</p>
                    </div>
                    <p>$150</p>
                </div>

                <button class="w-full border border-dashed border-purple-500 text-purple-400 py-2 rounded-xl hover:bg-purple-500/10 transition">
                    + Tambah Tingkat Tiket
                </button>

            </div>

            <!-- NARRATIVE -->
            <textarea rows="4" placeholder="Deskripsikan event Anda..."
                class="w-full bg-[#15151D] p-4 rounded-xl border border-[#1c1c24] outline-none"></textarea>

            <!-- ACTION -->
            <div class="flex justify-end gap-4">

                <button class="px-6 py-2 rounded-lg bg-[#1c1c24] hover:bg-[#2a2a35] transition">
                    Simpan sebagai Draf
                </button>

                <button class="px-6 py-2 rounded-lg bg-gradient-to-r from-purple-500 to-pink-500 hover:scale-105 transition">
                    Publikasikan Event
                </button>

            </div>

        </div>

    </div>

</div>

@endsection
