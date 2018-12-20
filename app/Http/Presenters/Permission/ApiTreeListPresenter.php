<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/20
 * Time: 21:37
 */

namespace App\Http\Presenters\Permission;

use Prettus\Repository\Presenter\FractalPresenter;
use App\Http\Transformers\Permission\ApiTreeListTransformer;

class ApiTreeListPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ApiTreeListTransformer();
    }
}