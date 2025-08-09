@extends('layout.app')

@section('title', 'Thông tin cá nhân')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Thông tin cá nhân</h2>
        @if($ttcn)
            <form id="ttcnForm">
                @csrf
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row align-items-center mb-4">
                            <div class="col-md-2 text-center">
                                <div class="avatar-container mb-3">
                                    <img src="{{ asset('/avatar.png') }}" alt="Avatar" class="img-thumbnail rounded-circle"
                                        style="width: 120px; height: 120px;">
                                    <div class="mt-2 text-muted">{{ $ttcn->hovaten }}</div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="hovaten" class="form-label"><strong>Họ và tên:</strong></label>
                                        <input type="text" class="form-control" id="hovaten" name="hovaten"
                                            value="{{ $ttcn->hovaten }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="gioitinh" class="form-label"><strong>Giới tính:</strong></label>
                                        <input type="text" class="form-control" id="gioitinh" name="gioitinh"
                                            value="{{ $ttcn->gioitinh }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="sodt" class="form-label"><strong>Số điện thoại:</strong></label>
                                        <input type="text" class="form-control" id="sodt" name="sodt" value="{{ $ttcn->sodt }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="ngaysinh" class="form-label"><strong>Ngày sinh:</strong></label>
                                        <input type="date" class="form-control" id="ngaysinh" name="ngaysinh"
                                            value="{{ $ttcn->ngaysinh }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="dvcongtac" class="form-label"><strong>Đơn vị công tác:</strong></label>
                                        <input type="text" class="form-control" id="dvcongtac" name="dvcongtac"
                                            value="{{ $ttcn->dvcongtac }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label"><strong>Email:</strong></label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $ttcn->email }}">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                    </div>
                </div>
            </form>

            {{-- Danh sách đề tài --}}
            <div class="card">
                <div class="card-header">
                    <h5>Danh sách đề tài</h5>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($ttcn->Detai as $detai)
                        <li class="list-group-item">
                            <strong>{{ $detai->tendetai ?? 'Không rõ tên đề tài' }}</strong><br>
                            <small>Nghiệm thu:
                                {{ $detai->tgnghiemthu ? \Carbon\Carbon::parse($detai->tgnghiemthu)->format('m/Y') : '' }}</small>
                        </li>
                    @empty
                        <li class="list-group-item">Không có đề tài nào.</li>
                    @endforelse
                </ul>
            </div>
        @else
            <div class="alert alert-warning">
                Không tìm thấy thông tin cá nhân.
            </div>
        @endif
    </div>
@endsection