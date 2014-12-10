'use strict';

angular.module('angularjsAuthTutorialApp')
	// leave this as the top controller for always! stores current user data
	// and all other controllers are then able to inherit from this as well
	// as modify its data.
    // Also, inject 'UserDataService'
    .controller('TopLevelAppCtrl', ['$scope', 'UserDataService', function ($scope, UserDataService) {

    	// only vars defined on $scope will be inherited
		//$scope.testVar = 'I was inherited';

        // Add $scope variable to store the user
        $scope.currentUser = UserDataService.getCurrentUser();

    }])
    .controller('NavigationCtrl', ['$scope', function($scope) {

        $scope.hasUser = false;

        $scope.$watch('currentUser', function(newValue, oldValue) {

        	// equivalent of if(newValue != false){ return true; }. whodathunk.
            $scope.hasUser = !!newValue;
        })
    }])
	.controller('MainCtrl', ['$scope', function ($scope) {
	        
	}])
	.controller('LoginCtrl', ['$scope', '$location', 'UserEventsService', function($scope, $location, UserEventsService) {

        $scope.$on(UserEventsService.login.loginSuccess, function(e, userDataObj) {

        	$scope.$parent.currentUser = userDataObj;
            $location.url('/');
        });

    }])
	.controller('LogoutCtrl', ['$scope', '$location', 'UserEventsService', function($scope, $location, UserEventsService) {

        $scope.$on(UserEventsService.logout.logoutSuccess, function(e, userDataObj) {

            // is this supposed to be false instead of userDataObj?
            $scope.$parent.currentUser = userDataObj;
            $location.url('/');
        });
    }])
	.controller('UserInfoCtrl', ['$scope', 'getUserData', function($scope, getUserData) {
		$scope.userData = getUserData;
    }])
    ;
;
