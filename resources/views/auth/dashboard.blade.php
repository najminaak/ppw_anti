@extends('auth.layouts')
@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-12"> 
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @else
                    <div class="alert alert-success">
                        You are logged in!
                    </div>
                @endif
                <h2 class="text-center">Data Buku</h2>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Harga</th>
                            <th>Tanggal Terbit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_buku as $index => $buku)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $buku->id }}</td>
                                <td>{{ $buku->judul }}</td>
                                <td>{{ $buku->penulis }}</td>
                                <td>{{ "Rp ".number_format($buku->harga, 2, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <form action="{{ route('buku.edit', $buku->id) }}" class="mr-2">
                                            @csrf 
                                            <button type="submit" class="btn btn-warning">Edit</button>
                                        </form>
                                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                                            @csrf 
                                            @method('DELETE')
                                            <button onclick="return confirm('Yakin mau dihapus??')" 
                                            type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Menampilkan jumlah buku -->
                <p>Jumlah Buku: {{ $jumlah_buku }}</p>
                <!-- Menampilkan total harga buku -->
                <p>Total Harga Buku: Rp {{ number_format($total_harga, 2, ',', '.') }}</p>
                <!-- Membuat tombol tambah buku -->
                <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Buku</a>
            </div>
        </div>
    </div>
</div>
@endsection
