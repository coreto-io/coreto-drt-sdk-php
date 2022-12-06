<?php

namespace Coreto\CoretoDRTSDK;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class Client
{
    private $apiUrl;
    private $callerAccountId;
    private $callerPrivateKey;

    public function __construct(
        string $apiUrl,
        string $callerAccountId,
        string $callerPrivateKey
    ) {
        $this->apiUrl = $apiUrl;
        $this->callerAccountId = $callerAccountId;
        $this->callerPrivateKey = $callerPrivateKey;
    }

    private function isResponseStatusOk(Response $response) : bool {
        switch ($response->status()) {
            case 200:
                $json = $response->json();

                if (isset($json['error'])) {
                    return false;
                }

                return true;
            default:
                return false;
        }
    }

    public function saveActionsBatch($payload) {
        $url = rtrim($this->apiUrl, '/') . '/drt/save_actions_batch';

        $payload['caller_account_id'] = $this->callerAccountId;
        $payload['caller_private_key'] = $this->callerPrivateKey;

        $response = Http::post($url, $payload);

        if (!$this->isResponseStatusOk($response)) {
            return null;
        }

        return $response->json();
    }

    public function saveAction($payload) {
        $url = rtrim($this->apiUrl, '/') . '/drt/save_action';

        $payload['caller_account_id'] = $this->callerAccountId;
        $payload['caller_private_key'] = $this->callerPrivateKey;

        $response = Http::post($url, $payload);

        if (!$this->isResponseStatusOk($response)) {
            return null;
        }

        return $response->json();
    }

    public function getUserActions($payload) {
        $url = rtrim($this->apiUrl, '/') . '/drt/get_user_actions';

        $response = Http::post($url, $payload);

        if (!$this->isResponseStatusOk($response)) {
            return [];
        }

        return $response->json();
    }

    public function getUserTrustActions($payload) {
        $url = rtrim($this->apiUrl, '/') . '/drt/get_user_trust_actions';

        $response = Http::post($url, $payload);

        if (!$this->isResponseStatusOk($response)) {
            return [];
        }

        return $response->json();
    }

    public function getUserPerformanceActions($payload) {
        $url = rtrim($this->apiUrl, '/') . '/drt/get_user_performance_actions';

        $response = Http::post($url, $payload);

        if (!$this->isResponseStatusOk($response)) {
            return [];
        }

        return $response->json();
    }

    public function getSourceActionTypes($payload) {
        $url = rtrim($this->apiUrl, '/') . '/drt/get_source_action_types';

        $response = Http::post($url, $payload);

        if (!$this->isResponseStatusOk($response)) {
            return [];
        }

        return $response->json();
    }

    public function createDID($payload) {
        $url = rtrim($this->apiUrl, '/') . '/did/create_did';

        $response = Http::post($url, $payload);

        if (!$this->isResponseStatusOk($response)) {
            return null;
        }

        return $response->json();
    }

    public function putDID($payload) {
        $url = rtrim($this->apiUrl, '/') . '/did/put_did';

        $payload['caller_account_id'] = $this->callerAccountId;
        $payload['caller_private_key'] = $this->callerPrivateKey;

        $response = Http::post($url, $payload);

        if (!$this->isResponseStatusOk($response)) {
            return null;
        }

        return $response->json();
    }

    public function getDID($payload) {
        $url = rtrim($this->apiUrl, '/') . '/did/get_did';

        $response = Http::post($url, $payload);

        if (!$this->isResponseStatusOk($response)) {
            return null;
        }

        return $response->json();
    }

    public function hasDID($payload) {
        $url = rtrim($this->apiUrl, '/') . '/did/has_did';

        $response = Http::post($url, $payload);

        if (!$this->isResponseStatusOk($response)) {
            return null;
        }

        return $response->json();
    }

    public function transferDID($payload) {
        $url = rtrim($this->apiUrl, '/') . '/did/transfer_did';

        $payload['caller_account_id'] = $this->callerAccountId;
        $payload['caller_private_key'] = $this->callerPrivateKey;

        $response = Http::post($url, $payload);

        if (!$this->isResponseStatusOk($response)) {
            return null;
        }

        return $response->json();
    }

    public function getCurrentBlockHeight() {
        $url = rtrim($this->apiUrl, '/') . '/current_block_height';

        $response = Http::get($url);

        if (!$this->isResponseStatusOk($response)) {
            return -1;
        }

        return $response->json()['block_height'];
    }

    public function getBalance($accountId) {
        $url = rtrim($this->apiUrl, '/') . "/balance/{$accountId}";

        $response = Http::get($url);

        if (!$this->isResponseStatusOk($response)) {
            return null;
        }

        return $response->json();
    }
}
