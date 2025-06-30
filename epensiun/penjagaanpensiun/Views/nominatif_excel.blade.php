<?php
    $title = "";
    $title .=((Input::get('idskpd') != '')?' PADA '.strtoupper(getSkpd(Input::get('idskpd'))):'');
    $title .=(((Input::get('bulan1') != '') or (Input::get('bulan2') != ''))?$titlebulan:'');
    $title .=((Input::get('tahun') != '')?' TAHUN '.Input::get('tahun'):'');

$w="<?xml version=\"1.0\"?>
    <?mso-application progid=\"Excel.Sheet\"?>
    <Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\"
     xmlns:o=\"urn:schemas-microsoft-com:office:office\"
     xmlns:x=\"urn:schemas-microsoft-com:office:excel\"
     xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\"
     xmlns:html=\"http://www.w3.org/TR/REC-html40\">
     <DocumentProperties xmlns=\"urn:schemas-microsoft-com:office:office\">
      <Author>Rendy Amdani</Author>
      <LastAuthor>Rendy Amdani</LastAuthor>
      <Created>2017-01-11T06:01:14Z</Created>
      <Version>15.00</Version>
     </DocumentProperties>
     <OfficeDocumentSettings xmlns=\"urn:schemas-microsoft-com:office:office\">
      <AllowPNG/>
     </OfficeDocumentSettings>
     <ExcelWorkbook xmlns=\"urn:schemas-microsoft-com:office:excel\">
      <WindowHeight>11595</WindowHeight>
      <WindowWidth>19200</WindowWidth>
      <WindowTopX>0</WindowTopX>
      <WindowTopY>0</WindowTopY>
      <ProtectStructure>False</ProtectStructure>
      <ProtectWindows>False</ProtectWindows>
     </ExcelWorkbook>
     <Styles>
      <Style ss:ID=\"Default\" ss:Name=\"Normal\">
       <Alignment ss:Vertical=\"Bottom\"/>
       <Borders/>
       <Font ss:FontName=\"Calibri\" x:Family=\"Swiss\" ss:Size=\"11\" ss:Color=\"#000000\"/>
       <Interior/>
       <NumberFormat/>
       <Protection/>
      </Style>
      <Style ss:ID=\"m316425232\">
       <Alignment ss:Horizontal=\"Center\" ss:Vertical=\"Center\" ss:WrapText=\"1\"/>
       <Borders>
        <Border ss:Position=\"Bottom\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
        <Border ss:Position=\"Left\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
        <Border ss:Position=\"Right\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
        <Border ss:Position=\"Top\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
       </Borders>
      </Style>
      <Style ss:ID=\"m316425252\">
       <Alignment ss:Horizontal=\"Center\" ss:Vertical=\"Center\" ss:WrapText=\"1\"/>
       <Borders>
        <Border ss:Position=\"Left\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
        <Border ss:Position=\"Right\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
        <Border ss:Position=\"Top\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
       </Borders>
      </Style>
      <Style ss:ID=\"m316425272\">
       <Alignment ss:Horizontal=\"Center\" ss:Vertical=\"Center\" ss:WrapText=\"1\"/>
       <Borders>
        <Border ss:Position=\"Left\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
        <Border ss:Position=\"Right\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
        <Border ss:Position=\"Top\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
       </Borders>
      </Style>
      <Style ss:ID=\"s62\">
       <Alignment ss:Horizontal=\"Center\" ss:Vertical=\"Center\"/>
      </Style>
      <Style ss:ID=\"s64\">
       <Alignment ss:Horizontal=\"Center\" ss:Vertical=\"Bottom\"/>
      </Style>
      <Style ss:ID=\"s66\">
       <Alignment ss:Horizontal=\"Center\" ss:Vertical=\"Bottom\"/>
       <NumberFormat ss:Format=\"@\"/>
      </Style>
      <Style ss:ID=\"s73\">
       <Alignment ss:Horizontal=\"Center\" ss:Vertical=\"Center\"/>
       <Borders>
        <Border ss:Position=\"Left\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
        <Border ss:Position=\"Top\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
       </Borders>
      </Style>
      <Style ss:ID=\"s74\">
       <Alignment ss:Horizontal=\"Center\" ss:Vertical=\"Center\"/>
       <Borders>
        <Border ss:Position=\"Left\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
        <Border ss:Position=\"Right\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
        <Border ss:Position=\"Top\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
       </Borders>
      </Style>
      <Style ss:ID=\"s79\">
       <Alignment ss:Horizontal=\"Center\" ss:Vertical=\"Center\" ss:WrapText=\"1\"/>
       <Borders>
        <Border ss:Position=\"Bottom\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
        <Border ss:Position=\"Left\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
       </Borders>
      </Style>
      <Style ss:ID=\"s80\">
       <Alignment ss:Horizontal=\"Center\" ss:Vertical=\"Center\" ss:WrapText=\"1\"/>
       <Borders>
        <Border ss:Position=\"Bottom\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
        <Border ss:Position=\"Left\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
        <Border ss:Position=\"Right\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
       </Borders>
      </Style>
      <Style ss:ID=\"s81\">
       <Alignment ss:Horizontal=\"Center\" ss:Vertical=\"Center\"/>
       <Borders>
        <Border ss:Position=\"Bottom\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
        <Border ss:Position=\"Left\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
        <Border ss:Position=\"Right\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
        <Border ss:Position=\"Top\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
       </Borders>
      </Style>
      <Style ss:ID=\"s83\">
       <Alignment ss:Horizontal=\"Center\" ss:Vertical=\"Center\" ss:WrapText=\"1\"/>
       <Borders>
        <Border ss:Position=\"Bottom\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"
         ss:Color=\"#000000\"/>
        <Border ss:Position=\"Left\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"
         ss:Color=\"#000000\"/>
        <Border ss:Position=\"Right\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"
         ss:Color=\"#000000\"/>
        <Border ss:Position=\"Top\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"
         ss:Color=\"#000000\"/>
       </Borders>
       <Font ss:FontName=\"Arial\" x:Family=\"Swiss\" ss:Size=\"8\" ss:Color=\"#000000\"/>
       <Interior ss:Color=\"#FFFFFF\" ss:Pattern=\"Solid\"/>
       <NumberFormat/>
       <Protection/>
      </Style>
      <Style ss:ID=\"s84\">
       <Alignment ss:Horizontal=\"Left\" ss:Vertical=\"Center\" ss:WrapText=\"1\"/>
       <Borders>
        <Border ss:Position=\"Bottom\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"
         ss:Color=\"#000000\"/>
        <Border ss:Position=\"Left\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"
         ss:Color=\"#000000\"/>
        <Border ss:Position=\"Right\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"
         ss:Color=\"#000000\"/>
        <Border ss:Position=\"Top\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"
         ss:Color=\"#000000\"/>
       </Borders>
       <Font ss:FontName=\"Arial\" x:Family=\"Swiss\" ss:Size=\"8\" ss:Color=\"#000000\"/>
       <Interior ss:Color=\"#FFFFFF\" ss:Pattern=\"Solid\"/>
       <NumberFormat/>
       <Protection/>
      </Style>
     </Styles>
     <Worksheet ss:Name=\"Sheet1\">
      <Table ss:ExpandedColumnCount=\"13000000\" ss:ExpandedRowCount=\"6000000\" x:FullColumns=\"1\"
       x:FullRows=\"1\" ss:DefaultRowHeight=\"15\">
       <Column ss:StyleID=\"s62\" ss:AutoFitWidth=\"0\" ss:Width=\"24\"/>
       <Column ss:AutoFitWidth=\"0\" ss:Width=\"156.75\"/>
       <Column ss:AutoFitWidth=\"0\" ss:Width=\"118.5\"/>
       <Column ss:AutoFitWidth=\"0\" ss:Width=\"69\"/>
       <Column ss:AutoFitWidth=\"0\" ss:Width=\"66.75\"/>
       <Column ss:AutoFitWidth=\"0\" ss:Width=\"224.25\"/>
       <Column ss:AutoFitWidth=\"0\" ss:Width=\"33.75\"/>
       <Column ss:AutoFitWidth=\"0\" ss:Width=\"29.25\"/>
       <Column ss:AutoFitWidth=\"0\" ss:Width=\"32.25\"/>
       <Column ss:AutoFitWidth=\"0\" ss:Width=\"31.5\"/>
       <Column ss:AutoFitWidth=\"0\" ss:Width=\"166.5\"/>
       <Column ss:Width=\"115.5\"/>
       <Column ss:AutoFitWidth=\"0\" ss:Width=\"98.25\"/>
       <Row ss:AutoFitHeight=\"0\">
        <Cell ss:MergeAcross=\"12\" ss:StyleID=\"s64\"><Data ss:Type=\"String\">DAFTAR NOMINATIF PEGAWAI PENSIUN</Data></Cell>
       </Row>
       <Row ss:AutoFitHeight=\"0\">
        <Cell ss:MergeAcross=\"12\" ss:StyleID=\"s66\"><Data ss:Type=\"String\">".$title."</Data></Cell>
       </Row>
       <Row ss:Index=\"4\" ss:AutoFitHeight=\"0\" ss:Height=\"29.25\">
        <Cell ss:MergeDown=\"1\" ss:StyleID=\"m316425232\"><Data ss:Type=\"String\">NO</Data></Cell>
        <Cell ss:StyleID=\"s73\"><Data ss:Type=\"String\">NAMA LENGKAP</Data></Cell>
        <Cell ss:StyleID=\"s73\"><Data ss:Type=\"String\">NIP</Data></Cell>
        <Cell ss:StyleID=\"s73\"><Data ss:Type=\"String\">GOL. </Data></Cell>
        <Cell ss:StyleID=\"s74\"><Data ss:Type=\"String\">JABATAN </Data></Cell>
        <Cell ss:MergeAcross=\"1\" ss:StyleID=\"m316425252\"><Data ss:Type=\"String\">MASA KERJA</Data></Cell>
        <Cell ss:MergeAcross=\"2\" ss:StyleID=\"m316425272\"><Data ss:Type=\"String\">PENDIDIKAN TERAKHIR </Data></Cell>
        <Cell ss:StyleID=\"s74\"><Data ss:Type=\"String\">AGAMA</Data></Cell>
       </Row>
       <Row ss:AutoFitHeight=\"0\" ss:Height=\"20.25\">
        <Cell ss:Index=\"2\" ss:StyleID=\"s79\"><Data ss:Type=\"String\"> TEMPAT, TGL LAHIR</Data></Cell>
        <Cell ss:StyleID=\"s79\"><Data ss:Type=\"String\"> KARPEG</Data></Cell>
        <Cell ss:StyleID=\"s79\"><Data ss:Type=\"String\">TMT</Data></Cell>
        <Cell ss:StyleID=\"s80\"><Data ss:Type=\"String\">UNIT KERJA TMT</Data></Cell>
        <Cell ss:StyleID=\"s81\"><Data ss:Type=\"String\">THN</Data></Cell>
        <Cell ss:StyleID=\"s81\"><Data ss:Type=\"String\">BLN</Data></Cell>
        <Cell ss:StyleID=\"s81\"><Data ss:Type=\"String\">TINGKAT</Data></Cell>
        <Cell ss:StyleID=\"s81\"><Data ss:Type=\"String\">JENJANG</Data></Cell>
        <Cell ss:StyleID=\"s81\"><Data ss:Type=\"String\">TAHUN</Data></Cell>
        <Cell ss:StyleID=\"s80\"><Data ss:Type=\"String\">USIA</Data></Cell>
       </Row>";

