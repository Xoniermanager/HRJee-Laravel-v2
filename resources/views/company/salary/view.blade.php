@extends('layouts.company.main')
@section('content')
@section('title', 'View Salary Structure')
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
            <form action="{{ route('salary.store') }}" method="post" id="salaryForm">
                @csrf
                <div class="card h-md-100">
                    <!--begin::Header-->
                    <div class="card-header p-0 align-items-center">
                        <div class="card-body">
                            <div class="col-md-12">
                                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                    <tbody>
                                        <tr>
                                            <th class="w-200px"> Name</th>
                                            <td>{{ $salariesDetails->name }}</td>
                                            <th>Description</th>
                                            <td>{{ $salariesDetails->description }}</td>
                                        </tr>

                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>

                <h2 class="mt-5 text-center">All Assigned Components</h2>
                <div class="row">
                    @foreach ($salariesDetails->salaryComponentAssignments as $item)
                    <div class="col-md-4 mt-4">
                        <div class="card h-md-100 mt-4">
                            <!--begin::Header-->
                            <div class="card-header p-0 align-items-center">
                                <div class="card-body">
                                    {{-- {{ dd($allSalaryComponentDetails) }} --}}

                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-row-dashed table-row-gray-300 align-middle">
                                                <tbody>
                                                    <tr>
                                                        <th class="w-200px"> Salary Component</th>
                                                        <td>{{ $item->salaryComponent->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> Value</th>
                                                        <td>{{ $item->value }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> Earning Or Deduction</th>
                                                        <td>{{ ucfirst($item->earning_or_deduction) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> Value Type</th>
                                                        <td>{{ ucfirst($item->value_type) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Parent Component</th>
                                                        <td>{{ $item->salaryComponent->parentSalaryComponent->name ?? ''}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
        </div>
    </div>
</div>
@endsection
