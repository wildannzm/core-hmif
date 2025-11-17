<div class="min-h-screen bg-gray-900">
    <!-- Header Section -->
    <div class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">
                Komunitas <span class="text-secondary">Program Studi</span>
            </h1>
            <p class="text-gray-400 text-lg md:text-xl max-w-3xl mx-auto">
                Bergabunglah dengan komunitas yang sesuai minat dan bakatmu. Kembangkan skill, networking, dan raih
                prestasi bersama!
            </p>
        </div>
    </div>

    <!-- KPM Section -->
    <div class="py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Community Header -->
            <div class="flex flex-col lg:flex-row items-center gap-8 mb-12">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <div class="w-32 h-32 bg-white rounded-2xl flex items-center justify-center shadow-2xl p-4">
                        <img src="{{ asset('images/community/kpm.png') }}" alt="Logo KPM"
                            class="w-full h-full object-contain">
                    </div>
                </div>

                <!-- Info -->
                <div class="flex-1 text-center lg:text-left">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                        <span class="text-primary">KPM</span> - Komunitas Pemrograman Mahasiswa
                    </h2>
                    <p class="text-gray-400 text-lg mb-4">
                        Wadah bagi mahasiswa yang ingin mendalami dunia pemrograman dan pengembangan software. Dari web
                        hingga AI, kita belajar dan berkembang bersama.
                    </p>
                    <div class="flex flex-wrap gap-2 justify-center lg:justify-start">
                        <span
                            class="px-4 py-2 bg-primary/20 text-primary rounded-full text-sm font-semibold border border-primary/30">
                            <i class="fas fa-laptop-code mr-2"></i>Web Development
                        </span>
                        <span
                            class="px-4 py-2 bg-primary/20 text-primary rounded-full text-sm font-semibold border border-primary/30">
                            <i class="fas fa-brain mr-2"></i>AI & ML
                        </span>
                        <span
                            class="px-4 py-2 bg-primary/20 text-primary rounded-full text-sm font-semibold border border-primary/30">
                            <i class="fas fa-mobile-alt mr-2"></i>Mobile Development
                        </span>
                    </div>
                </div>
            </div>

            <!-- Bidang Fokus Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Web Application -->
                <div
                    class="group bg-gray-800 rounded-xl p-6 hover:bg-gray-700 transition-all duration-300 transform hover:-translate-y-2 border border-gray-700 hover:border-primary">
                    <div class="w-16 h-16 bg-primary/20 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-globe text-3xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Web Application</h3>
                    <p class="text-gray-400 mb-4">
                        Pelajari teknologi web modern seperti Laravel, React, Vue.js, dan Node.js. Bangun aplikasi web
                        yang powerful dan scalable.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            Frontend & Backend Development
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            RESTful API & Database Design
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            Deployment & Cloud Services
                        </li>
                    </ul>
                </div>

                <!-- AI & ML -->
                <div
                    class="group bg-gray-800 rounded-xl p-6 hover:bg-gray-700 transition-all duration-300 transform hover:-translate-y-2 border border-gray-700 hover:border-primary">
                    <div class="w-16 h-16 bg-primary/20 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-robot text-3xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">AI dan Machine Learning</h3>
                    <p class="text-gray-400 mb-4">
                        Eksplorasi dunia kecerdasan buatan dan machine learning. Dari computer vision hingga natural
                        language processing.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            Python & Data Science Libraries
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            Deep Learning & Neural Networks
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            Computer Vision & NLP
                        </li>
                    </ul>
                </div>

                <!-- Mobile Application -->
                <div
                    class="group bg-gray-800 rounded-xl p-6 hover:bg-gray-700 transition-all duration-300 transform hover:-translate-y-2 border border-gray-700 hover:border-primary">
                    <div class="w-16 h-16 bg-primary/20 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-mobile-screen-button text-3xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Mobile Application</h3>
                    <p class="text-gray-400 mb-4">
                        Ciptakan aplikasi mobile yang inovatif untuk Android dan iOS. Pelajari Flutter, React Native,
                        dan Kotlin.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            Cross-Platform Development
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            UI/UX Mobile Design
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            App Publishing & Monetization
                        </li>
                    </ul>
                </div>
            </div>

            <!-- CTA -->
            <div
                class="bg-gradient-to-r from-primary to-blue-600 rounded-2xl p-8 text-center transform hover:scale-105 transition-all duration-300">
                <h3 class="text-2xl font-bold text-white mb-3">
                    <i class="fas fa-rocket mr-2"></i>Siap Menjadi Software Developer?
                </h3>
                <p class="text-white/90 mb-6 max-w-2xl mx-auto">
                    Bergabunglah dengan KPM dan asah kemampuan coding-mu bersama teman-teman yang passionate. Project
                    kolaboratif, workshop, dan kompetisi menanti!
                </p>
            </div>
        </div>
    </div>

    <!-- Infordia Section -->
    <div class="bg-gray-800 py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Community Header -->
            <div class="flex flex-col lg:flex-row items-center gap-8 mb-12">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <div class="w-32 h-32 bg-white rounded-2xl flex items-center justify-center shadow-2xl p-4">
                        <img src="{{ asset('images/community/infordia.png') }}" alt="Logo Infordia"
                            class="w-full h-full object-contain">
                    </div>
                </div>

                <!-- Info -->
                <div class="flex-1 text-center lg:text-left">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                        <span class="text-secondary">Infordia</span> - Informatika Multimedia
                    </h2>
                    <p class="text-gray-400 text-lg mb-4">
                        Komunitas kreatif untuk mahasiswa yang passionate di bidang multimedia, desain grafis, animasi,
                        dan konten digital. Wujudkan imajinasimu!
                    </p>
                    <div class="flex flex-wrap gap-2 justify-center lg:justify-start">
                        <span
                            class="px-4 py-2 bg-secondary/20 text-secondary rounded-full text-sm font-semibold border border-secondary/30">
                            <i class="fas fa-film mr-2"></i>Animation
                        </span>
                        <span
                            class="px-4 py-2 bg-secondary/20 text-secondary rounded-full text-sm font-semibold border border-secondary/30">
                            <i class="fas fa-camera mr-2"></i>Photography
                        </span>
                        <span
                            class="px-4 py-2 bg-secondary/20 text-secondary rounded-full text-sm font-semibold border border-secondary/30">
                            <i class="fas fa-pen-nib mr-2"></i>Graphic Design
                        </span>
                        <span
                            class="px-4 py-2 bg-secondary/20 text-secondary rounded-full text-sm font-semibold border border-secondary/30">
                            <i class="fas fa-video mr-2"></i>Video Editing
                        </span>
                    </div>
                </div>
            </div>

            <!-- Bidang Fokus Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Animasi 2D & 3D -->
                <div
                    class="group bg-gray-900 rounded-xl p-6 hover:bg-gray-700 transition-all duration-300 transform hover:-translate-y-2 border border-gray-700 hover:border-secondary">
                    <div class="w-16 h-16 bg-secondary/20 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-cube text-3xl text-secondary"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Animasi 2D & 3D</h3>
                    <p class="text-gray-400 mb-4">
                        Ciptakan animasi yang menakjubkan dengan tools professional seperti Blender, After Effects, dan
                        Cinema 4D.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-secondary mr-2"></i>
                            Character Animation
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-secondary mr-2"></i>
                            Motion Graphics
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-secondary mr-2"></i>
                            3D Modeling & Rendering
                        </li>
                    </ul>
                </div>

                <!-- Photography & Videography -->
                <div
                    class="group bg-gray-900 rounded-xl p-6 hover:bg-gray-700 transition-all duration-300 transform hover:-translate-y-2 border border-gray-700 hover:border-secondary">
                    <div class="w-16 h-16 bg-secondary/20 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-camera-retro text-3xl text-secondary"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Photography & Videography</h3>
                    <p class="text-gray-400 mb-4">
                        Tangkap momen terbaik dan ceritakan kisah melalui lensa. Dari fotografi hingga sinematografi
                        profesional.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-secondary mr-2"></i>
                            Product & Portrait Photography
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-secondary mr-2"></i>
                            Cinematography Techniques
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-secondary mr-2"></i>
                            Lighting & Color Grading
                        </li>
                    </ul>
                </div>

                <!-- Graphic Design -->
                <div
                    class="group bg-gray-900 rounded-xl p-6 hover:bg-gray-700 transition-all duration-300 transform hover:-translate-y-2 border border-gray-700 hover:border-secondary">
                    <div class="w-16 h-16 bg-secondary/20 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-pencil-ruler text-3xl text-secondary"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Graphic Design</h3>
                    <p class="text-gray-400 mb-4">
                        Kuasai seni visual communication dengan Adobe Suite. Desain logo, poster, branding, dan konten
                        visual lainnya.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-secondary mr-2"></i>
                            Logo & Brand Identity
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-secondary mr-2"></i>
                            Poster & Flyer Design
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-secondary mr-2"></i>
                            Social Media Content
                        </li>
                    </ul>
                </div>

                <!-- Editing Photo & Video -->
                <div
                    class="group bg-gray-900 rounded-xl p-6 hover:bg-gray-700 transition-all duration-300 transform hover:-translate-y-2 border border-gray-700 hover:border-secondary">
                    <div class="w-16 h-16 bg-secondary/20 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-sliders text-3xl text-secondary"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Editing Photo & Video</h3>
                    <p class="text-gray-400 mb-4">
                        Transform raw footage menjadi karya seni yang memukau. Master Premiere Pro, Photoshop, dan
                        DaVinci Resolve.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-secondary mr-2"></i>
                            Photo Retouching & Manipulation
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-secondary mr-2"></i>
                            Video Editing & Transitions
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-secondary mr-2"></i>
                            VFX & Compositing
                        </li>
                    </ul>
                </div>
            </div>

            <!-- CTA -->
            <div
                class="bg-gradient-to-r from-red-600 to-blue-600 rounded-2xl p-8 text-center transform hover:scale-105 transition-all duration-300">
                <h3 class="text-2xl font-bold text-white mb-3">
                    <i class="fas fa-lightbulb mr-2"></i>Wujudkan Kreativitasmu!
                </h3>
                <p class="text-white/90 mb-6 max-w-2xl mx-auto">
                    Join Infordia dan kembangkan skill multimedia-mu! Kolaborasi project, workshop eksklusif, dan
                    kesempatan showcase karya di berbagai event.
                </p>
            </div>
        </div>
    </div>

    <!-- Windstand Robotics Section -->
    <div class="py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Community Header -->
            <div class="flex flex-col lg:flex-row items-center gap-8 mb-12">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <div class="w-32 h-32 bg-white rounded-2xl flex items-center justify-center shadow-2xl p-4">
                        <img src="{{ asset('images/community/windstand.png') }}" alt="Logo Windstand"
                            class="w-full h-full object-contain">
                    </div>
                </div>

                <!-- Info -->
                <div class="flex-1 text-center lg:text-left">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                        <span class="text-green-400">Windstand Robotics</span>
                    </h2>
                    <p class="text-gray-400 text-lg mb-4">
                        Komunitas inovasi teknologi untuk mahasiswa yang ingin mengeksplorasi dunia robotika, IoT, dan
                        embedded systems. Build the future!
                    </p>
                    <div class="flex flex-wrap gap-2 justify-center lg:justify-start">
                        <span
                            class="px-4 py-2 bg-green-500/20 text-green-400 rounded-full text-sm font-semibold border border-green-500/30">
                            <i class="fas fa-robot mr-2"></i>Robotics
                        </span>
                        <span
                            class="px-4 py-2 bg-green-500/20 text-green-400 rounded-full text-sm font-semibold border border-green-500/30">
                            <i class="fas fa-wifi mr-2"></i>Internet of Things
                        </span>
                    </div>
                </div>
            </div>

            <!-- Bidang Fokus Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Robotics -->
                <div
                    class="group bg-gray-800 rounded-xl p-8 hover:bg-gray-700 transition-all duration-300 transform hover:-translate-y-2 border border-gray-700 hover:border-green-500">
                    <div class="w-20 h-20 bg-green-500/20 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-cogs text-4xl text-green-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Robotics</h3>
                    <p class="text-gray-400 mb-6">
                        Rancang dan bangun robot autonomous yang cerdas. Dari line follower hingga humanoid robot,
                        eksplorasi teknologi robotika terkini.
                    </p>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-400 mr-3 mt-1"></i>
                            <span>Robot Design</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-400 mr-3 mt-1"></i>
                            <span>Sensor Integration & Control Systems</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-400 mr-3 mt-1"></i>
                            <span>Autonomous Navigation & AI Integration</span>
                        </li>
                    </ul>
                </div>

                <!-- Internet of Things -->
                <div
                    class="group bg-gray-800 rounded-xl p-8 hover:bg-gray-700 transition-all duration-300 transform hover:-translate-y-2 border border-gray-700 hover:border-green-500">
                    <div class="w-20 h-20 bg-green-500/20 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-network-wired text-4xl text-green-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Internet of Things</h3>
                    <p class="text-gray-400 mb-6">
                        Ciptakan solusi IoT yang mengubah kehidupan. Smart home, smart city, hingga industri 4.0 -
                        hubungkan dunia fisik dengan digital.
                    </p>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-400 mr-3 mt-1"></i>
                            <span>Cloud Integration & Data Analytics</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-400 mr-3 mt-1"></i>
                            <span>Wireless Communication Protocols</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-400 mr-3 mt-1"></i>
                            <span>Smart Systems & Automation</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- CTA -->
            <div
                class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-2xl p-8 text-center transform hover:scale-105 transition-all duration-300">
                <h3 class="text-2xl font-bold text-white mb-3">
                    <i class="fas fa-trophy mr-2"></i>Siap Menjadi Innovator Teknologi?
                </h3>
                <p class="text-white/90 mb-6 max-w-2xl mx-auto">
                    Bergabung dengan Windstand Robotics dan jadilah bagian dari revolusi teknologi! Workshop intensif dan real project menanti.
                </p>
            </div>
        </div>
    </div>

    <!-- Bottom CTA Section -->
    <div class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-16 md:py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Masih Bingung Pilih Komunitas?
            </h2>
            <p class="text-gray-400 text-lg mb-8">
                Jangan khawatir! Kamu bisa join lebih dari satu komunitas sesuai minat dan bakatmu. Atau hubungi kami
                untuk konsultasi.
            </p>
        </div>
    </div>
</div>
