<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Accessory;
use App\Models\Type;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Dd;
use App\Models\Images;

class Accessories extends Controller
{


    public function index(Request $request)
    {

        $tile = 'Accessories';
        $types = Category::all();
        $query = Accessory::query();
        if (isset($request->title) && ($request->title != null)) {
            $query->where('name', 'like', '%' . $request->title . '%');
        }
        if (isset($request->type) && ($request->type != null)) {
            $query->where('type_id', '=', $request->type);
        }
        if (isset($request->min) && ($request->min != null)) {
            $query->where('price', '>=', $request->min);
        }
        if (isset($request->max) && ($request->max != null)) {
            $query->where('price', '<=', $request->max);
        }
        // $accessories = $query->get();
        $accessories = $query->paginate(7);
        return view('admins.accessory.index', compact('accessories', 'types', 'tile'));
    }

    public function storeAccessories(Request $request)
    {

        $accessory = new Accessory;
        $request->validate([
            'name' => 'string|required|',
            'use' => 'string|required|',
            'price' => 'required|',
            'type_id' => 'int|required|',
            'image.*' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:5120',
        ]);

        $accessory->name = $request->input('name');
        $accessory->price = $request->input('price');
        $accessory->use = $request->input('use');
        $accessory->type_id = $request->input('type_id');
        $accessory->description = $request->input('description');
        $accessory->save();
        foreach ($request->image as $value) {
            $Images = new Images;
            $Images['name'] = time() . '.' . $value->getClientOriginalName();
            $value->move(public_path('/images/product/'), $Images['name']);
            $Images['product_id'] = $accessory->id;
            $Images->save();
            $imageNams[] = $Images['name'];
        }

        return redirect()->back()->withSuccess('You have successfully upload image.')->with('image', $imageNams);
    }


    public function updateAccessories(Accessory $accessory, Request $request)
    {
        // return $request;
        $accessory = Accessory::find($accessory->id);
        $request->validate([
            'name' => 'string|required|',
            'use' => 'string|required|',
            'price' => 'required|',
            'type_id' => 'int|required|',
            'image.*' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:5120',
        ]);
        $accessory->name = $request->input('name');
        $accessory->price = $request->input('price');
        $accessory->use = $request->input('use');
        $accessory->type_id = $request->input('type_id');
        $accessory->description = $request->input('description');

        $Images = Images::all()->where('product_id', '=', $accessory->id);
        foreach ($Images as $value) {
            $value->delete();
        }

        foreach ($request->image as $value) {
            $Images = new Images;
            $Images['name'] = time() . '.' . $value->getClientOriginalName();
            $value->move(public_path('/images/product/'), $Images['name']);
            $Images['product_id'] = $accessory->id;
            $Images->save();
            $imageNams[] = $Images['name'];
        }

        if ($accessory->save()) {
            return redirect()->back()->withSuccess('You have successfully update assessories.')->with('image', $imageNams);
        }
    }

    public function editAccessories(Accessory $accessory)
    {
        $accessory->save();
        $category  = Category::all();
        return view('admins.accessory.editAccessories', compact('accessory', 'category'));
    }

    public function deleteAccessories(Accessory $accessory)
    {
        $Carts = Cart::all()->where('accessory_id','=',$accessory->id);
        $Orders = OrderItem::all()->where('accessory_id','=',$accessory->id);
        if(!$Carts->isEmpty()||!$Orders->isEmpty()){
            return redirect(route('adminAccessories'))->with('errors', 'The product exists in the shopping cart or order ');
        }else{
            $Images = Images::all()->where('product_id', '=', $accessory->id);
            foreach ($Images as $value) {
                $value->delete();
            }
            $accessory->delete();

            return redirect(route('adminAccessories'))->with('success', 'Delete Product Success');
        }


    }

    public function userAccessory(Request $request)
    {
        $types = Category::all();

        $query = Accessory::latest();
        if (isset($request->title) && ($request->title != null)) {
            $query->where('name', 'like', '%' . $request->title . '%');
        }
        if (isset($request->type) && ($request->type != null)) {
            $query->where('type_id', '=', $request->type);
        }
        if (isset($request->min) && ($request->min != null)) {
            $query->where('price', '>=', $request->min);
        }
        if (isset($request->max) && ($request->max != null)) {
            $query->where('price', '<=', $request->max);
        }
        $accessories = $query->paginate(7);
        $counts = Accessory::count();
        return view('clients.shop', compact('accessories', 'types', 'counts'));
    }



    public function singleAccessory($id)
    {

        $accessory = Accessory::Join('categories', 'accessories.type_id', '=', 'categories.id')
            ->select('accessories.*', 'categories.name as name_type')
            ->where('accessories.id', '=', $id)
            ->get();
        $accessory = $accessory[0];
        // return  $accessory['0'];
        $accessories = Accessory::all();
        return view('clients.detail_product', compact('accessory', 'accessories'));
    }

    public function ListOrder()
    {
        $title = 'Dashboard';
        $say = 'Hello Admin ! Good Luck';
        // $orders = Order::all();
        $orders = Order::Join('users', 'orders.customer_id', '=', 'users.id')
        ->select('orders.*', 'users.name as userName')
        ->get();
        // return $orders;
        $countorders = Order::count();
        return view('admins.listOrder', compact('orders', 'countorders', 'title', 'say'));
    }

    public function ViewOrder(Order $Order)
    {
        $title = 'View Order';
        $say = 'Hello Admin ! Good Luck';
        // $orders = Order::all();
        $ListOrders = OrderItem::Join('accessories', 'order_items.accessory_id', '=', 'accessories.id')
        ->select('order_items.*', 'accessories.name as accessoriesName')->where('order_items.order_id','=',$Order->id)
        ->get();
        // return $ListOrders;
        return view('admins.viewOrder', compact('ListOrders', 'title', 'say'));
    }

    public function changeStatus(Order $Order)
    {
        // Order::where('id',$Order->id)->update([
        //     'status' => 1
        // ]);
        $Order->status=(int)1;
        $Order->save();

        return redirect(route('ListOrder'))->with('success', 'Changer Status Success');
    }

    public function createAccessories()
    {

        $category = Category::all();
        return view('admins.accessory.createAccessories', compact('category'));
    }
}
