<?php
require_once 'class-client.php';
$p = new Pessoa("crudpdo","localhost","root","")

?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Cadastro cliente</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php 
    if(isset($_POST['nome']))
    {
      if (isset($_GET['id_updt']) && !empty($_GET['id_updt']))
      {
        $id_upd = addslashes($_GET['id_updt']);
        $nome = addslashes($_POST['nome']);
          $telefone = addslashes($_POST['telefone']);
          $email = addslashes($_POST['email']);
          if(!empty($nome) && !empty($telefone) && !empty($email))
          {
    
            $p->atualizarDados($id_upd,$nome, $telefone, $email);
            header("location: index.php");
          } 
          else
        {
          echo "tem que preencher todos os campos";
        }
      

      }
      else
      {
          $nome = addslashes($_POST['nome']);
          $telefone = addslashes($_POST['telefone']);
          $email = addslashes($_POST['email']);

          if(!empty($nome) && !empty($telefone) && !empty($email))
          {
    
            if(!$p->cadastrarPessoa($nome, $telefone, $email))
          {
            echo "o email já está cadastrado";
          }
          else
        {
          echo "tem que preencher todos os campos";
        }
      }

      }
      
    }
      
    ?>
    <?php
    if(isset($_GET['id_updt']))
    {
      $id_update = addslashes($_GET['id_updt']);
      $res = $p->pegarDadosUsuario($id_update);
    }
    
    
    ?>
      <section id="esquerda">
        <form method="POST">
          <h2>CADASTRO</h2>
          <label for="nome">Nome</label>
          <input type="text" name="nome" id="nome"
          value="<?php if(isset($res)){echo $res['nome'];}?>">
          <label for="telefone">Telefone</label>
          <input type="text" name="telefone" id="telefone"
          value="<?php if(isset($res)){echo $res['telefone'];}?>">
          <label for="email">Email</label>
          <input type="text" name="email" id="email"
          value="<?php if(isset($res)){echo $res['email'];}?>">
          <input type="submit" value="<?php if(isset($res)){echo "Atualizar";}
          else {echo "Cadastrar";} ?>">
        </form>
      </section>
      <section id="direita">
      <table>
          <tr id="titulo">
            <td>Nome</td>
            <td>Telefone</td>
            <td colspan="2">Email</td>
          </tr>
        <?php
            $dados = $p->buscarDados();
            if(count($dados) > 0 )
            {
              for ($i=0; $i < count($dados); $i++)
              {
                echo "<tr>";
                foreach ($dados[$i] as $k => $v ) 
                {
                  if($k != "id")
                  {
                    echo "<td>".$v."</td>";
                  }
                }
        ?> 
            <td>
               <a href="index.php?id_updt=<?php echo $dados[$i]['id'];?>">Editar</a>
                <a href="index.php?id=<?php echo $dados[$i]['id'];?>">Excluir</a>
            </td>
        <?php
                echo "</tr>";
              }
        
        
            }
            else
            {
              echo "ainda não ha pessoas cadastradas";
            }
        ?>

          </tr>
        </table>
      </section>
   
  </body>
</html>

<?php
if(isset($_GET['id']))
{
  $idUsuario = addslashes($_GET['id']);
  $p->excluir($idUsuario);
  header("location: index.php");

}


?>