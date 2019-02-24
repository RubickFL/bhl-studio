<?php

    namespace BHLst\database;

    
    if(!defined("AccPoint")) {
        $joke = ' <!DOCTYPE html>
        <html lang="en">
        <head>
            <title>410 Gone</title>
        </head>
        <body>
            <h1>Gone</h1>
            <p>The requested resource <br>
            '. $_SERVER["PHP_SELF"] . '
            <br> is no longer available on this server and there is no forwarding address.
            Please remove all references to this source. <br><br>
            Additionally, a 410 Gone error was encoutentered while trying to use an ErrorDocument to handle the request</p>
        </body>
        </html> ';
        header($_SERVER['SERVER_PROTOCOL'] . ' 410 Gone');
        exit($joke);
    }

    class ActiveRecord{

        private $_select;
        private $_from;
        private $_where = '';
        private $_update = array();

        private $_join;
        private $_orderBy='';
        private $_groupBy='';

        private $_limit = '';

        private $_prepared = array();
        
        private $_lastWhereEqual = '';

        private $_typeQuery = "select";

        private $_trunctate = '';

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

        /** TABLE MANAGEMENT */

        public function truncate($titleTable){
            $this->_truncate = 'TRUNCATE TABLE ' . $titleTable;
            $this->_typeQuery = "truncate";
        }

        public function delete(){
            $this->_typeQuery = "delete";
        }

        public function update($updData){
            for($i = 0; $i < count($updData); $i++){
                $this->_update = $updData[$i]['field'] . ' = ' . $updData[$i]['value'] . ', ';
            }
            $this->_update = trim($this->_update,',') . ' ';
            $this->_typeQuery = "update";
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

            switch($this->_typeQuery) {
                case "select" : 
                    $sqlRequest = $this->_select . $this->_from . $this->_join . $this->_where . $this->_groupBy .  $this->_orderBy . $this->_limit; 
                    break;
                case "update" : 
                    $sqlRequest = "UPDATE " . $this->_from . "SET " . $this->_update . $this->_where; 
                    break;
                case "delete" : 
                    $sqlRequest =   "DELETE " . $this->_from . $this->_join . $this->_where . $this->_groupBy . $this->_orderBy . $this->_limit; 
                    break;
                case "truncate" :  
                    $sqlRequest = $this->_truncate;
                    break;

                default:;
            }

            return $sqlRequest;
        }

        public function clear(){
            $this->_select = "SELECT *";
            $this->_from;
            $this->_where = '';
            $this->_update = array();
            $this->_trunctate = '';


            $this->_join;
            $this->_orderBy='';
            $this->_groupBy='';
            $this->_limit = '';

            $this->_prepared = array();
            $this->_lastWhereEqual = '';
            $this->_typeQuery = "select";
        }
    }

?>