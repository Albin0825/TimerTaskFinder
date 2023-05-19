<head>
	<meta charset="utf-8">
    <script src="//cdn.ckeditor.com/4.21.0/full/ckeditor.js"></script>
</head>
<dialog>
	<div class="wrapper">
		<!--==================================================
			Row 1 | Witch customer or/and project owns the project/task?
		===================================================-->
		<input id="connection" type="number" placeholder="customerID"></input>
		<button id="timeReportBtn">timeReportBtn</button>
		
		<!--==================================================
		Row 2 | What is the title of this project/task?
		how much time should it take to be done with the project/task?
		===================================================-->
		<input id="title" type="text" placeholder="title"></input>
		<div id="progressBar">
			<input id="time" type="number" placeholder="time"></input>
			<input id="eta" type="number" placeholder="eta"></input>
		</div>
		
		<!--==================================================
			Row 3 | What is this project/task about?
		===================================================-->
		<textarea id="description"></textarea>

		<!--==================================================
			Row 4 | What priority should this project/task have?
		===================================================-->
		<select id="priority">
			<option value="top">top</option>
			<option value="high">high</option>
			<option value="medium">medium</option>
			<option value="low">low</option>
			<option value="bottom">bottom</option>
		</select>
	</div>
    <footer>
        <button id="delete">Delete</button>
        <button id="close">Close</button>
        <button id="saveAndClose">Save And Close</button>
        <button id="save">Save</button>
    </footer>
    <script src="<?= base_url() ?>assets/js/openTask.js"></script>
</dialog>