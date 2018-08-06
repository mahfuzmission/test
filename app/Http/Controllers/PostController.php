<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    public function index() {
        return view('blogs');
    }

    public function save(Request $request) {
        $rules = array(
            'name'       => 'required',
            'cat'      => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('/posts')
                ->withErrors($validator);
        } else {
            // store
            $blog = new Blog;
            $blog->name       = Input::get('name');
            $blog->cat      = Input::get('cat');
            $blog->save();
           // $re = Blog::findOrFail(1); search from database
            // redirect
//            Session::flash('message', 'Successfully created blog!');
            return Redirect::to('/posts');
        }
    }
}
