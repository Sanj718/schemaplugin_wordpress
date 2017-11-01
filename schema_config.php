<?php
require_once "style.php";
require_once "schema_form.php";
class Config{
    public function __construct(){
        Form::savetoDB();
    }
}

?>

<?php  $config = new Config; ?>
<div class="config">
    <h2 style="text-align: left">Configuration</h2>
    <?php
        Form::openForm("schema-config-form");
        Form::radio("schema_location", "single", "Single location: ", array("type"=>"radio"));
        Form::radio("schema_location", "multi", "Multiple location:  ", array("type"=>"radio"),"multiclass");
        Form::inputCreate("schema_locnumber", "How many locations?: ", array("type"=>"number", "size"=>"10"), "numberoflocations");
        echo "<hr>";
    echo "<strong style='font-size: 17px;'>Please select checkbox if you want Individual Schema: </strong>";
    Form::checkbox("schema_individual", "none", "None of them: ", array("type"=>"checkbox"), "schema_individual");
    ?>
    <div class="pages">
    <?php
    echo "<p><strong style='font-size: 16px; color: #FF5722;'>Pages</strong></p>";
    $pages = get_pages();
    foreach ( $pages as $page ) {
        Form::checkbox("schema_individual[]", "$page->ID", "$page->post_title: ", array("type"=>"checkbox"), "schema_individual");
    }
    ?>
    </div>
    <div class="customposts">
    <?php
    $posts = get_post_types();
    $customposts = array();
    foreach ( $posts as $post ) {
        if ($post != "post" && $post != "page" && $post != "attachment" && $post != "revision" && $post != "nav_menu_item" && $post != "custom_css" && $post != "customize_changeset" &&
            $post != "acf-field-group" && $post != "acf-field" && $post != "vc_grid_item" && $post != "amn_mi-lite"){
            $customposts[] = $post;
        }
    }

    foreach ($customposts as $cust){
        $args = array('post_type' => $cust,'orderby' => 'menu-order','order' => 'ASC','posts_per_page' => -1);
        $loop = new WP_Query($args);
        if ( $loop->have_posts()){
        echo "<p><strong style='text-transform: capitalize;font-size: 16px; color: #FF9800;'>".$cust."</strong></p>";
        while ($loop->have_posts()) : $loop->the_post();
            $title = get_the_title(); $id = get_the_ID();
            Form::checkbox("schema_individual[]", "$id", "$title: ", array("type"=>"checkbox"), "schema_individual");
        endwhile; wp_reset_query();
        echo "<hr>";}
    }
    ?></div><?php
    Form::submitbutton("schema_submit", "schsubmit", "Save");
    Form::closeForm();
    ?>
</div>
<div class="config-pages">
    <?php /*
        echo "<strong>Please select checkbox if you want Individual Schema: </strong>";
        Form::openForm("schema-config-form2");
        Form::checkbox("schema_individual", "none", "None of them: ", ["type"=>"checkbox"], "schema_individual");
        $pages = get_pages();
        foreach ( $pages as $page ) {
            Form::checkbox("schema_individual[]", "$page->ID", "$page->post_title: ", ["type"=>"checkbox"], "schema_individual");
        }

        Form::submitbutton("schema_config_submit", "schsubmit", "Save");
        Form::closeForm();
    */ ?>
</div>