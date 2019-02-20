<?php
    namespace BHLst\models;

    use BHLst\models\Model;

    if(!defined("AccPoint")) exit("ACCESS DENIED");

    class User extends Model{

        private $_table = 'users';

        public function __construct(){
            parent::__construct();
        }

        public function get(){
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->condition('name',':name');

            $this->db->addPrepares(
                array(
                    array(
                        'key' => ':name',
                        'value' => 'test',
                    ),
                )
            );
            return $this->exec();
        }
    }

?>