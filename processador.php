<?php

/**
 * File: /processador.php
 * Project: calculomedia
 * Created Date: Friday, November 27th 2020, 11:16:37 pm
 * Author: Giovanne Oliveira
 * -----
 * Last Modified: Sat Nov 28 2020
 * Modified By: Giovanne Oliveira
 * -----
 * Copyright (c) 2020 GiovanneDev
 * -----
 * This code is under Proprietary License, and its use is authorized only for certified customers.
 * -----
 */

if (isset($_REQUEST['limpacookies'])) {

    setcookie("nota01", '', time() - 3600);
    setcookie("nota02", '', time() - 3600);
    setcookie("nota03", '', time() - 3600);
    setcookie("nota04", '', time() - 3600);
    setcookie("nota05", '', time() - 3600);
    header('Location: ./');
}

if (isset($_REQUEST['nota01'])) {

    $notas[0] = intval($_REQUEST['nota01']);
    $notas[1] = intval($_REQUEST['nota02']);
    $notas[2] = intval($_REQUEST['nota03']);
    $notas[3] = intval($_REQUEST['nota04']);
    $notas[4] = intval($_REQUEST['nota05']);

    // seta o cookie
    if ($notas[0] <> 0) {
        setcookie("nota01", $notas[0], time() + 30 * 24 * 60 * 60);
    }
    if ($notas[1] <> 0) {
        setcookie("nota02", $notas[1], time() + 30 * 24 * 60 * 60);
    }
    if ($notas[2] <> 0) {
        setcookie("nota02", $notas[2], time() + 30 * 24 * 60 * 60);
    }
    if ($notas[3] <> 0) {
        setcookie("nota04", $notas[3], time() + 30 * 24 * 60 * 60);
    }
    if ($notas[4] <> 0) {
        setcookie("nota05", $notas[4], time() + 30 * 24 * 60 * 60);
    }



    $mediaUnica = array();

    $notasPresentes = 0;
    foreach ($notas as $key => $nota) {
        if ($nota == '') {

            //$notas[$key] = 0;
            unset($notas[$key]);
        } else {
            $notasPresentes++;
        }

        $mediaUnica[$key] = round(($nota / 25) * 100);
    }


    $mediaGlobal = array_sum($mediaUnica) / $notasPresentes;

    if ($mediaGlobal >= 80) {
        $status = '<b class="text-success">Até o momento você passou!</b>';
    } else {
        $status = '<b class="text-warning>Você precisa se esforçar mais!</b>';
    }

    $proximosErros = round(($mediaGlobal - 80) / 4, 0, PHP_ROUND_HALF_DOWN);
    $proximosErrosStr = '';

    if ($proximosErros == 0) {
        $proximosErrosStr = '<b class="text-danger">Você não pode errar nenhuma na próxima prova :(</b>';
    } else if ($proximosErros < 0) {
        $proximosErrosStr = '<b class="text-danger">Você PRECISA acertar ' . abs($proximosErros) . ' acima de 20 na próxima prova :(</b>';
    } else {
        $proximosErrosStr = '<b class="text-success ">Você pode errar até ' . ($proximosErros + 5) . ' questões na próxima prova :D</b>';
    }

    $response = array(
        'reqStatus' => 200,
        'mediaGlobal' => $mediaGlobal,
        'statusCurso' => $status,
        'proximosErros' => $proximosErros,
        'proximosErrosStr' => $proximosErrosStr
    );

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
} else {
}
