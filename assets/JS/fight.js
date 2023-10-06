// Get the player health
function HealthPlayer() {
	const currentHealthPlayer = 13; // Current health
	const maxHealthPlayer = 22; // Max health

	const playerHealth = document.getElementById('PlayerHealth');
	const playerHealthValue = document.getElementById('PlayerHealthValue');

	const fillWidth = (currentHealthPlayer / maxHealthPlayer) * 100;

	playerHealth.style.setProperty('--fill-width', `${fillWidth}%`);
	playerHealthValue.innerText = `${currentHealthPlayer}/${maxHealthPlayer}`;
}

// Get the enemy health
function HealthEnemy() {
  	const currentHealthEnemy = 10; // Current health
	const maxHealthEnemy = 10; // Max health

	const enemyHealth = document.getElementById('EnemyHealth');
	const enemyHealthValue = document.getElementById('EnemyHealthValue');

	const fillWidth = (currentHealthEnemy / maxHealthEnemy) * 100;

	enemyHealth.style.setProperty('--fill-width', `${fillWidth}%`);
	enemyHealthValue.innerText = `${currentHealthEnemy}/${maxHealthEnemy}`;
}

HealthPlayer();
HealthEnemy();