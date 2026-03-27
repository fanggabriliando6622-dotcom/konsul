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
                Log::error('OpenRouter API credentials missing');
                
                return response()->json([
                    'reply' => 'Mohon maaf, chatbot sedang dalam pemeliharaan. Silakan hubungi admin.'
                ], 200);
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

            $systemPrompt = "Kamu adalah RuangKonsul AI Assistant, pakar kesehatan dan asisten layanan dari platform RuangKonsul. 
            
            ATURAN INTERAKSI:
            1. DIALOGIS & RAMAH: Kamu diperbolehkan melakukan percakapan dasar (salam, terima kasih, menanyakan kabar) untuk membangun kenyamanan dengan pengguna secara profesional.
            2. FOKUS KESEHATAN: Selain percakapan/basa-basi dasar, inti jawabanmu WAJIB seputar kesehatan atau layanan RuangKonsul. Jangan menjawab pertanyaan substantif di luar kesehatan (e.g. Politik, Hiburan, Matematika, Coding).
            3. PENOLAKAN SOPAN: Jika user bertanya hal di luar kesehatan (selain salam/terima kasih), jawab: 'Mohon maaf, sebagai asisten RuangKonsul, saya hanya dapat membantu hal-hal seputar kesehatan dan layanan kami.'
            
            INFORMASI PLATFORM:
            - RuangKonsul: Konsultasi dokter online, Belanja ALKES, Janji Temu (Appointment).
            - Spesialis: Mental, Seksual, Parenting, Lifestyle, Kronis, Gizi.
            
            DATA DOKTER & PRODUK (REAL-TIME):
            {$produkContext}
            {$dokterContext}
            
            PEDOMAN JAWABAN:
            - Empati & Ramah. 
            - Jika user tanya gejala, sarankan 'Chat Dokter' (spesialis yang cocok).
            - Jika user tanya alat/vit, sarankan produk dari daftar.
            - Gunakan Bullet points & **Bold**.
            - Bahasa: Indonesia.";

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
