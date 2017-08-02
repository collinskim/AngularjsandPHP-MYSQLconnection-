<!DOCTYPE html>
<html>
<head>
	<title>TRY</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
  	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
  	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
</head>
<body style="background-image: url(watch.jpg); background-size: cover;background-repeat: no-repeat; color: #fbff00;">
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h3 style="text-align: center;">INSERT, UPDATE AND DELETE</h3>
			<div ng-app="myapp" ng-controller="controller" ng-init="show_data()">
				<label>Name</label>
				<input type="text" ng-model="name" name="name" class="form-control">
				<br>
				<label>Email</label>
				<input type="text" ng-model="email" name="email" class="form-control">
				<br>
				<label>Age</label>
				<input type="number" ng-model="age" name="age" class="form-control">
				<br>
				<input type="hidden" ng-model="id">
				<input type="submit" name="insert" class="btn btn-primary" ng-click="insert()" value="{{btnname}}">
			</div>
		</div>
		<div class="col-md-6">
			<table class="table table-bordered">
				<tr>
					<th>S.No</th>
					<th>Name</th>
					<th>Email</th>
					<th>Age</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
				<tr ng-repeat="x in names">
					<td>{{x.id}}</td>
					<td>{{x.name}}</td>
					<td>{{x.email}}</td>
					<td>{{x.age}}</td>
					<td>
						<button class="btn btn-success btn-xs" ng-clck="update.data(x.id, x.name, x.email, x.age)">
							<span>Edit</span>
						</button>
					</td>
					<td>
						<button class="btn btn-danger btn-xs" ng-click="delete.data(x.id)">
							<span>Delete</span>
						</button>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<script>
		var app = angular.module("myapp", []);
		app.controller("controller", function ($scope, $http) {
			$scope.btnname = "insert";
			$scope.insert = function () {
				if ($scope.name == null) {
					alert("enter your name");
				}
				else if ($scope.email == null) {
					alert("enter your email");
				}
				else if ($scope.age == null) {
					alert("enter your age");
				}
				else {
					$http.post(
						"insert.php", {
							'name': $scope.name,
							'email': $scope.email,
							'age': $scope.age,
							'btnname': $scope.btnname,
							'id': $scope.id
						}
					)
					.then(function (data) {
						alert(data);
						$scope.name = null;
						$scope.email = null;
						$scope.age = null;
						$scope.btnname = "insert";
						$scope.show_data();
					});
				}
			}
			$scope.show_data = function () {
				$http.get("display.php")
					.then(function (data) {
						$scope.names = data;
					});
			}
			$scope.update_data = function (id, name, email, age) {
				$scope.id = id;
				$scope.name = name;
				$scope.email = email;
				$scope.age = age;
				$scope.btnname = "update";
			}
			$scope.delete_data = function (id) {
				if (confirm("are you sure you want to delete")) {
					$http.post("delete.php",{
						'id': id
					})
					.success(function (data) {
						alert(data);
						$scope.show_data();
					});
				}
				else{
					return false;
				}

			}
		});
	</script>
</div>

</body>
</html>