@extends('layouts.master')

@section('title', 'Tambah Buku')

@section('content')
    <div class="container">
        <h4 class="text-center">Tambah Buku</h4>
        <form method="post" action="{{route('buku.store')}}">
            @csrf 
            <div class="form-group mb-3">
                <label for="judul">Judul</label>
                <input type="text" id="judul" name="judul" class="form-control" 
                placeholder="Masukkan judul buku">
            </div>
            <div class="form-group mb-3">
                <label for="penulis">Penulis</label>
                <input type="text" id="penulis" name="penulis" class="form-control" 
                placeholder="Masukkan penulis buku">
            </div>
            <div class="form-group mb-3">
                <label for="harga">Harga</label>
                <input type="text" id="harga" name="harga" class="form-control" 
                placeholder="Masukkan harga buku">
            </div>
            <div class="form-group mb-3">
                <label for="tgl_terbit">Tanggal Terbit</label>
                <input type="date" id="tgl_terbit" name="tgl_terbit" class="form-control">
            </div>
            <div class="text-right">
                <a href="{{ '/buku' }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div> 
@endsection
