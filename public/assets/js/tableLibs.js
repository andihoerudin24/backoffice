var $D = {};

let csrf_token = $('meta[name="csrf-token"]').attr("content");
$D = {
    fetchTable: function (
        url,
        type = "GET",
        params,
        columns,
        targetElement,
        options = {}
    ) {
        const jsonOption = {
            processing:
                '<div class=""> <i class="fa fa-spinner fa-spin text-success"></i> </div>',
            language: {
                search: '',
                searchPlaceholder: 'Search',
                sLengthMenu: '_MENU_items',
            },
            searching: false,
            serverSide: true,
            lengthChange: false,
            ordering: false,
            scrollX: true,
            searchDelay: 500,
            order: [],
            columnDefs: [{ width: "5px", targets: [0] }],
            dom: "<'row'<'col-sm-12 col-md-8'Bl><'col-sm-12 col-md-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            ajax: {
                url: url,
                headers: {
                    "X-CSRF-TOKEN": csrf_token
                },
                type: type,
                data: params,
                // beforeSend: function() {
                //     $(".dataTables_processing").css("display", "block");
                //     $(".dataTables_processing").css("z-index", "1000");
                // },
                dataSrc: function (json) {
                    // console.log("DATA SRC: ", json);
                    var { data } = json;
                    json.recordsTotal = data.total;
                    json.recordsFiltered = data.total;
                    return data.data;
                }
            },
            columns: columns,
            responsive: true,
            // initComplete: function(settings, json) {
            //     targetElement.wrap(
            //         "<div style='overflow:auto; width:100% !important;position:relative;'></div>"
            //     );
            // }
        };

        Object.entries(options).forEach(item => {
            jsonOption[item[0]] = item[1];
        });

        const table = targetElement.DataTable(jsonOption);
        return table;
    },
    generateButtonExport: function (
        title,
        typeExport = ["pdf, excel"],
        targetElement
    ) {
        const buttons = {
            pdf: {
                extend: "pdfHtml5",
                text: "PDF Export",
                title: title,
                exportOptions: {
                    columns: ":not(:last-child)"
                },
                orientation: "landscape",
                customize: function (doc) {
                    var colCount = new Array();
                    $(targetElement)
                        .find("tbody tr:first-child td")
                        .each(function () {
                            if ($(this).attr("colspan")) {
                                for (
                                    var i = 1;
                                    i <= $(this).attr("colspan");
                                    $i++
                                ) {
                                    colCount.push("*");
                                }
                            } else {
                                colCount.push("*");
                            }
                        });
                    doc.content[1].table.widths = colCount;
                }
            },
            excel: {
                extend: "excel",
                text: "Excel Export",
                title: title,
                exportOptions: {
                    columns: ":not(:last-child)"
                }
            }
        };

        return typeExport.map(type => buttons[type]);
    },
};
