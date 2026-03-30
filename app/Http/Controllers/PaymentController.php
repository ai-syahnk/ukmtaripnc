<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PaymentController extends Controller
{
    /**
     * Show payment page for a booking (user).
     */
    public function show(Request $request, Booking $booking): View|RedirectResponse
    {
        // Only owner can access
        if ($booking->user_id !== $request->user()->id) {
            abort(403);
        }

        // Check expired first — auto-update status
        if ($booking->status === 'approved' && $booking->isPaymentExpired()) {
            $booking->update(['status' => 'expired']);
        }

        if (! in_array($booking->status, ['approved', 'payment_rejected'])) {
            return redirect()->route('booking.history')
                ->with('toast_error', 'Booking ini tidak dalam status menunggu pembayaran.');
        }

        $booking->load('tari', 'latestPayment');

        return view('web.booking.payment', [
            'booking' => $booking,
            'bankConfig' => config('payment'),
        ]);
    }

    /**
     * Store payment proof upload (user).
     */
    public function store(Request $request, Booking $booking): RedirectResponse
    {
        if ($booking->user_id !== $request->user()->id) {
            abort(403);
        }

        if ($booking->status === 'approved' && $booking->isPaymentExpired()) {
            $booking->update(['status' => 'expired']);

            return redirect()->route('booking.history')
                ->with('toast_error', 'Batas waktu pembayaran telah habis. Booking kadaluarsa.');
        }

        if (! in_array($booking->status, ['approved', 'payment_rejected'])) {
            return redirect()->route('booking.history')
                ->with('toast_error', 'Booking ini tidak dapat menerima pembayaran.');
        }

        $validated = $request->validate([
            'bukti_pembayaran' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'nama_pengirim' => ['required', 'string', 'max:255'],
            'bank_pengirim' => ['required', 'string', 'max:100'],
            'jumlah_transfer' => ['required', 'numeric', 'min:1'],
        ]);

        $path = $request->file('bukti_pembayaran')
            ->store('bukti_pembayaran', 'public');

        Payment::create([
            'booking_id' => $booking->id,
            'bukti_pembayaran' => $path,
            'nama_pengirim' => $validated['nama_pengirim'],
            'bank_pengirim' => $validated['bank_pengirim'],
            'jumlah_transfer' => $validated['jumlah_transfer'],
            'status' => 'pending',
        ]);

        $booking->update(['status' => 'waiting_confirmation']);

        return redirect()->route('booking.history')
            ->with('toast_success', 'Bukti pembayaran berhasil diupload. Menunggu konfirmasi admin.');
    }

    /**
     * Admin: list payments pending verification.
     */
    public function adminIndex(): View
    {
        $payments = Payment::with(['booking.user', 'booking.tari'])
            ->latest()
            ->get();

        return view('admin.payment.main', compact('payments'));
    }

    /**
     * Admin: verify (confirm/reject) a payment.
     */
    public function verify(Request $request, Payment $payment): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:confirmed,rejected'],
            'catatan_admin' => ['nullable', 'string', 'max:500'],
        ]);

        $booking = $payment->booking;

        if ($validated['status'] === 'confirmed') {
            $payment->update([
                'status' => 'confirmed',
                'confirmed_at' => now(),
                'catatan_admin' => $validated['catatan_admin'] ?? null,
            ]);
            $booking->update(['status' => 'paid']);
        } else {
            $payment->update([
                'status' => 'rejected',
                'catatan_admin' => $validated['catatan_admin'] ?? null,
            ]);
            $booking->update(['status' => 'payment_rejected']);
        }

        $statusLabel = $validated['status'] === 'confirmed' ? 'dikonfirmasi' : 'ditolak';

        return redirect()->route('admin.payment.index')
            ->with('toast_success', "Pembayaran berhasil {$statusLabel}.");
    }

    /**
     * Show invoice for a paid booking.
     */
    public function invoice(Request $request, Booking $booking): View
    {
        $user = $request->user();

        // Admin or booking owner can access
        if ($user->level !== 'admin' && $booking->user_id !== $user->id) {
            abort(403);
        }

        if ($booking->status !== 'paid') {
            abort(404);
        }

        $booking->load('tari', 'user', 'payments');

        $confirmedPayment = $booking->payments
            ->where('status', 'confirmed')
            ->first();

        return view('web.booking.invoice', [
            'booking' => $booking,
            'payment' => $confirmedPayment,
        ]);
    }
}
