<?php
require __DIR__ . '/../src/copomex.php';

header('Content-Type: text/plain; charset=utf-8');

$methods = [
  'get_estados',
  'get_estado',
  'get_estado_clave',
  'get_estados_clave',
  'get_estados_info',
];

foreach ($methods as $m) {
  echo "=== Probando: {$m} ===\n";
  try {
    $json = copomex_get($m);
    // Imprime solo pedacito para no saturar
    $preview = json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo substr($preview, 0, 1200) . "\n\n";
  } catch (Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n\n";
  }
}
