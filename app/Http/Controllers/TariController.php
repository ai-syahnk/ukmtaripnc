<?php

namespace App\Http\Controllers;

use App\Models\Tari;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TariController extends Controller
{
    public function index(): View
    {
        $taris = Tari::latest()->get();

        return view('admin.tari.main', compact('taris'));
    }

    public function create(): View
    {
        return view('admin.tari.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'harga' => ['required', 'numeric', 'min:0'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('tari', 'public');
        }

        Tari::create($validated);

        return redirect()->route('admin.tari.index')->with('toast_success', 'Data berhasil disimpan.');
    }

    public function edit(Tari $tari): View
    {
        return view('admin.tari.edit', compact('tari'));
    }

    public function update(Request $request, Tari $tari): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'harga' => ['required', 'numeric', 'min:0'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('gambar')) {
            if ($tari->gambar && Storage::disk('public')->exists($tari->gambar)) {
                Storage::disk('public')->delete($tari->gambar);
            }

            $validated['gambar'] = $request->file('gambar')->store('tari', 'public');
        }

        $tari->update($validated);

        return redirect()->route('admin.tari.index')->with('toast_success', 'Data berhasil diperbarui.');
    }

    public function destroy(Tari $tari): RedirectResponse
    {
        if ($tari->gambar && Storage::disk('public')->exists($tari->gambar)) {
            Storage::disk('public')->delete($tari->gambar);
        }

        $tari->delete();

        return redirect()->route('admin.tari.index')->with('toast_success', 'Data berhasil dihapus.');
    }

    public function bookingIndex(): View
    {
        $taris = Tari::latest()->get();

        return view('web.booking.main', compact('taris'));
    }

    public function bookingCreate(Request $request): View
    {
        $selectedTari = Tari::find($request->query('tari'));

        if (! $selectedTari) {
            $selectedTari = Tari::latest()->first();
        }

        return view('web.booking.create', compact('selectedTari'));
    }
}
