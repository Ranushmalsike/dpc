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


            {{-- Start trasport input section --}}
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Trasport Details</h4>
                        <form method="POST" action="{{ route('AddTrasnportData') }}">
                            @csrf
                            <label for="TransportCode" class="col-sm-6 col-form-label">Transport Code</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="TransportCode" name="TransportCode"
                                    placeholder="Enter Transport Code">
                            </div>
                            <span style="color:red"> @error ('TransportCode') {{ $message }} @enderror </span>                                    
                            <label for="TransportDescription" class="col-sm-6 col-form-label">Transport
                                Description</label>
                            <div class="input-group mb-3">
                                <textarea class="form-control" id="TransportDescription" name="TransportDescription"
                                    placeholder="Enter Transport Description" rows="3"></textarea>
                            </div>
                            <span style="color:red"> @error ('TransportDescription') {{ $message }} @enderror </span>                                    
                            <div class="text-center">
                                <button id="daysalrysave_158" class="btn btn-primary mt-2" value="158">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End trasport input section --}}


            {{-- Start trasport table section --}}
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Trasport Detils Section</h4>
                        <table id="Trasport_detail" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Transport Code</th>
                                    <th>Trasport Description</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getTransportInformation as $getTransportInformationD)
                                <tr id="rmTransportDetail{{ $getTransportInformationD->id }}">
                                    <td>{{ $getTransportInformationD->trasporot_code }}</td>
                                    <td>{{ $getTransportInformationD->description }}</td>
                                    <td>
                                        <div class="row">
                                            <!-- Delete -->
                                            <button type="button" class="btn btn-danger btn-sm h6 mr-1"
                                                value="{{ $getTransportInformationD->id }}" id="delete_transportDetail" data-toggle="tooltip"
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
            {{-- End trasport table section --}}

            {{-- Start trasport Price input section --}}
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Trasport Details</h4>
                        <form method="POST" action="{{ route('AddTrasnportDataPrice') }}">
                            @csrf
                            <label for="TransportCodeSelect" class="col-sm-6 col-form-label">Select Transport
                                Code</label>
                            <div class="input-group mb-3">
                                <select class="form-control" id="TransportCodeSelect" name="TransportCodeSelect">
                                    <option value="">Select a Transport Code</option>
                                    {{-- Assuming $transportCodes is passed from the controller --}}
                                    @foreach($getTransportInformation as $code)
                                    <option value="{{ $code->trasporot_code }}">{{ $code->trasporot_code }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <span style="color:red"> @ error ('TransportCode') { { $message }} @enderror </span>  --}}

                            <label for="TRPA" class="col-sm-6 col-form-label">Transport allowance</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">LKR</span>
                                </div>
                                <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)"
                                    id="TRPA" name="TRPA">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                                <span style="color:red"> @error ('TRPA') {{ $message }} @enderror </span>
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
                        <h4 class="card-title">Trasport Detils With Price </h4>
                        <table id="Trasport_detail_salary" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Transport Code</th>
                                    <th>Trasport Description</th>
                                    <th>Trasport Price</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getTransportPrice as $getTransportPriceData)
                                <tr id="rmTransportPrice{{ $getTransportPriceData->id }}">
                                    <td>{{ $getTransportPriceData->trasporot_code }}</td>
                                    <td>{{ $getTransportPriceData->description }}</td>
                                    <td>LKR {{ $getTransportPriceData->transport_price }}</td>
                                    <td>
                                        <div class="row">
                                            <!-- Delete -->
                                            <button type="button" class="btn btn-danger btn-sm h6 mr-1"
                                                value="{{ $getTransportPriceData->id }}" id="delete_transportPrice" data-toggle="tooltip"
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

            // Start Delete
            $(document).on('click', '#delete_transportDetail, #delete_transportPrice', function () {
                const thisElement = $(this); // Get the clicked element
                const id_name = thisElement.attr('id'); // Extract the ID
                var id = thisElement.val();

                if (id_name == "delete_transportDetail") {

                    var del_URL = "/administrativehub.Trasnport_detials.delete/";

                } else if (id_name == "delete_transportPrice") {
                    
                    var del_URL = "/administrativehub.Trasnport_detials_price.delete/";
                }

                deleteDataOfTable(id_name, id, del_URL);
            });

            // >> Delete function
            function deleteDataOfTable(id_name, id, del_URL) {

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
                                if(id_name == "delete_transportDetail"){
                                $('#rmTransportDetail' + id).remove();
                                location.reload();
                               
                                }
                                else{
                                    $('#rmTransportPrice' + id).remove();
                                }
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
