<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\product\Product;
use App\Models\category\Category;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
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

    // Create View Data
    public function create()
    {
        $data['title'] = "Add Products";
        $data['url'] = 'store';
        $data['disabled_'] = '';
        $data['categories'] = Category::orderBy('category', 'asc')->get();
        return view('product.create', $data);
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
