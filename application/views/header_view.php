<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.21.0/full/ckeditor.js"></script>
</head>
<body>
    <header>
        <img src="<?= base_url() ?>assets/img/logo.svg" alt="">
        <nav>
            <ul>
                <li>
                    <a href="<?= base_url() ?>index.php/timeReport_controllers/">Time Report</a>
                </li>
                <li>
                    <a href="<?= base_url() ?>index.php/main_controllers/">Tasks</a>
                    <a href="<?= base_url() ?>index.php/main_controllers/task">+</a>
                </li>
                <li>
					<a href="<?= base_url() ?>index.php/project_controllers/">Project</a>
					<a href="<?= base_url() ?>index.php/project_controllers/task">+</a>
                </li>
                <li>
                    <a href="<?= base_url() ?>index.php/user_controllers/">Accounts (comming soon)</a>
                </li>
            </ul>
        </nav>
    </header>
	<script src="<?= base_url() ?>assets/js/header.js"></script>
	<script src="<?= base_url() ?>assets/js/helper.js"></script>
</body>
</html>