@extends('include.commonstr')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
<!-- Include Bootstrap CSS -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
<!-- Start Sweet alert link -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
<!-- End Sweet alert Link -->
<!-- Start Bootstrap icon CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<!-- End Bootstrap Icon CDN -->
<style>
  .custom-scroll {
    max-height: 400px; /* Adjust based on your needs */
    overflow-y: auto;
}

.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

.modal-content {
  background-color: #fefefe;
  margin: 5% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 30%; /* Could be more or less, depending on screen size */
}

.close-button {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close-button:hover,
.close-button:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

</style>
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
            <!-- == Start Input section == -->
            <!-- Start permission input section-->

            <div class="col-md-4">
                <div class="card-body">
                    <h3 class="card-title"> <strong>Add Schedule</strong></h3>
                    <div class="container-fluid">

                        <input type="hidden" name="id" value="">

                        <div class="form-group mb-2">
                            <label for="Start_titile_datetime" class="control-label">Start Schedule Date</label>
                            <input type="date" class="form-control form-control-sm rounded-0"
                                name="Start_titile_datetime" id="Start_titile_datetime" required>
                        </div>

                        <div class="form-group mb-2">
                            <label for="End_titile_datetime" class="control-label">End Schedule Date</label>
                            <input type="date" class="form-control form-control-sm rounded-0" name="End_titile_datetime"
                                id="End_titile_datetime" required>
                        </div>

                        <div class="form-group mb-2">
                            <label for="starttime" class="control-label">Start Time</label>
                            <input type="time" class="form-control form-control-sm rounded-0" name="starttime"
                                id="starttime" required>
                        </div>

                        <div class="form-group mb-2">
                            <label for="endtime" class="control-label">End Time</label>
                            <input type="time" class="form-control form-control-sm rounded-0" name="endtime"
                                id="endtime" required>
                        </div>

                        <div class="form-group mb-2">
                            <label for="className" class="control-label">Class Name</label>
                            <select class="selectClass form-control form-control-sm rounded-0" data-rel="chosen"
                                name="className" id="className" placeholder="select Class">
                            @foreach($getClassVal as $classV)
                                <option value="{{ $classV->id }}" data="{{ $classV->dpcclass }}">{{ $classV->dpcclass }}</option>
                            @endforeach
                            </select>
                        </div>


                        <div class="form-group md-2">
                            <label for="subject" class="control-label">Subject and Schema</label>
                            <!-- Your HTML Select2 dropdown -->
                            <select class="selectSubject form-control form-control-sm rounded-0" name="subject"
                                id="subject" placeholder="select subject">
                            @foreach($getSubjectVal as $subject)
                                <option value="{{ $subject->id }}" data="{{ $subject->subject }}">{{ $subject->subject }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group md-2">
                            <label for="TeacherName" class="control-label">Select Teacher</label>
                            <!-- Your HTML Select2 dropdown -->
                            <select class="selectTeacher form-control form-control-sm rounded-0" name="TeacherName"
                                id="TeacherName" placeholder="select Teacher">
                            @foreach($getTeacher as $teacher)
                                <option value="{{ $teacher->user_id }}" data="{{ $teacher->first_name }}  {{ $teacher->second_name }}">{{ $teacher->first_name }} {{ $teacher->second_name }}</option>
                                
                            @endforeach
                            </select>
                        </div>


                        {{-- <div class="form-group md-2">
                            <input class="form-check-input" type="checkbox" value="" id="chkPassport">
                            <label for="Select_transport" class="control-label">Select transport
                                code</label>
                            <!-- Your HTML Select2 dropdown -->
                            <select class="selectSubject form-control form-control-sm rounded-0" name="Select_transport"
                                id="Select_transport" placeholder="Select transport" disabled>

                            </select>
                        </div> --}}

                    </div>
                </div>

                <div class="text-center">
                  <button class="btn btn-primary" id="Generate_shedule" value="" data-toggle="tooltip" data-placement="bottom"
                                            title="Generate Time arrangement by system">Generate</button>
                    <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i
                            class="fa fa-reset"></i> Cancel</button>
                </div>
                <hr />
            </div>
            <div class="col-md-8">
                <button type="submit" class="btn btn-success btn-sm" id="get_and_save_time_schedule" data-toggle="tooltip" data-placement="bottom"
                                            title="Time arrangement save into database">Save Time Arrangement</button>
                <hr/>
              <div class="custom-scroll table-responsive">
                <table class="table table-fixed table-hover table-striped timeSheduleTb" id="schedule_details_ofTb">
                    <thead>
                            <th>Teacher Code</th>
                            <th>Teacher Name</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Transport</th>
                            <th>Delete</th>
                        
                    </thead>
                    <tbody id="schedule_gen_tb">
                        
                    </tbody>
                </table>
              </div>
              
            </div>
            <div class="col-md-12">
                <div id='calendar'></div>
            </div>

            <!-- End permission input section -->
            <!-- == End input sections == -->
        </div>
    </div>


<!-- Transport Selection Modal -->
<div id="transportModal" class="modal">
  <div class="modal-content">
    <span class="close-button">&times;</span>
    <h2>Select Transport</h2>
    <select id="transportSelect" class="form-control">
        @foreach($getTransportInformation as $TRP)
         <option value="{{ $TRP->id  }}">{{ $TRP->trasporot_code }} -( LKR : {{ $TRP->transport_price }} )</option>                  
        @endforeach
    </select>
    <hr>
    <button id="saveTransport" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                                            title="Add transport code">Add</button>
  </div>
</div>



<!-- Event Details Modal -->
            <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event_details_modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-0">
                        <div class="modal-header rounded-0">
                            <h5 class="modal-title">Schedule Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body rounded-0">
                            <div class="container-fluid">
                                <dl>
                                    <dt class="text-muted">Title</dt>
                                    <dd id="title" class="fw-bold fs-4"></dd>
                                    <table>
                                        <tr class="table-danger">
                                            <td>
                                                <dt class="text-muted">Start Time</dt>
                                                <dd id="stTime" class=""></dd>
                                            </td>

                                            <td>
                                                <dt class="text-muted">End Time</dt>
                                                <dd id="edTime" class=""></dd>
                                            </td>
                                        <tr class="table-success">
                                            <td>
                                                <dt class="text-muted">Class name</dt>
                                                <dd id="ClassName" class=""></dd>
                                            </td>

                                            <td>
                                                <dt class="text-muted">Subject</dt>
                                                <dd id="Subjectname" class=""></dd>
                                            </td>
                                        </tr>

                                    </table>
                                    <hr>
                                    <table>
                                        <tr class="table-warning">
                                            <td>
                                                <dt class="text-muted">First Name</dt>
                                                <dd id="fstname" class=""></dd>
                                            </td>

                                            <td>
                                                <dt class="text-muted">Last Name</dt>
                                                <dd id="lstname" class=""></dd>
                                            </td>

                                            <td height='40%' width='30%'>

                                                <dd id="profile2" class=""></dd>

                                            </td>
                                        </tr>
                                    </table>
                                    <table>
                                        <tr class="table-light">
                                            <dt>Session Transfer</dt>
                                        </tr>
                                        <tr class="table-info">
                                            <td>
                                                <dt class="text-muted">First Name</dt>
                                                <dd id="fstname_trsn" class=""></dd>
                                            </td>

                                            <td>
                                                <dt class="text-muted">Last Name</dt>
                                                <dd id="lstname_tran" class=""></dd>
                                            </td>

                                            <td>

                                                <dd id="profile2_tran" class="">
                                                </dd>
                                            </td>
                                        </tr>
                                    </table>

                                </dl>
                            </div>
                        </div>
                        <div class="modal-footer rounded-0">
                            <div class="text-end">
                                <!--button type="button" class="btn btn-primary btn-sm rounded-0" id="edit"
                                    data-id="">Edit</!--button-->

                                <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete"
                                    data-id="">Delete</button>

                                <button type="button" class="btn btn-secondary btn-sm rounded-0"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



 <?php
    $sched_res = [];
    foreach($getTimeArrangementDetails as $row10){
        $row10['Time_arrangement_conv'] = date("F d, Y",strtotime($row10['Time_arrangement']));
        $row10['sdate'] = date("h:i A",strtotime($row10['start_time']));
        $row10['edate'] = date("h:i A",strtotime($row10['end_time']));
        $sched_res[$row10['id']] = $row10;
    }
 ?>
  
    @push('scripts')
    <script>
        var timeArrangementDetails_client = $.parseJSON('<?= json_encode($sched_res) ?>')
    </script>
    <!-- Include jQuery
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->

        <!-- Include Bootstrap JS (after jQuery) -->
        <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->

    <!-- content-wrapper ends -->
    <script src="{{ asset('assets/adminHub/js/file-upload.js') }}"></script>
    <script src="{{ asset('assets/adminHub/js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/adminHub/js/select2.js') }}"></script>

    <!-- Start DataTable Script Link -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Full calender -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script> --}}

    <script src="{{ asset('assets/fullcalendar-6.1.11/dist/index.global.js') }}"></script>
    <script src="{{ asset('assets/js/clenderMyCode.js') }}"></script>


    

    <!-- // Start Sweet model script link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <!-- // End Sweet Alert script link -->
    
    {{-- My Script --}} 
    <script src="{{ asset('assets/js/schedule_arrange.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/disabledBackdate.js') }}"></script> -->
    
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
