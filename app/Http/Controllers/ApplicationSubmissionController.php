<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ApplicationSubmission;

use App\Models\User;

use App\Models\Notification;

use Vimeo\Laravel\Facades\Vimeo;

use Vimeo\Laravel\VimeoManager;

use Auth;

class ApplicationSubmissionController extends Controller
{



    public function update_application(Request $request)
    {
        # code...

        // return $request->all();

        $user_id = $request->user()->id;
        $user_name = $request->user()->name;
        $user_email = $request->user()->email;
        $user_code = $request->user()->usercode;


      


        if ($request->mode == 'avatar') {
            # code...

            try {


                $request->validate([

                    'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:50000',
                    
                ]);
        
                $doc = $request->file('avatar');
        
                $new_name = rand().".".$doc->getClientOriginalExtension();
                
                $file1 = $doc->move(public_path('avatars'), $new_name);


                $user_avatar = User::find($user_id)->update([
                    'avatar' => config('app.url').'avatars/'.$new_name
                ]);
        

                
                return $user_avatar;
                 
            } catch (\Throwable $th) {
                //throw $th;

                return $th;
            }
        }

        if ($request->mode == 'video') {
            # code...

            try {


                $request->validate([
                    'video' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm|max:50000',
                    
                ]);
        
        
                // $data = Vimeo::upload($request->video,[
                //     'name' => $user_name.'- ' .$user_code,
                //     'description' => $user_email.'- ' .$user_code,
                // ]);

                // // $vvv = $data['data'];


                // $applicaiton = ApplicationSubmission::where('user_id', $user_id)->update([
                //     'video_id' => $data
                // ]);


                $doc = $request->file('video');
        
                $new_name = rand().".".$doc->getClientOriginalExtension();
                
                $file1 = $doc->move(public_path('videos'), $new_name);


                $applicaiton = ApplicationSubmission::where('user_id', $user_id)->update([
                    'video_id' => config('app.url').'videos/'.$new_name
                ]);
        
                
        
        
                return $datax = [
                    'data' => $data??'',
                    'application' => $applicaiton
                ];



            } catch (\Throwable $th) {
                //throw $th;

                return $th->errors();
            }
        }

        else{
            # code...



            // return $request->all();


                try {
                    
                        
                        $applicationx = 
                        ApplicationSubmission::where('user_id', $user_id)->updateOrCreate([
                            'user_id' => $user_id
                        ],[

                            'nationality' => $request->nationality,
                            'state' => $request->state,
                            'address' => $request->address,
                            'dob' => $request->dob,
                            'under_contract' => $request->under_contract,
                            'contract_duration' => $request->contract_duration,
                            'health_condition' => $request->health_condition,
                            'health_condition_desc' => $request->health_condition_desc,
                            'guardian_name' => $request->guardian_name,
                            'guardian_phone' => $request->guardian_phone,
                            'guardian_address' => $request->guardian_address
                          
            
                        ]);
            
            
                        Notification::create([
                            'user_id' => 1001,
                            'title' => 'New Application',
                            'message' => 'Application successfully submitted by '. $user_name.' with email: '.$user_email
                        ]);
            
                        Notification::create([
                            'user_id' => $user_id,
                            'title' => 'Successful Application',
                            'message' => 'Your application ['.$user_code .'] - video clip, and bio data - have been submitted successfully'
                        ]);


                        return $applicationx;



        
                } catch (\Throwable $th) {
                    //throw $th;


                    return $th;
                }



        }


    }


    public function playersData(Request $request)
    {

        if ($request->player_code) {
            # code...


            $userData = User::with('profile')->where('usercode', $request->player_code)->first();


            return $userData;



        }



        if ($request->mode == 'all') {


            
            $userData = User::with('profile')->latest()->get();


            return $userData;

        # code...
        }else {

            try {
                $userDatax = User::with('profile')->find($request->user()->id);
    
    
                return $userDatax;
                //code...
            } catch (\Throwable $th) {
                //throw $th;

                return $th;
            }


            # code...
        }




        

        
    }
    


    
}
