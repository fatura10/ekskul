SELECT a.`id_jadwal`,a.`id_mapel`,a.id_guru,a.`jam`, a.hari,b.`nama_guru`,c.`mapel`,d.`nama`,e.`absen_in`,e.`absen_out` ,
a.`starting_hour`, a.`finishing_hour`,DATE_FORMAT(NOW(),'%d %M %Y') AS datenow
FROM tb_japel a
JOIN tb_guru b ON a.`id_guru`=b.`id_guru`
JOIN tb_mapel c ON c.`id_mapel` = a.`id_mapel`
JOIN tb_kelas d ON d.`id_kelas` = a.`id_kelas`
LEFT JOIN tb_absen e ON e.`id_jadwal`=a.`id_jadwal`
JOIN tb_hari f ON f.`nama` = a.`hari`
WHERE f.`id_hari`=DAYOFWEEK('2019-12-30') AND DATE_FORMAT('2019-12-30 09:00:00', '%H:%i:%s')  BETWEEN a.`starting_hour` AND a.`finishing_hour` AND a.`id_guru`='1911300286'


/*select dayofweek('2019-12-30')*/
/*select DATE_FORMAT(now(), '%H:%i:%s')*/