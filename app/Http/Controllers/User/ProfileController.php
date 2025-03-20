<?php

namespace App\Http\Controllers\User;
use App\Models\Peminjam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $peminjam = Peminjam::where('user_id', Auth::id())->first();
        return view('user.layouts.pages.profile.data-user', compact('peminjam'));
    }

    public function create ()
    {
        return view('user.layouts.pages.profile.tambah');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'provinsi' => 'required|integer', // ID Provinsi
            'kabupaten' => 'required|integer', // ID Kabupaten
            'kecamatan' => 'required|integer', // ID Kecamatan
            'alamat' => 'required|string',
            'phone' => 'required|string',
            'nik' => 'required|string|max:16|unique:peminjams,nik',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

        // Upload foto profil jika ada
        $photoPath = $request->file('photo') ? $request->file('photo')->store('peminjams', 'public') : null;

        // Upload foto NIK (wajib)
        $fotoKtpPath = $request->file('foto_ktp')->store('peminjams/ktp', 'public');

        // Menyimpan peminjam
        Peminjam::create([
            'email' => Auth::user()->email, 
            'user_id' => Auth::id(),
            'nama_lengkap' => $request->nama_lengkap,
            'location' => $locationData,
            'alamat' => $request->alamat,
            'phone' => $request->phone,
            'photo' => $photoPath,
            'nik' => $request->nik,
            'foto_ktp' => $fotoKtpPath,
        ]);

        return redirect()->route('user.profile.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function edit ($id)
    {
        $peminjam = Peminjam::findOrFail($id);

        return view('user.layouts.pages.profile.edit', compact('peminjam'));
    }

    public function update(Request $request, $id)
    {
        // Temukan peminjam berdasarkan ID
        $peminjam = Peminjam::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:peminjams,nik,' . $id,
            'provinsi' => 'required|integer',
            'kabupaten' => 'required|integer',
            'kecamatan' => 'required|integer',
            'alamat' => 'required|string',
            'phone' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $locationData = [
            'provinsi_id' => $request->provinsi,
            'kabupaten_id' => $request->kabupaten,
            'kecamatan_id' => $request->kecamatan,
            'provinsi' => $request->input('provinsi_name'),
            'kabupaten' => $request->input('kabupaten_name'),
            'kecamatan' => $request->input('kecamatan_name'),
        ];

        // Cek dan hapus foto lama jika ada upload baru
        if ($request->hasFile('photo')) {
            if ($peminjam->photo) {
                Storage::disk('public')->delete($peminjam->photo);
            }
            $photoPath = $request->file('photo')->store('peminjams', 'public');
        } else {
            $photoPath = $peminjam->photo;
        }

        if ($request->hasFile('foto_ktp')) {
            if ($peminjam->foto_nik) {
                Storage::disk('public')->delete($peminjam->foto_ktp);
            }
            $fotoKtpPath = $request->file('foto_ktp')->store('peminjams/ktp', 'public');
        } else {
            $fotoKtpPath = $peminjam->foto_ktp;
        }

        $peminjam->update([
        'nama_lengkap' => $validated['nama_lengkap'],
        'nik' => $validated['nik'],
        'location' => $locationData,
        'alamat' => $validated['alamat'],
        'phone' => $validated['phone'],
        'photo' => $photoPath,
        'foto_ktp' => $fotoKtpPath,
    ]);

        return redirect()->route('user.profile.index')->with('success', 'Peminjam berhasil diperbarui!');
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

    public function destroy(Peminjam $peminjam)
    {
        $peminjam->delete();

        return redirect()->route('petugas.peminjam')->with('success', 'Peminjam deleted successfully');
    }
}
