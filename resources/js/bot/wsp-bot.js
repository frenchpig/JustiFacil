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
function saveAbsence(p_name,desc,number){
  //convert plain string into URIComponent, it now supports blank spaces.
  let p_nameFix=encodeURIComponent(p_name);
  let descFix=encodeURIComponent(desc);
  //Log in console the data sent
  console.log('Se han guardado estos datos en la base de datos!')
  console.log('person name: ',p_name);
  console.log('description: ',desc);
  //Ask the server to save data on database
  axios.get(`${apiUrl}/absences/${p_nameFix}/${descFix}/${number}`)
    .then(response => {
        console.log(response.data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

//ask DB if exist any user with the phone that is getting the message
async function checkPhone(phone){
  const response = await axios.get(`${apiUrl}/check-phone/${phone}`);
  return {"found": response.data.found, "data": response.data.user};
}

//saves de user on to the database
async function registerUser(phone, name){
  try{
    const response =  await axios.get(`${apiUrl}/register-person/${name}/${phone}`);
  }
  catch{

  }
}

//Creates a random number between 5000 and 7000 for the message response time.
function getRandomResponseTime(){
  return Math.floor(Math.random() * (7000 - 5000 + 1)) + 5000;
}

//Client message listener
client.on('message', async message => {
  //calls a random number for a response time for the messages.
  let responseTime=getRandomResponseTime();
   //gets the sender information, this is used to get the phone number
  const contact = await message.getContact();

  //calls function to check if phone is on the DB
  const dataValidation = await checkPhone(contact.number);

  //if phone isnt on database and the message isnt !registrar command it sends generic message
  if (dataValidation.found==false && !message.body.startsWith("!registrar")){
    setTimeout(() => {
      message.reply('Buenas! Soy JustiFacil, he notado que no te encuentras en nuestros sistemas, porfavor, registrate utilizando el comando !registrar seguido de tu nombre.');
      }, responseTime);
  }

  //if phone isnt on database and message IS !registrar command it saves the phone number and name given in to the DB
  if (dataValidation.found==false&&message.body.startsWith("!registrar")){
    let trimmed = message.body.replace("!registrar","");
    registerUser(contact.number,trimmed)
    setTimeout(() => {
      message.reply(`Magnifico!, te acabamos de registrar en nuestros sistemas ${trimmed}`);
    }, responseTime);
  }

  //if phone is on DB and the message isnt !justificar command it sends a generic message only for registered users.
  if (dataValidation.found==true && !message.body.startsWith("!justificar")){
    setTimeout(() => {
      message.reply(`Buenas ${dataValidation.data.name}!, si deseas justificar tu ausencia el dia de hoy no dudes en enviarme tu justificacion con el comando !justificar.`);
      }, responseTime);
  }

  //if phone is registered on DB and the message IS !justificar command it sends the data off to the DB and saves a new absence with todays date.
  if (dataValidation.found==true && message.body.startsWith("!justificar")){
    let trimmed = message.body.replace("!justificar","");
    saveAbsence(dataValidation.data.name,trimmed,contact.number);
    setTimeout(() => {
      message.reply(`Listo ${dataValidation.data.name}!, tu justificacion se ha registrado en nuestros sistemas.`);
      }, responseTime);
  }
});



