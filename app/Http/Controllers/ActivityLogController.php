<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Tampilkan daftar log aktivitas untuk admin.
     */
    public function index()
    {
        $logs = ActivityLog::with(['user.role'])->latest()->get();
        return view('admin.user_review', compact('logs'));
    }
}
