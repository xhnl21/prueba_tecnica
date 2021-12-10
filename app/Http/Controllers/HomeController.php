<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\products;
use App\Models\system_status;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        return view('home', compact('user'));
    }
    public function form(Request $request)
    {
        $request -> validate([
            'dni' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'age' => 'required',
            'birth_date' => 'required',
        ]);
        $data = [
            'id' => $request['id'],
            'dni' => $request['dni'],
            'name' => $request['name'],
            'last_name' => $request['lastname'],
            'surname' => $request['surname'],
            'second_surname' => $request['second_surname'],	
            'birth_date' => $request['birth_date'],
            'age' => $request['age'],
            'telephone' => $request['telephone'],
            'address' => $request['address'],
            'status' => 1
        ];
        $user = Auth::user();
        $date = true;
        $msj = '';
        if($data['age'] < 18) {
            $date = false;
            $msj = "It is not possible to register a person under 18";
        }
        if($data['age'] > 65) {
            $date = false;
            $msj = "It is not possible to register a person over 65 years of age";            
        }
        if($date) {
            User::where('id', $data['id'])
            ->update([
                'dni' => $data['dni'],
                'name' => $data['name'],
                'last_name' => $data['last_name'],
                'surname' => $data['surname'],
                'second_surname' => $data['second_surname'],
                'birth_date' => $data['birth_date'],
                'age' => $data['age'],
                'telephone' => $data['telephone'],
                'address' => $data['address'],
                'status' => $data['status'],                       
            ]);
            $msj = "Saved Data";   
            return back()->with('msj', $msj);         
        } else {
            return back()->with('message', $msj);
        }
    } 
    public function listProducts($a = false)
    {
        $pro = products::orderBy('id', 'desc')->get();
        $products = [];
        $count = count($pro);
        if(count($pro) > 0) {
            $cont = 0;
            foreach($pro as $i){
                $type = system_status::where('idx', $i->product_type)
                ->where('modul', 'products')->first();
                $user = User::where('id', $i->user_id)->first();
                $price = ($i->product_quantity * $i->product_price);
                $i->id = $i->id;
                if(!empty($user->last_name)){
                    $i->user_id = $user->name.' '.$user->last_name;
                } else {
                    $i->user_id = $user->name;
                }
                $i->product_name = $i->product_name;
                $i->product_type = $type->nameStatus;
                $i->product_price = number_format($i->product_price, 2, ".", ",");
                $i->product_quantity = $i->product_quantity;
                $i->price = number_format($price, 2, ".", ",");
                $i->status = $i->status;
                $products[$cont]=$i;
                $cont++;                
            }
        }
        if($a) {
            return $products;
        } else {
            return view('LayoutsDashboard.listProducts', compact('products', 'count'));
        }
    }
    public function listForm()
    {
        $user = Auth::user();
        $products = [];
        return view('LayoutsDashboard.listForm', compact('products', 'user'));
    }
    public function formProducts(Request $request) {
        $request -> validate([
            'product_name' => 'required',
            'product_quantity' => 'required',
            'product_price' => 'required',
        ]);
        $data = request()->all(); 
        $dat = [
            'product_name' =>  $data['product_name'],
            'product_type' =>  $data['product_type'],
            'product_quantity' =>  $data['product_quantity'],
            'product_price' =>  $data['product_price'],
            'user_id' => $data['user_id'],
            'status' => $data['status'],
        ];
        if ($data['id'] > 0) {
            products::where('id', $data['id'] )->update($dat);
        } else {
            products::create($dat);
        }
        $products = $this->listProducts(true);
        $count = count($products);
    	return view('LayoutsDashboard.listProducts',compact('products', 'count'));
    }    
    public function edit($id) {
        $user = Auth::user();
        $r = products::where('id', $id)->first();
        $r->price = ($r->product_quantity * $r->product_price);
        return view('LayoutsDashboard.listForm', compact('r', 'user'));        
    }
    public function delete($id) {
        products::where('id', $id)->delete();   
        $products = $this->listProducts(true);
        $count = count($products);
        return view('LayoutsDashboard.listProducts', compact('products', 'count'));        
    } 
    
    public function profile()
    {
        $user = Auth::user();
        return view('LayoutsDashboard.profile', compact('user'));
    }  
    public function security()
    {       
        $user = Auth::user();
        return view('LayoutsDashboard.security', compact('user'));
    }
    public function savedSecurity(Request $request)
    {
        $u = User::where('id', $request['id'])->first();
        if($u->password == $request['password']){
            $msj = "Saved Data";   
            return back()->with('msj', $msj);              
        } else {
            $rules = [
                'password' => 'min:5|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'min:5'
            ];
            $messages = [
                'password.same' => 'Password and confirmation must match.',
                'password_confirmation.same' => 'Password and confirmation must match.',
            ];
            $request -> validate($rules, $messages);
            $data = request()->all();
            $updateUser= User::where('id', $data['id'])
            ->update([
                'password' => Hash::make($data['password']),
                'created_at' => $u->created_at              
            ]);
            if($updateUser){
                $msj = "Saved Data";   
                return back()->with('msj', $msj); 
            } 
        }
    }            
}
