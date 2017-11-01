<?php
/*
Plugin Name: JSON Schema
Plugin URI: https://github.com/Sanj718
Description: Plugin for displaying schema in the head as JSON format.
Author: Sanjar Sobirjonov
Version: 2.0
Author URI: https://github.com/Sanj718
*/
class Schema{

    public function __construct(){
        require_once(ABSPATH . 'wp-config.php');
         mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
    }

    public function create_menu(){
        function schema_admin_actions() {
            add_menu_page("Json Schema", "Json Schema", 1, "jsonschema", 'schema_admin');
            add_submenu_page( 'jsonschema', 'Page title', 'Schema Config', 'manage_options', 'schema-config', 'schema_config_page');
        }
        add_action('admin_menu', 'schema_admin_actions');
        function schema_admin(){
            include('schema_admin.php');
        }

        function schema_config_page() {
            include('schema_config.php');
        }
    }

    public function schematohead(){

        function schema_to_head(){
            $ind = get_option('schema_individual');$i = 0;
            if (is_array($ind) || is_object($ind)){foreach ($ind as $in){if ($in == get_the_ID()){$i = get_the_ID();}}}
            if ($i == 0 && empty($i)){
                ?>
                <script type="application/ld+json">
            {
                "@context": {
                "@vocab": "http://schema.org/"
              },
              "@graph": [
                {
                    "@id": "<?php echo get_option('schema_url'); ?>",
                  "@type": "Organization",
                  "name": "<?php echo get_option('schema_name'); ?>",
                    "url" : "<?php echo get_option('schema_url'); ?>",
                    "logo" : "<?php echo get_option('schema_logo'); ?>",
                  "sameAs" : <?php $t = explode(',', get_option('schema_socials'));
                    $result = "";foreach ($t as $r) {$result .= '"' . trim($r) . '", ';}
                    $re = rtrim($result, ", ");echo "[ " . $re . " ]";; ?>,
                  "address": {
                    "@type": "PostalAddress",
                    "addressLocality": "<?php echo get_option('schema_city'); ?>",
                    "addressRegion": "<?php echo ucwords(get_option('schema_state')); ?>",
                    "postalCode": "<?php echo get_option('schema_zip'); ?>",
                    "streetAddress": "<?php echo get_option('schema_street'); ?>",
                    "telephone": "<?php echo get_option('schema_phone'); ?>"
                  },
                  "hasmap" : "<?php echo get_option('schema_map'); ?>",
                  "image" : "<?php echo get_option('schema_logo'); ?>"

                }<?php if (get_option('schema_location') == "multi") { ?>,
                <?php $loop = get_option('schema_locnumber');
                        $i = 1;
                        while ($loop > 0) {
                            ?>
                {
                    "@type": "LocalBusiness",
                  "parentOrganization": {
                    "name" : "<?php echo get_option('schema_name'); ?>"
                  },
                 "name" : "<?php echo get_option('schema_sub_name' . $i); ?>",
                  "address": {
                    "@type" : "PostalAddress",
                      "streetAddress": "<?php echo get_option('schema_sub_street' . $i); ?>",
                      "addressLocality": "<?php echo get_option('schema_sub_city' . $i); ?>",
                      "addressRegion": "<?php echo ucwords(get_option('schema_sub_state' . $i)); ?>",
                      "postalCode": "<?php echo get_option('schema_sub_zip' . $i); ?>",
                      "telephone" : "<?php echo get_option('schema_sub_phone' . $i); ?>"
                      },
                  "hasmap" : "<?php echo get_option('schema_sub_map' . $i); ?>",
                  "image" : "<?php echo get_option('schema_logo'); ?>"
                }<?php $i++;
                            $loop--;
                            if ($loop != 0) { ?>,
                <?php }
                        }
                    } ?>
              ]
            }

                </script> <?php
            }else{
                ?>
                <script type="application/ld+json">
                {
                  "@context": {
                    "@vocab": "http://schema.org/"
                  },
                  "@graph": [
                    {
                      "@id": "<?php echo get_option('schema_ind_url'.$i); ?>",
                      "@type": "LocalBusiness",
                      "name": "<?php echo get_option('schema_ind_name'.$i); ?>",
                        "url" : "<?php echo get_option('schema_ind_url'.$i); ?>",
                        "logo" : "<?php echo get_option('schema_ind_logo'.$i); ?>",
                        "image" : "<?php echo get_option('schema_ind_logo'.$i); ?>",
                      "sameAs" : <?php $t = explode(',', get_option('schema_ind_socials'.$i));
                    $result = "";foreach ($t as $r) {$result .= '"' . trim($r) . '", ';}
                    $re = rtrim($result, ", ");echo "[ " . $re . " ]"; ?>,
                      "address": {
                        "@type": "PostalAddress",
                        "addressLocality": "<?php echo get_option('schema_ind_city'.$i);?>",
                        "addressRegion": "<?php echo ucwords(get_option('schema_ind_state'.$i));?>",
                        "postalCode": "<?php echo get_option('schema_ind_zip'.$i);?>",
                        "streetAddress": "<?php echo get_option('schema_ind_street'.$i);?>",
                        "telephone": "<?php echo get_option('schema_ind_phone'.$i);?>"
                      }

                    }
                  ]
                }
                </script>
                <?php
            }
        }
        add_action( 'wp_head', 'schema_to_head' );
    }
}

$schema = new Schema;
$schema->create_menu();
$schema->schematohead();