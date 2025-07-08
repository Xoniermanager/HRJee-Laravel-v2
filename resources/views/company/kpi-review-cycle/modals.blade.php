<!-- Modal: Add -->
<div class="modal fade" id="modal_add" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered mw-500px">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add KPI Review Cycle</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">✖</span>
                </div>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    @csrf
                    <div class="mb-3">
                        <label class="required">Type</label>
                        <select name="type" class="form-control" required>
                            <option value="">Select Type</option>
                            <option value="Monthly">Monthly</option>
                            <option value="Quarterly">Quarterly</option>
                            <option value="Yearly">Yearly</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="required">Start Date</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="required">End Date</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-end border-top pt-3">
                        <button type="reset" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Edit -->
<div class="modal fade" id="modal_edit" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered mw-500px">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit KPI Review Cycle</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">✖</div>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    <input type="hidden" name="id" id="edit_id">
                    <div class="mb-3">
                        <label class="required">Type</label>
                        <select name="type" id="edit_type" class="form-control" required>
                            <option value="">Select Type</option>
                            <option value="Monthly">Monthly</option>
                            <option value="Quarterly">Quarterly</option>
                            <option value="Yearly">Yearly</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="required">Start Date</label>
                        <input type="date" name="start_date" id="edit_start_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="required">End Date</label>
                        <input type="date" name="end_date" id="edit_end_date" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-end border-top pt-3">
                        <button type="reset" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        // Add
        $("#addForm").validate({
            rules: {
                type: "required"
                , start_date: "required"
                , end_date: "required"
            }
            , submitHandler: function(form) {
                $.post("{{ route('kpi-review-cycles.store') }}", $(form).serialize(), res => {
                    $('#modal_add').modal('hide');
                    Swal.fire('Success!', res.message, 'success');
                    $('#kpi_list').html(res.data);
                    form.reset();
                }).fail(xhr => {
                    Swal.fire('Error!', xhr.responseJSON.message || 'Validation failed', 'error');
                });
            }
        });

        // Edit
        $("#editForm").validate({
            rules: {
                type: "required"
                , start_date: "required"
                , end_date: "required"
            }
            , submitHandler: function(form) {
                $.post("{{ route('kpi-review-cycles.update') }}", $(form).serialize(), res => {
                    $('#modal_edit').modal('hide');
                    Swal.fire('Updated!', res.message, 'success');
                    $('#kpi_list').html(res.data);
                }).fail(xhr => {
                    Swal.fire('Error!', xhr.responseJSON.message || 'Validation failed', 'error');
                });
            }
        });
    });

    // Prefill edit modal
    function editCycle(id, type, start_date, end_date) {
        $('#edit_id').val(id);
        $('#edit_type').val(type);
        $('#edit_start_date').val(start_date);
        $('#edit_end_date').val(end_date);
        $('#modal_edit').modal('show');
    }

    // Delete
    function deleteCycle(id) {
        Swal.fire({
            title: 'Are you sure?'
            , showCancelButton: true
            , confirmButtonText: 'Yes!'
        }).then(res => {
            if (res.isConfirmed) {
                $.get("{{ route('kpi-review-cycles.delete') }}", {
                    id
                }, res => {
                    Swal.fire('Deleted!', res.message, 'success');
                    $('#kpi_list').html(res.data);
                }).fail(() => Swal.fire('Error!', 'Delete failed', 'error'));
            }
        });
    }

    function toggleStatus(id) {
        $.get("{{ route('kpi-review-cycles.toggle-status') }}", {
            id
        }, res => {
            Swal.fire('Updated!', res.message, 'success');
            $('#kpi_list').html(res.data);
        }).fail(() => Swal.fire('Error!', 'Status update failed', 'error'));
    }

</script>
