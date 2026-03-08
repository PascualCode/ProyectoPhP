<?php
session_start();      // Recupera la sesión actual
session_unset();      // Elimina todas las variables de sesión
session_destroy();    // Destruye la sesión por completo

// Redirigir al index
header("Location: /miWEB/../index.php");
exit;
