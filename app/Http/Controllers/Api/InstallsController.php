<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plugin;
use Illuminate\Http\Request;
use App\Models\Install;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InstallsController extends Controller
{
    /**
     * Receive an 'announce' from the WP Registry client.
     * Store it in the database.
     */
    public function postAnnounce(Request $request)
    {
        $validation = Validator::make(
            $request->input(),
            [
                'site_name' => 'required|max:255',
                'site_id' => 'required|max:255',
                'wordpress_version' => 'required',
            ]
        );

        if ($validation->fails()) {
            return [
                'success' => false,
                'error_message' => 'Invalid data',
                'validation_errors' => $validation->messages(),
            ];
        }

        $install = Install::firstOrNew([
            'site_id' => $request->input('site_id'),
        ]);
        $install->fill([
            'name' => $request->input('site_name'),
            'url' => $request->input('url'),
            'wordpress_version' => $request->input('wordpress_version'),
        ]);

        $pluginSync = [];
        foreach ($request->input('plugins') as $plugin) {
            $record = Plugin::firstOrCreate([
                'name' => $plugin['name'],
                'slug' => $plugin['slug'],
            ]);

            $pluginSync[$record->id] = [
                'version' => $plugin['version'],
                'is_mu_plugin' => $plugin['mu'],
                'is_active' => $plugin['active'],
            ];
        }

        try {
            DB::transaction(function () use ($install, $pluginSync) {
                $install->save();

                if (!$install) {
                    throw new \Exception('An error occurred when saving install');
                }

                $install->plugins()->sync($pluginSync);
            });

            return ['success' => true];
        } catch (\Exception $e) {
            return ['success' => false, 'error_message' => $e->getMessage()];
        }
    }
}