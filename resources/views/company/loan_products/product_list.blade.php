<div id="loan_product_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            @php
                $userType = Auth()->user()->userRole->name;
            @endphp
            <thead>
                <tr class="fw-bold">
                    <th>Type</th>
                    <th>Product listing order</th>
                    <th>Status</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            @forelse ($allProductDetails as $key => $productDetails)
                <tbody class="">
                    <tr>
                        @if ($userType == 'Xonier Admin')
                        <td><a href="#" data-bs-toggle="modal"
                                onClick="edit_product_details('{{ $productDetails->id }}', '{{ $productDetails->type }}')">{{ $productDetails->type }}</a>
                        </td>
                        @else
                        <td>{{ $productDetails->type }}</td>
                        @endif
                        {{-- <td>{{ $key + 1 }}</td> --}}
                        <td>{{ $productDetails->listing_order }}</td>
                        <td data-order="Invalid date">
                            <label class="switch">
                                <input type="checkbox" <?= $productDetails->status == '1' ? 'checked' : '' ?>
                                    onchange="handleStatus({{ $productDetails->id }})"
                                    id="checked_value_{{ $productDetails->id }}">
                                <span class="slider round"></span>
                            </label>
                        </td>

                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                @if ($userType == 'Xonier Admin')
                                    <a href="#" data-bs-toggle="modal"
                                        onClick="edit_product_details('{{ $productDetails->id }}', '{{ $productDetails->type }}')"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                        <i class="fa fa-edit"></i>
                                        <!--end::Svg Icon-->
                                    </a>
                                @endif

                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                    onclick="deleteFunction('{{ $productDetails->id }}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Product Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <div class="col-md-12 clearfix">
            <ul class="pagination mt-3 float-right">
                {{ $allProductDetails->links() }}
            </ul>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Table container-->

</div>
