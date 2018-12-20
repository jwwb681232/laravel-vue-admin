<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/20
 * Time: 20:51
 */
namespace App\Http\Transformers\Role;


use App\Entities\Role;
use League\Fractal\TransformerAbstract;

/**
 * Class RoleTransformer.
 *
 * @package namespace App\Transformers;
 */
class ApiListTransformer extends TransformerAbstract
{
    /**
     * Transform the Schedule entity.
     *
     * @param \App\Entities\Role $model
     *
     * @return array
     */
    public function transform(Role $model)
    {
        return $model->toArray();
    }
}