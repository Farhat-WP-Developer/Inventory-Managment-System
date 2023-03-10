<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\TotalInventories;
use App\Models\Truck;
use App\Models\Expenses;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get latest entry of the truck and reports table
        $latestTrkNumber = Truck::latest()->first();
        $latestReport = Expenses::latest()->first();
        // fetch data from total inventories table to select the products
        $posts_data = DB::table("total_inventories")
            ->select("id", "pro_code", "pro_name", "per_price", "per_incentive", "total_qty", "total_cost")
            ->get();
        // ->paginate(2);
        // return view('admin.dashboard',['inventory' =>  $inventory]);
        return view("admin/dashboard", ["posts_data" => $posts_data],compact('latestTrkNumber', 'latestReport'));

        // return view('admin/dashboard');
    }

    //-------------------------------------------------------------------------------------
    // add new record row

    // public function store_pro(Request $request)
    // {
    //     $post = new Products();
    //     $post->name = $request->get("inv_name");
    //     $inv_in = $request->get("int_in");
    //     $post->in = $inv_in;
    //     $inv_out = $request->get("int_out");
    //     $post->out = $inv_out;
    //     // $total = $request->get('int_on_hand');
    //     $post->on_hand = $inv_in;

    //     $post->save();
    //     return redirect("admin/dashboard");
    // }

    //----------------------------------------------------------------------------------------
    // edit the incoming inventory

    // public function edit(Products $inventory, $id)
    // {
    //     $posts = Products::find($id);
    //     return view("admin/edit", ["posts" => $posts]);
    // }

    // public function update(Request $request, Products $inventory, $id)
    // {
    //     $posts = Products::find($id);
    //     $posts->name = $request->get("inv_name"); //get  name of inventory from form
    //     //get  incoming qty of inventory from form
    //     $inv_in = $request->get("inv_in");
    //     $posts->in = $inv_in;

    //     $posts->on_hand += $inv_in;
    //     $posts->save();
    //     return redirect("admin/dashboard");
    // }


    //-----------------------------------------------------------------------------------------------

    // edit the outgoing inventory

    // public function outInventory(Request $request, Products $inventory, $id)
    // {
    //     $posts = Products::find($id);
    //     return view("admin/out_inv", ["posts" => $posts]);
    // }

    // update the total and outgoing inventory

    // public function outInventoryUpdate(
    //     Request $request,
    //     Products $inventory,
    //     $id
    // ) {
    //     $posts = Products::find($id);
    //     $posts->name = $request->get("inv_name");

    //     $inv_out = $request->get("inv_out");
    //     $posts->out = $inv_out;
    //     // subtract outgoing from on hand inventory
    //     $posts->on_hand -= $inv_out;
    //     $posts->save();
    //     return redirect("admin/dashboard");
    // }

    //-----------------------------------------------------------------------------------------------
    //   New Product get route
    public function newProductShow()
    {
        return view("admin/new_product");
    }

    //   New Product post route
    public function newProduct(Request $request)
    {
        $invent = new TotalInventories();
        $pro = new Products();
        $latestTrkNumber = Truck::latest()->first();

        // get data from "new_product blade" form to add new product when it is not available
        $code = $request->get("productCodeInput");
        $name = $request->get("productNameInput");
        $price = $request->get("productPriceInput");
        $qty = $request->get("productQuantityInput");

        //add data to total inventories table
        $invent->pro_code = $code;
        $invent->pro_name = $name;
        $invent->total_qty = $qty;
        $invent->per_price=$price;
        $invent->save();

        //add data to products table
        $pro->trk_number = $latestTrkNumber->trk_number;
        $pro->pro_id = $code;
        $pro->name = $name;
        $pro->in = $qty;
        $pro->save();

        return redirect("admin/addProduct");
    }
}
