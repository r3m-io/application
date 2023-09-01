<?php
namespace Package\R3m\Io\Application\Trait;

use R3m\Io\Node\Model\Node;

trait Keyboard {


    public function list($application){
        $object = $this->object();
        $node = new Node($object);

        d($node);
//        $count =




        ddd($application);
    }

}
