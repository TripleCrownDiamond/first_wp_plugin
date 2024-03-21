<?php

/**
 * Plugin Name: Digital Process
 * Description: Description
 * Version: 1.0
 * Author: Georgeo A.
 * Author URI: /
 **/

function ajout_texte_page(){
    add_options_page(
        'Digital Process Configs Page',
        'Digital Process Configs',
        'manage_options',
        'digipro_ajout_texte_page',
        'ajout_texte_page_html'
    );
}

add_action('admin_menu', 'ajout_texte_page');

function ajout_texte_page_html(){

    if(!current_user_can('manage_options')){
        return;
    }

    if(isset($_POST['texte'])){
        $options = sanitize_text_field($_POST['texte']);
        update_option('texte_options', $options);
        echo'<div class="notice notice-success"><p>Options enregistrées avec succès.</p></div>';
    }

    $options = get_option('texte_options', '');

    ?>

    <div class='wrap'>
        <h1>Digital Process</h1>
        <form action="" method="post">
            <label for="texte">Texte à ajouter</label>
            <input type="text" name="texte" id="texte" value="<?php echo esc_attr( $options ) ;?>" class="regular_text">
            <?php submit_button('Envoyer', 'primary', 'submit'); ?>
        </form>
    </div>

    <?php

}

function mon_plugin_add_text($content){
    $options = get_option( 'texte_options' );
    $add = '<p>' . esc_html( $options ) . '</p>';
    $content = $add . $content;
    return $content;
}

add_filter( 'the_content', 'mon_plugin_add_text' );

?>