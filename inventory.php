<? include 'user_info.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>My RPG</title>
	<link rel="stylesheet" type="text/css" href="assets/CSS/null.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Jomhuria&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/CSS/header.css">
	<link rel="stylesheet" type="text/css" href="assets/CSS/footer.css">
	<link rel="stylesheet" type="text/css" href="assets/CSS/inventory.css">
</head>
<body>
	<? include 'header.php'; ?>
	<main class="main">
		<div class="equipped">
			<div class="equipped_stats">
				<p class="equipped_stats-armor">
					Armor: 15
				</p>
				<p class="equipped_stats-damage">
					Damage: 20
				</p>
			</div>
			<div class="equipped_items">
				<img src="" alt="" id="jewelry_left">
				<img src="" alt="" id="helmet">
				<img src="" alt="" id="jewelry_right">
				<img src="" alt="" id="weapon_left">
				<img src="" alt="" id="body">
				<img src="" alt="" id="weapon_right">
			</div>
		</div>
		<div id="inventory">
			
		</div>
		<div class="detail" id="itemDetail">
			<h2 class="title">Detail</h2>
			<div class="detail-border">
				<div class="detail__item" id="detail__item">
					<div class="detail__item_main">
						<img src="assets/Image/Items/Hemlet.png" alt="Item" class="detail__item-image">
						<div class="detail__item-about">
							<p class="detail__item-name">

							</p>
							<p class="detail__item-lvl">

							</p>
						</div>
					</div>
					<p class="detail__item-description">

					</p>
					<div class="detail__item__footer">
						<div class="detail__item__footer__stats">
							<div class="detail__item__footer__stats-main">

							</div>
							<div class="detail__item__footer__stats-slot">

							</div>
							<div class="detail__item__footer__stats-price">

							</div>
						</div>
						<div class="detail__item__footer-equip">
							<p>Equip</p>
							<img src="assets/Image/Interface/Equip.png" alt="Equip" class="detail__item__footer-equip-image">
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<? include 'footer.php'; ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="assets/JS/script.js"></script>
	<script type="text/javascript">
		function loadInventory() {
			const xhr = new XMLHttpRequest();
			const url = 'inventory_ajax.php';

			xhr.onreadystatechange = function() {
				if (xhr.readyState === XMLHttpRequest.DONE) {
					if (xhr.status === 200) {
                // Update the content in the inventory section
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

    // Define the PHP script URL to handle the AJAX request
    const url = `get_item_details.php?itemId=${itemId}`; // Adjust the URL as needed

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
        dataType: 'json',  // Указываем, что ожидаем JSON-ответ
        success: function(data) {
            console.log('Response:', data);  // Выводим ответ в консоль
            $('#jewelry_left').attr('src', 'assets/Image/Items/' + data.jewelry_left);
            $('#jewelry_right').attr('src', 'assets/Image/Items/' + data.jewelry_right);
            $('#helmet').attr('src', 'assets/Image/Items/' + data.helmet);
            $('#body').attr('src', 'assets/Image/Items/' + data.body);
            $('#weapon_left').attr('src', 'assets/Image/Items/' + data.weapon_left);
            $('#weapon_right').attr('src', 'assets/Image/Items/' + data.weapon_right);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', textStatus, errorThrown);  // Выводим ошибку в консоль
        }
    });
}

updateItems();
loadInventory();

// setInterval(updateItems, 1000);
// setInterval(loadInventory, 1000);

</script>
</body>
</html>
