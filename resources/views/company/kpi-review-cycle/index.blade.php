@extends('layouts.company.main')
@section('title','KPI Review Cycles')
@section('content')
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card custom-table p-0">
                <div class="card-header cursor-pointer">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <form id="filterForm" class="mb-3">
                            <select name="type" class="form-control">
                                <option value="">All Types</option>
                                <option value="Monthly">Monthly</option>
                                <option value="Quarterly">Quarterly</option>
                                <option value="Yearly">Yearly</option>
                                <option value="Other">Other</option>
                            </select>
                        </form>
                    </div>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal_add" class="btn btn-sm btn-primary align-self-center">
                        Add KPI Cycle</a>
                </div>

                <div class="mb-5 mb-xl-10" id="kpi_list">
                    @include('company.kpi-review-cycle.list')
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    @include('company.kpi-review-cycle.modals')
    <script>
        $(function() {
            // Whenever any input inside #filterForm changes, re-run the filter
            $('#filterForm').on('change', 'select, input', function() {
                $.get("{{ route('kpi-review-cycles.index') }}", $('#filterForm').serialize(), function(data) {
                    $('#kpi_list').html(data);
                }).fail(() => Swal.fire('Error', 'Could not filter list', 'error'));
            });
        });

    </script>
    @endsection
