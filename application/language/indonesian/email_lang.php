<?php	defined('BASEPATH') OR exit('Akses skrip secara langsung tidak diijinkan');
/**
 * File Bahasa Indoensia - Email
 */

$lang['email_must_be_array'] = 'Metode validasi email harus menggunakan array.';
$lang['email_invalid_address'] = 'Alamat email tidak sah: %s';
$lang['email_attachment_missing'] = 'Tidak dapat menemukan lampiran email berikut ini: %s';
$lang['email_attachment_unreadable'] = 'Tidak dapat membuka lampiran ini: %s';
$lang['email_no_from'] = 'Tidak dapat mengirim email tanpa field "From".';
$lang['email_no_recipients'] = 'Anda harus menyertakan penerima: To, Cc, atau Bcc';
$lang['email_send_failure_phpmail'] = 'Tidak dapat mengirim email menggunakan PHP mail(). Server Anda mungkin tidak dikonfigurasi untuk mengirim email dengan menggunakan metode ini.';
$lang['email_send_failure_sendmail'] = 'Tidak dapat mengirim email menggunakan PHP Sendmail. Server Anda mungkin tidak dikonfigurasi untuk mengirim email dengan menggunakan metode ini.';
$lang['email_send_failure_smtp'] = 'Tidak dapat mengirim email menggunakan PHP SMTP. Server Anda mungkin tidak dikonfigurasi untuk mengirim email dengan menggunakan metode ini.';
$lang['email_sent'] = 'Pesan Anda telah berhasil dikirim menggunakan protokol berikut: %s';
$lang['email_no_socket'] = 'Tidak dapat membuka socket untuk Sendmail. Silakan periksa pengaturan.';
$lang['email_no_hostname'] = 'Anda tidak menentukan nama host SMTP.';
$lang['email_smtp_error'] = 'Terjadi kesalahan SMTP berikut: %s';
$lang['email_no_smtp_unpw'] = 'Kesalahan: Anda harus menentukan username dan password SMTP.';
$lang['email_failed_smtp_login'] = 'Gagal mengirim perintah AUTH LOGIN. Kesalahan: %s';
$lang['email_smtp_auth_un'] = 'Gagal melakukan otentifikasi username. Kesalahan: %s';
$lang['email_smtp_auth_pw'] = 'Gagal melakukan otentifikasi password. Kesalahan: %s';
$lang['email_smtp_data_failure'] = 'Tidak dapat mengirim data: %s';
$lang['email_exit_status'] = 'Exit status code: %s';
