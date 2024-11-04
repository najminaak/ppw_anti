<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // cek apakah pengguna sudah login
        if (!Auth::check()) {
            // jika belum, arahkan ke halaman login dengan pesan error
            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Please login to access the dashboard.',
                ])->onlyInput('email');
        }

        // ambil semua data pengguna dari tabel users
        $users = User::get();
        
        // tampilkan view 'users' dengan data 'users'
        return view('users')->with('users', $users);
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        //cek apa user ada foto
        if($user->photo) {
            File::deleter(public_path('storage/' . $user->photo));
        }

        //hapus data
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Data berhasil dihapus');
    }

    public function update(Request $request, $id)
    {
        // Validasi input gambar
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        // Temukan user berdasarkan id
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }

        // Update data nama dan email
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika ada file gambar baru yang diunggah
        if ($request->hasFile('photo')) {
            $newPhoto = $request->file('photo');
            
            // Tentukan lokasi penyimpanan file
            $newPhotoPath = 'uploads/photos/';

            // Hapus file lama jika ada
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            // Simpan file baru
            $path = $newPhoto->store($newPhotoPath, 'public');

            // Update kolom photo di database
            $user->photo = $path;
        }

    // Simpan perubahan user
    $user->save();

    return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diperbarui');
    }
}
