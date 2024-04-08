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
            <!-- Start Class input section-->
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create Class</h4>
                        <p class="card-description">

                        </p>
                        <form class="forms-sample" action="{{ route('class_input') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>class</label>
                                <input type="text" class="form-control" id="Edit_class_name" name="class_name">
                                <span style="color:red"> @error ('class_name') {{ $message }} @enderror </span>
                            </div>
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="date" class="form-control" id="str_date" name="str_date">
                                <span style="color:red"> @error ('str_date') {{ $message }} @enderror </span>
                            </div>
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Save</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Class input section -->

            <!-- Start Subject input section -->
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Subject And Schema</h4>
                        <p class="card-description">

                        </p>
                        <form class="forms-sample" method="POST" action="{{ route('Subject_input') }}">
                            @csrf
                            <div class="form-group">
                                <label>Subject And Schema</label>
                                <input type="text" class="form-control" id="subject_name" name="subject_name">
                                <span style="color:red"> @error ('subject_name') {{ $message }} @enderror </span>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Save</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Subject input section -->
            <!-- == End input sections == -->


            <!-- === Start View Section ==-->
            <div class="col-12 grid-margin stretch-card">
                <!-- Start Class table -->
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Class Details</h4>
                            <table id="class" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Class Code</th>
                                        <th>Class</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getClassData as $classData)
                                    <tr id="classId{{ $classData->	id }}">
                                        <td>{{ $classData->	id }}</td>
                                        <td>{{ $classData->	dpcclass }}</td>
                                        <td>{{ $classData->	start_date }}</td>
                                        <td>{{ $classData->	end_date }}</td>
                                        <td>
                                            <div class="row">
                                                <button type="button" class="btn btn-warning btn-sm h6 mr-1"
                                                    value="{{ $classData->id }}" id="edit_class"><i
                                                        class="bi bi-pen"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm h6 mr-1"
                                                    value="{{ $classData->id }}" id="delete_class"><i
                                                        class="bi bi-trash"></i></button>
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
                <div class="col-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Subject and schema Details</h4>
                            <table id="subject" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Subject Code</th>
                                        <th>Subject</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getSubjectData as $subjectData)
                                    <tr id="subjectId{{ $subjectData->id }}">
                                        <td>{{ $subjectData->id }}</td>
                                        <td>{{ $subjectData->subject  }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm h6 mr-1"
                                                value="{{ $subjectData->id }}" id="edit_subject" data-toggle="modal"><i
                                                    class="bi bi-pen"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm h6 mr-1"
                                                value="{{ $subjectData->id }}" id="delete_subject"><i
                                                    class="bi bi-trash"></i></button>
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
    <!-- Start Model for Edit the Class-->
    <div class="modal fade modal-open-left" id="leftModal_Class" tabindex="-1" role="dialog"
        aria-labelledby="leftModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="leftModalLabel">Edit <span id="Which_edit_table"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal content goes here -->
                    <form id="class_form" method="GET"
                        action="{{ route('class.edit', ['class_id' => '_id_placeholder__']) }}">
                        @csrf
                        <input type="hidden" class="form-control" id="class_id" name="class_id">
                        <div class="form-group">
                            <label for="name">Class name</label>
                            <input type="text" class="form-control" id="class_name" name="dpcclass">
                        </div>

                        <div class="form-group" id="class_option1">
                            <label for="stardate_edit"><span id="start_date_edit">Start Date</span></label>
                            <input type="date" class="form-control" id="stardate_edit" name="start_date">
                        </div>
                        <div class="form-group" id="class_option2">
                            <label for="enddate_edte"><span id="end_date_edit">End date</span></label>
                            <input type="date" class="form-control" id="enddate_edte" name="end_date">
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- End Model for Edit  the Class-->

    <!-- Start Model for Edit the Subject-->
    <div class="modal fade modal-open-left" id="leftModal_subject" tabindex="-1" role="dialog"
        aria-labelledby="leftModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="leftModalLabel">Edit <span id="Which_edit_table"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal content goes here -->
                    <form id="subject_form" method="GET"
                        action="{{ route('subject.edit', ['subject_id' => '__subject_id_placeholder__']) }}">
                        @csrf
                        <input type="hidden" class="form-control" id="subject_id" name="subject_id">
                        <div class="form-group">
                            <label for="name">Subject name</label>
                            <input type="text" class="form-control" id="subject_name" name="subject_name_edit">
                            <span style="color:red"> @error ('subject_name_edit') {{ $message }} @enderror </span>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- End Model for Edit  the Subject-->
    @push('scripts')
    <!-- Start DataTable Script Link -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <!-- // End DataTale Script link -->

    <!-- // Start Sweet model script link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <!-- // End Sweet Alert script link -->

    {{-- Disabled Backdate --}}
    <script src="{{ asset('assets/js/disabledBackdate.js') }}"></script>
    <script src="{{ asset('assets/js/tableLinkWithdataTBl.js') }}"></script>
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
            >>Edit for Class
            */
            $(document).on('click', '#edit_class', function () {
                // Get the value of the clicked button
                var class_id = $(this).val();
                $('#class_id').val(class_id);
                $('#leftModal_Class').modal('show');
                var formAction =
                "{{ route('class.edit', ['class_id' => '__class_id_placeholder__']) }}";
                formAction = formAction.replace('__class_id_placeholder__', class_id);
                $('#class_form').attr('action', formAction);
                $('#leftModal_Class').modal('show');

            });

            /*
            >>Edit for Subject
            */
            $(document).on('click', '#edit_subject', function () {
                // Get the value of the clicked button
                var subject_id = $(this).val();
                $('#subject_id').val(subject_id);
                var formAction =
                    "{{ route('subject.edit', ['subject_id' => '__subject_id_placeholder__']) }}";
                formAction = formAction.replace('__subject_id_placeholder__', subject_id);
                $('#subject_form').attr('action', formAction);
                $('#leftModal_subject').modal('show');
            });


            /*
            >>Delete for class
            */
            $(document).on('click', '#delete_class', function () {
                // Get the value of the clicked button
                var id = $(this).val();
                var del_URL = "/administrativehub.Class.delete/";
                var what_function = "class";
                deleteDataOfTable(id, del_URL, what_function);
            });
            /*
            >>Delete for Subject
            */
            $(document).on('click', '#delete_subject', function () {
                // Get the value of the clicked button
                var id = $(this).val();
                var del_URL = "/administrativehub.subject.delete/";
                var what_function = "subject";
                deleteDataOfTable(id, del_URL, what_function);

            });

            //>> Delete class
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
                                if (what_function == "class") {
                                    $('#classId' + id).remove();
                                    success();
                                }
                                //if subject
                                else if (what_function == "subject") {
                                    $('#subjectId' + id).remove();
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
