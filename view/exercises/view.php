<?php
//file: view/exercises/view.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$exercise = $view->getVariable("exercise");
$tables = $view->getVariable("tables");
$view->setVariable("title", i18n("GesGym - View Exercise"));
$view->setVariable("header", i18n("View Exercise"));
?>
			<b><?=i18n("Name")?>:</b>
			<input disabled type="text" class="form-control" placeholder="<?=i18n("Name")?>" value="<?=$exercise->getExerName()?>"/>
			<b><?=i18n("Type")?>:</b>
			<input disabled type="text" class="form-control" placeholder="<?=i18n("Type")?>" value="<?php if($exercise->getExerTipo() == "cardio"){print i18n("Cardio");}
																										  if($exercise->getExerTipo() == "musculacion"){print i18n("Muscle Training");}
																										  if($exercise->getExerTipo() == "estiramiento"){print i18n("Stretching");} ?>"/>
			<b><?=i18n("Description")?>:</b>
			<textarea disabled type="text" rows="5" class="form-control" name="tableDescripcion"> <?=$exercise->getDescripcion()?></textarea><br/>
			
			<b><?=i18n("Tablas en las que se incluye el ejercicio")?></b>
					<div class="table-responsive">
						<table class="table table-striped table-hover">

							<tbody><br/>
<?php foreach ($tables as $table): ?>
								<tr>
									<td><a href="index.php?controller=tables&amp;action=view&amp;id=<?=$table->getTableId()?>"><?=$table->getTableNombre()?></a></td>
								</tr>
<?php endforeach; ?>
							</tbody>
						</table>
					</div>

			<b><?=i18n("Video Ilustrativo")?>:</b>
			<iframe width="600" height="315" src="https://www.youtube.com/embed/<?=$exercise->getUrl()?>?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=exercises&amp;action=exercisesList"><?=i18n("Return")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/viewExerciseStyle.css">
