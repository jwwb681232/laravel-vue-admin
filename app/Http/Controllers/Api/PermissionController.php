<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/19
 * Time: 16:29
 */
namespace App\Http\Controllers\Api;

use App\Http\Criteria\Permission\ApiListCriteria;
use App\Http\Criteria\Permission\ApiTreeListCriteria;
use App\Http\Presenters\Permission\ApiListPresenter;
use App\Http\Presenters\Permission\ApiTreeListPresenter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Validators\PermissionValidator;
use App\Http\Repositories\PermissionRepository;
use Prettus\Validator\Exceptions\ValidatorException;

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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function tree()
    {
        $this->repository->pushCriteria(ApiTreeListCriteria::class);
        $this->repository->setPresenter(ApiTreeListPresenter::class);

        return response()->json($this->repository->all(['id','name','parent_id'])['data']);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function store(Request $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail('store');
            return $this->repository->makeModel()->create($request->all());
        } catch (\Exception $e) {
            if ($e instanceof \Spatie\Permission\Exceptions\PermissionAlreadyExists){
                return response(['name'=>[$e->getMessage()]],422);
            }
            if($e instanceof ValidatorException){
                return response($e->getMessageBag(),422);
            }
        }
    }

    /**
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail('update');
            return $this->repository->updatePermission($request->all(),$id);
        } catch (ValidatorException $e) {
            return response($e->getMessageBag(),422);
        }

    }

    /**
     * @param $id
     *
     * @return int
     */
    public function destroy($id)
    {
        return intval($this->repository->delete($id));
    }

}