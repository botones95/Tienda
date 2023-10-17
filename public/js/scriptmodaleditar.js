$(document).ready(function () {
    // Capturar el evento de cambio en el campo "PVP" en el modal de edición
    $("#modalEditar .modal-pvp").on("change", function () {
        var ptField = $("#modalEditar .modal-pt");
        var porcientoField = $("#modalEditar .modal-porciento");
        calcularPTyPorciento(this, porcientoField, ptField);
    });

    // Capturar el evento de cambio en el campo "Porciento" en el modal de edición
    $("#modalEditar .modal-porciento").on("change", function () {
        var ptField = $("#modalEditar .modal-pt");
        var pvpField = $("#modalEditar .modal-pvp");
        calcularPTyPorciento(pvpField, this, ptField);
    });

    // Capturar el evento de cambio en el campo "PT" en el modal de edición
    $("#modalEditar .modal-pt").on("change", function () {
        var pt = parseFloat($(this).val());
        var pvpField = $("#modalEditar .modal-pvp");
        var porcientoField = $("#modalEditar .modal-porciento");
        var pvp = parseFloat($(pvpField).val());
        var porciento = ((pt - pvp) / pvp) * 100;
        $(porcientoField).val(porciento.toFixed(2));
    });
});
