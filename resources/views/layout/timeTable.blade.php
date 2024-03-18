@extends('include.commonstr')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
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
                  <button class="btn btn-primary" id="Generate_shedule" value="">Generate</button>
                    <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i
                            class="fa fa-reset"></i> Cancel</button>
                </div>
                <hr />
            </div>
            <div class="col-md-8">
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

    @push('scripts')
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
    <script src="{{ asset('assets/js/disabledBackdate.js') }}"></script>
    
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
