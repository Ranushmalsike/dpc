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
<style>
    .chat-container {
        height: 100%;
        overflow: hidden;
        border-radius: 8px 0 0 8px;
        /* Rounded corners on the left side */
    }

    .chat-header {
        background-color: #007bff;
        color: #fff;
        padding: 10px;
        text-align: center;
        font-size: 18px;
    }

    .chat-body {
        overflow-y: auto;
        height: calc(100vh - 160px);
        /* Adjust height dynamically */
        padding: 15px;
        background-color: #e9ecef;
    }

    .chat-message {
        display: flex;
        align-items: flex-end;
        margin-bottom: 10px;
    }

    .chat-message .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .customer-message .avatar {
        margin-right: 10px;
        margin-left: 0;
    }

    .message-content {
        padding: 10px;
        border-radius: 20px;
        color: #333;
        font-size: 14px;
    }

    .customer-message .message-content {
        background-color: #d1ecf1;
    }

    .agent-message {
        justify-content: flex-end;
    }

    .agent-message .message-content {
        background-color: #fefefe;
    }

    .chat-footer {
        padding: 10px;
        background-color: #f8f9fa;
    }

    /* Custom styles for modal */
    .modal.right .modal-dialog {
        position: fixed;
        margin: auto;
        width: 320px;
        height: 100%;
        right: 0;
        top: 0;
        background-color: #fff;
        border-radius: 0;
    }

    .modal-content {
        height: 100%;
        border: 0;
        border-radius: 0;
    }

    /**
    Select Teacher
    */
    #checkboxDropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        max-height: 200px;
        /* Set maximum height */
        overflow-y: auto;
        /* Enable vertical scrolling */
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content label {
        display: block;
        padding: 12px 16px;
        cursor: pointer;
    }

    #checkboxDropdown:hover .dropdown-content {
        display: block;
    }

