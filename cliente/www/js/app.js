// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
var app = angular.module('starter', [
    'ionic',
    'ngCordova',
    'services',
    'controllers']);

app.run(function($ionicPlatform,$cordovaSplashscreen) {
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if(window.cordova && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();
    }
  });
  setTimeout(function(){$cordovaSplashscreen.hide()},5000);
});

app.config(function($stateProvider,$urlRouterProvider){
    $urlRouterProvider.otherwise('/login');
    $stateProvider.state('login',{
        url:'/login',
        templateUrl:'login.html',
        controller:'LoginCtrl as login',
        onEnter: function(){
            console.log("Estoy en el estado Login");
        }
    });
    $stateProvider.state('app',{
        abstract:true,
        templateUrl: 'main.html',
        controller: 'mainCtrl as main',
        onEnter: function(){
            console.log("Estoy en el estado app")
        }
    });
    $stateProvider.state('app.lista',{
        abstract:true,
        url: '/lista',
        views: {
            lista: {
                template: '<ion-nav-view animation="slide-left-right"></ion-nav-view>'
            },
            estado: {
                templateUrl:'estado.html'
            }
        },
        onEnter: function(){
            console.log("Estoy en el estado app.lista")
        }
    });
    $stateProvider.state('app.lista.index',{
        url:'',
        templateUrl: 'lista.html',
        controller: 'ListaCtrl as lista',
        resolve: {
            candidates: function(PartidosService){
                return PartidosService.getCands();
            }
        },
        onEnter: function(){
            console.log("Estoy en el esado app.lista.index")
        }
    });
    $stateProvider.state('app.lista.opcion',{
        url:'/:candId',
        templateUrl:'opcion.html',
        controller:'OpcionCtrl as opcion',
        resolve:{
            cand: function(PartidosService,$stateParams){
                return PartidosService.getCand($stateParams.candId);
            }
        },
        onEnter: function(){
            console.log("Estoy en el esado app.lista.opcion")
        }
    })
});