<div class="tab-pane fade" id="past_work_tab">
    <!--begin::Wrapper-->
    <input type="hidden" name="company_id" class="id">
        <div class="row">
            {{-- <div class="col-md-4 form-group">
                <label for="">Previous Company*</label>
                <select class="form-control" name="previous_company_id" id="previous_company_id">
                    <option value="">Select The Previous Company</option>
                    @forelse ($allPreviousCompany as $previousCompany)
                        <option value="{{ $previousCompany->id }}">
                            {{ $previousCompany->name }}</option>
                    @empty
                        <option value="">No Previous Company Found</option>
                    @endforelse
                </select>
            </div> --}}

            <div class="col-md-4 form-group">
                <div class="k-w-300">
                    <label for="previous_company_id">Previous Company*</label>
                    <input id="previous_company_id" class="form-control"  name="previous_company_id" />
                </div>
                <script id="noPreviousCompanyTemplate" type="text/x-kendo-tmpl">
                    <div>
                        No data found. Do you want to add new item - '#: instance.filterInput.val() #' ?
                    </div>
                    <br />
                    <button class="k-button k-button-solid-base k-button-solid k-button-md k-rounded-md" onclick="addNewPreviousCompany('#: instance.element[0].id #', '#: instance.filterInput.val() #')">Add new item</button>
                </script>
            </div>

            <div class="col-md-4 form-group">
                <label class="mt-3"> <button class="btn btn-primary btn-sm mt-5"
                        onclick="get_previous_company_html()"> <i class="fa fa-plus"></i></button>
                </label>
            </div>
            <div class="col-md-12 form-group">
                <div class="panel" id="previous_company_html">
                </div>

            </div>
        </div>
        <button onclick="show_next_tab('qualification_tab')" class="btn btn-primary"><i class="fa fa-arrow-left"></i>   Previous</button>
                {{-- <button onclick="save_data_show_next_tab('advance_details_tab')"
    class="btn btn-primary">Save & Continue</button> --}}
                <button onclick="show_next_tab('permission_tab')" class="btn btn-primary float-right">Next <i class="fa fa-arrow-right"></i>  </button>
    <!--end::Wrapper-->
</div>
