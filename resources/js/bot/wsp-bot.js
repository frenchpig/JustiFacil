//get axios to send data to database
import axios from 'axios';
//get qrcode-terminal to get whatsappweb qr code
import qrcode from 'qrcode-terminal';
//get client to log into whatsappweb
import { Client } from 'whatsapp-web.js';
import pkg from 'whatsapp-web.js';
//database url
const apiUrl = 'http://justifacil.test';
//local auth to save session locally
const { LocalAuth } = pkg;
const client = new Client({
    authStrategy: new LocalAuth()
})

//show whatsappWeb login qr code
client.on('qr', qr => {
    qrcode.generate(qr, {small: true});
});

//when client is ready execute
client.on('ready', () => {
    console.log('¡El cliente está listo!');
});
//when client is authenticated execute
client.on('authenticated', () => {
    console.log('El cliente esta autorizado')
});

//start client
client.initialize();

//save absence in database, needed person_name and description
function saveAbsence(p_name,desc){
  //convert plain string into URIComponent, it now supports blank spaces.
  let p_nameFix=encodeURIComponent(p_name);
  let descFix=encodeURIComponent(desc);
  //Log in console the data sent
  console.log('Se han guardado estos datos en la base de datos!')
  console.log('person name: ',p_name);
  console.log('description: ',desc);
  //Ask the server to save data on database
  axios.get(`${apiUrl}/absences/${p_nameFix}/${descFix}`)
    .then(response => {
        console.log(response.data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

//global variables of person_name and descripcion.
let person_name;
let description;

//Client message listener
client.on('message', message => {
  //If messages starts with !justificar sends tutorial of usage.
	if(message.body.startsWith("!justificar")) {
        setTimeout(() => {
            message.reply('Buenas!, bienvenido a justifacil, para justificar tu inasistencia del dia de hoy ingresa tu nombre con el comando !nombre y tu razon o descripcion con !descripcion');
        }, 7000);
	}
  // if message starts with !nombre trims any unwanted characters and saves the full string on global variable person_name
  if(message.body.startsWith("!nombre")) {
        let trimmed = message.body.replace("!nombre ", "");
        person_name=trimmed;
        console.log("Se ha capturado un nombre! ",person_name);
        //Sends message to user stating that name is saved
        setTimeout(() => {
            message.reply('Nombre Guardado!');
        }, 7000);
    }
  // if message starts with !descripcion trims any unwanted characters and saves the full string on globar variable descripcion, triggering saveAbsence() funcition
  if(message.body.startsWith("!descripcion")) {
        let trimmed = message.body.replace("!descripcion ","");
        description=trimmed;
        console.log("Se ha capturado una descripcion! ",description);
        saveAbsence(person_name,description);
        //Sends message to user stating that the absence is saved
        setTimeout(() => {
            message.reply('Justificacion Guardada!');
        }, 7000);
    }
});



