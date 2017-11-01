<?php
require_once "style.php";
require_once "schema_form.php";
class Admin{
    public function __construct(){
        Form::savetoDB();
    }
}

?>
<div class="formdiv">
    <h2>General Schema</h2>
        <?php
        $form = new Admin;
        Form::openForm();
        Form::inputCreate("schema_url", "Site Url: ", array("type"=>"text", "size"=>"50"));
        Form::inputCreate("schema_name", "Site Name: ", array("type"=>"text", "size"=>"50"));
        Form::inputCreate("schema_logo", "Site Logo: ", array("type"=>"text", "size"=>"50"));
        Form::textarea("schema_socials", "Social Links: ", array("rows"=>"5", "cols"=>"52"));
        Form::inputCreate("schema_city", "City: ", array("type"=>"text", "size"=>"50"));
        $states = array("Alaska","Alabama","Arkansas","American Samoa","Arizona","California","Colorado","Connecticut",
            "District of Columbia","Delaware","Florida","Georgia","Guam","Hawaii","Iowa","Idaho","Illinois","Indiana",
            "Kansas","Kentucky","Louisiana","Massachusetts","Maryland","Maine","Michigan","Minnesota","Missouri",
            "Mississippi","Montana","North Carolina","North Dakota","Nebraska","New Hampshire","New Jersey","New Mexico",
            "Nevada","New York","Ohio","Oklahoma","Oregon","Pennsylvania","Puerto Rico","Rhode Island","South Carolina",
            "South Dakota","Tennessee","Texas","Utah","Virginia","Virgin Islands","Vermont","Washington","Wisconsin",
            "West Virginia","Wyoming");
        Form::select("schema_state", $states, "State: ");
        Form::inputCreate("schema_zip", "ZIP: ", array("type"=>"text", "size"=>"50", "pattern"=>"[0-9]{5}(-[0-9]+)*"));
        Form::inputCreate("schema_street", "Street/Apt: ", array("type"=>"text", "size"=>"50"));
        Form::inputCreate("schema_phone", "Phone(accepted format +1-xxx-xxx-xxxx): ", array("type"=>"tel", "size"=>"50", "pattern"=>"[+]1-[0-9]{3}-[0-9]{3}-[0-9]{4}"));
        Form::inputCreate("schema_map", "Google Map: ", array("type"=>"text", "size"=>"50"));

        if (get_option('schema_location') == "multi"){
            echo "<hr>";
            $loop = get_option('schema_locnumber');
            $i = 1;
            while ($loop > 0){
                Form::inputCreate("schema_sub_name$i", "Location $i Name: ", array("type"=>"text", "size"=>"50"));
                Form::select("schema_sub_state$i", $states, "Location $i State: ");
                Form::inputCreate("schema_sub_zip$i", "Location $i ZIP: ", array("type"=>"text", "size"=>"50", "pattern"=>"[0-9]{5}(-[0-9]+)*"));
                Form::inputCreate("schema_sub_street$i", "Location $i Street/Apt: ", array("type"=>"text", "size"=>"50"));
                Form::inputCreate("schema_sub_phone$i", "Location $i Phone(accepted format +1-xxx-xxx-xxxx): ", array("type"=>"tel", "size"=>"50", "pattern"=>"[+]1-[0-9]{3}-[0-9]{3}-[0-9]{4}"));
                Form::inputCreate("schema_sub_map$i", "Location $i Map: ", array("type"=>"text", "size"=>"50"));
                echo "<hr>";
                $i++;
                $loop--;
            }
        }
        Form::submitbutton("schema_submit", "schsubmit", "Save");
        Form::closeForm();
        ?>

</div>
<?php
$ind = get_option('schema_individual');
if ($ind != "none" && $ind){
?>
<div class="formdiv formdiv2">
    <?php
    Form::openForm("individual_form");
    foreach ($ind as $in){
        echo "<div class='individual_blocks'>";
        echo "<h4><strong>".get_the_title( $in )."</strong></h4>";
    Form::inputCreate("schema_ind_url$in", "Site Url: ", array("type"=>"text", "size"=>"25"));
    Form::inputCreate("schema_ind_name$in", "Site Name: ", array("type"=>"text", "size"=>"25"));
    Form::inputCreate("schema_ind_logo$in", "Site Logo: ", array("type"=>"text", "size"=>"25"));
    Form::textarea("schema_ind_socials$in", "Social Links: ", array("rows"=>"5", "cols"=>"25"));
    Form::inputCreate("schema_ind_city$in", "City: ", array("type"=>"text", "size"=>"25"));
    $states = array("Alaska","Alabama","Arkansas","American Samoa","Arizona","California","Colorado","Connecticut",
        "District of Columbia","Delaware","Florida","Georgia","Guam","Hawaii","Iowa","Idaho","Illinois","Indiana",
        "Kansas","Kentucky","Louisiana","Massachusetts","Maryland","Maine","Michigan","Minnesota","Missouri",
        "Mississippi","Montana","North Carolina","North Dakota","Nebraska","New Hampshire","New Jersey","New Mexico",
        "Nevada","New York","Ohio","Oklahoma","Oregon","Pennsylvania","Puerto Rico","Rhode Island","South Carolina",
        "South Dakota","Tennessee","Texas","Utah","Virginia","Virgin Islands","Vermont","Washington","Wisconsin",
        "West Virginia","Wyoming");
    Form::select("schema_ind_state$in", $states, "State: ");
    Form::inputCreate("schema_ind_zip$in", "ZIP: ", array("type"=>"text", "size"=>"25", "pattern"=>"[0-9]{5}(-[0-9]+)*"));
    Form::inputCreate("schema_ind_street$in", "Street/Apt: ", array("type"=>"text", "size"=>"25"));
    Form::inputCreate("schema_ind_phone$in", "Phone(accepted format +1-xxx-xxx-xxxx): ", array("type"=>"tel", "size"=>"25", "pattern"=>"[+]1-[0-9]{3}-[0-9]{3}-[0-9]{4}"));
    Form::inputCreate("schema_ind_map$in", "Google Map: ", array("type"=>"text", "size"=>"25"));
    echo "</div>";
    }
    Form::submitbutton("schema_ind_submit", "schsubmit", "Save");
    Form::closeForm();
    ?>
</div>
<?php }?>