<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Cache extends MY_Model {

    function __construct () {
        // Model クラスのコンストラクタを呼び出す
        parent::__construct();

    }

    function saveCache($cacheName, $cacheValue) {

        $sql = 'SELECT id FROM ' . CA_CACHES . ' WHERE cache_name = ? LIMIT 1';

        $query = $this -> db -> query( $sql, Array($cacheName) );

        if($query -> num_rows() > 0) {
            $sql = 'UPDATE ' . CA_CACHES . ' SET cache_value = ?, updated = ? WHERE cache_name = ?';
            if( ! $this -> db -> query($sql, Array(serialize($cacheValue), date('Y-m-d H:i:s'), $cacheName))) {
                return false;
            }
        } else {
            $sql = 'INSERT INTO ' . CA_CACHES . ' (cache_name, cache_value, updated) VALUES (?, ?, ?)';
            if( ! $this -> db -> query($sql, Array($cacheName, serialize($cacheValue), date('Y-m-d H:i:s')))) {
                return false;
            }
        }
    }

    function getCache($cacheName, $cacheTime = 10000000) {

        $sql = 'SELECT cache_value, updated FROM ' . CA_CACHES . ' WHERE cache_name = ? LIMIT 1';

        $query = $this -> db -> query($sql, Array($cacheName));

        if($query -> num_rows() > 0) {
            $cache = $query -> result();
            if($cache[0] -> updated < date('Y-m-d H:i:s', time() - $cacheTime)) {
                return false;
            }
            return unserialize($cache[0] -> cache_value);
        }
        return false;
    }

}