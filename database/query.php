<?php

class Query{
    public function __construct(public $body = '',public $vars = []){}

    
    protected function applyOption(Query &$query, array $options){

        Model::applyWhereOption($query , $options);
        Model::applyOrderOption($query , $options);
        Model::applyLimitOption($query , $options);

        unset($query);
    }

    static protected function applyWhereOption(&$query , $options){

        //WHERE options
        if(isset($options['where'])){
            $query .= " WHERE ";
            foreach($options['where'] as $name => $cond){

                $query .= "{$name} {$cond['sign']} {$cond['value']}";
                if($name != array_key_last($options['where'])){
                    $query .= ',';
                }
            }
        }
    }

    static protected function applyOrderOption(&$query , $options){

        //ORDER options
        if(isset($options['order_by'])){
            $query .= " ORDER BY ";
            foreach($options['order_by'] as $name => $ord){
                $query .= "$name $ord";
                if($name != array_key_last($options['order_by'])){
                    $query .= ',';
                }
            }
        }
    }

    static protected function applyLimitOption(&$query , $options){

        //Limit options
        if(isset($options['limit'])){
            $query .= " LIMIT {$options['limit']['from']} , {$options['limit']['count']}";
        }
    }
}