@props(['id'=>'', 'mass'=>''])
<script>
    c1 = $('#{{$id}}').DataTable({
        // headerCallback: function (e, a, t, n, s) {
        //     e.getElementsByTagName("th")[0].innerHTML = '<label class="new-control new-checkbox checkbox-outline-info m-auto">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
        // },
        // columnDefs: [{
        //     targets: 0, width: "30px", className: "", orderable: !1, render: function (e, a, t, n) {
        //         return '<label class="new-control new-checkbox checkbox-outline-info  m-auto">\n<input type="checkbox" class="new-control-input child-chk select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
        //     }
        // }],
        // select: {
        //     style: 'multi',
        //     selector: '.child-chk'
        // },
        rowId: 0,
        drawCallback: function () {
            $('.paginate_button.next:not(.disabled)', this.api().table().container())
                .on('click', function () {
                    feather.replace()
                });
            $('.paginate_button.page-item:not(.disabled)', this.api().table().container())
                .on('click', function () {
                    feather.replace()
                });

        },
        dom: 'lBfrtip<"actions">',
        buttons: [
            {
                extend: 'copy',
                className: 'btn btn-primary',
                text: 'Copy',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                className: 'btn btn-primary',
                text: 'Excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                className: 'btn btn-primary',
                text: 'PDF',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                className: 'btn btn-primary',
                text: 'Print',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ],
        'language': {
            "paginate": {
                "first": "First",
                "last": "Last",
                "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                "next": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
            },
        },
        "lengthMenu": [5, 10, 25, 50, 100],
        "pageLength": 5
    });

    // multiCheck(c1);
</script>
@push('css')
    <style>
        .dataTables_length {
            display: inline-block;
        }

        .dt-buttons {
            display: inline-block;
            margin-left: 30px;
        }

        .dataTables_filter {
            display: inline-block;
            float: right;
        }

        .dataTables_paginate {
            float: right;
        }
    </style>
@endpush
