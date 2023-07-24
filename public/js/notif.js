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
                        // console.log(val);
                    let tgl = val.created_at;
                    let date = new Date(tgl);
                    let day = date.toLocaleString('id-ID', { weekday: 'long' });
                    let dayNumber = date.getDate();
                    let month = date.toLocaleString('id-ID', { month: 'long' });
                    let year = date.getFullYear();

                    let msg_kep_gub = val.message.includes("Surat keputusan Gubernur");
                    let stts_usulan_setuju = val.message.includes("urat usulan telah ditolak");
                    let stts_usulan_tolak = val.message.includes("urat usulan telah ditolak");
                    
                    
                    if(msg_kep_gub || stts_usulan_setuju || stts_usulan_tolak){
                        console.log('stts_usulan_setuju',stts_usulan_setuju);
                    console.log('stts_usulan_tolak',stts_usulan_tolak);
                    console.log('message',val.message)
                        html += `<a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-envelope text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">${day + ', ' + dayNumber + '-' + month + '-' + year}</div>
                                    <span class="font-weight-bold">${val.message}</span>
                                </div>
                            </a>`
                    }else{
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
                    }


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
});
