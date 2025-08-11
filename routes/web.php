<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetaiController;
use App\Http\Controllers\DangNhapController;
use App\Http\Controllers\GiaodienQLController;
use App\Http\Controllers\GiaodienNguoiDungController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
| Đăng nhập, đăng xuất---------------------------------
*/

Route::post('/loginuser', [DangNhapController::class, 'loginNguoidung'])->name('login');;
Route::post('/logoutuser', [DangNhapController::class, 'Dangxuat'])->name('logout');;
/*
| Giao diện view---------------------------------------------
*/
Route::get('/', [GiaodienNguoiDungController::class, 'TrangDangnhap']);
Route::get('/trangdangnhap', [GiaodienNguoiDungController::class, 'TrangDangnhap']);
Route::get('/xemdetai/{iddt}/{ten}', [GiaodienNguoiDungController::class, 'TrangDeTai']);
Route::middleware(['checknguoidung'])->group(function () {
    Route::get('/detainckh/detaicuatoi', [GiaodienNguoiDungController::class, 'TrangDeTaiCaNhan']);
    Route::get('/quanlydetai', [GiaodienNguoiDungController::class, 'TrangQLdetai']);
    Route::get('/thongtincanhan', [GiaodienNguoiDungController::class, 'TrangCaNhan']);
    Route::get('/detainckh/dangkydetai', [GiaodienNguoiDungController::class, 'TrangDangKyDetai']);
    Route::get('/detainckh/Formdangkydetai', [GiaodienNguoiDungController::class, 'FormDangKyDetai']);
    Route::get('/detainckh', [GiaodienNguoiDungController::class, 'TrangTimKiemDetai']);
    Route::get('/detaitheonam/{nam}', [GiaodienNguoiDungController::class, 'DSdetaitheonam']);
});
/*
| Tìm kiếm---------------------------------------------
*/
Route::get('/detai/{idloai}', [GiaodienNguoiDungController::class, 'timkiemtheoloai']);
Route::get('/detai/timkiem/{search}', [GiaodienNguoiDungController::class, 'timkiem']);




/*
| Backend route post---------------------------------------------
*/
//Đề tài
Route::middleware(['checknguoidung'])->group(function () {
    route::post('/detai/dangkydetai', [DetaiController::class, 'DangkyDetai'])->name('detai.dangkydetai');
    route::post('/tiendo/{id}/themkinhphi', [DetaiController::class, 'ThemKinhPhi'])->name('detai.ThemKinhPhi');
    route::delete('/detai/{id_detai}/tiendo/{id_tiendo}/kinhphi/{id_kinhphi}', [DetaiController::class, 'xoaKinhPhi'])->name('detai.xoaKinhPhi');
    route::post('/detai/{id_detai}/tiendo/{id_tiendo}/suakinhphi/{id_kinhphi}', [DetaiController::class, 'suaKinhPhi'])->name('detai.suaKinhPhi');
    //upload file
    route::post('/detai/{id_detai}/sanpham', [DetaiController::class, 'themFile'])->name('detai.themFile');
    route::delete('/detai/xoasanpham/{idfile}', [DetaiController::class, 'xoaFile'])->name('detai.xoaFile');
});
//Thông tin cá nhân
Route::middleware(['checknguoidung'])->group(function () {
    route::post('/capnhat/thongtincanhan', [UserController::class, 'CapNhatThongTinCaNhan']);
});


// giao diện admin
Route::get('/admin/trangquanly', [GiaodienQLController::class, 'dashboardAdmin']);
// giao diện quản lý hệ thống
Route::get('/quanly/trangquanly', [GiaodienQLController::class, 'dashboardQL']);
Route::get('/quanly/detaichoduyet', [GiaodienQLController::class, 'DetaiChoDuyet']);
Route::get('/quanly/xemdetai/{id_detai}', [GiaodienQLController::class, 'TrangChiTietDeTai']);
