/**
 * Created by victormanuel on 01/10/2014.
 */
controllers = angular.module('controllers',[]);
controllers.controller('mainCtrl',function($state){

});
controllers.controller('ListaCtrl',function(candidates){
    this.cands = candidates;
});
controllers.controller('OpcionCtrl',function(cand,$scope,$cordovaCamera){
    this.cand = cand;
    $scope.getPhoto = function() {
        alert('Voy a tomar foto');

        $cordovaCamera.getPicture(options).then(function(imageData) {
            alert('Foto ok'+imageData);
            console.log(imageData);
            $scope.lastPhoto= imageData;

        }, function(err) {
            alert('Foto ko');
            console.err(err);
        });

    };
});
controllers.controller('Base',function(){

});
controllers.controller('LoginCtrl',function($state){
    this.ingresar = function(){
        $state.go('app.lista.index');
    };
});
