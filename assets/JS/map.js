function getLocation() {
    const xhr = new XMLHttpRequest();
    const url = 'AJAX/get_locations.php';

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById('locationsList').innerHTML = xhr.responseText;
            } else {
                console.error('Error:', xhr.status);
            }
        }
    };

    xhr.open('GET', url, true);
    xhr.send();
}


function showLocationDetail(locationId) {
       const detailElement = document.getElementById('detail-border');
       detailElement.style.display = 'block';
       const xhr = new XMLHttpRequest();
       const url = `AJAX/get_location_details.php?locationId=${locationId}`;

       xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const selectedItem = JSON.parse(xhr.responseText);
                const detailName = detailElement.querySelector('.detail-name');
                const detailDescription = detailElement.querySelector('.detail-description');
                const detailStart = detailElement.querySelector('.detail__footer-start');
                detailName.textContent = selectedItem.name;
                detailDescription.textContent = selectedItem.description;
                detailStart.setAttribute('onclick', `startAdventure(${selectedItem.id})`);
            } 
            else {
            console.error('Error:', xhr.status);
            }
        }
    };

xhr.open('GET', url, true);
xhr.send();
}


function startAdventure(locationId){
    const xhr = new XMLHttpRequest();
    const url = 'AJAX/start_adventure.php';

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                window.location.href = "fight.php";
            } 
            else {
                console.error('Error:', xhr.status);
            }
        }
    };

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(`locationId=${locationId}`);
}


getLocation();