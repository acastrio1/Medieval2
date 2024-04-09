<?php

if(isset($_SESSION['usuario'])==TRUE) {
  if( $_SESSION['last_activity'] < time()-$_SESSION['expire_time'] ) { //se ha acabado el tiempo?
      session_destroy();
      unset($_SESSION['usuario']);
      header("Location: Home.php");
  } else{ 
  $_SESSION['last_activity'] = time(); //renueve el tiempo
}
}
//Si la sesión ha sido cerrada (linea 56), el atributo Logout de session será 1 o TRUE y entrará al código, el cual destruye la sesión, quita el valor de usuario y carga el home
if(isset($_GET['logout'])) {

    session_destroy();
    unset($_SESSION['usuario']);
    header("Location: Home.php");
}

include "layout/header.php";
?>



    <!-- Login section -->
    <section class="h-100 gradient-form bg-paleta1">
        <div class="container py-5 h-50">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
              <div class="card rounded-3 text-black">
                <div class="row g-0">
                  <div class="col-lg-6">
                    <div class="card-body p-md-5 mx-md-4">
      
                      <div class="text-center">
                        <img src="../assets/img/icons8-medieval-62.png"
                          style="width: 62px;" alt="logo">
                        <h4 class="mt-1 mb-2 pb-1">Somos Medieval</h4>
                      </div>
                      <form method="post" action="../controller/login_register.php" id="login">
                        <p>Por favor ingrese a su cuenta</p>

                        <div class="form-outline mb-2">
                          <input type="email" id ="email" name="email" class="form-control" placeholder="correo electronico" />
                        </div>
      
                        <div class="form-outline mb-2">
                          <input type="password" id = "password" name="password" class="form-control" placeholder="Contraseña" />
                        </div>
                        
                        <div class="text-center pt-1 mb-1 pb-1">
                          <input id="submitButton" type="submit" class="btn btn-primary btn-block fa-lg mb-1 bg-paleta5" value="Login" name="login_usuario">
                        </div>
                        <!-- Muestra el array de errores si hay algún problema -->
                        <?php 
                          if (isset($_SESSION['error'])): ?>
                            <div class="errores">
                                <?php foreach($_SESSION['error'] as $error) : ?>
                                    <p><?php echo $error ?></p>
                                <?php endforeach ?>
                            </div>
                        <?php 
                        $_SESSION['error'] = array(); //Limpia el vector de errores después de mostrarlos
                        endif ?>
                        <!--************************************************* -->  
                        <div class="text-center pt-0 mb-2 pb-1">
                          <a class="text-muted mb-1" href="#!">Olvido su contraseña?</a>
                        </div>
                        <div class="text-center pt-0 mb-2 pb-1">
                          <a class="text-muted mb-1" href="registrar.php">No tiene una cuenta?</a>
                        </div>
                      
                      </form>
      
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                      <h4 class="mb-4">Viste como siempre lo soñaste</h4>
                      <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div class="clear" style='height: 60px'></div>
<?php include "layout/footer.php"; ?>