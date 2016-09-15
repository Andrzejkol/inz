<div class="row">

   
    <div class="col-md-12 main_content">
        <div id="main_content" <?php
        if (!empty($content_class_main)) {
            echo $content_class_main;
        }
        ?>>
                 <?php
                 if (!empty($main_content)) {

                   /*  if (!empty($vBreadcrumbs)) {
                         echo $vBreadcrumbs;
                     }*/
                     echo $main_content;
                 }
                 ?>
        </div>
    </div>
   
</div>