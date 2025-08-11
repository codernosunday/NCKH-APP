<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaidetaiModel;
use App\Models\LinhvucnghiencuuModel;
use App\Models\KhoaModel;
use App\Models\DetaiModel;
use App\Models\TiendoModel;
use App\Models\ThongtincanhanModel;
use App\Models\ThanhvienModel;
use App\Models\SanphamModel;
use Illuminate\Support\Facades\Log;

class GiaodienNguoiDungController extends Controller
{
    //Đăng nhập 
    public function TrangDangnhap()
    {
        return view('login');
    }
    //Giao diện cá nhân 
    public function TrangDangKyDetai()
    {
        return view('pages.dangkydetai');
    }
    //Các form
    public function FormDangKyDetai()
    {
        $loaiDeTai = LoaidetaiModel::all();
        $linhVuc = LinhvucnghiencuuModel::all();
        $dskhoa = KhoaModel::all();
        return view('pages.FormDangKyDeTai', compact('loaiDeTai', 'linhVuc', 'dskhoa'));
    }
    public function TrangQLdetai()
    {
        $user = auth()->user();
        $ttcn = ThongtincanhanModel::where('user_id', $user->id)->first();

        // Đề tài trạng thái "Chờ duyệt" hoặc "Đã nghiệm thu" mà user là chủ nhiệm
        $detai_choduyet = DetaiModel::where('id_ttcn', $ttcn->id_ttcn)
            ->whereIn('trangthai', ['Chờ duyệt', 'Không duyệt'])
            ->where('nguoixem', 'Công khai')
            ->get();
        $detai_nghiemthu = DetaiModel::where('id_ttcn', $ttcn->id_ttcn)
            ->where('trangthai', 'Đã nghiệm thu')
            ->where('nguoixem', 'Công khai')
            ->get();

        // Đề tài mà user là thành viên
        $detai_thanhvien = DetaiModel::whereIn(
            'id_detai',
            ThanhvienModel::where('id_ttcn', $ttcn->id_ttcn)->pluck('id_detai')
        )
            ->where('nguoixem', 'Công khai')
            ->get();
        return view('pages.quanlydetai', compact('detai_choduyet', 'detai_nghiemthu', 'detai_thanhvien'));
    }
    public function DSdetaitheonam($nam)
    {
        try {
            $user = auth()->user();
            $ttcn = ThongtincanhanModel::where('user_id', $user->id)->first();
            $detai_choduyet = DetaiModel::where('id_ttcn', $ttcn->id_ttcn)
                ->whereIn('trangthai', ['Chờ duyệt', 'Không duyệt'])
                ->whereYear('created_at', $nam)
                ->get();
            $detai_nghiemthu = DetaiModel::where('id_ttcn', $ttcn->id_ttcn)
                ->where('trangthai', 'Đã nghiệm thu')
                ->whereYear('created_at', $nam)
                ->get();
            $detai_thanhvien = DetaiModel::whereIn(
                'id_detai',
                ThanhvienModel::where('id_ttcn', $ttcn->id_ttcn)->pluck('id_detai')
            )
                ->whereYear('created_at', $nam)
                ->get();

            if ($detai_choduyet->isEmpty() && $detai_nghiemthu->isEmpty() && $detai_thanhvien->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không có dữ liệu đề tài cho năm này.'
                ], 404);
            }
            return view('components.detaithongketheonam', compact('detai_choduyet', 'detai_nghiemthu', 'detai_thanhvien'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Không có dữ liệu đề tài cho năm này.'
            ], 500);
        }
    }
    public function TrangTimKiemDetai()
    {
        $loaiDeTai = LoaidetaiModel::all();
        return view('pages.trangchu', compact('loaiDeTai'));
    }
    public function TrangCaNhan()
    {
        $user = auth()->user();
        $ttcn = ThongtincanhanModel::where('user_id', $user->id)->first();
        return view('pages.trangcanhan', compact('ttcn'));
    }
    public function TrangDeTaiCaNhan(Request $request)
    {
        $id_ttcn = ThongtincanhanModel::where('user_id', $request->id_nguoidung)->first();
        if (!$id_ttcn) {
            Log::warning('truy cập gián đoạn', [
                'url' => $request->fullUrl(),
                'ip' => $request->ip(),
                'agent' => $request->userAgent()
            ]);
            return redirect()->back()->with('error', 'Thông tin cá nhân không tồn tại.');
        };
        $dsDetai = DetaiModel::where('id_ttcn', $id_ttcn->id_ttcn)
            ->whereIn('trangthai', ['Đã duyệt'])
            ->first();
        if ($dsDetai == null) {
            $dieukien = false;
            return view('pages.detaicanhan', compact('dieukien'));
        } else {
            $dieukien = true;
            $id_detai = $dsDetai->id_detai;
            $tiendo = TiendoModel::with(['Kinhphi', 'Detai'])
                ->where('id_detai', $id_detai)
                ->get();
            $dssanpham = SanphamModel::with(['Detai'])
                ->where('id_detai', $id_detai)
                ->get();
            $thanhviens = ThanhvienModel::with('ThanhvienDT')
                ->where('id_detai', $id_detai)
                ->get();
            return view('pages.detaicanhan', compact('dsDetai', 'tiendo', 'thanhviens', 'dieukien', 'dssanpham'));
        }
    }
    public function timkiemtheoloai($idloai)
    {
        $loaiDeTai = LoaidetaiModel::all();
        $linhVuc = LinhvucnghiencuuModel::all();
        $dsDetai = DetaiModel::with(['Thanhvien', 'Linhvucnghiencuu', 'LoaiDT'])
            ->where('id_loaidt', $idloai)
            ->where('trangthai', 'Đã duyệt')
            ->paginate(10);
        if ($dsDetai->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Chưa có đề tài',
            ], 404);
        }
        return view('components.detai', compact('loaiDeTai', 'dsDetai'));
    }
    public function timkiem($search)
    {
        $loaiDeTai = LoaidetaiModel::all();
        $dsDetai = DetaiModel::with(['Thanhvien', 'Linhvucnghiencuu', 'LoaiDT'])
            ->where('tendetai', 'like', '%' . $search . '%')
            ->orWhere('hotenCN', 'like', '%' . $search . '%')
            ->where('trangthai', 'Đã duyệt')
            ->paginate(10);
        if ($dsDetai->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đề tài',
            ], 404);
        }
        return view('components.detai', compact('loaiDeTai', 'dsDetai'));
    }

    // Trang chi tiết đề tài
    public function TrangDeTai($iddt, $ten)
    {
        $detai = DetaiModel::with(['Thanhvien', 'Linhvucnghiencuu', 'LoaiDT'])
            ->where('id_detai', $iddt)
            ->first();
        if (!$detai) {
            abort(404, 'Không tìm thấy đề tài');
        }
        return view('pages.detai', compact('detai', 'ten'));
    }
}
