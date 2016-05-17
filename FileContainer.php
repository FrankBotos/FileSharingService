<?php
  class FileContainer{
    public $fileName;
    public $key;
    public $dateAdded;
    function __construct($fileName, $key){
      $this->fileName = $fileName;
      $this->key = $key;
      $this->dateAdded = strtotime('now');//we use a unix time stamp, which counts # of seconds passed since Jan 1, 1970
    }
  }
  ?>
