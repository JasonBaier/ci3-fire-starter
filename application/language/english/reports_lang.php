<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * reports Language File
 */

// Titles
$lang['reports title forgot']                   = "Forgot Password";
$lang['reports title login']                    = "Login";
$lang['reports title profile']                  = "Profile";
$lang['reports title register']                 = "Register";
$lang['reports title finance_add']                 = "Add Record";
$lang['reports title finance_delete']              = "Confirm Delete Record";
$lang['reports title finance_edit']                = "Edit Record";
$lang['reports title']                = "Reports Generator";
$lang['reports title manage_list']                = "Manage List";
$lang['reports title manage']                = "Manage Categories & Options";

// Buttons
$lang['reports button add_new_record']            = "Add New Record";
$lang['reports button add_new_catven']            = "Add New Opt. +";
$lang['reports button register']                = "Create Record";
$lang['reports button reset_password']          = "Reset Password";
$lang['reports button login_try_again']         = "Try Again";
$lang['reports button lookup']         = "Find in Gmail";
$lang['reports button copyme']         = "Copy";

// Tooltips
$lang['reports tooltip add_new_record']           = "Create a brand new record.";
$lang['reports tooltip add_new_catven']           = "Create a new record or category.";

// Links
$lang['reports link forgot_password']           = "Forgot your password?";
$lang['reports link register_account']          = "Register for an account.";

// Table Columns
$lang['reports col category']                 = "Category";
$lang['reports col who']                   = "User";
$lang['reports col group']                   = "Type";
$lang['reports col description']                  = "Description";
$lang['reports col finance_id']                    = "ID";
$lang['reports col catven_id']                    = "ID";
$lang['reports col title']                   = "Title";
$lang['reports col categories']                   = "Setting";
$lang['reports col value']                   = "Value";

// Form Inputs
$lang['reports input email']                    = "Email";
$lang['reports input category']               = "Category";
$lang['reports input is_admin']                 = "Is Admin";
$lang['reports input category_new']                 = "Category";
$lang['reports input catven category']                 = "Category";
$lang['reports input language']                 = "Language";
$lang['reports input no']                 = "No";
$lang['reports input yes']                 = "Yes";
$lang['reports input description']                = "Description";
$lang['reports input password']                 = "Password";
$lang['reports input password_repeat']          = "Repeat Password";
$lang['reports input costprice']                   = "Value";
$lang['reports input filename']                 = "Filename";
$lang['reports input title']           = "Title";
$lang['reports input vendor']			= "Vendor / Supplier";
$lang['reports input fy']			= "Financial Year";
$lang['reports input enabled']			= "Type?";
$lang['reports input who']			= "Who?";
$lang['reports input deleted']			= "Delete me?";

// Help
$lang['reports help passwords']                 = "Only enter passwords if you want to change it.";

// Messages
$lang['reports msg add_record_success']           = "%s was successfully added!";
$lang['reports msg delete_confirm']             = "Are you sure you want to delete <strong>%s</strong>? This can not be undone.";
$lang['reports msg delete_record']                = "You have succesfully deleted <strong>%s</strong>!";
$lang['reports msg edit_profile_success']       = "Your profile was successfully modified!";
$lang['reports msg edit_record_success']          = "%s was successfully modified!";
$lang['reports msg edit_category_success']          = "%s was successfully modified!";
$lang['reports msg register_success']           = "Thanks for registering, %s! Check your email for a confirmation message. Once
                                                 your account has been verified, you will be able to log in with the credentials
                                                 you provided.";
$lang['reports msg password_reset_success']     = "Your password has been reset, %s! Please check your email for your new temporary password.";
$lang['reports msg validate_success']           = "Your account has been verified. You may now log in to your account.";
$lang['reports msg email_new_account']          = "<p>Thank you for creating an account at %s. Click the link below to validate your
                                                 email address and activate your account.<br /><br /><a href=\"%s\">%s</a></p>";
$lang['reports msg email_new_account_title']    = "New Account for %s";
$lang['reports msg email_password_reset']       = "<p>Your password at %s has been reset. Click the link below to log in with your
                                                 new password:<br /><br /><strong>%s</strong><br /><br /><a href=\"%s\">%s</a>
                                                 Once logged in, be sure to change your password to something you can
                                                 remember.</p>";
$lang['reports msg email_password_reset_title'] = "Password Reset for %s";

// Errors
$lang['reports error add_record_failed']          = "%s could not be added!";
$lang['reports error delete_record']              = "<strong>%s</strong> could not be deleted!";
$lang['reports error edit_record_failed']      = "Your profile could not be modified!";
$lang['reports error edit_finance_failed']         = "%s could not be modified!";
$lang['reports error email_exists']             = "The email <strong>%s</strong> already exists!";
$lang['reports error email_not_exists']         = "That email does not exists!";
$lang['reports error invalid_login']            = "Invalid username or password";
$lang['reports error password_reset_failed']    = "There was a problem resetting your password. Please try again.";
$lang['reports error register_failed']          = "Your account could not be created at this time. Please try again.";
$lang['reports error finance_id_required']         = "A numeric user ID is required!";
$lang['reports error finance_not_exist']           = "That user does not exist!";
$lang['reports error record_exists']          = "The username <strong>%s</strong> already exists!";
$lang['reports error validate_failed']          = "There was a problem validating your account. Please try again.";
$lang['reports error too_many_login_attempts']  = "You've made too many attempts to log in too quickly. Please wait %s seconds and try again.";
