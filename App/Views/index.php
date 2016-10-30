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
  <?php $valuesInputs = explode(".", base64_decode($_GET['user']));?>

  <form method="POST" action="/sendRequestFormData">
  <section class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="name-people">Name:</label>
          <input name="tokenUpdate" type="hidden" value="<?php echo isset($valuesInputs['0'])? $valuesInputs['0'] : "" ?>">
          <input required name="name" type="text" class="form-control" id="name-people" placeholder="input your name" value="<?php echo isset($valuesInputs['1'])? $valuesInputs['1'] : "" ?>">
        </div>

        <div class="form-group">
          <label for="password-people">Password:</label>
          <input required name="password" type="password" class="form-control" id="password-people" placeholder="input your password" value="<?php echo isset($valuesInputs['2'])? $valuesInputs['2'] : "" ?>">
        </div>

        <div class="form-group">
          <label for="city-people">City:</label>
          <select required class="form-control" name="city" id="city-people" value="<?php echo isset($valuesInputs['5'])? $valuesInputs['5'] : "" ?>">
            <option value="porto_alegre">Porto Alegre</option>
            <option value="rio_de_janeiro">Rio de Janeiro</option>
            <option value="sao_paulo">São Paulo</option>
          </select>
        </div>

        <div class="form-group">
          <label for="father-people">father:</label>
          <input required name="father" type="text" class="form-control" id="father-people" placeholder="input name your father" value="<?php echo isset($valuesInputs['3'])? $valuesInputs['3'] : "" ?>">
        </div>
        <div class="form-group">
          <label for="mother-people">mother:</label>
          <input required name="mother" type="text" class="form-control" id="mother-people" placeholder="input name your mother" value="<?php echo isset($valuesInputs['4'])? $valuesInputs['4'] : "" ?>">
        </div>
        <button type="submit" class="btn btn-default">Enviar</button>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label for="birth-date-people">Birth date:</label>
        <input required name="birth_date" type="date" class="form-control" id="birth-date-people" placeholder="input your birth date" value="<?php echo isset($valuesInputs['6'])? $valuesInputs['6'] : "" ?>">
      </div>

      <div class="form-group">
        <label for="cpf-people">CPF:</label>
        <input required name="cpf" type="number" min="1" class="form-control" id="cpf-people" placeholder="input your CPF" value="<?php echo isset($valuesInputs['7'])? $valuesInputs['7'] : "" ?>">
      </div>

      <div class="form-group">
        <label for="observation-people">Observation:</label>
        <textarea required name="observation" style="resize:none !important" rows="4" cols="50" class="form-control" id="observation-people" placeholder="Observation"><?php echo isset($valuesInputs['8'])? $valuesInputs['8'] : "" ?></textarea>
      </div>
    </div>
  </form>
  </section>
</main>
<?php include_once("inc/footer.php"); ?>
