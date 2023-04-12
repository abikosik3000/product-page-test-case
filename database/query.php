<?php

/**
 * sql injection-protected query constructor
 */
class Query
{
    /**
     * construct
     * 
     * @param string $body
     * @param array $allowed_fields 
     * @param array $options
     */
    public function __construct(private $body = '',private $allowed_fields = [] ,private $vars = []){}

    /**
     * executes the request with the provided options
     * 
     * @param array $options
     */
    public function result(array $options = [])
    {
        /** @var PDO $pdo */
        global $pdo;

        try{
            $this->applyOption($options);
            $sth = $pdo->prepare($this->body);
            $sth->execute($this->vars);
            return $sth->fetchAll();
        }catch(Exception $e){
            return false;
        }
    }

    /**
     * constructs the request according to the options
     * 
     * @param array $options
     */
    private function applyOption(array $options)
    {

        $this->applyWhereOption($options);
        $this->applyOrderOption($options);
        $this->applyLimitOption($options);
    }

    /**
     * construct WHERE part querry
     * 
     * @param array $options
     */
    private function applyWhereOption(array $options)
    {
        if(isset($options['where'])){
            $this->body .= " WHERE ";
            foreach($options['where'] as $k => $cond){
                
                if(array_search($cond['sign'] , 
                    ["=" , ">=" , "<" ,">" ,"<=" , "Like" ]) === false){
                    throw new Error("Insection Error");
                }

                if(array_search($cond['field'] , $this->allowed_fields) === false){
                    throw new Error("Insection Error");
                }

                $this->body .= " {$cond['field']} {$cond['sign']} ? ";
                $this->vars[] = $cond['value'];

                if($k != array_key_last($options['where'])){
                    $this->body .= 'AND';
                }
            }
        }
    }

    /**
     * construct ORDER part querry
     * 
     * @param array $options
     */
    private function applyOrderOption($options)
    {
        if(isset($options['order_by'])){
            $this->body .= " ORDER BY ";
            foreach($options['order_by'] as $name => $ord){

                if(array_search($ord , ['asc' , "desc"]) === false){
                    throw new Error("Insection Error");
                }

                if(array_search($name , $this->allowed_fields) === false){
                    throw new Error("Insection Error");
                }
                
                $this->body .= "$name $ord";

                if($name != array_key_last($options['order_by'])){
                    $this->body .= ',';
                }
            }
        }
    }

    /**
     * construct LIMIT part querry
     * 
     * @param array $options
     */
    private function applyLimitOption($options)
    {
        if(isset($options['limit'])){
            if(is_numeric($options['limit']['from']) && is_numeric($options['limit']['count'])){
                $this->body .= " LIMIT {$options['limit']['from']} , {$options['limit']['count']}";
            }
        }
    }
}