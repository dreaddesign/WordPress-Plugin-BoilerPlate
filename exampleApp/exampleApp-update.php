<?php

function exampleApp_update() {
    global $wpdb;
    $table_name = $wpdb->prefix . "exampleApp";
    $name = $_POST["name"];
    $id = $_GET["id"];
    $exampleApp = $_POST["exampleApp"];

    //update
    if (isset($_POST['update'])) {
        $wpdb->update(
            $table_name, //table
            array('bdc_script' => $bdc_script), //data if you need more just comma seperate them here
            array('id' => $id)
        );
    }
    
    //delete
    else if (isset($_POST['delete'])) {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %s", $id));
    } else {//selecting value to update	
        $query = $wpdb->get_results($wpdb->prepare("SELECT id,name,exampleApp from $table_name where id=%s", $id));
        foreach ($query as $s) {
            $id = $s->id;
            $name = $s->name;
            $exampleApp = $s->exampleApp;
        }
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/exampleApp/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>exampleApp</h2>

        <?php if ($_POST['delete']) { ?>
            <div class="updated"><p>exampleApp deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=exampleApp_list') ?>">&laquo; Back to exampleApp list</a>

        <?php } else if ($_POST['update']) { ?>
            <div class="updated"><p>bdc script updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=exampleApp_list') ?>">&laquo; Back to exampleApp list</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class="wp-list-table widefat fixed">
                    <tr><th>Name</th><td><?php echo $name; ?></td></tr>
                    <tr><th>exampleApp</th>
                        <td>
                            <textarea class="update-textarea" row="5" col="50" name="exampleApp"><?php echo stripslashes($exampleApp); ?></textarea>
                        </td>
                    </tr>
                </table>
                <input type='submit' name="update" value='update' class='button' /> &nbsp;&nbsp;
                <input type='submit' name="delete" value='delete' class='button' onclick="return confirm('Are you sure you wanna do that?')" />
            </form>
        <?php } ?>

    </div>
    <?php
}