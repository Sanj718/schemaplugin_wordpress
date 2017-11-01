<?php
class Form{
    public static function savetoDB(){
        if(isset($_REQUEST['schema_submit'])) {
            foreach ($_REQUEST as $key => $value){
                update_option($key, $_POST[$key]);
            }
            echo "<div class='updated'><p><strong>SAVED</strong></p></div>";
        }elseif (isset($_REQUEST['schema_ind_submit'])){
            foreach ($_REQUEST as $key => $value){
                update_option($key, $_POST[$key]);
            }
            echo "<div class='updated'><p><strong>SAVED</strong></p></div>";
        }
    }
    private static function getAttr($attr){
        $temp = "";
        foreach ($attr as $key=>$value){$temp .=$key."='".$value."' ";}
        return $temp;
    }

    public static function inputCreate($name , $label="", $other_attr, $class="fnames", $phone=FALSE){
        echo "<p><span class='$class'>".$label."</span><input name='".$name."' ".self::getAttr($other_attr)." value='". get_option($name)."'/></p>";
    }
    public static function radio($name, $value, $label="", $other_attr, $class="fnames"){
        $checked = "";
        if ($value == get_option($name)){$checked = "checked";}
        echo "<p><span class='$class'>".$label."</span><input name='".$name."' ".self::getAttr($other_attr)." value='$value' $checked></p>";
    }
    public static function checkbox($name, $value, $label="", $other_attr, $class="fnames"){
        $forempty = get_option($class);
        if (get_option($class)=="none" || !get_option($class) || empty($forempty)){
            $checked = "";
            if ($value == get_option($name)){$checked = "checked";}
            echo "<p><span class='$class'>".$label."</span><input name='".$name."' ".self::getAttr($other_attr)." value='$value' $checked></p>";
        }else{
            $checked = ""; $result = "";
            foreach (get_option($class) as $ch){
                if ($value == $ch){$checked = "checked";}
                $result = "<p><span class='$class'>".$label."</span><input name='".$name."' ".self::getAttr($other_attr)." value='$value' $checked></p>";
            }
            echo $result;
        }
    }
    public static function textarea($name, $label, $other_attr, $class="fnames"){
        echo "<p><span class='$class'>$label</span><textarea name='$name' ".self::getAttr($other_attr)." >".get_option($name)."</textarea></p>";
    }
    public static function select($name, $options, $label){
        $open = "<select name='$name' >";
        $close = "</select>";
        $optionsf = "";
        foreach ($options as $opt){
            if (get_option($name) == strtolower($opt)){
                $optionsf .= "<option value='".strtolower($opt)."' selected>".strtoupper($opt)."</option>";
            }else{
                $optionsf .= "<option value='".strtolower($opt)."'>".strtoupper($opt)."</option>";
            }

        }
        echo "<p><span class='fnames'>$label</span>".$open.$optionsf.$close."</p>";
    }
    public static function submitbutton($name, $class, $label){
        echo  "<p><input class='$class' type='submit' name='$name' value='$label' /></p>";
    }
    public static function openForm($id="schemaform"){
        echo "<form id='$id' enctype='multipart/form-data' name='".$id."' method='post' action=".str_replace( '%7E', '~', $_SERVER['REQUEST_URI']).">";
    }
    public static function closeForm(){
        echo "</form>";
    }
}