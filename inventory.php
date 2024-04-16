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
				<p class="equipped_stats-armor" id="equipped_stats-armor">
					
				</p>
				<p class="equipped_stats-damage" id="equipped_stats-damage">
					
				</p>
				<p class="equipped_stats-crit" id="equipped_stats-crit">
					
				</p>
			</div>
			<div class="equipped_items">
				<p id="jewelry_left_lvl"><img src="" alt="" id="jewelry_left"></p>
				<p id="helmet_lvl"><img src="" alt="" id="helmet" onclick="unequipHelmet()"></p>
				<p id="jewelry_right_lvl"><img src="" alt="" id="jewelry_right"></p>
				<p id="weapon_left_lvl"><img src="" alt="" id="weapon_left" onclick="unequipWeapon_left()"></p>
				<p id="body_lvl"><img src="" alt="" id="body" onclick="unequipBody()"></p>
				<p id="weapon_right_lvl"><img src="" alt="" id="weapon_right" onclick="unequipWeapon_right()"></p>
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
							<div class="detail__item__footer__stats-crit">

							</div>
							<div class="detail__item__footer__stats-slot">

							</div>
							<div class="detail__item__footer__stats-price">

							</div>
						</div>
						<div class="detail__item__footer-equip">
							<p class="detail__item__footer-equip-text">Equip</p>
							<img src="assets/Image/Interface/Equip.png" alt="Equip" class="detail__item__footer-equip-image">
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<?php include 'footer.php'; ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="assets/JS/script.js"></script>
	<script src="assets/JS/inventory.js"></script>
	<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function() {
			const iconElement = document.querySelector('#inventory_icon');
			if (iconElement) {
				iconElement.classList.add('icon_active');
			}
		});
	</script>
</body>
</html>
