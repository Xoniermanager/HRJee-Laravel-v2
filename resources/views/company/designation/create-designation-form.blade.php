@extends('layouts.company.main')

@section('title', 'main')

@section('content')
{{-- 
<script id="noDataTemplate" type="text/x-kendo-tmpl">
    <div>
        No data found. Do you want to add new item - '#: instance.filterInput.val() #' ?
    </div>
    <br />
    <button class="k-button k-button-solid-base k-button-solid k-button-md k-rounded-md" onclick="addNew('#: instance.element[0].id #', '#: instance.filterInput.val() #')">Add new item</button>
</script>

<script>
    function addNew(widgetId, value) {
        var widget = $("#" + widgetId).getKendoDropDownList();
        var dataSource = widget.dataSource;
		console.log(value);

        if (confirm("Are you sure?")) {
            dataSource.add({
                name: value
            });

            dataSource.one("sync", function() {
                widget.select(dataSource.view().length - 1);
            });

            dataSource.sync();
        }
    };
</script>


<script>
    $(document).ready(function() {
        var crudServiceBaseUrl = "http://localhost:9000"; // Update URL if necessary
		var dataSource = new kendo.data.DataSource({
    batch: true,
    transport: {
        read: {
            url: crudServiceBaseUrl + "/demo_data",
            dataType: "jsonp"
        },
        create: {
            url: crudServiceBaseUrl + "/add-departments",
            dataType: "json",
            type: "POST", 
            data: { name:'puneet'}, // Add your data if needed
    beforeSend: function(xhr) {
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
    },

        },
        parameterMap: function(options, operation) {
            if (operation !== "read" && options.models) {
                return {models: kendo.stringify(options.models)};
            }
        }
    },
    schema: {
        model: {
           // id: "id",
            fields: {
                // id: { type: "number" },
                name: { type: "string" }
            }
        }
    }
});




        $("#products").kendoDropDownList({
            filter: "startswith",
            dataTextField: "name",
            dataValueField: "id",
            dataSource: dataSource,
            noDataTemplate: $("#noDataTemplate").html()
        });
    });
</script>

<style>
    .k-no-data{
        display: table;
        width: 100%;
        padding-top: 20px;
    }
</style> --}}

<div class="card card-body col-md-12">
    <div class="card-header cursor-pointer p-0">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0"> Add Designation</h3>
        </div>
        <!--end::Card title-->
    </div>
    <div class="mb-5 mb-xl-10"> 
        <div class="card-body py-3">
            <form method="post" action="{{ isset($designation) ? route('update.designations', ['id' => $designation->id]) : route('add.designations')}}">

                @csrf
                @if(isset($designation))
                    @method('patch')
                @endif

                {{-- <div  >
                    <div class="k-w-300">
                        <label for="products">Select Department</label>
                        <input lass="form-select mb-3" id="products" />
                    </div>
                </div> --}}

                <table class="_table table  dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>Select Department</th>
                        </tr>
                    </thead>
                    <tbody id="table_body">
                        <tr>
                            <td>
                                <select class="form-select mb-3" name="department_id">
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $dept)
                                        <option value="{{ $dept->id }}" {{ isset($designation) && $designation->department_id == $dept->id ? 'selected' : '' }}>
                                            {{ $dept->name }}
                                        </option>
                                    @endforeach
                                </select>                                                                    
                                <!-- @error('name')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror -->
                            </td>
                        </tr>

                    </tbody>
                </table> 
                <table class="_table table  dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>Designation Name</th>
                        </tr>
                    </thead>
                    <tbody id="table_body">
                        <tr>
                            <td>
                                <input type="text" class="form-control mb-3" name="name" value="{{ isset($designation) ? $designation['name'] : '' }}">
                                    @error('name')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                            </td>
                        </tr>

                    </tbody>
                </table> 
                
                @if(isset($designation))
                    <button class="btn btn-primary">update</button>
                @else
                    <button class="btn btn-primary">save</button>
                @endif
            </form>
        </div>

    </div>
</div>
@endsection
