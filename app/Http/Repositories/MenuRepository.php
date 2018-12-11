<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/11
 * Time: 20:56
 */

namespace App\Http\Repositories;

use App\Entities\Menu;
use Prettus\Repository\Eloquent\BaseRepository;

class MenuRepository extends BaseRepository
{
    public function model()
    {
        return Menu::class;
    }
}