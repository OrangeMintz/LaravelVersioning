<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use App\Helpers\GitHubHelper; // Import the GitHubHelper class

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        return view('welcome');
    }


    public function updateWelcomePage()
    {
        // Fetch content of welcome.blade.php from GitHub release (e.g., version 1.0.1)
        $newContent = GitHubHelper::getReleaseAssetContent('owner', 'repo', '1.0.1', 'welcome.blade.php');

        if ($newContent) {
            // Update welcome.blade.php with the fetched content
            File::put(resource_path('views/welcome.blade.php'), $newContent);
        }

        return redirect()->route('welcome')->with('success', 'Welcome page updated!');
    }

    public function rollbackWelcomePage()
    {
        // Fetch content of welcome.blade.php from GitHub release (e.g., version 1.0.0)
        $oldContent = GitHubHelper::getReleaseAssetContent('owner', 'repo', '1.0.0', 'welcome.blade.php');

        if ($oldContent) {
            // Rollback welcome.blade.php to the content of version 1.0.0
            File::put(resource_path('views/welcome.blade.php'), $oldContent);
        }

        return redirect()->route('welcome')->with('success', 'Welcome page rolled back!');
    }
}
