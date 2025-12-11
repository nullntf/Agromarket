<?php

return [
    // Common
    'welcome' => 'Bienvenido',
    'dashboard' => 'Panel de Control',
    'profile' => 'Perfil',
    'settings' => 'Configuración',
    'logout' => 'Cerrar Sesión',
    'save' => 'Guardar',
    'cancel' => 'Cancelar',
    'edit' => 'Editar',
    'delete' => 'Eliminar',
    'actions' => 'Acciones',
    'search' => 'Buscar...',
    'no_records' => 'No hay registros disponibles',
    'confirm_delete' => '¿Está seguro que desea eliminar este registro?',
    'success' => 'Éxito',
    'error' => 'Error',
    'info' => 'Información',
    'warning' => 'Advertencia',
    
    // Home Page
    'store' => [
        'title' => 'Tienda - AgroCompra',
        'catalog' => 'Catálogo de Productos',
        'discover' => 'Descubre productos agrícolas frescos de toda El Salvador',
        'filters' => [
            'title' => 'Filtros de Búsqueda',
            'clear' => 'Limpiar Filtros',
            'search' => 'Búsqueda General',
            'category' => 'Categoría',
            'department' => 'Departamento',
            'municipality' => 'Municipio',
            'min_price' => 'Precio Mínimo ($)',
            'max_price' => 'Precio Máximo ($)',
            'search_button' => 'Buscar',
            'reset_button' => 'Reiniciar',
            'loading' => 'Cargando...'
        ],
        'results' => [
            'title' => 'Productos Disponibles',
            'no_results' => 'No se encontraron productos que coincidan con tu búsqueda.',
            'view' => 'Ver Producto',
            'by' => 'por',
            'contact' => 'Contactar al Vendedor',
            'view_business' => 'Ver Negocio',
            'price' => 'Precio:',
            'stock' => 'Disponibilidad:',
            'in_stock' => 'En stock',
            'out_of_stock' => 'Agotado',
            'location' => 'Ubicación:'
        ],
        'pagination' => [
            'previous' => 'Anterior',
            'next' => 'Siguiente',
            'showing' => 'Mostrando',
            'to' => 'a',
            'of' => 'de',
            'results' => 'resultados'
        ]
    ],
    'home' => [
        'title' => 'Plataforma Agrícola Municipal de Santa Ana',
        'nav' => [
            'home' => 'Inicio',
            'how_it_works' => 'Cómo Funciona',
            'benefits' => 'Beneficios',
            'store' => 'Tienda',
            'login' => 'Iniciar Sesión',
            'view_products' => 'Ver Productos'
        ],
        'hero' => [
            'municipality' => 'Alcaldía Municipal de Santa Ana',
            'official' => 'Oficial',
            'title' => 'Plataforma Agrícola',
            'subtitle' => 'Municipal de Santa Ana',
            'description' => 'Unimos productores locales con la comunidad. Una iniciativa de la Unidad de Agricultura y Ganadería para fortalecer el sector agrícola del municipio.',
            'cta' => [
                'explore' => 'Explorar Tienda',
                'how_it_works' => 'Cómo Funciona'
            ],
            'stats' => [
                'producers' => 'Productores Locales',
                'products' => 'Productos Frescos',
                'support' => 'Respaldo Municipal'
            ]
        ],
        'how_it_works' => [
            'title' => 'Cómo Funciona',
            'subtitle' => 'Proceso simple y transparente para unir productores con la comunidad',
            'steps' => [
                'explore' => [
                    'title' => 'Explora Productos',
                    'description' => 'Navega por la selección de productos agrícolas frescos de los productores de Santa Ana'
                ],
                'contact' => [
                    'title' => 'Contacta al Productor',
                    'description' => 'Comunícate directamente con los productores locales para consultar disponibilidad y precios'
                ],
                'receive' => [
                    'title' => 'Recibe tus Productos',
                    'description' => 'Coordina la entrega o recogida de tus productos frescos directamente del productor'
                ]
            ]
        ],
        'benefits' => [
            'title' => 'Beneficios para Todos',
            'items' => [
                'fresh_products' => [
                    'title' => 'Productos Frescos',
                    'description' => 'Directamente del campo a tu mesa, sin intermediarios'
                ],
                'fair_prices' => [
                    'title' => 'Precios Justos',
                    'description' => 'Mejores precios para la comunidad y productores locales'
                ],
                'municipal_support' => [
                    'title' => 'Apoyo Municipal',
                    'description' => 'Iniciativa de la Alcaldía de Santa Ana para fortalecer el sector agrícola'
                ],
                'transparency' => [
                    'title' => 'Transparencia Total',
                    'description' => 'Conoce el origen de cada producto de nuestros agricultores'
                ]
            ],
            'producer_cta' => [
                'title' => '¿Eres Productor de Santa Ana?',
                'description' => 'Únete a esta iniciativa municipal y forma parte de la red de productores agrícolas de Santa Ana. Gestiona tu negocio de forma fácil y profesional con el respaldo de la Alcaldía.',
                'features' => [
                    'Crea tu perfil de negocio',
                    'Publica tus productos',
                    'Gestiona tu inventario',
                    'Conecta con la comunidad local'
                ],
                'button' => 'Registrarse Ahora'
            ]
        ],
        'footer' => [
            'description' => 'Plataforma municipal para unir productores agrícolas con la comunidad de Santa Ana.',
            'initiative' => 'Una iniciativa de:',
            'municipality' => 'Alcaldía Municipal de Santa Ana',
            'unit' => 'Unidad de Agricultura y Ganadería',
            'copyright' => '© 2025 Alcaldía Municipal de Santa Ana. Todos los derechos reservados.'
        ]
    ],
    
    // Admin section
    'business' => [
        'title' => 'Perfil del Negocio',
        'address' => 'Dirección',
        'description' => 'Descripción',
        'contact_whatsapp' => 'Contactar por WhatsApp',
        'view_products' => 'Ver Productos',
        'available_products' => 'Productos Disponibles',
        'no_products' => 'No hay productos disponibles',
        'no_products_message' => 'Este negocio no tiene productos publicados actualmente',
        'view_details' => 'Ver Detalles',
        'contact_seller' => 'Contactar Vendedor',
        'business_info' => 'Información del Negocio',
        'producer' => 'Productor',
        'phone' => 'Teléfono',
        'location' => 'Ubicación',
        'back_to_store' => 'Volver a la Tienda',
        'gallery' => 'Galería de Fotos',
        'breadcrumb_home' => 'Inicio',
        'breadcrumb_store' => 'Tienda'
    ],
    'product' => [
        'title' => 'Detalles del Producto',
        'price' => 'Precio',
        'category' => 'Categoría',
        'description' => 'Descripción',
        'contact_whatsapp' => 'Contactar por WhatsApp',
        'business_info' => 'Información del Negocio',
        'business' => 'Negocio',
        'producer' => 'Productor',
        'phone' => 'Teléfono',
        'back_to_store' => 'Volver a la Tienda',
        'breadcrumb_home' => 'Inicio',
        'breadcrumb_store' => 'Tienda',
        'gallery' => 'Galería de Fotos',
        'view_details' => 'Ver Detalles',
        'contact_seller' => 'Contactar Vendedor',
        'location' => 'Ubicación',
        'login' => 'Iniciar Sesión'
    ],
    'whatsapp' => [
        'business_message' => 'Hola {producer}, me interesa conocer más sobre su negocio {business}. Puede ver su perfil aquí: {url}',
        'product_message' => 'Hola {producer}, me interesa el producto "{product}" de su negocio {business}. Puede ver el producto aquí: {url}'
    ],
    
    'admin' => [
        'dashboard' => [
            'title' => 'Panel de Administración',
            'description' => 'Gestiona usuarios, categorías, negocios y configuraciones del sistema.',
            'stats' => [
                'total_registered' => 'Total registrados',
                'active_in_system' => 'Activos en el sistema',
                'active_businesses' => 'Negocios activos',
                'total_published' => 'Publicados en total',
                'total_users' => 'Usuarios Totales',
                'active_users' => 'Usuarios Activos',
                'total_products' => 'Productos Totales',
                'pending_orders' => 'Órdenes Pendientes',
            ],
            'recent_users' => 'Usuarios Registrados Recientemente',
            'no_recent_activity' => 'No hay actividad reciente',
            'view_all_users' => 'Ver todos los usuarios',
            'recent_activity' => 'Actividad Reciente',
            'view_all' => 'Ver Todo',
        ],
        'users' => [
            'title' => 'Usuarios',
            'list' => 'Lista de Usuarios',
            'name' => 'Nombre',
            'email' => 'Correo Electrónico',
            'role' => 'Rol',
            'registered' => 'Registrado',
            'create' => 'Crear Usuario',
            'edit' => 'Editar Usuario',
            'status' => 'Estado',
            'created_at' => 'Fecha de Creación',
            'last_login' => 'Último Inicio de Sesión',
        ],
        'products' => [
            'title' => 'Productos',
            'list' => 'Lista de Productos',
            'create' => 'Crear Producto',
            'edit' => 'Editar Producto',
            'name' => 'Nombre del Producto',
            'category' => 'Categoría',
            'price' => 'Precio',
            'stock' => 'Inventario',
            'status' => 'Estado',
        ],
        'categories' => [
            'title' => 'Categorías',
            'list' => 'Lista de Categorías',
            'create' => 'Crear Categoría',
            'edit' => 'Editar Categoría',
            'name' => 'Nombre de la Categoría',
            'description' => 'Descripción',
            'status' => 'Estado',
        ],
        'business' => [
            'title' => 'Negocios',
            'list' => 'Lista de Negocios',
            'create' => 'Crear Negocio',
            'edit' => 'Editar Negocio',
            'name' => 'Nombre del Negocio',
            'owner' => 'Propietario',
            'status' => 'Estado',
        ],
        'settings' => [
            'title' => 'Configuración',
            'general' => 'Configuración General',
            'site_name' => 'Nombre del Sitio',
            'site_description' => 'Descripción del Sitio',
            'site_email' => 'Correo del Sitio',
            'items_per_page' => 'Elementos por Página',
            'save_changes' => 'Guardar Cambios',
            'changes_saved' => 'Cambios guardados correctamente',
        ],
    ],
];
