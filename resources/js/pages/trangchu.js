export function TrangChu() {
    const searchBtn = document.getElementById('search-btn');
    const keywordInput = document.getElementById('keyword');
    const researchTypeSelect = document.getElementById('research_type');
    const resultsContainer = document.getElementById('results-container');
    const resultsBody = document.getElementById('results-body');
    const paginationLinks = document.getElementById('pagination-links');

    // Xử lý sự kiện click nút tìm kiếm
    searchBtn.addEventListener('click', function () {
        const keyword = keywordInput.value.trim();
        const bangdetai = document.getElementById('bangdetai');
        bangdetai.innerHTML = '<div class="text-center"><i class="anticon anticon-loading"></i> Đang tải...</div>';
        if (keyword) {
            fetch(`/detai/timkiem/${encodeURIComponent(keyword)}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            })
                .then(async response => {
                    if (!response.ok) {
                        let message = 'Có lỗi xảy ra khi tải dữ liệu';
                        try {
                            const data = await response.json();
                            if (data.message) message = data.message;
                        } catch { }
                        throw new Error(message);
                    }
                    return response.text();
                })
                .then(html => {
                    bangdetai.innerHTML = html;
                })
                .catch(error => {
                    bangdetai.innerHTML = `<div class="text-center text-secondary">${error.message}</div>`;
                });
        } else {
            bangdetai.innerHTML = '<div class="text-center text-secondary">Vui lòng nhập từ khóa tìm kiếm</div>';
        }
    });

    // Xử lý sự kiện nhấn Enter trong ô tìm kiếm
    keywordInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            const keyword = keywordInput.value.trim();
            if (keyword) {
                const bangdetai = document.getElementById('bangdetai');
                bangdetai.innerHTML = '<div class="text-center"><i class="anticon anticon-loading"></i> Đang tải...</div>';
                fetch(`/detai/timkiem/${encodeURIComponent(keyword)}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html'
                    }
                })
                    .then(async response => {
                        if (!response.ok) {
                            let message = 'Có lỗi xảy ra khi tải dữ liệu';
                            try {
                                const data = await response.json();
                                if (data.message) message = data.message;
                            } catch { }
                            throw new Error(message);
                        }
                        return response.text();
                    })
                    .then(html => {
                        bangdetai.innerHTML = html;
                    })
                    .catch(error => {
                        bangdetai.innerHTML = `<div class="text-center text-secondary">${error.message}</div>`;
                    });
            } else {
                const bangdetai = document.getElementById('bangdetai');
                bangdetai.innerHTML = '<div class="text-center text-secondary">Vui lòng nhập từ khóa tìm kiếm</div>';
            }
        }
    });
    researchTypeSelect.addEventListener('change', function () {
        const idloai = this.value;
        const bangdetai = document.getElementById('bangdetai');
        bangdetai.innerHTML = '<div class="text-center"><i class="anticon anticon-loading"></i> Đang tải...</div>';
        fetch(`/detai/${idloai}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        })
            .then(async response => {
                if (!response.ok) {
                    let message = 'Có lỗi xảy ra khi tải dữ liệu';
                    try {
                        const data = await response.json();
                        if (data.message) message = data.message;
                    } catch { }
                    throw new Error(message);
                }
                return response.text();
            })
            .then(html => {
                bangdetai.innerHTML = html;
            })
            .catch(error => {
                bangdetai.innerHTML = `<div class="text-center text-secondary">${error.message}</div>`;
            });
    });

    // Xử lý phân trang AJAX
    document.addEventListener('click', function (e) {
        if (e.target.closest('.pagination a')) {
            e.preventDefault();
            const url = e.target.closest('a').href;

            // Hiển thị loading
            resultsBody.innerHTML = '<tr><td colspan="7" class="text-center"><i class="anticon anticon-loading"></i> Đang tải...</td></tr>';

            // Gửi request AJAX cho phân trang
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.html) {
                        resultsBody.innerHTML = data.html;
                        paginationLinks.innerHTML = data.pagination || '';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    resultsBody.innerHTML = '<tr><td colspan="7" class="text-center text-danger">Có lỗi xảy ra khi tải dữ liệu</td></tr>';
                    paginationLinks.innerHTML = '';
                });
        }
    });
}