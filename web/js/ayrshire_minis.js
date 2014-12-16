$(document).ready(function () {

    // Google Maps on the /contact page
    function init_map() {
        var var_location = new google.maps.LatLng(55.518282, -4.379168);

        var var_mapoptions = {
            center: var_location,
            zoom: 14
        };

        var var_marker = new google.maps.Marker({
            position: var_location,
            map: var_map,
            title: "Venice"
        });

        var var_map = new google.maps.Map(document.getElementById("map-container"),
            var_mapoptions);

        var_marker.setMap(var_map);

    }

    if (typeof(google) !== 'undefined') {
        google.maps.event.addDomListener(window, 'load', init_map);
    }

    // Homepage Subscribe form submit handler
    $('#submit_form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: {
                email: $('#email').val()
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
            }
        });

    });

});