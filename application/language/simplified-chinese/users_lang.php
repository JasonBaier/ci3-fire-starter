<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Users Language File
 * author Evenvi
 * www.evenvi.com
 */

// Titles
$lang['users title forgot']                   = "忘记密码";
$lang['users title login']                    = "登录";
$lang['users title profile']                  = "个人资料";
$lang['users title register']                 = "注册";
$lang['users title user_add']                 = "添加用户";
$lang['users title user_delete']              = "确定删除用户";
$lang['users title user_edit']                = "编辑用户";
$lang['users title user_list']                = "用户列表";

// Buttons
$lang['users button add_new_user']            = "添加新用户";
$lang['users button register']                = "创建新账号";
$lang['users button reset_password']          = "重置密码";
$lang['users button login_try_again']         = "再试一次";

// Tooltips
$lang['users tooltip add_new_user']           = "创建一个全新的用户。";

// Links
$lang['users link forgot_password']           = "忘记密码?";
$lang['users link register_account']          = "注册一个帐号。";

// Table Columns
$lang['users col first_name']                 = "名字";
$lang['users col is_admin']                   = "管理员";
$lang['users col last_name']                  = "姓";
$lang['users col user_id']                    = "ID";
$lang['users col username']                   = "用户名";

// Form Inputs
$lang['users input email']                    = "邮箱";
$lang['users input first_name']               = "名字";
$lang['users input is_admin']                 = "是管理员";
$lang['users input language']                 = "语言";
$lang['users input last_name']                = "姓";
$lang['users input password']                 = "密码";
$lang['users input password_repeat']          = "确认密码";
$lang['users input status']                   = "状态";
$lang['users input username']                 = "用户名";
$lang['users input username_email']           = "用户名或密码";

// Help
$lang['users help passwords']                 = "只有更新密码时需要输入密码";

// Messages
$lang['users msg add_user_success']           = "用户 %s 添加成功!";
$lang['users msg delete_confirm']             = "确定删除 <strong>%s</strong>? 操作不可恢复.";
$lang['users msg delete_user']                = "成功删除 <strong>%s</strong>!";
$lang['users msg edit_profile_success']       = "个人信息修改成功!";
$lang['users msg edit_user_success']          = "%s 修改成功!";
$lang['users msg register_success']           = "感谢注册, %s! 请登录你的邮箱检查,激活该账号";
$lang['users msg password_reset_success']     = "密码已经重置 %s! 请登录邮箱检查你的临时密码.";
$lang['users msg validate_success']           = "账号已经激活. 你可以登录授权系统了.";
$lang['users msg email_new_account']          = "<p>感谢注册账号 %s. Click 点击下面的链接激活你的账号.<br /><br /><a href=\"%s\">%s</a></p>";
$lang['users msg email_new_account_title']    = "New Account for %s";
$lang['users msg email_password_reset']       = "<p>你的密码 %s 已经重置. 点击下面的链接,用新密码登录:<br /><br /><strong>%s</strong><br /><br /><a href=\"%s\">%s</a>
                                                 登录后请尽快修改你能记住的密码.</p>";
$lang['users msg email_password_reset_title'] = "密码修改为 %s";

// Errors
$lang['users error add_user_failed']          = "%s 添加失败!";
$lang['users error delete_user']              = "<strong>%s</strong> 不能被删除!";
$lang['users error edit_profile_failed']      = "个人资料不能修改!";
$lang['users error edit_user_failed']         = "%s 不能修改!";
$lang['users error email_exists']             = "邮箱 <strong>%s</strong> 已经存在!";
$lang['users error email_not_exists']         = "邮箱不存在!";
$lang['users error invalid_login']            = "错误的用户名或密码";
$lang['users error password_reset_failed']    = "重置密码失败!请重试";
$lang['users error register_failed']          = "注册失败!请重试.";
$lang['users error user_id_required']         = "ID必须为数字!";
$lang['users error user_not_exist']           = "该用户不存在!";
$lang['users error username_exists']          = "用户名 <strong>%s</strong> 已经存在!";
$lang['users error validate_failed']          = "用户激活失败!请重试.";
$lang['users error too_many_login_attempts']  = "你做了太多的登录尝试太. 请等待%s秒，然后重试.";
