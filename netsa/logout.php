<?php
		session_start();
		unset($_SESSION['usuario']);
		session_destroy();

		//header("Location: https://netsabolivia.com/sistema/rider/pagina/iniciar-session.html");
		header("Location:iniciar-session.html");
?>