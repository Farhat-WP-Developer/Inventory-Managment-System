<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{

    // show all record of the stock on dashboard
    public function index(Request $request)
    {
        $posts_data = DB::table('products')
        ->select('id','name', 'in', 'out', 'on_hand')
        ->get();
        // ->paginate(2);
        // return view('admin.dashboard',['inventory' =>  $inventory]);
        return view('admin/dashboard', ['posts_data' => $posts_data]);

        // return view('admin/dashboard');
    }

    // public function Index(Inventory $post)
    // {
    //     $posts_data = Inventory::all();
    //     return view('admin/dashboard', ['posts_data' => $posts_data]);
    // }
   
  
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'inv_name' => 'required|max:255',
    //         'int_in' => 'required|integer',
    //         'int_out' => 'required|integer',
    //         'int_on_hand' => 'required|integer'

    //     ]);

    //     $invent = new Inventory;
    //     $invent->name = $request->inv_name;
    //     $invent->in = $request->int_in;
    //     $invent->out = $request->int_out;
    //     $invent->on_hand = $request->int_on_hand;
    //     $invent->save();
    //     return redirect('add_record')->with('success', 'Item added successfully!');

    // }

//-------------------------------------------------------------------------------------
    // add new record row
    public function store(Request $request)
    {
        $post = new Inventory;
        $post->name = $request->get('inv_name');
        $inv_in = $request->get('int_in');
        $post->in = $inv_in;
        $inv_out = $request->get('int_out');
        $post->out = $inv_out;
        // $total = $request->get('int_on_hand');
        $post->on_hand = $inv_in;
        
        $post->save();
        return redirect('admin/dashboard');  
    }
//----------------------------------------------------------------------------------------
    // edit the incoming inventory 
     public function edit(Inventory $inventory, $id)
    {
        $posts =  Inventory::find($id);
        return view('admin/edit', ['posts' => $posts]);
    }
 
    public function update(Request $request, Inventory $inventory,$id)
    {
        $posts = Inventory::find($id);
        $posts->name = $request->get('inv_name'); //get  name of inventory from form
        //get  incoming qty of inventory from form
        $inv_in = $request->get('inv_in');
        $posts->in = $inv_in;
        // $inv_out = $request->get('inv_out');
        // $posts->out = $inv_out;
        // $total = $inv_in +  $inv_out;
        // $posts->on_hand = $total;
        
         // add the incoming inv to the total(on hand)
         $posts->on_hand +=  $inv_in;
         $posts->save();
         return redirect('admin/dashboard');
    }
//-----------------------------------------------------------------------------------------------  

    // edit the outgoing inventory
    public function outInventory(Request $request,Inventory $inventory, $id)
    {
        $posts =  Inventory::find($id);
        return view('admin/out_inv', ['posts' => $posts]);

    }

    // update the total and outgoing inventory
    public function outInventoryUpdate(Request $request,Inventory $inventory, $id)
    {
        $posts = Inventory::find($id);
        $posts->name = $request->get('inv_name');
        
        $inv_out = $request->get('inv_out');
        $posts->out = $inv_out;
        // subtract outgoing from on hand inventory
        $posts->on_hand -=  $inv_out;
        $posts->save();
        return redirect('admin/dashboard');   
    }
//-----------------------------------------------------------------------------------------------  

}
