<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrackPoint;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        /* Проверка валидации полей */
        // $request->validate([
        //     'device_id' => 'required|string',
        //     'latitude'  => 'required|numeric',
        //     'longitude' => 'required|numeric'
        // ]);

        /* Передача данных из запроса в модель приложения для записи в таблицу базы */
        TrackPoint::create([
            'device_id' => $request->device_id,
            'lat'  => $request->lat,
            'lon' => $request->lon
        ]);

        /* Если API ключ не совпадает с тем что указана в env, то в таком случае обрубаем запрос, а если все ок, то возвращаем true */
        if ($request->api_key !== env('TRACKER_API_KEY')) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        } else {
            Log::info('Garmin request', $request->all());
            return response()->json([
                'received' => $request->all()
            ]);
        }
        Log::info('Garmin request', $request->all());
            return response()->json([
                'received' => $request->all()
            ]);
    }
}
