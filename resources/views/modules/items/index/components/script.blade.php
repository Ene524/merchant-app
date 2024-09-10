<script src="{{asset('assets/bower_components/sweet-alert/sweetalert.min.js')}}"></script>
<script>
    $('body').on('keypress', function (e) {
        var key = (e.keyCode || e.which);
        if (key == 13 || key == 3) {
            $('#saveItem').click();
        }
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

    $('.server-name').on('click', function () {
        var serverId = $(this).data('server-name');
        $('#itemTable tbody tr').each(function () {
            var serverColumnText = $(this).find('td:nth-child(7)').text();
            if (serverColumnText.indexOf(serverId) > -1 || serverId === "") {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    $('#clearFilter').on('click', function () {
        $('#itemTable tbody tr').show();
    });

    $('#selectAll').on('click', function () {
        if ($('#selectAll').data('selected') === 'true') {
            $('.itemCheckbox').prop('checked', false);
            $('#selectAll').data('selected', 'false');
        } else {
            $('.itemCheckbox').prop('checked', true);
            $('#selectAll').data('selected', 'true');
        }

    });

    $("#deleteSelected").on('click', function () {
        var selectedItems = [];
        $('.itemCheckbox:checked').each(function () {
            selectedItems.push($(this).data('id'));
        });

        console.log(selectedItems);

        if (selectedItems.length === 0) {
            swal("Lütfen silmek istediğiniz itemleri seçin", {
                icon: "warning",
                timer: 3000
            });
            return;
        }

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
                        selectedItems.forEach(function (id) {
                            $('tr[data-id="' + id + '"]').fadeOut(1500, function () {
                                $(this).remove();
                            });
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
                //window.location.reload();
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

</script>

<script>
    function submitFormWithServerId(serverId) {
        // Yeni bir input oluştur ve server_id olarak ayarla
        let form = document.querySelector('form');
        let serverInput = document.createElement('input');
        serverInput.type = 'hidden';
        serverInput.name = 'server_id';
        serverInput.value = serverId;

        // Formun içerisine yeni input'u ekle ve formu gönder
        form.appendChild(serverInput);
        form.submit();
    }
</script>
