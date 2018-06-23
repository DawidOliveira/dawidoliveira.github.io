<?php
/**
 * Created by PhpStorm.
 * User: Dáwid
 * Date: 15/10/2017
 * Time: 20:45
 */
//  include "conexao/connection.php";
// session_start();
//  if (!isset($_SESSION['logado']) || !$_SESSION['logado']) {
//    header("Location: login.php");
//  }

    function del($p,$b){
        unlink($p."/".$b);
    }
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Arquivos</title>
    <style>
        a{
            color: #fff;
            text-decoration: none;
        }
        *{
            margin: 0;
            padding: 0;
        }
        body{
            font-family: Andalus;
            background-color: #7376ff;
            overflow-x: hidden;
        }
        header{
            text-align: center;
            background-color: #fff;
            width: 100%;
            padding: 5px 0;
        }
        header h2{
            font-size: 2em;
        }
        .conteudo{
            float: left;
            width: 100%;
        }
        .conteudo section{
            width: 100%;
            border: 1px solid black;
        }
        form input[type="submit"]{
            border: none;
            padding: 5px;
            font-size: 1em;
            margin: 5px;
            color: white;
            background-color: #aaa;
        }
    </style>
</head>
<body>
    <header>
        <h2>Lista de Arquivos</h2>
    </header>
    <?php
        $pasta = 'dawid/';
        if(is_dir($pasta)){
        $diretorio = dir($pasta);

    ?>
    <div class="conteudo">
        <section style="padding: 0 0 0 20px;">
            <ol><?php
                while ($arquivo = $diretorio->read()) {
                    if($arquivo != ".") {
                        ?>
                        <li><a href="<?= $pasta . $arquivo ?>"><?= $arquivo ?></a><?=" "?></li><?php
                    }
                }
                }
            ?>
            </ol>
        </section>
        <section>
            <form enctype="multipart/form-data" action="" method="post">
                <input type="file" name="file"><br>
                <input type="submit" name="enviar" value="Enviar">
                <a href="?func=logout">Sair <!--(<?= ucwords($_SESSION['username']); ?>)--></a>
            </form>
        </section>
    </div>

</body>
</html>

<?php
    if (isset($_POST['enviar'])){

            $nome_temporario=$_FILES["file"]["tmp_name"];
            $nome_real=$_FILES["file"]["name"];

            if (copy($nome_temporario,"dawid/$nome_real")){
                echo "<script>alert('Upload feito com sucesso!');</script>";
                header("Location: index.php");
            }else{
                echo "<script>alert('Erro ao fazer o upload!');</script>";
            }

    }

    // if (isset($_GET['func'])) {
    //   if ($_GET['func']=='logout') {
    //     session_destroy();
    //     header('Location: login.php');
    //   }else{
    //     header('Location: index.php');
    //   }
    // }
?>
