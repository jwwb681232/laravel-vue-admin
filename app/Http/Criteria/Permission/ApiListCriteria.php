<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/19
 * Time: 16:32
 */
namespace App\Http\Criteria\Permission;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class RoleCriteria.
 *
 * @package namespace App\Criteria\Permissions;
 */
class ApiListCriteria implements CriteriaInterface
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
        $keyword = request('keyword');
        $deleted = request('deleted');

        return $model
            ->when($deleted == 'true',function($query){
                return $query->onlyTrashed();
            })
            ->when($keyword,function($query)use($keyword){
                return $query->where('name','like',"%{$keyword}%");
            })
            ->orderBy(request('orderBy'),request('order'));
    }
}
