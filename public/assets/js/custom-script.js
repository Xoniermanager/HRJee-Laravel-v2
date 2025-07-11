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
                url: company_ajax_base_url + "/qualifications/qualification_data",
                dataType: "json"
            },
            create: {
                url: company_ajax_base_url + "/qualifications/ajax_store_qualification",
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

function get_designation_by_department_id(selectedDesignationId = null, all_departments = null, all_user = null) {
    var selectedValues = $('#department_id').val();
    if (all_user == true) {
        get_all_user();
    }
    $.ajax({
        type: 'GET',
        url: '/company/designation/get-designation-by-departments',
        dataType: "json",
        data: {
            'department_id': selectedValues,
            'all_departments': all_departments
        },
        success: function (response) {
            var select = $('#designation_id');
            select.empty()
            if (response.status == true) {
                $.each(response.data, function (key, value) {
                    select.append('<option value=' +
                        value.id + '>' + value.name + '</option>');
                });
                $('#designation_id').val(selectedDesignationId);
            } else {
                return false;
            }
        },
        error: function () {
            // Swal.fire({
            //     icon: "error",
            //     title: "Oops...",
            //     text: "Something Went Wrong!! Please try Again"
            // });
        }
    });
};
function get_checked_value(type = null) {
    if (type == 'company_branch') {
        var company_branches_checkbox = document.getElementById('company_branches_checkbox');
        if (company_branches_checkbox.checked != false) {
            $("#company_branch").val('').trigger('change');
            $('#company_branches_checkbox').val(1);
            $('#company_branch').prop('disabled', true);
            get_all_user(true, '', '');
        } else {
            $('#company_branches_checkbox').val(0);
            $('#company_branch').prop('disabled', false);
            get_all_user();
        }
    }
    if (type == 'department') {
        var department_checkbox = document.getElementById('department_checkbox');
        if (department_checkbox.checked != false) {
            $("#department_id").val('').trigger('change');
            $('#department_checkbox').val(1);
            $('#department_id').prop('disabled', true);
            get_designation_by_department_id('', true);
            get_all_user('', true, '');
        } else {
            $('#department_checkbox').val(0);
            $('#department_id').prop('disabled', false);
            get_all_user();
        }
    }
    if (type == 'designation') {
        var designation_checkbox = document.getElementById('designation_checkbox');
        if (designation_checkbox.checked != false) {
            $("#designation_id").val('').trigger('change');
            $('#designation_checkbox').val(1);
            $('#designation_id').prop('disabled', true);
            get_all_user('', '', true);
        }
        else {
            $('#designation_checkbox').val(0);
            $('#designation_id').prop('disabled', false);
            get_all_user();
        }
    }
}
function get_all_user(all_company_branch = false, all_department = false, all_designation = false) {
    $.ajax({
        url: '/company/announcement/get-all-user',
        type: 'get',
        data: {
            'company_branch_id': $('#company_branch').val(),
            'department_ids': $('#department_id').val(),
            'designation_ids': $('#designation_id').val(),
            'all_company_branch': all_company_branch,
            'all_department': all_department,
            'all_designation': all_designation,
        },
        success: function (response) {
            if (response.status == true) {
                let userDetailsHtml = '';
                userDetailsHtml = `<div class="panel"><div class="panel-body listscroll"><div class="">`;
                if (response.allUserDetails.length > 0) {
                    $.each(response.allUserDetails, function (key, value) {
                        userDetailsHtml += ` <div class="d-flex align-items-center mb-3">
                                            <div class="symbol symbol-45px me-5">
                                                <img src="${value.profile_image}" alt="">
                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="#" class="text-dark fw-bold text-hover-primary fs-6">
                                                    ${value.user.name}</a>
                                                <span
                                                    class="text-muted fw-semibold text-muted d-block fs-7">${value.official_email_id}</span>
                                            </div>
                                        </div>`;
                    });
                }
                else {
                    userDetailsHtml += `<p>Users not found</p>`;
                }
                userDetailsHtml += `</div></div></div>`;
                $('#user_listing').html(userDetailsHtml);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
function assignAnnouncement(value) {
    if (value == 1) {
        $('#time').val('');
        $('.notification_schedule_time').hide();
    }
    else {
        $('.notification_schedule_time').show();
    }
}
function exportAttendanceByUserId(empId, year, month, startDate, endDate) {
    $("#export_button").prop("disabled", true);

    Swal.fire({
        title: 'Preparing download...',
        text: 'Please wait while we generate the attendance report.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        type: 'GET',
        url: '/export/employee/attendance',
        data: {
            year: year,
            month: month,
            empId: empId,
            startDate: startDate,
            endDate: endDate
        },
        xhrFields: {
            responseType: 'blob'
        },
        success: function (response, status, xhr) {
            const blob = response;
            const filename = xhr.getResponseHeader('Content-Disposition')
                ?.split('filename=')[1]
                ?.replace(/"/g, '') || 'attendance_report.xlsx';

            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            Swal.fire({
                title: 'Download Complete',
                text: 'Your file has been successfully downloaded!',
                icon: 'success',
                confirmButtonText: 'OK'
            });

            $("#export_button").prop("disabled", false);
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Download Failed',
                text: 'Something went wrong while exporting attendance.'
            });
            $("#export_button").prop("disabled", false);
        }
    });
}

function exportAttendanceByUserIdByToDateFromDate(empId, toDate, fromDate) {
    $("#export_button").prop("disabled", true);

    Swal.fire({
        title: 'Preparing download...',
        text: 'Please wait while we generate the attendance report.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        type: 'get',
        url: '/export/employee/attendance',
        data: {
            'to_date': toDate,
            'from_date': fromDate,
            'empId': empId,
            'type': "ByTwoDates"
        },
        xhrFields: {
            responseType: 'blob'
        },
        success: function (response, status, xhr) {
            const blob = response;
            const link = document.createElement('a');
            const filename = xhr.getResponseHeader('Content-Disposition')
                ?.split('filename=')[1]
                ?.replace(/"/g, '') || 'attendance_report.xlsx';

            link.href = URL.createObjectURL(blob);
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            Swal.fire({
                title: 'Download Complete',
                text: 'Your file has been successfully downloaded!',
                icon: 'success',
                confirmButtonText: 'OK'
            });

            $("#export_button").prop("disabled", false);
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Download Failed',
                text: 'Something went wrong while exporting attendance.'
            });
            $("#export_button").prop("disabled", false);
        }
    });
}

function downloadPaySlip(userId) {
    $.ajax({
        type: 'get',
        url: "/employee/payslip/generate-pdf",
        data: {
            'year': $('#year').val(),
            'month': $('#month').val(),
            'user_id': userId
        },
        xhrFields: {
            responseType: 'blob'
        },
        success: function (response, status, xhr) {
            var blob = response;
            var link = document.createElement('a');
            var filename = xhr.getResponseHeader('Content-Disposition').split('filename=')[1].replace(/"/g, '');
            link.href = URL.createObjectURL(blob);
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            // SweetAlert notification after download is triggered
            Swal.fire({
                title: 'Download Complete',
                text: 'Your Payslip has been successfully downloaded!',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        },
        error: function () {
            $('#download_btn').hide();
            console.log("Export failed");
        }
    });
}




