/*Home*/
app.controller('signupCtrl', function ($http, $scope, toaster, $location) {

    /*********************************************** Registeration of User*************************************************/
    $scope.registerData = {};
    $scope.register = function () {
        $http({
            method: 'POST',
            url: api_base_url + '/user/signup',
            data: $.param($scope.registerData),
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        }).then(function (data) {
            // Message displayed to user (account successfully registered)    
            $scope.register_response = data.data.message;
            toaster.pop('success', "", $scope.register_response, null, 'trustedHtml');
            $location.path('/signin');
            $scope.registerData = [];
        }, function (error) {
            toaster.pop('error', "", error.data.email, null, 'trustedHtml');
        });
    };
});
/************************************************************Registration ends here***************************************/
