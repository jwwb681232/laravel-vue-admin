<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/20
 * Time: 20:51
 */

namespace App\Http\Presenters\Role;

use Prettus\Repository\Presenter\FractalPresenter;
use App\Http\Transformers\Role\ApiListTransformer;

class ApiListPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ApiListTransformer();
    }
}