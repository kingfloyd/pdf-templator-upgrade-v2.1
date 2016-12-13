<?php

namespace Zeraus\Templator\Db;

use Zeraus\Templator\Db\WpdbQueries;

class DB_PDF extends  WpdbQueries {


    private $wpdb = '';
    private $table_name = '';

    function __construct($table_name)
    {

        $this->table_name = $table_name;
    }

    public  function getAllEntry($limit=null, $oderBy=null)
    {
        $wpdb_queries = new WpdbQueries($this->table_name);
        if($limit != null) {
            return $wpdb_queries->wpdb_get_result("select * from " . $this->table_name . " limit $limit");
        } else {

            return $wpdb_queries->wpdb_get_result("select * from " . $this->table_name . " oderBy");
        }
    }

    public function getEntriesByCondition($whereVal='')
    {
        if(empty($whereVal)) {
            $wpdb_queries = new WpdbQueries($this->table_name);
            return $wpdb_queries->wpdb_get_result("select * from " . $this->table_name);
        } else {
            $wpdb_queries = new WpdbQueries($this->table_name);
            return $wpdb_queries->wpdb_get_result("select * from " . $this->table_name . " where $whereVal");
        }
    }
    public function getEntryById($id)
    {
        $wpdb_queries = new WpdbQueries($this->table_name);
        return $wpdb_queries->wpdb_get_result("select * from " . $this->table_name . " where id = " . $id);
    }

    public function updateEntry($data = array(), $id)
    {
        $wpdb_queries = new WpdbQueries($this->table_name);
        return $wpdb_queries->wpdb_update($data, array('id'=>$id));
    }

    public function deleteEntry($id)
    {
        $wpdb_queries = new WpdbQueries($this->table_name);
        return  $wpdb_queries->wpdb_delete(array('id'=>$id));
    }

    public function addEntry($data = array())
    {
        $wpdb_queries = new WpdbQueries($this->table_name);
        return  $wpdb_queries->wpdb_insert($data);
    }

}