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


//Getting items in the player inventory
function getPotionInfo() {
    const xhr = new XMLHttpRequest();
    const url = 'AJAX/get_potion_info.php';

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById('potionDetail').innerHTML = xhr.responseText;
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
    var mouseClickAudio = new Audio('assets/Sound/potion_upgrade.flac');
    mouseClickAudio.play();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE){
            if (xhr.status === 200){
                loadInventory();
                getPotionInfo();
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

function craftPotion(){
    const xhr = new XMLHttpRequest();
    const url = 'AJAX/craft_potion.php';
    var mouseClickAudio = new Audio('assets/Sound/potion_craft.mp3');
    mouseClickAudio.play();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                loadInventory();
                getPotionInfo();
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

function sellPotion(){
    const xhr = new XMLHttpRequest();
    const url = 'AJAX/sell_potion.php';
    var mouseClickAudio = new Audio('assets/Sound/sell.wav');
    mouseClickAudio.play();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                loadInventory();
                getPotionInfo();
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
getPotionInfo();