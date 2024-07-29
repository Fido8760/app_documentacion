<main class="container">
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
                                <h2 class="fw-bold mb-2 text-uppercase">Recuperar Password</h2>
                                <p class="text-white-50 mb-5">Coloca tu nuevo password a continuación</p>
                                <?php if($error) return; ?>
                                <form method="POST" >

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <input type="password" id="typePasswordX" class="form-control form-control-lg" placeholder="Tu nuevo password" name="password" />
                                        <label class="form-label" for="typePasswordX">Nuevo Password</label>
                                    </div>  
                                    
                                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Guardar Nuevo Password</button>
                                </form>
                           
                            </div>
                            <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="/">¿Ya tienes una cuenta? Inicia sesión</a></p>
                        </div> 
                    </div> 
                </div>
            </div>
        </div>
    </section>
</main>