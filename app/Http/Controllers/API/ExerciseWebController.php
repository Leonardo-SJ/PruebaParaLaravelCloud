<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ExerciseWebController extends Controller
{
    public function index()
    {
        // Obtener lista de partes del cuerpo desde caché o API
        $bodyParts = Cache::remember('body_parts', now()->addHours(24), function () {
            try {
                $response = Http::timeout(30)
                    ->connectTimeout(10)
                    // Deshabilitar verificación SSL temporalmente (solo para pruebas)
                    ->withOptions(['verify' => false])
                    ->get('https://v2.exercisedb.dev/api/v1/exercise/bodyPart/list');
                if ($response->successful()) {
                    Log::info('Partes del cuerpo obtenidas exitosamente', ['count' => count($response->json())]);
                    return $response->json();
                }
                Log::warning('API de partes del cuerpo falló, usando datos de respaldo', ['status' => $response->status()]);
                return ['chest', 'back', 'arms', 'legs', 'shoulders', 'abs', 'cardio', 'full body'];
            } catch (\Exception $e) {
                Log::error('Error al obtener partes del cuerpo: ' . $e->getMessage(), ['exception' => $e]);
                return ['chest', 'back', 'arms', 'legs', 'shoulders', 'abs', 'cardio', 'full body'];
            }
        });

        return view('EjerciciosCuerpo', compact('bodyParts'));
    }
}