<?php

class ModelReminder extends DAO
{
    private static $instance ;

    public static function newInstance()
    {
        if( !self::$instance instanceof self ) {
            self::$instance = new self ;
        }
        return self::$instance ;
    }

    /**
     * Construct
     */
    function __construct()
    {
        parent::__construct();
        $this->setTableName('t_reminder');
        $array_fields = array(
            's_slug',
            'i_days',
            'b_enabled',
            's_subject',
            's_body_content',
            'dt_created'
        );
        $this->setFields($array_fields);
    }

    /**
     * Import sql file
     * @param type $file
     */
    public function import($file)
    {
        $path   = osc_plugin_resource($file) ;
        $sql    = file_get_contents($path);

        if(! $this->dao->importSQL($sql) ){
            throw new Exception( $this->dao->getErrorLevel().' - '.$this->dao->getErrorDesc() ) ;
        }
    }

    /**
     * Remove data and tables related to the plugin.
     */
    public function uninstall()
    {
        $this->dao->query(sprintf('DROP TABLE %s', $this->getTableName()) ) ;
    }

    public function insertReminder($aSet)
    {
        if($this->dao->insert( $this->getTableName(), $aSet) ) {
            return true;
        }
        return false;
    }

    public function updateLastCheck($aUpdate)
    {
        if( $this->dao->update( $this->getTableName(),
            array('dt_last_check' => $aUpdate['dt_last_check']),
            array('s_slug' => $aUpdate['s_slug'],
                    'i_days' => $aUpdate['i_days']) )
        ) {
            return true;
        }
        return false;
    }

    /**
     *  NOTE: days are not updated
     *
     * @param type $aUpdate
     * @return boolean
     */
    public function updateReminder($aUpdate)
    {
        if( $this->dao->update( $this->getTableName(),
                array('s_body_content' => $aUpdate['s_body_content'],
                        's_subject'  => $aUpdate['s_subject'],
                        'b_enabled' => $aUpdate['b_enabled']),
                array('s_slug' => $aUpdate['s_slug'],
                        'i_days' => $aUpdate['i_days']) )
            ) {
            return true;
        }
        return false;
    }

    public function toggleEnabled($slug, $days)
    {
        $_reminder = $this->findBySlugDays($slug, $days);
        $b_enabled = 1;
        if($_reminder['b_enabled']==1) {
            $b_enabled = 0;
        }
        if( $this->dao->update( $this->getTableName(),
                array('b_enabled' => $b_enabled,
                        'dt_last_check' => date('Y-m-d H:i:s')),
                array('s_slug' => $slug,
                        'i_days' => $days) ) == 1
            ) {
            return true;
        }
        return false;
    }

    public function getReminders($b_enabled = null)
    {
        $this->dao->select();
        $this->dao->from( $this->getTableName() );
        if($b_enabled!=null) {
            if($b_enabled==true) {
                $this->dao->where('b_enabled', 1);
            } else {
                $this->dao->where('b_enabled', 0);
            }
        }

        $result = $this->dao->get();

        if($result!==false) {
            return $result->result();
        }
        return array();
    }

    public function findBySlugDays($slug, $days)
    {
        $this->dao->select();
        $this->dao->from( $this->getTableName() );
        $this->dao->where('s_slug', $slug);
        $this->dao->where('i_days', $days);
        $result = $this->dao->get();

        if($result!==false) {
            return $result->row();
        }
        return array();
    }

    function deleteBySlugDay($slug, $days) {
        return $this->dao->delete($this->getTableName(), array(
            's_slug' => $slug,
            'i_days' => $days
            ));
    }

    public function getItemNoImagesEmails($start, $end)
    {
        $t_item = DB_TABLE_PREFIX.'t_item';
        $t_item_resc = DB_TABLE_PREFIX.'t_item_resource';
        $t_user = DB_TABLE_PREFIX.'t_user';

        $this->dao->select("$t_item.*, $t_user.s_name");
        $this->dao->from($t_item);
        $this->dao->join($t_item_resc, $t_item_resc.'.fk_i_item_id = '.$t_item.'.pk_i_id', 'left');
        $this->dao->join($t_user, $t_item.'.fk_i_user_id = '.$t_user.'.pk_i_id', 'left');
        $this->dao->where($t_item.'.b_enabled', 1);
        $this->dao->where($t_item_resc.'.pk_i_id IS NULL');
        $this->dao->where($t_item.'.dt_pub_date >',$start );
        $this->dao->where($t_item.'.dt_pub_date <=',$end );
        $result = $this->dao->get();

        if($result!==false) {
            return $result->result();
        }
        return array();
    }

    public function getItemNoValidatedEmails($start, $end)
    {
        $t_item = DB_TABLE_PREFIX.'t_item';

        $this->dao->select("$t_item.*");
        $this->dao->from($t_item);
        $this->dao->where($t_item.'.b_enabled', 1);
        $this->dao->where($t_item.'.b_active', 0);
        $this->dao->where($t_item.'.dt_pub_date >',$start );
        $this->dao->where($t_item.'.dt_pub_date <=',$end );
        $result = $this->dao->get();

        if($result!==false) {
            return $result->result();
        }
        return array();
    }


