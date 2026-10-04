<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheImages
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (!$response->isOk() && !$response->isSuccessful()) {
            return $response;
        }

        $contentType = $response->headers->get('Content-Type', '');
        $imageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml', 'image/x-icon'];
        $isImage = false;
        foreach ($imageTypes as $type) {
            if (str_starts_with($contentType, $type)) {
                $isImage = true;
                break;
            }
        }

        if ($isImage) {
            $response->headers->set('Cache-Control', 'public, max-age=2592000, immutable');
            $response->headers->set('Expires', gmdate('D, d M Y H:i:s', time() + 2592000) . ' GMT');
            $response->headers->set('Pragma', 'cache');
        }

        return $response;
    }
}
