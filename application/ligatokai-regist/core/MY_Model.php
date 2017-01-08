<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY_Model
 *
 * author
 * property CI_DB_active_record $db
 */
class MY_Model extends CI_Model {
    /**
     * table name
     *
     * var string
     */
    protected $_table;

    /**
     * constructor
     */
	function __construct() {
		parent::__construct();

		$strDatabaseHost = 'default';
		$strServerAddr = $_SERVER['SERVER_ADDR'];

		// 本番サーバー
		if ( $strServerAddr == '112.78.117.114' ) {
			$strDatabaseHost = 'firebird';
		}

        $this->load->database($strDatabaseHost);
        $clazz = get_class($this);

        $this->_table = strtolower(substr($clazz, 0, strpos($clazz, '_')));

    }

    /**
     * insert
     *
     * return integer
     */
    public function insert() {
        $now = $this->now();
        $this->db->set(array('created_at' => $now, 'updated_at' => $now));
        $ret = $this->db->insert($this->_table, $this);
        if ($ret === FALSE) {
            return FALSE;
        }
        return $this->db->insert_id();
    }

    /**
     * update
     *
     * param integer|string $id
     */
    public function update($id, $data = null) {
        if ($data === null) {
            $data = $this;
        }
        $ret = $this->db->update($this->_table, $data, array('id' => $id));
        if ($ret === FALSE) {
            return FALSE;
        }
    }

    /**
     * delete
     *
     * param integer|strng $id
     */
    public function delete($id) {
        $this->db->delete($this->_table, array('id' => $id));
    }

    /**
     * find_all
     *
     * return array
     */
    public function find_all() {
        return $this->db->get($this->_table)->result();
    }

    /**
     * find_list
     *
     * param  integer|string $limit
     * return array
     */
    public function find_list($limit = 10) {
        return $this->db->limit($limit)->order_by('id')->get($this->_table)->result();
    }

    /**
     * find
     *
     * param  integer|string $id
     * return stdClass
     */
    public function find($id) {
        $ret = $this->db->where(array('id' => $id))->get($this->_table)->row();
        return $ret;
    }

    /**
     * now
     *
     * return string
     */
    public function now() {
        return date('Y-m-d H:i:s');
    }

}
