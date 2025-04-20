<?php
if(mail("tucorreo@dominio.com", "Prueba", "Esto es una prueba")) {
  echo "Correo enviado correctamente.";
} else {
  echo "Error al enviar el correo.";
}