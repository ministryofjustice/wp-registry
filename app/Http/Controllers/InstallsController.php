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
        return view('installs.index', compact('installs'));
    }

    public function view($id)
    {
        $install = Install::findOrFail($id);
        return view('installs.view', compact('install'));
    }
}
