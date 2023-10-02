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
				<img src="assets/Image/Items/Dagger.png" alt="">
				<img src="assets/Image/Items/Dagger.png" alt="">
				<img src="assets/Image/Items/Dagger.png" alt="">
				<img src="assets/Image/Items/Dagger.png" alt="">
				<img src="assets/Image/Items/Dagger.png" alt="">
				<img src="assets/Image/Items/Dagger.png" alt="">
			</div>
		</div>
		<div class="inventory">
			<h2 class="title">Your inventory</h2>
			<div class="inventory-border">
				<div class="inventory__item">
					<img src="assets/Image/Items/Hemlet.png" alt="Item" class="inventory__item-image">
					<div class="inventory__item-about">
						<p class="inventory__item-name">
							Knight's helmet
						</p>
						<p class="inventory__item-lvl">
							Level - 5
						</p>
					</div>
					<img src="assets/Image/Interface/Detail.png" alt="detail" class="inventory__item-detail">
				</div>
				<div class="inventory__item">
					<img src="assets/Image/Items/Hemlet.png" alt="Item" class="inventory__item-image">
					<div class="inventory__item-about">
						<p class="inventory__item-name">
							Knight's helmet
						</p>
						<p class="inventory__item-lvl">
							Level - 5
						</p>
					</div>
					<img src="assets/Image/Interface/Detail.png" alt="detail" class="inventory__item-detail">
				</div>
				<div class="inventory__item">
					<img src="assets/Image/Items/Hemlet.png" alt="Item" class="inventory__item-image">
					<div class="inventory__item-about">
						<p class="inventory__item-name">
							Knight's helmet
						</p>
						<p class="inventory__item-lvl">
							Level - 5
						</p>
					</div>
					<img src="assets/Image/Interface/Detail.png" alt="detail" class="inventory__item-detail">
				</div>
				<div class="inventory__item">
					<img src="assets/Image/Items/Hemlet.png" alt="Item" class="inventory__item-image">
					<div class="inventory__item-about">
						<p class="inventory__item-name">
							Knight's helmet
						</p>
						<p class="inventory__item-lvl">
							Level - 5
						</p>
					</div>
					<img src="assets/Image/Interface/Detail.png" alt="detail" class="inventory__item-detail">
				</div>
				<div class="inventory__item">
					<img src="assets/Image/Items/Hemlet.png" alt="Item" class="inventory__item-image">
					<div class="inventory__item-about">
						<p class="inventory__item-name">
							Knight's helmet
						</p>
						<p class="inventory__item-lvl">
							Level - 5
						</p>
					</div>
					<img src="assets/Image/Interface/Detail.png" alt="detail" class="inventory__item-detail">
				</div>
				<div class="inventory__item">
					<img src="assets/Image/Items/Hemlet.png" alt="Item" class="inventory__item-image">
					<div class="inventory__item-about">
						<p class="inventory__item-name">
							Knight's helmet
						</p>
						<p class="inventory__item-lvl">
							Level - 5
						</p>
					</div>
					<img src="assets/Image/Interface/Detail.png" alt="detail" class="inventory__item-detail">
				</div>
			</div>
			
		</div>
		<div class="detail">
			<h2 class="title">Detail</h2>
			<div class="detail-border">
				<div class="detail__item">
					<div class="detail__item_main">
						<img src="assets/Image/Items/Hemlet.png" alt="Item" class="detail__item-image">
						<div class="detail__item-about">
							<p class="detail__item-name">
								Knight's helmet
							</p>
							<p class="detail__item-lvl">
								Level - 5
							</p>
						</div>
					</div>
					<p class="detail__item-description">
						This axe belonged to a lumberjack named Jack, whose fate had not turned out well...
					</p>
					<div class="detail__item__footer">
						<div class="detail__item__footer__stats">
							<div class="detail__item__footer__stats-main">
								Damage: 14
							</div>
							<div class="detail__item__footer__stats-slot">
								Slot: hand
							</div>
							<div class="detail__item__footer__stats-price">
								Price: 46 coins
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
		<script src="assets/JS/script.js"></script>
			<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function() {
			const iconElement = document.querySelector('#inventory');
			if (iconElement) {
				iconElement.classList.add('icon_active');
			}
		});
	</script>
	</body>
	</html>
