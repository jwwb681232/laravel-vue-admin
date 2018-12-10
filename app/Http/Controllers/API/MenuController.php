<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Menu\StoreRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * MenuController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function store(StoreRequest $request)
    {
        return $request->all();
    }

}
