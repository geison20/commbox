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
      <form action="/search-letter" method="GET">
        <div class="form-group">
          <label for="name-char">inform a caracter: ( OPTEI POR NAO DIFERENCIAR CAIXA ALTA E BAIXA )</label>
          <input required name="char" type="text" class="form-control" id="name-char" maxlength="1"><br>

          <span><?php echo isset($_GET['count']) ? "Count:".$_GET['count'] : "" ?></span>
          <br><input type="submit" class="btn btn-success" value="Search">
        </div>
      </form>

      <p>
        <?php echo $_GET['textForCount']; ?>
      </p>

    </div>
  </section>
</main>
<?php include_once("inc/footer.php"); ?>
