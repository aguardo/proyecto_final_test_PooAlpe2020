<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $t->description;
?>
<div style="margin-top:50px;"> </div>
<div class="site-about pdfSalida">
    <div class="row">
        <div style="float:none" class="col-lg-8 center-block">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        <?= $this->title ?>
                    </h2>
                </div>
                <div style="height: 600px" class="panel-body">
                    <?= $t->description ?>
                    <!---
                    <div style="margin:30px;float:none" class="col-lg-6 center-block">
                        <div class="list-group">
                            <div class="list-group-item list-group-item-info">Las preguntas de este test estan relacionadas con los siguientes temas:</div>

                            <?php 
                            /**
                            foreach ($c as $categoria){
                                if (!is_null($categoria->descripcion)) {
                                    echo '<div class="list-group-item"><span stype="display:block;float:left">' . $categoria->descripcion . '</span> - <span style="line-height:20px;height:20px;border-radius:5px;width:60px;display:block;float:left" class="bg-info">' . "&nbsp;&nbsp;" . $n[$categoria->id]["numero"] . "&nbsp;&nbsp;" . '</span></div>';
                                }
                            } **/
                            ?>
                         </div>
                    </div>
                    --->
                </div>
                <div class="panel-footer bg-info text-right">
                    <?= 'ID' . $t->id ?>
                </div>
            </div>
        </div>

    </div>

    <div style="display: block; page-break-before: always;"> </div>

    <div class="test1" style="line-height: 1.5em;font-size: .9em;font-family: Bodoni MT">
        <ol>
          
    
    <?php
        
        $fotos=[];
        $contadorPreguntas=0;
        foreach ($p as $key => $v){
            $contadorPreguntas++;
            
        ?>

            <li style="margin-bottom:0px"><?= $v->texto?></li>
            <?php  /**
            if ($v->pregunta0->imagen){
                echo '<div style="text-align:center;margin:10px">';
                //compruebo que la foto no este en otra pregunta del mismo test para solo mostrarla una vez 
                if(!in_array($v->pregunta0->imagen,$fotos)){
                    $fotos=[$contadorPreguntas => $v->pregunta0->imagen];
                    echo Html::img('@web/imgs/pdf/' . $v->pregunta0->imagen0->url);
                }else{
                    $numeroFoto=array_search($v->pregunta0->imagen,$fotos);
                    echo "Mirar imagen de la pregunta $numeroFoto";
                }
                echo "</div>";
            }**/
            ?>
            <ol type="a">
                <?php
                    foreach ($r[$key] as $resp){
                        echo "<li>" . $resp->texto . "</li>";
                    }
                ?>
            </ol>


    <?php
        }
        ?>
        </ol>
    </div>

    <div style="display: block; page-break-before: always;"> </div>

    <table class="tablas">
    <?php
        
        for($numero=0;$numero<count($p);){
            echo '<tr><td>' . ($numero+1) . ':</td><td>' .  $p[$numero++]->respuesta_correcta . "</td>";

            if($numero>=count($p)){
                echo '<td>' . ($numero+1) . ':</td><td> - </td>';
                $numero++;
            }else{
                echo '<td>' . ($numero+1) . ':</td><td>' .  $p[$numero++]->respuesta_correcta . "</td>";
            }

            if($numero>=count($p)){
                echo '<td>' . ($numero+1) . ':</td><td> - </td></tr>';
                $numero++;
            }else{
                echo '<td>' . ($numero+1) . ':</td><td>' .  $p[$numero++]->respuesta_correcta . "</td></tr>";
            }

        } 
    ?>
    </table>
</div>
