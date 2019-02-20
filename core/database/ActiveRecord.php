<?php

    namespace BHLst\database;

    if(!defined("AccPoint")) exit("ACCES DENIED");

    class ActiveRecord{

        private $_select;
        private $_from;
        private $_join;
        private $_where = '';
        private $_orderBy='';
        private $_groupBy='';
        private $_limit = '';

        private $_prepared = array();
        
        private $_lastWhereEqual = '';

        public function __construct(){

        }

        /** MAIN COMMANDS */

        public function condition($field,$value,$equals="=",$type="AND"){
            $this->_condition($field . ' ' .$equals . ' ' . $value . ' ',$type);
        }

        public function select($select){
            $this->_select = 'SELECT ' . $select . ' ';
        }

        public function from($from){
            $this->_from = 'FROM ' . $from . ' ';
        }

        /** STATEMENTS */

        private function _condition($condition,$type){
            if($this->_lastWhereEqual !== '')
                $this->_where .= $this->_lastWhereEqual . ' ';
   
            $this->_where .= $condition;
            $this->_lastWhereEqual = $type;
        }

        public function in($field,$values,$type){
            $this->_condition($field . ' ' . 'IN (' . implode(',',$values) . ')' . ' ',$type);
        }

        public function notIn($field,$values,$type){
            $this->_condition($field . ' ' . 'NOT IN (' . implode(',',$values) . ')' . ' ',$type);
        }

        public function like($field,$value,$type){
            $this->_condition($field . ' ' . 'LIKE ' . $value . ' ',$type);
        }

        public function notLike($field,$value,$type){
            $this->_condition($field . ' ' . 'NOT LIKE ' . $value . ' ',$type);
        }

        /** MANAGE COMMANDS */

        public function groupBy($groupBy){
            $this->_groupBy = 'GROUP BY ' . $groupBy . ' ';
        }

        public function orderBy($orderBy,$sort = "ASC"){
            $this->_orderBy = 'ORDER BY ' . $orderBy . ' ' . $sort . ' ';
        }

        public function join($table, $condition, $type){
            $this->_join .= $type. ' JOIN ' . $table . ' ON ' . $condition . ' ';
        }

        public function limit($position,$count = ''){
            $this->_limit = 'LIMIT ' . $position;
            if($count !== ''){
                $this->_limit .= ', '. $count;
            }
        }

        /* GET_DATA COMMANDS */

        public function addPrepare($key,$value){
            $this->_prepared[] = array(
                'key' => $key,
                'value' => $value,
            );
        }

        public function addPrepares($prepared){
            $this->_prepared = $prepared;
        }

        public function getPrepare(){
            return $this->_prepared;
        }


        public function getSql(){
            if( $this->_where !==  '')
                $this->_where = "WHERE " . $this->_where . ' ';

            $sqlRequest = $this->_select . $this->_from . $this->_join . $this->_where . $this->_groupBy .  $this->_orderBy . $this->_limit;

            return $sqlRequest;
        }
    }

?>