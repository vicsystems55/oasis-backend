<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Notification;
        
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Mail;

// use App\Mail\Welcome;

use App\Mail\EmailVerification;

use Auth;

class ApiAuthController extends Controller
{
    //

    public function register(Request $request)
    {

        try {
            //code...

                    
            $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // 'username' => 'required|string|max:255',
           
            'email' => 'required|string|email|max:255|unique:users',
            // 'referrer_code' => 'required',
            'password' => 'required|string|min:8',
            ]);


            $regCode = "OASIS" .rand(11100,999999);
                
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                // 'username' => $validatedData['username'],
                'usercode' => $regCode,
                // 'sponsors_id' => $validatedData['referrer_code'],
                'password' => Hash::make($validatedData['password']),
            ]);


            $user->update([
                'otp' => $validatedData['password']
            ]);


        // $sponsors_data = User::where('usercode', $validatedData['referrer_code'])->first();
        
        $weekNo = Carbon::now()->weekOfYear;
        
        // $referral_bonus = DirectReferral::Create([
        //     'referrer_id' => $sponsors_data->id??10001,
        //     'referree_id' => $user->id,
        //     'referrer_usercode' => $sponsors_data->usercode??'PGN22002', // usercode of your upline
        //     'referree_usercode' => $regCode,
        //     'weekInYear' => $weekNo,
            
        // ]);




        // $notification = Notification::create([
        //     'performed_by' => $sponsors_data->id??10001,
        //     'title' => "New Signup",
        //     'log' => 'Someone just signed up with your code'
        // ]);

        $notification = Notification::create([
            'user_id' => $user->id,
            'title' => "New Signup",
            'message' => 'You just signed up welcome to Leptons'
        ]);

        $datax = [
            'name' => $user->name,
            'email' => $user->email,
            'otp' => $validatedData['password']
        ];

        // try {
            //code...

            // try {
                //code...

                
            // Mail::to($user->email)
            // ->send(new Welcome($datax));



            Mail::to($user->email)
            ->send(new EmailVerification($datax));

            // } catch (\Throwable $th) {
            //     //throw $th;

                
            // }



        $token = $user->createToken('auth_token')->plainTextToken;
            
        return response()->json([
                    'access_token' => $token,
                    'user_data' => $user,
                    'token_type' => 'Bearer',
        ]);

        } catch (\Throwable $th) {
            //throw $th;

            return $th;
        }
            

    }



    public function login(Request $request)
    {
        # code...


        if (!Auth::attempt($request->only('email', 'password'))) {

            return response()->json([
            'message' => 'Invalid login details'
                       ], 401);
        }else{

            $user = User::where('email', $request['email'])->firstOrFail();
            
            $token = $user->createToken('auth_token')->plainTextToken;
            
            return response()->json([
                       'access_token' => $token,
                       'user_data' => $user,
                       'token_type' => 'Bearer',
            ]);

        }
            

    }


    public function verify_otp(Request $request)
    {
        # code...

       

        try {
            //code...

            $user = User::where('id', $request->user()->id)->where('otp', $request->otp)->first();

            if ($user) {


                return response()->json([
                    // 'access_token' => $token,
                    'user_data' => $user,
                    'token_type' => 'Bearer',
                ]);   
                
                
            }
        } catch (\Throwable $th) {
            //throw $th;

            return $th;
        }

      
    }
}
