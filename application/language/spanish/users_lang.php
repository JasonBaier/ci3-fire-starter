<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Users Language File
 */

// Titles
$lang['users title forgot']                   = "Olvido su contraseña";
$lang['users title login']                    = "Iniciar sesión";
$lang['users title profile']                  = "Perfil";
$lang['users title register']                 = "Registrarse";
$lang['users title user_add']                 = "Añadir usuario";
$lang['users title user_delete']              = "Confirmar Eliminar usuario";
$lang['users title user_edit']                = "Editar usuario";
$lang['users title user_list']                = "Lista de usuarios";

// Buttons
$lang['users button add_new_user']            = "Añadir usuario nuevo";
$lang['users button register']                = "Crear cuenta";
$lang['users button reset_password']          = "Restablecer la contraseña";
$lang['users button login_try_again']         = "Inténtalo de nuevo";

// Tooltips
$lang['users tooltip add_new_user']           = "Crear un nuevo usuario.";

// Links
$lang['users link forgot_password']           = "¿Olvidaste tu contraseña?";
$lang['users link register_account']          = "Regístrese para una cuenta.";

// Table Columns
$lang['users col first_name']                 = "Nombre";
$lang['users col is_admin']                   = "Administrador";
$lang['users col last_name']                  = "Apellido";
$lang['users col user_id']                    = "ID";
$lang['users col username']                   = "Nombre de usuario";

// Form Inputs
$lang['users input email']                    = "Correo";
$lang['users input first_name']               = "Nombre";
$lang['users input is_admin']                 = "Es administrador";
$lang['users input language']                 = "Idioma";
$lang['users input last_name']                = "Apellido";
$lang['users input password']                 = "Contraseña";
$lang['users input password_repeat']          = "Repetir contraseña";
$lang['users input status']                   = "Estado";
$lang['users input username']                 = "Nombre de usuario";
$lang['users input username_email']           = "Nombre de usuario o Correo";

// Help
$lang['users help passwords']                 = "Solo escribe la contraseña si deseas cambiarla.";

// Messages
$lang['users msg add_user_success']           = "%s fue añadido exitosamente!";
$lang['users msg delete_confirm']             = "¿Seguro que quieres eliminar <strong>%s</ strong>? Esto no se puede deshacer.";
$lang['users msg delete_user']                = "Ha sido eliminado correctamente <strong>%s</strong>!";
$lang['users msg edit_profile_success']       = "Su perfil se modificó con éxito!";
$lang['users msg edit_user_success']          = "%s fue modificado exitosamente!!";
$lang['users msg register_success']           = "Gracias por registrarse, %s! Verifica tu correo por un mensaje de confirmación. Una vez que su cuenta ha sido verificada, usted será capaz de iniciar sesión con las credenciales proporcionadas.";
$lang['users msg password_reset_success']     = "Tu contraseña ha sido restablecida, %s! Por favor revise su correo electrónico para su nueva contraseña temporal.";
$lang['users msg validate_success']           = "Tu cuenta ha sido verificada. Ahora puede acceder a su cuenta.";
$lang['users msg email_new_account']          = "<p>Gracias por crear una cuenta en %s. Haga clic en el enlace de abajo para validar su dirección de correo electrónico y activar su cuenta.<br /><br /><a href=\"%s\">%s</a></p>";
$lang['users msg email_new_account_title']    = "Nueva Cuenta de %s";
$lang['users msg email_password_reset']       = "<p>Su contraseña en %s ha sido restablecida. Haga clic en el enlace de abajo para iniciar sesión con su nueva contraseña:<br /><br /><strong>%s</strong><br /><br /><a href=\"%s\">%s</a>
                                                 Una vez iniciada la sesión, asegúrese de cambiar la contraseña a algo que pueda recordar.</p>";
$lang['users msg email_password_reset_title'] = "Restablecer contraseña para %s";

// Errors
$lang['users error add_user_failed']          = "%s no pudo ser añadido!";
$lang['users error delete_user']              = "<strong>%s</strong> no pudo ser eliminado!";
$lang['users error edit_profile_failed']      = "Su perfil no puede ser modificado!";
$lang['users error edit_user_failed']         = "%s no pudo ser modificado!";
$lang['users error email_exists']             = "El correo electrónico <strong>%s</strong> ya existe!";
$lang['users error email_not_exists']         = "Ese correo electrónico no existe!";
$lang['users error invalid_login']            = "Usuario o contraseña invalido";
$lang['users error password_reset_failed']    = "Hubo un problema al restablecer su contraseña. Por favor, vuelva a intentarlo.";
$lang['users error register_failed']          = "Tu cuenta no pudo crearce en este momento. Por favor, vuelva a intentarlo.";
$lang['users error user_id_required']         = "Se requiere un ID de usuario numérico!";
$lang['users error user_not_exist']           = "Ese usuario no existe!";
$lang['users error username_exists']          = "El usuario <strong>%s</strong> ya existe!";
$lang['users error validate_failed']          = "Hubo un problema al validar su cuenta. Por favor, vuelva a intentarlo.";
$lang['users error too_many_login_attempts']  = "Usted ha hecho demasiados intentos para iniciar sesión con demasiada rapidez. Por favor, espere %s segundos y vuelva a intentarlo.";
