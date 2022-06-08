<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Vimeo\Laravel\Facades\Vimeo;

use Vimeo\Laravel\VimeoManager;

use App\Models\ApplicationSubmission;

use Auth;

class VimeoController extends Controller
{
    //

    public function getMovies(Request $request)
    {
        
        $data = Vimeo::request('/me/videos', ['per_page' => 10], 'GET');


        return $data;
    }

    public function uploadVideo(Request $request, VimeoManager $vimeo)
    {

        $request->validate([
            'video' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm|max:50000',
            // 'amount' => 'required|numeric|min:99700|between:0,99.99',
            // 'number_of_accounts' => 'required|numeric|min:1|max:15',
            // 'featured_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:50000',
            
        ]);

        // dd($request->file('video')->getPath());


        
        // $data = Vimeo::request('/me/videos', ['per_page' => 10], 'GET');

        // $data = Vimeo::upload($request->file('video'));

        $data = $vimeo->upload($request->video,[
            'name' => 'name',
            'description' => 'description'
        ]);

        ApplicationSubmission::where('user_id', $request->user()->id)->update([
            'video_id' =>  trim($data['data'], '/'.'videos/')
        ]);



        return $data;
    }


}
