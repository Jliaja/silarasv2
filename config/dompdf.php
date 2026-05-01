<?php

return [
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => [
        'DOMPDF_FONT_CACHE' => storage_path('fonts/'),
        'DOMPDF_TEMP_DIR' => sys_get_temp_dir(),
        'DOMPDF_CHROOT' => base_path(),
        'DOMPDF_UNICODE_ENABLED' => true,
        'DOMPDF_ENABLE_REMOTE' => true,
        'DOMPDF_ENABLE_FONT_SUBSETTING' => false,
        'DOMPDF_DPI' => 96,
        'DOMPDF_ENABLE_PHP' => false,
        'DOMPDF_ADMIN_USERNAME' => '',
        'DOMPDF_ADMIN_PASSWORD' => '',
    ],
];