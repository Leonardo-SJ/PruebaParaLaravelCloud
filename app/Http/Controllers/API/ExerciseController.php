<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ExerciseController extends Controller
{
    public function getAllExercises()
    {
        try {
            $exercises = Cache::remember('all_exercises', now()->addHours(24), function () {
                $response = Http::timeout(30)
                    ->connectTimeout(10)
                    ->withOptions(['verify' => false])
                    ->get('https://v2.exercisedb.dev/api/v1/exercises');
                if ($response->failed()) {
                    throw new \Exception('La solicitud a la API falló con estado ' . $response->status());
                }
                Log::info('Ejercicios obtenidos exitosamente', ['count' => count($response->json())]);
                return $response->json();
            });
            return response()->json($exercises);
        } catch (\Exception $e) {
            Log::error('Error al obtener todos los ejercicios: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['error' => 'Error en la solicitud: ' . $e->getMessage()], 500);
        }
    }

    public function getBodyParts()
    {
        try {
            $bodyParts = Cache::remember('body_parts', now()->addHours(24), function () {
                $response = Http::timeout(30)
                    ->connectTimeout(10)
                    ->withOptions(['verify' => false])
                    ->get('https://v2.exercisedb.dev/api/v1/exercise/bodyPart/list');
                if ($response->failed()) {
                    throw new \Exception('La solicitud a la API falló con estado ' . $response->status());
                }
                Log::info('Partes del cuerpo obtenidas exitosamente', ['count' => count($response->json())]);
                return $response->json();
            });
            return response()->json($bodyParts);
        } catch (\Exception $e) {
            Log::error('Error al obtener partes del cuerpo: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['error' => 'Error en la solicitud: ' . $e->getMessage()], 500);
        }
    }

    public function getExercisesByBodyPart($bodyPart)
    {
        try {
            $exercises = Cache::remember("exercises_bodypart_{$bodyPart}", now()->addHours(24), function () use ($bodyPart) {
                $response = Http::timeout(30)
                    ->connectTimeout(10)
                    ->withOptions(['verify' => false])
                    ->get('https://v2.exercisedb.dev/api/v1/exercises', [
                        'bodyPart' => $bodyPart
                    ]);
                if ($response->failed()) {
                    throw new \Exception('La solicitud a la API falló con estado ' . $response->status());
                }
                Log::info("Ejercicios obtenidos para $bodyPart", ['count' => count($response->json())]);
                return $response->json();
            });
            return response()->json($exercises);
        } catch (\Exception $e) {
            Log::error("Error al obtener ejercicios para la parte del cuerpo $bodyPart: " . $e->getMessage(), ['exception' => $e]);
            return response()->json(['error' => 'Error en la solicitud: ' . $e->getMessage()], 500);
        }
    }
}