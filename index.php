<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Giovanne Oliveira">
    <title>Cálculo de Média Global - Curso de Formação</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/component-spinners.min.css">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#563d7c">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="assets/js/component-spinners.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 20px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 10px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>

<body class="text-center">
    <form class="form-signin" id="frmCalcular">
        <h1 class="h3 mb-3 font-weight-normal">Cálculo de Média Global</h1>
        <div class="alert alert-primary" role="alert">
            Insira suas notas até o momento e calcule sua média global no curso. E de quebra saiba quantas você pode errar na próxima prova!
        </div>
        <label for="nota01" class="sr-only">Nota 01</label>
        <input type="number" value="<?php if (isset($_COOKIE["nota01"])) {
                                        echo $_COOKIE["nota01"];
                                    } ?>" id="nota01" class="form-control" max="25" placeholder="Nota 01" required autofocus>

        <label for="nota02" class="sr-only">Nota 02</label>
        <input type="number" value="<?php if (isset($_COOKIE["nota02"])) {
                                        echo $_COOKIE["nota02"];
                                    } ?>" id="nota02" class="form-control" max="25" placeholder="Nota 02">

        <label for="nota03" class="sr-only">Nota 03</label>
        <input type="number" value="<?php if (isset($_COOKIE["nota03"])) {
                                        echo $_COOKIE["nota03"];
                                    } ?>" id="nota03" class="form-control" max="25" placeholder="Nota 03">

        <label for="nota04" class="sr-only">Nota 04</label>
        <input type="number" value="<?php if (isset($_COOKIE["nota04"])) {
                                        echo $_COOKIE["nota04"];
                                    } ?>" id="nota04" class="form-control" max="25" placeholder="Nota 04">

        <label for="nota05" class="sr-only">Nota 05</label>
        <input type="number" value="<?php if (isset($_COOKIE["nota05"])) {
                                        echo $_COOKIE["nota05"];
                                    } ?>" id="nota05" class="form-control" max="25" placeholder="Nota 05">
        <p></p>
        <button class="btn btn-lg btn-primary btn-block btn-spinner" id="btnCalcular" data-spinner-text="Calculando..." type="submit">Calcular</button>
        <a class="btn btn-lg btn-primary btn-block" href="processador.php?limpacookies">Limpar dados salvos</a>
        <p class="mt-5 mb-3 text-muted">Curso de Formação de Servidores - PMBD 2020</p>
    </form>

    <form class="form-signin" id="frmResultado" style="display:none; max-width:500px;">
        <h1 class="h3 mb-3 font-weight-normal">Cálculo de Média Global</h1>
        <div class="alert alert-primary" role="alert">
            Vamos aos resultados:
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th scope="row">Média Global:</th>
                    <td id="celula-media"></td>
                </tr>
                <tr>
                    <th scope="row">Acertos na próxima prova:</th>
                    <td id="celula-acertos"></td>
                </tr>
                <tr>
                    <th scope="row">Status</th>
                    <td id="celula-status"></td>
                </tr>
            </tbody>
        </table>
        <p></p>
        <a class="btn btn-lg btn-primary btn-block" id="btnVoltar" onClick="javascript:reset();">Voltar</a>
        <p class="mt-5 mb-3 text-muted">Curso de Formação de Servidores - PMBD 2020</p>
    </form>
</body>

<script>
    function reset() {
        $("#frmResultado").slideUp('slow', function() {
            $("#frmCalcular").slideDown();
        });
    }
    $(function() {


        $("btnVoltar").click(function() {

        });

        $("#frmCalcular").submit(function(e) {
            e.preventDefault();
            var nota01 = $("#nota01").val();
            var nota02 = $("#nota02").val();
            var nota03 = $("#nota03").val();
            var nota04 = $("#nota04").val();
            var nota05 = $("#nota05").val();
            var btn = $("#btnCalcular");
            $.ajax({

                type: "POST",
                data: {
                    nota01: nota01,
                    nota02: nota02,
                    nota03: nota03,
                    nota04: nota04,
                    nota05: nota05
                },

                url: "processador.php",
                dataType: "json",
                success: function(result) {

                    if (result.reqStatus == 200) {
                        $("#celula-media").html(result.mediaGlobal + '%');
                        $("#celula-acertos").html(result.proximosErrosStr);
                        $("#celula-status").html(result.statusCurso);
                        $("#frmCalcular").slideUp('slow', function() {
                            btn.buttonLoader('stop');
                            $('#frmResultado').slideDown();
                        });
                    }


                },
                beforeSend: function() {
                    btn.buttonLoader('start');

                },
                error: function() {
                    swalInit.fire({
                        text: 'Oops! Alguma coisa deu errada. Nada é perfeito na vida né? Tente novamente por favor.',
                        type: 'error',
                        toast: true,
                        showConfirmButton: false,
                        position: 'top-right'
                    });
                    btn.buttonLoader('stop');
                }
            });
            return false;
        });
    })
</script>

</html>