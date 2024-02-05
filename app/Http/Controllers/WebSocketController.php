<?php

namespace App\Http\Controllers;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketController implements MessageComponentInterface
{
    protected $clients;
    protected $activeGames = [];

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "Nueva conexión! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        echo "Mensaje recibido: " . $msg . "\n";
        $data = json_decode($msg, true);

        if (isset($data['play']) && isset($data['userId'])) {
            $this->activeGames[$from->resourceId] = [
                'play' => $data['play'],
                'userId' => $data['userId'],
                'userName' => $data['userName'],
            ];
        
            if (count($this->activeGames) == 2) {
                $games = array_values($this->activeGames);
                $result = $this->evaluateGame($games);
        
                foreach ($this->clients as $client) {
                    // Modificamos la estructura del mensaje para incluir userPlay, opponentPlay y userName del ganador
                    $winnerId = $result['winner'];
                    $winnerName = ($games[0]['userId'] === $winnerId) ? $games[0]['userName'] : $games[1]['userName'];
                
                    $client->send(json_encode([
                        'action' => 'result',
                        'result' => $result['message'],
                        'userPlay' => $games[0]['play'],
                        'opponentPlay' => $games[1]['play'],
                        'winnerName' => $winnerName, // Envía el nombre del jugador ganador
                    ]));
                }
                
                // Guardar la partida en la base de datos
                $winnerId = $result['winner'];
                $loserId = ($games[0]['userId'] === $winnerId) ? $games[1]['userId'] : $games[0]['userId'];

                \App\Models\GameResult::create([
                    'user_id' => $winnerId,
                    'result' => 'win',
                ]);

                \App\Models\GameResult::create([
                    'user_id' => $loserId,
                    'result' => 'lose',
                ]);

                $this->activeGames = [];
            }

            $confirmation = ['action' => 'confirmation', 'message' => 'Mensaje recibido'];
            $from->send(json_encode($confirmation));
        }
    }


    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        unset($this->activeGames[$conn->resourceId]);
        echo "Conexión {$conn->resourceId} se ha desconectado\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Se ha producido un error: {$e->getMessage()}\n";
        $conn->close();
    }
    private function evaluateGame($games)
    {
        $rules = [
            'tijeras' => ['papel', 'lagarto'],
            'papel' => ['piedra', 'spock'],
            'piedra' => ['lagarto', 'tijeras'],
            'lagarto' => ['spock', 'papel'],
            'spock' => ['tijeras', 'piedra'],
        ];
    
        $play1 = $games[0]['play'];
        $userId1 = $games[0]['userId'];
        $userName1 = $games[0]['userName'];
    
        $play2 = $games[1]['play'];
        $userId2 = $games[1]['userId'];
        $userName2 = $games[1]['userName'];
    
        if ($play1 === $play2) {
            return ['message' => 'Empate', 'winner' => null, 'userName' => 'Empate'];
        }
    
        if (in_array($play2, $rules[$play1])) {
            return ['message' => "$userName1 gana", 'winner' => $userId1, 'userName' => $userName1];
        }
    
        return ['message' => "$userName2 gana", 'winner' => $userId2, 'userName' => $userName2];
    }
    
}
