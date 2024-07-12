<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title> HRJEE </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="robots" content="noindex,nofollow">
    <meta name="title" property='og:title' content='Xonier HRJEE' />
    <meta name="type" property='og:type' content='website' />
    <meta name="image" property='og:image' content="" />
    <meta name="url" property='og:url' content='' />
    <meta name="description" property='og:description' content='' />
    <meta name="author" content="Jyoti Mishra Web Designer at Xonier">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!--end::Global Stylesheets Bundle-->
    <link rel="icon" type="image/png" href="{{ asset('assets/media/logos/favicon.png') }}">

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        window.company_ajax_base_url = '{{ env('COMPANY_BASE_URL') }}';
        window.admin_ajax_base_url = '{{ env('ADMIN_BASE_URL') }}';
        window.employee_ajax_base_url = '{{ env('EMPLOYEE_BASE_URL') }}';
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link
        rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
    </script>
    <script src="https://cdn.tiny.cloud/1/z1qoq3vmki5r4bldcrbrijy8rm3txecup4qyxt3wpfj7qhwl/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
      tinymce.init({
        selector: '#editor',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        height:300,
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
      });
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="sidebar-enabled">
    <!--begin::Theme mode setup on page load-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page flex-row flex-column-fluid">
            @include('layouts.company.sidebar')
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                @include('layouts.company.header')
                <!--end::Header-->
                <!--begin::Content-->
                @yield('content')
                <!--end::Root-->
                <!--begin::Scrolltop-->
                <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                    <span class="svg-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1"
                                transform="rotate(90 13 6)" fill="currentColor" />
                            <path
                                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
</body>
<script>
    function addUpdateFormData(messageBox, method, url, formId, btnClose = "", reloadUrl = '', error_type = null
        , dataTable = '') {
        let btn = $(`.${formId}`);
        let loader = $('.' + messageBox);

        $.ajax({
            type: method
            , dataType: 'json'
            , url: url
            , data: new FormData($('#' + formId)[0])
            , processData: false
            , contentType: false
            , beforeSend: () => {
                btn.attr('disabled', true);
                loader.html(`{!! transLang('loader_message') !!}`).removeClass(
                    'd-none alert-danger alert-success').addClass('alert-info');
            }
            , error: (jqXHR, exception) => {
                let data = JSON.parse(jqXHR.responseText);
                $(".field_error").text('');
                $.each(data.errors, function(key, value) {

                    if (key.indexOf(".")) {
                        key = key.replace(".", "_");
                    }
                    if (error_type == 'class') {
                        $("." + key + "_error").text(value);
                    } else {
                        $("#" + key + "_error").text(value);
                    }
                });

                btn.attr('disabled', false);
                loader.html(``).removeClass('alert alert-info');
            }
            , success: response => {
                btn.attr('disabled', false);
                if (btnClose != "") {
                    $("." + btnClose).click();
                }
                if (response.status == false) {
                    notifySuccess(response.errors[0], 'error');
                } else {
                    if (reloadUrl != '') {
                        setInterval(function() {
                            window.location.href = reloadUrl;
                        }, 2000);
                    } else {
                        reloadTable(dataTable);
                    }
                    // notifySuccess(response.message, 'success');
                }

            }
        });
    }

    function resetForm(id) {
        $('#' + id)[0].reset();
        $("textarea").text("");
    }


</script>
<!--end::Body-->
@include('layouts.company.footer')

</html>
