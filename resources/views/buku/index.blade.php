<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 50px;
        }
        table {
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;  
        }

        thead th {
            background-color: #007bff; 
            color: white;
        }
        
        table, th, td {
            border: 1px solid #dee2e6; 
        }

        .d-flex {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <h2 class="text-center">Data Buku</h2>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>id</th>
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

    <!-- menampilkan jumlah buku -->
    <p>Jumlah Buku: {{ $jumlah_buku }}</p>
    
    <!-- menampilkan total harga buku -->
    <p>Total Harga Buku: Rp {{ number_format($total_harga, 2, ',', '.') }}</p>
    
    <!-- membuat tombol tambah buku -->
    <a href="{{ route('buku.create') }}" class="btn btn-primary"> Tambah Buku</a>
</body>
</html>
