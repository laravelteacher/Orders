<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;

class ordersController extends Controller
{
    // by this function we get all data from table
 public function index()
 {
     $posts = order::orderBy('order','ASC')->get();

     return view('Order',compact('posts'));
 }

 // this function update all data and orders accordin put or pull to frontend

 public function update(Request $request)
 {
     $posts = order::all();

     foreach ($posts as $post) {
         foreach ($request->order as $order) {
             if ($order['id'] == $post->id) {
                 $post->update(['order' => $order['position']]);
             }
         }
     }
     
     return response('Update Successfully.', 200);
 }

}
