<?php
// --- Configuration & Data ---

// Product Data
$products = [
    [
        'id' => 1,
        'title' => 'हलव्याची माळ',
        'desc' => 'पारंपरिक तिळगूळ माळ - हाताने बनवलेली',
        'price' => 450,
        'old_price' => 600,
        'image' => 'assets/images/showcase/img_01.png',
        'tag' => 'सर्वाधिक लोकप्रिय',
        'tag_color' => 'bg-kumkum text-white',
        'offer' => '२५% सूट'
    ],
    [
        'id' => 2,
        'title' => 'बांगड्या (जोडी)',
        'desc' => 'पारंपरिक तिळगूळ बांगड्या',
        'price' => 350,
        'old_price' => null, // No old price
        'image' => 'assets/images/showcase/img_04.png',
        'tag' => null,
        'tag_color' => null,
        'offer' => null
    ],
    [
        'id' => 3,
        'title' => 'कानातले',
        'desc' => 'सुंदर तिळगूळ कानातले',
        'price' => 250,
        'old_price' => null,
        'image' => 'assets/images/showcase/img_03.png',
        'tag' => null,
        'tag_color' => null,
        'offer' => null
    ],
    [
        'id' => 4,
        'title' => 'कमरपट्टा',
        'desc' => 'पारंपरिक तिळगूळ कमरपट्टा',
        'price' => 400,
        'old_price' => null,
        'image' => 'assets/images/showcase/img_02.jpeg',
        'tag' => null,
        'tag_color' => null,
        'offer' => null
    ],
    [
        'id' => 5,
        'title' => 'पूर्ण सेट',
        'desc' => 'सर्व दागिने एकत्र - माळ, बांगड्या, कानातले, कमरपट्टा',
        'price' => 1299,
        'old_price' => 1450,
        'image' => 'assets/images/showcase/img_05.png',
        'tag' => '⭐ सर्वोत्तम किंमत',
        'tag_color' => 'bg-turmeric text-deep-black',
        'offer' => '₹१५१ बचत'
    ]
];

// Testimonial Data
$testimonials = [
    [
        'name' => 'प्रिया देशपांडे',
        'location' => 'कोथरूड, पुणे',
        'initial' => 'प्र',
        'gradient' => 'from-kumkum to-turmeric',
        'text' => 'खूप सुंदर आणि पारंपरिक दागिने. वेळेवर डिलिव्हरी मिळाली. गुणवत्ता उत्तम आहे.'
    ],
    [
        'name' => 'सुनीता पाटील',
        'location' => 'शिवाजीनगर, पुणे',
        'initial' => 'स',
        'gradient' => 'from-turmeric to-kumkum',
        'text' => 'WhatsApp वर ऑर्डर करणे खूप सोपे झाले. खऱ्या पारंपरिक दागिने मिळाले. धन्यवाद!'
    ],
    [
        'name' => 'मीना कुलकर्णी',
        'location' => 'वडगांव, पुणे',
        'initial' => 'म',
        'gradient' => 'from-kumkum to-turmeric',
        'text' => 'स्थानिक विक्रेते आणि प्रामाणिक व्यवहार. सणासाठी परफेक्ट दागिने. शिफारस करते!'
    ]
];

// FAQ Data
$faqs = [
    [
        'id' => 1,
        'question' => 'WhatsApp वर ऑर्डर कसे द्यावे?',
        'answer' => 'येथील कोणत्याही "WhatsApp वर ऑर्डर करा" बटणावर क्लिक करा, आपल्याला हवे ते दागिना सांगा, आणि आम्ही पत्ता घेऊन डिलिव्हरी करू.'
    ],
    [
        'id' => 2,
        'question' => 'डिलिव्हरीला किती वेळ लागतो?',
        'answer' => 'पुण्यात २-३ दिवसांत डिलिव्हरी मिळेल. १४ जानेवारी २०२६ पूर्वी डिलिव्हरीची हमी.'
    ]
];

?>

