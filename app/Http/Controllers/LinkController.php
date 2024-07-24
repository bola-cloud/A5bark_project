<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class LinkController extends Controller
{
    public function createMediaLink()
    {
        try {
            $target = storage_path('app/public/media');
            $link = public_path('media');

            if (!File::exists($link)) {
                File::link($target, $link);
                return response()->json(['message' => 'The symbolic link has been created successfully.']);
            } else {
                return response()->json(['message' => 'The symbolic link already exists.']);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create the symbolic link.', 'error' => $e->getMessage()]);
        }
    }
}
