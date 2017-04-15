<?php
    global $wpdb;
    //setup DB table name
    $table_name = $wpdb->prefix . "exampeAppTable";
    //query the DB for everything from the table selected above
    $query = $wpdb->get_results("SELECT * from $table_name", ARRAY_A);
    //dump it out to make sure that it is properly getting results
    echo '<pre>';
        var_dump($query);
    echo '</pre>';
?>
