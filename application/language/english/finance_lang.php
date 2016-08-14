<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * finance Language File
 */

// Titles
$lang['finance title forgot']                   = "Forgot Password";
$lang['finance title login']                    = "Login";
$lang['finance title profile']                  = "Profile";
$lang['finance title register']                 = "Register";
$lang['finance title finance_add']                 = "Add Record";
$lang['finance title finance_delete']              = "Confirm Delete Record";
$lang['finance title finance_edit']                = "Edit Record";
$lang['finance title finance_list']                = "Records List";
$lang['finance title manage_list']                = "Manage List";
$lang['finance title manage']                = "Manage Categories & Options";

// Buttons
$lang['finance button add_new_record']            = "Add New Record";
$lang['finance button add_new_catven']            = "Add New Opt. +";
$lang['finance button register']                = "Create Record";
$lang['finance button reset_password']          = "Reset Password";
$lang['finance button login_try_again']         = "Try Again";
$lang['finance button lookup']         = "Find in Gmail";
$lang['finance button copyme']         = "Copy";

// Tooltips
$lang['finance tooltip add_new_record']           = "Create a brand new record.";
$lang['finance tooltip add_new_catven']           = "Create a new record or category.";

// Links
$lang['finance link forgot_password']           = "Forgot your password?";
$lang['finance link register_account']          = "Register for an account.";

// Table Columns
$lang['finance col category']                 = "Category";
$lang['finance col who']                   = "User";
$lang['finance col group']                   = "Type";
$lang['finance col description']                  = "Description";
$lang['finance col finance_id']                    = "ID";
$lang['finance col catven_id']                    = "ID";
$lang['finance col title']                   = "Title";
$lang['finance col categories']                   = "Setting";
$lang['finance col value']                   = "Value";

// Form Inputs
$lang['finance input email']                    = "Email";
$lang['finance input category']               = "Category";
$lang['finance input is_admin']                 = "Is Admin";
$lang['finance input category_new']                 = "Category";
$lang['finance input catven category']                 = "Category";
$lang['finance input language']                 = "Language";
$lang['finance input no']                 = "No";
$lang['finance input yes']                 = "Yes";
$lang['finance input description']                = "Description";
$lang['finance input password']                 = "Password";
$lang['finance input password_repeat']          = "Repeat Password";
$lang['finance input costprice']                   = "Value";
$lang['finance input filename']                 = "Filename";
$lang['finance input title']           = "Title";
$lang['finance input vendor']			= "Vendor / Supplier";
$lang['finance input fy']			= "Financial Year";
$lang['finance input enabled']			= "Type?";
$lang['finance input who']			= "Who?";
$lang['finance input deleted']			= "Delete me?";

// Help
$lang['finance help passwords']                 = "Only enter passwords if you want to change it.";

// Messages
$lang['finance msg add_record_success']           = "%s was successfully added!";
$lang['finance msg delete_confirm']             = "Are you sure you want to delete <strong>%s</strong>? This can not be undone.";
$lang['finance msg delete_record']                = "You have succesfully deleted <strong>%s</strong>!";
$lang['finance msg edit_profile_success']       = "Your profile was successfully modified!";
$lang['finance msg edit_record_success']          = "%s was successfully modified!";
$lang['finance msg edit_category_success']          = "%s was successfully modified!";
$lang['finance msg register_success']           = "Thanks for registering, %s! Check your email for a confirmation message. Once
                                                 your account has been verified, you will be able to log in with the credentials
                                                 you provided.";
$lang['finance msg password_reset_success']     = "Your password has been reset, %s! Please check your email for your new temporary password.";
$lang['finance msg validate_success']           = "Your account has been verified. You may now log in to your account.";
$lang['finance msg email_new_account']          = "<p>Thank you for creating an account at %s. Click the link below to validate your
                                                 email address and activate your account.<br /><br /><a href=\"%s\">%s</a></p>";
$lang['finance msg email_new_account_title']    = "New Account for %s";
$lang['finance msg email_password_reset']       = "<p>Your password at %s has been reset. Click the link below to log in with your
                                                 new password:<br /><br /><strong>%s</strong><br /><br /><a href=\"%s\">%s</a>
                                                 Once logged in, be sure to change your password to something you can
                                                 remember.</p>";
$lang['finance msg email_password_reset_title'] = "Password Reset for %s";

// Errors
$lang['finance error add_record_failed']          = "%s could not be added!";
$lang['finance error delete_record']              = "<strong>%s</strong> could not be deleted!";
$lang['finance error edit_record_failed']      = "Your profile could not be modified!";
$lang['finance error edit_finance_failed']         = "%s could not be modified!";
$lang['finance error email_exists']             = "The email <strong>%s</strong> already exists!";
$lang['finance error email_not_exists']         = "That email does not exists!";
$lang['finance error invalid_login']            = "Invalid username or password";
$lang['finance error password_reset_failed']    = "There was a problem resetting your password. Please try again.";
$lang['finance error register_failed']          = "Your account could not be created at this time. Please try again.";
$lang['finance error finance_id_required']         = "A numeric user ID is required!";
$lang['finance error finance_not_exist']           = "That user does not exist!";
$lang['finance error record_exists']          = "The username <strong>%s</strong> already exists!";
$lang['finance error validate_failed']          = "There was a problem validating your account. Please try again.";
$lang['finance error too_many_login_attempts']  = "You've made too many attempts to log in too quickly. Please wait %s seconds and try again.";
