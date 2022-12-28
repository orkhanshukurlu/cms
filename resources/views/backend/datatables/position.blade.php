<script>
    var table = $('#datatable').DataTable({
        pageLength: 10,
        language: {
            url: '{{ asset('backend/js/az.json') }}'
        },
        ajax: {
            url:  '{{ route('api.positions') }}',
            type: 'GET'
        },
        serverSide: true,
        processing: true,
        columns: [
            {data: 'id'},
            {data: 'name'},
            {data: 'status'},
            {data: 'actions'}
        ],
        columnDefs: [
            {
                'targets':   [3],
                'orderable': false
            }
        ]
    })

    $(document).on('click', '.delete', function(e) {
        e.preventDefault()

        {!! confirm() !!}.then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:  $(this).prop('href'),
                    type: 'POST',
                    data: {_method: 'DELETE', _token: '{{ csrf_token() }}'},
                    success: function (result) {
                        if (result.success) {
                            {!! notify('success', __('messages.success.delete')) !!}
                            table.row($(this).parents('tr')).remove().draw()
                        }

                        else if (result.warning) {
                            {!! notify('warning', __('messages.warning.position')) !!}
                        }

                        else if (result.error) {
                            {!! notify('error', __('messages.error.delete')) !!}
                        }

                        else {
                            {!! notify('error', __('messages.error.system')) !!}
                        }
                    },
                    error: function () {
                        {!! notify('error', __('messages.error.system')) !!}
                    }
                })
            }
        })
    })
</script>
