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

//Display information about the selected item
function showLocationDetail(locationId) {
 const detailElement = document.getElementById('detail-border');
 detailElement.style.display = 'block';
 const xhr = new XMLHttpRequest();
 const url = `AJAX/get_location_details.php?locationId=${locationId}`;

 xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
            const selectedItem = JSON.parse(xhr.responseText);
            const detailElement = document.getElementById('detail-border');
            const detailName = detailElement.querySelector('.detail-name');
            const detailDescription = detailElement.querySelector('.detail-description');
            detailName.textContent = selectedItem.name;
            detailDescription.textContent = selectedItem.description;
        } 
        else {
           console.error('Error:', xhr.status);
       }
   }
};

xhr.open('GET', url, true);
xhr.send();
}

getLocation();