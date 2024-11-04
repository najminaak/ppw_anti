<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Buku;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginRegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LoginRegisterController extends Controller
{
    // instantiate a new LoginRegisterController instance
    public function  __construct() {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

    // display registration form
    public function register() {
        return view('auth.register');
    }

    // store a new user
    public function store(Request $request) {

        // validasi data yang dikirim
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed',
            'photo' => 'image|nullable|max:1999'
        ]);

        //pertemuan 10 untuk upload foto
        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('photo')->storeAs('photos', $filenameSimpan);
        } else {

        }


        // membuat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo'=> $path,
        ]);

        // autentikasi pengguna
        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);

        // redirect pengguna ke halaman dashboard
        $request->session()->regenerate();
        return redirect()->route('dashboard')
            ->withSuccess('You have successfully registered & logged in!');
    }

    // display a login form
    public function login() {
        return view('auth.login');
    }

    // authenticate the user
    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')
                            ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');
    }

    // display a dashboard to auathenticated users
    public function dashboard()
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->level === 'admin') {
                // Ambil data buku untuk dashboard admin
                $data_buku = Buku::all();
                $jumlah_buku = $data_buku->count();
                $total_harga = $data_buku->sum('harga');

                return view('auth.dashboard', compact('data_buku', 'jumlah_buku', 'total_harga'));
            } else {
                // Jika user biasa, arahkan ke halaman home
                return view('home');
            }
        }

        return redirect()->route('login')
            ->withErrors(['email' => 'Please login to access the dashboard.'])
            ->onlyInput('email');
    }

    // logout the user from app
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')
                        ->withSuccess('You have logged out successfully!');
    }
}
