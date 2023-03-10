<?php
namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\TotalInventories;
use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TruckController extends Controller
{
    public function index()
    {
        // $categories = Products::all();
        return view("admin/truck_load");
    }

    public function store_truck(Request $request)
    {
        //  dd( $request->all());
        $post = new Truck();
        $post->driver_name = $request->get("drvr_name");
        $post->trk_name = $request->get("trk_name");
        $post->trk_number = $request->get("trk_nmbr");
        $trk_number = $post->trk_number;
        $post->pilots = $request->get("pilots");
        $post->shells = $request->get("shells");
        $post->empty = $request->get("empty");
        $post->save();
        return redirect("admin/addProduct");
    }

    public function addProductShow()
    {
        $products = TotalInventories::all();
        $prdcts = Products::all();
        return view("admin/add_products", compact("products", "prdcts"));
    }

    public function addProduct(Request $request)
    {
        $pro = new Products();
        $latestTrkNumber = Truck::latest()->first();
        $product_code = $request->get("product_code");
        $invent = TotalInventories::where("pro_code", $product_code)->first();

        // $trkInProductsTable = Products::where('trk_number', $latestTrkNumber );
        // dd($trkInProductsTable);

        $pro->trk_number = $latestTrkNumber->trk_number;
        $pro->pro_id = $request->get("product_code");
        $pro->in = $request->get("quantity");

        if ($invent) {
            $pro->name = $invent->pro_name;
            $invent->total_qty += $request->get("quantity");
        }
        $pro->save();
        $invent->save();
        return redirect()->back();
    }
}
