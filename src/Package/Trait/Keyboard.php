<?php
namespace Package\R3m\Io\Application\Trait;

use R3m\Io\Module\Data as Storage;

use R3m\Io\Node\Model\Node;

use Exception;

trait Keyboard {


    public function list($application){
        $application = new Storage($application);
        $object = $this->object();
        $node = new Node($object);
        $class = 'Keyboard';
        $role = $application->get('#rootNode.#role');
        if(empty($role)){
            throw new Exception('Role is missing');
        }
        $options = [];
        $options['sort'] = [];
        $options['sort']['uuid'] = 'ASC';
        $options['where'] = [];
        $options['where'][] = [
            'application' => [
                'value' => $application->get('uuid'),
                'operator' => '==='
            ]
        ];
        d($role);
        d($options);
        $count = $node->count($class, $role, $options);
        ddd($count);
        $response = $node->list($class, $role, $options);


        d($response);
//        $count =




        ddd($application);
    }

}
