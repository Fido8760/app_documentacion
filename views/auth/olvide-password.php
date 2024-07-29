<div class="container">
    <div class="row justify-content-center">
        <div class="col-5">
        <?php  
            include_once __DIR__ . "/../template/alertas.php";
        ?>
        </div>
    
    </div>
</div>
<section class="gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <div class="mb-md-5 mt-md-4 pb-5">
                            <h2 class="fw-bold mb-2 text-uppercase">Reestablecer Password</h2>
                            <p class="text-white-50 mb-5">Escribe tu correo con el que estás registrado para recibir las instrucciones de recuperación por E-Mail</p>
                            <form action="/olvide" method="POST" >

                                <div data-mdb-input-init class="form-outline form-white mb-4">
                                    <input type="email" id="typeEmailX" class="form-control form-control-lg" placeholder="Escribe tu email" name="email" />
                                    <label class="form-label" for="typeEmailX">Email Registrado</label>
                                </div>  
                                
                                <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="/">¿Ya tienes una cuenta? Inicia sesión</a></p>
                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Enviar Instrucciones</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>