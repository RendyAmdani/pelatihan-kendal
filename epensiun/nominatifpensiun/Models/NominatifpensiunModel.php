<?php
namespace App\Modules\epensiun\nominatifpensiun\Models;

use Gemboot\Models\CoreModel as GembootModel;

/**
* Nominatifpensiun Model
* @var Nominatifpensiun
* Generate from Custom Laravel 5.1 by Aa Gun.
*
* Developed by Dinustek.
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class NominatifpensiunModel extends GembootModel {
	protected $guarded = array();

	protected $table = "tr_pensiun";

	public static $rules = array(
    	// 'nip' => 'required',
		/*'idjenpens' => 'required',*/
		// 'tmtpens' => 'required',
		/*'noskpens' => 'required',
		'tglskpens' => 'required',
		'jbtpenetapens' => 'required',*/

    );

	public static function all($columns = array('*')){
		$instance = new static;
        $where = " tr_pensiun.idjenkedudupeg != 1 and tr_pensiun.nip != ''";
        if(session('role_id') > 3){
            if(session('role_id') == 5){
                $where .= " and tr_pensiun.nip = \"".session('user_id')."\" ";
            }else{
                $where .= " and b.idskpd like \"".session('idskpd')."%\" ";
            }
        }

		if (\PermissionsLibrary::hasPermission('mod-nominatifpensiun-index')){
            return $instance->newQuery()
                    ->select(\DB::raw("tr_pensiun.*,tr_pensiun.idjenpens as jenispensiun,
                        b.idgolrucpn, b.tmtcpn, b.mkthncpn, b.mkblncpn,b.*,a_tkpendid.tkpendid,a_jenjurusan.jenjurusan,a_agama.agama,a_jenpens.jenpens,g.path_short,
                        b.idgolrupns, b.tmtpns, e.golru, e.pangkat,
                        c.golru as golrucpn,c.pangkat as pangkatcpn,
                        d.golru as golrupns,d.pangkat as pangkatpns, tr_pensiun.tmtpens"),
                        \DB::raw("CONCAT(b.gdp,IF(LENGTH(b.gdp)>0,' ',''),b.nama,IF(LENGTH(b.gdb)>0,', ',''),b.gdb) AS namalengkap"),
                        \DB::raw("DATE_FORMAT(tr_pensiun.tmtpens,'%d-%m-%Y') AS tmtpens_"),
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
			return $instance->newQuery()
            ->whereRaw($where)
			->where('role_id', \Session::get('role_id'))
			->paginate($_ENV['configurations']['list-limit']);

		}
	}

    //semua jenis pensiun
    public static function comboJenispens($id="idjenpens",$sel="",$required=""){
        $ret = "<select id=\"$id\" name=\"$id\" $required style='width: 100%;' class=\"form-control\">";
        $ret.="<option value=\"\">.: Pilihan :.</option>";

        $rs = \DB::table('a_jenpens')->orderBy('idjenpens','asc')->get();
        foreach($rs as $item){
            $isSel = (($item->idjenpens==$sel)?"selected":"");
            $ret.="<option value=\"".$item->idjenpens."\" $isSel >".$item->jenpens."</option>";
        }
        $ret.="</select>";
        return $ret;
    }

    public static function getattrpensiun($nip) {
        $rs = \DB::table('tb_01')->select('tb_01.*',\DB::raw("CONCAT(LEFT(DATE_ADD(DATE_ADD(tb_01.tglhr, INTERVAL IF(tb_01.idjenjab>=20,a_skpd.bup,IF(tb_01.idjenjab=2,a_jabfung.pens,IF(tb_01.idjenjab=3,a_jabfungum.pens,58))) YEAR), INTERVAL 1 MONTH),8),'01') AS pensiunnext"))
        ->join('a_skpd', 'tb_01.idskpd', '=', 'a_skpd.idskpd')
        ->leftjoin('a_jabfung', 'tb_01.idjabfung', '=', 'a_jabfung.idjabfung')
        ->leftjoin('a_jabfungum', 'tb_01.idjabfungum', '=', 'a_jabfungum.idjabfungum')
        ->where('tb_01.nip', $nip)
        ->orderBy('a_skpd.idskpd', 'desc')
        ->first();

        return $rs;
    }

    /*function untuk mendapatkan data kgb yang sudah verifikasi perorangan*/
    public static function getNominatifver($nip){
        $rs = \DB::table("tr_pensiun as a")
            ->select('a.*','a_agama.agama as agama',
                \DB::raw("b.pangkat as golpnsskr_txt, b.golru as golpns_txt, d.jabatan as pejpenkgbl_txt,f.*,e.skpd,e.path_short,a_tkpendid.tkpendid,a_jenjurusan.jenjurusan"),
                \DB::raw("CONCAT(f.gdp,IF(LENGTH(f.gdp)>0,' ',''),f.nama,IF(LENGTH(f.gdb)>0,', ',''),f.gdb) AS namalengkap"),
                \DB::raw("DATE_FORMAT(a.tmtpens,'%d-%m-%Y') AS tmtpens_, a.tmtpens"),
                \DB::raw("DATE_FORMAT(f.tglhr,'%d-%m-%Y') AS tgllahir_"),
                \DB::raw("DATE_FORMAT(f.tmtpkt,'%d-%m-%Y') AS tmtgollama_"),
                \DB::raw("DATE_FORMAT(f.tmtesljbt,'%d-%m-%Y') AS tmteselon_"),
                \DB::raw('IF(f.idjenjab>4,e.jab,IF(f.idjenjab=2,a_jabfung.jabfung,IF(f.idjenjab=3,a_jabfungum.jabfungum,"-"))) as jabatan'),
                \DB::raw("DATE_FORMAT(f.tmtjbt,'%d-%m-%Y') AS tmtjbt_"),
                \DB::raw("IF(f.idjenjab=2,a_jabfung.jabfung,IF(f.idesljbt BETWEEN '11' AND '51',e.jab,IF(f.idjenjab=3,a_jabfungum.jabfungum,''))) AS namajab"),
                \DB::raw('IF(f.idjenjab>4,e.jab,IF(f.idjenjab=2,a_jabfung.jabfung,IF(f.idjenjab=3,a_jabfungum.jabfungum,"-"))) as jabatan')
            )
            ->join('tb_01 as f', 'a.nip', '=', 'f.nip')
            ->join('a_skpd as e', 'f.idskpd', '=', 'e.idskpd')
            ->leftJoin('a_golruang as b', 'f.idgolrupkt', '=', 'b.idgolru')
            ->leftJoin('a_penetapsk as d', 'f.pejmenpkt', '=', 'd.id')
            ->leftjoin('a_jabfung', 'f.idjabfung', '=', 'a_jabfung.idjabfung')
            ->leftjoin('a_jabfungum', 'f.idjabfungum', '=', 'a_jabfungum.idjabfungum')
            ->leftjoin('a_tkpendid', 'f.idtkpendid', '=', 'a_tkpendid.idtkpendid')
            ->leftjoin('a_jenjurusan', 'f.idjenjurusan', '=', 'a_jenjurusan.idjenjurusan')
            ->leftjoin('a_agama','f.idagama','=','a_agama.idagama')
            ->where('a.nip', $nip)
            ->first();

        return $rs;
    }

    public static function getTemplatesk($idskpd,$jenis='',$idgol=''){
        $role = \Session::get('role_id');
        if($jenis == 1){
            $rs = \DB::table('tr_dpcp_template')
                ->where('idskpd', 'all')
                ->where('jenis', $jenis)
                ->first();
        }else if($jenis == 2){
            $rs = \DB::table('tr_dpcp_template')
                ->where('idskpd', 'all')
                ->where('jenis', $jenis)
                ->first();
        }else{
            $rs = \DB::table('tr_dpcp_template')
                ->where('idskpd', substr($idskpd,0,2))
                ->first();
        }

        if($rs){
            return $rs->template;
        }else{
            return "0";
        }
    }

}
