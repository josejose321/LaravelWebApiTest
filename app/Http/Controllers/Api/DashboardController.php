<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        return response()->json([
            'user_count' => User::count(),
        ]);
    }

    public function getUsersPerDay(Request $request)
    {
        $data = DB::table('users')
        ->select(DB::raw('COUNT(id) AS user_count'), DB::raw('DATE(created_at) as date_created'))
        ->whereMonth('created_at', '=', now()->month)
        ->whereYear('created_at', '=', now()->year)
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy(DB::raw('DATE(created_at)'))
        ->get();

        return response()->json($data);
    }
}
