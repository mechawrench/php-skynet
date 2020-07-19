<?php

namespace Mechawrench\PhpSkynet;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PhpSkynet
{
    // Upload to remote/local Siad API
    public static function uploadSiad($filename, $file_path, $host, $apiKey)
    {
        // Check for host
        if (! $host && ! config('php-skynet.siad_host')) {
            return ['error' => 'Host is required'];
        }

        // Check for apiKey
        if (! $apiKey && ! config('php-skynet.siad_api_key')) {
            return ['error' => 'ApiKey is required'];
        }

        // Check for $filename
        if (! $filename) {
            return ['error' => 'Filename is required'];
        }

        // Check for apiKey
        if (! $file_path) {
            return ['error' => 'File (path) is required'];
        }

        $filename = time() . '-'. $filename;

        $response = Http::withBasicAuth('', ($apiKey ? $apiKey : config('php-skynet.siad_api_key')))
            ->withHeaders(['user-agent' => 'Sia-Agent'])
            ->attach('file', file_get_contents(__DIR__ . '/' . $file_path), $filename)
            ->post(($host ? $host : config('php-skynet.siad_host')) .'/skynet/skyfile/' . $filename . '?filename=' . $filename);

        return ($response->json());
    }

    // Download to remote/local Siad API
    public static function downloadSiad($skyLink, $filename = null, $host)
    {
        // Check for host
        if (! $host && ! config('php-skynet.siad_host')) {
            return ['error' => 'Host is required'];
        }

        $response = Http::withHeaders(['user-agent' => 'Sia-Agent'])
            ->get($host.'/skynet/skylink/'.$skyLink);

        $filename = $filename ? $filename : json_decode($response->getHeaders()['Skynet-File-Metadata'][0])->filename;
        $body = $response->getBody();
        $stringBody = (string) $body;

        return Storage::put($filename, $stringBody);
    }

    // Upload from Skynet Portal
    public static function upload($file_path, $portal_url = null)
    {
        // Check for apiKey
        if (! $file_path) {
            return ['error' => 'File (path) is required'];
        }

        $filename = time() . '-'. base_path($file_path);

        $response = Http::attach('file', file_get_contents(__DIR__ . '/' . $file_path), $filename)
            ->post(($portal_url ? $portal_url : config('php-skynet.default_portal_url')) . 'skynet/skyfile/');

        return $response->json();
    }

    // Download from Skynet Portal
    public static function download($skyLink, $portal_url = null)
    {
        // Check for Syylink
        if (! $skyLink) {
            return ['error' => 'Skylink is required'];
        }

        $response = Http::get(($portal_url ? $portal_url : config('php-skynet.default_portal_url')) . $skyLink);

        $filename = json_decode($response->getHeaders()['Skynet-File-Metadata'][0])->filename;
        $body = $response->getBody();
        $stringBody = (string) $body;

        return Storage::put($filename, $stringBody);
    }
}
