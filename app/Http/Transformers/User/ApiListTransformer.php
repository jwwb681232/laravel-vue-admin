<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/15
 * Time: 18:09
 */
namespace App\Http\Transformers\User;


use App\Entities\User;
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
     * @param \App\Entities\User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return $model->toArray();
    }
}