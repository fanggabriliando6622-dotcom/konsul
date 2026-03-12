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
            $produkContext = Produk::select('produkName', 'price')
                ->get()
                ->map(fn($p) => "- {$p->produkName}: Rp " . number_format($p->price, 0, ',', '.'))
                ->join("\n");

            $dokterContext = Dokter::select('dokterName', 'namaBidang', 'hargaKonsultasi')
                ->get()
                ->map(fn($d) => "- {$d->dokterName} ({$d->namaBidang}): Rp " . number_format($d->hargaKonsultasi, 0, ',', '.'))
                ->join("\n");

            $systemPrompt = "Kamu adalah AI Specialist dari RuangKonsul. Tugas utamamu adalah memberikan informasi yang berkaitan dengan kesehatan, konsultasi medis, dan layanan di website RuangKonsul.

INFORMASI LAYANAN:
RuangKonsul adalah platform layanan kesehatan digital terpercaya. Kami menyediakan:
1. Konsultasi Dokter (Chat Dokter): Layanan chat privat dengan dokter profesional.
2. Penjualan Alat Kesehatan (ALKES): Berbagai produk alat kesehatan berkualitas.
3. Layanan Spesialisasi:
   - Kesehatan Mental: Mengelola stres, kecemasan, dan kesehatan jiwa.
   - Kesehatan Seksual: Konsultasi privat dan profesional.
   - Parenting: Pendampingan tumbuh kembang anak.
   - Gaya Hidup Sehat: Panduan pola hidup seimbang.
   - Penyakit Kronis: Pengelolaan penyakit jangka panjang (seperti diabetes, hipertensi).
   - Gizi / Nutrisi: Konsultasi pemenuhan kebutuhan nutrisi tubuh.

INFORMASI KESEHATAN (BLOG):
- 'Mens sana in corpore sano' (Jiwa yang sehat dalam tubuh yang sehat).
- Pentingnya deteksi dini (cek tekanan darah, gula darah, kolesterol) untuk mencegah penyakit kronis.
- Kesehatan mental sama pentingnya dengan kesehatan fisik; hindari burnout dengan self-care dan istirahat yang cukup.

DATA PRODUK ALKES:
{$produkContext}

DATA HARGA CHAT DOKTER:
{$dokterContext}

INSTRUKSI KHUSUS:
1. Jika pengguna bertanya tentang harga produk ALKES atau biaya chat dokter, berikan informasi berdasarkan data di atas.
2. Jika pengguna meminta filter harga 'terjangkau' (termurah) atau 'tertinggi' (termahal), lakukan analisis pada data di atas dan sebutkan produk atau dokter yang sesuai.
3. Jawablah pertanyaan seputar kesehatan umum menggunakan pengetahuan medis yang benar, namun tetap kaitkan dengan layanan RuangKonsul jika memungkinkan.
4. SANGAT PENTING: Jika pengguna bertanya tentang hal-hal di luar kesehatan (seperti politik, hobi, hiburan, resep masakan non-diet, teknologi umum, atau topik lain yang tidak relevan), kamu HARUS menolak menjawab dengan sopan.
5. Berikan respon yang profesional, empati, dan informatif dalam bahasa Indonesia.";

            // Call OpenRouter API
            $response = Http::timeout(env('OPENROUTER_API_TIMEOUT', 30))
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type'  => 'application/json',
                    'HTTP-Referer'  => url('/'),
                    'X-Title'       => 'RuangKonsul Chatbot'
                ])
                ->post($apiEndpoint . 'chat/completions', [
                    'model' => 'stepfun/step-3.5-flash:free',
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
                    'body' => $response->body(),
                    'headers' => $response->headers()
                ]);
                
                return response()->json([
                    'reply' => 'Server AI tidak merespons. Status: ' . $response->status()
                ], $response->status());
            }

            $data = $response->json();
            
            if (!isset($data['choices'][0]['message']['content'])) {
                Log::error('Invalid OpenRouter API response', [
                    'response' => $data
                ]);
                
                return response()->json([
                    'reply' => 'AI tidak memberikan balasan yang valid.'
                ]);
            }

            $replyMessage = $data['choices'][0]['message']['content'];

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

            return response()->json([
                'reply' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }

    }
}
