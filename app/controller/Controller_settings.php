<?php

namespace app\controller;


use app\settings\Domains;

class Controller_settings
{
    public function Call() {
        try {
            $domains = new Domains();
            $result = $domains->getAllDomains();
            $result = $result->http_response_body->items;
            $data['domains'] = json_decode(json_encode($result), true);
        } catch (\Exception $e) {
            if(!empty($e)) {
                $error = array('error' => $e->getMessage());
            }
        } finally {
            if(!empty($error)) {
                $data[] = array('message' => $error);
            }
            return $data;
        }
    }
}