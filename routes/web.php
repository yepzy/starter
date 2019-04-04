<?php

// not localized routes ************************************************************************************************
Route::namespace('Utils')->group(function () {
    require('web/utils/seo.php');
    require('web/utils/download.php');
});
// localized routes ****************************************************************************************************
Route::prefix(LaravelLocalization::setLocale())
    ->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])
    ->group(function () {
        // auth ********************************************************************************************************
        Route::namespace('Auth')->group(function () {
            require('web/auth/login.php');
            require('web/auth/password.php');
            // require('web/auth/register.php'); // todo : uncomment if this feature is needed
            // require('web/auth/verification.php'); // todo : uncomment if this feature is needed
        });
        // admin *******************************************************************************************************
        Route::prefix('admin')->namespace('Admin')
            ->middleware([
                'auth',
                // 'verified', // todo : uncomment if this feature is needed
            ])
            ->group(function () {
                require('web/admin/admin.php');
                require('web/admin/dashboard.php');
                require('web/admin/news.php');
                require('web/admin/simplePages.php');
                require('web/admin/settings.php');
                require('web/admin/users.php');
            });
        // front ******************************************************************************************************
        Route::namespace('Front')->group(function () {
            require('web/front/home.php');
            require('web/front/news.php');
            // /!\ any declaration under this one will be lost /!\ *****************************************************
            require('web/front/simplePages.php');
        });
    });
