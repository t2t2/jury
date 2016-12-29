<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $page->title; ?></title>
</head>
<body>

	<?= $this->section('content'); ?>

	<?php if($page->editable()) echo "<p><a href='$page->editURL'>Edit</a></p>"; ?>
</body>
</html>