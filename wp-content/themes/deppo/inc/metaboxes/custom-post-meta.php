<?php

$prefix = 'deppo_';

$meta_boxes = array(

    // POST TYPE POST
    array(
        'id' => 'deppo_post_meta1',
        'title' => __('Project Background Color', 'deppo'),
        'pages' => array('jetpack-portfolio'), // multiple post types
        'context' => 'side',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Color','deppo'),
                'desc' => '',
                'id' => $prefix . 'portfolio_bg_color',
                'type' => 'colorpicker',
                'std'  => ''
            ),
        )
    ),

    // POST TYPE POST
    array(
        'id' => 'deppo_post_meta2',
        'title' => __('Show/Hide Page Title', 'deppo'),
        'pages' => array('page'), // multiple post types
        'context' => 'side',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Show Title','deppo'),
                'desc' => '',
                'id' => $prefix . 'page_title',
                'type' => 'checkbox',
                'std' => ''
            ),
        )
    ),
);

foreach ($meta_boxes as $meta_box) {
    $my_box = new deppo_meta_box($meta_box);
}


class deppo_meta_box {

    protected $_meta_box;

    // create meta box based on given data
    function __construct($meta_box) {
        $this->_meta_box = $meta_box;
        add_action('admin_menu', array(&$this, 'add'));

        add_action('save_post', array(&$this, 'save'));
    }

    /// Add meta box for multiple post types
    function add() {
        foreach ($this->_meta_box['pages'] as $page) {
            add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
        }
    }

