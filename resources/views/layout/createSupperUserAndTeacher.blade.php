@extends('include.commonstr')
@section('css')
<!-- Start Add link for DataTable -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">
<!-- End DataTable link -->
<!-- Start Sweet alert link -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
<!-- End Sweet alert Link -->
<!-- Start Bootstrap icon CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<!-- End Bootstrap Icon CDN -->
<!-- Start for Model Style-->
<style>
    .modal.fade:not(.in).right .modal-dialog {
        -webkit-transform: translate3d(25%, 0, 0);
        transform: translate3d(25%, 0, 0);
    }

</style>
<!-- End for Model Style -->
@endsection
@section('content')

<!-- partial -->
<!-- plugin css for this page -->
<!-- <link rel="stylesheet" href="{{ asset('assets/adminHub/vendors/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/adminHub/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}"> -->
<!-- End plugin css for this page -->
<!-- jQuery -->

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <!-- == Start Input section == -->
            <!-- Start Supper User input section-->
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create Staff</h4>
                        <p class="card-description">

                        </p>
                        <form class="forms-sample" action="{{ route('staff_input') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Staff Username</label>
                                <input type="text" class="form-control" id="supper_user" name="supper_user"
                                    value="{{ old('supper_user') }}">
                                <span style="color:red"> @error ('supper_user') {{ $message }} @enderror </span>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <br>
                                <span style="color:purple">Password must contain :
                                    min:8
                                    [a-zA-Z]
                                    [@$!%*#?&]</span>

                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="pass_staff" name="supper_user_pass">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" id="togglePassword_staff">Show</button>
                                </div>
                                <span style="color:red"> @error ('supper_user_pass') {{ $message }} @enderror </span>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Save</button>
                            
                        </form>

                    </div>
                </div>
            </div>
            <!-- End Supper User section -->

            <!-- Start Teacher section -->
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create Teacher</h4>
                        <p class="card-description">

                        </p>
                        <form class="forms-sample" method="POST" action="{{ route('teacher_input') }}">
                            @csrf
                            <div class="form-group">
                                <label>Teacher Username</label>
                                <input type="text" class="form-control" id="teacher_name" name="teacher_name"
                                    value="{{ old('teacher_name') }}">
                                <span style="color:red"> @error ('teacher_name') {{ $message }} @enderror </span>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <br>
                                <span style="color:purple">Password must contain :
                                    min:8
                                    [a-zA-Z]
                                    [@$!%*#?&]</span>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="pass_teach" name="pass_teacher">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" id="togglePassword_teach">Show</button>
                                </div>
                                <span style="color:red"> @error ('pass_teacher') {{ $message }} @enderror </span>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Save</button>
                            
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Teacher input section -->
            <!-- == End input sections == -->


            <!-- === Start View Section ==-->
            <div class="col-12 grid-margin stretch-card">
                <!-- Start Class table -->
                <div class="col-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Staff Details</h4>
                            <table id="staff" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Staff Code</th>
                                        <th>Staff Username</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getStaff as $getStaff)
                                    <tr id="staffId{{ $getStaff->	id }}">
                                        <td>{{ $getStaff->	id }}</td>
                                        <td>{{ $getStaff->	name }}</td>
                                        <td>
                                            <div class="row">
                                                <!-- edit -->
                                                <button type="button" class="btn btn-warning btn-sm h6 mr-1"
                                                    value="{{ $getStaff->id }}" id="edit_staff"><i
                                                        class="bi bi-pen"></i></button>
                                                <!-- Delete -->
                                                <button type="button" class="btn btn-danger btn-sm h6 mr-1"
                                                    value="{{ $getStaff->id }}" id="delete_staff"><i
                                                        class="bi bi-trash"></i></button>
                                                <!-- Permission -->
                                                <button type="button" class="btn btn-info btn-sm h6 mr-1"
                                                    value="{{ $getStaff->id }}" id="permission_staff">
                                                    <i class="bi bi-key"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <!-- End Class table -->

                <!-- Start Subject table -->
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Teacher Details</h4>
                            <table id="teacher" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Teacher Code</th>
                                        <th>Teacher Username</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getTeacher as $getTeacher)
                                    <tr id="teacherId{{ $getTeacher->id }}">
                                        <td>{{ $getTeacher->id }}</td>
                                        <td>{{ $getTeacher->name  }}</td>
                                        <td>
                                            <div class="row">
                                                <!-- Edit -->
                                                <button type="button" class="btn btn-warning btn-sm h6 mr-1"
                                                    value="{{ $getTeacher->id }}" id="edit_teacher"
                                                    data-toggle="modal"><i class="bi bi-pen"></i></button>
                                                <!-- Delete -->
                                                <button type="button" class="btn btn-danger btn-sm h6 mr-1"
                                                    value="{{ $getTeacher->id }}" id="delete_teacher"><i
                                                        class="bi bi-trash"></i></button>
                                                <!-- Permission -->
                                                <button type="button" class="btn btn-info btn-sm mr-1"
                                                    value="{{ $getTeacher->id }}" id="permission_teacher">
                                                    <i class="bi bi-key"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <!-- End Subject table -->
            </div>
            <!-- == End View Section == -->
        </div>
    </div>
    <!-- Start Model for Edit the staff-->
    <div class="modal fade modal-open-left" id="leftModal_staff" tabindex="-1" role="dialog"
        aria-labelledby="leftModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="leftModalLabel">Add New  <strong>Password of Staff</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal content goes here -->
                    <form id="staff_form" method="GET"
                        action="{{ route('staff.edit', ['staff_id' => '__staff_id_placeholder__']) }}">
                        @csrf
                        <input type="hidden" class="form-control" id="staff_id" name="staff_id">
                        <div class="form-group">
                            <label for="name">New Password for Staff <strong id="staff_name_of_edit"></strong></label>
                            <input type="text" class="form-control" id="staff_password_edit" name="staff_password_edit">
                            <span style="color:red"> @error ('staff_password_edit') {{ $message }} @enderror </span>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Password Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- End Model for Edit  the staff-->

    <!-- Start Model for Edit the teacher-->
    <div class="modal fade modal-open-left" id="leftModal_teacher" tabindex="-1" role="dialog"
        aria-labelledby="leftModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="leftModalLabel">Add new  <strong>Password of Teacher</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal content goes here -->
                    <form id="teacher_form" method="GET"
                        action="{{ route('teacher.edit', ['teacher_id' => '__teacher_id_placeholder__']) }}">
                        @csrf
                        <input type="hidden" class="form-control" id="teacher_id" name="teacher_id">
                        <div class="form-group">
                            <label for="name">New Password for Teacher <strong id="teacher_name_of_edit"></strong></label>
                            <input type="text" class="form-control" id="teacher_name" name="teacher_password_edit">
                            <span style="color:red"> @error ('teacher_password_edit') {{ $message }} @enderror </span>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Password Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- End Model for Edit  the teacher-->
    @push('scripts')
    <!-- Start DataTable Script Link -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <!-- // End DataTale Script link -->

    <!-- // Start Sweet model script link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <!-- // End Sweet Alert script link -->
    
    <script>
        $(document).ready(function () {

            // Start Alert section
            // Success Alert
            function success() {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Your work has been saved",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
            // Fail Alert
            function fail() {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                    footer: ''
                });
            }
            // End Alert Section

            /*
            >> staff table 
            */
            $('#staff').DataTable({
                "pagingType": "full_numbers",
                "pageLength": 5,
                "searching": true,
                "fixedHeader": true,
                "responsive": true,
                "scrollX": true,
                order: [
                    [0, 'desc']
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
            // End staff table

            /*
            >> teacher table 
            */
            $('#teacher').DataTable({
                "pagingType": "full_numbers",
                "pageLength": 5,
                "searching": true,
                "fixedHeader": true,
                "responsive": true,
                "scrollX": true,
                order: [
                    [0, 'desc']
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
            //End  teacher Table

            /*
            >>Edit for staff
            */
            $(document).on('click', '#edit_staff', function () {
                // Get the value of the clicked button
                var staff_id = $(this).val();

                $('#staff_id').val(staff_id);
                $('#leftModal_staff').modal('show');
                var formAction =
                    "{{ route('staff.edit', ['staff_id' => '__staff_id_placeholder__']) }}";
                formAction = formAction.replace('__staff_id_placeholder__', staff_id);
                $('#staff_form').attr('action', formAction);
                $('#leftModal_staff').modal('show');

            });

            /*
            >>Edit for teacher
            */
            $(document).on('click', '#edit_teacher', function () {
                // Get the value of the clicked button
                var teacher_id = $(this).val();
                $('#teacher_id').val(teacher_id);
                var formAction =
                    "{{ route('teacher.edit', ['teacher_id' => '__teacher_id_placeholder__']) }}";
                formAction = formAction.replace('__teacher_id_placeholder__', teacher_id);
                $('#teacher_form').attr('action', formAction);
                $('#leftModal_teacher').modal('show');
            });


            /*
            >>Delete for staff
            */
            $(document).on('click', '#delete_staff', function () {
                // Get the value of the clicked button
                var id = $(this).val();
                var del_URL = "/administrativehub.staff.delete/";
                var what_function = "staff";
                deleteDataOfTable(id, del_URL, what_function);
            });
            /*
            >>Delete for teacher
            */
            $(document).on('click', '#delete_teacher', function () {
                // Get the value of the clicked button
                var id = $(this).val();
                var del_URL = "administrativehub.teacher.delete/";
                var what_function = "teacher";
                deleteDataOfTable(id, del_URL, what_function);

            });

            //>> Delete function
            function deleteDataOfTable(id, del_URL, what_function) {

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to delete this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: del_URL + id,
                            data: {
                                'X-CSRF-TOKEN': $("input[name=_token]").val()
                            },
                            success: function (response) {
                                //if class 
                                if (what_function == "staff") {
                                    $('#staffId' + id).remove();
                                    success();
                                }
                                //if subject
                                else if (what_function == "teacher") {
                                    $('#teacherId' + id).remove();
                                    success();
                                } else {
                                    fail();
                                }
                            }
                        });
                    }
                });
                //alert();

            }


            $(document).on('click', '#permission_staff , #permission_teacher', function () {
                // Get the value of the clicked button
                var id = $(this).val();
                //alert(id);
                 var newPageURL = "/administrativehub.permission/"+id;
                 window.location.href = newPageURL;
                // var del_URL = "administrativehub.teacher.delete/";
                // var what_function = "teacher";
                // deleteDataOfTable(id, del_URL, what_function);

            });

            //Password hidden and show -staff
            document.getElementById('togglePassword_staff').addEventListener('click', function () {
                var passwordInput = document.getElementById('pass_staff');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    document.getElementById('togglePassword_staff').textContent = 'Hide';
                } else {
                    passwordInput.type = 'password';
                    document.getElementById('togglePassword_staff').textContent = 'Show';
                }
            });
            //Password hidden and show - teach
            document.getElementById('togglePassword_teach').addEventListener('click', function () {
                var passwordInput = document.getElementById('pass_teach');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    document.getElementById('togglePassword_teach').textContent = 'Hide';
                } else {
                    passwordInput.type = 'password';
                    document.getElementById('togglePassword_teach').textContent = 'Show';
                }
            });

            /*
             >> Insert function of Alert Section
            */
            @if(Session::get('success'))
            success();
            @endif
            @if(Session::get('fail'))
            fail();
            @endif

        });

    </script>
    // End DataTable Script link
    //
    <!-- content-wrapper ends -->
    <script src="{{ asset('assets/adminHub/js/file-upload.js') }}"></script>
    <script src="{{ asset('assets/adminHub/js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/adminHub/js/select2.js') }}"></script>
    @endpush

    @endsection
