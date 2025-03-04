@extends('layouts.company.main')
@section('content')
@section('title', 'View Task Details')
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Row-->
            <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
                <!--begin::Timeline widget 3-->
                <div class="card h-md-100">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible">
                            {{ session('success') }}
                        </div>
                    @endif
                    @php
                        $formDetails = json_decode($taskdetails->response_data, true);
                    @endphp
                    <!--begin::Header-->
                    <div class="card-header p-0 align-items-center">
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Employee Name</th>
                                        <td>{{ $taskdetails->user->name }}</td>
                                    </tr>
                                    @foreach ($formDetails as $key => $item)
                                    <tr>
                                        <th>{{ ucfirst($key) }}</th>
                                        <td>{{ $item }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <th>Task Status</th>
                                        <td>{{ ucfirst($taskdetails->user_end_status) }}</td>
                                    </tr>
                                    @if(!empty($taskdetails->image))
                                    <tr>
                                        <th>Image</th>
                                        <td>
                                            <img src="{{ $taskdetails->image }}" alt="Task Image" style="max-width: 200px; height: auto;"/>
                                        </td>
                                    </tr>
                                    @endif
                                    @if(!empty($taskdetails->document))
                                    <tr>
                                        <th>Document</th>
                                        <td>
                                            <embed src="{{ $taskdetails->document }}" type="application/pdf" width="100%" height="400px" />
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
@endsection
