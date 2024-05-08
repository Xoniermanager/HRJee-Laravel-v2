<!DOCTYPE html>
<html>
<head>
    <base href="https://demos.telerik.com/kendo-ui/dropdownlist/addnewitem">
    <style>html { font-size: 14px; font-family: Arial, Helvetica, sans-serif; }</style>
    <title></title>
    <link href="https://kendo.cdn.telerik.com/themes/7.2.1/default/default-main.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <script src="https://kendo.cdn.telerik.com/2024.1.319/js/kendo.all.min.js"></script>
    
    
</head>
<body>
    
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

    <script>
        function addNew(widgetId, value) {
            var widget = $("#" + widgetId).getKendoDropDownList();
            var dataSource = widget.dataSource;

            if (confirm("Are you sure?")) {
                dataSource.add({
                    ProductID: 0,
                    ProductName: value
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
            var crudServiceBaseUrl = "https://demos.telerik.com/kendo-ui/service";
            var dataSource = new kendo.data.DataSource({
                batch: true,
                transport: {
                    read:  {
                        url: crudServiceBaseUrl + "/Products",
                        dataType: "jsonp"
                    },
                    create: {
                        url: crudServiceBaseUrl + "/Products/Create",
                        dataType: "jsonp"
                    },
                    parameterMap: function(options, operation) {
                        if (operation !== "read" && options.models) {
                            return {models: kendo.stringify(options.models)};
                        }
                    }
                },
                schema: {
                    model: {
                        id: "ProductID",
                        fields: {
                            ProductID: { type: "number" },
                            ProductName: { type: "string" }
                        }
                    }
                }
            });

            $("#products").kendoDropDownList({
                filter: "startswith",
                dataTextField: "ProductName",
                dataValueField: "ProductID",
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
    </style>



</body>
</html>
