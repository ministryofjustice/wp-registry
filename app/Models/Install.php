<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use App\Services\WordPressVersion;

class Install extends Model
{
    public $fillable = [
        'name',
        'site_id',
        'url',
        'wordpress_version',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['wordpress_is_current'];

    public function plugins()
    {
        return $this->belongsToMany('App\Models\Plugin')
            ->withPivot(['version', 'is_mu_plugin', 'is_active'])
            ->orderBy('name');
    }

    public function newPivot(Model $parent, array $attributes, $table, $exists)
    {
        if ($parent instanceof Plugin) {
            return new InstallPluginPivot($parent, $attributes, $table, $exists);
        }

        return parent::newPivot($parent, $attributes, $table, $exists);
    }

    public function getWordpressIsCurrentAttribute()
    {
        $wp = App::make(WordPressVersion::class);
        $current = $wp->core();
        return ($this->wordpress_version == $current);
    }
}
