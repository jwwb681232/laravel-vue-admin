<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/11
 * Time: 20:53
 */

namespace App\Http\Presenters\Menu;

use Prettus\Repository\Presenter\FractalPresenter;
use App\Http\Transformers\Menu\ApiListTransformer;

class ApiListPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TableDataTransformer();
    }
}