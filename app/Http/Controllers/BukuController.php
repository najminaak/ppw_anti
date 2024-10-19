<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;


class BukuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        // $data_buku = Buku::all()->sortByDesc('id');

        $data_buku = Buku::orderBy('id', 'desc')->get();

        $jumlah_buku = Buku::count();
        $total_harga = $data_buku->sum('harga');

        return view('auth.dashboard', compact('data_buku', 'jumlah_buku', 'total_harga'));

    }

    public function create(){
        return view('buku.create');
    }

    public function store(Request $request){
        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();
        return redirect('/buku');
    }

    public function destroy($id) {
        $buku = buku::find($id);
        $buku->delete();

        return redirect('/buku');
    }

    public function edit($id) {
        $buku = Buku::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id) {
        $buku = Buku::find($id);
        
        $buku->judul = $request->input('judul');
        $buku->penulis = $request->input('penulis');
        $buku->harga = $request->input('harga');
        $buku->tgl_terbit = $request->input('tgl_terbit');
        $buku->save();
        return redirect('/buku');
    }    
}
