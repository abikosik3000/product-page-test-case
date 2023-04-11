<?php

class Query{

    protected $options; 
    public function __construct(public $body = '',public $vars = []){}

    public function result(){
        /** @var PDO $pdo */
        global $pdo;
        $sth = $pdo->prepare($this->body);
        //var_dump($this->body);
        //var_dump($this->vars);
        $sth->execute($this->vars);
        return $sth->fetchAll();
    }

    public function applyOption(array $options){

        $this->applyWhereOption($options);
        $this->applyOrderOption($options);
        $this->applyLimitOption($options);
    }

    protected function applyWhereOption(array $options){

        //WHERE options
        if(isset($options['where'])){
            $this->body .= " WHERE ";
            foreach($options['where'] as $k => $cond){
                
                if(array_search($cond['sign'] , 
                    ["=" , ">=" , "<" ,">" ,"<=" , "Like" ]) === false){
                    continue;
                }

                $this->body .= "{$cond['field']} {$cond['sign']} ?";
                $this->vars[] = $cond['value'];

                if($k != array_key_last($options['where'])){
                    $this->body .= ',';
                }
            }
        }
    }

    protected function applyOrderOption($options){

        //ORDER options
        if(isset($options['order_by'])){
            $this->body .= " ORDER BY ";
            foreach($options['order_by'] as $name => $ord){

                if(array_search($ord , ['asc' , "desc"]) === false){
                    continue;
                }
                
                $this->body .= "$name $ord";

                if($name != array_key_last($options['order_by'])){
                    $this->body .= ',';
                }
            }
        }
    }

    protected function applyLimitOption($options){

        //LIMIT options
        if(isset($options['limit'])){
            if(is_numeric($options['limit']['from']) && is_numeric($options['limit']['count'])){
                $this->body .= " LIMIT {$options['limit']['from']} , {$options['limit']['count']}";
                //$this->vars[] = ;
                //$this->vars[] = (int)$options['limit']['count'];
                
            }
        }
    }
}