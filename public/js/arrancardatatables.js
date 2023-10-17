$(document).ready(function () {
    var currentPage = window.location.pathname;
    var tableName;
    var exportFilename;

    if (currentPage.includes("/Productos")) {
        tableName = "tablasdatatables-productos";
        exportFilename = "Listado_de_productos";
    } else if (currentPage.includes("/InformesDiarios")) {
        tableName = "tablasdatatables-informesdiarios";
        exportFilename = "Informes_Diarios";
    } else if (currentPage.includes("/InformesMeses")) {
        tableName = "tablasdatatables-informesMeses";
        exportFilename = "Informes_Meses";
    } else if (currentPage.includes("/InformesHistorialPreciosProductos")) {
        tableName = "tablasdatatables-InformesHistorialPreciosProductos";
        exportFilename = "Informes_HistorialPrecios";
    } else if (currentPage.includes("/InformesHistorialVentaProductos")) {
        tableName = "tablasdatatables-informeshistorialventas";
        exportFilename = "Informes_HistorialVenta";
    } else if (currentPage.includes("/Ventas")) {
        tableName = "tablasdatatables-ventas";
        exportFilename = "Ticket";
    } else if (currentPage.includes("/Devoluciones")) {
        tableName = "tablasdatatables-Devoluciones";
        exportFilename = "Devoluciones";
    } else if (currentPage.includes("/Finalizarturno")) {
        tableName = "tablasdatatables-finalizarturno";
        exportFilename = "Total_del_dia";
    }

    $('#' + tableName).DataTable({
        "language": {
            "url": "/js/es-ES.json"
        },
        dom: 'Bflrtip',
        buttons: [
            {
                extend: 'csv',
                text: 'Exportar CSV',
                filename: exportFilename + '.csv',
                attr: {
                    id: 'csv-button'
                }
            },
            {
                extend: 'excel',
                text: 'Exportar Excel',
                filename: exportFilename + '.xlsx',
                attr: {
                    id: 'excel-button'
                }
            },
            {
                extend: 'pdf',
                text: 'Exportar PDF',
                filename: exportFilename + '.pdf',
                attr: {
                    id: 'pdf-button'
                }
            }
        ]
    });
});
