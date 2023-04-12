<?php

class QueryFilters
{

    public function __construct(public $where = [],public $order_by = [],public $limit = []){}

    public function setWhere($field , $sign ,$value)
    {
        $this->where[] = [
            'field' => $field,
            'sign' => $sign,
            'value' => $value,
        ];
    }

    public function setOrderBy($field , $cond )
    {
        $this->order_by[] = [
            'field' => $field,
            'cond' => $cond
        ];
    }

    public function setLimit($from , $count )
    {
        if(is_numeric($from) && is_numeric($count)){
            $this->limit = [
                'from' => $from,
                'count' => $count
            ];
        }
    }
}