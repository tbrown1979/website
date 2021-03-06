<?php
namespace Destiny\Discord;

use Destiny\Common\Config;
use Destiny\Common\Log;
use Destiny\Common\Session\Session;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class DiscordLogHandler extends AbstractProcessingHandler {

    /**
     * @var Client
     */
    private $guzzle;

    /**
     * MonologDiscordHandler constructor.
     * @param int $level
     * @param bool $bubble
     */
    public function __construct($level = Logger::DEBUG, $bubble = true) {
        $this->guzzle = new Client(['timeout' => 10, 'connect_timeout' => 10, 'http_errors' => false]);
        parent::__construct($level, $bubble);
    }

    /**
     * Writes the record down to the log of the implementing handler
     *
     * @param  array $record
     * @return void
     */
    protected function write(array $record) {
        $webhook = Config::$a['discord']['webhook'];
        if (empty($webhook)) {
            return;
        }
        try {
            $creds = Session::getCredentials();
            $username = $creds->isValid() ? "<https://www.destiny.gg/admin/user/{$creds->getUserId()}/edit|{$creds->getUsername()}>" : "";
            $color = $record['level'] >= 400 ? 'danger' : ($record['level'] >= 300 ? 'warning' : 'good');
            $this->guzzle->post($webhook, [
                RequestOptions::JSON => [
                    'username' => Config::$a['meta']['shortName'],
                    'text' => $record['message'],
                    'attachments' => [
                        [
                            'color' => $color,
                            'text' => "```" . $record['context']['trace'] . "```",
                            'fields' => [
                                [
                                    'title' => 'URL',
                                    'value' => $record['extra']['url'],
                                    'short' => false
                                ],
                                [
                                    'title' => 'User',
                                    'value' => empty($username) ? "none" : $username,
                                    'short' => false
                                ],
                                [
                                    'title' => 'Address',
                                    'value' => $record['extra']['ip'],
                                    'short' => true
                                ]
                            ],
                            'footer' => Config::$a['meta']['domain'],
                            'ts' => time()
                        ]
                    ]
                ],
            ]);
        } catch (\Exception $e) {
            Log::error("Error sending discord message." . $e->getMessage() . PHP_EOL . $e->getTraceAsString());
        }
    }
}