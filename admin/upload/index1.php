<html>
<head>
<meta charset="utf-8">
<title>jQuery File Upload Example</title>
<style>
#progress {
	width:400px;
	height:18px;
	background: silver;
}
.bar {
    height: 18px;
    background: green;
}
</style>
</head>
<body>
<input id="fileupload" type="file" name="files[]" data-url="server/php/" multiple>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src="js/vendor/jquery.ui.widget.js"></script>
<script src="js/jquery.iframe-transport.js"></script>
<script src="js/jquery.fileupload.js"></script>
<script src="js/jquery.fileupload-fp.js"></script>
<script src="http://blueimp.github.com/JavaScript-Load-Image/load-image.min.js"></script>
<script src="http://blueimp.github.com/JavaScript-Canvas-to-Blob/canvas-to-blob.min.js"></script>
<script>
$(function () {
    $('#fileupload').fileupload({
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result, function (index, file) {
                $('<p/>').text(file.name).appendTo(document.body);
            });
        }
    });
});
</script>
<div id="progress">
    <div class="bar" style="width: 0%;"></div>
</div>
<script>
$('#fileupload').fileupload({
    /* ... */
    progressall: function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .bar').css(
            'width',
            progress + '%'
        );
    }
});
</script>
<script>
$('#fileupload').fileupload({
    /* ... */
    add: function (e, data) {
        $(this).fileupload('process', data).done(function () {
            data.submit();
        });
    }
});
</script>



</body> 
</html>