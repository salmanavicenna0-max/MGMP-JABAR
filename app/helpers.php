<?php

if (!function_exists('cached_asset')) {
    /**
     * Generate an asset URL with a version query string based on file modification time.
     * This ensures browsers re-download images when the file changes.
     */
    function cached_asset(string $path): string
    {
        $url = asset($path);
        $fullPath = public_path($path);

        if (file_exists($fullPath)) {
            $timestamp = filemtime($fullPath);
            $separator = str_contains($url, '?') ? '&' : '?';
            $url .= $separator . 'v=' . $timestamp;
        }

        return $url;
    }
}
