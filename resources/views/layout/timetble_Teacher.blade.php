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

    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
        padding-top: 60px;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 30%;
        /* Could be more or less, depending on screen size */
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


<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <!-- == Start Input section == -->
            <!-- Start permission input section-->
            <div class="col-md-12">
                <div id='calendar'></div>
            </div>

            <!-- End permission input section -->
            <!-- == End input sections == -->
        </div>
    </div>


    <!-- transfer Modal -->
    <div id="TeacherModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <input type="text" name="" id="id_tb" disabled hidden>
            <!-- <h5 id="Data_of_this"></h5> -->
            <p>Transfer Date</p>
            <input type="text" name="" id="Data_of_this" class="form-control" disabled>
            <p>Select Teacher</p>
            <select id="Teachers_selection_for_transfer_section" class="form-control">
                @foreach($getTeacher as $teacher)
                <option value="{{ $teacher->user_id }}" data="{{ $teacher->first_name }}  {{ $teacher->second_name }}">
                    {{ $teacher->first_name }} {{ $teacher->second_name }}</option>
                @endforeach
            </select>
            <hr>
            <button id="saveTeacher" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                title="Add transport code">Add</button>
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
    <script src="{{ asset('assets/js/clenderMyCodeForTeacher.js') }}"></script>

    <!-- // Start Sweet model script link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <!-- // End Sweet Alert script link -->
    <script>
        function success() {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Your work has been saved",
                showConfirmButton: false,
                timer: 1500
            });
        }

        function fail() {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                footer: ''
            });
        }


        $(document).ready(function () {

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
