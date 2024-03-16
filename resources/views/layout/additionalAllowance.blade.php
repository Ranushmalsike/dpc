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
                        <h4 class="card-title">Additional Allowance</h4>
                        <form method="POST" action="{{ route('Addadditional_allowance') }}">
                            @csrf

                            <label for="additionalAllowance" class="col-sm-6 col-form-label">Add Additional Allowance</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" id="additionalAllowance" name="additionalAllowance">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                                <span style="color:red"> @error ('additionalAllowance') {{ $message }} @enderror </span>
                            </div>

                            <label for="description" class="col-sm-6 col-form-label">Description</label>
                            <div class="input-group mb-3">
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                <span style="color:red"> @error ('description') {{ $message }} @enderror </span>
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
                        <h4 class="card-title">Additional Allowance</h4>
                        <table id="Trasport_detail_salary" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Allowance Amount (LKR)</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($additional_allowanceData as $alwdata)
                                <tr id="allowanceId{{ $alwdata->id }}">
                                    <td>{{ $alwdata->id }}</td>
                                    <td>{{ $alwdata->allowance_amount }}</td>
                                    <td>{{ $alwdata->Description }}</td>
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

    {{-- Start MyScript Link  --}}
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

                // Start trasport table with price section
                    $('#Trasport_detail_salary, #Trasport_detail').DataTable({
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
                            title: 'Daphne Lord School (Trasport Information)',
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
            // End trasport table with price section

            // Start Delete
            $(document).on('click', '#delete_allowance', function () {
                const thisElement = $(this); // Get the clicked element
                //const id_name = thisElement.attr('id'); // Extract the ID
                var id = thisElement.val();
                var del_URL = "/administrativehub.additional_allowance.delete/";
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
    {{-- End MyScript Link  --}}

    @endpush

    @endsection
