<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/20
 * Time: 20:51
 */
namespace App\Http\Criteria\Role;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class RoleCriteria.
 *
 * @package namespace App\Criteria\Roles;
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
