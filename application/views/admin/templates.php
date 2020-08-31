
<link rel="stylesheet" href="<?php echo base_url()?>assets/admin/vendor/codemirror/theme/monokai.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/admin/vendor/codemirror/lib/codemirror.css">

<script src="<?php echo base_url()?>assets/admin/vendor/codemirror/lib/codemirror.js"></script>

<script src="<?php echo base_url()?>assets/admin/vendor/codemirror/addon/edit/matchbrackets.js"></script>
<script src="<?php echo base_url()?>assets/admin/vendor/codemirror/addon/comment/comment.js"></script>

<!-- FOLDING -->
<script src="<?php echo base_url()?>assets/admin/vendor/codemirror/addon/fold/foldcode.js"></script>
<script src="<?php echo base_url()?>assets/admin/vendor/codemirror/addon/fold/foldgutter.js"></script>
<script src="<?php echo base_url()?>assets/admin/vendor/codemirror/addon/fold/brace-fold.js"></script>

<!-- SEARCH -->
<script src="<?php echo base_url()?>assets/admin/vendor/codemirror/addon/dialog/dialog.js"></script>
<script src="<?php echo base_url()?>assets/admin/vendor/codemirror/addon/search/searchcursor.js"></script>
<script src="<?php echo base_url()?>assets/admin/vendor/codemirror/addon/search/search.js"></script>

<!-- MODES -->
<script src="<?php echo base_url()?>assets/admin/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="<?php echo base_url()?>assets/admin/vendor/codemirror/mode/xml/xml.js"></script>
<script src="<?php echo base_url()?>assets/admin/vendor/codemirror/mode/javascript/javascript.js"></script>
<script src="<?php echo base_url()?>assets/admin/vendor/codemirror/mode/css/css.js"></script>
<script src="<?php echo base_url()?>assets/admin/vendor/codemirror/mode/clike/clike.js"></script>
<script src="<?php echo base_url()?>assets/admin/vendor/codemirror/mode/php/php.js"></script>
<script src="<?php echo base_url()?>assets/admin/vendor/codemirror/keymap/sublime.js"></script>

<div class="row page-titles">
    <div class="col-md-12">
        <h3 class="text-themecolor">Templates <span class="selected_file text-success"></span></h3>
    </div>

</div>
<?php
if (isset($view) && $view == true){
    ?>
<div class="row m-b-5">

    <div class="col-lg-9">

        <div class="card">
            <div class="card-body">
                <div class="alert alert-info small">It is advisable to copy the current code to a text editor/notepad because after saving, changes will not revert to last version.</div>
                <textarea id="editor" style="min-height: 500px;"></textarea>
                <br/>
                <a href="#" class="btn btn-success float-right btn_save w-100 font-bold">Save changes</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h3>Template files</h3>
                <ul>
                    <li><a href="#" class="btn_load_file" data-file="style.css">style.css</a></li>
                    <?php
                    foreach($templates as $file){
                        ?>
                        <li><a href="#" class="btn_load_file" data-file="<?=$file?>"><?=$file?></a></li>
                        <?php
                    }
                    ?>
                </ul>

            </div>
        </div>
    </div>
</div>



<script>
    $(function(){
        let cm = CodeMirror.fromTextArea(document.getElementById("editor"), {
            lineNumbers: true,
            matchBrackets: true,
            indentUnit: 4,
            indentWithTabs: true,
            theme: "monokai",
            keyMap: "sublime",
        });

        cm.setSize(null, 500);

        $('body').on('click', '.btn_load_file', function(e){
            e.preventDefault();

            var filename = $(this).attr('data-file')
            $('.selected_file').text(' - ' + filename);
            $.ajax({
                type: 'post',
                url: '<?php echo base_url() ?>' + 'themes/read/' + filename,
                dataType: 'text',
                contentType: 'text/plain',
                crossDomain: true,
                headers: {'X-Requested-With': 'XMLHttpRequest'},
                success: function(res){
                    $('textarea#editor').data('filename', filename)
                    $('textarea#editor').val(res)

                    config = {
                        lineNumbers: true,
                        matchBrackets: true,
                        indentUnit: 4,
                        indentWithTabs: true,
                        theme: "monokai",
                        keyMap: "sublime",
                    }

                    // remove existing CodeMirror editor
                    $('.CodeMirror').remove()

                    if( filename.indexOf('.php') >= 0 ){
                        config['mode'] = "application/x-httpd-php"
                    }
                    else if( filename.indexOf('.css') >= 0 ){
                        config['mode'] = "css"
                    }
                    else if( filename.indexOf('.js') >= 0 ){
                        config['mode'] = "javascript"
                    }

                    CodeMirror.fromTextArea( document.getElementById("editor"), config )
                        .on('change', editor => {
                            editor.save()
                        })

                }
            })
        })


        $('body').on('click', '.btn_save', function(e){
            e.preventDefault();

            var filename = $('textarea#editor').data('filename')
            var text 	 = $('textarea#editor').val()

            $.ajax({
                type: 'post',
                url: '<?php echo base_url() ?>' + 'themes/write',
                data: { file: filename, text: text },
                crossDomain: true,
                headers: {'X-Requested-With': 'XMLHttpRequest'},
                error: function(error){
                    console.log('error')
                    console.log(error)
                },
                success: function(res){
                    Swal.fire("Success!", "Changes successfully saved!", "success");
                }
            })
        })
    })
</script>


<style type="text/css">
    .CodeMirror {
        font-size: 14px;
        height: 700px;
    }
</style>

    <?php
}else {
    ?>
    <div class="alert alert-danger">
        <h3>Access denied!</h3>
       <p>It seems that your are not allowed to access this page. Please contact system administrator.</p>
    </div>
    <?php
}
?>
