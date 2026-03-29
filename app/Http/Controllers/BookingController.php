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
            $bentrok = Booking::where('tari_id', $booking->tari_id)
                ->where('tanggal_tampil', $booking->tanggal_tampil)
                ->where('status', 'approved')
                ->where('id', '!=', $booking->id)
                ->exists();

            if ($bentrok) {
                return redirect()
                    ->route('admin.booking.index')
                    ->with('toast_error', 'Gagal: Tari ini sudah ada booking approved pada tanggal ' . $booking->tanggal_tampil->format('d/m/Y') . '.');
            }
        }

        $booking->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.booking.index')
            ->with('toast_success', 'Status booking berhasil diperbarui.');
    }

    public function informasiBooking(): View
    {
        $approvedBookings = Booking::with('tari')
            ->where('status', 'approved')
            ->orderBy('tanggal_tampil')
            ->latest('id')
            ->paginate(10);

        return view('web.booking.info', compact('approvedBookings'));
    }

    public function history(Request $request): View
    {
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
            'catatan' => ['nullable', 'string'],
            'jumlah_penari' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        $bentrok = Booking::where('tari_id', $validated['tari_id'])
            ->where('tanggal_tampil', $validated['tanggal_tampil'])
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($bentrok) {
            return back()
                ->withInput()
                ->withErrors(['tanggal_tampil' => 'Tari ini sudah dipesan pada tanggal tersebut. Silakan pilih tanggal lain.']);
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
