@extends('include.commonstr')
@section('meta')
 <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
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
                            <div class="form-group mb-2">
                                    <label for="TeacherName" class="col-sm-5 col-form-label">Select Teacher</label>
                                    <select class="selectTeacher form-control rounded-0" name="TeacherName" id="TeacherName"
                                        placeholder="select Teacher">
                                        <!-- Options will be dynamically added here -->
                                        @foreach($getData as $user)
                                        <option value="{{ $user->user_id }}"> {{ $user->first_name }} &nbsp; {{ $user->second_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="Salary" class="col-sm-6 col-form-label">Per hour salary (1H =
                                    LKR)</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">LKR</span>
                                    </div>
                                    <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)"
                                        id="Salary">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button id="daysalrysave_158" class="btn btn-primary" value="158">Add</button>
                                </div>
                    </div>
                </div>
            </div>
            <!-- End permission section -->

            <!-- Start permission section -->
            <div class="col-md-7 grid-margin stretch-card">
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

            /**
             * Permission table
             */
            $('#PerHourSalary').DataTable({
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
                        title: 'Daphne Lord School (Permision Information for User)',
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
            // End permission table


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
