
import qrcode from 'qrcode-terminal';
import { Client } from 'whatsapp-web.js';
import pkg from 'whatsapp-web.js';
const { LocalAuth } = pkg;
const client = new Client({
    authStrategy: new LocalAuth()
})

client.on('qr', qr => {
    qrcode.generate(qr, {small: true});
});

client.on('ready', () => {
    console.log('¡El cliente está listo!');
});

client.on('authenticated', () => {
    console.log('El cliente esta autorizado')
});

client.initialize();

let person_name;
let description;

client.on('message', message => {
	if(message.body.startsWith("!justificar")) {
        setTimeout(() => {
            message.reply('Buenas!, bienvenido a justifacil, para justificar tu inasistencia del dia de hoy ingresa tu nombre con el comando !nombre y tu razon o descripcion con !descripcion');
        }, 7000);
	}
    if(message.body.startsWith("!nombre")) {
        let trimmed = message.body.replace("!nombre ", "");
        person_name=trimmed;
        console.log(person_name);
        setTimeout(() => {
            message.reply('Nombre Guardado!');
        }, 7000);
    }
    if(message.body.startsWith("!descripcion")) {
        let trimmed = message.body.replace("!descripcion ","");
        description=trimmed;
        console.log(person_name);
        console.log(description);
        setTimeout(() => {
            message.reply('Justificacion Guardada!');
        }, 7000);
    }
});


