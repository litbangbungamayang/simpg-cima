DELIMITER $$

DROP TRIGGER /*!50032 IF EXISTS */ `tr_no_ajuan_timbangan`$$

CREATE
    /*!50017 DEFINER = 'root'@'localhost' */
    TRIGGER `tr_no_ajuan_timbangan` BEFORE INSERT ON `t_ubah_timbangan`
    FOR EACH ROW BEGIN

DECLARE nilaimax INT;

	SELECT IFNULL(MAX(RIGHT(no_ajuan,4))+1,1) INTO nilaimax FROM `t_ubah_timbangan` WHERE DATE(tgl_perubahan) = DATE(NOW());

	SET NEW.no_ajuan = CONCAT(SUBSTRING(new.no_spat,1,4),'-',DATE_FORMAT(DATE(NOW()),'%d%m%y'),'-T-',LPAD(nilaimax,4,'0'));

	SET new.tgl_perubahan = NOW();

    END;
$$

DELIMITER ;