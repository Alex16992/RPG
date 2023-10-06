
//Getting items in the player inventory
function loadInventory() {
	const xhr = new XMLHttpRequest();
	const url = 'AJAX/inventory_ajax.php';

	xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById('inventory').innerHTML = xhr.responseText;
            } 
            else {
                console.error('Error:', xhr.status);
            }
        }   
    };
    xhr.open('GET', url, true);
    xhr.send();
}


//Display information about the selected item
function showItemDetail(itemId, itemLevel) {
   const detailElement = document.getElementById('detail__item');
   detailElement.style.display = 'grid';
   const xhr = new XMLHttpRequest();
   const url = `AJAX/get_item_details.php?itemId=${itemId}`;

   xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
            const selectedItem = JSON.parse(xhr.responseText);
            const detailElement = document.getElementById('itemDetail');
            const detailItemName = detailElement.querySelector('.detail__item-name');
            const detailItemImage = detailElement.querySelector('.detail__item-image');
            const detailItemLevel = detailElement.querySelector('.detail__item-lvl');
            const detailItemDescription = detailElement.querySelector('.detail__item-description');
            const detailItemDamage = detailElement.querySelector('.detail__item__footer__stats-main');
            const detailItemSlot = detailElement.querySelector('.detail__item__footer__stats-slot');
            const detailItemPrice = detailElement.querySelector('.detail__item__footer__stats-price');
            const detailEquip = detailElement.querySelector('.detail__item__footer-equip-image');


            detailItemName.textContent = selectedItem.name;
            detailItemImage.src = "assets/Image/Items/" + selectedItem.image;
            const slot = selectedItem.slot;
            detailEquip.setAttribute('onclick', `equipItem(${selectedItem.id}, '${slot}', '${itemLevel}')`);

            detailItemLevel.textContent = "Level - " + itemLevel;
            detailItemDescription.textContent = selectedItem.description;

            //Get damage and armor using my formula
            if (itemLevel > 1) {
                if (selectedItem.armor != null) {
                    detailItemDamage.textContent = "Armor: " + Math.round(selectedItem.armor * (itemLevel / 2) + 2);
                } else if (selectedItem.damage != null) {
                    detailItemDamage.textContent = "Damage: " + Math.round(selectedItem.damage * (itemLevel / 2) + 2);
                }
            } else {
                if (selectedItem.armor != null) {
                    detailItemDamage.textContent = "Armor: " + Math.round(selectedItem.armor);
                } else if (selectedItem.damage != null) {
                    detailItemDamage.textContent = "Damage: " + Math.round(selectedItem.damage);
                }
            }

            //Get price using my formula
            detailItemSlot.textContent = "Slot: " + selectedItem.slot;
            detailItemPrice.textContent = "Price: " + Math.round((selectedItem.price * (itemLevel / 2) + 2)) + " coins";
        } 
        else {
         console.error('Error:', xhr.status);
     }
 }
};

xhr.open('GET', url, true);
xhr.send();
}


//Equipping the selected item
function equipItem(itemId, slot, lvl) {

    const xhr = new XMLHttpRequest();
    const url = 'AJAX/equip_item.php';

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const detailElement = document.getElementById('detail__item');
                //Hide the "Details" window
                detailElement.style.display = 'none';
                updateItems();
                loadInventory();
                updateChar();
            } 
            else {
                console.error('Error:', xhr.status);
            }
        }
    };

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(`itemId=${itemId}&slot=${slot}&lvl=${lvl}`);
}


//Display equipped items
function updateItems() {
    $.ajax({
        url: 'AJAX/updateitems.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#jewelry_left').attr('src', 'assets/Image/Items/' + data.jewelry_left);
            $('#jewelry_right').attr('src', 'assets/Image/Items/' + data.jewelry_right);
            $('#helmet').attr('src', 'assets/Image/Items/' + data.helmet);
            $('#body').attr('src', 'assets/Image/Items/' + data.body);
            $('#weapon_left').attr('src', 'assets/Image/Items/' + data.weapon_left);
            $('#weapon_right').attr('src', 'assets/Image/Items/' + data.weapon_right);

            $('#jewelry_left_lvl').attr('data-tooltip', data.jewelry_left_lvl);
            $('#jewelry_right_lvl').attr('data-tooltip', data.jewelry_right_lvl);
            $('#helmet_lvl').attr('data-tooltip', data.helmet_lvl);
            $('#body_lvl').attr('data-tooltip', data.body_lvl);
            $('#weapon_left_lvl').attr('data-tooltip', data.weapon_left_lvl);
            $('#weapon_right_lvl').attr('data-tooltip', data.weapon_right_lvl);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', textStatus, errorThrown);
        }
    });
}


//Updating Player Characteristics
function updateChar() {
    $.ajax({
        url: 'AJAX/updatechar.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#equipped_stats-armor').html('Armor: ' + data.armor);
            $('#equipped_stats-damage').html('Damage: ' + data.damage);
        },

        error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', textStatus, errorThrown);
        }
    });
}


//Then there are the functions of removing equipped items
//Yes yes i know this could have been done in one function, perhaps I will fix this in the future
function unequipHelmet() {
    const xhr = new XMLHttpRequest();
    const url = 'AJAX/unequip_helmet.php';

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                updateItems();
                loadInventory();
                updateChar();
            } else {
                console.error('Error:', xhr.status);
            }
        }
    };

    xhr.open('GET', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send();
}

function unequipWeapon_left() {
    const xhr = new XMLHttpRequest();
    const url = 'AJAX/unequip_weapon_left.php';

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                updateItems();
                loadInventory();
                updateChar();
            } else {
                console.error('Error:', xhr.status);
            }
        }
    };

    xhr.open('GET', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send();
}

function unequipWeapon_right() {
    const xhr = new XMLHttpRequest();
    const url = 'AJAX/unequip_weapon_right.php';

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                updateItems();
                loadInventory();
                updateChar();
            } else {
                console.error('Error:', xhr.status);
            }
        }
    };

    xhr.open('GET', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send();
}


updateItems();
loadInventory();
updateChar();
