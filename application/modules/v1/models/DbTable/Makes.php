<?php

class V1_Model_DbTable_Makes extends Zend_Db_Table_Abstract
{

    protected $_name = 'makes';
    protected $_dependantTables = array('V1_Model_DbTable_Models');

}