<?php

function exampleApp_create() {
    //set variables based off what is being POST'ed(submitted)
    $id = $_POST["id"];
    $name = $_POST["name"];
    $exampleCustomField = $_POST["exampleCustomField"];
    //if the input with name="insert" is set(submitted) do the following
    if (isset($_POST['insert'])) {
        //prepare everything to be added to database
        global $wpdb;
        $table_name = $wpdb->prefix . "exampleApp";
        $wpdb->insert(
                $table_name, //table
                array('name' => $name, 'exampleCustomField' => $exampleCustomField)	//what needs to be inserted	
        );
        $message.="exampleApp inserted"; //A little message to let user know something happened
    }
    ?>
    <!-- Depending on how you want to handle this, add it to init.php and wp_enqueue it instead of hard coding -->
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/exampleApp/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Add New ExampleApp</h2>
<?php 
            if (isset($message)){ ?>
                <div class="updated">
                    <p><?php echo $message; ?></p>
                </div>
<?php 
            }
        //Form posts and it goes to the page 
?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <p>Enter the ExampleApp</p>
            <table class='wp-list-table widefat fixed'>
                <tr>
                    <!-- Button is clicked and insert is set -->
                    <input style="margin-bottom: 10px;" type='submit' name="insert" value='Save' class='button'/>
                    <th class="ss-th-width">Name</th>
                    <!-- 
                        the input is given the name of name(associated with name in database)
                        the value echoes name variable which is pulled from database
                    -->
                    <td><input type="text" name="name" value="<?php echo $name; ?>" class="" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">exampleCustomField</th>
                    <!-- 
                        exampleCustomField is giving an example of a arbitrary field for the plugin
                        this is the same as above but value is empty                
                    -->
                    <td><textarea rows="5" cols="50" name="exampleCustomField" value="" class=""></textarea></td>
                </tr>
            </table>
        </form>
    </div>
    <?php
}