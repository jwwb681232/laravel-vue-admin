<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/20
 * Time: 21:35
 */
namespace App\Http\Criteria\Permission;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class RoleCriteria.
 *
 * @package namespace App\Criteria\Permissions;
 */
class ApiTreeListCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $guard = request('guard_name');
        $parentId = request('parent_id');

        return $model->with(['child'=>function($query){
            return $query->select(['id','name','parent_id']);
        }])
            ->when($guard,function($query)use($guard){
                return $query->where('guard_name',$guard);
            })->where('parent_id',$parentId);
    }
}
