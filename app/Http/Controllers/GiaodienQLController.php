<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LoaidetaiModel;
use App\Models\KinhphiModel;
use App\Models\DetaiModel;
use App\Models\TiendoModel;
use App\Models\ThongtincanhanModel;
use App\Models\ThanhvienModel;
use App\Models\SanphamModel;
use Illuminate\Support\Facades\Log;

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
        $dsDetai = DetaiModel::where('trangthai', 'Chờ duyệt')->get();
        return view('qlDashbroard.qlHome', compact('dsDetai'));
    }
    public function DetaiChoDuyet()
    {
        $dsDetai = DetaiModel::where('trangthai', 'Chờ duyệt')->get();
        return view('qlDashbroard.TrangDuyetDeTai', compact('dsDetai'));
    }
    public function TrangChiTietDeTai($id_detai)
    {
        $dsDetai = DetaiModel::with(['Thanhvien', 'Tiendo', 'Sanpham', 'Kinhphi'])
            ->where('id_detai', $id_detai)
            ->first();
        if (!$dsDetai) {
            $dieukien = false;
            return view('qlDashbroard.chitietdetai', compact('dieukien'));
        }
        $dieukien = true;
        $tiendo = $dsDetai->Tiendo;
        $dssanpham = $dsDetai->Sanpham;
        $thanhviens = $dsDetai->Thanhvien;
        return view('qlDashbroard.chitietdetai', compact('dsDetai', 'tiendo', 'thanhviens', 'dieukien', 'dssanpham'));
    }
}
