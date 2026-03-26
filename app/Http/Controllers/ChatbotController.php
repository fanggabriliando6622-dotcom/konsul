<?php

namespace App\Http\Controllers;
use App\Models\ChatMessage;
use App\Models\Produk;
use App\Models\Dokter;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\Response;

class ChatbotController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);
        
        try {
            $customerId = Auth::guard('customer')->check() ? Auth::guard('customer')->user()->customerId : 'GUEST';

            // Save customer message
            ChatMessage::create([
                'chatDokterId'  => null, // ✅ Bot messages have no chatDokterId
                'customerId'    => $customerId,
                'message'       => $request->message,
                'sender_type'   => 'customer',
                'chat_type'     => 'bot',
                'created_at'    => now()
            ]);

            // Validate API credentials
            $apiKey = env('OPENROUTER_API_KEY');
            $apiEndpoint = env('OPENROUTER_API_ENDPOINT');
            
            if (empty($apiKey) || empty($apiEndpoint)) {
                Log::error('OpenRouter API credentials missing', [
                    'api_key_set' => !empty($apiKey),
                    'endpoint_set' => !empty($apiEndpoint)
                ]);
                
                return response()->json([
                    'reply' => 'Konfigurasi API belum lengkap. Hubungi administrator.'
                ], 500);
            }

            // Fetch Products and Doctors data for context
            $produkContext = Produk::select('produkName', 'price', 'qty')
                ->get()
                ->map(fn($p) => "- {$p->produkName}: Rp " . number_format($p->price, 0, ',', '.') . " (" . ($p->qty > 0 ? "Stok: {$p->qty}" : "Stok Habis") . ")")
                ->join("\n");

            $dokterContext = Dokter::select('dokterName', 'namaBidang', 'hargaKonsultasi', 'statusDokter')
                ->get()
                ->map(fn($d) => "- {$d->dokterName} ({$d->namaBidang}): Rp " . number_format($d->hargaKonsultasi, 0, ',', '.') . " [" . (strcasecmp($d->statusDokter, 'online') === 0 ? 'Tersedia' : 'Offline') . "]")
                ->join("\n");

            $systemPrompt = "Kamu adalah RuangKonsul AI Assistant, pakar kesehatan dan layanan dari platform RuangKonsul. 
Tujuanmu adalah membantu pengguna dengan informasi kesehatan yang akurat, menyarankan produk alat kesehatan (ALKES), dan membantu proses konsultasi dengan dokter kami.

INFORMASI PLATFORM:
- Website: RuangKonsul.com
- Layanan Utama: Konsultasi Dokter Online (Chat Dokter), Toko Alat Kesehatan (ALKES), Blog Kesehatan.
- Kategori Spesialis: Kesehatan Mental, Kesehatan Seksual, Parenting, Gaya Hidup Sehat, Penyakit Kronis, Gizi & Nutrisi.

LAYANAN UNGGULAN:
1. Chat Dokter: Pasien membayar biaya konsultasi terlebih dahulu, lalu bisa mulai chat privat.
2. Belanja ALKES: Berbagai alat medis mulai dari vitamin hingga alat diagnostik.

DATA PRODUK ALKES SAAT INI:
{$produkContext}

DATA DOKTER & BIAYA KONSULTASI SAAT INI:
{$dokterContext}

PEDOMAN MERESPON:
1. PERSONAL & EMPATI: Mulailah jawaban dengan nada ramah. Gunakan sapaan yang sopan. Jika pengguna mengeluh sakit, tunjukkan empati.
2. REKOMENDASI CERDAS: 
   - Jika pengguna bertanya soal gejala, berikan penjelasan singkat dan SANGAT SARANKAN untuk Chat Dokter. Sebutkan nama dokter spesialis yang relevan dari data di atas beserta harganya.
   - Jika pengguna butuh alat medis atau suplemen, sarankan produk dari daftar ALKES di atas beserta harganya.
3. FORMAT JAWABAN: Gunakan Bullet points atau List agar mudah dibaca di layar chat yang kecil. Gunakan **tebal** untuk poin penting.
4. KEBIJAKAN PRIVASI: Jangan meminta data pribadi yang sangat sensitif (Nomer KTP/Password).
5. BATASAN TOPIK: Jika ditanya hal di luar kesehatan/layanan (Politik, Hiburan umum, Gosip), jawab dengan: 'Mohon maaf, sebagai asisten RuangKonsul, saya hanya dapat membantu hal-hal seputar kesehatan dan layanan kami.'
6. CALL TO ACTION: Arahkan user untuk 'Klik menu Chat Dokter' atau 'Cek menu Produk' jika relevan.

Bahasa: Indonesia Formal-Casual (Friendly Professional).";

            // Call OpenRouter API
            $response = Http::timeout(15)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . config('laravel-openrouter.api_key'),
                    'Content-Type'  => 'application/json',
                    'HTTP-Referer'  => config('laravel-openrouter.referer', url('/')),
                    'X-Title'       => config('laravel-openrouter.title', 'RuangKonsul Chatbot')
                ])
                ->post(config('laravel-openrouter.api_endpoint') . 'chat/completions', [
                    'models' => [
                        'google/gemma-3-27b-it:free',
                        'meta-llama/llama-3.3-70b-instruct:free',
                        'openrouter/free'
                    ],
                    'route' => 'fallback',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => $systemPrompt
                        ],
                        [
                            'role' => 'user',
                            'content' => $request->message
                        ]
                    ]
                ]);

            if ($response->status() !== 200) {
                Log::error('OpenRouter API Error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                if ($response->status() === 429) {
                    $replyMessage = 'Mohon maaf, server AI kami sedang sangat sibuk saat ini. Mohon tunggu beberapa detik dan coba lagi.';
                } elseif ($response->status() === 401) {
                    $replyMessage = 'Mohon maaf, konfigurasi API Key kami tidak valid atau belum disetel dengan benar. Mohon periksa OPENROUTER_API_KEY.';
                } else {
                    $replyMessage = 'Mohon maaf, koneksi ke server AI sedang mengalami gangguan (Error ' . $response->status() . ').';
                }
            } else {
                $data = $response->json();
                
                if (!isset($data['choices'][0]['message']['content'])) {
                    Log::error('Invalid OpenRouter API response', [
                        'response' => $data
                    ]);
                    
                    $replyMessage = 'AI tidak memberikan balasan yang valid. Silakan coba lagi.';
                } else {
                    $replyMessage = $data['choices'][0]['message']['content'];
                }
            }

            // Save AI reply
            ChatMessage::create([
                'chatDokterId'  => null,
                'customerId'    => $customerId,
                'message'       => $replyMessage,
                'sender_type'   => 'bot',
                'chat_type'     => 'bot',
                'created_at'    => now()
            ]);

            return response()->json([
                'reply' => $replyMessage
            ]);

        } catch (\Exception $e) {
            Log::error('Chatbot Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            $fallbackMessage = 'Maaf, koneksi ke sistem kecerdasan buatan sedang terhambat (Timeout). Silakan ketik ulang kalimat Anda sesaat lagi.';
            
            // Simpan log cadangan agar tidak corrupt di front-end
            ChatMessage::create([
                'chatDokterId'  => null,
                'customerId'    => $customerId,
                'message'       => $fallbackMessage,
                'sender_type'   => 'bot',
                'chat_type'     => 'bot',
                'created_at'    => now()
            ]);

            return response()->json([
                'reply' => $fallbackMessage
            ]);
        }

    }
}
