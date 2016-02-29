<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Users Language File
 */

// Titles
$lang['users title forgot']                   = "Şifremi unuttum";
$lang['users title login']                    = "Oturum açma";
$lang['users title profile']                  = "Profil";
$lang['users title register']                 = "Üye ol";
$lang['users title user_add']                 = "Kullanıcı Ekle";
$lang['users title user_delete']              = "kullanıcıyı silmek icin onaylayın";
$lang['users title user_edit']                = "Kullanıcı düzenleme";
$lang['users title user_list']                = "Kullanıcı listesi";

// Buttons
$lang['users button add_new_user']            = "Yeni Kullanıcı Ekle";
$lang['users button register']                = "Hesap oluşturma";
$lang['users button reset_password']          = "Parola sıfırlama";
$lang['users button login_try_again']         = "Tekrar dene";

// Tooltips
$lang['users tooltip add_new_user']           = "Yeni bir kullanıcı oluşturun.";

// Links
$lang['users link forgot_password']           = "Şifrenizi mi unuttunuz?";
$lang['users link register_account']          = "Bir hesap için üye ol.";

// Table Columns
$lang['users col first_name']                 = "İlk ad";
$lang['users col is_admin']                   = "Admin";
$lang['users col last_name']                  = "Soyadı";
$lang['users col user_id']                    = "ID";
$lang['users col username']                   = "Kullanıcı adı";

// Form Inputs
$lang['users input email']                    = "E-posta";
$lang['users input first_name']               = "İlk ad";
$lang['users input is_admin']                 = "Admin";
$lang['users input language']                 = "Dil";
$lang['users input last_name']                = "Soyadı";
$lang['users input password']                 = "Şifre";
$lang['users input password_repeat']          = "Şifreyi tekrarla";
$lang['users input status']                   = "Durumu";
$lang['users input username']                 = "Kullanıcı adı";
$lang['users input username_email']           = "Kullanıcı adı veya e-posta";

// Help
$lang['users help passwords']                 = "Bunu değiştirmek istiyorsanız, sadece şifreleri girin.";

// Messages
$lang['users msg add_user_success']           = "%s başarıyla eklendi!";
$lang['users msg delete_confirm']             = "<strong>%s</strong> silmek istediğinizden emin misiniz? Bu alınamaz.";
$lang['users msg delete_user']                = "<strong>%s</strong> Başarıyla sildiniz !";
$lang['users msg edit_profile_success']       = "Profil başarıyla güncellenmiştir!";
$lang['users msg edit_user_success']          = "%s başarıyla güncellenmiştir!";
$lang['users msg register_success']           = "Kayıt için teşekkürler! %s Bir onay iletisi için e-postanızı kontrol edin.
Hesabınız doğrulandigi zaman, kimlik bilgilerinizle oturum acabileceksiniz.";
$lang['users msg password_reset_success']     = "Parolanız sıfırlandı,%s ! Yeni Geçici şifre e-postanızı kontrol edin.";
$lang['users msg validate_success']           = "Hesap doğrulandı. Hesabınıza şimdi oturum açabilir.";
$lang['users msg email_new_account']          = "<p>Hesap olusturdugunuz icin teşekkür ederim %s.
asagadaki linke tiklayarak hesabinizi active onaylaya bilirsiniz <br/> <br/> <a href=\"%s\"> %s</a></p>";
$lang['users msg email_new_account_title']    = "%s için yeni hesap";
$lang['users msg email_password_reset']       = "%s, parola sıfırlama <p>. İçinde oturum için aşağıdaki bağlantıyı tıklatın,
                                                 yeni parola: < br / > < br / > <strong>%s</strong> < br / > < br / > <a href=\"%s\"> %s</a>
                                                 Bir kez logged içinde bir şey için parolanızı değiştirmek emin olun
                                                 hatırlıyorum.</p>";
$lang['users msg email_password_reset_title'] = "%s için parola sıfırlama";

// Errors
$lang['users error add_user_failed']          = "%s eklenemedi!";
$lang['users error delete_user']              = "<strong>%s</strong> silinemedi!";
$lang['users error edit_profile_failed']      = "Profilinizi değiştirilemedi.";
$lang['users error edit_user_failed']         = "%s değiştirilemedi.";
$lang['users error email_exists']             = "<strong>%s</strong> e-posta zaten var!";
$lang['users error email_not_exists']         = "E-posta değil var!";
$lang['users error invalid_login']            = "Geçersiz kullanıcı adı veya parola";
$lang['users error password_reset_failed']    = "Şifrenizi sıfırlamak bir hata oluştu. Lütfen yeniden deneyin.";
$lang['users error register_failed']          = "Hesabınız şu anda oluşturulamadı. Lütfen yeniden deneyin.";
$lang['users error user_id_required']         = "Bir sayısal kullanıcı kimliği gereklidir!";
$lang['users error user_not_exist']           = "Bu kullanıcı yok!";
$lang['users error username_exists']          = "Kullanıcı adı <strong>%s</strong> zaten!";
$lang['users error validate_failed']          = "Hesabınızı doğrulanırken bir hata oluştu. Lütfen yeniden deneyin.";
$lang['users error too_many_login_attempts']  = "Çok hızlı giriş için çok fazla deneme yaptık. %s saniye bekleyin ve tekrar deneyin.";
