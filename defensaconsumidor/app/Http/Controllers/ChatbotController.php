<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function process(Request $request)
    {
        $userMessage = $request->input('message');

        if (!$userMessage) {
            return response()->json(['reply' => 'No recibí tu mensaje.'], 400);
        }

        try {
            // Llamada a OpenAI
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                "model" => "gpt-4o-mini",  // O el modelo que uses
                "messages" => [
                    ["role" => "system", "content" => "Responde claro y útil. No des recomendaciones finales. Siempre responde basado en la información juridica de Posadas, Misiones, Argentina."],
                    ["role" => "user", "content" => $userMessage]
                ],
                "temperature" => 0.7
            ]);

            $reply = $response->json()['choices'][0]['message']['content'] ?? "Sin respuesta de la API.";

            return response()->json(['reply' => $reply]);

        } catch (\Exception $e) {
            return response()->json(['reply' => 'Error interno.'], 500);
        }
    }
}
