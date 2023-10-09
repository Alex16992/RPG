	<footer class="footer">
		<div class="icons">
			<a href="index.php"><span class=""  id="update"><img src="assets/Image/Interface/update.png" alt="update" class="icon"></span></a>
			<a href="inventory.php"><span class=""  id="inventory_icon"><img src="assets/Image/Interface/inventory.png" alt="inventory" class="icon"></span></a>
			<a href="shop.php"><span class="" id="shop"><img src="assets/Image/Interface/shop.png" alt="shop" class="icon"></span></a>
			<!-- <a href="quests.php"><span class="" id="quest"><img src="assets/Image/Interface/quest.png" alt="quest" class="icon"></span></a>
			<a href="friends.php"><span class="" id="friends"><img src="assets/Image/Interface/friends.png" alt="friends" class="icon"></span></a> -->
			<a href="map.php"><span class="" id="map"><img src="assets/Image/Interface/map.png" alt="map" class="icon"></span></a>
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