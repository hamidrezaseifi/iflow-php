/**
 * 
 */


var iflowApp = angular.module('iflowApp', ['ngAnimate', 'ngMaterial', 'ngCookies']);


iflowApp.config(appconfig);
function appconfig($httpProvider){
    $httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    $httpProvider.defaults.headers.common['X-CSRF-Token'] = $('meta[name="csrf-token"]').attr('content');
}

iflowApp.controller('BodyController', function ($scope, $http, $sce, $element, $mdSidenav, $cookies) {

	  //$scope.phones = [];
	
	
});
