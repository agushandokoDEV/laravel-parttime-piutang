$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#usulans_id").select2();

    $("#select_STS").select2();

    let row = 1;

    $(document).on("click", "#plus", function (e) {
        e.preventDefault();
        row = row + 1;
        let html = `<tr id="${row}">`;
        html += `<td>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm" data-row="${row}" id="minus"><i class="fas fa-minus"></i></a>
                </td>`;
        html += `<td style="width: 100%">
                        <input type="file" name="docs_STS" class="form-control my-2">
                    </td>`;
        html += "</tr>";

        $("#file_plus").append(html);
    });

    $(document).on("click", "#minus", function (e) {
        e.preventDefault();
        let unrow = $(this).data("row");
        $("#" + unrow).remove();
    });
});
