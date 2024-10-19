@extends('layouts.master')

@section('title', 'Edit Data Buku')

@section('content')
<div class="container">
    <h4 class="text-center">Edit Buku</h4>
    <form method="post" action="{{ route('buku.update', $buku->id) }}">
        @csrf 
        @method('PUT')

        <div class="form-group mb-3">
            <label for="judul">Judul</label>
            <input type="text" id="judul" name="judul" class="form-control" 
                value="{{ old('judul', $buku->judul) }}">
        </div>

        <div class="form-group mb-3">
            <label for="penulis">Penulis</label>
            <input type="text" id="penulis" name="penulis" class="form-control" 
                value="{{ old('penulis', $buku->penulis) }}">
        </div>

        <div class="form-group mb-3">
            <label for="harga">Harga</label>
            <input type="text" id="harga" name="harga" class="form-control" 
                value="{{ old('harga', $buku->harga) }}">
        </div>

        <div class="form-group mb-3">
            <label for="tgl_terbit">Tanggal Terbit</label>
            <input type="date" id="tgl_terbit" name="tgl_terbit" class="form-control"
                value="{{ old('tgl_terbit', $buku->tgl_terbit) }}">
        </div>

        <div class="text-right">
            <a href="{{ '/buku' }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection
