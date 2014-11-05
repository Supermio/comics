/**
 * Created by victormanuel on 01/10/2014.
 */
var services = angular.module('services',[]);

services.service('Camera',['$q',function($q,$cordovaCamera){
    return {
        getPicture: function(){
            var q = $q.defer();
            var options = {
                quality : 100,
                allowEdit : false,
                targetWidth: 200,
                targetHeight: 200,
                saveToPhotoAlbum: false
            };

            $cordovaCamera.getPicture(options).then(
                function(result){
                    q.resolve(result);
                },
                function(err){
                    q.reject(err);
                }
            );
            return q.promise;
        }
    }
}]);
services.service('PartidosService',function($q){
    return {
        cands: [
            {
                id:'1',
                nombre:'Enrique Cornejo',
                partido:'APRA',
                tipo: 'Partido'
            },
            {
                id:'2',
                nombre:'Susana Villaran',
                partido:'Dialogo Vecinal',
                tipo: 'Independiente'
            },
            {
                id:'3',
                nombre: 'Salvador Heresi',
                partido:'Perú Patria segura',
                tipo:'independiente'
            },
            {
                id:'4',
                nombre: 'Enrique Ocrospoma',
                partido:'PPC',
                tipo:'partido'
            },
            {
                id:'5',
                nombre: 'Fernan Altuve',
                partido:'Vamos Perú',
                tipo:'independiente'
            }
        ],
        getCands: function(){
            return this.cands;
        },
        getCand: function(candId){
            var dfd = $q.defer();
            this.cands.forEach(function(cand){
                if (cand.id === candId) dfd.resolve(cand)
            })
            return dfd.promise;
        }
    }
})
