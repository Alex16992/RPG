// Get the player health
function getPlayerHP() {
    const xhr = new XMLHttpRequest();
    const url = `AJAX/get_player_hp.php`;

    xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
        	const playerHP = JSON.parse(xhr.responseText);

            const currentHealthPlayer = playerHP.health; // Current health
			const maxHealthPlayer = playerHP.max_health; // Max health

			const playerHealth = document.getElementById('PlayerHealth');
			const playerHealthValue = document.getElementById('PlayerHealthValue');

			const fillWidth = (currentHealthPlayer / maxHealthPlayer) * 100;

			playerHealth.style.setProperty('--fill-width', `${fillWidth}%`);
			playerHealthValue.innerText = `${currentHealthPlayer}/${maxHealthPlayer}`;
        } 
        else {
        	console.error('Error:', xhr.status);
     }
 }
};

xhr.open('GET', url, true);
xhr.send();
}


// Get the enemy health
function getEnemyHP() {
	const xhr = new XMLHttpRequest();
	const url = `AJAX/get_enemy_hp.php`;

	xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
        	const enemyHP = JSON.parse(xhr.responseText);

            const currentHealthEnemy = enemyHP.enemy_hp; // Current health
			const maxHealthEnemy = enemyHP.enemy_max_hp; // Max health

			const enemyHealth = document.getElementById('EnemyHealth');
			const enemyHealthValue = document.getElementById('EnemyHealthValue');

			const fillWidth = (currentHealthEnemy / maxHealthEnemy) * 100;

			enemyHealth.style.setProperty('--fill-width', `${fillWidth}%`);
			enemyHealthValue.innerText = `${currentHealthEnemy}/${maxHealthEnemy}`;
        } 
        else {
         console.error('Error:', xhr.status);
     }
 }
};

xhr.open('GET', url, true);
xhr.send();
}


function enemyDetails() {
	const xhr = new XMLHttpRequest();
	const url = 'AJAX/get_enemy_details.php';

	xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById('EnemyStats').innerHTML = xhr.responseText;
            } 
            else {
                console.error('Error:', xhr.status);
            }
        }   
    };
    xhr.open('GET', url, true);
    xhr.send();
}


function playerAttack() {
    const xhr = new XMLHttpRequest();
    const url = 'AJAX/player_attack.php';

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const damageTextElement = document.getElementById('damageEnemyText');
                const damage = parseInt(xhr.responseText);
                console.log (damage);
                if (damage === 77777) {
                    window.location.href = 'win.php';
                }
                else if (damage === 66666) {
                    window.location.href = 'die.php';
                } 
                else if (damage !== 0) {
                    damageTextElement.innerText = `-${damage}`;
                    damageTextElement.classList.add('damageText');
                    // Remove the damage text after the animation
                    setTimeout(() => {
                        damageTextElement.innerText = '';
                        damageTextElement.classList.remove('damageText');
                        animateEnemyImage();
                    }, 650);
                    getEnemyHP();
                    enemyDetails();
                } else {
                    animateEnemyImage();
                }
                
            } 
            else {
                console.error('Error:', xhr.status);
            }
        }
    };

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send();
}


function enemyAttack() {
    const xhr = new XMLHttpRequest();
    const url = 'AJAX/enemy_attack.php';

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const damageTextElement = document.getElementById('damagePlayerText');
                const damage = parseInt(xhr.responseText);
                if (damage === 66666) {
                    window.location.href = 'die.php';
                } 
                else if(damage === 77777){
                    window.location.href = 'win.php';
                }
                else {             
                damageTextElement.innerText = `-${damage}`;
                damageTextElement.classList.add('damageText');

                // Remove the damage text after the animation
                setTimeout(() => {
                    damageTextElement.innerText = '';
                    damageTextElement.classList.remove('damageText');
                }, 650);

                getPlayerHP();
                enemyDetails();
                }
            } 
            else {
                console.error('Error:', xhr.status);
            }
        }
    };

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send();
}


function getDistanceToEnemy() {
    const playerImage = document.querySelector('.BattleField__player');
    const enemyElement = document.querySelector('.BattleField__enemy__img');
    if (!enemyElement) {
        console.error('Enemy element not found.');
        return 0;
    }

    const playerRect = playerImage.getBoundingClientRect();
    const enemyRect = enemyElement.getBoundingClientRect();

    return enemyRect.left - playerRect.right;
}


function getDistanceToPlayer() {
    const playerImage = document.querySelector('.BattleField__player__img');
    const enemyElement = document.querySelector('.BattleField__enemy');
    if (!playerImage) {
        console.error('Player element not found.');
        return 0;
    }

    const playerRect = playerImage.getBoundingClientRect();
    const enemyRect = enemyElement.getBoundingClientRect();

    return playerRect.right - enemyRect.left;
}

