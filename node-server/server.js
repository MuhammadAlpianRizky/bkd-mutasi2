const { makeWASocket, DisconnectReason, useMultiFileAuthState} = require("@whiskeysockets/baileys");
const pino = require("pino");

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
}

connetToWhatsApp()
