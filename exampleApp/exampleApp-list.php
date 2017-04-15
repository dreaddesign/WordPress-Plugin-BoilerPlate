<?php
function exampleApp_list() {
global $wpdb;
$table_name = $wpdb->prefix . "exampleApp";
$rows = $wpdb->get_results("SELECT id,name,exampleApp from $table_name");
?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/exampleApp/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>exampleApp</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <!-- Add New takes user to specific page to create a new thing -->
                <a href="<?php echo admin_url('admin.php?page=exampleApp_create'); ?>">Add New</a>
            </div>
            <br class="clear">
        </div>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>
                <th class="manage-column ss-list-width">Name</th>
                <th class="manage-column ss-list-width">exampleApp</th>
                <th class="manage-column ss-list-width">Edit</th>
            </tr>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <!-- echo name from the row -->
                    <td class="manage-column ss-list-width"><?php echo $row->name; ?></td>
                    <!-- echo the exampleApp stripping slashes and encoding htmlentities for safety -->
                    <td class="manage-column ss-list-width"><?php echo htmlentities(stripslashes($row->exampleApp)); ?></td>
                    <!-- If user clicks update, take them to update page with a query specific to the id -->
                    <td><a href="<?php echo admin_url('admin.php?page=exampleApp_update&id=' . $row->id); ?>">Update</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}