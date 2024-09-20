<script src="{{asset('assets/bower_components/sweet-alert/sweetalert.min.js')}}"></script>
<script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.5/js/dataTables.bootstrap.js"></script>
<script src="https://cdn.datatables.net/select/2.1.0/js/dataTables.select.js"></script>

<script>
    $('body').on('keypress', function (e) {
        var key = (e.keyCode || e.which);
        if (key == 13 || key == 3) {
            $('#saveItemTransaction').click();
        }
    });

    $("#item-transaction-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('item.transactions', ['id' => $item->id]) }}', // id parametresi burada verilmiş
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Turkish.json'
        },
        columns: [
            {
                orderable: false,
                render: DataTable.render.select(),
                targets: 0
            },
            {
                data: 'type', name: 'type', render: function (data, type, row) {
                    switch (data) {
                        case 1:
                            return 'Alış';
                        case 2:
                            return 'Satış';
                        default:
                            return 'Bilinmiyor';
                    }
                }

            },
            {data: 'quantity', name: 'quantity', searchable: false},
            {data: 'price', name: 'price', defaultContent: '0.00', searchable: false},
            {data: 'created_at', name: 'created_at'},
            {data: 'item.user.name', name: 'item.user.name'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        select: {
            style: 'multi',
            selector:
                'td:first-child'
        }
    })
    ;

    $('#saveItemTransaction').on('click', function () {
        var id = $('#id').val();
        var item_id = $('#item_id').val();
        var type = $('#type').val();
        var price = $('#price').val();
        var quantity = $('#quantity').val();


        var data = {
            id: id,
            item_id: item_id,
            type: type,
            price: price,
            quantity: quantity,
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            type: 'POST',
            url: '{{ route('item.transactionStore') }}',
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
                $('#error-transaction-container').html(errorHtml);
            }
        });
    });

    function getItemTransaction(id) {
        $('#id').val('');
        $('#item_id').val('');
        $('#type').val('');
        $('#price').val('');
        $('#quantity').val('');

        $.ajax({
            type: 'GET',
            url: '{{ route('transaction.edit') }}',
            data: {id: id},
            success: function (response) {
                $('#itemTransactionModal').modal('show');
                $('#item_id').val(response.item_id);
                $('#type').val(response.type);
                $('#price').val(response.price);
                $('#quantity').val(response.quantity);
                $('#id').val(response.id);
            },
            error: function (response) {
                console.log(response);
            }
        });
    }

    function deleteItemTransaction(id) {
        swal({
            title: "İtem hareketini silmek istediğinize emin misiniz?",
            icon: "error",
            buttons: true,
            dangerMode: true,

        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '{{route('transaction.delete')}}',
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

    function calculatePrice() {
        var price = $('#price').val();
        var quantity = $('#quantity').val();


        var price_with_tax = (price * quantity) - ((price * quantity) * 0.03);
        $('#price_with_vat').val(price_with_tax);

    }
</script>
