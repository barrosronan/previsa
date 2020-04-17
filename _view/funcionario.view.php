<main class="container">
    
    <div class="message-box info-delete" style="display:none; max-width: 1096px"></div>

    <div class="form-modal modal-funcionario" style="display:none;">

        <div class="form-modal modalfilho" style="display: none;">
            <form action="" class="form form-border form-shadow" name="cadfilho" data-action="createfilho" style="background: #fff; max-width: 720px; margin: 100px auto; display: none;">
                <div class="form-header">
                    <h4>Cadastro de filho</h4>
                    <span class="close">&times;</span>
                </div>
                <div class="form-container">
                    <div class="message-box info-filho" style="display:none;"></div>
                    <div class="row">
                        <div class="col col-12">
                            <label for="" class="label-control">Nome</label>
                            <input type="text" name="nomefilho" id="nomefilho" class="control">
                            <small class="alert">Informe o nome do funcionário.</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-5">
                            <label for="" class="label-control">Data de nascimento</label>
                            <input type="text" name="datanascimentofilho" id="datanascimentofilho" class="control" maxlength="10">
                            <small class="alert">Informe o nome do funcionário.</small>
                        </div>
                    </div>
                </div>
                <div class="form-footer">
                    <input type="hidden" name="codfilho" id="codfilho">
                    <button class="bt bt-success">Salvar</button>
                </div>
            </form>
        </div>

        <form action="" class="form form-border form-shadow" name="cadFuncionario" data-action="create" style="display:none"> 
            <div class="form-header">
                <h4 class="form-title">Cadastro de funcionário</h4>
                <span class="close">&times;</span>
            </div>

            <div class="form-container">

                <div class="message-box msgcreate"></div>

                <div class="row">
                    <div class="col col-2">
                        <label for="" class="label-control text-right">Nome</label>
                    </div>
                    <div class="col col-10">
                        <input type="text" name="nomeFuncionario" id="nomeFuncionario" class="control">
                        <small class="alert">Informe o nome do funcionário.</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-2">
                        <label for="" class="label-control text-right">Data de nascimento</label>
                    </div>
                    <div class="col col-3">
                        <input type="text" name="dataNascimentoFuncionario" id="dataNascimentoFuncionario" class="control" maxlength="10">
                        <small class="alert">Informe uma data de nascimento.</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-2">
                        <label for="" class="label-control text-right">Salário</label>
                    </div>
                    <div class="col col-3">
                        <input type="text" name="salarioFuncionario" id="salarioFuncionario" class="control" maxlength="21">
                        <small class="alert">Informe o salário do funcionário.</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-2">
                        <label for="" class="label-control text-right">Atividades</label>
                    </div>
                    <div class="col col-10">
                        <textarea name="atividadesFuncionario" id="atividadesFuncionario" cols="30" rows="10" class="control text-area resize-v"></textarea>
                        <small class="alert">Informe as atividades do funcionário.</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-12">
                        <fieldset style="padding: 0 20px 10px; border-color: #ccc">
                            <legend>Filhos</legend>
                            <div class="row">
                                <div class="col col-12">
                                    <!-- Tabela de filhos -->
                                    <table class="table table-border-line tableFilho">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Data de nascimento</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <div class="col col-12 text-center loader">
                                        <img src="<?=SITE_URL?>/imagens/loader.gif">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-12" style="padding: 0 20px">
                                    <button type="button" class="bt bt-success novofilho">Novo filho</button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>

            </div>

            <div class="form-footer">
                <div class="row">
                    <div class="col col-12">
                        <input type="hidden" name="codfunc" id="codfunc" value="">
                        <button class="bt bt-success">Salvar</button>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <h3 style="height: 70px; padding: 20px">Sistema de teste</h3>
    
    <form action="" style="border: 1px solid #ccc; margin: 0 20px" name="pesquisa">
        <div class="form-container">
            <div class="row">
                <div class="col col-2">
                    <label for="" class="label-control">Nome do funcionário </label>
                </div>
                <div class="col col-5">
                    <input type="text" class="control" name="pesquisa">
                </div>
                <div class="col col-5">
                    <button type="text" class="bt bt-primary">Pesquisa</button>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col col-12" style="padding: 10px 20px">
            <!-- Tabela de funcionários -->
            <table class="table table-border-line tableFuncionario" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data de nascimento</th>
                        <th>Número de filhos</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>                                        
                </tbody>
            </table>
            <div class="col col-12 text-center loader" style="display: none">
                <img src="<?=SITE_URL?>/imagens/loader.gif">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col col-12" style="padding: 0 20px">
            <button type="button" class="bt bt-success novofuncionario">Novo funcionário</button>
        </div>
    </div>
</main>
