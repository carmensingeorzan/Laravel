$(".deleteProduct").click(function () {
    var id = $(this).data("id");
    var token = $(this).data("token");
    $.ajax(
            {
                url: "user/delete/" + id,
                type: 'DELETE',
                dataType: "JSON",
                data: {
                    "id": id,
                    "_method": 'DELETE',
                    "_token": token,
                },
                success: function (data)
                {
                    if (data.success == true) {
                        $("tr.fade" + id).fadeOut(1000);
                    }
                }
            });
});

$('#search').on('keyup', function () {
    $value = $(this).val();
    $.ajax({
        type: 'get',
        url: 'search',
        data: {'search': $value},
        success: function (data) {
            $('tbody').html(data);
        }
    });
})