<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BersihinAja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .header-section {
            position: relative;
            background-image: url('/bersihinAja/assets/6856377.png');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
        }

        .header-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .service-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            position: relative;
            z-index: 2;
        }
    </style>
</head>

<body>
    <div class="relative h-full w-full bg-cover bg-center p-20 "
        style="background-image: url('/bersihinAja/assets/testimoni.png');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative flex flex-col justify-center h-full ">
            <h1 class="text-white text-4xl font-bold text-center">
                Hasil Review dari Customer<br>Tercinta Kami
            </h1>
        </div>
    </div>

    <section id="testimonials" class="p-10 mt-0">
        <div class="container mx-auto py-5">
            <div class="flex flex-wrap -mx-2">
                <div class="w-full sm:w-1/2 lg:w-1/4 px-2 mb-4">
                    <div class="service-card h-full shadow-md border rounded-3 p-4">
                        <h5 class="font-semibold text-lg mb-1">Joni</h5>
                        <p class="text-sm text-gray-600">Home Cleaning</p>
                        <p class="mt-2 text-gray-700">Pelayanannya cepat dan bersih banget. Rumah jadi wangi dan rapi dalam waktu singkat. Recommended!</p>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/4 px-2 mb-4">
                    <div class="service-card h-full shadow-md border rounded-3 p-4">
                        <h5 class="font-semibold text-lg mb-1">Sarah</h5>
                        <p class="text-sm text-gray-600">home Cleaning</p>
                        <p class="mt-2 text-gray-700">Pelayanannya sangat ramah dan profesional. Rumah jadi bersih dan rapi. Terima kasih!</p>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/4 px-2 mb-4">
                    <div class="service-card h-full shadow-md border rounded-3 p-4">
                        <h5 class="font-semibold text-lg mb-1">Raka</h5>
                        <p class="text-sm text-gray-600">AC Service</p>
                        <p class="mt-2 text-gray-700">Teknisi datang tepat waktu dan AC langsung dingin seperti baru. Harganya juga terjangkau.</p>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/4 px-2 mb-4">
                    <div class="service-card h-full shadow-md border rounded-3 p-4">
                        <h5 class="font-semibold text-lg mb-1">Maya</h5>
                        <p class="text-sm text-gray-600">Cuci Sofa</p>
                        <p class="mt-2 text-gray-700">Sofa keluarga jadi wangi dan bersih. Anak-anak jadi betah duduk berlama-lama. Terima kasih!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>