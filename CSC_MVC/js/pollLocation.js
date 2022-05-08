function updateLocation () {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                document.getElementById("current-user-location").innerHTML = position.coords.latitude + ", " + position.coords.longitude;

                fetch("locationUpdater.php?lat=" + position.coords.latitude + "&long=" + position.coords.longitude);

                infoWindow.setPosition(pos);
                infoWindow.setContent("Location found.");
                infoWindow.open(map);
                map.setCenter(pos);
            },
            () => {
                handleLocationError(true, infoWindow, map.getCenter());
            }
        );
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }
}

setTimeout(() => {
    setInterval(updateLocation, 1000);
}, 1000);