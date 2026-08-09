<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;

class HomeController extends Controller {

    public function index(): void {
        $stats = [
            'total_tickets' => 128,
            'pending_tickets' => 14,
            'resolved_today' => 32,
            'avg_response' => '18 mnt',
            'satisfaction' => '98.5%'
        ];

        $tickets = [
            [
                'id' => 'TICK-1092',
                'title' => 'Koneksi Database Timeout pada Server Staging',
                'category' => 'Backend & Server',
                'priority' => 'Tinggi',
                'status' => 'Diproses',
                'reporter' => 'Budi Santoso',
                'avatar' => 'BS',
                'updated_at' => '10 menit lalu',
            ],
            [
                'id' => 'TICK-1091',
                'title' => 'Permintaan Akses Dashboard Analytics untuk Tim Marketing',
                'category' => 'Akses & Security',
                'priority' => 'Sedang',
                'status' => 'Menunggu',
                'reporter' => 'Siti Nurhaliza',
                'avatar' => 'SN',
                'updated_at' => '25 menit lalu',
            ],
            [
                'id' => 'TICK-1090',
                'title' => 'Tampilan Layout Pecah pada Layar Mobile (iOS Safari)',
                'category' => 'UI/UX Bug',
                'priority' => 'Rendah',
                'status' => 'Selesai',
                'reporter' => 'Rian Ardianto',
                'avatar' => 'RA',
                'updated_at' => '1 jam lalu',
            ],
            [
                'id' => 'TICK-1089',
                'title' => 'Integrasi Gateway Pembayaran Midtrans Gagal Handshake',
                'category' => 'API Integration',
                'priority' => 'Tinggi',
                'status' => 'Diproses',
                'reporter' => 'Dewi Lestari',
                'avatar' => 'DL',
                'updated_at' => '2 jam lalu',
            ],
            [
                'id' => 'TICK-1088',
                'title' => 'Update Sertifikat SSL Domain Utama DeskLite',
                'category' => 'DevOps',
                'priority' => 'Sedang',
                'status' => 'Selesai',
                'reporter' => 'Andi Wijaya',
                'avatar' => 'AW',
                'updated_at' => '3 jam lalu',
            ],
        ];

        $activities = [
            [
                'title' => 'Budi Santoso memperbarui tiket #TICK-1092',
                'time' => '10 mnt lalu',
                'icon' => 'chat',
                'color' => 'indigo'
            ],
            [
                'title' => 'Tiket #TICK-1090 telah ditandai Selesai',
                'time' => '1 jam lalu',
                'icon' => 'check',
                'color' => 'emerald'
            ],
            [
                'title' => 'Sertifikat SSL diperbarui oleh System Bot',
                'time' => '3 jam lalu',
                'icon' => 'shield',
                'color' => 'amber'
            ],
            [
                'title' => 'Backup Database Otomatis Berhasil',
                'time' => '5 jam lalu',
                'icon' => 'server',
                'color' => 'blue'
            ],
        ];

        $this->view('home/index', [
            'title' => 'DeskLite — Modern Helpdesk & Task Management',
            'stats' => $stats,
            'tickets' => $tickets,
            'activities' => $activities
        ]);
    }
}
