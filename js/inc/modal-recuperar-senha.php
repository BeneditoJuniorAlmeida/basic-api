<!-- Modal recuperar senha -->
<div aria-hidden="true" id="recuperarSenha" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Informe seu email</h4>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-redefinir" class="form-horizontal">
                    <div class="form-group">
                        <label for="email" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email de recuperação">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-info" data-dismiss="modal" id="btn-redefinir">Ok</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
