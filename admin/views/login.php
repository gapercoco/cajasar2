<div class="container">
    <form class="form-signin" role="form" method="post" name="loginForm" ng-controller="loginController" ng-submit="login(credentials)" novalidate>
        <h2 class="form-signin-heading">Ingreso al sistema</h2>
        <input type="text" class="form-control" name="username" placeholder="Usuario" ng-model="credentials.username" required autofocus>
        <input type="password" class="form-control" name="password" placeholder="Password" ng-model="credentials.password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
    </form>
    <p>Usuario: admin clave: 12345</p>
</div>

