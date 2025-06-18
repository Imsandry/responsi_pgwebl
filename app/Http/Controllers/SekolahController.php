<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sekolah; // Import Model Sekolah

class SekolahController extends Controller
{
    // Menggunakan middleware 'auth' untuk melindungi semua method CRUD
    public function __construct()
    {
        $this->middleware('auth')->except(['index']); // Kecuali method index (untuk tabel publik)
    }

    /**
     * Menampilkan daftar sekolah dalam tabel (publik).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sekolahs = Sekolah::all(); // Menggunakan Model untuk mengambil data
        return view('sekolah.table', compact('sekolahs'));
    }

    /**
     * Menampilkan halaman manajemen data sekolah (CRUD).
     * Hanya bisa diakses oleh pengguna yang login.
     *
     * @return \Illuminate\View\View
     */
    public function manage()
    {
        $sekolahs = Sekolah::all();
        return view('sekolah.manage', compact('sekolahs'));
    }

    /**
     * Menampilkan form untuk menambahkan sekolah baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('sekolah.create');
    }

    /**
     * Menyimpan data sekolah baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenjang' => 'required|string|max:255',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'akreditasi' => 'nullable|string|max:10',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file gambar
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $imageName = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('images'), $imageName);
            $fotoPath = $imageName; // Simpan hanya nama file, asumsi di public/images/
        }

        Sekolah::create([
            'nama' => $request->nama,
            'jenjang' => $request->jenjang,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'akreditasi' => $request->akreditasi,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('sekolah.manage')->with('success', 'Data sekolah berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit data sekolah.
     *
     * @param  \App\Models\Sekolah  $sekolah
     * @return \Illuminate\View\View
     */
    public function edit(Sekolah $sekolah)
    {
        return view('sekolah.edit', compact('sekolah'));
    }

    /**
     * Memperbarui data sekolah di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sekolah  $sekolah
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Sekolah $sekolah)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenjang' => 'required|string|max:255',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'akreditasi' => 'nullable|string|max:10',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $fotoPath = $sekolah->foto; // Ambil foto lama
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($fotoPath && file_exists(public_path('images/' . $fotoPath))) {
                unlink(public_path('images/' . $fotoPath));
            }
            $imageName = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('images'), $imageName);
            $fotoPath = $imageName;
        }

        $sekolah->update([
            'nama' => $request->nama,
            'jenjang' => $request->jenjang,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'akreditasi' => $request->akreditasi,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('sekolah.manage')->with('success', 'Data sekolah berhasil diperbarui!');
    }

    /**
     * Menghapus data sekolah dari database.
     *
     * @param  \App\Models\Sekolah  $sekolah
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Sekolah $sekolah)
    {
        // Hapus foto terkait jika ada
        if ($sekolah->foto && file_exists(public_path('images/' . $sekolah->foto))) {
            unlink(public_path('images/' . $sekolah->foto));
        }
        $sekolah->delete();

        return redirect()->route('sekolah.manage')->with('success', 'Data sekolah berhasil dihapus!');
    }
}
