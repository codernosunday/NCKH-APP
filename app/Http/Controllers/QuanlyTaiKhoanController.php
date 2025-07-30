<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ThongtincanhanModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class QuanlyTaiKhoanController extends Controller
{
    //
    public function Taotaikhoan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:7|confirmed',
            'permission' => 'required|in:user,admin,manager',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        $user = User::create([
            'name'       => $request->input('name'),
            'email'      => $request->input('email'),
            'password'   => Hash::make($request->input('password')),
            'permission' => $request->input('permission'),
        ]);

        return response()->json([
            'message' => 'Tài khoản đã được tạo thành công',
        ], 201);
    }
}
