<?php

namespace app\settings;


use Mailgun\Mailgun;

class Routes
{
    public function getAllRoutes($limit = 100, $skip = 0)
    {
        $mgClient = new Mailgun(KEY);
        $result = $mgClient->get('routes', array(
            'limit' => $limit,
            'skip' => $skip
        ));
        return $result;
    }

    public function getRoutesById($id)
    {
        $mgClient = new Mailgun(KEY);
        $result = $mgClient->get('routes' . $id);
        return $result;
    }

    public function createRoutes($priority, $description, $expression, $action)
    {
        $mgClient = new Mailgun(KEY);
        $result = $mgClient->post('routes', array(
            'priority' => $priority,
            'description' => $description,
            'expression' => $expression,
            'action:' => $action
        ));
        return $result;
    }

    public function updateRoutes($id, $priority, $description, $expression, $action)
    {
        $mgClient = new Mailgun(KEY);
        $result = $mgClient->put('routes/' . $id, array(
            'priority' => $priority,
            'description' => $description,
            'expression' => $expression,
            'action:' => $action
        ));
        return $result;
    }
    public function deleteRoutes($id) {
        $mgClient = new Mailgun(KEY);
        $result = $mgClient->delete('routes/'.$id);
        return $result;
    }
}