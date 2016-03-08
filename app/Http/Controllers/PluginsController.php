<?php

namespace App\Http\Controllers;

use App\Models\Plugin;

class PluginsController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $plugins = Plugin::orderBy('name')->get();
        return view('plugins.index', compact('plugins'));
    }

    public function view($id)
    {
        $plugin = Plugin::findOrFail($id);
        return view('plugins.view', compact('plugin'));
    }
}
