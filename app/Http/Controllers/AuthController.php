<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use User;



class AuthController extends Controller
{

    //
    /* login  user function */
   public function login()
   {
       return view("login");
   }

   public function loginUser(Request $req,Post $post)
    {

        $ValidateData = $req->validate
       (
            [
                'email'=>'required|email',
                'password'=>'required|max:8|max:8',
            ]
       );


       $Post = Post::where('email','=', $req->email)->first();

        if($Post)
       {
         if(Hash::check($req->password,$Post->password)){
                $req->session()->put('loginId',$Post->id);
                return redirect('show')->with('status','Successfully logins');

         }else{
            return back()->with('fail','password is not match');
         }
       }
       else
        {
            return back()->with('fail','this email is not validate');
        }


    }


   /*registration user function */
   public function registraton()
   {
        $countries = Country::get(["name","id"]);
        return view("registraton",compact('countries'));
   }



   /*Register user Function*/
   public function registerUser(Request $req )
   {
     //dd($req->all() );
        $ValidateData = $req->validate
        (
           [
                'email'=>'required|email|unique:posts',
                'password'=>'required|max:8|max:8',
                // 'hobby'=>'required',

            ]
        );


        $posts =new Post();


        $posts->email =$req->email;

        $posts->password = Hash::make($req->password);
        $posts->post_title=$req->post_title;
        $posts->post_author=$req->post_author;
        $posts->post_address=$req->post_address;
        $posts->number=$req->number;
        $posts->country=$req->country;
        $posts->state=$req->state;
        $posts->city=$req->city;
        $posts->gender=$req->gender;
        // $posts->hobby=$req->hobby;
        $posts->hobby=json_encode($req->hobby);

        // if(isset($_POST['hobby[]']))
        // {
        //     $hobbys = $req->checkbox('hobby[]');
        //     echo $hobbys;
        // }


        if ($req->has('image'))
        {
            $file = $req->file('image');
            $extention = $file->clientExtension();
            $filename = time() . '.' . $extention;
            $destinationPath = public_path('public/images/');
            $file->move($destinationPath, $filename);
            $posts->image = $filename;
        }
        $posts->save();
        return redirect("registraton");
    }

    public function logout(Request $req)
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }


    // Display Country,State and City based on a user selection//
    public function getState(Request $request)
    {
        $post['states'] = State::where("country_id",$request->country_id)->get(["name","id"]);
        return response()->json($post);
    }

    public function getCity(Request $request)
    {
        $post['cities'] = City::where("state_id",$request->state_id)->get(["name","id"]);
        return response()->json($post);
    }

   public function show(Post $post)
    {
        $posts=Post::all();
        return view('show',['posts'=>$posts]);
    }



}
