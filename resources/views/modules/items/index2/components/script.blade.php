<script src="{{asset('assets/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('assets/bower_components/sweet-alert/sweetalert.min.js')}}"></script>
<script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.5/js/dataTables.bootstrap.js"></script>
<script src="https://cdn.datatables.net/select/2.1.0/js/dataTables.select.js"></script>
<script>
    $(document).ready(function () {
        $('#items-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('item.index2') }}',
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Turkish.json'
            },
            columns: [
                {
                    orderable: false,
                    render: DataTable.render.select(),
                    targets: 0
                },
                {data: 'name', name: 'name'},
                {data: 'quantity', name: 'quantity', searchable: false},
                {data: 'last_purchase_price', name: 'last_purchase_price', defaultContent: '0.00', searchable: false},
                {data: 'last_sales_price', name: 'last_sales_price', defaultContent: '0.00', searchable: false},
                {data: 'profit', name: 'profit', searchable: false, defaultContent: '0.00'},
                {data: 'server_name', name: 'servers.name'},
                {data: 'user_name', name: 'users.name'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            }
        });
    });
</script>

<script>
    $('body').on('keypress', function (e) {
        var key = (e.keyCode || e.which);
        if (key == 13 || key == 3) {
            $('#saveItem').click();
        }
    });
    $('.select2').select2({
        dropdownAutoWidth: true,
    });

    $('#saveItem').on('click', function () {
        var name = $('#name').val();
        var description = $('#description').val();
        var note = $('#note').val();
        var server_id = $('#server_id').val();
        var id = $('#id').val();

        var data = {
            id: id,
            name: name,
            description: description,
            note: note,
            server_id: server_id,
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            type: 'POST',
            url: '{{ route('item.store') }}',
            data: data,
            success: function (response) {
                window.location.reload();
            },
            error: function (response) {
                console.log(response);
                var errors = response.responseJSON.errors;
                var errorHtml = '<div class="alert alert-danger"><ul>';
                $.each(errors, function (key, value) {
                    errorHtml += '<li>' + value + '</li>';
                });
                errorHtml += '</ul></div>';
                $('#error-container').html(errorHtml);
            }
        });
    });

    function getItem(id) {
        $('#name').val('');
        $('#description').val('');
        $('#note').val('');
        $('#server_id').val('');
        $('#id').val('');

        $.ajax({
            type: 'GET',
            url: '{{ route('item.edit') }}',
            data: {id: id},
            success: function (response) {
                $('#itemModal').modal('show');
                $('#name').val(response.name);
                $('#description').val(response.description);
                $('#note').val(response.note);
                $('#server_id').val(response.server_id);
                $('#id').val(response.id);
            },
            error: function (response) {
                console.log(response);
            }
        });
    }

    function deleteItem(id) {
        swal({
            title: "İtemi silmek istediğinize emin misiniz?",
            icon: "error",
            buttons: true,
            dangerMode: true,

        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '{{route('item.delete')}}',
                    type: 'DELETE',
                    data: {
                        id: id,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (response) {
                        swal("İşlem tamamlandı", {
                            icon: "success",
                            timer: 3000
                        });
                        $('tr[data-id="' + id + '"]').fadeOut(1500, function () {
                            $(this).remove();
                        });
                    }.bind(this),
                    error: function (response) {
                        console.log(response);
                        swal("Bir sorun oluştu".response, {
                            icon: "error",
                            timer: 3000
                        });
                    }
                })
            }
        });
    }

    $("#deleteSelected").on('click', function () {

        const table = new DataTable('#items-table');

        var selectedItems = table.rows('.selected').data().toArray().map(function (item) {
            return item.id;
        });

        swal({
            title: "Seçilen itemleri silmek istediğinize emin misiniz?",
            icon: "error",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '{{route('item.delete')}}',
                    type: 'DELETE',
                    data: {
                        id: selectedItems,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (response) {
                        swal("İşlem tamamlandı", {
                            icon: "success",
                            timer: 3000
                        });
                        table.rows('.selected').nodes().to$().fadeOut(1500, function () {
                            table.rows('.selected').remove().draw();
                        });
                    }.bind(this),
                    error: function (response) {
                        console.log(response);
                        swal("Bir sorun oluştu".response, {
                            icon: "error",
                            timer: 3000
                        });
                    }
                })
            }
        });
    });

    $("#saveFromExcel").on('click', function () {
        var file = $('#file')[0].files[0];
        var formData = new FormData();
        formData.append('file', file);
        formData.append('_token', '{{csrf_token()}}');

        $.ajax({
            url: '{{route('item.import')}}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                window.location.reload();
            },
            error: function (response) {
                console.log(response);
                var errors = response.responseJSON.errors;
                var errorHtml = '<div class="alert alert-danger"><ul>';
                $.each(errors, function (key, value) {
                    errorHtml += '<li>' + value + '</li>';
                });
                errorHtml += '</ul></div>';
                $('#error-container-import').html(errorHtml);
            }
        });
    });
</script>
