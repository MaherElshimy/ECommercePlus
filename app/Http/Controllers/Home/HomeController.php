<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Reply;

class HomeController extends Controller
{
    /**
     * Redirect users based on their user type.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function redirect() {
        $usertype = Auth::user()->usertype ;

        if ($usertype == '1') {
            return view('admin.home');
        }
        else {
            $product = Product::paginate(6);
            $comment = Comment::orderby('id','desc')->get();
            $reply = Reply::all();
            return view('home.userpage',compact('product','comment','reply'));
        }
    }

}
