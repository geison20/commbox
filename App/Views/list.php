<!-- OPTEI POR NAO USAR NENHUM TEMPLATE ENGINE TIPO O TWIG -->
<?php include_once("inc/header.php"); ?>
<?php include_once("inc/navbar.php"); ?>
<main class="container">
  <?php if($_GET && $_GET['result']) {
    if($_GET['result'] == 'true') {
      include_once("inc/alerts/success.php");
    } else{
      include_once("inc/alerts/error.php");
    }
  } ?>

  <section class="row">
    <div class="col-md-12">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>CPF</th>
            <th>EDIT</th>
            <th>DELETE</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $itenarator = $_GET['queryUsers'] ? $_GET['queryUsers'] : $_GET['users'];
            foreach ($itenarator as $user) {
              echo "<tr>";
              echo  "<th>$user->id</th>";
              echo  "<th>$user->name</th>";
              echo  "<th>$user->cpf</th>";
              echo  "<th><a class='btn btn-info' href='/update?file=$user->id'>UPDATE</a></th>";
              echo  "<th><a class='btn btn-danger' href='/delete?file=$user->id'>DELETE</a></th>";
              echo "</tr>";
            }
           ?>
          </tr>
          </tbody>
        </table>
    </div>
  </section>
</main>

<?php include_once("inc/footer.php"); ?>
