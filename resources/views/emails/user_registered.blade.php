<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Berhasil</title>
</head>
<body>
    <h1>Halo, {{ $user['name'] }}!</h1>
    <p>Anda telah berhasil mendaftar pada aplikasi kami.</p>
    <p><strong>Nama:</strong> {{ $user['name'] }}</p>
    <p><strong>Email:</strong> {{ $user['email'] }}</p>
    <p><strong>Tanggal Pendaftaran:</strong> {{ now()->format('d-m-Y H:i') }}</p>
    <p>Terima kasih telah bergabung.</p>
</body>
</html>
