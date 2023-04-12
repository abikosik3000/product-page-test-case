<?php

class Query{
 
    public function __construct(private $body = '',private $allowed_fields = [] ,private $vars = []){}

    public function result(array $options = []){
        /** @var PDO $pdo */
        global $pdo;

        $this->applyOption($options);
        $sth = $pdo->prepare($this->body);
        //var_dump($this->body);
        //var_dump($this->vars);
        $sth->execute($this->vars);
        return $sth->fetchAll();
    }

    private function applyOption(array $options){

        $this->applyWhereOption($options);
        $this->applyOrderOption($options);
        $this->applyLimitOption($options);
    }

    private function applyWhereOption(array $options){

        //WHERE options
        if(isset($options['where'])){
            $this->body .= " WHERE ";
            foreach($options['where'] as $k => $cond){
                
                if(array_search($cond['sign'] , 
                    ["=" , ">=" , "<" ,">" ,"<=" , "Like" ]) === false){
                    throw new Error("Field Error");
                }

                if(array_search($cond['field'] , $this->allowed_fields) === false){
                    throw new Error("Field Error");
                }

                $this->body .= " {$cond['field']} {$cond['sign']} ? ";
                $this->vars[] = $cond['value'];

                if($k != array_key_last($options['where'])){
                    $this->body .= 'AND';
                }
            }
        }
    }

    private function applyOrderOption($options){

        //ORDER options
        if(isset($options['order_by'])){
            $this->body .= " ORDER BY ";
            foreach($options['order_by'] as $name => $ord){

                if(array_search($ord , ['asc' , "desc"]) === false){
                    throw new Error("Field Error");
                }

                if(array_search($name , $this->allowed_fields) === false){
                    throw new Error("Field Error");
                }
                
                $this->body .= "$name $ord";

                if($name != array_key_last($options['order_by'])){
                    $this->body .= ',';
                }
            }
        }
    }

    private function applyLimitOption($options){

        //LIMIT options
        if(isset($options['limit'])){
            if(is_numeric($options['limit']['from']) && is_numeric($options['limit']['count'])){
                $this->body .= " LIMIT {$options['limit']['from']} , {$options['limit']['count']}";
            }
        }
    }
}