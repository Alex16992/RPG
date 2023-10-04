	<footer class="footer">
		<div class="icons">
			<a href="index.php"><img src="assets/Image/Interface/update.png" alt="update" id="update" class="icon"></a>
			<a href="inventory.php"><img src="assets/Image/Interface/inventory.png" alt="inventory" id="inventory_icon" class="icon"></a>
			<a href="shop.php"><img src="assets/Image/Interface/shop.png" alt="shop" id="shop" class="icon"></a>
			<a href="quests.php"><img src="assets/Image/Interface/quest.png" alt="quest" id="quest" class="icon"></a>
			<a href="friends.php"><img src="assets/Image/Interface/friends.png" alt="friends" id="friends" class="icon"></a>
			<a href="map.php"><img src="assets/Image/Interface/map.png" alt="map" id="map" class="icon"></a>
		</div>
	</footer>
	<script type="text/javascript">
		function HP() {
		const currentHealth = <?php echo $health; ?>; // Текущее здоровье
		const maxHealth = <?php echo $max_health; ?>; // Максимальное здоровье

		const healthBar = document.getElementById('healthBar');
		const healthText = document.getElementById('healthText');

		const fillWidth = (currentHealth / maxHealth) * 100;

		healthBar.style.setProperty('--fill-width', `${fillWidth}%`); // Уменьшение полоски здоровья
		healthText.innerText = `${currentHealth}/${maxHealth}`; // Вывод здоровья
	}

	HP();
	</script>