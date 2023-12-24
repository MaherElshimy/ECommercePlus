<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth ;

use App\Models\User ;
use App\Models\Product ;
use App\Models\Cart ;
use App\Models\Order ;
use App\Models\Comment ;
use App\Models\Reply ;

use Session;
use Stripe;

use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{

     /**
     * Show the home page for users.
     *
     * @return \Illuminate\View\View
     */

    public function index() {
        $product = Product::paginate(6);
        $comment = Comment::orderby('id','desc')->get();
        $reply = Reply::all();
        return view('home.userpage',compact('product','comment','reply'));
    }


    /**
     * Redirect users based on their user type.
     *
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



    /**
     * Display details of a product.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */

    public function product_details($id) {
        $product = Product::find($id);
        return view('home.product_details', compact('product'));
    }





        /**
     * Add a product to the shopping cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function add_cart(Request $request ,$id) {
        if (Auth::id())
        {
            $user = Auth::user();  // NTA KDA M3AK NAME USER ALE 3AMEL LOGIN
            $product = Product::find($id);
            $userid =$user->id ;
            $product_exist_id = Cart::where('Product_id','=',$id)->where('User_id','=',$userid)->get('id')->first();


            if ($product_exist_id)
            {
                $cart = Cart::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;

                if ($product->discount_price!=NULL) {
                    $cart->price= $product->discount_price * $cart->quantity;
                }
                else {
                    $cart->price= $product->price * $cart->quantity;
                }

                $cart->save();
                Alert::success('Product Added Successfully', 'We have addeed product to the cart');
                return redirect()->back();

            } else {
                    $cart = new Cart ;
                    $cart->name = $user->name;
                    $cart->email = $user->email;
                    $cart->phone = $user->phone;
                    $cart->address = $user->address;
                    $cart->user_id = $user->id;
                    $cart->product_title= $product->title;

                    if ($product->discount_price!=NULL) {
                        $cart->price= $product->discount_price * $request->quantity;
                    }
                    else {
                        $cart->price= $product->price * $request->quantity;
                    }

                    $cart->image= $product->image;
                    $cart->product_id= $product->id;
                    $cart->quantity= $request->quantity;

                    $cart->save();
                    Alert::success('Product Added Successfully', 'We have addeed product to the cart');
                    return redirect()->back();


                }
        }

        else {
            return redirect('login');
        }
    }


    /**
     * Show the shopping cart.
     *
     * @return \Illuminate\View\View
     */
    public function show_cart()
    {

        if (Auth::id()){

            $id= Auth::user()->id;
            $carts = Cart::where('user_id','=', $id)->get();

            return view('home.show_cart', compact('carts'));
        }

        else {
            return redirect('login');
        }
    }

    /**
     * Remove an item from the shopping cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function remove_cart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }


    /**
     * Process a cash order.
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function cash_order()
    {
        $user= Auth::user(); // KDA NTA GEBT L USER ALE FFT7 L WEBSITE
        $user_id = $user->id;

        $data = Cart::where('user_id','=', $user_id)->get();

        foreach($data as $data)
        {
            $order = new Order ;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->User_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->Product_id;

            $order->payment_status ='cash on delivery';
            $order->delivery_status ='processing';

            $order->save() ;

            $cart_id = $data->id ;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        return redirect()->back()->with('message','We have Received Your Order. We will connect with you Soon....') ;

    }

    /**
     * Display the Stripe payment page.
     *
     * @param  int  $totalPrice
     * @return \Illuminate\View\View
     */

    public function stripe($totalPrice){
        return view('home.stripe',compact('totalPrice'));
    }


    /**
     * Process a Stripe payment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $totalPrice
     * @return \Illuminate\Http\RedirectResponse
     */

    public function stripePost(Request $request , $totalPrice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => $totalPrice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks For Payment."
        ]);

        $user= Auth::user(); // KDA NTA GEBT L USER ALE FFT7 L WEBSITE
        $user_id = $user->id;

        $data = Cart::where('user_id','=', $user_id)->get();

        foreach($data as $data)
        {
            $order = new Order ;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->User_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->Product_id;

            $order->payment_status ='Paid';
            $order->delivery_status ='processing';

            $order->save() ;

            $cart_id = $data->id ;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }


        Session::flash('success', 'Payment successful!');

        return back();
    }


    /**
     * Show the user's order history.
     *
     * @return \Illuminate\View\View
     */
    public function show_order()
    {
        if (Auth::id())  // Mean if ID is exist it means there is auser logged in
        {
            $user = Auth::user();
            $user_id = $user->id;
            $data_order = Order::where('user_id','=', $user_id)->get();

            return view('home.order',compact('data_order'));
        }
        else
        {
            return redirect('login');
        }

    }


    /**
     * Cancel an order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function cancel_order($id)
    {
        $order = Order::find($id);
        $order->delivery_status="You Canceled  the order";
        $order->save();
        return redirect()->back();

    }


    /**
     * Add a comment to a product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function add_comment(Request $request)
    {
        if(Auth::id()){
            $comment = new Comment ;
            $comment->name = Auth::user()->name ;
            $comment->user_id = Auth::user()->id ;
            $comment->comment = $request->comment ;
            $comment->save();

            return redirect()->back();


        }
        else {
            return redirect('login');
        }
    }


    /**
     * Add a reply to a comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add_reply(Request $request) {

        if (Auth::id())
        {
            $reply = new Reply ;
            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->comment_id = $request->commentId;
            $reply->reply = $request->reply;
            $reply->save();

            return redirect()->back();
        } else {
            return redirect('login');
        }
    }


    public function product_search(Request $request){
        $search_Text = $request->search;
        $comment = Comment::orderby('id','desc')->get();
        $reply = Reply::all();
        $product = Product::where('title' , 'LIKE' , "%$search_Text%")-> orWhere('catagory' , 'LIKE' , "%$search_Text%")->paginate(10) ;
        return view('home.userpage',compact('product','comment','reply'));

    }



    public function products(){
        $product = Product::paginate(9);
        $comment = Comment::orderby('id','desc')->get();
        $reply = Reply::all();
        return view('home.all_product',compact('product','comment','reply'));
    }


    public function search_product(Request $request){
        $search_Text = $request->search;
        $comment = Comment::orderby('id','desc')->get();
        $reply = Reply::all();
        $product = Product::where('title' , 'LIKE' , "%$search_Text%")-> orWhere('catagory' , 'LIKE' , "%$search_Text%")->paginate(10) ;
        return view('home.all_product',compact('product','comment','reply'));

    }



}
