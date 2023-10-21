
//Getting items in the player inventory
function loadInventory() {
    const xhr = new XMLHttpRequest();
    const url = 'AJAX/get_inventory_items.php';

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


//Getting items in the seller inventory
function loadSellerInventory() {
    const xhr = new XMLHttpRequest();
    const url = 'AJAX/get_shop_items.php';

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById('seller-inventory').innerHTML = xhr.responseText;
            } else {
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

                        // Update the content in the "Detail" section
            const detailElement = document.getElementById('itemDetail');
            const detailItemName = detailElement.querySelector('.detail__item-name');
            const detailItemImage = detailElement.querySelector('.detail__item-image');
            const detailItemLevel = detailElement.querySelector('.detail__item-lvl');
            const detailItemDescription = detailElement.querySelector('.detail__item-description');
            const detailItemDamage = detailElement.querySelector('.detail__item__footer__stats-main');
            const detailItemSlot = detailElement.querySelector('.detail__item__footer__stats-slot');
            const detailItemPrice = detailElement.querySelector('.detail__item__footer__stats-price');
            const detailSell = detailElement.querySelector('.detail__item__footer-equip-image');
            const detailBuysell = detailElement.querySelector('.detail__item__footer-buysell-text');


            detailItemName.textContent = selectedItem.name;
            detailItemImage.src = "assets/Image/Items/" + selectedItem.image;
            const slot = selectedItem.slot;
            detailSell.setAttribute('onclick', `sellItem(${selectedItem.id}, '${slot}', '${itemLevel}')`);

            detailItemLevel.textContent = "Level - " + itemLevel;
            detailItemDescription.textContent = selectedItem.description;
            detailBuysell.textContent = "Sell";
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


            detailItemSlot.textContent = "Slot: " + selectedItem.slot;
            detailItemPrice.textContent = "Price: " + Math.round((selectedItem.price * (itemLevel / 2))) + " coins";
        } 
        else {
           console.error('Error:', xhr.status);
       }
   }
};

xhr.open('GET', url, true);
xhr.send();
}

//Display information about the selected seller item
function showSellItemDetail(itemId, itemLevel) {
 const detailElement = document.getElementById('detail__item');
 detailElement.style.display = 'grid';
 const xhr = new XMLHttpRequest();
 const url = `AJAX/get_sell_details_shop.php?itemId=${itemId}`;

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
            const detailSell = detailElement.querySelector('.detail__item__footer-equip-image');
            const detailBuysell = detailElement.querySelector('.detail__item__footer-buysell-text');


            detailItemName.textContent = selectedItem.name;
            detailItemImage.src = "assets/Image/Items/" + selectedItem.image;
            const slot = selectedItem.slot;
            detailSell.setAttribute('onclick', `buyItem(${selectedItem.id}, '${slot}', '${itemLevel}')`);

            detailItemLevel.textContent = "Level - " + itemLevel;
            detailItemDescription.textContent = selectedItem.description;
            detailBuysell.textContent = "Buy";
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


            detailItemSlot.textContent = "Slot: " + selectedItem.slot;
            detailItemPrice.textContent = "Price: " + Math.round((selectedItem.price * (itemLevel))) + " coins";
        } 
        else {
           console.error('Error:', xhr.status);
       }
   }
};

xhr.open('GET', url, true);
xhr.send();
}


//item sale
function sellItem(itemId, slot, lvl) {

   const xhr = new XMLHttpRequest();
   const url = 'AJAX/sellitems.php';

   xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
         if (xhr.status === 200) {
            const detailElement = document.getElementById('detail__item');
            detailElement.style.display = 'none';
            loadInventory();
            loadSellerInventory();
        } else {
            console.error('Error:', xhr.status);
        }
    }
};

xhr.open('POST', url, true);
xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
xhr.send(`itemId=${itemId}&slot=${slot}&lvl=${lvl}`);
}

//item buy
function buyItem(itemId, slot, lvl) {

   const xhr = new XMLHttpRequest();
   const url = 'AJAX/buyitems.php';

   xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
         if (xhr.status === 200) {
            const detailElement = document.getElementById('detail__item');
            detailElement.style.display = 'none';
            loadInventory();
            loadSellerInventory();
        } else {
            console.error('Error:', xhr.status);
        }
    }
};

xhr.open('POST', url, true);
xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
xhr.send(`itemId=${itemId}&slot=${slot}&lvl=${lvl}`);
}

loadInventory();
loadSellerInventory();