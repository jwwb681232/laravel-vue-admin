<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/19
 * Time: 16:33
 */

namespace App\Http\Presenters\Permission;

use Prettus\Repository\Presenter\FractalPresenter;
use App\Http\Transformers\Permission\ApiListTransformer;

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