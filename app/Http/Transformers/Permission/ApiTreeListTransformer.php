<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/20
 * Time: 21:38
 */
namespace App\Http\Transformers\Permission;


use App\Entities\Permission;
use League\Fractal\TransformerAbstract;

/**
 * Class RoleTransformer.
 *
 * @package namespace App\Transformers;
 */
class ApiTreeListTransformer extends TransformerAbstract
{
    /**
     * Transform the Schedule entity.
     *
     * @param \App\Entities\Permission $model
     *
     * @return array
     */
    public function transform(Permission $model)
    {
        return $model->toArray();
    }
}