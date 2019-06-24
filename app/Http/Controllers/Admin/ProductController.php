<?php
namespace App\Http\Controllers\Admin;

use App\Product;
use DataTables;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
 
class ProductController extends Controller
{
    public function index()
    {
        if (! Gate::allows('products')) {
            return abort(401);
        }
        
        return view('admin.products.index');
    }

    public function getProductsData(){
        $filter = (!empty($_GET["filter_value"])) ? ($_GET["filter_value"]) : ('');
        if(!empty($filter)){
            $products = Product::query();
            $products->whereRaw("products.in_stock = '" . $filter . "'");
        }else{
            $products = Product::query();
        }
        return \DataTables::of($products)
            ->addIndexColumn()
            ->make(true);
    }
}
