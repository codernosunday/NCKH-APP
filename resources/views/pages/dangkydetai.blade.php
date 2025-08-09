@extends('layout.app')
@section('title', 'Đăng ký đề tài NCKH')
@vite(['resources/css/page/trangdangkydetai.css', 'resources/js/pages/dangkydetai.js'])
@section('content')
    <div class="main-content">
        <div class="container">
            {{-- <div class="text-center mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="site-logo">
            </div> --}}
            <h3 class="mb-5">Chọn biểu mẫu đăng ký</h3>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex justify-content-center">
                    <div class="card card-option h-100 p-2" style="min-width: 260px; max-width: 320px; margin: 0 auto;">
                        <div class="card-icon d-flex justify-content-center align-items-center" style="height: 60px;">
                            <i class="fas fa-file-signature" style="font-size: 2rem;"></i>
                        </div>
                        <div class="card-body text-center p-2">
                            <h5 class="card-title mb-2" style="font-size: 1.1rem;">Đăng ký đề tài</h5>
                            <p class="card-text mb-2" style="font-size: 0.95rem;">Đăng ký đề tài nghiên cứu khoa học mới</p>
                            <a href="/detainckh/Formdangkydetai" class="btn btn-primary btn-access btn-sm"
                                style="font-size: 0.95rem; padding: 4px 12px;">
                                Truy cập <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex justify-content-center">
                    <div class="card card-option h-100 p-2" style="min-width: 260px; max-width: 320px; margin: 0 auto;">
                        <div class="card-icon d-flex justify-content-center align-items-center" style="height: 60px;">
                            <i class="fas fa-users" style="font-size: 2rem;"></i>
                        </div>
                        <div class="card-body text-center p-2">
                            <h5 class="card-title mb-2" style="font-size: 1.1rem;">Đăng ký Hội đồng</h5>
                            <p class="card-text mb-2" style="font-size: 0.95rem;">Đăng ký thành viên hội đồng đánh giá</p>
                            <a href="#" class="btn btn-primary btn-access btn-sm"
                                style="font-size: 0.95rem; padding: 4px 12px;">
                                Truy cập <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div> --}}
                <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex justify-content-center">
                    <div class="card card-option h-100 p-2" style="min-width: 260px; max-width: 320px; margin: 0 auto;">
                        <div class="card-icon d-flex justify-content-center align-items-center" style="height: 60px;">
                            <i class="fas fa-graduation-cap" style="font-size: 2rem;"></i>
                        </div>
                        <div class="card-body text-center p-2">
                            <h5 class="card-title mb-2" style="font-size: 1.1rem;">Đăng ký chương trình đào tạo</h5>
                            <p class="card-text mb-2" style="font-size: 0.95rem;">Đăng ký chương trình đào tạo liên quan</p>
                            <a href="#" class="btn btn-primary btn-access btn-sm"
                                style="font-size: 0.95rem; padding: 4px 12px;">
                                Truy cập <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="row mt-5">
                <div class="col-12">
                    <div class="info-box animated fadeIn">
                        <h3><i class="fas fa-info-circle mr-2"></i>Hướng dẫn sử dụng</h3>
                        <ol class="guide-steps">
                            <li>Chọn chức năng bạn muốn thực hiện</li>
                            <li>Điền đầy đủ thông tin theo yêu cầu</li>
                            <li>Xem lại thông tin trước khi gửi đăng ký</li>
                            <li>Theo dõi trạng thái đăng ký trong mục "Quản lý đăng ký"</li>
                        </ol>
                        <div class="text-center mt-3">
                            <button class="btn btn-outline-primary btn-support">
                                <i class="fas fa-question-circle mr-2"></i> Cần hỗ trợ?
                            </button>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection