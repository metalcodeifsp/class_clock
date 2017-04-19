

				<div id="content" class="col-md-10">
					<?php if ($this->session->flashdata('success')) : ?>
            <!-- Alert de sucesso -->
            <div class="text-center alert alert-success" role="alert">
              <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
              <span class="sr-only">Succes:</span>
              <?= $this->session->flashdata('success') ?>
            </div>
          <?php elseif ($this->session->flashdata('danger')) : ?>
            <!-- Alert de erro -->
            <div class="text-center alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only">Error:</span>
              <?= $this->session->flashdata('danger') ?>
            </div>
					<?php endif; ?>

					<?php if (validation_errors()): ?>
						<div class="alert alert-danger text-center">
							<p><?= $this->session->flashdata('formDanger') ?></p>
							<?= validation_errors() ?>
						</div>
					<?php endif; ?>

					<h1>Turmas</h1>

					<!-- Lista de 'botoes' links do Bootstrap -->
					<ul class="nav nav-pills">
						<!-- 'botao' link para a listagem -->
						<li class="active"><a data-toggle="pill" href="#list">Listar todas</a></li>
						<!-- 'botao' link para novo registro -->
						<li><a data-toggle="pill" href="#new">Cadastrar</a></li>
					</ul>

					<!-- Dentro dessa div vai o conteúdo que os botões acima exibem ou omitem -->
					<div class="tab-content">

						<!-- Aqui é a Listagem dos Itens -->
						<div id="list" class="tab-pane fade in active">
							<div style="margin-top: 25px;">
								<table id="turmaTable" class="table table-striped">
								<thead>
									<tr>
										<th>Nome</th>
										<th>Disciplina</th>
										<th>Qtd. Alunos</th>
										<th>Turma DP</th>
										<th>Status</th>
										<th>Ação</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($turmas as $turma): ?>
											<?= ($turma['status'] ? '<tr>' : '<tr class="danger">') ?>
												<td><?= $turma['nome']?></td>
												<td><?= $turma['disciplina']?></td>
												<td><?= $turma['qtdAluno']?></td>
												<td><?= $turma['dp']?></td>
												<td><?php if($turma['status']): echo "Ativo"; else: echo "Inativo"; endif;?></td>
												<td>
													<?php if ($turma['status']): ?>
														<button type="button" class="btn btn-warning" title="Editar" data-toggle="modal" data-target="#exampleModal"  data-whateverdisciplina="<?= $turma['disciplina']?>" data-whateverid="<?= $turma['id']?>"  data-whatevernome="<?= $turma['nome']?>"  data-whateverqtdAluno="<?= $turma['qtdAluno']?> data-whateverdp="<?= $turma['dp']?>"><span class="glyphicon glyphicon-pencil"></span></button>
														<button onClick="disable(<?= $turma['id']?>)" type="button" class="btn btn-danger delete" title="Desativar"><span class="glyphicon glyphicon-remove"></span></button>
													<?php else : ?>
														<button onClick="able(<?= $turma['id']?>)" type="button" class="btn btn-success delete" title="Ativar"><span class="glyphicon glyphicon-ok"></span></button>
													<?php endif; ?>

												</td>
											</tr>
									<?php endforeach;?>
								</tbody>
							</table>
							</div>
						</div>

						<!-- Aqui é o formulário de registro do novo item-->
						<div id="new" class="tab-pane fade">
							<h3>Cadastrar Turmas</h3>
							<form action="" method="post">
							
							<div class="form-group">
									<label>Nome</label>
									<input type="text" class="form-control" name="nome" placeholder="Nome" maxlength="10" value="<?= set_value('nome')?>">
									<?= form_error('nome') ?>
								</div>
								
								<div class="form-group">
                                    <label>Curso</label>
                                    <!-- DropListDisciplina (Droplist) -->
                                    <div class="form-group percent-15">
                                        <div id="u1" class="ax_default droplist" data-label="DropListDisciplina">
                                          <?= form_dropdown('disciplina',$disciplina,set_value('disciplina'),array('class'=>'form-control')) ?>
                                          <?= form_error('disciplina') ?>
                                        </div>
                                    </div>
                                </div>
								
								<div class="form-group">
									<label>Quantidade de Alunos</label>
									<input type="text" maxlength="3" pattern="[0-9]+$" class="form-control percent-5" name="qtdAluno" placeholder="ex: 30" value="<?= set_value('qtdAluno')?>">
									<?= form_error('qtdAluno') ?>
								</div>
								<div class="form-group">
									<input id="dp" type="checkbox" name="dp" class="form-group" value="true"/>
									<label for="dp">Cursando Dependência</label>
								</div
								<div class="inline">
									<button type='submit' class='btn bt-lg btn-primary'>Cadastrar</button>
								</div>
							</form>
						</div>

					</div><!--fecha tab-content-->

				</div><!--Fecha content-->

			</div><!--Fecha row-->

			<!-- Aqui é o Modal de alteração das Turmas-->
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="exampleModalLabel">Turmas</h4>
						</div>
						<div class="modal-body">
							<?= form_open('Turma/atualizar') ?>
								<div class="form-group">
									<input type="hidden" name="recipient-id" id="recipient-id">
								</div>
								
								<div class="form-group">
									<label for="nome-name" class="control-label">Nome:</label>
									<input type="text" class="form-control" name="recipient-nome" id="recipient-nome" maxlength="10">
									<?= form_error('recipient-nome') ?>
								</div>
								
								   <!-- DropListDisciplina (Droplist) -->
                                <div class="form-group percent-40 inline">
                                    <label for="disciplina-name" class="control-label">Curso:</label>
                                  <?= form_dropdown('disciplina',$disciplina,null,array('class'=>'form-control')) ?>
                                  <?= form_error('disciplina') ?>
                                </div>
														
								
								
								<div class="form-group">
									<label for="qtd-aluno" class="control-label">Quantidade de Alunos:</label>
									<input type="text" maxlength="3" pattern="[0-9]+$"  class="form-control percent-10" name="recipient-qtd-aluno" id="recipient-qtd-aluno">
									<?= form_error('recipient-qtd-aluno') ?>
								</div>
								
								<div class="form-group">
									<input type="checkbox" name="recipient-dp" value="true" class="form-group" id="recipient-dp"/>
									<label for="recipient-dp">Cursando Dependência</label>
								</div>
								
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary">Alterar</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

