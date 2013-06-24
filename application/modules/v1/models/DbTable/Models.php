<?php

class V1_Model_DbTable_Models extends Zend_Db_Table_Abstract
{

    protected $_name = 'models';
    protected $_dependantTables = array('V1_Model_DbTable_Makes');

    protected $_referenceMap = array(
        'Make' => array(
            'columns' => 'make_id',
            'refTableClass' => 'V1_Model_DbTable_Makes',
            'refColumns' => 'id'
        )
    );
}