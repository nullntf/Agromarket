<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroCompra - <?php _e('home.title', 'Plataforma Agrícola Municipal de Santa Ana'); ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.13.3/dist/cdn.min.js" defer></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700&family=Geist:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body { font-family: 'Sora', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Geist', sans-serif; }
    </style>
</head>

<body class="bg-white text-gray-900 antialiased">

<!-- NAVBAR -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-[#6b7a2a] text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center gap-2">
                <i class="fas fa-seedling text-white text-2xl"></i>
                <span class="text-lg sm:text-xl font-bold tracking-wide">AgroCompra</span>
            </div>

            <!-- Menu -->
            <div class="hidden md:flex items-center gap-10">
                <a href="#inicio" class="text-sm font-semibold hover:opacity-90 transition"><?php _e('home.nav.home', 'Inicio'); ?></a>
                <a href="#como-funciona" class="text-sm font-semibold hover:opacity-90 transition"><?php _e('home.nav.how_it_works', 'Como funciona'); ?></a>
                <a href="#beneficios" class="text-sm font-semibold hover:opacity-90 transition"><?php _e('home.nav.benefits', 'Beneficios'); ?></a>
                <a href="/tienda" class="text-sm font-semibold hover:opacity-90 transition"><?php _e('home.nav.store', 'Tienda'); ?></a>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-3">
                <!-- Language Switcher -->
                <div id="language-switcher" class="relative">
                    <button id="language-button"
                            class="flex items-center gap-2 hover:opacity-90 transition focus:outline-none"
                            aria-expanded="false">
                        <i class="fas fa-globe text-lg"></i>
                        <span class="text-sm font-semibold">
                            <?php echo strtoupper(isset($_SESSION['language']) && $_SESSION['language'] === 'en' ? 'EN' : 'ES'); ?>
                        </span>
                        <i id="language-chevron" class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
                    </button>

                    <div id="language-dropdown"
                         class="hidden absolute right-0 mt-2 w-36 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50 text-gray-800">
                        <a href="?lang=es"
                           class="language-option flex items-center px-4 py-2 text-sm hover:bg-gray-100">
                            <span class="w-5 h-4 mr-2 rounded-sm overflow-hidden">
                                <img src="https://flagcdn.com/w20/es.png" alt="Español" class="w-full h-full object-cover">
                            </span>
                            Español
                        </a>
                        <a href="?lang=en"
                           class="language-option flex items-center px-4 py-2 text-sm hover:bg-gray-100">
                            <span class="w-5 h-4 mr-2 rounded-sm overflow-hidden">
                                <img src="https://flagcdn.com/w20/gb.png" alt="English" class="w-full h-full object-cover">
                            </span>
                            English
                        </a>
                    </div>
                </div>

                <a href="/login" class="hidden sm:inline-flex items-center px-3 py-2 text-sm font-semibold hover:opacity-90 transition">
                    <?php _e('home.nav.login', 'Iniciar sesión'); ?>
                </a>

                <a href="/tienda"
                   class="inline-flex items-center px-5 py-2.5 bg-[#e6efd8] text-[#334015] font-bold rounded-full hover:brightness-95 transition">
                    <?php _e('home.nav.view_products', 'Ver productos'); ?>
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- HERO -->
<section id="inicio" class="relative pt-16">
  <div class="relative h-[420px] sm:h-[460px] md:h-[520px] lg:h-[560px]">
    <!-- Background image -->
    <div class="absolute inset-0 bg-cover bg-center"
      style="background-image: url('/uploads/image/fondo.jpeg');"></div>

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/35"></div>

    <!-- Texto del hero -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
      <div class="w-full lg:w-1/2 lg:ml-auto text-white">
        <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
          <?php _e('home.hero.title', 'Plataforma Agrícola'); ?>
          <span class="block"><?php _e('home.hero.subtitle', 'Municipal de Santa Ana'); ?></span>
        </h1>

        <p class="mt-5 text-base md:text-lg text-white/90 leading-relaxed max-w-xl">
          <?php _e('home.hero.description', 'Unimos productores locales con la comunidad. Una iniciativa de la Unidad de Agricultura y Ganadería para fortalecer el sector agrícola del municipio.'); ?>
        </p>
      </div>
    </div>
  </div>

  <!-- BLOQUE BAJO HERO -->
  <div class="relative bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
      <div class="grid lg:grid-cols-12 gap-8 items-center">

        <!-- Alcalde (más grande + un poco más arriba) -->
        <div class="lg:col-span-3">
          <div class="relative -mt-28 md:-mt-32 lg:-mt-36">
            <img src="/uploads/image/mayor.png" alt="Alcalde"
              class="w-full max-w-[380px] sm:max-w-[420px] lg:max-w-[460px] mx-auto lg:mx-0 drop-shadow-2xl">
          </div>
        </div>

        <!-- Gallery -->
        <div class="lg:col-span-6">
          <div class="grid grid-cols-3 gap-4">
            <div class="rounded-xl overflow-hidden shadow-sm">
              <img src="/uploads/image/galeria-1.jpg" alt="Galería 1"
                class="w-full h-28 md:h-32 object-cover">
            </div>
            <div class="rounded-xl overflow-hidden shadow-sm">
              <img src="/uploads/image/galeria-2.jpg" alt="Galería 2"
                class="w-full h-28 md:h-32 object-cover">
            </div>
            <div class="rounded-xl overflow-hidden shadow-sm">
              <img src="/uploads/image/galeria-3.jpg" alt="Galería 3"
                class="w-full h-28 md:h-32 object-cover">
            </div>
          </div>
        </div>

        <!-- Buttons -->
        <div class="lg:col-span-3 flex flex-col gap-4 lg:items-end">
          <a href="/tienda"
            class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-full bg-[#6b7a2a] text-white font-bold hover:brightness-95 transition w-full lg:w-auto">
            <i class="fas fa-store"></i>
            <?php _e('home.hero.cta.explore', 'Explorar tienda'); ?>
          </a>

          <a href="#como-funciona"
            class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-full border-2 border-[#6b7a2a] text-[#6b7a2a] font-bold hover:bg-[#6b7a2a]/10 transition w-full lg:w-auto">
            <i class="fas fa-circle-info"></i>
            <?php _e('home.hero.cta.how_it_works', 'Como funciona'); ?>
          </a>
        </div>
      </div>

      <!-- Branding (más pegado al alcalde + alineado bajo él) -->
      <div class="mt-4 md:mt-6 flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="w-full md:w-auto md:pl-10 lg:pl-16">
          <img src="/uploads/image/alcalde-brand.png" alt="Brand Alcalde"
            class="h-16 md:h-20 object-contain">
        </div>

        <img src="/uploads/image/alcaldia-logo.jpeg" alt="Logo Alcaldía"
          class="h-14 md:h-16 object-contain rounded-md">
      </div>
    </div>
  </div>
</section>



<!-- COMO FUNCIONA -->
<section id="como-funciona" class="relative">
    <div class="relative py-5 md:py-8">
        <!-- Background (podés cambiar esta imagen por la del diseño si luego la tenés) -->
        <div class="absolute inset-0 bg-cover bg-center"
             style="background-image:url('/uploads/image/como-funciona.jpeg');"></div>
        <div class="absolute inset-0 bg-black/35"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-10 md:mb-14">
                <h2 class="text-3xl md:text-4xl font-extrabold text-white">
                    <?php _e('home.how_it_works.title', 'Como funciona'); ?>
                </h2>
            </div>

            <!-- Top 3 images + icon placeholders -->
            <div class="grid md:grid-cols-3 gap-6">
                <div class="rounded-2xl overflow-hidden bg-white/10 backdrop-blur border border-white/15">
                    <img src="/uploads/image/como-1.jpg" alt="Paso visual 1" class="w-full h-48 object-cover">
                    <div class="p-4 text-white flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white/15 flex items-center justify-center">
                            <!-- Placeholder icon -->
                            <i class="fas fa-magnifying-glass"></i>
                        </div>
                        <span class="font-semibold"><?php _e('home.how_it_works.steps.explore.title', 'Explora Productos'); ?></span>
                    </div>
                </div>

                <div class="rounded-2xl overflow-hidden bg-white/10 backdrop-blur border border-white/15">
                    <img src="/uploads/image/como-2.jpg" alt="Paso visual 2" class="w-full h-48 object-cover">
                    <div class="p-4 text-white flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white/15 flex items-center justify-center">
                            <!-- Placeholder icon -->
                            <i class="fas fa-comments"></i>
                        </div>
                        <span class="font-semibold"><?php _e('home.how_it_works.steps.contact.title', 'Contacta al Productor'); ?></span>
                    </div>
                </div>

                <div class="rounded-2xl overflow-hidden bg-white/10 backdrop-blur border border-white/15">
                    <img src="/uploads/image/como-3.jpg" alt="Paso visual 3" class="w-full h-48 object-cover">
                    <div class="p-4 text-white flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white/15 flex items-center justify-center">
                            <!-- Placeholder icon -->
                            <i class="fas fa-truck"></i>
                        </div>
                        <span class="font-semibold"><?php _e('home.how_it_works.steps.receive.title', 'Recibe tus Productos'); ?></span>
                    </div>
                </div>
            </div>

            <!-- Steps (1 y 3 con tarjeta oscura, 2 libre) -->
            <div class="mt-14 grid md:grid-cols-3 gap-8 items-start">
                <div class="rounded-3xl bg-[#2f3a12] text-white p-8 shadow-lg">
                    <h3 class="text-xl font-extrabold mb-3"><?php _e('home.how_it_works.steps.explore.title', 'Explora Productos'); ?></h3>
                    <p class="text-white/90 leading-relaxed">
                        <?php _e('home.how_it_works.steps.explore.description', 'Navega por la selección de productos agrícolas frescos de los productores de Santa Ana'); ?>
                    </p>
                </div>

                <div  class="rounded-3xl bg-[#2f3a12] text-white p-8 shadow-lg">
                    <h3 class="text-xl font-extrabold mb-3"><?php _e('home.how_it_works.steps.contact.title', 'Contacta al Productor'); ?></h3>
                    <p class="text-white/90 leading-relaxed">
                        <?php _e('home.how_it_works.steps.contact.description', 'Comunícate directamente con los productores locales para consultar disponibilidad y precios'); ?>
                    </p>
                </div>

                <div class="rounded-3xl bg-[#2f3a12] text-white p-8 shadow-lg">
                    <h3 class="text-xl font-extrabold mb-3"><?php _e('home.how_it_works.steps.receive.title', 'Recibe tus Productos'); ?></h3>
                    <p class="text-white/90 leading-relaxed">
                        <?php _e('home.how_it_works.steps.receive.description', 'Coordina la entrega o recogida de tus productos frescos directamente del productor'); ?>
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- BENEFICIOS -->
<section id="beneficios" class="relative">
    <div class="relative py-10 md:py-14">
        <div class="absolute inset-0 bg-cover bg-center"
             style="background-image:url('/uploads/image/beneficios-bg.jpg');"></div>
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-10">
                <?php _e('home.benefits.title', 'Beneficios para todos'); ?>
            </h2>

            <div class="grid lg:grid-cols-12 gap-10 items-start">
                <!-- Left list -->
                <div class="lg:col-span-6 space-y-6">
                    <div class="flex gap-4 text-white">
                        <div class="w-11 h-11 rounded-full bg-white/15 flex items-center justify-center shrink-0">
                            <!-- Placeholder icon -->
                            <i class="fas fa-leaf"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-extrabold"><?php _e('home.benefits.items.fresh_products.title', 'Productos Frescos'); ?></h4>
                            <p class="text-white/90"><?php _e('home.benefits.items.fresh_products.description', 'Directamente del campo a tu mesa, sin intermediarios'); ?></p>
                        </div>
                    </div>

                    <div class="flex gap-4 text-white">
                        <div class="w-11 h-11 rounded-full bg-white/15 flex items-center justify-center shrink-0">
                            <!-- Placeholder icon -->
                            <i class="fas fa-hand-holding-dollar"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-extrabold"><?php _e('home.benefits.items.fair_prices.title', 'Precios Justos'); ?></h4>
                            <p class="text-white/90"><?php _e('home.benefits.items.fair_prices.description', 'Mejores precios para la comunidad y productores locales'); ?></p>
                        </div>
                    </div>

                    <div class="flex gap-4 text-white">
                        <div class="w-11 h-11 rounded-full bg-white/15 flex items-center justify-center shrink-0">
                            <!-- Placeholder icon -->
                            <i class="fas fa-building-columns"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-extrabold"><?php _e('home.benefits.items.municipal_support.title', 'Apoyo Municipal'); ?></h4>
                            <p class="text-white/90"><?php _e('home.benefits.items.municipal_support.description', 'Iniciativa de la Alcaldía de Santa Ana para fortalecer el sector agrícola'); ?></p>
                        </div>
                    </div>

                    <div class="flex gap-4 text-white">
                        <div class="w-11 h-11 rounded-full bg-white/15 flex items-center justify-center shrink-0">
                            <!-- Placeholder icon -->
                            <i class="fas fa-eye"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-extrabold"><?php _e('home.benefits.items.transparency.title', 'Transparencia Total'); ?></h4>
                            <p class="text-white/90"><?php _e('home.benefits.items.transparency.description', 'Conoce el origen de cada producto de nuestros agricultores'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Right panel -->
                <div class="lg:col-span-6">
                    <div class="rounded-3xl bg-[#dfe8cf] p-8 md:p-10 shadow-xl">
                        <h3 class="text-2xl md:text-3xl font-extrabold text-[#22310e] mb-4 text-center">
                            <?php _e('home.benefits.producer_cta.title', '¿Eres Productor de Santa Ana?'); ?>
                        </h3>

                        <p class="text-[#334015] mb-8 leading-relaxed text-center">
                            <?php _e('home.benefits.producer_cta.description', 'Únete a esta iniciativa municipal y forma parte de la red de productores agrícolas de Santa Ana. Gestiona tu negocio de forma fácil y profesional con el respaldo de la Alcaldía.'); ?>
                        </p>

                        <ul class="space-y-4 mb-8">
                            <li class="flex items-start gap-3 text-[#22310e]">
                                <div class="w-9 h-9 rounded-full bg-[#6b7a2a] text-white flex items-center justify-center shrink-0">
                                    <!-- Placeholder icon -->
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <span><?php _e('home.benefits.producer_cta.benefits.business_profile', 'Crea tu perfil de negocio'); ?></span>
                            </li>
                            <li class="flex items-start gap-3 text-[#22310e]">
                                <div class="w-9 h-9 rounded-full bg-[#6b7a2a] text-white flex items-center justify-center shrink-0">
                                    <!-- Placeholder icon -->
                                    <i class="fas fa-tags"></i>
                                </div>
                                <span><?php _e('home.benefits.producer_cta.benefits.publish_products', 'Publica tus productos'); ?></span>
                            </li>
                            <li class="flex items-start gap-3 text-[#22310e]">
                                <div class="w-9 h-9 rounded-full bg-[#6b7a2a] text-white flex items-center justify-center shrink-0">
                                    <!-- Placeholder icon -->
                                    <i class="fas fa-boxes-stacked"></i>
                                </div>
                                <span><?php _e('home.benefits.producer_cta.benefits.manage_inventory', 'Gestiona tu inventario'); ?></span>
                            </li>
                            <li class="flex items-start gap-3 text-[#22310e]">
                                <div class="w-9 h-9 rounded-full bg-[#6b7a2a] text-white flex items-center justify-center shrink-0">
                                    <!-- Placeholder icon -->
                                    <i class="fas fa-people-group"></i>
                                </div>
                                <span><?php _e('home.benefits.producer_cta.benefits.connect_community', 'Conecta con la comunidad local'); ?></span>
                            </li>
                        </ul>

                        <div class="text-center">
                            <a href="/registro/informacion"
                               class="inline-flex items-center justify-center gap-2 px-7 py-3 rounded-full bg-[#6b7a2a] text-white font-extrabold hover:brightness-95 transition">
                                <!-- Placeholder icon -->
                                <i class="fas fa-user-plus"></i>
                                <?php _e('home.benefits.producer_cta.register_button', 'Registrarse Ahora'); ?>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- FOOTER (compacto) -->
<footer class="bg-[#1a1f12] text-gray-300 pt-10 pb-6">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-6">

    <!-- Top grid -->
    <div class="grid md:grid-cols-12 gap-6 mb-8">
      <div class="md:col-span-4">
        <div class="flex items-center space-x-2 mb-3">
          <i class="fas fa-seedling text-[#9fb34d] text-2xl"></i>
          <span class="text-2xl font-bold text-white">AgroCompra</span>
        </div>

        <p class="text-sm text-gray-400 leading-relaxed mb-4">
          <?php _e('home.footer.description', 'Plataforma municipal para unir productores agrícolas con la comunidad de Santa Ana.'); ?>
        </p>

        <div class="bg-white/5 border border-white/10 rounded-lg p-3">
          <p class="text-xs text-gray-300 mb-1">
            <?php _e('home.footer.initiative_label', 'Una iniciativa de:'); ?>
          </p>
          <p class="text-sm text-white font-semibold">
            <?php _e('home.footer.municipality', 'Alcaldía Municipal de Santa Ana'); ?>
          </p>
          <p class="text-xs text-gray-400">
            <?php _e('home.footer.agriculture_unit', 'Unidad de Agricultura y Ganadería'); ?>
          </p>
        </div>
      </div>

      <div class="md:col-span-4">
        <h4 class="text-white font-semibold mb-3 flex items-center">
          <i class="fas fa-building text-[#9fb34d] mr-2"></i>
          <?php _e('home.footer.municipality', 'Alcaldía de Santa Ana'); ?>
        </h4>

        <ul class="space-y-2 text-sm">
          <li class="flex items-start space-x-2">
            <i class="fas fa-map-marker-alt text-[#9fb34d] mt-1 flex-shrink-0"></i>
            <span>Av. Independencia Sur entre Calle Libertad y 2da Calle Poniente, Santa Ana</span>
          </li>

          <li class="flex items-center space-x-2">
            <i class="fas fa-phone text-[#9fb34d] flex-shrink-0"></i>
            <span>2402-7500</span>
          </li>

          <li class="flex items-start space-x-2">
            <i class="fas fa-clock text-[#9fb34d] mt-1 flex-shrink-0"></i>
            <div>
              <div><?php _e('home.footer.hours.weekdays', 'Lunes a Viernes: 8:00 AM - 4:00 PM'); ?></div>
              <div class="text-gray-500"><?php _e('home.footer.hours.weekend', 'Cerrado fines de semana'); ?></div>
            </div>
          </li>

          <li class="flex items-center space-x-2">
            <i class="fas fa-globe text-[#9fb34d] flex-shrink-0"></i>
            <a href="https://santaana.gob.sv/amsa/" target="_blank" class="hover:text-white transition-colors">
              santaana.gob.sv
            </a>
          </li>
        </ul>
      </div>

      <div class="md:col-span-4">
        <h4 class="text-white font-semibold mb-3 flex items-center">
          <i class="fas fa-tractor text-[#9fb34d] mr-2"></i>
          <?php _e('home.footer.agriculture', 'Agricultura y Ganadería'); ?>
        </h4>

        <ul class="space-y-2 text-sm mb-4">
          <li class="flex items-center space-x-2">
            <i class="fas fa-phone text-[#9fb34d] flex-shrink-0"></i>
            <span>2432-0337</span>
          </li>
          <li class="flex items-center space-x-2">
            <i class="fab fa-whatsapp text-[#9fb34d] flex-shrink-0"></i>
            <span>7092-9496</span>
          </li>
        </ul>

        <div class="space-y-2 text-sm text-gray-400">
          <p class="flex items-start space-x-2">
            <i class="fas fa-check-circle text-[#9fb34d] mt-0.5 flex-shrink-0"></i>
            <span><?php _e('home.footer.services.technical_support', 'Asistencia técnica agrícola'); ?></span>
          </p>
          <p class="flex items-start space-x-2">
            <i class="fas fa-check-circle text-[#9fb34d] mt-0.5 flex-shrink-0"></i>
            <span><?php _e('home.footer.services.animal_health', 'Programas de salud animal'); ?></span>
          </p>
          <p class="flex items-start space-x-2">
            <i class="fas fa-check-circle text-[#9fb34d] mt-0.5 flex-shrink-0"></i>
            <span><?php _e('home.footer.services.supplies', 'Entrega de insumos'); ?></span>
          </p>
        </div>
      </div>
    </div>

    <!-- Mid bar -->
    <div class="border-t border-white/10 pt-5">
      <div class="flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0">
        <div class="flex flex-wrap justify-center gap-5 text-sm">
          <a href="/tienda" class="hover:text-white transition-colors"><?php _e('home.footer.links.store', 'Tienda'); ?></a>
          <a href="#como-funciona" class="hover:text-white transition-colors"><?php _e('home.footer.links.how_it_works', 'Cómo Funciona'); ?></a>
          <a href="#beneficios" class="hover:text-white transition-colors"><?php _e('home.footer.links.benefits', 'Beneficios'); ?></a>
          <a href="/login" class="hover:text-white transition-colors"><?php _e('home.footer.links.login', 'Iniciar Sesión'); ?></a>
        </div>

        <div class="flex items-center space-x-3">
          <span class="text-sm text-gray-400"><?php _e('home.footer.follow_us', 'Síguenos:'); ?></span>

          <a href="https://www.facebook.com/SantaAnaAlcaldia" target="_blank"
             class="w-9 h-9 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-colors">
            <i class="fab fa-facebook-f"></i>
          </a>

          <a href="https://www.instagram.com/alcaldia_sa/" target="_blank"
             class="w-9 h-9 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-colors">
            <i class="fab fa-instagram"></i>
          </a>

          <a href="https://x.com/alcaldia_SA" target="_blank"
             class="w-9 h-9 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-colors">
            <i class="fab fa-x-twitter"></i>
          </a>

          <a href="https://www.tiktok.com/@alcaldiasa" target="_blank"
             class="w-9 h-9 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-colors">
            <i class="fab fa-tiktok"></i>
          </a>
        </div>
      </div>
    </div>

    <!-- Bottom -->
    <div class="border-t border-white/10 mt-5 pt-4 text-center">
      <p class="text-sm text-gray-400">
        <?php _e('home.footer.copyright', 'Alcaldía Municipal de Santa Ana. Todos los derechos reservados.'); ?>
      </p>
    </div>

  </div>
</footer>


<!-- Scripts (tu language switcher intacto) -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const languageButton = document.getElementById('language-button');
        const languageDropdown = document.getElementById('language-dropdown');
        const languageChevron = document.getElementById('language-chevron');
        const languageOptions = document.querySelectorAll('.language-option');

        if (languageButton && languageDropdown) {
            languageButton.addEventListener('click', function(e) {
                e.stopPropagation();
                const isOpen = languageDropdown.classList.toggle('hidden');
                languageChevron.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
                languageButton.setAttribute('aria-expanded', !isOpen);
            });

            languageOptions.forEach(option => {
                option.addEventListener('click', function() {
                    languageDropdown.classList.add('hidden');
                    languageChevron.style.transform = 'rotate(0deg)';
                    languageButton.setAttribute('aria-expanded', 'false');
                });
            });

            document.addEventListener('click', function(e) {
                if (!languageButton.contains(e.target) && !languageDropdown.contains(e.target)) {
                    languageDropdown.classList.add('hidden');
                    languageChevron.style.transform = 'rotate(0deg)';
                    languageButton.setAttribute('aria-expanded', 'false');
                }
            });

            languageDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }
    });
</script>

</body>
</html>
