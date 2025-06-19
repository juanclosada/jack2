const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
const usuariosRoutes = require('./routes/usuarios');

const app = express();
app.use(cors());
app.use(bodyParser.json());
app.use('/api/usuarios', usuariosRoutes);

app.listen(3001, () => {
  console.log('Servidor backend corriendo en puerto 3001');
});
