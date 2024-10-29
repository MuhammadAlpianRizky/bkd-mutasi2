const { makeWASocket, DisconnectReason, useMultiFileAuthState} = require("@whiskeysockets/baileys");
const express = require("express");
const pino = require("pino");

const app = express();
app.use(express.json());

async function connetToWhatsApp() {
    const { state, saveCreds } = await useMultiFileAuthState("auth_info_baileys");
    const sock = makeWASocket({
        logger: pino( {level: "fatal" }),
        auth: state,
        printQRInTerminal: true
    });

    sock.ev.on("connection.update", ({ connection, lastDisconnect }) => {
        if(connection === "close") {
            const shouldReconnect = lastDisconnect.error?.output.statusCode !== DisconnectReason.loggedOut;
            if(shouldReconnect) {
                console.log("Menjalankan Ulang");
                connetToWhatsApp();
            }
        }
        if (connection === "open") {
            console.log("terhubung");
        }
    });
    sock.ev.on("creds.update", saveCreds)

    // Endpoint untuk mengirim pesan
    app.post("/send-message", async (req, res) => {
        const { number, message } = req.body;
        try {
            await sock.sendMessage(`${number}@s.whatsapp.net`, { text: message });
            res.json({ status: "Pesan berhasil dikirim" });
        } catch (error) {
            res.status(500).json({ status: "Gagal mengirim pesan", error: error.message });
        }
    });
}

connetToWhatsApp()


app.listen(3000, () => {
    console.log("Server berjalan di port 3000");
});
