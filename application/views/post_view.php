<head>
	<meta charset="utf-8">
	<title>Main | Codeigniter</title>
	<link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.21.0/full/ckeditor.js"></script>
</head>
<dialog>
    <input type="text" id="title"></input>
    <textarea id="text"></textarea>
    <input type="number" id="priority">
    <footer>
        <button id="close">Close</button>
        <button id="saveAndClose">Save And Close</button>
        <button id="save">Save</button>
    </footer>
</dialog>
<script>
    window.addEventListener("load", async (event) => {
        id    = parseInt(window.location.hash.substr(1, window.location.hash.length))
        title = ''
        text  = ''
        if(!isNaN(id)) {
            data     = await funData('show', id)
            title    = data[0].title
            text     = data[0].text
            priority = data[0].priority
        }
        document.querySelector('dialog').showModal()
        
        //editor title
        $('#title').val(funDecodeHtml(title))

        //editor text
        CKEDITOR.replace('text', {
            toolbar: [
                { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
                { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ] },
                { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent' ] }
            ]
        });
        CKEDITOR.instances['text'].setData(text);

        //editor priority
        $('#priority').val(priority)
    });

    $('dialog button#close, dialog button#saveAndClose').click(function() {
        window.location.hash = '!'
        window.location.pathname = window.location.pathname.substr(0, window.location.pathname.lastIndexOf('/'))
    })
    $('dialog button#save, dialog button#saveAndClose').click(function() {
        funsaveUpdate()
    })
</script>