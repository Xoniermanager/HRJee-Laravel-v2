<div class="card card-flush h-md-100" id="company_connector_list">
    <div class="card-body px-0">
        <!--begin::Nav-->
        <ul class="nav d-flex g-5 mb-3 mx-9" role="tablist" id="connector-tabs">
            @php
                $tabItems = [
                    'all' => 'All',
                    'UNASSIGNED' => 'Pending Approval Unassigned',
                    'ASSIGNED' => 'Pending Approval Assigned',
                    'APPROVED' => 'Approved',
                    'REJECTED' => 'Rejected',
                ];
                $tabCounts = [
                    'all' => $allConnectorCount,
                    'UNASSIGNED' => $pendingApprovalUnassignedConnectorCount,
                    'ASSIGNED' => $pendingApprovalAssignedConnectorCount,
                    'APPROVED' => $approvedConnectorCount,
                    'REJECTED' => $rejectedConnectorCount,
                ];
            @endphp

            @foreach ($tabItems as $key => $label)
                <li class="nav-item mb-3" role="presentation">
                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px {{ $loop->first ? 'active' : '' }}"
                       data-bs-toggle="tab"
                       data-status="{{ $key }}"
                       href="#"
                       role="tab">
                       {{ $label }} ({{ $tabCounts[$key] }})
                    </a>
                </li>
            @endforeach
        </ul>
        <!--end::Nav-->

        <!--begin::Table container-->
        <div class="table-responsive mx-9 mt-n6">
            <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-500">
                        <th>Connector ID</th>
                        <th>Name</th>
                        <th>Profession</th>
                        <th>Email</th>
                        <th>Owner</th>
                        <th>Mobile</th>
                        <th>Employer Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="connector-table-body">
                    @include('company.connector.connector-table-rows', ['connectors' => $connectors])
                </tbody>
            </table>
        </div>

        <div class="col-md-12 clearfix">
            <ul class="pagination mt-3 float-right">
                {{ $connectors->links() }}
            </ul>
        </div>
        <!--end::Table container-->
    </div>
</div>
