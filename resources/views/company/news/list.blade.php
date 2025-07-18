<div class="table-responsive" id="news_list">
    <!--begin::Table-->
    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
        <!--begin::Table head-->
        <thead>
            <tr class="fw-bold">
                <th>Sr. No.</th>
                <th>Title</th>
                <th>News Catgeory</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th class="float-right">Action</th>
            </tr>
        </thead>
        <tbody class="">
            @forelse ($allNewsDetails as $index => $newsDetails)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $newsDetails->title }}</td>
                    <td>{{ $newsDetails->newsCategories->name }}</td>
                    <td>{{ $newsDetails->start_date }}</td>
                    <td>{{ $newsDetails->end_date }}</td>
                    <td data-order="Invalid date">
                        <label class="switch">
                            <input type="checkbox" <?= $newsDetails->status == '1' ? 'checked' : '' ?>
                                onchange="handleStatus({{ $newsDetails->id }})"
                                id="checked_value_{{ $newsDetails->id }}">
                            <span class="slider round"></span>
                        </label>
                    </td>
                    <td>
                        <div class="d-flex justify-content-end flex-shrink-0">
                            <a href="{{ route('news.view', $newsDetails->id) }}"
                                class="btn btn-dark btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <i class="fa fa-eye"></i>
                                <!--end::Svg Icon-->
                            </a>
                            <a href="{{ route('news.edit', $newsDetails->id) }}"
                                class="btn btn-primary btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <i class="fa fa-edit"></i>
                                <!--end::Svg Icon-->
                            </a>
                            <a href="#" class="btn btn-danger btn-sm me-1"
                                onclick="deleteFunction('{{ $newsDetails->id }}')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No News Found!</strong>
                    </span>
                </td>
            @endforelse
        </tbody>
        <!--end::Table body-->
    </table>
{{ $allNewsDetails->links() }}
    <!--end::Table-->
</div>
