<?php

require_once 'utilitarias.php';
require_once '../controlador/conexion.php';
include_once '../config/config.php';
enviarEmail($_POST['email'], $_POST['subject'], $_POST['message']);
