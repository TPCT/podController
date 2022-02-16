<div class="d-flex h-100 justify-content-center align-items-center">
    <div class="container d-sm-flex bg-dark d-block justify-content-center align-items-center pt-4 flex-wrap">
            <div class="p-2 col-lg-3 d-flex justify-content-center">
                <div class="toast show d-flex flex-column">
                    <div class="toast-header justify-content-center">
                        <span class="text-center">تسجيل دخول</span>
                    </div>
                <div id="loginContainer" class="toast-body h-100 d-flex flex-column">
                    <form method="POST" id="login" action="javascript:void(0)" onsubmit="login()">
                        <div class="input-group mb-3">
                            <input id="username" name="username" form="login" type="text" class="form-control" required="">
                            <span class="input-group-text col-5">اسم المستخدم</span>
                        </div>
                        <div class="input-group mb-3">
                            <input id="password" name="password" form="login" type="password" class="form-control" required="">
                            <span class="input-group-text col-5">كلمه المرور</span>
                        </div>    
                        <input type="hidden" id="g-token"/>
                        <input id="submit" type="submit" class="mt-auto btn btn-primary w-100" value="تسجيل" form="login">       
                    </form>                  
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/assets/js/auth-layout/login.js"></script>