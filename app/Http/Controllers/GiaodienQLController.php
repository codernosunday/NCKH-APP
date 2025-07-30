<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GiaodienQLController extends Controller
{
    //admin
    public function dashboardAdmin()
    {
        return view('adminDashboard.AdminDashboard');
    }
    // Quản lý hệ thống
    public function dashboardQL()
    {
        return view('qlDashbroard.qlHome');
    }
}
