const { makeWASocket, DisconnectReason, useMultiFileAuthState } = require("@whiskeysockets/baileys");
const express = require("express");
const pino = require("pino");

const app = express();
app.use(express.json());

async function connectToWhatsApp() {
    const { state, saveCreds } = await useMultiFileAuthState("auth_info_baileys");
    const sock = makeWASocket({
        logger: pino({ level: "fatal" }),
        auth: state,
        printQRInTerminal: true
    });

    sock.ev.on("connection.update", ({ connection, lastDisconnect }) => {
        if (connection === "close") {
            const shouldReconnect = lastDisconnect.error?.output.statusCode !== DisconnectReason.loggedOut;
            if (shouldReconnect) {
                console.log("Menjalankan Ulang");
                connectToWhatsApp();
            }
        }
        if (connection === "open") {
            console.log("terhubung");
        }
    });
    sock.ev.on("creds.update", saveCreds);

    // Endpoint untuk mengirim pesan
    app.post("/send-message", async (req, res) => {
        const { numbers, message } = req.body;
        const delayBetweenMessages = 60000;

        try {
            // Kirim pesan ke setiap nomor dengan jeda
            for (let i = 0; i < numbers.length; i++) {
                const number = numbers[i];
                await new Promise((resolve) => setTimeout(resolve, i * delayBetweenMessages)); // Jeda untuk setiap pengiriman
                await sock.sendMessage(`${number}@s.whatsapp.net`, { text: message });
                console.log(`Pesan dikirim ke ${number}`);
            }
            res.json({ status: "Pesan berhasil dikirim ke semua nomor" });
        } catch (error) {
            res.status(500).json({ status: "Gagal mengirim pesan", error: error.message });
        }
    });
}

// Menjalankan server Express di port 3000
const PORT = 3000;
app.listen(PORT, () => {
    console.log(`Server berjalan pada port ${PORT}`);
});

connectToWhatsApp();

