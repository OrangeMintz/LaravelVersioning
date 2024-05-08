<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class getReleaseAssetContent extends Controller
{
    function getReleaseAssetContent(string $tagName, string $assetName)
    {
        $url = "clttps://api.github.com/repos/OrangeMintz/LaravelVersioning/releases/tags/{$tagName}";

        $response = Http::get($url);

        if ($response->successful()) {
            $release = $response->json();

            foreach ($release['assets'] as $asset) {
                if ($asset['name'] === $assetName) {
                    return Http::get($asset['browser_download_url'])->body();
                }
            }
        }

        return null;
    }
}
