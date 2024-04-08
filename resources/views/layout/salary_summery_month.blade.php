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
<!-- <link rel="stylesheet" href="{ { asset('assets/adminHub/vendors/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{ { asset('assets/adminHub/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}"> -->
<!-- End plugin css for this page -->
<!-- jQuery -->

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            <!-- Start payment section -->
            <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Salary Details</h4>
                        <table id="PerHourSalary" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>First name</th>
                                    <th>Second Name</th>
                                    <th>Total Balance (LKR)</th>
                                    <th>Calculation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getSalaryByTeacherByTeacher as $myData)
                                <tr>
                                    <td>{{ $myData->today_day }}</td>
                                    <td>{{ $myData->first_name }}</td>
                                    <td>{{ $myData->second_name }}</td>
                                    <td>{{ $myData->netSumV }}.00</td>
                                    <td>
                                        <!-- Look calculation by This block -->
                                            <button type="button" class="btn btn-info btn-sm h6 mr-1"
                                                value="{{ $myData->user_id }}" value_month="{{ $myData->today_day }}" id="calDetails"
                                                data-toggle="tooltip" data-placement="bottom"
                                                title="Look Calculation Process">
                                                <i class="bi bi-calculator-fill"></i>
                                            </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- End payment  section -->
            <div class="col-md-11 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Salary Details</h4>
                        <table id="calTbl" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th rowspan="2">Year & Month</th>
                                    <th rowspan="2">Description</th>
                                    <th colspan="2">Name</th>
                                    <th colspan="4">Schedule</th>
                                    <th rowspan="2">Additional Payment(LKR)</th>
                                </tr>
                                <tr>
                                    <th colspan="1" data-dt-order="disable">First</th>
                                    <th colspan="1" data-dt-order="disable">Second</th>
                                    <th colspan="1">Date</th>
                                    <th colspan="1">Hour</th>
                                    <th colspan="1">payment(LKR)</th>
                                    <th colspan="1">Transport(LKR)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2024-04</td>
                                    <td>Schedule</td>
                                    <td>amal</td>
                                    <td>xx</td>
                                    <td>2024-04-05</td>
                                    <td>2.00</td>
                                    <td>200.00</td>
                                    <td>100.00</td>
                                    <td>100.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- == End  sections == -->
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
            /**
             * 
             */
                $(document).on('click', '#calDetails', function () {
                    var value = $(this).attr('value');
                    var value_month = $(this).attr('value_month');

                    $.ajax({
                        type: "POST",
                        url: "/administrativehub/teacher_salary_cal_details",
                        data: {
                            value: value,
                            value_month: value_month
                        },
                        beforeSend: function (xhr) {
                                    xhr.setRequestHeader('X-CSRF-TOKEN', $(
                                        "meta[name='csrf-token']").attr(
                                        'content'));
                        },
                        dataType: "json",
                        success: function (response) {
                            if (response.length > 0) {
                                        var item = response[
                                            0
                                        ];
                                        $('#staff').text(item.name);
                                        $('#staff_chat').text(item.chat_staff);
                                        if (item.name == null) {
                                            $('#time_of_staff').text("");
                                        } else {
                                            $('#time_of_staff').text(item
                                                .chat_time);
                                        }
                                        $('#teacher').text(item.first_name + ' ' +
                                            item
                                            .second_name);
                                        $('#teacher_chat').text(item.chat_teacher);
                                        if (item.first_name == null) {
                                            $('#time_of_teacher').text("");
                                        } else {
                                            $('#time_of_teacher').text(item
                                                .chat_time);
                                        }
                                    } else {
                                        $('#staff').text("none");
                                        $('#staff_chat').text("none");
                                        $('#time_of_staff').text("--");
                                        $('#teacher').text("none");
                                        $('#teacher_chat').text("none");
                                        $('#time_of_teacher').text("--");
                                    }

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


    <!-- SELECT 
genSal.id,
genSal.today_day, 
genSal.description,
user_privet_datas.first_name, 
user_privet_datas.second_name,

-- schedule salary
CASE
WHEN schedul_cals.time_duration != 0 AND schedul_cals.time_duration IS NOT NULL THEN schedul_cals.time_duration
ELSE 'None'
END AS `timeduration`,
-- payment description
CASE 
WHEN genSal.schedule_id != NULL OR genSal.schedule_id != 0 THEN
'Schedule'
WHEN DATE_FORMAT(allowance_for_users.define_month, '%Y-%m') = DATE_FORMAT(genSal.today_day, '%Y-%m') AND genSal.user_id = allowance_for_users.user_id THEN
'Allowance'
WHEN genSal.trp_transport_id != 0 OR genSal.trp_transport_id != NULL THEN
'Transport'
WHEN genSal.additional_allowance_id != 0 OR genSal.additional_allowance_id != NULL THEN
'Additional Allowance'
END AS `Paymenent_description`,
-- payment
CASE 
WHEN genSal.schedule_id != NULL OR genSal.schedule_id != 0 THEN
schedul_cals.salary_on_schedul

WHEN DATE_FORMAT(allowance_for_users.define_month, '%Y-%m') = DATE_FORMAT(genSal.today_day, '%Y-%m') AND genSal.user_id = allowance_for_users.user_id THEN
allowance_tbs.allowance

WHEN genSal.trp_transport_id != 0 OR genSal.trp_transport_id != NULL THEN
transpoer_price_details.transport_price



WHEN genSal.additional_allowance_id != 0 OR genSal.additional_allowance_id != NULL THEN
additional_allowances.allowance_amount
END AS `Paymenent`

FROM
how_gen_salaries genSal
-- parivat data of user
LEFT JOIN
user_privet_datas ON genSal.user_id = user_privet_datas.user_id
-- schedule information
LEFT JOIN
schedul_cals ON genSal.schedule_id = schedul_cals.schedule_id_of_cal_gen
-- allowance
LEFT JOIN
allowance_for_users ON genSal.user_id = allowance_for_users.user_id
AND DATE_FORMAT(allowance_for_users.define_month, '%Y-%m') = DATE_FORMAT(genSal.today_day, '%Y-%m')
LEFT JOIN 
allowance_tbs ON allowance_for_users.allowance_id = allowance_tbs.id
-- transport
LEFT JOIN
transpoer_price_details ON genSal.trp_transport_id = transpoer_price_details.id
-- additional allowance
LEFT JOIN additional_allowances ON genSal.additional_allowance_id = additional_allowances.id
-- no confirmed credit
LEFT JOIN
credit_t_b_d2s ON genSal.credit_id = credit_t_b_d2s.id; -->
