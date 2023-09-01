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
        $count = $node->count($class, $role, $options);
        if($count === 0){
            return [];
        }
        $options['limit'] = 4096;
        $page_max = ceil($count / $options['limit']);
        $result = [];
        $options['where'] = [];
        $options['where'][] = [
            'attribute' => 'application.uuid',
            'value' => $application->get('uuid'),
            'operator' => '==='
        ];
        $options['relation'] = false;
        for($page = 1; $page <= $page_max; $page++){
            $options['page'] = $page;
            $response = $node->list($class, $role, $options);
            ddd($response);
            if(
                array_key_exists('list', $response) &&
                is_array($response['list'])
            ){
                foreach($response['list'] as $record){
                    $result[] = $record;
                }
            }
        }
        return $result;
    }

}
