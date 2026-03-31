<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $usersCount = User::where('level', '!=', 'admin')->count();
        $bookingCount = Booking::count();
        $approvedBookingCount = Booking::whereIn('status', ['approved', 'waiting_confirmation', 'paid'])->count();
        $approvedOrderTotal = Booking::where('status', 'paid')->sum('total_harga');
        $pendingPaymentCount = Payment::where('status', 'pending')->count();
        $jadwalPentas = Booking::with('tari')
            ->whereIn('status', ['paid'])
            ->orderBy('tanggal_tampil')
            ->latest('id')
            ->get();
        // dd($jadwalPentas);
        return view('admin.dashboard', compact(
            'usersCount',
            'bookingCount',
            'approvedBookingCount',
            'approvedOrderTotal',
            'pendingPaymentCount',
            'jadwalPentas'
        ));
    }
}
