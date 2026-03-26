<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukDescriptionSeeder extends Seeder
{
    /**
     * Seed the deskripsi, kegunaan, dosis, and efek_samping columns
     * on the produkALKES table based on produkName.
     */
    public function run(): void
    {
        // Mapping obat/produk ke deskripsi, kegunaan, dosis, efek samping
        $produkData = [
            // === OBAT UMUM ===
            'Paracetamol' => [
                'deskripsi' => 'Paracetamol (Acetaminophen) adalah obat analgesik dan antipiretik yang digunakan secara luas untuk meredakan nyeri ringan hingga sedang dan menurunkan demam.',
                'kegunaan' => 'Meredakan sakit kepala, nyeri otot, sakit gigi, nyeri haid, nyeri sendi, dan menurunkan demam akibat flu atau infeksi.',
                'dosis' => 'Dewasa: 500-1000 mg setiap 4-6 jam (maks 4000 mg/hari). Anak 6-12 tahun: 250-500 mg setiap 4-6 jam.',
                'efek_samping' => 'Jarang terjadi pada dosis normal. Potensi efek samping: mual, ruam kulit, reaksi alergi. Overdosis dapat menyebabkan kerusakan hati serius.',
            ],
            'Amoxicillin' => [
                'deskripsi' => 'Amoxicillin adalah antibiotik golongan penisilin berspektrum luas yang digunakan untuk mengobati berbagai infeksi bakteri.',
                'kegunaan' => 'Mengobati infeksi saluran pernapasan, infeksi telinga tengah (otitis media), infeksi saluran kemih, infeksi kulit, dan infeksi gigi.',
                'dosis' => 'Dewasa: 250-500 mg setiap 8 jam atau 500-875 mg setiap 12 jam. Anak: 20-40 mg/kgBB/hari dibagi dalam 3 dosis.',
                'efek_samping' => 'Diare, mual, muntah, ruam kulit, reaksi alergi (gatal, urtikaria). Pada kasus berat dapat terjadi reaksi anafilaksis.',
            ],
            'Ibuprofen' => [
                'deskripsi' => 'Ibuprofen adalah obat antiinflamasi nonsteroid (NSAID) yang memiliki efek analgesik, antipiretik, dan antiinflamasi.',
                'kegunaan' => 'Meredakan nyeri ringan hingga sedang, nyeri haid, sakit kepala, nyeri otot, radang sendi, dan menurunkan demam.',
                'dosis' => 'Dewasa: 200-400 mg setiap 4-6 jam (maks 1200 mg/hari tanpa resep). Anak >6 bulan: 5-10 mg/kgBB setiap 6-8 jam.',
                'efek_samping' => 'Gangguan saluran cerna (mual, nyeri lambung, diare), pusing, ruam kulit. Penggunaan jangka panjang dapat meningkatkan risiko gangguan ginjal dan jantung.',
            ],
            'Cetirizine' => [
                'deskripsi' => 'Cetirizine adalah obat antihistamin generasi kedua yang digunakan untuk mengatasi gejala alergi tanpa menyebabkan kantuk berlebih.',
                'kegunaan' => 'Mengatasi gejala rhinitis alergi (bersin, pilek, hidung tersumbat), urtikaria (biduran), dan gatal-gatal akibat alergi.',
                'dosis' => 'Dewasa dan anak >12 tahun: 10 mg sekali sehari. Anak 6-12 tahun: 5 mg dua kali sehari atau 10 mg sekali sehari.',
                'efek_samping' => 'Mengantuk ringan, mulut kering, sakit kepala, pusing, kelelahan, dan nyeri perut.',
            ],
            'Omeprazole' => [
                'deskripsi' => 'Omeprazole adalah obat golongan penghambat pompa proton (PPI) yang mengurangi produksi asam lambung.',
                'kegunaan' => 'Mengobati GERD (refluks asam lambung), tukak lambung, tukak duodenum, sindrom Zollinger-Ellison, dan dispepsia.',
                'dosis' => 'Dewasa: 20-40 mg sekali sehari sebelum makan pagi selama 2-8 minggu tergantung kondisi.',
                'efek_samping' => 'Sakit kepala, mual, diare, nyeri perut, flatulensi. Penggunaan jangka panjang dapat menyebabkan defisiensi vitamin B12 dan magnesium.',
            ],
            'Antasida' => [
                'deskripsi' => 'Antasida adalah obat yang menetralkan asam lambung berlebih, biasanya mengandung kombinasi aluminium hidroksida dan magnesium hidroksida.',
                'kegunaan' => 'Meredakan gejala maag, heartburn, kembung, nyeri ulu hati, dan gangguan pencernaan akibat kelebihan asam lambung.',
                'dosis' => 'Dewasa: 1-2 tablet kunyah atau 5-15 ml suspensi, 3-4 kali sehari antara waktu makan dan sebelum tidur.',
                'efek_samping' => 'Konstipasi (pada antasida aluminium), diare (pada antasida magnesium), perut kembung, mual.',
            ],
            'OBH Combi' => [
                'deskripsi' => 'OBH Combi adalah obat batuk herbal yang mengandung kombinasi bahan aktif untuk meredakan batuk berdahak maupun batuk kering.',
                'kegunaan' => 'Meredakan batuk berdahak, batuk kering, melegakan tenggorokan, dan membantu mengencerkan dahak.',
                'dosis' => 'Dewasa: 15 ml (1 sendok makan) 3 kali sehari. Anak 6-12 tahun: 5 ml 3 kali sehari.',
                'efek_samping' => 'Mengantuk, mual, pusing, mulut kering. Tidak dianjurkan untuk penderita gangguan hati berat.',
            ],
            'Vitamin C' => [
                'deskripsi' => 'Vitamin C (Asam Askorbat) adalah suplemen vitamin esensial yang berperan penting dalam menjaga sistem imun dan kesehatan kulit.',
                'kegunaan' => 'Meningkatkan daya tahan tubuh, antioksidan, membantu penyerapan zat besi, menjaga kesehatan kulit, dan mempercepat penyembuhan luka.',
                'dosis' => 'Dewasa: 75-90 mg/hari (kebutuhan harian). Sebagai suplemen: 250-1000 mg/hari. Batas aman: maks 2000 mg/hari.',
                'efek_samping' => 'Dosis tinggi dapat menyebabkan gangguan pencernaan, mual, diare, kram perut, dan peningkatan risiko batu ginjal.',
            ],
            'Vitamin D' => [
                'deskripsi' => 'Vitamin D (Kolekalsiferol/D3) adalah vitamin larut lemak yang penting untuk kesehatan tulang dan sistem imun tubuh.',
                'kegunaan' => 'Menjaga kesehatan tulang dan gigi, membantu penyerapan kalsium, mendukung fungsi sistem imun, dan mencegah osteoporosis.',
                'dosis' => 'Dewasa: 600-1000 IU/hari. Lansia: 800-2000 IU/hari. Defisiensi: 1000-5000 IU/hari sesuai anjuran dokter.',
                'efek_samping' => 'Dosis berlebihan dapat menyebabkan hiperkalsemia (kadar kalsium darah tinggi), mual, muntah, lemas, dan gangguan ginjal.',
            ],
            'Vitamin B Complex' => [
                'deskripsi' => 'Vitamin B Complex adalah suplemen yang mengandung kombinasi vitamin B1, B2, B6, B12 dan vitamin B lainnya yang penting untuk metabolisme tubuh.',
                'kegunaan' => 'Mendukung metabolisme energi, menjaga fungsi saraf, membantu pembentukan sel darah merah, mengurangi kelelahan, dan menjaga kesehatan kulit.',
                'dosis' => 'Dewasa: 1 tablet/kaplet sekali sehari, diminum setelah makan.',
                'efek_samping' => 'Umumnya aman. Dosis tinggi vitamin B6 jangka panjang dapat menyebabkan neuropati perifer. Urine mungkin berwarna kuning terang.',
            ],
            'Multivitamin' => [
                'deskripsi' => 'Multivitamin adalah suplemen yang mengandung berbagai vitamin dan mineral esensial untuk memenuhi kebutuhan nutrisi harian.',
                'kegunaan' => 'Membantu memenuhi kebutuhan vitamin dan mineral harian, meningkatkan daya tahan tubuh, mendukung kesehatan secara keseluruhan.',
                'dosis' => 'Dewasa: 1 tablet/kapsul sekali sehari, diminum setelah makan sesuai petunjuk pada kemasan.',
                'efek_samping' => 'Mual ringan jika diminum saat perut kosong. Dosis berlebih vitamin tertentu dapat menimbulkan efek toksisitas.',
            ],
            'Dexamethasone' => [
                'deskripsi' => 'Dexamethasone adalah obat kortikosteroid sintetis yang memiliki efek antiinflamasi dan imunosupresan kuat.',
                'kegunaan' => 'Mengatasi peradangan berat, reaksi alergi berat, asma, penyakit autoimun, dan kondisi inflamasi lainnya.',
                'dosis' => 'Dewasa: 0.5-9 mg/hari tergantung kondisi. Harus sesuai resep dan pengawasan dokter.',
                'efek_samping' => 'Peningkatan nafsu makan, kenaikan berat badan, gangguan tidur, peningkatan gula darah, penipisan kulit, dan gangguan mood.',
            ],
            'Metformin' => [
                'deskripsi' => 'Metformin adalah obat antidiabetes oral golongan biguanid yang digunakan untuk mengendalikan kadar gula darah pada diabetes tipe 2.',
                'kegunaan' => 'Menurunkan kadar gula darah pada penderita diabetes melitus tipe 2, meningkatkan sensitivitas insulin, dan mengurangi produksi glukosa di hati.',
                'dosis' => 'Dewasa: Awal 500 mg 2x sehari atau 850 mg 1x sehari, dinaikkan bertahap. Dosis maks: 2550 mg/hari.',
                'efek_samping' => 'Mual, muntah, diare, nyeri perut, rasa logam di mulut. Jarang terjadi: asidosis laktat (terutama pada gangguan ginjal).',
            ],
            'Amlodipine' => [
                'deskripsi' => 'Amlodipine adalah obat antihipertensi golongan calcium channel blocker (CCB) yang digunakan untuk menurunkan tekanan darah tinggi.',
                'kegunaan' => 'Mengobati hipertensi (tekanan darah tinggi) dan angina (nyeri dada) dengan merelaksasi pembuluh darah.',
                'dosis' => 'Dewasa: 5-10 mg sekali sehari. Lansia dan gangguan hati: mulai dari 2.5 mg sekali sehari.',
                'efek_samping' => 'Pembengkakan pergelangan kaki/kaki, pusing, muka memerah (flushing), kelelahan, palpitasi, dan mual.',
            ],
            'Captopril' => [
                'deskripsi' => 'Captopril adalah obat antihipertensi golongan ACE inhibitor yang digunakan untuk mengendalikan tekanan darah dan melindungi jantung serta ginjal.',
                'kegunaan' => 'Mengobati hipertensi, gagal jantung, pasca serangan jantung, dan nefropati diabetik.',
                'dosis' => 'Dewasa: 12.5-25 mg 2-3 kali sehari, diminum 1 jam sebelum makan. Dosis maks: 150 mg/hari.',
                'efek_samping' => 'Batuk kering, pusing, gangguan pengecapan, ruam kulit, hipotensi (tekanan darah terlalu rendah), dan peningkatan kadar kalium.',
            ],
            'Simvastatin' => [
                'deskripsi' => 'Simvastatin adalah obat penurun kolesterol golongan statin yang bekerja menghambat produksi kolesterol di hati.',
                'kegunaan' => 'Menurunkan kadar kolesterol LDL (kolesterol jahat) dan trigliserida, serta meningkatkan kolesterol HDL (kolesterol baik) untuk mencegah penyakit jantung.',
                'dosis' => 'Dewasa: 10-40 mg sekali sehari pada malam hari. Dosis maks: 80 mg/hari (jarang digunakan).',
                'efek_samping' => 'Nyeri otot (mialgia), gangguan pencernaan, sakit kepala. Jarang: rabdomiolisis (kerusakan otot serius), gangguan fungsi hati.',
            ],
            'Ranitidine' => [
                'deskripsi' => 'Ranitidine adalah obat golongan H2-receptor antagonist yang mengurangi produksi asam lambung.',
                'kegunaan' => 'Mengobati dan mencegah tukak lambung, tukak duodenum, GERD, dan kondisi kelebihan asam lambung lainnya.',
                'dosis' => 'Dewasa: 150 mg 2 kali sehari atau 300 mg sekali sehari sebelum tidur selama 4-8 minggu.',
                'efek_samping' => 'Sakit kepala, pusing, konstipasi, diare, mual. Jarang: gangguan fungsi hati, trombositopenia.',
            ],
            'Salbutamol' => [
                'deskripsi' => 'Salbutamol (Albuterol) adalah obat bronkodilator golongan beta-2 agonis kerja pendek untuk mengatasi sesak napas.',
                'kegunaan' => 'Meredakan dan mencegah serangan asma, bronkospasme akut, dan mengatasi sesak napas pada penyakit paru obstruktif kronik (PPOK).',
                'dosis' => 'Inhaler: 1-2 semprot (100-200 mcg) saat serangan, maks 8 semprot/hari. Tablet: 2-4 mg 3-4 kali sehari.',
                'efek_samping' => 'Tremor (gemetar) pada tangan, jantung berdebar, sakit kepala, kram otot, dan gelisah.',
            ],
            'Domperidone' => [
                'deskripsi' => 'Domperidone adalah obat antiemetik (anti mual-muntah) yang bekerja dengan memblokir reseptor dopamin di saluran pencernaan.',
                'kegunaan' => 'Mengatasi mual, muntah, perut kembung, rasa penuh di perut, dan mempercepat pengosongan lambung.',
                'dosis' => 'Dewasa: 10 mg 3 kali sehari, diminum 15-30 menit sebelum makan. Durasi penggunaan sebaiknya tidak lebih dari 7 hari.',
                'efek_samping' => 'Mulut kering, sakit kepala, diare, kram perut. Jarang: gangguan irama jantung (terutama pada dosis tinggi).',
            ],
            'Loperamide' => [
                'deskripsi' => 'Loperamide adalah obat antidiare yang bekerja memperlambat gerakan usus sehingga feses lebih padat.',
                'kegunaan' => 'Mengatasi diare akut dan diare kronik, mengurangi frekuensi buang air besar yang berlebih.',
                'dosis' => 'Dewasa: Awal 4 mg, dilanjutkan 2 mg setelah setiap diare (maks 16 mg/hari). Anak >12 tahun: sama dengan dewasa.',
                'efek_samping' => 'Konstipasi, kram perut, mual, pusing, mulut kering. Overdosis dapat menyebabkan gangguan jantung serius.',
            ],
            'Betadine' => [
                'deskripsi' => 'Betadine (Povidone-Iodine) adalah antiseptik topikal yang mengandung iodine untuk membunuh kuman pada kulit dan luka.',
                'kegunaan' => 'Membersihkan dan mendisinfeksi luka ringan, luka gores, luka bakar ringan, dan mencegah infeksi pada kulit.',
                'dosis' => 'Oleskan secukupnya pada area luka 1-3 kali sehari atau sesuai kebutuhan. Bersihkan area sebelum pengaplikasian.',
                'efek_samping' => 'Iritasi kulit, rasa perih sementara, reaksi alergi (kemerahan, gatal). Hindari penggunaan pada luka dalam atau luka bakar luas.',
            ],
            'Biogesic' => [
                'deskripsi' => 'Biogesic adalah obat analgesik yang mengandung Paracetamol 500 mg untuk meredakan nyeri dan menurunkan demam.',
                'kegunaan' => 'Meredakan sakit kepala, demam, sakit gigi, nyeri otot, nyeri haid, dan nyeri ringan hingga sedang lainnya.',
                'dosis' => 'Dewasa: 1-2 kaplet setiap 4-6 jam sesuai kebutuhan. Maks 8 kaplet/hari. Anak sesuai berat badan.',
                'efek_samping' => 'Jarang terjadi pada dosis normal. Kemungkinan: mual, reaksi alergi kulit ringan. Overdosis dapat merusak hati.',
            ],
            'Promag' => [
                'deskripsi' => 'Promag adalah obat maag yang mengandung kombinasi Hydrotalcite dan Magnesium Hidroksida untuk menetralkan asam lambung berlebih.',
                'kegunaan' => 'Meredakan gejala maag, kembung, mual karena asam lambung berlebih, nyeri ulu hati, dan heartburn.',
                'dosis' => 'Dewasa: 1-2 tablet kunyah, 3-4 kali sehari di antara waktu makan dan sebelum tidur.',
                'efek_samping' => 'Diare ringan, konstipasi, perut kembung. Penggunaan jangka panjang dapat mempengaruhi penyerapan mineral.',
            ],
            'Mylanta' => [
                'deskripsi' => 'Mylanta adalah obat antasida yang mengandung Aluminium Hidroksida, Magnesium Hidroksida, dan Simetikon untuk mengatasi masalah lambung.',
                'kegunaan' => 'Meredakan gejala kelebihan asam lambung, kembung, perut begah, mual, nyeri ulu hati, dan gangguan pencernaan.',
                'dosis' => 'Dewasa: 5-10 ml (1-2 sendok teh) 3-4 kali sehari antara waktu makan dan sebelum tidur. Kocok dahulu sebelum diminum.',
                'efek_samping' => 'Konstipasi atau diare (tergantung komposisi), mual ringan. Penggunaan jangka panjang: gangguan keseimbangan elektrolit.',
            ],
            'Diclofenac' => [
                'deskripsi' => 'Diclofenac adalah obat antiinflamasi nonsteroid (NSAID) yang kuat untuk mengatasi nyeri dan peradangan.',
                'kegunaan' => 'Mengatasi nyeri akut, nyeri pasca operasi, radang sendi (osteoarthritis, rheumatoid arthritis), nyeri punggung, dan peradangan.',
                'dosis' => 'Dewasa: 50 mg 2-3 kali sehari atau 75 mg 2 kali sehari. Dosis maks: 150 mg/hari. Diminum setelah makan.',
                'efek_samping' => 'Gangguan lambung (nyeri, mual, diare), sakit kepala, pusing. Risiko perdarahan saluran cerna dan gangguan jantung pada penggunaan jangka panjang.',
            ],
            'Dextromethorphan' => [
                'deskripsi' => 'Dextromethorphan (DMP) adalah obat antitusif yang bekerja di pusat batuk di otak untuk menekan refleks batuk.',
                'kegunaan' => 'Meredakan batuk kering (batuk tidak berdahak) akibat flu, pilek, atau iritasi saluran pernapasan.',
                'dosis' => 'Dewasa: 10-20 mg setiap 4 jam atau 30 mg setiap 6-8 jam. Maks: 120 mg/hari.',
                'efek_samping' => 'Mengantuk, pusing, mual, gangguan pencernaan. Dosis berlebihan dapat menyebabkan halusinasi dan gangguan pernapasan.',
            ],
            'Ambroxol' => [
                'deskripsi' => 'Ambroxol adalah obat mukolitik yang bekerja mengencerkan dahak sehingga mudah dikeluarkan dari saluran pernapasan.',
                'kegunaan' => 'Mengencerkan dan membantu pengeluaran dahak pada batuk berdahak, bronkitis, pneumonia, dan gangguan pernapasan lainnya.',
                'dosis' => 'Dewasa: 30 mg 3 kali sehari. Setelah membaik: 30 mg 2 kali sehari. Anak 6-12 tahun: 15 mg 2-3 kali sehari.',
                'efek_samping' => 'Gangguan pencernaan ringan (mual, diare), reaksi alergi kulit. Jarang: reaksi anafilaksis.',
            ],
            'Mefenamic Acid' => [
                'deskripsi' => 'Asam Mefenamat adalah obat antiinflamasi nonsteroid (NSAID) yang digunakan untuk meredakan nyeri ringan hingga sedang.',
                'kegunaan' => 'Meredakan nyeri haid (dismenore), sakit gigi, sakit kepala, nyeri otot, nyeri pasca operasi, dan nyeri sendi.',
                'dosis' => 'Dewasa: 500 mg sebagai dosis awal, dilanjutkan 250 mg setiap 6 jam sesuai kebutuhan. Maks penggunaan: 7 hari.',
                'efek_samping' => 'Nyeri lambung, mual, diare, pusing, sakit kepala. Penggunaan jangka panjang meningkatkan risiko perdarahan saluran cerna.',
            ],
            'Asam Mefenamat' => [
                'deskripsi' => 'Asam Mefenamat adalah obat antiinflamasi nonsteroid (NSAID) yang digunakan untuk meredakan nyeri ringan hingga sedang.',
                'kegunaan' => 'Meredakan nyeri haid (dismenore), sakit gigi, sakit kepala, nyeri otot, nyeri pasca operasi, dan nyeri sendi.',
                'dosis' => 'Dewasa: 500 mg sebagai dosis awal, dilanjutkan 250 mg setiap 6 jam sesuai kebutuhan. Maks penggunaan: 7 hari.',
                'efek_samping' => 'Nyeri lambung, mual, diare, pusing, sakit kepala. Penggunaan jangka panjang meningkatkan risiko perdarahan saluran cerna.',
            ],
            'Metronidazole' => [
                'deskripsi' => 'Metronidazole adalah antibiotik dan antiprotozoal yang efektif melawan bakteri anaerob dan parasit tertentu.',
                'kegunaan' => 'Mengobati infeksi bakteri anaerob, infeksi saluran cerna (amoebiasis, giardiasis), vaginosis bakterial, dan infeksi gigi.',
                'dosis' => 'Dewasa: 250-500 mg 3 kali sehari selama 7-10 hari. Diminum bersama makanan untuk mengurangi gangguan lambung.',
                'efek_samping' => 'Mual, rasa logam di mulut, sakit kepala, kehilangan nafsu makan. PENTING: Hindari alkohol selama dan 48 jam setelah penggunaan.',
            ],
            'Lansoprazole' => [
                'deskripsi' => 'Lansoprazole adalah obat golongan penghambat pompa proton (PPI) yang mengurangi produksi asam lambung secara efektif.',
                'kegunaan' => 'Mengobati GERD (penyakit refluks asam lambung), tukak lambung, tukak duodenum, dan sindrom Zollinger-Ellison.',
                'dosis' => 'Dewasa: 15-30 mg sekali sehari sebelum makan pagi. Tukak lambung: selama 4-8 minggu. GERD: selama 4 minggu.',
                'efek_samping' => 'Sakit kepala, diare, mual, nyeri perut, konstipasi. Penggunaan jangka panjang: risiko defisiensi magnesium dan vitamin B12.',
            ],
            'Sucralfate' => [
                'deskripsi' => 'Sucralfate adalah obat pelindung mukosa lambung yang membentuk lapisan pelindung pada permukaan tukak lambung.',
                'kegunaan' => 'Mengobati dan mencegah tukak lambung, tukak duodenum, dan melindungi dinding lambung dari iritasi asam lambung.',
                'dosis' => 'Dewasa: 1 gram (1 tablet atau 5 ml suspensi) 4 kali sehari, diminum 1 jam sebelum makan dan sebelum tidur.',
                'efek_samping' => 'Konstipasi (paling umum), mual, mulut kering, pusing, nyeri perut. Dapat mengganggu penyerapan obat lain.',
            ],
            // === PRODUK IBU DAN ANAK ===
            'Prenagen' => [
                'deskripsi' => 'Prenagen adalah susu formula khusus ibu hamil dan menyusui yang diformulasikan dengan nutrisi lengkap untuk mendukung kehamilan sehat.',
                'kegunaan' => 'Memenuhi kebutuhan nutrisi ibu hamil dan janin, mendukung perkembangan otak janin, dan menjaga kesehatan ibu selama kehamilan.',
                'dosis' => 'Minum 2 gelas sehari (pagi dan malam). Larutkan 3 sendok makan dalam 200 ml air hangat.',
                'efek_samping' => 'Umumnya aman. Beberapa orang mungkin mengalami mual atau kembung ringan.',
            ],
            'Lactacyd' => [
                'deskripsi' => 'Lactacyd adalah sabun pembersih kewanitaan yang mengandung asam laktat alami untuk menjaga kebersihan dan pH area intim.',
                'kegunaan' => 'Membersihkan area kewanitaan, menjaga keseimbangan pH alami, mencegah iritasi, dan mengurangi risiko infeksi.',
                'dosis' => 'Gunakan secukupnya saat mandi, aplikasikan pada area luar kewanitaan, bilas bersih. Gunakan 1-2 kali sehari.',
                'efek_samping' => 'Umumnya aman untuk penggunaan luar. Iritasi ringan mungkin terjadi pada kulit sensitif.',
            ],
            'Sangobion' => [
                'deskripsi' => 'Sangobion adalah suplemen zat besi yang mengandung Iron Polymaltose Complex, Asam Folat, Vitamin B12, dan Vitamin C.',
                'kegunaan' => 'Mengatasi dan mencegah anemia defisiensi besi, membantu pembentukan sel darah merah, cocok untuk ibu hamil dan menyusui.',
                'dosis' => 'Dewasa: 1 kapsul sekali sehari, diminum setelah makan. Untuk ibu hamil sesuai anjuran dokter.',
                'efek_samping' => 'Feses berwarna gelap/hitam (normal), mual, konstipasi, nyeri perut ringan.',
            ],
            'Tempra' => [
                'deskripsi' => 'Tempra adalah obat penurun demam dan pereda nyeri untuk anak yang mengandung Paracetamol dengan rasa buah yang disukai anak.',
                'kegunaan' => 'Menurunkan demam dan meredakan nyeri ringan pada anak seperti nyeri akibat tumbuh gigi, sakit kepala, dan pasca imunisasi.',
                'dosis' => 'Anak 0-1 tahun: 0.6 ml, 1-2 tahun: 1.2 ml, 2-3 tahun: 1.8 ml, 3-5 tahun: 2.4 ml (sirup). Diberikan setiap 4-6 jam.',
                'efek_samping' => 'Jarang terjadi pada dosis yang tepat. Kemungkinan: ruam kulit, reaksi alergi ringan.',
            ],
            // === SUPLEMEN DAN GAYA HIDUP ===
            'Enervon-C' => [
                'deskripsi' => 'Enervon-C adalah suplemen multivitamin yang mengandung Vitamin B Complex dan Vitamin C untuk menjaga stamina dan daya tahan tubuh.',
                'kegunaan' => 'Membantu menjaga daya tahan tubuh, mengurangi kelelahan, membantu pemulihan setelah sakit, dan memenuhi kebutuhan vitamin harian.',
                'dosis' => 'Dewasa: 1 tablet sekali sehari setelah makan.',
                'efek_samping' => 'Umumnya aman. Urine mungkin berwarna kuning terang (normal, karena vitamin B2). Mual ringan jika diminum saat perut kosong.',
            ],
            'Becom-C' => [
                'deskripsi' => 'Becom-C adalah suplemen yang mengandung Vitamin B Complex dan Vitamin C untuk menjaga kesehatan dan stamina tubuh.',
                'kegunaan' => 'Membantu menjaga daya tahan tubuh, mengurangi pegal-pegal, membantu metabolisme energi, dan menjaga kesehatan kulit.',
                'dosis' => 'Dewasa: 1 kaplet sekali sehari setelah makan.',
                'efek_samping' => 'Umumnya aman. Kemungkinan efek: mual ringan, urine berwarna kuning pekat.',
            ],
            'Redoxon' => [
                'deskripsi' => 'Redoxon adalah suplemen Vitamin C dosis tinggi dalam bentuk tablet effervescent yang mudah diserap tubuh.',
                'kegunaan' => 'Meningkatkan daya tahan tubuh, sebagai antioksidan, membantu pemulihan dari sakit, dan menjaga kesehatan kulit.',
                'dosis' => 'Dewasa: 1 tablet effervescent dilarutkan dalam segelas air (200 ml) sekali sehari.',
                'efek_samping' => 'Gangguan pencernaan ringan (mual, diare) pada dosis tinggi. Peningkatan risiko batu ginjal pada penggunaan berlebihan.',
            ],
            'Neurobion' => [
                'deskripsi' => 'Neurobion adalah suplemen vitamin neurotropik yang mengandung Vitamin B1, B6, dan B12 untuk kesehatan saraf.',
                'kegunaan' => 'Mengatasi gangguan saraf (neuropati), mengurangi kesemutan, kebas, nyeri saraf, dan mendukung fungsi saraf yang sehat.',
                'dosis' => 'Dewasa: 1 tablet sekali sehari. Untuk kondisi neuropati: sesuai anjuran dokter.',
                'efek_samping' => 'Umumnya aman. Dosis tinggi vitamin B6 jangka panjang: risiko neuropati perifer. Reaksi alergi jarang terjadi.',
            ],
            'Blackmores' => [
                'deskripsi' => 'Blackmores adalah merek suplemen kesehatan premium asal Australia yang menyediakan berbagai vitamin dan mineral berkualitas tinggi.',
                'kegunaan' => 'Membantu memenuhi kebutuhan nutrisi harian, mendukung kesehatan tulang, sendi, jantung, dan sistem imun tubuh.',
                'dosis' => 'Sesuai petunjuk pada kemasan masing-masing produk. Umumnya 1 kapsul/tablet sekali sehari setelah makan.',
                'efek_samping' => 'Umumnya aman. Kemungkinan: gangguan pencernaan ringan jika diminum saat perut kosong.',
            ],
            // === ALAT KESEHATAN ===
            'Tensimeter Digital' => [
                'deskripsi' => 'Tensimeter Digital adalah alat kesehatan elektronik untuk mengukur tekanan darah secara otomatis dan akurat.',
                'kegunaan' => 'Memantau tekanan darah di rumah, mendeteksi hipertensi atau hipotensi, dan membantu kontrol kesehatan rutin.',
                'dosis' => 'Gunakan 1-2 kali sehari pada waktu yang sama. Pastikan posisi duduk rileks, tidak berbicara, dan lengan sejajar jantung.',
                'efek_samping' => 'Tidak ada efek samping. Hasil bisa kurang akurat jika alat tidak dikalibrasi atau cara penggunaan tidak tepat.',
            ],
            'Termometer Digital' => [
                'deskripsi' => 'Termometer Digital adalah alat pengukur suhu tubuh elektronik yang memberikan hasil pengukuran cepat dan akurat.',
                'kegunaan' => 'Mengukur suhu tubuh untuk mendeteksi demam, memantau kondisi kesehatan, dan membantu diagnosis awal.',
                'dosis' => 'Tempatkan di bawah lidah, ketiak, atau rektal selama 30-60 detik hingga berbunyi "beep". Bersihkan sebelum dan sesudah penggunaan.',
                'efek_samping' => 'Tidak ada efek samping. Pastikan alat bersih untuk menghindari kontaminasi silang.',
            ],
            'Oximeter' => [
                'deskripsi' => 'Pulse Oximeter adalah alat kesehatan portabel untuk mengukur kadar oksigen dalam darah (SpO2) dan detak jantung.',
                'kegunaan' => 'Memantau saturasi oksigen darah, mendeteksi hipoksia, berguna untuk pasien dengan gangguan pernapasan dan COVID-19.',
                'dosis' => 'Jepitkan pada ujung jari yang bersih. Baca hasil setelah 10-15 detik. Normal SpO2: 95-100%. Di bawah 90% perlu bantuan medis.',
                'efek_samping' => 'Tidak ada efek samping. Hasil mungkin tidak akurat jika jari dingin, kuku dicat, atau sirkulasi darah buruk.',
            ],
            'Nebulizer' => [
                'deskripsi' => 'Nebulizer adalah alat medis yang mengubah obat cair menjadi uap halus agar dapat dihirup langsung ke paru-paru.',
                'kegunaan' => 'Mengobati asma, bronkitis, PPOK, dan gangguan pernapasan lainnya dengan cara memberikan obat langsung ke saluran pernapasan.',
                'dosis' => 'Gunakan sesuai resep dokter. Umumnya 5-15 menit per sesi, 2-4 kali sehari atau sesuai kebutuhan.',
                'efek_samping' => 'Efek samping tergantung obat yang digunakan. Alat itu sendiri aman. Pastikan selalu dibersihkan setelah digunakan.',
            ],
            'Masker Medis' => [
                'deskripsi' => 'Masker Medis adalah alat pelindung diri (APD) sekali pakai yang dirancang untuk mencegah penyebaran droplet dan partikel penyakit.',
                'kegunaan' => 'Melindungi diri dari penularan penyakit melalui droplet, memfilter partikel udara, dan menjaga kebersihan pernapasan.',
                'dosis' => 'Gunakan 1 masker, ganti setiap 4-8 jam atau jika sudah basah/kotor. Pastikan menutupi hidung, mulut, dan dagu.',
                'efek_samping' => 'Tidak ada efek samping medis. Penggunaan berkepanjangan mungkin menyebabkan iritasi kulit ringan di area telinga.',
            ],
            'Hand Sanitizer' => [
                'deskripsi' => 'Hand Sanitizer adalah cairan antiseptik berbasis alkohol (minimal 60%) untuk membersihkan tangan tanpa air.',
                'kegunaan' => 'Membunuh kuman, bakteri, dan virus pada tangan, menjaga kebersihan tangan saat air dan sabun tidak tersedia.',
                'dosis' => 'Tuangkan 3-5 ml ke telapak tangan, gosok merata seluruh permukaan tangan hingga kering (sekitar 20-30 detik).',
                'efek_samping' => 'Kulit kering jika digunakan berlebihan. Iritasi ringan pada kulit sensitif. Jauhkan dari mata dan luka terbuka.',
            ],
            'Plester Luka' => [
                'deskripsi' => 'Plester Luka (Band-Aid) adalah perban perekat steril yang digunakan untuk menutup luka kecil dan mencegah infeksi.',
                'kegunaan' => 'Melindungi luka ringan (goresan, luka sayat kecil) dari kotoran dan bakteri, membantu proses penyembuhan luka.',
                'dosis' => 'Bersihkan luka terlebih dahulu, tempelkan plester menutupi luka. Ganti setiap 1-2 kali sehari atau jika basah/kotor.',
                'efek_samping' => 'Iritasi kulit ringan atau reaksi alergi pada perekat. Gunakan plester hipoalergenik jika kulit sensitif.',
            ],
            'Alkohol 70%' => [
                'deskripsi' => 'Alkohol 70% (Isopropyl Alcohol/Ethyl Alcohol) adalah cairan antiseptik yang digunakan untuk membersihkan dan mendisinfeksi.',
                'kegunaan' => 'Mendisinfeksi kulit sebelum injeksi, membersihkan luka ringan, sterilisasi alat medis, dan membersihkan permukaan.',
                'dosis' => 'Oleskan secukupnya pada kapas atau kain bersih, usapkan pada area yang ingin didisinfeksi. Biarkan mengering sendiri.',
                'efek_samping' => 'Rasa perih pada luka terbuka, kulit kering jika digunakan berlebihan, iritasi kulit. Mudah terbakar, jauhkan dari api.',
            ],
            'Perban Elastis' => [
                'deskripsi' => 'Perban Elastis adalah perban yang dapat melar dan digunakan untuk membungkus dan menopang bagian tubuh yang cedera.',
                'kegunaan' => 'Membungkus dan menopang sendi yang keseleo, mengurangi pembengkakan, memfiksasi balutan luka, dan kompresi pasca cedera.',
                'dosis' => 'Lilitkan pada area cedera dengan tekanan sedang (tidak terlalu ketat). Lepaskan jika terasa kesemutan atau kebas.',
                'efek_samping' => 'Jika terlalu ketat dapat mengganggu sirkulasi darah. Iritasi kulit ringan mungkin terjadi.',
            ],
            'Glucometer' => [
                'deskripsi' => 'Glucometer adalah alat pengukur kadar gula darah portabel yang digunakan untuk pemantauan mandiri diabetes.',
                'kegunaan' => 'Memantau kadar glukosa darah harian, membantu penderita diabetes mengontrol gula darah, dan menyesuaikan dosis obat.',
                'dosis' => 'Cuci tangan, tusuk ujung jari dengan lancet, teteskan darah pada strip tes, baca hasil dalam 5-10 detik. Normal puasa: 70-100 mg/dL.',
                'efek_samping' => 'Nyeri ringan saat penusukan jari. Hasil bisa tidak akurat jika strip kadaluarsa atau tangan tidak bersih.',
            ],
            'Stetoskop' => [
                'deskripsi' => 'Stetoskop adalah alat medis diagnostik yang digunakan untuk mendengarkan suara dari dalam tubuh manusia.',
                'kegunaan' => 'Mendengarkan suara jantung, paru-paru, aliran darah, dan suara usus untuk keperluan diagnosa medis.',
                'dosis' => 'Tempatkan bagian chest piece pada area yang ingin diperiksa. Gunakan sisi bell untuk suara frekuensi rendah dan diafragma untuk frekuensi tinggi.',
                'efek_samping' => 'Tidak ada efek samping. Pastikan ear tips bersih untuk menghindari infeksi telinga.',
            ],
            // === PRODUK KESEHATAN MENTAL (K0001) ===
            'Antiprestin' => [
                'deskripsi' => 'Antiprestin adalah obat antidepresan yang mengandung Fluoxetine HCl, termasuk golongan Selective Serotonin Reuptake Inhibitor (SSRI) untuk mengatasi gangguan depresi.',
                'kegunaan' => 'Mengobati gangguan depresi mayor, gangguan obsesif-kompulsif (OCD), gangguan panik, bulimia nervosa, dan gangguan kecemasan.',
                'dosis' => 'Dewasa: 20 mg sekali sehari di pagi hari. Dosis dapat ditingkatkan hingga 60-80 mg/hari sesuai respons klinis dan anjuran dokter.',
                'efek_samping' => 'Mual, sakit kepala, insomnia, gelisah, penurunan nafsu makan, mulut kering, tremor, dan disfungsi seksual. Perlu pengawasan dokter.',
            ],
            'Stablon' => [
                'deskripsi' => 'Stablon adalah obat antidepresan yang mengandung Tianeptine Sodium, bekerja dengan meningkatkan reuptake serotonin untuk mengatasi gangguan depresi.',
                'kegunaan' => 'Mengobati episode depresi mayor, gangguan kecemasan yang menyertai depresi, dan membantu menstabilkan suasana hati.',
                'dosis' => 'Dewasa: 12.5 mg (1 tablet) 3 kali sehari sebelum makan. Lansia: dosis dikurangi menjadi 2 tablet per hari. Harus dengan resep dokter.',
                'efek_samping' => 'Nyeri perut, mual, konstipasi, mulut kering, pusing, sakit kepala, gangguan tidur, dan mimpi buruk. Tidak boleh dihentikan mendadak.',
            ],
            'Kalxetin' => [
                'deskripsi' => 'Kalxetin adalah obat antidepresan generik yang mengandung Fluoxetine HCl 20 mg, termasuk golongan SSRI untuk mengatasi gangguan mental.',
                'kegunaan' => 'Mengobati depresi mayor, gangguan obsesif-kompulsif (OCD), gangguan panik dengan atau tanpa agorafobia, dan premenstrual dysphoric disorder (PMDD).',
                'dosis' => 'Dewasa: 20 mg sekali sehari di pagi hari. Dosis dapat dinaikkan setelah beberapa minggu jika diperlukan. Maks: 80 mg/hari. Harus dengan resep dokter.',
                'efek_samping' => 'Mual, diare, sakit kepala, insomnia, gugup, tremor, penurunan libido, mulut kering. Peringatan: risiko pikiran bunuh diri pada remaja.',
            ],
            // === PRODUK KESEHATAN SEKSUAL (K0002) ===
            'Viagra' => [
                'deskripsi' => 'Viagra adalah obat yang mengandung Sildenafil Citrate, digunakan untuk mengatasi disfungsi ereksi (impotensi) pada pria dewasa.',
                'kegunaan' => 'Mengobati disfungsi ereksi dengan meningkatkan aliran darah ke penis saat stimulasi seksual, serta mengobati hipertensi pulmonal.',
                'dosis' => 'Dewasa: 50 mg diminum 30-60 menit sebelum aktivitas seksual. Dapat disesuaikan 25-100 mg. Maks 1 kali per hari. Harus dengan resep dokter.',
                'efek_samping' => 'Sakit kepala, muka memerah (flushing), gangguan pencernaan, hidung tersumbat, gangguan penglihatan (penglihatan biru). BAHAYA jika dikombinasi dengan nitrat.',
            ],
            'Cialis' => [
                'deskripsi' => 'Cialis adalah obat yang mengandung Tadalafil, digunakan untuk mengatasi disfungsi ereksi dan gejala pembesaran prostat jinak (BPH).',
                'kegunaan' => 'Mengobati disfungsi ereksi, mengatasi gejala benign prostatic hyperplasia (BPH), dan hipertensi arteri pulmonal.',
                'dosis' => 'Disfungsi ereksi: 10 mg sebelum aktivitas seksual (bisa disesuaikan 5-20 mg). Penggunaan harian: 2.5-5 mg sekali sehari. Harus dengan resep dokter.',
                'efek_samping' => 'Sakit kepala, nyeri punggung, nyeri otot, muka memerah, hidung tersumbat, gangguan pencernaan. BAHAYA jika dikombinasi dengan nitrat.',
            ],
            'CAMASTIL' => [
                'deskripsi' => 'Camastil adalah obat yang mengandung Cabergoline, digunakan untuk mengatasi hiperprolaktinemia (kelebihan hormon prolaktin) yang mempengaruhi fungsi seksual dan reproduksi.',
                'kegunaan' => 'Mengobati hiperprolaktinemia, menghambat laktasi (produksi ASI) pasca persalinan jika tidak menyusui, dan mengatasi gangguan menstruasi akibat prolaktin tinggi.',
                'dosis' => 'Hiperprolaktinemia: awal 0.5 mg/minggu, dinaikkan bertahap. Penghambatan laktasi: 1 mg dosis tunggal. Harus dengan resep dan pengawasan dokter.',
                'efek_samping' => 'Mual, pusing, sakit kepala, kelelahan, nyeri perut, konstipasi, dan hipotensi ortostatik (tekanan darah turun saat berdiri).',
            ],
            // === SUPLEMEN IMUNITAS (K0004) ===
            'STIMUNO' => [
                'deskripsi' => 'Stimuno adalah suplemen imunomodulator herbal yang mengandung ekstrak Phyllanthus niruri (meniran) untuk meningkatkan sistem kekebalan tubuh.',
                'kegunaan' => 'Meningkatkan daya tahan tubuh, membantu tubuh melawan infeksi, mempercepat pemulihan setelah sakit, dan sebagai imunomodulator alami.',
                'dosis' => 'Dewasa: 1 kapsul 3 kali sehari. Anak (sirup): 1 sendok takar 1-3 kali sehari sesuai usia. Diminum sebelum atau sesudah makan.',
                'efek_samping' => 'Umumnya aman karena berbahan herbal. Jarang terjadi: gangguan pencernaan ringan, reaksi alergi pada individu sensitif.',
            ],
            // === ALAT KESEHATAN (K0005) ===
            'Glukometer' => [
                'deskripsi' => 'Glukometer adalah alat pengukur kadar gula darah portabel yang digunakan untuk pemantauan mandiri penderita diabetes melitus.',
                'kegunaan' => 'Memantau kadar glukosa darah secara mandiri, membantu penderita diabetes mengontrol gula darah harian, dan menyesuaikan pola makan serta dosis obat.',
                'dosis' => 'Cuci tangan, tusuk ujung jari dengan lancet, teteskan darah pada strip tes, baca hasil dalam 5-10 detik. Normal puasa: 70-100 mg/dL.',
                'efek_samping' => 'Nyeri ringan saat penusukan jari. Hasil bisa tidak akurat jika strip kadaluarsa, tangan tidak bersih, atau alat tidak dikalibrasi.',
            ],
            'Spirometri' => [
                'deskripsi' => 'Spirometer adalah alat medis diagnostik yang digunakan untuk mengukur fungsi paru-paru, termasuk volume dan kapasitas udara yang dapat dihirup dan diembuskan.',
                'kegunaan' => 'Mendiagnosa penyakit paru seperti asma, PPOK, dan fibrosis paru. Memantau perkembangan penyakit paru dan mengevaluasi efektivitas pengobatan.',
                'dosis' => 'Tarik napas dalam-dalam lalu embuskan sekuat dan secepat mungkin ke dalam alat. Ulangi 3 kali untuk hasil terbaik. Dilakukan oleh tenaga medis terlatih.',
                'efek_samping' => 'Tidak ada efek samping signifikan. Beberapa orang mungkin merasa pusing atau sesak napas sementara setelah tes.',
            ],
            'Oksigen' => [
                'deskripsi' => 'Tabung Oksigen Medis adalah perangkat yang menyimpan oksigen murni bertekanan tinggi untuk terapi oksigen pada pasien dengan gangguan pernapasan.',
                'kegunaan' => 'Memberikan terapi oksigen pada pasien sesak napas, hipoksia, PPOK, pneumonia berat, dan kondisi darurat medis seperti gagal napas.',
                'dosis' => 'Sesuai resep dokter. Umumnya 1-6 liter/menit melalui nasal kanul atau 6-15 liter/menit melalui masker oksigen. Saturasi target: 94-98%.',
                'efek_samping' => 'Penggunaan berlebihan (hiperoksia) dapat menyebabkan toksisitas oksigen: iritasi saluran napas, kerusakan paru. Tabung bertekanan tinggi harus ditangani hati-hati.',
            ],
            // === PRODUK IBU & ANAK (K0003) ===
            'Folavicap' => [
                'deskripsi' => 'Folavicap adalah suplemen asam folat (Vitamin B9) yang sangat penting untuk ibu hamil, membantu mencegah cacat tabung saraf pada janin.',
                'kegunaan' => 'Mencegah neural tube defect (cacat tabung saraf) pada janin, membantu pembentukan sel darah merah, mendukung pertumbuhan plasenta, dan mencegah anemia megaloblastik.',
                'dosis' => 'Ibu hamil: 400-800 mcg (0.4-0.8 mg) sekali sehari, sebaiknya dimulai sejak perencanaan kehamilan dan dilanjutkan selama trimester pertama.',
                'efek_samping' => 'Umumnya aman pada dosis yang dianjurkan. Dosis sangat tinggi: mual, kembung, gangguan tidur, dan dapat menutupi gejala defisiensi vitamin B12.',
            ],
            'Bundavin' => [
                'deskripsi' => 'Bundavin adalah suplemen multivitamin dan mineral yang diformulasikan khusus untuk ibu hamil dan menyusui untuk mendukung kehamilan yang sehat.',
                'kegunaan' => 'Memenuhi kebutuhan vitamin dan mineral ibu hamil, mendukung perkembangan janin yang optimal, mencegah anemia, dan menjaga kesehatan ibu selama kehamilan.',
                'dosis' => 'Ibu hamil dan menyusui: 1 kaplet sekali sehari setelah makan, atau sesuai anjuran dokter.',
                'efek_samping' => 'Mual ringan (terutama jika diminum saat perut kosong), konstipasi ringan, feses berwarna gelap (normal, akibat kandungan zat besi).',
            ],
            'Elevit Multivitamin' => [
                'deskripsi' => 'Elevit adalah suplemen multivitamin dan mineral premium yang diformulasikan khusus untuk ibu hamil dan merencanakan kehamilan oleh Bayer.',
                'kegunaan' => 'Mendukung perkembangan otak janin, mencegah cacat tabung saraf, memenuhi kebutuhan nutrisi ibu hamil, dan meningkatkan kesuburan.',
                'dosis' => 'Wanita yang merencanakan kehamilan dan ibu hamil: 1 tablet sekali sehari bersama makanan. Mulai dari sebelum konsepsi hingga menyusui.',
                'efek_samping' => 'Mual ringan, konstipasi, feses berwarna gelap (normal). Jarang: reaksi alergi. Konsultasikan dengan dokter sebelum penggunaan.',
            ],
            // === PRODUK GIZI & NUTRISI (K0006) ===
            'Citoviplex' => [
                'deskripsi' => 'Citoviplex adalah suplemen vitamin dan mineral lengkap yang mengandung Vitamin A, B Complex, C, D, E, Kalsium, dan Zat Besi untuk memenuhi kebutuhan gizi harian.',
                'kegunaan' => 'Membantu memenuhi kebutuhan vitamin dan mineral harian, meningkatkan daya tahan tubuh, menjaga kesehatan tulang, dan mendukung metabolisme energi.',
                'dosis' => 'Dewasa: 1 kaplet sekali sehari setelah makan, atau sesuai anjuran dokter/apoteker.',
                'efek_samping' => 'Umumnya aman. Mual ringan jika diminum saat perut kosong. Alergi sangat jarang terjadi. Feses mungkin berwarna gelap.',
            ],
            'Cetopzink' => [
                'deskripsi' => 'Cetopzink adalah suplemen yang mengandung Zinc (Seng) yang berperan penting dalam sistem imun, pertumbuhan sel, dan metabolisme tubuh.',
                'kegunaan' => 'Membantu menjaga daya tahan tubuh, mendukung penyembuhan luka, menjaga kesehatan kulit dan rambut, serta mendukung fungsi indera perasa dan penciuman.',
                'dosis' => 'Dewasa: 1 tablet sekali sehari setelah makan. Anak sesuai anjuran dokter. Jangan melebihi dosis harian yang dianjurkan.',
                'efek_samping' => 'Mual, muntah, diare, dan rasa logam di mulut pada dosis tinggi. Penggunaan jangka panjang berlebihan dapat mengganggu penyerapan tembaga.',
            ],
        ];

        // Update semua produk berdasarkan nama
        $updated = 0;
        $notFound = [];

        $allProducts = DB::table('produkALKES')->get();

        foreach ($allProducts as $product) {
            $name = trim($product->produkName);
            $matched = false;

            // Cari exact match dulu
            if (isset($produkData[$name])) {
                DB::table('produkALKES')
                    ->where('produkId', $product->produkId)
                    ->update($produkData[$name]);
                $updated++;
                $matched = true;
            }

            // Kalau tidak exact match, coba partial match (case-insensitive)
            if (!$matched) {
                foreach ($produkData as $key => $data) {
                    if (stripos($name, $key) !== false || stripos($key, $name) !== false) {
                        DB::table('produkALKES')
                            ->where('produkId', $product->produkId)
                            ->update($data);
                        $updated++;
                        $matched = true;
                        break;
                    }
                }
            }

            if (!$matched) {
                $notFound[] = $name;

                // Berikan deskripsi generik untuk produk yang tidak dikenali
                DB::table('produkALKES')
                    ->where('produkId', $product->produkId)
                    ->update([
                        'deskripsi' => $name . ' adalah produk kesehatan yang tersedia di RuangKonsul untuk membantu menjaga kesehatan Anda.',
                        'kegunaan' => 'Mendukung kesehatan dan memenuhi kebutuhan medis sesuai indikasi produk. Baca kemasan untuk informasi lebih lanjut.',
                        'dosis' => 'Gunakan sesuai petunjuk pada kemasan atau anjuran tenaga kesehatan.',
                        'efek_samping' => 'Baca informasi pada kemasan produk. Konsultasikan dengan dokter atau apoteker jika mengalami reaksi tidak diinginkan.',
                    ]);
            }
        }

        $this->command->info("✅ Berhasil update deskripsi untuk {$updated} produk.");
        if (!empty($notFound)) {
            $this->command->warn("⚠️  Produk tanpa mapping spesifik (diberi deskripsi generik): " . implode(', ', $notFound));
        }
    }
}
