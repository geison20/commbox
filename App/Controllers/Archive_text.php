<?php
namespace App\Controllers;

class Archive_text
{
  private $name;

  private $password;

  private $father;

  private $mother;

  private $city;

  private $birth_date;

  private $cpf;

  private $observation;

  private $pathFile = "../users.txt";

  private $tableLayout = "%s|----------%s----------|----------%s----------|----------%s----------|----------%s----------|----------%s----------|----------%s----------|----------%s----------|----------%s----------".PHP_EOL;

  private $objUsers;

  public function sendRequestFormData()
	{
    if($_POST){
      $this->name = filter_var(strtolower($_POST['name']), FILTER_SANITIZE_STRING);
      $this->password = filter_var(strtolower($_POST['password']), FILTER_SANITIZE_STRING);
      $this->father = filter_var(strtolower($_POST['father']), FILTER_SANITIZE_STRING);
      $this->mother = filter_var(strtolower($_POST['mother']), FILTER_SANITIZE_STRING);
      $this->city = filter_var(strtolower($_POST['city']), FILTER_SANITIZE_STRING);
      $this->birth_date = filter_var($_POST['birth_date'], FILTER_SANITIZE_STRING);
      $this->cpf = filter_var($_POST['cpf'], FILTER_SANITIZE_NUMBER_INT);
      $this->observation =filter_var($_POST['observation'], FILTER_SANITIZE_STRING);

      if($_POST['tokenUpdate']) {
        $this->updateFileAndLine($_POST);
      }else{
        $this->createTextData();
      }
    } else {
      header('Location: /?result=false');
    }
	}

  private function createTextData()
  {
    $file = fopen($this->pathFile, "a+");
    fwrite($file, sprintf(
    str_replace("-", ".", $this->tableLayout),
    $this->generateID($file),
    $this->name,
    md5($this->password),
    $this->father,
    $this->mother,
    $this->city,
    $this->birth_date,
    $this->cpf,
    $this->observation
    ));
    fclose($file);
    header('Location: /?result=true');

  }

  private function generateID($file)
  {
    $count = 0;
    while(!feof($file)){
      $line = fgets($file);

      $count++;
    }
    return $count;
  }
  private function getNameAndCPFFromUsers($arrUsers)
  {
    $arr = [];
    foreach ($arrUsers as $index => $user) {
      $arr[$index] = explode(".", $user);
      $userObject[$index] = (object) [
        'id' => $arr[$index]['0'],
        'name' => $arr[$index]['1'],
        'cpf' => maskCPF("###.###.###-##", $arr[$index]['7'])
      ];
    }
    return $userObject;
  }

  public function getFiltredUsers()
  {
    $arrUsers = $this->FilterUsers(file($this->pathFile));
    return $this->getNameAndCPFFromUsers($arrUsers);
  }

  private function FilterUsers($users)
  {
    $userSanatized = [];
    foreach ($users as $index => $user) {
      $userSanatized[$index] = str_replace("|", ".", str_replace(".", "", trim($user)));
    }
    return $userSanatized;
  }
  private function findFileByID($arrData, $id){
    $result = array_filter($arrData, function ($item) use ($id) {
        return (strpos($item, $id) !== false );
    });
    return $result;
  }
  public function deleteFileLine()
  {
    $fileData = file($this->pathFile);
    unset($fileData[key($this->findFileByID($fileData, $_GET['file']."|"))]);

    $file = fopen($this->pathFile, "w");
    foreach ($fileData as $filee) {
      fwrite($file, $filee);
    }
    fclose($file);
    header('Location: /list?result=true');
  }

  public function updateInputFile()
  {
    $fileData = file($this->pathFile);
    $user = $fileData[key($this->findFileByID($fileData, $_GET['file']."|"))];
    $userFilter = str_replace("|", ".", str_replace(".", "", trim($user)));
    $_GET['user'] = explode(".", $userFilter);
    header('Location: /?user='.base64_encode($userFilter));
  }

  private function updateFileAndLine($data)
  {
    $fileData = file($this->pathFile);

    $updatedLine = sprintf(
      str_replace("-", ".", $this->tableLayout),
      $data['tokenUpdate'],
      $this->name,
      md5($this->password),
      $this->father,
      $this->mother,
      $this->city,
      $this->birth_date,
      $this->cpf,
      $this->observation
    );
    $fileData[key($this->findFileByID($fileData,  $data["tokenUpdate"]."|"))] = $updatedLine;

    $file = fopen($this->pathFile, "w");
    foreach ($fileData as $filee) {
      fwrite($file, $filee);
    }
    fclose($file);
    header('Location: /list?result=true');
  }

  public function search()
  {
    $fileData = file($this->pathFile);
    $searchFiltred = $this->FilterUsers($this->findFileByID($fileData, $_GET['q']));
    return $this->getNameAndCPFFromUsers($searchFiltred);
  }

  public function getText()
  {
    return file_get_contents("../lorem.txt");
  }

  public function searchLetterCount()
  {
    $text = str_replace(" ", "", trim($this->getText()));
    $arr = array(
    " " => "",
    "," => "",
    "." => "");
    $count = 0;
    foreach (str_split(strtr($text, $arr)) as $letter) {
      if($letter == $_GET['char']) {
        $count++;
      }
    }
    header('Location: /count-letter?count='.$count);

  }
}
