﻿<?php
	
	if(!isset($_GET['t'])) { die("<h1>Ошибка! Не переданы все параметры</h1>"); }
	if(!isset($_GET['key'])) { die("<h1>Ошибка! Не передан ключ</h1>"); }
	
	if(sha1($GLOBALS['private_key'] . $_GET['t']) === $_GET['key']) {
		$_SESSION['invited'] = true;
		die("<h1>Поздравляем! Вы получили право зарегистрировать аккаунт. <a href='/'>Нажмите сюда</a></h1>");
	}
	else {
		die("<h1>Ошибка! Неверный ключ</h1>");
	}