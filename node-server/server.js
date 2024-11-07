const { makeWASocket, DisconnectReason, useMultiFileAuthState } = require("@whiskeysockets/baileys");
const express = require("express");
const pino = require("pino");
const qrcode = require("qrcode");

const app = express();
app.use(express.json());

let qrCodeData = null; // Variabel untuk menyimpan QR code sementara

async function connectToWhatsApp() {
    const { state, saveCreds } = await useMultiFileAuthState("auth_info_baileys");
    const sock = makeWASocket({
        logger: pino({ level: "fatal" }),
        auth: state,
        printQRInTerminal: false
    });

    sock.ev.on("connection.update", async ({ connection, lastDisconnect, qr }) => {
        if (connection === "close") {
            const shouldReconnect = lastDisconnect.error?.output.statusCode !== DisconnectReason.loggedOut;
            if (shouldReconnect) {
                console.log("Menjalankan Ulang");
                connectToWhatsApp();
            }
        }

        if (connection === "open") {
            console.log("Terhubung");
            qrCodeData = null; // Hapus QR code setelah terhubung
        }

        if (qr) {
            // Simpan QR code dalam bentuk base64
            qrCodeData = await qrcode.toDataURL(qr);
        }
    });

    sock.ev.on("creds.update", saveCreds);

    // Endpoint untuk mengirim pesan
    app.post("/send-message", async (req, res) => {
        const { number, message } = req.body;
        try {
            await sock.sendMessage(`${number}@s.whatsapp.net`, { text: message });
            res.json({ status: "Pesan berhasil dikirim" });
        } catch (error) {
            console.error("Gagal mengirim pesan:", error);
            res.status(500).json({ status: "Gagal mengirim pesan", error: error.message });
        }
    });
}

// Endpoint untuk mengambil QR code dalam format base64
app.get("/qr", (req, res) => {
    if (qrCodeData) {
        res.json({ qr: qrCodeData });
    } else {
        res.status(404).json({ status: "QR code tidak tersedia" });
    }
});

// Memanggil fungsi koneksi WhatsApp
connectToWhatsApp();

app.listen(3000, () => {
    console.log("Server berjalan di port 3000");
});
