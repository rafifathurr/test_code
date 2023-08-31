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
        $data['title'] = "WELCOME ADMIN";

        // RETURN VIEW
        return view('dashboard', $data);
    }
}
