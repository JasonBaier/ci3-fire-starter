<?php	defined('BASEPATH') OR exit('Akses skrip secara langsung tidak diijinkan');
/**
 * File Bahasa Indonesia - Users
 */

// Titles
$lang['users title forgot']                   = "Lupa Password";
$lang['users title login']                    = "Login";
$lang['users title profile']                  = "Profil";
$lang['users title register']                 = "Masuk";
$lang['users title user_add']                 = "Tambah User";
$lang['users title user_delete']              = "Konfirmasi Hapus User";
$lang['users title user_edit']                = "Ubah User";
$lang['users title user_list']                = "Daftar User";

// Buttons
$lang['users button add_new_user']            = "Tambah User Baru";
$lang['users button register']                = "Buat Akun";
$lang['users button reset_password']          = "Reset Password";
$lang['users button login_try_again']         = "Coba lagi";

// Tooltips
$lang['users tooltip add_new_user']           = "Buat user baru.";

// Links
$lang['users link forgot_password']           = "Lupa password anda?";
$lang['users link register_account']          = "Daftarkan akun.";

// Table Columns
$lang['users col first_name']                 = "Nama Depan";
$lang['users col is_admin']                   = "Admin";
$lang['users col last_name']                  = "Nama Belakang";
$lang['users col user_id']                    = "ID";
$lang['users col username']                   = "Username";

// Form Inputs
$lang['users input email']                    = "Email";
$lang['users input first_name']               = "Nama Depan";
$lang['users input is_admin']                 = "Apakah Admin?";
$lang['users input language']                 = "Bahasa";
$lang['users input last_name']                = "Nama Belakang";
$lang['users input password']                 = "Password";
$lang['users input password_repeat']          = "Ulangi Password";
$lang['users input status']                   = "Status";
$lang['users input username']                 = "Username";
$lang['users input username_email']           = "Username atau Email";

// Help
$lang['users help passwords']                 = "Masukkan password hanya jika anda ingin merubahnya.";

// Messages
$lang['users msg add_user_success']           = "%s berhasil ditambahkan!";
$lang['users msg delete_confirm']             = "Apakah anda yakin ingin menghapus <strong>%s</strong>? Ini tidak bisa dibatalkan.";
$lang['users msg delete_user']                = "Anda telah berhasil menghapus <strong>%s</strong>!";
$lang['users msg edit_profile_success']       = "Profil anda berhasil diperbarui!";
$lang['users msg edit_user_success']          = "%s berhasil diperbarui!";
$lang['users msg register_success']           = "Terima kasih sudah mendaftar, %s! Periksa email anda untuk pesan konfirmasi. Sekali
                                                 akun anda diverifikasi, anda akan dapat masuk dengan informasi rahasia yang anda buat.";
$lang['users msg password_reset_success']     = "Password anda telah direset, %s! Silakan periksa email anda untuk password sementara anda yang baru.";
$lang['users msg validate_success']           = "Akun anda telah diverifikasi. Anda sekarang bisa login ke akun anda.";
$lang['users msg email_new_account']          = "<p>Terima kasih sudah membuat akun di %s. Klik ltautan di bawah ini untuk melakukan validasi
                                                 alamat email anda dan mengaktifkan akun anda.<br /><br /><a href=\"%s\">%s</a></p>";
$lang['users msg email_new_account_title']    = "Akun Baru untuk %s";
$lang['users msg email_password_reset']       = "<p>Password anda di %s telah direset. Klik tautan di bawah ini untuk login dengan
                                                 menggunakan password baru anda:<br /><br /><strong>%s</strong><br /><br /><a href=\"%s\">%s</a>
                                                 Sekali anda login, pastikan untuk merubah password anda dengan yang dapat anda ingat.</p>";
$lang['users msg email_password_reset_title'] = "Reset Password untuk %s";

// Errors
$lang['users error add_user_failed']          = "%s tidak bisa ditambahkan!";
$lang['users error delete_user']              = "<strong>%s</strong> tidak bisa dihapus!";
$lang['users error edit_profile_failed']      = "Profil anda tidak bisa diubah!";
$lang['users error edit_user_failed']         = "%s tidak bisa diubah!";
$lang['users error email_exists']             = "Email <strong>%s</strong> sudah ada!";
$lang['users error email_not_exists']         = "Email tidak ada!";
$lang['users error invalid_login']            = "Username atau password tidak benar";
$lang['users error register_failed']          = "Akun anda tidak dapat dibuat saat ini. Silakan coba lagi.";
$lang['users error user_id_required']         = "User ID harus berisi angka!";
$lang['users error user_not_exist']           = "User tersebut tidak ada!";
$lang['users error username_exists']          = "Username <strong>%s</strong> sudah ada!";
$lang['users error validate_failed']          = "Terdapat masalah dalam upaya validasi akun anda. Silakan coba lagi.";
$lang['users error too_many_login_attempts']  = "Anda sudah membuat terlalu banyak upaya untuk log in terlalu cepat. Silahkan tunggu %s detik dan coba lagi.";
