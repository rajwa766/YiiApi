var app = angular.module('cleaner', ['ngRoute', 'ngSanitize', 'ui.select', 'toaster', 'angular-loading-bar', 'angularMoment', 'ui.bootstrap', 'ngCookies', 'ngAnimate', 'ngRateIt', 'oc.lazyLoad', 'ui.router', 'ngFileUpload', 'checklist-model']);

// var site_url = document.location.origin;
// if (site_url === 'http://cleaner.dev')
//     site_url = 'http://project-demos.com/repair';
// var api_base_url = "http://blakbronco.com/demo/cleaner1/api/web/v1";
var api_base_url = "http://blakbronco.com/demo/cleaner1/api/web/v1";


app.run(function ($rootScope, $compile, $location, $http, toaster, $cookies, $window) {
    // $rootScope.api_img_url = "http://blakbronco.com/repair/common/upload/";
    $rootScope.api_img_url = "http://blakbronco.com/demo/cleaner1/common/upload/";

    $rootScope.web_url = "http://localhost/YiiApi/frontend";
    // $rootScope.web_url = "http://blakbronco.com/demo/cleaner1/frontend";

    if ($cookies.get('auth_token') && $cookies.get('id') && $cookies.get('role')) {
        //console.log("Successfully Getting Aut role status and ID");
        $rootScope.auth_token = $cookies.get('auth_token');
        $rootScope.id = $cookies.get('id');
        $rootScope.role = $cookies.get('role');
        $rootScope.payment = $cookies.get('payment');
        $rootScope.is_loggedin = true;
    } else {
        //console.log('No cookie found');
    }
    $rootScope.logout = function () {
        $window.location.reload();
        $cookies.remove('auth_token');
        $cookies.remove('id');
        $cookies.remove('role');
        $cookies.remove('payment');
        $location.path('/login');
        //console.log("Logout Successfully");

        $rootScope.auth_token = $cookies.get('auth_token');
        $rootScope.role = $cookies.get('role');
        $rootScope.status = $cookies.get('status');
        $rootScope.id = $cookies.get('id');
        $rootScope.payment = $cookies.get('payment');
        $rootScope.is_loggedin = false;
    };

});
app.config(['$stateProvider', '$httpProvider', '$locationProvider', '$urlRouterProvider', '$controllerProvider', '$compileProvider', '$filterProvider', '$provide', '$ocLazyLoadProvider', '$qProvider',
    function ($stateProvider, $httpProvider, $locationProvider, $urlRouterProvider, $controllerProvider, $compileProvider, $filterProvider, $provide, $ocLazyLoadProvider, $qProvider) {

        app.controller = $controllerProvider.register;
        app.directive = $compileProvider.directive;
        app.filter = $filterProvider.register;
        app.factory = $provide.factory;
        app.service = $provide.service;
        app.constant = $provide.constant;
        app.value = $provide.value;

        $qProvider.errorOnUnhandledRejections(false);

    }
]);