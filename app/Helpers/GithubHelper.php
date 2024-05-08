<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class GitHubHelper
{
    public static function getReleaseAssetContent(string $owner, string $repo, string $tagName, string $assetName)
    {
        $url = "https://api.github.com/repos/{$owner}/{$repo}/releases/tags/{$tagName}";

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
