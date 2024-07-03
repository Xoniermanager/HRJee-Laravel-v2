
// jQuery(document).ready(function() {
//     var skillCrudServiceBaseUrl =  company_ajax_base_url;
//     var skillDataSource = new kendo.data.DataSource({
//         batch: true,
//         transport: {
//             read:  {
//                 url: skillCrudServiceBaseUrl + "/skill_data",
//                dataType: "json"
//             },
//             create: {
//                 url: skillCrudServiceBaseUrl + "/skills/ajax_store_skills",
//                 dataType: "json"
//             },
//             parameterMap: function(options, operation) {
//                 if (operation !== "read" && options.models) {
//                     return {models: kendo.stringify(options.models)};
//                 }
//             }
//         },
//         schema: {
//             model: {
//                 id: "id",
//                 fields: {
//                     id: { type: "number" },
//                     name: { type: "string" }
//                 }
//             }
//         }
//     });

//     jQuery("#Skill").kendoDropDownList({
//         filter: "startswith",
//         dataTextField: "name",
//         dataValueField: "id",
//         dataSource: skillDataSource,
//         noDataTemplate: jQuery("#noSkillTemplate").html()
//     });
// });


// function addNew(widgetId, value) {

//     var widget = jQuery("#" + widgetId).getKendoDropDownList();
//     var dataSource = widget.dataSource;
//     // console.log(dataSource);
//     // if (confirm("Are you sure?")) {
//         dataSource.add({
//             name: value
//         });

//         dataSource.one("sync", function() {
//             widget.select(dataSource.view().length - 1);
//         });

//         dataSource.sync();
//     // }
// };


function addNewSkill(widgetId, value) {
    var widget = $("#" + widgetId).getKendoMultiSelect();
    var dataSource = widget.dataSource;
    console.log(dataSource.data().length + 1)

    dataSource.add({
        name: value
    });
    dataSource.add({
        id: dataSource.data().length + 1,
        name: value
    });

    var currentValue = widget.value();
    currentValue.push(dataSource.data().length)
    widget.value(currentValue);
    widget.trigger("change");
    dataSource.sync();
};


$(document).ready(function () {
    var skillId = jQuery('#get_skills_id').text();
    if (skillId) {
        var arraySkillId = JSON.parse(skillId);
        var skillValue = "" + arraySkillId.join(",") + "";
        var arrs = skillValue.split(',');
    }
    var skillCrudServiceBaseUrl = company_ajax_base_url;
    var skillDataSource = new kendo.data.DataSource({
        batch: true,
        transport: {
            read: {
                url: skillCrudServiceBaseUrl + "/skill_data",
                dataType: "json"
            },
            create: {
                url: skillCrudServiceBaseUrl + "/skills/ajax_store_skills",
                dataType: "json"
            },
            parameterMap: function (options, operation) {
                if (operation !== "read" && options.models) {
                    return { models: kendo.stringify(options.models) };
                }
            }
        },
        schema: {
            model: {
                id: "id",
                fields: {
                    id: { type: "number" },
                    name: { type: "string" }
                }
            }
        }
    });
    jQuery("#Skill").kendoMultiSelect({
        filter: "contains",
        dataTextField: "name",
        dataValueField: "id",
        dataSource: skillDataSource,
        value: arrs,
        noDataTemplate: jQuery("#noSkillTemplate").html()
    });
});

// for active menu script 
$(document).ready(function () {
    var currentUrl = window.location.pathname;
    var fullUrl = window.location.origin + currentUrl;
    $('.menu-item').each(function () {
        var url = $(this).data('url');
        if (fullUrl == url) {
            $(this).addClass('active');
        }
    });
});



function addNewQualification(widgetId, value) {

    var widget = jQuery("#" + widgetId).getKendoDropDownList();
    var dataSource = widget.dataSource;
    // console.log(dataSource);
    // if (confirm("Are you sure?")) {
    dataSource.add({
        name: value
    });

    dataSource.one("sync", function () {
        widget.select(dataSource.view().length - 1);
    });

    dataSource.sync();
}

jQuery(document).ready(function () {
    var qualificationDataSource = new kendo.data.DataSource({
        batch: true,
        transport: {
            read: {
                url: admin_ajax_base_url + "/qualifications/qualification_data",
                dataType: "json"
            },
            create: {
                url: admin_ajax_base_url + "/qualifications/ajax_store_qualification",
                dataType: "json"
            },
            parameterMap: function (options, operation) {
                if (operation !== "read" && options.models) {
                    return { models: kendo.stringify(options.models) };
                }
            }
        },
        schema: {
            model: {
                id: "id",
                fields: {
                    id: { type: "number" },
                    name: { type: "string" }
                }
            }
        }
    });

    jQuery("#Qualification").kendoDropDownList({
        filter: "startswith",
        dataTextField: "name",
        dataValueField: "id",
        dataSource: qualificationDataSource,
        value: [jQuery('#highest_qualification_id').val()],
        noDataTemplate: jQuery("#noQualificationTemplate").html()
    });
});




function addNewPreviousCompany(widgetId, value) {

    var widget = jQuery("#" + widgetId).getKendoDropDownList();
    var dataSource = widget.dataSource;
    // console.log(dataSource);
    // if (confirm("Are you sure?")) {
    dataSource.add({
        name: value
    });

    dataSource.one("sync", function () {
        widget.select(dataSource.view().length - 1);
    });

    dataSource.sync();
    // }
};

jQuery(document).ready(function () {
    var previousCompanyCrudServiceBaseUrl = company_ajax_base_url;
    var previousCompanyDataSource = new kendo.data.DataSource({
        batch: true,
        transport: {
            read: {
                url: previousCompanyCrudServiceBaseUrl + "/previous-company/previous_company_data",
                dataType: "json"
            },
            create: {
                url: previousCompanyCrudServiceBaseUrl + "/previous-company/ajax_store_previous_company",
                dataType: "json"
            },
            parameterMap: function (options, operation) {
                if (operation !== "read" && options.models) {
                    return { models: kendo.stringify(options.models) };
                }
            }
        },
        schema: {
            model: {
                id: "id",
                fields: {
                    id: { type: "number" },
                    name: { type: "string" }
                }
            }
        }
    });

    jQuery("#previous_company_id").kendoDropDownList({
        filter: "startswith",
        dataTextField: "name",
        dataValueField: "id",
        dataSource: previousCompanyDataSource,
        noDataTemplate: jQuery("#noPreviousCompanyTemplate").html()
    });
});





