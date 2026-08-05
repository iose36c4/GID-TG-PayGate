<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.telegram.org/',
            'timeout' => 10,
        ]);
    }

    public function getBotInfo(string $token): array
    {
        try {
            $response = $this->client->get("bot{$token}/getMe");
            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (GuzzleException $e) {
            Log::error('Telegram getMe failed', [
                'error' => $e->getMessage(),
            ]);

            return ['ok' => false, 'description' => 'Error de conexión con Telegram'];
        }
    }

    public function getChatMember(string $token, string $chatId, int $userId): array
    {
        try {
            $response = $this->client->get("bot{$token}/getChatMember", [
                'query' => [
                    'chat_id' => $chatId,
                    'user_id' => $userId,
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            Log::error('Telegram getChatMember failed', [
                'error' => $e->getMessage(),
                'chat_id' => $chatId,
                'user_id' => $userId,
            ]);

            return ['ok' => false];
        }
    }

    public function sendMessage(string $token, string $chatId, string $text, array $options = []): array
    {
        try {
            $response = $this->client->post("bot{$token}/sendMessage", [
                'json' => array_merge([
                    'chat_id' => $chatId,
                    'text' => $text,
                    'parse_mode' => 'HTML',
                ], $options),
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            Log::error('Telegram sendMessage failed', [
                'error' => $e->getMessage(),
                'chat_id' => $chatId,
            ]);

            return ['ok' => false];
        }
    }

    public function revokeChatInviteLink(string $token, string $chatId, string $inviteLink): array
    {
        try {
            $response = $this->client->post("bot{$token}/revokeChatInviteLink", [
                'json' => [
                    'chat_id' => $chatId,
                    'invite_link' => $inviteLink,
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            Log::error('Telegram revokeChatInviteLink failed', [
                'error' => $e->getMessage(),
                'chat_id' => $chatId,
            ]);

            return ['ok' => false];
        }
    }

    public function createChatInviteLink(string $token, string $chatId, array $options = []): array
    {
        try {
            $response = $this->client->post("bot{$token}/createChatInviteLink", [
                'json' => array_merge([
                    'chat_id' => $chatId,
                ], $options),
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            Log::error('Telegram createChatInviteLink failed', [
                'error' => $e->getMessage(),
                'chat_id' => $chatId,
            ]);

            return ['ok' => false];
        }
    }

    public function banChatMember(string $token, string $chatId, int $userId): array
    {
        try {
            $response = $this->client->post("bot{$token}/banChatMember", [
                'json' => [
                    'chat_id' => $chatId,
                    'user_id' => $userId,
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            Log::error('Telegram banChatMember failed', [
                'error' => $e->getMessage(),
                'chat_id' => $chatId,
                'user_id' => $userId,
            ]);

            return ['ok' => false];
        }
    }

    public function unbanChatMember(string $token, string $chatId, int $userId): array
    {
        try {
            $response = $this->client->post("bot{$token}/unbanChatMember", [
                'json' => [
                    'chat_id' => $chatId,
                    'user_id' => $userId,
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            Log::error('Telegram unbanChatMember failed', [
                'error' => $e->getMessage(),
                'chat_id' => $chatId,
                'user_id' => $userId,
            ]);

            return ['ok' => false];
        }
    }
}
