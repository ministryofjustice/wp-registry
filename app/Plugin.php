<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plugin extends Model
{
    public $fillable = [
        'name',
        'slug',
    ];

    public function installs()
    {
        return $this->belongsToMany('App\Install')
            ->withPivot(['version', 'is_mu_plugin', 'is_active']);
    }
}
