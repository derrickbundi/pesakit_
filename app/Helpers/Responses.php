<?php
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;

function _httpOk($message) {
    return response()->json(
        [
            'code' => Response::HTTP_OK,
            'message' => $message,
        ], Response::HTTP_OK
    );
}

function _httpCreated($message) {
    return response()->json(
        [
            'code' => Response::HTTP_CREATED,
            'message' => $message
        ], Response::HTTP_CREATED
    );
}

function _httpBadRequest($message) {
    return response()->json(
        [
            'code' => Response::HTTP_BAD_REQUEST,
            'message' => $message,
        ], Response::HTTP_BAD_REQUEST
    );
}

/**
 * generate token function
 */

function _Token(string $email, string $password) {
    $client = new Client;
    $form = [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => config('services.passport_client_id'),
            'client_secret' => config('services.passport_client_secret'),
            'username' => $email,
            'password' => $password,
            'scope' => '*'
        ]
    ];
    $response = $client->post(config('services.token_url'),$form);
    $token = json_decode((string)$response->getBody(), true);
    return $token;
}