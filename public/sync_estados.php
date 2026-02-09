
<?php
require __DIR__ . '/../src/db.php';
require __DIR__ . '/../src/copomex.php';

header('Content-Type: text/plain; charset=utf-8');

$pdo = null;

try {
  $estados = copomex_listar_estados();
  if (!is_array($estados) || count($estados) === 0) {
    throw new Exception('Sin estados');
  }

  $pdo = db();
  $pdo->beginTransaction();

  $stmt = $pdo->prepare("INSERT IGNORE INTO estados (nombre) VALUES (:nombre)");

  $nuevos = 0;

  foreach ($estados as $nombre) {
    $stmt->execute([':nombre' => $nombre]);
    $nuevos += (int)$stmt->rowCount();
  }

  $total = (int)$pdo->query("SELECT COUNT(*) FROM estados")->fetchColumn();

  $pdo->commit();

  echo "OK\n";
  echo "Estados recibidos: " . count($estados) . "\n";
  echo "Nuevos insertados: {$nuevos}\n";
  echo "Total en BD: {$total}\n";

} catch (Throwable $e) {
  if ($pdo && $pdo->inTransaction()) $pdo->rollBack();
  http_response_code(500);
  echo "ERROR";
}
