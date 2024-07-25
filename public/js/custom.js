/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

// "use strict";

$(document).ready(function () {

    // /pengaduan
    $('#jenis_aduans_id').change(function () {
        if (this.value == '#') {
            $.get('/all-laporan', function (data) {
                addAduanTable(data);
            })
        } else {
            $.get('/getbyjenis/' + this.value, function (data) {
                console.log(data);
                addAduanTable(data);
            });
        }
    })

    // edit data user
    $('.edit-user').click(function () {
        $('#tokoUser').empty();
        var id = $(this).data('id');
        $.get('/users/' + id, function (data) {
            $("#namaUser").val(data.user.name);
            $("#roleUser").val(data.user.role);
            data.toko.forEach(element => {
                $('#tokoUser').append('<option value="' + element.id + '">' +
                    element.nama + '</option>');
            });
            $('#tokoUser').val(data.user.tokos_id)
            $('#form-edit-user').attr("action", "/users/" + id);
            $('#editUser').modal('show');
        });
    })

    // table lihat pengaduan
    function addAduanTable(data) {
        var table = $('.table-pengaduan tbody');
        table.empty();

        data.forEach((element, index) => {
            var newRow = $('<tr>');
            var content = element.user_pekerja ? element.user_pekerja.name : '-';
            var statusBadge;

            switch (element.status) {
                case 'open':
                    statusBadge = '<div class="badge badge-primary">Open</div>';
                    break;
                case 'completed':
                    statusBadge = '<div class="badge badge-success">Completed</div>';
                    break;
                case 'in progress':
                    statusBadge = '<div class="badge badge-danger">In Progress</div>';
                    break;
                case 'pending':
                    statusBadge = '<div class="badge badge-warning">Pending</div>';
                    break;
                default:
                    statusBadge = '<div class="badge badge-secondary">Unknown Status</div>';
                    break;
            }

            var menu = `<div class="dropdown d-inline">
                            <button class="btn btn-primary dropdown-toggle"
                                type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"
                                data-bs-toggle="dropdown">
                                Detail
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item has-icon"
                                    href="/pengaduan/`+ element.id + `/edit"><i
                                        class="fa-regular fa-pen-to-square"></i>Edit
                                    Data</a>
                                <a class="dropdown-item has-icon"
                                    href="/followupkaryawan/`+ element.id + `"><i
                                        class="fa-solid fa-circle-info"></i>Follow Up
                                    Laporan</a>
                            </div>`;
            newRow.append('<td>' + (index + 1) + '</td>');
            newRow.append('<td>' + element.laporan + '</td>');
            newRow.append('<td>' + formatTime(element.created_at) + '</td>');
            newRow.append('<td>' + element.user_pelapor.name + '</td>');
            newRow.append('<td>' + content + '</td>');
            newRow.append('<td>' + statusBadge + '</td>');
            newRow.append('<td>' + menu + '</td>');

            table.append(newRow);
        });
    }


    // pemeliharaan
    $('#data-pengaduan').change(function () {
        if (this.value == '#') {
            $.get('/getlapall', function (data) {
                addDataAduan(data)
            })
        } else {
            $.get('/getJenis/' + this.value, function (data) {
                addDataAduan(data)
            });
        }
    })

    // table data pengaduan
    function addDataAduan(data) {
        var table = $('.table-data-aduan tbody');
        table.empty();

        data.forEach((element, index) => {
            console.log(element.id)
            var newRow = $('<tr>');
            var pekerja = element.user_pekerja ? element.user_pekerja.name : '-';
            var statusBadge;

            switch (element.status) {
                case 'open':
                    statusBadge = '<div class="badge badge-primary">Open</div>';
                    break;
                case 'completed':
                    statusBadge = '<div class="badge badge-success">Completed</div>';
                    break;
                case 'in progress':
                    statusBadge = '<div class="badge badge-danger">In Progress</div>';
                    break;
                case 'pending':
                    statusBadge = '<div class="badge badge-warning">Pending</div>';
                    break;
                default:
                    statusBadge = '<div class="badge badge-secondary">Unknown Status</div>';
                    break;
            }

            newRow.append('<td>' + (index + 1) + '</td>');
            newRow.append('<td>' + element.laporan + '</td>');
            newRow.append('<td>' + formatTime(element.created_at) + '</td>');
            newRow.append('<td>' + element.user_pelapor.toko.nama + '</td>');
            newRow.append('<td>' + element.user_pelapor.name + '</td>');
            newRow.append('<td>' + pekerja + '</td>');
            newRow.append('<td>' + statusBadge + '</td>');
            var dropdown = `
        <td>
            <div class="dropdown d-inline">
                <button class="btn btn-secondary dropdown-toggle" type="button"
                    data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false" data-bs-toggle="dropdown">
                    Detail
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item has-icon edit-data-pengaduan"  
                        data-id="`+ element.id + `" data-toggle="modal"
                        data-target="#modal-edit-pengaduan" >
                        <i class="fa-regular fa-pen-to-square"></i> Follow Up Pengaduan
                    </a>
                </div>
            </div>
        </td>`;

            newRow.append(dropdown);

            table.append(newRow);
        });
    }

    // edit data pengaduan
    $(document).on('click', '.edit-data-pengaduan', function () {
        var id = $(this).data('id');
        console.log(id);
        $.get('/lap/' + id, function (data) {
            $("#dataLaporan").val(data.laporan);
            $("#namaPekerja").val(data.user_pekerja ? data.user_pekerja.name : '-');
            $("#namaPelapor").val(data.user_pelapor.name);
            $('.status-aduan').val(data.status);
            $('#form-edit-pengaduan').attr("action", "/data-pengaduan/" + id);
            $('#modal-edit-pengaduan').modal('show');
        });
    })

    function formatTime(time) {
        var datetime = new Date(time);

        var formattedDate = datetime.getFullYear() + '-' +
            ('0' + (datetime.getMonth() + 1)).slice(-2) + '-' +
            ('0' + datetime.getDate()).slice(-2);

        var formattedTime = ('0' + datetime.getHours()).slice(-2) + ':' +
            ('0' + datetime.getMinutes()).slice(-2) + ':' +
            ('0' + datetime.getSeconds()).slice(-2);

        var formattedDateTime = formattedDate + ' ' + formattedTime;
        return formattedDateTime;
    }
})

