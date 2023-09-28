function HP() {
	const currentHealth = 13; // Текущее здоровье
	const maxHealth = 22; // Максимальное здоровье

	const healthBar = document.getElementById('healthBar');
	const healthText = document.getElementById('healthText');

	const fillWidth = (currentHealth / maxHealth) * 100;

	healthBar.style.setProperty('--fill-width', `${fillWidth}%`); // Уменьшение полоски здоровья
	healthText.innerText = `${currentHealth}/${maxHealth}`; // Вывод здоровья
}

HP();