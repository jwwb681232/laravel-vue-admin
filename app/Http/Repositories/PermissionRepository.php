<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/19
 * Time: 16:30
 */

namespace App\Http\Repositories;

use App\Entities\Permission;
use Illuminate\Support\MessageBag;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Validator\Exceptions\ValidatorException;

class PermissionRepository extends BaseRepository
{
    public function model()
    {
        return Permission::class;
    }

    /**
     * @return mixed
     */
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

    /**
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     * @throws ValidatorException
     */
    public function updatePermission(array $attributes,$id)
    {
        $permission = $this->model->withTrashed()
                     ->where('name',$attributes['name'])
                     ->where('guard_name',$attributes['guard_name'])
                     ->whereNotIn('id',array_wrap($id))->first();

        if ($permission){
            throw new ValidatorException(
                new MessageBag(
                    ['name' => ["A `{$attributes['name']}` permission already exists for guard `{$attributes['guard_name']}`."]]
                )
            );
        }

        $attributes['parent_id'] = request('parent_id',0);

        return $this->update($attributes,$id);
    }

}