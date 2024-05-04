<?php
// src/Service/VmwareWorkstationService.php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class VmwareWorkstationService
{
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client([
            'base_uri' => "http://127.0.0.1:8697/api/",
            'timeout' => 5, // Adjust timeout as needed
        ]);
    }

    public function getVirtualMachines()
    {
        try {
            $response = $this->httpClient->request('GET', 'vms', [
                'headers' => [
                    'Accept' => "application/vnd.vmware.vmw.rest-v1+json",
                    'Authorization' => "Basic cm9vdDpSb290MTIzLg=="
                ]
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
// Handle exceptions
            return [];
        }
    }

    public function getVirtualMachineById(string $id)
    {
        try {
            $response = $this->httpClient->request('GET', 'vms/' . $id, [
                'headers' => [
                    'Accept' => 'application/vnd.vmware.vmw.rest-v1+json',
                    'Authorization' => 'Basic cm9vdDpSb290MTIzLg=='
                ]
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            // Handle exceptions
            return null;
        }
    }

    public function getRestriction(string $id)
    {
        try {
            $response = $this->httpClient->request('GET', 'vms/' . $id . '/restrictions', [
                'headers' => [
                    'Accept' => 'application/vnd.vmware.vmw.rest-v1+json',
                    'Authorization' => 'Basic cm9vdDpSb290MTIzLg=='
                ]
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            // Handle exceptions
            return null;
        }
    }

    public function updateVirtualMachine(string $id, int $processors, int $memory)
    {
        $url = 'http://127.0.0.1:8697/api/vms/' . $id;
        try {
            $response = $this->httpClient->request('PUT', $url, [
                'json' => [

                    'cpu' => ['processors' => $processors],
                    'memory' => $memory
                ],
                'headers' => [
                    'Content-Type' => 'application/vnd.vmware.vmw.rest-v1+json',
                    'Authorization' => 'Basic cm9vdDpSb290MTIzLg== -d @- <<REQUEST_BODY '
                ]
            ]);
            if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
                return $response->toArray();
            } else {
                return ['error' => 'Erreur lors de la mise à jour de la machine virtuelle'];
            }
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getIp(string $id)
    {
        try {
            $response = $this->httpClient->request('GET', 'vms/' . $id . '/ip', [
                'headers' => [
                    'Accept' => 'application/vnd.vmware.vmw.rest-v1+json',
                    'Authorization' => 'Basic cm9vdDpSb290MTIzLg=='
                ]
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            // Handle exceptions
            return null;
        }
    }
}