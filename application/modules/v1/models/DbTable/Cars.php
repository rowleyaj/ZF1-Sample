<?php

class V1_Model_DbTable_Cars extends Zend_Db_Table_Abstract
{

    protected $_name = 'cars';
    protected $_dependantTables = array('V1_Model_DbTable_Models');

    protected $_referenceMap = array(
        'Model' => array(
            'columns' => 'model_id',
            'refTableClass' => 'V1_Model_DbTable_Models',
            'refColumns' => 'id'
        )
    );
}