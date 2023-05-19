<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
                    <a href="<?= base_url() ?>index.php/task_controllers/">Tasks</a>
                    <a href="<?= base_url() ?>index.php/task_controllers/task">+</a>
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
</body>
</html>