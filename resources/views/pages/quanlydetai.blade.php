@extends('layout.app')

@section('title', 'Số giờ NCKH')
@vite('resources/js/pages/quanlydetai.js')
@section('content')
    <div class="main-content">
        <h2 class="mb-4">Đề tài và số giờ nghiên cứu khoa học</h2>
        <div class="mb-3 p-3 rounded" style=" border-left: 6px solid #007bff;">
            <form method="get" class="d-flex align-items-center flex-wrap gap-2" id="form-chon-nam">
                <strong class="me-2">Tổng số giờ nghiên cứu khoa học cá nhân</strong>
                <span class="me-2">năm</span>
                <select name="nam" id="chon-nam" class="form-select form-select-sm w-auto me-2">
                    @php
                        $currentYear = now()->year;
                        $minYear = $currentYear - 10;
                        $selectedYear = request('nam', $currentYear);
                    @endphp
                    @for($y = $currentYear; $y >= $minYear; $y--)
                        <option value="{{ $y }}" @if($selectedYear == $y) selected @endif>{{ $y }}</option>
                    @endfor
                </select>
                <button type="submit" class="btn btn-sm btn-outline-primary">Xem</button>
                @php
                    $tongGio = 0;
                    $tongGioThamGia = 0;
                    $tongGioHoiDong = 0;
                    if (isset($detai_choduyet)) {
                        $tongGio += $detai_choduyet->where(function ($dt) use ($selectedYear) {
                            return optional($dt->created_at)->year == $selectedYear;
                        })->sum('sogiotacgia');
                    }
                    if (isset($detai_nghiemthu)) {
                        $tongGio += $detai_nghiemthu->where(function ($dt) use ($selectedYear) {
                            return optional($dt->created_at)->year == $selectedYear;
                        })->sum('sogiotacgia');
                    }
                    if (isset($detai_thanhvien)) {
                        $tongGioThamGia = $detai_thanhvien->where(function ($dt) use ($selectedYear) {
                            return optional($dt->created_at)->year == $selectedYear;
                        })->sum('sogiothanhvien');
                        $tongGioHoiDong = $detai_thanhvien->where(function ($dt) use ($selectedYear) {
                            return optional($dt->created_at)->year == $selectedYear;
                        })->sum('sogiotvhoidong');
                    }
                @endphp
                <span class="text-primary fw-bold ms-3" style="font-size:1.2em">
                    {{ $tongGio }} giờ
                </span>
                <span class="ms-4">| Số giờ tham gia: <span class="fw-bold text-success">{{ $tongGioThamGia }}</span></span>
                <span class="ms-4">| Số giờ hội đồng: <span class="fw-bold text-warning">{{ $tongGioHoiDong }}</span></span>
                <span class="ms-4">| Tổng số giờ NCKH: <span
                        class="fw-bold text-danger">{{ $tongGio + $tongGioThamGia + $tongGioHoiDong }}</span></span>
            </form>
        </div>
        <div id="ds-detai-theonam">
            @include('components.detaithongketheonam')
        </div>
    </div>
@endsection