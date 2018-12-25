<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/25
 * Time: 11:56
 */

namespace App\Providers;

use App\Http\ViewComposers\PermissionMenusComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('layouts.master', PermissionMenusComposer::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}