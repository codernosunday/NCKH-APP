@extends('layout.app')

@section('title', '{{$ten}}')

@section('content')
    <div class="main-content">
        <h2 class="mb-4">{{$detai->tendetai}}</h2>
        @if(isset($detai))
            <table class="table table-bordered w-75 mx-auto">
                <tbody>
                    <tr>
                        <th style="width:35%">Tên đề tài</th>
                        <td>{{ $detai->tendetai }}</td>
                    </tr>
                    <tr>
                        <th>Chủ nhiệm</th>
                        <td>{{ $detai->hotenCN }}</td>
                    </tr>
                    <tr>
                        <th>Loại đề tài</th>
                        <td>{{ $detai->LoaiDT->tenloaidetai ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Lĩnh vực nghiên cứu</th>
                        <td>{{ $detai->Linhvucnghiencuu->tenlvnc ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Số tháng thực hiện</th>
                        <td>{{ $detai->sothang }}</td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td>{{ $detai->trangthai }}</td>
                    </tr>
                    <tr>
                        <th>Ngày đăng ký</th>
                        <td>{{ $detai->created_at ? \Carbon\Carbon::parse($detai->created_at)->format('d/m/Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Ngày nghiệm thu</th>
                        <td>{{ $detai->tgnghiemthu ? \Carbon\Carbon::parse($detai->tgnghiemthu)->format('d/m/Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Thành viên tham gia</th>
                        <td>
                            @if($detai->Thanhvien && count($detai->Thanhvien) > 0)
                                {{ $detai->Thanhvien->pluck('tenthanhvien')->implode(', ') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        @else
            <div class="alert alert-warning">Không tìm thấy thông tin đề tài.</div>
        @endif
    </div>
@endsection