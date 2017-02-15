<?php

namespace app\settings;


use Mailgun\Mailgun;

class Domains
{
    public function getDomainsByName($domain) {
        $mgClient = new Mailgun(KEY);
        $result = $mgClient->get('domains/'.$domain);
        return $result;
    }
    public function getAllDomains($limit = 100,$skip = 0) {
        $mgClient = new Mailgun(KEY);
        $result = $mgClient->get('domains', array(
            'limit' => $limit,
            'skip' => $skip
        ));
        return $result;
    }
    public function createDomain($name,$smtp_password,$spam_action,$wildcard) {
        $mgClient = new Mailgun(KEY);
        $result = $mgClient->post('domains', array(
            'name' => $name,
            'smtp_password' => $smtp_password,
            'spam_action' => $spam_action,
            'wildcard' => $wildcard
        ));
        return $result;
    }
    public function deleteDomain($domain) {
        $mgClient = new Mailgun(KEY);
        $result = $mgClient->delete('domains/'.$domain);
        return $result;
    }
    public function credentialsDomain($domain,$limit = 100,$skip = 0) {
        $mgClient = new Mailgun(KEY);
        $result = $mgClient->get('domains/'.$domain.'/credentials', array(
            'limit' => $limit,
            'skip' => $skip
        ));
        return $result;
    }
    public function credentialsCreate($domain,$login,$password) {
        $mgClient = new Mailgun(KEY);
        $result = $mgClient->post('domains/'.$domain.'/credentials', array(
            'login' => $login,
            'password' => $password
        ));
        return $result;
    }
    public function credentialsUpdate($domain,$login,$password) {
        $mgClient = new Mailgun(KEY);
        $result = $mgClient->put('domains/'.$domain.'/credentials/'.$login, array(
            'password' => $password
        ));
        return $result;
    }
    public function credentialsDelete($domain,$login) {
        $mgClient = new Mailgun(KEY);
        $result = $mgClient->delete('domains/'.$domain.'/credentials/'.$login);
        return $result;
    }
    public function deliveryStatus($domain) {
        $mgClient = new Mailgun(KEY);
        $result = $mgClient->get('domains/'.$domain.'/connection');
        return $result;
    }
    public function deliveryUpdate($domain,$require_tls,$skip_verification) {
        $mgClient = new Mailgun(KEY);
        $result = $mgClient->put('domains/'.$domain.'/connection', array(
            'require_tls' => $require_tls,
            'skip_verification' => $skip_verification
        ));
        return $result;
    }
}