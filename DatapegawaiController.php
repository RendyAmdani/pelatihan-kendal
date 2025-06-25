<?php
namespace App\Modules\epersonal\datapegawai\Controllers;

use Gemboot\Controllers\CoreRestController as GembootController;
use App\Modules\epersonal\datapegawai\Models\DatapegawaiModel;
use App\Modules\epersonal\biodatapegawai\Models\BiodatapegawaiModel;
use Input,View, Request, Form, File;

class DatapegawaiController extends GembootController {

	/**
	 * Datapegawai Repository
	 *
	 * @var Datapegawai
	 */
	protected $datapegawai;

	public function __construct()
	{

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		cekAjax();
		return View::make('datapegawai::index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('datapegawai::create');
	}

    public function postCaripegawai()
    {
        cekAjax();
        $keyword 	= Input::get('keyword');
        $per_page   = intval(Input::get('per_page'));
        $start      = (intval(Input::get('page'))-1)*$per_page;
        $page       = intval(Input::get('page'));

        $rs = \DB::table('tb_01')
            ->select('nip', 'nama', 'nip as id', \DB::raw("concat(gdp, if(gdp!='',' ',''),nama, if(gdb!='',', ',''), gdb) as text"))
            ->where('nama', 'like', '%'.$keyword. '%')
            ->orWhere('nip', 'like', '%'.$keyword. '%')
            ->orderBy('nama', 'asc');

        $arr['result'] 		= count($rs->get());
        $arr['per_page'] 	= $per_page;
        $arr['page'] 		= (($page>0)?$page:1);
        $arr['rows']        = $rs->skip($start)->take($per_page)->get();
        echo json_encode($arr);
    }

	public function getDetailpegawai()
	{
		$nip = \Input::get('nip');
		$pegawai = \DB::table('tb_01')->where('nip', $nip)->first();
		return View::make('datapegawai::detailpegawai', compact('pegawai'));
	}

    public function postDetailpegawai()
	{
		$nip = \Input::get('nip');
		$pegawai = \DB::table('tb_01')
            ->select('tb_01.*', 'a_skpd.skpd', 'a_jenjurusan.jenjurusan', 'a_skpd.jab', 'a_jabfung.jabfung', 'a_jabfungum.jabfungum')
            ->leftJoin('a_skpd', 'tb_01.idskpd', '=', 'a_skpd.idskpd')
            ->leftJoin('a_jenjurusan', 'tb_01.idjenjurusan', '=', 'a_jenjurusan.idjenjurusan')
            ->leftJoin('a_jabfung', 'tb_01.idjabfung', '=', 'a_jabfung.idjabfung')
            ->leftJoin('a_jabfungum', 'tb_01.idjabfungum', '=', 'a_jabfungum.idjabfungum')
            ->where('nip', $nip)->first();

		echo json_encode($pegawai);
	}

    /*function cari jurusan*/
    public function postJenjurusan()
    {
        cekAjax();
        $keyword 	= Input::get('keyword');
        $parent 	= Input::get('parent');
        $per_page   = intval(Input::get('per_page'));
        $start      = (intval(Input::get('page'))-1)*$per_page;
        $page       = intval(Input::get('page'));

        $rs = \DB::table('a_jenjurusan')
            ->select('idjenjurusan', 'jenjurusan', 'idjenjurusan as id', 'jenjurusan as text')
            ->where('idtkpendid', '=', $parent)
            ->where('jenjurusan', 'like', '%'.$keyword. '%')
            ->orderBy('jenjurusan', 'asc');

        $arr['result'] 		= count($rs->get());
        $arr['per_page'] 	= $per_page;
        $arr['page'] 		= (($page>0)?$page:1);
        $arr['rows']        = $rs->skip($start)->take($per_page)->get();
        echo json_encode($arr);
    }

    /*function cari skpd unit*/
    public function postSkpdunit()
    {
        cekAjax();
        $keyword 	= Input::get('keyword');
        $parent 	= Input::get('parent');
        $per_page   = intval(Input::get('per_page'));
        $start      = (intval(Input::get('page'))-1)*$per_page;
        $page       = intval(Input::get('page'));

        $rs = \DB::table('a_skpd')
            ->select('idskpd', 'skpd', 'idskpd as id', 'skpd as text')
            ->where('flag', 1)
            ->whereRaw("left(idskpd, 2) = \"".$parent."\"")
            ->where('skpd', 'like', '%'.$keyword. '%')
            ->orderBy('idskpd', 'asc')
            ->orderBy('skpd', 'asc');

        $arr['result'] 		= count($rs->get());
        $arr['per_page'] 	= $per_page;
        $arr['page'] 		= (($page>0)?$page:1);
        $arr['rows']        = $rs->skip($start)->take($per_page)->get();
        echo json_encode($arr);
    }

    /*function cari jabatan struktural*/
    public function postJabstruk()
    {
        cekAjax();
        $keyword 	= Input::get('keyword');
        $parent 	= Input::get('parent');
        $per_page   = intval(Input::get('per_page'));
        $start      = (intval(Input::get('page'))-1)*$per_page;
        $page       = intval(Input::get('page'));

        $rs = \DB::table('a_skpd')
            ->select('idskpd', 'jab', 'idskpd as id', 'jab as text')
            ->where('flag', 1)
            ->where('idskpd', 'like', ''.$parent. '%')
            ->where('jab', 'like', '%'.$keyword. '%')
            ->orderBy('idskpd', 'asc')
            ->orderBy('jab', 'asc');

        $arr['result'] 		= count($rs->get());
        $arr['per_page'] 	= $per_page;
        $arr['page'] 		= (($page>0)?$page:1);
        $arr['rows']        = $rs->skip($start)->take($per_page)->get();
        echo json_encode($arr);
    }

    /*function cari jabatan fungsional*/
    public function postJabfung()
    {
        cekAjax();
        $keyword 	= Input::get('keyword');
        $parent 	= Input::get('parent');
        $per_page   = intval(Input::get('per_page'));
        $start      = (intval(Input::get('page'))-1)*$per_page;
        $page       = intval(Input::get('page'));

        $rs = \DB::table('a_jabfung')
            ->select('idjabfung', 'jabfung', 'idjabfung as id', 'jabfung as text')
            ->where('flag', 1)
            ->where('jabfung', 'like', '%'.$keyword. '%')
            ->orderBy('jabfung', 'asc');

        $arr['result'] 		= count($rs->get());
        $arr['per_page'] 	= $per_page;
        $arr['page'] 		= (($page>0)?$page:1);
        $arr['rows']        = $rs->skip($start)->take($per_page)->get();
        echo json_encode($arr);
    }

    /*function cari jabatan fungsional umum*/
    public function postJabfungum()
    {
        cekAjax();
        $keyword 	= Input::get('keyword');
        $parent 	= Input::get('parent');
        $per_page   = intval(Input::get('per_page'));
        $start      = (intval(Input::get('page'))-1)*$per_page;
        $page       = intval(Input::get('page'));

        $rs = \DB::table('a_jabfungum')
            ->select('idjabfungum', 'jabfungum', 'idjabfungum as id', 'jabfungum as text')
            ->where('flag', 1)
            ->where('jabfungum', 'like', '%'.$keyword. '%')
            ->orderBy('jabfungum', 'asc');

        $arr['result'] 		= count($rs->get());
        $arr['per_page'] 	= $per_page;
        $arr['page'] 		= (($page>0)?$page:1);
        $arr['rows']        = $rs->skip($start)->take($per_page)->get();
        echo json_encode($arr);
    }

    public function postEdit()
    {
        cekAjax();
        $id = Input::get('nip');
        $input = Input::all();
        $validation = \Validator::make($input, BiodatapegawaiModel::$rules);

        if ($validation->passes()) {
            $arrnot = array('','_token','id');
            $keydate = array('','tglhr','tgskjbt','tmtjbt','tgskcpn','tmtcpn','tgskpns','tmtpns','tgskpkt','tmtpkt','tgskkgb','tmtkgb','tgspmtcpn','tgspmtpns','tmtspmtcpn','tmtspmtpns');

            foreach ($input as $key=>$value) {
                if (array_search($key, $keydate)!='') {
                    if ($value != '') {
                        $val = explode("-", $value);
                        $value = $val[2]."-".$val[1]."-".$val[0];
                    } else {
                        $value = '0000-00-00';
                    }
                }
                if (array_search($key, $arrnot)=="") {
                    $data[$key] = $value;
                }
            }

            $data['user_id'] = \Session::get('user_id');
            $data['role_id'] = \Session::get('role_id');
            $data['updated_at'] = gmdate("Y-m-d H:i", time()+60*60*7);

            if (\DB::table('tb_01')->where('nip', $id)->update($data)) {
                echo "4";
            } else {
                echo "Data Gagal Disimpan";
            }
        } else {
            echo 'Input tidak valid';
        }
    }
}
