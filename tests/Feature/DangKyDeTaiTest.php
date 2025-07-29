<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class DangKyDeTaiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDKdetai()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $payload = [
            "loaidetai" => 1,
            "linhvuc" => 1,
            "hovaten" => "Nguyen Van A",
            "Donvi" => "Khoa CNTT",
            "Sodienthoai" => "0123456789",
            "Email" => "a@gmail.com",
            "TGbatdau" => "2025-07-27", // Dùng đúng format Y-m-d nếu migration là `date`
            "TGketthuc" => "2025-08-27",
            "Sogiotacgia" => 100, // ≤ sogioNC (giả sử là 120) → ✅
            "Trangthai" => "Đang chờ duyệt",
            "diemdanhgia" => null,
            "nhanxet" => null,
            "thanhvien" => [
                [
                    "id_nguoidung" => null,
                    "tenthanhvien" => "Le Van B",
                    "nhiemvu" => "Thành viên",
                    "vaitro" => "Hỗ trợ",
                    "sogio" => 30
                ],
                [
                    "id_nguoidung" => null,
                    "tenthanhvien" => "Tran Thi C",
                    "nhiemvu" => "Thành viên",
                    "vaitro" => "Phân tích",
                    "sogio" => 40
                ]
            ], // tổng = 70 ≤ sogioTVtoida (giả sử là 90) → ✅, số TV = 2 ≤ 3 → ✅
            "tiendo" => [
                [
                    "ndcongviec" => "Khảo sát tài liệu",
                    "nguoithuchien" => "tác giả và thành viên",
                    "Tgbatdaucv" => "2025-07-27",
                    "Tgketthuccv" => "2025-08-05",
                    "trangthai" => "Chưa thực hiện",
                    "kinhphi" => [
                        [
                            "noidungchi" => "Mua sách",
                            "DVT" => "Cuốn",
                            "Soluong" => "2",
                            "dongia" => 100000,
                            "thanhtien" => 200000
                        ],
                        [
                            "noidungchi" => "In tài liệu",
                            "DVT" => "Bộ",
                            "Soluong" => "3",
                            "dongia" => 50000,
                            "thanhtien" => 150000
                        ]
                    ]
                ],
                [
                    "ndcongviec" => "Viết báo cáo",
                    "nguoithuchien" => "tác giả",
                    "Tgbatdaucv" => "2025-08-10",
                    "Tgketthuccv" => "2025-08-20",
                    "trangthai" => "Chưa thực hiện",
                    "kinhphi" => null
                ]
            ]
        ];

        $response = $this->postJson('/pdangkydetai', $payload);
        Log::info('Payload gửi lên', $payload);
        $response->dump();
        $response->assertStatus(201);
    }
}
