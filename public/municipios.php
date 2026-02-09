<?php
require __DIR__ . '/../src/db.php';
require __DIR__ . '/../src/copomex.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
  http_response_code(400);
  exit('Estado inválido');
}

$pdo = db();
$stmt = $pdo->prepare("SELECT nombre FROM estados WHERE id = :id");
$stmt->execute([':id' => $id]);
$estado = $stmt->fetchColumn();

if (!$estado) {
  http_response_code(404);
  exit('Estado no encontrado');
}

$municipios = copomex_municipios_por_estado($estado);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Municipios de <?= htmlspecialchars($estado) ?></title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
</head>
<body>

<nav class="navbar navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a href="estados.php" class="navbar-brand">← Estados</a>
  </div>
</nav>

<div class="container">
  <h2 class="mb-4">Municipios de <?= htmlspecialchars($estado) ?></h2>

  <table id="tablaMunicipios" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Municipio</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($municipios as $m): ?>
        <tr>
          <td><?= htmlspecialchars($m) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>
$(function () {
  $('#tablaMunicipios').DataTable({
    pageLength: 10,
    lengthMenu: [5, 10, 25, 50],
    order: [[0, 'asc']],
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
    }
  });
});
</script>

</body>
</html>

