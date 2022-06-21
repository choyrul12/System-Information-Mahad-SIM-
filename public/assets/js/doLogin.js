$('form').submit(function (e) {
    var action = $("#action").val()
    e.preventDefault(),
    $.ajax({
        url: action,
        type: "POST",
        data: new FormData(this),
        processData: !1,
        contentType: !1,
        cache: !1,
        async: !1,
        dataType: "JSON",
        success: function (e) {
            switch (e[0]) {
                case "Empty":
                    $(":input").removeClass("is-invalid")
                    $.each( e, function( key, value ) {
                        $("#"+key+"").addClass("is-invalid")
                        $("#"+key+"-feedback").text(value)
                    });
                    break;
                case "Success":
                    location.reload();
                    break;
                case "Failed":
                    $(":input").removeClass("is-invalid")
                    $(".alert").show().text(e.notif),
                    setTimeout(function () {
                        $(".alert").hide();
                    }, 5e3);
                    break;
                default:
                    // location.reload();
            }
        },
    });
});
