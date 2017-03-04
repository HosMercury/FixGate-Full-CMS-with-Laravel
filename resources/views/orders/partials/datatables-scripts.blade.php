<script src="{{asset('theme/plugins/datatables/jquery.datatables.min.js')}}"></script>
<script src="{{asset('theme/plugins/datatables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function () {
        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            bAutoWidth: false,
            responsive: true,
            dom: 'lB<"date">frtip',
            order: [[{{$order}}, "{{$sort_type}}"]],
            ajax: '/{{$route}}/data',
            columns: [
                    @foreach($cols as $col)
                       {
                    data: '{{$col[0]}}', name: '{{$col[2]}}', width: '{{$col[1]}}'
                },
                @endforeach
        ],
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print',
            ]
        });
        // Setup - add a text input to each footer cell
        $('#table tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });
        // Apply the Column search
        table.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
            //Stop filter when clicking for search
            $('input', this.header()).on('click', function (e) {
                e.stopPropagation();
            });
        });
    });
</script>
