<?php

namespace App\Http\Controllers\API;

use App\Http\Criteria\Menu\ApiListCriteria;
use App\Http\Presenters\Menu\ApiListPresenter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Validators\MenuValidator;
use App\Http\Repositories\MenuRepository;
use Prettus\Validator\Exceptions\ValidatorException;

class MenuController extends Controller
{
    protected $repository;
    protected $validator;

    /**
     * MenuController constructor.
     *
     * @param MenuRepository $repository
     * @param MenuValidator  $validator
     */
    public function __construct(MenuRepository $repository,MenuValidator $validator)
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
            return $this->repository->create($request->all());
        } catch (ValidatorException $e) {
            return response($e->getMessageBag(),422);
        }
    }

}