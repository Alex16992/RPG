		function loadInventory() {
			const xhr = new XMLHttpRequest();
			const url = 'inventory_ajax.php';

			xhr.onreadystatechange = function() {
				if (xhr.readyState === XMLHttpRequest.DONE) {
					if (xhr.status === 200) {
						document.getElementById('inventory').innerHTML = xhr.responseText;
					} else {
						console.error('Error:', xhr.status);
					}
				}
			};

			xhr.open('GET', url, true);
			xhr.send();
		}

		function showItemDetail(itemId, itemLevel) {
			const detailElement = document.getElementById('detail__item');
			detailElement.style.display = 'grid';
			const xhr = new XMLHttpRequest();
            const url = `get_item_details.php?itemId=${itemId}`;

            xhr.onreadystatechange = function() {
               if (xhr.readyState === XMLHttpRequest.DONE) {
                  if (xhr.status === 200) {
                     const selectedItem = JSON.parse(xhr.responseText);

                // Update the content in the "Detail" section
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
                     if(selectedItem.armor!=null){
                        detailItemDamage.textContent = "Armor: " + selectedItem.armor;
                    }
                    else if(selectedItem.damage!=null){
                        detailItemDamage.textContent = "Damage: " + selectedItem.damage;
                    }

                    detailItemSlot.textContent = "Slot: " + selectedItem.slot;
                    detailItemPrice.textContent = "Price: " + selectedItem.price + " coins";
                } else {
                 console.error('Error:', xhr.status);
             }
         }
     };

     xhr.open('GET', url, true);
     xhr.send();
 }

 function equipItem(itemId, slot, lvl) {
   console.log('itemId:', itemId);
   console.log('slot:', slot);
   console.log('lvl:', lvl);

   const xhr = new XMLHttpRequest();
   const url = 'equip_item.php';

   xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
         if (xhr.status === 200) {
            const detailElement = document.getElementById('detail__item');
            detailElement.style.display = 'none';
            updateItems();
            loadInventory();
        } else {
            console.error('Error:', xhr.status);
        }
    }
};

xhr.open('POST', url, true);
xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
xhr.send(`itemId=${itemId}&slot=${slot}&lvl=${lvl}`);


}

function updateItems() {
    $.ajax({
        url: 'updateitems.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log('Response:', data);

            // Update images and tooltips
            $('#jewelry_left')
                .attr('src', 'assets/Image/Items/' + data.jewelry_left);

            $('#jewelry_right')
                .attr('src', 'assets/Image/Items/' + data.jewelry_right);

            $('#helmet')
                .attr('src', 'assets/Image/Items/' + data.helmet);

            $('#body')
                .attr('src', 'assets/Image/Items/' + data.body);

            $('#weapon_left')
                .attr('src', 'assets/Image/Items/' + data.weapon_left);

            $('#weapon_right')
                .attr('src', 'assets/Image/Items/' + data.weapon_right);

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


function unequipHelmet() {
    const xhr = new XMLHttpRequest();
    const url = 'unequip_helmet.php';

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                updateItems();
                loadInventory();
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
    const url = 'unequip_weapon_left.php';

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                updateItems();
                loadInventory();
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
    const url = 'unequip_weapon_right.php';

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                updateItems();
                loadInventory();
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
