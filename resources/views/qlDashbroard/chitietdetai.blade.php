@extends('layoutQL.app')

@section('title', 'Xem chi tiết đề tài')

@section('content')
    @vite(['resources/js/pages/Detaithuchien.js'])
    <div class="main-content" id="trangdetaicanhan">
        @if($dsDetai && $dsDetai->trangthai == 'Chờ duyệt')
            <div class="mb-3">
                <button class="btn btn-success btn-sm me-2" id="btnDuyetDetai" data-id="{{ $dsDetai->id_detai }}">
                    <i class="fas fa-check"></i> Duyệt
                </button>
                <button class="btn btn-danger btn-sm" id="btnKhongDuyetDetai" data-id="{{ $dsDetai->id_detai }}">
                    <i class="fas fa-times"></i> Không duyệt
                </button>
            </div>
        @endif
        <div class="d-flex align-items-center mb-3">
            <h5 class="mb-0 me-3">Đề tài: {{ $dsDetai->tendetai }}</h5>
        </div>
        <div class="border-start border-4 border-primary ps-3 py-2 mb-3 bg-light fw-bold">
            Đề tài đang thực hiện
        </div>
        @if ($dieukien)
            <input type="hidden" id="edit_id_detai" value="{{ $dsDetai->id_detai }}">
            <table class="table table-bordered table-striped table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th>Chủ nhiệm</th>
                        <th>Tên đề tài</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Thời gian thực hiện</th>
                        <th>Số giờ quy đổi</th>
                        <th>Năm học tính giờ</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $dsDetai->hotenCN}}</td>
                        <td>{{ $dsDetai->tendetai }}</td>
                        <td>{{ \Carbon\Carbon::parse($dsDetai->tgbatdau)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($dsDetai->tgketthuc)->format('d/m/Y') }}</td>
                        <td>{{ $dsDetai->sothang }} (Tháng)</td>
                        <td>{{ $dsDetai->sogiotg }}</td>
                        <td>{{ \Carbon\Carbon::parse($dsDetai->created_at)->year }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ $dsDetai->trangthai }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="border-start border-4 border-primary ps-3 py-2 mb-3 bg-light fw-bold">
                Danh sách thành viên
            </div>
            @if ($thanhviens->count() > 0)
                <table class="table table-bordered table-striped table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>STT</th>
                            <th>Họ tên</th>
                            <th>Nhiệm vụ</th>
                            <th>Vai trò</th>
                            <th>Số giờ tham gia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($thanhviens as $index => $tv)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $tv->tenthanhvien ?? $tv->ThanhvienDT->hoten }}</td>
                                <td>{{ $tv->nhiemvu }}</td>
                                <td>{{ $tv->vaitro }}</td>
                                <td>{{ $tv->sogiothamgia }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">Không có thành viên nào.</div>
            @endif
            <div class="border-start border-4 border-primary ps-3 py-2 mb-3 bg-light fw-bold">
                Hội đồng
            </div>
            <div class="alert alert-info">Chưa có hội đồng</div>
            <div class="border-start border-4 border-primary ps-3 py-2 mb-3 bg-light fw-bold">
                Tiến độ thực hiện
            </div>
            @forelse ($tiendo as $td)
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>

                                <strong>Công việc:</strong> {{ $td->ndcongviec }}
                            </div>
                            <div>
                                <span
                                    class="badge 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        @if($td->trangthai == 'Hoàn thành') bg-success 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        @elseif($td->trangthai == 'Đang thực hiện') bg-warning 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        @else bg-secondary @endif">
                                    {{ $td->trangthai }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p><strong>Thời gian: {{$td->thang}} | </strong> {{ \Carbon\Carbon::parse($td->tgbatdau)->format('d/m/Y') }}
                            -
                            {{ \Carbon\Carbon::parse($td->tgketthuc)->format('d/m/Y') }}
                        </p>
                        <div class="d-flex align-items-center mb-2">
                            <h5 class="mb-0 me-2">Kinh phí liên quan:</h5>
                            <button class="btn btn-sm btn-outline-success py-0 px-1 toggle-kinhphi-form"
                                data-id="{{ $td->id_tiendo }}">
                                <i class="fas fa-plus"></i> Thêm kinh phí
                            </button>
                        </div>
                        @if($td->Kinhphi->count() > 0)
                            <table class="table table-bordered table-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>Chi tiết khoản chi</th>
                                        <th>Đơn vị tính</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($td->Kinhphi as $kp)
                                        <tr>
                                            <td>{{ $kp->ctkhoanchi }}</td>
                                            <td>{{ $kp->donvitinh }}</td>
                                            <td>{{ $kp->soluong }}</td>
                                            <td>{{ number_format($kp->dongia, 0, ',', '.') }}</td>
                                            <td>{{ number_format($kp->thanhtien, 0, ',', '.') }}</td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-sm py-0 px-1 btn-outline-primary btn-edit-kinhphi-modal"
                                                    data-id="{{ $kp->id_kp }}" data-tiendo="{{ $td->id_tiendo }}"
                                                    data-ctkhoanchi="{{ $kp->ctkhoanchi }}" data-donvitinh="{{ $kp->donvitinh }}"
                                                    data-soluong="{{ $kp->soluong }}" data-dongia="{{ $kp->dongia }}"
                                                    data-thanhtien="{{ $kp->thanhtien }}" data-detai="{{ $td->id_detai }}">
                                                    <i class="fas fa-edit"></i> Sửa
                                                </button>
                                                <button type="button" class="btn btn-sm py-0 px-1 btn-outline-danger"
                                                    onclick="deleteKinhPhi('{{ $kp->id_kp }}', '{{ $td->id_detai }}', '{{ $td->id_tiendo }}')"><i
                                                        class="fas fa-trash"></i> Xoá</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">Không có kinh phí nào.</p>
                        @endif
                    </div>
                    <!-- Form thêm kinh phí (ẩn ban đầu) -->
                    <div class="kinhphi-form-container mb-3 ms-3" id="form-{{ $td->id_tiendo }}" style="display: none;">
                        <form class="form-kinhphi" data-id="{{ $td->id_tiendo }}">
                            @csrf
                            <div class="row g-2">
                                <input type="hidden" name="id_detai" value="{{ $td->id_detai }}">
                                <div class="col"><input type="text" name="ctkhoanchi" class="form-control"
                                        placeholder="Chi tiết khoản chi" required></div>
                                <div class="col"><input type="text" name="donvitinh" class="form-control" placeholder="Đơn vị tính"
                                        required></div>
                                <div class="col"><input type="number" name="soluong" class="form-control" placeholder="Số lượng"
                                        required>
                                </div>
                                <div class="col"><input type="number" name="dongia" class="form-control" placeholder="Đơn giá"
                                        required>
                                </div>
                                <div class="col"><input type="number" name="thanhtien" class="form-control" placeholder="Thành tiền"
                                        required></div>
                                <div class="col">
                                    <button type="submit" class="btn btn-sm btn-primary">Lưu</button>
                                    <button type="button" class="btn btn-sm btn-secondary btn-cancel"
                                        data-id="{{ $td->id_tiendo }}">Huỷ</button>
                                </div>
                            </div>
                        </form>
                        <div id="msg-{{ $td->id_tiendo }}"></div>
                    </div>
                </div>

            @empty
                <div class="alert alert-info">Không có tiến độ nào.</div>
            @endforelse
            <div
                class="d-flex justify-content-between align-items-center border-start border-4 border-primary ps-3 py-2 mb-3 bg-light fw-bold">
                <span>Các file sản phẩm</span>
                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalSanPham"
                    id="btnShowModalThemSanPham">
                    <i class="fas fa-plus"></i> Thêm sản phẩm
                </button>
            </div>
            <div>
                @if(isset($dssanpham) && count($dssanpham) > 0)
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>loại</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dssanpham as $index => $sp)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><a href="{{asset($sp->linkSP)}}" target="_blank">{{ $sp->tenSP }}</a></td>
                                    <td>{{ $sp->loaiSP }}</td>
                                    <td>
                                        {{-- <button type="button"
                                            class="btn btn-sm btn-outline-primary py-0 px-1 btn-edit-sanpham-modal">
                                            <i class="fas fa-pen"></i>
                                        </button> --}}
                                        <button type="button" class="btn btn-sm py-0 px-1 btn-outline-danger"
                                            onclick="xoaSanPham('{{ $sp->id_sanpham }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">Chưa có sản phẩm nào.</div>
                @endif
            </div>
        @else
            <div class="alert alert-info" role="alert">
                Bạn chưa có đề tài được duyệt.
            </div>
        @endif
    </div>
    <!-- Modal sửa kinh phí -->
    <div class="modal fade" id="modalEditKinhPhi" tabindex="-1" aria-labelledby="modalEditKinhPhiLabel" aria-hidden="true"
        style="z-index: 1055;">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white py-2 px-3" style="min-height:unset;">
                    <h6 class="modal-title mb-0" id="modalEditKinhPhiLabel" style="font-size:1rem;">Sửa kinh phí</h6>
                    <button type="button" class="btn-close btn-close-white p-1 m-0" style="width:1.2rem;height:1.2rem;"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditKinhPhi" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id_kp" id="edit_id_kp">
                        <input type="hidden" name="id_tiendo" id="edit_id_tiendo">
                        <input type="hidden" name="id_detai" id="edit_id_detai">
                        <div class="row g-2">
                            <div class="col"><input type="text" name="ctkhoanchi" id="edit_ctkhoanchi" class="form-control"
                                    placeholder="Chi tiết khoản chi" required></div>
                            <div class="col"><input type="text" name="donvitinh" id="edit_donvitinh" class="form-control"
                                    placeholder="Đơn vị tính" required></div>
                            <div class="col"><input type="number" name="soluong" id="edit_soluong" class="form-control"
                                    placeholder="Số lượng" min="0" required></div>
                            <div class="col"><input type="number" name="dongia" id="edit_dongia" class="form-control"
                                    placeholder="Đơn giá" min="0" required></div>
                            <div class="col"><input type="number" name="thanhtien" id="edit_thanhtien" class="form-control"
                                    placeholder="Thành tiền" min="0" required></div>
                        </div>
                        <div class="mt-3 text-end">
                            <button type="submit" class="btn btn-success">Lưu</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                        </div>
                        <div id="msg-edit-modal" class="mt-2"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal sản phẩm -->
    <div class="modal fade" id="modalSanPham" tabindex="-1" aria-labelledby="modalSanPhamLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white py-2 px-3">
                    <h6 class="modal-title mb-0" id="modalSanPhamLabel" style="font-size:1rem;">Thêm sản phẩm</h6>
                    <button type="button" class="btn-close btn-close-white p-1 m-0" style="width:1.2rem;height:1.2rem;"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formModalSanPham" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_sanpham" id="modal_id_sanpham">

                        {{-- Loại nhập --}}
                        <div class="mb-3">
                            <label for="modal_loaiSP" class="form-label">Loại nhập</label>
                            <select class="form-select" id="modal_loaiSP" name="loaiSP" required>
                                <option value="">-- Chọn loại --</option>
                                <option value="link">Link sản phẩm</option>
                                <option value="file">Tải file sản phẩm</option>
                            </select>
                        </div>

                        {{-- Tên sản phẩm --}}
                        <div class="mb-3">
                            <label for="modal_tenSP" class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="modal_tenSP" name="tenSP" required>
                        </div>
                        {{-- Nhập link --}}
                        <div class="mb-3 d-none" id="group_linkSP">
                            <label for="modal_linkSP" class="form-label">Link sản phẩm (URL)</label>
                            <input type="url" class="form-control" id="modal_linkSP" name="linkSP">
                        </div>
                        {{-- Upload file --}}
                        <div class="mb-3 d-none" id="group_fileSP">
                            <label for="modal_fileSP" class="form-label">File sản phẩm</label>
                            <input type="file" class="form-control" id="modal_fileSP" name="fileSP" accept=".jpg,.png,.pdf">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success" id="btnLuuSanPham">Lưu</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                        </div>
                        <div id="msg-modal-sanpham" class="mt-2"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection