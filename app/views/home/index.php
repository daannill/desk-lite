<?php extend('layouts/main'); ?>

<?php section('content'); ?>
<div x-data="{ 
    activeTab: 'semua',
    searchQuery: '',
    showModal: false,
    newTicketTitle: '',
    newTicketCategory: 'Backend & Server',
    newTicketPriority: 'Sedang',
    newTicketDesc: '',
    toastMessage: '',
    showToast: false,
    quickNotes: [
        'Cek sertifikat SSL domain staging sebelum jam 17:00',
        'Review PR dari tim frontend terkait responsivitas tablet'
    ],
    newNote: '',
    addNote() {
        if (this.newNote.trim() !== '') {
            this.quickNotes.unshift(this.newNote.trim());
            this.newNote = '';
        }
    },
    removeNote(index) {
        this.quickNotes.splice(index, 1);
    },
    submitTicket() {
        if (!this.newTicketTitle) return;
        this.toastMessage = 'Tiket berhasil dibuat: ' + this.newTicketTitle;
        this.showToast = true;
        this.showModal = false;
        this.newTicketTitle = '';
        this.newTicketDesc = '';
        setTimeout(() => { this.showToast = false; }, 4000);
    }
}">

    <!-- Toast Notification -->
    <div x-show="showToast" 
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-4"
         class="fixed bottom-6 right-6 z-50 bg-indigo-600 text-white px-5 py-3.5 rounded-2xl shadow-2xl flex items-center gap-3 border border-indigo-400/30">
        <svg class="w-6 h-6 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span x-text="toastMessage" class="text-sm font-semibold"></span>
    </div>

    <!-- Hero Header Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-950/80 to-slate-900 border border-slate-800 p-6 sm:p-8 mb-8 shadow-2xl">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-300 text-xs font-semibold uppercase tracking-wider">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span>
                    DeskLite Workspace
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                    Selamat Datang Kembali, Alex! 👋
                </h1>
                <p class="text-sm text-slate-400 max-w-2xl leading-relaxed">
                    Pantau kinerja tim, kelola tiket helpdesk, dan pantau aktivitas sistem secara real-time dari satu dashboard terpadu.
                </p>
            </div>

            <!-- Action Button -->
            <div class="flex items-center gap-3">
                <button @click="showModal = true" class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white font-semibold text-sm shadow-lg shadow-indigo-600/30 hover:shadow-indigo-500/50 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>+ Buat Tiket Baru</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Metric Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <!-- Metric 1: Total Tiket -->
        <div class="bg-slate-800/60 backdrop-blur-sm border border-slate-700/60 rounded-2xl p-5 hover:border-indigo-500/40 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Tiket Aktif</span>
                <div class="w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
            </div>
            <div class="flex items-baseline justify-between">
                <span class="text-3xl font-extrabold text-white tracking-tight"><?= $this->stats['total_tickets'] ?></span>
                <span class="text-xs font-semibold text-emerald-400 flex items-center gap-0.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    +12% minggu ini
                </span>
            </div>
        </div>

        <!-- Metric 2: Menunggu -->
        <div class="bg-slate-800/60 backdrop-blur-sm border border-slate-700/60 rounded-2xl p-5 hover:border-amber-500/40 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Perlu Penanganan</span>
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="flex items-baseline justify-between">
                <span class="text-3xl font-extrabold text-white tracking-tight"><?= $this->stats['pending_tickets'] ?></span>
                <span class="text-xs font-medium text-amber-400 bg-amber-500/10 px-2 py-0.5 rounded-full border border-amber-500/20">High Priority</span>
            </div>
        </div>

        <!-- Metric 3: Respon Rata-rata -->
        <div class="bg-slate-800/60 backdrop-blur-sm border border-slate-700/60 rounded-2xl p-5 hover:border-cyan-500/40 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Waktu Respon Rata-rata</span>
                <div class="w-10 h-10 rounded-xl bg-cyan-500/10 text-cyan-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
            </div>
            <div class="flex items-baseline justify-between">
                <span class="text-3xl font-extrabold text-white tracking-tight"><?= $this->stats['avg_response'] ?></span>
                <span class="text-xs font-semibold text-emerald-400 flex items-center gap-0.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/></svg>
                    -3 mnt cepat
                </span>
            </div>
        </div>

        <!-- Metric 4: Kepuasan -->
        <div class="bg-slate-800/60 backdrop-blur-sm border border-slate-700/60 rounded-2xl p-5 hover:border-emerald-500/40 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Kepuasan Pengguna</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="flex items-baseline justify-between">
                <span class="text-3xl font-extrabold text-white tracking-tight"><?= $this->stats['satisfaction'] ?></span>
                <span class="text-xs font-medium text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-full border border-emerald-500/20">Sangat Baik</span>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Main Column (Tickets List) -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-slate-800/50 border border-slate-700/60 rounded-3xl p-6 shadow-xl">
                
                <!-- Table Controls Header -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <div>
                        <h2 class="text-lg font-bold text-white">Daftar Tiket Terbaru</h2>
                        <p class="text-xs text-slate-400">Kelola dan update tiket masalah sistem</p>
                    </div>

                    <!-- Filter Tabs -->
                    <div class="flex items-center bg-slate-900/80 p-1 rounded-xl border border-slate-700/50 text-xs">
                        <button @click="activeTab = 'semua'" :class="activeTab === 'semua' ? 'bg-indigo-600 text-white font-semibold shadow' : 'text-slate-400 hover:text-slate-200'" class="px-3 py-1.5 rounded-lg transition-all">Semua</button>
                        <button @click="activeTab = 'diproses'" :class="activeTab === 'diproses' ? 'bg-indigo-600 text-white font-semibold shadow' : 'text-slate-400 hover:text-slate-200'" class="px-3 py-1.5 rounded-lg transition-all">Diproses</button>
                        <button @click="activeTab = 'menunggu'" :class="activeTab === 'menunggu' ? 'bg-indigo-600 text-white font-semibold shadow' : 'text-slate-400 hover:text-slate-200'" class="px-3 py-1.5 rounded-lg transition-all">Menunggu</button>
                        <button @click="activeTab = 'selesai'" :class="activeTab === 'selesai' ? 'bg-indigo-600 text-white font-semibold shadow' : 'text-slate-400 hover:text-slate-200'" class="px-3 py-1.5 rounded-lg transition-all">Selesai</button>
                    </div>
                </div>

                <!-- Live Search Box inside Widget -->
                <div class="mb-5 relative">
                    <input type="text" x-model="searchQuery" placeholder="Cari judul tiket atau pemohon..." class="w-full bg-slate-900/90 border border-slate-700/80 rounded-xl pl-10 pr-4 py-2 text-xs text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>

                <!-- Tickets List -->
                <div class="space-y-3">
                    <?php foreach ($this->tickets as $ticket): ?>
                        <div x-show="(activeTab === 'semua' || activeTab === '<?= strtolower($ticket['status']) ?>') && ('<?= strtolower($ticket['title']) ?>'.includes(searchQuery.toLowerCase()) || '<?= strtolower($ticket['reporter']) ?>'.includes(searchQuery.toLowerCase()))"
                             x-transition
                             class="p-4 rounded-2xl bg-slate-900/60 border border-slate-800 hover:border-slate-700/90 transition-all flex flex-col sm:flex-row sm:items-center justify-between gap-4 group">
                            
                            <div class="flex items-start gap-3.5">
                                <div class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-xs font-bold text-indigo-400 border border-slate-700 shrink-0">
                                    <?= $ticket['avatar'] ?>
                                </div>
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span class="text-[11px] font-mono text-indigo-400 bg-indigo-500/10 px-2 py-0.5 rounded border border-indigo-500/20"><?= $ticket['id'] ?></span>
                                        <span class="text-xs text-slate-400 font-medium">&bull; <?= $ticket['category'] ?></span>
                                    </div>
                                    <h3 class="text-sm font-semibold text-slate-100 group-hover:text-indigo-300 transition-colors leading-snug">
                                        <?= $ticket['title'] ?>
                                    </h3>
                                    <div class="flex items-center gap-3 text-xs text-slate-400 pt-0.5">
                                        <span>Oleh: <strong class="text-slate-300 font-medium"><?= $ticket['reporter'] ?></strong></span>
                                        <span>&bull; <?= $ticket['updated_at'] ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between sm:justify-end gap-3 shrink-0 pt-2 sm:pt-0 border-t sm:border-t-0 border-slate-800/60">
                                <!-- Priority Badge -->
                                <?php 
                                    $prioBg = match($ticket['priority']) {
                                        'Tinggi' => 'text-rose-400 bg-rose-500/10 border-rose-500/20',
                                        'Sedang' => 'text-amber-400 bg-amber-500/10 border-amber-500/20',
                                        default => 'text-slate-400 bg-slate-500/10 border-slate-500/20'
                                    };
                                ?>
                                <span class="text-[11px] font-medium px-2.5 py-1 rounded-lg border <?= $prioBg ?>">
                                    <?= $ticket['priority'] ?>
                                </span>

                                <!-- Status Badge -->
                                <?php 
                                    $statusBg = match($ticket['status']) {
                                        'Selesai' => 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20',
                                        'Diproses' => 'text-indigo-400 bg-indigo-500/10 border-indigo-500/20',
                                        default => 'text-amber-400 bg-amber-500/10 border-amber-500/20'
                                    };
                                ?>
                                <span class="text-xs font-semibold px-3 py-1 rounded-xl border <?= $statusBg ?>">
                                    <?= $ticket['status'] ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-800 flex items-center justify-between text-xs text-slate-400">
                    <span>Menampilkan 5 tiket terbaru</span>
                    <a href="#all-tickets" class="text-indigo-400 hover:text-indigo-300 font-semibold flex items-center gap-1 transition-colors">
                        Lihat Semua Tiket &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Sidebar (Activity & Quick Notes) -->
        <div class="space-y-6">
            
            <!-- Quick Notes Widget (Alpine.js Interactive State) -->
            <div class="bg-slate-800/50 border border-slate-700/60 rounded-3xl p-6 shadow-xl">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-sm font-bold text-white flex items-center gap-2">
                        <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Catatan Cepat Tim
                    </h2>
                    <span class="text-[10px] text-slate-400 font-medium" x-text="quickNotes.length + ' catatan'"></span>
                </div>

                <!-- Input to add note -->
                <form @submit.prevent="addNote()" class="flex gap-2 mb-4">
                    <input type="text" x-model="newNote" placeholder="+ Tambah catatan..." class="flex-1 bg-slate-900 border border-slate-700 rounded-xl px-3 py-1.5 text-xs text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-3 py-1.5 rounded-xl text-xs font-semibold transition-colors">Simpan</button>
                </form>

                <!-- List of notes -->
                <div class="space-y-2">
                    <template x-for="(note, index) in quickNotes" :key="index">
                        <div class="p-2.5 rounded-xl bg-slate-900/80 border border-slate-800 flex items-center justify-between gap-2 group text-xs text-slate-300">
                            <span x-text="note" class="leading-relaxed"></span>
                            <button @click="removeNote(index)" class="text-slate-400 hover:text-rose-400 opacity-0 group-hover:opacity-100 transition-opacity p-1">
                                &times;
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Recent Activity Timeline -->
            <div class="bg-slate-800/50 border border-slate-700/60 rounded-3xl p-6 shadow-xl">
                <h2 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Aktivitas Terbaru
                </h2>

                <div class="relative border-l border-slate-700/80 ml-3 space-y-5">
                    <?php foreach ($this->activities as $act): ?>
                        <div class="pl-5 relative group">
                            <div class="absolute -left-2 top-0.5 w-4 h-4 rounded-full bg-slate-900 border-2 border-indigo-400 flex items-center justify-center">
                                <div class="w-1.5 h-1.5 rounded-full bg-indigo-400"></div>
                            </div>
                            <div class="text-xs font-medium text-slate-200 group-hover:text-indigo-300 transition-colors">
                                <?= $act['title'] ?>
                            </div>
                            <div class="text-[10px] text-slate-400 mt-0.5">
                                <?= $act['time'] ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Server Status Widget -->
            <div class="bg-slate-800/50 border border-slate-700/60 rounded-3xl p-5 text-xs space-y-3">
                <div class="flex items-center justify-between font-semibold text-slate-300">
                    <span>Kesehatan Server DeskLite</span>
                    <span class="text-emerald-400">Optimal</span>
                </div>
                <div class="space-y-2">
                    <div>
                        <div class="flex justify-between text-slate-400 mb-1 text-[11px]">
                            <span>Penggunaan CPU</span>
                            <span>18%</span>
                        </div>
                        <div class="w-full bg-slate-900 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-indigo-500 h-1.5 rounded-full" style="width: 18%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-slate-400 mb-1 text-[11px]">
                            <span>Memory (RAM)</span>
                            <span>42%</span>
                        </div>
                        <div class="w-full bg-slate-900 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-cyan-500 h-1.5 rounded-full" style="width: 42%"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Create Ticket Modal -->
    <div x-show="showModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm"
         style="display: none;">
        
        <div @click.away="showModal = false" 
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="bg-slate-900 border border-slate-800 rounded-3xl max-w-lg w-full p-6 shadow-2xl space-y-5">
            
            <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-indigo-500/10 text-indigo-400 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-white">Buat Tiket Baru</h3>
                </div>
                <button @click="showModal = false" class="text-slate-400 hover:text-white p-1 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form @submit.prevent="submitTicket()" class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">Judul Masalah / Tiket</label>
                    <input type="text" x-model="newTicketTitle" required placeholder="Contoh: Error 500 saat ekspor PDF laporan" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2 text-xs text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5">Kategori</label>
                        <select x-model="newTicketCategory" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="Backend & Server">Backend & Server</option>
                            <option value="Akses & Security">Akses & Security</option>
                            <option value="UI/UX Bug">UI/UX Bug</option>
                            <option value="API Integration">API Integration</option>
                            <option value="DevOps">DevOps</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5">Prioritas</label>
                        <select x-model="newTicketPriority" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="Rendah">Rendah</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Tinggi">Tinggi</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">Deskripsi Lengkap</label>
                    <textarea x-model="newTicketDesc" rows="3" placeholder="Jelaskan langkah reproduksi masalah..." class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2 text-xs text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-800">
                    <button type="button" @click="showModal = false" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-400 hover:text-white transition-colors">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl text-xs font-semibold bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg shadow-indigo-600/30 transition-all">Simpan Tiket</button>
                </div>
            </form>
        </div>
    </div>

</div>
<?php endSection(); ?>
