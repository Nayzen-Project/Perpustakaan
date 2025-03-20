<?php

namespace App\Http\Controllers\Petugas\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjam;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class PeminjamController extends Controller
{
    public function index()
    {
        $users = User::all();
        $peminjams = Peminjam::with('user')->paginate(10);
        return view('petugas.layouts.pages.peminjam.data-peminjam', compact('peminjams','users'))->with('title', 'Peminjam');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:peminjams,email',
            'user_id' => 'required|exists:users,id',
            'nama_lengkap' => 'required|string|max:255',
            'provinsi' => 'required|integer', // ID Provinsi
            'kabupaten' => 'required|integer', // ID Kabupaten
            'kecamatan' => 'required|integer', // ID Kecamatan
            'alamat' => 'required|string',
            'phone' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        // Handle if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Menyimpan data location dalam format JSON
        $locationData = [
            'provinsi_id' => $request->provinsi,
            'kabupaten_id' => $request->kabupaten,
            'kecamatan_id' => $request->kecamatan,
            'provinsi' => $request->input('provinsi_name'),
            'kabupaten' => $request->input('kabupaten_name'),
            'kecamatan' => $request->input('kecamatan_name'),
        ];

        // Menyimpan foto jika ada
        $path = null;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('peminjams', 'public');
        }

        // Menyimpan peminjam
        Peminjam::create([
            'email' => $request->email,
            'user_id' => $request->user_id,
            'nama_lengkap' => $request->nama_lengkap,
            'location' => $locationData,
            'alamat' => $request->alamat,
            'phone' => $request->phone,
            'photo' => $path,
        ]);

        // Redirect after storing successfully
        return redirect()->route('petugas.peminjam')->with('success', 'Peminjam berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        // Temukan peminjam berdasarkan ID
        $peminjam = Peminjam::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'provinsi' => 'required|integer',
            'kabupaten' => 'required|integer',
            'kecamatan' => 'required|integer',
            'alamat' => 'required|string',
            'phone' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $locationData = [
            'provinsi_id' => $request->provinsi,
            'kabupaten_id' => $request->kabupaten,
            'kecamatan_id' => $request->kecamatan,
            'provinsi' => $request->input('provinsi_name'),
            'kabupaten' => $request->input('kabupaten_name'),
            'kecamatan' => $request->input('kecamatan_name'),
        ];

        $peminjam->update([
        'nama_lengkap' => $validated['nama_lengkap'],
        'location' => $locationData,
        'alamat' => $validated['alamat'],
        'phone' => $validated['phone'],
        'photo' => $path ?? $peminjam->photo, // Tetap menggunakan foto lama jika tidak ada foto baru
    ]);

        return redirect()->route('petugas.peminjam')->with('success', 'Peminjam berhasil diperbarui!');
    }

    // Mendapatkan data Provinsi
    public function getProvinces()
    {
        $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
        return response()->json($response->json());
    }

    // Mendapatkan data Kabupaten berdasarkan Provinsi
    public function getKabupatenByProvinsi($provinsiId)
    {
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/{$provinsiId}.json");
        return response()->json($response->json());
    }

    // Mendapatkan data Kecamatan berdasarkan Kabupaten
    public function getKecamatanByKabupaten($kabupatenId)
    {
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/districts/{$kabupatenId}.json");
        return response()->json($response->json());
    }

    public function toggleStatus($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        $peminjam->status = $peminjam->status === 'active' ? 'nonactive' : 'active';
        $peminjam->save();

        return redirect()->route('petugas.peminjam')->with('success', 'Status peminjam diperbarui!');
    }

    public function destroy(Peminjam $peminjam)
    {
        $peminjam->delete();

        return redirect()->route('petugas.peminjam')->with('success', 'Peminjam deleted successfully');
    }
}
