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


<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            {{-- Start Add credit section --}}
            <div class="col-md-12 grid-margin stretch-card">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Provide a Loan</h4>

                            <div class="form-group">
                                <label for="TeacherName">Select Member</label>
                                <select class="form-control" id="TeacherName" name="TeacherName">
                                    @foreach($getTeacher as $teach)
                                    <option value="{{ $teach->user_id }}">
                                        {{ $teach->first_name }}
                                        &nbsp;
                                        {{ $teach->second_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <label for="credit" class="col-sm-6 col-form-label">Credit</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)"
                                    id="credit" name="credit">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                                <span style="color:red"> @error ('credit') {{ $message }} @enderror </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                 <label for="MonthID">Select Installment Date</label>
                                <input type="date" class="form-control" id="credit_date" name="credit_date">
                            </div>
                            <div class="form-group">
                                <label for="MonthID">Duration</label>
                                <select class="form-control" id="MonthID" name="MonthID">
                                    <option value="0">Select Duration</option>
                                    @for($i = 1; $i <= 12; $i++) <option value="{{ $i }}">{{ $i }} Month</option>
                                        @endfor

                                </select>
                            </div>
                            <table border="1" id="installment_tb">
                                <thead>
                                    <tr>
                                        <th>Installment Date</th>
                                        <th>Installment (LKR) </th>
                                    </tr>
                                </thead>
                                <tbody id="installment_data">
                                    <td></td>
                                    <td></td>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <center>
                            <button type="submit" class="btn btn-primary" id="save_credit">Submit</button>
                        </center>
                        <br>
                    </div>
                </div>
            </div>
            {{-- End Add Credit section --}}

            {{-- start Credit view section  --}}
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">credit</h4>
                        <table id="creditInfoTb" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Second Name</th>
                                    <th>admin Decision</th>
                                    <th>Provide date</th>
                                    <th>Credit</th>
                                    <th>Installment Date</th>
                                    <th>Installment</th>
                                    <th>Process Type Installment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($getloanDetails as $loandetails)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $loandetails->first_name }}</td>
                                    <td>{{ $loandetails->second_name }}</td>
                                    <td>
                                        <h5 class="text-info"><strong>{{ $loandetails->type_ofmainTB }}</strong></h5>
                                        <!--For Admin -->
                                        <hr />
                                        <div class="row">
                                            <!-- Reject Option -->
                                            <button type="button" class="btn btn-danger btn-sm h6 mr-1"
                                                value="{{ $loandetails->credit_id_of_baseTB }}" id="reject_loan_option"
                                                data-toggle="tooltip" data-placement="bottom" title="Reject Loan">
                                                <i class="bi bi-clipboard-x"></i>
                                            </button>
                                            <!-- Confirmed -->
                                            <button type="button" class="btn btn-warning btn-sm h6 mr-1"
                                                value="{{ $loandetails->credit_id_of_baseTB }}"
                                                id="confirmed_loan_option" data-toggle="tooltip" data-placement="bottom"
                                                title="Confirmed Loan">
                                                <i class="bi bi-check-circle"></i>
                                            </button>
                                            <!-- All loan Completed -->
                                            <button type="button" class="btn btn-secondary btn-sm h6 mr-1"
                                                value="{{ $loandetails->credit_id_of_baseTB }}" id="all_loan_completed"
                                                data-toggle="tooltip" data-placement="bottom"
                                                title="All installment Successfully Completed of This Loan">
                                                <i class="bi bi-check-all"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>{{ $loandetails->provide_date }}</td>
                                    <td>{{ $loandetails->amount }}</td>
                                    <td>{{ $loandetails->installment_date }}</td>
                                    <td>{{ $loandetails->installment }}</td>
                                    <td>
                                        <h5 class="text-success"><strong>
                                                {{ $loandetails->type_ofsubTB }}
                                            </strong></h5>

                                    </td>
                                    <td>
                                        <!-- Delete -->
                                        <button type="button" class="btn btn-danger btn-sm h6 mr-1"
                                            value="{{ $loandetails->credit_id_of_baseTB }}" id="delete_loan"
                                            data-toggle="tooltip" data-placement="bottom"
                                            title="Delete this loan of all record">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            {{-- End Credit view section --}}

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
        src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js">
    </script>
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

    <!-- {{-- Start MyScript Link  --}} -->
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

            //limit Date
            let today = new Date();
            let currentMonth = today.getMonth();
            let currentYear = today.getFullYear();
            let lastDayOfCurrentMonth = new Date(currentYear, currentMonth + 1, 0).getDate(); 

            let minDate = today.toISOString().substring(0, 10); // YYYY-MM-DD
            let maxDate = new Date(currentYear, currentMonth, lastDayOfCurrentMonth).toISOString().substring(0, 10);

            let creditDateInput = document.getElementById("credit_date");
            creditDateInput.setAttribute("min", minDate);
            creditDateInput.setAttribute("max", maxDate);


            // Table
            // $('#creditInfoTb').DataTable({
            //     "pagingType": "full_numbers",
            //     "pageLength": 5,
            //     "searching": true,
            //     "fixedHeader": true,
            //     "responsive": true,
            //     "scrollX": true,
            //     order: [
            //         [0, 'asc']
            //     ],
            //     paging: true,
            //     scrollCollapse: true,
            //     scrollY: '500px',
            //     dom: 'Blfrtip',
            //     buttons: [{
            //             extend: 'pdf',
            //             bold: 'true',
            //             fontSize: '15',
            //             title: 'Daphne Lord School (System Developer Section)',
            //             subtitle: 'Line 2 of the subtitle',
            //             exportOptions: {
            //                 modifier: {
            //                     page: 'current'
            //                 },
            //             }
            //         },
            //         'excel', 'print'
            //     ]
            // });

            //    Start generate installment of Installment section 
            // Generate popup alert for selected the of <select class="form-control" id="TeacherName" name="TeacherName">
            $('#MonthID').change(function () {
                var Staff_selectedDate = $('#credit_date').val();

                    // Parse the selected date into a Date object
                var dateObj = new Date(Staff_selectedDate);
                var day = dateObj.getDate();


                var MonthID = $(this).val();
                var credit = $('#credit').val();
                let installment = credit / MonthID;

                // generate installment within month with date

                $('#installment_data').empty();

                // Get the current date
                let currentDate = new Date();


                for (let i = 0; i < MonthID; i++) {

                    let monthDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + i, 1);

                    let monthName = monthDate.toLocaleString('default', {
                        month: 'long'
                    });

                    let year = monthDate.getFullYear();
                    // let date = currentDate.getDate(); // Add this line to get the date

                    $('#installment_data').append(
                        `<tr><td>${year} ${monthName} ${day}</td> <td>${installment}</td></tr>`);
                }
                //    End generate installment of Installment section 


            });

            //Start save credit details and insert into database
            $('#save_credit').click(function (e) {
                //e.preventDefault();
                var dataToInsert = [];
                // get credit value and TeacherName value
                var credit = $('#credit').val();
                var TeacherName = $('#TeacherName').val();

                $('#installment_tb').find('tr').each(function () {
                    var $columns = $(this).find('td');
                    var month = $columns.eq(0).text().trim();
                    var installment = $columns.eq(1).text().trim();
                    dataToInsert.push({
                        month: month,
                        installment: installment
                    });
                    //alert('Month: ' + month + ', Installment: ' + installment);
                });

                $.ajax({
                    type: 'POST',
                    url: '/input/creditInsert', // Replace with the actual PHP script URL
                    data: {
                        credit: credit,
                        TeacherName: TeacherName,
                        dataToInsert: dataToInsert
                    },
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', $("meta[name='csrf-token']")
                            .attr('content'));
                    },
                    // dataType:'json',
                    success: function (response) {
                        msgbxInstance.okCompleted();
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
            });
            // End save credit details and insert into database

            // button proccess section in table
            $(document).on('click',
                '#reject_loan_option, #confirmed_loan_option, #all_loan_completed, #delete_loan',
                function () {
                    const thisElement = $(this); // Get the clicked element
                    const id_name = thisElement.attr('id'); // Extract the ID
                    var id = thisElement.val();
                    var del_URL = "";

                    switch (id_name) {
                        case "reject_loan_option":
                            del_URL = "/administrativehub/edit/updateCredit_reject_loan/";
                            break;
                        case "confirmed_loan_option":
                            del_URL = "/administrativehub/edit/updateCredit_confirmed_loan/";
                            break;
                        case "all_loan_completed":
                            del_URL = "/administrativehub/edit/updateCredit_allcompleted/";
                            break;
                        case "delete_loan":
                            del_URL = "/administrativehub/credit.delete/";
                            break;
                        default:
                            break;
                    }

                    deleteDataOfTable(id_name, id, del_URL);
                });

            // deleteDataOfTable function
            function deleteDataOfTable(id_name, id, del_URL) {
                if (id_name == "delete_loan") {
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
                                    success();
                                    location.reload();

                                }
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to Update this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, Update it!"
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
                }

            }


        });

    </script>
    <!-- {{-- End MyScript Link  --}} -->

    @endpush

    @endsection
