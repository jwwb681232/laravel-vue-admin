<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/15
 * Time: 18:08
 */
namespace App\Http\Criteria\User;

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
        return $model->orderBy(request('orderBy'),request('order'));
    }
}
