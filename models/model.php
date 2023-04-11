<?php
require_once "../database/query.php";

abstract class Model{

    abstract public static function getData($options = []);
}