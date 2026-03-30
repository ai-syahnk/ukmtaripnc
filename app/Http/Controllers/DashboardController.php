<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $usersCount = User::where('level', '!=', 'admin')->count();
        $bookingCount = Booking::count();
        $approvedBookingCount = Booking::where('status', 'approved')->count();
        $approvedOrderTotal = Booking::where('status', 'approved')->sum('total_harga');
        $jadwalPentas = Booking::with('tari')
            ->where('status', 'approved')
            ->orderBy('tanggal_tampil')
            ->latest('id')
            ->get();
        // dd($jadwalPentas);
        return view('admin.dashboard', compact(
            'usersCount',
            'bookingCount',
            'approvedBookingCount',
            'approvedOrderTotal',
            'jadwalPentas'
        ));
    }
}
