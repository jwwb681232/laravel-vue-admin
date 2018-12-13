<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/11
 * Time: 20:51
 */
namespace App\Http\Criteria\Menu;

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
