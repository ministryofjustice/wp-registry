<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class InstallPluginPivot extends Pivot
{
    protected $appends = [
        'is_current',
    ];

    /**
     * Return whether the installed version is the
     * current version of the plugin.
     *
     * @return bool
     */
    public function getIsCurrentAttribute()
    {
        $plugin = Plugin::find($this->plugin_id);
        return ($this->version == $plugin->current_version);
    }
}