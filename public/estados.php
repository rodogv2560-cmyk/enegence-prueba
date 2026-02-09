<?php
require __DIR__ . '/../src/db.php';

$pdo = db();
$estados = $pdo->query("SELECT id, nombre FROM estados ORDER BY nombre")->fetchAll();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Estados - Prueba ENEGENCE</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
  <span class="navbar-brand">Prueba ENEGENCE</span>
</nav>

<main class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Estados de México</h3>
    <a href="sync_estados.php" class="btn btn-sm btn-outline-primary">
      Sincronizar
    </a>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <table id="tblEstados" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Estado</th>
            <th style="width:180px;">Municipios</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($estados as $e): ?>
            <tr>
              <td><?= htmlspecialchars($e['nombre']) ?></td>
              <td class="text-center">
                <a class="btn btn-sm btn-primary"
                   href="municipios.php?id=<?= (int)$e['id'] ?>">
                   Ver municipios
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>

<script>
$(function () {
  $('#tblEstados').DataTable({
    pageLength: 10,
    order: [[0, 'asc']],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json"
    }
  });
});
</script>

</body>
</html>
