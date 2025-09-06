<?php

namespace App\Http\Controllers;

use App\Interfaces\SmsGatewayInterface;
use App\Jobs\DealJob;
use App\Jobs\IDVerifyJob;
use App\Models\Deal;
use App\Models\Invoice;
use App\Models\PaymentHistory;
use App\Models\Product;
use App\Models\User;
use App\Repositories\EventRepository;
use App\Repositories\ProductRepository;
use App\Services\Api\EdfpayService;
use App\Services\Api\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected EventRepository $eventRepository, protected ProductRepository $productRepository)
    {
        $this->middleware('auth')->except(['index', 'successorfail']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    function successorfail()
    {
        return view('successorfail');
    }
}
