<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepository;
use App\Http\Criteria\User\ApiListCriteria;
use App\Http\Presenters\User\ApiListPresenter;

class UserController extends Controller
{
    protected $repository;

    /**
     * MenuController constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->middleware('auth:api');
        $this->repository = $repository;
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