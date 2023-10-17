function calcularPTyPorciento(pvpField, porcientoField, ptField) {
    var pvp = parseFloat($(pvpField).val());
    var porciento = parseFloat($(porcientoField).val());
    var pt = pvp * (1 + porciento / 100);
    $(ptField).val(pt.toFixed(2));
}

$(document).ready(function () {
    // Capturar el evento de cambio en el campo "PVP"
    $(".modal-pvp").on("change", function () {
        var ptField = $(this).closest(".modal-content").find(".modal-pt");
        var porcientoField = $(this).closest(".modal-content").find(".modal-porciento");
        calcularPTyPorciento(this, porcientoField, ptField);
    });

    // Capturar el evento de cambio en el campo "Porciento"
    $(".modal-porciento").on("change", function () {
        var ptField = $(this).closest(".modal-content").find(".modal-pt");
        var pvpField = $(this).closest(".modal-content").find(".modal-pvp");
        calcularPTyPorciento(pvpField, this, ptField);
    });

    // Capturar el evento de cambio en el campo "PT"
    $(".modal-pt").on("change", function () {
        var pt = parseFloat($(this).val());
        var pvpField = $(this).closest(".modal-content").find(".modal-pvp");
        var porcientoField = $(this).closest(".modal-content").find(".modal-porciento");
        var pvp = parseFloat($(pvpField).val());
        var porciento = ((pt - pvp) / pvp) * 100;
        $(porcientoField).val(porciento.toFixed(2));
    });

});