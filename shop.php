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
	<link rel="stylesheet" type="text/css" href="assets/CSS/shop.css">
</head>
<body>
<? include 'header.php'; ?>

	<main class="main">
		<div id="inventory" class="inventory">
			
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
						<div class="detail__item__footer-buysell">
							<p class="detail__item__footer-buysell-text"></p>
							<img src="assets/Image/Interface/Equip.png" alt="Equip" class="detail__item__footer-equip-image">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="seller-inventory" class="seller-inventory">
			
		</div>
	</main>
<? include 'footer.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="assets/JS/script.js"></script>
	<script src="assets/JS/shop.js"></script>
		<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function() {
			const iconElement = document.querySelector('#shop');
			if (iconElement) {
				iconElement.classList.add('icon_active');
			}
		});
	</script>
</body>
</html>
