<?php
namespace App\Modules\epensiun\templateskpensiun\Controllers;

use Gemboot\Controllers\CoreRestController as GembootController;
use App\Modules\epensiun\templateskpensiun\Models\TemplateskpensiunModel;
use Input,View, Request, Form, File;

/**
* Templateskpensiun Controller
* @var Templateskpensiun
* Generate from Custom Laravel 5.1 by Aa Gun.
*
* Developed by Divisi Software Development - Dinustek.
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class TemplateskpensiunController extends GembootController {
    protected $templateskpensiun;

    public function __construct(TemplateskpensiunModel $templateskpensiun){
        $this->templateskpensiun = $templateskpensiun;
    }

        public function getIndex(){
        cekAjax();
        if (Input::has('search')) {
            if(strlen(Input::has('search')) > 0){
                $templateskpensiuns = $this->templateskpensiun
                			->orWhere('template', 'LIKE', '%'.Input::get('search').'%')

                ->paginate(@\Session::get('configurations')['list-limit']);
            }else{
                $templateskpensiuns = $this->templateskpensiun->all();
            }
        }else{
            $templateskpensiuns = $this->templateskpensiun->all();
        }
        return View::make('templateskpensiun::index', compact('templateskpensiuns'));
    }




    //{controller-show}

        public function getEdit($id = false){
        cekAjax();
        $id = ($id == false)?Input::get('id'):'';
        $templateskpensiun = $this->templateskpensiun->find($id);
        //if (is_null($templateskpensiun)){return \Redirect::to('epensiun/templateskpensiun/index');}
        return View::make('templateskpensiun::edit', compact('templateskpensiun'));
    }

    public function postEdit(){
        cekAjax();
        $id = Input::get('id');
        $input = Input::all();
        $validation = \Validator::make($input, TemplateskpensiunModel::$rules);

        if ($validation->passes()){
            $templateskpensiun = $this->templateskpensiun->find($id);
            echo ($templateskpensiun->update($input))?4:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }

    /*function template DPCP*/
    public function getDpcp(){
        cekAjax();
        return View::make('templateskpensiun::dpcp');
    }

    /*function template DPCP*/
    public function getDpcpmeninggal(){
        cekAjax();
        return View::make('templateskpensiun::dpcpmeninggal');
    }

    /*function untuk simpan template*/
    public function postSavetemplate(){
        cekAjax();
        $dt['idskpd'] = (Input::get('idskpd')!='')?Input::get('idskpd'):'all';
        $dt['jenis'] = Input::get('jenis');

        $cek = \DB::table('tr_dpcp_template')->where($dt)->count();
        if($cek === 0){
            $data['user_id'] = \Session::get('user_id');
            $data['role_id'] = \Session::get('role_id');
            $data['created_at'] = gmdate("Y-m-d H:i", time()+60*60*7);
            $dt['template'] = Input::get('template');
            $insert = \DB::table('tr_dpcp_template')->insert($dt);
            echo ($insert)?1:"Gagal Disimpan";
        }else{
            $data['template'] = Input::get('template');
            $data['updated_at'] = gmdate("Y-m-d H:i", time()+60*60*7);
            $update = \DB::table('tr_dpcp_template')->where($dt)->update($data);
            echo ($update)?1:"Gagal Disimpan";
        }
    }

}
