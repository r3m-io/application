<?php
namespace Package\R3m\Io\Application\Trait;

use R3m\Io\Module\Data as Storage;
use R3m\Io\Node\Model\Node;

trait Keyboard {


    public function list($application){
        $application = new Storage($application);
        $object = $this->object();
        $node = new Node($object);
        $class = 'Keyboard';
        $role = $application->get('#role');
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
        $options['where'][] = 'and';
        $options['where'][] = [
            'host' => [
                'value' => $application->get('host.uuid'),
                'operator' => '==='
            ]
        ];
        d($options);
        $count = $node->count($class, $role, $options);
        ddd($count);
        $response = $node->list($class, $role, $options);


        d($response);
//        $count =




        ddd($application);
    }

}
