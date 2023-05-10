<?php

return [

    'update' => [
        'error'                 => 'Terjadi kesalahan saat memperbarui. ',
        'success'               => 'Pengaturan berhasil diperbarui.',
    ],
    'backup' => [
        'delete_confirm'        => 'Apakah anda yakin ingin menghapus berkas cadangan ini? Tindakan ini tidak dibatalkan. ',
        'file_deleted'          => 'Berkas cadangan berhasil dihapus. ',
        'generated'             => 'Berkas cadangan baru berhasil dibuat.',
        'file_not_found'        => 'Berkas cadangan itu tidak dapat ditemukan di peladen.',
        'restore_warning'       => 'Yes, restore it. I acknowledge that this will overwrite any existing data currently in the database. This will also log out all of your existing users (including you).',
        'restore_confirm'       => 'Are you sure you wish to restore your database from :filename?'
    ],
    'purge' => [
        'error'     => 'Terjadi kesalahan saat membersihkan. ',
        'validation_failed'     => 'Konfirmasi pembersihan Anda salah Ketikkan kata "HAPUS" di kotak konfirmasi.',
        'success'               => 'Catatan yang dihapus berhasil dibersihkan.',
    ],
    'mail' => [
        'sending' => 'Sending Test Email...',
        'success' => 'Mail sent!',
        'error' => 'Mail could not be sent.',
        'additional' => 'No additional error message provided. Check your mail settings and your app log.'
    ],
    'ldap' => [
        'testing' => 'Testing LDAP Connection, Binding & Query ...',
        '500' => '500 Server Error. Please check your server logs for more information.',
        'error' => 'Something went wrong :(',
        'sync_success' => 'A sample of 10 users returned from the LDAP server based on your settings:',
        'testing_authentication' => 'Testing LDAP Authentication...',
        'authentication_success' => 'User authenticated against LDAP successfully!'
    ],
    'slack' => [
        'sending' => 'Sending Slack test message...',
        'success_pt1' => 'Success! Check the ',
        'success_pt2' => ' channel for your test message, and be sure to click SAVE below to store your settings.',
        '500' => '500 Server Error.',
        'error' => 'Something went wrong.',
    ]
];
