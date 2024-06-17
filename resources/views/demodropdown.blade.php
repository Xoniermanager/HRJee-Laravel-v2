@extends('layouts.company.main')

@section('title', 'main')

@section('content')
<base href="https://demos.telerik.com/kendo-ui/dropdownlist/addnewitem#">
    <style>html { font-size: 14px; font-family: Arial, Helvetica, sans-serif; }</style>
<link href="https://kendo.cdn.telerik.com/themes/8.0.1/default/default-main.css" rel="stylesheet" />
<body>


    
{{--     
	<div class="k-d-flex k-justify-content-center" style="padding-top: 54px;">
		<div class="k-w-300">
			<label for="products">Type a custom product name</label>
			<input id="products" />
        <div class="demo-hint">e.g. 'custom'</div>
		</div>
	</div>
    <script id="noDataTemplate" type="text/x-kendo-tmpl">
        <div>
            No data found. Do you want to add new item - '#: instance.filterInput.val() #' ?
        </div>
        <br />
        <button class="k-button k-button-solid-base k-button-solid k-button-md k-rounded-md" onclick="addNew('#: instance.element[0].id #', '#: instance.filterInput.val() #')">Add new item</button>
    </script>
    <div class="k-d-flex k-justify-content-center" style="padding-top: 54px;">
		<div class="k-w-300">
			<label for="skills">Type a new Skill Name</label>
			<input id="Skill" />
        <div class="demo-hint">e.g. 'PHP'</div>
		</div>
	</div>
    <script id="noSkillTemplate" type="text/x-kendo-tmpl">
        <div>
            No data found. Do you want to add new item - '#: instance.filterInput.val() #' ?
        </div>
        <br />
        <button class="k-button k-button-solid-base k-button-solid k-button-md k-rounded-md" onclick="addNew('#: instance.element[0].id #', '#: instance.filterInput.val() #')">Add new item</button>
    </script>

 --}}




    <style>
        .k-no-data{
          display: table;
          width: 100%;
          padding-top: 20px;
        }
    </style>


<style>
    .demo-wrapper {
        grid-template-columns: 180px 1fr;
    }

    .k-h4 {
        line-height: 26px;
        margin-bottom: 0;
    }

	.kd-nodata-wrapper{
		display: block !important;
		padding-top: 20px !important;
	}


    /* Breakpoints for full screen demo: max:599px, min:759px and max: 959 */
    @media (max-width: 678px), (min-width: 821px) and (max-width: 1038px), (min-width: 1241px) and (max-width: 1328px) {
      .demo-wrapper {
        grid-template-columns: 1fr;
      }

      .avatar {
        display: block !important;
      }

      .side-container {
        display: none !important;
      }

      .main-container {
        padding-bottom: 0;
      }

      .content-expanded {
        border-end-end-radius: 0;
        border-end-start-radius: 0;
      }
    }

    /* Breakpoint for full screen demo: max:359px */
    @media (max-width: 476px) {
      .avatar {
        width: 32px;
        height: 32px;
      }
    }
</style>
</body>