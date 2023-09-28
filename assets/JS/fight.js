function HealthPlayer() {
	const currentHealthPlayer = 13; // Текущее здоровье
	const maxHealthPlayer = 22; // Максимальное здоровье

	const playerHealth = document.getElementById('PlayerHealth');
	const playerHealthValue = document.getElementById('PlayerHealthValue');

	const fillWidth = (currentHealthPlayer / maxHealthPlayer) * 100;

	playerHealth.style.setProperty('--fill-width', `${fillWidth}%`);
	playerHealthValue.innerText = `${currentHealthPlayer}/${maxHealthPlayer}`;
}

function HealthEnemy() {
  	const currentHealthEnemy = 10;
	const maxHealthEnemy = 10;

	const enemyHealth = document.getElementById('EnemyHealth');
	const enemyHealthValue = document.getElementById('EnemyHealthValue');

	const fillWidth = (currentHealthEnemy / maxHealthEnemy) * 100;

	enemyHealth.style.setProperty('--fill-width', `${fillWidth}%`);
	enemyHealthValue.innerText = `${currentHealthEnemy}/${maxHealthEnemy}`;
}

HealthPlayer();
HealthEnemy();