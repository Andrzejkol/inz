<div id="adminPartnersList">
    <?php echo (!empty($msg)) ? $msg : ''; ?>
    <div class="options">
        <h5><?php echo Kohana::lang('admin.partners.partners'); ?></h5>
        <?php echo html::anchor('4dminix/dodaj_partnera', html::image('img/admin_default/newobject.gif', array('alt' => Kohana::lang('partners.add_partner'), 'class' => 'add_button', 'id' => 'add_news_button'))); ?>
        <?php echo html::anchor('4dminix/dodaj_partnera', Kohana::lang('admin.partners.add_partner'), array('class' => 'add_text', 'id' => 'add_news_button')); ?>
    </div>
    <?php if (!empty($oPartners) && $oPartners->count() > 0) { ?>
        <div id="news_table">
            <?php echo form::open('4dminix/usun_partnera'); ?>        
            <table id="news_list" class="table_view">
                <tr>
                    <th><input type="checkbox" name="partners_check_all" id="news_category_check_all" class="check_all" value="1" /></th>
                    <th>#</th>
                    <th><?php echo Kohana::lang('news.title'); ?></th>                
                    <th><?php echo Kohana::lang('news.add_date'); ?></th>
                    <th><?php echo Kohana::lang('news.modified_date'); ?></th>
                    <th><?php echo Kohana::lang('news.available'); ?></th>
                    <th><?php echo Kohana::lang('news.options'); ?></th>
                </tr>
                <?php
                foreach ($oPartners as $p) {
                    ?>
                    <tr>
                        <td><input type="checkbox" name="partners_check[]" class="check" value="<?php echo $p->id_partner; ?>" /></td>
                        <td><?php echo $p->id_partner; ?></td>
                        <td><?php echo html::anchor(('4dminix/edytuj_partnera/' . $p->id_partner), $p->name); ?></td>
                        <td><?php echo date(config::DATE_FORMAT, $p->date_added); ?></td>
                        <td><?php echo (!empty($p->modified_date)) ? date(config::DATE_TIME_FORMAT, $p->modified_date) : '-'; ?></td>
                        <td><?php
                            if (!empty($p->available)) {
                                echo html::image('img/icons/' . (($p->available == 'Y') ? ('tick.png') : ('cross.png')), array('alt' => Kohana::lang('news.available_true')));
                            } else {
                                echo html::image('img/icons/cross.png', array('alt' => Kohana::lang('admin.partners.available_false')));
                            }
                            ?></td>
                        <td>
                          
							<?php echo html::anchor('4dminix/edytuj_partnera/'.$p->id_partner, Kohana::lang('admin.edit'), array('title' =>Kohana::lang('admin.edit'), 'class' => 'btn btn-edit'));  ?>
							
							<?php echo html::anchor('4dminix/usun_partnera/'.$p->id_partner, Kohana::lang('admin.delete'), array('title' =>Kohana::lang('admin.delete'), 'class' => 'btn btn-delete'));  ?>
									
                        </td>
                    </tr>

                    <?php
                }
                ?>
            </table>
            <div class="delete_selected">
                <?php echo Kohana::lang('news.selected'); ?>: 
				
				<button name="delete_news" value="1" class="btn btn-delete"><?php echo Kohana::lang('admin.delete'); ?></button>
            </div>
            <?php echo form::close(); ?>
            <?php
            //echo $pagination;
            ?>
        </div>
    <?php } else { ?>
        <div class="info"><?php echo Kohana::lang('admin.partners.empty_partners'); ?></div>
    <?php } ?>
    <div id="form_action"></div>
</div>