<?php

return [
    'full_access_permission' => [
        'full-access'
    ],
    'dashboard_permissions' => [
        'view-dashboard',
    ],
    'role_permissions' => [
        'view-roles',
        'create-role',
        'show-role',
        'edit-role',
        'delete-role'
    ],
    'user_permissions' => [
        'view-users',
        'show-user',
        'edit-user',
        'create-user',
        'delete-user',
        'restore-user',
    ],
    'permohonan_akun_permissions' => [
        'list-akun',
        'detail-akun',
        'tolak-akun',
        'perbaikan-akun',
        'approve-akun',
    ],
    'verifikasi_kegiatan_permission' => [
        'list-permohonan-kegiatan',
        'detail-permohonan-kegiatan',
        'status-permohonan-kegiatan'
    ],
    'permohonan_kegiatan_permissions' => [
        'view-kegiatan',
        'create-kegiatan',
        'edit-kegiatan',
        'update-kegiatan',
        'submit-kegiatan',
        'list-setuju',
        'list-tolak',
        'pelaporan',
        'submit-pelaporan',
    ],
    'sub_penyelenggara_permissions' => [
        'view-sub-penyelenggara',
        'change-status-sub-penyelenggara',
        'create-sub-penyelenggara',
        'edit-sub-penyelenggara',
        'update-sub-penyelenggara'
    ],
    'peserta_permissions' => [
        'view-peserta',
        'create-peserta',
        'edit-peserta',
        'update-peserta'
    ],
    'logbook_permissions' => [
        'list-kegiatan',
        'kegiatan-unverified',
        'kegiatan-verified',
        'all-kegiatan',
    ]
];
