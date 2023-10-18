// mi-archivo.js

const axios = require('axios');

// URL de tu aplicación Laravel
const apiUrl = 'http://justifacil.test'; // Reemplaza con la URL de tu aplicación Laravel

// Llamada a la ruta usando axios
axios.get(`${apiUrl}/test/123/Hola!!!`)
    .then(response => {
        console.log(response.data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
