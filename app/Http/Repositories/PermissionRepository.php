<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/19
 * Time: 16:30
 */

namespace App\Http\Repositories;

use App\Entities\Permission;
use Prettus\Repository\Eloquent\BaseRepository;

class PermissionRepository extends BaseRepository
{
    public function model()
    {
        return Permission::class;
    }

    public function search()
    {
        $this->applyCriteria();
        $condition = $this->model;

        $total = $condition->count();
        $data['dataList']  = $this->parserResult(
            $condition->offset(request('start',0))->limit(request('length',5))->get()
        )['data'];

        $data['totalRecords']    = $total;

        return $data;
    }

}