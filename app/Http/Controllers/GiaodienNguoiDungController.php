<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GiaodienNguoiDungController extends Controller
{
    //Đăng nhập
    public function TrangDangnhap()
    {
        return view('login');
    }
}
