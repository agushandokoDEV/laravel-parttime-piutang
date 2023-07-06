$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    getCountNotif();
    getNotif();

    function getCountNotif()
    {
        $.ajax({
            url: '/json/notif/count',
            method: 'GET',
            success: function (response) {
                $('#countNotif').html(`<i class="fas fa-bell fa-fw"></i>
                                       <span class="badge badge-danger badge-counter">${response.data}</span>`);
            },
            error: function (err) {
                console.log(err);
            }
        })
    }

    function getNotif()
    {
        $.ajax({
            url: '/json/notif',
            method: 'GET',
            success: function (response) {
                let html = '';
                if (response.data.data.length > 0) {
                    $.each(response.data.data, function (key, val) {
                        console.log(val);
                    let tgl = val.created_at;
                    let date = new Date(tgl); 
                    let day = date.toLocaleString('id-ID', { weekday: 'long' });
                    let dayNumber = date.getDate();
                    let month = date.toLocaleString('id-ID', { month: 'long' });
                    let year = date.getFullYear();
                    html += `<a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-envelope text-white"></i>
                                    </div>
                                </div>
                                <div data-id="${val.id}" id="cekNotif">
                                    <div class="small text-gray-500">${day + ', ' + dayNumber + '-' + month + '-' + year}</div>
                                    <span class="font-weight-bold">Surat ${val.usulan.nomor_surat} Ada Yang Kurang!</span>
                                </div>
                            </a>`
                    });
                } else {
                    html += `<a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-envelope text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <span class="font-weight-bold">Tidak Ada Pemberitahuan</span>
                                </div>
                            </a>`
                    
                }
                $('#notif').html(html)
            },
            error: function (err) {
                console.log(err);
            }
        })
    }

    $(document).on('click', '#cekNotif', function (e) {
        let id = $(this).data('id');
        window.location.href = '/nasabah/status-usulan/dokumen/' + id
        // $.ajax({
        //     url: '/json/notif/' + id,
        //     method: 'GET',
        //     success: function (response) {
        //         console.log(response);
        //         $('#notifModal').modal('show');
        //         $('#notifModalLabel').html('Surat Usulan ' + response.data.usulan.nomor_surat);
        //         $('#pesan').html(response.data.message);
        //     },
        //     error: function (err) {
        //         console.log(err);
        //     }
        // })
    });
});
