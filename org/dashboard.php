<?php
	class Organization{protected $pdo;public function __construct($pdo){$this->pdo=$pdo;}public function all(){return $this->pdo->query('SELECT * FROM organizations')->fetchAll();}} 
?>