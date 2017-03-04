<script>
    function initMap() {
        var uluru = {lat: {!! $location->latitude !!} , lng:{!! $location->longitude !!} };
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_KEY')}}&callback=initMap">
</script>