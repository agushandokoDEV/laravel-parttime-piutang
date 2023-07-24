$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#usulans_id").select2();
    $("#usulans_id").change(function () {
        let usulans_id = $(this).val();
        if(usulans_id !=''){
            $.ajax({
                url: "/json/piutangsByNoSurat",
                method: "POST",
                data: {
                    usulans_id: usulans_id,
                },
                dataType: "json",
                success: function (response) {
                    const {data}=response;
                    console.log('response',data.nama_peminjam);
                    // if (response.data.length > 0) {
                    //     $("#no_skpd").val(data.nama_peminjam);
                    //     $("#users_id").val(data.user.id);
                    // } else {
                    //     $("#no_skpd").val("");
                    // }
                    $("#no_skpd").val(data.nama_peminjam);
                    $("#users_id").val(data.user.id);
                },
                error: function (err) {
                    console.log(err);
                },
            });
        }else{
            $("#no_skpd").val('');
            $("#users_id").val('');
        }
        
    });
});
