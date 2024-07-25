"use strict";

$("#toastr-1").click(function () {
    iziToast.info({
        title: "Login Sukses!",
        position: "topRight",
    });
});

$("#toastr-2").click(function () {
    iziToast.success({
        title: "Registrasi Pegawai Sukses!",
        position: "topRight",
    });
});

$("#toastr-3").click(function () {
    iziToast.error({
        title: "Username & Password Salah",
        message: "Silahkan Login Kembali",
        position: "topRight",
    });
});

$("#toastr-4").click(function () {
    iziToast.success({
        title: "Pengaduan telah diubah!",
        position: "topRight",
    });
});

$("#toastr-5").click(function () {
    iziToast.success({
        title: "Pengaduan telah dihapus",
        position: "topRight",
    });
});

$("#toastr-6").click(function () {
    iziToast.success({
        title: "Pengaduan telah ditambahkan",
        position: "topRight",
    });
});

$("#toastr-7").click(function () {
    iziToast.warning({
        title: "Pengaduan telah selesai dan telah ditutup",
        position: "topRight",
    });
});

$("#toastr-8").click(function () {
    iziToast.show({
        title: "Registrasi Admin Sukses!",
        position: "topRight",
    });
});

$("#toastr-9").click(function () {
    iziToast.show({
        title: "Pengaduan berhasil dipending!",
        position: "topRight",
    });
});

$("#toastr-9").click(function () {
    iziToast.show({
        title: "Pengaduan telah terselesaikan!",
        position: "topRight",
    });
});

$("#toastr-9").click(function () {
    iziToast.show({
        title: "Follow Up Pengaduan telah terkirim!",
        position: "topRight",
    });
});
