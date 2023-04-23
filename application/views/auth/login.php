     <div class="col-lg-5 d-flex align-items-center justify-content-center mx-auto mt-5">
         <div class="auth-form-transparent text-left p-3 mt-5">
             <div class="brand-logo">
                 <!--<img src="/assets/images/logo.svg">-->
             </div>


             <?php if ($toast) : ?>

                 <div class="alert alert-<?php echo $toast["type"]; ?>" role="alert">
                     <?php echo $toast["message"]; ?>
                 </div>

             <?php endif; ?>

             <div class="modal-content rounded-4 shadow">
                 <div class="modal-header p-5 pb-4 border-bottom-0">
                     <!-- <h1 class="modal-title fs-5" >Modal title</h1> -->
                     <h1 class="fw-bold mb-0 fs-4">Login to your account</h1>

                 </div>

                 <div class="modal-body p-5 pt-0">
                     <form method="post">
                         <input value="<?php echo $security['csrf_hash']; ?>" name="<?php echo $security['csrf_name']; ?>" type="hidden" />
                         <div class="form-floating mb-3">
                             <input name="email" type="email" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com" required>
                             <label for="floatingInput">Email address</label>
                         </div>
                         <div class="form-floating mb-3">
                             <input name="password" type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password" required>
                             <label for="floatingPassword">Password</label>
                         </div>
                         <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Login</button>
                         <small class="text-muted">By clicking Sign up, you agree to the <a href="/about/terms">terms of use</a>.</small>

                     </form>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-lg-6 login-half-bg d-flex flex-row">

     </div>