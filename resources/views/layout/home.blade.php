@extends('include.commonstr')
@section('content')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            
        </div>
        <!--========================= staff or admin section ===================-->
        @if($which_roletype_of_user->roleType == "staff" || $which_roletype_of_user->roleType == "admin")
       
        <div class="row  mt-3">
            {{-- chart Section --}}
            <div class="col-xl-7 d-flex grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            {{-- process of This month --}}
            <div class="col-xl-5 d-flex grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between">
                            <h4 class="card-title mb-3">Process of this month</h4>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="d-flex justify-content-between mb-4">
                                    <div>Month</div>
                                    <div class="text-muted"> 
                                        @php
                                echo date("Y") ."/". date("m");
                                @endphp</div>
                                </div>
                                <div class="d-flex justify-content-between mb-4">
                                    <div>Scheduled Task</div>
                                    <div class="text-muted">
                                        @if($admin_GetFullScheduleOfMonth_all)
                                        {{ $admin_GetFullScheduleOfMonth_all }}
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-4">
                                    <div>Completed Task</div>
                                    <div class="text-muted">
                                        @if($admin_Confirmed_all_session_of_month_for_admin)
                                        {{ $admin_Confirmed_all_session_of_month_for_admin }}
                                        @endif
                                    </div>
                                </div>
                                <progress id="file" value="
                                        @if($admin_Confirmed_all_session_of_month_for_admin)
                                        {{ $admin_Confirmed_all_session_of_month_for_admin }}
                                        @endif
                                        " max="
                                        @if($admin_GetFullScheduleOfMonth_all)
                                        {{ $admin_GetFullScheduleOfMonth_all }}
                                        @endif
                                        "> 32% </progress>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Month price range --}}
        <div class="row">
            <div class="col-xl-1 d-flex grid-margin stretch-card">
                </div>
            <div class="col-xl-5 d-flex grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3>Rank of teacher</h3>
                        <hr>
                        <ul class="list-unstyled">
                            @foreach($rank_with_month_salary_of_teacher as $rank_of_teacher)
                            <li class="mb-2">
                                <strong>{{ $rank_of_teacher->first_name }} {{ $rank_of_teacher->second_name }}</strong> {{ $rank_of_teacher->groupnetSumV }}
                                <hr>
                            </li>
                            @endforeach
                        </ul>
                        <div class="salary-range-bar mt-3" style="background: linear-gradient(to right, #4ade80 0%, #22d3ee 100%); border-radius: 8px; height: 20px;">
                            <!-- Gradient bar as a visual representation of the range -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-1 d-flex grid-margin stretch-card">
                </div>
            <!-- <div class="col-xl-6 d-flex grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between">
                            <h4 class="card-title mb-3">Summery Schema</h4>

                        </div>
                        <div>
                            <canvas id="schema"></canvas>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-xl-4 d-flex grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between">
                            <h4 class="card-title mb-3">Compare Payment</h4>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-5">
                                    <div class="mr-1">
                                        <div class="text-info mb-1">
                                            This Month
                                        </div>
                                        <h2 class="mb-2 mt-2 font-weight-bold">
                                            @foreach($get_allSalary_for_this_month as $this_month_sal)
                                            {{ $this_month_sal->groupnetSumV }}
                                            @endforeach (LKR)
                                        </h2>
                                        <div class="font-weight-bold">
                                            Month : @php
                                            echo date("Y/m");
                                            @endphp
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="mr-1">
                                        <div class="text-info mb-1">
                                            previous Month
                                        </div>
                                        <h2 class="mb-2 mt-2  font-weight-bold">
                                            @foreach($get_allSalary_for_previous_month as $previous_month_sal)
                                            {{ $previous_month_sal->groupnetSumV }}
                                            @endforeach
                                             (LKR)</h2>
                                        <div class="font-weight-bold">
                                            Month : @php
                                            echo date("Y/m", strtotime("-1 month"));
                                            @endphp
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Payment and Loan --}}
        <div class="row">
            <div class="col-lg-5 d-flex grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between">
                            <h4 class="card-title mb-3">Payment and Loan</h4>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="text-success font-weight-bold">
                                            @php
                                            echo date("Y/m");
                                            @endphp
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="font-weight-medium">Salary of this month </div>
                                        <div class="text-muted"> 
                                            @foreach($get_allSalary_for_this_month as $this_month_sal)
                                            {{ $this_month_sal->groupnetSumV }}
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="font-weight-medium">Loan</div>
                                        <div class="text-muted">
                                             @foreach($month_total_loan as $month_total_loan)
                                            {{ $month_total_loan->monthcredit }}
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="font-weight-medium">Additional Allowance</div>
                                        <div class="text-muted">
                                              @foreach($month_total_additional_allowance as $month_total_additional_allowance)
                                            {{ $month_total_additional_allowance->monthlyadditional_allowance }}
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Loan Chart --}}
            <div class="col-lg-7 d-flex grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between">
                            <h4 class="card-title mb-3">Loan</h4>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <canvas id="barChart_loan"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--================================== Teacher section ===========================-->
        @elseif($which_roletype_of_user->roleType == "teacher")
        
        <div class="row  mt-3">
            {{-- chart Section --}}
            <div class="col-xl-5 d-flex grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                     
                    <br>
                    <center>
                        <h2>
                            <u>
                                @php
                                echo date("Y") ."/". date("m");
                                @endphp
                            </u>
                        </h2>
                    </center>
                    <div class="card-body">
                        <table border="0">
                            <tbody>
                                <tr>
                                    <td>Received Total Schedule :</td>
                                    <td style="text-align: right;">
                                        @if($getTotalReceived_task)
                                        {{ $getTotalReceived_task }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Completed Total Schedule :</td>
                                    <td style="text-align: right;">
                                        @if($getTotalCompleted_task)
                                        {{ $getTotalCompleted_task }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Completed Additional Schedule :</td>
                                    <td style="text-align: right;">
                                        @if($getTotalAdditionalTask)
                                        {{ $getTotalAdditionalTask}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <hr>
                                        Schedule calculation (+) :</td>
                                    <td style="text-align: right;">
                                    <hr>
                                        @if($getTotalSchedule_calculationForMonth)
                                        {{ $getTotalSchedule_calculationForMonth }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total Allowance (+) :</td>
                                    <td style="text-align: right;">
                                        @if($Teacher_for_total_Allowance_Task )
                                        {{ $Teacher_for_total_Allowance_Task   }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total Transport (+) :</td>
                                    <td style="text-align: right;">
                                        @if($Teacher_for_total_trp_Task)
                                        {{ $Teacher_for_total_trp_Task }}
                                        @endif
                                    </td>
                                </tr>
                                
                                <tr>
                                    
                                    <td>Total Additional Allowance (+) :</td>
                                    <td style="text-align: right;">
                                        @if($Teacher_for_total_Additional_Allowance_Task)
                                        {{ $Teacher_for_total_Additional_Allowance_Task }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Credit (-):</td>
                                    <td style="text-align: right;">
                                        @if($Teacher_for_total_credit_Task)
                                         {{ $Teacher_for_total_credit_Task }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>
                                        <hr>
                                        Total : </strong></td>
                                    <td style="text-align: right;"><strong>
                                        <hr>
                                            @if($Teacher_for_total_Total_Salary )
                                             {{ $Teacher_for_total_Total_Salary  }}
                                            @endif
                                        </strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
              
                    </div>
                </div>
            </div>
                {{-- process of This month --}}
                    <div class="col-xl-5 d-flex grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap justify-content-between">
                                    <h4 class="card-title mb-3">Process of this month</h4>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="d-flex justify-content-between mb-4">
                                            <div>Month</div>
                                            <div class="text-muted"> 
                                                @php
                                        echo date("Y") ."/". date("m");
                                        @endphp</div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-4">
                                            <div>Scheduled Task</div>
                                            <div class="text-muted">
                                                @if($get_teacher_schedule)
                                                {{ $get_teacher_schedule }}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-4">
                                            <div>Completed Task</div>
                                            <div class="text-muted">
                                                @if($get_teacher_schedule_confrimed)
                                                {{ $get_teacher_schedule_confrimed }}
                                                @endif
                                            </div>
                                        </div>
                                        <progress id="file" value="
                                                @if($get_teacher_schedule_confrimed)
                                                {{ $get_teacher_schedule_confrimed }}
                                                @endif
                                                " max="
                                                @if($get_teacher_schedule)
                                                {{ $get_teacher_schedule }}
                                                @endif
                                                "> 32% </progress>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                                {{-- Loan Chart --}}
                                <div class="col-lg-8 d-flex grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex flex-wrap justify-content-between">
                                                <h4 class="card-title mb-3">Loan</h4>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div>
                                                        <canvas id="barChart_loan"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
        @endif
    </div>

    <!-- content-wrapper ends -->
    @push('scripts')
    <!-- chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"
        integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <!-- End chart js -->

    <!--============= staff section ====================-->
     @if($which_roletype_of_user->roleType == "staff" || $which_roletype_of_user->roleType == "admin")
    <script>
        // Assuming $salarySummaries is passed to the Blade view
        const salaryData = @json($salarySummaries -> pluck('groupnetSumV'));
        const salaryMonths = @json($salarySummaries -> pluck('salary_month'));
        const date_and_year = @json($loanForMonth -> pluck('date_and_year'));
        const credit_month = @json($loanForMonth -> pluck('credit_month'));

    </script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: salaryMonths, // Use salaryMonths for the x-axis labels
                datasets: [{
                    label: 'Net Salary',
                    data: salaryData, // Use salaryData for the y-axis values
                    borderWidth: 1,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1 // Adds some smoothness to the line
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true // Ensures the y-axis starts at 0
                    }
                }
            }
        });
        // // second chart
        // const Utils = {
        //     numbers: function (cfg) {
        //         let arr = [];
        //         for (let i = 0; i < cfg.count; i++) {
        //             arr.push(Math.floor(Math.random() * (cfg.max - cfg.min + 1)) + cfg.min);
        //         }
        //         return arr;
        //     },
        //     CHART_COLORS: {
        //         red: 'rgb(255, 99, 132)',
        //         orange: 'rgb(255, 159, 64)',
        //         yellow: 'rgb(255, 205, 86)',
        //         green: 'rgb(75, 192, 192)',
        //         blue: 'rgb(54, 162, 235)',
        //     }
        // };

        // // Provided configuration
        // const DATA_COUNT = 5;
        // const NUMBER_CFG = {
        //     count: DATA_COUNT,
        //     min: 0,
        //     max: 100
        // };

        // const data = {
        //     labels: ['Red', 'Orange', 'Yellow', 'Green', 'Blue'],
        //     datasets: [{
        //         label: 'Dataset 1',
        //         data: Utils.numbers(NUMBER_CFG),
        //         backgroundColor: Object.values(Utils.CHART_COLORS),
        //     }]
        // };

        // const config = {
        //     type: 'doughnut',
        //     data: data,
        //     options: {
        //         responsive: true,
        //         plugins: {
        //             legend: {
        //                 position: 'top',
        //             },
        //             title: {
        //                 display: true,
        //                 text: 'Chart.js Doughnut Chart'
        //             }
        //         }
        //     },
        // };

        // // Initialize the chart
        // const schema = document.getElementById('schema').getContext('2d');
        // const myChart2 = new Chart(schema, config);

        // Loan section
        document.addEventListener('DOMContentLoaded', (event) => {
            const loanData = {
                labels: date_and_year, // Example labels
                datasets: [{
                    label: 'Number of Loans',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: credit_month, // Example data
                }]
            };

            const config_loan = {
                type: 'bar',
                data: loanData,
                options: {}
            };

            const loanChartCtx = document.getElementById('barChart_loan').getContext('2d');
            const loanChart = new Chart(loanChartCtx, config_loan);
        });

    </script>

    <!--=================== teacher section ================================-->
    @elseif($which_roletype_of_user->roleType == "teacher")
    <script>
        // Assuming $salarySummaries is passed to the Blade view
        const date_and_year = @json($get_get_balance_of_loan_teacher_thisMonth -> pluck('provide_date'));
        const credit_month = @json($get_get_balance_of_loan_teacher_thisMonth -> pluck('amount'));

    </script>
    <script>
    

        // Loan section
        document.addEventListener('DOMContentLoaded', (event) => {
            const loanData = {
                labels: date_and_year, // Example labels
                datasets: [{
                    label: 'Number of Loans',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: credit_month, // Example data
                }]
            };

            const config_loan = {
                type: 'bar',
                data: loanData,
                options: {}
            };

            const loanChartCtx = document.getElementById('barChart_loan').getContext('2d');
            const loanChart = new Chart(loanChartCtx, config_loan);
        });

    </script>
     @endif
    @endpush
    @endsection
