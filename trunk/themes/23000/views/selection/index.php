<?php
$this->pageTitle=Yii::app()->name . ' - Продажа шин, дисков, автозапчастей';
$this->breadcrumbs=array(
	'Подбор',
);
?>

<div class='grid_4 alpha'>
	<h2 class="title1"><span><span>Подбор шин</span></span></h2>
	<?php $this->widget('widgets.selection.tyresWidget')?>
</div>

<div class='grid_4'>
	<h2 class="title3"><span><span>Полезная информация</span></span></h2>
	<p>При выборе шин, первым делом, если Вы не знаете какие конкретно шины должны быть установлены на Ваш автомобиль
	 &mdash; мы рекомендуем посмотреть руководство по эксплуатации для вашего авто. 
	 В нём обязательно должны быть указаны типоразмеры шин и дисков, рекомендуемые заводом изготовителем автомобиля.</p>
	<p>Так же на боковине, уже установленных на Вашем автомобиле шин, есть надпись, в которой указан типоразмер шины, 
	вида &mdash; 195/65 R15.</p>
	<p>При подборе колесных дисков всегда следует учитывать X-фактор, это расстояние от тормозного суппорта 
	до внутренней стороны диска. Иногда подходящий по размеру диск может не вставать на автомобиль.</p>
	<p>Так же мы рекомендуем примерять диски до шиномонтажа и установки их на автомобиль.<p>
	<p>И в любом случае Вы всегда сможете получить консультацию у наших менеджеров, которые обладают всеми необходимыми 
	знаниями и опытом, что бы помочь Вам подобрать шины и диски для вашего автомобиля.</p>
	</ul>
</div>

<div class='grid_4 omega'>
	<h2 class="title2"><span><span>Подбор дисков</span></span></h2>
	<?php $this->widget('widgets.selection.disksWidget')?>
</div>