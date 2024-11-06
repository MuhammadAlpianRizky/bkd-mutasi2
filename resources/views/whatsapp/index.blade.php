<!-- resources/views/whatsapp/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp</title>
    <meta http-equiv="refresh" content="15"> <!-- Halaman di-refresh setiap 60 detik -->
</head>
<body>
    <h1>WhatsApp Notifikasi</h1>
    @if($notif)
        <p>Pesan terkirim: {{ $notif->message }} ke {{ $notif->no_hp }}</p>
    @endif

    @if($status)
        <p>Status: {{ $status }}.</p>
    @endif
</body>
</html>
