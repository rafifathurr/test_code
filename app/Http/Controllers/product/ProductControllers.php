<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\product\Product;
use App\Models\order\Order;
use App\Models\category\Category;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Auth;
use Session;

class ProductControllers extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Index View and Scope Data
    public function index()
    {
        return view('product.index', [
            "title" => "List Products",
            "products" => Product::with('category')->whereNull('deleted_at')->get()
        ]);
    }

    // Checkout Index
    public function checkout_index()
    {
        $id_user = Auth::user()->id;
        $check = Order::selectRaw('SUM(total_price) as total')->whereNull('deleted_at')->where('status', 0)->where('created_by', $id_user)->groupBy('invoice')->first();

        if($check == null){
            $total = 0;
        }else{
            $total = $check->total;
        }
        $id_user = Auth::user()->id;
        return view('checkout.index', [
            "title" => "List Checkout",
            "checkouts" => Order::with('product')->whereNull('deleted_at')->where('status', 0)->where('created_by', $id_user)->get(),
            "total_price" => $total
        ]);
    }

    // Create View Data
    public function create()
    {
        $data['title'] = "Add Products";
        $data['url'] = 'store';
        $data['disabled_'] = '';
        $data['categories'] = Category::orderBy('category', 'asc')->get();
        return view('product.create', $data);
    }

    // Create Order View Data
    public function create_order($id)
    {
        $products = Product::with('category')->where('id', $id)->first();
        $data['title'] = "Order Product $products->product_name";
        $data['disabled_'] = '';
        $data['products'] = $products;
        $data['url'] = 'checkout';
        return view('product.create_order', $data);
    }

    // Store Checkput View Data
    public function checkout(Request $req)
    {
        $id_user = Auth::user()->id;
        $datenow = date('Y-m-d H:i:s');
        $date = date('Y-m-d');

        $check_last_checkout = Order::where('created_by', $id_user)->where('status', 0)->first();
        $check_last_product = Order::where('created_by', $id_user)->where('status', 0)->where('product_id', $req->id)->first();

        if(is_null($check_last_checkout)){
            $invoice = mt_rand();
            $store = Order::create([
                'invoice' => $invoice,
                'date' => $date,
                'product_id' => $req->id,
                'qty' => $req->qty,
                'price' => $req->price_data,
                'total_price' => $req->price,
                'status' => 0,
                'created_by' => $id_user
            ]);
        }else{
            $invoice = $check_last_checkout->invoice;

            if(is_null($check_last_product)){
                $store = Order::create([
                    'invoice' => $invoice,
                    'date' => $date,
                    'product_id' => $req->id,
                    'qty' => $req->qty,
                    'price' => $req->price_data,
                    'total_price' => $req->price,
                    'status' => 0,
                    'created_by' => $id_user
                ]);
            }else{
                $qty_old = $check_last_product->qty;
                $total_price_old = $check_last_product->total_price;
                $qty_new = $req->qty;
                $total_price_new = $req->price;

                $cal_qty = $qty_old + $qty_new;
                $cal_price = $total_price_old + $total_price_new;
                $store = Order::where('invoice', $invoice)
                ->where('product_id', $req->id)
                ->update([
                    'date' => $date,
                    'qty' => $cal_qty,
                    'total_price' => $cal_price,
                    'status' => 0,
                    'created_by' => $id_user,
                    'updated_by' => $id_user
                ]);
            }
        }

        if($store){
            return redirect()->route('user.checkout.index')->with(['success' => 'Checkout Successfully!']);
        }else{
            return redirect()->back()->with(with(['gagal' => 'Failed Checkout!']));
        }
    }

    // Delete Data Function
    public function checkout_delete(Request $req)
    {
        $datenow = date('Y-m-d H:i:s');
        $exec = Order::where('id', $req->id )->update([
            'deleted_at'=>$datenow,
            'updated_at'=>$datenow
        ]);

        if ($exec) {
            Session::flash('success', 'Data successfully deleted!');
          } else {
            Session::flash('gagal', 'Error Data');
          }
    }

    // Store Function to Database
    public function store(Request $req)
    {
        $datenow = date('Y-m-d H:i:s');

        $product_pay = Product::create([
            'code_product' => $req->code_product,
            'product_name' => $req->product_name,
            'category_id' => $req->category,
            'price' => $req->price,
            'stock' => $req->stock,
            'capacity' => $req->capacity,
            'weight_total' => $req->weight_total,
            'height' => $req->height,
            'width' => $req->width,
            'radius' => $req->radius,
            'rating' => $req->rating,
            'created_at' => $datenow
        ]);

        $destination='Uploads/Product/';
        if ($req->hasFile('uploads')) {
            $file = $req->file('uploads');
            $name_file = time().'_'.$req->file('uploads')->getClientOriginalName();
            Storage::disk('Uploads')->putFileAs($destination,$file,$name_file);
            Product::where('id', $product_pay->id)->update(['upload' => $name_file]);
        }

        return redirect()->route('admin.product.index')->with(['success' => 'Data successfully stored!']);

    }

    // Detail Data View by id
    public function detail($id)
    {
        $data['title'] = "Detail Products";
        $data['disabled_'] = 'disabled';
        $data['url'] = 'create';
        $data['products'] = Product::where('id', $id)->first();
        $data['categories'] = Category::all();
        return view('product.create', $data);
    }

    // Edit Data View by id
    public function edit($id)
    {
        $data['title'] = "Edit Products";
        $data['disabled_'] = '';
        $data['url'] = 'update';
        $data['products'] = Product::where('id', $id)->first();
        $data['categories'] = Category::all();
        return view('product.create', $data);
    }

    // Update Function to Database
    public function update(Request $req)
    {
        date_default_timezone_set("Asia/Bangkok");
        $datenow = date('Y-m-d H:i:s');

        $product_pay = Product::where('id', $req->id)
        ->update([
            'code_product' => $req->code_product,
            'product_name' => $req->product_name,
            'category_id' => $req->category,
            'price' => $req->price,
            'stock' => $req->stock,
            'capacity' => $req->capacity,
            'weight_total' => $req->weight_total,
            'height' => $req->height,
            'width' => $req->width,
            'radius' => $req->radius,
            'rating' => $req->rating,
            'updated_at' => $datenow
        ]);

        $destination='Uploads/Product/';
        if ($req->hasFile('uploads')) {
            $file = $req->file('uploads');
            $name_file = time().'_'.$req->file('uploads')->getClientOriginalName();
            Storage::disk('Uploads')->putFileAs($destination,$file,$name_file);
            Product::where('id', $product_pay->id)->update(['upload' => $name_file]);
        }

        return redirect()->route('admin.product.index')->with(['success' => 'Data successfully updated!']);
    }

    // Delete Data Function
    public function delete(Request $req)
    {
        date_default_timezone_set("Asia/Bangkok");
        $datenow = date('Y-m-d H:i:s');
        $exec = Product::where('id', $req->id )->update([
            'deleted_at'=>$datenow,
            'updated_at'=>$datenow
        ]);

        if ($exec) {
            Session::flash('success', 'Data successfully deleted!');
          } else {
            Session::flash('gagal', 'Error Data');
          }
    }

    public function detailproduct(Request $req)
    {
        $data = Product::with('category')->where("id", $req->id_prod)->first();
        return $data;
    }
}
