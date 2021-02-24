@extends('layouts.main')

@section('title', 'Create User')

@push('styles')
 <!-- Data Table CSS -->
 <link href="{{ asset('vendors/datatables.net-dt/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create User</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">
    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title">
            <span class="pg-title-icon">
                <span class="feather-icon">
                    <i data-feather="user-plus"></i>
                </span>
            </span>Create User
        </h4>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                <button class="btn btn-info mr-2" id="addButton">Add</button>

                <button type="button" class="btn btn-success mr-2 resetAble" id="editButton" disabled>Edit</button>

                <button type="button" class="btn btn-danger mr-2 resetAble" id="deleteButton" disabled>Delete</button>

                <br>
                <br>

                <!-- Modal -->
                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="crud-form" method="post">
                                    <div id="response-message" class="text-center"></div>

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" maxlength="250"
                                            id="username" name="username" placeholder="Contoh : Username" autocomplete="off">
                                        <div class="invalid-feedback validation" data-field="username"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" maxlength="250"
                                            id="name" name="name" placeholder="Contoh : Name" autocomplete="off">
                                        <div class="invalid-feedback validation" data-field="name"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="text" class="form-control" maxlength="250"
                                            id="password" name="password" placeholder="Contoh : Password">
                                        <div class="invalid-feedback validation" data-field="password"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="level">Level</label>
                                        <select class="form-control" id="level" name="level">
                                            <option value="">- Choose level -</option>
                                            <option value="Rpt">Reporter</option>
                                            <option value="Edt">Editor</option>
                                        </select>
                                        <div class="invalid-feedback validation" data-field="level"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="saveButton">Save</button>
                                <button type="button" class="btn btn-success" id="updateButton">Update</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->

                {{-- Table --}}
                <section class="hk-sec-wrapper">

                    <div class="row">
                        <div class="col-sm">
                            <div class="table-wrap">
                                <table id="table" class="table table-hover w-100 display pb-30">

                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                {{-- Table --}}
            </section>

        </div>
    </div>
    <!-- /Row -->
</div>
<!-- /Container -->
@endsection

