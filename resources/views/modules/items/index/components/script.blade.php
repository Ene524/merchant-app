<script src="{{asset('assets/bower_components/sweet-alert/sweetalert.min.js')}}"></script>
<script>
    $('body').on('keypress', function (e) {
        var key = (e.keyCode || e.which);
        if (key == 13 || key == 3) {
            $('#saveItem').click();
        }
    });</script>

<script>
    $('#saveItem').on('click', function () {
        var name = $('#name').val();
        var description = $('#description').val();
        var note = $('#note').val();
        var id = $('#id').val();

        var data = {
            id: id,
            name: name,
            description: description,
            note: note,
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

</script>
