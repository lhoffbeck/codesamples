'use strict';

angular
    .module('angularjsAuthTutorialApp', [
        'ngCookies',
        'ngResource',
        'ngSanitize',
        'ngRoute',
        'dfUserManagement'
    ])

    // add DSP constants (necessary to connect to DreamFactory)
    .constant('DSP_URL', 'YOUR_URL_GOES_HERE')
    .constant('DSP_API_KEY', 'YOUR_API_KEY_HERE')

    // configure the AngularJS $httpProvider to use the dreamfactory header
    .config(['$httpProvider', 'DSP_API_KEY', function($httpProvider, DSP_API_KEY) {

        // set default headers for http requests
        $httpProvider.defaults.headers.common['X-DreamFactory-Application-Name'] = DSP_API_KEY;
    }])

    .config(function ($routeProvider) {
        $routeProvider
            .when('/', {
                templateUrl: 'views/main.html',
                controller: 'MainCtrl'
            })
            .when('/login', {
                templateUrl: 'views/login.html',
                controller: 'LoginCtrl'
            })
            .when('/logout', {
                templateUrl: 'views/logout.html',
                controller: 'LogoutCtrl'
            })
            .when('/user-info', {
                templateUrl: 'views/user-info.html',
                controller: 'UserInfoCtrl',
                // resolve helps protect routes. resolve property can run
                // functions before a route resolves
                resolve: {  
                    getUserData: ['$location', 'UserDataService', function($location, UserDataService) {

                        if (!UserDataService.getCurrentUser()) {
                            $location.url('/login')
                        }else {
                            return UserDataService.getCurrentUser();
                        }
                    }]
                }
            })
            .otherwise({
                redirectTo: '/'
            });
    });
