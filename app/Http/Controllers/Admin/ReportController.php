<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\RequestProductionRepository;
use App\Repositories\TransactionRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ReportController extends Controller
{
    public function showOrder():Response
    {
        return response()->view("admin.reports.order");
    }

    public function generateOrder()
    {
        $orders = (new OrderRepository())
            ->where("status", OrderStatus::COMPLETED())
            ->whereMonth("created_at", "=", request()->get("month"))
            ->whereYear("created_at", "=", request()->get("year"))
            ->getAllData();

        if(!$orders || $orders->count()===0){
            return redirect()->back()->withErrors(["errors" => "Data transaksi pada bulan tersebut tidak ditemukan"])->withInput();
        }

        $pdf = Pdf::loadView('admin.reports.report-order', [
            'orders' => $orders,
        ]);

        return $pdf->stream();
    }

    public function showProduct():Response
    {
        $products = (new ProductRepository())
            ->getAllData();

        $pdf = Pdf::loadView('admin.reports.report-product', [
            'products' => $products,
        ]);

        return $pdf->stream();
    }

    public function showRequestProduction():Response
    {
        $requestProducts = (new RequestProductionRepository())->where("status", "done")->getAllData();

        $pdf = Pdf::loadView('admin.reports.request-production', [
            'request_products' => $requestProducts,
        ]);

        return $pdf->stream();

    }
}
