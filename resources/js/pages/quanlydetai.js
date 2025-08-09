export function ChonNamQuanLyDeTai() {
    const select = document.getElementById('chon-nam');
    const form = document.getElementById('form-chon-nam');
    const container = document.getElementById('ds-detai-theonam');
    if (!select || !form || !container) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const year = select.value;
        container.innerHTML = '<div class="text-center py-4"><span class="spinner-border spinner-border-sm"></span> Đang tải...</div>';
        fetch(`/detaitheonam/${year}`)
            .then(response => {
                if (!response.ok) throw new Error('Lỗi khi tải dữ liệu');
                return response.text();
            })
            .then(html => {
                container.innerHTML = html;
            })
            .catch(err => {
                container.innerHTML = `<div class='text-danger text-center'>${err.message}</div>`;
            });
    });
}
