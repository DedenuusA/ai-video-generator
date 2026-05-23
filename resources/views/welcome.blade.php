<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Studio - Photo & Text To Video</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-black text-white overflow-x-hidden">

    @php
        $video = $video ?? null;
    @endphp

    <!-- Background Glow -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-purple-600 rounded-full blur-3xl opacity-20"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-pink-600 rounded-full blur-3xl opacity-20"></div>

    <!-- Navbar -->
    <nav class="relative z-10 max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-extrabold tracking-tight">
                AI Studio
            </h1>
        </div>

        <div class="hidden md:flex items-center gap-8 text-gray-300">
            <a href="#features" class="hover:text-white transition">Features</a>
            <a href="#generator" class="hover:text-white transition">Generate</a>
        </div>

    </nav>

    <!-- Hero -->
    <section class="relative z-10 max-w-7xl mx-auto px-6 pt-12 pb-24">

        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <div>

                <div
                    class="inline-flex items-center gap-2 bg-white/10 border border-white/10 px-4 py-2 rounded-full text-sm mb-6 backdrop-blur-xl">
                    ✨ AI Powered Content Generator
                </div>

                <h1 class="text-5xl lg:text-7xl font-extrabold leading-tight">
                    Turn
                    <span class="bg-gradient-to-r from-purple-400 to-pink-500 bg-clip-text text-transparent">
                        Photos
                    </span>
                    &
                    <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">
                        Text
                    </span>
                    Into Amazing Videos
                </h1>

                <p class="text-gray-400 text-lg mt-8 leading-relaxed max-w-2xl">
                    Create cinematic AI videos from photos and prompts.
                    Generate realistic motion, anime scenes, storytelling clips,
                    product promos, and social media content instantly.
                </p>

                <div class="flex flex-wrap gap-4 mt-10">

                    <div class="bg-white/5 border border-white/10 rounded-2xl px-5 py-4 backdrop-blur-xl">
                        <div class="text-2xl font-bold">Photo ➜ Video</div>
                        <div class="text-sm text-gray-400 mt-1">
                            Upload image and animate it with AI
                        </div>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-2xl px-5 py-4 backdrop-blur-xl">
                        <div class="text-2xl font-bold">Text ➜ Image</div>
                        <div class="text-sm text-gray-400 mt-1">
                            Generate AI photos from prompts
                        </div>
                    </div>

                </div>

            </div>

            <!-- Generator Card -->
            <!-- Generator Card -->
            <div id="generator">

                <div class="bg-white/5 border border-white/10 backdrop-blur-2xl rounded-3xl p-8 shadow-2xl">

                    <h2 class="text-3xl font-bold mb-2">
                        AI Video Generator
                    </h2>

                    <p class="text-gray-400 mb-8">
                        Upload your image and describe the motion.
                    </p>

                    <form id="generateForm" action="{{ route('generate.video') }}" method="POST"
                        enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Upload -->
                        <div>
                            <label class="block mb-3 font-semibold text-lg">
                                Upload Photo
                            </label>

                            <input type="file" name="image" required
                                class="w-full bg-black/30 border border-white/10 rounded-2xl p-4 text-gray-300">
                        </div>

                        <!-- Prompt -->
                        <div>
                            <label class="block mb-3 font-semibold text-lg">
                                AI Prompt
                            </label>

                            <textarea name="prompt" rows="5" required placeholder="Example: cinematic camera movement..."
                                class="w-full bg-black/30 border border-white/10 rounded-2xl p-4 text-gray-300 resize-none"></textarea>
                        </div>

                        <!-- Button -->
                        <button id="submitBtn" type="submit"
                            class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:scale-[1.02] transition-all duration-300 py-4 rounded-2xl font-bold text-lg shadow-xl">
                            Generate AI Video
                        </button>

                        <!-- Loading -->
                        <div id="loading" class="hidden pt-4">

                            <div class="w-full bg-white/10 rounded-full h-3 overflow-hidden">
                                <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-3 animate-pulse w-full">
                                </div>
                            </div>

                            <p class="text-gray-400 mt-4 text-center">
                                AI is generating your cinematic video...
                            </p>

                            <p class="text-gray-500 text-sm text-center mt-2">
                                This may take 1-3 minutes
                            </p>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </section>

    <!-- Features -->
    <section id="features" class="relative z-10 max-w-7xl mx-auto px-6 pb-24">

        <div class="grid md:grid-cols-3 gap-8">

            <div class="bg-white/5 border border-white/10 rounded-3xl p-8 backdrop-blur-xl">
                <div class="text-5xl mb-6">🎬</div>
                <h3 class="text-2xl font-bold mb-3">
                    AI Video Motion
                </h3>
                <p class="text-gray-400 leading-relaxed">
                    Transform still photos into cinematic AI videos with realistic movement.
                </p>
            </div>

            <div class="bg-white/5 border border-white/10 rounded-3xl p-8 backdrop-blur-xl">
                <div class="text-5xl mb-6">🖼️</div>
                <h3 class="text-2xl font-bold mb-3">
                    Text To Image
                </h3>
                <p class="text-gray-400 leading-relaxed">
                    Create AI generated photos from creative prompts and imagination.
                </p>
            </div>

            <div class="bg-white/5 border border-white/10 rounded-3xl p-8 backdrop-blur-xl">
                <div class="text-5xl mb-6">⚡</div>
                <h3 class="text-2xl font-bold mb-3">
                    Fast Generation
                </h3>
                <p class="text-gray-400 leading-relaxed">
                    Generate content quickly using powerful cloud AI rendering.
                </p>
            </div>

        </div>

    </section>

    <script>
        const form = document.getElementById('generateForm');
        const loading = document.getElementById('loading');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', function() {

            loading.classList.remove('hidden');

            submitBtn.disabled = true;

            submitBtn.innerHTML = 'Generating...';

        });
    </script>

</body>

</html>
