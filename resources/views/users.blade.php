@extends('auth.layouts')

@section('content')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: Arial, sans-serif;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        td img {
            border-radius: 8px;
        }
        button {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-edit {
            background-color: #4CAF50;
            color: white;
            margin-right: 5px;
        }
        .btn-danger {
            background-color: #f44336;
            color: white;
        }
        #editFormContainer {
            display: none;
            margin-top: 20px;
            padding: 20px;
            max-width: 400px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        #editForm label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        #editForm input[type="text"],
        #editForm input[type="email"],
        #editForm input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        #editForm button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>

    <!-- flash message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if ($user->photo)
                    <img src="{{ asset('storage/' . $user->photo) }}" width="100px">
                @else
                    <img src="{{ asset('noimage.jpg') }}" width="100px">
                @endif
            </td>
            <td>
                <button class="btn-edit" onclick="showEditForm('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}', '{{ asset('storage/' . $user->photo) }}')">Edit</button>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <!-- form untuk edit yang akan muncul ketika tombol edit ditekan -->
    <div id="editFormContainer">
        <form id="editForm" action="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="name">Name:</label>
            <input type="text" id="editName" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="editEmail" name="email" required>

            <label for="photo">Profile Image:</label>
            <input type="file" id="editPhoto" name="photo">
            
            <button type="submit">Update</button>
        </form>
    </div>

    <script>
    function showEditForm(userId, name, email, photoUrl) {
        // Isi data dalam form dengan data user
        document.getElementById('editForm').action = '/users/' + userId;
        document.getElementById('editName').value = name;
        document.getElementById('editEmail').value = email;

        // Tampilkan formulir edit
        document.getElementById('editFormContainer').style.display = 'block';
    }
    </script>

@endsection
