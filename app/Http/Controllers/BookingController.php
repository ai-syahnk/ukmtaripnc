<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tari;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function adminIndex(): View
    {
        $bookings = Booking::with(['user', 'tari'])
            ->latest()
            ->get();

        return view('admin.booking.main', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
        ]);

        if ($validated['status'] === 'approved') {
            $bentrok = Booking::where('tanggal_tampil', $booking->tanggal_tampil)
                ->whereIn('status', ['approved', 'waiting_confirmation', 'paid'])
                ->where('id', '!=', $booking->id)
                ->exists();

            if ($bentrok) {
                return redirect()
                    ->route('admin.booking.index')
                    ->with('toast_error', 'Gagal: Sudah ada booking approved pada tanggal '.$booking->tanggal_tampil->format('d/m/Y').'. Hanya 1 booking per hari.');
            }
        }

        $updateData = ['status' => $validated['status']];

        if ($validated['status'] === 'approved') {
            $deadlineHours = config('payment.payment_deadline_hours', 24);
            $updateData['approved_at'] = now();
            $updateData['payment_deadline'] = now()->addHours($deadlineHours);
        }

        $booking->update($updateData);

        return redirect()
            ->route('admin.booking.index')
            ->with('toast_success', 'Status booking berhasil diperbarui.');
    }

    public function informasiBooking(): View
    {
        $approvedBookings = Booking::with('tari')
            // ->whereIn('status', ['approved', 'waiting_confirmation', 'paid'])
            ->orderBy('tanggal_tampil')
            ->latest('id')
            ->paginate(10);

        return view('web.booking.info', compact('approvedBookings'));
    }

    public function history(Request $request): View
    {
        // Auto-expire overdue bookings for this user
        Booking::where('user_id', $request->user()->id)
            ->where('status', 'approved')
            ->whereNotNull('payment_deadline')
            ->where('payment_deadline', '<', now())
            ->update(['status' => 'expired']);

        $bookings = Booking::with('tari')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return view('web.booking.history', compact('bookings'));
    }

    public function create(Request $request): View
    {
        $selectedTari = Tari::find($request->query('tari_id'));

        if (! $selectedTari) {
            $selectedTari = Tari::latest()->first();
        }

        return view('web.booking.create', compact('selectedTari'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tari_id' => ['required', 'exists:tari,id'],
            'nama_pemesan' => ['required', 'string', 'max:255'],
            'alamat_pentas' => ['required', 'string'],
            'no_telp' => ['required', 'string', 'max:30'],
            'tanggal_tampil' => ['required', 'date', 'after_or_equal:today'],
            'waktu_tampil' => ['required', 'date_format:H:i'],
            'catatan' => ['nullable', 'string'],
            'jumlah_penari' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        $bentrok = Booking::where('tanggal_tampil', $validated['tanggal_tampil'])
            ->whereIn('status', ['pending', 'approved', 'waiting_confirmation', 'paid'])
            ->exists();

        if ($bentrok) {
            return back()
                ->withInput()
                ->withErrors(['tanggal_tampil' => 'Sudah ada booking pada tanggal tersebut. Hanya 1 booking per hari. Silakan pilih tanggal lain.']);
        }

        $tari = Tari::findOrFail($validated['tari_id']);
        $hargaPerPenari = (float) $tari->harga;
        $totalHarga = $hargaPerPenari * (int) $validated['jumlah_penari'];

        Booking::create([
            'user_id' => $request->user()->id,
            'tari_id' => $tari->id,
            'nama_pemesan' => $validated['nama_pemesan'],
            'alamat_pentas' => $validated['alamat_pentas'],
            'no_telp' => $validated['no_telp'],
            'tanggal_tampil' => $validated['tanggal_tampil'],
            'waktu_tampil' => $validated['waktu_tampil'],
            'catatan' => $validated['catatan'] ?? null,
            'jumlah_penari' => $validated['jumlah_penari'],
            'harga_per_penari' => $hargaPerPenari,
            'total_harga' => $totalHarga,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('booking.history')
            ->with('toast_success', 'Booking berhasil dibuat.');
    }
}
