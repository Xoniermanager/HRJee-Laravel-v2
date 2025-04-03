@extends('layouts.company.main')
@section('content')
@section('title', 'Location Tracking')
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
	<div class="container-xxl" id="kt_content_container">
		<div class="row gy-5 g-xl-10">
			<div class="card card-body col-md-12">
				<div class="card-header cursor-pointer p-0">
					<div class="card-title m-0">
						<div class="d-flex align-items-center position-relative min-w-250px my-1 me-2">
							<span class="svg-icon svg-icon-1 position-absolute ms-4">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
										transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
									<path
										d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
										fill="black"></path>
								</svg>
							</span>

							<input class="form-control form-control-solid ps-14" placeholder="Search " type="text" name="search"
								value="{{ request()->get('search') }}" id="search">
						</div>

						<div>
							<button class="btn btn-primary active" id="list-view-btn">List View</button>
							<button class="btn btn-outline-primary" id="map-view-btn">Map View</button>
						</div>
					</div>
					<a href="#" data-bs-toggle="modal" data-bs-target="#assign_location_tracking"
						class="btn btn-sm btn-primary align-self-center">
						Assign Location Tracking
					</a>
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

	<!----------modal------------>
	<div class="modal" id="assign_location_tracking">
		<div class="modal-dialog modal-dialog-centered mw-500px">
			<div class="modal-content">
				<div class="modal-header">
					<h2>Assign Location Tracking</h2>
					<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
						<span class="svg-icon svg-icon-1">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
									transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
								<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
									fill="currentColor"></rect>
							</svg>
						</span>
					</div>
				</div>

				<div class="modal-body scroll-y border-top pb-5 pt-0">
					<form id="assign_tracking_form">
						@csrf
						<div class="mw-lg-600px mx-auto p-4">
							<div class="mt-3">
								<label class="required">Employees</label>
								<select class="form-control mb-5 mt-3" data-control="select2" data-close-on-select="false"
									data-placeholder="Select the Employee" data-allow-clear="true" multiple="multiple" name="user_id[]">
									@foreach ($allEmployees as $item)
										<option value="{{ $item->id }}">{{ $item->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="mt-3">
								<label class="">Location Tracking</label>
								<input type="text" value="Active" class="form-control" disabled>
								</select>
							</div>
						</div>
						<div class="d-flex flex-end flex-row-fluid border-top pt-2">
							<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary" id="kt_modal_upgrade_plan_btn">
								<span class="indicator-label">Submit</span>
								<span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm ms-2 align-middle"></span>
								</span>
							</button>
						</div>
					</form>
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
							jQuery('#assign_location_tracking').modal('hide');
							swal.fire("Done!", response.message, "success");
							$('#tracking_list').replaceWith(response.data);
							jQuery("#assign_tracking_form")[0].reset();

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
				$("#map-view").removeClass("d-none");
				$("#list-view").addClass("d-none");

				$("#map-view-btn").addClass("btn-primary active").removeClass("btn-outline-primary");
				$("#list-view-btn").addClass("btn-outline-primary").removeClass("btn-primary active");
			});

			$("#list-view-btn").click(function() {
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
						if (!response.data.length) return console.warn("No employee locations found.");
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
							iconDiv.style.color = employees[0].is_location_tracking_active ==
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
							google.maps.event.addListener(customMarker, "click", function() {
								let maxZoomLevel = 16;
								map.setCenter(customMarker.position);
								map.setZoom(maxZoomLevel);

								const title = employees.length > 1 ? "Users" : "User"
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