    // Callback function to show fields in meta box
    function show() {
        global $post;

        // Use nonce for verification
        echo '<input type="hidden" name="deppo_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

        echo '<table class="form-table">';

        foreach ($this->_meta_box['fields'] as $field) {
            // get current post meta data
            $meta = get_post_meta($post->ID, $field['id'], true);

            if ($field['type'] != 'annotated_timeline') {
                echo '<tr>',
                '<th style=""><label class="screen-reader-text" for="' . $field['id'] . '">' . $field['name'] . '</label>';
            } else {

            }

            switch ($field['type']) {

                case 'annotated_timeline' :
                    if (isset($_GET['post'])) {
                        echo '<tr><td><div class="period_selector">',
                        '<a id="selector_seven_days" href="javascript:updateChart(\'' . urlencode(site_url()) . '\', ' . $_GET['post'] . ', 7)">Last 7 Days</a>',
                        '<a href="javascript:updateChart(\'' . urlencode(site_url()) . '\', ' . $_GET['post'] . ', 30)">Last 30 Days</a>',
                        '<a href="javascript:updateChart(\'' . urlencode(site_url()) . '\', ' . $_GET['post'] . ', 365)">Last Year</a>',
                        '<a href="javascript:updateChart(\'' . urlencode(site_url()) . '\', ' . $_GET['post'] . ', 0)">All Time</a>',
                        '</div><div class="banner-chart" style="width:100%; height:300px"></div></td></tr>';'<script></script>';
                    }
                    break;

                case 'text':
                    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $meta, '" size="30" style="width:97%" />',
                        '<br />', $field['desc'];

                    if($field['id'] == 'deppo_number_beds') { echo '<p style="color:red;">Required Field</p>'; }

                    if($field['id'] == 'deppo_room_price_adult') { echo '<p style="color:red;">Numbers Only</p>'; }
                    break;

                case 'plaintextarea':
                    echo '<textarea name="' . $field['id'] . '" id="' . $field['id'] . '" rows="10" cols="40">'.$meta.'</textarea>';
                    break;

                case 'textarea':

                    wp_editor( $meta ? $meta : $field['std'], $field['id'], $settings = array('media_buttons' => false, 'textarea_rows' => '5'  ) );

                    break;

                case 'select':
                    echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                    foreach ($field['options'] as $option) {
                        echo '<option', $meta == $option ? ' selected="selected"' : '', ' value="'.$option.'">', $option, '</option>';
                    }
                    echo '</select></br>';
                    echo '<span class="description">'.$field['desc'].'</span>';
                    break;

                case 'category':
                    if($field['taxonomy'] == ''){$field['taxonomy'] = 'category';}
                    $args = array(
                        'selected' => $meta,
                        'echo' => 1,
                        'taxonomy' => $field['taxonomy'],
                        'name' => $field['id']);
                    wp_dropdown_categories($args);
                    break;

                case 'radio':
                    foreach ($field['options'] as $option) {
                        echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                    }
                    break;

                case 'checkbox':
                    echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />', $field['name'];
                    break;



                    case 'select-sidebar':
                    global $wp_registered_sidebars;
                    echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                    $i = 1;

                    if(get_post_type() == 'post') {
                        echo '<option value="none">None</option>';
                    }


                    foreach ($wp_registered_sidebars as $sidebar) {
                            if($sidebar['name'] !== 'Footer Widget '.$i){

                                echo '<option', $meta == $sidebar['name'] ? ' selected="selected"' : '', ' value="' . $sidebar['name'] . '">', $sidebar['name'], '</option>';
                            }
                        $i++;
                    }
                    echo '</select></br>';
                    echo '<span class="description">' . $field['desc'] . '</span>';
                    break;



                case 'imageupload':
                      echo '<input type="text"  class="upload-url"  name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $meta, '" size="30"  />',
                        '<input id="st_upload_button" style="margin-left:15px;" class="st_upload_button" type="button" name="upload_button" value="Upload" />
                            </label>
                            ';
                    break;

                // repeatable
                case 'repeatable':
                    echo '<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
                    $i = 0;

                    if ($meta) {
                        foreach($meta as $row) {  if($i==0) {$display = 'style="display:none"';} else { $display='';}
                            echo '<li><span class="sort hndle"><img  src="'.get_template_directory_uri().'/style/img/drag_arrow.png" /></span>
                                        <input type="text"  class="upload-url"  name="'.$field['id'].'['.$i.']" id="'.$field['id'].'"  id="'.$field['id'].'" value="'.$row.'" size="30" style="width:77%" />
                                        <input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload" />
                                        <a class="repeatable-remove button check'.$i.'" rel="'.$i.'" style="display:none;" href="#">-</a></li>';
                            $i++;
                        }
                    } else {
                        echo '<li><span class="sort hndle"><img  src="'.get_template_directory_uri().'/style/img/drag_arrow.png" /></span>
                                        <input type="text"  class="upload-url"  name="'.$field['id'].'['.$i.']" id="'.$field['id'].'"  id="'.$field['id'].'" size="30" style="width:77%" />
                                        <input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload" />
                                        <a class="repeatable-remove button check'.$i.'" rel="'.$i.'" style="display:none;" href="#">-</a></li>';
                    }
                    echo '</ul>
                        <span class="description">'.$field['desc'].'</span>';
                    echo '<a class="repeatable-add button" href="#">+</a> Click to add another meta box';
                break;



                case 'colorpicker':
                    echo '
                        <input id="' . $field['id'] . '" name="' . $field['id'] . '" type="text"  class="color color-field" value="', $meta ? $meta : $field['std'] , '" size="10"/>',
                        ' ', $field['desc'];?>
                        <script type="text/javascript">
                            jQuery(document).ready(function(){
                                jQuery('#button_<?php echo $field['id']?>').live('click', function(){
                                    jQuery('#<?php echo $field['id']?>').val('<?php echo $field['value']?>');
                                })
                            })
                        </script>
                    <?php break;



            }
            echo     '<th>',
                '</tr>';
        }

        echo '</table>';
    }

    // Save data from meta box
    function save($post_id) {
        // verify nonce
        if(!empty($_POST['deppo_meta_box_nonce'])){
                if (!wp_verify_nonce($_POST['deppo_meta_box_nonce'], basename(__FILE__))) {
                    return $post_id;
                }

            // check autosave
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return $post_id;
            }

            // check permissions

            if(isset($_POST['post_type'])) {
                if ('page' == $_POST['post_type']) {
                    if (!current_user_can('edit_page', $post_id)) {
                        return $post_id;
                    }
                } elseif (!current_user_can('edit_post', $post_id)) {
                    return $post_id;
                }
            }
            foreach ($this->_meta_box['fields'] as $field) {
                $old = get_post_meta($post_id, $field['id'], true);
                @$new = $_POST[$field['id']];

                if ($new && $new != $old) {
                    update_post_meta($post_id, $field['id'], $new);
                } elseif ('' == $new && $old) {
                    delete_post_meta($post_id, $field['id'], $old);
                }
            }
        }
    }
}

?>
