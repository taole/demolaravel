<html>

<head lang="en">
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Blog</title>
    <script src="assets/lib/jquery-1.9.1.js"></script>
    <script src="assets/lib/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/lib/angular.min.js" type="text/javascript"></script>
    <link href="assets/lib/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
</head>
<body>
<div class="container">

    <div class="wrapper" ng-app="myApp">
        <div ng-controller="myController" id="controller"><br>

            <div ng-repeat="item in data" class="row"><br>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-8">
                            <a href="#" user-link=user/{{item.username}}>{{ item.email }}</a>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary" ng-click="remove(item)">delete</button>
                        </div>
                    </div>
                </div>


            </div>

            <!--container-->

            <section class="page-edit-diadiemhocvo" id="logInForm">
                <form enctype="multipart/form-data" role="form" name="formLogin" method="post" novalidate
                      class="col-md-8">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="User name "
                                       ng-model="user.username" required>
                            </div>
                            <!--Tên võ đường-->

                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="password" ng-model="user.password"
                                       required>
                            </div>
                            <!--Địa chỉ-->
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default" ng-click="postLogin(user)"
                            ng-disabled="formLogin.$invalid">Submit
                    </button>

                </form>
                <pre>form = {{user | json}}</pre>
            </section>
            <!--page-content-->


            <!--container-->

        </div>
    </div>
</div>

<?php
    $token = '';
    if (Session::get('token')) {
        $token = Session::get('token');
    }
?>

<script type="text/javascript">


    var app = angular.module('myApp', []);

    app.controller("myController", function ($scope, $http) {
        var token = "<?php echo $token ?>"
        if (token != '') {
            console.log(token);
            $('#logInForm').hide();
        }
        $scope.data = {};
        var url = "<?php echo route('profile-user') ?>";

        // console.log(url);
        $http.get(url)
            .success(function (data, status, headers, config) {
                $scope.data = data;
            })
            .error(function (data, status, headers, config) {
                // log error
                console.log(status, headers, config);
            });


        $scope.postLogin = function (user) {
            var login = "<?php echo route('account-sign-in-post') ?>";
            $http.post(login, user)
                .success(function (data) {
                    console.log(data);
                    $scope.error = {};
                    $('#logInForm').hide();
                    $http.get(url)
                        .success(function (data, status, headers, config) {
                            $scope.data = data;
                        })
                        .error(function (data, status, headers, config) {
                            // log error
                            $scope.error = data;
                            console.log(data);
                        });


                })
                .error(function (data, status, headers, config) {
                    // log error

                    console.log(status, headers, config);
                });
        };

        //click 
        $scope.remove = function (item) {

            var index = $scope.data.indexOf(item),
                user_id = this.item.id,
                post_link = '/account',
                post_link = post_link + '/' + user_id;

            $('#myModal').modal({
                keyboard: false
            });

            // post delete user 
            $('#delete').click(function () {
                $http.delete(post_link)
                    .success(function (data, status, headers) {
                        $scope.data.splice(index, 1);
                        console.log("delete success ", headers);
                    })
                    .error(function (data, status, headers, config) {
                        // log error
                        console.log(data, status, headers, config);
                    });
            });

            $('#cancel').click(function () {
                $('#myModal').modal('hide');
            });

            /*if (confirm("Are you sure to delete this?")) {
             $scope.data.splice(index, 1);
             }*/

        }


    })
    /*.factory("FooService", function($http, CSRF_TOKEN) {
     console.log(CSRF_TOKEN);
     });*/


</script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                Confirm box
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                Bạn có muốn thực hiện thao tác xóa ?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="delete">Yes</button>
                <button type="button" class="btn btn-primary" id="cancel">No</button>
            </div>

        </div>
    </div>
</div>
<!-- Modal -->

</body>
</html>