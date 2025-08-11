export function DeTaiCaNhan() {
    const formEditKinhPhi = document.getElementById('formEditKinhPhi');
    if (formEditKinhPhi) {
        formEditKinhPhi.addEventListener('submit', async function (e) {
            e.preventDefault();
            const id_kp = document.getElementById('edit_id_kp').value;
            const id_tiendo = document.getElementById('edit_id_tiendo').value;
            const id_detai = document.getElementById('edit_id_detai').value;
            const formData = new FormData(this);
            const csrfToken = this.querySelector('input[name="_token"]')?.value;
            const msgBox = document.getElementById('msg-edit-modal');
            try {
                const res = await fetch(`/detai/${id_detai}/tiendo/${id_tiendo}/suakinhphi/${id_kp}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                });
                const data = await res.json();
                if (!res.ok || !data.success) {
                    msgBox.innerHTML = `<div class="alert alert-danger mt-2">${data.message || 'Lỗi không xác định.'}</div>`;
                    return;
                }
                msgBox.innerHTML = `<div class="alert alert-success mt-2">${data.message}</div>`;
                setTimeout(() => { location.reload(); }, 1000);
            } catch (error) {
                msgBox.innerHTML = `<div class="alert alert-danger mt-2">Không thể gửi dữ liệu. Vui lòng thử lại.</div>`;
            }
        });
    }
    // Hiện modal sửa kinh phí khi bấm Sửa
    document.querySelectorAll('.btn-edit-kinhphi-modal').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();

            const modalElement = document.getElementById('modalEditKinhPhi');
            if (!modalElement) {
                console.error('Không tìm thấy modal #modalEditKinhPhi');
                return;
            }

            const modal = new bootstrap.Modal(modalElement);

            document.getElementById('edit_id_kp').value = btn.dataset.id;
            document.getElementById('edit_id_tiendo').value = btn.dataset.tiendo;
            document.getElementById('edit_id_detai').value = btn.dataset.detai;
            document.getElementById('edit_ctkhoanchi').value = btn.dataset.ctkhoanchi;
            document.getElementById('edit_donvitinh').value = btn.dataset.donvitinh;
            document.getElementById('edit_soluong').value = btn.dataset.soluong;
            document.getElementById('edit_dongia').value = btn.dataset.dongia;
            document.getElementById('edit_thanhtien').value = btn.dataset.thanhtien;
            document.getElementById('msg-edit-modal').innerHTML = '';

            modal.show();
        });

        const editSoluong = document.getElementById('edit_soluong');
        const editDongia = document.getElementById('edit_dongia');
        const editThanhTien = document.getElementById('edit_thanhtien');

        if (editSoluong && editDongia && editThanhTien) {
            const updateThanhTienModal = () => {
                const soluong = parseFloat(editSoluong.value) || 0;
                const dongia = parseFloat(editDongia.value) || 0;
                editThanhTien.value = soluong * dongia;
            };
            editSoluong.addEventListener('input', updateThanhTienModal);
            editDongia.addEventListener('input', updateThanhTienModal);
        }
    });


    // Hiện form khi bấm "Thêm kinh phí"
    document.querySelectorAll('.toggle-kinhphi-form').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const formContainer = document.getElementById(`form-${id}`);
            if (formContainer) {
                formContainer.style.display = (formContainer.style.display === 'none' || formContainer.style.display === '') ? 'block' : 'none';
            }
        });
    });
    // Ẩn form khi bấm "Huỷ"
    document.querySelectorAll('.btn-cancel').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const formContainer = document.getElementById(`form-${id}`);
            if (formContainer) {
                formContainer.style.display = 'none';
            }
        });
    });

    // Tự động tính thành tiền
    document.querySelectorAll('.form-kinhphi').forEach(form => {
        const soluongInput = form.querySelector('input[name="soluong"]');
        const dongiaInput = form.querySelector('input[name="dongia"]');
        const thanhtienInput = form.querySelector('input[name="thanhtien"]');

        function updateThanhTien() {
            const soluong = parseFloat(soluongInput.value) || 0;
            const dongia = parseFloat(dongiaInput.value) || 0;
            thanhtienInput.value = soluong * dongia;
        }
        soluongInput.addEventListener('input', updateThanhTien);
        dongiaInput.addEventListener('input', updateThanhTien);

        // Submit form bằng Fetch API
        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            const id = this.getAttribute('data-id');
            const formData = new FormData(this);
            const csrfToken = this.querySelector('input[name="_token"]')?.value;
            const msgBox = document.getElementById(`msg-${id}`);

            try {
                const res = await fetch(`/tiendo/${id}/themkinhphi`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                });

                const data = await res.json();

                if (!res.ok) {
                    let errorHtml = '';
                    if (data.errors) {
                        for (const key in data.errors) {
                            errorHtml += `<div>${data.errors[key]}</div>`;
                        }
                    } else {
                        errorHtml = `<div>${data.message || 'Lỗi không xác định.'}</div>`;
                    }
                    msgBox.innerHTML = `<div class="alert alert-danger mt-2">${errorHtml}</div>`;
                    return;
                }

                // Thành công
                msgBox.innerHTML = `<div class="alert alert-success mt-2">${data.message}</div>`;
                alert('Thêm kinh phí thành công!');
                this.reset();
                document.getElementById(`form-${id}`).style.display = 'none';
                location.reload();
            } catch (error) {
                msgBox.innerHTML = `<div class="alert alert-danger mt-2">Không thể gửi dữ liệu. Vui lòng thử lại.</div>`;
                alert('Thêm kinh phí thất bại!');
            }
        });
    });
    // Khởi tạo 1 instance modal sản phẩm dùng chung
    const modalSanPhamElement = document.getElementById('modalSanPham');
    let modalSanPhamInstance = null;
    if (modalSanPhamElement) {
        modalSanPhamInstance = new bootstrap.Modal(modalSanPhamElement);
    }
    // Hiện modal thêm sản phẩm khi bấm nút Thêm sản phẩm
    const btnShowModalThemSanPham = document.getElementById('btnShowModalThemSanPham');
    if (btnShowModalThemSanPham && modalSanPhamInstance) {
        btnShowModalThemSanPham.addEventListener('click', function () {
            const form = document.getElementById('formModalSanPham');
            form.reset(); // reset form
            document.getElementById('modal_id_sanpham').value = '';
            // Ẩn cả 2 nhóm nếu có
            if (document.getElementById('group_linkSP')) document.getElementById('group_linkSP').classList.add('d-none');
            if (document.getElementById('group_fileSP')) document.getElementById('group_fileSP').classList.add('d-none');
            if (document.getElementById('modal_linkSP')) document.getElementById('modal_linkSP').required = false;
            if (document.getElementById('modal_fileSP')) document.getElementById('modal_fileSP').required = false;
            document.getElementById('modalSanPhamLabel').innerText = 'Thêm sản phẩm';
            document.getElementById('msg-modal-sanpham').innerHTML = '';
            modalSanPhamInstance.show();
        });
    }
    // Hiện modal sửa sản phẩm khi bấm nút sửa
    if (modalSanPhamInstance) {
        document.querySelectorAll('.btn-edit-sanpham-modal').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const id = btn.getAttribute('data-id');
                const tenSP = btn.getAttribute('data-tensp');
                const linkSP = btn.getAttribute('data-linksp');
                document.getElementById('modal_id_sanpham').value = id || '';
                document.getElementById('modal_tenSP').value = tenSP || '';
                document.getElementById('modal_linkSP').value = linkSP || '';
                document.getElementById('modalSanPhamLabel').innerText = 'Sửa sản phẩm';
                document.getElementById('msg-modal-sanpham').innerHTML = '';
                modalSanPhamInstance.show();
            });
        });
    }
    // Khi chọn loại nhập
    document.getElementById('modal_loaiSP').addEventListener('change', function () {
        const groupLink = document.getElementById('group_linkSP');
        const groupFile = document.getElementById('group_fileSP');
        const inputLink = document.getElementById('modal_linkSP');
        const inputFile = document.getElementById('modal_fileSP');

        if (this.value === 'link') {
            groupLink.classList.remove('d-none');
            groupFile.classList.add('d-none');
            inputLink.required = true;
            inputFile.required = false;
        }
        else if (this.value === 'file') {
            groupFile.classList.remove('d-none');
            groupLink.classList.add('d-none');
            inputFile.required = true;
            inputLink.required = false;
        }
        else {
            groupLink.classList.add('d-none');
            groupFile.classList.add('d-none');
            inputLink.required = false;
            inputFile.required = false;
        }
    });

    const formSanPham = document.getElementById('formModalSanPham');
    if (formSanPham) {
        formSanPham.addEventListener('submit', async function (e) {
            e.preventDefault();
            const id_detai = document.getElementById('edit_id_detai').value;
            const msgBox = document.getElementById('msg-modal-sanpham');
            const formData = new FormData(this);
            const url = `/detai/${id_detai}/sanpham`;
            console.log('Submitting form to:', url);
            try {
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': this.querySelector('input[name="_token"]')?.value
                    },
                    body: formData
                });
                const data = await res.json();
                if (!res.ok || !data.success) {
                    msgBox.innerHTML = `<div class=\"alert alert-danger mt-2\">${data.message || 'Lỗi không xác định.'}</div>`;
                    return;
                }
                msgBox.innerHTML = `<div class=\"alert alert-success mt-2\">${data.message}</div>`;
                setTimeout(() => { location.reload(); }, 1000);
            } catch (error) {
                msgBox.innerHTML = `<div class=\"alert alert-danger mt-2\">Không thể gửi dữ liệu. Vui lòng thử lại.</div>`;
            }
        });
    }
}
// Hàm xoá kinh phí
window.deleteKinhPhi = async function (id_kinhphi, id_detai, id_tiendo) {
    if (!confirm('Bạn có chắc muốn xoá kinh phí này?')) return;
    try {
        const res = await fetch(`/detai/${id_detai}/tiendo/${id_tiendo}/kinhphi/${id_kinhphi}`, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
            }
        });
        const data = await res.json();
        if (res.ok && data.success) {
            alert('Xoá kinh phí thành công!');
            location.reload();
        } else {
            alert(data.message || 'Xoá thất bại!');
        }
    } catch (error) {
        alert('Lỗi khi xoá kinh phí!');
    }
}
// Hàm xoá sản phẩm
window.xoaSanPham = async function (id_sanpham) {
    if (!confirm('Bạn có chắc muốn xoá sản phẩm này?')) return;
    try {
        const res = await fetch(`/detai/xoasanpham/${id_sanpham}`, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
            }
        });
        const data = await res.json();
        if (res.ok && data.success) {
            alert('Xoá sản phẩm thành công!');
            location.reload();
        } else {
            alert(data.message || 'Xoá thất bại!');
        }
    } catch (error) {
        alert('Lỗi khi xoá sản phẩm!');
    }
}
