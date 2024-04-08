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
            <!-- Start permission input section-->
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Per One Hour Salary</h4>
                        <form method="POST" action="{{ route('AddTeacherSalaryByStaff') }}">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="TeacherName" class="col-sm-5 col-form-label">Select Teacher</label>
                                <select class="selectTeacher form-control rounded-0" name="TeacherName" id="TeacherName"
                                    placeholder="select Teacher">
                                    <!-- Options will be dynamically added here -->
                                    @foreach($getData as $user)
                                    <option value="{{ $user->user_id }}"> {{ $user->first_name }} &nbsp;
                                        {{ $user->second_name }}</option>
                                    @endforeach
                                </select>
                                <span style="color:red"> @error ('TeacherName') {{ $message }} @enderror </span>
                            </div>
                            <label for="Salary" class="col-sm-6 col-form-label">Per hour salary (1H =
                                LKR)</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">LKR</span>
                                </div>
                                <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)"
                                    id="Salary" name="Salary">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                                <span style="color:red"> @error ('Salary') {{ $message }} @enderror </span>
                            </div>
                            <div class="text-center">
                                <button id="daysalrysave_158" class="btn btn-primary" value="158">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End permission section -->

            <!-- Start permission section -->
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Per Hour Salary Details</h4>
                        <table id="PerHourSalary" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Teacher Code</th>
                                    <th>First Name</th>
                                    <th>Second Name</th>
                                    <th>Year</th>
                                    <th>Salary for one Hour (LKR)</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getslarydata as $slarydata)
                                <tr id="rmPerSalary{{ $slarydata->id }}">
                                    <td>{{ $slarydata->user_id }}</td>
                                    <td>{{ $slarydata->first_name }}</td>
                                    <td>{{ $slarydata->second_name }}</td>
                                    <td>{{ $slarydata->published }}</td>
                                    <td>{{ $slarydata->perHourSalary }}</td>
                                    <td>
                                        <div class="row">
                                            @if($slarydata->Default_set == 0)
                                            <!-- Defualt -->
                                            <button type="button" class="btn btn-warning btn-sm h6 mr-1"
                                                value="{{ $slarydata->id }}" id="Set_Defualt" data-toggle="tooltip"
                                                data-placement="bottom" title="Set Default">
                                                <i class="bi bi-check2-all"></i>
                                            </button>
                                            @else
                                            <p class="mr-1 text-success">Default</p>
                                            @endif
                                            <!-- Look calculation by This block -->
                                            <button type="button" class="btn btn-info btn-sm h6 mr-1"
                                                value="{{ $slarydata->id }}" id="toUserPrivateDetails"
                                                data-toggle="tooltip" data-placement="bottom"
                                                title="Which Calculation By LKR: {{ $slarydata->perHourSalary }}">
                                                <i class="bi bi-calculator-fill"></i>
                                            </button>
                                            <!-- Delete -->
                                            <button type="button" class="btn btn-danger btn-sm h6 mr-1"
                                                value="{{ $slarydata->id }}" id="delete_perSalary" data-toggle="tooltip"
                                                data-placement="bottom" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- End permission input section -->
            <!-- == End input sections == -->
        </div>
    </div>

    @push('scripts')
    <!-- content-wrapper ends -->
    <script src="{{ asset('assets/adminHub/js/file-upload.js') }}"></script>
    <script src="{{ asset('assets/adminHub/js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/adminHub/js/select2.js') }}"></script>

    <!-- Start DataTable Script Link -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Start DataTable Script Link -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js">
    </script>

    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <!-- // End DataTale Script link -->

    <!-- // Start Sweet model script link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <!-- // End Sweet Alert script link -->
    {{-- My script --}}
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
            >>Delete for permission
            */
            $(document).on('click', '#delete_perSalary', function () {
                // Get the value of the clicked button
                var id = $(this).val();
                var del_URL = "/administrativehub/PerHourSalaryBand.delete/";
                deleteDataOfTable(id, del_URL);
            });


            //>> Delete function
            function deleteDataOfTable(id, del_URL) {

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

                                $('#rmPerSalary' + id).remove();
                                success();

                            }
                        });
                    }
                });

            }

            /*
            >>Set Defualt
            */
            $(document).on('click', '#Set_Defualt', function () {
                // Get the value of the clicked button
                var id = $(this).val();
                var del_URL = "/administrativehub/edit/setDefaultSalaryBand/";
                 Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to Confirm this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Confirm it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: del_URL + id,
                    data: {
                        'X-CSRF-TOKEN': $("input[name=_token]").val()
                    },
                    success: function (response) {
                        success();
                        location.reload();
                    }
                });
                }
                });
            });
            //alert();
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


    @endpush

    @endsection
