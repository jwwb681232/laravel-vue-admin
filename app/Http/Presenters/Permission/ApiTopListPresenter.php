<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/21
 * Time: 15:25
 */

namespace App\Http\Presenters\Permission;

use Prettus\Repository\Presenter\FractalPresenter;
use App\Http\Transformers\Permission\ApiTopListTransformer;

class ApiTopListPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ApiTopListTransformer();
    }
}