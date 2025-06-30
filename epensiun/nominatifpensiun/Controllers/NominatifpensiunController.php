<?php
namespace App\Modules\epensiun\nominatifpensiun\Controllers;

use Gemboot\Controllers\CoreRestController as GembootController;
use App\Modules\epensiun\nominatifpensiun\Models\NominatifpensiunModel;
use Input,View, Request, Form, File;

/**
* Nominatifpensiun Controller
* @var Nominatifpensiun
* Generate from Custom Laravel 5.1 by Aa Gun.
*
* Developed by Divisi Software Development - Dinustek.
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class NominatifpensiunController extends GembootController {
    protected $nominatifpensiun;

    public function __construct(NominatifpensiunModel $nominatifpensiun){
        $this->nominatifpensiun = $nominatifpensiun;
    }

    // public function getIndex(){
    //     cekAjax();
    //     if (Input::has('search')) {
    //         if(strlen(Input::has('search')) > 0){
    //             $nominatifpensiun = $this->nominatifpensiun
    //             			->orWhere('almdesapens', 'LIKE', '%'.Input::get('search').'%')
	// 		->orWhere('almdesaskrpens', 'LIKE', '%'.Input::get('search').'%')
	// 		->orWhere('almkabpens', 'LIKE', '%'.Input::get('search').'%')
	// 		->orWhere('almkabskrpens', 'LIKE', '%'.Input::get('search').'%')
	// 		->orWhere('almkecpens', 'LIKE', '%'.Input::get('search').'%')
	// 		->orWhere('almkecskrpens', 'LIKE', '%'.Input::get('search').'%')
	// 		->orWhere('almpens', 'LIKE', '%'.Input::get('search').'%')
	// 		->orWhere('almprovpens', 'LIKE', '%'.Input::get('search').'%')

    //             ->paginate(@\Session::get('configurations')['list-limit']);
    //         }else{
    //             $nominatifpensiuns = $this->nominatifpensiun->all();
    //         }
    //     }else{
    //         $nominatifpensiuns = $this->nominatifpensiun->all();
    //     }
    //     return View::make('nominatifpensiun::index', compact('nominatifpensiuns'));
    // }

    public function getIndex(){
            cekAjax();
            $where = " tr_pensiun.idjenkedudupeg != 1 and tr_pensiun.nip != '' ";
            if(session('role_id') > 3){
                if(session('role_id') == 5){
                    $where .= " and tr_pensiun.nip = \"".session('user_id')."\" ";
                }else{
                    $where .= " and b.idskpd like \"".session('idskpd')."%\" ";
                }
            }
            if (Input::has('search') or Input::has('idskpd') or Input::has('tahun') or Input::has('bulan') or (Input::get('statussk') != '') or (Input::get('idjenpens') != '')) {
                if(Input::get('tahun') != ''){
                    $where .= (($where != '')?' AND ':'')." YEAR(tr_pensiun.tmtpens)= ".Input::get('tahun')."";
                }

                /* Kondisi Bulan */
                if(Input::get('bulan') != '' && Input::get('tahun') != ''){
                    $where .= " AND MONTH(tr_pensiun.tmtpens) = \"".Input::get('bulan')."\"";
                }

                if(Input::get('bulan') != '' && Input::get('tahun') == ''){
                    $where .= "AND MONTH(tr_pensiun.tmtpens) = \"".Input::get('bulan')."\"";
                }

                /* Kondisi skpd atau unit kerja */
                if(Input::get('idskpd') != ''){
                    $where.= " and b.idskpd like '".Input::get('idskpd')."%'";
                }

                if(Input::get('statussk') != ''){
                    $where .= " and statussk = \"".Input::get('statussk')."\"";
                }

                /* Kondisi jenis pensiun */
                if(Input::get('idjenpens') != ''){
                    $where.= "and tr_pensiun.idjenpens like '".Input::get('idjenpens')."'";
                }

                /* Kondisi search */
                if(Input::get('search') != ''){
                    $where.= "and (tr_pensiun.nip like '%".Input::get('search')."%' or b.nama like '%".Input::get('search')."%')";
                }

                $nominatifpensiuns = $this->nominatifpensiun
                    ->select(\DB::raw("tr_pensiun.*,tr_pensiun.idjenpens as jenispensiun,
                        b.idgolrucpn, b.tmtcpn, b.mkthncpn, b.mkblncpn,b.*,a_tkpendid.tkpendid,a_jenjurusan.jenjurusan,a_agama.agama,a_jenpens.jenpens,g.path_short,
                        b.idgolrupns, b.tmtpns, e.golru, e.pangkat,
                        c.golru as golrucpn,c.pangkat as pangkatcpn,
                        d.golru as golrupns,d.pangkat as pangkatpns, tr_pensiun.tmtpens"),
                        \DB::raw("CONCAT(b.gdp,IF(LENGTH(b.gdp)>0,' ',''),b.nama,IF(LENGTH(b.gdb)>0,', ',''),b.gdb) AS namalengkap"),
                        \DB::raw('IF(b.idjenjab>4,g.jab,IF(b.idjenjab=2,h.jabfung,IF(b.idjenjab=3,i.jabfungum,"-"))) as jabatan'),
                        \DB::raw('IF(b.idjenjab>4,g.bup,IF(b.idjenjab=2,h.pens,IF(b.idjenjab=3,i.pens,"-"))) as usiapens'),
                        \DB::raw("DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(b.tglhr)), '%Y%m')+0 AS usia")
                    )
                    ->join('tb_01 as b', 'tr_pensiun.nip', '=', 'b.nip')
                    ->leftJoin('a_golruang as c', 'b.idgolrucpn', '=', 'c.idgolru')
                    ->leftJoin('a_golruang as d', 'b.idgolrupns', '=', 'd.idgolru')
                    ->leftJoin('a_golruang as e', 'b.idgolrupkt', '=', 'e.idgolru')
                    ->join('a_skpd as g', 'b.idskpd', '=', 'g.idskpd')
                    ->leftjoin('a_jabfung as h', 'b.idjabfung', '=', 'h.idjabfung')
                    ->leftjoin('a_jabfungum as i', 'b.idjabfungum', '=', 'i.idjabfungum')
                    ->leftjoin('a_tkpendid', 'b.idtkpendid', '=', 'a_tkpendid.idtkpendid')
                    ->leftjoin('a_jenjurusan', 'b.idjenjurusan', '=', 'a_jenjurusan.idjenjurusan')
                    ->leftjoin('a_agama', 'b.idagama', '=', 'a_agama.idagama')
                    ->leftjoin('a_jenpens', 'tr_pensiun.idjenpens', '=', 'a_jenpens.idjenpens')
                    ->whereRaw($where)
                    ->orderByRaw('tr_pensiun.tmtpens DESC, b.idskpd, a_jenpens.idjenpens')
                    ->groupBy('tr_pensiun.tmtpens', 'b.idskpd', 'a_jenpens.idjenpens')
                    ->paginate(@\Session::get('configurations')['list-limit']);
        }else{
            $nominatifpensiuns = $this->nominatifpensiun->all();
        }
        return View::make('nominatifpensiun::index', compact('nominatifpensiuns'));
    }

    public function getCreate(){
        cekAjax();
        return View::make('nominatifpensiun::create');
    }

    public function getCreateaps()
	{
		return View::make('nominatifpensiun::createaps');
    }


    //{controller-show}

        public function getEdit($id = false){
        cekAjax();
        $id = ($id == false)?Input::get('id'):'';
        $nominatifpensiun = $this->nominatifpensiun->find($id);
        //if (is_null($nominatifpensiun)){return \Redirect::to('epensiun/nominatifpensiun/index');}
        return View::make('nominatifpensiun::edit', compact('nominatifpensiun'));
    }

    public function postEdit(){
        cekAjax();
        $id = Input::get('id');
        $input = Input::all();
        $validation = \Validator::make($input, NominatifpensiunModel::$rules);

        if ($validation->passes()){
            $nominatifpensiun = $this->nominatifpensiun->find($id);
            echo ($nominatifpensiun->update($input))?4:"Gagal Disimpan";
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
                $cek = $this->nominatifpensiun->find($id);
                if($cek){
                    $cek->delete();
                }
            }
            echo 'Data berhasil dihapus';
        }
        else{
            echo ($this->nominatifpensiun->find($ids)->delete())?9:0;
        }
    }

    function postNominatif(){
        cekAjax();
        $data['idskpd'] = Input::get('idskpd');
        $data['idjenjab'] = Input::get('idjenjab');
        $data['bulan1'] = Input::get('bulan1');
        $data['bulan2'] = Input::get('bulan2');
        $data['tahun'] = Input::get('tahun');

        return View::make('nominatifpensiun::nominatif', compact('data'));
    }

    public function postCreate() {
        cekAjax();
        $input = Input::All();
        // dd($input);
        $validation = \Validator::make($input, NominatifpensiunModel::$rules);
        if ($validation->passes()){
            $data = array();
            $nip = $input['nip'];
            $skpd = $input['skpd'];
            $almskrpens = $input['almskrpens'];
            $almrtskrpens = $input['almrtskrpens'];
            $almrwskrpens = $input['almrwskrpens'];
            $almdesaskrpens = $input['almdesaskrpens'];
            $almkecskrpens = $input['almkecskrpens'];
            $almkabskrpens = $input['almkabskrpens'];
            $almprovskrpens = $input['almprovskrpens'];

            $bupati = $input['bupati'];
            $idpejabpens = $input['idpejabpens'];
            $pejpenpens = $input['pejpenpens'];
            $jabpenpens = $input['jabpenpens'];
            $nippenpens = $input['nippenpens'];
            $pangkatpenpens = $input['pangkatpenpens'];
            $golrupenpens = $input['golrupenpens'];
            $pejpen_sp = $input['pejpen_sp'];
            $jabpen_sp = $input['jabpen_sp'];
            $nippen_sp = $input['nippen_sp'];
            $golpen_sp = $input['golpen_sp'];
            $pejpen_hukpid = $input['pejpen_hukpid'];
            $jabpen_hukpid = $input['jabpen_hukpid'];
            $nippen_hukpid = $input['nippen_hukpid'];
            $golpen_hukpid = $input['golpen_hukpid'];
            $pangpen_hukpid = $input['pangpen_hukpid'];

            // dd($input);

            $data = array();
            foreach($nip as $key => $item){
                $attr = NominatifpensiunModel::getattrpensiun($item);
                $statussk = 0;
                $idjenkedudupeg = 99;
                $idjenpens = 1;

                $temp_arr = array(
                    'nip' => $item,
                    'idskpdpens' => $skpd[$item],
                    'tmtpens' => $attr->pensiunnext,
                    'almskrpens' => $almskrpens[$item],
                    'almrtskrpens' => $almrtskrpens[$item],
                    'almrwskrpens' => $almrwskrpens[$item],
                    'almdesaskrpens' => $almdesaskrpens[$item],
                    'almkecskrpens' => $almkecskrpens[$item],
                    'almkabskrpens' => $almkabskrpens[$item],
                    'almprovskrpens' => $almprovskrpens[$item],
                    'almpens' => $almskrpens[$item],
                    'almrtpens' => $almrtskrpens[$item],
                    'almrwpens' => $almrwskrpens[$item],
                    'almdesapens' => $almdesaskrpens[$item],
                    'almkecpens' => $almkecskrpens[$item],
                    'almkabpens' => $almkabskrpens[$item],
                    'almprovpens' => $almprovskrpens[$item],
                    'idjenkedudupeg' => $idjenkedudupeg,
                    'idjenpens' => $idjenpens,
                    'statussk' => $statussk,
                    'bupati' => $bupati[$item],
                    'idpejabpens' => $idpejabpens[$item],
                    'pejpenpens' => $pejpenpens[$item],
                    'jabpenpens' => $jabpenpens[$item],
                    'nippenpens' => $nippenpens[$item],
                    'pangkatpenpens' => $pangkatpenpens[$item],
                    'golrupenpens' =>$golrupenpens[$item],
                    'pejpen_sp' => $pejpen_sp[$item],
                    'jabpen_sp' => $jabpen_sp[$item],
                    'nippen_sp' => $nippen_sp[$item],
                    'golpen_sp' => $golpen_sp[$item],
                    'pejpen_hukpid' => $pejpen_hukpid[$item],
                    'jabpen_hukpid' => $jabpen_hukpid[$item],
                    'nippen_hukpid' => $nippen_hukpid[$item],
                    'pangpen_hukpid' => $pangpen_hukpid[$item],
                    'role_id' => \Session::get('role_id'),
                    'created_at' => sekarang(),
                    'user_id' => \Session::get('user_id')
                );
                array_push($data,$temp_arr);
            }

            if (! empty($nip)){
                if(!\DB::table('tr_pensiun')->insert($data)){
                    echo "Nominatif Pensiun gagal disimpan.";
                }else{
                    echo 1;
                }
            }else{
                echo 'Input tidak valid';
            }
        }
        else{
            echo 'Input tidak valid';
        }
    }

    /*function view data atribut dari link */
    function postView($view){
        cekAjax();
        return View::make('nominatifpensiun::'.$view.'_view');
    }

	/*function print atribut dari link */
    public function postData($view){
        $data['nip']  = Input::get('nip');
        return View::make('nominatifpensiun::'.$view.'_data', $data);
    }
}
