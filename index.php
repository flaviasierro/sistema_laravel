<!DOCTYPE html>
<html lang="pt-br" ng-app="myApp">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!--<script src="app/app.js"></script>-->
    <title>Crud angular js</title>

</head>
<body ng-controller="myAppCtrl">

  <div class="container mt-5" ng-init="fetchData()">
    
    <form class="form-inline ">
        <div class="form-group mx-sm-3 mb-2">
          <label>Nome</label><br>
          <input type="name" class="form-control"  ng-model="name" placeholder="Nome">
        </div>
        <div class="form-group mx-sm-3 mb-2">
          <label>Celular</label><br>
          <input type="text" class="form-control"  ng-model="celular" placeholder="Celular">
        </div>
        <input type="hidden" ng-model="id">
      <button type="submit" class="btn btn-primary mb-2" ng-if="btnName == 'Insert';" value="{{btnName}}" ng-click="insertData()">Confirma</button>
      <button type="submit" class="btn btn-primary mb-2"  ng-if="btnName == 'Update';"value="{{btnName}}" ng-click="updateData()">Atualizar</button>

    </form>'

    <table class="table table-striped mt-4">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Nome</th>
          <th scope="col">Celular</th>
          <th scope="col">Ação</th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="contato in contatos.data">
          <td>{{contato.id}}</td>
          <td>{{contato.name}}</td>
          <td>{{contato.celular}}</td>
          <td>
            <button type="button" class="btn btn-warning btn-sm" ng-click="update_data(contato.id, contato.name, contato.celular)">Editar</button>
            <button type="button" class="btn btn-danger btn-sm" ng-click="delete_data(contato.id)">Deletar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>



</body>
</html>


<script>
 app =  angular.module('myApp', []);
 app.controller('myAppCtrl', function($scope, $http){

$scope.contatos= {};
$scope.btnName = "Insert";
$scope.insertData=function(){      
            $http.post("insert.php", {
                'id':$scope.id,
                'name':$scope.name,
                'celular':$scope.celular
            }).then(function(data){
                    $scope.id = null;
                    $scope.name = null;
                    $scope.celular = null;
                    $scope.btnName = "Insert";
                    $scope.fetchData();
                },function(error){
                    alert("Erro tentar inserir dados");
                    console.error(error);

                });
      }

  $scope.fetchData = function(){
		$http.get('fetch_data.php')
    .then(function(data){
  
      $scope.contatos = data.data;
      console.log($scope.contatos);
		});
	};

  $scope.updateData=function(){      
            $http.post("update.php", {
                'id':$scope.id,
                'name':$scope.name,
                'celular':$scope.celular
            }).then(function(data){
                    $scope.id = null;
                    $scope.name = null;
                    $scope.celular = null;
                    $scope.btnName = "Update";
                    console.log('passou por aqui')
                    $scope.fetchData();
                },function(error){
                    alert("Erro tentar inserir dados");
                    console.error(error);

                });
      }

 $scope.update_data = function(id, name, celular) {
        $scope.id = id;
        $scope.name = name;
        $scope.celular = celular;
        $scope.btnName = "Update";
    }

    $scope.delete_data = function(id) {
        if (confirm("Are you sure you want to delete?")) {
            $http.post("delete.php", {
                    'id': id
                })
                .then(function(data) {
                    console.log(data);
                    $scope.fetchData();
                });
        } else {
            return false;
        }
    }

 })

 

</script>