</style>
@endsection
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            {{-- Start summery schema Add --}}
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Summery Schema</h4>
                        <form action="{{ route('Add_summery_schema') }}" method="POST">
                            @csrf
                            <div class="row">
                                <!--  -->
                                <div class="col-md-6">
                                    <!-- Month -->
                                    <!--  -->
                                    <div class="form-group">
                                        <label for="input1-1">Class</label>
                                        <select name="class_id" id="class_id" class="form-control">
                                            @foreach($getClassData as $classData)
                                            <option value="{{ $classData->id }}">{{ $classData->dpcclass }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--  -->
                                    <div class="form-group">
                                        <label for="input1-1"><span class="text-white bg-dark">Month:</span></label>
                                        <br>
                                        <label for="input1-1">Ref. / Txt. Books</label>
                                        <input type="month" class="form-control" id="month_of_summery"
                                            name="month_of_summery" required>

                                    </div>
                                    <div class="form-group">
                                        <label for="input1-1"><span class="text-white bg-dark">SP TR EXERCS &
                                                POEMS:</span></label>
                                        <br>
                                        <label for="input1-1">Blank page Exercise book - 80 page</label>
                                        <textarea name="EXERCS_POEMS" id="EXERCS_POEMS" cols="30" rows="10"
                                            class="form-control" required></textarea>
                                    </div>
                                    <!--  -->
                                    <div class="form-group">
                                        <label for="input1-1"><span
                                                class="text-white bg-dark">VOCABULARY:</span></label>
                                        <br>
                                        <label for="input1-1">My ABC Book (DLS Workbook).[identification of letters and
                                            of pictures beginning with each letter of the alphabet]</label>
                                        <textarea name="VOCABULARY" id="VOCABULARY" cols="30" rows="10"
                                            class="form-control" required></textarea>
                                    </div>
                                    <!--  -->
                                    <div class="form-group">
                                        <label for="input1-1"><span class="text-white bg-dark">IDENTIFICATION OF
                                                LETTERS,
                                                NUMBERS, SHAPES &
                                                COLOURS:</span></label>
                                        <br>
                                        <label for="input1-1">My ABC Book (DLS Workbook)</label>
                                        <textarea name="IDENTIFICATION_3" id="IDENTIFICATION_3" cols="30" rows="10"
                                            class="form-control" required></textarea>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="col-md-6">
                                    <!--  -->
                                    <div class="form-group">
                                        <label for="input1-1"><span class="text-white bg-dark">CONVERSATION, GREETINGS &
                                                COURTESIES :</span></label>
                                        <br>
                                        <label for="input1-1">My ABC Book (DLS Workbook)</label>
                                        <textarea name="CONVERSATION_4" id="CONVERSATION_4" cols="30" rows="10"
                                            class="form-control" required></textarea>
                                    </div>
                                    <!--  -->
                                    <div class="form-group">
                                        <label for="input1-1"><span class="text-white bg-dark">INSTRCTNS
                                                :</span></label>
                                        <br>
                                        <label for="input1-1">My ABC Book (DLS Workbook)</label>
                                        <textarea name="INSTRCTNS_5" id="INSTRCTNS_5" cols="30" rows="10"
                                            class="form-control" required></textarea>
                                    </div>
                                    <!--  -->
                                    <div class="form-group">
                                        <label for="input1-1"><span class="text-white bg-dark">READING :</span></label>
                                        <br>
                                        <label for="input1-1">Gunasena's Beginning to read 1st half pages 1 - 21 & 28 -
                                            30</label>
                                        <textarea name="READING_6" id="READING_6" cols="30" rows="10"
                                            class="form-control" required></textarea>
                                    </div>
                                    <!--  -->
                                    <div class="form-group">
                                        <label for="input1-1"><span class="text-white bg-dark">WRITING :</span></label>
                                        <br>
                                        <label for="input1-1">Ladybird writing Book series 2, ABC WorkBook Guideline
                                            exercise Book - 80 pages</label>
                                        <textarea name="WRITING_7" id="WRITING_7" cols="30" rows="10"
                                            class="form-control" required></textarea>
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <center>
                                <button class="btn btn-primary">Save</button>
                            </center>
                        </form>
                        <!--  -->

                        <!-- Modal - teacher select -->
                        <div class="modal fade" id="TeacherSelect" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">select Teacher</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" id="summery_id_for_teacher" hidden>
                                        <div id="checkboxDropdown">
                                            <span>Select Teacher</span>
                                            <div class="dropdown-content">
                                                @foreach($getTeacherData as $teacherData)
                                                <label><input type="checkbox" class="checkbox"
                                                        value="{{ $teacherData->user_id }}">
                                                    {{ $teacherData->first_name }}
                                                    {{ $teacherData->second_name }}</label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="summery_for_teachers">Attach
                                            teacher</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Model teacher select -->
                        
                        <!-- Modal view teachers-->
                        <div class="modal fade" id="recommended_teacher_model" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Recommended teachers</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- view recommended teachers -->
                                        <table id="recommended" class="table table-hover">
                                            <thead>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td id="id_of_recommended"></td>
                                                    <td id="teacher_id_set"></td>
                                                    <td id="delete_id">
                                                        <button type="button" class="btn btn-danger btn-sm h6 mr-1"
                                                            value="" id="delete_recommended" data-toggle="tooltip"
                                                            data-placement="bottom" title="Delete">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Model view teachers -->

                       
                    </div>
                </div>
            </div>
            {{-- End summery schema Add --}}

            {{-- Start Summery for table--}}
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Summery Schema</h4>
                        <table id="summery_table" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2">ID</th>
                                    <th rowspan="2">Class</th>
                                    <th colspan="1">Month</th>
                                    <th colspan="1">SP TR EXERCS &
                                        POEMS</th>
                                    <th colspan="1">VOCABULARY</th>
                                    <th colspan="1">IDENTIFICATION OF
                                        LETTERS,
                                        NUMBERS, SHAPES &
                                        COLOURS</th>
                                    <th rowspan="1">CONVERSATION, GREETINGS &
                                        COURTESIES</th>
                                    <th rowspan="1">INSTRUCTNS</th>
                                    <th colspan="1">READING</th>
                                    <th colspan="1">WRITING</th>
                                    <th rowspan="2">Delete</th>
                                </tr>
                                <tr>
                                    <!-- <th colspan="1"></th> -->
                                    <th colspan="1" data-dt-order="disable">Ref. / Txt. Books</th>
                                    <th colspan="1" data-dt-order="disable">Blank page Exercise book - 80 page</th>
                                    <th colspan="1">My ABC Book (DLS Workbook).[identification of letters and
                                        of pictures beginning with each letter of the alphabet]</th>
                                    <th colspan="1">My ABC Book (DLS Workbook)</th>
                                    <th colspan="2">My ABC Book (DLS Workbook)</th>
                                    <th colspan="1">Gunasena's Beginning to read 1st half pages 1 - 21 & 28 -
                                        30</th>
                                    <th colspan="1">Ladybird writing Book series 2, ABC WorkBook Guideline
                                        exercise Book - 80 pages</th>
                                    <!-- <th colspan="1"></th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($summery_view_for_staff as $summery_data)
                                <tr>
                                    <td>{{ $summery_data->id }}</td>
                                    <td>{{ $summery_data->dpcclass }}</td>
                                    <td>{{ $summery_data->month_of_summery }}</td>
                                    <td>
                                        {{ $summery_data->summery_col_1 }}
                                        <br>
                                        <progress id="file" value="{{ $summery_data->Percentage_sum_co_1 }}" max="100">
                                            {{ $summery_data->Percentage_sum_co_1 }} </progress>

                                    </td>
                                    <td>
                                        {{ $summery_data->summery_col_2 }}
                                        <br>
                                        <progress id="file" value="{{ $summery_data->Percentage_sum_co_2 }}" max="100">
                                            {{ $summery_data->Percentage_sum_co_2 }} </progress>

                                    </td>
                                    <td>
                                        {{ $summery_data->summery_col_3 }}
                                        <br>
                                        <progress id="file" value="{{ $summery_data->Percentage_sum_co_3 }}" max="100">
                                            {{ $summery_data->Percentage_sum_co_3 }} </progress>

                                    </td>
                                    <td>
                                        {{ $summery_data->summery_col_4 }}
                                        <br>
                                        <progress id="file" value="{{ $summery_data->Percentage_sum_co_4 }}" max="100">
                                            {{ $summery_data->Percentage_sum_co_4 }} </progress>

                                    </td>
                                    <td>
                                        {{ $summery_data->summery_col_5 }}
                                        <br>
                                        <progress id="file" value="{{ $summery_data->Percentage_sum_co_5 }}" max="100">
                                            {{ $summery_data->Percentage_sum_co_5 }} </progress>

                                    </td>
                                    <td>
                                        {{ $summery_data->summery_col_6 }}
                                        <br>
                                        <progress id="file" value="{{ $summery_data->Percentage_sum_co_6 }}" max="100">
                                            {{ $summery_data->Percentage_sum_co_6 }} </progress>


                                    </td>
                                    <td>
                                        {{ $summery_data->summery_col_7 }}
                                        <br>
                                        <progress id="file" value=" {{ $summery_data->Percentage_sum_co_7 }}" max="100">
                                            {{ $summery_data->Percentage_sum_co_7 }} </progress>

                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm h6 mr-1"
                                            value="{{ $summery_data->id }}" id="delete_summery" data-toggle="tooltip"
                                            data-placement="bottom" title="Delete">
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
            {{-- End Summery for table--}}

        </div>

        <!-- Chat model -->
        <div class="modal right fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="chatModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="chat-container">
                        <div class="chat-header" id="chatModalLabel">
                            Chat
                        </div>
                        <div class="chat-body">
                            <!-- Chat messages will go here -->
                            <input type="text" id="ID_of_row" value="" hidden>
                            <input type="text" id="column_number_of_row" value="" hidden>
                            <div class="chat-message customer-message">
                                <strong>
                                    <p id="staff"></p>
                                </strong>
                                <div class="message-content">
                                    <p id="staff_chat">None.
                                        <em>
                                            <h6 id="time_of_staff" class="text-info"></h6>
                                        </em>
                                    </p>
                                </div>

                            </div>
                            <div class="chat-message agent-message">
                                <div class="message-content">
                                    <p id="teacher_chat">none.
                                        <em>
                                            <h6 id="time_of_teacher" class="text-info"></h6>
                                        </em>
                                    </p>
                                </div>
                                <strong>
                                    <p id="teacher"></p>
                                </strong>
                            </div>

                        </div>
                        <div class="chat-footer">
                            <input type="text" class="form-control" id="chat_input"
                                placeholder="Type your message here...">
                            <button class="btn btn-primary mt-2" id="send">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Chat Model -->
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

    <!-- {{-- Start MyScript Link  --}} -->
    <!-- <script src="{{ asset('assets/js/tableLinkWithdataTBl.js') }}"></script> -->
    <!-- Then include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
         /** 
          * Start Alert section function
         */
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
         * End Alert section function 
         */



        /***
         * XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX Process of this page by ajax
        */    
        $(document).ready(function () {

            //==========>> Data table
                $('#summery_table').DataTable({
                "pagingType": "full_numbers",
                "pageLength": 5,
                "searching": true,
                "fixedHeader": true,
                "responsive": true,
                "scrollX": true,
                order: [
                    [0, 'asc']
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
                    'print'
                ]
            });

            //==========>> Get values through table 
            var table_summery = $('#summery_table');
            table_summery.on('click', 'td', function () {
                var cell = $(this);
                var row = cell.closest('tr');
                var cellIndex = cell.index();
                var id = row.find('td:first').text();

                // Assuming the first row of the table contains column headers
                var columnName = $('#summery_table thead th').eq(cellIndex).text().trim();

                //===========>>look chart
                if (cellIndex == 0) {

                }
                //==========>> recommended teacher 
                else if (cellIndex == 1) {

                    $.ajax({
                        type: "POST",
                        url: "/administrativehub/summery_recommendedTeacher",
                        data: {
                            id: id
                        },
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader('X-CSRF-TOKEN', $(
                                "meta[name='csrf-token']").attr('content'));
                        },
                        dataType: "json",
                        success: function (response) {

                            if (response.length > 0) {
                                var item = response[
                                    0
                                ];
                                $('#id_of_recommended').text(item.id);
                                $('#teacher_id_set').text(item.first_name + ' ' + item
                                    .second_name);
                            } else {
                                $('#id_of_recommended').text("none");
                                $('#teacher_id_set').text("none");
                            }
                            $('#recommended_teacher_model').modal('show');
                        },
                        error: function (xhr, status, error) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Error saving data" + status + ',' + error,
                                footer: ''
                            });
                        }
                    });

                }
                //===========>> Add teacher for recommend
                else if (cellIndex == 2) {
                    $('#summery_id_for_teacher').val(id);
                    $('#TeacherSelect').modal('show');

                }
                //===========>> Defined (summery delete check below)
                else if (cellIndex == 10) {

                }
                //============>> Chat option 
                else {

                    $.ajax({
                        type: "POST",
                        url: "/administrativehub/summery_for_chat",
                        data: {
                            id: id,
                            cellIndex: cellIndex
                        },
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader('X-CSRF-TOKEN', $(
                                "meta[name='csrf-token']").attr('content'));
                        },
                        dataType: 'json',
                        success: function (response) {
                            console.log(
                                response
                            );

                            if (response.length > 0) {
                                var item = response[
                                    0
                                ];
                                $('#staff').text(item.name);
                                $('#staff_chat').text(item.chat_staff);
                                if (item.name == null) {
                                    $('#time_of_staff').text("");
                                } else {
                                    $('#time_of_staff').text(item.chat_time);
                                }
                                $('#teacher').text(item.first_name + ' ' + item
                                    .second_name);
                                $('#teacher_chat').text(item.chat_teacher);
                                if (item.first_name == null) {
                                    $('#time_of_teacher').text("");
                                } else {
                                    $('#time_of_teacher').text(item.chat_time);
                                }
                            } else {
                                $('#staff').text("none");
                                $('#staff_chat').text("none");
                                $('#time_of_staff').text("--");
                                $('#teacher').text("none");
                                $('#teacher_chat').text("none");
                                $('#time_of_teacher').text("--");
                            }

                            $('#ID_of_row').val(id);
                            $('#column_number_of_row').val(cellIndex);
                            $('#chatModal').modal('show');
                        },
                        error: function (xhr, status, error) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Error saving data" + status + ',' + error,
                                footer: ''
                            });
                        }
                    });


                }
            });

            /***
             * Component for check box of recommend 
             */
            var checkboxes = document.querySelectorAll('.checkbox');
            for (var checkbox of checkboxes) {
                checkbox.addEventListener('change', function () {
                    var allChecked = document.querySelectorAll('.checkbox:checked').length ===
                        checkboxes.length;
                    document.getElementById('selectAll').checked = allChecked;
                });
            }

            /**
             * Save selected teacher of recommend
             */

            $('#summery_for_teachers').click(function (e) {
                var id_of_summery = $('#summery_id_for_teacher').val();
                var selected = [];
                document.querySelectorAll('.checkbox:checked').forEach(checkbox => {
                    selected.push(checkbox.value);
                });

                $.ajax({
                    url: '/input/selected_teacher_forSummery', // Your server-side script to handle the saving
                    type: 'POST',
                    data: {
                        summery_id: id_of_summery,
                        selected_values: selected
                    },
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', $("meta[name='csrf-token']")
                            .attr('content'));
                    },
                    dataType: 'json',
                    success: function (response) {
                        // Handle success response
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Data saved successfully:" + response,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Error saving data" + error,
                            footer: ''
                        });

                    }
                });

                // document.getElementById('selectedValues').textContent = 'Selected: ' + selected.join(', ');

            });

            /***
             * Save chat for database
             */
            $('#send').click(function (e) {
                var idOfRow = $('#ID_of_row').val();
                var columnNumberOfRow = $('#column_number_of_row').val();
                var chatInput = $('#chat_input').val();

                $.ajax({
                    type: "POST",
                    url: "/input/chat_input",
                    data: {
                        idOfRow: idOfRow,
                        columnNumberOfRow: columnNumberOfRow,
                        chatInput: chatInput
                    },
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', $("meta[name='csrf-token']")
                            .attr('content'));
                    },
                    dataType: 'json',
                    success: function (response) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Data saved successfully:" + response,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Error saving data" + error,
                            footer: ''
                        });
                    }
                });
            });

            /***
             * Delete summery
             */
            $('#delete_summery').click(function (e) {
                e.preventDefault();
                var id = $(this).val();
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
                            url: "/administrativehub/delete_summery.delete/" + id,
                            data: {
                                id: id
                            },
                            beforeSend: function (xhr) {
                                xhr.setRequestHeader('X-CSRF-TOKEN', $(
                                        "meta[name='csrf-token']")
                                    .attr('content'));
                            },
                            dataType: "json",
                            success: function (response) {
                                // success
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                });
                                location.reload();
                            }
                        });

                    }
                });


            });
            /**
             * Delete recommended teachers
             */

            $(document).on('click', '#delete_recommended', function () {
                var id = $(this).closest('tr').find('#id_of_recommended').text();
                if (id == "none") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Nothing to data for delete",
                        footer: ''
                    });
                } else {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "GET",
                                url: "/administrativehub/delete_recommended.delete/" +
                                    id,
                                data: {
                                    id: id
                                },
                                beforeSend: function (xhr) {
                                    xhr.setRequestHeader('X-CSRF-TOKEN', $(
                                            "meta[name='csrf-token']")
                                        .attr('content'));
                                },
                                dataType: "json",
                                success: function (response) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        icon: "success"
                                    });
                                    location.reload();
                                }
                            });
                        }
                    });

                }
            });


            /**
             * Alert section
             */
            @if(Session::get('success'))
            // Success Alert
            success();
            @endif
            @if(Session::get('fail'))
            // Fail Alert
            fail();
            @endif  
            /**
             * End Alert section
             */          
        });

    </script>
    @endpush

    @endsection
