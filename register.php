

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
	<link rel="stylesheet" type="text/css" href="assets/CSS/log_reg.css">
</head>
<body>
	<main class="main">
		<div class="form">
			<div id="err" class="err">
			</div>
			<form id="register-form">
				<input name='login' class="input" type='text' placeholder='Login...' autocomplete="off">
				<input name='email' class="input" type='email' placeholder='Email...' autocomplete="off">
				<input name='password' class="input" type='password' placeholder='Password...' autocomplete="new-password">
				<input name="send" class="submit" type="submit" value="Register">
			</form>
			<p class="form__text">
				Have account? <a href="#">Login</a>
			</p>
		</div>
	</main>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script type="text/javascript">
	window.onload = function() {
    loginInput.value = ' ';
    emailInput.value = ' ';
    passwordInput.value = ' ';

    setTimeout(function() {
        loginInput.value = '';
        emailInput.value = '';
        passwordInput.value = '';
    }, 100); // Adjust the timeout as needed
};
		$(document).ready(function() {
			$("#register-form").submit(function(event) {
            event.preventDefault(); // Предотвращаем отправку формы по умолчанию

            // Собираем данные из формы
            var formData = $(this).serialize();

            $.ajax({
                type: "POST", // Метод запроса
                url: "reg.php", // URL-адрес обработчика PHP
                data: formData, // Данные из формы
                success: function(response) {
                    // Обработка успешного ответа от сервера
                	$("#err").html(response);
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Обработка ошибок
                	console.error("Ошибка при выполнении запроса: " + errorThrown);
                }
            });
        });
		});
	</script>
</body>
</html>
