<?php

namespace App\Http\Controllers;

use App\Models\Install;
use App\Services\WordPressVersion;

class InstallsController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(WordPressVersion $wp)
    {
        $installs = Install::all();
        $wordpressCurrentVersion = $wp->core();
        return view('installs.index', compact('installs', 'wordpressCurrentVersion'));
    }

    public function view($id, WordPressVersion $wp)
    {
        $install = Install::findOrFail($id);
        $wordpressCurrentVersion = $wp->core();
        return view('installs.view', compact('install', 'wordpressCurrentVersion'));
    }
}
