	<footer class="footer">
		<div class="icons">
			<a href="index.php"><span class="icon"  id="update" onclick="clickSound()"><img src="assets/Image/Interface/update.png" alt="update" class="icon_image"></span></a>
			<a href="inventory.php"><span class="icon"  id="inventory_icon" onclick="clickSound()"><img src="assets/Image/Interface/inventory.png" alt="inventory" class="icon_image"></span></a>
			<a href="shop.php"><span class="icon" id="shop" onclick="clickSound()"><img src="assets/Image/Interface/shop.png" alt="shop" class="icon_image"></span></a>
			<a href="potion.php"><span class="icon" id="potion_icon" onclick="clickSound()"><img src="assets/Image/Interface/potion.png" alt="shop" class="icon_image"></span></a>
			<!-- <a href="quests.php"><span class="icon" id="quest"><img src="assets/Image/Interface/quest.png" alt="quest" class="icon_image"></span></a>
			<a href="friends.php"><span class="icon" id="friends"><img src="assets/Image/Interface/friends.png" alt="friends" class="icon_image"></span></a> -->
			<a href="map.php"><span class="icon" id="map" onclick="clickSound()"><img src="assets/Image/Interface/map.png" alt="map" class="icon_image"></span></a>
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

		var mouseClickAudio = new Audio('assets/Sound/mouse_click.flac');
 		mouseClickAudio.play();


	HP();
	</script>