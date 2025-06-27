<?php
namespace App\Modules\epersonal\statistik\Controllers;

use Gemboot\Controllers\CoreRestController as GembootController;
use App\Modules\epersonal\statistik\Models\StatistikModel;
use Input,View, Request, Form, File;

class StatistikController extends GembootController {

	/**
	 * Statistik Repository
	 *
	 * @var Statistik
	 */
	protected $statistik;

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
		return View::make('statistik::index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('statistik::create');
	}

    public function postStatistik()
	{
		cekAjax();
        $idskpd = Input::get('idskpd');
        $kategori = Input::get('kategori');
        if($idskpd != ''){
            $where = "tb_01.kdunit = \"".$idskpd."\"";
        }else{
            $where = "tb_01.nip != ''";
        }

        switch($kategori){
            case 1: //pendidikan
                $statistik = \DB::table('a_tkpendid')
                ->select('a_tkpendid.idtkpendid', 'a_tkpendid.tkpendid', \DB::raw('COUNT(*) as jumlah'))
                ->leftJoin('tb_01', 'a_tkpendid.idtkpendid', '=', 'tb_01.idtkpendid')
                ->whereRaw($where)
                ->whereNotIn('tb_01.idjenkedudupeg', [99, 21])
                ->orderBy('a_tkpendid.idtkpendid')
                ->groupBy('a_tkpendid.idtkpendid')
                ->get();
                return View::make('statistik::statistik_pendidikan', compact('statistik', 'idskpd'));
            break;
            case 2: //agama
                $statistik = \DB::table('a_agama')
                ->select('a_agama.idagama', 'a_agama.agama', \DB::raw('COUNT(*) as jumlah'))
                ->leftJoin('tb_01', 'a_agama.idagama', '=', 'tb_01.idagama')
                ->whereRaw($where)
                ->whereNotIn('tb_01.idjenkedudupeg', [99, 21])
                ->orderBy('a_agama.idagama')
                ->groupBy('a_agama.idagama')
                ->get();
                return View::make('statistik::statistik_agama', compact('statistik', 'idskpd'));
            break;
            case 3: //golongan
                $statistik = \DB::table('a_golruang')
                ->select('a_golruang.idgolru', 'a_golruang.golru', \DB::raw('COUNT(*) as jumlah'))
                ->leftJoin('tb_01', 'a_golruang.idgolru', '=', 'tb_01.idgolrupkt')
                ->whereRaw($where)
                ->whereNotIn('tb_01.idjenkedudupeg', [99, 21])
                ->orderBy('a_golruang.idgolru')
                ->groupBy('a_golruang.idgolru')
                ->get();
                return View::make('statistik::statistik_golongan', compact('statistik', 'idskpd'));
            break;
        }
	}

    public function postDetail()
	{
		cekAjax();
        $idskpd = Input::get('idskpd');
        $kategori = Input::get('kategori');
        if($idskpd != ''){
            $where = "kdunit = \"".$idskpd."\"";
        }else{
            $where = "nip != ''";
        }

        switch($kategori){
            case 1: //pendidikan
                $idtkpendid = Input::get('idtkpendid');
                $detail = \DB::table('v_tb_01')
                ->whereRaw($where)
                ->where('idtkpendid', $idtkpendid)
                ->whereNotIn('idjenkedudupeg', [99, 21])
                ->orderBy('nip')
                ->get();
                return View::make('statistik::detail_pendidikan', compact('detail'));
            break;
            case 2: //agama
                $idagama = Input::get('idagama');
                $detail = \DB::table('v_tb_01')
                ->whereRaw($where)
                ->where('idagama', $idagama)
                ->whereNotIn('idjenkedudupeg', [99, 21])
                ->orderBy('nip')
                ->get();
                return View::make('statistik::detail_agama', compact('detail'));
            break;
            case 3: //golongan
                $idgolru = Input::get('idgolru');
                $detail = \DB::table('v_tb_01')
                ->whereRaw($where)
                ->where('idgolrupkt', $idgolru)
                ->whereNotIn('idjenkedudupeg', [99, 21])
                ->orderBy('nip')
                ->get();
                return View::make('statistik::detail_golongan', compact('detail'));
            break;
        }
	}
}