@push('scripts')
<!-- Data Table JavaScript -->
<script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-dt/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('vendors/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ asset('vendors/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>

<script>
    var column = [{
            data: 'action',
            name: 'action',
            title: `<div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="published" onclick="allChecked(this.checked)">
                        <label class="custom-control-label" for="published"></label>
                    </div>`,
            searchable: false,
            orderable: false,
            className: 'text-center'
        },
        {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            title: 'No',
        },
        {
            data: 'username',
            name: 'username',
            title: 'Username',
        },
        {
            data: 'name',
            name: 'name',
            title: 'Name'
        },
        {
            data: 'level',
            name: 'level',
            title: 'Level'
        },
    ]

    // Show Datatable in every Page Loaded
    $(function() {
        $('#table').DataTable({
            responsive: true,
            autoWidth: false,
            language: { search: "",
            searchPlaceholder: "Search",
            sLengthMenu: "_MENU_items"

            },
            ajax: '{!! route('user.datatable') !!}',
            columns: column
        });
    });

    // For Check All Checkbox
    function allChecked(status) {
        var arrayChecked = document.querySelectorAll('.checkId');
        arrayChecked.forEach(function (check) {
            check.checked = status
        })

        updateCheck('')
    }

    // Disabled / Enable Edit & Delete Button
    function updateCheck(id) {
        var count = document.querySelectorAll('.checkId:checked').length
        var publishedEl = document.querySelectorAll('.checkId:checked')
        var published = (count >= 1) ? publishedEl[0].getAttribute('data-published') : 0
        console.log(parseInt(published))
        // Edit Button
        // Check apakah sudah di Published atau belum, kalau sudah di Published maka Edit nya Disable
        if(parseInt(published) == 1) {
            $('#editButton').prop('disabled', true)
        } else {
            if(count == 1) {
                $('#editButton').prop('disabled', false)
            } else {
                $('#editButton').prop('disabled', true)
            }
        }

        // Delete Button
        if(parseInt(published) == 1) {
            $('#deleteButton').prop('disabled', true)
        } else {
            if(count == 1) {
                $('#deleteButton').prop('disabled', false)
            } else {
                $('#deleteButton').prop('disabled', true)
            }
        }
    }

    // For Refresh Datatable if Data has been Inserted / Updated / Deleted
    function redrawDatatable() {
        $('#table').DataTable().destroy();
        $('#table').html('');

        $('#table').DataTable({
                responsive: true,
                autoWidth: false,
                language: { search: "",
                searchPlaceholder: "Search",
                sLengthMenu: "_MENU_items"

                },
                ajax: '{!! route('user.datatable') !!}',
                columns: column
            });
    }

    // Show Add Modal
    $('#addButton').click(function() {
        $('#crud-form').trigger("reset");
        $('#response-message').html('')
        $('#saveButton').show()
        $('#updateButton').hide()
        $('#modalLabel').text('Tambah Data')
        $('#modal').modal({
            show: true,
            backdrop: 'static',
            keyboard: false
        })
    })

    function resetButton() {
        var arrayButton = document.querySelectorAll('.resetAble');

        arrayButton.forEach(function (button) {
            button.setAttribute('disabled', true)
        })
    }

    //For Insert
    $('#saveButton').click(function(e) {
        e.preventDefault()

        var data = $('#crud-form').serialize()
        var validationEl = $('.validation')

        $.ajax({
            url: '{{ route('user.insert') }}',
            method: 'POST',
            dataType: 'JSON',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            beforeSend: function() {
                $(this).prop('disabled', true)
                $('#response-message').html('')
                $.each(validationEl, function(key, val) {
                    val.innerHTML = ''
                })
            },
            success: function(response) {
                $(this).prop('disabled', false)

                var status = response.status
                var message = response.message

                if(status == 'success') {
                    $('#modal').modal('hide')
                    resetButton()
                    redrawDatatable()
                }

                $('#response-message').html(message)
            },
            error: function(err) {
                $(this).prop('disabled', false)
                if(err.status == 422) {
                    $.each(err.responseJSON.errors, function (i, error) {
                        $('[data-field="'+i+'"]').html(error[0]).css('display', 'block')
                    });
                } else {
                    $('#response-message').html('<div class="alert alert-danger">Ops, ada suatu Masalah di Sistem</div>')
                }

            }
        })

    })

    // Get Data for Edit
    $('#editButton').click(function(e) {
        $('#response-message').html('')
        var id = document.querySelectorAll('.checkId:checked')[0].value

        $.ajax({
            url: '{{ route('user.get') }}/'+id,
            method: 'GET',
            dataType: 'JSON',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                var status = response.status
                var data = response.data

                $('#saveButton').hide()
                $('#updateButton').show()

                if(status == 'success') {
                    for(property in data) {
                        $('#'+property).val(data[property])
                    }

                    $('#username').prop('readonly', true)

                    $('#modalLabel').text('Edit Data')
                    $('#modal').modal({
                        show: true,
                        backdrop: 'static',
                        keyboard: false
                    })
                }
            },
        })
    })

    // For Update
    $('#updateButton').click(function(e) {
        e.preventDefault()

        var data = $('#crud-form').serialize()
        var validationEl = $('.validation')

        $.ajax({
            url: '{{ route('user.update') }}',
            method: 'POST',
            dataType: 'JSON',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                $(this).prop('disabled', true)
                $('#response-message').html('')
                $.each(validationEl, function (key, val) {
                    val.innerHTML = ''
                })
            },
            success: function (response) {
                $(this).prop('disabled', false)

                var status = response.status
                var message = response.message

                if (status == 'success') {
                    $('#modal').modal('hide')
                    resetButton()
                    redrawDatatable()
                }

                $('#response-message').html(message)
            },
            error: function (err) {
                $(this).prop('disabled', false)
                if (err.status == 422) {
                    $.each(err.responseJSON.errors, function (i, error) {
                        $('[data-field="' + i + '"]').html(error[0]).css('display', 'block')
                    });
                } else {
                    $('#response-message').html('<div class="alert alert-danger">Ops, ada suatu Masalah di Sistem</div>')
                }

            }
        })

    })

    // Delete Data
    $('#deleteButton').click(function() {
        var arrayChecked = document.querySelectorAll('.checkId:checked');
        var arrayId = [];

        arrayChecked.forEach(function (check) {
            arrayId.push(check.value)
        })

        var data = {
            id: arrayId
        }

        Swal.fire({
            title: 'Delete Data?',
            text: "Please Ensure Before Confirm!",
            type: "info",
            icon: 'question',
            showCancelButton: true,
            reverseButtons: false,
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return $.ajax({
                    url: '{{ route('user.delete') }}',
                    method: 'POST',
                    dataType: 'JSON',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {

                        var status = response.status
                        var message = response.message

                        if (status == 'success') {
                            Swal.fire(message, "", "success")
                            resetButton()
                            redrawDatatable()
                        } else {
                            Swal.fire(message, "", "error")
                        }
                    },
                    error: function (err) {
                        Swal.fire("Oops, Something went Wrong", "", "error")
                    }
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {

        })

    })


</script>
@endpush
