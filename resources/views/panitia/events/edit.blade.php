@extends('panitia.layout')

@section('content')

<div x-data="{ 
    tickets: {{ $event->tickets->map(fn($t) => ['name' => $t->name, 'type' => $t->type, 'price' => (float)$t->price, 'quota' => $t->quota])->toJson() }}, 
    poster: '{{ asset($event->poster_url) }}',
    showModal: false, 
    showUploadModal: false,
    editIndex: -1,
    newTicket: { name: '', type: 'Gratis', price: 0, quota: '' },
    
    // Toast State
    showToast: false,
    toastMessage: '',
    toastTimeout: null,

    init() {
        this.showModal = false;
        this.showUploadModal = false;
    },

    handlePoster(file) {
        if (!file || !file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = (e) => {
            this.poster = e.target.result;
            this.showUploadModal = false;
        };
        reader.readAsDataURL(file);
    },

    addTicket() {
        if(!this.newTicket.name || !this.newTicket.quota) return;
        if(this.editIndex > -1) {
            this.tickets[this.editIndex] = {...this.newTicket};
        } else {
            this.tickets.push({...this.newTicket});
        }
        this.closeModal();
    },
    editTicket(index) {
        this.editIndex = index;
        this.newTicket = {...this.tickets[index]};
        this.showModal = true;
    },
    removeTicket(index) {
        this.tickets.splice(index, 1);
    },
    closeModal() {
        this.showModal = false;
        this.editIndex = -1;
        this.newTicket = { name: '', type: 'Gratis', price: 0, quota: '' };
    },
    validateAndSubmit(e) {
        if (!this.poster || this.tickets.length === 0) {
            e.preventDefault();
            this.showErrorToast('Mohon unggah poster dan buat minimal satu jenis tiket.');
            return;
        }
    },
    showErrorToast(msg) {
        this.toastMessage = msg;
        this.showToast = false; 
        clearTimeout(this.toastTimeout);
        setTimeout(() => {
            this.showToast = true;
            this.toastTimeout = setTimeout(() => {
                this.showToast = false;
            }, 5000);
        }, 50);
    }
}" class="p-8 bg-gradient-to-br from-[#0B0B0F] via-[#12121A] to-[#0B0B0F] min-h-screen text-white relative overflow-hidden">

    {{-- NATIVE ALPINE TOAST --}}
    <div x-show="showToast" 
         x-transition:enter="transition-transform ease-out duration-500"
         x-transition:enter-start="translate-x-[120%]"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition-transform ease-in duration-400"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-[120%]"
         class="error-toast show" style="display: none;">
        <div class="toast-content">
            <div class="toast-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="toast-text" x-text="toastMessage"></div>
        </div>
        <div class="toast-progress"></div>
    </div>

    <!-- HEADER -->
    <div class="mb-8">
        <p class="text-xs text-purple-400 tracking-widest mb-1">MANAJEMEN EVENT</p>
        <h1 class="text-3xl font-semibold">Edit Event: {{ $event->title }}</h1>
        <p class="text-gray-400 text-sm mt-1">Perbarui detail acara Anda untuk menarik lebih banyak peserta.</p>
    </div>

    <!-- MAIN CONTENT SECTIONS -->
    <form action="{{ route('panitia.event.update', $event->id) }}" method="POST" @submit="validateAndSubmit($event)" class="space-y-16">
        @csrf
        
        {{-- Data Hidden --}}
        <input type="hidden" name="poster_data" :value="poster.startsWith('data:image') ? poster : ''">
        <input type="hidden" name="tickets" :value="JSON.stringify(tickets)">

        <!-- SECTION 1: IDENTITAS EVENT -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            <div class="space-y-2">
                <p class="text-white font-semibold text-lg">Identitas Event</p>
                <p class="text-sm text-gray-400 leading-relaxed">Sesuaikan visual dan informasi utama acara Anda.</p>
            </div>

            <div class="lg:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- UPLOAD -->
                    <div @click="showUploadModal = true" class="border border-dashed border-[#2a2a35] rounded-2xl h-56 flex flex-col items-center justify-center bg-[#15151D] hover:bg-[#1a1a25] transition cursor-pointer group relative overflow-hidden">
                        <template x-if="!poster">
                            <div class="flex flex-col items-center">
                                <svg class="w-8 h-8 text-gray-500 mb-2 group-hover:text-purple-500 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-gray-500 text-sm group-hover:text-gray-300 transition">Unggah Poster Event</p>
                            </div>
                        </template>
                        <template x-if="poster">
                            <div class="w-full h-full relative">
                                <img :src="poster" class="w-full h-full object-cover" />
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                    <p class="text-white text-xs font-bold uppercase tracking-wider">Ubah Gambar</p>
                                </div>
                                <button type="button" @click.stop="poster = null" class="absolute top-2 right-2 w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center hover:bg-red-600 transition">
                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>
                        </template>
                    </div>

                    <!-- INPUT -->
                    <div class="space-y-5">
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">Nama Event</label>
                            <input type="text" name="title" value="{{ $event->title }}" required
                                class="w-full bg-[#15151D] p-3.5 rounded-xl outline-none border border-[#1c1c24] focus:border-purple-500/50 focus:ring-4 focus:ring-purple-500/10 transition" />
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">Kategori</label>
                            <select name="category" required class="w-full bg-[#15151D] p-3.5 rounded-xl outline-none border border-[#1c1c24] focus:border-purple-500/50 focus:ring-4 focus:ring-purple-500/10 transition text-gray-400">
                                <option value="Seminar" {{ $event->category == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                                <option value="Workshop" {{ $event->category == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                                <option value="Konser" {{ $event->category == 'Konser' ? 'selected' : '' }}>Konser</option>
                                <option value="Olahraga" {{ $event->category == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 2: WAKTU & TEMPAT -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            <div class="space-y-2">
                <p class="text-white font-semibold text-lg">Waktu & Tempat</p>
                <p class="text-sm text-gray-400 leading-relaxed">Perbarui jadwal dan lokasi acara Anda.</p>
            </div>

            <div class="lg:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">Tanggal Event</label>
                        <input type="date" name="event_date" value="{{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d') }}" required
                            class="w-full bg-[#15151D] p-3.5 rounded-xl border border-[#1c1c24] focus:border-purple-500/50 outline-none text-gray-400" />
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">Pintu Dibuka</label>
                        <input type="text" name="gates_open" value="{{ $event->gates_open }}" placeholder="18:30"
                            class="w-full bg-[#15151D] p-3.5 rounded-xl border border-[#1c1c24] focus:border-purple-500/50 outline-none" />
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">Estimasi Durasi</label>
                        <input type="text" name="duration" value="{{ $event->duration }}" placeholder="3 Jam"
                            class="w-full bg-[#15151D] p-3.5 rounded-xl border border-[#1c1c24] focus:border-purple-500/50 outline-none" />
                    </div>

                    <div class="md:col-span-3 space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">Lokasi Fisik / Venue</label>
                        <div class="relative">
                            <input type="text" name="location" value="{{ $event->location }}" required placeholder="Cari Alamat atau Nama Tempat..."
                                class="w-full bg-[#15151D] p-3.5 pl-11 rounded-xl border border-[#1c1c24] focus:border-purple-500/50 outline-none" />
                            <svg class="w-5 h-5 text-gray-500 absolute left-4 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>

                    <div class="md:col-span-3 space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">Link Google Maps (Opsional)</label>
                        <div class="relative">
                            <input type="url" name="google_maps_url" value="{{ $event->google_maps_url }}" placeholder="https://maps.app.goo.gl/..."
                                class="w-full bg-[#15151D] p-3.5 pl-11 rounded-xl border border-[#1c1c24] focus:border-purple-500/50 outline-none transition" />
                            <svg class="w-5 h-5 text-gray-500 absolute left-4 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 3: AKSES & HARGA -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            <div class="space-y-2">
                <p class="text-white font-semibold text-lg">Akses & Harga</p>
                <p class="text-sm text-gray-400 leading-relaxed">Kelola tingkatan tiket dan ketersediaan kuota.</p>
            </div>

            <div class="lg:col-span-2 space-y-4">
                <template x-for="(ticket, index) in tickets" :key="index">
                    <div class="bg-[#15151D] p-5 rounded-2xl border border-[#1c1c24] flex justify-between items-center group animate-fadeIn">
                        <div class="flex items-center gap-5">
                            <div class="w-12 h-12 rounded-xl bg-purple-500/10 flex items-center justify-center text-purple-400">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-white" x-text="ticket.name"></p>
                                <p class="text-[11px] text-gray-500 uppercase tracking-widest mt-0.5" x-text="ticket.type + ' • Slot: ' + ticket.quota"></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6">
                            <p class="font-bold text-white" x-text="ticket.type === 'Gratis' ? 'FREE' : 'Rp ' + parseInt(ticket.price).toLocaleString()"></p>
                            <div class="flex items-center gap-3">
                                <button type="button" @click.prevent="editTicket(index)" class="text-gray-600 hover:text-purple-400 transition">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                                <button type="button" @click.prevent="removeTicket(index)" class="text-gray-600 hover:text-red-400 transition">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </template>

                <button type="button" @click="showModal = true" class="w-full border-2 border-dashed border-[#1c1c24] text-gray-500 py-8 rounded-2xl hover:border-purple-500/40 hover:text-purple-400 hover:bg-purple-500/5 transition-all duration-300 font-medium flex flex-col items-center justify-center gap-3 group">
                    <div class="w-12 h-12 rounded-full bg-[#15151D] flex items-center justify-center group-hover:scale-110 transition duration-300">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <span class="text-base">Tambahkan jenis tiket</span>
                </button>
            </div>
        </div>

        <!-- SECTION 4: NARASI -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            <div class="space-y-2">
                <p class="text-white font-semibold text-lg">Narasi</p>
                <p class="text-sm text-gray-400 leading-relaxed">Ceritakan kembali visi dan detail acara Anda.</p>
            </div>

            <div class="lg:col-span-2">
                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">Deskripsi Lengkap</label>
                    <textarea name="description" required rows="6" placeholder="Tuliskan pengalaman apa yang akan didapatkan oleh peserta..."
                        class="w-full bg-[#15151D] p-5 rounded-2xl border border-[#1c1c24] focus:border-purple-500/50 outline-none leading-relaxed transition resize-none">{{ $event->description }}</textarea>
                </div>
            </div>
        </div>

        <!-- FINAL ACTIONS -->
        <div class="pt-8 border-t border-[#1c1c24] flex flex-col md:flex-row justify-end gap-4">
            <a href="{{ route('panitia.manage_event') }}" class="px-8 py-3.5 rounded-xl bg-[#1c1c24] text-gray-300 font-semibold hover:bg-[#2a2a35] hover:text-white transition order-2 md:order-1 text-center">
                Batalkan
            </a>
            <button type="submit" class="px-10 py-3.5 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold hover:shadow-[0_0_20px_rgba(168,85,247,0.4)] hover:scale-[1.02] transition active:scale-[0.98] order-1 md:order-2">
                Simpan Perubahan
            </button>
        </div>
    </form>

    {{-- MODAL POPUP TICKETS (Reuse dari create) --}}
    <div x-show="showModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" x-cloak>
        <div @click.away="closeModal()" class="bg-[#12121A] border border-[#1c1c24] w-full max-w-md rounded-3xl overflow-hidden shadow-2xl">
            <div class="p-6 border-b border-[#1c1c24] flex justify-between items-center">
                <h3 class="text-xl font-bold text-white" x-text="editIndex > -1 ? 'Perbarui Tiket' : 'Konfigurasi Tiket'"></h3>
                <button type="button" @click="closeModal()" class="text-gray-500 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <div class="p-6 space-y-5">
                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Nama Jenis Tiket</label>
                    <input type="text" x-model="newTicket.name" class="w-full bg-[#0B0B0F] p-3.5 rounded-xl border border-[#1c1c24] outline-none text-white" />
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Kategori</label>
                        <select x-model="newTicket.type" class="w-full bg-[#0B0B0F] p-3.5 rounded-xl border border-[#1c1c24] outline-none text-gray-400">
                            <option>Gratis</option>
                            <option>Berbayar</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Jumlah Slot</label>
                        <input type="number" x-model="newTicket.quota" class="w-full bg-[#0B0B0F] p-3.5 rounded-xl border border-[#1c1c24] outline-none text-white" />
                    </div>
                </div>
                <div x-show="newTicket.type === 'Berbayar'" class="space-y-1.5">
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Harga Tiket (Rp)</label>
                    <input type="number" x-model="newTicket.price" class="w-full bg-[#0B0B0F] p-3.5 rounded-xl border border-[#1c1c24] outline-none text-white" />
                </div>
                <button type="button" @click="addTicket()" class="w-full py-4 bg-gradient-to-r from-purple-600 to-pink-600 rounded-xl font-bold text-white">Simpan Tiket</button>
            </div>
        </div>
    </div>

    {{-- MODAL UPLOAD POSTER (Reuse dari create) --}}
    <div x-show="showUploadModal" class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-black/90 backdrop-blur-md" x-cloak>
        <div @click.away="showUploadModal = false" class="bg-[#12121A] border border-[#1c1c24] w-full max-w-lg rounded-[32px] overflow-hidden shadow-2xl">
            <div class="p-8 text-center space-y-6">
                <h3 class="text-2xl font-bold text-white">Visual Event</h3>
                <div @click="$refs.fileInput.click()" class="border-2 border-dashed border-[#1c1c24] rounded-3xl p-12 cursor-pointer">
                    <input type="file" x-ref="fileInput" class="hidden" accept="image/*" @change="handlePoster($event.target.files[0])">
                    <p class="text-white font-semibold text-lg">Klik untuk ubah poster</p>
                </div>
                <button type="button" @click="showUploadModal = false" class="text-gray-500 underline">Tutup</button>
            </div>
        </div>
    </div>

</div>

@endsection

@push('styles')
<style>
    [x-cloak] { display: none !important; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fadeIn { animation: fadeIn 0.4s ease-out forwards; }
    .error-toast { position: fixed; bottom: 30px; right: 30px; z-index: 10000; width: calc(100% - 40px); max-width: 400px; background: linear-gradient(135deg, rgba(20, 15, 30, 0.95), rgba(30, 15, 30, 0.95)); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 14px; box-shadow: 0 15px 40px rgba(0,0,0,0.5); backdrop-filter: blur(12px); overflow: hidden; display: flex; flex-direction: column; }
    .toast-content { padding: 16px 20px; display: flex; align-items: center; gap: 16px; }
    .toast-icon { width: 36px; height: 36px; border-radius: 50%; background: rgba(239, 68, 68, 0.15); display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: #ef4444; }
    .toast-text { color: #ffffff; font-size: 13.5px; font-weight: 500; }
    .toast-progress { height: 4px; background: linear-gradient(90deg, #ef4444, #f87171); width: 100%; animation: toastTimer 5s linear forwards; }
    @keyframes toastTimer { from { width: 100%; } to { width: 0%; } }
</style>
@endpush
