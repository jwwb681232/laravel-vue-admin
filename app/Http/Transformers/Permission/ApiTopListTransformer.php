<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/21
 * Time: 15:26
 */
namespace App\Http\Transformers\Permission;


use App\Entities\Permission;
use League\Fractal\TransformerAbstract;

/**
 * Class RoleTransformer.
 *
 * @package namespace App\Transformers;
 */
class ApiTopListTransformer extends TransformerAbstract
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