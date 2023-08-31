<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\order\Order;
use App\Models\order\Orders;
use App\Models\order\detail\Details;
use App\Models\product\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use DateTime;

class DashboardControllers extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // Index View and Scope Data
    public function index()
    {
        $yearz = date('Y');
        $monthz = date('m');

        $month = range(1,12);

        // RETURN DATA
        $data['title'] = "Dashboard";

        // RETURN VIEW
        return view('dashboard', $data);
    }
}
