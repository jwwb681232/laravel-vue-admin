<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/25
 * Time: 12:01
 */

namespace App\Http\ViewComposers;

use App\Http\Repositories\MenuRepository;
use Illuminate\View\View;

class PermissionMenusComposer
{
    protected $repository;

    public function __construct(MenuRepository $repository)
    {
        $this->repository = $repository;
    }

    public function compose(View $view)
    {
        $view->with('menus', $this->repository->permissionMenus());
    }
}