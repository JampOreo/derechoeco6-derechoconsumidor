<?php

namespace App\Http\Controllers;

use App\Models\Juridico;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function chatbot(Request $request)
    {
        $request->validate(['message' => 'required|string']);

        $userMessage = strtolower(trim($request->message));
        $response = "Lo siento, no encontré información relacionada con tu pregunta. Puedes revisar el <a href='" . route('juridico.index') . "' target='_blank'>contenido jurídico</a> o contactarnos directamente.";

        // Palabras a ignorar (stop words en español)
        $stopWords = ['el', 'la', 'los', 'las', 'un', 'una', 'unos', 'unas', 'de', 'del', 'y', 'o', 'en', 'a', 'al', 'con', 'por', 'para', 'que', 'como', 'cuando', 'donde', 'quien', 'sobre', 'hacia', 'desde', 'hasta', 'entre', 'sin', 'es', 'son', 'fue', 'ser', 'estar', 'tiene', 'tengo', 'tienes', 'tiene', 'tenemos', 'tienen'];

        // Extraer palabras significativas
        $words = array_filter(
            array_map('trim', explode(' ', $userMessage)),
            function ($word) use ($stopWords) {
                return strlen($word) > 3 && !in_array($word, $stopWords);
            }
        );

        if (empty($words)) {
            $words = explode(' ', $userMessage);
        }

        $bestMatch = null;
        $maxScore = 0;

        $juridicos = Juridico::all();

        foreach ($juridicos as $juridico) {
            $text = strtolower($juridico->titulo . ' ' . $juridico->contenido);
            $score = 0;

            foreach ($words as $word) {
                if (strpos($text, $word) !== false) {
                    $score++;
                }
            }

            if ($score > $maxScore) {
                $maxScore = $score;
                $bestMatch = $juridico;
            }
        }

        if ($bestMatch && $maxScore > 0) {
            $response = $bestMatch->contenido;
        }

        return response()->json(['reply' => $response]);
    }
}