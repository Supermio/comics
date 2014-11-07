/**
 * Created by victormanuel on 01/10/2014.
 */
controllers = angular.module('controllers',[]);
controllers.controller('mainCtrl',function($state){

});
controllers.controller('ListaCtrl',function(candidates){
    this.cands = candidates;
});
controllers.controller('OpcionCtrl',function(cand,$scope,Camara,$cordovaBarcodeScanner,$cordovaDialogs){
    this.cand = cand;
    $scope.getPhoto = function() {
        Camara.getPicture({
            quality: 50,
            targetWidth: 320,
            targetHeight: 320,
            saveToPhotoAlbum: false,
            encodingType: Camera.EncodingType.PNG,
            sourceType: Camera.PictureSourceType.CAMERA,
            destinationType: Camera.DestinationType.DATA_URL
            //allowEdit: true
        }).then(function(imageData){
            console.log(imageData);
            //$cordovaDialogs.alert(imageData,'supermio','Hecho');
            $scope.lastPhoto = "data:image/png;base64,"+imageData;
        }, function(err){
            console.err(err);
            $cordovaDialogs.alert('Error:'+err,'supermio','Hecho');
        });
    };
    $scope.getCodigo = function(){
        $cordovaBarcodeScanner
            .scan()
            .then(function(imageData) {
                $cordovaDialogs.alert(imageData.text+"\n"+
                imageData.format);
            }, function(error) {
               $cordovaDialogs.alert(error);
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
