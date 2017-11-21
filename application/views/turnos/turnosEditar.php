<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10" style="padding-top: 5px">
	<form id="formTurnos" method="post" action="<?= site_url('turno/atualizar/'.$id)?>">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-5 form-group">
				<label>Nome:</label>
				<input name="nome_turno" class="form-control" placeholder="Nome" value="<?= htmlspecialchars(ucwords($turno->nome_turno))?>">
				<?= form_error('nome_turno') ?>
			</div>
		</div>
		<div class="row" id="turnoCadastrar">
			<div class="col-xs-12 col-sm-12 col-md-12 form-group">
				<button id="btnAdd" type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Adicionar Aula</button>
			</div>
		</div>
		<div id="horarios">

			<?= form_error('horario[]') ?>

			<?php $horarios = set_value('horario'); ?>
			<?php if($horarios != ""): ?>
			<?php for ($i = 0; $i < count($horarios); $i+=2): ?>
					<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-1 form-group">
						<p class="aula"><strong>Aula <?= $index++?></strong></p>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-2 form-group">
						<label >Horário de entrada:</label>
						<input name="horario[<?= $i ?>]" class="form-control hora" type="text" value="<?= $horarios[$i] ?>">
					</div>

				<div class="col-xs-12 col-sm-12 col-md-2 form-group">
					<label >Horário de saída:</label>
					<input name="horario[<?= $i ?>]" class="form-control hora" type="text" value="<?= $horarios[$i+1] ?>">
				</div>
				<div col-md-2 style="padding: 25px 0 0 0;">
					<button id="btnRemove" type="button" class="btn btn-danger add-field"><span class="glyphicon glyphicon-remove"></span></button>
				</div>
			</div>
		<?php endfor;endif; ?>

		<?php var_dump(set_value('horario'))?>
		</div>


		<div class="row">
			<div class="col-md-12 form-group">
				<a class="btn btn-danger active" href="<?= base_url('index.php/Turno')?>" style="float: right;"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>
				<button type="submit" class="btn btn-success active salvar" style="float: right; margin-right: 10px;"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	//var aula = 0;
	var aula = <?= ($horarios != "") ? count($horarios) / 2 : 0 ?>
</script>
