<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/15
 * Time: 18:10
 */

namespace App\Http\Repositories;

use App\Entities\User;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
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