function animatePlayerImage() {
    const playerImage = document.querySelector('.BattleField__player');
    let currentPosition = 0;
    let direction = 1; // 1 for moving right, -1 for moving left
    const targetPosition = getDistanceToEnemy();  // Desired distance to move
    const animationSpeed = 5;    // Speed of the animation
    let animationRunning = true; // Flag to control animation

    function animate() {
        if (!animationRunning) return; // Stop animation if flag is false

        currentPosition += direction * animationSpeed;
        playerImage.style.transform = `translateX(${currentPosition}px)`;

        // Check if reached the desired distance
        if ((direction === 1 && currentPosition >= targetPosition) || (direction === -1 && currentPosition <= 0)) {
            // Change direction to move in the opposite direction
            direction *= -1;
            if (direction === -1) {
                playerAttack();
                enemyDamageAnimation();
            }
            // If reached the end positions, stop animation
            if (currentPosition <= 0) {
                animationRunning = false;
                playerImage.style.transform = 'translateX(0)'; // Reset position
                
            }
        }

        // Continue animation if not reached the end positions
        if (animationRunning) {
            requestAnimationFrame(animate);
        }
    }

    animate();
}

function enemyDamageAnimation() {
    const enemyImage = document.querySelector('.BattleField__enemy__img');
    let duration = 600; // Duration of the animation in milliseconds
    let startTime = null;

    function animate(timestamp) {
        if (!startTime) {
            startTime = timestamp;
        }

        const elapsed = timestamp - startTime;

        if (elapsed < duration) {
            const progress = elapsed / duration;
            const angle = Math.sin(progress * Math.PI * 5) * 6; // Adjust the amplitude and frequency as needed
            enemyImage.style.transform = `rotate(${angle}deg)`;

            requestAnimationFrame(animate);
        } else {
            enemyImage.style.transform = 'rotate(0deg)'; // Reset rotation
        }
    }
    requestAnimationFrame(animate);
}


function animateEnemyImage() {
    const playerImage = document.querySelector('.BattleField__enemy');
    let currentPosition = 0;
    let direction = -1; // 1 for moving right, -1 for moving left
    const targetPosition = getDistanceToPlayer();  // Desired distance to move
    let currentSpeed = 6;    // Speed of the animation
    let animationRunning = true; // Flag to control animation

    function animate() {
        if (!animationRunning) return; // Stop animation if flag is false

        currentPosition += direction * currentSpeed;
        playerImage.style.transform = `translateX(${currentPosition}px)`;

        // Check if reached the desired distance
        if ((direction === -1 && currentPosition <= targetPosition) || (direction === 1 && currentPosition >= 0)) {
            // Change direction to move in the opposite direction
            direction *= -1;

            // Gradually reduce speed to make the transition smooth
            currentSpeed = Math.max(currentSpeed - 0.1, 0.1);

            if (direction === 1) {
                enemyAttack();
                playerDamageAnimation();
            }
            // If reached the end positions, stop animation
            if (currentPosition >= 0) {
                animationRunning = false;
                playerImage.style.transform = 'translateX(0)'; // Reset position
            }
        }

        // Continue animation if not reached the end positions
        if (animationRunning) {
            requestAnimationFrame(animate);
        }
    }

    animate();
}


function playerDamageAnimation() {
    const enemyImage = document.querySelector('.BattleField__player__img');
    let duration = 600; // Duration of the animation in milliseconds
    let startTime = null;

    function animate(timestamp) {
        if (!startTime) {
            startTime = timestamp;
        }

        const elapsed = timestamp - startTime;

        if (elapsed < duration) {
            const progress = elapsed / duration;
            const angle = Math.sin(progress * Math.PI * 5) * 6; // Adjust the amplitude and frequency as needed
            enemyImage.style.transform = `rotate(${angle}deg)`;

            requestAnimationFrame(animate);
        } else {
            enemyImage.style.transform = 'rotate(0deg)'; // Reset rotation
        }
    }
    requestAnimationFrame(animate);
}

let lastCheckTime = 0;

function checkTurn() {
    const currentTime = new Date().getTime();

    if (currentTime - lastCheckTime >= 2500) {
        lastCheckTime = currentTime;

        const xhr = new XMLHttpRequest();
        const url = 'AJAX/check_turn.php';

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const turn = parseInt(xhr.responseText);
                    if (turn == 0) {
                        animateEnemyImage();
                    } else {
                        animatePlayerImage();
                    }
                } else {
                    console.error('Error:', xhr.status);
                }
            }
        };

        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send();
    } else {
        console.log('Too soon to make another request.');
    }
}

getPlayerHP();
getEnemyHP();
enemyDetails();