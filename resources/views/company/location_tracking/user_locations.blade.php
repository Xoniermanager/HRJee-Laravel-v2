@extends('layouts.company.main')
@section('content')
@section('title', 'Location Tracking')
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <div class="container-xxl" id="kt_content_container">
        <div class="row gy-5 g-xl-10">
            <div class="card card-body col-md-12">
                <div class="card-header cursor-pointer p-0">
                    <div class="card-title m-0">
                        <div>
                            <button class="btn btn-primary active" id="list-view-btn">List View</button>
                            <button class="btn btn-outline-primary" id="map-view-btn">Map View</button>
                        </div>
                    </div>
                    <div class="card-title m-0">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#assign_location_tracking"
                            class="btn btn-sm btn-primary align-self-center">
                            Assign Location Tracking
                        </a>
                    </div>
                </div>
                <div id="map-view" class="d-none mb-5">
                    <div id="map" style="height: 70vh; width: 100%;"></div>
                </div>

                <div id="list-view" class="mb-5">
                    @include('company.location_tracking.list')
                </div>
            </div>
        </div>
    </div>

    <script>
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            jQuery("#assign_tracking_form").validate({
                rules: {
                    'user_id[]': {
                        required: true,
                        minlength: 1 // Requires at least one branch to be selected
                    },
                },
                messages: {
                    'user_id[]': "Please select at least one Employee",
                },
                submitHandler: function(form) {
                    var formData = $(form).serialize();
                    $.ajax({
                        url: "{{ route('location.tracking.store') }}",
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            if (response.success) {
                                jQuery('#assign_location_tracking').modal('hide');
                                swal.fire("Done!", response.message, "success");
                                $('#tracking_list').replaceWith(response.data);
                                jQuery("#assign_tracking_form")[0].reset();
                            } else {
                                swal.fire("Failed!", response.message, "error");
                            }
                        },
                        error: function(error_messages) {
                            let errors = error_messages.responseJSON.error;
                            for (var error_key in errors) {
                                $(document).find('[name=' + error_key + ']').after(
                                    '<span class="' + error_key +
                                    '_error text text-danger">' + errors[
                                        error_key] + '</span>');
                                setTimeout(function() {
                                    jQuery("." + error_key + "_error").remove();
                                }, 5000);
                            }
                        }
                    });
                }
            });
        });

        jQuery("#search").on('input', function() {
            search_filter_results();
        });

        jQuery(document).on('click', '#tracking_list a', function(e) {
            e.preventDefault();
            var page_no = $(this).attr('href').split('page=')[1];
            search_filter_results(page_no);
        });

        function handleStatus(userId) {
            var checked_value = $('#checked_value_' + userId).prop('checked');
            let status;
            let status_name;
            if (checked_value == true) {
                status = 1;
                status_name = 'Location Tracking Active';
            } else {
                status = 0;
                status_name = 'Location Tracking InActive';
            }
            $.ajax({
                url: "{{ route('location.tracking.statusUpdate') }}",
                type: 'get',
                data: {
                    'userId': userId,
                    'status': status,
                },
                success: function(res) {
                    if (res) {
                        swal.fire("Done!", 'Status ' + status_name + ' Update Successfully', "success");
                        $('#tracking_list').replaceWith(res.data);
                    } else {
                        swal.fire("Oops!", 'Something Went Wrong', "error");
                    }
                }
            })
        }

        function search_filter_results(page_no = 1) {
            $.ajax({
                type: 'GET',
                url: company_ajax_base_url + '/location-tracking/search/filter?page=' + page_no,
                data: {
                    'status': $('#status').val(),
                    'search': $('#search').val()
                },
                success: function(response) {
                    $('#tracking_list').replaceWith(response.data);
                }
            });
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAdzVvYFPUpI3mfGWUTVXLDTerw1UWbdg"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            // -------------------------------- Tab Section (Map ⇋ List View) --------------------------------

            $("#map-view-btn").click(function() {
                $("#search-sec").hide();
                $("#search").hide();
                $("#map-view").removeClass("d-none");
                $("#list-view").addClass("d-none");

                $("#map-view-btn").addClass("btn-primary active").removeClass("btn-outline-primary");
                $("#list-view-btn").addClass("btn-outline-primary").removeClass("btn-primary active");
            });

            $("#list-view-btn").click(function() {
                $("#search-sec").show();
                $("#search").show();
                $("#list-view").removeClass("d-none");
                $("#map-view").addClass("d-none");

                $("#list-view-btn").addClass("btn-primary active").removeClass("btn-outline-primary");
                $("#map-view-btn").addClass("btn-outline-primary").removeClass("btn-primary active");
            });

            // -------------------------------- Map Section --------------------------------

            let mapRefreshInterval = null;
            let map;
            let markers = [];
            let infoWindow;

            /**
             * Initializes the Google Map.
             */
            (function initMap() {
                console.log('initMap');

                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 5,
                    center: {
                        lat: 20.5937,
                        lng: 78.9629
                    },
                    mapId: "AIzaSyCAdzVvYFPUpI3mfGWUTVXLDTerw1UWbdg"
                });
                infoWindow = new google.maps.InfoWindow();
                loadMarkers();
            })()

            /**
             * Fetches employee locations from the server and updates the map with markers.
             * - Clears existing markers before adding new ones.
             * - Zooms and centers the map to the first employee's location.
             * - Groups employees at the same coordinates under a single marker.
             * - Displays employee details in an info window on marker click.
             */
            async function loadMarkers() {
                const {
                    AdvancedMarkerElement
                } = await google.maps.importLibrary("marker");

                $.ajax({
                    url: "{{ route('location.tracking.currentLocations') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        if (!response.data.length) return console.warn(
                            "No employee locations found.");
                        clearMarkers();

                        let firstEmp = response.data.find(emp => emp.latitude && emp.longitude);
                        if (firstEmp) {
                            console.log(firstEmp);
                            let mapCenter = {
                                lat: parseFloat(firstEmp.latitude),
                                lng: parseFloat(firstEmp.longitude)
                            };
                            map.setCenter(mapCenter);
                            map.setZoom(10);
                        }

                        // Group employees by location
                        let locationMap = new Map();
                        response.data.forEach(emp => {
                            if (!emp.latitude || !emp.longitude) return;

                            let latLngKey =
                                `${parseFloat(emp.latitude).toFixed(6)},${parseFloat(emp.longitude).toFixed(6)}`;
                            if (!locationMap.has(latLngKey)) locationMap.set(latLngKey, []);
                            locationMap.get(latLngKey).push(emp);
                        });

                        // Iterate through grouped locations
                        locationMap.forEach((employees, latLngKey) => {
                            let [lat, lng] = latLngKey.split(',').map(Number);
                            let position = new google.maps.LatLng(lat, lng);

                            // Get first employee's name and count of additional users
                            let displayText = employees.length === 1 ?
                                employees[0].name :
                                `${employees[0].name} + ${employees.length - 1} more`;

                            // Create custom marker
                            let markerDiv = document.createElement("div");
                            markerDiv.style.display = "flex";
                            markerDiv.style.flexDirection = "column";
                            markerDiv.style.alignItems = "center";

                            // Name label with "X more"
                            let nameDiv = document.createElement("div");
                            nameDiv.textContent = displayText;
                            nameDiv.style.fontSize = "10px";
                            nameDiv.style.fontWeight = "bold";
                            nameDiv.style.color = "white";
                            nameDiv.style.padding = "2px 6px";
                            nameDiv.style.marginBottom = "-6px";
                            nameDiv.style.borderRadius = "5px";
                            nameDiv.style.backgroundColor = employees[0]
                                .is_location_tracking_active == 1 ? "#28a745" : "#dc3545";

                            // FontAwesome Icon
                            let iconDiv = document.createElement("div");
                            iconDiv.style.color = employees[0]
                                .is_location_tracking_active ==
                                1 ? "#28a745" : "#dc3545";
                            iconDiv.style.fontSize = "35px";
                            iconDiv.innerHTML = '<i class="fa fa-map-marker"></i>';

                            markerDiv.appendChild(nameDiv);
                            markerDiv.appendChild(iconDiv);

                            let customMarker = new AdvancedMarkerElement({
                                map,
                                position,
                                content: markerDiv,
                                title: displayText
                            });

                            // Click Event for Info Window
                            let previousZoom = map.getZoom();
                            google.maps.event.addListener(customMarker, "click",
                        function() {
                                let maxZoomLevel = 16;
                                map.setCenter(customMarker.position);
                                map.setZoom(maxZoomLevel);

                                const title = employees.length > 1 ? "Users" :
                                    "User"
                                let content =
                                    `<div style="max-width:250px;"><strong>${title}:</strong><br>`;

                                employees.forEach(user => {
                                    let statusText = user
                                        .is_location_tracking_active == 1 ?
                                        `<span style="color:green;">Active</span>` :
                                        `<span style="color:red;">Inactive</span>`;

                                    content +=
                                        `<b>${user.name}</b> - ${statusText} (Last Updated: ${formatAMPM(user.last_updated)})<br>`;
                                });
                                content += `</div>`;

                                infoWindow.setContent(content);
                                infoWindow.open(map, customMarker);
                            });

                            google.maps.event.addListener(infoWindow, "closeclick",
                                function() {
                                    map.setZoom(previousZoom);
                                });

                            markers.push(customMarker);
                        });
                    }
                });
            }

            /**
             * Clears all existing markers from the map.
             */
            function clearMarkers() {
                markers.forEach(marker => marker.setMap(null));
                markers = [];
            }

            /**
             * Starts automatic map refresh every 30 seconds when the auto-sync toggle is enabled.
             */
            function startAutoRefresh() {
                if (!mapRefreshInterval) {
                    mapRefreshInterval = setInterval(function() {
                        if ($("#map-view").hasClass("active") && $("#sync-toggle").prop("checked")) {
                            console.log("Auto-syncing map...");
                            loadMarkers();
                        }
                    }, 30000);
                }
            }

            /**
             * Stops the automatic map refresh.
             */
            function stopAutoRefresh() {
                if (mapRefreshInterval) {
                    clearInterval(mapRefreshInterval);
                    mapRefreshInterval = null;
                }
            }

            // -------------------------------- Helpers --------------------------------

            /**
             * Converts a timestamp into a human-readable 12-hour format (AM/PM).
             * @param {string} timestamp - The timestamp to be formatted.
             * @returns {string} Formatted time in "hh:mm AM/PM" format.
             */
            function formatAMPM(timestamp) {
                var date = new Date(timestamp);
                var hours = date.getHours();
                var minutes = date.getMinutes();
                var ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12;
                minutes = minutes < 10 ? '0' + minutes : minutes;
                var timeStr = hours + ':' + minutes + ' ' + ampm;
                return timeStr;
            }

            // Function to get initials from name
            function getInitials(name) {
                if (!name) return "U"; // Default 'U' for unknown
                let nameParts = name.trim().split(" ");
                let initials = nameParts[0].charAt(0).toUpperCase();
                if (nameParts.length > 1) {
                    initials += nameParts[nameParts.length - 1].charAt(0).toUpperCase();
                }
                return initials;
            }
        });
    </script>
@endsection
