# CI3 Email Finance System (ci3-email-finance-system)

<a name="toc"></a>
## TABLE OF CONTENTS
* [Introduction](#introduction)
* [(Not) Modular](#not-modular)
* [Base Classes](#base-classes)
  * [MY\_controller](#my-controller)
  * [Public\_controller](#public-controller)
  * [Private\_controller](#private-controller)
  * [Admin\_controller](#admin-controller)
  * [API\_controller](#api-controller)
  * [Understanding Includes](#understanding-includes)
* [Core Files](#core-files)
  * [Core Config](#core-config)
  * [Core Language](#core-language)
  * [Core Helper](#core-helper)
* [Internationalization](#i18n)
  * [Jsi18n Library](#jsi18n-library)
* [User Management](#user-management)
* [Settings](#settings)
* [Themes](#themes)
  * [Theme Functions](#theme-functions)
* [APIs](#apis)
* [System Requirements](#system-requirements)
* [Installation](#installation)
* [Updates](#updates)
* [Conclusion](#conclusion)
* [What's New](#whats-new)
* [Fork It!](#forkit)

<a name="introduction"></a>
## INTRODUCTION

This site is based around the CI3-Firster-Starter framework that sets a good base for developing and utilizing other tools such as the Twitter bootstrap seen throughout this site. I encourage you to look at the Email Finance System more closely. 

CI3 Fire Starter is a CodeIgniter3 skeleton application that includes [jQuery](https://jquery.com/) and [Twitter Bootstrap](http://getbootstrap.com/). It is intended to be light weight, minimalistic and not get in your way of building great CodeIgniter 3 applications. It is also intended for new CodeIgniter developers who want a simple, easy platform for learning the framework.

* CodeIgniter 3.x
* Base controllers for Public, Private, Admin and API classes
* Internationalization (translations) support
    + Jsi18n Library to support internationalization in your JS files
* The latest version of [jQuery](https://jquery.com/)
* The latest version of [Twitter Bootstrap](http://getbootstrap.com/)
* The latest version of [Font Awesome](https://fortawesome.github.io/Font-Awesome/)
* Independent responsive admin and frontend themes
* [Summernote](http://summernote.org/ "Summernote") WYSIWYG editor
* Auto-loaded core config file
* Auto-loaded core language file (based on selected language)
* Auto-loaded core helper files
    + Human-readable JSON string output for API functions
    + Array to CSV exporting
    + Enhanced CAPTCHA
    + Random password generator
    + Available languages fetcher
* Simple user authentication with registration, forgot password and profile editor
* Contact Us page with enhanced CAPTCHA
* Basic admin tool with dashboard, user management, settings and Contact Us message list
* File-based sessions

I hope you find this finance system useful. 

Want to code your own project? Then fork Jason Baier's ci3-fire=starter **Please [fork it on Github](https://github.com/JasonBaier/ci3-fire-starter/fork "Fork It")
and help make it better!**

NOTE: This documentation assumes you are already familiar with PHP and CodeIgniter. To learn more about PHP,
visit [php.net](http://php.net/). If you need to learn more about CodeIgniter, visit the
[CodeIgniter User Guide](http://www.codeigniter.com/userguide3/index.html).


<a name="forkit"></a>
## FORK IT!

**Please [fork CI3 Fire Starter on Github](https://github.com/JasonBaier/ci3-fire-starter/fork "Fork It")
and help make it better!**
