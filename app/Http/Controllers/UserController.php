<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ThongtincanhanModel;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Backend------------
    public function CapNhatThongTinCaNhan(Request $request)
    {
        $validated = $request->validate([
            'hovaten'    => 'required|string|max:100',
            'gioitinh'   => 'nullable|string|max:10',
            'sodt'        => 'nullable|string|max:20',
            'ngaysinh'        => 'nullable|Date',
            'dvcongtac'  => 'nullable|string|max:100',
            'email'      => 'required|email|max:100'
        ]);
        $user = Auth::user();
        $ttcn = ThongtincanhanModel::where('user_id', $user->id)->first();
        if (!$ttcn) {
            return response()->json(['error' => 'Thông tin cá nhân không tồn tại.'], 404);
        }
        $ttcn->update($validated);
        return response()->json(['success' => 'Cập nhật thông tin cá nhân thành công.']);
    }
    //------------
}
