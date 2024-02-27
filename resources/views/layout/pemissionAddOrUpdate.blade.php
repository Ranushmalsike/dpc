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
            <!-- Start permission input section-->
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Permission</h4>
                        <p class="card-description">
                        </p>
                        <!--Start staff or teacher permission section-->
                        @forelse($getStaff as $staff)
                        <!-- Start Staff permission -->
                        @if($staff->roleType == "staff")
                        <div class="row">

                            <div class="col-sm-4">
                                <h5 class="text-info"><u><b> >> Normal section</b></u></h5>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="1"
                                        id="flexCheckDefault_hmpg">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Dashboard
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="2"
                                        id="flexCheckDefault_ownprlsec">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Change Password and add email
                                    </label>
                                </div>
                                <h5 class="text-info"><u><b> >> Add and maintain section</b></u></h5>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="3"
                                        id="flexCheckDefault_ownprlpasssec">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Add Educator
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="4"
                                        id="flexCheckDefault_addSubj">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Add Subject And Schema
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="5"
                                        id="flexCheckDefault_addclass">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Add Class
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="6"
                                        id="flexCheckDefault_addTeacher">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Arrange Timetable
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="7"
                                        id="flexCheckDefault_Summery_Maintain">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Summery Maintain
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <h5 class="text-info"><u><b> >> Financial section</b></u></h5>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="8"
                                        id="flexCheckDefault_addmonthly_salary_range_allownace">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Define Hourly Pay Criteria
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="9"
                                        id="flexCheckDefault_add_month_salary_gen">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Define Salary Bands
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="10"
                                        id="flexCheckDefault_add_daySalary_gen">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Transport Benefit Criteria
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="11"
                                        id="flexCheckDefault_add_transport_sec">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Detail Salary Criteria (Events/Extras)
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="12"
                                        id="flexCheckDefault_add_monthly_salary_event">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Teacher Pay
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="13"
                                        id="flexCheckDefault_loan_sec">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Credit Section
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="14"
                                        id="flexCheckDefault_add_monthly_salary_event">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Calculation
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <h5 class="text-info"><u><b> >> Report section</b></u></h5>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="15"
                                        id="flexCheckDefault_lookTeacheratten">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Teachers Details
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="16"
                                        id="flexCheckDefault_lookAllTecher_salary">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Teachers Salary Details
                                    </label>
                                </div>

                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="17"
                                        id="flexCheckDefault_Report">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Teacher Attendance Details
                                    </label>
                                </div>

                            </div>
                        </div>
                        <!-- End staff permission -->

                        <!-- Start teacher permission -->
                        @else
                        <div class="row">
                            <div class="col-sm-4">
                                <h5 class="text-info"><u><b> >> Normal section</b></u></h5>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="18"
                                        id="flexCheckDefault_pg1">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Own Profile access
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <h5 class="text-info"><u><b> >> Activity section</b></u></h5>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="19"
                                        id="flexCheckDefault_pg2">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Approve Schedule
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="20"
                                        id="flexCheckDefault_pg3">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        My Performance
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="21"
                                        id="flexCheckDefault_pg6">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Summary Maintain
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <h5 class="text-info"><u><b> >> Report section</b></u></h5>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="22"
                                        id="flexCheckDefault_pg5">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        My salary Report
                                    </label>
                                </div>

                            </div>
                        </div>
                        @endif
                        <!-- End teacher permission -->
                        @empty
                        <p>No staff members found</p>
                        @endforelse
                        <!-- end staff or teacher permission section-->
                        
                        @forelse($getStaff as $forButton)
                       
                        <button type="submit" class="btn btn-primary mr-2" id="passThePermission"
                            value="{{ $forButton->id }}">Add</button>
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
            <!-- End permission section -->

            <!-- Start permission section -->
            <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Permission Details</h4>
                        <table id="permission" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Permission</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($HimOrherPermision as $pmv)
                                <tr id="rmPermission{{ $pmv->pmvid }}">
                                    <td>{{ $pmv->permissionTg }}</td>
                                    <td><!-- Delete -->
                                                <button type="button" class="btn btn-danger btn-sm h6"
                                                    value="{{ $pmv->pmvid }}" id="delete_permissionforUser"><i
                                                        class="bi bi-trash"></i></button>
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
            $('#permission').DataTable({
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

            /*
            >>Delete for permission
            */
            $(document).on('click', '#delete_permissionforUser', function () {
                // Get the value of the clicked button
                var id = $(this).val();
                var del_URL = "/administrativehub.permissionForUser.delete/";
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
                            
                                    $('#rmPermission' + id).remove();
                                    success();
                               
                            }
                        });
                    }
                });

            }

            /**
             * Add permission for user
             */
            const selectedValues = [];
            $("#passThePermission").click(function (e) {
                //e.preventDefault();
                var idOfTheUser = $(this).val();
                var URL_OF_permission_add = "{{ route('AddPermissionForUser') }}";
                selectedValues.length = 0;

                $('input[type=checkbox]:checked').each(function () {
                    const valuseOfthePermission = $(this).val();
                    //alert(valuseOfthePermission);
                    // element == this
                    if (!selectedValues.includes(valuseOfthePermission)) {
                        selectedValues.push(valuseOfthePermission);
                    }

                });


                $.ajax({
                    type: "POST",
                    url: URL_OF_permission_add,
                    data: {
                        selectedValues: selectedValues,
                        idOfTheUser: idOfTheUser
                    }, // Send actual data as JSON object
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', $("meta[name='csrf-token']").attr('content'));
                    },
                    dataType:'json',
                    success: function (response) {
                        if(response.message == 'Permission added successfully'){
                        success();
                        location.reload(true);
                        }

                    }
                    //
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
    // End DataTable Script link
    //
    <!-- content-wrapper ends -->
    <script src="{{ asset('assets/adminHub/js/file-upload.js') }}"></script>
    <script src="{{ asset('assets/adminHub/js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/adminHub/js/select2.js') }}"></script>
    @endpush

    @endsection
