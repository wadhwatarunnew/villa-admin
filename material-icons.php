<?php
$asJavaScript = isset($_GET['format']) && $_GET['format'] === 'js';
header($asJavaScript ? 'Content-Type: application/javascript; charset=utf-8' : 'Content-Type: application/json; charset=utf-8');
header('Cache-Control: public, max-age=86400');

$metadataUrl = 'https://fonts.google.com/metadata/icons';
$content = false;

if (function_exists('curl_init')) {
    $curl = curl_init($metadataUrl);
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_USERAGENT => 'Villa Dashboard Material Icon Catalog'
    ]);
    $content = curl_exec($curl);
    curl_close($curl);
} else {
    $content = @file_get_contents($metadataUrl);
}

if ($content === false) {
    http_response_code(502);
    echo $asJavaScript ? 'window.materialIconNames = [];' : json_encode(['icons' => []]);
    exit;
}

$content = preg_replace('/^\)\]\}\',?\s*/', '', $content);
$metadata = json_decode($content, true);
$icons = [];

if (isset($metadata['icons']) && is_array($metadata['icons'])) {
    foreach ($metadata['icons'] as $icon) {
        if (!empty($icon['name']) && !in_array($icon['name'], $icons, true)) {
            $icons[] = $icon['name'];
        }
    }
}

$iconJson = json_encode($icons);
echo $asJavaScript
    ? 'window.materialIconNames = ' . $iconJson . ';'
    : json_encode(['icons' => $icons]);