if($pegawai != ''){
$n = 0;
foreach($pegawai as $item){ $n++;
    $w.="<Row ss:Height=\"33.75\">
        <Cell ss:StyleID=\"s83\"><Data ss:Type=\"String\">".$n."</Data></Cell>
        <Cell ss:StyleID=\"s84\"><Data ss:Type=\"String\">".$item->namalengkap."&#10;".$item->tmlhr.", ".(($item->tglhr!='0000-00-00')?date('d-m-Y', strtotime($item->tglhr)):'')."&#10;TMT Pensiun : ".date('d-m-Y', strtotime($item->pensiunnext))."</Data></Cell>
        <Cell ss:StyleID=\"s84\"><Data ss:Type=\"String\">".$item->nip."&#10;".$item->nokarpeg."</Data></Cell>
        <Cell ss:StyleID=\"s83\"><Data ss:Type=\"String\">".$item->golrupkt."&#10;".(($item->tmtpkt!='0000-00-00')?date('d-m-Y', strtotime($item->tmtpkt)):'')."</Data></Cell>
        <Cell ss:StyleID=\"s84\"><Data ss:Type=\"String\">".$item->jabatan." pada ".$item->path_short."&#10;".(($item->tmtjbt!='0000-00-00')?date('d-m-Y', strtotime($item->tmtjbt)):'')."</Data></Cell>
        <Cell ss:StyleID=\"s83\"><Data ss:Type=\"String\">".$item->mkthnpkt."</Data></Cell>
        <Cell ss:StyleID=\"s83\"><Data ss:Type=\"String\">".$item->mkblnpkt."</Data></Cell>
        <Cell ss:StyleID=\"s84\"><Data ss:Type=\"String\">".ucwords(strtolower($item->tkpendid))."</Data></Cell>
        <Cell ss:StyleID=\"s84\"><Data ss:Type=\"String\">".ucwords(strtolower($item->jenjurusan))."</Data></Cell>
        <Cell ss:StyleID=\"s84\"><Data ss:Type=\"String\">".$item->thijaz."</Data></Cell>
        <Cell ss:StyleID=\"s84\"><Data ss:Type=\"String\">".$item->agama."&#10;".substr($item->usia,0,2)." thn ".substr($item->usia,2,2)."</Data></Cell>
       </Row>";
       }
      }else{
        $w.="<Row ss:AutoFitHeight=\"0\" ss:Height=\"18\">
            <Cell ss:StyleID=\"s74\"><Data ss:Type=\"String\">Data yang anda cari tidak ditemukan</Data></Cell>
        </Row>";
      }

$w.="</Table>
      <WorksheetOptions xmlns=\"urn:schemas-microsoft-com:office:excel\">
       <PageSetup>
        <Header x:Margin=\"0.3\"/>
        <Footer x:Margin=\"0.3\"/>
        <PageMargins x:Bottom=\"0.75\" x:Left=\"0.7\" x:Right=\"0.7\" x:Top=\"0.75\"/>
       </PageSetup>
       <Unsynced/>
       <Print>
        <ValidPrinterInfo/>
        <HorizontalResolution>600</HorizontalResolution>
        <VerticalResolution>600</VerticalResolution>
       </Print>
       <Selected/>
       <DoNotDisplayGridlines/>
       <Panes>
        <Pane>
         <Number>3</Number>
         <ActiveRow>3</ActiveRow>
         <RangeSelection>R4C1:R5C1</RangeSelection>
        </Pane>
       </Panes>
       <ProtectObjects>False</ProtectObjects>
       <ProtectScenarios>False</ProtectScenarios>
      </WorksheetOptions>
     </Worksheet>
    </Workbook>";
force_download("penjagaan_pensiun".date('Ymds').".xls", $w);
?>
