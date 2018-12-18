<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepository;
use App\Http\Criteria\User\ApiListCriteria;
use App\Http\Presenters\User\ApiListPresenter;
use App\Http\Validators\UserValidator;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class UserController extends Controller
{
    protected $repository;
    protected $validator;

    /**
     * MenuController constructor.
     *
     * @param UserRepository $repository
     * @param UserValidator $validator
     */
    public function __construct(UserRepository $repository,UserValidator $validator)
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