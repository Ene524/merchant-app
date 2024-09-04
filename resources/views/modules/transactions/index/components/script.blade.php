<script src="{{asset('assets/bower_components/sweet-alert/sweetalert.min.js')}}"></script>
<script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.5/js/dataTables.bootstrap.js"></script>

<script>
    $('body').on('keypress', function (e) {
        var key = (e.keyCode || e.which);
        if (key == 13 || key == 3) {
            $('#saveItemTransaction').click();
        }
    });

    $("#itemTransactionTable").DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
        "order": [[0, "desc"]],
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Turkish.json"
        }
    });

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

    function calculatePrice() {
        var price = $('#price').val();
        var quantity = $('#quantity').val();


        var price_with_tax = (price * quantity) - ((price * quantity) * 0.03);
        $('#price_with_vat').val(price_with_tax);

    }
</script>
