<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\User\UpdateProfileRequest;
use Storage;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
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
        return User::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users|max:255',
            'bio'      => 'max:21845',
            'password' => 'required|string|between:6,20',
            'type'     => 'required',
        ]);
        return User::create(
            [
                'name'     => $request['name'],
                'email'    => $request['email'],
                'type'     => $request['type'],
                'bio'      => $request['bio'],
                'photo'    => $request['photo'],
                'password' => bcrypt($request['password']),
            ]
        );
    }

    public function profile()
    {
        $user = auth('api')->user();
        $user->photo = asset('storage'.$user->photo);
        return $user;
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = auth('api')->user();

        if (stripos($request->photo,'http') === false){
            $photoPath = convert_base64_to_file($request->photo);
            $request->request->set('photo',$photoPath);
        }else{
            $request->request->remove('photo');
        }

        if (!empty($request->password)){
            $request->request->set('password',bcrypt($request->password));
        }

        $user->update($request->request->all());
        return ['message'=>'Success'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'sometimes|string|between:6,20',
            'type'=>'required'
        ]);
        $user = User::findOrFail($id);
        $user->update($request->toArray());
        return ['message'=>'Edit Success'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return ['message'=>'User deleted'];
    }
}
