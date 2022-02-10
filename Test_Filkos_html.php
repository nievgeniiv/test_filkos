<?php /** @noinspection PhpUndefinedFieldInspection */
$tpl = Tpl::getInstance();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Title</title>
</head>
<body>
	<form action="test_filkos.php" method="post">
		<input type="hidden" name="token_form" value="<?php echo $tpl->tokenForm ?>">
		<label>Введите ссылку: </label>
		<!--suppress HtmlFormInputWithoutLabel -->
		<input type="text" name="link" required />
		<input type="submit" value="Сократить ссылку">
		<?php if ($tpl->is_error) { ?>
			<em><?php echo $tpl->error ?></em>
		<?php } ?>
	</form>
	<?php if (!empty($tpl->shortLink)) { ?>
		<a href="http://domen.ru/<?php echo $tpl->shortLink ?>"><?php echo $tpl->shortLink ?></a>
	<?php } ?>
</body>
</html>
