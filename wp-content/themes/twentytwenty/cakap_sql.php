<?php 

class Sql {

    function addDB($table_name,$data){
        global $wpdb;
        
	    $table = $wpdb->prefix.$table_name;
	
	    $wpdb->insert($table,$data);
	
	    return $id = $wpdb->insert_id;
    }

    function queryDB($sql){
        global $wpdb;
        $query = $wpdb->get_results($sql);
        return $query;
    }

    function queryRowDB($sql){
        global $wpdb;
        $query = $wpdb->get_row($sql);
        return $query;
    }

    function showDB($table_name,$andWhere=""){
        global $wpdb;
        $table = $wpdb->prefix.$table_name;
        $sql =  "SELECT * FROM " .$table. " WHERE 1".$andWhere;
        $query = $wpdb->get_results($sql);
        return $query;
    }

    function updateDB($table_name,$data,$where){
        global $wpdb;
        $table = $wpdb->prefix.$table_name;
        $query = $wpdb->update($table, $data, $where);
        return $query;
    }

    function deleteDB($table_name,$where){
        global $wpdb;
        $table = $wpdb->prefix.$table_name;
        return $query = $wpdb->delete( $table, $where );
    }

    function getRowDB($table_name,$andWhere=""){
        global $wpdb;
        $table = $wpdb->prefix.$table_name;
        $sql = "SELECT * FROM ".$table." WHERE 1 ".$andWhere;
        $query = $wpdb->get_row( $sql );
        return $query;
    }
}

$sql = new Sql();
?>