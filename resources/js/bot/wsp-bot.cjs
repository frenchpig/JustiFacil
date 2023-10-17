function startConnection(){
    const qrcode = require('qrcode-terminal');

    const { Client, LocalAuth } = require('whatsapp-web.js');
    const client = new Client({
        authStrategy: new LocalAuth(),
    });

    client.on('qr', qr => {
        qrcode.generate(qr, {small: true});
    });

    client.on('ready', () => {
        console.log('¡El cliente está listo!');
    });

    client.initialize();

    client.on('authenticated', () => {
        console.log('El cliente esta autorizado')
    });
}

function checkConnection(){
    const { Client, LocalAuth } = require('whatsapp-web.js');
    const client = new Client({
        authStrategy: new LocalAuth(),
    });

    client.initialize();

    client.on('authenticated', ()=> {
        console.log('Client is ready!');
    });

}


