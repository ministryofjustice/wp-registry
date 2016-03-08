<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Install extends Model
{
    public $fillable = [
        'name',
        'site_id',
        'url',
        'wordpress_version',
    ];

    public function plugins()
    {
        return $this->belongsToMany('App\Models\Plugin')
            ->withPivot(['version', 'is_mu_plugin', 'is_active'])
            ->orderBy('name');
    }
}
