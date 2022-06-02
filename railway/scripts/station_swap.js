
    $(document).ready(function() {
    $(".select-swap").on('click', function (ev) {
        swaper();
    });
    });

    function swaper () {
    var co=$(".sw1").val();
    $(".sw1").val($(".sw2").val());
    $(".sw2").val(co);
}