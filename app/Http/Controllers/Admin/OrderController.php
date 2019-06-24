<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use DataTables;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        if (! Gate::allows('orders')) {
            return abort(401);
        }
        
        return view('admin.orders.index');
    }

    public function getOrdersData(){
        $orders = DB::table('orders as o')
                    ->leftJoin('customers as c', 'o.customer_id', '=', 'c.id')
                    ->select('c.name','o.*',DB::raw('DATE_FORMAT(o.created_at, "%d %M %Y %r") as order_date'))
                    ->get()->toArray();
        return \DataTables::of($orders)
            ->addIndexColumn()
            ->addColumn('action', function ($orders) {
                return '<a href="'. url('/admin/viewOrder/'.$orders->id).'" class="btn btn-xs btn-rpimary"><i class="glyphicon glyphicon-eye-open"></i> View</a>';
            })
            ->make(true);
    }

    public function view($order_id){
        if (! Gate::allows('orders')) {
            return abort(401);
        }
        $order_data = DB::table('orders as o')
                    ->leftJoin('customers as c', 'o.customer_id', '=', 'c.id')
                    ->leftJoin('order_items as oi', 'oi.order_id', '=', 'o.id')
                    ->leftJoin('products as p', 'p.id', '=', 'oi.product_id')
                    ->where('o.id', '=', $order_id)
                    ->select('c.name as customer_name','c.email','oi.*','o.total_amount','o.status','o.invoice_number','p.name as product_name','p.price',DB::raw('DATE_FORMAT(o.created_at, "%d %M %Y %r") as order_date'))
                    ->get()->toArray();
        return view('admin.orders.view',compact('order_data'));
    }
}
