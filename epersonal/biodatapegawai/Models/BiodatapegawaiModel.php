<?php
namespace App\Modules\epersonal\biodatapegawai\Models;

use Gemboot\Models\CoreModel as GembootModel;

/**
* Biodatapegawai Model
* @var Biodatapegawai
* Generate from Custom Laravel 5.1 by Aa Gun.
*
* Developed by Dinustek.
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class BiodatapegawaiModel extends GembootModel {
	protected $guarded = array();

	protected $table = "tb_01";
	protected $primaryKey = "nip";

	public static $rules = array(
    		'nip' => 'required',
		'nama' => 'required',
		'idskpd' => 'required',

    );

	public static function all($columns = array('*')){
		$instance = new static;
		if (\PermissionsLibrary::hasPermission('mod-biodatapegawai-listall')){
			return $instance->newQuery()->paginate(@\Session::get('configurations')['list-limit']);
		}else{
			return $instance->newQuery()
			->where('role_id', \Session::get('role_id'))
			->paginate($_ENV['configurations']['list-limit']);

		}
	}

}
