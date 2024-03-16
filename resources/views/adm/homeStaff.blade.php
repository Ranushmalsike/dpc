<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Start Add link for DataTable -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">
        <!-- End DataTable link -->
        <!-- Start Sweet alert link -->
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
        <!-- End Sweet alert Link -->
        <!-- Start Bootstrap icon CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <!-- End Bootstrap Icon CDN -->



    </head>

    <body>
        <main class="container">
            <div class="row  mt-5">
                <!--Start alert -->
                @if(Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                </div>
                @endif

                @if(Session::get('fail'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('fail') }}
                </div>
                @endif
                <!-- End alert -->

                <!-- Add admin section -->
                <div class="col-md-3 bg-primary">

                    <h3 class="text-decoration-underline fw-bold">Add Admin</h3>
                    <form class="container" method="POST" action="{{ route('adminsave') }}">
                        @csrf
                        <div class="form-group">
                            <label for="username">Admin:</label>
                            <input type="text" class="form-control" name="username" id="usernname"
                                placeholder="Enter email" value="{{  old('username') }}">
                            <span style="color:red"> @error ('username') {{ $message }} @enderror </span>
                        </div>
                        <div class="form-group">
                            <label for="useremail">Email:</label>
                            <input type="email" name="useremail" id="useremail" class="form-control"
                                placeholder="Enter email" value="{{  old('useremail') }}">
                            <span style="color:red"> @error ('useremail') {{ $message }} @enderror </span>
                        </div>
                        <div class="form-group">
                            <label for="pass">Passord:</label>
                            <input type="password" name="pass" id="pass" class="form-control"
                                placeholder="Enter password" value="{{  old('pass') }}">
                            <span style="color:red"> @error ('pass') {{ $message }} @enderror </span>
                        </div>
                        <center>
                            <button type="submit" class="btn btn-danger btn-sm mt-2">Submit</button>
                        </center>
                    </form>
                    <hr>
                    <table id="user_adm" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>user Code</th>
                                <th>username</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admintb as $admintb)
                            <tr id="userIDofadm{{ $admintb->id  }}">
                                <td>{{ $admintb->id }}</td>
                                <td>{{ $admintb->name  }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm h6 mr-1"
                                        value="{{ $admintb->id }}" id="delete_usertb"><i
                                            class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End add Admin section -->

                <!-- add permission data for permission table -->
                <div class="col-md-3 bg-secondary">
                    <h3 class="text-decoration-underline fw-bold">Permission Table</h3>
                    <form class="container" method="POST" action="{{ route('permisionData') }}">
                        @csrf
                        <div class="form-group">
                            <label for="username">Permision Text:</label>
                            <input type="text" class="form-control" name="permisiontext" id="permissiontext"
                                placeholder="Enter permission text">
                            <span style="color:red;">@error ('permisiontext'){{ $message }} @enderror</span>
                        </div>
                        <center>
                            <button type="submit2" class="btn btn-danger btn-sm mt-2">Submit</button>
                        </center>
                    </form>
                    <hr>
                    <table id="permission_tb" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>UerRole Code</th>
                                <th>User Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userRole as $userRole)
                            <tr id="userRoleID{{ $userRole->id  }}">
                                <td>{{ $userRole->id }}</td>
                                <td>{{ $userRole->roleType  }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm h6 mr-1"
                                        value="{{ $userRole->id }}" id="delete_userrole"><i
                                            class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End add Permssion section -->
                <div class="col-md-5 bg-info">

                    <h3 class="text-decoration-underline fw-bold">Pages Permission table</h3>
                    <form class="container" method="POST" action="{{ route('addPagepermission.add') }}">
                        @csrf
                        <div class="form-group">
                            <label for="username">Page name:</label>
                            <input type="text" class="form-control" name="pageName" id="pageName">
                            <span style="color:red"> @error ('pageName') {{ $message }} @enderror </span>
                        </div>
                        <center>
                            <button type="submit" class="btn btn-danger btn-sm mt-2">Submit</button>
                        </center>
                    </form>
                    <hr>
                    <table id="permissionPage" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>PermissionPage Code</th>
                                <th>Permission Page</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissionTB as $permissionTB)
                            <tr id="permissionpgID{{ $permissionTB->id  }}">
                                <td>{{ $permissionTB->id }}</td>
                                <td>{{ $permissionTB->nameOfPage  }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm h6 mr-1"
                                        value="{{ $permissionTB->id }}" id="delete_permisionTB"><i
                                            class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            <hr>
                <br>
                <!-- Process Type -->
                <div class="col-md-3 bg-success">

                    <h3 class="text-decoration-underline fw-bold">Proccess text</h3>
                    <form class="container" method="POST" action="{{ route('processData.add') }}">
                        @csrf
                        <div class="form-group">
                            <label for="username">Process Type:</label>
                            <input type="text" class="form-control" name="process_text" id="process_text">
                            <span style="color:red"> @error ('process_text') {{ $message }} @enderror </span>
                        </div>
                        <center>
                            <button type="submit" class="btn btn-danger btn-sm mt-2">Submit</button>
                        </center>
                    </form>
                    <hr>
                    <table id="processID" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Process ID</th>
                                <th>Proccess Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proccessTypeData as $pTD)
                            <tr id="proccessID{{ $pTD->id  }}">
                                <td>{{ $pTD->id }}</td>
                                <td>{{ $pTD->type  }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm h6 mr-1"
                                        value="{{ $pTD->id }}" id="delete_permisionTB"><i
                                            class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            

            <div class="row mt-2">
                <!-- Add Permission page section -->

                <!-- End add Permission page section -->
            </div>
            </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Start DataTable Script Link -->
        <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

        <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
        <script type="text/javascript" charset="utf8"
            src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
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

                /**
                 * permission page TB
                 */
                $('#permissionPage, #user_adm, #permission_tb, #processID').DataTable({
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
                            title: 'Daphne Lord School (System Developer Section)',
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

                /*
                >>Delete for userrole
                */
                $(document).on('click', '#delete_usertb, #delete_userrole, #delete_permisionTB', function () {
                    // Get the id of the clicked button
                    var Which_button = $(this).attr('id');
                    var id = $(this).val()
                    var del_URL;
                    // Check which button was clicked
                    if (Which_button === 'delete_usertb') {
                         del_URL = "/systemMaintenance.user.delete/";
                    } else if (Which_button === 'delete_userrole') {
                         del_URL = "/systemMaintenance.userRole.delete/";
                    } else if (Which_button === 'delete_permisionTB') {
                         del_URL = "/systemMaintenance.permissionPage.delete/";
                    }
                    //alert(del_URL);
                    deleteDataOfTable(id, del_URL, Which_button);
                    // Rest of your code...
                });

                function deleteDataOfTable(id, del_URL, Which_button){
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
                                //if userIDofadm 
                                if (Which_button == "delete_usertb") {
                                    $('#userIDofadm' + id).remove();
                                    success();
                                }
                                //if userRoleID
                                else if (Which_button == "delete_userrole") {
                                    $('#userRoleID' + id).remove();
                                    success();
                                }
                                //if permissionpgID 
                                else if(Which_button == "delete_permisionTB") {
                                    $('#permissionpgID' + id).remove();
                                    success();
                                }
                            }
                        });
                    }
                });
                }


            });

        </script>
    </body>

</html>
