<?php

/**
 * sql injection-protected query constructor
 */
class Query
{
    /**
     * construct
     * 
     * @param string $options
     * @param array $allowed_fields 
     * @param array $options
     */
    public function __construct(private $body = '',private $allowed_fields = [] ,private $vars = []){}

    /**
     * executes the request with the provided options
     * 
     * @param QueryFilters $options
     */
    public function result(QueryFilters $options = new QueryFilters())
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
     * @param QueryFilters $options
     */
    private function applyOption(QueryFilters $options)
    {
        $this->applyWhereOption($options->where);
        $this->applyOrderOption($options->order_by);
        $this->applyLimitOption($options->limit);
    }

    /**
     * construct WHERE part querry
     * 
     * @param array $options
     */
    private function applyWhereOption(array $options)
    {
        if (count($options) > 0) {
            $this->body .= " WHERE ";

            foreach ($options as $k => $cond) {
                
                if (array_search($cond['sign'] , 
                    ["=" , ">=" , "<" ,">" ,"<=" , "Like" ]) === false) {
                    throw new Error("Insection Error");
                }

                if (array_search($cond['field'] , $this->allowed_fields) === false) {
                    throw new Error("Insection Error");
                }

                $this->body .= " {$cond['field']} {$cond['sign']} ? ";
                $this->vars[] = $cond['value'];

                if($k != array_key_last($options)){
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
    private function applyOrderOption(array $options)
    {
        if (count($options) > 0) {
            $this->body .= " ORDER BY ";
            foreach ($options as $k => $ord) {

                if (array_search($ord['cond'] , ['asc' , "desc"]) === false) {
                    throw new Error("Insection Error");
                }

                if (array_search($ord['field'] , $this->allowed_fields) === false) {
                    throw new Error("Insection Error");
                }
                
                $this->body .= "{$ord['field']} {$ord['cond']}";

                if ($k != array_key_last($options)) {
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
    private function applyLimitOption(array $options)
    {
        if(count($options) > 0){
            $this->body .= " LIMIT {$options['from']} , {$options['count']}";
        }
    }
}