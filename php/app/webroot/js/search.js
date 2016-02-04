/**
 * Created by lucasesteban on 19/11/15.
 */
angular.module('app', [])

// Unlike BadController, GoodController1 and GoodController2 will not fail to be instantiated,
// due to using explicit annotations using the array style and $inject property, respectively.
    .controller('searchCtrl', ['$scope', function($scope) {
        $scope.origine = 0;
        $scope.cepage = 0;
        $scope.recherche="";

        $scope.isSearchedClient = function(nom,prenom,login,societe) {
            alert(nom);
            if((nom.indexOf($scope.recherche)>-1) /*|| (prenom.indexOf($scope.recherche)>-1) || (login.indexOf($scope.recherche)>-1) || (societe.indexOf($scope.recherche)>-1)*/) {
                return true;
            }
        };


        $scope.isSearched = function (cepage,origine) {
            alert(cepage);
            return (($scope.origine==0 || $scope.origine==origine) && ($scope.cepage==0 || $scope.cepage==cepage));
        }

    }]);