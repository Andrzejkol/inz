<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
    <head>
        <title><?php echo!empty($title) ? $title : ''; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?php echo!empty($descriptionTag) ? $descriptionTag : ''; ?>"/>
        <meta name="keywords" content="<?php echo!empty($keywordsTag) ? $keywordsTag : ''; ?>"/>
        <script type="text/javascript">
            //<![CDATA[
            var urlBase = '<?php echo url::base(); ?>';
            //]]>
        </script>
        <?php echo html::stylesheet('js/jquery-ui-1.8.21.custom/css/smoothness/jquery-ui-1.8.21.custom.css'); ?>
        <?php echo html::stylesheet('js/ref/bootstrap/css/bootstrap.css'); ?>
        <?php echo html::stylesheet('css/admin_default/admin_default.css'); ?>
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>        
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
       <?php echo html::script('js/jquery-1.7.2.min.js') ?>
        <?php echo html::script('js/jquery-ui-1.8.21.custom/js/jquery-ui-1.8.21.custom.min.js') ?>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <?php echo html::script('js/tinymce/js/tinymce/tinymce.min.js'); ?>               
        <?php echo html::script('js/jscolor/jscolor.js'); ?>  
        <?php echo html::script('js/ref/multiselectable.js'); ?> 
        <?php echo html::script('js/admin.js'); ?>
        
        <?php /*
          <script type="text/javascript" src="<?php echo url::base(); ?>js/tiny_mce_jq/plugins/tinybrowser/tb_tinymce.js.php"></script> */ ?>
        <script type="text/javascript">
            tinymce.init({
            	mode : "specific_textareas",
                editor_selector : "tinyText",                			    
                language : 'pl',
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen textcolor",
                    "insertdatetime media table contextmenu paste filemanager colorpicker"
                ],
				rel_list: [
                    {title: 'Zdj�cie', value: 'prettyPhoto'},
                ],
                convert_urls: false,
                relative_urls: false,
                document_base_url : "<?php echo url::base(true, 'http');?>",
                toolbar: "insertfile undo redo | bold italic | fontsizeselect forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                image_advtab: true,
                height : 250,   
				fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
                external_filemanager_path:urlBase+"js/filemanager/",
                filemanager_title:"Responsive Filemanager" ,
                external_plugins: { "filemanager" : urlBase+"js/filemanager/plugin.min.js"},
                content_css: urlBase+"css/default/default.css?" + new Date().getTime(),
                style_formats: [
        			{title: 'Headers', items: [
        			    {title: 'h1', block: 'h1'},
        			    {title: 'h2', block: 'h2'},
        			    {title: 'h3', block: 'h3'},
        			    {title: 'h4', block: 'h4'},
        			    {title: 'h5', block: 'h5'},
        			    {title: 'h6', block: 'h6'}
        			]},
					
        			{title: 'Blocks', items: [
        			    {title: 'p', block: 'p'},
        			    {title: 'div', block: 'div'},
        			    {title: 'pre', block: 'pre'}
        			]},
        			
        			{title: 'Custom', items: [
        				{title: 'Smaller', inline: 'span', classes: 'smaller'},
        				{title: 'Small', inline: 'span', classes: 'small'},
        				{title: 'Big', inline: 'span', classes: 'big'},
        				{title: 'Bigger', inline: 'span', classes: 'bigger'}
        			]}

        		]
            });         

            
        </script>        
    </head>
    <body>
        <div id="container">
            <div id="header">
                <?php echo!empty($header) ? $header : ''; ?>
            </div>
            <div id="content_wrapper">
                <?php echo!empty($content) ? $content : ''; ?>
            </div>
            <div id="footer">
                <?php echo!empty($footer) ? $footer : ''; ?>
            </div>
        </div>
    </body>
</html>