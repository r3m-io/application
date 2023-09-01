<?php
namespace Package\R3m\Io\Application\Trait;

use R3m\Io\Exception\FileWriteException;
use R3m\Io\Exception\ObjectException;
use R3m\Io\Module\Data as Storage;

use R3m\Io\Node\Model\Node;

use Exception;

trait Keyboard {


    /**
     * @throws ObjectException
     * @throws FileWriteException
     * @throws Exception
     */
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
            'attribute' => 'application',
            'value' => $application->get('uuid'),
            'operator' => '==='
        ];
        d($options);
        $count = $node->count($class, $role, $options);
        d($count);
        $options['limit'] = 4096;
        $page_max = ceil($count / $options['limit']);
        $result = [];
        for($page = 1; $page <= $page_max; $page++){
            $options['page'] = $page;
            $response = $node->list($class, $role, $options);
            foreach($response['list'] as $record){
                $result[] = $record;
            }
        }
        ddd($result);
    }

}
