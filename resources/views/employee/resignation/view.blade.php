@extends('layouts.company.main')
@section('content')
@section('title')
    Resignation Detail
@endsection
<div class="card card-body col-md-12">
    <div class="mb-5 mb-xl-10">
        <div class="card-body">
            {{-- enctype="multipart/form-data" method="post"
                action="{{ route('resignation.store') }}" --}}
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">

                        <!--begin::Table body-->
                        <tbody class="">
                            <tr>
                                <th class="min-w-150px">Title</th>
                                <td>{{ $resignation->title }}</td>
                            </tr>
                            <tr>
                                <th class="min-w-150px">Description</th>
                                <td>{{ $resignation->description }}</td>
                            </tr>
                            <tr>
                                <th>Resignation Date & Time</th>
                                <td><span
                                        class="btn btn-success btn-sm me-1">{{ date('Y-m-d h:i A', strtotime($resignation->created_at)) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Release Date</th>
                                <td> {{ !empty($resignation->release_date) ? date('Y-m-d h:i A', strtotime($resignation->release_date)) : '--' }}
                                </td>
                            </tr>
                            <tr>
                                <th>Resignation Status</th>
                                <td><span
                                        class="btn btn-danger btn-sm me-1">{{ $resignation->resignationStatus->name }}</span>
                                </td>
                            </tr>

                            <tr>
                                <th colspan="2">Resignation Logs</th>
                            </tr>

                            @forelse ($resignation->resignationActionDetails as $row)
                                <tr>
                                    <th>Action Taken By</th>
                                    <td> {{ $row->actionTakenBy->name }}</td>
                                    <th>Resignation Status</th>
                                    <td> {{ $row->resignationStatus->name }}</td>
                                    <th>Remark </th>
                                    <td> {{ $row->remark }}</td>
                                </tr>

                            @empty
                            @endforelse
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->

            </div>

        </div>
    </div>
</div>
<!--end::Content-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
@endsection
