<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/11
 * Time: 20:54
 */
namespace App\Http\Transformers\Menu;


use App\Entities\Menu;
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
     * @param \App\Entities\Menu $model
     *
     * @return array
     */
    public function transform(Menu $model)
    {
        return $model->toArray();
    }
}