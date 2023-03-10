<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\SalesPersons;
use App\Models\TotalInventories;
use Illuminate\Support\Facades\DB;



class SalesController extends Controller
{
    // show sales man page
    public function index()
    {
        $sales_persons = SalesPersons::all();
        return view('admin/sales_man', compact('sales_persons'));
    }

    // Add new Sales Man
    public function store(Request $request)
    {
        $sales_man = new SalesPersons;
        $name = $request->get('name');
        $phone_number = $request->get('phone_number');
        $address = $request->get('address');
        $hiring_date = $request->get('hire_date');
        $salary = $request->get('basic_salary');

        $sales_man->name = $name ;
        $sales_man->phone_number = $phone_number ;
        $sales_man->address = $address ;
        $sales_man->hire_date = $hiring_date ;
        $sales_man->basic_salary = $salary ;
        $sales_man->save();
        return redirect()->back();
    }


    // show form for sales man checkout
    public function salesShow()
    {
        $products = TotalInventories::all();
        $sales_man = SalesPersons::all();
        return view('admin.sales', compact('products', 'sales_man'));
    }

    // Save data from sales man checkout form
    public function storeSales(Request $request)
    {
        $salesMan = $request->input('salesman_id');
        $pro = $request->input('products');
        $qty = $request->input('qty');
        // $inventory = TotalInventories::all();
        $invent = TotalInventories::where('pro_code', $pro)->first();

        // if($qty === null) {
        //     $qty = array_fill(0, count($pro), 0);
        // }
        if($invent)
        {
        foreach($pro as $key => $p)
        {
            $product = ['sales_man_id' => $salesMan, 'product_code' => $p,'product_name' => $invent->pro_name,'stock_out' => $qty[$key]];
            Sales::create($product);
        }
    }
}
}
