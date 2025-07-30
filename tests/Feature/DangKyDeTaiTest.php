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
        $payload = [
            "loaidetai" => 4,
            "linhvuc" => 1,
            "hovaten" => "Nguyen Van D",
            "tendetai" => "Nghiên cứu Khoa học 4",
            "Donvi" => "Khoa công nghệ thông tin",
            "Sodienthoai" => "0123456789",
            "Email" => "c@gmail.com",
            "TGbatdau" => "2025-08-30",
            "TGketthuc" => "2025-12-30",
            "Sogiotacgia" => 120,
            "Trangthai" => "Đang chờ duyệt",
            "diemdanhgia" => null,
            "nhanxet" => null,
            "thanhvien" => [
                [
                    "id_nguoidung" => null,
                    "tenthanhvien" => "Le Van H",
                    "nhiemvu" => "Thành viên",
                    "vaitro" => "Hỗ trợ",
                    "sogio" => 25
                ],
                [
                    "id_nguoidung" => null,
                    "tenthanhvien" => "Tran Thi G",
                    "nhiemvu" => "Thành viên",
                    "vaitro" => "Hỗ trợ",
                    "sogio" => 25
                ]
            ],
            "tiendo" => [
                [
                    "ndcongviec" => "Công việc 1",
                    "nguoithuchien" => "tác giả và thành viên",
                    "thang" => "Tháng 1",
                    "trangthai" => "Đang thức hiện",
                    "kinhphi" => [
                        [
                            "noidungchi" => "Nội dung chi 1",
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
                    "ndcongviec" => "Công việc 2",
                    "thang" => "Tháng 1 - Tháng 2",
                    "nguoithuchien" => "tác giả",
                    "Tgbatdaucv" => "2025-08-10",
                    "Tgketthuccv" => "2025-08-20",
                    "trangthai" => "Chưa thực hiện",
                    "kinhphi" => [
                        [
                            "noidungchi" => "Nội dung chi",
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
                ]
            ]
        ];
        $response = $this->postJson('/pdangkydetai', $payload);
        Log::info('Payload gửi lên', $payload);
        $response->dump();
        $response->assertStatus(201);
    }
}
