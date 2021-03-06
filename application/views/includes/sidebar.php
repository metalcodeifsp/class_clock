
<?php $tipoUsuario = $this->session->userdata('usuario_logado')['tipos']; ?>
<?php $isCoordenador = !is_null(@Pessoa_model::find(@$this->session->userdata('usuario_logado')['id'])->docente->cursos); ?>
<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 sidebar" aria-expanded="false"  id="sidebar">
   <ul class="nav nav-pills nav-stacked">
   <!--
	   <li id="sidebar-home">
		   <a href="">
			   <span class="glyphicon glyphicon-home"></span> <span class="sidebar-label">Home</span>
		   </a>
	   </li>
	-->
	<?php if (podeVer($tipoUsuario,[1, 2])) :?>
		<li id="sidebar-turno">
		   <a href="<?php echo base_url();?>index.php/Turno">
			   <span class="glyphicon glyphicon-time"></span> <span class="sidebar-label">Turnos</span>
		   </a>
	   </li>
	<?php endif; ?>
    
	<?php if (podeVer($tipoUsuario,[1, 2])) :?>
     <li id="sidebar-cursos">
		   <a href="<?php echo base_url();?>index.php/Curso">

			   <span class="glyphicon glyphicon-education"></span> <span class="sidebar-label">Cursos</span>
		   </a>
	   </li>
    <?php endif; ?>
	<?php if (podeVer($tipoUsuario,[1,3,5])) :?>
     <li id="sidebar-classificacao">
		   <a href="<?php echo base_url();?>index.php/classificacao">
			   <span class="glyphicon glyphicon-education"></span> <span class="sidebar-label">Classificação</span>
		   </a>
	   </li>
    <?php endif; ?>
	
	<?php if (podeVer($tipoUsuario,[1,2])) :?>
	   <li id="sidebar-salas">
		   <a href="<?php echo base_url();?>index.php/Tipo_sala">
			   <span class="glyphicon glyphicon-home"></span> <span class="sidebar-label">Salas</span>
		   </a>
	   </li>
	<?php endif; ?>
	
	<?php if (podeVer($tipoUsuario,[1,2])) :?>
	   <li id="sidebar-periodos">
		   <a href="<?php echo base_url();?>index.php/periodo">
			   <span class="glyphicon glyphicon-time"></span> <span class="sidebar-label">Períodos</span>
		   </a>
	   </li>
	<?php endif; ?>

     <?php if (podeVer($tipoUsuario,[1,2])) :?>
     	<li id="sidebar-areas">
		    <a href="<?php echo base_url();?>index.php/area">
			   <span class="glyphicon glyphicon-list"></span> <span class="sidebar-label">Áreas</span>
		    </a>
	    </li>
     <?php endif; ?>
     <?php if (podeVer($tipoUsuario,[1,2])) :?>
	   <li id="sidebar-turmas">
		   <a href="<?php echo base_url();?>index.php/turma">
			   <span class="glyphicon glyphicon-education"></span> <span class="sidebar-label">Turmas</span>
		   </a>
	   </li>
     <?php endif; ?>
     <?php if (podeVer($tipoUsuario,[1,2])) :?>
	   <li id="sidebar-modalidades">
		   <a href="<?php echo base_url();?>index.php/modalidade">
			   <span class="glyphicon glyphicon-education"></span> <span class="sidebar-label">Modalidades</span>
		   </a>
	   </li>
      <?php endif; ?>
	   <!-- <li id="sidebar-funcionarios">
		   <a href="">
			   <span class="glyphicon glyphicon-user"></span> <span class="sidebar-label">Funcionários</span>
		   </a>
	   </li> -->
	   <!-- <li id="sidebar-instituicao">
		   <a href="">
			   <span class="glyphicon glyphicon-briefcase"></span> <span class="sidebar-label">Instituição</span>
		   </a>
	   </li> -->
	   <?php if (podeVer($tipoUsuario,[4])) :?>
		<li id="sidebar-fpa">
			<a href="<?php echo base_url();?>index.php/Fpa">
				<span class="glyphicon glyphicon-duplicate"></span> <span class="sidebar-label">FPA</span>
			</a>
		</li>
	   <?php endif; ?>
	
	<?php if (podeVer($tipoUsuario,[1,3,5])) :?>
    	<li id="sidebar-docente">
		   <a href="<?php echo base_url();?>index.php/ConsultaDocente">
			   <span class="glyphicon glyphicon-duplicate"></span> <span class="sidebar-label">Consulta Docente</span>
		   </a>
		</li>
	<?php endif; ?>
    
	 <?php if (podeVer($tipoUsuario, [1])) :?>
	   <li id="sidebar-pessoa">
		   <a href="<?php echo base_url();?>index.php/pessoa">
			   <span class="glyphicon glyphicon-user"></span> <span class="sidebar-label">Pessoas</span>
       </a>
     </li>
     <?php endif; ?>
     <?php if (podeVer($tipoUsuario,[1,2])) :?>
     	<li id="sidebar-disciplinas">
		   <a href="<?php echo base_url();?>index.php/disciplina">
			   <span class="glyphicon glyphicon-tree-deciduous"></span> <span class="sidebar-label">Disciplinas</span>
		   </a>
	   </li>
    <?php endif; ?>
   </ul>
</div>
