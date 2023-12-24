<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use App\Models\Catagory;
use App\Models\Product;
use App\Models\Order;

use PDF;
use Notification;
use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{
    public function view_catagory() {
        if(Auth::id())
        {
            $data = Catagory::all();
            return view('admin.catagory' , compact('data'));
        } else {
            return redirect('login');
        }
    }


    public function add_catagory(Request $request) {
        if (Auth::id()) {

        $data = new Catagory ;
        $data->catagory_name = $request -> categoryName;
        $data->save();
        return redirect()->back()->with('message' , 'Catagory Added Successfully');
        } else {
            return redirect('login');
        }
    }

    public function delete_catagory($id) {
        if (Auth::id()) {

        $data = Catagory::find($id);
        $data->delete();
        return redirect()->back()->with('message' , 'Catagory Deleted Duccessfully');
        } else {
            return redirect('login');
        }
    }



    public function view_product() {
        if (Auth::id()) {
        $catagory = Catagory::all();
        return view('admin.product' , compact('catagory'));
        } else {
            return redirect('login');
        }
    }


    public function add_product(Request $request) {
        if (Auth::id()) {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'catagory' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'discount_price' => 'numeric|nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product();

        $product->title = $request->title;
        $product->description = $request->description;
        $product->catagory = $request->catagory;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $image->move('product', $imagename);
            $product->image = $imagename;
        }

        $product->save();
        return redirect()->back()->with('message', 'Product Added Successfully');
    }  else {
        return redirect('login');
    }
    }




    public function show_product() {
        if (Auth::id()) {
        $products = Product::all();
        return view('admin.show_product' , compact('products'));
        }  else {
            return redirect('login');
        }
    }


    public function delete_product($id) {
        if (Auth::id()) {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('message' , 'Product Deleted Duccessfully');
        }  else {
            return redirect('login');
        }
    }


    public function update_product($id) {
        if (Auth::id()) {
        $product = Product::find($id);
        $catagories = Catagory::all();
        return view('admin.update_product' ,compact('product' ,'catagories'));
        } else {
            return redirect('login');
        }
    }



    public function update_product_confirm(Request $request ,$id) {
        if (Auth::id()) {
        $product = Product::find($id);
        $product->title = $request->title ;
        $product->description = $request->description;
        $product->catagory = $request->catagory;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $image = $request->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $image->move('product', $imagename);
            $product->image = $imagename;
        }

        $product->save() ;
        return redirect()->back()->with('message', 'Product Updated Successfully');
        } else {
            return redirect('login');
        }

    }


    public function order(){
        if (Auth::id()) {
        $order = Order::all();
        return view('admin.order',compact('order'));
        }  else {
            return redirect('login');
        }
    }


    public function delivered($order_id){
        if (Auth::id()) {

        $order = Order::find($order_id);
        $order->delivery_status = 'delivered';
        $order->payment_status = 'Paid';
        $order->save();
        return redirect()->back();
        } else {
            return redirect('login');
        }
    }


    public function print_pdf($order_id){
        if (Auth::id()) {
        $order_data = Order::find($order_id);
        $pdf = PDF::loadView('admin.pdf', compact('order_data'));
        return $pdf->download('order->details.pdf');
        } else {
            return redirect('login');
        }
    }



    public function send_email($id){
        if (Auth::id()) {
        $order = Order::find($id);
        return view('admin.email_info',compact('order'));
        } else {
            return redirect('login');
        }
    }



    public function send_user_email(Request $request , $id){
        if (Auth::id()) {
        $order = Order::find($id);
        $details =[
            'greeting' => $request->greeting,
            'firstline' => $request->firstline,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastline' => $request->lastline,
        ];

        Notification::send($order,new SendEmailNotification($details));
        return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    public function searchdata(Request $request){
        if (Auth::id()) {

        $searchText = $request->search;
        $order = Order::where('name' , 'LIKE' , "%$searchText")-> orWhere('phone' , 'LIKE' , "%$searchText") -> orWhere('product_title' , 'LIKE' , "%$searchText")->get() ;
        return view('admin.order',compact('order'));
        }  else {
            return redirect('login');
        }

    }

}
