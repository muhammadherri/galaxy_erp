<?php

namespace App\Http\Controllers\Api;

use App\Helper\responapi\responapi;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Response;


class LoginController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
    }

    public function logout(Request $request){
        try {

            $user =  User::where('api_token', $request->header('apitoken'))->first();
            $api_token = User::find($user->id);

            // Make sure you've got the model
            if($api_token) {
                $api_token->api_token = null;
                $api_token->save();

                return responapi::success([
                    'message' => 'Token Revoked',
                    'user' => $api_token->api_token,
                ],'Token Revoked', 200);
            }

        }catch(Exception $error){
            return responapi::error([
                'message' => 'Something went wrong',
                'error' => $error->getMessage(),
            ],'Authentication Failed', 401);
        }
    }
    public function login(Request $request)
    {

        try {
            $validated = $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);
            $user = User::where('users.userID', $request->username)->first();
            if ( ! Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Invalid Credentials');
            }

            $Token = User::where('name', '=', $user->name)->first();
            // dd($Token);

            // $client = new Client(); //GuzzleHttp\Client

            // $url = "http://192.168.1.210:8082/api/images/".$user->userID;
            // $response = $client->request('GET', $url, [
            //     'verify'  => false,
            // ]);

            // $body = json_decode($response->getBody(), true);

            if($Token->api_token == null){
                if($Token) {
                    $Token->api_token = crypt($Token->name, 'api_galaxy_token');
                    $Token->save();
                }
                return responapi::success([
                    'access_token' => $Token->api_token,
                    'user' => $Token,
                    // 'users_detail' => $body['users_detail']
                ],'Authenticated', 200);
            }else{
                return responapi::success([
                    'access_token' => $user->api_token,
                    'user' => $user,
                    // 'users_detail' => $body['users_detail']
                ],'Authenticated', 200);
            }


        } catch (Exception $error) {
            return responapi::error([
                'message' => 'Something went wrong',
                'error' => $error->getMessage(),
            ],'Authentication Failed', 401);
        }
    }

    public function changepass(Request $request)
    {
        try{
            $user = Auth::guard('api')->user();
            $password = $request->get('password');
            Log::debug($password);
            $user = User::where('user_id', $user->user_id)
                ->first();
            if($user){
                $user->user_password = bcrypt($password);
                if ($user->save()) {
                    return responapi::success([
                        'status' => 'success',
                        'message' => $user,
                    ], 'Succesfull', 201);
                }else{
                    return responapi::error([
                        'status' => 'Error',
                        'message' => 'Failed Change Pass',
                    ], 'Bad Request', 401);
                }
            }
        } catch (Exception $eror){
            return responapi::error([
                'status' => 'Error',
                'message' => 'Credentials',
            ], 'Bad Request', 401);
        }
    }

}
