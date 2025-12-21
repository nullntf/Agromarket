<?php

return [
    // Common
    'welcome' => 'Welcome',
    'dashboard' => 'Dashboard',
    'profile' => 'Profile',
    'settings' => 'Settings',
    'logout' => 'Logout',
    'save' => 'Save',
    'cancel' => 'Cancel',
    'edit' => 'Edit',
    'delete' => 'Delete',
    'actions' => 'Actions',
    'search' => 'Search...',
    'no_records' => 'No records found',
    'confirm_delete' => 'Are you sure you want to delete this record?',
    'success' => 'Success',
    'error' => 'Error',
    'info' => 'Information',
    'warning' => 'Warning',
    
    // Home Page
    'store' => [
        'title' => 'Store - AgroCompra',
        'catalog' => 'Product Catalog',
        'discover' => 'Discover fresh agricultural products from all over El Salvador',
        'filters' => [
            'title' => 'Search Filters',
            'clear' => 'Clear Filters',
            'search' => 'General Search',
            'category' => 'Category',
            'department' => 'Department',
            'municipality' => 'Municipality',
            'min_price' => 'Minimum Price ($)',
            'max_price' => 'Maximum Price ($)',
            'search_button' => 'Search',
            'reset_button' => 'Reset',
            'loading' => 'Loading...'
        ],
        'results' => [
            'title' => 'Available Products',
            'no_results' => 'No products found matching your search.',
            'view' => 'View Product',
            'by' => 'by',
            'contact' => 'Contact Seller',
            'view_business' => 'View Business',
            'price' => 'Price:',
            'stock' => 'Availability:',
            'in_stock' => 'In stock',
            'out_of_stock' => 'Out of stock',
            'location' => 'Location:'
        ],
        'pagination' => [
            'previous' => 'Previous',
            'next' => 'Next',
            'showing' => 'Showing',
            'to' => 'to',
            'of' => 'of',
            'results' => 'results'
        ]
    ],
    'home' => [
        'title' => 'Agricultural Platform of Santa Ana Municipality',
        'nav' => [
            'home' => 'Home',
            'how_it_works' => 'How It Works',
            'benefits' => 'Benefits',
            'store' => 'Store',
            'login' => 'Login',
            'view_products' => 'View Products'
        ],
        'hero' => [
            'municipality' => 'Municipality of Santa Ana',
            'official' => 'Official',
            'title' => 'Agricultural Platform',
            'subtitle' => 'of Santa Ana Municipality',
            'description' => 'Connecting local producers with the community. An initiative by the Agriculture and Livestock Unit to strengthen the agricultural sector of the municipality.',
            'cta' => [
                'explore' => 'Explore Store',
                'how_it_works' => 'How It Works'
            ],
            'stats' => [
                'producers' => 'Local Producers',
                'products' => 'Fresh Products',
                'support' => 'Municipal Support'
            ]
        ],
        'how_it_works' => [
            'title' => 'How It Works',
            'subtitle' => 'Simple and transparent process to connect producers with the community',
            'steps' => [
                'explore' => [
                    'title' => 'Explore Products',
                    'description' => 'Browse through the selection of fresh agricultural products from Santa Ana producers'
                ],
                'contact' => [
                    'title' => 'Contact the Producer',
                    'description' => 'Communicate directly with local producers to check availability and prices'
                ],
                'receive' => [
                    'title' => 'Receive Your Products',
                    'description' => 'Coordinate delivery or pickup of your fresh products directly from the producer'
                ]
            ]
        ],
        'benefits' => [
            'title' => 'Benefits for Everyone',
            'items' => [
                'fresh_products' => [
                    'title' => 'Fresh Products',
                    'description' => 'Straight from the field to your table, no intermediaries'
                ],
                'fair_prices' => [
                    'title' => 'Fair Prices',
                    'description' => 'Better prices for the community and local producers'
                ],
                'municipal_support' => [
                    'title' => 'Municipal Support',
                    'description' => 'Initiative by the Santa Ana Municipality to strengthen the agricultural sector'
                ],
                'transparency' => [
                    'title' => 'Full Transparency',
                    'description' => 'Know the origin of every product from our farmers'
                ]
            ],
            'producer_cta' => [
                'title' => 'Are You a Santa Ana Producer?',
                'description' => 'Join this municipal initiative and become part of the Santa Ana agricultural producers network. Manage your business easily and professionally with the support of the Municipality.',
                'features' => [
                    'Create your business profile',
                    'Publish your products',
                    'Manage your inventory',
                    'Connect with the local community'
                ],
                'button' => 'Register Now'
            ]
        ],
        'footer' => [
            'description' => 'Municipal platform to connect agricultural producers with the Santa Ana community.',
            'initiative' => 'An initiative by:',
            'municipality' => 'Municipality of Santa Ana',
            'unit' => 'Agriculture and Livestock Unit',
            'copyright' => '© 2025 Municipality of Santa Ana. All rights reserved.'
        ]
    ],
    
    // Admin section
    'business' => [
        'title' => 'Business Profile',
        'address' => 'Address',
        'description' => 'Description',
        'contact_whatsapp' => 'Contact via WhatsApp',
        'view_products' => 'View Products',
        'available_products' => 'Available Products',
        'no_products' => 'No products available',
        'no_products_message' => 'This business does not have any products published at the moment',
        'view_details' => 'View Details',
        'contact_seller' => 'Contact Seller',
        'business_info' => 'Business Information',
        'producer' => 'Producer',
        'phone' => 'Phone',
        'location' => 'Location',
        'back_to_store' => 'Back to Store',
        'gallery' => 'Photo Gallery',
        'breadcrumb_home' => 'Home',
        'breadcrumb_store' => 'Store'
    ],
    'product' => [
        'title' => 'Product Details',
        'price' => 'Price',
        'category' => 'Category',
        'description' => 'Description',
        'contact_whatsapp' => 'Contact via WhatsApp',
        'business_info' => 'Business Information',
        'business' => 'Business',
        'producer' => 'Producer',
        'phone' => 'Phone',
        'back_to_store' => 'Back to Store',
        'breadcrumb_home' => 'Home',
        'breadcrumb_store' => 'Store',
        'gallery' => 'Photo Gallery',
        'view_details' => 'View Details',
        'contact_seller' => 'Contact Seller',
        'location' => 'Location',
        'login' => 'Login'
    ],
    'whatsapp' => [
        'business_message' => 'Hello {producer}, I am interested in learning more about your business {business}. You can view your profile here: {url}',
        'product_message' => 'Hello {producer}, I am interested in the product "{product}" from {business}. Could you provide more information about price, availability, and delivery options? Thank you. Product: {url}'
    ],
    
    'admin' => [
        'dashboard' => [
            'title' => 'Admin Dashboard',
            'description' => 'Manage users, categories, businesses, and system settings.',
            'stats' => [
                'total_registered' => 'Total registered',
                'active_in_system' => 'Active in system',
                'active_businesses' => 'Active businesses',
                'total_published' => 'Total published',
                'total_users' => 'Total Users',
                'active_users' => 'Active Users',
                'total_products' => 'Total Products',
                'pending_orders' => 'Pending Orders',
            ],
            'recent_users' => 'Recently Registered Users',
            'no_recent_activity' => 'No recent activity',
            'view_all_users' => 'View all users',
            'recent_activity' => 'Recent Activity',
            'view_all' => 'View All',
        ],
        'users' => [
            'title' => 'Users',
            'list' => 'Users List',
            'name' => 'Name',
            'email' => 'Email',
            'role' => 'Role',
            'registered' => 'Registered',
            'create' => 'Create User',
            'edit' => 'Edit User',
            'status' => 'Status',
            'created_at' => 'Created At',
            'last_login' => 'Last Login',
        ],
        'products' => [
            'title' => 'Products',
            'list' => 'Products List',
            'create' => 'Create Product',
            'edit' => 'Edit Product',
            'name' => 'Product Name',
            'category' => 'Category',
            'price' => 'Price',
            'stock' => 'Stock',
            'status' => 'Status',
        ],
        'categories' => [
            'title' => 'Categories',
            'list' => 'Categories List',
            'create' => 'Create Category',
            'edit' => 'Edit Category',
            'name' => 'Category Name',
            'description' => 'Description',
            'status' => 'Status',
        ],
        'business' => [
            'title' => 'Businesses',
            'list' => 'Businesses List',
            'create' => 'Create Business',
            'edit' => 'Edit Business',
            'name' => 'Business Name',
            'owner' => 'Owner',
            'status' => 'Status',
        ],
        'settings' => [
            'title' => 'Settings',
            'general' => 'General Settings',
            'site_name' => 'Site Name',
            'site_description' => 'Site Description',
            'site_email' => 'Site Email',
            'items_per_page' => 'Items Per Page',
            'save_changes' => 'Save Changes',
            'changes_saved' => 'Changes saved successfully',
        ],
    ],
];
