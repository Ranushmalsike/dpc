$(document).ready(function () {
    $('#class, #subject, #creditInfoTb, #Trasport_detail_salary, #Trasport_detail, #PerHourSalary, #permission, #staff, #teacher').DataTable({
        "pagingType": "full_numbers",
        "pageLength": 5,
        "searching": true,
        "fixedHeader": true,
        "responsive": true,
        "scrollX": true,
        order: [
            [0, 'asc']
        ],
        paging: true,
        scrollCollapse: true,
        scrollY: '500px',
        dom: 'Blfrtip',
        buttons: [{
                extend: 'pdf',
                bold: 'true',
                fontSize: '15',
                title: 'Daphne Lord School (Subject And Schema Information)',
                subtitle: 'Line 2 of the subtitle',
                exportOptions: {
                    modifier: {
                        page: 'current'
                    },
                }
            },
            'excel', 'print'
        ]
    });
});