<?php

namespace App\Models;

use App;
use App\Services\WordPressVersion;
use Illuminate\Database\Eloquent\Model;

class Plugin extends Model
{
    public $fillable = [
        'name',
        'slug',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['current_version'];

    public function installs()
    {
        return $this->belongsToMany('App\Models\Install')
            ->withPivot(['version', 'is_mu_plugin', 'is_active']);
    }

    public function getCurrentVersionAttribute()
    {
        $wp = App::make(WordPressVersion::class);
        return $wp->plugin($this->slug);
    }

    public function newPivot(Model $parent, array $attributes, $table, $exists)
    {
        if ($parent instanceof Install) {
            return new InstallPluginPivot($parent, $attributes, $table, $exists);
        }

        return parent::newPivot($parent, $attributes, $table, $exists);
    }
}
