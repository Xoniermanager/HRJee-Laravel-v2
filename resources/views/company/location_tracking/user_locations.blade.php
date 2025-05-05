@extends('layouts.company.main')
@section('content')
@section('title', 'Location Tracking')
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <div class="container-xxl" id="kt_content_container">
        <div class="card mb-4">
            <div class="card-header d-block cursor-pointer border-0 pb-5">
                <div class="row align-items-center mt-4">
                    <div class="col-md-9">
                        <div class="d-flex align-items-center position-relative">
                            <a href="/company/location-tracking" class="btn btn-primary btn-sm"
                                style="margin-right: 40px;">Back</a>
                            <h3 class="tracking-heading" style="width: 300px;">
                                Tracking Location for <span class="text-bold">{{ $user->name }}</span>
                            </h3>
                            <input type="date" id="datePicker" class="form-control"
                                value="{{ request()->has('date') ? request()->get('date') : null }}">
                            <button id="fetchBtn" class="btn btn-primary">Fetch</button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button id="openDrawerBtn" class="btn btn-primary"><i class="fa fa-history"></i></button>
                    </div>
                </div>
                @if ($punchIn)
                    <div class="tracking-stats" id="tracking-stats">
                        <span id="firstLocation" class="stat-item">Punch in at: N/A</span>
                        <span id="exitLocation" class="stat-item">Punch out at: N/A</span>
                        <span id="totalDistance" class="stat-item">Total Travel Distance: N/A</span>
                    </div>
                @else
                    <div class="tracking-stats" id="tracking-stats">
                        No attendance found!
                    </div>
                @endif
                <div id="visitLocations" class="visit-locations">
                    <span>Assigned Tasks: </span>
                </div>
            </div>
        </div>
        <style>
            .tracking-header {
                background-color: #f8f9fa;
                padding: 15px 20px;
                border-radius: 8px;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .tracking-info {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .tracking-heading {
                margin: 0;
                font-size: 1.4rem;
                color: #333;
            }

            .text-bold {
                font-weight: 600;
                color: #007bff;
            }

            .tracking-stats {
                display: flex;
                gap: 15px;
                font-size: 14px;
                color: #555;
                padding-top: 5px;
            }

            .stat-item {
                background: #e9ecef;
                padding: 5px 10px;
                border-radius: 4px;
            }

            .error-message {
                color: #dc3545;
                font-weight: bold;
                font-size: 16px;
                margin-top: 5px;
            }

            .filter-controls {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            #datePicker:focus {
                border-color: #007bff;
            }

            @media (max-width: 768px) {
                .filter-controls {
                    flex-direction: column;
                    align-items: flex-start;
                }

                #datePicker {
                    width: 100%;
                }
            }

            #map {
                height: 70vh;
            }

            .drawer {
                position: fixed;
                right: -400px;
                width: 400px;
                height: 100%;
                background: white;
                box-shadow: -3px 0 10px rgba(0, 0, 0, 0.2);
                transition: right 0.3s ease-in-out;
                display: flex;
                flex-direction: column;
                z-index: 1000;
                padding-bottom: 40px;
            }

            .drawer-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 15px;
                background: #007bff;
                color: white;
            }

            .drawer-header button {
                background: none;
                border: none;
                color: white;
                font-size: 24px;
                cursor: pointer;
            }

            .drawer-header p {
                font-size: 1.3rem;
            }

            .drawer-body {
                padding: 15px;
                overflow-y: auto;
                flex: 1;
            }

            .drawer-backdrop {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.3);
                display: none;
                z-index: 999;
            }

            #stayPointsList {
                list-style: none;
                padding-left: 0px;
            }

            .stay-point-item {
                list-style: none;
                margin-bottom: 10px;
            }

            .stay-point-card {
                background: #f8f9fa;
                padding: 12px;
                border-radius: 8px;
                border: 1px solid #ddd;
                position: relative;
                transition: all 0.3s ease-in-out;
            }

            .stay-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                cursor: pointer;
            }

            .stay-badge {
                font-size: 12px;
                font-weight: bold;
                padding: 4px 8px;
                border-radius: 12px;
            }

            .badge-current {
                background: red;
                color: white;
            }

            .badge-number {
                background: gray;
                color: white;
            }

            .toggle-btn {
                background: transparent;
                border: none;
                font-size: 18px;
                cursor: pointer;
            }

            .stay-details {
                margin-top: 10px;
                overflow: hidden;
                transition: max-height 0.3s ease-in-out;
                max-height: 200px;
            }

            .stay-details.collapsed {
                max-height: 0;
                overflow: hidden;
            }

            .visit-locations {
                display: flex;
                align-items: center;
                gap: 5px;
                max-width: 100%;
                overflow: scroll;
            }

            .scroll-container {
                display: flex;
                gap: 8px;
                overflow-x: auto;
                white-space: nowrap;
                max-width: 400px;
                padding: 5px 0;
                scrollbar-width: thin;
                scrollbar-color: #ccc transparent;
            }

            .scroll-container::-webkit-scrollbar {
                height: 6px;
            }

            .scroll-container::-webkit-scrollbar-thumb {
                background: #ccc;
                border-radius: 3px;
            }

            .visit-item {
                background-color: #007bff;
                color: white;
                padding: 8px 15px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                min-width: 80px;
                text-align: center;
                flex-shrink: 0;
                transition: background 0.2s;
            }

            .visit-item:hover {
                background-color: #0056b3;
            }
        </style>
        <style>
            div#map {
                position: statica !important;
                width: 100%;
                height: 60vh;
            }
        </style>
        <!-- Custom Side Drawer -->
        <div id="sideDrawer" class="drawer">
            <div class="drawer-header">
                <div>
                    <h4>Travel History</h4>
                    <p>Places where the user stayed for 30 minutes or more</p>
                </div>
                <button id="closeDrawerBtn">&times;</button>
            </div>
            <div class="drawer-body">
                <ul id="stayPointsList" class="stay-points">
                    <li class="empty">No travel history found.</li>
                </ul>
            </div>
        </div>

        <!-- Backdrop for drawer -->
        <div id="drawerBackdrop" class="drawer-backdrop"></div>
        <div class="row gy-5 g-xl-10">
            <div class="card card-body col-md-12">
                <div class="col-md-12">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAdzVvYFPUpI3mfGWUTVXLDTerw1UWbdg&libraries=geometry">
    </script>

    <script type="text/javascript">
        if (console && console.warn) console.warn = function() {};
    </script>

    <script type="text/javascript">
        // ------------------------------- Map Rendering Section -------------------------------

        let map;
        let directionsService;
        let directionsRenderer;
        let routePoints = [];
        let markers = [];
        let bikeMarker;
        let bikePath = [];
        let polyline;
        const userId = "{{ $userID }}";
        const maxDaysUserLocation = "<?= $maxDaysUserLocation ?>";
        const urlParams = new URLSearchParams(window.location.search);
        const locationData = <?php echo json_encode($locationData); ?>;
        const assignedTasks = <?php echo json_encode($assignedTasks); ?>;
        const locationDataDiv = document.getElementById('locationData');
        const closeConnectionBtn = document.getElementById('closeConnection');
        const errorBox = document.getElementById('error');
        const visitLocationsBox = document.getElementById('visitLocations');
        const firstLocationBox = document.getElementById('firstLocation');
        const exitLocationBox = document.getElementById('exitLocation');
        const totalDistanceBox = document.getElementById('totalDistance');
        const officeIcon = {
            url: "https://app.hrjee.com/assets/admin/icons/building.svg",
            scaledSize: new google.maps.Size(37, 37),
            anchor: new google.maps.Point(16, 37)
        };
        const personIcon = {
            url: "https://app.hrjee.com/assets/admin/images/person-mark.png",
            scaledSize: new google.maps.Size(35, 35),
            anchor: new google.maps.Point(16, 35)
        }

        console.log("Dfadsf");

        const mapCenter = {
            lat: 28.65553,
            lng: 77.23165
        }

        /**
         * Initializes the Google Map and related services.
         */
         console.log("Dfadsfcccccc");
        (function() {
            console.log("Dfadsfdcdcdcdcdc");
            map = new google.maps.Map(document.getElementById('map'), {
                center: mapCenter,
                zoom: 12
            });

            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer({
                suppressMarkers: true
            });
            directionsRenderer.setMap(map);
            console.log("Dfadssdfdf");
        })();

        /**
         * Draws circles for task locations and colors them based on task completion
         */
        function drawVisitCircles(tasks) {
            const groupedTasks = groupTasksByProximity(tasks);
            const visitLocationsContainer = document.getElementById("visitLocations");
            visitLocationsContainer.innerHTML = "<span>Assigned Tasks: </span>";

            groupedTasks.forEach((group, index) => {
                let hasInProgress = group.tasks.some(task => task.user_end_status == "pending");
                let hasCompleted = group.tasks.every(task => task.user_end_statuss == "completed");

                let circleColor = hasCompleted ? "#28A745" : "#DC3545";

                const circle = new google.maps.Circle({
                    strokeColor: circleColor,
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: circleColor,
                    fillOpacity: 0.3,
                    map: map,
                    center: group.center,
                    radius: 500
                });

                let taskInfo = group.tasks.map(task => {
                    let statusText = task.user_end_status == "completed" ? "🟢 Completed" : "🔴 In Progress";
                    let visitAddress = task.visit_address ? task.visit_address : "N/A";

                    return `<b>Task ID:</b> ${task.id}<br>
                    <b>Status:</b> ${statusText}<br>
                    <b>Visit Address:</b> ${visitAddress}`;
                }).join("<hr>");

                const infoWindow = new google.maps.InfoWindow({
                    content: `<div style="font-size: 14px;">${taskInfo}</div>`
                });

                google.maps.event.addListener(circle, 'click', function() {
                    infoWindow.setPosition(group.center);
                    map.setZoom(15);
                    infoWindow.open(map);
                });


                google.maps.event.addListener(infoWindow, 'closeclick', function() {
                    map.setZoom(12);
                    map.panTo(mapCenter);
                });

                // Add group name to Assigned Tasks
                group.tasks.sort((a, b) => a.id - b.id);
                let firstAddress = `#${group.tasks[0]?.visit_address}` || "Unknown";
                let additionalCount = group.tasks.length - 1;

                let groupLabel = firstAddress;
                if (additionalCount === 1) {
                    groupLabel += " + one more";
                } else if (additionalCount > 1) {
                    groupLabel += ` + ${additionalCount} more`;
                }

                let groupButton = document.createElement("button");
                groupButton.className = "visit-item";
                groupButton.innerText = groupLabel;
                groupButton.style.backgroundColor = circleColor;
                groupButton.style.color = "#FFF";
                groupButton.style.border = "none";
                groupButton.style.padding = "8px 12px";
                groupButton.style.margin = "5px";
                groupButton.style.borderRadius = "5px";
                groupButton.style.cursor = "pointer";

                groupButton.onclick = function() {
                    map.panTo(group.center);
                    map.setZoom(15);
                    infoWindow.setPosition(group.center);
                    infoWindow.open(map);
                };

                visitLocationsContainer.appendChild(groupButton);
            });
        }

        function groupTasksByProximity(tasks) {
            let groups = [];

            tasks.forEach(task => {
                let latitude, longitude;

                // Use completed coordinates if task is completed, else use visit coordinates
                if (task.user_end_status == "completed" && task.latitude && task.longitude) {
                    latitude = parseFloat(task.latitude);
                    longitude = parseFloat(task.longitude);
                } else if (task.visit_coords && task.visit_coords.latitude && task.visit_coords.longitude) {
                    latitude = task.visit_coords.latitude;
                    longitude = task.visit_coords.longitude;
                } else {
                    return;
                }

                let foundGroup = null;
                for (let group of groups) {
                    let distance = getDistance(group.center.lat, group.center.lng, latitude, longitude);

                    if (distance <= 500) {
                        group.tasks.push(task);
                        foundGroup = group;
                        break;
                    }
                }

                if (!foundGroup) {
                    groups.push({
                        center: {
                            lat: latitude,
                            lng: longitude
                        },
                        tasks: [task]
                    });
                }
            });

            return groups;
        }

        /**
         * Calculates the Haversine distance between two coordinates in meters
         */
        function getDistance(lat1, lng1, lat2, lng2) {
            const R = 6371000; // Radius of Earth in meters
            const dLat = (lat2 - lat1) * (Math.PI / 180);
            const dLng = (lng2 - lng1) * (Math.PI / 180);
            const a =
                Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * (Math.PI / 180)) * Math.cos(lat2 * (Math.PI / 180)) *
                Math.sin(dLng / 2) * Math.sin(dLng / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c; // Distance in meters
        }

        /**
         * Function to auto-move to all Assigned Tasks, open info window, and return to the initial position.
         */
        function autoTravelToVisitLocations(tasks) {
            const groupedTasks = groupTasksByProximity(tasks);
            if (groupedTasks.length === 0) return;

            let infoWindow = new google.maps.InfoWindow();
            let index = 0;

            function moveToNextGroup() {
                if (index < groupedTasks.length) {
                    let group = groupedTasks[index];

                    map.panTo(group.center);
                    map.setZoom(15);

                    let taskInfo = group.tasks.map(task => {
                        let statusText = task.user_end_status == "completed" ? "🟢 Completed" : "🔴 In Progress";
                        let visitAddress = task.visit_address ? task.visit_address : "N/A";

                        return `<b>Task ID:</b> ${task.id}<br>
                    <b>Status:</b> ${statusText}<br>
                    <b>Visit Address:</b> ${visitAddress}<br>`;
                    }).join("<hr>");

                    infoWindow.setContent(`<div style="font-size: 14px;">${taskInfo}</div>`);
                    infoWindow.setPosition(group.center);
                    infoWindow.open(map);

                    setTimeout(() => {
                        index++;
                        infoWindow.close();
                        moveToNextGroup();
                    }, 1000);
                } else {
                    setTimeout(() => {
                        map.panTo(mapCenter);
                        map.setZoom(12);
                    }, 1000);
                }
            }

            moveToNextGroup();
        }

        /**
         * Adds locations to the route and updates the map.
         * @param {Array} locations - List of location objects with latitude and longitude.
         */
        function appendLocations(locations) {
            locations.forEach(location => {
                const newPoint = new google.maps.LatLng(location.latitude, location.longitude);
                routePoints.push(newPoint);
            });

            if (routePoints.length > 1) {
                const totalDistance = calculateTotalDistance(routePoints);
                totalDistanceBox.innerText = `Total Travel Distance: ${totalDistance.toFixed(2)} km`;

                if (totalDistance.toFixed(2) > 0.1) {
                    updateRoute();
                } else {
                    addMarker(routePoints[0], 'Punch In Location', true);
                    map.setCenter(routePoints[0]);
                    map.setZoom(12);
                }

                bikePath = routePoints;
                createBikeMarker(routePoints[routePoints.length - 1]);
                placeBikeAtEnd();
            } else {
                addMarker(routePoints[0], 'Punch In Location', true);
                map.setCenter(routePoints[0]);
                map.setZoom(12);
            }
        }

        /**
         * Calculates the total travel distance in kilometers.
         * @param {Array} points - Array of LatLng points.
         * @returns {number} - Total distance in kilometers.
         */
        function calculateTotalDistance(points) {
            let totalDistance = 0;
            for (let i = 0; i < points.length - 1; i++) {
                totalDistance += google.maps.geometry.spherical.computeDistanceBetween(points[i], points[i + 1]);
            }
            return totalDistance / 1000;
        }

        /**
         * Adds a marker on the map.
         * @param {Object} position - LatLng position for the marker.
         * @param {string} title - Title of the marker.
         * @param {boolean} isFirstMarker - Whether the marker is the first one.
         */
        function addMarker(position, title, isFirstMarker) {
            const geocoder = new google.maps.Geocoder();

            geocoder.geocode({
                location: position
            }, (results, status) => {
                let placeName = title;
                if (status === google.maps.GeocoderStatus.OK && results[0]) {
                    placeName = results[0].formatted_address;
                }

                const marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: placeName,
                    // animation: isFirstMarker ? google.maps.Animation.DROP : google.maps.Animation.BOUNCE,
                    icon: isFirstMarker ? officeIcon : personIcon
                });

                markers.push(marker);

                const infoWindow = new google.maps.InfoWindow({
                    content: `<strong>${title}</strong><br>${placeName}`
                });

                marker.addListener('click', () => {
                    infoWindow.open(map, marker);
                });
            });
        }

        /**
         * Instantly places the bike at the last position of the path.
         */
        function placeBikeAtEnd() {
            if (bikePath.length === 0) return;

            const finalPosition = bikePath[bikePath.length - 1];
            bikeMarker.setPosition(finalPosition);
            map.panTo(finalPosition);
            map.setCenter(finalPosition);
        }

        /**
         * Animates the bike along a given path by interpolating between waypoints.
         * The bike moves from the first waypoint to the last one over a set duration.
         * The function uses easing for smooth transitions between points.
         */
        function animateBikeAlongPath() {
            let startTime;
            const totalDuration = 3000;
            const totalSteps = bikePath.length - 1;
            let currentSegment = 0;

            /**
             * Function that animates the bike's movement along the path.
             * It uses requestAnimationFrame to update the position over time.
             * @param {number} time - The current time from the requestAnimationFrame callback.
             */
            function animateBike(time) {
                if (!startTime) startTime = time;

                // Calculate the progress based on elapsed time
                const elapsedTime = time - startTime;
                const progress = Math.min(elapsedTime / totalDuration, 1);

                // Calculate the current position using the easing function
                const t = progress * totalSteps;
                const from = bikePath[Math.floor(t)];
                const to = bikePath[Math.ceil(t)] || bikePath[bikePath.length - 1];

                // Interpolate between the two coordinates
                const tInSegment = t - Math.floor(t);
                const position = interpolatePosition(from, to, easeInOut(tInSegment));

                bikeMarker.setPosition(position);
                map.panTo(position);
                map.setCenter(position);

                // Continue the animation until it's complete
                if (elapsedTime < totalDuration) {
                    requestAnimationFrame(animateBike);
                }
            }

            requestAnimationFrame(animateBike);
        }

        /**
         * Creates a bike marker at a given position on the map.
         * @param {google.maps.LatLng} position - The starting position of the bike marker.
         */
        function createBikeMarker(position) {
            if (bikeMarker) {
                bikeMarker.setMap(null);
            }

            bikeMarker = new google.maps.Marker({
                position: position,
                map: map,
                icon: personIcon,
                title: "Last Active Location"
            });

            bikeMarker.infoWindow = new google.maps.InfoWindow({
                content: `<strong>Last Active Location</strong><br>Loading address...`
            });

            bikeMarker.addListener('click', () => {
                bikeMarker.infoWindow.open(map, bikeMarker);
            });

            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                location: position
            }, (results, status) => {
                if (status === google.maps.GeocoderStatus.OK && results[0]) {
                    bikeMarker.infoWindow.setContent(
                        `<strong>Last Active Location</strong><br>${results[0].formatted_address}`);
                }
            });
        }

        /**
         * Interpolates the position between two points (start and end) based on a given time fraction.
         * @param {google.maps.LatLng} start - The starting coordinate.
         * @param {google.maps.LatLng} end - The ending coordinate.
         * @param {number} t - The time fraction (between 0 and 1) for interpolation.
         * @returns {google.maps.LatLng} The interpolated position.
         */
        function interpolatePosition(start, end, t) {
            return new google.maps.LatLng(
                start.lat() + (end.lat() - start.lat()) * t,
                start.lng() + (end.lng() - start.lng()) * t
            );
        }

        /**
         * Easing function to create a smooth transition effect.
         * The easeInOut function accelerates at the start and decelerates at the end.
         * @param {number} t - The time fraction (between 0 and 1).
         * @returns {number} The eased value for smooth transition.
         */
        function easeInOut(t) {
            return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;
        }

        /**
         * Clears all markers from the map.
         */
        function clearMarkers() {
            markers.forEach(marker => marker.setMap(null));
            markers = [];
        }

        /**
         * Updates the route by making requests to the Google Directions API.
         */
        function updateRoute() {
            // If first and last points are too close, slightly modify the last point
            if (routePoints.length > 2) {
                const firstPoint = routePoints[0];
                const lastPoint = routePoints[routePoints.length - 1];
                const distance = google.maps.geometry.spherical.computeDistanceBetween(firstPoint, lastPoint);

                // If first and last points are very close (less than 10 meters)
                if (distance < 10) {
                    // Add a small offset to the last point to avoid ZERO_RESULTS
                    const lastLat = lastPoint.lat() + 0.0001; // Small lat offset
                    const lastLng = lastPoint.lng() + 0.0001; // Small lng offset
                    routePoints[routePoints.length - 1] = new google.maps.LatLng(lastLat, lastLng);
                }
            }

            const maxWaypoints = 23;
            const numChunks = Math.ceil(routePoints.length / maxWaypoints);
            let combinedResults = [];

            let promiseArray = Array.from({
                length: numChunks
            }, (_, i) => {
                const chunk = routePoints.slice(i * maxWaypoints, (i + 1) * maxWaypoints + 1);
                const origin = chunk[0];
                const destination = chunk[chunk.length - 1];
                const waypoints = chunk.slice(1, -1).map(point => ({
                    location: point,
                    stopover: false
                }));

                return new Promise((resolve, reject) => {
                    directionsService.route({
                        origin: origin,
                        destination: destination,
                        waypoints: waypoints,
                        travelMode: google.maps.TravelMode.DRIVING,
                        optimizeWaypoints: true
                    }, (result, status) => {
                        if (status === google.maps.DirectionsStatus.OK) {
                            combinedResults.push(result);
                            resolve();
                        } else {
                            // Try with different travel mode if ZERO_RESULTS
                            if (status === "ZERO_RESULTS") {
                                directionsService.route({
                                    origin: origin,
                                    destination: destination,
                                    waypoints: waypoints,
                                    travelMode: google.maps.TravelMode
                                        .WALKING, // Try WALKING instead
                                    optimizeWaypoints: true
                                }, (altResult, altStatus) => {
                                    if (altStatus === google.maps.DirectionsStatus.OK) {
                                        combinedResults.push(altResult);
                                        resolve();
                                    } else {
                                        reject(status);
                                    }
                                });
                            } else {
                                reject(status);
                            }
                        }
                    });
                });
            });

            Promise.all(promiseArray).then(() => {
                // If no directions were found, draw a polyline instead
                if (combinedResults.length === 0) {
                    drawPolyline();
                    return;
                }

                combinedResults.forEach((result, index) => {
                    if (index === 0) {
                        directionsRenderer.setDirections(result);
                    } else {
                        // Append new routes to the existing one
                        const directions = directionsRenderer.getDirections();
                        const routes = directions.routes[0];
                        routes.legs.push(...result.routes[0].legs);
                        directionsRenderer.setDirections(directions);
                    }
                });

                const lastPoint = routePoints[routePoints.length - 1];
                addMarker(routePoints[0], 'Punch In Location', true);
                map.setCenter(lastPoint);
                map.setZoom(12);
            }).catch((status) => {
                errorBox.innerText = 'Failed to fetch directions, falling back to direct path.';
                // Fallback to drawing a simple polyline
                drawPolyline();
            });
        }

        /** 
         * Function to draw a polyline as fallback
         */
        function drawPolyline() {
            directionsRenderer.setMap(null);
            if (polyline) polyline.setMap(null);

            polyline = new google.maps.Polyline({
                path: routePoints,
                geodesic: true,
                strokeColor: '#FF0000',
                strokeOpacity: 1.0,
                strokeWeight: 2,
                map: map
            });

            // Add markers for first and last positions
            addMarker(routePoints[0], 'Punch In Location', true);
            if (routePoints.length > 1) {
                addMarker(routePoints[routePoints.length - 1], 'Last Location', false);
            }

            // Center map on the last point
            map.setCenter(routePoints[routePoints.length - 1]);
            map.setZoom(12);
        }

        // update location data on map on page render
        (function() {
            jQuery('.loader-outer').hide();
            let locations = locationData;
            console.log("locations => ", locations)
            if ("{{ $punchIn }}") {
                firstLocationBox.innerText = 'Punch in at: ' + formatPunchTime("{{ $punchIn }}");
            }

            let coordinates = [];
            locations.forEach(location => {
                coordinates.push({
                    latitude: parseFloat(location.latitude),
                    longitude: parseFloat(location.longitude)
                });
            });

            if ("{{ $punchOut }}") {
                exitLocationBox.innerText = 'Punch out at: ' + formatPunchTime("{{ $punchOut }}");
            }

            if (assignedTasks.length) {
                drawVisitCircles(assignedTasks);
            } else {
                visitLocationsBox.style.display = "none";
            }
            appendLocations(coordinates);
        })();

        /**
         * Periodically fetches new location data for a specific user and appends it to the map.
         */

        // ------------------------------- Travel History -------------------------------
        document.getElementById("openDrawerBtn").addEventListener("click", () => {
            document.getElementById("sideDrawer").style.right = "0";
            document.getElementById("drawerBackdrop").style.display = "block";
            loadLocationHistory();
        });

        document.getElementById("closeDrawerBtn").addEventListener("click", closeDrawer);
        document.getElementById("drawerBackdrop").addEventListener("click", closeDrawer);

        function closeDrawer() {
            document.getElementById("sideDrawer").style.right = "-400px";
            document.getElementById("drawerBackdrop").style.display = "none";
        }

        document.addEventListener("DOMContentLoaded", function() {
            const datePicker = document.getElementById("datePicker");
            const fetchBtn = document.getElementById("fetchBtn");

            const today = new Date();

            const last30Days = new Date();
            last30Days.setDate(today.getDate() - maxDaysUserLocation);

            const formatDate = (date) => date.toISOString().split('T')[0];
            datePicker.min = formatDate(last30Days);
            datePicker.max = formatDate(today);
            let selectedDate = urlParams.get('date') || '';

            if (!selectedDate) selectedDate = formatDate(today);
            datePicker.value = selectedDate;

            fetchBtn.addEventListener("click", function() {
                const newDate = datePicker.value;
                updateUrlParam("date", newDate);
            });

            function updateUrlParam(key, value) {
                const url = new URL(window.location.href);
                url.searchParams.set(key, value);
                window.location.href = url.toString();
            }
        })

        /**
         * Loads location history from the backend and populates the list.
         * Implements caching to prevent frequent API calls. Cached data is valid for 1 minute.
         */
        function loadLocationHistory() {
            document.getElementById("stayPointsList").innerHTML =
                '<li class="empty-state pending">Fetching ↻ ....</li>';

            const payload = {
                "user_id": userId,
                "only_stay_point": 1,
                "only_new_locations": 0
            };

            let selectedDate = new URLSearchParams(window.location.search).get('date');

            // If no date is provided, default to today's date (YYYY-MM-DD)
            const today = new Date().toISOString().split("T")[0];
            const formattedDate = selectedDate ? selectedDate : today;

            if (selectedDate) {
                payload.date = selectedDate;
            }

            const cacheKey = `travelHistoryCache_${userId}_${formattedDate}`;
            const cacheDuration = 60 * 1000; // 1 minute
            const cachedData = JSON.parse(localStorage.getItem(cacheKey));
            const now = Date.now();

            // Check if cached data exists and is still valid
            if (cachedData) {
                if (now - cachedData.timestamp < cacheDuration) {
                    renderLocationHistory(cachedData.data);
                    return;
                } else {
                    localStorage.removeItem(cacheKey);
                }
            }

            // Fetch data via AJAX if cache is not valid
            $.ajax({
                type: "GET",
                url: "{{ route('getLocations') }}",
                data: payload,
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        localStorage.setItem(cacheKey, JSON.stringify({
                            timestamp: now,
                            data: response.data
                        }));
                    }
                    renderLocationHistory(response.data);
                },
                error: function() {
                    document.getElementById("stayPointsList").innerHTML =
                        '<li class="empty-state error">❌ Failed to load travel history.</li>';
                }
            });
        }

        /**
         * Renders the fetched location history data into the UI.
         * @param {Object} data - The location history data containing stay points.
         */
        function renderLocationHistory(data) {
            let list = document.getElementById("stayPointsList");
            list.innerHTML = "";

            if (data.length > 0) {
                data.forEach((point, index) => {
                    let listItem = document.createElement("li");
                    listItem.className = "stay-point-item";
                    let badgeText = (index === 0) ? "Current" : index + 1;

                    listItem.innerHTML = `
                        <div class="stay-point-card">
                            <div class="stay-header">
                                <p class="location toggle-header">
                                    <span class="stay-badge badge-current">${point.duration}</span> 
                                    ${point.address.length > 20 ? point.address.substring(0, 20) + "..." : point.address}
                                </p>
                                <button class="toggle-btn">▼</button>
                            </div>
                            <div class="stay-details collapsed">
                                <p class="location">📍 <b>Address:</b> ${point.address}</p>
                                <p class="time">🕒 <b>Arrived:</b> ${point.start_time}</p>
                                <p class="time">🕒 <b>Departed:</b> ${point.end_time}</p>
                                <p class="duration">⏳ <b>Duration:</b> ${point.duration}</p>
                            </div>
                        </div>
                    `;

                    list.appendChild(listItem);
                });

                document.querySelectorAll(".toggle-btn").forEach((btn) => {
                    btn.addEventListener("click", function() {
                        let details = this.parentElement.nextElementSibling;
                        details.classList.toggle("collapsed");
                        this.textContent = details.classList.contains("collapsed") ? "▶" : "▼";
                    });
                });

                document.querySelectorAll(".toggle-header").forEach((btn) => {
                    btn.addEventListener("click", function() {
                        let details = this.parentElement.nextElementSibling;
                        details.classList.toggle("collapsed");
                    });
                });

            } else {
                list.innerHTML = `<li class="empty-state">🚫 No travel history found.</li>`;
            }
        }

        /**
         * Formats a given timestamp into a human-readable punch time.
         * - If the timestamp is from today, it returns "Today at HH:MM AM/PM".
         * - If the timestamp is from yesterday, it returns "Yesterday at HH:MM AM/PM".
         * - Otherwise, it returns a formatted date string with the time.
         * 
         * @param {number|string} timestamp - The timestamp to format (Unix timestamp or date string).
         * @returns {string} - The formatted punch time.
         */
        function formatPunchTime(timestamp) {
            const date = new Date(timestamp);
            const now = new Date();
            const yesterday = new Date();
            yesterday.setDate(yesterday.getDate() - 1);

            const isToday = date.toDateString() === now.toDateString();
            const isYesterday = date.toDateString() === yesterday.toDateString();

            const options = {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            };
            const time = date.toLocaleTimeString('en-US', options);

            if (isToday) return `Today at ${time}`;
            if (isYesterday) return `Yesterday at ${time}`;
            return date.toLocaleString('en-US', {
                weekday: 'long',
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            }) + ` - ${time}`;
        }
    </script>
@endsection
