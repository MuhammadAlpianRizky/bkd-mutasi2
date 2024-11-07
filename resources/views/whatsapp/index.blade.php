<!-- resources/views/whatsapp/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp</title>
    <meta http-equiv="refresh" content="15"> <!-- Halaman di-refresh setiap 15 detik -->
</head>
<body>
    <h1>WhatsApp Notifikasi</h1>

    @if($notif)
        <p>Pesan terkirim: {{ $notif->message }} ke {{ $notif->no_hp }}</p>
    @endif

    <p>Status: {{ $status }}</p>

    <!-- Menampilkan QR code jika tersedia -->
    @if($qrCode)
        <h2>Scan QR Code untuk Terhubung</h2>
        <img src="{{ $qrCode }}" alt="QR Code WhatsApp" style="width:200px; height:200px;">
    @else
        <p>QR code tidak tersedia, coba lagi nanti.</p>
    @endif
</body>
</html>
