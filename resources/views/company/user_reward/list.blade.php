<div class="mb-5 mb-xl-10" id="reward_list">
    <div class="card-body py-3">
        <!--begin::Table container-->
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                <!--begin::Table head-->
                <thead>
                    <tr class="fw-bold">
                        <th>Sr. No.</th>
                        <th>Reward Category</th>
                        <th>Employee Name</th>
                        <th>Date</th>
                        <th>Reward Name</th>
                        <th>Description</th>
                        <th>Certificate</th>
                        <th>Document</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="">
                    @forelse ($allRewardDetails as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->rewardCategory->name }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ getFormattedDate($item->date) }}</td>
                            <td>{{ $item->reward_name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                @if ($item->getRawOriginal('image'))
                                    <img src="{{ $item->image }}" alt="Reward Image" width="50" height="50">
                                @endif
                            </td>
                            <td>
                                @if ($item->getRawOriginal('document'))
                                    <a href="{{ $item->document }}" download>
                                        <i class="fa fa-file" style="font-size:35px; color:red;"></i>
                                    </a>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-end flex-shrink-0">
                                    <a href="{{ route('reward.edit', $item->id) }}"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                        <i class="fa fa-edit"></i>
                                        <!--end::Svg Icon-->
                                    </a>
                                    <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                        onclick="deleteFunction('{{ $item->id }}')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                    @empty
                        <td colspan="3">
                            <span class="text-danger">
                                <strong>No Reward Found!</strong>
                            </span>
                        </td>
                    @endforelse
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Table container-->

    </div>
    <div id="paginate">
        {{ $allRewardDetails->links() }}
    </div>
</div>
