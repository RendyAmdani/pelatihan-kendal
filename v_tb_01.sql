CREATE    
    VIEW `v_tb_01` 
    AS
(
SELECT 
    tb_01.*,
    a_goldarah.goldarah,
    a_golrupkt.golru AS golrupkt,
    a_golrupkt.pangkat AS pangkatpkt,
    #a_skpd.skpd,
    #a_esl.esl,
    a_tkpendid.tkpendid,
    a_jenjurusan.jenjurusan,
    #a_stspeg.stspeg,
    IF(tb_01.idstspeg=1,'CPNS',IF(tb_01.idstspeg=2,'PNS',IF(tb_01.idstspeg=3,'PPPK','-'))) AS stspeg,
    a_jenkepeg.jenkepeg,
    a_stskawin.stskawin,
    a_jenkedudupeg.jenkedudupeg,    
    #a_jabfungum.jabfung_id,
    CONCAT(tb_01.gdp, IF(LENGTH(tb_01.gdp) > 0, " ", ""), tb_01.nama, IF(LENGTH(tb_01.gdb) > 0, ", ", ""), tb_01.gdb) AS namalengkap,
    b_skpd.skpd AS unit,
	b_skpd.path_short AS path_short,    
    #a_jenkel.jenkel,
	CONCAT(LEFT(((`tb_01`.`tglhr` + INTERVAL IF((`tb_01`.`idjenjab` >= 20),`b_skpd`.`bup`,IF((`tb_01`.`idjenjab` = 2),`a_jabfung`.`pens`,IF((`tb_01`.`idjenjab` = 3),`a_jabfungum`.`pens`,58))) YEAR) + INTERVAL 1 MONTH),8),'01') AS `pensiunnext`,
    IF(tb_01.idjenkel=1,'Pria', IF(tb_01.idjenkel=2,'Wanita', '-')) AS jenkel,
    a_agama.agama,
    IF(tb_01.idjenjab > 4, b_skpd.jab, 
        IF(tb_01.idjenjab = 2, a_jabfung.jabfung,
            IF(tb_01.idjenjab = 3, a_jabfungum.jabfungum,
                #IF(tb_01.idjenjab = 4, a_jabnonjob.jabnonjob, 
                "-")
            #)
        )
    ) AS jabatan,
    DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW()) - TO_DAYS(tb_01.tglhr)), '%Y%m') + 0 AS usia,
    a_golrucpn.golru AS golrucpn,
    a_golrucpn.pangkat AS pangkatcpn,
    a_golrupns.golru AS golrupns,
    a_golrupns.pangkat AS pangkatpns
FROM tb_01
#INNER JOIN a_skpd ON tb_01.idskpd = a_skpd.idskpd
INNER JOIN a_skpd AS b_skpd ON tb_01.kdunit = b_skpd.idskpd  AND flag = 1
#LEFT JOIN a_esl ON tb_01.idesljbt = a_esl.idesl
LEFT JOIN a_tkpendid ON tb_01.idtkpendid = a_tkpendid.idtkpendid
LEFT JOIN a_jenjurusan ON tb_01.idjenjurusan = a_jenjurusan.idjenjurusan
LEFT JOIN a_golruang AS a_golrucpn ON tb_01.idgolrucpn = a_golrucpn.idgolru
LEFT JOIN a_golruang AS a_golrupns ON tb_01.idgolrupns = a_golrupns.idgolru
LEFT JOIN a_golruang AS a_golrupkt ON tb_01.idgolrupkt = a_golrupkt.idgolru
LEFT JOIN a_agama ON tb_01.idagama = a_agama.idagama
#LEFT JOIN a_jenkel ON tb_01.idjenkel = a_jenkel.idjenkel
#LEFT JOIN a_stspeg ON tb_01.idstspeg = a_stspeg.idstspeg
LEFT JOIN a_jenkepeg ON tb_01.idjenkepeg = a_jenkepeg.idjenkepeg
LEFT JOIN a_stskawin ON tb_01.idstskawin = a_stskawin.idstskawin
LEFT JOIN a_jenkedudupeg ON tb_01.idjenkedudupeg = a_jenkedudupeg.idjenkedudupeg
LEFT JOIN a_jabfung ON tb_01.idjabfung = a_jabfung.idjabfung  AND a_jabfung.flag = 1
LEFT JOIN a_jabfungum ON tb_01.idjabfungum = a_jabfungum.idjabfungum AND a_jabfungum.flag = 1
#LEFT JOIN a_jabnonjob ON tb_01.idjabnonjob = a_jabnonjob.idjabnonjob
LEFT JOIN a_goldarah ON tb_01.idgoldarah = a_goldarah.idgoldarah
#WHERE tb_01.nip = '[ISI_NIP_DI_SINI]'
ORDER BY tb_01.idjenjab ASC, tb_01.idgolrupkt DESC, tb_01.tmtpkt ASC
#LIMIT 1
);
