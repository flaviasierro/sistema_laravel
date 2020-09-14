angular.module("myApp", []);

angular.module("myApp")
.controller('myAppCtrl', ['$scope', myAppCtrl]);

var uId = 0;
function myAppCtrl($scope, $http)
{
    $scope.novoContato = null;
    $scope.contatos = [];

    $scope.success = false;
	$scope.error = false;
	
	$scope.fetchData = function(){
		$http.get('fetch_data.php').success(function(data){
			$scope.namesData = data;
		});
	};
    $scope.salvarContato = function(){
        if($scope.novoContato.id == null ){
            uId = uId + 1;
            $scope.novoContato.id = uId;
            $scope.contatos.push($scope.novoContato);
        }else{
              for(var i in $scope.contatos){
                  if($scope.contatos[i].id == $scope.novoContato.id){
                     $scope.contatos[i] = $scope.novoContato;
                  }
              }
        }
        $scope.novoContato = null;
    }

    $scope.editar = function(id){

        for(var i  in $scope.contatos){
            console.log('testando');
            console.log($scope.contatos[i]);
            if($scope.contatos[i].id == id){
                $scope.novoContato = angular.copy($scope.contatos[i]);
            }
        }
    }

    $scope.deletar = function(id)
    {   
        
        for(var i  in $scope.contatos)
        {
            if($scope.contatos[i].id == id)
            {
                $scope.contatos.splice(i, 1);
                $scope.novoContato = {};
            }
        }
    }

}