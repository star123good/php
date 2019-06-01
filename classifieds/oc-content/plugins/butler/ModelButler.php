<?php

class ModelButler extends DAO
{

    private static $instance ;
    public static function newInstance() {
        if( !self::$instance instanceof self ) {
            self::$instance = new self ;
        }
        return self::$instance ;
    }

    function __construct() {
        parent::__construct();
    }

    public function expired($days = 30, $limit = 1000) {
        $this->dao->select('s_secret, pk_i_id');
        $this->dao->from(DB_TABLE_PREFIX . 't_item');
        $this->dao->where('dt_expiration < "' . date('Y-m-d H:i:s', time()-($days*24*3600)) . '"');
        $this->dao->limit($limit);
        $result = $this->dao->get();

        if($result == false) {
            return array();
        }
        return $result->result();
    }

    public function inactivatedListings($days = 30, $limit = 1000) {
        $this->dao->select('s_secret, pk_i_id');
        $this->dao->from(DB_TABLE_PREFIX . 't_item');
        $this->dao->where('b_active', 0);
        $this->dao->where('dt_pub_date < "' . date('Y-m-d H:i:s', time()-($days*24*3600)) . '"');
        $this->dao->limit($limit);
        $result = $this->dao->get();

        if($result == false) {
            return array();
        }
        return $result->result();
    }

    public function spam($days = 30, $limit = 1000) {
        $this->dao->select('s_secret, pk_i_id');
        $this->dao->from(DB_TABLE_PREFIX . 't_item');
        $this->dao->where('b_spam', 1);
        $this->dao->where('dt_pub_date < "' . date('Y-m-d H:i:s', time()-($days*24*3600)) . '"');
        $this->dao->limit($limit);
        $result = $this->dao->get();

        if($result == false) {
            return array();
        }
        return $result->result();
    }

    public function inactivatedUsers($days = 30, $limit = 1000) {
        $this->dao->select('pk_i_id');
        $this->dao->from(DB_TABLE_PREFIX . 't_user');
        $this->dao->where('b_active', 0);
        $this->dao->where('dt_reg_date < "' . date('Y-m-d H:i:s', time()-($days*24*3600)) . '"');
        $this->dao->limit($limit);
        $result = $this->dao->get();
        if($result == false) {
            return array();
        }
        return $result->result();
    }

}