    function getNewItems($start, $end, $active = null)
    {
        $t_item = DB_TABLE_PREFIX.'t_item';

        $this->dao->select("$t_item.*");
        $this->dao->from($t_item);
        $this->dao->where($t_item.'.b_spam ', 0);
        $this->dao->where($t_item.'.b_enabled', 1);
        if($active!==null && $active===true) {
            $this->dao->where($t_item.'.b_active', 1);
        }
        $this->dao->where($t_item.'.dt_pub_date >',$start );
        $this->dao->where($t_item.'.dt_pub_date <=',$end );
        $result = $this->dao->get();

        if($result!==false) {
            return $result->result();
        }
        return array();
    }

    function getNewItemsNoPremium($start, $end)
    {
        $t_item = DB_TABLE_PREFIX.'t_item';

        $this->dao->select("$t_item.*");
        $this->dao->from($t_item);
        $this->dao->where($t_item.'.b_spam ', 0);
        $this->dao->where($t_item.'.b_enabled', 1);
        $this->dao->where($t_item.'.b_active', 1);
        $this->dao->where($t_item.'.b_premium', 0);
        $this->dao->where($t_item.'.dt_pub_date >',$start );
        $this->dao->where($t_item.'.dt_pub_date <=',$end );
        $result = $this->dao->get();

        if($result!==false) {
            return $result->result();
        }
        return array();
    }

    public function getExpiredItems($start, $end)
    {
        $t_item = DB_TABLE_PREFIX.'t_item';

        $this->dao->select("$t_item.*");
        $this->dao->from($t_item);
        $this->dao->where($t_item.'.b_enabled', 1);
        $this->dao->where($t_item.'.dt_expiration >',$start );
        $this->dao->where($t_item.'.dt_expiration <=',$end );
        $this->dao->where($t_item.'.b_spam ', 0);

        $result = $this->dao->get();
        error_log($this->dao->lastQuery());

        if($result!==false) {
            return $result->result();
        }
        return array();
    }

    function getUserNoValidatedEmails($start, $end)
    {
        $t_user = DB_TABLE_PREFIX.'t_user';

        $this->dao->select("$t_user.*");
        $this->dao->from($t_user);
        $this->dao->where($t_user.'.b_enabled', 1);
        $this->dao->where($t_user.'.b_active', 0);
        $this->dao->where($t_user.'.dt_reg_date >',$start );
        $this->dao->where($t_user.'.dt_reg_date <=',$end );
        $result = $this->dao->get();

        if($result!==false) {
            return $result->result();
        }
        return array();
    }

    function getNewUsers($start, $end)
    {
        $t_user = DB_TABLE_PREFIX.'t_user';

        $this->dao->select("$t_user.*");
        $this->dao->from($t_user);
        $this->dao->where($t_user.'.b_enabled', 1);
        $this->dao->where($t_user.'.dt_reg_date >',$start );
        $this->dao->where($t_user.'.dt_reg_date <=',$end );
        $result = $this->dao->get();

        if($result!==false) {
            return $result->result();
        }
        return array();
    }

    /**
     * return user stats:
     *
     * - new users in period
     * - validated/no validated users in period
     *
     * @param type $start
     * @param type $end
     */
    function getUserStats($start, $end)
    {
        // get new users in period
        $users_period = User::newInstance()->countUsers('dt_reg_date > "'.$start.'" and dt_reg_date <= "'.$end.'"');
        return $users_period;
    }

    function getItemStats($start, $end)
    {
        // get new users in period
        $this->dao->select('count(1) as count');
        $this->dao->from(DB_TABLE_PREFIX.'t_item');
        $this->dao->where('dt_pub_date > "'.$start.'" and dt_pub_date <= "'.$end.'"');
        $result = $this->dao->get();
        if($result!==false){
            $aux = $result->row();
            return $aux['count'];
        }
        return 0;
    }

    public function getStatsLast30() {
        $this->dao->select();
        $this->dao->from(DB_TABLE_PREFIX.'t_reminder_stats');
        $this->dao->where('dt_date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()');
        $result = $this->dao->get();

        if($result!==false) {
            return $result->result();
        }
        return array();
    }

    public function getStatsByDay($date) {
        $this->dao->select();
        $this->dao->from(DB_TABLE_PREFIX.'t_reminder_stats_row');
        $this->dao->where('dt_date >=', $date . ' 00:00:00');
        $this->dao->where('dt_date <=', $date . ' 23:59:59');
        $result = $this->dao->get();

        if($result!==false) {
            return $result->result();
        }
        return array();
    }

    // increase stat
    public function increase_stat() {
            $this->dao->set('i_total_emails', 'i_total_emails + 1', false);
            $this->dao->where(array(
                'dt_date' => date('Y-m-d'). ' 00:00:00'
                )
            );
        $r_update = $this->dao->update(DB_TABLE_PREFIX.'t_reminder_stats');
        if($r_update===false || $r_update==0) {
            $this->dao->insert(DB_TABLE_PREFIX.'t_reminder_stats',
                array(
                    'dt_date' => date('Y-m-d'),
                    'i_total_emails' => 1
                    )
                );
        }
    }

    public function log_reminder($s_slug, $i_days, $to) {
        $this->dao->insert(DB_TABLE_PREFIX.'t_reminder_stats_row',
                array(
                    'dt_date' => date('Y-m-d H:i:s'),
                    's_email' => $to,
                    's_reminder_slug' => $s_slug,
                    'i_reminder_days' => $i_days
                    )
                );
    }
}
