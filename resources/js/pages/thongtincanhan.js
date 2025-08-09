export function thongTinCaNhan() {
    const form = document.getElementById('ttcnForm');
    if (!form) return;
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(form);
        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) submitBtn.disabled = true;

        fetch('/capnhat/thongtincanhan', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: formData
        })
            .then(async response => {
                if (!response.ok) {
                    let message = 'Có lỗi xảy ra khi cập nhật';
                    try {
                        const data = await response.json();
                        if (data.errors) {
                            message = Object.values(data.errors).join('<br>');
                        } else if (data.error) {
                            message = data.error;
                        }
                    } catch { }
                    throw new Error(message);
                }
                return response.json();
            })
            .then(data => {
                alert(data.success || 'Cập nhật thành công!');
            })
            .catch(error => {
                alert(error.message);
            })
            .finally(() => {
                if (submitBtn) submitBtn.disabled = false;
            });
    });
}
