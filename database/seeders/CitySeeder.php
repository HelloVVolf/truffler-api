<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\District;
use App\Models\Subdistrict;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            "Jembrana",
            "Tabanan",
            "Badung",
            "Gianyar",
            "Klungkung",
            "Bangli",
            "Karangasem",
            "Buleleng",
            "Denpasar"
        ];

        $districts = [
            [
                "Negara",
                "Mendoyo",
                "Pekutatan",
                "Melaya",
                "Jembrana"
            ],
            [
                "Selemadeg",
                "East Selamadeg",
                "West Selemadeg",
                "Kerambitan",
                "Tabanan",
                "Kediri",
                "Marga",
                "Penebel",
                "Baturiti",
                "Pupuan"
            ], [
                "Kuta",
                "Mengwi",
                "Abiansemal",
                "Petang",
                "South Kuta",
                "North Kuta"
            ], [
                "Sukawati",
                "Blahbatuh",
                "Gianyar",
                "Tampaksiring",
                "Ubud",
                "Tegallalang",
                "Payangan"
            ], [
                "Nusa Penida",
                "Banjarangkan",
                "Klungkung",
                "Dawan"
            ], [
                "Susut",
                "Bangli",
                "Tembuku",
                "Kintamani"
            ], [
                "Rendang",
                "Sidemen",
                "Manggis",
                "Karangasem",
                "Abang",
                "Bebandem",
                "Selat",
                "Kubu"
            ], [
                "Gerokgak",
                "Seririt",
                "Busungbiu",
                "Banjar",
                "Sukasada",
                "Buleleng",
                "Sawan",
                "Kubutambahan",
                "Tejakula"
            ], [
                "South Denpasar",
                "East Denpasar",
                "West Denpasar",
                "North Denpasar"
            ]

        ];

        $subdistricts = [
            // Jembrana
            [
                [
                    "Baler Bale Agung",
                    "Central Banjar",
                    "Lelateng",
                    "West Loloan",
                    "Cupel",
                    "Baluk",
                    "Banyu Biru",
                    "Kaliakah",
                    "Berangbang",
                    "East Tegal Badeng",
                    "West Tegal Badeng",
                    "Pengambengan"
                ],
                [
                    "Tegalcangkring",
                    "Mendoyo Dauh Tukad",
                    "Pohsanten",
                    "Mendoyo Dangin Tukad",
                    "Pergung",
                    "Delodberawah",
                    "Penyaringan",
                    "Yehembang",
                    "Yeh Sumbul",
                    "Yehembang Kauh",
                    "Yehembang Kangin"
                ],
                [
                    "Medewi",
                    "Pulukan",
                    "Asahduren",
                    "Pekutatan",
                    "Pangyangan",
                    "Gumbrih",
                    "Manggissari",
                    "Pengragoan"
                ],
                [
                    "Gilimanuk",
                    "Melaya",
                    "Belimbingsari",
                    "Ekasari",
                    "Nusasari",
                    "Warnasari",
                    "Candikusuma",
                    "Tuwed",
                    "Tukadaya",
                    "Manistutu"
                ],
                [
                    "Pendem",
                    "East Loloan",
                    "Dauhwaru",
                    "Sangkaragung",
                    "Perancak",
                    "Batu Agung",
                    "Budeng",
                    "Air Kuning",
                    "Yehkuning",
                    "Dangin Tukadaya"
                ]
            ],
            // Tabanan
            [
                [
                    "Bajera",
                    "Wanagiri",
                    "Pupuan Sawah",
                    "Berembeng",
                    "Selemadeg",
                    "Sarampingan",
                    "Antap",
                    "Wanagiri Kauh",
                    "Manikyang",
                    "North Bajera"
                ], [
                    "Gunung Salak",
                    "Gadungan",
                    "Bantas",
                    "Mambang",
                    "Megati",
                    "Tangguntiti",
                    "Beraban",
                    "Tegal Mengkeb",
                    "Dalang",
                    "Gadungsari"
                ], [
                    "Mundeh",
                    "Mundeh Kangin",
                    "Lalanglinggah",
                    "Antosari",
                    "Lumbung",
                    "Lumbung Kauh",
                    "Tiing Gading",
                    "Mundeh Kauh",
                    "Angkah",
                    "Selabih",
                    "Bengkel Sari"
                ], [
                    "Tibubiu",
                    "Kelating",
                    "Penarukan",
                    "Belumbang",
                    "Tista",
                    "Kerambitan",
                    "Pangkung Karung",
                    "Samsam",
                    "Kukuh",
                    "Baturiti",
                    "Meliling",
                    "Sembung Gede",
                    "Batuaji",
                    "Kesiut",
                    "Timpag"
                ], [
                    "Sudimara",
                    "Gubug",
                    "Bongan",
                    "Delod Peken",
                    "Dauh Peken",
                    "Dajan Peken",
                    "Denbantas",
                    "Subamia",
                    "Wanasari",
                    "Tunjuk",
                    "Buahan",
                    "Sedandan"
                ], [
                    "Bengkel",
                    "Pangkung Tibah",
                    "Belalang",
                    "Beraban",
                    "Buwit",
                    "Cepaka",
                    "Kaba-kaba",
                    "Nyambu",
                    "Pandak Bandung",
                    "Pandak Gede",
                    "Nyitdah",
                    "Pejaten",
                    "Kediri",
                    "Abian Tuwung",
                    "Banjar Anyar"
                ], [
                    "Kukuh",
                    "Beringkit",
                    "Peken",
                    "Batannyuh",
                    "Tegaljadi",
                    "Kuwum",
                    "Selanbawak",
                    "Marga",
                    "Petiga",
                    "Cau Belayu",
                    "Tua",
                    "Payangan",
                    "Marga Dajan Puri",
                    "Marga Dauh Puri",
                    "Geluntung",
                    "Baru"
                ],
                [
                    'Rejasa',
                    'Jegu',
                    'Riang Gede',
                    'Buruan',
                    'Biaung',
                    'Pitra',
                    'Penatahan',
                    'Tengkudak',
                    'Mengesta',
                    'Penebel',
                    'Babakan',
                    'Senganan',
                    'Jatiluwih',
                    'Wongaya Gede',
                    'Tajen',
                    'Tegallinggah',
                    'Pesagi',
                    'Sangketan'
                ], [
                    "Perean",
                    "Luwus",
                    "Apuan",
                    "Angseri",
                    "Bangli",
                    "Baturiti",
                    "Antapan",
                    "Candikuning",
                    "Mekarsari",
                    "Batunya",
                    "Perean Tengah",
                    "Perean Kangin"
                ], [
                    "Belimbing",
                    "Sanda",
                    "Batungsel",
                    "Kebon Padangan",
                    "Munduk Temu",
                    "Pujungan",
                    "Pupuan",
                    "Bantiran",
                    "Padangan",
                    "Jelijih Punggung",
                    "Belatungan",
                    "Pajahan",
                    "Karyasari",
                    "Sai"
                ]
            ],

            // Badung
            [
                [
                    "Tuban",
                    "Kuta",
                    "Kedonganan",
                    "Legian",
                    "Seminyak"
                ], [
                    "Kapal",
                    "Sempidi",
                    "Abianbase",
                    "Sading",
                    "Lukluk",
                    "Munggu",
                    "Buduk",
                    "Mengwitani",
                    "Penarungan",
                    "Sembung",
                    "Baha",
                    "Mengwi",
                    "Kekeran",
                    "Sobangan",
                    "Gulingan",
                    "Werdi Bhuwana",
                    "Cemagi",
                    "Pererenan",
                    "Tumbakbayuh",
                    "Kuwun"
                ], [
                    "Darmasaba",
                    "Sibangkaja",
                    "Sibanggede",
                    "Jagapati",
                    "Angantaka",
                    "Sedang",
                    "Mambal",
                    "Abiansemal",
                    "Bongkasa",
                    "Taman",
                    "Blahkiuh",
                    "Ayunan",
                    "Sangeh",
                    "Punggul",
                    "Mekar Bhuwana",
                    "Abiansemal Dauh Yeh Cani",
                    "Selat",
                    "Bongkasa Pertiwi"
                ], [
                    "Carangsari",
                    "Petang",
                    "Belok/Sidan",
                    "Pelaga",
                    "Getasan",
                    "Pangsan",
                    "Sulangai"
                ],
                [
                    "Benoa",
                    "Tanjung Benoa",
                    "Jimbaran",
                    "Pecatu",
                    "Ungasan",
                    "Kutuh"
                ], [
                    "Kerobokan Kelod",
                    "Kerobokan",
                    "Kerobokan Kaja",
                    "Tibubeneng",
                    "Canggu",
                    "Dalung"
                ]



            ],

            // Gianyar
            [
                [
                    "Batubulan",
                    "Ketewel",
                    "Guwang",
                    "Sukawati",
                    "Celuk",
                    "Singapadu",
                    "Batuan",
                    "Kemenuh",
                    "Batubulan Kangin",
                    "Central Singapadu",
                    "Singapadu Kaler",
                    "Batuan Kaler"
                ], [
                    "Saba",
                    "Pering",
                    "Keramas",
                    "Belega",
                    "Blahbatuh",
                    "Buruan",
                    "Bedulu",
                    "Medahan",
                    "Bona"
                ], [
                    "Samplangan",
                    "Abianbase",
                    "Gianyar",
                    "Bitera",
                    "Beng",
                    "Tulikup",
                    "Sidan",
                    "Lebih",
                    "Bakbakan",
                    "Siangan",
                    "Suwat",
                    "Petak",
                    "Serongga",
                    "Petak Kaja",
                    "Temesi",
                    "Sumita",
                    "Tegal Tugu"
                ],
                [
                    "Pejeng",
                    "Sanding",
                    "Tampaksiring",
                    "Manukaya",
                    "Pejeng Kawan",
                    "Pejeng Kaja",
                    "Pejeng Kangin",
                    "Pejeng Kelod"
                ],
                [
                    "Ubud",
                    "Lodtunduh",
                    "Mas",
                    "Singakerta",
                    "Kedewatan",
                    "Peliatan",
                    "Petulu",
                    "Sayan"
                ],
                [
                    "Keliki",
                    "Tegallalang",
                    "Kenderan",
                    "Kedisan",
                    "Pupuan",
                    "Sebatu",
                    "Taro"
                ],
                [
                    "Melinggih",
                    "Kelusa",
                    "Bukian",
                    "Puhu",
                    "Buahan",
                    "Kerta",
                    "Melinggih Kelod",
                    "Buahan Kaja",
                    "Bresela"
                ]
            ],

            // Klungkung
            [
                [
                    "Sakti",
                    "Batumadeg",
                    "Klumpu",
                    "Batukandik",
                    "Sekartaji",
                    "Tanglad",
                    "Suana",
                    "Batununggul",
                    "Kutampi",
                    "Ped",
                    "Kampung Toyapakeh",
                    "Lembongan",
                    "Jungutbatu",
                    "Pejukutan",
                    "Kutampi Kaler",
                    "Bunga Mekar"
                ],
                [
                    "Negari",
                    "Takmung",
                    "Banjarangkan",
                    "Tusan",
                    "Bakas",
                    "Getakan",
                    "Tihingan",
                    "Aan",
                    "Nyalian",
                    "Bungbungan",
                    "Timuhun",
                    "Nyanglan",
                    "Tohpati"
                ],
                [
                    "Semarapura Kaja",
                    "Semarapura Kauh",
                    "Central Semarapura",
                    "Semarapura Kangin",
                    "Semarapura Kelod Kangin",
                    "Semarapura Kelod",
                    "Satra",
                    "Tojan",
                    "Gelgel",
                    "Kampung Gelgel",
                    "Jumpai",
                    "Tangkas",
                    "Kamasan",
                    "Akah",
                    "Manduang",
                    "Selat",
                    "Tegak",
                    "Selisihan"
                ], [
                    "Paksebali",
                    "Central Sampalan",
                    "Sampalan Kelod",
                    "Sulang",
                    "Gunaksa",
                    "Kusamba",
                    "Kampung Kusamba",
                    "Pesinggahan",
                    "Dawan Kelod",
                    "Pikat",
                    "Dawan Kaler",
                    "Besan"
                ],
            ],

            // Bangli
            [
                [
                    "Apuan",
                    "Demulih",
                    "Abuan",
                    "Susut",
                    "Sulahan",
                    "Penglumbaran",
                    "Tiga",
                    "Selat",
                    "Pengiangan"
                ],
                [
                    "Bebalang",
                    "Kawan",
                    "Cempaga",
                    "Kubu",
                    "Bunutin",
                    "Tamanbali",
                    "Kayubihi",
                    "Pengotan",
                    "Landih"
                ],
                [
                    "Jehem",
                    "Tembuku",
                    "Yangapi",
                    "Undisan",
                    "Bangbang",
                    "Peninjoan"
                ],
                [
                    "Mengani",
                    "Binyan",
                    "Ulian",
                    "Bunutin",
                    "Langgahan",
                    "Lembean",
                    "Manikliyu",
                    "Bayung Cerik",
                    "Mangguh",
                    "Belancan",
                    "Katung",
                    "Banua",
                    "Abuan",
                    "Bonyoh",
                    "Sekaan",
                    "Bayung Gede",
                    "Sekardadi",
                    "Kedisan",
                    "Buahan",
                    "Abangsongan",
                    "Suter",
                    "Batudinding",
                    "Terunyan",
                    "Songan A",
                    "Songan B",
                    "South Batur",
                    "Central Batur",
                    "North Batur",
                    "Kintamani",
                    "Serai",
                    "Daup",
                    "Awan",
                    "Gunungbau",
                    "Belanga",
                    "Batukaang",
                    "Belantih",
                    "Catur",
                    "Pengejaran",
                    "Selulung",
                    "Satra",
                    "Dausa",
                    "Bantang",
                    "Sukawana",
                    "Kutuh",
                    "Subaya",
                    "Siakin",
                    "Pinggan",
                    "Belandingan"
                ],
            ],

            // Karangasem
            [
                [
                    "Nongan",
                    "Rendang",
                    "Menanga",
                    "Besakih",
                    "Pempatan",
                    "Pesaban"
                ],
                [
                    "Tangkup",
                    "Talibeng",
                    "Sidemen",
                    "Sangkan Gunung",
                    "Telaga Tawang",
                    "Sinduwati",
                    "Tri Eka Buana",
                    "Kerta Buana",
                    "Lakasari",
                    "Wismakerta"
                ],
                [
                    "Gegelang",
                    "Antiga",
                    "Ulakan",
                    "Manggis",
                    "Nyuh Tebel",
                    "Tenganan",
                    "Ngis",
                    "Selumbung",
                    "Padangbai",
                    "Antiga Kelod",
                    "Pasedahan",
                    "Sengkidu"
                ],
                [
                    "Subagan",
                    "Padang Kerta",
                    "Karang Asem",
                    "Bugbug",
                    "Tumbu",
                    "Seraya",
                    "West Seraya",
                    "East Seraya",
                    "Pertima",
                    "Tegalinggah",
                    "Bukit"
                ],
                [
                    "Ababi",
                    "Tiying Tali",
                    "Bunutan",
                    "Tista",
                    "Abang",
                    "Pidpid",
                    "Datah",
                    "Culik",
                    "Purwakerti",
                    "Kerta Mandala",
                    "Labasari",
                    "Nawa Kerti",
                    "Kesimpar",
                    "Tribuana"
                ],
                [
                    "Bungaya",
                    "Budekeling",
                    "Bebanden",
                    "Sibetan",
                    "Jungutan",
                    "Bungaya Kangin",
                    "Buana Giri",
                    "Macang"
                ],
                [
                    "Muncan",
                    "Selat",
                    "Duda",
                    "Sebudi",
                    "North Duda",
                    "East Duda",
                    "Pering Sari",
                    "Amerta Bhuana"
                ],
                [
                    "Ban",
                    "Dukuh",
                    "Kubu",
                    "Tianyar",
                    "West Tianyar",
                    "Central Tianyar",
                    "Tulamben",
                    "Baturinggit",
                    "Sukadana"
                ],
            ],

            [
                [
                    "Sumberklampok",
                    "Pejarakan",
                    "Sumberkima",
                    "Pemuteran",
                    "Banyupoh",
                    "Penyambangan",
                    "Musi",
                    "Sanggalangit",
                    "Gerokgak",
                    "Patas",
                    "Pengulon",
                    "Tinga-tinga",
                    "Celukanbawang",
                    "Tukadsumaga"
                ],
                [
                    "Seririt",
                    "Unggahan",
                    "Ularan",
                    "Ringdikit",
                    "Rangdu",
                    "Mayong",
                    "Gunungsari",
                    "Munduk Bestala",
                    "Bestala",
                    "Kalianget",
                    "Joanyar",
                    "Tangguwisia",
                    "Sulanyah",
                    "Bubunan",
                    "Patemon",
                    "Pengastulan",
                    "Lokapaksa",
                    "Pangkungparuk",
                    "Banjarasem",
                    "Kalisada",
                    "Umeanyar"
                ],
                [
                    "Sepang",
                    "Tista",
                    "Bongancina",
                    "Pucaksari",
                    "Telaga",
                    "Titab",
                    "Subuk",
                    "Tinggarsari",
                    "Kedis",
                    "Kekeran",
                    "Busungbiu",
                    "Pelapuan",
                    "Bengkel",
                    "Umejero",
                    "Sepang Kelod"
                ],
                [
                    "Banyuseri",
                    "Tirtasari",
                    "Kayuputih",
                    "Banyuatis",
                    "Gesing",
                    "Munduk",
                    "Gobleg",
                    "Pedawa",
                    "Cempaga",
                    "Sidetapa",
                    "Tampekan",
                    "Banjar Tegeha",
                    "Banjar",
                    "Dencarik",
                    "Temukus",
                    "Tigawasa",
                    "Kaliasem"
                ],
                [
                    "Sukasada",
                    "Pancasari",
                    "Wanagiri",
                    "Ambengan",
                    "Gitgit",
                    "Pegayaman",
                    "Silangjana",
                    "Pegadungan",
                    "Padangbulia",
                    "Sambangan",
                    "Panji",
                    "Panji Anom",
                    "Tegallinggah",
                    "Selat",
                    "Kayu Putih"
                ],
                [
                    "Banyuasri",
                    "Banjar Tegal",
                    "Kendran",
                    "Paket Agung",
                    "Kampung Singaraja",
                    "Liligundi",
                    "Beratan",
                    "Banyuning",
                    "Penarukan",
                    "Kampung Kajanan",
                    "Astina",
                    "Banjar Jawa",
                    "Kaliuntu",
                    "Kampung Anyar",
                    "Kampung Bugis",
                    "Banjar Bali",
                    "Kampung Baru",
                    "Kalibukbuk",
                    "Anturan",
                    "Tukadmungga",
                    "Pemaron",
                    "Baktiseraga",
                    "Sarimekar",
                    "Nagasepaha",
                    "Petandakan",
                    "Alasangker",
                    "Poh Bergong",
                    "Jinangdalem",
                    "Penglatan"
                ],
                [
                    "Lemukih",
                    "Galungan",
                    "Sekumpul",
                    "Bebetin",
                    "Sudaji",
                    "Sawan",
                    "Menyali",
                    "Suwug",
                    "Jagaraga",
                    "Sinabun",
                    "Kerobokan",
                    "Sangsit",
                    "Bungkulan",
                    "Giri Emas"
                ],
                [
                    "Tambakan",
                    "Pakisan",
                    "Bontihing",
                    "Tajun",
                    "Tunjung",
                    "Depeha",
                    "Tamblang",
                    "Bulian",
                    "Bila",
                    "Bengkala",
                    "Kubutambahan",
                    "Bukti",
                    "Mengening"
                ],
                [
                    "Sembiran",
                    "Pacung",
                    "Julah",
                    "Madenan",
                    "Bondalem",
                    "Tejakula",
                    "Les",
                    "Penuktukan",
                    "Sambirenteng",
                    "Tembok"
                ]
            ],

            // Denpasar
            [
                [
                    "Serangan",
                    "Pedungan",
                    "Sesetan",
                    "Panjer",
                    "Renon",
                    "Sanur",
                    "Sidakarya",
                    "Pemogan",
                    "Sanur Kaja",
                    "Sanur Kauh"
                ],

                [
                    "Kesiman",
                    "Sumerta",
                    "Dangin Puri",
                    "Penatih",
                    "Dangin Puri Kelod",
                    "Sumerta Kelod",
                    "Kesiman Petilan",
                    "Kesiman Kertalangu",
                    "Sumerta Kaja",
                    "Sumerta Kauh",
                    "Penatih Dangin Puri"
                ],

                [
                    "Dauh Puri",
                    "Pemecutan",
                    "Padangsambian",
                    "Padangsambian Kelod",
                    "Pemecutan Kelod",
                    "Dauh Puri Kauh",
                    "Dauh Puri Kelod",
                    "Dauh Puri Kangin",
                    "Tegal Harum",
                    "Tegal Kertha",
                    "Padang Sambian Kaja"
                ],

                [
                    "Tonja",
                    "Ubung",
                    "Peguyangan",
                    "Dangin Puri Kangin",
                    "Dangin Puri Kauh",
                    "Dangin Puri Kaja",
                    "Pemecutan Kaja",
                    "Dauh Puri Kaja",
                    "Ubung Kaja",
                    "Peguyangan Kaja",
                    "Peguyangan Kangin"
                ]
            ]
        ];

        foreach ($cities as $key => $city) {
            $cityModel = City::create([
                'name' => $city,
            ]);

            foreach ($districts[$key] as $subkey => $district) {
                $districtModel = District::create([
                    'name'    => $district,
                    'city_id' => $cityModel->id,
                ]);

                if (isset($subdistricts[$key][$subkey]) && is_array($subdistricts[$key][$subkey])) {
                    foreach ($subdistricts[$key][$subkey] as $subsubdistrict) {
                        Subdistrict::create([
                            'name'        => $subsubdistrict,
                            'district_id' => $districtModel->id,
                        ]);
                    }
                }
            }
        }
    }
}
