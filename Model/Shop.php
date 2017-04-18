<?php 
App::uses('AppModel', 'Model');

Class Shop extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'Shop';
	public $useTable = 'shop';
	public $primaryKey = 'id_shop';
}