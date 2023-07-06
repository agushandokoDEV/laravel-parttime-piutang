$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#usulans_id").select2();
    $("#usulans_id").change(function () {
        let usulans_id = $(this).val();
        $.ajax({
            url: "/json/piutangsById",
            method: "POST",
            data: {
                usulans_id: usulans_id,
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                if (response.data.length > 0) {
                    $("#no_skpd").val(response.data[0].nama_peminjam);
                    $("#users_id").val(response.data[0].user.id);
                } else {
                    $("#no_skpd").val("");
                }
            },
            error: function (err) {
                console.log(err);
            },
        });
    });
});
