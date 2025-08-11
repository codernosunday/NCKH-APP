@extends('layoutQL.app')

@section('title', 'Trang quản lý')

@section('content')
    <div class="main-content">
        <h2 class="mb-4">Các đề tài chờ duyệt</h2>
        @if($dsDetai && count($dsDetai) > 0)
            @foreach ($dsDetai as $detai)
                <div class="card shadow-sm mb-2">
                    <div class="card-body">
                        <h6 class="card-title mb-2">
                            <span><strong>Tên đề tài:</strong></span>
                            <span class="text-success">{{ $detai->tendetai ?? '' }}</span>
                        </h6>
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <strong>Loại đề tài:</strong> <em>{{ $detai->loaiDT->tenloaidetai ?? '' }}</em>
                                <span class="mx-2"></span>
                                <strong>Lĩnh vực:</strong> {{ $detai->Linhvucnghiencuu->tenlvnc ?? '' }}
                            </div>
                            <div class="col-md-6">
                                <strong>Yêu cầu lúc:</strong>
                                @if($detai->created_at)
                                    {{ \Carbon\Carbon::parse($detai->created_at)->format('H:i d/m/Y') }}
                                @endif
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <strong>Chủ nhiệm đề tài:</strong> {{ $detai->hotenCN ?? '' }}
                            </div>
                            <div class="col-md-6">
                                <strong>Thành viên:</strong>
                                @if($detai->Thanhvien && count($detai->Thanhvien))
                                    @foreach ($detai->Thanhvien as $index => $tv)
                                        <span>{{ $tv->hoten ?? $tv->tenthanhvien }}</span>{{ $index + 1 < count($detai->Thanhvien) ? ',' : '' }}
                                    @endforeach
                                @else
                                    <span class="text-muted">Chưa có thành viên</span>
                                @endif
                            </div>
                        </div>
                        <p class="mb-3">
                            <strong>Đơn vị:</strong>
                            <a href="#" class="text-decoration-none">
                                {{ $detai->donvi ?? '' }}
                            </a>
                        </p>
                        <a href="/quanly/xemdetai/{{$detai->id_detai}}" class="btn btn-outline-primary btn-sm">Xem chi
                            tiết</a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-warning">Chưa có đề tài cần duyệt.</div>
        @endif
    </div>
@endsection