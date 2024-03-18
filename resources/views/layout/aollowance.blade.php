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


<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            {{-- Start trasport Price input section --}}
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Allowance</h4>
                        <form method="POST" action="{{ route('Addallowance') }}">
                            @csrf
                            <label for="startSalary" class="col-sm-6 col-form-label">Start Salary</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" id="startSalary" name="startSalary">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                                <span style="color:red"> @error ('startSalary') {{ $message }} @enderror </span>
                            </div>

                            <label for="endSalary" class="col-sm-6 col-form-label">End Salary</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" id="endSalary" name="endSalary">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                                <span style="color:red"> @error ('endSalary') {{ $message }} @enderror </span>
                            </div>

                            <label for="TRPA" class="col-sm-6 col-form-label">Transport allowance</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">LKR</span>
                                </div>
                                <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)"
                                    id="allowance" name="allowance">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                                <span style="color:red"> @error ('allowance') {{ $message }} @enderror </span>
                            </div>
                            <div class="text-center">
                                <button id="daysalrysave_158" class="btn btn-primary" value="158">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End trasport Price input section --}}

            {{-- Start trasport table with price section --}}
            <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Allowance</h4>
                        <table id="Trasport_detail_salary" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                   
                                    <th>Salary Start</th>
                                    <th>Salary End</th>
                                    <th>Allowance Amount (LKR)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allowanceData as $alwdata)
                                <tr id="allowanceId{{ $alwdata->id }}">
                                    <td>{{ $alwdata->start_salary }}</td>
                                    <td>{{ $alwdata->end_star }}</td>
                                    <td>{{ $alwdata->allowance }}</td>
                                    <td>
                                        <div class="row">
                                            <!-- Delete -->
                                            <button type="button" class="btn btn-danger btn-sm h6 mr-1"
                                                value="{{ $alwdata->id }}" id="delete_allowance" data-toggle="tooltip"
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
            {{-- End trasport table with price section --}}

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

               

            // Start Delete
            $(document).on('click', '#delete_allowance', function () {
                const thisElement = $(this); // Get the clicked element
                //const id_name = thisElement.attr('id'); // Extract the ID
                var id = thisElement.val();
                    var del_URL = "/administrativehub.allowance.delete/";
                deleteDataOfTable(id, del_URL);
            });

            // >> Delete function
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
                                
                                $('#allowanceId' + id).remove();
                                success();

                            }
                        });
                    }
                });

            }
            // End Delete

            // Start Alert
            @if(Session::get('success'))
            // Success Alert
            success();
            @endif
            @if(Session::get('fail'))
            // Fail Alert
            fail();
            @endif

        });

    </script>
    <!-- {{-- End MyScript Link  --}} -->

    @endpush

    @endsection
