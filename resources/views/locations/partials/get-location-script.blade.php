            <!-- Geo Location -->
    <script src="http://maps.google.com/maps/api/js?key={{env('GOOGLE_MAPS_KEY')}}"></script>
    <script>
        $(document).ready(function () {
            $('.location').slideDown('slow')
            $('.lat').val({{ isset($location->latitude) ?$location->latitude:''}})
            $('.lon').val({{ isset($location->longitude) ?$location->latitude:''}})
        });
        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            $('.loading').show();
            lat = position.coords.latitude;
            lon = position.coords.longitude;

            latlon = new google.maps.LatLng(lat, lon)
            mapholder = document.getElementById('mapholder')
            mapholder.style.height = '220';
            mapholder.style.width = '220';

            $('.lat').val(lat)
            $('.lon').val(lon)

            var myOptions = {
                center: latlon, zoom: 8,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: false,
                navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL}
            }

            var map = new google.maps.Map(document.getElementById("mapholder"), myOptions);
            var marker = new google.maps.Marker({position: latlon, map: map, title: "You are here!"});
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    x.innerHTML = "User denied the request for Geolocation."
                    break;
                case error.POSITION_UNAVAILABLE:
                    x.innerHTML = "Location information is unavailable."
                    break;
                case error.TIMEOUT:
                    x.innerHTML = "The request to get user location timed out."
                    break;
                case error.UNKNOWN_ERROR:
                    x.innerHTML = "An unknown error occurred."
                    break;
            }
        }
    </script>