<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Cloudinary\Cloudinary;

class VideoController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:10240',
            'prompt' => 'required|string|max:1000',
        ]);

        try {
            /*
            |--------------------------------------------------------------------------
            | Cloudinary Upload
            |--------------------------------------------------------------------------
            */

            $cloudinary = new Cloudinary(config('cloudinary.cloud_url'));

            $upload = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath(), [
                'folder' => 'ai-video',
            ]);

            $imageUrl = $upload['secure_url'];

            /*
            |--------------------------------------------------------------------------
            | Create AI Prediction
            |--------------------------------------------------------------------------
            */
            $prompt = $request->prompt;

            $response = Http::timeout(300)
                ->connectTimeout(60)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . env('REPLICATE_API_TOKEN'),
                    'Content-Type' => 'application/json',
                    'Prefer' => 'wait',
                ])
                ->post('https://api.replicate.com/v1/models/minimax/video-01/predictions', [
                    'input' => [
                        'prompt' => $prompt,
                        'prompt_optimizer' => true,
                        'first_frame_image' => $imageUrl,
                    ],
                ]);

            $data = $response->json();

            /*
            |--------------------------------------------------------------------------
            | Debug Error
            |--------------------------------------------------------------------------
            */

            if (!isset($data['id'])) {
                return response()->json([
                    'success' => false,
                    'response' => $data,
                ]);
            }

            $predictionId = $data['id'];

            $videoUrl = null;

            /*
            |--------------------------------------------------------------------------
            | Polling Result
            |--------------------------------------------------------------------------
            */

            for ($i = 0; $i < 40; $i++) {
                sleep(5);

                $result = Http::withHeaders([
                    'Authorization' => 'Bearer ' . env('REPLICATE_API_TOKEN'),
                ])->get("https://api.replicate.com/v1/predictions/$predictionId");

                $resultData = $result->json();

                /*
                |--------------------------------------------------------------------------
                | Success
                |--------------------------------------------------------------------------
                */

                if (isset($resultData['status']) && $resultData['status'] === 'succeeded') {
                    if (isset($resultData['output']) && !empty($resultData['output'])) {
                        $videoUrl = is_array($resultData['output']) ? $resultData['output'][0] : $resultData['output'];
                    }

                    break;
                }

                /*
                |--------------------------------------------------------------------------
                | Failed
                |--------------------------------------------------------------------------
                */

                if (isset($resultData['status']) && $resultData['status'] === 'failed') {
                    return response()->json([
                        'success' => false,
                        'message' => 'AI gagal generate video',
                        'response' => $resultData,
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Timeout
            |--------------------------------------------------------------------------
            */

            if (!$videoUrl) {
                return response()->json([
                    'success' => false,
                    'message' => 'Video masih diproses',
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Success
            |--------------------------------------------------------------------------
            */

            return view('result', [
                'video' => $videoUrl,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
