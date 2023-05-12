<head>
	<meta charset="utf-8">
	<title>Main | Codeigniter</title>
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.21.0/full/ckeditor.js"></script>
</head>
<dialog>
    <input type="text" id="title"></input>
    <textarea id="description"></textarea>
    <select id="priority">
        <option value="top">top</option>
        <option value="high">high</option>
        <option value="medium">medium</option>
        <option value="low">low</option>
        <option value="bottom">bottom</option>
    </select>
    <footer>
        <button id="close">Close</button>
        <button id="saveAndClose">Save And Close</button>
        <button id="save">Save</button>
    </footer>
    <script src="<?= base_url() ?>assets/js/task.js"></script>
    <script src="<?= base_url() ?>assets/js/bridge.js"></script>
    <script src="<?= base_url() ?>assets/js/helper.js"></script>
</dialog>