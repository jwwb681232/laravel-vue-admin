<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/21
 * Time: 15:25
 */
namespace App\Http\Criteria\Permission;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class RoleCriteria.
 *
 * @package namespace App\Criteria\Permissions;
 */
class ApiTopListCriteria implements CriteriaInterface
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

        return $model->when(
            $guard,
            function ($query) use ($guard) {
                return $query->where('guard_name', $guard);
            }
        )->where('parent_id', 0);
    }
}
