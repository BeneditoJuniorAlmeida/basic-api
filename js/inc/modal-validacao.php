<!--modal validação-->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalValidacao" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Confirmar usuário</h4>
            </div>
            <div class="modal-body">

                <form method="post" id="form-validar" class="form-horizontal">
                    <input type="hidden" id="id" name="id" value=""/>
                    <div class="form-group">    
                        <label for="usuario" class="col-lg-2 control-label">Usuário</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="senha" class="col-lg-2 control-label">Senha</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" maxlength="8" size="8">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-info" id="btn-verificar" data-dismiss="modal">Verificar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
