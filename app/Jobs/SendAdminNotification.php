<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendAdminNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $adminPhone;
    protected $message;

    /**
     * Create a new job instance.
     *
     * @param string $adminPhone
     * @param string $message
     */
    public function __construct($adminPhone, $message)
    {
        $this->adminPhone = $adminPhone;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $response = Http::post('http://localhost:3000/send-message', [
                'numbers' => [$this->adminPhone],
                'message' => $this->message,
            ]);

            if ($response->successful()) {
                Log::info("Notifikasi berhasil dikirim ke {$this->adminPhone}");
            } else {
                Log::error("Gagal mengirim notifikasi ke {$this->adminPhone}: {$response->body()}");
            }
        } catch (\Exception $e) {
            Log::error("Terjadi kesalahan saat mengirim notifikasi ke {$this->adminPhone}: " . $e->getMessage());
        }
    }
}
