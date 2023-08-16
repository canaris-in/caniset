<?php

namespace App\Jobs;

use App\Models\ApiData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class FetchApiData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $url = "http://127.0.0.1:8000/discover/";
        $response = Http::get($url);
        if ($response->successful()) {
            $data = $response->json();
            ApiData::create(['data' => $data]);
            // Process and store $data as needed
        } else {
            // Handle API error
            $statusCode = $response->status();
            Log::error("API request failed with status code: $statusCode");
            // Log the error or perform any other action
        }
        // $data = $response->json();

        
    }
}
