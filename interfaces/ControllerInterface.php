<?php

namespace src\interfaces;



interface ControllerInterface{
    public function get($arr);
    public function post($arr);
    public function delete($arr);
    public function put($arr);
}

?>