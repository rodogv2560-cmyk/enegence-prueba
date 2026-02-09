<?php

function copomex_get(string $path): array {
  $cfg = require __DIR__ . '/../.env.php';
  $base = rtrim($cfg['copomex']['base_url'], '/');
  $token = $cfg['copomex']['token'];

  $url = $base . '/' . ltrim($path, '/');
  $url .= (strpos($url, '?') === false ? '?' : '&') . 'token=' . urlencode($token);

  $ch = curl_init($url);
  curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 20,
    CURLOPT_CONNECTTIMEOUT => 10,
  ]);

  $raw = curl_exec($ch);
  $err = curl_error($ch);
  $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);

  if ($raw === false) {
    throw new Exception($err);
  }

  if ($http < 200 || $http >= 300) {
    throw new Exception($raw);
  }

  $json = json_decode($raw, true);
  if (!is_array($json)) {
    throw new Exception($raw);
  }

  return $json;
}

function copomex_listar_estados(): array {
  $json = copomex_get('get_estados');
  $estados = $json['response']['estado'] ?? [];

  if (!is_array($estados)) return [];

  $out = [];
  foreach ($estados as $e) {
    if (!is_string($e)) continue;
    $e = trim(preg_replace('/\s+/', ' ', $e));
    if ($e !== '') $out[] = $e;
  }

  return array_values(array_unique($out));
}

function copomex_municipios_por_estado(string $estado): array {
  $estado = trim(preg_replace('/\s+/', ' ', $estado));
  $json = copomex_get('get_municipio_por_estado/' . rawurlencode($estado));

  $resp = $json['response'] ?? [];
  $mun = $resp['municipios'] ?? ($resp['municipio'] ?? []);

  if (!is_array($mun)) return [];

  $out = [];
  foreach ($mun as $m) {
    if (is_string($m)) $out[] = $m;
    if (is_array($m) && isset($m['municipio'])) $out[] = $m['municipio'];
    if (is_array($m) && isset($m['nombre'])) $out[] = $m['nombre'];
  }

  $out = array_map(fn($x) => trim(preg_replace('/\s+/', ' ', (string)$x)), $out);
  $out = array_values(array_filter(array_unique($out), fn($x) => $x !== ''));
  sort($out, SORT_STRING);

  return $out;
}


