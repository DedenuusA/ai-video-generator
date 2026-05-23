<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Video Result</title>

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

<body class="bg-black text-white min-h-screen overflow-x-hidden">

    <div class="absolute top-0 left-0 w-96 h-96 bg-purple-600 rounded-full blur-3xl opacity-20"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-pink-600 rounded-full blur-3xl opacity-20"></div>

    <div class="relative z-10 max-w-5xl mx-auto px-6 py-16">

        <div class="text-center mb-12">

            <div
                class="inline-flex items-center gap-2 bg-white/10 border border-white/10 px-4 py-2 rounded-full text-sm mb-6 backdrop-blur-xl">
                🚀 AI Video Generated Successfully
            </div>

            <h1 class="text-5xl font-extrabold mb-4">
                Your AI Video Is Ready
            </h1>

            <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                Download or preview your cinematic AI generated video.
            </p>

        </div>

        <div class="bg-white/5 border border-white/10 rounded-3xl p-6 backdrop-blur-2xl shadow-2xl">

            @if ($video)
                <video controls autoplay class="w-full rounded-2xl shadow-2xl">
                    <source src="{{ $video }}" type="video/mp4">
                </video>

                <div class="grid md:grid-cols-2 gap-4 mt-8">

                    <a href="{{ $video }}" download
                        class="bg-gradient-to-r from-purple-600 to-pink-600 text-center py-4 rounded-2xl font-bold text-lg hover:scale-[1.02] transition-all">
                        Download Video
                    </a>

                    <a href="{{ url('/') }}"
                        class="bg-white/10 border border-white/10 text-center py-4 rounded-2xl font-bold text-lg hover:bg-white/20 transition-all">
                        Generate Again
                    </a>

                </div>
            @else
                <div
                    class="bg-yellow-500/10 border border-yellow-500/20 text-yellow-300 p-6 rounded-2xl text-center text-lg">
                    Video is still processing by AI.
                </div>
            @endif

        </div>

    </div>

</body>

</html>
