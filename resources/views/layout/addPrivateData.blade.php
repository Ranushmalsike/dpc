@extends('include.commonstr')
@section('css')
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
                        <h4 class="card-title">Add The profile Data</h4>
                         @foreach($getData as $getDta)
                        <p class="card-description">
                         UserName of <b>  {{ $getDta->name }} </b>
                        </p>
                        <form class="container" method="POST" action="{{ route('teacher.PrivateData') }}">
                            
                            <input type="hidden" name="idOfUser" value="{{ $getDta->user_id }}">
                            
                            @csrf
                            <div class="form-group">
                                <label for="first_name">First Name:</label>
                                <br/>
                                <i>{{ $getDta->first_name }} </i>
                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{  old('username') }}">
                                <span style="color:red"> @error ('first_name') {{ $message }} @enderror </span>
                            </div>

                            <div class="form-group">
                                <label for="Second_Name">Second Name:</label>
                                <br/>
                                <i>{{ $getDta->second_name }}</i>
                                <input type="text" name="Second_Name" id="Second_Name" class="form-control" value="{{  old('Second_Name') }}">
                                <span style="color:red"> @error ('Second_Name') {{ $message }} @enderror </span>
                            </div>

                            <div class="form-group">
                                <label for="Address">Address:</label>
                                <br/>
                                <i>{{ $getDta->address }}</i>
                                <textarea name="Address" id="Address" class="form-control" 
                                value="{{  old('Address') }}" row="3" col="5"></textarea>
                                <span style="color:red"> @error ('Address') {{ $message }} @enderror </span>
                            </div>

                            <div class="form-group">
                                <label for="NIC">NIC:</label>
                                <br/>
                                <i>{{ $getDta->NIC }}</i>
                                <input type="text" name="NIC" id="NIC" class="form-control" 
                                value="{{  old('NIC') }}">
                                <span style="color:red"> @error ('NIC') {{ $message }} @enderror </span>
                            </div>

                            <div class="form-group">
                                <label for="Contact_Number">Contact Number:</label>
                                <br/>
                                <i>{{ $getDta->contact_number }}</i>
                                <input type="text" name="Contact_Number" id="Contact_Number" class="form-control" value="{{  old('Contact_Number') }}">
                                <span style="color:red"> @error ('Contact_Number') {{ $message }} @enderror </span>
                            </div>
                            @endforeach
                            <center>
                            <button type="submit" class="btn btn-primary mr-2" id="SaveDataOfUser"
                            value="{{ $getDta->uid }}">Update</button>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
             <!--================================== Teacher section ===========================-->
        @php
        $routeName = Route::currentRouteName();
        @endphp
        @if($routeName == "addPrivateDataUserBy_teacher")
         <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Change Password Own Password</h4>
                            <form id="own_pass" method="POST" action="{{ route('ownChangePassword.Update') }}">
                        @csrf
                        <div class="form-group">
                            <label for="new_pass">New Password<strong id="teacher_name_of_edit"></strong></label>
                            <input type="text" class="form-control" id="new_pass" name="new_pass">
                            <span style="color:red"> @error ('new_pass') {{ $message }} @enderror </span>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Password Update</button>
                    </form>
                    </div>
            </div>
         </div>
        @endif
        </div>
    </div>

    @push('scripts')
    <!-- Start DataTable Script Link -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
