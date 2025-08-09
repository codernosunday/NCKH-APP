import './bootstrap';
import { DangKyDeTai } from './pages/Formdangkydetai.js';
import { DeTaiCaNhan } from './pages/Detaithuchien.js';
import { TrangChu } from './pages/trangchu.js';
import { thongTinCaNhan } from './pages/thongtincanhan.js';
import { ChonNamQuanLyDeTai } from './pages/quanlydetai.js';
document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('dangKyDeTaiForm')) {
        DangKyDeTai();
    }
    if (document.getElementById('trangdetaicanhan')) {
        DeTaiCaNhan();
    }
    if (document.getElementById('trang-chu')) {
        TrangChu();
    }
    if (document.getElementById('ttcnForm')) {
        thongTinCaNhan();
    }
    if (document.getElementById('ds-detai-theonam')) {
        ChonNamQuanLyDeTai();
    }
});
