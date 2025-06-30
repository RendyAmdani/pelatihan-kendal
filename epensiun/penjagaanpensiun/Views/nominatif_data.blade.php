
<style type='text/css'>
	table {
		font-family: 'Arial';
		font-size: 9pt;
		background: white;
		line-height:1.5;
	}

	table{
	border-collapse:collapse;
	border-width:1px;
	width:100%;
	}

	table thead tr th,table tfoot tr th{
        background-color:#337ab7;
		font-weight:bold;
		padding:4px;
	}

	table tbody tr td{
		padding:4px;
		vertical-align:top;
	}

	table.gen tbody tr td{
		/*height:40px; */
	}

	table tbody td div.r,table tfoot td div.r,table tfoot th div.r{
		text-align:right;
	}
</style>

<br><div align="center">
<h4>DAFTAR NOMINATIF PEGAWAI PENSIUN</h4>
<h4>
    {!!((Input::get('idskpd') != '')?'PADA '.strtoupper(getSkpd(Input::get('idskpd'))):'')!!}
    {!!(((Input::get('bulan1') != '') or (Input::get('bulan2') != ''))?strtoupper($titlebulan):'')!!}
    {!!((Input::get('tahun') != '')?'TAHUN '.Input::get('tahun'):'')!!}
</h4>
</div><br>
<table border="1" width="100%" id="table table-striped table-hover table-condensed table-bordered">
    <thead class="bg-primary">
    <tr>
        <th rowspan="2"><div class="text-center">NO</div></th>
        <th rowspan="2">
            <div class="text-left">NAMA</div>
            <div class="text-left">TEMPAT, TGL LAHIR</div>
        </th>
        <th rowspan="2">
            <div class="text-center">NIP</div>
            <div class="text-center">KARPEG</div>
        </th>
        <th rowspan="2">
            <div class="text-center">GOL.</div>
            <div class="text-center">TMT</div>
        </th>
        <th rowspan="2">
            <div class="text-center">JABATAN</div>
            <div class="text-center">UNIT KERJA</div>
            <div class="text-center">TMT</div>
        </th>
        <th colspan="2">
            <div class="text-center">MASA KERJA</div>
        </th>
          <th colspan="3">
                <div class="text-center">PENDIDIKAN TERAKHIR</div>
          </th>
        <th rowspan="2">
            <div class="text-center">AGAMA</div>
            <div class="text-center">USIA</div>
        </th>
    </tr>
    <tr>
        <th>
            <div class="text-center">THN</div>
        </th>
        <th>
            <div class="text-center">BLN</div>
        </th>
        <th>
            <div class="text-center">TINGKAT</div>
        </th>
        <th>
            <div class="text-center">JENJANG</div>
        </th>
        <th>
            <div class="text-center">TAHUN</div>
        </th>
    </tr>
  </thead>
  <tbody>
    <?php
        if($pegawai){
        $n = 0;
        foreach($pegawai as $item){ $n++;
	?>
    <tr>
        <td align="center">{!!$n!!}.</td>
        <td>
            <div class="text-left">{!!$item->namalengkap!!}</div>
            <small><div class="text-left">{!!$item->tmlhr!!}, {!!($item->tglhr!='0000-00-00')?date('d-m-Y', strtotime($item->tglhr)):''!!}</div></small>
            <small>TMT Pensiun : {!!date("d-m-Y", strtotime($item->pensiunnext))!!}</small>
        </td>
        <td align="center">
            <div class="text-center">{!!$item->nip!!}</div>
            <div class="text-center">{!!$item->nokarpeg!!}</div>
        </td>
        <td align="center">
            <div class="text-center">{!!$item->golrupkt!!}</div>
            <div class="text-center">{!!($item->tmtpkt!='0000-00-00')?date('d-m-Y', strtotime($item->tmtpkt)):''!!}</div>
        </td>
        <td>
            <small>
                <div class="text-left">{!!ucwords($item->jabatan)!!}</div>
                <div class="text-left"><i>Pada</i></div>
                <div class="text-left">{!!ucwords($item->path_short)!!}</div>
                <div class="text-left">TMT : {!!($item->tmtjbt!='0000-00-00')?date('d-m-Y', strtotime($item->tmtjbt)):''!!}</div>
            </small>
        </td>
        <td align="center">
            <div class="text-center">{!!$item->mkthnpkt!!}</div>
        </td>
        <td align="center">
            <div class="text-center">{!!$item->mkblnpkt!!}</div>
        </td>
        <td>
            <div class="text-left">{!!ucwords(strtolower($item->tkpendid))!!}</div>
        </td>
				<td>
						<div class="text-left">{!!ucwords(strtolower($item->jenjurusan))!!}</div>
				</td>
				<td>
						<div class="text-left">{!!$item->thijaz!!}</div>
				</td>
        <td align="center">
            <div class="text-center">{!!$item->agama!!}</div>
            <div class="text-center">{!!substr($item->usia,0,2)!!} thn {!!substr($item->usia,2,2)!!} bln</div>
        </td>
    </tr>
    <?php
        }
    } else {
    ?>
            <tr>
                <td align="center" colspan="15"><h4>Data Tidak Ditemukan</h4></td>
            </tr>
    <?php  } ?>
  </tbody>
</table>
