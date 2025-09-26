jQuery.extend(jQuery.fn.dataTableExt.oSort, {
    "date-br-pre": function(a) {
        if (a == null || a == "") {
            return 0;
        }
        var brDatea = a.split("/");
        return (brDatea[2] + brDatea[1] + brDatea[0]) * 1;
    },

    "date-br-asc": function(a, b) {
        return a < b ? -1 : a > b ? 1 : 0;
    },

    "date-br-desc": function(a, b) {
        return a < b ? 1 : a > b ? -1 : 0;
    }
});

$(document).ready(function() {
    $(".simple-datatable").DataTable({ 
        info: false,
        paging: true,
        searching: true,
        responsive: true,
        columnDefs: [
            { targets: 'no-sort', orderable: false }
        ],
        language: {
            lengthMenu: "Mostrar _MENU_ itens por página",
            zeroRecords: "Desculpe, não encontramos nenhum registro ...",
            info: "Exibindo página _PAGE_ de _PAGES_",
            infoEmpty: "Nenhum registro disponível ...",
            infoFiltered: "(filtrado de _MAX_ registros)",
            search: "Buscar:",
            zeroRecords: "Desculpe, não encontramos nenhum registro...",
            paginate: {
                first: "Primeiro",
                last: "Último",
                next: "Próximo",
                previous: "Anterior"
            },
            buttons: {
                selectAll: "Select all items",
                selectNone: "Select none"
            }
        }
    });


    $(".dt-dash").DataTable({ 
        info: false,
        paging: false,
        searching: false,
        responsive: true,
        columnDefs: [
            { targets: 'no-sort', orderable: false }
        ],
        language: {
            lengthMenu: "Mostrar _MENU_ itens por página",
            zeroRecords: "Desculpe, não encontramos nenhum registro ...",
            info: "Exibindo página _PAGE_ de _PAGES_",
            infoEmpty: "Nenhum registro disponível ...",
            infoFiltered: "(filtrado de _MAX_ registros)",
            search: "Buscar:",
            zeroRecords: "Desculpe, não encontramos nenhum registro...",
            paginate: {
                first: "Primeiro",
                last: "Último",
                next: "Próximo",
                previous: "Anterior"
            },
            buttons: {
                selectAll: "Select all items",
                selectNone: "Select none"
            }
        }
    });
    
    $("#focus_filter input").focus();
});