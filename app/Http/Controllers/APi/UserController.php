<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Image;

class UserController extends Controller
{
    public $successStatus = 200;


    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['key'] = $user->id;

            $typeUser = DB::table('type_users')
                            ->where('type_users.id', $user->typeUser_id)
                            ->select('type_users.codeTypeUser')
                            ->get();
            //dd($typeUser);                
            $success['typeUser'] = $typeUser;
            
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'login ou password incorrecte'], 401);
        }
    }


    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'matricule' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);


        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }


        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        //return $input;
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;


        return response()->json(['success'=>$success], $this->successStatus);
    }


    // /**
    //  * details api
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function details()
    // {
    //     $user = Auth::user();
    //     //dd($user);

    //     return response([
    //         'data' => $user
    //     ],Response::HTTP_CREATED);
        
    //     //return response()->json(['success' => $user], $this->successStatus);
    // }

        /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details(Request $request)
    {
        //dd($request);
        $user = DB::table('users')
                    ->join('towns', 'users.town_id', '=', 'towns.id')
                    ->join('cities', 'towns.city_id', '=', 'cities.id')
                    ->join('type_users', 'type_users.id', '=', 'users.typeUser_id')
                    ->where('users.id', $request->id)
                    ->select('users.id','users.name','users.nameMovie','users.email','users.phone','users.address','users.city_id','users.town_id','users.typeUser_id', 'users.shop_id','cities.libelleCity','towns.libelleTown', 'type_users.libelleTypeUser')
                    ->get();


        return response([
            'data' => $user
        ],Response::HTTP_CREATED);
    }

     /**
     * users api
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        $userList = DB::table('users')
            ->orderBy('users.id')
            ->get();

        //dd($userList);    
        return response([
            'data' => $userList
        ],Response::HTTP_CREATED);
        
        //return response()->json(['success' => $user], $this->successStatus);
    }

    /**
     * update user api
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUser(User $user, Request $request)
    {
        unset($request['c_password']);
        unset($request['password']);

        $image = $request->nameMovie;
        if($image)
        {
            if($user->nameMovie !== null){
                $image_path = public_path().'/images/users/'. $user->nameMovie;
                if(file_exists($image_path) === true){
                    unlink($image_path);
                }
            }
            $imageName = $request->typeUser_id.'-'.time().'.'.explode('/',explode(':',
            substr($request->nameMovie, 0, strpos($request->nameMovie, ';')))[1])[1];
            $request['nameMovie'] = $imageName;

            $location = public_path('images/users/' . $request->nameMovie);
            Image::make($image)->save($location);    
        }
        else{
            unset($request['nameMovie']);
        }
        
        $user->update($request->all());
           //return $request; 
        return response([
            'data' => $user
        ],Response::HTTP_CREATED);
        
    }
}
