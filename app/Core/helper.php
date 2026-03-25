<?php

// function สำหรับกำหนด path ที่ใช้ asset
function asset(string $path): string
{
    if ($path === '' || $path !== '/') {
        $path = '/' . ltrim($path, '/');
    }

    $publicPath = dirname(__DIR__, 2) . '/' . $path;

    $v = is_file($publicPath) ? filemtime($publicPath) : time();
    $base = defined('BASE_URL') ? BASE_URL : '';

    return $base . $path . '?v=' . $v;
}