<!DOCTYPE html>
<html lang="mr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>हलव्याचे दागिने - मकर संक्रांत २०२६ विशेष | पुणे</title>
    <meta name="description" content="मकर संक्रांत २०२६ साठी पारंपरिक हलव्याचे दागिने. पुण्यातील विश्वासार्ह हाताने बनवलेले तिळगूळ दागिने. WhatsApp वर ऑर्डर करा.">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Marathi:ital@0;1&family=Baloo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'kumkum': '#c1121f',      // Red
                        'turmeric': '#f59f00',    // Yellow/Orange
                        'deep-black': '#1a1a1a',  // Black
                        'cream': '#fdfbf7',       // Background
                    },
                    fontFamily: {
                        sans: ['"Baloo 2"', 'sans-serif'],
                        serif: ['"Tiro Devanagari Marathi"', 'serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-slow': 'float 8s ease-in-out infinite',
                        'spin-slow': 'spin 12s linear infinite',
                        'marquee': 'marquee 25s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        marquee: {
                            '0%': { transform: 'translateX(0%)' },
                            '100%': { transform: 'translateX(-100%)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Utilities */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        
        /* Hide Scrollbar but allow scrolling */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .grayscale-hover {
            filter: grayscale(0%);
            transition: filter 0.3s ease;
        }
        .group:hover .grayscale-hover {
            filter: grayscale(0%);
        }

        /* FIX: Remove the | cursor on text */
        body {
            cursor: default;
        }
        
        /* Optional: Prevent text selection highlighting if desired */
        .no-select {
            -webkit-user-select: none; /* Safari */
            -ms-user-select: none; /* IE 10 and IE 11 */
            user-select: none; /* Standard syntax */
        }
    </style>
</head>

<body class="bg-cream text-deep-black antialiased overflow-x-hidden selection:bg-kumkum selection:text-white font-sans cursor-default">

    <div class="fixed inset-0 pointer-events-none z-0 opacity-[0.03]">
        <div class="absolute top-20 left-10 w-32 h-32 rounded-full bg-gradient-to-r from-kumkum to-transparent blur-3xl"></div>
        <div class="absolute top-40 right-20 w-40 h-40 rounded-full bg-gradient-to-r from-turmeric to-transparent blur-3xl"></div>
        <div class="absolute bottom-40 left-1/4 w-36 h-36 rounded-full bg-gradient-to-r from-kumkum to-transparent blur-3xl"></div>
    </div>

    <nav class="fixed top-0 w-full z-50 py-4 px-4 md:px-8 no-select">
        <div class="glass-card max-w-7xl mx-auto rounded-full py-3 px-6 flex items-center justify-between backdrop-blur-xl border border-kumkum/20">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-kumkum flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                        <circle cx="12" cy="8" r="6" />
                        <path d="M12 14v7" />
                        <path d="M8 21h8" />
                    </svg>
                </div>
                <span class="text-lg md:text-xl font-bold tracking-tight text-deep-black">हलव्याचे दागिने</span>
            </div>

            <div class="hidden md:flex items-center gap-8 text-sm font-medium text-deep-black/70">
                <a href="#products" class="hover:text-kumkum transition-colors">दागिने</a>
                <a href="#tradition" class="hover:text-kumkum transition-colors">परंपरा</a>
                <a href="#trust" class="hover:text-kumkum transition-colors">आमच्याबद्दल</a>
            </div>

            <a href="https://wa.me/7796080794?text=नमस्कार,%20मला%20मकर%20संक्रांतीसाठी%20हलव्याचे%20दागिने%20ऑर्डर%20करायचे%20आहेत." target="_blank" rel="noopener noreferrer" class="bg-kumkum text-white px-5 py-2 rounded-full text-sm font-bold hover:bg-kumkum/90 transition-all flex items-center gap-2 shadow-lg shadow-kumkum/30">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                </svg>
                <span class="hidden sm:inline">ऑर्डर करा</span>
            </a>
        </div>
    </nav>

    <section id="hero" class="relative min-h-screen flex items-center justify-center pt-32 pb-20 px-4 md:px-8 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1571417615472-ad2c9330c362" alt="मकर संक्रांत वातावरण" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-t from-cream via-cream/80 to-transparent"></div>
        </div>

        <div class="absolute top-32 right-4 md:right-12 z-30 hidden md:block animate-float no-select">
            <div class="relative w-28 h-28 flex items-center justify-center">
                <svg class="animate-spin-slow w-full h-full" viewBox="0 0 100 100">
                    <path id="circlePath" d="M 50, 50 m -37, 0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0" fill="transparent" />
                    <text font-size="9" font-family="Baloo 2" font-weight="700" letter-spacing="2px" fill="#c1121f">
                        <textPath href="#circlePath" startOffset="0%">
                            मर्यादित • स्टॉक • मर्यादित • स्टॉक •
                        </textPath>
                    </text>
                </svg>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-16 h-16 rounded-full bg-kumkum flex items-center justify-center shadow-xl shadow-kumkum/40">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                            <path d="M12 2v20M2 12h20" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 flex flex-col gap-8">
                <div>
                    <div class="inline-flex items-center gap-2 glass-card px-4 py-2 rounded-full mb-6 border border-kumkum/20 no-select">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-kumkum opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-kumkum"></span>
                        </span>
                        <span class="text-xs font-bold text-kumkum uppercase tracking-wider">मकर संक्रांत २०२६ विशेष</span>
                    </div>

                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-black leading-[1.1] tracking-tight text-deep-black mb-6">
                        मकर संक्रांत<br />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-kumkum via-turmeric to-kumkum">पारंपरिक</span><br />
                        हलव्याचे दागिने
                    </h1>

                    <p class="text-lg md:text-xl text-deep-black/70 leading-relaxed max-w-2xl font-medium mb-3">
                        महाराष्ट्रातील मकर संक्रांतीची गोड परंपरा
                    </p>

                    <p class="text-base md:text-lg text-deep-black/60 leading-relaxed max-w-xl">
                        पुण्यातील विश्वासार्ह हाताने बनवलेले पारंपरिक तिळगूळ दागिने. १४ जानेवारी २०२६ पूर्वी डिलिव्हरी हमी.
                    </p>
                </div>

                <div class="glass-card rounded-3xl p-6 max-w-md border border-kumkum/20 no-select">
                    <div class="flex items-center gap-3 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-kumkum">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg>
                        <span class="text-sm font-bold text-kumkum uppercase tracking-wider">मकर संक्रांतीपर्यंत वेळ</span>
                    </div>
                    <div class="grid grid-cols-4 gap-3">
                        <div class="text-center">
                            <div class="text-3xl font-black text-deep-black" id="days">00</div>
                            <div class="text-xs text-deep-black/60 mt-1">दिवस</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-black text-deep-black" id="hours">00</div>
                            <div class="text-xs text-deep-black/60 mt-1">तास</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-black text-deep-black" id="minutes">00</div>
                            <div class="text-xs text-deep-black/60 mt-1">मिनिटे</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-black text-deep-black" id="seconds">00</div>
                            <div class="text-xs text-deep-black/60 mt-1">सेकंद</div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 no-select">
                    <a href="./collections.php" class="bg-kumkum text-white px-8 py-4 rounded-2xl text-base font-bold hover:bg-kumkum/90 transition-all shadow-xl shadow-kumkum/30 flex items-center justify-center gap-3 hover:-translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="6" />
                            <path d="M12 14v7" />
                            <path d="M8 21h8" />
                        </svg>
                        दागिने पाहा
                    </a>
                    <a href="https://wa.me/7796080794?text=नमस्कार,%20मला%20मकर%20संक्रांतीसाठी%20हलव्याचे%20दागिने%20ऑर्डर%20करायचे%20आहेत." target="_blank" class="glass-card border border-kumkum/30 text-deep-black px-8 py-4 rounded-2xl text-base font-bold hover:bg-kumkum/5 transition-all flex items-center justify-center gap-3 group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" class="text-[#25D366]">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                        </svg>
                        WhatsApp वर ऑर्डर करा
                    </a>
                </div>

                <div class="flex items-center gap-6 pt-6 border-t border-deep-black/10 no-select">
                    <div class="flex -space-x-3">
                        <div class="w-10 h-10 rounded-full border-2 border-cream bg-gradient-to-br from-kumkum to-turmeric flex items-center justify-center text-white text-xs font-bold">म</div>
                        <div class="w-10 h-10 rounded-full border-2 border-cream bg-gradient-to-br from-turmeric to-kumkum flex items-center justify-center text-white text-xs font-bold">स</div>
                        <div class="w-10 h-10 rounded-full border-2 border-cream bg-gradient-to-br from-kumkum to-turmeric flex items-center justify-center text-white text-xs font-bold">ह</div>
                        <div class="w-10 h-10 rounded-full border-2 border-cream bg-deep-black/90 flex items-center justify-center text-white text-xs font-bold">+२क</div>
                    </div>
                    <div>
                        <div class="flex items-center gap-1 text-turmeric mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        </div>
                        <p class="text-sm text-deep-black/60">पुण्यातील २,००० कुटुंबांचा विश्वास</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 hidden lg:flex justify-center items-center">
                <div class="relative animate-float-slow">
                    <div class="glass-card rounded-3xl p-6 max-w-sm border border-kumkum/20 shadow-2xl">
                        <div class="aspect-square rounded-2xl overflow-hidden mb-6 bg-white/50">
                            <img src="assets/images/showcase/img_01.png" alt="पारंपरिक हलव्याचे दागिने माळ" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <div class="text-xs uppercase tracking-wider text-kumkum font-bold mb-1">खास ऑफर</div>
                                <div class="text-xl font-bold text-deep-black">हलव्याची माळ</div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-black text-kumkum">₹४५०</div>
                                <div class="text-xs text-deep-black/60 line-through">₹६००</div>
                            </div>
                        </div>
                        <a href="https://wa.me/7796080794?text=नमस्कार,%20मला%20हलव्याची%20माळ%20ऑर्डर%20करायची%20आहे." target="_blank" class="w-full bg-kumkum text-white py-3 rounded-xl font-bold text-sm hover:bg-kumkum/90 transition-all flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                            ऑर्डर करा
                        </a>
                    </div>
                    <div class="absolute top-4 -right-4 w-full h-full border border-turmeric/20 rounded-3xl -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <div class="w-full overflow-hidden bg-kumkum py-4 border-y-2 border-deep-black no-select">
        <div class="flex whitespace-nowrap animate-marquee">
            <div class="flex items-center gap-8 text-white text-sm font-bold tracking-wider px-6 uppercase">
                <span>⚠️ मर्यादित स्टॉक</span><span class="w-2 h-2 rounded-full bg-white"></span>
                <span>१४ जानेवारीपूर्वी डिलिव्हरी हमी</span><span class="w-2 h-2 rounded-full bg-white"></span>
                <span>फक्त ७ दिवस शिल्लक</span><span class="w-2 h-2 rounded-full bg-white"></span>
                <span>पुण्यातील विश्वासार्ह विक्रेते</span><span class="w-2 h-2 rounded-full bg-white"></span>
                <span>⚠️ मर्यादित स्टॉक</span><span class="w-2 h-2 rounded-full bg-white"></span>
                <span>१४ जानेवारीपूर्वी डिलिव्हरी हमी</span><span class="w-2 h-2 rounded-full bg-white"></span>
                <span>फक्त ७ दिवस शिल्लक</span><span class="w-2 h-2 rounded-full bg-white"></span>
                <span>पुण्यातील विश्वासार्ह विक्रेते</span>
            </div>
        </div>
    </div>

    <section id="tradition" class="py-24 px-4 md:px-8 relative border-b border-deep-black/5">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 rounded-full bg-turmeric/20 text-turmeric text-xs font-bold uppercase tracking-wider mb-4">महाराष्ट्रीय परंपरा</span>
                <h2 class="text-4xl md:text-5xl font-black text-deep-black tracking-tight mb-4">
                    हलव्याचे दागिने -<br />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-kumkum to-turmeric">५०० वर्षांची परंपरा</span>
                </h2>
                <p class="text-lg text-deep-black/70 max-w-2xl mx-auto font-medium">
                    मकर संक्रांतीला तिळगूळ देताना परिधान केलेले विशेष पारंपरिक दागिने
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 auto-rows-[280px]">
                <div class="md:col-span-7 md:row-span-2 relative rounded-3xl overflow-hidden group glass-card border border-kumkum/10">
                    <img src="assets/images/image1.png" alt="मकर संक्रांतीला पारंपरिक महाराष्ट्रीय स्त्री" class="w-full h-full object-cover object-[60%_center] transition-transform duration-700 group-hover:scale-105 opacity-90">
                    <div class="absolute inset-0 bg-gradient-to-t from-deep-black/80 via-deep-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 p-8 w-full">
                        <h3 class="text-2xl md:text-3xl font-bold text-white mb-2">पारंपरिक वारसा</h3>
                        <p class="text-white/80 text-sm leading-relaxed">
                            सासूबाईंकडून सुनेला दिला जाणारा आशीर्वाद म्हणून हलव्याचे दागिने मकर संक्रांतीच्या सणाशी निगडित आहेत.
                        </p>
                    </div>
                </div>

                <div class="md:col-span-5 relative rounded-3xl glass-card p-8 border border-turmeric/20 flex flex-col justify-center hover:border-turmeric/40 transition-colors">
                    <div class="w-12 h-12 rounded-full bg-turmeric/20 flex items-center justify-center mb-6 text-turmeric">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.42 4.58a5.4 5.4 0 0 0-7.65 0l-.77.78-.77-.78a5.4 5.4 0 0 0-7.65 0C1.46 6.7 1.33 10.28 4 13l8 8 8-8c2.67-2.72 2.54-6.3.42-8.42z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-deep-black mb-3">सांस्कृतिक महत्त्व</h3>
                    <p class="text-deep-black/70 text-sm leading-relaxed">
                        मकर संक्रांतीला "तिळगूळ घ्या आणि गोड गोड बोला" म्हणत शुभेच्छा देण्याची परंपरा आहे.
                    </p>
                </div>

                <div class="md:col-span-5 relative rounded-3xl glass-card p-8 border border-kumkum/20 flex flex-col justify-center hover:border-kumkum/40 transition-colors">
                    <div class="w-12 h-12 rounded-full bg-kumkum/20 flex items-center justify-center mb-6 text-kumkum">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.42 4.58a5.4 5.4 0 0 0-7.65 0l-.77.78-.77-.78a5.4 5.4 0 0 0-7.65 0C1.46 6.7 1.33 10.28 4 13l8 8 8-8c2.67-2.72 2.54-6.3.42-8.42z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-deep-black mb-3">प्रेम आणि शुभेच्छा</h3>
                    <p class="text-deep-black/70 text-sm leading-relaxed">
                        हलव्याचे दागिने हे फक्त सजावट नसून ते प्रेम, गोडवा आणि कुटुंबातील बंध यांचे प्रतीक आहेत.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="products" class="py-24 px-4 md:px-8 bg-deep-black/[0.02]">
        <div class="max-w-7xl mx-auto">
            
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                
                <div class="w-full md:w-auto text-left">
                    <span class="inline-block px-4 py-2 rounded-full bg-kumkum/20 text-kumkum text-xs font-bold uppercase tracking-wider mb-4">आमचे दागिने</span>
                    <h2 class="text-4xl md:text-5xl font-black text-deep-black tracking-tight">खास संग्रह</h2>
                    <p class="text-lg text-deep-black/70 mt-3 font-medium">पारंपरिक हाताने बनवलेले तिळगूळ दागिने</p>
                </div>

                <div class="w-full md:w-auto flex justify-end">
                    <a href="./collections.php" class="group relative inline-flex items-center gap-3 px-8 py-3 bg-gradient-to-r from-kumkum to-turmeric text-white rounded-full font-bold shadow-lg shadow-kumkum/40 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-turmeric/50 overflow-hidden ring-4 ring-white/30">
                        
                        <div class="absolute inset-0 -translate-x-full group-hover:translate-x-full transition-transform duration-700 bg-gradient-to-r from-transparent via-white/30 to-transparent"></div>

                        <span class="relative tracking-wide">अधिक पहा</span>
                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="relative transition-transform duration-300 group-hover:translate-x-1">
                            <path d="M5 12h14"></path>
                            <path d="m12 5 7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                
            </div>

            <div class="hidden md:flex justify-end mb-4 text-sm text-deep-black/60 items-center gap-2">
                <span>स्वाइप करा →</span>
            </div>

            <div id="productSlider" class="flex gap-6 overflow-x-auto no-scrollbar snap-x snap-mandatory pb-8">

                <?php foreach ($products as $product): ?>
                <div class="min-w-[85vw] md:min-w-[380px] snap-start group relative shrink-0">
                    <div class="relative min-h-[520px] overflow-hidden rounded-3xl glass-card border border-kumkum/10">
                        <?php if ($product['tag']): ?>
                        <div class="absolute top-4 left-4 px-3 py-1.5 rounded-full <?= $product['tag_color'] ?: 'bg-kumkum text-white' ?> text-xs font-bold z-10">
                            <?= $product['tag'] ?>
                        </div>
                        <?php endif; ?>

                        <div class="h-[340px] overflow-hidden">
                            <img src="<?= $product['image'] ?>" alt="<?= $product['title'] ?>" class="w-full h-full object-cover grayscale-hover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-deep-black mb-2"><?= $product['title'] ?></h3>
                            <p class="text-deep-black/60 text-sm mb-4"><?= $product['desc'] ?></p>
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <span class="text-3xl font-black text-kumkum">₹<?= $product['price'] ?></span>
                                    <?php if ($product['old_price']): ?>
                                    <span class="text-sm text-deep-black/50 line-through ml-2">₹<?= $product['old_price'] ?></span>
                                    <?php endif; ?>
                                </div>
                                <?php if ($product['offer']): ?>
                                <span class="px-3 py-1 rounded-full bg-turmeric/20 text-turmeric text-xs font-bold"><?= $product['offer'] ?></span>
                                <?php endif; ?>
                            </div>
                            <?php 
                                $message = "नमस्कार, मला " . $product['title'] . " (₹" . $product['price'] . ") ऑर्डर करायची आहे.";
                                $whatsapp_link = "https://wa.me/7796080794?text=" . urlencode($message);
                                $btn_bg = ($product['id'] == 5) ? 'bg-gradient-to-r from-kumkum to-turmeric hover:opacity-90 shadow-kumkum/40' : 'bg-kumkum hover:bg-kumkum/90 shadow-kumkum/30';
                            ?>
                            <a href="<?= $whatsapp_link ?>" target="_blank" class="w-full <?= $btn_bg ?> text-white py-3 h-12 rounded-xl font-bold text-sm transition-all flex items-center justify-center gap-2 shadow-lg leading-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="flex-shrink-0">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                </svg>
                                WhatsApp वर ऑर्डर करा
                            </a>
                        </div>
                    </div>
                    <div class="absolute top-4 -right-2 w-full h-full border border-turmeric/20 rounded-3xl -z-10 group-hover:top-2 group-hover:-right-1 transition-all"></div>
                </div>
                <?php endforeach; ?>

            </div>

            <div class="flex justify-center items-center gap-6 mt-6 no-select">
                <button onclick="slideLeft()" class="w-10 h-10 rounded-full bg-white shadow flex items-center justify-center hover:bg-kumkum hover:text-white transition">◀</button>
                <div id="sliderDots" class="flex gap-2"></div>
                <button onclick="slideRight()" class="w-10 h-10 rounded-full bg-white shadow flex items-center justify-center hover:bg-kumkum hover:text-white transition">▶</button>
            </div>
            <p class="text-center text-sm text-gray-500 mt-2 no-select">अधिक दागिने पाहण्यासाठी स्लाइड करा →</p>
        </div>
    </section>

    <section id="trust" class="py-24 px-4 md:px-8 border-t border-deep-black/5">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-black text-deep-black tracking-tight mb-4">आमच्यावर का विश्वास ठेवावा?</h2>
                <p class="text-lg text-deep-black/70 max-w-2xl mx-auto font-medium">पुण्यातील हजारो कुटुंबांचा विश्वास</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="glass-card p-8 rounded-3xl border border-kumkum/10 hover:border-kumkum/30 transition-all text-center">
                    <div class="w-16 h-16 rounded-full bg-kumkum/20 flex items-center justify-center mx-auto mb-6 text-kumkum">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-deep-black mb-3">पुण्यातील स्थानिक</h3>
                    <p class="text-deep-black/60 text-sm leading-relaxed">आम्ही पुण्यातील स्थानिक विक्रेते आहोत. तुमच्या जवळच उपलब्ध.</p>
                </div>
                <div class="glass-card p-8 rounded-3xl border border-turmeric/10 hover:border-turmeric/30 transition-all text-center">
                    <div class="w-16 h-16 rounded-full bg-turmeric/20 flex items-center justify-center mx-auto mb-6 text-turmeric">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20"/><path d="m15 5-3-3-3 3"/><path d="m9 19 3 3 3-3"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-deep-black mb-3">हाताने बनवलेले</h3>
                    <p class="text-deep-black/60 text-sm leading-relaxed">प्रत्येक दागिना पारंपरिक पद्धतीने हाताने तयार केलेला आहे.</p>
                </div>
                <div class="glass-card p-8 rounded-3xl border border-kumkum/10 hover:border-kumkum/30 transition-all text-center">
                    <div class="w-16 h-16 rounded-full bg-kumkum/20 flex items-center justify-center mx-auto mb-6 text-kumkum">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-deep-black mb-3">वेळेत डिलिव्हरी</h3>
                    <p class="text-deep-black/60 text-sm leading-relaxed">१४ जानेवारी २०२६ पूर्वी तुमच्या घरी पोहोचण्याची १००% हमी.</p>
                </div>
                <div class="glass-card p-8 rounded-3xl border border-turmeric/10 hover:border-turmeric/30 transition-all text-center">
                    <div class="w-16 h-16 rounded-full bg-turmeric/20 flex items-center justify-center mx-auto mb-6 text-turmeric">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a5.4 5.4 0 0 1-7.65 0l-.77-.78-.77-.78a5.4 5.4 0 0 1-7.65 0C1.46 6.7 1.33 10.28 4 13l8 8 8-8c2.67-2.72 2.54-6.3.42-8.42Z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-deep-black mb-3">१००% महाराष्ट्रीय</h3>
                    <p class="text-deep-black/60 text-sm leading-relaxed">महाराष्ट्रीय परंपरेला जपून तयार केलेले प्रामाणिक दागिने.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 px-4 md:px-8 bg-deep-black/[0.02] border-t border-deep-black/5">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 rounded-full bg-turmeric/20 text-turmeric text-xs font-bold uppercase tracking-wider mb-4">ग्राहक प्रतिक्रिया</span>
                <h2 class="text-4xl md:text-5xl font-black text-deep-black tracking-tight mb-4">आमच्या ग्राहकांचे अनुभव</h2>
                <p class="text-lg text-deep-black/70 max-w-2xl mx-auto font-medium">पुण्यातील कुटुंबांनी दिलेला विश्वास आणि प्रेम</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <?php foreach($testimonials as $testimonial): ?>
                <div class="glass-card p-8 rounded-3xl border border-kumkum/10 hover:border-kumkum/20 transition-all">
                    <p class="text-deep-black/80 text-sm leading-relaxed mb-6">"<?= $testimonial['text'] ?>"</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br <?= $testimonial['gradient'] ?> flex items-center justify-center text-white text-xs font-bold"><?= $testimonial['initial'] ?></div>
                        <div>
                            <div class="text-sm font-bold text-deep-black"><?= $testimonial['name'] ?></div>
                            <div class="text-xs text-deep-black/60"><?= $testimonial['location'] ?></div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </section>

    <section class="py-24 px-4 md:px-8 border-t border-deep-black/5">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 rounded-full bg-kumkum/20 text-kumkum text-xs font-bold uppercase tracking-wider mb-4">WhatsApp ऑर्डरिंग</span>
                <h2 class="text-4xl md:text-5xl font-black text-deep-black tracking-tight mb-4">ऑर्डर कसे द्यावे?</h2>
            </div>
            <div class="space-y-4">
                
                <?php foreach($faqs as $faq): ?>
                <div class="glass-card rounded-2xl border <?= ($faq['id'] % 2 == 0) ? 'border-turmeric/10' : 'border-kumkum/10' ?> overflow-hidden no-select">
                    <button class="w-full p-6 text-left flex items-center justify-between group <?= ($faq['id'] % 2 == 0) ? 'hover:bg-turmeric/5' : 'hover:bg-kumkum/5' ?> transition-colors" onclick="toggleFAQ(<?= $faq['id'] ?>)">
                        <span class="text-lg font-bold text-deep-black"><?= $faq['question'] ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transform transition-transform shrink-0" id="faq-icon-<?= $faq['id'] ?>"><polyline points="6 9 12 15 18 9" /></svg>
                    </button>
                    <div id="faq-<?= $faq['id'] ?>" class="hidden px-6 pb-6 text-deep-black/70 text-sm leading-relaxed">
                        <?= $faq['answer'] ?>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </section>

    <a href="https://wa.me/7796080794?text=नमस्कार,%20मला%20मकर%20संक्रांतीसाठी%20हलव्याचे%20दागिने%20ऑर्डर%20करायचे%20आहेत." target="_blank" class="fixed bottom-6 right-6 z-50 w-16 h-16 bg-[#25D366] rounded-full shadow-2xl flex items-center justify-center hover:scale-110 transition-transform animate-float no-select">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="white">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
        </svg>
        <span class="absolute -top-1 -right-1 w-4 h-4 bg-kumkum rounded-full animate-ping"></span>
    </a>

    <script>
        // --- FAQ Toggle Function ---
        function toggleFAQ(id) {
            const content = document.getElementById(`faq-${id}`);
            const icon = document.getElementById(`faq-icon-${id}`);
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                content.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }

        // --- Countdown Timer ---
        const countdownDate = new Date('January 14, 2026 06:00:00 GMT+0530').getTime();
        function updateCountdown() {
            const now = new Date().getTime();
            const distance = countdownDate - now;
            
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            const elDays = document.getElementById('days');
            if(elDays) {
                elDays.textContent = String(days).padStart(2, '0');
                document.getElementById('hours').textContent = String(hours).padStart(2, '0');
                document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
                document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
            }
        }
        updateCountdown();
        setInterval(updateCountdown, 1000);

        // --- Slider Logic ---
        document.addEventListener("DOMContentLoaded", () => {
            const slider = document.getElementById("productSlider");
            const dotsContainer = document.getElementById("sliderDots");

            if (!slider || !dotsContainer) return;

            const cards = slider.querySelectorAll(".snap-start");
            const totalCards = cards.length;
            if (totalCards === 0) return;

            // Approximate width of card + gap
            const cardWidth = cards[0].getBoundingClientRect().width + 24;

            // Create Dots
            dotsContainer.innerHTML = "";
            for (let i = 0; i < totalCards; i++) {
                const dot = document.createElement("button");
                dot.className = "w-2.5 h-2.5 rounded-full bg-gray-300 transition cursor-pointer hover:bg-kumkum";
                dot.addEventListener("click", () => {
                    slider.scrollTo({ left: i * cardWidth, behavior: "smooth" });
                });
                dotsContainer.appendChild(dot);
            }

            function updateDots() {
                const index = Math.round(slider.scrollLeft / cardWidth);
                [...dotsContainer.children].forEach((dot, i) => {
                    dot.classList.toggle("bg-kumkum", i === index);
                    dot.classList.toggle("bg-gray-300", i !== index);
                });
            }

            slider.addEventListener("scroll", updateDots);
            updateDots();

            // Expose arrow functions globally
            window.slideLeft = () => slider.scrollBy({ left: -cardWidth, behavior: "smooth" });
            window.slideRight = () => slider.scrollBy({ left: cardWidth, behavior: "smooth" });
        });
    </script>

</body>
</html>