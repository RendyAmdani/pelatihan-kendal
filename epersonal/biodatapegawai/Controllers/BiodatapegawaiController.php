<?php
namespace App\Modules\epersonal\biodatapegawai\Controllers;

use Gemboot\Controllers\CoreRestController as GembootController;
use App\Modules\epersonal\biodatapegawai\Models\BiodatapegawaiModel;
use Input,View, Request, Form, File;

/**
* Biodatapegawai Controller
* @var Biodatapegawai
* Generate from Custom Laravel 5.1 by Aa Gun.
*
* Developed by Divisi Software Development - Dinustek.
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class BiodatapegawaiController extends GembootController {
    protected $biodatapegawai;

    public function __construct(BiodatapegawaiModel $biodatapegawai){
        $this->biodatapegawai = $biodatapegawai;
    }

        public function getIndex(){
        cekAjax();
        // if (Input::has('search')) {
        //     if(strlen(Input::has('search')) > 0){
        //         $biodatapegawais = $this->biodatapegawai
        //             ->orWhere('nip', 'LIKE', '%'.Input::get('search').'%')
        //             ->orWhere('nama', 'LIKE', '%'.Input::get('search').'%')
        //             ->orWhere('idskpd', 'LIKE', '%'.Input::get('search').'%')

        //         ->paginate(@\Session::get('configurations')['list-limit']);
        //     }else{
        //         $biodatapegawais = $this->biodatapegawai->all();
        //     }
        // }else{
        //     $biodatapegawais = $this->biodatapegawai->all();
        // }
        /**
         * $this->biodatapegawai
         * \DB::table('tb_01')
         */

        $biodatapegawais = $this->biodatapegawai
            ->select('tb_01.nip', 'tb_01.nama', 'a_skpd.skpd as namaskpd')
            // LEFT JOIN a_skpd ON tb_01.idskpd = a_skpd.idskpd
            ->leftjoin('a_skpd', 'tb_01.idskpd', '=', 'a_skpd.idskpd')
            ->whereNotIn('tb_01.idjenkedudupeg', [99, 21]);

        if (Input::has('search')) {
            $cari = Input::get('search');
            $biodatapegawais = $biodatapegawais->where(function($q) use ($cari){
                $q->orWhere('tb_01.nama', 'like', "%$cari%");
                $q->orWhere('tb_01.nip', 'like', "%$cari%");
                $q->orWhere('a_skpd.skpd', 'like', "%$cari%");
            });
        }

        $biodatapegawais = $biodatapegawais->orderBy('namaskpd', 'asc')
            ->paginate(25);
        return View::make('biodatapegawai::index', compact('biodatapegawais'));
    }


        public function getCreate(){
        cekAjax();
        return View::make('biodatapegawai::create');
    }

    public function postCreate(){
        cekAjax();
        $input = Input::all();
        $validation = \Validator::make($input, BiodatapegawaiModel::$rules);
        if ($validation->passes()){
            $input['user_id'] = \Session::get('user_id');
            $input['role_id'] = \Session::get('role_id');
            echo ($this->biodatapegawai->create($input))?1:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }



    //{controller-show}

        public function getEdit($id = false){
        cekAjax();
        $id = ($id == false)?Input::get('id'):'';
        $biodatapegawai = $this->biodatapegawai->find($id);
        //if (is_null($biodatapegawai)){return \Redirect::to('epersonal/biodatapegawai/index');}
        return View::make('biodatapegawai::edit', compact('biodatapegawai'));
    }

    public function postEdit(){
        cekAjax();
        $id = Input::get('id');
        $input = Input::all();
        $validation = \Validator::make($input, BiodatapegawaiModel::$rules);

        if ($validation->passes()){
            $biodatapegawai = $this->biodatapegawai->find($id);
            echo ($biodatapegawai->update($input))?4:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }



        public function postDelete(){
        cekAjax();
        $ids = Input::get('id');
        if (is_array($ids)){
            foreach($ids as $id){
                $cek = $this->biodatapegawai->find($id);
                if($cek){
                    $cek->delete();
                }
            }
            echo 'Data berhasil dihapus';
        }
        else{
            echo ($this->biodatapegawai->find($ids)->delete())?9:0;
        }
    }

    public function getPrint($nip){
        $pegawai = \DB::table('v_tb_01')->where('nip', $nip)->first();
        return View::make('biodatapegawai::print', compact('pegawai'));
    }
}
