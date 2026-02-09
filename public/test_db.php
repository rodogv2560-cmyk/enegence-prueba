<?php
require __DIR__ . '/../src/db.php';

try {
  $pdo = db();
  $count = $pdo->query("SELECT COUNT(*) c FROM estados")->fetch()['c'];
  echo "Conexión a MySQL OK. Tabla estados lista. Registros: " . $count;
} catch (Throwable $e) {
  echo "ERROR: " . $e->getMessage();
}
