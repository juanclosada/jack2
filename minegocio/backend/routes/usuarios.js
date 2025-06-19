const express = require('express');
const router = express.Router();
const db = require('../db');

// Obtener todos los usuarios
router.get('/', (req, res) => {
  db.query('SELECT * FROM usuarios', (err, results) => {
    if (err) throw err;
    res.json(results);
  });
});

// Crear nuevo usuario
router.post('/', (req, res) => {
  const { nombre, correo, contrasena, id_rol } = req.body;
  db.query('INSERT INTO usuarios (nombre, correo, contrasena, id_rol) VALUES (?, ?, ?, ?)',
    [nombre, correo, contrasena, id_rol],
    (err, result) => {
      if (err) throw err;
      res.send({ message: 'Usuario creado' });
    });
});

// Actualizar usuario
router.put('/:id', (req, res) => {
  const { nombre, correo, contrasena, id_rol } = req.body;
  db.query('UPDATE usuarios SET nombre = ?, correo = ?, contrasena = ?, id_rol = ? WHERE id_usuario = ?',
    [nombre, correo, contrasena, id_rol, req.params.id],
    (err, result) => {
      if (err) throw err;
      res.send({ message: 'Usuario actualizado' });
    });
});

// Eliminar usuario
router.delete('/:id', (req, res) => {
  db.query('DELETE FROM usuarios WHERE id_usuario = ?', [req.params.id], (err, result) => {
    if (err) throw err;
    res.send({ message: 'Usuario eliminado' });
  });
});

module.exports = router;
