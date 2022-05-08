function updateLocation () {
    let id = document.getElementById("current-id").value;
    fetch("locationFetcher.php?id=" + id)
    .then(response => response.json())
    .then((data) => {
        // change current-user-location to the new location
        document.getElementById("current-user-location").innerHTML = data.lat + ", " + data.lng;

        let lat = Number(data.lat);
        let lng = Number(data.lng);
        var latlng = new google.maps.LatLng(lat, lng);

        marker.setPosition(latlng);
        map.setCenter({
            lat : lat,
            lng : lng
        });
    });

}
setTimeout(() => {
    setInterval(updateLocation, 1000);
}, 1000);