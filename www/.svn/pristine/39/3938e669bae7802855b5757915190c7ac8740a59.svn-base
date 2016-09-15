<?php if(!empty($message)) { echo $message; } ?>
<?php if(!empty($msg)) { echo $msg; } ?>
<?php if(!empty($vBreadcrumbs)) { echo $vBreadcrumbs; } ?>
<?php if(!empty($vSorting)) { echo $vSorting; } ?>
<?php if(!empty($vBasketBreadcrumb)) { echo $vBasketBreadcrumb; } ?>
<?php //if(!empty($vAdvSearch)) { echo $vAdvSearch; } ?>
<?php if(!empty($vContent)) { echo $vContent; } ?>
<?php if(!empty($vProductDetails)) { echo $vProductDetails; } ?>
<?php if(!empty($vCustomer)) { echo $vCustomer; } ?>
<?php if(!empty($vProductListing)) { echo $vProductListing; } ?>
<?php if(!empty($vAllProductListing)) { echo $vAllProductListing; } ?>

<?php if(!empty($vProductFavourite)) { echo $vProductFavourite; } ?>
<?php if(!empty($vPaginationBottom)) { echo $vPaginationBottom; } ?>
<?php if(!empty($most_purchased)) : ?>
<div id="most_purchased">
    <h2><?php echo Kohana::lang('app.also_recommend'); ?></h2>
    <div id="products">
        <?php echo $most_purchased; ?>
    </div>
</div>
<?php endif; ?>
<?php if(!empty($vSeeProduct)) {
			
		
			 if(Kohana::lang('links.lang') == 'en/'){
            echo '<h4><span class="cufon_chapa">'.html::anchor("en/".Kohana::lang('links.recommended'), Kohana::lang('app.recommend')).'</span></h4>';
    }
    else {
            echo '<h4><span class="cufon_chapa">'.html::anchor(Kohana::lang('links.recommended'), Kohana::lang('app.recommend')).'</span></h4>';
 } 
			echo $vSeeProduct; 
        }
        ?>
<?php if(!empty($oRecentlyVievedProducts)) { echo '<h3>OSTATNIO OGLĄDANE</h3>'.$oRecentlyVievedProducts; } ?>
<?php if(!empty($oAlsoLiked)) { echo $oAlsoLiked; } ?>