<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $events = Event::withCount('registrations')
            ->orderByDesc('event_date')
            ->get();

        return view('admin.attendance.index', compact('events'));
    }

    public function event(Event $event)
    {
        $registrations = Registration::with(['user', 'attendance'])
            ->where('event_id', $event->id)
            ->where('status', 'Registered')
            ->get();

        return view('admin.attendance.event', compact('event', 'registrations'));
    }

    public function scan(Request $request)
    {
        $request->validate([
            'qr_code' => ['required', 'string'],
        ]);

        $registration = Registration::where('id', $request->qr_code)
            ->where('status', 'Registered')
            ->with(['event', 'user'])
            ->first();

        if (!$registration) {
            return response()->json(['success' => false, 'message' => 'QR Code tidak valid atau registrasi dibatalkan.']);
        }

        $attendance = Attendance::firstOrCreate(
            ['registration_id' => $registration->id],
            ['status_kehadiran' => 'Hadir', 'waktu_kehadiran' => now()]
        );

        if ($attendance->wasRecentlyCreated) {
            return response()->json([
                'success' => true,
                'message' => "✅ {$registration->user->name} berhasil check-in!",
                'user'    => $registration->user->name,
                'event'   => $registration->event->title,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "⚠️ {$registration->user->name} sudah check-in sebelumnya pada " .
                         $attendance->waktu_kehadiran->format('H:i'),
        ]);
    }

    public function generateQr(Registration $registration)
    {
        // Generate QR code sebagai URL ke halaman verifikasi
        // Gunakan package simple-qrcode: composer require simplesoftwareio/simple-qrcode
        $qrData = $registration->id;

        return view('admin.attendance.qr', compact('registration', 'qrData'));
    }
}