<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/15
 * Time: 18:08
 */

namespace App\Http\Presenters\User;

use Prettus\Repository\Presenter\FractalPresenter;
use App\Http\Transformers\User\ApiListTransformer;

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