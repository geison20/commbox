<?php

use App\Core\Routes\RouteSystem;

$app = new RouteSystem();

$app->addRoute("/", function () {

  $this->controller = "Home";
  $this->action = "index";
  $this->namespace = "App\\Controllers\\";
});

$app->addRoute("/list", function () {

  $this->controller = "Home";
  $this->action = "listAllUsersInTxt";
  $this->namespace = "App\\Controllers\\";
});

$app->addRoute("/sendRequestFormData", function () {

  $this->controller = "Archive_text";
  $this->action = "sendRequestFormData";
  $this->namespace = "App\\Controllers\\";
});

$app->addRoute("/delete", function () {

  $this->controller = "Archive_text";
  $this->action = "deleteFileLine";
  $this->namespace = "App\\Controllers\\";
});

$app->addRoute("/update", function () {

  $this->controller = "Archive_text";
  $this->action = "updateInputFile";
  $this->namespace = "App\\Controllers\\";
});

$app->addRoute("/search", function () {

  $this->controller = "Home";
  $this->action = "querySearch";
  $this->namespace = "App\\Controllers\\";
});

$app->addRoute("/count-letter", function () {

  $this->controller = "Home";
  $this->action = "countLetter";
  $this->namespace = "App\\Controllers\\";
});

$app->addRoute("/search-letter", function () {

  $this->controller = "Archive_text";
  $this->action = "searchLetterCount";
  $this->namespace = "App\\Controllers\\";
});

$app->run();
