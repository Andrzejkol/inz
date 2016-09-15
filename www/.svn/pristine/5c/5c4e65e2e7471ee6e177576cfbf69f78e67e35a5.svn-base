<div id="admin_page_content_view">    
    <div class="options">
        <h5><?php echo Kohana::lang('admin.page_content.title'); ?></h5>
        <?php
        if (User_Model::IsAllowed($_SESSION['_acl'], 'page_content', 'add')->Value == true) {
            echo html::anchor('4dminix/dodaj_zawartosc_strony', html::image('img/admin_default/newobject.gif', array('alt' => 'Dodaj treść strony', 'class' => 'add_button')));
            echo html::anchor('4dminix/dodaj_zawartosc_strony', Kohana::lang('admin.page_content.add'), array('class' => 'add_text'));
        }
        ?>
    </div>
    <?php if (!empty($page_content) && $page_content->count() > 0) { ?>
        <?php echo form::open('4dminix/usun_zawartosc_strony/'); ?>

        <table id="page_content_list" class="table_view">
            <tr>
                <th><input type="checkbox" name="page_content_check_all" id="check_all_news" class="check_all" value="1" /></th>
                <th>
                    <?php
                    echo Kohana::lang('admin.title');
                    layer::GetSort('content_orderby', 1, 2, '/4dminix/zawartosc_strony');
                    ?>
                </th>
                <th>
                    <?php
                    echo Kohana::lang('admin.page_content.name');
                    layer::GetSort('content_orderby', 3, 4, '/4dminix/zawartosc_strony');
                    ?>
                </th>
                <th>
                    <?php
                    echo Kohana::lang('admin.lang');
                    layer::GetSort('content_orderby', 5, 6, '/4dminix/zawartosc_strony');
                    ?>
                </th>
                <th>
                    <?php
                    echo Kohana::lang('admin.add_date');
                    layer::GetSort('content_orderby', 7, 8, '/4dminix/zawartosc_strony');
                    ?>
                </th>
                <th><?php echo Kohana::lang('admin.options'); ?></th>
            </tr>
            <?php
            $temp = array();
            //$page_content2 = clone($page_content);
            foreach ($page_content as $pc) {
                if (!in_array($pc->element_id, $temp)) {
                    array_push($temp, $pc->element_id);
                    ?>
                    <tr>
                        <td><input type="checkbox" name="page_content_check[]" class="check" value="<?php echo $pc->element_id; ?>" /></td>
                        <td><?php echo $pc->title; ?></td>
                        <td><small>
                                <?php
                                for ($i = 0; $i < sizeof($page_content2); $i++) {
                                    if ($page_content2[$i]->element_id == $pc->element_id) {
                                        echo "(" . $page_content2[$i]->name_page . ") ";
                                    }
                                }
                                ?>
                            </small></td>
                        <td><?php echo Kohana::lang('language.' . $pc->description); ?></td>
                        <td><?php echo date(config::DATE_FORMAT, $pc->element_date_added); ?></td>
                        <td>
                            <?php
                            if (User_Model::IsAllowed($_SESSION['_acl'], 'page_content', 'edit')->Value == true) {
                                echo html::anchor('4dminix/edytuj_zawartosc_strony/' . $pc->id_page_content, Kohana::lang('admin.edit'), array('title' => Kohana::lang('admin.edit'), 'class' => 'btn btn-edit'));
                            }
                            if (User_Model::IsAllowed($_SESSION['_acl'], 'page_content', 'delete')->Value == true) {
                                echo html::anchor('4dminix/usun_zawartosc_strony/' . $pc->element_id, Kohana::lang('admin.delete'), array('class' => 'btn btn-delete', 'title' => Kohana::lang('admin.delete_info')));
                            }
                            ?>                
                        </td>
                    </tr>

            <?php
        }
    } //var_dump($temp); // Tutaj sie konczy forach
    ?>
        </table>
        <div class="delete_selected">
            <?php if (User_Model::IsAllowed($_SESSION['_acl'], 'page_content', 'delete')->Value == true) {
                echo Kohana::lang('admin.selected');
                ?>:     		
                <button name="delete_pages" value="1" class="btn btn-delete"><?php echo Kohana::lang('admin.delete'); ?></button>			

        <?php } ?>
        </div>
    <?php echo form::close(); ?>
<?php } else { ?>
        <div class="info"><?php echo Kohana::lang('admin.page_content.no_page_content'); ?></div>
<?php } ?>
<?php echo $oPagination; ?>
</div>
