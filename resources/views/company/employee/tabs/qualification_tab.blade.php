<div class="tab-pane fade" id="qualification_tab">
    <!--begin::Wrapper-->
    <input type="hidden" name="company_id" class="id">
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="">Degree*</label>
                <select class="form-control" onchange="get_qualification_html()" name="qualification_id">
                    <option value="">Select The Qualification</option>
                    @forelse ($allQualification as $qualificationDetails)
                        <option value="{{ $qualificationDetails->id }}">
                            {{ $qualificationDetails->name }}</option>
                    @empty
                        <option value="">No Qualification Found</option>
                    @endforelse
                </select>
            </div>
            <div class="col-md-12 form-group">
                <div class="panel" id="qualification_html">
                </div>
            </div>
        </div>
        <button onclick="show_next_tab('bank_details_tab')" class="btn btn-primary"><i class="fa fa-arrow-left"></i>  Previous</button>
                {{-- <button onclick="save_data_show_next_tab('advance_details_tab')"
    class="btn btn-primary">Save & Continue</button> --}}
                <button onclick="show_next_tab('past_work_tab')" class="btn btn-primary float-right">Next <i class="fa fa-arrow-right"></i> </button>
</div>
