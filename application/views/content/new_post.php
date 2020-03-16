<script src="<?=base_url()?>assets/vendors/ckeditor/build/ckeditor.js"></script>
<!-- BEGIN: Content-->
<div class="app-content content" style="max-width: 1200px; margin: 60px auto 0;">
    <div class="content-wrapper pt-0">
        <div class="content-header row">
        </div>
        <div class="content-body">           
            <!--Content -->
            <div class="row">
                <div class="col-12" style="margin-bottom: 10px!important;">                            
                    <div style="padding: 0 10px 10px !important;">
                        <div style="padding: 10px!important;">                                    
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="pt-1 pb-0">                                      
                        <h2 class="text-bold-500 black">Create a post</h2>     
                        <hr/>                         
                    </div>
                    <?php
                    if (isset($user["username"])) {
                    ?>
                    <div class="card rounded">                      
                        <div class="card-content">
                            <div class="card-body p-1">
                                <form method="post" id="frmPost">   
                                    <input type="text" class="form-control mb-1" name="title" placeholder="Title" autofocus>                                 
                                    <textarea name="post" id="editor" class="form-control mb-1"></textarea>
                                    <input type="submit" class="btn bg-blue white btn_do_post pull-right mb-2 btn-min-width mt-1" value="POST">
                                    <a class="btn btn-outline-primary pull-right mb-2 btn-min-width mt-1 mr-1">CANCEL</a>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php
                    }

                    ?>
                   
                </div>
                <div class="col-lg-4">
                    <div class="card rounded">                       
                        <div class="card-content">
                            <h4 class="p-1 text-bold-500 mb-0 black">Latest</h4>
                            <ul class="list-group list-group-flush">                               
                            <?php
                            foreach($latest as $topic){
                            ?>
                                <li class="list-group-item">
                                    <a href="<?=base_url()?>posts/view/<?=$topic["slug"]?>" class="blue-grey">
                                        <h5 class="m-0"><?=$topic["title"]?></h5>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                            </ul>
                            <a href="" class="btn bg-blue white text-bold-700 d-block m-1">VIEW ALL</a>
                                           
                        </div>
                    </div>

                    <div class="card rounded">                       
                        <div class="card-content">                           
                            <h4 class="p-1 text-bold-500 mb-0 black"><i class="ft-trending-up"></i>&nbsp;Trending</h4>
                            <ul class="list-group list-group-flush">     
                            <?php
                            foreach($trending as $topic){
                            ?>
                                 <li class="list-group-item">
                                    <a href="<?=base_url()?>posts/view/<?=$topic["slug"]?>" class="blue-grey">
                                        <h5 class="m-0"><?=$topic["title"]?></h5>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                            </ul>                           
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>
<!-- END: Content-->

<script>
   

        //  CKEDITOR.replace('editor', {
        //     // Define the toolbar: http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_toolbar
        //     // The full preset from CDN which we used as a base provides more features than we need.
        //     // Also by default it comes with a 3-line toolbar. Here we put all buttons in a single row.
        //     toolbar: [              
        //         { name: 'styles', items: ['Format'] },
        //         { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting'] },
              
        //         { name: 'links', items: ['Link', 'Unlink'] },
        //         { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Blockquote'] },
        //         { name: 'insert', items: ['Image', 'Table'] },
            
        //     ],
        //     // Since we define all configuration options here, let's instruct CKEditor to not load config.js which it does by default.
        //     // One HTTP request less will result in a faster startup time.
        //     // For more information check http://docs.ckeditor.com/ckeditor4/docs/#!/api/CKEDITOR.config-cfg-customConfig
        //     customConfig: '',
        //     // Sometimes applications that convert HTML to PDF prefer setting image width through attributes instead of CSS styles.
        //     // For more information check:
        //     //  - About Advanced Content Filter: http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_advanced_content_filter
        //     //  - About Disallowed Content: http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_disallowed_content
        //     //  - About Allowed Content: http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_allowed_content_rules
        //     disallowedContent: 'img{width,height,float}',
        //     extraAllowedContent: 'img[width,height,align]',
        //     // Enabling extra plugins, available in the full-all preset: http://ckeditor.com/presets-all
        //     extraPlugins: 'tabletools,tableresizerowandcolumn,base64image,uploadimage', 
        //     removePlugins: 'elementspath',
        //     resize_enabled: false,
        //     //sourcedialog
        //     /*********************** File management support ***********************/
        //     // In order to turn on support for file uploads, CKEditor has to be configured to use some server side
        //     // solution with file upload/management capabilities, like for example CKFinder.
        //     // For more information see http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_ckfinder_integration
        //     // Uncomment and correct these lines after you setup your local CKFinder instance.
        //     // filebrowserBrowseUrl: 'http://example.com/ckfinder/ckfinder.html',
        //     // filebrowserUploadUrl: 'http://example.com/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        //     /*********************** File management support ***********************/
        //     // Make the editing area bigger than default.
        //     height: (200),
        //     // An array of stylesheets to style the WYSIWYG area.
        //     // Note: it is recommended to keep your own styles in a separate file in order to make future updates painless.
        //     contentsCss: ['<?=base_url()?>assets/vendors/ckeditor/contents.css', ''],
        //     // This is optional, but will let us define multiple different styles for multiple editors using the same CSS file.
        //     bodyClass: 'document-editor',
        //     // Reduce the list of block elements listed in the Format dropdown to the most commonly used.
        //     format_tags: 'p;h1;h2;h3;pre',
        //     // Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
        //     removeDialogTabs: 'image:advanced;link:advanced',

        //     enterMode: CKEDITOR.ENTER_P,
        //     autoParagraph: false,
        //     tabSpaces: 6,
        //     // Define the list of styles which should be available in the Styles dropdown list.
        //     // If the "class" attribute is used to style an element, make sure to define the style for the class in "mystyles.css"
        //     // (and on your website so that it rendered in the same way).
        //     // Note: by default CKEditor looks for styles.js file. Defining stylesSet inline (as below) stops CKEditor from loading
        //     // that file, which means one HTTP request less (and a faster startup).
        //     // For more information see http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_styles

        //     stylesSet: [
        //         /* Inline Styles */
        //         { name: 'Marker', element: 'span', attributes: { 'class': 'marker' } },
        //         { name: 'Cited Work', element: 'cite' },
        //         { name: 'Inline Quotation', element: 'q' },
        //         /* Object Styles */
        //         {
        //             name: 'Special Container',
        //             element: 'div',
        //             styles: {
        //                 padding: '5px 10px',
        //                 background: '#eee',
        //                 border: '1px solid #ccc'
        //             }
        //         },
        //         {
        //             name: 'Compact table',
        //             element: 'table',
        //             attributes: {
        //                 cellpadding: '5',
        //                 cellspacing: '0',
        //                 border: '1',
        //                 bordercolor: '#ccc'
        //             },
        //             styles: {
        //                 'border-collapse': 'collapse'
        //             }
        //         },
        //         { name: 'Borderless Table', element: 'table', styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA', 'border-collapse': 'collapse' } },
        //         { name: 'Square Bulleted List', element: 'ul', styles: { 'list-style-type': 'square' } },

        //     ]
        // });

        // CKEDITOR.customConfig
       

    $(function(){       

        let editor;

ClassicEditor
    .create( document.querySelector( '#editor' ), {				
        toolbar: {
            items: [
                'heading',
                '|',
                'bold',
                'italic',
                'link',
                'bulletedList',
                'numberedList',
                '|',
                'indent',
                'outdent',
                '|',
                'blockQuote',
                'insertTable',
                'mediaEmbed',
                'imageUpload'
            ]
        },
        language: 'en',
        image: {
            toolbar: [
                'imageTextAlternative',
                'imageStyle:full',
                'imageStyle:side'
            ]
        },
        table: {
            contentToolbar: [
                'tableColumn',
                'tableRow',
                'mergeTableCells'
            ]
        },
        licenseKey: '',
        
    } )
    .then( editor => {
        window.editor = editor;
        editor = editor;
    } )
    .catch( error => {
        console.error( error );
    } );

        $('#frmPost').on('submit', function(e){
            e.preventDefault();
            e.stopPropagation();

            //console.log(CKEDITOR.instances.editor.getData());

            let data = {
                title: $('input[name="title"]').val(),
                post: $('textarea[name="post"]').val()
            };
            let url = '<?=base_url()?>index.php/posts/create';

            ajax(url, data).done(function(results){
                if (results.message == "success"){
                    //reload here
                    window.location.href = '<?=base_url()?>' + 'posts/view/' + results.slug;
                }else{
                    swal("Oh snap!", results.message, "error");
                }
            })
        })
    })
</script>