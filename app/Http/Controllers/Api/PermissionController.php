<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/19
 * Time: 16:29
 */
namespace App\Http\Controllers\Api;

use App\Http\Criteria\Permission\ApiListCriteria;
use App\Http\Presenters\Permission\ApiListPresenter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Validators\PermissionValidator;
use App\Http\Repositories\PermissionRepository;

class PermissionController extends Controller
{
    protected $repository;
    protected $validator;

    /**
     * MenuController constructor.
     *
     * @param PermissionRepository $repository
     * @param PermissionValidator  $validator
     */
    public function __construct(PermissionRepository $repository,PermissionValidator $validator)
    {
        $this->middleware('auth:api');
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(ApiListCriteria::class);
        $this->repository->setPresenter(ApiListPresenter::class);

        return response()->json($this->repository->search());
    }
}