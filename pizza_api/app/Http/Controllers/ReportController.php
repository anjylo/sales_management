<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SalesReportService;

class ReportController extends Controller
{
    public function __construct(private SalesReportService $service)
    {

    }

    public function topSellingPizzas()
    {
        $report = $this->service->topSellingPizzas();

        return response()->json($report);
    }

    public function salesBySize()
    {
        $report = $this->service->salesBySize();

        return response()->json($report);
    }
    
    public function salesByDay(Request $request)
    {
        $perPage = (int) $request->get('per_page', 10);
        return response()->json($this->service->salesByDay($perPage));
    }

    public function salesByMonth(Request $request)
    {
        $perPage = (int) $request->get('per_page', 12);
        return response()->json($this->service->salesByMonth($perPage));
    }

    public function salesByYear(Request $request)
    {
        $perPage = (int) $request->get('per_page', 10);
        return response()->json($this->service->salesByYear($perPage));
    }
}
