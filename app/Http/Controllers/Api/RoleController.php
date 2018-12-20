<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/20
 * Time: 20:48
 */
namespace App\Http\Controllers\Api;

use App\Http\Criteria\Role\ApiListCriteria;
use App\Http\Presenters\Role\ApiListPresenter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Validators\RoleValidator;
use App\Http\Repositories\RoleRepository;
use Prettus\Validator\Exceptions\ValidatorException;

class RoleController extends Controller
{
    protected $repository;
    protected $validator;

    /**
     * MenuController constructor.
     *
     * @param RoleRepository $repository
     * @param RoleValidator  $validator
     */
    public function __construct(RoleRepository $repository,RoleValidator $validator)
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
            if ($e instanceof \Spatie\Permission\Exceptions\RoleAlreadyExists){
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
            return $this->repository->updateRole($request->all(),$id);
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