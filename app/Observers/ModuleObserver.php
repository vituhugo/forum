<?php

namespace App\Observers;

use App\Module;
use Illuminate\Support\Str;

class ModuleObserver
{
    /**
     * Handle the module "creating" event.
     *
     * @param  \App\Module  $module
     * @return void
     */
    public function creating(Module $module)
    {
        $slug = Str::slug($module->name);

        $count = Module::query()->where('slug', 'LIKE', "$slug%")->count();
        if ($count) $slug .= "-$count";
        $module->slug = $slug;
    }

    /**
     * Handle the module "updated" event.
     *
     * @param  \App\Module  $module
     * @return void
     */
    public function updated(Module $module)
    {
        //
    }

    /**
     * Handle the module "deleted" event.
     *
     * @param  \App\Module  $module
     * @return void
     */
    public function deleted(Module $module)
    {
        //
    }

    /**
     * Handle the module "restored" event.
     *
     * @param  \App\Module  $module
     * @return void
     */
    public function restored(Module $module)
    {
        //
    }

    /**
     * Handle the module "force deleted" event.
     *
     * @param  \App\Module  $module
     * @return void
     */
    public function forceDeleted(Module $module)
    {
        //
    }
}
