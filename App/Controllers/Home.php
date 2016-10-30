<?php

namespace App\Controllers;

use
    App\Controllers\Archive_text as Text;

class Home
{

  private $file;

  function __construct()
  {
    $this->file = new Text();
  }
	public function index()
	{
		renderView('index.php');
	}
	public function listAllUsersInTxt()
	{
    $_GET['users'] = $this->file->getFiltredUsers();
    renderView('list.php');
	}
	public function querySearch()
	{
    $_GET['queryUsers'] = $this->file->search();
    renderView('list.php');
	}
	public function countLetter()
	{
    $_GET['textForCount'] = $this->file->getText();
    renderView('countLetter.php');
	}
}
