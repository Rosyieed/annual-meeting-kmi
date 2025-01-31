@extends('admin-layouts.master')

@section('title', 'Dashboard')

@section('page-header')
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Dashboard</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Dashboard</li>
            </ul>
        </div>
    </div>
    <!-- [ page-header ] end -->
@endsection

@section('content')
    <div class="row">
        <!-- [Total Users] start -->
        <div class="col-xxl-3 col-md-6">
            <div class="card stretch stretch-full">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-4">
                        <div class="d-flex align-items-center gap-4">
                            <div class="avatar-text avatar-lg bg-gray-200">
                                <i class="feather-user"></i>
                            </div>
                            <div>
                                <div class="fs-4 fw-bold text-dark">
                                    <span class="counter">{{ $totalUsers }}</span>
                                </div>
                                <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Users</h3>
                            </div>
                        </div>
                        <a href="javascript:void(0);" class="">
                            <i class="feather-more-vertical"></i>
                        </a>
                    </div>
                    <div class="pt-4">
                        <div class="progress ht-3 mt-2">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [Total Users] end -->

        <!-- [Total Groups] start -->
        <div class="col-xxl-3 col-md-6">
            <div class="card stretch stretch-full">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-4">
                        <div class="d-flex align-items-center gap-4">
                            <div class="avatar-text avatar-lg bg-gray-200">
                                <i class="feather-users"></i>
                            </div>
                            <div>
                                <div class="fs-4 fw-bold text-dark">
                                    <span class="counter">{{ $totalGroups }}</span>
                                </div>
                                <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Groups</h3>
                            </div>
                        </div>
                        <a href="javascript:void(0);" class="">
                            <i class="feather-more-vertical"></i>
                        </a>
                    </div>
                    <div class="pt-4">
                        <div class="progress ht-3 mt-2">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [Total Groups] end -->

        <!-- [Total Questions] start -->
        <div class="col-xxl-3 col-md-6">
            <div class="card stretch stretch-full">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-4">
                        <div class="d-flex align-items-center gap-4">
                            <div class="avatar-text avatar-lg bg-gray-200">
                                <i class="feather-help-circle"></i>
                            </div>
                            <div>
                                <div class="fs-4 fw-bold text-dark">
                                    <span class="counter">{{ $totalQuestions }}</span>
                                </div>
                                <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Questions</h3>
                            </div>
                        </div>
                        <a href="javascript:void(0);" class="">
                            <i class="feather-more-vertical"></i>
                        </a>
                    </div>
                    <div class="pt-4">
                        <div class="progress ht-3 mt-2">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [Total Questions] end -->

        <!-- [Total Users Active] start -->
        <div class="col-xxl-3 col-md-6">
            <div class="card stretch stretch-full">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-4">
                        <div class="d-flex align-items-center gap-4">
                            <div class="avatar-text avatar-lg bg-gray-200">
                                <i class="feather-activity"></i>
                            </div>
                            <div>
                                <div class="fs-4 fw-bold text-dark">
                                    <span class="counter">{{ $activePercentage }}</span>%
                                </div>
                                <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Users Active</h3>
                            </div>
                        </div>
                        <a href="javascript:void(0);" class="">
                            <i class="feather-more-vertical"></i>
                        </a>
                    </div>
                    <div class="pt-4">
                        <div class="progress ht-3 mt-2">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [Total Users Active] end -->

        <!-- [Users Process Overview] start -->
        <div class="col-xxl-4">
            <div class="card stretch stretch-full">
                <div class="card-header">
                    <h5 class="card-title">Users Process Overview</h5>
                    <div class="card-header-action">
                        <div class="card-header-btn">
                            <div data-bs-toggle="tooltip" title="Delete">
                                <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger"
                                    data-bs-toggle="remove"> </a>
                            </div>
                            <div data-bs-toggle="tooltip" title="Refresh">
                                <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning"
                                    data-bs-toggle="refresh"> </a>
                            </div>
                            <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                                <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success"
                                    data-bs-toggle="expand"> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body custom-card-action">
                    <!-- Pie chart -->
                    <div id="process-status-overview"></div>
                </div>
            </div>
        </div>
        <!-- [Users Process Overview] end -->

        <!-- [Group Leader] start -->
        <div class="col-xxl-8">
            <div class="card stretch stretch-full">
                <div class="card-header">
                    <h5 class="card-title">Group Leader</h5>
                    <div class="card-header-action">
                        <div class="card-header-btn">
                            <div data-bs-toggle="tooltip" title="Delete">
                                <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger"
                                    data-bs-toggle="remove"> </a>
                            </div>
                            <div data-bs-toggle="tooltip" title="Refresh">
                                <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning"
                                    data-bs-toggle="refresh"> </a>
                            </div>
                            <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                                <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success"
                                    data-bs-toggle="expand"> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body custom-card-action p-0">
                    <div class="table-responsive">
                        <table class="table-hover mb-0 table" id="groupLeaderTable">
                            <thead>
                                <tr class="border-b">
                                    <th>Group Name</th>
                                    <th>Group Leader</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groups as $group)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <a href="javascript:void(0);">
                                                    <span class="d-block">{{ $group->txtGroupName }}</span>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);">
                                                <span
                                                    class="d-block">{{ $group->leader ? $group->leader->txtName : 'Leader Assignment Pending' }}</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="card-footer">
                    <ul class="list-unstyled d-flex align-items-center pagination-common-style mb-0 gap-2">
                        <li>
                            <a href="javascript:void(0);"><i class="bi bi-arrow-left"></i></a>
                        </li>
                        <li><a href="javascript:void(0);" class="active">1</a></li>
                        <li><a href="javascript:void(0);">2</a></li>
                        <li>
                            <a href="javascript:void(0);"><i class="bi bi-dot"></i></a>
                        </li>
                        <li><a href="javascript:void(0);">8</a></li>
                        <li><a href="javascript:void(0);">9</a></li>
                        <li>
                            <a href="javascript:void(0);"><i class="bi bi-arrow-right"></i></a>
                        </li>
                    </ul>
                </div> --}}
            </div>
        </div>
        <!-- [Group Leader] end -->

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const table = document.getElementById('groupLeaderTable');
                const dataTable = new DataTable(table);
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                fetch('/admin/dashboard/get-process-status')
                    .then(response => response.json())
                    .then(data => {
                        const filled = data.filled;
                        const notFilled = data.notFilled;
                        const done = data.done;

                        var options = {
                            series: [filled, notFilled, done],
                            chart: {
                                width: 380,
                                type: 'pie',
                            },
                            labels: ['Question Complete', 'Question Not Started', 'All Steps Complete'],
                            legend: {
                                position: 'bottom', // Memindahkan legend ke bawah chart
                                horizontalAlign: 'center', // Agar legend berada di tengah
                                fontSize: '14px',
                                markers: {
                                    width: 12,
                                    height: 12
                                },
                                itemMargin: {
                                    horizontal: 10,
                                    vertical: 5
                                }
                            },
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: 300
                                    },
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            }]
                        };

                        var chart = new ApexCharts(document.querySelector("#process-status-overview"), options);
                        chart.render();
                    })
                    .catch(error => console.error('Error fetching data: ', error));
            });
        </script>
    </div>
@endsection
