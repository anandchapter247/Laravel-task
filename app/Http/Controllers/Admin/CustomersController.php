<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use DataTables;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;

class CustomersController extends Controller
{
    public function index()
    {
        if (! Gate::allows('customers')) {
            return abort(401);
        }
        
        return view('admin.customers.index');
    }

    public function getCustomersData(){

        $customers = Customer::query();
        return \DataTables::of($customers)
        ->editColumn('created_at', function ($customers) {
            $date_format = date('d F Y',strtotime($customers->created_at));
            return $date_format;
        })->addIndexColumn()
        ->make(true);
    }
}
