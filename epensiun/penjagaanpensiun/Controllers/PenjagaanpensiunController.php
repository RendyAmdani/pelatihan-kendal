<?php
namespace App\Modules\epensiun\penjagaanpensiun\Controllers;

use Gemboot\Controllers\CoreRestController as GembootController;
use App\Modules\epensiun\penjagaanpensiun\Models\PenjagaanpensiunModel;
use Input,View, Request, Form, File;

class PenjagaanpensiunController extends GembootController {

	/**
	 * Penjagaanpensiun Repository
	 *
	 * @var Penjagaanpensiun
	 */
	protected $penjagaanpensiun;

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
		return View::make('penjagaanpensiun::index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('penjagaanpensiun::create');
	}

    /*function view data atribut dari link */
    function postData($view){
        cekAjax();
        $where = " idjenkedudupeg not in('99','21') and nip != '' ";
        $having = '';

        /* Kondisi jabatan jabatan*/
        if(Input::get('idjenjab') != ''){
            $where.= "and idjenjab = '".Input::get('idjenjab')."'";
        }

        /* Kondisi jenis pegawai*/
        if(Input::get('idstspeg') != ''){
            $where.= "and idstspeg = '".Input::get('idstspeg')."'";
        }

        /* Kondisi Tahun */
        if(Input::get('tahun') != ''){
            $having .= " YEAR(pensiunnext)= ".Input::get('tahun')."";
        }

        /* Kondisi Bulan */
        if((Input::get('bulan1') != '') and (Input::get('bulan2') != '')){
            $having .= " AND MONTH(pensiunnext) between ".Input::get('bulan1')." and ".Input::get('bulan2')."";
            $titlebulan = ' BULAN '.formatBulan(Input::get('bulan1')).' S/D '.formatBulan(Input::get('bulan2'));
        }else if((Input::get('bulan1') != '') and (Input::get('bulan2') == '')){
            $having .= " AND MONTH(pensiunnext)= ".Input::get('bulan1')."";
            $titlebulan = ' BULAN '.formatBulan(Input::get('bulan1'));
        }else if((Input::get('bulan1') == '') and (Input::get('bulan2') != '')){
            $having .= " AND MONTH(pensiunnext)= ".Input::get('bulan2')."";
            $titlebulan = ' BULAN '.formatBulan(Input::get('bulan2'));
        }

        /* Kondisi skpd atau unit kerja */
        if(Input::get('idskpd') != ''){
            $where.= "and idskpd like '".Input::get('idskpd')."%'";
        }

        $pegawai = \DB::table('v_tb_01')
        ->whereRaw($where)
        ->havingRaw($having)
        ->orderBy(\DB::raw('tglhr, idgolrupkt, tmtpkt, nama'))
        ->get();
        return View::make('penjagaanpensiun::'.$view.'_data', compact('pegawai', 'titlebulan'));
    }

    function postPrint($view){
        $where = " idjenkedudupeg not in('99','21') and nip != '' ";
        $having = '';

        /* Kondisi jabatan jabatan*/
        if(Input::get('idjenjab') != ''){
            $where.= "and idjenjab = '".Input::get('idjenjab')."'";
        }

        /* Kondisi jenis pegawai*/
        if(Input::get('idstspeg') != ''){
            $where.= "and idstspeg = '".Input::get('idstspeg')."'";
        }

        /* Kondisi Tahun */
        if(Input::get('tahun') != ''){
            $having .= " YEAR(pensiunnext)= ".Input::get('tahun')."";
        }

        /* Kondisi Bulan */
        if((Input::get('bulan1') != '') and (Input::get('bulan2') != '')){
            $having .= " AND MONTH(pensiunnext) between ".Input::get('bulan1')." and ".Input::get('bulan2')."";
            $titlebulan = ' BULAN '.formatBulan(Input::get('bulan1')).' S/D '.formatBulan(Input::get('bulan2'));
        }else if((Input::get('bulan1') != '') and (Input::get('bulan2') == '')){
            $having .= " AND MONTH(pensiunnext)= ".Input::get('bulan1')."";
            $titlebulan = ' BULAN '.formatBulan(Input::get('bulan1'));
        }else if((Input::get('bulan1') == '') and (Input::get('bulan2') != '')){
            $having .= " AND MONTH(pensiunnext)= ".Input::get('bulan2')."";
            $titlebulan = ' BULAN '.formatBulan(Input::get('bulan2'));
        }

        /* Kondisi skpd atau unit kerja */
        if(Input::get('idskpd') != ''){
            $where.= "and idskpd like '".Input::get('idskpd')."%'";
        }

        $pegawai = \DB::table('v_tb_01')
        ->whereRaw($where)
        ->havingRaw($having)
        ->orderBy(\DB::raw('tglhr, idgolrupkt, tmtpkt, nama'))
        ->get();

        return View::make('penjagaanpensiun::'.$view.'_print', compact('pegawai', 'titlebulan'));
    }

    function postExcel($view){
        $where = " idjenkedudupeg not in('99','21') and nip != '' ";
        $having = '';

        /* Kondisi jabatan jabatan*/
        if(Input::get('idjenjab') != ''){
            $where.= "and idjenjab = '".Input::get('idjenjab')."'";
        }

        /* Kondisi jenis pegawai*/
        if(Input::get('idstspeg') != ''){
            $where.= "and idstspeg = '".Input::get('idstspeg')."'";
        }

        /* Kondisi Tahun */
        if(Input::get('tahun') != ''){
            $having .= " YEAR(pensiunnext)= ".Input::get('tahun')."";
        }

        /* Kondisi Bulan */
        if((Input::get('bulan1') != '') and (Input::get('bulan2') != '')){
            $having .= " AND MONTH(pensiunnext) between ".Input::get('bulan1')." and ".Input::get('bulan2')."";
            $titlebulan = ' BULAN '.formatBulan(Input::get('bulan1')).' S/D '.formatBulan(Input::get('bulan2'));
        }else if((Input::get('bulan1') != '') and (Input::get('bulan2') == '')){
            $having .= " AND MONTH(pensiunnext)= ".Input::get('bulan1')."";
            $titlebulan = ' BULAN '.formatBulan(Input::get('bulan1'));
        }else if((Input::get('bulan1') == '') and (Input::get('bulan2') != '')){
            $having .= " AND MONTH(pensiunnext)= ".Input::get('bulan2')."";
            $titlebulan = ' BULAN '.formatBulan(Input::get('bulan2'));
        }

        /* Kondisi skpd atau unit kerja */
        if(Input::get('idskpd') != ''){
            $where.= "and idskpd like '".Input::get('idskpd')."%'";
        }

        $pegawai = \DB::table('v_tb_01')
        ->whereRaw($where)
        ->havingRaw($having)
        ->orderBy(\DB::raw('tglhr, idgolrupkt, tmtpkt, nama'))
        ->get();

        return View::make('penjagaanpensiun::'.$view.'_excel', compact('pegawai', 'titlebulan'));
    }
}
