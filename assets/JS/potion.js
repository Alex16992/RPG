//Getting items in the player inventory
function loadInventory() {
	const xhr = new XMLHttpRequest();
	const url = 'AJAX/get_herbs.php';

	xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById('herbs').innerHTML = xhr.responseText;
            } 
            else {
                console.error('Error:', xhr.status);
            }
        }   
    };
    xhr.open('GET', url, true);
    xhr.send();
}


function upgradePotion(){
    const xhr = new XMLHttpRequest();
    const url = 'AJAX/upgrade_potion.php';

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE){
            if (xhr.status === 200){
                loadInventory();
            }
            else {
                console.error('Error:', xhr.status);
            }
        }
    };

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send();
}

loadInventory();