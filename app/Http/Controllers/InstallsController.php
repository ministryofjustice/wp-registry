<?php

namespace App\Http\Controllers;

use App\Install;
use Illuminate\Http\Request;

use App\Http\Requests;

class InstallsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $installs = Install::all();
        return view('installs.index', compact('installs'));
    }

    public function view($id)
    {
        $this->middleware('auth');
        $install = Install::findOrFail($id);
        return view('installs.view', compact('install'));
    }
}
