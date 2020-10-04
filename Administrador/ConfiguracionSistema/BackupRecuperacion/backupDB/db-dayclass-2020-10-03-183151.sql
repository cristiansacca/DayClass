

CREATE TABLE `administrativo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apellidoAdm` varchar(255) DEFAULT NULL,
  `contraseniaAdm` varchar(255) DEFAULT NULL,
  `dniAdm` int(11) NOT NULL,
  `emailAdm` varchar(255) DEFAULT NULL,
  `fechaAltaAdm` date DEFAULT NULL,
  `fechaBajaAdm` date DEFAULT NULL,
  `fechaNacAdm` date DEFAULT NULL,
  `legajoAdm` varchar(255) NOT NULL,
  `nombreAdm` varchar(255) DEFAULT NULL,
  `permiso_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKrmoejtr2yebukeu2kuvo3xwg7` (`permiso_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

INSERT INTO administrativo VALUES("1","admin","$2y$10$TNPmQGaxFNd2BjDLhR5YkuJzu1u530Pj9BAdPgsbSJF7kkdIy0Uka","11111111","admin@dayclass.com","2020-07-30","","","12345","admin","3");
INSERT INTO administrativo VALUES("3","Belgrano","$2y$10$jAbn77SvQghX0tLqK61iJ.WYRyxobac9Q.OeOuLFn6eL6CXaqAL7m","2358796","abelgrano@mail.com","2020-08-30","","1970-07-17","AD78517","Ana","3");
INSERT INTO administrativo VALUES("4","Juarez","$2y$10$.Khvk2Yg9Qc.hn8mGOreYeu7rcDT7ptJAdcDIXUIZ2z3ekYmVny8O","2564895","pjuarez@mail.com","2020-08-30","","1970-06-18","AD78519","Pedro","3");
INSERT INTO administrativo VALUES("5","Rodriguez","$2y$10$uy.2xCN6qnEqdL/x5OYPOu9.BNenA1szWS.4Y.OABnZE9b3TxQw/e","21546987","drodriguez@mail.com","2020-08-31","","1953-10-06","AD96541","Diego","3");
INSERT INTO administrativo VALUES("6","Noya","$2y$10$R4OsbbLH8XYcLw8GaQhxhuP9ibvbmwN/r1bRK52L4gNNLKbiqgJ/W","15698735","rnoya@mail.com","2020-08-31","","1965-06-17","15698735","Rodrigo","3");
INSERT INTO administrativo VALUES("7","sgroi","$2y$10$l9PjPmh6O4vQn9m7X0K/pOjFLzmZ4jtx5qw8ST91rXEt46f79q3du","5236974","lucasSgroi@mail.com","2020-09-04","","1985-06-03","96548","Lucas","3");
INSERT INTO administrativo VALUES("8","Hacha","$2y$10$wCF0iz5kgq5ioneRiAbv3OKRtYRZ9Nyw6KtONFVbT6505UNLqmdW.","4523178","mhacha@mail.com","2020-09-06","","1970-06-18","AD78787","Marina","3");
INSERT INTO administrativo VALUES("9","Estebanez","$2y$10$qSg17bK4yFiMyz1DIZDtJusgGhL5fJEmo/89jpOJf8bUSVPyqWgeG","45213985","pestebanez@mail.com","2020-09-06","","1990-02-22","AD12457","Pedro","3");
INSERT INTO administrativo VALUES("10","Seguro","$2y$10$zt5cyY4CSJvQqtEZngTSN.wQ5V3GOwx6f9gkf33EUAPA1pWzZdN/e","7854236","pseguro@mail.com","2020-09-06","","1969-08-22","AD89542","Pascual","3");
INSERT INTO administrativo VALUES("12","Fernandez","$2y$10$ewoAwCMmfu6qebGfmYo6hOa/viZnsjvYJeKoaY9hVAfqTAQXWjkXe","4521369","efernandez@mail.com","2020-09-06","","1990-06-06","AD30000","Emilia","3");
INSERT INTO administrativo VALUES("14","Fernandez","$2y$10$CKwwvmfDkou63vl.hCRiVuy4Jwsatyd66/W/sNBvRuyGjjmliSIzW","1000000","lfernandez@mail.com","2020-09-06","","1988-10-22","AD10000","Lucas","3");
INSERT INTO administrativo VALUES("15","Arias","$2y$10$1GUauTxLWtHwN/YyL2cBtO1hgFigOoVxO9tMLyOJqn7TgypviWuNi","10101010","warias@mail.com","2020-09-09","","2011-02-09","AD10101","Wilfredo","3");
INSERT INTO administrativo VALUES("16","liz","$2y$10$znV8YvjDLMVA7BjV1M74t.5082lIWeGONTWZRYVkpzxTCJj3v87qe","7513689","diegoL@mail.com","2020-09-15","","1990-02-13","AD90000","Diego","3");
INSERT INTO administrativo VALUES("17","lopez","$2y$10$9yeUVnwC0BHQUAoE.rTg1.qiuUs60IbgejMajGnpE/Gi/CFhkNsZ.","2000033","juall@mail.com","2020-09-22","","1990-02-02","AD85236","juan","3");





CREATE TABLE `alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apellidoAlum` varchar(255) DEFAULT NULL,
  `contraseniaAlum` varchar(255) DEFAULT NULL,
  `dniAlum` int(11) NOT NULL,
  `emailAlum` varchar(255) DEFAULT NULL,
  `fechaAltaAlumno` date DEFAULT NULL,
  `fechaBajaAlumno` date DEFAULT NULL,
  `fechaNacAlumno` date DEFAULT NULL,
  `legajoAlumno` varchar(255) NOT NULL,
  `nombreAlum` varchar(255) DEFAULT NULL,
  `permiso_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKctdmkskdhf5bla743m05m1u3x` (`permiso_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1856 DEFAULT CHARSET=utf8mb4;

INSERT INTO alumno VALUES("1614","Alfaro","","46586634","","2020-09-08","","","AL41097","Cristina","1");
INSERT INTO alumno VALUES("1615","Allison","","9190607","","2020-09-08","","","AL41098","Cameron","1");
INSERT INTO alumno VALUES("1616","Alvarado","","44685116","","2020-09-08","","","AL41099","Maite","1");
INSERT INTO alumno VALUES("1617","Andrada","","18147102","","2020-09-08","","","AL41100","Pamela ","1");
INSERT INTO alumno VALUES("1618","Antares","","43677391","","2020-09-08","","","AL41101","Hugo","1");
INSERT INTO alumno VALUES("1619","Atkinson","","12004396","","2020-09-08","","","AL41102","Libby","1");
INSERT INTO alumno VALUES("1620","Barker","","7366016","","2020-09-08","","","AL41103","Nissim","1");
INSERT INTO alumno VALUES("1621","Barr","","42906639","","2020-09-08","","","AL41104","Omar","1");
INSERT INTO alumno VALUES("1622","Barrera","","30388106","","2020-09-08","","","AL41105","Ainsley","1");
INSERT INTO alumno VALUES("1623","Barrera","","41989681","","2020-09-08","","","AL41106","Ezra","1");
INSERT INTO alumno VALUES("1624","Barry","","24682669","","2020-09-08","","","AL41107","Finn","1");
INSERT INTO alumno VALUES("1625","Beard","","22330635","","2020-09-08","","","AL41108","Ivan","1");
INSERT INTO alumno VALUES("1626","Beasley","","15427371","","2020-09-08","","","AL41109","Aimee","1");
INSERT INTO alumno VALUES("1627","Benton","","22621912","","2020-09-08","","","AL41110","Abel","1");
INSERT INTO alumno VALUES("1628","Berry","","16979721","","2020-09-08","","","AL41111","Levi","1");
INSERT INTO alumno VALUES("1629","Blackburn","","26084777","","2020-09-08","","","AL41112","Oprah","1");
INSERT INTO alumno VALUES("1630","Blanco","","13452240","","2020-09-08","","","AL41113","Eusebio ","1");
INSERT INTO alumno VALUES("1631","Blevins","","48996568","","2020-09-08","","","AL41114","Oscar","1");
INSERT INTO alumno VALUES("1632","Bowman","","48709695","","2020-09-08","","","AL41115","Lillian","1");
INSERT INTO alumno VALUES("1633","Boyd","","46104830","","2020-09-08","","","AL41116","Nayda","1");
INSERT INTO alumno VALUES("1634","Bradford","","17466469","","2020-09-08","","","AL41117","Kenneth","1");
INSERT INTO alumno VALUES("1635","Bradley","","31046654","","2020-09-08","","","AL41118","Joel","1");
INSERT INTO alumno VALUES("1636","Burks","","49686278","","2020-09-08","","","AL41119","Noah","1");
INSERT INTO alumno VALUES("1637","Bush","","11935283","","2020-09-08","","","AL41120","Rudyard","1");
INSERT INTO alumno VALUES("1638","Calderon","","43750049","","2020-09-08","","","AL41121","Heather","1");
INSERT INTO alumno VALUES("1639","Caldwell","","36385416","","2020-09-08","","","AL41122","Victor","1");
INSERT INTO alumno VALUES("1640","Calero","","9028700","","2020-09-08","","","AL41123","Rafael","1");
INSERT INTO alumno VALUES("1641","Camacho","","48784498","","2020-09-08","","","AL41124","Kieran","1");
INSERT INTO alumno VALUES("1642","Cano","","27374218","","2020-09-08","","","AL41125","Rosa Maria","1");
INSERT INTO alumno VALUES("1643","Cantu","","31636157","","2020-09-08","","","AL41126","Gabriel","1");
INSERT INTO alumno VALUES("1644","Carr","","49953301","","2020-09-08","","","AL41127","Fay","1");
INSERT INTO alumno VALUES("1645","Carson","","29117970","","2020-09-08","","","AL41128","Brian","1");
INSERT INTO alumno VALUES("1646","Carver","","45266483","","2020-09-08","","","AL41129","Clinton","1");
INSERT INTO alumno VALUES("1647","Case","","21409081","","2020-09-08","","","AL41130","Barrett","1");
INSERT INTO alumno VALUES("1648","Case","","30308657","","2020-09-08","","","AL41131","Lev","1");
INSERT INTO alumno VALUES("1649","Casey","","34665895","","2020-09-08","","","AL41132","Walter","1");
INSERT INTO alumno VALUES("1650","Castillo","","6390630","","2020-09-08","","","AL41133","Juana","1");
INSERT INTO alumno VALUES("1651","Chandler","","32311568","","2020-09-08","","","AL41134","Ivy","1");
INSERT INTO alumno VALUES("1652","Chaney","","32100255","","2020-09-08","","","AL41135","Carlos","1");
INSERT INTO alumno VALUES("1653","Cherry","","30701387","","2020-09-08","","","AL41136","Dalton","1");
INSERT INTO alumno VALUES("1654","Cherry","","48282154","","2020-09-08","","","AL41137","Jeanette","1");
INSERT INTO alumno VALUES("1655","Christensen","","15294557","","2020-09-08","","","AL41138","Sasha","1");
INSERT INTO alumno VALUES("1656","Clarke","","29722234","","2020-09-08","","","AL41139","Cheyenne","1");
INSERT INTO alumno VALUES("1657","Clay","","24483666","","2020-09-08","","","AL41140","Josiah","1");
INSERT INTO alumno VALUES("1658","Coffey","","18849012","","2020-09-08","","","AL41141","Blaine","1");
INSERT INTO alumno VALUES("1659","Coffey","","21289686","","2020-09-08","","","AL41142","Veronica","1");
INSERT INTO alumno VALUES("1660","Collier","","45686853","","2020-09-08","","","AL41143","Azalia","1");
INSERT INTO alumno VALUES("1661","Conley","","43475325","","2020-09-08","","","AL41144","Kyra","1");
INSERT INTO alumno VALUES("1662","Conley","","30239463","","2020-09-08","","","AL41145","Rajah","1");
INSERT INTO alumno VALUES("1663","Conner","","45399925","","2020-09-08","","","AL41146","Brett","1");
INSERT INTO alumno VALUES("1664","Cuenca","","24844311","","2020-09-08","","","AL41147","Alejandro","1");
INSERT INTO alumno VALUES("1665","Cummings","","42555216","","2020-09-08","","","AL41148","Roary","1");
INSERT INTO alumno VALUES("1666","Cunningham","","46743067","","2020-09-08","","","AL41149","Kennedy","1");
INSERT INTO alumno VALUES("1667","Delaney","","45145072","","2020-09-08","","","AL41150","Jessica","1");
INSERT INTO alumno VALUES("1668","Delaney","","12487810","","2020-09-08","","","AL41151","Palmer","1");
INSERT INTO alumno VALUES("1669","Dillard","","34660087","","2020-09-08","","","AL41152","August","1");
INSERT INTO alumno VALUES("1670","Dorsey","","27721420","","2020-09-08","","","AL41153","Dane","1");
INSERT INTO alumno VALUES("1671","Downs","","33031532","","2020-09-08","","","AL41154","Aline","1");
INSERT INTO alumno VALUES("1672","Drake","","33192449","","2020-09-08","","","AL41155","Damon","1");
INSERT INTO alumno VALUES("1673","Duncan","","43348668","","2020-09-08","","","AL41156","Iris","1");
INSERT INTO alumno VALUES("1674","Dunlap","","38157891","","2020-09-08","","","AL41157","Wang","1");
INSERT INTO alumno VALUES("1675","Ellis","","16532140","","2020-09-08","","","AL41158","Kibo","1");
INSERT INTO alumno VALUES("1676","English","","42837826","","2020-09-08","","","AL41159","Brennan","1");
INSERT INTO alumno VALUES("1677","Evans","","38474198","","2020-09-08","","","AL41160","Bruno","1");
INSERT INTO alumno VALUES("1678","Farley","","12346991","","2020-09-08","","","AL41161","Hiroko","1");
INSERT INTO alumno VALUES("1679","Farley","","35406343","","2020-09-08","","","AL41162","Quentin","1");
INSERT INTO alumno VALUES("1680","Figueroa","","19459406","","2020-09-08","","","AL41163","Xerxes","1");
INSERT INTO alumno VALUES("1681","Fletcher","","49708703","","2020-09-08","","","AL41164","Candice","1");
INSERT INTO alumno VALUES("1682","Foster","","37469970","","2020-09-08","","","AL41165","Shaine","1");
INSERT INTO alumno VALUES("1683","Franco","","39549507","","2020-09-08","","","AL41166","Nicholas","1");
INSERT INTO alumno VALUES("1684","Franco","","36959025","","2020-09-08","","","AL41167","Phyllis","1");
INSERT INTO alumno VALUES("1685","Franklin","","16309654","","2020-09-08","","","AL41168","Shellie","1");
INSERT INTO alumno VALUES("1686","Fulton","","18529843","","2020-09-08","","","AL41169","Clio","1");
INSERT INTO alumno VALUES("1687","Garrido","","25772496","","2020-09-08","","","AL41170","Miguel Angel","1");
INSERT INTO alumno VALUES("1688","Garrison","","26818620","","2020-09-08","","","AL41171","Kelsey","1");
INSERT INTO alumno VALUES("1689","Garruson","","23159573","","2020-09-08","","","AL41172","Laura","1");
INSERT INTO alumno VALUES("1690","Glap","","35283269","","2020-09-08","","","AL41173","Cedric","1");
INSERT INTO alumno VALUES("1691","Glover","","6875664","","2020-09-08","","","AL41174","Kitra","1");
INSERT INTO alumno VALUES("1692","Goodwin","","26587375","","2020-09-08","","","AL41175","Lilah","1");
INSERT INTO alumno VALUES("1693","Grant","","48772372","","2020-09-08","","","AL41176","Miranda","1");
INSERT INTO alumno VALUES("1694","Hahn","","30776213","","2020-09-08","","","AL41177","Zane","1");
INSERT INTO alumno VALUES("1695","Hampton","","48099435","","2020-09-08","","","AL41178","Lucas","1");
INSERT INTO alumno VALUES("1696","Haney","","18780604","","2020-09-08","","","AL41179","Jarrod","1");
INSERT INTO alumno VALUES("1697","Hansen","","49867796","","2020-09-08","","","AL41180","Timon","1");
INSERT INTO alumno VALUES("1698","Harris","","7029267","","2020-09-08","","","AL41181","Cameron","1");
INSERT INTO alumno VALUES("1699","Hartman","","14669989","","2020-09-08","","","AL41182","Zahir","1");
INSERT INTO alumno VALUES("1700","Henderson","","15307164","","2020-09-08","","","AL41183","Finn","1");
INSERT INTO alumno VALUES("1701","Herman","","9478391","","2020-09-08","","","AL41184","Eve","1");
INSERT INTO alumno VALUES("1702","hernandez","","26065721","","2020-09-08","","","AL41185","daniel","1");
INSERT INTO alumno VALUES("1703","Herring","","36503934","","2020-09-08","","","AL41186","Oliver","1");
INSERT INTO alumno VALUES("1704","Hewitt","","46508041","","2020-09-08","","","AL41187","Isadora","1");
INSERT INTO alumno VALUES("1705","Hickman","","48459517","","2020-09-08","","","AL41188","Ariana","1");
INSERT INTO alumno VALUES("1706","Hilord","","11680657","","2020-09-08","","","AL41189","Akeem","1");
INSERT INTO alumno VALUES("1707","Horton","","10527975","","2020-09-08","","","AL41190","Curran","1");
INSERT INTO alumno VALUES("1708","Howe","","13320912","","2020-09-08","","","AL41191","Rowan","1");
INSERT INTO alumno VALUES("1709","Howell","","21001931","","2020-09-08","","","AL41192","Stacy","1");
INSERT INTO alumno VALUES("1710","Huff","","29820020","","2020-09-08","","","AL41193","Jerry","1");
INSERT INTO alumno VALUES("1711","Hurley","","31082253","","2020-09-08","","","AL41194","Tamara","1");
INSERT INTO alumno VALUES("1712","Irwin","","49176547","","2020-09-08","","","AL41195","Shea","1");
INSERT INTO alumno VALUES("1713","Jacobs","","22905831","","2020-09-08","","","AL41196","Lane","1");
INSERT INTO alumno VALUES("1714","Jarvis","","23521654","","2020-09-08","","","AL41197","Cathleen","1");
INSERT INTO alumno VALUES("1715","Johnson","","7528332","","2020-09-08","","","AL41198","Leslie","1");
INSERT INTO alumno VALUES("1716","Jones","","16835660","","2020-09-08","","","AL41199","Grant","1");
INSERT INTO alumno VALUES("1717","Joseph","","13084195","","2020-09-08","","","AL41200","Burke","1");
INSERT INTO alumno VALUES("1718","Joyner","","26067341","","2020-09-08","","","AL41201","Kaitlin","1");
INSERT INTO alumno VALUES("1719","Juarez","","27612120","","2020-09-08","","","AL41202","Alisa","1");
INSERT INTO alumno VALUES("1720","Kelley","","46067823","","2020-09-08","","","AL41203","Sydney","1");
INSERT INTO alumno VALUES("1721","Kidd","","8544513","","2020-09-08","","","AL41204","Cruz","1");
INSERT INTO alumno VALUES("1722","King","","36097579","","2020-09-08","","","AL41205","Shea","1");
INSERT INTO alumno VALUES("1723","Klein","","14523329","","2020-09-08","","","AL41206","Vivian","1");
INSERT INTO alumno VALUES("1724","Klein","","32614691","","2020-09-08","","","AL41207","Zelda","1");
INSERT INTO alumno VALUES("1725","Lamb","","28074424","","2020-09-08","","","AL41208","Demetria","1");
INSERT INTO alumno VALUES("1726","Lamb","","40646382","","2020-09-08","","","AL41209","Kuame","1");
INSERT INTO alumno VALUES("1727","Leach","","45293197","","2020-09-08","","","AL41210","Renee","1");
INSERT INTO alumno VALUES("1728","Lee","","27781028","","2020-09-08","","","AL41211","Aline","1");
INSERT INTO alumno VALUES("1729","Lucas","","28726855","","2020-09-08","","","AL41212","Keiko","1");
INSERT INTO alumno VALUES("1730","Macdonald","","31524309","","2020-09-08","","","AL41213","Hilda","1");
INSERT INTO alumno VALUES("1731","Malone","","21060218","","2020-09-08","","","AL41214","Pearl","1");
INSERT INTO alumno VALUES("1732","marin","","31975106","","2020-09-08","","","AL41215","raquel","1");
INSERT INTO alumno VALUES("1733","Marks","","40319991","","2020-09-08","","","AL41216","Samuel","1");
INSERT INTO alumno VALUES("1734","martinez","","22330766","","2020-09-08","","","AL41217","marta ","1");
INSERT INTO alumno VALUES("1735","Mcdonald","","21106410","","2020-09-08","","","AL41218","Ria","1");
INSERT INTO alumno VALUES("1736","Mcfadden","","13815202","","2020-09-08","","","AL41219","Quamar","1");
INSERT INTO alumno VALUES("1737","Mcintosh","","47093288","","2020-09-08","","","AL41220","Channing","1");
INSERT INTO alumno VALUES("1738","Mckenzie","","25376667","","2020-09-08","","","AL41221","Harriet","1");
INSERT INTO alumno VALUES("1739","Mclean","","42651808","","2020-09-08","","","AL41222","Avram","1");
INSERT INTO alumno VALUES("1740","Meadows","","41420760","","2020-09-08","","","AL41223","Blaze","1");
INSERT INTO alumno VALUES("1741","Melendez","","21680638","","2020-09-08","","","AL41224","Fay","1");
INSERT INTO alumno VALUES("1742","Melton","","6038948","","2020-09-08","","","AL41225","Jelani","1");
INSERT INTO alumno VALUES("1743","Mercado","","34567537","","2020-09-08","","","AL41226","Jameson","1");
INSERT INTO alumno VALUES("1744","Mercer","","48837147","","2020-09-08","","","AL41227","Howard","1");
INSERT INTO alumno VALUES("1745","Mercer","","8388803","","2020-09-08","","","AL41228","Quail","1");
INSERT INTO alumno VALUES("1746","Merritt","","13556299","","2020-09-08","","","AL41229","Hamish","1");
INSERT INTO alumno VALUES("1747","Meyer","","11891058","","2020-09-08","","","AL41230","Reese","1");
INSERT INTO alumno VALUES("1748","Miles","","9612128","","2020-09-08","","","AL41231","Rana","1");
INSERT INTO alumno VALUES("1749","Mooney","","21527247","","2020-09-08","","","AL41232","Katelyn","1");
INSERT INTO alumno VALUES("1750","Mooney","","34541073","","2020-09-08","","","AL41233","Magee","1");
INSERT INTO alumno VALUES("1751","Morales","","34969826","","2020-09-08","","","AL41234","Nathan","1");
INSERT INTO alumno VALUES("1752","Moralez","","49207332","","2020-09-08","","","AL41235","manuela","1");
INSERT INTO alumno VALUES("1753","Moreno","","32484160","","2020-09-08","","","AL41236","maria pilar","1");
INSERT INTO alumno VALUES("1754","Morgan","","23808848","","2020-09-08","","","AL41237","Coby","1");
INSERT INTO alumno VALUES("1755","Mueller","","48882260","","2020-09-08","","","AL41238","Gail","1");
INSERT INTO alumno VALUES("1756","Mullen","","16244592","","2020-09-08","","","AL41239","Nina","1");
INSERT INTO alumno VALUES("1757","Muñoz","","44888501","","2020-09-08","","","AL41240","Juan Jose","1");
INSERT INTO alumno VALUES("1758","Murphy","","24556744","","2020-09-08","","","AL41241","Ayanna","1");
INSERT INTO alumno VALUES("1759","Murphy","","10507943","","2020-09-08","","","AL41242","Demetrius","1");
INSERT INTO alumno VALUES("1760","Nelson","","45757180","","2020-09-08","","","AL41243","Germane","1");
INSERT INTO alumno VALUES("1761","Newton","","31400914","","2020-09-08","","","AL41244","Timothy","1");
INSERT INTO alumno VALUES("1762","Nielsen","","18843297","","2020-09-08","","","AL41245","Pascale","1");
INSERT INTO alumno VALUES("1763","Oliver","","7905790","","2020-09-08","","","AL41246","Ursa","1");
INSERT INTO alumno VALUES("1764","Oneal","","33431495","","2020-09-08","","","AL41247","Nathaniel","1");
INSERT INTO alumno VALUES("1765","Oneil","","15651752","","2020-09-08","","","AL41248","Madeson","1");
INSERT INTO alumno VALUES("1766","Ortega","","46287308","","2020-09-08","","","AL41249","Marta","1");
INSERT INTO alumno VALUES("1767","Ortiz","","34755891","","2020-09-08","","","AL41250","Encarnacion","1");
INSERT INTO alumno VALUES("1768","Ortiz","","45968273","","2020-09-08","","","AL41251","Hammett","1");
INSERT INTO alumno VALUES("1769","Ortiz ","","22047023","","2020-09-08","","","AL41252","Pablo ","1");
INSERT INTO alumno VALUES("1770","Parker","","23141185","","2020-09-08","","","AL41253","Kato","1");
INSERT INTO alumno VALUES("1771","Parsons","","40338231","","2020-09-08","","","AL41254","Lynn","1");
INSERT INTO alumno VALUES("1772","Patterson","","20699148","","2020-09-08","","","AL41255","Octavia","1");
INSERT INTO alumno VALUES("1773","Patterson","","40274537","","2020-09-08","","","AL41256","Rosalyn","1");
INSERT INTO alumno VALUES("1774","Paul","","14150114","","2020-09-08","","","AL41257","Leila","1");
INSERT INTO alumno VALUES("1775","Payne","","40817811","","2020-09-08","","","AL41258","Portia","1");
INSERT INTO alumno VALUES("1776","Perez","","14597246","","2020-09-08","","","AL41259","Gray","1");
INSERT INTO alumno VALUES("1777","Perez","","33124056","","2020-09-08","","","AL41260","Paula","1");
INSERT INTO alumno VALUES("1778","Petersen","","34224227","","2020-09-08","","","AL41261","Blossom","1");
INSERT INTO alumno VALUES("1779","Petty","","21111049","","2020-09-08","","","AL41262","Cameran","1");
INSERT INTO alumno VALUES("1780","Picazo","","12821197","","2020-09-08","","","AL41263","Elena","1");
INSERT INTO alumno VALUES("1781","Puckett","","47537619","","2020-09-08","","","AL41264","Zahir","1");
INSERT INTO alumno VALUES("1782","Ramirez","","12693189","","2020-09-08","","","AL41265","Mariela","1");
INSERT INTO alumno VALUES("1783","Ramsey","","28423363","","2020-09-08","","","AL41266","Kenyon","1");
INSERT INTO alumno VALUES("1784","Ray","","27150078","","2020-09-08","","","AL41267","Marny","1");
INSERT INTO alumno VALUES("1785","Raymond","","8874625","","2020-09-08","","","AL41268","Gary","1");
INSERT INTO alumno VALUES("1786","Raymond","","13772878","","2020-09-08","","","AL41269","Theodore","1");
INSERT INTO alumno VALUES("1787","Reeves","","30943501","","2020-09-08","","","AL41270","Dominic","1");
INSERT INTO alumno VALUES("1788","Reilly","","25018737","","2020-09-08","","","AL41271","Hanna","1");
INSERT INTO alumno VALUES("1789","Richards","","9971350","","2020-09-08","","","AL41272","Jesse","1");
INSERT INTO alumno VALUES("1790","Robbins","","23049612","","2020-09-08","","","AL41273","Amir","1");
INSERT INTO alumno VALUES("1791","Roberson","","38627621","","2020-09-08","","","AL41274","Mollie","1");
INSERT INTO alumno VALUES("1792","Robertson","","12148427","","2020-09-08","","","AL41275","Eliana","1");
INSERT INTO alumno VALUES("1793","Robles","","22562138","","2020-09-08","","","AL41276","Naomi","1");
INSERT INTO alumno VALUES("1794","Romero","","46294563","","2020-09-08","","","AL41277","Ana Maria","1");
INSERT INTO alumno VALUES("1795","Roth","","7845681","","2020-09-08","","","AL41278","Eaton","1");
INSERT INTO alumno VALUES("1796","Rubio","","8647566","","2020-09-08","","","AL41279","Lucia","1");
INSERT INTO alumno VALUES("1797","Rutledge","","11604323","","2020-09-08","","","AL41280","Gregory","1");
INSERT INTO alumno VALUES("1798","Ryan","","21717906","","2020-09-08","","","AL41281","Mariko","1");
INSERT INTO alumno VALUES("1799","Saez","","8726399","","2020-09-08","","","AL41282","Luis","1");
INSERT INTO alumno VALUES("1800","Sampson","","26275883","","2020-09-08","","","AL41283","Ryan","1");
INSERT INTO alumno VALUES("1801","Sanchez","","37824311","","2020-09-08","","","AL41284","Pedro","1");
INSERT INTO alumno VALUES("1802","Sanchez","","45843775","","2020-09-08","","","AL41285","Pedro ","1");
INSERT INTO alumno VALUES("1803","Sears","","44060633","","2020-09-08","","","AL41286","Colette","1");
INSERT INTO alumno VALUES("1804","Sears","","47835848","","2020-09-08","","","AL41288","Uriel","1");
INSERT INTO alumno VALUES("1805","Sgroi","$2y$10$sfKIZ5rzF7wWPqWSsB6nFOn6o3uaIH5nhaXvaiFr3ICiHJSAADng.","40102196","lean@mail.com","2020-09-08","","","AL41414","Leandro","1");
INSERT INTO alumno VALUES("1806","Skinner","","41288968","","2020-09-08","","","AL41289","Ruth","1");
INSERT INTO alumno VALUES("1807","Sloan","","7949419","","2020-09-08","","","AL41290","Clare","1");
INSERT INTO alumno VALUES("1808","Solomon","","29770639","","2020-09-08","","","AL41291","Ulla","1");
INSERT INTO alumno VALUES("1809","Stephens","","25644254","","2020-09-08","","","AL41292","Channing","1");
INSERT INTO alumno VALUES("1810","Stone","","25933535","","2020-09-08","","","AL41293","Dawn","1");
INSERT INTO alumno VALUES("1811","Stone","","8553228","","2020-09-08","","","AL41294","Denton","1");
INSERT INTO alumno VALUES("1812","Stout","","42720207","","2020-09-08","","","AL41295","Cassidy","1");
INSERT INTO alumno VALUES("1813","Sutton","","43904374","","2020-09-08","","","AL41296","Scarlet","1");
INSERT INTO alumno VALUES("1814","Tanner","","6986876","","2020-09-08","","","AL41297","Adam","1");
INSERT INTO alumno VALUES("1815","Taylor","","45575547","","2020-09-08","","","AL41298","Stephen","1");
INSERT INTO alumno VALUES("1816","Thornton","","36467874","","2020-09-08","","","AL41299","Cameron","1");
INSERT INTO alumno VALUES("1817","Torres","","8258764","","2020-09-08","","","AL41300","Francisco Javier","1");
INSERT INTO alumno VALUES("1818","Townsend","","41565942","","2020-09-08","","","AL41301","Jacqueline","1");
INSERT INTO alumno VALUES("1819","Turner","","32277550","","2020-09-08","","","AL41302","Macy","1");
INSERT INTO alumno VALUES("1820","Valenzuela","","30039298","","2020-09-08","","","AL41303","Aurora","1");
INSERT INTO alumno VALUES("1821","Vargas","","38898965","","2020-09-08","","","AL41304","Lars","1");
INSERT INTO alumno VALUES("1822","Vasquez","","9568854","","2020-09-08","","","AL41305","Iris","1");
INSERT INTO alumno VALUES("1823","Vega","","49671795","","2020-09-08","","","AL41306","Joy","1");
INSERT INTO alumno VALUES("1824","Velazquez","","16303341","","2020-09-08","","","AL41307","Carter","1");
INSERT INTO alumno VALUES("1825","Velez","","19266093","","2020-09-08","","","AL41308","Hashim","1");
INSERT INTO alumno VALUES("1826","Velez","","23014472","","2020-09-08","","","AL41309","Wynter","1");
INSERT INTO alumno VALUES("1827","Ward","","41100921","","2020-09-08","","","AL41310","Clare","1");
INSERT INTO alumno VALUES("1828","Ward","","44786239","","2020-09-08","","","AL41311","Zachery","1");
INSERT INTO alumno VALUES("1829","Watson","","16968661","","2020-09-08","","","AL41312","Candice","1");
INSERT INTO alumno VALUES("1830","Watts","","37404149","","2020-09-08","","","AL41313","Cairo","1");
INSERT INTO alumno VALUES("1831","Weeks","","20445652","","2020-09-08","","","AL41314","Ignatius","1");
INSERT INTO alumno VALUES("1832","Wells","","30607549","","2020-09-08","","","AL41315","Hamilton","1");
INSERT INTO alumno VALUES("1833","Wheeler","","17613236","","2020-09-08","","","AL41316","Benjamin","1");
INSERT INTO alumno VALUES("1834","Whitney","","31491848","","2020-09-08","","","AL41317","Willow","1");
INSERT INTO alumno VALUES("1835","Wilkinson","","6691125","","2020-09-08","","","AL41318","Christen","1");
INSERT INTO alumno VALUES("1836","Witt","","48725746","","2020-09-08","","","AL41319","Illana","1");
INSERT INTO alumno VALUES("1837","Wolf","","17524543","","2020-09-08","","","AL41320","Whitney","1");
INSERT INTO alumno VALUES("1838","Woodard","EwcyB5UOJEIAo23KgrruaQ==","19255872","algo@mail.com","2020-09-08","2020-09-30","","AL41321","Amethyst","1");
INSERT INTO alumno VALUES("1839","Wooten","","33285501","","2020-09-08","","","AL41322","Preston","1");
INSERT INTO alumno VALUES("1840","Wynn","$2y$10$Kw9QS1UpfLl/2looKv7n/OxaAJp0jaEBEneYCGLmw2v0s.Vsyv1Hm","49914939","pwynn@mail.com","2020-09-08","2020-09-30","2012-06-30","AL41324","Pamela","1");
INSERT INTO alumno VALUES("1841","Yang","","25159132","","2020-09-08","","","AL41325","Ferris","1");
INSERT INTO alumno VALUES("1842","Richards","","45612398","","2020-09-08","","","AL95123","Estefania","1");
INSERT INTO alumno VALUES("1613","Aguirre","$2y$10$3Yb9yW0c.gzoQtuIkuxgVOGUltzajvG0KFdbU3hSaKfeI/9o29a8O","48637507","iaguirre@mail.com","2020-09-08","","1998-06-11","AL41096","Imelda","1");
INSERT INTO alumno VALUES("1852","ortiz","","20001243","","2020-09-11","","","AL41414","leandro","1");
INSERT INTO alumno VALUES("1853","Sears","","47835848","","2020-09-22","","","AL41287","Uriel","1");
INSERT INTO alumno VALUES("1851","Sanchez","$2y$10$7TAPZqLqyC3qidPfmBZs0u6489E/LPVVahRs3SkmtuaCGXF7pqL..","7512360","asanchez@mail.com","2020-09-09","","1989-11-20","AL89600","Arnaldo","1");
INSERT INTO alumno VALUES("1854","Sgroi","","40102196","","2020-09-22","","","AL41288","Leandro ","1");
INSERT INTO alumno VALUES("1855","Wuito","","25704075","","2020-09-30","","","AL41329","Esteban ","1");





CREATE TABLE `alumnocursoactual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaDesdeAlumCurAc` date DEFAULT NULL,
  `fechaHastaAlumCurAc` date DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK36obnguwdre5apx5dchq91odn` (`alumno_id`),
  KEY `FKt7ydcu477pnwgp95bumcwako7` (`curso_id`)
) ENGINE=MyISAM AUTO_INCREMENT=360 DEFAULT CHARSET=utf8mb4;

INSERT INTO alumnocursoactual VALUES("357","2020-09-17","2020-10-31","1735","20");
INSERT INTO alumnocursoactual VALUES("356","2020-09-17","2020-10-31","1734","20");
INSERT INTO alumnocursoactual VALUES("355","2020-09-17","2020-10-31","1733","20");
INSERT INTO alumnocursoactual VALUES("354","2020-09-17","2020-10-31","1732","20");
INSERT INTO alumnocursoactual VALUES("353","2020-09-17","2020-10-31","1731","20");
INSERT INTO alumnocursoactual VALUES("352","2020-09-17","2020-10-31","1730","20");
INSERT INTO alumnocursoactual VALUES("351","2020-09-17","2020-10-31","1729","20");
INSERT INTO alumnocursoactual VALUES("350","2020-09-17","2020-10-31","1715","20");
INSERT INTO alumnocursoactual VALUES("349","2020-09-17","2020-10-31","1714","20");
INSERT INTO alumnocursoactual VALUES("348","2020-09-17","2020-10-31","1713","20");
INSERT INTO alumnocursoactual VALUES("341","2020-08-10","2020-11-30","1851","18");
INSERT INTO alumnocursoactual VALUES("342","2020-09-17","2020-10-31","1805","20");
INSERT INTO alumnocursoactual VALUES("343","2020-09-17","2020-10-31","1851","20");
INSERT INTO alumnocursoactual VALUES("344","2020-09-17","2020-10-31","1613","20");
INSERT INTO alumnocursoactual VALUES("345","2020-09-17","2020-10-31","1614","20");
INSERT INTO alumnocursoactual VALUES("346","2020-09-17","2020-10-31","1615","20");
INSERT INTO alumnocursoactual VALUES("347","2020-09-17","2020-10-31","1712","20");
INSERT INTO alumnocursoactual VALUES("358","2020-09-17","2020-10-31","1736","20");
INSERT INTO alumnocursoactual VALUES("359","2020-09-17","2020-10-31","1737","20");
INSERT INTO alumnocursoactual VALUES("330","2020-08-10","2020-11-30","1715","18");
INSERT INTO alumnocursoactual VALUES("329","2020-08-10","2020-11-30","1714","18");
INSERT INTO alumnocursoactual VALUES("328","2020-08-10","2020-11-30","1713","18");
INSERT INTO alumnocursoactual VALUES("327","2020-08-10","2020-11-30","1712","18");
INSERT INTO alumnocursoactual VALUES("326","2020-08-10","2020-11-30","1615","18");
INSERT INTO alumnocursoactual VALUES("325","2020-08-10","2020-11-30","1614","18");
INSERT INTO alumnocursoactual VALUES("324","2020-08-10","2020-11-30","1613","18");
INSERT INTO alumnocursoactual VALUES("331","2020-08-10","2020-11-30","1729","18");
INSERT INTO alumnocursoactual VALUES("332","2020-08-10","2020-11-30","1730","18");
INSERT INTO alumnocursoactual VALUES("333","2020-08-10","2020-11-30","1731","18");
INSERT INTO alumnocursoactual VALUES("340","2020-08-10","2020-11-30","1805","18");
INSERT INTO alumnocursoactual VALUES("339","2020-08-10","2020-11-30","1737","18");
INSERT INTO alumnocursoactual VALUES("338","2020-08-10","2020-11-30","1736","18");
INSERT INTO alumnocursoactual VALUES("337","2020-08-10","2020-11-30","1735","18");
INSERT INTO alumnocursoactual VALUES("336","2020-08-10","2020-11-30","1734","18");
INSERT INTO alumnocursoactual VALUES("335","2020-08-10","2020-11-30","1733","18");
INSERT INTO alumnocursoactual VALUES("334","2020-08-10","2020-11-30","1732","18");
INSERT INTO alumnocursoactual VALUES("323","2020-09-01","2020-11-30","1851","25");
INSERT INTO alumnocursoactual VALUES("322","2020-09-01","2020-11-30","1805","25");





CREATE TABLE `alumnocursoestado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaFinEstado` date DEFAULT NULL,
  `fechaInicioEstado` date DEFAULT NULL,
  `alumnoCursoActual_id` int(11) DEFAULT NULL,
  `cursoEstadoAlumno_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKh3ew326q03dqseb9wyxsdcric` (`alumnoCursoActual_id`),
  KEY `FK1nlk4159vb50rrgimdmx9tuib` (`cursoEstadoAlumno_id`)
) ENGINE=MyISAM AUTO_INCREMENT=255 DEFAULT CHARSET=utf8mb4;

INSERT INTO alumnocursoestado VALUES("254","2020-10-31","2020-09-17","359","1");
INSERT INTO alumnocursoestado VALUES("253","2020-10-31","2020-09-17","358","1");
INSERT INTO alumnocursoestado VALUES("252","2020-10-31","2020-09-17","357","1");
INSERT INTO alumnocursoestado VALUES("251","2020-10-31","2020-09-17","356","1");
INSERT INTO alumnocursoestado VALUES("250","2020-10-31","2020-09-17","355","1");
INSERT INTO alumnocursoestado VALUES("249","2020-10-31","2020-09-17","354","1");
INSERT INTO alumnocursoestado VALUES("248","2020-10-31","2020-09-17","353","1");
INSERT INTO alumnocursoestado VALUES("247","2020-10-31","2020-09-17","352","1");
INSERT INTO alumnocursoestado VALUES("246","2020-10-31","2020-09-17","351","1");
INSERT INTO alumnocursoestado VALUES("245","2020-10-31","2020-09-17","350","1");
INSERT INTO alumnocursoestado VALUES("244","2020-10-31","2020-09-17","349","1");
INSERT INTO alumnocursoestado VALUES("243","2020-10-31","2020-09-17","348","1");
INSERT INTO alumnocursoestado VALUES("242","2020-10-31","2020-09-17","347","1");
INSERT INTO alumnocursoestado VALUES("241","2020-10-31","2020-09-17","346","1");
INSERT INTO alumnocursoestado VALUES("240","2020-10-31","2020-09-17","345","1");
INSERT INTO alumnocursoestado VALUES("239","2020-10-31","2020-09-17","344","1");
INSERT INTO alumnocursoestado VALUES("238","2020-10-31","2020-09-17","343","1");
INSERT INTO alumnocursoestado VALUES("237","2020-10-31","2020-09-17","342","1");
INSERT INTO alumnocursoestado VALUES("236","2020-11-30","2020-08-10","341","1");
INSERT INTO alumnocursoestado VALUES("235","2020-11-30","2020-08-10","340","1");
INSERT INTO alumnocursoestado VALUES("234","2020-11-30","2020-08-10","339","1");
INSERT INTO alumnocursoestado VALUES("233","2020-11-30","2020-08-10","338","1");
INSERT INTO alumnocursoestado VALUES("232","2020-11-30","2020-08-10","337","1");
INSERT INTO alumnocursoestado VALUES("231","2020-11-30","2020-08-10","336","1");
INSERT INTO alumnocursoestado VALUES("230","2020-11-30","2020-08-10","335","1");
INSERT INTO alumnocursoestado VALUES("229","2020-11-30","2020-08-10","334","1");
INSERT INTO alumnocursoestado VALUES("228","2020-11-30","2020-08-10","333","1");
INSERT INTO alumnocursoestado VALUES("227","2020-11-30","2020-08-10","332","1");
INSERT INTO alumnocursoestado VALUES("226","2020-11-30","2020-08-10","331","1");
INSERT INTO alumnocursoestado VALUES("225","2020-11-30","2020-08-10","330","1");
INSERT INTO alumnocursoestado VALUES("224","2020-11-30","2020-08-10","329","1");
INSERT INTO alumnocursoestado VALUES("223","2020-11-30","2020-08-10","328","1");
INSERT INTO alumnocursoestado VALUES("222","2020-11-30","2020-08-10","327","1");
INSERT INTO alumnocursoestado VALUES("220","2020-11-30","2020-08-10","325","1");
INSERT INTO alumnocursoestado VALUES("221","2020-11-30","2020-08-10","326","1");
INSERT INTO alumnocursoestado VALUES("219","2020-11-30","2020-08-10","324","1");
INSERT INTO alumnocursoestado VALUES("218","2020-11-30","2020-09-01","323","1");
INSERT INTO alumnocursoestado VALUES("217","2020-11-30","2020-09-01","322","1");





CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nroFichaAsistencia` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `fechaHastaFichaAsis` date DEFAULT NULL,
  `fechaDesdeFichaAsis` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKnq42e1ofgrph75me0ryq4xd3r` (`alumno_id`),
  KEY `FK5inf5bn7xwmwnrnebu1rk5cjj` (`curso_id`)
) ENGINE=MyISAM AUTO_INCREMENT=345 DEFAULT CHARSET=utf8mb4;

INSERT INTO asistencia VALUES("339","","1732","20","2020-10-31","2020-09-17");
INSERT INTO asistencia VALUES("338","","1731","20","2020-10-31","2020-09-17");
INSERT INTO asistencia VALUES("337","","1730","20","2020-10-31","2020-09-17");
INSERT INTO asistencia VALUES("336","","1729","20","2020-10-31","2020-09-17");
INSERT INTO asistencia VALUES("335","","1715","20","2020-10-31","2020-09-17");
INSERT INTO asistencia VALUES("334","","1714","20","2020-10-31","2020-09-17");
INSERT INTO asistencia VALUES("333","","1713","20","2020-10-31","2020-09-17");
INSERT INTO asistencia VALUES("332","","1712","20","2020-10-31","2020-09-17");
INSERT INTO asistencia VALUES("326","","1851","18","2020-11-30","2020-08-10");
INSERT INTO asistencia VALUES("327","","1805","20","2020-10-31","2020-09-17");
INSERT INTO asistencia VALUES("328","","1851","20","2020-10-31","2020-09-17");
INSERT INTO asistencia VALUES("329","","1613","20","2020-10-31","2020-09-17");
INSERT INTO asistencia VALUES("330","","1614","20","2020-10-31","2020-09-17");
INSERT INTO asistencia VALUES("331","","1615","20","2020-10-31","2020-09-17");
INSERT INTO asistencia VALUES("340","","1733","20","2020-10-31","2020-09-17");
INSERT INTO asistencia VALUES("341","","1734","20","2020-10-31","2020-09-17");
INSERT INTO asistencia VALUES("342","","1735","20","2020-10-31","2020-09-17");
INSERT INTO asistencia VALUES("344","","1737","20","2020-10-31","2020-09-17");
INSERT INTO asistencia VALUES("343","","1736","20","2020-10-31","2020-09-17");
INSERT INTO asistencia VALUES("315","","1715","18","2020-11-30","2020-08-10");
INSERT INTO asistencia VALUES("314","","1714","18","2020-11-30","2020-08-10");
INSERT INTO asistencia VALUES("313","","1713","18","2020-11-30","2020-08-10");
INSERT INTO asistencia VALUES("312","","1712","18","2020-11-30","2020-08-10");
INSERT INTO asistencia VALUES("311","","1615","18","2020-11-30","2020-08-10");
INSERT INTO asistencia VALUES("310","","1614","18","2020-11-30","2020-08-10");
INSERT INTO asistencia VALUES("309","","1613","18","2020-11-30","2020-08-10");
INSERT INTO asistencia VALUES("316","","1729","18","2020-11-30","2020-08-10");
INSERT INTO asistencia VALUES("317","","1730","18","2020-11-30","2020-08-10");
INSERT INTO asistencia VALUES("318","","1731","18","2020-11-30","2020-08-10");
INSERT INTO asistencia VALUES("325","","1805","18","2020-11-30","2020-08-10");
INSERT INTO asistencia VALUES("324","","1737","18","2020-11-30","2020-08-10");
INSERT INTO asistencia VALUES("323","","1736","18","2020-11-30","2020-08-10");
INSERT INTO asistencia VALUES("322","","1735","18","2020-11-30","2020-08-10");
INSERT INTO asistencia VALUES("321","","1734","18","2020-11-30","2020-08-10");
INSERT INTO asistencia VALUES("320","","1733","18","2020-11-30","2020-08-10");
INSERT INTO asistencia VALUES("319","","1732","18","2020-11-30","2020-08-10");
INSERT INTO asistencia VALUES("308","","1851","25","2020-11-30","2020-09-01");
INSERT INTO asistencia VALUES("307","","1805","25","2020-11-30","2020-09-01");





CREATE TABLE `asistenciadia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaHoraAsisDia` datetime DEFAULT NULL,
  `asistencia_id` int(11) DEFAULT NULL,
  `tipoAsistencia_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKq321ay6csahth7tshhr0rbn6w` (`asistencia_id`),
  KEY `FKtqtd79xsh4ircl22go5jyx1qh` (`tipoAsistencia_id`)
) ENGINE=MyISAM AUTO_INCREMENT=843 DEFAULT CHARSET=utf8mb4;

INSERT INTO asistenciadia VALUES("842","2020-10-03 18:19:32","307","1");
INSERT INTO asistenciadia VALUES("822","2020-10-03 18:18:07","325","2");
INSERT INTO asistenciadia VALUES("821","2020-10-03 18:18:07","326","2");
INSERT INTO asistenciadia VALUES("820","2020-10-03 18:18:07","324","1");
INSERT INTO asistenciadia VALUES("819","2020-10-03 18:18:07","323","1");
INSERT INTO asistenciadia VALUES("818","2020-10-03 18:18:07","322","2");
INSERT INTO asistenciadia VALUES("817","2020-10-03 18:18:07","321","2");
INSERT INTO asistenciadia VALUES("816","2020-10-03 18:18:07","320","1");
INSERT INTO asistenciadia VALUES("815","2020-10-03 18:18:07","319","1");
INSERT INTO asistenciadia VALUES("814","2020-10-03 18:18:07","318","1");
INSERT INTO asistenciadia VALUES("813","2020-10-03 18:18:07","317","2");
INSERT INTO asistenciadia VALUES("812","2020-10-03 18:18:07","316","2");
INSERT INTO asistenciadia VALUES("811","2020-10-03 18:18:07","315","2");
INSERT INTO asistenciadia VALUES("810","2020-10-03 18:18:07","314","1");
INSERT INTO asistenciadia VALUES("809","2020-10-03 18:18:07","313","2");
INSERT INTO asistenciadia VALUES("808","2020-10-03 18:18:07","312","1");
INSERT INTO asistenciadia VALUES("807","2020-10-03 18:18:07","311","2");
INSERT INTO asistenciadia VALUES("823","2020-10-03 18:18:59","329","1");
INSERT INTO asistenciadia VALUES("824","2020-10-03 18:18:59","330","2");
INSERT INTO asistenciadia VALUES("825","2020-10-03 18:18:59","331","1");
INSERT INTO asistenciadia VALUES("841","2020-10-03 18:19:32","308","1");
INSERT INTO asistenciadia VALUES("840","2020-10-03 18:18:59","327","2");
INSERT INTO asistenciadia VALUES("839","2020-10-03 18:18:59","328","2");
INSERT INTO asistenciadia VALUES("838","2020-10-03 18:18:59","344","1");
INSERT INTO asistenciadia VALUES("837","2020-10-03 18:18:59","343","2");
INSERT INTO asistenciadia VALUES("836","2020-10-03 18:18:59","342","1");
INSERT INTO asistenciadia VALUES("835","2020-10-03 18:18:59","341","2");
INSERT INTO asistenciadia VALUES("834","2020-10-03 18:18:59","340","1");
INSERT INTO asistenciadia VALUES("833","2020-10-03 18:18:59","339","2");
INSERT INTO asistenciadia VALUES("832","2020-10-03 18:18:59","338","1");
INSERT INTO asistenciadia VALUES("831","2020-10-03 18:18:59","337","2");
INSERT INTO asistenciadia VALUES("830","2020-10-03 18:18:59","336","1");
INSERT INTO asistenciadia VALUES("829","2020-10-03 18:18:59","335","2");
INSERT INTO asistenciadia VALUES("828","2020-10-03 18:18:59","334","1");
INSERT INTO asistenciadia VALUES("827","2020-10-03 18:18:59","333","2");
INSERT INTO asistenciadia VALUES("826","2020-10-03 18:18:59","332","2");
INSERT INTO asistenciadia VALUES("806","2020-10-03 18:18:07","310","1");
INSERT INTO asistenciadia VALUES("785","2020-10-02 07:43:43","308","2");
INSERT INTO asistenciadia VALUES("784","2020-10-01 16:58:01","325","1");
INSERT INTO asistenciadia VALUES("783","2020-10-01 16:58:01","326","1");
INSERT INTO asistenciadia VALUES("782","2020-10-01 16:58:01","324","1");
INSERT INTO asistenciadia VALUES("781","2020-10-01 16:58:01","323","2");
INSERT INTO asistenciadia VALUES("780","2020-10-01 16:58:01","322","2");
INSERT INTO asistenciadia VALUES("779","2020-10-01 16:58:01","321","2");
INSERT INTO asistenciadia VALUES("778","2020-10-01 16:58:01","320","1");
INSERT INTO asistenciadia VALUES("777","2020-10-01 16:58:01","319","1");
INSERT INTO asistenciadia VALUES("776","2020-10-01 16:58:01","318","1");
INSERT INTO asistenciadia VALUES("769","2020-10-01 16:58:01","311","1");
INSERT INTO asistenciadia VALUES("770","2020-10-01 16:58:01","312","2");
INSERT INTO asistenciadia VALUES("771","2020-10-01 16:58:01","313","1");
INSERT INTO asistenciadia VALUES("772","2020-10-01 16:58:01","314","2");
INSERT INTO asistenciadia VALUES("773","2020-10-01 16:58:01","315","2");
INSERT INTO asistenciadia VALUES("774","2020-10-01 16:58:01","316","1");
INSERT INTO asistenciadia VALUES("775","2020-10-01 16:58:01","317","2");
INSERT INTO asistenciadia VALUES("786","2020-10-02 07:43:43","307","1");
INSERT INTO asistenciadia VALUES("787","2020-10-02 08:00:35","329","2");
INSERT INTO asistenciadia VALUES("788","2020-10-02 08:00:35","330","1");
INSERT INTO asistenciadia VALUES("804","2020-10-02 08:00:35","327","2");
INSERT INTO asistenciadia VALUES("803","2020-10-02 08:00:35","328","2");
INSERT INTO asistenciadia VALUES("802","2020-10-02 08:00:35","344","1");
INSERT INTO asistenciadia VALUES("801","2020-10-02 08:00:35","343","1");
INSERT INTO asistenciadia VALUES("800","2020-10-02 08:00:35","342","1");
INSERT INTO asistenciadia VALUES("799","2020-10-02 08:00:35","341","1");
INSERT INTO asistenciadia VALUES("798","2020-10-02 08:00:35","340","2");
INSERT INTO asistenciadia VALUES("797","2020-10-02 08:00:35","339","1");
INSERT INTO asistenciadia VALUES("796","2020-10-02 08:00:35","338","1");
INSERT INTO asistenciadia VALUES("795","2020-10-02 08:00:35","337","1");
INSERT INTO asistenciadia VALUES("794","2020-10-02 08:00:35","336","1");
INSERT INTO asistenciadia VALUES("793","2020-10-02 08:00:35","335","2");
INSERT INTO asistenciadia VALUES("792","2020-10-02 08:00:35","334","1");
INSERT INTO asistenciadia VALUES("791","2020-10-02 08:00:35","333","1");
INSERT INTO asistenciadia VALUES("790","2020-10-02 08:00:35","332","1");
INSERT INTO asistenciadia VALUES("789","2020-10-02 08:00:35","331","2");
INSERT INTO asistenciadia VALUES("805","2020-10-03 18:18:07","309","2");
INSERT INTO asistenciadia VALUES("759","2020-09-30 08:30:41","339","2");
INSERT INTO asistenciadia VALUES("758","2020-09-30 08:30:41","338","1");
INSERT INTO asistenciadia VALUES("757","2020-09-30 08:30:41","337","1");
INSERT INTO asistenciadia VALUES("756","2020-09-30 08:30:41","336","1");
INSERT INTO asistenciadia VALUES("755","2020-09-30 08:30:41","335","2");
INSERT INTO asistenciadia VALUES("754","2020-09-30 08:30:41","334","1");
INSERT INTO asistenciadia VALUES("753","2020-09-30 08:30:41","333","1");
INSERT INTO asistenciadia VALUES("760","2020-09-30 08:30:41","340","2");
INSERT INTO asistenciadia VALUES("761","2020-09-30 08:30:41","341","2");
INSERT INTO asistenciadia VALUES("768","2020-10-01 16:58:01","310","2");
INSERT INTO asistenciadia VALUES("767","2020-10-01 16:58:01","309","1");
INSERT INTO asistenciadia VALUES("766","2020-09-30 08:30:41","327","1");
INSERT INTO asistenciadia VALUES("765","2020-09-30 08:30:41","328","2");
INSERT INTO asistenciadia VALUES("764","2020-09-30 08:30:41","344","2");
INSERT INTO asistenciadia VALUES("763","2020-09-30 08:30:41","343","2");
INSERT INTO asistenciadia VALUES("762","2020-09-30 08:30:41","342","1");
INSERT INTO asistenciadia VALUES("678","2020-09-28 08:11:08","312","1");
INSERT INTO asistenciadia VALUES("658","2020-09-28 08:06:39","330","1");
INSERT INTO asistenciadia VALUES("657","2020-09-28 08:06:39","329","2");
INSERT INTO asistenciadia VALUES("656","2020-09-27 12:54:15","325","1");
INSERT INTO asistenciadia VALUES("655","2020-09-27 12:54:15","326","2");
INSERT INTO asistenciadia VALUES("654","2020-09-27 12:54:15","324","1");
INSERT INTO asistenciadia VALUES("653","2020-09-27 12:54:15","323","2");
INSERT INTO asistenciadia VALUES("652","2020-09-27 12:54:15","322","1");
INSERT INTO asistenciadia VALUES("651","2020-09-27 12:54:15","321","2");
INSERT INTO asistenciadia VALUES("650","2020-09-27 12:54:15","320","1");
INSERT INTO asistenciadia VALUES("649","2020-09-27 12:54:15","319","2");
INSERT INTO asistenciadia VALUES("648","2020-09-27 12:54:15","318","1");
INSERT INTO asistenciadia VALUES("647","2020-09-27 12:54:15","317","2");
INSERT INTO asistenciadia VALUES("646","2020-09-27 12:54:15","316","1");
INSERT INTO asistenciadia VALUES("645","2020-09-27 12:54:15","315","2");
INSERT INTO asistenciadia VALUES("644","2020-09-27 12:54:15","314","1");
INSERT INTO asistenciadia VALUES("643","2020-09-27 12:54:15","313","2");
INSERT INTO asistenciadia VALUES("659","2020-09-28 08:06:39","331","2");
INSERT INTO asistenciadia VALUES("660","2020-09-28 08:06:39","332","1");
INSERT INTO asistenciadia VALUES("661","2020-09-28 08:06:39","333","2");
INSERT INTO asistenciadia VALUES("677","2020-09-28 08:11:08","311","2");
INSERT INTO asistenciadia VALUES("676","2020-09-28 08:11:08","310","1");
INSERT INTO asistenciadia VALUES("675","2020-09-28 08:11:08","309","2");
INSERT INTO asistenciadia VALUES("674","2020-09-28 08:06:39","327","1");
INSERT INTO asistenciadia VALUES("673","2020-09-28 08:06:39","328","2");
INSERT INTO asistenciadia VALUES("672","2020-09-28 08:06:39","344","1");
INSERT INTO asistenciadia VALUES("671","2020-09-28 08:06:39","343","2");
INSERT INTO asistenciadia VALUES("670","2020-09-28 08:06:39","342","1");
INSERT INTO asistenciadia VALUES("669","2020-09-28 08:06:39","341","2");
INSERT INTO asistenciadia VALUES("668","2020-09-28 08:06:39","340","1");
INSERT INTO asistenciadia VALUES("667","2020-09-28 08:06:39","339","2");
INSERT INTO asistenciadia VALUES("666","2020-09-28 08:06:39","338","1");
INSERT INTO asistenciadia VALUES("665","2020-09-28 08:06:39","337","2");
INSERT INTO asistenciadia VALUES("664","2020-09-28 08:06:39","336","1");
INSERT INTO asistenciadia VALUES("663","2020-09-28 08:06:39","335","2");
INSERT INTO asistenciadia VALUES("662","2020-09-28 08:06:39","334","1");
INSERT INTO asistenciadia VALUES("642","2020-09-27 12:54:15","312","1");
INSERT INTO asistenciadia VALUES("641","2020-09-27 12:54:15","311","2");
INSERT INTO asistenciadia VALUES("631","2020-09-26 12:45:32","319","1");
INSERT INTO asistenciadia VALUES("615","2020-09-25 08:00:58","323","2");
INSERT INTO asistenciadia VALUES("614","2020-09-25 08:00:58","324","2");
INSERT INTO asistenciadia VALUES("613","2020-09-25 08:00:58","325","1");
INSERT INTO asistenciadia VALUES("612","2020-09-25 08:00:58","318","2");
INSERT INTO asistenciadia VALUES("611","2020-09-25 08:00:58","317","2");
INSERT INTO asistenciadia VALUES("610","2020-09-25 08:00:58","316","2");
INSERT INTO asistenciadia VALUES("609","2020-09-25 08:00:58","309","2");
INSERT INTO asistenciadia VALUES("608","2020-09-25 08:00:58","310","2");
INSERT INTO asistenciadia VALUES("607","2020-09-25 08:00:58","311","2");
INSERT INTO asistenciadia VALUES("606","2020-09-25 08:00:58","312","2");
INSERT INTO asistenciadia VALUES("605","2020-09-25 08:00:58","313","2");
INSERT INTO asistenciadia VALUES("604","2020-09-25 08:00:58","314","2");
INSERT INTO asistenciadia VALUES("616","2020-09-25 08:00:58","322","2");
INSERT INTO asistenciadia VALUES("617","2020-09-25 08:00:58","321","2");
INSERT INTO asistenciadia VALUES("630","2020-09-26 12:45:32","318","2");
INSERT INTO asistenciadia VALUES("629","2020-09-26 12:45:32","317","1");
INSERT INTO asistenciadia VALUES("628","2020-09-26 12:45:32","316","2");
INSERT INTO asistenciadia VALUES("627","2020-09-26 12:45:32","315","1");
INSERT INTO asistenciadia VALUES("640","2020-09-27 12:54:15","310","1");
INSERT INTO asistenciadia VALUES("639","2020-09-27 12:54:15","309","2");
INSERT INTO asistenciadia VALUES("638","2020-09-26 12:45:32","325","3");
INSERT INTO asistenciadia VALUES("637","2020-09-26 12:45:32","326","1");
INSERT INTO asistenciadia VALUES("636","2020-09-26 12:45:32","324","2");
INSERT INTO asistenciadia VALUES("635","2020-09-26 12:45:32","323","1");
INSERT INTO asistenciadia VALUES("634","2020-09-26 12:45:32","322","2");
INSERT INTO asistenciadia VALUES("633","2020-09-26 12:45:32","321","1");
INSERT INTO asistenciadia VALUES("632","2020-09-26 12:45:32","320","2");
INSERT INTO asistenciadia VALUES("626","2020-09-26 12:45:32","314","2");
INSERT INTO asistenciadia VALUES("625","2020-09-26 12:45:32","313","1");
INSERT INTO asistenciadia VALUES("624","2020-09-26 12:45:32","312","2");
INSERT INTO asistenciadia VALUES("623","2020-09-26 12:45:32","311","1");
INSERT INTO asistenciadia VALUES("622","2020-09-26 12:45:32","310","1");
INSERT INTO asistenciadia VALUES("620","2020-09-25 08:00:58","326","1");
INSERT INTO asistenciadia VALUES("619","2020-09-25 08:00:58","319","2");
INSERT INTO asistenciadia VALUES("618","2020-09-25 08:00:58","320","2");
INSERT INTO asistenciadia VALUES("716","2020-09-29 08:08:24","334","1");
INSERT INTO asistenciadia VALUES("732","2020-09-30 08:11:48","310","1");
INSERT INTO asistenciadia VALUES("731","2020-09-30 08:11:48","309","2");
INSERT INTO asistenciadia VALUES("730","2020-09-29 08:59:37","307","1");
INSERT INTO asistenciadia VALUES("729","2020-09-29 08:59:37","308","2");
INSERT INTO asistenciadia VALUES("728","2020-09-29 08:08:24","327","2");
INSERT INTO asistenciadia VALUES("727","2020-09-29 08:08:24","328","2");
INSERT INTO asistenciadia VALUES("726","2020-09-29 08:08:24","344","1");
INSERT INTO asistenciadia VALUES("725","2020-09-29 08:08:24","343","2");
INSERT INTO asistenciadia VALUES("724","2020-09-29 08:08:24","342","1");
INSERT INTO asistenciadia VALUES("723","2020-09-29 08:08:24","341","2");
INSERT INTO asistenciadia VALUES("722","2020-09-29 08:08:24","340","1");
INSERT INTO asistenciadia VALUES("721","2020-09-29 08:08:24","339","2");
INSERT INTO asistenciadia VALUES("720","2020-09-29 08:08:24","338","1");
INSERT INTO asistenciadia VALUES("719","2020-09-29 08:08:24","337","2");
INSERT INTO asistenciadia VALUES("718","2020-09-29 08:08:24","336","1");
INSERT INTO asistenciadia VALUES("717","2020-09-29 08:08:24","335","1");
INSERT INTO asistenciadia VALUES("733","2020-09-30 08:11:48","311","2");
INSERT INTO asistenciadia VALUES("734","2020-09-30 08:11:48","312","1");
INSERT INTO asistenciadia VALUES("735","2020-09-30 08:11:48","313","2");
INSERT INTO asistenciadia VALUES("746","2020-09-30 08:11:48","324","1");
INSERT INTO asistenciadia VALUES("747","2020-09-30 08:11:48","326","2");
INSERT INTO asistenciadia VALUES("748","2020-09-30 08:11:48","325","2");
INSERT INTO asistenciadia VALUES("749","2020-09-30 08:30:41","329","2");
INSERT INTO asistenciadia VALUES("750","2020-09-30 08:30:41","330","2");
INSERT INTO asistenciadia VALUES("751","2020-09-30 08:30:41","331","2");
INSERT INTO asistenciadia VALUES("752","2020-09-30 08:30:41","332","1");
INSERT INTO asistenciadia VALUES("745","2020-09-30 08:11:48","323","2");
INSERT INTO asistenciadia VALUES("744","2020-09-30 08:11:48","322","1");
INSERT INTO asistenciadia VALUES("743","2020-09-30 08:11:48","321","2");
INSERT INTO asistenciadia VALUES("742","2020-09-30 08:11:48","320","1");
INSERT INTO asistenciadia VALUES("741","2020-09-30 08:11:48","319","2");
INSERT INTO asistenciadia VALUES("740","2020-09-30 08:11:48","318","1");
INSERT INTO asistenciadia VALUES("739","2020-09-30 08:11:48","317","2");
INSERT INTO asistenciadia VALUES("738","2020-09-30 08:11:48","316","1");
INSERT INTO asistenciadia VALUES("737","2020-09-30 08:11:48","315","2");
INSERT INTO asistenciadia VALUES("736","2020-09-30 08:11:48","314","1");
INSERT INTO asistenciadia VALUES("715","2020-09-29 08:08:24","333","1");
INSERT INTO asistenciadia VALUES("695","2020-09-29 08:02:19","311","1");
INSERT INTO asistenciadia VALUES("694","2020-09-29 08:02:19","310","2");
INSERT INTO asistenciadia VALUES("693","2020-09-29 08:02:19","309","1");
INSERT INTO asistenciadia VALUES("692","2020-09-28 08:11:08","325","2");
INSERT INTO asistenciadia VALUES("691","2020-09-28 08:11:08","326","1");
INSERT INTO asistenciadia VALUES("690","2020-09-28 08:11:08","324","2");
INSERT INTO asistenciadia VALUES("689","2020-09-28 08:11:08","323","2");
INSERT INTO asistenciadia VALUES("688","2020-09-28 08:11:08","322","1");
INSERT INTO asistenciadia VALUES("687","2020-09-28 08:11:08","321","2");
INSERT INTO asistenciadia VALUES("686","2020-09-28 08:11:08","320","1");
INSERT INTO asistenciadia VALUES("685","2020-09-28 08:11:08","319","2");
INSERT INTO asistenciadia VALUES("684","2020-09-28 08:11:08","318","1");
INSERT INTO asistenciadia VALUES("683","2020-09-28 08:11:08","317","2");
INSERT INTO asistenciadia VALUES("682","2020-09-28 08:11:08","316","1");
INSERT INTO asistenciadia VALUES("681","2020-09-28 08:11:08","315","2");
INSERT INTO asistenciadia VALUES("680","2020-09-28 08:11:08","314","1");
INSERT INTO asistenciadia VALUES("696","2020-09-29 08:02:19","312","2");
INSERT INTO asistenciadia VALUES("697","2020-09-29 08:02:19","313","1");
INSERT INTO asistenciadia VALUES("698","2020-09-29 08:02:19","314","2");
INSERT INTO asistenciadia VALUES("714","2020-09-29 08:08:24","332","2");
INSERT INTO asistenciadia VALUES("713","2020-09-29 08:08:24","331","2");
INSERT INTO asistenciadia VALUES("712","2020-09-29 08:08:24","330","2");
INSERT INTO asistenciadia VALUES("711","2020-09-29 08:08:24","329","2");
INSERT INTO asistenciadia VALUES("710","2020-09-29 08:02:19","325","1");
INSERT INTO asistenciadia VALUES("709","2020-09-29 08:02:19","326","2");
INSERT INTO asistenciadia VALUES("708","2020-09-29 08:02:19","324","2");
INSERT INTO asistenciadia VALUES("707","2020-09-29 08:02:19","323","1");
INSERT INTO asistenciadia VALUES("706","2020-09-29 08:02:19","322","1");
INSERT INTO asistenciadia VALUES("705","2020-09-29 08:02:19","321","2");
INSERT INTO asistenciadia VALUES("704","2020-09-29 08:02:19","320","2");
INSERT INTO asistenciadia VALUES("703","2020-09-29 08:02:19","319","1");
INSERT INTO asistenciadia VALUES("702","2020-09-29 08:02:19","318","2");
INSERT INTO asistenciadia VALUES("701","2020-09-29 08:02:19","317","1");
INSERT INTO asistenciadia VALUES("700","2020-09-29 08:02:19","316","2");
INSERT INTO asistenciadia VALUES("699","2020-09-29 08:02:19","315","1");
INSERT INTO asistenciadia VALUES("679","2020-09-28 08:11:08","313","2");
INSERT INTO asistenciadia VALUES("603","2020-09-25 08:00:58","315","2");
INSERT INTO asistenciadia VALUES("621","2020-09-26 12:45:32","309","2");





CREATE TABLE `cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaAltaCargo` date DEFAULT NULL,
  `fechaFinCargo` date DEFAULT NULL,
  `nombreCargo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO cargo VALUES("1","2020-07-31","","Titular");
INSERT INTO cargo VALUES("2","2020-07-31","","JTP");
INSERT INTO cargo VALUES("3","2020-08-23","","Auxiliar");
INSERT INTO cargo VALUES("4","2020-08-23","","Adjunto");
INSERT INTO cargo VALUES("8","2020-09-24","","Ayudante de 1era");
INSERT INTO cargo VALUES("7","2020-09-15","","Suplente");





CREATE TABLE `cargoprofesor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaDesdeCargo` date DEFAULT NULL,
  `fechaHastaCargo` date DEFAULT NULL,
  `cargo_id` int(11) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `profesor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKrbxf8x1h5hpn28fyjyrhr7r3p` (`cargo_id`),
  KEY `FKt5cax41qk424i7e1ghn28ow9n` (`curso_id`),
  KEY `FKjcr7feyg610sv4gde6ts2lvbj` (`profesor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

INSERT INTO cargoprofesor VALUES("23","2020-09-21","","1","23","238");
INSERT INTO cargoprofesor VALUES("22","2020-09-21","2020-09-27","2","20","238");
INSERT INTO cargoprofesor VALUES("21","2020-09-21","2020-09-21","1","20","238");
INSERT INTO cargoprofesor VALUES("20","2020-09-21","2020-09-27","1","20","231");
INSERT INTO cargoprofesor VALUES("19","2020-09-20","","1","18","226");
INSERT INTO cargoprofesor VALUES("29","2020-09-29","","1","27","238");
INSERT INTO cargoprofesor VALUES("28","2020-09-27","","1","20","238");
INSERT INTO cargoprofesor VALUES("26","2020-09-22","","4","25","250");
INSERT INTO cargoprofesor VALUES("27","2020-09-22","","7","25","238");
INSERT INTO cargoprofesor VALUES("30","2020-10-01","","7","18","227");





CREATE TABLE `cargoprofesorestado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaDesdeCargoProfesorEstado` date DEFAULT NULL,
  `fechaHastaCargoProfesorEstado` date DEFAULT NULL,
  `estadoCargoProfesor_id` int(11) DEFAULT NULL,
  `cargoProfesor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO cargoprofesorestado VALUES("21","2020-09-20","","1","19");
INSERT INTO cargoprofesorestado VALUES("22","2020-09-21","","1","20");
INSERT INTO cargoprofesorestado VALUES("23","2020-09-21","","1","28");
INSERT INTO cargoprofesorestado VALUES("24","2020-09-21","","1","23");
INSERT INTO cargoprofesorestado VALUES("25","2020-09-22","","1","24");
INSERT INTO cargoprofesorestado VALUES("26","2020-09-22","","1","25");
INSERT INTO cargoprofesorestado VALUES("27","2020-09-22","","1","26");
INSERT INTO cargoprofesorestado VALUES("28","2020-09-22","","1","27");
INSERT INTO cargoprofesorestado VALUES("31","2020-09-29","","1","29");
INSERT INTO cargoprofesorestado VALUES("32","2020-10-01","","1","30");





CREATE TABLE `codigoasitencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaHoraFinCodigo` datetime DEFAULT NULL,
  `fechaHoraInicioCodigo` datetime DEFAULT NULL,
  `numCodigo` varchar(11) NOT NULL,
  `curso_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKjxci9ixskm4u2q3jeu3vvejf6` (`curso_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

INSERT INTO codigoasitencia VALUES("15","2020-09-10 19:39:20","2020-09-10 19:19:20","SF596409839","18");
INSERT INTO codigoasitencia VALUES("16","2020-09-20 12:40:27","2020-09-20 12:15:27","GM642202511","18");
INSERT INTO codigoasitencia VALUES("18","2020-09-22 19:45:17","2020-09-22 19:30:17","RE250971708","25");
INSERT INTO codigoasitencia VALUES("19","2020-09-25 08:25:58","2020-09-25 08:00:58","SB413126762","18");





CREATE TABLE `contraseniarestablecida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contraseniaProvisoria` varchar(255) DEFAULT NULL,
  `vigenciaContraDesde` datetime DEFAULT NULL,
  `vigenciaContraHasta` datetime DEFAULT NULL,
  `administrativo_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `profesor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKmldqjsr08gjdktcgqf6u84f2k` (`administrativo_id`),
  KEY `FKf6hu0tkygeqlcjtn4ju2pvpsi` (`alumno_id`),
  KEY `FKq9empioxj25p70f0hlqmumuuy` (`profesor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;






CREATE TABLE `curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaDesdeCurActual` date DEFAULT NULL,
  `fechaHastaCurActul` date DEFAULT NULL,
  `nombreCurso` varchar(255) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  `fechaDesdeCursado` date DEFAULT NULL,
  `fechaHastaCursado` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKb0pu5rd27n5ld9n4oamd62dwj` (`division_id`),
  KEY `FK48osbikkitlflgwqf0vh8qt7j` (`materia_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

INSERT INTO curso VALUES("18","2020-08-23","","Lengua - 4K10","2","4","2020-08-10","2020-11-30");
INSERT INTO curso VALUES("20","2020-09-01","","Matemática - 4K10","2","6","2020-09-17","2020-10-31");
INSERT INTO curso VALUES("21","2020-09-05","2020-09-15","Lengua - 4K13","4","4","2020-08-10","2020-11-30");
INSERT INTO curso VALUES("22","2020-09-20","","Lengua - 4K9","1","4","2020-08-20","2020-11-30");
INSERT INTO curso VALUES("23","2020-09-21","","Matemática - 4K9","1","6","2020-09-01","2020-10-31");
INSERT INTO curso VALUES("25","2020-09-22","","Biología - 5E10","5","9","2020-09-01","2020-11-30");
INSERT INTO curso VALUES("27","2020-09-27","","Matemática - 5E9","6","7","","");





CREATE TABLE `cursodia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombreDia` varchar(255) DEFAULT NULL,
  `nombreDiaSA` varchar(255) DEFAULT NULL,
  `dayName` varchar(255) NOT NULL,
  `ordenDia` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

INSERT INTO cursodia VALUES("15","Lunes","Lunes","Monday","1");
INSERT INTO cursodia VALUES("16","Martes","Martes","Tuesday","2");
INSERT INTO cursodia VALUES("17","Miércoles","Miercoles","Wednesday","3");
INSERT INTO cursodia VALUES("18","Jueves","Jueves","Thursday","4");
INSERT INTO cursodia VALUES("19","Viernes","Viernes","Friday","5");
INSERT INTO cursodia VALUES("20","Sábado","Sabado","Saturday","6");
INSERT INTO cursodia VALUES("21","Domingo","Domingo","Sunday","7");





CREATE TABLE `cursoestadoalumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEstado` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO cursoestadoalumno VALUES("1","INSCRIPTO");
INSERT INTO cursoestadoalumno VALUES("2","LIBRE");





CREATE TABLE `division` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaAltaDivision` date DEFAULT NULL,
  `fechaBajaDivision` date DEFAULT NULL,
  `nombreDivision` varchar(255) DEFAULT NULL,
  `modalidad_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKfr54cpkq6e5mmhivhi546oboy` (`modalidad_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

INSERT INTO division VALUES("1","2020-07-31","","4K9","1");
INSERT INTO division VALUES("2","2020-08-13","","4K10","1");
INSERT INTO division VALUES("4","2020-08-15","","4K13","1");
INSERT INTO division VALUES("5","2020-09-22","","5E10","2");
INSERT INTO division VALUES("6","2020-09-22","","5E9","2");





CREATE TABLE `estadocargoprofesor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEstadoCargoProfe` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO estadocargoprofesor VALUES("1","Activo");
INSERT INTO estadocargoprofesor VALUES("2","Licencia");
INSERT INTO estadocargoprofesor VALUES("3","Baja");





CREATE TABLE `horariocurso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horaFinCurso` time NOT NULL,
  `horaInicioCurso` time NOT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `cursoDia_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKc1fqqmvfrs27v0ujycjokrq0j` (`curso_id`),
  KEY `FKh09fpmkq3ex3t1ets58oa0q0p` (`cursoDia_id`)
) ENGINE=MyISAM AUTO_INCREMENT=170 DEFAULT CHARSET=utf8mb4;

INSERT INTO horariocurso VALUES("53","19:00:00","17:00:00","23","15");
INSERT INTO horariocurso VALUES("21","23:00:00","07:00:00","21","21");
INSERT INTO horariocurso VALUES("20","21:45:00","20:45:00","21","15");
INSERT INTO horariocurso VALUES("99","23:00:00","10:00:00","20","20");
INSERT INTO horariocurso VALUES("98","23:00:00","07:00:00","20","17");
INSERT INTO horariocurso VALUES("97","23:00:00","07:00:00","20","16");
INSERT INTO horariocurso VALUES("169","23:00:00","07:00:00","18","21");
INSERT INTO horariocurso VALUES("168","21:00:00","10:00:00","18","20");
INSERT INTO horariocurso VALUES("167","20:03:00","07:03:00","18","18");
INSERT INTO horariocurso VALUES("166","23:00:00","07:00:00","18","17");
INSERT INTO horariocurso VALUES("24","20:00:00","18:00:00","22","16");
INSERT INTO horariocurso VALUES("25","23:00:00","07:00:00","22","20");
INSERT INTO horariocurso VALUES("26","23:00:00","07:00:00","22","21");
INSERT INTO horariocurso VALUES("96","22:00:00","08:00:00","20","15");
INSERT INTO horariocurso VALUES("47","23:00:00","07:00:00","27","16");
INSERT INTO horariocurso VALUES("46","17:32:00","13:32:00","27","15");
INSERT INTO horariocurso VALUES("30","19:00:00","17:00:00","24","16");
INSERT INTO horariocurso VALUES("31","19:00:00","17:00:00","24","18");
INSERT INTO horariocurso VALUES("32","11:00:00","09:00:00","24","20");
INSERT INTO horariocurso VALUES("163","22:00:00","08:00:00","25","21");
INSERT INTO horariocurso VALUES("54","23:00:00","07:00:00","23","16");
INSERT INTO horariocurso VALUES("165","23:00:00","07:00:00","18","16");
INSERT INTO horariocurso VALUES("100","21:00:00","08:00:00","20","19");
INSERT INTO horariocurso VALUES("164","23:00:00","07:00:00","18","15");
INSERT INTO horariocurso VALUES("162","23:00:00","07:00:00","25","20");
INSERT INTO horariocurso VALUES("161","20:00:00","07:00:00","25","19");
INSERT INTO horariocurso VALUES("160","22:30:00","07:30:00","25","16");
INSERT INTO horariocurso VALUES("159","20:00:00","07:00:00","25","15");





CREATE TABLE `institucion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaAltaInstitucion` date DEFAULT NULL,
  `fechaBajaInstitucion` date DEFAULT NULL,
  `nombreInstitucion` varchar(255) DEFAULT NULL,
  `telefonoInstitucion` varchar(255) NOT NULL,
  `direccionInstitucion` varchar(255) NOT NULL,
  `correoInstitucion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;






CREATE TABLE `justificativo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aprobado` bit(1) NOT NULL,
  `comentarioJustificativo` varchar(255) DEFAULT NULL,
  `fechaPresentacion` date DEFAULT NULL,
  `fechaRevision` datetime DEFAULT NULL,
  `imagenJustificativo` longblob,
  `alumno_id` int(11) DEFAULT NULL,
  `fechaDesdeJustificativo` date DEFAULT NULL,
  `fechaHastaJustificativo` date DEFAULT NULL,
  `extensionImagen` varchar(255) DEFAULT NULL,
  `descripcionImagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKtm1gv5wen4ld811v7ampmrbbr` (`alumno_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

INSERT INTO justificativo VALUES("13","1","se acepta por pandemia ","2020-09-28","2020-09-28 08:35:44","����\0JFIF\0\0\0\0\0\0��\0C\0	!\"$\"$��\0C��\0�-\"\0��\0\0\0\0\0\0\0\0\0\0\0\0\0\0��\0\0\0\0\0\0\0\0\0\0\0\0\0��\0\0\0\0��g�Л2N@��,L�ITT��qJ���I\0�	0C�d	���S��1�;&A���D�����}9�b@�N��&L�E��1�	A�4��&�HQt\nDI(MN0)!��Cq�H���8�7e��&\0�c���7P0Jq��	J�A$�)\0�\0��D�a6\0��K��A�&D��0C@�`�P������̹�Hy�z��zX�$o<%�S�u`�ʯ:�h�(�V���ث%K171�0C�\0� �0��J���F2�&�`���L�\0�H�MKէ�(N\'0��4��@���,��|�����Y�!���`���^���>��m����8�ˡ�[���?��2�^��J��x$��\0M#CE�i�$CN(E��E\nH#8�Cq�\0�$ �����&����Ob�sA`��\n�`�H�(�M@���?7ѫ�9I�g��s�\"[���>f>��ccz��Nw�NY�et�oy�zoG�ou�EO3r�s3�I�7��w��]�^�B߭�*��N#Vy��s}��x:��RQY��\'��=����]E%lT��HF��$�0b&R��\n�BN)��}!��\0\0jV j���`\0�S,L\0�cmx����-)�]d���R���M\\�����vO{������i�}�j���9�>g����5��`Y��k_+�۳(�^�2�+�Vǌ����\\��*�S���C^��	�1�|��u�H�t&-@(�I!V\0&��hH�R4\nFQ��=r��B��N@LFh` `X\'i�_:�^*y��8�Q�=��vQ��.]qY�3�]�{�����3=�����z�{�>m��4���@���~{u�ݿt���;/�R��?�x�e{yМ�G�/�^Ⱥ񖽅ƨh�\"�Bq�7r�H���$&��&��PԈ`5ޠ�#˯9SA\",%��5tD�5@R���K�W�\"�zO9�s��h�6׏�8�x���G�շ{��;�*N^KKn�t��א���1��=�]��W��s�!�`/Oe�׏��LR��������r��?B�`�bM\0\0A\0�D��%����c�(�T֑�8J	�2$�I��$Zj�I!9\n��$\0�-�`�\0E1\0�&V̌�M� \0H�A�!�bh�&mq$�%\0�L@j�4\"C�Ӊ�\n�d⢒!�\0�d�$�E0\0��hh`�M4鸈�@J�$Q��I)$ �`�\0�`��I0M�`�CN!�m8��$��H�@Lأ bwQ$�$��8�Iq�P���\"�&�\0�ZD��Q� �Ԅ�4�*Br\'	+`�\0\n	�c42H\0L��`h�Ԅ&\0\0\0��$�D+H�e(����M\"JÚM�r���D�� \"�b\'h�hS��\0CF�H�H�@&��2!�\0\0�\04�I���H�$ i�iڔ�#@0v�ȉ[$�EN*���n,�@&^]���y�Ts�(ʥZ0t���\\�DL���0-�J,b�u탽�ŚB���(iԫq�)FP1\0�HJQ2H�1��M�2,]$ɔ�l�+@Aŀ0@	0��X6n�𞮴^N����$z�P�����2�1��wR�Y�溅���_����l?9����ƞ���3�F.F�{jy��^��9gs��e��y�O�[����iT��8�^��s2�c�n^���g\\�uqv�w�%s\0\0 ��4Ƣ�b\0�$��\0h$�@-\0�C�1!���p4�k:8����?k�}A�w������݂�󳱬��\\����I[KB�[��|�jZ�描�����K���3ۋ8S�^V�laϴ����joB��p=^6�I���w9۽f]�ܗ�-�u�(��X����[�x7�q���h\0�\0��\0\0L`]4�Ȇ$�,�;�$-�3��g����쭗����Dr��<���u��i�q�J2\n�FMP#(�-K6IJ�IP�ǨX� �,�A8��a��Jѧ 0\0@Ȅ��\010M`�\0���\0\0L�+�\"I5!F�H�4bR54�D\n��a&����Q�*��1\0\0��N��n2�J#���`&�Br)\044dI �!�$��`\0i�� `\0�n2qv�_SӞW�ޒ973m����2&����@1���d-(�@�\"ӄH�Ɖ� \n��.rHA$\0�]E�$�#b\0`\0D��j�1�0� �h\0h�14\ni5h4�e���y����zl����ZbŠ�U(�����&%]��@�$��h A91���q`X�$���\"�	�\n�@��$@@�d04 bM`�� |�H	�7J�Tu:V*�@$0 \0R�b�P��0CH1����� �@J�1MX�W(I�\"�CM(н+L��zhD���<�}I�%V\'�yt�8���+ABv|&�\\d�D�d10!���WCRL=�=Ά�*kk�2z������:�<,��&wN:�diGa<�	��+z^�;��K�=wh�\n����p�oQ�o�nG��r�eF�+3�st��lX��te����\"���_�+ϝ�o+�������ɥyW�à�vJ\\H���i�.J���FC��Y�unu:�b\\�a)E�1\nB@!�(�d&am�r�,p�G�h�w�K�BA��v�m���{��8[��޲���(_�Uo��jR���V�=\\�,�޽o7�\\?;��<���Z9|�:f�=ۣ��������3,�֮���3�~Q�\n��\0��^�����C�y�\0FS��s���\\������ZY�Wnv9��u�p::�;����S������.�v�H�ח^i����1	�B2Bi�0_9����=|4)D���+뜋�^n9�U=�Cͭ��F�eƱ�-���~���vޥN\\.wx�T�B�h�s\\�$ᑺ�Ɔ񩋵#�Z�6�q��\'Ulʶ��W�uw�y�EG#d���\"-��+�쫊�q�����ٜdq�p�.Ű�JN��Е0�F	Sd��\04��I��\n) (` 2Ѣ�(hC�L�@�!�I$M�gB25t��f���5s�F%�.P�īt���8��������	��t\"J�agS�w|&�\\H��(�:G�,��L�.�`D�*�v��U\'Y�X�5e�qЂ����A��2H��|��4��8׫D%)�\\l����r��qGc�;G�k��ү#�ŝcu�o��z/3�t��Uyt��ӯ�b|\'�c�w�(\\#��V�u�bJ\\�ujY����g(�zu�_�a�yt9+g����GP�ǢZ�R�+&�\0�]�k���r|M�+�KS�(��Zu�wu�p�X��P�ާ���X���^y���˽�����f��F�\0Fq �@�\"�FQ�NGwZp����W���y����:��I0��:�b�6���s�g	�Ϗj��,�rs�d�l�Z6�Ug�Ag�^id���:��nT,��o�V����s�L�Q�f�w����hd���򽧛�,�F%_G�,+:�r;Bx���UB�j��Ȯ�2�d+�YYEw`+Y\\�Es�*����~��@3���ۇ^�9.�+����]��+���sa\"Yr�jSvBrq�/70��,WA9>�FJP�P��Q��:��V�!d*�e�ݡ+F�]T���L=K*��9��!�Q�&�J I bt�j��E�MbD�h�sgs���	e�Dȸ��WC�L�\\Ύ�jҭ#��:����,..�(N%÷���t��]D��5�)b^z�q�n,q`�������*]3�.o���X%Hp�WRO���Ď�����,Y��_	�Hɜ\n�We�W�v�Y;�[�LK��c��K�8�fU&Y\\��t�R�,���^%���S��\'åz�`��.h�p#��,.1;��V%�qg�g���x�g���e���Rh����76�ˬ4�E��5�u_�^�*���s2�_c[�DiտP�V�b�zs�\'>s%�=1\\:r�N1��>;$�s�3�7�%�rO�;�N:F)�?;���U��\n���>����NqgEQ�J3#�C���ϯ4+Z�U�9�ϝ�g����0�3��=�ec�No=�|��g?�lKZEfS�\nf�瓧!uK�H����������}F�Tі���˻�z��,��*�ѱt��_>���-+ˠ�q�Fs�h�aܪ��g\'ؖ�,ʪl�B���×hW�ԭ��4�.���2���N��r�����f8�>��JL��_Vq�p�w+���Bӂ��Ey��\",b` ����G�Ƶyo2hƨ]e�b(̮Q�N`��ÙЮndD� ���΁�8��%%B%�%4F3�h��\'Q�Q!��\0Г��$\0\0�t���UВ�1輏��F�Y�b5\0 N#H�c0v�Ǭ����!A+��l��IDȃDIcqD$�V�M�\0؁�\0�RP�a	!\'OoI ��AL�MI	�B�$�q@Q�����9MW�S�40v|�E˾;[�����J<py\\�i�w:�v��܏AZ1��1\0�^�m���ܵ*��˯<��W���˒�<��b\\\'�y��y�Ua�5*W.YSK��L֛�UmCL�������¡=���to��LoK�}wY)��6ޮ>��\n���Y>��;Ӿ:�S�u�\\s�!��#�����z=�g���8�����t���N]<���}ۑ��G]4�v������S��ޝ�s��#9�4$\0\0�!ôt���}�M=:N0�{\\*��zN����P�%���s�,��8�zCI_�s/?�Ǩ�8�5�UC�=d�i�ō�1-�z���=n�Yd�VC�я	��ֶ%˼��Э�?��rޅ��5���X�)��u�+��x%(8��y�X����(>��`�rR��	�&�7� ��q�Z���P�ˤK�U-XZZ���q�=����˲����t.��g�H�� 9��V�%S4!�.%T�\'H��Y%(�8�@	JI��!�	�Ѐ.�{Q�8;ےƍ1 $\0`�9A�@\0EIq�\"�]�8�g����R�P���WEϬ��gmv�T6E�~�}:u��B�Vs*����)a��ϭ�n��vN�jܼ�����׮Q/3��|�Ӈ8cV��&/x��;{tѭo�)ЎH��r9o��\07�z�9|�W�s���tn�[�6;fi� 2R˗]�IK�8���\0�8\0�Wqd��\n�;�<���8r�l��pV�Â��z]��o��F�^�<��+����714<_Y���u3xlez��;Q�/׳,�527:I׌p���9ݪW8f�l��S�ǲ�8���/���;O?{���2�|qym*5�p����oucsu�C�7.��\0I���������x��z��r��I29��I��P���j�p���HH�B�k�	��n�Z����ډ���_���i�ͥ˜�M�OGK�����Rߩk���A��ww�Uh�V�7�xYv��>��X]�y/O٦�(��ڰ�>�RH�c�P���ԣ�o����2\\Ε�\\{�_3l�jDK�z���_.�\0�Bͻ��ԑ�\0^/�\0��\0\"N,hCi�ZD��+foA�nM��Z��yZ�ej�r��X�I#qq&�lH�@M��W�2d^�!��� ����J2I��[�ͬ��9FB`1�\"u�>���z�������ey�ʫo3v�9��tu-�(b� �\01&��3g��5\0�������R!Ϛ��2�����4\n&��D�j��ujH3[�B/CG��>���~��e���\n�������2��zYش=���Z�2ש_j%�SH����*�O+�OK(�5��v�zy]^�X�ەi?=�<�g�Ʌ�8���\\��?�R����J+��ϙ��KiO�T�҉�`�0LM�b-x�\\�(^�]f��+�ؙg	*ǡ����\'��ϻ�+��y]��������r3��V�H���v���>��ܲ�IP�_�t�yu�i��<��/��<��]L���2؞E��0�2���\\��Ό�ڝn��4VT3���q�*a�d�[ŵ������WY�ʞo�auk��לG.�)]�#��]|����b��F�0b\0b���ַ4��q���J�V��9V_�����V����26ob���������I<�]�7cWr�G��:Q��&��Hk*��\n�ґT�pȱ1SLn.�4Ƙ) \"�Ѻ��hRI\n2�my#3�gjBt�䁊�� �`���Ӵi��զ},��}RI8�$�*@ `\"&�Ճ���\0m*��nF <��f�>�XmJ�`Dd��.ן�=P�4�&�]5L�a��!8���R�W���7�w�ל���[��/k�i��(mK\'WH�6��3��R�a����I9gh�B����8���ȴeT�ߎOݯ��U����5GK|�*u������\\~��R�S�֎\'-�E�9>���F�.��\'ҭU�u9�|�z�C�y��A,<��χ~U4��wf��C��ykE\\͏3��q݃�y�B�\'v���#+�8t�l����D_��:�R���V�Q�b&[��1�]ԥ<���y�C�\\��-v�W|u��A{7_R5����]&����VУ;(zOA�q��O�z�#�X�u�����nhb�Д�B��z-�EQ8K��|�������}/�t�n.��ܭ��fn۫c�O��U�^�:7Ufi9e]ⱶS�ђbY\0�`���œE@�\0�j�\02���$�@5�(�~g�s�%�2���+2�p���B��\'fi>}��L�|�SJ�ȧ�}_��=X��AN�G)8�hj�X�0@\0�T��cl����us:�>��z�&��D���\0h$�(�X9Fh�H�$`0�j���\0Lf ��$�NP�1H�XZ�ꇚ�s�JQ�`�i�M]\0C��zq��_��}�y�9l6r���Z�Y}8���\n�Z3t��^��g�t������k0�֮F�K<w����fݖ�����0��@�&0�6��Qi!9&�DN�	�@��10�.�\"��+g�6�ͬ�:&n�M=J5�:��Yz~�og6�jvKh�)�צ<��w��1K�}��7A�<���ɸK�x��{�Ю9�p�ĵ�\"��B�EO[��ජ��Cos73S��J�x�C���˖lv;<���a!�ƜI���deuԋI8J&�\"5kYFI��>W�};O�qgZ��ꜣ.d�M;�Q`�v�����	�so��o�Vz�VdipY���ݲ��I�Hz9V�qT���a�ߟy4�7\n֙�Z0fE�+jv;�&<�#J�;L�`Y�i$�I���\n�4�IFBm���(���J�U28�l��!(Jlone�~�V4_+ϊ���z�/���;;Dfja�\'4��ǳ�w�F29t!�c�&th@���`� R��19�.U4�ˠp�K�ȼ�@>w��?)�De�\'J�(M\n̮Z�k:佊U4ؕ:�j��Խ��\n�֧͡���^�r��Ȍ����t���u]Z<�`�����u<��Ը��g���n��u�8�fk�뛆�5\'Œ�i�]y��C�w1��6�.I9r꒜f9��D����Y��7�;4/�>����v+�v�%߆o;�����\'�̼��ONz�B�-P��zΞo6�jX��Η������*����Y~v��hW�:����-�X�fh���v]��ZU,tL{Z0���?���.�R��6�?��D�4�I�+L0-�LL	�h=E<�Zk<[Rh8����W\\����jR,.x6k��.G���fu[Z��oW�j��9�����ea�V���Ͳ��X`iܕ��:F>���\06�����۔y�]	V7@�Υ�f�Gsj������)q�}i�ӳ%δ��U��R8��Z��$�Mc���>SoK7�={�=�6�x�0@Ĥ��X-:�!�H�����(Gr���:���gm��l��\'�١�;g+��~6u���ʛƯ����/F�Q���a^�nd�8H`�Ȥ\0L4H�>��Y���\\�&Q���7{V�\02�q�����=9�v����4\n�5!:^K׫>I���u�)@�ӢB15m2,+��MXJ,���	E� )�J&H`����v񬦉�wV^n=����Բ���\0�0\0\0`���\0�Х��ЌX���}J7���w����4��?*:Y4�ϋ�<v��f���/�9��LD�z֯:0�hI\"-f�!��}�V�,p�6���GS#�������^S^}s�����W��ţ��mj���qyI�D��0\0�N#\0�4��\0���\'	*$�($\"��r�fX�o>%������\nU�V��.T��b�R��{�{:g����y+��f�,c(��\",�!y�FT��%(���6�OI{#Bݙ��j��ks?_��<���_\'nс^�ͯe8H�X�0	�\0	�L�\0�D�L ZӢV�ZZ�t8��W��d��$Ƃ�&�\n�`����ء�K.��kۦ(���\"�0\0��7��:K��}�CJ$�u�P��`�m�	#JP����\0M0C@n,`�\0�0`@4�zz�jX�����!�� \0m;+h�U4�j�p�F^����Xv\'.䱶f��J@ �0�`�;@vL���8��Ԁ�)�K����4\'l�\0�ˡ����`��RDZb��� �B��J�ץ�*�9���#-��rm�7޶x��v{^re�_\"��-�;�c+G;X�]Z���;��yu:�+J_!�<��i4f�\"$�JH���B����0i��Ģs�ҺJF%��q\"dFd�+��Ѧ�R��qh�qHM00@\0J��f��j��&��MV4�ϿJ�����#Z�C�5���$Ǟ�J�{�R�h��T�:ve^avܪt�Tэ1HM*B���р2HL\0@�BMD�e˥H	(�0df\\���%35�P��@M�40��M� �R���JR�+ؕI2IA:�!uՁ{�:u{�V�����u����=�wH_��]�nˍ)�Y����ٸ˞���\"Ɯ@A�(�$\0���`42.��L�(�o��I)$\0�MI4ˋ-)\0D�Z�qQ:82M0M{~{s���FD�e^+���Ε�J�\nkߕ��Q��T��O�{(���˹fU�=��j+��WGYx���ױ�e�H\0M\0�t\"�4�)FZHE0������28�W��LjV!��@n2AŠ� D|w��ښ>��ݷ�O��|�88hf�^�wq>4Ma������/�.FHͱ��\'�WS�4�g�6E�-s��[�e�2�=>範a�Y��z�dTҁ�#:\0�@FA!��)�[MŌRL`���l�5\\dI22�t�������6U�|�/o��)C+���e����Y�9������&��jг���}m��	s��V�af���^�f�c(�KF�g�����}�ϝ�gT�n\'<�>U����-`��,և��!Ca4i9FT�\'(2@� F�+h�(L�2�!$���I�M	41t\"�c�jo����Δ�)m���J>�����?7�9jBr�ȶ\'�ݦh�v�4��K����9�#��*\'�ŃA!	\'\0�*��7O������&�Bb\0MB`����VMœq�Ć�$��#�RBq]�b$�\0\0���Z��X�;x�=k�W�����Y��F��.����ֹ��L$����WPD1wkXY�ީ&�Z5!$��B��C�)DxUZ�=���X\"DeN$��D7`8=Y8:�.RN��\"J!1��W͝)���GWɧW\0�#�#�8�I8IBt�5!���>C�n�ܩ�/�����W����O_[/?��_��O=W�^�{���ߘZ��t=V&���=&oF)[@�AR�:���,�\n�O�Cf���+qp�P�>��zToA����j�2IK��n2��B	8�N!�\\�N\\�)BhN.����Ma��98��4��J�(��N$�F�sﲼ7?[����ĳ�o���z�B�}m���/�WSV��&��f���8jT���^�e�����&S�������m�O2������m��@���Q���]hMd�΍j���)�\\\'@11�H��:�!��E��e�.:2�Ό��+	beו�Qq�H��tI(�T��>g�}4�,B�����2����7���t$�tЁ�D��y�������Ͳ�z\'���e/����˙״��dR���10�N#h$�P�G�h���$�>])��p��G����P��vʶ\'I��ï;�/K0֔J�.y����d�ܩc2^1�Q�Bq`ԅ$\'3f��|�ի1�aô��)yamyg���~��U�gD�ɤ�\0�\\�����B\0�@�HbH$�8�y��D<に!�Y�|eg^2�S���i��J:��9O��+t���Սw��͇y��15-cnT�/t��W}�uַ|����2Z)l�5��\n�mU��<��)���R��l:/��ʄ˥0���\0wV��g��3GN5K�*%��S�z;�底��lӵ-�S%�����[*�VE�X,����%��i�qq�|z�Z2k�a�VIr;��U�k�8U���Y�;[\'Sn�.�4f�g����`�^=e�A���ͭL�Z�s��:����c��;����9�VS�8v@��-2|�m�7W#�w�-9E�9�.�\'	��U�|G�v��+�����,��7��$E����b M�C#%@�8�@T�֯Wȸ�9ꕬ�Y���gĹkZ�g_�r��E�L���xƌ��M��FE��}�e�Ne��ΰ�bN!4ФH�2!�䤡fjPܵ�;Dhx���Nӯ�&5jRPE�T�@�\0��A4�B�@���P`p�;�i[g��s]��9H`�S��%�	9s�!��r�:J%(H�N�Ԇ\0���u�BJ,p��R�Ý����&}��=&ʃ�	�	��ڜ��	5\0!��\"h���\0�!\0��M@P A�ŀ��$��)�9���I�$��r�(s�\"d7ͤ�H��H�.3:ˋ;t�һ�2g9����q��9F@H!ȡ�d��aԥ���Q	��D�ED�^/�,T�D�ȇD�L�L�H�k��̸��ۨ�bk����<�#ӞZ	��G�~Q���b������\03\0\0\0\0 0!@#1P\"$234A%5`Cp��\0\0�\n�\0��\0��\0�/�_b��~�&�?�).i_n~(�����1���_�*����b��It��qЎ�ˊ�,��pd��iFሌ+a<�#���1��H$}�>�Glݹ�8l�l�#��� [�t1�����00��?��3t0�-��-�M����2T>�>¾����<qY� �s�n��&,��H9F�A�T�ΐ�&$�����bDxa:�82�Q$�|t+E�ۯj�y�RM|-������GcF]a�dm�_��R�8\\�0��\\�uR+�=u2+�=2l��{��]L��5s���ŕ�#�]�j�5[�t��0�gWu2+�=@��ݎ濜��jI�Pz�M�!(Jk������r��ه��%�`ѭW������磻t�,���/�F7sڈ��ȜqtkU�j#[,��4lr�\"�5��v{��Wrm��&j38������n�WG5�t\0�R&\'�{��3dK�2]-C�+��L�KS7ɚ�8�\"nV7kjN�}-��}������|�{.$�+@H )nh�y����bTX�n��A7y�w�KH����C�h����#=u��O!���<#A�߯�r�i_�Ml��i���,�t��Z���k��������ii�N]��n�k9�q)i*6�r\'$���)jf�O��	�*�	�qu��l}\"��BU�F���ѝ��Z��%螚\"�]�ɮ�Murj�S���~-��,���WHЄ��#�A,����a�{�W�n.�X���w&�:YY��������㉢&\\6�d�rIN�;0	�哥�~�w�:E$���\\\'���r�=�����`k᢯���C`�Kp��\0���*��eI�ÿၯ��A,�6C~\n�p(P�7�������ãWãW����������я���������Ch�x�:�>=|>=(�ﱧb�}���\'�Oe��\'��?���\\w/z���)�S�\0�dO�/��B=�k׷�kܟfOi:Z��	�(lk�JV	~��L�,x�|�8�q˥��9#�?a*Pb���A{Lp������^�\"ę_l���%�$p�,�3�ӟ���ު�tn��Ϗ65�7R��8Q�#��\nH僶d�Ʃf�nܣ�����`���\'�REf�pEJ�!��� �W)]4{OPɳe�3jC�p��te�h��E�=�{Y��`�?�0C�1�Fb\\\"�&��\0av���!�Ӣ�~ ���Ǿ3��\n����)�OV���f��\n0�Q�:7�U`����o�\n6ǲS�(�bƨ�pn�!�[��$�����34G��Q�s��)yV#�J����@[���K���<0$x�l�G�_y�HM���-�#4Ll���5��5y���:E�I���ث!ABjU�衶.ٓ%�0��*�g+��\\�\"u\'\0�I�DpJ�\'�ϩOIw���MȮc�\n9���8-,^\"�Ac�Ș���v����Wq��h�r�����n$�qG��;\\D������Ur���������u�\0\'nm��ڵG�w�H�f�4�94s��<��F�P��t{|`�~�NEH��p�訕%����pP`�o�q���Gl�K~�,�=��[��Ԛ2H�G ���a7\\������ΨqYK�u8���xĈ���+��\04ks��5�gOH�X&=�l;<K8	�2��0J�C��;dtQ��ob�L3ֵ��#�֣S��-���fcQ;�\0,�d�j{�i�d��y�k���5,Ib���YIr#)�(o�H��|)�\0�N�&��O��u-�=t��6TR�n�B[��W��z�#<+�OO�]ߐ\0|A���Z\"\'�k5���{�Y���}�d�vC���r�\0�~�*����Pe�2�֕k4��f�H���Y��}��V��M��Q���\\@\'$�x�,r�R�MaZ�\0	�7�qU�Q�����2|����Y�#�i�`�ƞ0��H�����N�R��f�H��Y��k4�Y��-f����\0gI��pc=�r��=5��.�l¶���p�\"��Q�44���hda[ه\\���ki���(c 3&�+B�J��.X���I\'UY7\'Pi@��Ѱs���>���jŔ9-��g��$�5jj�	� 5�\n���^p���щ#U�w����Ϋ�k4���4�t��\n�w��cL�MGȈ����n�`AA�֪���4���m\'\"�(Ui��$]�N��[b����RD�gP�0�}���1�r���l��g�O����,I�so����pI��bi�{�̨���=�v��5(\\����H$91^�_<��&!��Z]W�tO\nSi)<���.r�.`��]��ei�Y�=���V��or:6�E��]�t�C�����h���(øFJy�1�kR�Qr7�p/�O� ��%��FdRI��ӷҭ��ܨ�2s�c&�u�5w^�_��O3�#ƕ=�dn�ID���0Ȗ�\nHYJEΪ���b�X�R�b�+�qX�V+����S�0ѣ�8�&���� t�o-1�ڌ��e�{�!�L��9\'D{�˨�h��C���b5�ǜf��E\"U\"5*\\V�y�4��\0�	��F�5�n�\n1�iG 2��2VZpJ��{��<Y0�N]}:-Y�e;Z�&;ֹm��(q�ۊ�b�X�V+��b�X�V+��\"RRyS�����+����\0.V��O�C\0�k^߆A�Ƶ��Oi$� ���4H��X��c��r�m�5T6��ݙ��L�|9��k?fχ5��f�Y��k5��V��[��u(�&Am��J���\"�3ۚ�fk5��viV�J��H�E����.���k5��f�Y��k5��f�Y��k5��8��Lj1�/��%%\'j�f�Y��uJM���Y�]s��*�iV�H�զ�k5��f��k5��gU��H$�1w�,A?b�%I;#��EJZZ�f�Y��k5��f��k5�΋J���G_��޻�v��i��f�iV�H��ΩI����f�Y�Z^Ħ�{֝J��Y��-f�Y��k5�ЎrF\0*��	 e�p�RM��Iܛa��!׎\"lJ_��%��n�V6�[��Gh���f�؝�I�ө|8�V+�IM�M�K�k5��[�4��i4U�Dj�^�~m�1]�NbiƄ��\"���,V���S�{��MqX�T�\"ǌ6�4�D�wI/��%&�ي�rRh��R�X�V+��b�X�JJN��R��&�����ȥ\\%�95���c���H�r�v���a��]qX���b�X�V+��cLV+��$��El(�A���R%\"V4T�V+��rRh��X�Ri��c\\i�ǉiR�X�V+mm����X�JD���n��U�L�-DS4Ch�mk50�a���i��X����X�J�b�X�V+��m�V+����r��k��X�V+��b�X�V+��c���cΝ��V+�����X�R%%-mEVĐo�ZO��ĝ�#��gjcĝ��w泦��gL�g˚�t���k5��f�Y��Y��t�f�Y��k5��+�	�EH�@��k\"0��Dc��؞2Iy&���}�Y��k:�Y�=���k=�W��4�v�*�k5��f�H�f�Y��k5�V�iW\\�k5��f�Y��k4�\\I��(�L�b�!�5ܷ�����}E$M ��p�7+��\\Z������k5�Ή�k5�Ι�굚�f�Y��iV��\0���;V���Y��k:%f�Y��k5�E��iݹ��f�Y�)4���\'���QL��a��!%�ӊ�1Q�3�[%���GJX��p~|��|F��d�񱨨8fy��\0��蚦��k4������f�Y�����i��^��k5�Ħ��1�����C/��8%���ܡ�����@`�?S-���*�T� H��t����>8�-0y ~�rY!��Kl���R�}�w�R�;�GR�.����\0�E�iԵ�ǅ+��\"Rh��X�V+��b�X�V+�ƷF8Ra���eT\0Q��E���J��������5ȟ�8����(+�Jҥ*V+%&�X�h��V;�j�&�+�	K�Z�b�J���b�X�V)�X�V);1�+��b�X�V+�(�`�2�L���K�����\0�Ee�	��6;���C�+�Ɖ�+�Ƙ�V+��b�X�V+���s`�.��4�b�X�V+��\"V=ԓ4Ѓ�@�S5G�%G���+�ߊ�c���n+��b�X�V)�{�J�%cLi�y{]�6�Y�^�_�O��ٳ�J! �2&��e���(~M������v�a>GO���sZ�g�k��H]�M9��5����L8�Tn��k5�3Y��k5��f��k5��f�Y��G!8�%P�Ȏwż	�W#Z�N�J+�h��Ԓ(�-�:�!N�+>�Y��uu�����\"T�� ���\0R|�	X�u��Gu���!x��Z�f�Y��iV�Y��k5��\"��f�Y��k4�q5��e<>Ü@�NR4��C�X�P��@%�)�ڴ{�aoi*@�3��1H��q��\n��rRh�VM+��*�;����,L�d�֢�Cw.���=�����%��5,�J�\\B� �0���-��KRB9C�D�9c\\����k|N�:��Y�괫Y�ZE�M�|L�Ί\"v=�u\'�]A�!9��b�5R2��0�z�d�dԙ\\ei�e���%rQ��)&b��b0NB�q�h)�֑��Kd��@öI�5�b�jv\\�Â)9�h��b�H)nq�d�� ����x�9��r����K-1�c[?��jR�-5���_���Kڴ��I�h�\'rP�@���v�XЪ��6�l�v]��ހZ���7�����[�]ț�KR��\\b�Bx��Ց4�����6�����W4�b18�\0��}��\\�y_)�=����22y֕)ST�iԩ�i;WD�J���\0�v/�[J�a��M�h`��1E>j����iQ��R+O\\xqDDD�� ���})\0��aX���\0�#�H�4��cz�����3�--.���*V)���جV)�@�7�҄DV5�O���1�O;ʟ_d���k��\"V4�b�J���V+\'�-�\0�����.���x��/1l��?a�VڐV�k��b�X�V+��Cp�X�V+⦽Z!14�w�mdy#S\\�G.�[Z����ӕ�\'*x��W�$̎}��\0�\">�Tkz�=XY{❧J_J߶,f �ܳQ\n20��U�O�����>��`ɿ[{��^��Qx�8m��l���� �{Y1^V�(�B�(Gq���\'I�kNIk8C\\����v�t�wX���dB����q��\\M\'r�c�K��h�&�H��!	�I���5��tF���I�ɜ�Ue�tE\nC��x�L��������a�_i����\0�*$�la����@�%����~&�Z��*v;�u\\.\"��vZL�����qX&���/�ۧ�W���Bk]͌�A+q��Ć��������0Ѥ�a��{���&�Ѳ޷A��{H=H�c-�To���Q�)!�˨��KvΏ�L`H���{\nK�����*���!x��c��lH�BG��\'ҭ��&����j�@�U\0ʳ��{5�Z�\0�A�ov��-�7Q29�\0�иr܄�e�?�ȍ�N��%݈U4�&han�d4�X��ȟ.}\\Ʈ�`v�R�\0~޿�8�\0�^}m�5m�?B������G5��@�8�i���9�K�j�ȸ����P�Hs�n�q�i�F`cZ���_�X��R�1�m�0&�Q<�<D65�Ыk��>	�O��ɔ�#�?K$ mv����E�9e-S:k*mYr��t�Ņ1G��R)��7T�M�a�&_�,E�W�M�wAD|��k��P���@$�CR�ac}�^��=�����f/��6�=ǩ�3���08hL�ȭ$(�p�17XIZ��l�e�%&�#0�b;\0�mU��!��J���1>��M�;1Q���rռ�Js6s�pa�	��hOʦ�\\2ތ�r�Ah����h�C�sa�F�L&B��Ŏ�¤�W���\0N��\0;�\0�r����f�Q�O��f.Y�Gme���ۄ��Ï��}l+�$���h!غJ�Ő����_�}Pl`����V�a���ㆯX�]���`�.QS�H\'!ƍ� �F��}�GbV��=��q4!�%\\���X�$�vST`O.gG���6_c��4&i]����E�&����>W���m�;v����=�&JFG����0еq1B9I+O��L*�\n\n|bUcs�,�9���ok��w%\\����q8ܳ����c�Q��\\��0����lOj籕�Ǧ=�M9��ծj��񝉵�H\0k����W�%�8�8JQ�f�\"6)���\0��u[�wԒ�Cm��F�=�#�{��Ӳf\nԪ$�\'-+Z�\"V��Dl{�F���Gl��S%L�g�B\n3R*tpF�]�d��I��Z\n�5]&[�bΎ0\\u���ͭ���=��(1�����^���j��(X\0�!��V�u��)�,��)�{��Ĺ�Ss��ѱ.q\\��s!�sFBt�@�����l��)	��NKq�oW[��V�����[��H-���8\\���I�\0wҔ���v�a����m�V�z��L�d�G�\\8��ۧ��\\՘ePE.pC,��v������W%F�ߦ��H�j1���J6�\0�Uݫ�\\�Q&\nEH�)��%��\\���8Ħ~(��g\0lʧ|��Q�����4�a*u/����?2An\\ېj�����4�2�?���� ea}+:\\?�Z��(�z5�u�k�[�El��<R�����[��&0l0�f�n4ty{&��/SDw ��W��a30�Ѝ�����x��CO�)Waa����pQ��Ik�q�Me5Tw	.@LY��+�%���Q0��&��n�L�gMcQ6����Dz��A��Ƶ�(�f��\\0i�c���� ��2�\n����7]�6����Fj��-���I������MI%�S1\nV#A�4v��r��2Ik~ZB��	݌����\n�D0�ʪ��_ow.Ȑ��UDTDF��>,g�`����%zk�>Of�c����ѱ<�	�V��-߲L�GY�|��#~��F�%�MW�a�\0�W�W�����#��d���2I�|��5J��s�\n�.o{F4a�^9sF8�S-�k�_�G���\0eL��*}��٪�nd�!4�^˪����a����ޘ0��G�}�>\'���7�(�=�k9䞀åE�RK�fGC���R.�y$SKR�ID�%ʳ̊�Q37+�rU�6۹����!�.H��ɍ�ZU��>dv�T�|�P��Y���8M#��>K�)�fsc�d�)�!*�Ɩ�G�mUDA��s������ew%%�KV�m�ĹQެ	\\I#8�$I1de�I���~�daTI�^�?=L�n����\")�CAD��Go�؈�ϏQf��\'M#֥����1X!��D^�����T� .#�zE2�Q\0�~)�1��F) q	�6I1wѢ��HL�z{K��`p6Z��p�!�4��JXJ���%�*HԣK|=�w0܎����QJ���s\\��6�Gۘb4Cb�mMU=��2��D��i��	\n3CP�$��J��*H��lee�/�\n+\"��poRwd�^��!JI����Pb5�c^(�-s*�V*x�._�G~���j�&:��B*۹����	��(�Q6� a|�O}��~m��<T����Śtm�lT<�z�.�I^�`�\'��#�>\'<Ȓb��!��L����r������%KU�7�[� ����q�1x\'a�\'U-j~t��&���C\0&����L#SR\0$rz&��,��lY�f����}���!���ɩ��By\"S�4��1�t�PƎlX��x�Jlh�ugS+`����&��U/�lR\'�;ҥ�L=_�� n��\'�=�r����\nc��/7��Up���:\'��U�\nJ�.��s�ֵ\'�lզ9��2R;�o�p��J����%����n��>C,%_�M~��M��QKQ�v�d�\ne�>�[D�ɍ���DF7nh�Z9�H�a�Ic��Z��r\\dcǋ�,Y4�,�2t�	������ՏWA)��FqI��2�W<^���sWR�GU9�0�+T�{UҊf�r7rRh׻����!q<*�O�4���/N�-5�����UDH�IjP�����9�|e���#D2�[\"w!�CD	����k�ER�5)�~8?�Q��\n�Ҫ������E�Owo�v\\���ۃ��M ИԎNPԯJ���FB2O-[����<R&ɠ����#5â��=QxcG��7�L$	ZQ�H-����\0|P�e���$,�#UR���	�p�Ƕ��Q�\\flxN�_-�$N��\03*�l/<Iܠ39%���Os-D��\\\"�H+�)����.�崦�]��^����Uk�V�\0آ7s���l|��$�C%��GF���D�u��p1�U�B�l�Z)0T\0�1�VƔ����Z|#�j�5�9m���>$w�B!&�@B�@68N�Q����=�x�)U]1�m�1�QjQ��H��N�}�L�\n�u2�4,A�D����)�X�$#�\n��P�\0�.:��4h�S�z7�B1�oL��A��Ƶ��9��c�����k���-�- n!q5��Z ���ߒ��@��-�$o�N�%�z����0��;.E�OP>�	�h#4o�kww�����;Zm�N�x��CT�R+#1�M&�\\(�q�\0�\n��:.���h��Vd��Y#�p���JWF����p!���1���j��Ok�fW��p�B�ݭ��9QSS�A*k����<�[�MfMz�9ŐY�c�A���pRL\",c4��g�I�S��1��N$���3O���	�YsB1]�i8�Eh��Q�S��{�A9.`Z�E�WŎ�hQ��!0L�z���\0EEJ	P�	�t�oQ�N8�c5�?\\CU=��);!��큭�؄�c7u�1D� Ĵ�$�9pю?G�%�;� {��^(��oY�x��t�,)���Q�s�@��V�\"�%�-��Fz-Kw���4ft�1���0	&8\"�_%^�qW�\n5JU���,b!Y���] ���\n�[ښ�!������c0��wma�\0\0�.��vĨ˙��\0[зD���1�ǧ�7#�u��k��ޚ��\'Z�܉�$p�JL�V\0q�Ǻ�l���8�vU0�����!=�m���\0J�D�-vD�~8h��/5��ho�@K�ʋ����q�J�n��h�x]O����VW�ሤ�Ok�%��J�v���z�#�-GCR[�=cJ�̷���I�3FSG�>�NE��*YȞ���5��3K���W�B��x�s䳐7<�R4�`qU���`���I�[פY�%��T�<��00�O=M	��\\eT8Q�Ԉ��N�WTk![��dp�m���\"�\\�M�,�Q��f�c�G7rI6�{\\q���N�x#2���YR���\"���	HĊI��6H��q�d��zN�DBOU�;aR��{Z�`�$E�l�JiԨpo�p���C����Ƶ�Q����Q����V����m��^ߥ&�k^˝�D�Nr�����O�#CH��<`�[�)�w	 �.�W�63��H�������#�&r�$ $qIy�L����kU���	���������-���\0�Zy��Y`����n�tf8r@J���5T�]A�c?�dB4��g�#R�h)�6��7�b2$R�h����[��́�;��/�Уi�F��҂*,��Q�X1��]%t)]��JG<�/$����5�U�)��s�����3x���\0~�}ю�T�h2�b���LTa�_/z��j�S3�b�9oR������$��k!��^##�oj4]��O����F�L����G>l���#��|ԉ.r�D{��M\"�OO�9���=*������Y�n˛=r�d:*G��-{�N\n�r��L{�5�)�X�C�:=��EY2f�|����R|:D\0J)��Ԋ�ٞ�ceHs������ �#]�%�	��Rc�F�.�q Y(q,s�n�f�(�U��J9Z1�;�Q��P�׷D�>�\'�;^�cm�W��fʄ>��SS��s\"���x�hf��M����$V��-\'s�ҕ^X�r9e+�ap_,�1�.c��E�6�.��� �)����$w1Q���(_,6�+��O�T�%��	��%ͤ�����JF@:8Ԃ\0�c�>�UC,a9��Gr��9$(B0��A��hܕq�k{$�Iq�J5ac��~d��!#���	�M�\'�������K�RB����S�Q���)��#��+�^yԇ$F>wI*v�@��*����p ������DsFƣ��s��|�@�Ggؓ���<;m�Q��q����EOf�v����5�`ʈ�����9�E8Q�V#�-�p$4��w9�HU-N\"�T��qo{���>��#�s�-�+�lv��i�1;Q�V��EO#�L���,���(eL�B�������!ȏ�$#:b%O3Pf9h�D�\0߱tO|���^����A#��`hy,��HTQ�E|��9I�D�\"	�znڿ�2�6�d{�ݼre�B�Q����Gs������<R6U�e�5��X��)=�{iÓ��p��UD�V��^�+W��\'�q=c<�Ȃ=TbG)�G$q���H����ӂK�����k	�%{��R*���:��S&�ņ1V;��&a���}�hڊƵ��s��R�Z�4�a�m3�L�־0��$�\'��\"\"9Z��XMS�����0c�!��&*�7K�ǶCQ��7��?��#��9�e8s\\�gS@���<�ܞT�g��HA7���A�a�� *�=�U/c^�\'8�Φ9��9ό+� l$�m`�vHjg����\'�� �E������%�� �8�l�%��s���o��)�Ͼ��\0��)3Y�kv�Q�}h���~�� 1�n�����WF�!�Ғ*�\\�/�\0`��X`!Q�E��<�Br>)���F*-\'��)�{רG���?�\"��w�e92O«��4ý�ܱG�`�Ő\'���5����4�E�D0n\"z�0E�<���y3$�YuQS�5={��H���re#�9�:�ƍ���+YߝUQ�j�:��I)�}K�EI�>�\\6�m���0M��I�I�Omr�ؑ�C��Ȑ#��0�A?=�$���\0�0:\"9��դ��D��R�����\'9�U6N��9�8��39S��R�\\\\�4�c:K��#��F�qɽ��p�CgG���I�x��I\0�٨^��m�q����C*C> ��	�f�U����?|�|�?�z����j?��U��ڈ���1U�	9V�[ԑb��#����.���!iP\n�sM� �H�ƣ[9pBLf���M+z�sU�}�v\'�{�%�c�����GaL`��h��b�S�@���U�~婟�q��jEs}�b�oيDyv�)�Q��A�]���pd�U#\\1��a))D��b�[ں=�z ��ǌ�\'�?����H\"0%6hd[��Y�c�IP\"�x�q�S-���\0�S-Wd!�~h�p��N@�v� ��1�V�n�\0�ڏF5�DDO=�����W�\'��I{β�\n3���4nI�HM�ĳ5��N��G9�T��;�3i\".�)&�Z��=���q��8��D`��ј4o�M	:M�.9�I*�Q�H\"	�*�<I��5��\\�3\'��ek��H�b���;�X�w�=<8]����@ѕ������RK��ےPy71<-�t�������W4fhފ��$\\��V�h7<�j5=�|�Y�>��I	<���P�5j�M%��,�<擫�$�r��6M�\"M�8�!��M%�$Wϫ]�t8�C#Y��0��=}��3z��E�>��ʉMTT���D�Z�&AC*J���\\׮7Dic�I�ZX򟮞RC3&ú�t����4�l&K+�@�Z$HFF?I�3Q�<Oc���e��8Hҏ��Z��,X�$��]�U[�3�v�ji�	a��� �Ih^��i��8�C��r�_�\n�>L��֪˄���F�ɗ.Y�a��������n�|N�j�e��b2d �-�V\"��x�\"l��{d�N��JT�N��K�) |�Fk��b��$�7�$�E�h��8CrͷIl����0���zj<��̚�EEN�(�H�zc���D���g�q�J�$�2�EOx��S�<M�0�	�:N�v%��9��\0q��b�ݟ�q�!��W6C)����sz�P�\'�=�\\bR�Ʃ��euu�X�>A�]웛\\��Q�0��U�\n��W3v�r�[�W�ki댵U�rv%/~jlf���o�G9Q�������\'1#�<ia��\03���`�HG�A-)\"�$S\"IDH%�@0lg�M\\�k�f[\\K\\)\\��T6���!pq�2���Ԕ��?����N�J���Jc�(�\0��b��4�j\"hGmh�9\"9��\"��7;������*��ҍ�D{Fƪ+k�\0���<��h��w��5��G�.�9�.�?�����(Ќ��%f����;�љ�B��.1��5W�r�a�_�h�8\08[�Î�d�`ƥ&���&c���c����Ϛ��haR�1�5G�;a�f^�?�ي^��K�=�_�縭��h�=�����I�e|T��\\��I���7��m�{V�%�N�O]��up����K��VR�����Ymnmnm\"����_�?�;��A� 8R+yU�M���c^ib#5��sbD��>)��j#[�g��*�\\��jB�����}|�������R�Ճ�H�	�n���ϯ�I�VX�[OE��B�Ս�O�05��7=�ߕ�!��9��HB\n\n��5U�^�ʉ��\\O�\'W�p�p2�]8�U�*��\\�\0�\0��5��p��\\!����ct��#�������u��`�K��(�#Ѫ/۬���O���������ȅGLTst�6p\"7�<+���1y�3�H3C� ����s�Lwb#�+����T�G8N����H�lz�����ͯ�X%m}�&���c��d��(/�Q��h�Dc^�bn����q�����B�/��½�j2s})>��ćF�$pnm���S�Z���ʆa���>؄l�{���oJ��9Tt��{Z�sD�/Q�!��\0��Z��_���ܿ��rR�iQ���}Ź`��٤F�\"%c���}�5��)��rzc��8dGB�?��+{+�u�:�s����s��]�����Ǭ��1H\'q`հ�����\0T�v<K����]���\"�/�3H��9�� �E�f�ъƹv�ӑ�!��kkjV=�v�;1J��7	��	������}^���\"�/f}�{<V5�*k	�Km~c�cV�;��\0\0���rR�*2��´�Mr}���<	��Nڪ����g�:gTu\"�)�R��M2����s��Lt��-,�i_�Ks���[}|bޔ��u-�ܕ��}|z�T��K_�_�K|�K{�_%�=��\0&\0\0\0\0\0\0\0\0\0 P0@!1\"A`Qp��\0?���S�w�R��]t��P�n��v��hv�zh�v�Z�uT�K���Y>�u�TI+T��2�j��IU��I^WQTVO���?L(mC%Q��?�U4��j�%i�/Q��ĕ�|��T��|�c��\"KT`5u*�T+T�a����F�����G�T�ԻE/��^�D��T���6�\'��T����J�H�Ԡ���U�H��+�Wh��1v�]?�R����Y�N����jZ�(�xP����`�р����!����y;E�7��\\!�JG2(�O�&Zr%\0��ŝ�%O`O.8�&1!�<zSÎ0�4(Ď0����j,a����b��!���bT��^\\�Kx�1*\\^q�xR�C����J��ʖ�;�^|�򅡪�4(P�dq��[��z�%�9E�<���ҍ���.�$���у��E��M�v�X�B�Qaa��K�(���hلG�6�S�PPр!�rPq�*8F�@Fd\'*T쌐��~�c��8c\nrӒ�gl�8�<�d����92����S�7��\00\0\0\0\0\0\0\0!1 \"02A@PQB#`aCRq�bp���\0?�\0zY��Y��־�}�Yk�k\'�d���y>�����b͈}��_rO����d�E~u�Y�TQEQYP��\0s���֣�sJ��i�}	�gU�M���[�F�8��\'�KCd���N>C�nB7HĊ�ی��i�4�l��1��Fs:��w�ZcD���u�1W������R�����87��qr%4Х�\"Ջ�!MZd��w�y$�ݶ)���cK�ĕ���ǉ��R{��n蜗��CO�7����q�\\Y�m�؄o��K�p��I}�i��{k��[�n����zt�4�=�QEvW�n%l~>(Q����aa��M;�ZΣM�{^Ta��s*����(�,�v��6;ѹD�Т���*+:�J.L��v��Ii{�0�V�\'�|H��IS!�?��aەJJ5�P\'��籴*(�b�\0&B7vJt�!����а�vc��DqIMH�Ԗ��VK+,�챏Ӊ-��3X�ɫ�u��Ƶ�]�=�)�;#���f�!��/+�&䝳����JO5&�����,��/�TP�db;�ʽ�vQEv�E���\\�t��$QEQEgE�波�(��·ز��%Q=�J�AI��iQ/�Ĺ��Y_y/C�v�e��Ye�6.I��vb�u#�Oc]��\"�,��,��/&���,��,��L���Ye���1��mWu�EQEg�4ڴ\"��]�V�km�QEgE�VR���+*(��Y�EP���0��\n+�g��c}��6aJ�(�Q9&�+S#묨��(��b�eyX���	i$��ҡ�#�n<�6I���|P��1|K,����,��;\"�W�,��,����,��/+)����d�,�����Yb*�Q]��߶�_�ƽ�/�%�[0����繉:!F,nTR�{���E$i+*(��.���J�ť�V�Km�j��^Tt�(È\"Ҏ��\0�t��Q��={2�E_$�4��#�F�i�Ի5ڦG�:��\'$��By��|�ns�b~v8_#q�����q^GQs�<N��.�(˒��\0����X�U�U{eԍl��+\'�O�e���X�G�m�u:1��߃d�H���d_���+��KIӑ��(��Λ�F&�H�Ȭ���BTN�b*�m�Q��%J���4t�f�Û$��T/׋��b���%;����N:^PF��xzU�������1�℮��ĕ�Sj���\0�-2���?\"RJ{�[d��Y%c���D%-���שn5�_-Y��c���GKݪ&�����K�M��ex��5��=5�9&����r�#/�bIK�S5���,G!�I����Q{<��F7̱6�X�C��&�ǚ_y�z}I���9uQmp6�W����O��V���Iao�>�a��%�����֪=�_Mg��A\"XR�9W��8������\'��zI(��:U���D��{d��Xt���R��H�w���Q�V=�Pi=��ĉBT_�ӓVhѻ\'V/=�aF����ҤȽ;�լ�[��]�ro�)|R1_���&Tt�ɵ�)%D�d��Ji�5�Q	\\��ѩC��Y`���V7yO��8:�4ʳ�M�vJK�\\#����b�Di�\'��tX��V�)[/�iv<��o$I��)5�������ۡ�aB�f�ƫ�;����$!{�I]!�5�j��Qo��VΝ�t��%���W�:q�Q���-�?����ǖ(6�Pf�tt�����紾�xn�*1�\0�R��\n���ŧU��N���>*�T��)\'�ߎ�V�=�MG����:oN�[-�����ƞ�V��b4J4��&��%r�-Ǒ��gS�Q�٫�<T��dG�#!���٪-5��:��M�ɾ�Y4k�l��r��6�9G�OS0w�m芷D��Y�7F\"����^Zv(���9(�Q��᥽з����(^풅3Mr�|���-ơ��?ƌlq�d��G�GOz%\n4�4�� ��(V�6��?��m�P��;$����ѡI�ax���I�C���ԣ�\"lғ���߶fׂ�l{G,O�J{���\'�vJH��vu#UC���}E�c�y둮_ܣ&�����\0�����\\�+d��������b��MU�ӱ��k(�ˌ�ݒ�d�|gӕX�а�4�15F���䭕�o�KhnQ����-�I��\0��ӵ��orR��o���u��S���C[�T���*�U1�j(����(!�^(��ч���q��F.hĴ�!&�	jT-�l�����D�3䛸�I�%\'.DǸץ:4/��YQ\n�O\n	��$���V�5h���Ֆ�|D��7�jM�Oj+c���U�R����IsB�ipu%v�J�I�GR\\��W�/Tk�Q|Ĝ[�=�Q��I(�k�F��,F�8�vJW�m��|�X�y�(�ؤi�N�����V�\\��ey�G����О��ч⏸���{�O�Y�����v67Qej+�i%:�R׿�)�ߋE�/l���;�΢�8�UP������v�yY}�u�W�y\"��\'�^�/���_��+9|b�QEd��ϯ̼�h��v#�{�,��^w�U�ܪ/)|}�����$?ԧ���\0�eY]�z����Y[d�i�Wcʎ?C���4����f�\"���\00շbM�5ϥ︤�[�n8�R�=�;�rbl�d�\"ҋ�N�=��S��EvEЙ���x�~/!�N��7��sOc����Rk�����$���t�/��u^�+*(��,�QG��\0F\0\0!1\"AQ 2aq#3BR�0@Pb�`r��$4C��Ss�c�ѐ������\0\0?�\0�2Ѫ�:�?޽���vkݵ{��v��j�o^��ݵ{��aHΊ�����T[�sV�TCXN��\0���4hzDE29���8)ֱ��ר��dVu�\0t���65�]�2�/X�p�Ύ�U{ko������!sE��Z]��0�����H�RO ]�On^U��\0O,\\�2����F!�:�H�U+�֒?��/ֶ�9r��Z���f�O^��mg�gz��}�s����l�$[�!N���a����-�}�\'SN��*@��v�r��Z�J4$.Q��RC!�J��])V�t�k-�Pf0���Κ!q[Z��7j}��9��԰��,o�_aW\0�Ê�;NЮ�f��ξ��&2ހ���2�b����W�?J��ڙ���0_Z׽J���^�}+|YS�����{֯|��Z��׽j����&[~�؊��ƽ��k޿֣]��}k�E�����_�^���.ĳgܽ%`/^���=!v$�y�F�A�ͫ޷ֽ�}k޿ֽ�׽j���0��+��Ι�\n$��4�1�;t�T\\��-\\hGr<]*�(�l�tʟ�d;Bf�\0��n��hQ�ڂ�T������a�u�4��66�t��{q�����t����(�c�ߵz�t����$�W�����o+v��A��<7˵ۑ?��{�9���e�wvϭj�J��zʳ�YF|�a�]����r��������On>lj8��ڮ��s�v��hE�Ҡ���n����N�w�\nϷ�{n�ƷR��Cـh����S�v�hQ������V��J���7E˿���uc��菛.�/�p\'�{Q<�#kg~حױߩ�ͳ���=����^��ޚ␕�.����Ι�!W�ژ׊��^��	�׻�e��2��c�;��}� �i>Q����9�r�\n9�N@S���_�4ǐ�v��r��ǵ���_�\"�[:�x��mX��mϺ�]�k���j*����-^\'�Z��7��\nվ��}h8�F�֍���Z7ֲ���Z7քk��}k����������_,�u�}kF��$�\0�@��\0�h2A��H#�7�\0���ĞH4E���H�͇�N�����s��dk(����E�4^�G*ć>c��A��}+ch�7��]ὑS��������\02�6����Hܻ��| ���>g�Xk��Kt�#-#t���Q���ĸ�T�������g}�s�^�;R�&����_ \n2�1�.u��Ў����o\n.���)�D��X�>�|��e���c��;��Vaf�X�>�jiԻpEk����%MFv��s��\0B���\\R�\n/�Oҙ,�-Ի�����vxIM�3�|G��0��oV���ߘK\'E4�,j����fE��[�d�ֽnⓋ��L��l�3�q�9(�Nx�6�4��*İJÖTX���Lu�(�dp_ͽ+lG�K������Z�d��\'��13�Q�4Rd�P�5����\0M�a��ѵ���(�~���(��Ǔw^E`2�}��6��BYx淊�^�j�����3m�>C�|V�����5q�̩y��>t&���-E��ɧ�\0�$���OZ\\~28�$�҇�?���H؍�Smxc*yW��Ζ!���ٶea����7kT@̫d�ַ���>l�g\\I��e݀��۳w���i\"��z��C���ЅZ��� ^)���V��;��͟%�Gi�ZI>��ɭq�OJ�h��b\\-[U��q�}y�i���-]�f���^�3�(ң�iw��V�kl��5�(��$�F�>��l��r�u�X�uQ�[��.�2�VEx�Ğ���ҙOɈ~��������ؓO�ʡ�\"��<$�:���[hyԒ^�Z��	-H�m���\0������������\05y�K)�I�s[��ſ0�6n��|.)$�\0۽m�gΦ��q�0-0YU���t��[����\0}��>�xn;.�\n�l+�~���lsOJ�\"�����0���םJ���z�#P�m[D�G9wI�⢩���Ў$EE>+`�ΕS�~��}�R�H\"Gq�9��mHhp��iw��iVQa_n�KeiPs�J�-}���Џ&���CB%�6�iq��i!>C*��$�_>�x�IN� ���ZV�Z�.�EX��b�(�C���#swA΀�d?0�]��Mr������4ÅoQ;��X�B(��*e��u4�Ǣ��`U�e6�}�h��]����VE\n<���₨��0��XT\0>��/���T�Xd�\0ؽo�}�-��7�ҼN�YW���d�׽��¸fC�֣���4?�g��������?�\'�qzT�\0�#X�J�~�\0��+|��X��8�_/��z�e�_�Z�?�[�;,������1H|+[��)O�\0�/��W\'*>�kj���?2��-ޝή|+־Ѵ�Jܾ^�\nW赋�\0�d��D�%e6emEb���:��q1��6XO=_w��Кh$F�U�~�)��,���6����L��y��k$G�/��*ƠzW�+�c���1Z����ۜ��W�}�i�C�?^�F�NdQl�s&�[��\0��춆ٹ�Gy$ŏ2���d�x�M,�!VS?�\n����Wľ�X��]�����XT\0:v+/�jnkw�?0�M{���a����|C�kh��x��4bc�c�6X�>{���>�p��ⶽ���\nRL���u�W�)�S�����]�f�Pp��ݲbq����jE��/[����z�i�\0�{w�c��s�\0 ����E��m<r�\\���hE�n\"_���m�~��*�,h���54�F=����[����RyU��zP�a�g)W�h�+�@���5���W?ڬ�SH���O�QH�,�-YR7�i���=��h�=)�m�}�y?_Ze-�?����Imj�@+v������\\v�!S��Z5s��)�g�Q���QoM�t�7�qO��g3!��Nʸ�%�=+�I���5��գ@�ʣ)���;����~����^��r?��ÌxI�g	#Ń⭦�F1b[���R�=�?�_d�¾?:-��V����8�s���[�N9O>���Բ�|\\^]�,�L�l��8w��ʲӱ��\"�������-[���p��ll�$�yZ��Q�>�=���漛A�I�kd�+g�h�F��t��������H9a�(S�c�[�\\f�Jm�s�%���6��~�0B�G�֢S�oGf�y��t��%X�u�����\0mP�ʗ�I�����;t9\\\\�-�V�rM1V��\0�w1I�\\QSõ�\\G)9�r�~�����;�,����=O^�ڶ97S��Ճk�e�\\W�٤�qaGbo�*�\"����V�����m��q�Z��/����`;:|L�\"Ms��7ļ��������s�35���\n$��X��?R�����ϳ >��dh�\"��=�W����\\P�-�ATXҎ���+{y���:	��ocV�C�{�����L8ܪ]������X8[Ĝ鶙��Ɲ;�\"�u�0���]�������Y�#ί�\0�WS�SI��t�6Cָ���ۘ��Ej{���E]!E>B����b�K�XT��yi֐�Ѻ�߅u�(?s�� a�g��O�B$�Dk5H?I����m����\"���tR�][���l�*8X�>��o{^�q��j����E�3���\"v/P���6������f�\\��H�?b�Tӿ��AL��ы���%�)���+��	�?��;�t�>,%e�}*�/���s:�	<?�!|GJoĔ���\'֒%�E�.t���B���1���;D�\0{�d�3�jʞH�A��v��q�\\2(�\0zT�nr����G��#��tQoϟҐ��yd�k��\n,;,�ӷ����͘rW�?�ҏ�\'�XU�|g����V8�=�~d�<�2���_����o:}�\0��B�Y-��c`(<mqM)�Q	��l������r���%�j8�g��d�~T��3V�(�m��5��}�k]��O�XF�֩�{�\"����ڂ���@��ݧ�|�n������-����\0%#�\n����7��a�<Gvg��K���c�|7-J�\0�ճE�x����]�2(Brb+���Lt��{�l2�Ľ�_��\'^����.�H66�n˳���,���˶i�\0V��}�S\'�*f��t�+au7SO��V�Z���.Q�3\"��f\0RcXs�;�R���B�s�}�d�a���8Xx��^�bN	���x�c����I��0��!ې���t�q�a�!�nWJ�\"L]m߇g��>�ޅ.�Y�u�?�+[!	���{%��hb�v��%���)ı�>_�#����Cvn6sQ��\"�\0z`<C1X�E�i��d�q�q&�6��<��qI�\\�+i[AJ�B/��T�v�E��������޶�~����.��3AF�[����\0��%ydT�5x�\\y���#����D:L.������\"�<F淘����d��<�˷H%���4�$F=�� Oo�=��l�*����t]+*�c��rhE���ᇅ�*��I��\0�p��ZP�p��hp���厀^���CÕɫ�����w�û<�i��r4�/lVϲ\\���G�$l*+)��u��.1���!F��茭\"�����v�l�]����K���&�c`5��D�J*o�A���oqQ�|Dg�ݼ�j\"�[��[��$�X��Ln<D��<ח~q�#�`Oa^6���!A��[1X�����ª�\\�j<�S�T��#Y:�N��,���)�t�C��L��Bng_N�zV�!�m��5�\0ư��jEcvC��1r]���G�o$kɨ�������yԛE�G�ҥ*Tr�/$F�u����4��7��n�F[��\'���n����i����u��\\^Teu*�CCf����G�@_�X�f?\\wx�[�U�B�����#Tr��zi>Qz�)8۲�5��`��`�(�iO�9:X�3j���3k\n�IM�.i�c\"�zy��/)^�Qv�W�!o�q�ZfQ���<�0��1��1\0:ԏ;�U�4սj#1Ë;u��nA}SA��_�����<A�$�b�*y״�̼�=jΒ���K��e�p����k�c�Ӊ���ߧJ�˲��9�ڶ���[�,s�Rr,,�T�6�(9(���қj��[[�p�_�g�p�?(�:�{v�$�k�S��\0���K�js�j1�GdC�5{3��8[%�>ͱ��yoچ���[|+QmAN����Ζ��qH��*e�\"�3	n>C���.��#�_�K$�۩@��ұ�?�F���f�:�g��\"�6�Z�f�4/��^�^�#�ƅ�����z�>�	Ht2X�E�8����!���O���`a���~u��?�Ч����\"}��+�t9��\0��x�}�v7}+m�,_-B��Ht��+�<��Fh6���ń^�H%�o����@��2D�����?e�V%�0zᢒ(e<�k0.�D��ư����KܻF���e�X�Ւ�҂ ���&y\'z����AS���_�M7��~ߕ��h�oO/�F��Hկw6zp8l9��F}��)c^C�Mb|^#���u7���b\'f{��6�bPp�<��v%B�v�d�zƋ	�>f���^�״�^�q�h+�e�j6VR�̬4칭�h\'9[\n�R(�;�\'��ث5�~Iy^�?�����q;ap�>ٞ,�����1�!��2�g�%�x%�贪6Y��\n]��4 �]�T�5Ծw�R�J�Öt��{%�u��1��sY^�@!Ί��3���ͼt�\'��zTQ�DGL:1칦�(1l�l�y��>�ٕ��r���0�M��F�yv�1�)��9#�֑�@16���\'^KK���e�ŨhF}��T9vd)m#��Mm[!Q�dpD��48��:Pe���I��\nS�Ɂ�֌�4��r&�����:V��N!Fp��ӻ�5�M�)�?��\0ۏ�[i~+ �Vy��5�S�^�4���h�]E�F�ц?�U�\\#��#U��p{�J��*,N��W��l�N�Ȳ��ʈ�,FG��v�@Z:O\"k�╀�L֣q�vJ�\n��B�.�\0�ăz�2hI(�5���;V���K�n\0�o�V����6Pm��}|�p0��B���4��X�ʄ�x[N�s���?<�\\�k~u���Q�3z�䍱��\"��[�}�\\��^�M�|��ַN�)~V���A&xC^�w�H����I��Õ$Qo$��ʦ�C���ߧ�F�L4�u6&�וm&?u�������[Ү;�i�KOrM�jDt�!͇�ᶹnҩ\"���3��1Isk�)���nW�\0��D�^�>�6�G�R���A��%�-n�c���y!��wFp��>u�s��󵥝�\\�ZiX�;\"�����>�o��f�?yĴ�R��ڵz*=����)s�l�rA&}�#]�6(��CR��j+����M͊�íԓzv��>��e��M	�\0I��%��ۂ�S��Vnŭ�Ý>�:��1�A[�G:}��p��n����4#��&�����1FF�D�O:�tl6`r�*L�޵�RSjޕ�?AE�\0�S�V-�H�?��x_�����#l���QjX�m����X\'e�/�h(�w҄���;&l��x��U�θ}i������*��3��Mn�����1�3׸vf6@3�U�d�ӳ}�	��*6ڠ9�0Ѫ_�5���˹NJ��� � �I��6�������T�f-Q$���P+g�0b�ݳnk��A�x���R�r@5a�vs���aj�	�w15�s4cqu5�M��~��i�U��:��>��a�:��E�[;t�OXc@�˹���=�u6��O�n�n���Z�p߷r����\'�U�w�C��n�	)��q�ϼ�9�8���$�E�/�O�Ʀ8�VC|g�4�L��7j��9ϸM�SO9@rCʸ�\n�Q�΋�(�_V�)6��Eľ^TU�4�+�tck���6�g�3�?s׺�ʑ~w\0�Z��5[����Ib;�mFt�|���t�)P(zw�t�6�������#�Z}�yS�҂\"�Q˷Ŵn��1V�xW�V�gn�ۉ���)�bT��X��PH�*�TR1t_y�}����eI�����������l����#�7����pa�T�}����� ��I��QKh>�]�A��\nP��	�\"��m��C�49U�-i�D�c��<����V�+�=�Ll)�߇�߷�|�5�Q�//�kC��b���S[�I!��k�\"2.3�߰I���dT<25Ϡ��ӥ��״{V�1��՝�rH�\n����#;Qf�kQ����\0������;����DP؂�MG�J��<�-k�����i�0�7�<P^čEE�����Q<�ḝW�շ�WS~��k����f���V��}״�V�Ia�BW.�ɬ[< ��v�C�B�[#{�)\\*��8�gd�͕�%(S��n�yr\\�=*G|�ϒ��o�a��袓l��X�{&��p7>�#Q�����lF׭ȉ0��Z�gf���})��͉�Vb��ƨo�Ҿդ��O_*HFM1�\0�.�dt�q*�)�$a&�a�Op,W����ݶ�;��:i�\0��\"xN��=b��eL<#���C�Vˑ�*t]Hʖ9��\"�T�[�\\)��S�3\'s��l�\n��b�o¬J۵#6���Rk�4����?0���M���Q����D^���\n�ʎ��\0]��õ1aɹ�0Ⱦ!E��kr��-��.�F�՗6��=@ʃ��<z��%d]�(�D�kqݒ���kf@�G�x����BI��NW�};�arM\'�m#�Mk��y-�m�0m��\nQ��+T�����m�b�P�h)���N�<��g�����g8T�Q���\'�@�����e���U�a��#�Q2\"��(��\'��h�̝X�[�\0��:�+f��\\(���\n�ݡ��Q�giTX�\\�G\"x���+u��w1R�m�짅��Ӹ�.�PA���\"�+�&�$_��+-�g��m^�bYXڰؤ�Tmhz�b9��W����!eĸi���c��8�iC�\\�hF���&�;\"���Ի(6��\'�NvdÕ�rQ�\0�n�e2L�N�E���5��\0�P�6ˈ�Ӈ��IÅp�j��ұA#��ZU�T�B3�-��Ľ֏�����T롩v��@`S֥g��3iWGWG��#U�i��Ɑ��~J�q�>�_e�d���/�yv�C=6ӴG����zI�ۼ�~�T���m.�|��iX%@��X���u�p�s��Y�6Y��Z��i ��/��I������]������b��m��}ɫ�ō�8dN}hI�kxǄ��d(�2��l8I�P�q�X�ٴJ]��lOJ�v������:fX�T�g9ތl8MaE����1��E����E��V���ʀ䢸]O�W9T�i���ZH��EE\n!XeEq�+�P��5½�LI?�ٴ�m�Cu쌵���e��E��Tx�a�N��}�O!Xήq~!=�0����r����n �|ML����5�)c�6ݍ�5n��d�<bE��AX�u����Ҭ2������wV��������>B�N��A�Ն���k�z���v�0}6��\06������Ws]����\'w�aF!�mq��ұ!��ԳX�pr={���b�4���1ەl·�_����W�&:_cG|�s��N�������(�\'f���T�#�p��:ڋ��^�o�/f������s4ޕ���y��\0Á��]�d�y~O�C�e�m�K|�ۻ�f��E{kc�ٶo�F���ʟ,��5:n�<we�AƇ>���� =;���t#٠�l�mc`+�4@/�%^i��Q����J2�V�ڦc�Sp��V1�1��f�fLL5c�����,��*��xp7�_�˛~�A�*i.< T;8�\0Q����aK#�V���~	p�-�����y:���>��mI�_?�ܰ����[i@�\0�o��Z,�^��S���V6�FQ����Q�� �g:����ц�$E��� s��N�{bmu5�������jm�$�ļ\0u��(�k9U�T\'ֶIz=���\0��<`u�J�.K�X���f��V����\\޶��j���/�dW\\Ŵ��F8�����h���-������J�h|�k���e���4{�:P�9�+�l��5*���(#Hs͏%�A��w-*�g>О�X��w�|�F{a��+}����\0M9zՕ@��/J�J.�!O�,\n���[5��k�ҋ��i��ᾂ�Ԑ����ֱ8�K[��K��ySO=����f.+!So٧�]�o����\nyV�\"Ռ�.t��p|��o.��\02�U�y%����l�7�Se�s�* �.�TX�n.B�핤k���p6+e_eV£9)cT¾B�\n�\0����8��Rk���=)_^���\nm�>r5����rjV�/E��\n׳6]�q~�6}��������(�Vu��	��A�P�aHЮU4,o&�nZY�g�\\y��u�$a��|XG*���_*���Ku��d�>u�t�O��t���iP}�ƛ>,��nv�7��$����\\�h�3�\"ؚ�i�J�|��4H��nǛ~� ��g7_!_ge�\0��l�&a�4�Λ�`������-FK^�߻�g�3�k��ډ�6��-�(��0!ʄn� 0��M����vӀhojm4�:�?o��OƯ���g�\n�F����܌�Δ�C&����A����S�{��:��c;�:��h�@!�u�Z�g�*�H����~�3[�:�i��%R�c�:�v�o�vd�{��J��b�t4%ڧ30�[*e���3^��vѾ��4�]�}�qK�\0�n�-�f\"�l���eSµ�����kr��(�ڹʰ&� ��qR6nz�f�d榷����V���#�aK��}�`�(ӹ�H��s�Xiژdݺ�,K��L;D���Ex���2�*�L�����_�y�B��5��G��7�i?�\n�:X�x��X@ʮ`_ڽ�(�v�g���{D<�X#Ӻ��^���%8��t���?�l���7�;�<Z_��9\\_�6r?����8�4?�f#��LI�_�۟ng�C�=i�(��k����[M�Q�n���n�&!@�Xc�!�+Wm�u^�Pe��������3���̎��Q�5aS�,�ٮlku</���`Y��	�~f�yR���u��iO]^m��n�X~y6�h�u�Ⱦ#�og@�<6�;�O�����(�ŝb���Ye�f�CaM�2����c����Qll|`z����8E}�mfg�0���͍Nq7�v2�۸ط6�ى�j�~t[�9(��K��uZ�Wńв<Ūֳr4ROg	�m��A�=��(��i��|���ߵ`�C=�G`y�*��~u�;�[!ٻV�z}��Ӑ��~,�ֱ|�M��?=(�q�����tdrc�z{.yW�v���y\n��>�.�+_w�>U�����<�Y>��9��6��F�E�=�����W��iw�����f	c���7[K~���<RrA���m~28S䡳��Yll����W�,���iqm�\\Sn����B�_�sA{�\"x�R9ԏ�h�@xW�o6a��int��v$�)�G�e�K��q�MI�Ҥi��K�����&���^�l~�j�#��jRO:iQ_�β����.�<��F֬p3M��=(:h{�T��-Jߦ�C������o|ɬ�e���\0����V���zt�v\n�Ҥ��:�5h���*VӴ8��!Q�.u,p�V-��+bX��,�u&�ݦrz���χ45���E&�&Q��[RHbh����4����VU���5�\0�Z,��]������j1���XWi��V\\�I�K�a��G㶩U���V{P�f/Zז#�V���N���]<����&f�I[�2�2\"���]i%�a���������N��6T�7�ܖ�[Y�ȹf5���y�>Q@Hn�6�γ\n���_�7v��N�[6�$\0꺊�,�3~�;�`����W��W���h�WӸ��tК��c�4c�\\X�#�r�<-5���6v�����|�[�\"(E��.y�U��w�+�l��C`�6vy�H�B0���r���I�ivV��P�m�j?�!�D�E��t��5�An�Xޑ��r5�ׯ�[f�pG����\'iy�^X#@��W+z��q�z��@�ΰ��^��Ic`(2���\n����������r+��w46iN�\n)͍���)�����ʶ�Z�j���jϠ���i�Ch�.D\n߉�6�b���q.\'�0��e��S˹��_�H4g�s��R�-l�Ŵ*�V^}�N�ߠ��Y_����qj������߭�A�/�!�ڒ(�F׬f@��hm,�C���<s�{���Cj.���ta_iZ6{r���!�ʶ�D\"+Z�y*a�I�\05Xa�w�j�}�>��Ț��,�{-8I,�eG�����=�j�N���(�o��$�[�RI�3���Qݴ�����=��do\n-�xm��P�H�±F��*�˳h(�6{����1R6�V��ǆG��Wm�cQF�ҫ���z��&�V�e�8���r.@�u4�I�<Xo����#���K_�v����%�\\Z��a,�3�)\0���f8��w2�޴`��m�^�F,?#��������k)\0gϲd:-�D%�[F��[R�.��iʷq:Ī<Xozm�iz��T{f���)�ݍ�Z@����,�-t@\'�d͛�=��T�GҤ�a�5�.�D��J���d�ޱ���Җt|(فj�����lN�+}qh�H�����.�N֐r�/x�K�BE\0u�B�*v&홽c��2{g��S!��|B�eSŝǕbq��փB8��Ҷi#�,Vv��h��CA��C��ҸA#��c��N�3�_��?sW����^Ipy-E�ի��^�_�iAA�ׯr��G�\\�Z�B�#<�|M���&�V�q�\\�!��f�nV��x�����^8�q�nu�%Ft�NCZ����jӗr tފh��O��PT��.��r�S+��q�U��o���X�y�lټ�-�.�#�F�#᲎*�3�5�������B�;����ayW�y�у*�k$�\0����oZˇf���MHF\\4����a�c��G�����#g���O1A`|y\\�Ȓ�2�h�]�����d[�o@����V\0��J�!W\\�O5Ů?f��Uԃߵ3(�΄�r/�5kn��z�����+[��i���	��M����>9b�I�-Q����V/�OzQ9�B~>b��2�߄V9N)��yT�)�m^�f�L���3ӧ�-RA2���ΰlө���)�ܼ���e��jx���:�	�+t���A���m�S�ֶ��UL�n6�c+�{�/��T/��k�k��;f�x���δv�����h�UM�?�]� �dZ`Z�zՄk��(��?�f��rI�9�}�5�Ξ�ˌ�s�I��6k�EQ�p�U�>�Ƹ�p٩��j�@Bh&.\\_��4G���I��W��Z�Pެ�cѲ�˲V�8EgW_tڎ��F��b��O�+έ�ԛf��/dSVF����ԪG����c!��q��_\0�w��VxlXa5i��6�[��1��\n�/vq�(�A���U�cS�Y*���69��{�P\0�/���O^�����>���J0�5xV�����Fo��_�d�.Ց��S�g��ְb�D�):��Ud���>c_ZĊZگZ)-��0¾��|&C��p��iD�0�5�ҟgs�ߟfn/z���bC_�6���\0���Rvbn�>*�[�^�Z�gc�Ն��M1�G�X�A�����|�D�~���G�^\"O���\0/?�վ�?Ү`��Vv*|�pJ�����R�6΃����.F�+�����W�g�z\n�ųȈ�>U�옟��k�[[��D��aַ�mf?��-��-Ս��X�OȊ8����w��s�s5pI̶�u�i�Ϡ�\"�-u4o9[����������{�\05����v�V��{M�\'�Z��~x�|2�SXCan���*�\0�K}@��\"�����[(M��9�F���?�lk�1��_���cne��F��-[��\"+�-�,�7�j�;�$�A���%6���3���nEk�D�G�0����/���Ú��[�>��T?Z���3=#�*��\0��0�>� I �_JE�v�]��kײ��C�Sp(Ί�p����@���>)�j1X���k�CX��9T,N�iz�6~,���D_ᦲ؆�=i�mY�(G�Ը�������\"(4�\n�\0�1@J1D|2��7��fyEZ\'	VSfS˴�RO�S����	\0������9G������jc�C{ԁ�#F�|Ll(o�\"25o�[[ʮ�^���B�ڕC^\'���	2���Շ�/�~t����5�3Z��+�Ⱞ�lu�:h��5�<�+��X����	�2�xFU���nL�����L�q)�y�1����Pek����/�m�Oy&�B��g�f��󣳆,<F��d[?�soJNJ�ղ�;��P�E�D�t����s��ي�ƾϳM!���Am��ś *7�H_�>�����1��QYc!z��\"h$9�Evr����uvU?��ZJ��Sʃ�Ζ[��V9������u]=����4\n�����|f��\n�k���Tmo������tP���1I����oQ��\'D�� ��ϱ�;_yҰ�����(��R���\0$��N_�іSw?ڲ`hH�ɩ����A_�r�ӝa�B��A�i\0��A��r�^���s}|��oM�Ǆ��y�m��	������V�=NG҂.�Z�Dm\"����(�\0Yk�I�������ankl��r)H�(����c�dk��>.�n�X�|�o?��U�\"%��Z.L�%�E+X�Ɵ����+u�Tu�V���uC�����7�M�����Fmt�[���e�*�rw�B9P���ҷ�dy�n��w9b��&�-�qy�ww�-S	ԫ1�cL��7ЎF���D8dʃ�V�N&�!�>f��\\�*;�ȟ5��.��o7�������n������L%#�������;� �M�,��uZ���oiK?�����5�s��%��R���4�:>m�[���:PI,o��ʶ��Ĭ�(~mzi��/j����ʤ1h�)]i\"B�#I��h���ݢ�:�/�ѭ�E$R��p�4��_Z�{�9����|Q��έ���qJǉ�Bi�m�\'Џg\'�H���O!�V���[��,.(p�_�[�r��Z����+�w��C����{Mo֓r�Q�k\n�5<#��|ցS���n�)[	��Zlq�A�:t��|�	�`��Fk�Q�qc��e����хS�����J��#�-9�$��;X�S*�9�,y���f��g�F�ѩ�RR�p���<���5�Lhs�TL�NFN�yT�O���^�(Y<Q��*��y�w�����Cy�]G +rnWΆ4m/�x�o��ƛT�eԚ�3H���9��Z�Ҧ�P3�������:Պ�n�Czc���A#Aָ�TȖ!��)m����Y��W�7�ւ��r��~���V���\nX��z�B]\"Q�<�ȶ�\0��[KR���&�\0�����9�&��������k��žajX�Ef�#z�E����u	�T�$�\';�K.#i#������O{ZտDǗ�\0�t�ʈ�(�����.Tb�6���A f����5����ҭl�H��%�Ӌp����=m�0�A�z�f��z<V{kH[[gH%P��֥��[��zV$&��K M�J�2\n��6�B�{b˭I����4nJ�2w�¼7�Xp�I\0��V�[T��Fju�Q��`6�E��D��:�\'���ă��XWJ�\0��++U���Y\0�!�W	�t�Wy�L$\"�\0���}u5��NT/��s�Z��:��U��j�UV`maO����	[PR��&!j�2����`�繺�1����؛�ji{�v��T+��V���f����o�����1��f��{[_˰mC!��B��L���u�*��D.�+�ՖB�5Տ��:]4��.XX��,���u�7�ZV�3u���,ͧ�Λ�XG=`ۡh���5�0�;�����U��Ҭ��XwC�ac@�z֟t9�X��0[���(i@���BҲ�q��t��ŋ����H-�ck��9f�����/����so�u46��P$�7F҇����,z��l��\' ��I��ۣ(��a��\'�G���/��ά��ί#3�|�Cf�O��9�#0zQ�O^twxr�΄��s��	|���9T,$5fFWP��R\0��9kX@���K��ʮ���b������^�ƶ�E#+m8yR�s��>3\n?5�*�gv�����9�˜��١٠�6<���w��)���\nK)�_�Աm�c���ʱFᇗh�CQ�\0(���D���Mi�ňPil�4��B\n[��Fu��5�X�V�<���=o��Gc�6w�J�ka�aӈT��c~\\�I{K��*��`Υ������\"�]H4���Qʡ��u�t��UC�pq/��RE�\\f��s6���a�FM�g���*4�Wmἲyt��l�N�-X.`ԛV�S?��a�[N����\0�Xe�K ^2����%��\0m�?���.~�����ND��0M�SXW��!�y�5��?^ezx��9P#�F��J~U�ʖ�	je�j)$+���)��[Td�t�&�Z����w@)�FY%29�J\'G�M�+!����(�6(�&Je��s�#�j�c�@�i�I�!�p�V�Ʒd�c�\'��?c��Y�奃l��£���(7�,�ҷ��* �޸�J����_+\n����)�M�ى�ܫ����*�L#AXX\\U�XV���G�s�SK��?f�����8ޖQ����n��.Ρ�i�B�zV�����٭?ޣY�#�38Nf��ن7��4��8���h����T[<�:�l�5�����Ҏ��i�E�k\n�����΂(��v��׭��rVD��ҼB�0p\'�Zd�Y6}���]�s������m1�;�LV&�y�a..�oVWE:�9�cP��nSQۥA���p_�f�(��ԃBX�_��*t5����\\y�Y-~��B��|rs�o�#����΍���+[���N2RHт\\^��f����2>���v��+�{R�M|#�}�bi\\��A�Cg���#�Q�88HU��Y8�Ο�>��ͼ�l�q��Ҿӵ5��\0jVF�۟s���\\_!��1v�����Ն��<�qF�d�}���4�V�0d�p(�D㍯�T�k1��1�l�TVһI�%�X������5�lN\'��-.�Z�0����f��M�٤daQ�;f���l�^�_�4Yq�z\n�j�mՍ��ﵺ��a�֎�@��3 7> 9��$�OOc�������Ά;���e���`�ŋ���y�4H�Şus�< �n��E��|V�ʷ2n�P4:�Ψ�c�m�6	I�Ҧ��ǒy-M���Z6��\04���o��%V܃Λ{���L?��<�,��jk�vX��k�\\G��\ni��eG����E�5�XlZ 3굉M��4���RȺ����h<��o��M�\'S�^U�摹L�8��γ���#w�!��%;Fd�EB�|\"+�ڽ�J�c�N`lh˅c�֒(��D�@�4��E��@�Ҡ�C���Rl�DM�1\"��]���j��.������Ĝ2u�����F�����L�G�-�$W��{׳�p_��_h�:i�ݡ)��ŋ{5��s��O݌U�����{�ʌ�,�ϐ���U\n�K�Q�<��!��I����N�]Kp�n!A6����ɞu*�؈�>�Z5b4���6)���Z�}�iVL#�kXw0��cO��V��~��{Pc�\0j��w�8W�����t)�#A���s�����W�-���E\0D�;�5d[\0�*�_����ar���C�D�FU�$�am}kgH������x�I�)f1joq�v��2-��!�ҳ�?�׌\'��GUγ{1\\2)�bZ��Z�,���)���\"�:��q�,ߢ!L�Ż���u�Oi\'3�>��^5�׼_�{ů�I�� �\0�L�<:�W����}k��w�V���U�׿?�JX������`r���S��|�Hd��7�3��Z�6!w�+|p:�eM�C+_${�d[kN��t��\0�c[���+��X�?���x�e\n�D�[\n#�A�\\e�������t�ҽ�}+�=x�������?ޥ\n,0\nN{W�Z�/Ҽ#�Zݧ>c��k�O��=�Sc��ּ��v����Y(��������4b�+���ғ�EfmV)>���AA�>������#ַ�is!<\n:���[>ݫ��f�ӳ	|O�t\"1�lt�ϵ~��hh�\'�?��zw�})�%�q3`��@sҭ��ş�/#�?_�J�����ǵ���\0����B�8�����u���I�v�����X�)���[�����ͣ��aN9O�+h3�)����ҸTy��ڈ!�;S�H�i���8�M���E��q�O�x��h��Ά#��u�\0���*F^u�S�\0*���QD�9W;Q��֮���<�b�M��QZ��V������Ej+^�|\"�ZO��i��Ң��\n��c�i�9[65��u>!��?��)=c̃���z׹8V\n1���άu�����hͳH��N��f��󠫧j݀�x+S�����5��W�z���t?��?z�:�\0N�Q�+ƟJ���5��k�\'�׍?���L2g�:�\'��x��W�>���^(���O�x��^���̧�\0����(�xm��{K�L0Ճ�\'Bk٤�l�ʰ�F�	<>T�V.s�VC�X�~��M�Z�&kzW�z��W���^�_�x�����\0��/��^�^�^\n�b�دv+ݭ{��v����^�~����^�~��Z�P;8�8&��J}�_ �o�J��_h��|#�Jo��b8X�\\ϕ,��ݢ�?��v>?u7>�����[#ܚ�a��t��ri��I�D9Y�0�����^|�G��b��L�c�s�n�!EƘ�Up�9W�@��P0Z�F�|�F��y�,��)_a{:[�J�l�xp�f���>�1TBf%���.�����_<M�ᯆ��J�׼4�v9V\\�h�I|$Z�4���d4����K�م��a�B����hҩ�Q��5�.�NE��c]v�ࡓ�����y.خ�\\�d��ܶ�V��������3���V�)k�����An��F��ⴉ��@6R�#��DZω������a��\'��e�_���U�،��%�卩w�Լ���S�x�ڒ>��u:?�f$c�D�n����ʗӿ\'�����b��Hz5\\���8@��;�vi�Ƞ\nlqT+��<���J��sX�h�Π,\0Z���׌W�����^�T�\'�Jt��Z���׺�����^���LE�^���W�?J��Y��޹�޼���ygJ~���X�5s|���!r��1~T.4�\'JҼ\"�\"��:���\n����9.�uq�L/|20�%+�r�hF��\0��=�x�{��׽O��W���\0���E�U�j?��J�\02��`}+��z��^7���O��?����Y$�J�rW���ܕ���\0)\0\0\0\0\0!1AQ aq���0������@��\0\0?!!����J����%i��i�y+���GBT�Z֕�8Օ�X���\"Vu�>��*�9��3��*w�3�#Nc��v�?��8��ta/Ɍt�S�=�g�0�kƬeiσ���r�a������ҡ1Ң�^\'&����8�f�Ԩ���Ǜ�g�Մ���/�T\'3�Z;B:>	�z>O�3�0|�8�g::\\w�J�4?���E��+J�{���8��T�L�8��4\'>F��47��V,�����Ǔ�z��t5�G��֡�e1aK.�������\0��\\�\0S�~��|��?�`����;S<�CT���e�H�ڔ��U7��K02E�h��nˌo.5m��\\��W�I�3k��6֭Va~�n�����U��0ю��S��>FV<x��\0���/ß*��x2���fX����79�陛�͡8����R�Cc��0�WӪ`������<�<FY�\0p�������\"1{\n����s�&�[y[����<���3%4/�o�:2��j�jiZc����SQ��y�:��B�Gx�Μ�.t}��*xsv��[Yq�7i��uM���G`Ī�b�ڢ}����6��d�㑫W.����T��L{���V+Q�^`��0�qּh��v��s���::q�#p֡.o�=B�����%�υ�!���Oš������z�+j�4��axI�tc�ъ��h\0�\\�*�1�\\p{��Ͼf(��/-�\0L��xv����4D�^���@��J������7��ԎV!}�0�@[.��{�����.͘�����K��^ʌA��c�����=�����������f�΄#2ҥJ���_�jʋ���17��SygoA����ԥ�A	\0D�e\'��g}��e����Z�`���Ǩ�Ҥ�hQ�n:��V��� 4�.�GƜĮ��>!�ʜD��K�ҼGC��ŋ@�ρ�F��7�0m�:����d�9�;��9�M��>��W{�\\��w�A�\0��}��}��Ε-�t�����J�r�i^O��)Np>ٴ7�s*mD�nK��b�W1����q��^�����U��&�w�?�c+Wolt�a�T7���1Δjs1�}.8���kNR�����%��.��\"�!����W���W2A�P���Ӹf�7�F-}J�����y����~�����3� #{Sm#W(#=kp%��?��^�>����h�3o\'Nt%��R�r�q��%��)]�t�����s:K�� [�/�LJ��a�)���2.T}ʹ)J ��A,9��)&��b40�&�P?P��ԩQ�J�	}�T>\'�:��7т�q�m����|+֕_�����N4ι���.u�w�\n( o�/g�Ժ��&}�~�f���\0�����=Ǯ���Cw�&\n�ak)�`Syn��DޥF��_�]��Oul�`�n��\'�M����`)�Vj���տg��|�	����P�u5��2����PN.~Y��s;n�����߱��1A��	`z�q=*���q�\0#�\n�[\"]����Y[:,}D����������fm��3.f���֝��\0����H�c�0��Ý]�Σ�1+SRJԃ���B:>U�:^��c�3nO�a6������y�d6툒�j�|��M�ž��3�Ժ4�M\\��,�%��K��т��M������+��Z�[��\0<ccJæ��m÷KV�Ƽ�;�:��\0�����C�6j7�Ӊp�Bs��ׇ�����q�LUN<xӍ�����N|�V����i~dc�T�S^a�s1�%�F�Λ�a���h�Z:����I�u4�	Ɨ��j��<�����/�ӍMY�K�e�R���ņ���s7�����W��\0�ф<K�����#��]m.+N��8�lC[���+N<���ц��7��]�BV�u�r�C����*�?S��@��&8�pg��ƼJj�\';B�7� �}/Vⓘ�ß��ұ�s������x��t�|GM�xޜh>U1���<�e��>�9ь��+Nu��i�	�\\%iƆ����:>|��CU�M��ʹ�m�Cx���_���3�>44\'>Bq��>&ҥcȄ�<+ˈiR�S�.\\�+��6��jE�Jf|�M����Ҵ�9�9֥y_�0�.����n��x���\\]�ܸ�i�-O~����{��N���1ұ���o��A�o���q7���>w�Ώ��\0�o��m�͋\';n�zџ0�?���!M�ݡ�v}9��O�E��S�+�&�@-`B����.*\n��/�~`�q��i���CVV��h���kw�.�$j�8Wu)44a��`�c�� ���&�9����E��.{�!�����#���=�7@�ک���\'q��9�Gc�,��3��6���o*2�^�/�N\0I[^�G��2�6��.�<_� y����-�|Ko��J�2��R�^`d�~\".O�Kc�\nL���=�P���u;Տ���\02�(�t%8Q��\'*w\\�J�<�[���:�$��Ν�K�9-p�JL7LfV+�\'e�]�g�N��g�gs��C�˝�F������(9`��@7sQ�\0�z��E�w[L�(�������t{���d7�o	��V�\0�	[�+~���?�xOz�wOr�Z��\0�2.>\'Ɗ_e#2m��(�(�� ��ǭ���\0N.[��l�\'s�ġ\'��9�.̌�st$�U��L�t`�*|��r�����-v���T\\8}�Ʈ�����[hx>/�J�B:T�b}Q���>A�����\\X�5� ��_��(�-v��;@Q�����~w�9������V񸗵�u-;h�{��H��񠠴>���\0������a[�\0%��BzA�����7�z��e	��Bq���o�Ԟ�ڊ�\'�9��o�A4*\01*�c	]���b�>7��<:����Fү7���J������ا\nJ�\0Ą��\0Qp����[��WtW�B����t���c^|yӘ�0���6�����N�o\\E-��.j�[���#�k�!��^`�TFU���Sը���?;>��� 4�������&h̝��\'���>8�%���a���,����@���*�Ӥm�ߴ���6]��(��B3�Hq*��(B��?B�\n���\0d�A��}M�+ϯ���m�h@�Q����u���U����k��/\'f���I[a�����` ��_礼�^���@�3/�-�ekz�μx���9��`xy)c�\'�]�{�ĵ(2�̻X����G��WqHQU������.C[��*j罹�6����p�����&�/`�ͥ�]�a?p7J�PGxh�Ƽ�y���F}+�t5#��^��@ �JΜA+SB;��6�⺛����6ѕ�p��Ɯ�ĭ;�4e�*W�TkNt�\'�>5iƗ/B�2�6��B95|8�|/JЩ^Jϕ���>w��~;e�m.::�q��q7�CJц#9�x�����Ԟ�B\\{�x:1a��ӝY���5��tv�>��j�h�r��	Ƅ�M�w�>,1.?�E�Ǝ�S�����[�Ƭ?���!����_0b�<�Y�x�3�R���a>\"D0���Nt1���CK�����K��UB;�z�;i�ϋ�b���::y֧�>&f�]�\'�̺��\\��~��1�-�\0�]�B&���t\"Ō����ˉs�8��1՗�h����\0Q��T&.?�D���긜hG�ќ�V����Ԭ�j�ua�x�*s�^�%�[��Gσ.\\�o�o�ӏǈ�\\|\n���F�����\'>wkt�����_�\0���� e��<WPe��߃���+��ӍB��嘲[q�.T|�P�ʣ����=~b���\0�hh���X>d	m.�3�HGŏX��t\n\\�qb�@�\0��m*����\\�s��n��Il4��{��{5������yS�Wu7���Y�u���\0lc�̿�\04�������h������[-�6І���E�9]CmY&��0�#R38y���N��~GCA�R��@�� �Ї�*V����B3�����N��:\"�z�`������Ii{��t�s�`�a*��6�M�.�B��6�.�M}�|L�$���W��k+Pw�n��?����lP��{��~�R�G��hMFM��/��YfN����D	4��R�����ܨ�^�0�����p�?�~ۃ�f�\"6�s�ǪV���Z��.�I��a�Ɔ�.;hB��\\ �����9ӝqM��4p<$3/�O&\0�5��by� �\0�BT�NN�g��0g?\'�Y�z�P�V%�4`�~y``?j� ��$V���\\APr���م�����T˧�Q���1��=KY��P�\\%���f��Gc508��y��.J�oq^��@`�H��}T+��?*P4�M�>����<�o/�s}�N�2�X9�B��U�d�bwg���=�ӏ�����3�g.�!�~(tz�R��%b	Zh�TO\"?��0Ц,\n���֘S$�>�\0�YU\0�!�b]Knca��6ɻ0��԰+\"i�8�ʞը%������L���br��=�8��6��WN�WR�l����aٚ��_`�ܔԣ��[��ì0O��7p6=��`f����v�[����c���H+ԯ\n����1�t6�n%|��j�>,�Q�����(l��KH�|\0�s��6�G��\n�c\n��Y�ݐ٣�2k;�M*���$뚺;y���Y=��\'ݫ���UP��\0�����	}B	Ev ��r����E���3�<zNH�g�z����BLւ��=���;&��,��������%.�AWs���l��6WɊm�Q�Y���M����;s\0��V��\nmЀ���$�2����G�Bvq���@jo�&`��/�ա�\0w�����>_������&N����\nZ�e9��`Fڧ�Ή��\\Ώ�6��+j��,	n\\a/O�q�<;�v�+��\0��=�a���6/�� ����M�9�λF78��z�a�CK��\n�먈����>����m���R�J�*Q�R����R�44��B�v��3��\0������ǖ���18���A�\'��P��~���S���%�?�e�,�K򸱇L�����\0�h�^�в��\\�r��L�A��D0�P�?s�?�V:�ԚA�/[���ŋ���:�\\�r�|`�֫�e˃�>#��ȿ�\0���>�3�K���%2�^�����Pe˗��L,��B�h^������2i0@ˎ�и9��7�ˇڔ��j��8���YҒй�u���mh���/�u5��_h���挸O��΂)~Mwj�[<��|@���9�ĒYd�:(#�I�~eQ贜�U�K&��@�m޽O�n�!�]�L\\Fiպ�{J˗��7q��u��e��6�|S���9��ѳR�sɎ��I��j(:4�4���Ľ}M�p��,���)Ǻ�>�u�\"�L\\\\��hCc���B��eM�]jTb�J�*T�R���#� c��g$�F��[���9���� ��*:�vxL4>`]tA�h�����e�$1�z�>š�	{�y#�PV��|b��\0JKpD�ݍ�M�ĕ���� �x0����}�������H��@�P�%x\n���+CZ�����C�n+x$\0�iE�rTYp���h��z� ��Vt�0���+��H�#�^�;��X02��������RW�Ѝ�������>��Q��|g��>��\0zj��,�EiR�jW�Z���F&��phB[��b���U_�E�7�\'m����m�\\�h��jJ�B\\�����4>eŗ�ŗ�S���/2��.\\�zV_�r�hE��AX��@����&�.*q�JewT��J:�u���K:��S���>�,�w^�\\�˗.Y/K�»jq��c�4K�\\�r�b�@�A�\0e��,_q9Df�+��!���$f�a�}�q���R�qn�Yq�<8���uQK�h4��E�r�ˋ�,P�0���{��q9��-��u!׌\"�.�,��6��?2�Q|]x���Nu���>�gՑ\"p��ʺc���k���x3u�\0{#c~��	ϸt�����d��F	!�Ժe�X�H�\\U�G�X7�\\a��I5!�4�q�m*0��,�:\"(����`\0�S:~�8��S+�l���eV$7r��!>�,VnEa~��ܞ��><[����g��N0���Λ̧.�é���s�R���,4�ˊ\\QK�A�b�8oF����B\\�j0��6�%f�\nю��XKsG�+If������\0��)��p�ZO0\"�di���nr	���c�+�0\"a}���8\\I����#=���:�ˡe�2�ԥ;OK�UL!�Gm���:�e�m�k��K�Bl�c�Z�.0�PC���� ��aI0��B�}1�*�T�gu�T#�C[�.	[��J80E��;*jq�;W1�b��+���R}s=H��hFf����F�!P#�F	Q=L�߽�o����6;�l�Xm�#���$�bM2�ED�_�������j�Y���Џg��h�a�=La+��oP���̔ȬO�]��Ԅ�leFtRha�P�3���R��g�����\"h�àA�f���*V�+Z�*T�R�J�+��S�7�\n^�����E������~�͡*7��ӈ`�T�\n\n�D��%J��*T�Q�H�d� gOhޕ*V��ҴT  iZW��\0yj�)��!�J�uR�	�#f�-�_�5+J�ZҥJ�*V��f�:q���xh:q��x�yq.�/��\"��\0	��x��mw��Y�`��*:ܽ����~F��KՁ��?��w���<��h�s\\�J�*2�h\'�㶄�xT�9֬�ڔd0����0��#���=*n��AS/�����%�\0g:��,�m�YZ���\\O�F^4�0��^��jY�ϚVWR�%etVVVR\\�`�J�i>I`QltM�\\���^a֧�7�lG�É�����N��\n�L�ƃp֧0!�A��.�ծ!��ŸU���#��*2V̂�ș������+�9!���ܵ�Iw�x~�\'�	mLs����~i���1�����4�\0r����c��[���$��I������2�^��J���Mk0�R1J����^JW�\0�yяՃ��8��R�[�w!q;\n��PS���\nvO�I�Q��:��o��S���9��8����kZ�V4S��=�Xa�̵]���G:dV<��.�̹�Dj6[<3�$�FMCWE�8��yA���Ģi�U��sv�J�����.VUy!��W� �>I����t��f�����4�T����墩�a�>4�D�i=2��F\\R��1bŋ��b�6���0��܀%�p��N�%�d���N�aT*;c�B`	�f����>��=��r�e�\0�hV�2�G�d��P�\0��J�&��A������S�~#��6;���xA�*����Iܥ�������O���Q�X[�˘J�H:�Y�.�|�P�8Fg�0��G��N�����.�3���J�^�w&AoD[]p�I�(�	mv=��\'�h�^�U��1�x�ܸ�B�Z��\\qt1���l��ُ���0�����.8�����Z	��[�%%���Us1�7�-;��������`z�]��nE��P��\"�6�\0�NSۓ�.��1��`9��f_9�J�P�VQ*�K�����3;����-�Z+���z��j��Aٺ�\0�3\n%���!��B>l�*q���M�h�����&�m�Тn�-P���2�[����*�[N Ƀ��=��^%`W��>��AUXMŇ��\0�T��d6�Dį+�Z36�_d&��E�4�2܆\0����%�:���}�\\Cd�l:r�>��-��^�\0GR�r�+�<oSA����h�0C�;x�\"@�%@�*Tt�\0���h萇��w�J�	Z\\t3��7��G��J���h�P�?B�u�bUCB��;�^u��J��&�K�xq��CRGU\"�AP%x�Gc�>�| ���t��Kқ�3��R·A�wҹ�:�^j+z�`�ρ�Bs��q��.�*qZ�`���p�9������:�R!��^�%4e�>�M�*��.#�#�h��ɼY!� ��ā��	f��TR`Z�&���7�g����,�.?ն���y��cFmM�J���;r��ԋx�F`v�t����8�.�˙N��*�A��7�rۤƄ�5�|n/�9����˛�L^�c�p�p�KH\n$u���	�p��:iN�7+��ۏy�M��J_r)߸���R���e��ޘB展�\"V��q���?�[y�����^�QTm�A�`C\nr��B�	s32֩`X)��R��	y�i裗7�f�`W��,���żvҘ+HڜJ�e�fF���\n��fI����U������4\\�=E����^����$]9K�������,^���Ѝ/��ǹ`����o�	�*�6��F��e�x\\��H��=�����u�\"7{�*\\�wu��{��t�*�,�l�:ڸ:B���`��[B��WS=��E�y�7�!��I�?$V�\0��l;����o� �^��2����5W�BU�o*g��Q�?j�����rb6���Ж}��j��[�)�;U�]��R�Ak�T+�3�+W�Bׅ;�P����B��9h�0\\�_*��`}̡���~>��i��M��g�Ё���E�/��2����+Ba�Z�mp�f�b��n�>�a�.Qo �ܖ�K_\'�N����y�wݢ��Ի�� �����S�q�!�6�,�%f�O�0��س��f����\n�uhLi҇U���6ݢ�����kuq�-ǧrR�^e��B������\0R�Y��c��*��)�͇����^�nS>q��%)Z?��*�>����%�g�s��ybSm���߄�9���ݯ�f\"�^�աAX�Q᭾��]�V�� <YƠ�,��V�\n<�P�:+�����X,�i*������	��C/�B�?�� l�+)o�f�п51�y�Y��mQpіj����f�b������s�V��׈�x�	��h7X^�~�EU�(���_�����e����[����7o�\\g���u�wV|�EZ1R�\0�K�x?�J�ps(����^���i�r�)UsQnÖa�#G+�m�fڵ��t�!z[j\\6�y���M�d=S\0�7�Mp3yj��jK�ة���b��U$\\�w�e\0X���ċJ����)�j�	\'�5��O�#��Vx�=R���92wSt ������+�:���]Ϲ�O#el�\0A�l��/����ǁ*�l���3�1�c���/&���#]	��	�1gr��h7��o7�D��b�W>���i\\R��OY]ʟKoyy`�N�\n��gI�1���g�\nI�-���#�xsmtl�(�Suު�L�����\nuY|F����+L���t�>�CV�ѕM��f��/L��?S+N&�9�6��*��\\�C�	R�٘��\0MMh�ލ�ф]/:�Z\\oS7�]�_8h���D3<ƻ���͆�:\\.XbPzCg����,te�hK�F0�CCx�h���B ���M�\0%1����t\':�:�L#/O�s�;¬���F�������7/Q�R���p񲵯B�\0OZU�_�E�+��Y�ƾ� ��:,[��fE����jF�l\";]�^Xhy^�������8���a�K*lK��@�-�1\n���A�\n�D;���Xi�.iy��y`���!.Зz:ж�� ����p�����K��L�A���\n�\\�	���p-Ŀ���hX��&\\)�^&�S�_�oQ�E�;?1\0�����~�Z^�1�0�ʘ��Qڃ!�����0Yh���2x����Z��*�)������}�,����嗜 ����S���.�[a	�H�KĹv�렕�OCr��0��&U�f>Th�zo�8��eu7L�s�jP_p���Ձl�q�B�-����w<�&|�.����GG��U��v��_���,S,�3zP��,r�>%T����h_R�Q�x���Y��\\�V�݉�Ʌ�\"�+ܢ�3�ә\\�\n�뙲�)���l�z7����c���u�of�h�Z!��gg-���v�\'�O�3)x!�%���x%e�8�ߥC�J\')sC�|���n2�D(ATے8p�B�=F���+�[Gʡ�t(�ݰO�+�����-��%9\ne�Ee�>u�u۠��~��\0Ԏ�������y�v3���\0�\\��%�,#s]���.\0�`��/��y��e&���#\"\'�	*ȓ#��asL}��?R�JoS�I���������-޷�������m���\'ӂ$i�+�;&�MKV�#�+{���qK/`�lN	]{XY�Ƨ�1��6��s���>`�>ϙ��6�J��\'���R��%|��F��\0�c�*k\n?oAes�\0��;�=W�h�.��H�.fn�*n|Ei�k�`�@�C��NgiX�e��7�w���QLɱ���=γ���2H6�D�ݱF��\0u6����\\$:�o�|3���8!CVP�u�\0j�\0��p����m{=�w�+�w/ܱr���+�j���a�3)�2���yK�L7��G#>&��=��2P�v�2v?e�|	w\n0�̵nO�`:m�V/��eX`��h�r�k,M^N�vk(��8���-z��ȿ�62��J�Q�R�N��i�\"Ձi�!&�a� M��fq�~���	U��~UW�d�\0P�Z���c�K5O�t|x��Ĺr�BzKliæp�_P�`�����Ŵm���,��c�w��G�i��!N��n;�ׯS��������3����1AV�g�W�v�}n#WACk�+�5(#��.���V��u��Pmi�=�(����`R���:�\'���s���)\n�@֤B��CE���P�+E�h�σ������S. �\0�/��X�\"��!U�(��\0͂P�G3��uµ�w��D�r��f@9	�\0�UC^f���\n;��٦X�$���k��XBsx��n�G���t47Ҵ�q���9�1�S}�J���XRB\0�<x�a�X��j�Z%�\\R��b4~T�gѠ\n�V�g�U�u%����~`�<?Q-�v>�7��ı�<)cŭho�;̹�%�a�trI[�xc	��7_�3����&U�|#8�46�Ӊ��GS��ֆ4�i^.������;g�6�߸�A��~tY)��%�y��w�q�8�w�}3/RJ��Y�dPK�q,F����y��9���0�_��)�m)e<��xc�W�ǥ�����f�ػE?��;q�=j;?��u�m/K���G}K��h�Lr�\0Z���n.:A��;�>�APЗ���\0\0�e@�\nR��l|��̣\\��h(���j�3\np��\"�4��@�e�FY���;ЀW|��*�T�ڲ��>O�@��	��j�׈+�NJ{+�O�fH����%�[sF�[���n��ީg�[fK���6�\\�l4r�� S��B:� ���@mɷ���V��x�u|oQ��-�a�W���q�\"��s,�\0�ՋF@kt�P�RmB���7`���d��ܼ`r�u�ޭ۟�#�7c�!I�J���DZ�k=j3)b�QK�,l�gS��	D��TX�����P�%u�5�J�\'�\0�q7�� ����CJ{;����G3�=+_�]�j1[[z^�~��NSb\"��`�9c���|���b���~`�wWl7#r7(�dv�d��_V�N�	����)��J�5_��c�5-��W�w�%���غ�h��qH��n�%q���T�K/�N{Y=̌Q�X���/�[��E���:`\\B�R��r�����(���������r�.s`���ߚ������7eUPl��\"PB=\"��+W8�\\9N�G��Z/ ���bݗ龎��e�f飻���Wz�cv�d6�,i��?��5TQy��eͦSYb�\n��A�O���;ί>̭�����|��%!�\\��=댳�=q����{~&�V��PZ͜!n:�\0�/I�v�}G�f�>T}�+\n��(�>��.�A�@���D_�W��<k���T��#m�ݐ%(�{`��3eܽ�&)��y�vc8�gЉ��\0(K������*J�@�X���~( Ύ����C��r�t\':\\��3�������\0L6��h]$,s���B�ںLEX{&1�P[�l>�����qN����o���g����B�0Gr��*�A�L��/�qftY����q��U٨�+�w�A�#�)���\\���~G�{��}VT�w�Aqh�nSB%�P��f@�����.����e�6��\\j�����W���,��l��4xJHm�=�\"�����3�6�d��ֆ���|�:��K�O�������6�Јkj}q\'Н1oy��F����\nc6��e۩�eD�s{��yȿ���_�L�T���\"�1t>�dۧIzm	��/��9��_�T��*ciΆ�%�Όc��9��R0Uz?�%GC��5�_-�	~g����<��o�ᛆ���{�@��m��/�W��a԰�>�_\n�����E�\09�Z�5�h�^��s�z��)>8���,44#��W��u<��.nȬ�әzn(hgEҼH�s�5��?�J�E[�Ub{SQVUė�E�V�4>���)L	6���c�Y���؟�,0Lzg^l��L��t��2��O���4\"�^�/R�*�x���{�\0i�2	��k2�n�Cm$�K�����e�6̾>�B�5f�D��\"���K�ہ����_��I�Us:ˮ��fݯD�3��t�	�Hm������F������A��T�)p����M��a���mE���[����\0��K�6���\\5<Xxm6�ng�s�~݉g�އ\\�m����s�\"}g��*���.¦���87�h��������	�-M�3�8��ix[Y[�6�N`7�+3�A����Y��+�c�7���m�%�ZI�Un����P\"Z���=L4�Cu�S���\0ڠn}\\����gK�-��ӭ]|�%�̳bܙ�x�t�/�bV��.ez�U�o0��8Ќ�GmΜL�>�(we�CK��6\'�6�k�+�c\n�6Q^z���,�1���d9��ϰ���F	�$\0�Zz>#��>h�@�zů��~������!����^�+ڐ��\0>#W���)8P�\\���k��B�O���&S�A���(]�s�����acd@r̮gz䙓{ �!��Z��ĭJ&�y���*؀-�z1�:��\0��>�M�Q�xAd��U�t�?�����r!�F\"�+�=�f��E���T�%�{m�7]�\n���\0�\"��}m���\\�Ӊ�ƜA-F���6�����U�\'\"	<�ܽx�6��U\\���U���%�ws�D�s�\\h*� n���n.�LӺ.��I=9)���\\~h5�)8�+�`l����߽�R\\ZI>�tC��6(�Ux��b�G��f\0@����q�,��Y�~D/Uf_���m��_H�UB����EX��6K��%���	�|������><��˛��:#ǀ��q9�-��˺�[\\���~���ޘK݃ܲ��������x-�cnɃ�l�5��?zZ��&]&h��Hk�6��9��5~R����\0q��Wp5)Y<�eա��\'�B����\n�=���޲��\\���M��WGVAZ�Z�ηjm��ϝ��+:���\n�Q��V�;��p33E!��X�Q����1��0꿹O��>�>fm��H��q�3����J��@��G\\\ng�=�r��d	2��k�8��8�W+�CCR�\n����	S|��m��j��ω��~!1���0�W�\\�[Ҏ�t�C?��1VU�ۡL�.`�xC�V��	��ľM�˛�rs;����W!��E�F�.~�a���&6}�Ls�=\"�^���a�y�Cu��T`��4�t*D�|+B�6��h�M�T�͙��c�[E��:R���/��b���@k��\0 ���x=@ٍ�l~�9יp���X�`X����\0,��ef@��L�J�z�y8��<Le��J&6*a�ےۙVҏ�����Ʃ�/?0���N6�~V3\0��!dO�#w����V�D����)[���[��!dU��#��Z+e���V��%nС�ةWĬ�h�A��@����_���(b� �CB\\���/�\0|AMCև��P��\n�X�3�-������z��7��(�����w��Z��^�]��*c��&+??3n����e�\0�%1`�ݥˎP})��!`��ZW��Fa!)�����M�x�Px�wj]\"ݝ�겑V���a��CO�<\0?�o�B��C!�|�7�B��y%I��:��F���@��;MՉ��@��-����v�6�;�:�lR��1��H��O	��>Im����Qǅ�Ȋ�l8���\\,,dP%�)����M9�fP̾���K\0n�CW�X�0�׍H�n��� �;�-1�WYo�+�����!Za��`�T+ܩx�����Oԣ�m�=�oW�,��Eg�܍]��8���W��H*:�@q6��3���n�mB0�+��P �>%�g�	g���!*?(~d����b=�4�	��d5u�6�ʴ���F;Y�U�7H���&Aq}r�۽������=A~:>a�]��Ov�?�6�,���l�ҥ\'�Z�8U��{�/��Kuٰ�8B��;�@�;����	�E�ʲ���vCM�s�ebVȐ3��y�,�\nQs�*>Z�D��V�۩nڃ��\\��M>���itDY�&�K�Oq���O�����_�B�n���K��8��JW�aX��լ�8��������H�l��*�~ў�\0�5v���\"���C��/���J����ˊ�)�)��%O�3!�U�%��L�MͿ������ȏ��\n1�̶h=�@��K�ջ|#�+\'ىQ\"��k#��cK�@J�L�Gw4yUB�A���H��c�q��1�P��KC�_D����\\���#�;K���{�iz�?���V���Ɣ���w+dl9~\\K�,�b.=#:Ȫ��\0ݎ�@\0V�-�R�qS�`��,���HUbUKe�a�E��x��v��/�_�������2���V1툭!�S���&��4m2���EVπ�h�E�^R��Ɓ7�6�m.���qAm��GK��B���}��:<�ĸ�И�����o�lk�T6��Z҉�S��j�Q*:=h�����ĠM*������g,�]��,\"`�&T�F���J��]��(h�x��;[.=��D8��r�~X˻��*��_�}�?��\0\0��Lh�J�l��Da��[�٬;��{���m����J�45�ք4a�R��t�\"\'���[�b��L\"��o0�u�,�R��|1��)�u��G3`�]/A��CoBg\0l�̠�Lm��Y	�q<�f����\\�B�m-+C�]\'�S������)��Oc3��ч���9�4e�H �(!�*z�4��19�\0~2n��B�4ꙕ���tt����x&2�-�\n�_q��v!�Wj��\"��/T�Y�)mm�`ٜ׍3�J��\\��=�4g��\"���j��!��������U�5)�Y��V�^5�U�A�v���3�\"V)Ep@\'aQ\n��K���bU�N}�n۬bQ\n���~��)<�v\na�h͙��&�5�:�\0�����ᵻ���MD=���-������\0��W̫����v=��_��<�ga�A[w�L�#��\0r��d�e���6�L�5�PSr���<8�\060BL%�\\��\07�i�[���Z�ȣ��\00�̻v��������0H	�s���eK����\'>$<ۥ��f��r��T\n�޸��\nՊH�E���!*�M������z�VV\"�u�Q�ckA�^��syZ�0�a�W����,r���f_PO��{&A�^�K�����.\n�y�%��I߈�y��:�	GL?!)���˛4�V$��~A.�\")�+��Z`����$Eg����N�4���ҷ;+���ؖ���W::�m_1�;c�w�`L�(NH��aW�F�(=�H>*����,���\\\'ȘW��bP��龄1���u4?��.~(Z��_z�;�\0��X�?��^SY�ɸ�x!��Xij\'lQ�����Tc%��r$��p_��[-�x��LPk���-�be	��ޛB1Ԏ���*�U�E��}2Kp����՘�����+\'ķq��sB��TBE�Oy�̮�]����ѐ�\"4g\"���^�����M����\0������e���>�L�>���������\0�@g�JІ�q���djy4�F������>q�?q(���v{���2p�Aǃ+Ї�����Ȋ�D��N!���>��4G�15�b��IՑQ��K\\��ih���b��J!+O�g��&��s�\\\\��\0,v�aٮ�������NJw�����-��\\x_��x��ro��\n������ކ75?���`Ư��/F:��hjB^����q�5�6���/WC[�u?��\'�a�N&��0W�x \0�=!�xտr��)�PAQ�J�r�.���0اc3�V%�U��5Ӳ���w��^Bo⒣�i~#��!p��/N%�yU�ƕ��6������}K�;	��h)ؙ��L\'��Is\\�ʭjk0���S�%(=�#�\\S,%u�*�+�5��	�m��u�]JqH������|������+�e�������K��qy�^a��x0Ά��i�����4�Wȗ�ic1V�1��E����m��d\"���k���P~�1V��D0��l#�	�E�W0��J	�m6a\n0bPiƿ�����l;�s|,n�p�̹S�G�������a$��0�l��5��ߢ�f�zq��ԯ\'�|�\'�q��n�<ip�cx��H�n�v6ʿ���\0��~��)���^be�n��e?�\\i��*����2��,%ws�.fXJ˄v��}�fH���QE!��yJ-0���f��[+-J\"�K�J���z�X��JlK�G;,��ܨ͉پa��Z�����eNe��*�0���hx�f��/Rs.\\Q��i~F�G(v�X�>*���\"���J#iJ�eU��Iz�T?1܉�PX~�qK�wi�x�.A`��T�~�vp�c��r���@���o�5�c �lS�ء�w�$����u�Ӎ��꿙��\n��((��l�H�r�nEk���<6��-��s������m�r�u�[����ћ�j��+n]�\'1�{3%h�O���ڸ���6ct��\0L��b��B�q|�S&A��!�E�>�˖�1h�m�����w���t¥�?�Mȴ[�eh�#h+l���X�a�U�2�0��o�q��?�t%͐e���ֵ����Q��tu�P��ÍY�9\'�2�(`s���	NІ\05�j�����9��7���j�J!�J��&ʅ��Y������wS|�zY���OI���w��D�%x �(%�ng<��hi~,��8�a�FV��Sv���k���:W�q�kxs���ޢ��J`\0��ukD_�d�Im�+VIp�p�X��,���,�T�\07&KY0��������dL4#�n&��%��sp�����O\"�r�E����q��j��;����V�b(e�[l�74Y�8�>�C)�c�z(��e�����-�R8�n,6���7�hhh<wӉY�����z�\n���%���|�R��Lo�a�9oR���4h&�JYp�tE$�Ih�U;,k�b;�;_�����a�������-�M�@X�8�%p/s�:�!�}S76B(��i�6�uP2(N�\0��\n׬�_�-�F���Z��h��Vt�z0�<O2$4!�.\\�Ď�duo���1eδ4t��E�����-�:a#c��(�l�\n����7�.�K���WW/p�b���n\"�L`�V1��.�.�A����9���ލ�˻��\0�6���{�fY�/���f�!��VнwKW�9�x�u2�m���|X2e���`�h}�/I����������k^�\"	�,õ���\n���9И\\���\06Nu4\\�y�P�;�ťO�	�L�èZ��C �m�9)k��	�du�V���@��ނ�rJo����#s]�/�]���5�Q�d��Ǝ�����sq(P�E�\0B����1(������2��J����2\0l�9�O񘡪Q�Kus��J�5~(\"���J,�J���&�\\q�ۻ�/J��J:a�,�v��qL����v����ѭ�O��l&��-�}�3��8����v�]�32�&�:�eUW!��g y�>4<�V�hg�\\3�ĳ�G�v�Tj���EĤl���\'�@�F��g�H�((p��E�CR�\0�u�j6��\00Lf�����Qal#{������!�]�����=��M�.�m�R4�`��Sn�PcN�\0p��\0���<�B^ճ��G`�w^�n��wE0�r1��t�,��4;.b�e��_ڱ72Ľ���3�&��* ?���\0�����֜͞.<.o]�J�7���̺8�ڕ�cme�0Qe)zaW����Z��J�%y��e�L{>`�d�zy\\Sb�(���uU9_�[E��\n�7l%�Tus\n;�g�9Ü��gu����O7\nȞdD�0�ݩ�y�BE��ˇ��EQsV����,�fhՎv�V��6	�ZY�����ʯ���P���\0\0pk���!��j�X��2���E��q�̭y[��� �(��.������\'l(]���}q�\0���\\8��PS2�3i׻x�]m�v����t_:�Ȧ�n[:�{�!2_�8^-�8%·�ܒ���5]F\"^%N�����r�7�*�-�����J��t7�R#��M�2�3/G@��a�X0�͌\0F]�0D@EFhɮ�\n����½2��G��0@�ĸe�L�6��m���ɡ�R ���z�]�����M��|!��ܾ�5�M�/GmK�Dd�g� V~O�x��_2h��S����J��G�M��\0iO�^�x=J$���-�q�6�&�\"u��*����\"�����\"��e1����g\\�;���7�hL�S9�_5mM���/Z�\n�q	pD��JfJ��|WW���N52�6�V�.���E������k�mk��C�ve{�����=BY�́����LY7�K�?f�[,}%�톽�$m��3���/�)����D7�\nj�:VZ��ԡ�f��\0AMI�33	^l#*m�lr���΂:x0��f|	r����b��.\\�:g�\"�m1�D%\\O,���6�#����_�q��}�o��ݡZy+�\n�r��(*M�&옦�RW� �\0������U,�d:���<�]KZ�^_�s=�<U�(�;Y���������`˛�����~W��,�|x���tc\n@#��C��a���	�`C�x����j0`˃.]�\\̨��[�,�Zs	���Uz�d�z3�Ec�x��m���E�aҕ���t��n�����Heq�G	�\'��H��J���� T�����G���gⶫ�\0�9R�)͵fΆ룱��OeCNt�Ș�>�d��8��2r�K6�Y�@��2_�����E�7�xs�CM��x\\!9����}hʶF:m�hE�\\�2(��-�^.��<A=��3�OCe�%5\n�H*��2�@��B�7W��VU�8b�������cq�}�x��\020S���\0ez�o�&�\\��F�}�}E�w.~5�CFF�u���Λޣ�����4t��/���>ʂ���	޼�xʿ���|9ԃy�n�!/AZ޻���q���z��e�}&�ջ�4�0ܩns�X��L�3홞�\"�q��/X�j�~!��h\n�ݹ��c|��(��k1X�\0�FX��?єA����(�$7���L�[��\0o-�G�*��a�l�a��\\����1�t����N4�^|��x�Ms��?��|/:�~r\'�%�殟�\'r�mT���]�kЖ�;�z��o�a���p46�(�.������*�g���Y�	%]�~Sް`�anU-v�5Gz�U\\��P�\\�ʣ51n]�_�\"�Ô{�0uh%�ɷ�+������1�hC�ӍpGf�[�S��;�I[*�|GQ𡏦�I~����	c`��M����m˚����K�;��ͩ^MA�Aĸ��)ˬ��%Z��l�/�Lǰ�i7}��L�Ŷ��\0	�{�����H���_�x���7�m�R;i�R�\'g���K�]�h5cXR�,����8�Q�a��?>O����\n.���/�������e۴e���b~҂F��uU�� rWo?(�nm�ѠƄ�	�|�\0q��s�i���X☄ٲ�St�r�\n�z�2JFk���N\nJ\'���(T��x@���~,�;��%�r�]��N55�>�-Y���u}�h�CE�������C��5ӃC�E����C�/�0���B���\n	�>��\0��8�����h��C�7Ts9����^�6C}9�]2[|���1�����>�6Au�a>��&�-��R1sa�)Wp����O�z,�+���b�D����h�^�O��\\��yn�r]z\'~r8`�_f��y������Q# �Ab~����ӗ.[��Je�,�q\n������m��b�J���~}�u���2��1*^�%����1�ɿ�ǽ���[�~������n����>�Zl8�M�q�.�H�*�;��&!�{���ܾ�>\'TQ��~c��X��r��Uk��Nfoi��f�E�/����\0�/��O���\0�G�\0z�\'�\0f;�!�����P�d�\'i�ǉ�2���2�^��(|9z��t;\\]���s.��i�\0+�,M`hc�F\\I��g��5�W�G �6!Z�3����@��g?�F�������[?�_��2|�1�\'�>��W?Ȅ���@�Ҵ��)j�w+����\0��\0ؔn�����Y[���*��2��\"��¢>�P��v�A��I��W���vf&�\\/�^lq\nF���`�(%�ٴA�A�����\0�I{�}��\0i�~Tó�C����)f����eO�����#���Zkc�\0ul:4��S�\"�\n������<�����P?l���r�(�C@�l\n#����������e�����sQ����{Xql�t�����\0��\".��{������3��9�a.[*>�2�}�����pa�=�^���sgtΑ�aW�^y���o`�V�e}3���H �%%z�/����GF���j	�)c��}X0]~!9��k�|9�%�~<G�J��Ni��eO�/K�aC��J�\0�^��_�^��oA���n�B-��;T��S(�z�oČ~��!��Q���\0d��f~����x�L�%�t�\0s�f1��%hj�r�>Z�%�̏��mx�����p�5�ma�f�RK�5�����TA��a�\nK	�\0�f���0vql/y!F�4V��iL�\\%�Ҽ3��Eן\n���X���-/Z?��q{T>Eq��a�pp��	@���N�BW�Ϛ�3��t����O��i�o엘:}K�������?���&+GRԍ>�N�޵���`@��R�E[ciK�~%\n�&�]��R�l����mw�x�!q>�h�����y�/8������/�l�#�w�s������K�J#�L�\'��_<x<���@N��K��$gt��ˏ�phA���_v�\0Tv/�\n�չ�(_�AlPPipq*Z�h�j� ι�����$4�r�+S�LR�oVN�������*\"�,�Bm��Z�/�0M\'� �ȧ\"ܝ,i���O@Ї�CCBq�o��Z��c�a=�������0B3:6�m�ds/�����z����Ə��Q�y�/@˃.\\pt�˗.�.���ȃ.]�x��m*��$����MS��q����ė/^g1Ѫї��6��0a/̗X8��K�.A�.9z\\��ƹ�h�9��;K��hܮ������v�9��JE=j�~�ĳ��I�?���jh_�����0�� t�9���˜�Л�4�fl�8���A��~���Ŕ����s�Ǝ7����9g�7!��E;?2���%���~���\0\no���o�R�\n���17�߅?�Xׄ~z%��a8�O�r~�Y�\0�\0��\0٩�\0�\'��\0\0\0\0\0\0jn���9�8ɩ�;\'�?��-�[@��(��e��O��\n�`�: ��������)����/�wښ���(�pk�zG�A��Ǝ�!���Z�z$��2��:h�.��`�P+��$�pC�\0W� ���.b��}��h\0rr�!��ٹ��k�����F<�#�9O;:ƍ�k�{5�����z��>����x5������d�׆��Vk�ag���zOf���o�4L�{���Wx��:k���)]�N�>��?�5����:=��]I��Ё���\0��2�޳��r��H��(�$��#���G�p�=�j�⃼��CHw�>��2���1�&��3���;��xֻۗ|t��J43�yo��|}�z���uf//��ߵӯ����p��7����=�l�����|�i��+��=��N��\0��:��6�ܢ�x(�ex/����$OJ\n@�̵���~��\0�w�����:���ɤ����]S\\7��x�q�[��\0��\0���v��9����0l��&��A�3��!]O��I��df�^�������2�[���p��e�,~�O��ե�I����X?��#Z۝��7�8����+�	o�`2*����Ɗo4Wm���=�~�Þ����=��X��Y��L0u�p����ɉ�$�$4ۜs��|�=1�޶�?�ϋ����5�I誫N&��G��ߨ�~1����/4�dӛ��|�*��f�Х�2((�羨�Z���Y�<�=~�Ok����m���`�^j�W�# g������ӈP�v��v�)��U�p;���h��\\���!96o����\\�O���O�\0���p����\\�Eo���c�n�����y��X�$XW���l}x猼r���p�Yj�txw�|I^6e�l˛gc�v/9k�hQp��Q�頀ɾ�aVϸ��\\�M����>شpC?�����S*99Ӄ�\\L����z�r߱�i�v�Y��l<�{R�����(?�}�E1��:g�x�W������k����|��u��ǕoH#�z4�0[7j�o��o�T�YC�vݭ�������ÿ��$����a�Wx�@�?���!a�XCǖ���h��`�%��m�w�U�86��K7�}�a�9㱟�ETs�Dv�Qu^a���ŊE\\���{�~?�����&�ܲ�{�N*����Y��ˤi|ÿ6�\0�%����3ќ���Q5V���Y�n�G�6�������\0���\0X_Ճe6Qi���vC�5�\0Y=F�>yv���\"f)s�ۏ=��B��h���_�����E\n�àY:F�V,њ&�E<��vp�e�7~-<���\'{�ڐ�*����I�����:�^r?�����u=�O���6�m���=m����Ǟ��<�����\"�a�~�G����Rtz��\0�1�j�t��7O���\0]}��\0gL���E���m�&��\0��].d��x�N~ǿ�Ԟ����r�{��xL��V�m#�ϫ���˹Q�N��\\p���D{��t󧯚g.��n��\0G�����t�}��ﯿ˱���t�-����A�RL@�F�S����|�0�y�I\"��<��5X�%�0;�\0�y���5Z,�m�5���\0��{��z�_�W0Q����)u�}����[�;�:��X=(.��<5���ס-|���$/�\0T���_��5p玸a�Pz������a�������0CR�?�+aȖy��+vX��Q94���҉7���b�r0���z��b�)%�)Ɵ��it�I�����\"��Ri�\0���\'̮�)3!�x�w�^����k��I6׭%���-�n��&�\'��ij�q����4����A���:c���#+,[_�+y�g9c��oVͿ}��o<.t�]Ɠ�z���������7G�l�1\n	vy����4а9#m���gԊ�w!t�]�����동a����%�dr��\"����Д�Î��9f�u�]\\?-�f�?wvp ��9�M]���O�Lp��,��$���ϩ��|J�΋�յ�/9C��1�\nˆkl{��:�2�~�I�׽˜r�\0L��[ =���Q&�E�΋ϔ��L3S��r-��O�\0߽8��$�I��9@7�8��+w�K.����\0;50��}6�߻�0�,��T_<:��-��Ȭ��\"Y�����\0��-6��=���9�.��#o���\n.��c*@���/P\'�>�?��\0N��n��Al�-����c�jj�������/]:�l�����Y��ۈ���y-�X#�#�4X��#��������y��	�����4���� �xc��$�E>��Ƹ��3N{�\0�W<�	��edtiZ��g�j\"�\n�>�-�N��$�4=�{m�o�@���*(����Ť;(�eg�j�{<�\0�����z����+�j����K�ã0(@���6����l!:��믅�2<�4��_Ŋ*c���AQ����(*��T���@>~:��WT�\"5H0�g�Y�n���w�}����K a��b�����F����T;������/2��nw�����b��S�д|-��\'�j�0˸XC*�y��O$ƙ����/��!V�,]�ɓ�/֑SL�▚ŀ�r���,P��;¸�C�e.Q��m�ý��JKg��{�-&���#d������(��f��p-<!˾�k2�ࢩo��:���~���J��\'��I��\n{���H&���g4$�A�Om&�N&��7��*�Cwr�/���}��\0���1!\"XQlkj��:{i(��y��k�鬋O��rw\0Bq��[���F9�)n<�@z\"�0�	�h�l�����_$b�F�0*�/���E�D ���g�8r�Y�as��4�c��\0!\0\0\0\0\0\0\0\0! 01A@QaqP��\0?�hb��b�b������������>��/n�JR�t��=cB�Yo	�����.nV���>_�4�Lq1���_F09�ޑ�TT��45\"Bs����������>p�����Ϣ$HF�d�Ĵ��E5���ssxW��&�7� ڦ̑	ɢ��x�(�sJA�m��6/�(1��-+��J�EO�OAaKt�1c���!	DA��lL�\\�2�Ox:bXj�^�Q���i�cX\\\"0r4�:(��7�؊R��$�<$=1$h��J��9��X�� �\"���(�1�\'R��؆�$2v^��4\"cB��Af�{&!NP�DG���D�X���)x��2��S_F���삆��OBXэhЧ���u��;��91�o��Zءч�QA9��q���$��y��-�a����B\'�	�H��^�Q�^(����:RRa\\����BFTU�,<��\\����39�4>��A�!2��&o)�\'�b�8_�G����h���1>[���8�<^�Ѡ�ln����(�K���?�Ch�en�JFථix���,��Ѳ�KcI!lh^�EJ�-D=	v+ ߃q����\00��CcF%�_�N	L$���4�4ņ�Bf������Z&��y�\\!	��,Ab�\\[�؈^�P�և�R�Y��4�l��F���Y��C�)KͼҕbWg�1E�.w�Ab����͏�ʶI�u�?�:aNO(4O�O�<Q>/��/p�)zn~𸹥��\"��\\_��_n8Q���e��{oc�|�5��h��7^Y8��H|g�x���h�-�$��x}�ыC�mB1�0�.[)K�R�N���f��Ck�6ƩJ��T\\�k��f.!���)�	:#^�6�d�Ć�DM�	�2q�ǂq�e���y���L��C�K�j*��to�btO��z��u$l�b��U�P�Z���i�J�CU�\"�H��V��Q{0�f��f��2B\'�KpV���(n��DbQkcJEh�tJ	��?ᬾrj�,4��\n\\��U�7�����V�^*Bi��5h�p�g���p��!Xz,,��kb���sF�^��)iLzc~�ƪ5x���(��]�Ҡ�sH��i|Ʉy$ⲇ���d�\"�I!��|!7�4�m���Jc|�(�l���\"��K����s���/�\'�����\n/1�^?Ȥ/��GL�*��\'�S��m��LL��a��m(�����zdЙ������y�i4�t����%vQ���JpN-k(k���HhPp�ia$���L.M�<�1NT�_+�\n1qj��7�<�ĜН��IR2ކ�A��OQ��Qh���e~ፉճl��S&Ѱ�Ģ����1cCe��6?O���ᷢMhL�������C���P�>���/��^1����~���K�޻^.[�w�h�g��\"��md���%����� ��t|=���6��2E~��������!����x�O�H��16�6THh�\'�D1,#�?ѣEiA7��T���=	��J3�&Ą��`.����e���9N�_�ɺ�[p�a(.�2�U�e������\0D�!�����A��	%��������Ǳ-b�R\"	垮\'O�&5Cn��\'�6�CE�)�k�B�.��6x_��\0��;R!&�\'&����a�q�Q��Ҕ�\'ZG��*.MǄ�X������Yxl�ĸin�!p�ou��xh���<xb}�b�FA�t5�C᷄$Q�v��D/$�&7�C�_\n�i���Ά�m�ܡA�	pxoJC��|/-	4\"��b���,Bas�o�B�K�l��Н�&!L4Be�E�	�����)q1F�O����i	�Z�\'U� �qF��B=����ۂ�J4�����B��C<�(����o,Xnb�d�LXv��9F%�Θ�\0�4VV͑������.��VDL@Jŉ�ٴ%�Sv�`��͡��aSb\n͋�}x���	\nN�a�F�X����t�2%��x� ���Β��]�}��җ�,�h�8\\***(���\0)\0\0\0\0\0\0!1A Q0aq�@����������\0?����_��p�T��)�_�<����|O+D��.��J��?+�xTH�!���nY���:�JL�Ŀ�Id_r���#���;�@J=O�W��R�[��Ç�*`FS3��R����|�=�ʁ��BUI��El��F�q^7�\\_\n�]�p�>�\\�b,J��TJ�8�1̳���r��/¸�xTy�[p\n�/�TKn1S(��+�b�Q+���._5��ו~���R�J�r��;���x�����_�Ó3_k�)+�eP���[o�TD���GhqO#�r�Vb� b��\"W�O2��X��s�Ν�!������ΣB�땃��6}7�!��{���A�\0����\0ר:�n~Y{��e��+U�Y������ܣs��+��\0G�����	�ΤZ��h�2v\'n=@�����+\"2�JYv����?Lܸ\'�q@���芊��\0ljܥˉA�L,PHѴW�ЎZ��Z�!}�#k1�ĭ�*�EV�IP��q���^O����~�^i�~�;��;���GƼߚ�l4��� S�\\?���|�)��J��Gq�5o�3�W��\\�w��lZ.ҫ���p`�T�|7\0�=DA��Kz?��{j=K���6�4M�^E1).��-��È�:\0���gB��F↢E��D��\n�\\ [����y�������@�e��@\'�\0�h���60\"�p����5�������\\���c;�;{e���\0����k�毚3,�)�(;ea�ƈh�/n�}U�nK�R\\�	F#����ߙ^�AF�Fį�T�H��Jؾ�.��wB�1�R�n*�����X�Z`�M�=��s�9�j\"���\nK����S*0�y\\�R�T�R�J�*S-/�XJ���!\"J�*T�	�B/J���pT���M�!j�i�x���@�4.V��nx$N����#�n87�D,�h���?i�\\3q�L��._�	^@����Sb��ˢ,�g;�W���\"#��/lJ��A���b�Y��\\U��<7��~��/:�����<��.\\���8�)3J��*W�߈rU2���\\m---ª0�8=ˤ��p�g]xӈJ���\0<N&\\jW��3�B���,�J�|KU�Ȩ��Ǧ/�tN�_���)�E�����G��3�$���!�THD��p�g����\\\\^[�\\�!d�E��ڊ*��J���V�?�!A�!���-ϴ4�� �X0����x�g�&�c}�<=�,8O0F. |�P����s<����r�˗/��.\\�r�/ʸ�]Cs�6}Po^L\'iL�*ZT���)�~����q+ĵ�\0���6@�]��W����:�?i�c�,[�_o�|!����$XMZ�\0|d��������Dj؛F�����B������[������D����6T؅�b\"fz��R�\\�\0ؔ�P�%_��	E� u�^�Z��ǒ�s��@�3H0�G\0.bL���ZU��t�EXF�Ϩ�c�&	���7\n�n��+R�<�:p������/��A�����rK�a�_r��9V]��o)/����l�D�C�p�#�ḙ�m�*n[.\0�ԲW�@.\0���1P-v�QH�EFK�+i�%�����(�B&-�ޒ�Ff�JļR�i�Ģؕ(��Ρ��⧨h�Id!��Z��k�]멀��N�Ӡ���*�7d6u���������X s�c)��\'5O@�\'�q��7uo�Ŋ�d����[��oQ!)R�Ѝ^8����_��Is�W\0K5/�D�KE���J*{����h��Rp>��>���t*\0!�Z��J�RS�?�+�%F�&�2E��)ަ�-�cB}��^���(�{�\n�8�Ŷm����e=qor���\0C��4�#N�7�R\"�a�Y\0~efU�����K�%a�/���L��)�9�SۘP��l�J�6�P�P@{i�5��K>�0L���z�\0��+�\0Z�\\������P�SD7\n���_��	��I.�F��\',M�Q��ͺ�f�F�� ���\0�!����+��$����w2�&;M�ʷ���f*2��h��u��:z����1:��;�^�l�J�����e�QNخ�n �>z��J�����UX?�j��vT�wX���V2Cu��(����^]�[���y��q�A���͹�S2&�PJX`�1W|[����M3�\0_B�M�ׂܘ�����>r�^#\0�Y z��p�6�\01�]<����G�a_z�8o��B�;��y;�Y�S35\n؂���3:eYz�舖��3-UGM肼�7��l��cS��R�f�\0�,Jz�(]��*�\0�R����\0�5Q)j7Դ�}��x3�X\"h���ٖ�%V倐^�Et�	�t��D�w�W��A�%�e�`��`[o��}�2o1�Y����\0��O_�b�SV��)�x�+�K�]jZ��&�7�#��~��&�X���k<�߮\\�QՇ/���C�/�%8�^(�<�D�3���뚣�Yp����TU:�������U�C*���g�m+b}}�H���=��0W��C�1_�+��<L��e@���\n�B�J;�,���/Q*Ydx���,m(bAO�1A��}�ؼ��2��0��!P��������at�JXߛ��J��T�K���i=��?d�h��b�����EM�)</}�P���c�L�fls�-�Fȩv�G�s�p.e�ۍÜy�D߄�Â\"��$UƳ�d\n#40mߺ��t��T#;`\\��k�+�/�G���0i��,Z�5�i)Dæǹe���e0Lx�Zba��-V�Z�9�u���F�xb�K�q^��W#�K�b\0��&��]�fb_.VQ=�\\k����*\"+���CF�\"�u�-̈́`��\"\n�\0�r�J�0\\�z!Es6M�&���#d�v�ꥬY�5.�_Y��[�\n2��jX��ds�)�RP������Ĭ���$&a�Z�\'G� K���*�@U��WpC�A�(t�_J����$Ӟ-��ؼ2��E?�3��9��V�DP��|R�*�%P��ypXG�HZ���IR��D��e�0���o�dw\0�Fb�i�`�\0s\nqy�wǇ�Y)�]GeqL��D�;��D߇Bd	�K⸫���2�]@+ws\0\":�b#O����q	���F�X�{�[+�x\nWCI�pZթP�A���I��^b�5�Z7-e�(q)�hY���Y���#�!K)غ��P�lU�6EV�Єs�ෘG�����PvF_��P ��� �c��Lq_>�5����Sh	b%c�#��~�\"�nT831QL\\�K+��K����HÇ��R�L%�\nK�Ź�ԶT�)�����K��ג<���\\�wVG�ž�������o�d�5�HE�.]p��\0+_��~:|)�>�G�y�B%q|T�Z`��aD���m��嗈�2�y�FQ�h&Q+�*eT.�tphp���%���!x>u¸0r�� bW�˛�����G��^b���Ԫ�e���`,l��0��ርL8%�T��$|B]/��+��R��C.�`���i�n�@�-*S��Q�5(��/��	+���h�\\hY2��do�(�#�i�PR�.����|TIR�*T�Xc��e����Ļ��y��rԳL���GQo��<>5*n8��z���w\\����ޥ��}iV.\\ �D�D	��Gù�q����`Y\\����/�EX@f�X7�\03,~q����_#�}��ڊc]x�+��qG\'ø��P�Y�\n���1���^5�p���TL��ܹ�Yp��J�����_	p��r��>r��<:��ܫ��7/����xe�2>7�<߂��F�E��x\\x�\0Yk������>�+�O��\0\'\0\0\0\0\0\0!1AQaq��������� ��\0\0?��L6�,�7.�Q8e�f�ªZz��u�i�oZ��&���@�p\0���*8W)�7n�W�b0�A�J�A�7:��J�.c	�Kcd\"SR���1	����]1�b	s/R�jP�]j�ܶ�ZC2�\"�&fqAJ��3r���#�@�U֡b��r��[�n9.YD*�)��ا0�P�\\�i�Pjg\0�)��:jU*�E{�c�|]s�وj���qC(���H<�0��3���;�r����*	�\\0�]c¶�:�*UJ���pk2ච]:�a�����\01Vj��@(j ާ!z`�Ad �Cs����-.q��E�ܻ�G,Pj�Y�5��N�K�9�l@���Z�ۆ|oL,u+,u��p�WZ6fƃ�p_,��Ia�E�\"�$G�a�\'��d�)���FFYd6\\T����C��CL�\\���~\0��d{��3*%;�UBTKh�9�n!��V��w(�����]Ŧ4���[�010�n����y�XZY�Sp���f��_R�i(�R�\\L�,���qr��� G.!�i�\nTJf��5D\\�68��g2�7x��{��4���%�c-�*���[<Č\n��X����D-ĲȢɁ/�[Bln�&B�\n�,�-�,F����J3p�3�����7��qpJ��Ի�5_��L��e�Q��\0p���k��qf���O�����FR��RAvQ��Nj+p\"�L���� =�8C�g��-� w)��	sF\'_W�D0��X���_q ���5*&%R�&�Է���9��������ǳ��+�x�=D�I��.fw�)xb������Ł[���2�fZ�s=�l���fU�Xe��Y�LC2�Mʬ͜�ňٚ��&����)3Z0�,iF�[d��DYs�K0�����:�L\n�_?��31s�G�y�Bu\n�G�[��^%1k*l�3+�񨶅Ը�ٴJ�+A+5�)�a�\nƈ�(H��M�/��7,	B����a?��ԗ&zA�Ήb593����:~c{��,�`b�9���u�br���Ҹ�����7�	����\\O%�����h��S��Z�7w�r!D4����e[P-�%��*50\0�o3_aG?%�g�wO�,�X�Q��}	�iuJa����@���P ���K�5DT�4Ad�� ٍ��q�9�\'=�pq\"��c0�ljm�LK`n�&�i5�\'ʠV c��L�o�S��JGq�\'�����m�N ,bJ�x�po��\\MT #꡴�C*���\"Xo���\0b_��\0r�(WQ�L���n����fsLU����v��[F�y�Nsإ-�Ls��2�z���W+�Y�\\�tX5�8*P>BT.!\0�p*�;ϸ@Ɓ���K\0��q�z���ӵf�fP�5�^��S\'�\\e;i���h4�Y����\n�B���Os3�@Jw*�:��]�!�Gt�xf�-�s�(�\0��s��3�y̬��-�8�(%ˢ�c���#���v2D��q���j̛�#�ř�&�험B.a�\'��Ane5��H@�Q�ǭ���n`V)#��oiH5�bf�s�W4���p8cѠ�����BkU8ѸH���t=�(*����\"������p>Qf�Q��!C���_�]6�X|�X���sE�3��l7��FIB�sTb��e�g�yP7q��L�=�7d��a�;�_����ܵ+�F3�W#�-����,�˨\n��	G�]���qz�MYv��rK�=\'�\'��5-��s��x�1)S\":��p���� cfkPi���u�[@�%���q�S-�j&����!e*8������E�����@Ms\n)jט�x���pm���p:��²�㇘˒P��Y�G�Eg9yd�j�~\\��o�=��1�0��~����������d�������P:>QHE�,=8�`)n��j0�w��e��oP:��[d��7�/�#0Ā����U��Cd��*<6�h�TPԾe��:�R�0��P�,���l����\0���8�%��S��B�Y5jŜ�m�\0�<¸}V�`d9=�]��$I�.4���qY�@�A([%U��L70�!�m8�2����R��5�[G���1R�SI�pRعHYơ�4e?X��C���Y���w4f:WÂQSeM��N<��7nQ�<�U`18&o�:�򰠫\"l&a������c�������:��/�o9��r��z���-jcK�E�ļ���`��@�9��!��N����ž !� �ǜ��3}���\0Qu� �g3/+�\0�i�⊁Bu�����\n#��a�mP|\0Q�%¶��0K�-V�(�̪ �	6U6���d\'1���&�ɏ���[����Iw��@��0��v����Q�ډ�b6�+�[8���������/8��n-�g�`�sT�L��2�R�̮�5�V\\LLye#X̍��r�P�s[~r�`+K�0��{r�\0e�\\��Y]�»�l���[�	~��̱<���(��af�Xy��p���R��Z�U$1�T�N���M,�������^R|�M��hѩh�WM���[��)5������T1�&Bl{ft�9�P�֏��`�z?�̣c����@�bh?�r�ߘٜ%�\0�p^�n������WdU!��n�c��@���y��2˸�q��1&Hٻ�� .ٌ�\\0�r��Ln374B��k�|��{q`s9�J���T�Q��=ۖ5\0q��@۸�[7�5�\0x��3���`o�FVg׿�c~�b�U-�%Qp#�p	�˔�N��*�\0��QQ��0���Ԣ�u8?�V��+�Eht��DtWaq�$k7����Z�Z�^+1.O�t~��W�WNF��:_�`?�-xA��li�����E��Չ���~fW�s�B��z	C|�e��P	D�i�5�U7��U�6A���6��q�|C$�13��h�,\\i��K�����F٨�ܡ��ud��ʊ����\\K.�@���ڭ˦�\n�q/�^�Nf�B�]���T�*��Q��a���ԡ���n^J6�5%u_ng����D��)A+��@7)�ij-0 ͛~a���9��[�?p� ᄢ���<�pWJ�*(���u��S�@<�j��1ط1����\0kr��X���W+�cЊ�e��X��_��@�9����XW�R�T����<��,M>>��暹f��x����Tfw(���A\0ޡ��o��\\���C���R�2����.m�B%,@Y�G�9n&j�*UJ�,����P��]j%cx�*l�L��eq0;�����P+��Q�3l�S��m�N���y��@�,`�o=���%�B _��\0ʹ������Z���^���y����Na��ZS��7a\"���F�4�.X�kֿH&���Q^�y&�2vA�!9�v!X�P����(:@m���\"P�����2ۏ2�z 	�����Q�O5���r<��\0bS�͋�q�z2�TT����&����?�L8G� u�|d�ne�%#��uZ��S��uD��S��~+9�@pD�a��q**��g^&&]]�7���ɨ&nZ�јd̕�X*;�Yw�v�jXu5|9 �S0�Jqā��?SJt���PZ�p�2�ҁ�%0�Qi���YO��\0��d�wS+����Sy�3ZY��S\0�_����?�����Ի�:��9yZ�iE�`�5/��\n_ ���Aϒ�6���Ϛ�)���\0�\\l�V�G0�9�_���R����JJ���R�}Ya@�W\\G	6Ķ���N���z�����!�\n��j.�T�Y*\\oDωQph����pV`s0\n��*���;�;Mb^R��f%��������J`r������{�mK�:���J�a���G�d��!Y�A�xux�}����P�07�UM�\\���Xn�Cp�*rp�-TKYO�\0��\0q�:�W\0��\n���UPu��J����6���+���Kh��e��e��\"a��)Z88��A�k��nS��%5A���-��7=bgY	t���ۧ�F7?�\"�`U1��5\'m�ƠVQG7��zp�>���p=M��2?b��ķ���X-�.-%W�����*�X�ڄrM|t|5.[�Q�����k��J|%��w��id��@fV8���0	��A3/1D7�F�֪]��X.eR$T��3&Y������8�S��2KqQ��j*���HSd�l\'�����S�r�\n�w��K�2����L�f��+~ [W.�{���Y�J��\0ĽEL¬�Z���J���A�f�jZnd���x�̙�J��a*�!�o�o50%�m}΄(�(�`3eO�q�cG��)���3\"�{���a�SC3{��L�K+2�����\n�\n\\�E*�2���%l0��4�d��c��y�x�#WpU|Z��&ɐy&r�Yq7�V9�*g�晖&����E�g�m��*9�9x�����n~Q����+�D��0q�W*\\�3�Ay���$��8;�1QYl�;%�0��\\Jl�f31�Q�L,����xDM����8��*CMA��4�\"�)���Y��HD�2�^��M���H��Q.�Un(q+o�4��g0�(4�|֢����V�E�sL��-jf�#x�_��k���e���u���o$ҳ��ܯ2�c��jZ�:���Qf\\�03��W�vL֢wP�NLE/R�¨�M�/�n.������GU.:�-����������v�*��`Gq8�r�-%��s-qy���s9�25�Z8a:�B�wN���3�cCY���Ƙ�D`!P�8�l�����S��8&��J%L3G*�4��X�	��C\\�[�03���Sq�.�kr��J$�%5>�/\n�ȥ�95�W �,\"D2��9�5L����p)lTZ�q�DSf$�ܢ[�ѤfˊE����H�awQղ��-�^�*�.z�g�e����éG�L˄��ܨfp3�)�8K �\\�&/&!�1q�%Ր7I�z��*ԼԦa(Z���u�/0��1�!DQo�P�9%�ŕLG����\n��VjVb�U˽M��+\'�	3�Q��V��[��L;TqJnhLT�Y�J��D\n<LU��LV!xMu~d�He�����KG�12f��\nĸ�������[�X�y�������p��+�A���V7*�e�pW�b�I\\�+�:�1�n��TŌL��4�\0:��v�� �Ʒ2�����m14:��Gl��V!/R���\0&�Z��\nX��@9�07�������E�AM�g�(f\\�a�Q�%*-�.��g��D�&DT+�����5O�L�D*;��S���@��K�ÇÓu4fg�̃�m�m�2&�ԧ$sE�Y�w�K��]+��Ʀ��˨�N\"����9���ڜ\\�!+�-��8s�gQ�U*�72��E&c-&�|(_,�|Ը�R��f�1k\"D^b�T�+����jT��s��1.�Y�V���GF�`̦��h��ِ��Y�>��!�F�皨��eْ\nӉ��>�^\"w0�f�pb�55Q�%�mGTD�D�E+m�9��7�㛔�p�3�K�bbo_	�2�sL�R�Ac3��������EK�\"{�X�c��s�m�xYm�-fW+*]0`�,���ê����M�(;�\0�Z�Nr٩EN\';��_p��QYd\\D^b�ԡr��$����V/偎��%#�mb�@b�3)�\nef3���#W۹w���fj�Y�x<�\0����q��:%������c_	y�v�h/Z�D��-��uq�1�lS5�l��C�q\\s+�tGw+7w0\"�.*f;�\0��J�Hk#�q!F�����r�S��*:�����	���\nY�ci��#�\"W,����\"��ڼGvL�۫�:+7�Q�����ʮy�͒������`�2�!7rʿĻ&��Xw�a��%s/4�̣�:ơQJ�q�����4ns1�������������`(ߨ�W�����WD�aл���6婈a���A`���n%�Pks�q3)��=�ט-f,�|��J~�y�,��L/��.+�Fn,�,��[I�e e.P*�F8����t���s^bqw1��\'ܥ���WX��hK��԰c>!D�u~Wp���G!�Zf��W�w6[|br�|��\0Iߨ_���L��#(Ӹ1�O.�%y QPWm�P+��;?�5y���D0�Svw-�g�a/���u�FD�q>���CQ�\"���%r���g�g��9F���Å�:�)�y���ʣmIn\"��1��QyB���2�Y.���R�g�1R��8���vT����\n�����ȶN�{��wv؏���\0WD[\':ͥ��b�l�S�J��6�}~f\\w,�ڮc�Qz��vfk������cG�\\b%�\\58=�q�/qH\n�0�#���q�T~�Ԫf�32��5��)���1B��ln41)�%|ձ9~�aS,p�9�J�O�6�M���	�rlf�#y!�����r�yo��\0%��l5�ڹ���=g���d	o�sS���\\[������v�bp�]�]=9��ln{vM}À\\�]���\n�.��.�J(��Ve�<Cv�N�$yl`��B�=Ú]1w���y�Z����\n5�EX��7�{z�1,_�HR�\\�Z�ax?l��?yc�woy%k@mB�\0�c�V���/�4���jJ���gC�x+�b��O��C\'^�P_�Y\0�Sa���d(W˩ٌy��dIw.��1n�P�W!��i�I�ɾ���q?�7-3�[q�F��|sݹ]��q�2��Bؗ��4��/0�g��+��G%�qĔ+���cL�\\T�WS�p	Y�ܦR�������os�j�J��\"�K� �7�ђYq����\"f=%��P����K�vco�z�vSG�@Y@�	{�q�aɱ�׉�U&�l�\0\0������}8�Uܺ0�|׉d�Ƽ*�Գ��eݹ�p��d\n��6��}K�����ػ��	xM��H���A�8F�5���ې��C1^���\'�/��\0�Tt�E�ĲQC*�Cu.�����z�#H��n(sh�3\n]#G�\0jj���sXn0����8M:�F�F�c�OXGl��+>?�2��d�s�^�>����B�)�c��gh��*LGqJ�����4�gsJ���X:8�U��O��	���K���ՏL%��\0�B�V����:.��?�Yv����\"���Dh�ba9[���[}T[(e���!Ue!Na-�F��*��bԾ\"~�s�a����MA/g�A(��*-F����,#�\0|1i����*�p�<���?�9�GF�\0�z����:��>c�?��C�V~�V%AwN5C�,�>��ɫ+s2wUW���j����`\0wl8�P���8�?����E����0�^�p��k�Q1KK���L�)�>g*�|f6[���OR���BR���=KN8��dɔ)�O/�\n�d�`�l�\0�[�^����J��Y���W��cm�|ۚ�0�JK>�cU�1/��M�E�֎��W��$,W���;�e��~��\n7+�_�k�.����Q.a� G9�I`q�f^eF���=&\"�n+N�0&�p\0�0��@��gv�*�����I��/,Ʈ)���r���\"��]n����ad�R��ַ�o3(8����������f�|f˄!R����ļ��A�Ew4�rqT�)����\"�UYڣ���e?�7�і���\0�+]����X6�Or�_x�<7m�\0F\n)��[}��a���C��q[�T���ܣ���imP��?��0#��p-2]l��#�QM_�#��Q\no�lHV��\0z�^f�ç�:\n��@��Pĵgss�@R��`�jT���%5���X���TOQe�:�e@0�p��[�(AW�S5-W�6˼q/�;�w��C����s�r��N�\\�����p�s(�x��L?�;��AZh���\"5Cr�9��)�Z3��`�)]D91�7^ ��R�\nK��n�Ņ��lP�S$�\\pkq�!�F���f�-<���@.����<0)�#Q�р��p\\J��Η\0\\āe|Vт�*s8f�U`�c�$\01��D��r�%��PԤ*#P���g:��-�-�?	f٨��b�n1,MY�M���.q0�nW?5���*ԥ埻����[��dLX�af\"G|�`��_�3I�b�G-��01�x�G�f-1��x ���T�Q��R�sQB@�w�GQ������(O�NsV7x�D�JG���x�[�mY�nY.���8�i�a�gQY�W�|3���,b�e�r���iJ�\"黇Ie�Tr���Gp^�5R�(��(4j9�~�1��L�RFDLJ}¢���H�D�9c�=Oq,�Ԡf�7qK���~�T�W�R��\"w07u�\n�����/q\n=����W0�\npKF�b�S�O�%�0����%�D�J\"�)�2�Զ����̬.j�fcw���K��y���je���l��= ?�iSY��H�&H�����eq\\M��>#sS��aK9�7pX1�8�7(�=��@d0�,U�-��K�C,bl�	��S&��.&3�n�8���+9buy��3Y�I� �S,`�����%E���#����\\�$��ImD�Jf5,y�o�Q9����\"MA�q#���M�Oےn�x��lqh�}f��J�U�3[3c�|�+G�yƽ��Ցr;�p�s���+��V7���FЫ��M�[�,�!��:�&��Sl�^h��R\\<�x[�y�LTw	X���α�h r�q��s�A1\ns�.af*e.̫1�+�^*`kΦ�\"f�A.�()�n�T��EjT�\\rG�����0J�7��c��q��z�a�˂U��%S)ṵt­C��cb�p�ˇ6*=���v#���8hn���C��\0DM\"n!w,��6E�)SyG1&F��L�q�R�[v�F�\n���4��f �TE���Z�A�`�\08<�L�bі�TTK�7��њ��f�.��8j6���C�Z��pg&�TYqs���pƣ3K����˃ԣ�J̡.qSH�%F5U�������>fb0Eľ����5��ŀ��3F�E_� �c���a�&���-��r��$��2�P���\0>2����Lu�ʙ�^d������2�5N�.��^�f�\n�Eq�\n�.)q��H[���>c��0\'u��F�[�-ר�Q\\{Bj,\\�s���~/䌹�2�˃=�J���1F%�[�X7|̌�Y�|�1,X��	Sf�l��Q�g�;��GA�r�.�K�%�]nR�#���GQ4��7�8�s%�S4�W��T��3���#Y,%��=@���0���J�*:�VeU�	Ø�w\n*� S�1�Z�dA�-��E����gr�M`�2��i�%Oq��q�n]`΢����^!\"���G4��@9xl/$��k�&J��(a�� |���Pg1�x��s�*��Ǹ)F���b�0�1�^�?�\n9]/}A;�2Π��,����f����P!�-�^H���\"Q��C���G`~�f^�Щ��Pk��.ʫ��� �7�%7(w2fX0�O,��lO�c�^�¸�0��5�j����r�	t�/R��̑Z#Gn<���d!E��]���ף��-W�!CY}̘j�.�D;�F�\02}�D�<�#���2źG��	��ʻ��*�3�J���M��+`�P^i�G�,�+��\n�T����2��DS��\0ձ+W%\"�����e9\nœs-i��` �.�-�T��ȡ\\ƉjA�	U�e�B�@��@q�ԇ����a��|�#�Yy��ǈ�2�����|M��r���]�^f����y�H}�����1O<��f�;ܺ]���b���d�ԫ����\\\'����E/E=���~������0��p�6��q]�恾��¦�o\"�*[���|�a%�v=��\0������#+D��7��O��7Th���>�b7-�e�:a��`�\n6�c:�>� jEC�c�f��D��[���șuu2W�WI8��\n��t��\0�,[�#�p5go�	�~��Èq�����o���9�b��êy�4)H�Ø�/{�E@ĵ�?^�P.��\"î`tCC���Z����հ=p����8�v̡����s1�7\'�Rᖝ$�_od)��|�	�/P��f�-h��E�S�o�#rK9WP��\0;^b�0�-4j��e3ܼ��YfL��d�h�Oǋp]���?�&��	���k���\0�,AĹN`�\\�8�g�\'���(�kܡ��p��!h����m�À;%6�<��`��S�1|�����)�F_p�u��D��/��d7�Ci|����$d닊�TtP-��p�I�F%��5W��(@�.rf����.kr�Qh���tj�B�%U!�����3�k߃�X��pU�B�K�79=p��f(�3H��Ճ^mɨkٮr�\0u)�h�_��y[2���U�/�J��nN.��,\0>��df�*/?�Bw��(�X��ļ�X*�����	�:�a�	B�GG�8��q��x�����C��H�9��*ۧ�B�0��Muu��>U�lq���G�Op���&Rr�!���UV���������1��\'Hrx���l�:��`�V32d�s>�C�nQ�-B����~-\'7�ۛ�\0D��:�|Ĭ˂�5����q�p�p��ˆ@�G��B9|���5sg���qX�.�@��mc�R\0�8+`��]���r��x%�n�����E�>�#��\0�J�AS��F��4��7o,ਂT�V�\"�k棉��)��K֣ACu�*��P��0�ao���8u�[��y���s�K-�\\��5�feniԿ�E��.�����:P������Z:iq|�En���^��e�&9hbN-�FO�P�]$�n\n�j�#a��}V5N�h\\B���+@H������7OW4��`�f���w6l�����iw�*XZ?�+��8C!�Vsm��-�/n멂�V�{<?��|�X���^�]�S?�1w��q+V��J!\"�j�ɚ9�G��_�~#��l���&H��u\nj�E��R���P�n��3�����.��^���ܫ�\"�-��[���~30S�Tj��^I����`+ܼ�S3b�����{�����ow����eR�]W�:�p�D��>_00j�����4^���n131�ɒ�\0?�a�\0+\\�B����K���x\0��Mp�im˸���G}10�e�3� �˹�����8�� �J���\0&�/��@��c�Eۧp�E���ԭ>)��Ŗdơ䘋�7�ϒ[رz�:,B%7�tp���b+��T�S}��p.���/y=��Ly��5G�29�<G�n�\0��ze�WP�~ỔY~!j�=��\"�㕣��-����E�R���?�1�b�J��xc`�?:*�q*屗�=He=`���1��?�AoƗ���Pb��\\��*��r�&�(k?W\nynno�PC\"��Jq��RٖI�~�e����a�B-�\\n�y�m�l)j�T=Nq_-�\\m�+�D�:G��@�D~�4n�?*`�����%7��k���sK�E�Z���J�P���aTQ1�f͐��.jQW��q�&���q/,[�C˷�زѓ��������p���@�e\"\"nRRS�D��		�C��*�@MJKH�b��.���+?Q^\"�1��bZ��7�j���n�\n�������`m�PZ5��V�����q���������i*Pbv@�+�ǅ ���q[a�GUPJ$C�CL3=ƫ�\\\\T�d�j���W�, ��>�Q�P�#�5���K�����~��qq(\'��\'�2w�+��>Y�B>D��g1a��U9�Gr�W5��.�F_��~O�fe�稪1YA�e�di��.�f�T)��lMTTr�����R�$GS<0��\"WR��� [-�X��:+n���?�ǗP<�o���˙�ak�Y��y&8AK��̲���Y#���Ohe���;�\0����<�c���0�f�K1R�/����r���1��K�/�r���	��,��Qe�*��ѝ�\n���W������|�����ѯ1�?$����/�^���q��E�3�k�:)͵3\n�9�h���!���v� ��b�c�3r�����<3ܳ�[��/�Z���r�k�k�o��9n{�$�F�+�\\S.	dIM@*f�ۧá�L���372�\\�y�;3=��7��<&RtL\"�!a�z<W.��_���{�M��V�F�\n*-��\08hY��k�0=�\'pl��,�0�}��)��8#\n��xC�^�p]�$��\0s�(�p 9��9c�;�o±h�0¤g�8ny�^�}�bd`n_�@W��#bn(�(�MQ��p1 q���ńf�?1_�&V�yE�s�<�;�Y��s?���x39A(0��_7\n�HO($�!�7\0Vk�~�Rᣏ㟨�y%�k.+qCE<���P��\"$���p�����3E_��+/�ۂ�fb7��z�#��**C��:\0�*ɼ���-e��nv�[A��M~fI��P��X��-{��ş��,ˊ?�����h-���̶����E̚���f$\n��c��#�5�&��{�w=�����廈�\"�ݘ�)6j��K�2�`^tx�+\0��۪�A�\\-8a�bZj�?���eݢ���M#��丮b V��Z�f`�f��H6^.._஢TZKx��\"�p���Y���,ʙ�7{$8-��Gp6o�qZ�+`��Xx��TiC�JYh�de��M>��姂?�zez���ORx щTj��J��;�V�n���f2�m�\'��^�bh���Dd��P����h���hzie�Y���\0� �����Hhj�hv���ڋRω�����b�w=�[�-�ID>2�K>�/�^����>��G��i��0��F�_�0�Qɕ��,j�rȷ�&	�0��x;�	O�\\���1+�]z�f%(�����Rz���W�&��fX.�Ypn9��]smMc֣�G�/PW�צ)Ĵg�G���B��N�Y���0!����D����tB�}��U�9\"�{2��֧�������4�r�EE�|�.�`(��Vv߉[V�Fr�F��{�s���c�����,��	���Wm@r�z�l�F٦�/8�s��soĹ~�f�.7�Rď��`�ֱ�,�CA���e��.q�������Q]F�1oi~�#��[D���.+����\"ޙG[�0��M�\"e=\"�ኁ�PB�3m��c�C��-��S��>�=�E�H,�f�E$�k��f1�@)�@k��*��&���Z�o1����L���\01w\0K�cIj��gP���]j�5�F5��/EDv.. f%8��G���Sp�U���������\0�ȗ�`w�	S6\"�\\SN/DFT�K�f\'��99��Գv,A�J��Z�//��%�\\�d�1�2���4����>��K#�1�cC*�>&f�ŴE� �&d���D˩�G�h!q��!���m~�{���H\n��\n�RR)x�]�4�ۈHFN��qeBXSX�EY�|vw�w����dn��r訦�f�]@5A�u�k�Pn\0�\0���+3%�D��Yo�yA���<�>5��y�*�e����&=Gn��}ĕV�nf���6����E .����\"�e����2U2�!�l��;1.�r��&<K�D;�G��.P�e��+�Px�LA�NYn��`�Q*P^�z��{��䏔9�y1�IYI_�nb��/r�`KI�F1�&��cΔ/ƢK�#E̼�g��m�����V�nc��3o�)+�=��#�G��Y0J9��?��p7��Y��y#ў��i�����nSxQ���#���\\�\0u�!�²��3��|�_>x�R��˷�A��9�q2���b8�,����\0�����es��`�(*�}!�U��_�K@���y���5[j��)u��`�CPf6�Z�ڂ(q4�����y&9g2�jR�5w<��S�9C)Ⱦr�g�<�A���%Fg����@�,��-�]�e�TJ�3&�������3�T�-��5���͊���a.;`�DQ̷q{����Ÿ�؏3�(�P.��R`(JPt�4_\\˞�	Oq�S)v[�h����A׌_�����T��S�-5��#��L�1<8��``�����[���;	��\0Mm(�W@���v���[H�*�ti��9V4M���DW2�AV )U�9Z�ƍ��5	��I���=��j%S�R߂��T5���0n>Ss-\\ܕ ��_�QS�ujwN\n=��g)ke�����b�\\?��/[r��D���$�|+�\'0Ch=��k$�6�؂f�e��J�a�5�(�:�ey5��P%AVd�&lM\0��	Z�j_z�\'P�5�/�L=6���E��S�=�8�(&�����D>Kl��#t��K�T�\0�ث����fJ��Ӯ���\'@nM4����u(�\0k/����<�w57�b�>����|��ef�qK��X�%�TK��P�j˩�\n�i�;�����3�O�X����������|)���\"��1|��\0%��⮦#2�el����b���\"p�a�b�`M��h�v�N*6��H5��w�}�a��+���q�-�����*`w�QW�΀�S{�zu[��᳎?\'�\0R�n�En����_���k�%HS�������;�4�L����T�3��?�eku+A�Hy9Y�n�D�.�j	��ћ�(V���TP\nj��PH��ciD�9K�L��\0�^�\0�`��^�	�2�}���IZF�����ܾk�0ʘ�Xd�3�r£_�Lz�Bjֵg�A�\\�nM��~%�\0Ƕ0Tt��.�D����YK�����%�(Y�!��Դ|ԬU��`�lG�\0�X��K����%n��zC-|����8釋#\0��eܡA=��:�_��b����׽��~���k��<���w�F)H�#i����\0�G����b�w��S�����H%�[�t�u.i������i�\"d4�`���&�F�X]����0��Xc2���\0m�Wx�GMaF�ko�+�R풵 ��_�L����0��3��p�����1�}e!��)��eL�:��R��6b��ۘ\'1U�-�!&7�0���!vfaܪ��\\B�Ĩ�F���-s	�U+�C�)�U���jg�cfn,��btwq��4���=\0-�Ե�BRi�,s�d��-E^b\\�35p-Ö�����dE�e�%T���=E� g0�6���#�<|+��R�DT��x�\0�	��稭Jmw�h�B�x�������)n��\\v�����!�\0�~^SieY4�1r�j&}��D��8D�\nb�e���./$�h$��jhq�l���s��\'�@��G�rP�$�y��\"vf�aߘ���c��V�ZϢܢ_1iˆ�	#�`�x�ab��㈳63)8��w2�e���f�1L%���\0��z�Q��x���`#L��J��Bw礬�3�p��a��F�\"^t��8Ve�b��\\Rc���=@�87(sr��EF5k1�\0�Bn6�X�:�J���E�rү>��d��&o|G�� j�Qw�F�t%=���̇���\n���+�.{k�C����6���ѩ��oShC8/��,bf�Q���h��b8�\"���R�?M��\"�ų�M7�̴�+P_2�0(�P`#[y<C��eJv�]�T�\"쁠\"eG1����>�e�v�WW9������2,�����jHZ�僘ƤQ���ñY�tVb,7SJ73is�`�P��l71y�52̬�R8g���f�������Ӊ��\0acE��V�5�����!hn��ZʉYY*��91�C9�+	}�8��\\���-)~�*?T�7����=���BO�^=D�T>յ�Ph�l����2����\n~��-���P��� [}��A������L��� ����$�\\���|L������U����`5���ص�5��	�OQe�U��nSl�X���%��*��P�z�$�Ja�0na�������k��e�1��Lc�\0��6�Ύ�/�#^!h�1n�S�\0y��בT�3���yX�d,_��Il	I�!�[R��#�_�ݹ\0=���L5��Ķ%���s�٪NiR�8���O�ai�q�\0st�El��[�Q\n��!.�EJ#B&���ĤS�l2j�#Pm�v:s��P�`���m���7(Z0M�u��OF�q!Ax��6���JH.*�Ś������w�X�\nK�T�\0�aT���j�p8�л�Q!}��!�v�����A{`~����g8����9ô�$5#D��u�j�ƍ�^s�x��\0&&.��wn���B��J�W�;�<li��M�������z��M������0�\\j�F���ND4h�@\n���TR�(�@�n�T��X�ĸ\".bl��*�v�f4�[�Q�H��\0�c�g1\\L<�8c�{��B�kYQ���z�v���LIr�R����;�PJ0���u�ŧ�/�x����~b�\n~������B���Qh�C+�9�K�hJ(zBَe<��;�A�`��.����P5���S��_�]��I�/���X��w���x46�Go���h5o��� �O�0\"�专�H`|�AE���I�|7K�i��J>�\0S1@w��7\0��T\nT�5���Y��a��e����h��k� �s�o+����\\W�IjkJg�r�Y�ޢBz�����/1t�۹�?��˹����������w̎�/�4���aFX<�c?��,����zȄ�2?2�4]��dZ�[^u�����m�1X�P���M�2��쬔�{�����P6�`��SY��Ku�2�LA�qW�Yq3叜�5���w�PMfd��E����e�y�,Ӧ�p7Fc�����r�[�Pt��Lb/p�*�@�����-p^п�\n\0�X�|�pI�B�i�MU޳	�l��<׉x�1�9;�=x��q���5�p\\�EC�g��S)��������7y�G�H�-7�j�c��`~�Ve���v�j�Q}Ee��nf`���ucW�\\4�X�f�����F���s&]5��#+��\n��\n���J^Ha���<�A���� �7s�w�cwG���\\1�^��U�̢��yJTv�U��=f�����D#ulCj!�-Ῠ��rϢ-0�\"E�3�8�����l\\J�eD����=KJ����b^�,�|6��s�uT�ʂ����G�ݬ�Vou�\0��u�12ը���p��Z�Y�^q.�cӾ���#����O�/�I��ᦷ	����i\n�;���/p$�۟�Q%}�6H�GY�-%�3��[u��\0�E\'	�e��QJD+�T�J�\0v��	B�ܢD2�>ɡ\nzC������,��w_p�����r��Q��ݚG����ڥ��ܰ�%��]\n~U��z��l�����1�u�����QK��b��.�.��L��1�s{�D�p�%]D1N%�:������7	�3�6���^H>-��`w8|Eő�PW������&y��>Y�;�Q�����d3P��FS\\\"�ADN�eb(���<q/�QSl�<�{��p�j�憠�e�1��:���1�*��	M�Ľ��(s��è\n�mq)�����P7���=ʣPf,���l�t9��:�ʟ�X��\"�����e7	H�R���Qh�1:�Q�%�ܪF�0.�	�����0�؞	\\��\n|~g�C��Qr�C�8jx\'�é���2�<\'�5	*ȰY`:�����P�0�A�p�2��T,h�#r�e���\"䈺��c\\m�,�U�Yj\"�MK\ne��n�M��]@�70i�m�&�Fx���s36��G�\n1z��V�#���Jn����*VL���q z��M��MJ�h�(�\"��(�\"��t�\0E�(�TVb��0��1F�b#D�9�XM�V<�}�cL�TX�X���a���!��0R��僻efۀjS�w\'�Ż�й�(������CYc� ���R�� DmJ�D%���m�:����ʸ�q�9^�S�l��@�q���mpY��	�7���e*�\0*�������K�N#�:�w���=�8�=����M¥����E�P�X2��렰z��7�)�SJ�S�rQ�r�҅��rY�mSùj�7s��!��X#���M�\"�*.���&1�pU�|na��B�����W(�Y0������?���t+s�`%A\0���$�x�J.���C��4ua-�~�E�c�٘�&�N�s\05�n�����������2�nap@�s)d��N�!nb��S�x/+�6�%��¶�1tpļ�Υ�[��Slfz��Q(N`;��喘\0]#�@��Vb�繑5X�����m���G��*W�(\"�D6����$���X��t��Cc��������J�G�:�AG�8���4vPm�6�9H������I\\\\z�C�.�X���@�pd�q�S���P���8��M�����%��R�ƃ[�\"[l���s���VR�9��J�a,�A���z�=W錠k)��h\"5�e��!�P�h��]�0J};\";.<�4��Y�F󠴼�R��GķKt6�V�[�Wѳ~5�lK�<���4��@k��dk�O�rSxR�S�X�\'�g��r������u��%��mZ��GR��k�E[i�\\�\n=�e���1�u0J7��6\\G�[�]�Gq�^nT�c�˩n�/�\0>\\k��wnY�j}͈��c�]�Ǉp�Z�ՠ�b�ō5\nc�x�$&-8�Ʈ)k�_�%T��y����X㸁��i���S6�X��q�T]�ݽ�13X�.�S�,��)_!�!�a���b�:���\0pF@\n#��\0ӝ���\0!�3!v��J��\n��\0��M\"�ML(L�/�\\�xwB�i��J��-��`5\"�����L�t����L�oD\"H��_pf�|�}��^g=�;g��вo-~�.h�>*W�y���w���������k�YZQ;X�3̪AFK��a5\\��i�00go�?D֎3�bdW������0�:���;��G���1�{8���Z}��9Rz���?�΅e(�f�^z?��4���`��͆X��Gc�9�+� �y<��lN���/Qm�;xs�b�޿����̠(�Ql�n\"��8�55ɛ�&5P&_G9��Ա��3FR�-���6���]�$h�U������*ZV����8��^��+�P0�9���3��)W���@79�.��؜����	_V�$D7Z��d}�\0�b�~`RX=�%�?�79����Դ��QK��5��%�=J�gm`��K�+g,�fja�GV��d�j�3X4��\0��]͔kB�-v\n��b�i�e1iU�\"Z������0��\n�\0�^2�h��J�UyYS*oȵ��x�s鴿�(��.�g�ł���W�p�?�5��M�4x��R����l@��\'9��\00B�Z�e�N�#����.���Ϙ�@��I,w��\0#�@��k����*^3G��X�����:q	G�Y峄���j�� �l8�����\"�t�qހ%,x��x���l���S����#Ж�|�cf&�.fY�f)��~� wg�ݜ��dB���˕�̠�4s.�.]g:�1�&�@>�,x`�Ws��?��1��a�2�}ª�@ �-y���wpJ^�L����&K����S�^��ʼku�cƚ)�Say��\0̡�\n��]o�E\"�k�����ϸe9~1@�;e�t���֬ƶ�9]ia$ڟ�KPj��,J���k�)Yq�8zl%�)���Lo�{��5a��e�e�p�誶U̞����f��c)�cU�j��9W�W��t��a�A&q\0�	+XW.n�İz� �yGP��5r,rJ�u�E����T�%�O#��Si�*+2���\\9�ł�Au�\\tmڲ���V톴y��h*�iw�[K�M)�E�\0Yig%n�Q�p70 \0�\0%娭�70�,�q��$_��XW�#|��p7k��A�ү��p�D4�=�\n�rf\00`D`amw�<E\"�z_Pk\0�$$��x�L\0\04q/�U�f`�����+^�0����Чӈ�z��������E@���^a���/0ܽ�f&��I��eah(��`r�\\��	M��i����X�Զ�p���8VIڎ�+h�p�zVl��@6�KX�D��!;T��7X5�`Cd�d�Tb~������-#���㡍��Z��1�*��A��aV���=���PE���c}��lmAo����c�U�@:a�\n�*CJ�\"G��r�%��g����\\�V�ĸ��G��������\\J����ɺ�������rTbuL�/�@��`!�\\��da��B��x�	�����GL����A\\�ț�j+\0�\\\\���Q�jC�K�:����P��-��x`���%�b-C��Sƪ[8.gw�+ܿQ�����=��f\"�w;��(J����1��!>z-��%�1�!#�)��^P�Ja<Y�K�c5�P�4�D�������̋� ��8��i��j�\\㨳�2�ľ��\"fp2ہ[�5���@�Tq0na�c�NX�0�c�࠻�e�q1w,e����똊�fǉ�aCW�Qi9=:�4N9m�\0���}��*���ƹ���o3pZ�b��<�E������v�cR��b��]�7m��Kb�=�0,5]F�s5s_p\\1�`���Q;�*Y�y�(fR�%.��i�U|!3Y�t��r�su@]�h����I���$���@G�-�D�?\"�Bf6�:���p���	˵k�K�K 2�}M��m5y�\"��\"S� u㙓�[p��X�S����ca`�y�B��.�n;����1���Us�KL�L����7_�y#^%�����qQ��LU�)��F����!vd��.\'W��)�N��5�v\nBi*!�~\'�?�a�#(~��m`��%Ug���S�*��-�|���2(l�%Pc�������+��[K��}A��9��VK�-Ԫ���kF������}��U%k1��7K����b�&펕���|Axc�dn�qj,U�+�1¶��g0������wd��Z�F?K	���s�ļ�M�����=�pe���=o�����E�j��9�\0P>m\0/L�.�j�̮���GH���=@�Ҳ&�`��i�����.��ј����B����\"7��B�`L�p䅭�h�m�^Gvת��i�E��W�SaE���J	�$[>i�]���R±��I����\\�-�7Ĳ��rҟ�-���b9Q0p[�\0�J�.X�j`mQ�\\W~�/Ϩ�9|Fk�`LeS5_1[�L����D��t&5*\\g�QK���	���\0L���1燾��.c����S�0EN���&fᯧ�I���	��w���^Ly���*�b�D��J���\nj��&a��-*���Gr�ct���\0���N6�v2��k����������-���,(,�.�.#�b�@�(��*E9h�Z0�kH�!�FgC�����\\�~�5��z�Y���+3{2�8��Tx�����^��[�efL\0��J��\".�����2&�:Ħ���DV?1�T��/��ŀ�B89!�v^��(��y�En�K�gP3P²�%=�*�:�_W2�T��G�kw{^�p���Kܷ�[.k�ţ&Z�av�:1m�a�.OG�v6ѻ�Կ�m�X����ӖJ~./��,�qZ\"��J�F���b@X՞��2�{�m��^��/^�]�>���q� q��Obe�\\�f���xrr�EwWP���\'�<\n�\00B�	�	\nU_�!E��i�qU��\0��d\0UꠂN\"��^N�ԆPqpjX��!`Y�Gn�_C�vZ���v�J�l�������2����~�1����/��rm-��z�����8ԯ��OL�:e��t��Z�ԣh^8g���*��\0乗\0��N���#^���cϖ�&\"�o^p�7�f�{m98 ���C�ه�7�\'[-��8� WH��.���(&ag�@�nt�_U�\0Ve�m�&�������+���Y�cܼCĵ�.��zp�Lh�f,ڴV�x���w3�\\�\n��g��-JV��\\KL���?�;ľ���v��RźA���(؋Cz��Kޒ�Q�_w��i��i�\0��& 鷓��D��p�9������.lX��	���L��M7��*��i9g�4G1!Zz]Q)w����Sl������#������4�U�������VN&�*?���T���C��G�wN���p61G^�S�+�l��n�K��!	v1��(�����7��	���}�ɭquB�ߦ�l?A�P����`�����<��Nnkpݴ�.�b��q�J���	��\\=�iib����\0ư�\'������h/��0:f&�ɨ`�k��� dB�u-L���,��X����U��{���A,��IW��!u�e�<��]�m��\\9��C��Wt��pо]k`1(�m;u����z�7����4����3d��&u�)cb�����{ �<R=C�4C�Q����rU�\n\0QM�Q���AF4R����g�t`�3u��V���R��N!��`�I�4}��\n�C�R�d��3� �s\0W���\"�(��\"� ����s�q�^eű�gA�kw�,����(�)�bfP�4�n8ܳm�,/3HPIhvb]���It@<�*����	L��=������p����;�x^Y�QK	���LF[�Yjv�X�*l(���e�y��W�`��n�K�/�tcF�k���;n_�p��Pev��7[{�-�N����vY��0�h\\-��ی6��9鉗ߞ`pb��R����ӨX��\n�}\0� �����E���(.־�nQ��_�MrQ���%W�\\f�7,@s�	��b� o���C�������U\\F�o̺�\0�Y}F�HY\\��s�x|�bkq^!\\\\1,�@�Ow/�\n/&���\n.�b^1�1^��i�ga�lo��x\\\0C-E�����p2�^&�mr�3,�����A��è�&k�^��s\"����eMǞV����xA�S_�>�9}��c��\0Qg�zha�?�FW9>���zKu}x�0&��C�e�����[_X�e㽝j��@�0Q=�r��5���6���Lɠ���ҫ,/�������6]�����Cy|b���fA��e�F7���)O(`#V\n��vEt.7R�����m�����U����r\"��@�sNai\\G�i����K�*�]�\'���G/��\0�^�����lX�-@�\\Գ����N�, �a�Gd5n�2�b��5~f|A���Ԩ����蛋LN`�o54�������n.�ߨQ�u���]g��Ƒ��(�U]�ψ<7��W�<�S��4�0(��f+����V�A�2Ƙ�B�����K��\'���\"9�|-_��[�\\�E=r�Z��o�ܧ��F�bjd˨���Jn��\'�E��1��c:�d`;�Ff���\n\'�f���>#�\0�ZH��A�i���-X���!l���ꭅ�\'�K�&��*:�)`K|\0�\n��r�F����m�+��g]�+Wq��n�D[�Q��r��1gr�1���Uަ{��YU�efY���H<�����%��`�[ԥ�.��������lM\'�o����YPUa���ڊ��w3��x;6<̭3���Զ��Ƙ4\"I�P\'��s�[�}>��>*�ʡ��2���j7���w��y�d�*�s®��a���n���C7w�g�C�����&�1h��jR�~f�a���c��1a�bju���Ee�$����\0`S���&�PՅ�Ni�ee��0�*�^kԅ�@�Q�n.�)Bf�C\'W�����8+��t]x�M�/�͹��:�c������&��D��7�ƃPZ��x�r����9&���^��P���c�3L��^�&�\\VS)��V\0���\\B�=�~�we�<7L~�\0��T�%��G:���w�m�z��H�+\"�̤�Q��\0��B,��!����9A��-�T�\0?Qq�.�48�@�I1m���#�b�K��JY,8H�^�7�����F���P1�E�\0p�o��L�e��f��~W�-96&�o�?@��- {f4���So72�$�b|�9������+T������+��Q|���h�ω�}ix�(Q�y�\0\"l�,S��+�q�\\�����|[�Ե�rKr�4���ŷu�֤�1����`=��vJ�O��1�\0��~�[�T���]�hKܱ���K�%�q!�������\"��L�︸�qyj]���_3o��V�h{i�s��B�)�|GA�Q>�Y6�r���:5�E�x�9���t�w\\z�Y���zu9M����#�	c���M�\n����U���nK����G��kG��L����#�CL]X%�����R��j�-\"����>��h��\0:�GcTP߲�e�B��pHiH��b�c�,M�i��B�$PW1����3��]����?��\\���W\\�r�\0V�GP?�	3���]�gcu�]N����Խ�L�}�T���q����ы����r��V�5�%j�V/���hkdb�aR�x�hD��G�i��T�q�:c�\"�\0Rr�C|Y��)��_��7�/�V+�ԥ���W-�Ş+������tbP���@�h��8<�6�(��pm�;ˊ�:����Q0W	�ĺb�p��hY�h�}j[^!��&3\nv6�*�\\����ID��D&\n�B�_N�?q�@��@�(��`�sX]f\0헇Ķ�0:����$(K`9�)�b��N�������9�,]����=��G@�D�P���D���S!����p����iՙŋ09��O�$�[�a��T����2&�L���2�a�4_0�����!���y_SrJuK���MHp��\0-՗S\'��N��	aHR	��mF�U���!�¼���3T[Y<�^��_�d\n@�vyi��%��5��eN��]k~j:�A����k��8�e�j�o$i\0�/g\'���nގ#@9@`��Wa��iM����#Oe��:�\'\\7��N�`J�=�UP����\0������m�\0�(�DӺ���H��m��e�!O�/�5O�0#Y��Q������PsU��^�q\0P�-R��Q��&1_p\0���J�;Q�ĕq�wU<�Cs��t�}�0]��:�k��X���N�,\\�K�9N�0y��Q	��C�?T�<ƞ+b��ʵ��o*ʮ���Nb�6�����o3G��!U��L���N<��إ/0��c[�ᨖ�8ES���d�9�A����h#�+��r�\0�l.F0n��1� Z��/�%+���|��E��36�C�SD�W�^%M��б��eN%�gwҤ��c������|��]8|G�:o\"s�ǈa&��ķ�K ��K���@�(\0u.�G?1�\0�P�T\0�6��i2��\0_R��vc)��c�*.��|��{@{��ʪ7G+�5H�v�Yp\'�f���j�h^��幀�2�K��P��G�z��)ʛU��3;OK��\\GB����TD�s�	�g0��P�Z4ELs%���0r�J����#s����\'��u������3�D�NO)��:��Vq�.�r�f#�;�d�������Z�l�_��S%���Q!\n�/?SdĪ���������94>�*��ɀg%�I�\0`(�J���h�\'j�V[&�k��P���_V�y����:��sm��E�\\3`��Wv��[*.�Z[ʪ�h���\01�s`��35׎�e�ܵ��B��F�J�}��PU�=�MV>��5H?����=�`\0�/�Ra�,o���b%�:A�ʮ`�N��]AY�����%��a��\0/0 Y���Sj��R��Z�Լ_R�A�\\j��Na��������w�T�9�S(\\q���2�ʈF��j313-~&7�f���n.b���C�N.E��0\'%���l<��8`f���/+U-��QQfѾ&L��R���X\0��|˔�C���n��)s�����^\"�I��ϘX��G.3c�����4��2\'��9b�4�����ط��t�si_sib�7�P5/5x��^�Gt�:R�ڰ��/�Կ��Ť�̭����y���� ����-�\"�Y#�A�E#p\"��[���X�GP�e5��a�����bl�h@��V7��ꨔ�1�nR�D8d�q-1P+�%q�Ui�8�������Y�/�X�%,��	M_S��[�K���Pi�D*s����qT7�`\\��GW*�_�U��x�R�k�����P(��5PĹ�{��G�/W��w�:�V	N3��)`=�����Os	�r��$gu]�^�0�W|fl:�FfЬ��L�)ϸH;^��/�!��(��&�	o��\\Y��鹼�K��m�:��b��b�)o�=W�+Gb$��LR��A�jQ�-��Bd�\"���QW(b*b]���Ǜ�����u�Ӊ�@��7g�R���E�P��X)�(nV��nUPR�Q.�w,-���!�w�5�%Zy�8m��lWS�\"����9CP��鸑,��@�3)2$��/�Q7�\0�>;���.��oܰ%�r�*��UYCU���\"QF��u/�|l��~` �?S�\\w��)��b�Z��h�9�/L�n����m8�s�.J�*<:2pV�2��eWP��s�T\n�݌�aT�m����G\"ty��XW��^�����.U�n*R��c�����ߏPt�\0������v<�o�m*���������.�.�B��/P��n\\cW|E��l<�W�\\���Ej�oX7���ڍ	�nۙ��q����ë�y._�_�>��.�РdU��)\n��0�bΈ��$`هr��ԇk��b܅���V.�`�8\0f �u��\0Ĳ���K.E�TA�{�RtSrY�0%�bK�ڈ�mQ7T�m/�2�a�g%(����E�~hÕ�y�}��Ю.���uUeўf]�����2����_���P�rbWix+�0l�f���T9.��*/��\"�ppo̠~�7EF�	J�r�K��>�G?�Cު���]H���k�ׯ���(�W�\0&�!��z!�0x��G)G�����O6��#�[�0֟U(���c���� ��\"Q,�L·ۙH)�\0��B��U��#�p��8\n��)�Dj\"�`�n\"�]�c���-{��E[�h��A]KV7.�60�*i �J������^�#��;n.sf9�ڦj�\"���J��?qYp���3��%��̫�L�R��W�b��J���?�[��\\%�r�f��eu!}��b��sN�ަb$�J�.	r��K��~&�%�_�7�6T�/��__����W���$O�ߨNY��Լy7o %)Ak�����2��4��}���,{���\"uU㈔T�Z���U�]r�$F���0�uW3-l��;@�c�^2?���;Y�Bdm�+��w\0A��CO�n�KA��#�i��.���2�AGF�̬Rӆ�7Km���\"��16�����2�0ZeT|Y�.��v�*���:�Yv]�̋��J�0)��ޢ��P����2�_�e�j����[�Z���03�b���G_Qx�{錏�=�\0�`�oE�vEtX�]b��;�z���1 U��x#�\'6��	1���r��4�u��e�!/j%t�^�*B��/ľ*������rh���l9*�\0������XB���U����?��F��q-�)̸B �[�0�\0��9�*�	h7��x��A��\'s�zqPk�&]����t/DY�*.�e~�k�W���Iv.�p^�X�(0����R�OAP��K\0�8<�kg�������a+�\0��U�)g��.�2��u���.z�u����s_��@ �1�ͤ���2��&�U�Q�����M����\\)DT��,�jAKȕ<�_��H%Vs��@B�J�H�P\n��Ĳ�s���ECj��xIEeگ+�sgUrԦ^s�FՌ��V�=bV�qGr�B�\"ݨ�s..+/�oPW�W�o��w5�Ľf!i�+��f̨�c�>!Ne���у���1��k�i�7����aJ����UdSԾm?��/R�\n����@e\n�?${.b��N��\nڸ�r�P�`Y4�qS���߿�S�_qϺ��<TUl����N3�q+������1k�V4�05\\q_K�����vol�*��aS�lU�+s�9���ha5��G�4���#8Ͷ.�1á��������߶р����v�\'?q1lن��{�3�br�zA�y���R����A�e�:p=��,{$�GW�`.4\"�\n1*۴��N:�M��k�jf]1l�j&%�K�و�:�m����\\B�&o��+�m���)y�n�a��\\�)��.�o��Uغ�2�P��\\�Pˉ]��bWmr�`���ݿ�H��W��{*��j���j�lNVm���@9������p������e\n�Ҹ��\0�3�Z�z��}���/(f��1խ����&���v/⹂�*/�F��\0LIAC�U��7�<�g�}@�߹��%�j����N$�G2ǔ�EW �F#�8e�RØ��f�$Y����.b���f�i�9�e�PoT����k��RE�T\\��éu�,��e�\0�:�.�\ny��8�7�啛��8�z���6�B�n�)��z��SˈA����^5g�e�����C�*�<�nZ���]1�n:<E����태̜���%���M[����1������ţCR�g�S\n�����z���\0��}�ǂ[P٘���\";���}C�@��1-�w�4�0J����\nh��)�*&I�@X\'�DBk֢nUFR�����#�Ej�7*j�P]��0�@GJQ:\09F�a���51r�%[%��q&e��9��,�[�SK�4�Kb����4�\0�PV�G,��eS�a%E���D��g��_�����v0���@<�e/8��CS�j��,;��δ��e7�\"��\n���<+�����{�6~B�&�?��B��`�Q�ךV�ղ�\0\"�ȹ����ܽQ�*�\\<lT��r���8�����/���<D\"����!B���H4��/����O��!��k���1K�L6�>1ɆQ��ˏC;h�N8#C^���b�Ug0h\nt�8��oգ͒�\0�0J�E�M��ߘ��TAo8������\n��PL\0PUK\n4Ju���Gg�\0P-Um[���8�%��k�|GL�1U����j�tY�e����/pc�Tǉ�����,�{A�7+G�����>�)�/0�}���	H�NǕ�3�p7^��-P��0U��t���N_Ӗj<w��?ӟ�{�2�3�\\�L�{˘@\0|�9J���⨗�����T�\0��E{w<�nVF�\02ח�`l	SUE��*J��	R�	A:���1-e�.��Cͽ�X�g�n�$�&So�KV����R_��\n�}\nq�<f��o��Il�Zy%���>�=\\&hr����B���P���yf%\n���{���F�6|\'�~��bs1�D8����c�E;�\n�cU�t����2<�o0��]耦sh�. ZFX����\'��Q��8���\"^��3 �p�S��@����t�+����/S���n+{f��R��Y��ye�/S�Lb6�!��Mӣ)����J�aabr,�Q�Mqۀ��Wd�WS!}LߝkS�\n�)}�m���<BJx��{��������Gh�px��{��dA�nb�Xp.��������o~�\\!v&�W���7�����O[��Lj(��}]�������\0%$\n�����Z����<��)yw.�KC�W]:��o�Zk���.��Q��G��Q�i�<F���% %������\n��[�VҏA����`�v�\"(��65~8��e��Q�qy2�do7W|B&�\\9���\0�8^�~b�,���F��6��\0�tn�f�C���d�2�{p	�á�����5=V�R���H�Q_od�C�<2����\\�`�p��(���:���W^C�R�,��x�h<_�w��ۦ,�g��wp�\\L6���!Ζ�-Of��L�Z\n�ݸ����Q%�큢Y���>.*`ef$(M�+�|G�l�����f�����/�=&m�b&����X�\0��ס�#��J]��O�w��QHV�L�}E�8�_�9L��-�߇X�l>����s�<���u�һ�^.w�#���[|U����1����;)�e��pC<w���\0 �pXo�g����\'�q	�@ֳ���bf�ťz��$;Tv�b��j]��Jo\n��a��V�!�ڢ�.�\n��d�I���;Vx��=��|Ԫ���7A:��x�F>N&>�?��	�-7��Fp��]�t���0�\"7J��EL)!���t_wN)�_�g��8���h\0�[�Z�1�/���5ڶ�k_�i-�f��k��JjU�{�C�xg��:@=w���pZ��l+\n��촾j[����Q��+.+��a��%�6DTxB�����\0�e9�1@m`\n�/��~Ah�tM�ᬅ�s�F�yk1s8���i���hK�\'�,|��FJ��ށ��P�\\�������R�F�|;�E�j���I*t�#+�*h��.���4Xܝ��V\0]�*�+U���O�f��Uk*�p�Ҏ���5�\0\0\0F��f���?���ֽS���5\"V�bAV&㤬>���1��⧹�2�V���?YI\\�bgOj��Q��M�\n�	��9 �a�l�|o\0B�\0W�x�����n@�y��P�Yx̢\0�\"ܬ���ju���E.pM���,l�#��:�&�� U�ʇh��`+\'��T�S<�&����G%W:�ո*)HaB]�%�������X�p)�	`s2U�L���u���R���������\0��>�\\���us��Z���߱��j�\\�X�.�\\�u|����?.�����B�R��fC�9`�����\0H@�!HÂ�2��ܴ�����~�7�6{F��z�m�����K3�b�?HE���~�>��~�]aki��B��Tn�:�c�@^8󘶪�\'���\0[vk����].RW^�y��ps�/^P4���?��F�E\0Ը�.��p�^ ��:��_�\0PPx�ޥ�����2_3��h��:Op�![w��i��h��%�5���ظkYO�*;�)��梼G�w���Y�6©�E�GlBj[C���u z��{`:�w��K�+\\W�?P�<\0\0�%��3dB���B#��\0|E��P�����`��i��+��HxX��s�,X��y��qZ�d7d�%T`q�Q��fX��\"�fc#���^�L�v�ǐ�j�XSr|O��m(/���.^O0_�\"���}��}��7g� X:���&�>&{�7E?�\\\\\\�[�g�Y��ms���E�X���B\n�0�3X�I�*�&�1��p��˦�@2�#�-�J�;ĥ�.��!1� S�\\[��1x+Wn����N�X�w�@`��9��<�ZV\0\0���G5�d���T���0�\'�<�Ib%aa��r:ud��;����\\�cښ��LE �n��T\n�Ř�D-u�Q�a>�����>/�D�FR�\'��3� SD^�s��q�%��%��P�\n���x���]Ve�6����3-*�0�����atxM��pA�x��M���RÙD������l��⬆��T�q0!m�\"nY:L�2���Dn!T�a����Υ�pK<��f;��J�f��UTk|c����C��4K������}�)���k���l�������KI��`n��8�aV����+m�J�o�n�QH�.�t��W�P)���t>�a8�\"���bj�&�r�n��ӆ��C�.#O����;��F�xB����r��J\01��8��E���f/1[r�b˭J����9��9�]��8a����sL3Z�-K�\"K�\\�0T\\J�\0?؜.É�����x��9�	S�hv��9�#y�(�=rJ�@�\0�L\n�br�*by���\'���2��?\n�̯��)�%�c�x�Ax��^f�38��e�w3�eh)Y����͊,��������� 2K͚�{����<5�^n-\n3V��=KX��t��_:��A�b�-]_�+�2�� �\0��@�V�9e���1��B�P���]�L�`w��i\\k�9 ��h<��E�k���pb�֫+J�A���ĹU��cfٲ^�/���Ve�SL��.6���̱5��\04�v�;��`@�A]���cG}{�O`2���P�Y��R\0:O�����x�/<ۻy�*�:�����\0��U�,Ђ�%@̨��.�L�+��v�K�q=��<O��0ˉ�L!��Fq/9��A���Բ��9���-Fu�\\��7���MH�h��,t\\&`��1���g@e�W��3���#�&r�)q�97WWs�$p�1���j+\0��AU|Aca�f�r�w҈�Ŏ�hZ� ���!�ָ��t(S\'7����H�3�����sqb�4(N��㟲�N�rۮ -���.]�Xrɶ��t�%�ܺ�%�\"[���\nD��w�0 ʱ1�J�V�E_����G�w*�3LA�2���V\"�L���vx-�iE�g���G(f湘1����ڕ=�O�����x\\\0�75��4ۻK[�b���\0�V���qޑN����ε��;��\0\0x��-����s3��ḗ�9�LT|�BW0o���*��sQ�i��Ze�fe[Se��X̸��&J�Ch��ǘ�Wt�|�a�;�b�!�4�Q�#��wW���\\&��1�+a�\'�`UC$���� �D��)�,��,/��jS%2f.Mj��ˉ\"+(6ܵ�h�\0��M�E�K;��YF��� p���TK+�u8�6P3�6�Qu�����U�9�dʋ�ᝪ���s��_p�p��K�fBj������ճ�_��eAg� ���*�V1X�p�;co�-�;1����0��ۯQ���[���pÀ�?����1��<�~��}�/��<�<O��%˼J��G�M��@��op�L,i���Pj���������޾.�%X�	�ތq�\0�,l��y�a�B0<�ǙxL<����6�����2�~�x��o�y�/��q�*�1l{Z2AaҜM�/����ߘ�P�I��uj\0�2vB��V��uC�ra���2����_��Y���t�s`�d�L�v�G*�V`R����3���l{�%�<ǌ�^\'?3�y������fZ\n���|�*_�oI��?��e�7�{�;e{�A�.)x�fl2l)o���%+�ׂ<߹T���\0�J7y�5~`��p70q3�K�Ig,�=��@Zܣ���w���3Ķ�é�Ʒ8gS��.*\"�0�/C�W�(\\4�&�e{O�pPS-��2�I��舊�%%����X!�W��ȉ\"��LcƠ�[{���a,��1���E�g�v���C\0�[cc	Y��<��\n����\"�ʍ6Ky�.Qj�����*�hx �BJ�W����U��E�z���8N!�ۘ�]����Ը�\'��L�°��\0p�l��l�剁W�Sl�p�ʣ��k��in������ctA9em�/�(�#/��0��u#.g�	(�>%�@������1b/��A6y�X9����]B�{�����ܔ�rܚ鹞A����N�v,�`4V?qȪ��E�{�n-�ffSl.�,ޥf�Pg�q(/�U��>\"a-~Q��F]�q��>Į���J�y�r��Ǚ��UܩX�5�\nUE�����߉]D��e\"��+w�֥�_���=Lbf���W��1Id�\0�<ª*�����1=ϴ,��Uo᫂�˧R�����n��M��r���%<|`=�+�*7����J�ĸP�����\n���\0�����8�CĐ���n�4���UTD�#EE�\\����Pm�%4��Eo��N��Mܐ<[�rz�Y](�����D��j��)lUl8�a�ɧӁJ�P8=�@oP��*�.$܀:X��@)��.z��PA��J���hlZɌ\\\"g����|L�*\"�~��+Ĳ4�ѱ0e�{���z�p��*�jg��(�X�e���\n��5�0j��@�IԽT_T���u)QqR���1�j�uV�x�bX\n��<�U����rg���y�Q�E�B+\0�3�\0��=��)ʃ�Eѳ��h]���3c�\\2�ik*�L���9�\n[3V~!����3�o/���]��)6�����d�+En\"�ͤ�JL��Ocm�vհ)�B�p�\\j���Y�_��6hž�f Hl8-y7q㫁��4��\"�ۋ\n����?���/�J�����pq��V���D�lL��ȡ�=u2���{�|CR�M#.U��\0�n-jS�\nJ�Lu���(TJԶ��ʪ0��嚦\nWps�Z����-�5j�U�����/�Jf���D��a�<�E��.4���s��/�\"��:\nC�ѿ0r/\\���?��x�\0b��	a���~ ���3�F�4.ôH(�x-׸��F-f�%y����=F �Я�\n�8�^�Q�1����_�b��L+��of�� �P��d	��q�O�vᄰ\n�<F��,� ս�(�n)��l�Gɮe�GY��w�C�Bp[���X1�x�;�\0cp�f�m���n�(�V�H�9	�L~/\'r�)� �E�8��ZE\\��mǆ&yb\\�������%�~��[���or�^��a�<�N�,�,��DStF3pr��SR�R���	Uɉ��,&AH�����u<u��Rb2��]�������C��]pf!V�X^ݹbL��<�$�[���L`��ub�^=��*�@�a�A���L��f	�*����΀���a�.bS_�w+�$�eR��[]�V��S�\'B2L�G$���H��9�<�]\nb�t�=۞���;��h8AN���:�U��B��������hf\'fd4�ݓQ�Ʊ�[�+���]q^1rv��(��U|lb��$�a�Lˎ�b(��R�C�Ց[��.��	�jo�b\'�]¢j+���y���pU�e�0���9�� �P�e���|TEfc2���X~%*�  �M��DxK3\0�	3h��9����A��6Z�:W\nU��� �^	|�kD���=�q/�b�Q�T*����>�䠡�\0)���?+E��1�̓��I�q-��:!!-=*A�)��K=�ȶfo�aG��4�s4J���tB�)GG7+\"-.���	.\"��:�S����V���P���( ��B�d�q�S)�q)X�qr�C�g�a5p$S�C��q�jg�J�+�dw�v�����_!F-�d41�rʸj~��.%D��@K�-�l��PPG�����-P�U����.f� \\LbZ�.�;\"���h~�U8V�� L�pZ����P���]K�qq%ug<KG:�\"�V@��E|=�\"��a��|nP��A�(d<�HBXO6\"��`ڬr��bװ�d漘~2�X�#��}Ư 	zO���.��v�\\����T�*́��نU��ǩJZ=���\nҮ�&��~��[��v˓5o�����z���A��5�F�@�)��[��!�����	w���a\\6�E\\Ŋ���R�p�.>ᙼZx�lP�0�6\\���uUp\n	��ˈ���1�����8�.��(�\'Y�7���@3L^a�H�%޷���>��.up4Mz��y��^x�`p@�6Uʵ5[�K�S6�\0��嫫����C�.���h��hߜG�1Qt-����2���\n�<�2��+\0�b��uk�?����QY�NJ �%v,#��Ƒ_r�U�,����^�����ŝ�=��\0uW�i���5g�_��ˈ����p.�R��>ۙ\"�wl�,	z�|�V~����u�E���KNg�˘+�������>ၥ��7k���J�c�l��x�!r��е|ł��L��S���e\\)��J\\0�*oINT�q(*��p�Q�y���ۉ���؈K���Գs�8b�>��\'�aay_qm��D-��Gq-`�{�J���~��bw����F³�e:+N����� � \\-M�����h���2�3�g���exM\\ڀ��� �b�S�S��*� @��\0�H�S���w��:<\\b��6\0mb��U��f2�G6`m��3� .�q�����ת��w�j�����(��2�A�R0 ��}�f��\\B@f����S9���<��T�*�R�qeƠ7��\0\n�R�%�S(�1�������5�h�a8�02fjWp���3s>�$���,��M̉��+�c���9�^�J>S+,��VGJL��<��*��)_���5l�2���X�e�Y�����w�nS{+�&x����ˠ�Q[��P^�f�i�@\n**��#�Q�V���������f,���V;Xwd)/\n�`hΦd1���T*�k������Ape����(���DR{��0,�Ӓ��	(.��b���2����K�<�1Ȋ�����Q���\'�bQr˥�i^�+�R4P�O$T�7s�P{Wx�n̡��\0QRR����b�R꽜������w\\OW4�u8���[�B:�G&�Թ��1�i�ʗR�*��L�(*�5r�˺�8E��wDVPʾ`]\\0KrK����Ի3�\\qW��`X&@8W�ǪA�;�-j3���d�nPh�B�R�msl�������#��T�<��«��Ĳ$,Z��Du�-;����\'lJ��ժ}�$o��X�cQ�l����:g�a����9�xsu�Kf�O����ABA�7n��[�C�2�cog4tw\"�Cyc�K/�R�� x,n���zC�\n)w�BU%�Y���`e(trʓ��h�V�N�ז�kr^��LE*N*Yr��kc�H�mVr�p�A�$�,+�w�g��:e���Fb���B;���7-�A� �)�\n�w,���\"�-*5ܷ�����\\2��1f鉵]ƜTr5�VS<�`1V�̪ghh6�J��V�:)�7Yԡ,������6:�RĲ��c7A$��	����e����ZBR��`���4�����tP��8#�����DJV�h<.��J�P���?�(;?1���U���ϔ���vd)��u#ztV�q����Ek�j��m�z]K��Ъ˭�>a�v�7�H�U�T��\n� ���� ���R�\0X���+Ү�!���&����:�^:�Tɲ����F���r���2���`,`�q^.S��2ً��.UM�Lc���f�b�$N��P���P��ÙY�:��w(�����\n��siU�K��1�WH�Ub	�xD�S6A�l`��$X�GI�kp��M��������y�w���0�N+b�ņ���h�*�Tt�\"N��\0:!\\-t�q��U�L��wXk��-~ʘ4�a��V���p���h��˄��\0�\\�f�%9��1N�8�\\��R���4Qq4ߪcqr�|NXF�ajƊ�|����R�].���B��tg�n%�9`UW[�N,a�՘��z��U(_ĭ�XDs�A�j�Ք?7F����U�[q%��6	Gp�@���J��8W@En��}E{0p�^�׬�͙�v�\\6�`������u� V<��%H�χ��)�B�+R�D;`�����&6J�_g���Հ\'��6�Lx|ĵ��]�����B&`+�F�E]�y����<f����1��T�\'rʔU�Tw�wIr�1mܼ�[�/�[�w*�ab�*����f8-\n��ԥJ�K�\\�N��|��VS�}0T}M�\\e�c�=����>Ρt��@�U���xa�����o����<�ɘ�<��E*j��8b46��]�^�*b�f����D�ܷV��]4�������U4�Q(�(SK3x�����-�\0�c�:�-� �,.m�颪��(�\0�l��ٕ.�\\�<����ս�{���(�|]Jɫ+Ir��6�kA�jV{𳄻p�q�� �Wj�_R�\'�iH��l����\0aR�iv� #B��\\���發�sg���4��՝���P��B���%�����!I��6\0h+Qי����Y�P�SFf7RնkPn>Na����{�Pq=�*P���������`��UDn�\'������.is��t��q��cWR���#k�[��Hh#^ˈ7\\m�j-��kc2��IÍ�)Q@\0N]��8� *ּ4<}���MFלiTφ�XG)X�*�=��2]O,�~��D��ہ�El��x��w,#���W�ba�q^1��\"����AW�x�d²�����&��2�)�P���{U�b�@|c�fg�>�P\n	y7�A�$4i�i7�fa��8h�T3��K��e���/�\\���`�E��M�q�X�Q�LK\nq,�uT����|J�ٕ�}��\\|L�7q��w���!�bj)��U���Ճ���\"o3���:��/�`���L�cs�/H��2�9�#qU\"����ۊ,�3Z�\ncءÊ�H����y᪏f \'���QXZa�)�a\"�i���Fԭ�q���l��v�u����f�<�\\���0��W�	1�.�b�̪��n\\�-J�!Ҁ�%B�>cFb���k�CQ�7G�.#SGg�x����q�?2��Q��R���Ū�M�%���p�(n\'���4��#�w��o�\n���X���L�AV�`�>J��Q�3Z�QnQY�Tqnq�A\\Z�p��&�f�.��55��̫2T�-��7*�0q˘�Ԩ�L�5�B���Г@1\0�� ��$(�p#���*�&�+�u���\'����4�0��\'ń�������G�KJ�P��x��@1�Áy��~-�;n�˷�\"���\0��Mj�}&~�9\n�W���T�����}�pM/�š��Ɏ[�9�z��fD�y�#�������N��������*��3̪��;�[�F�*���J��V�ڸXJ�j��2�JM˸<5�ndz|n�Z\'�;���qj6���R�Q`��ĵo�Z��-H��@�^\"���\\,����.	D�����3)*��0u�[��˚�R�]���n7NH����k��:�r�c����oI?A��$�v�n�@[��P/ޫ�Y�lf��w�e�e�>���R��U�d�p`3)k��{�u��BJ|fW��>�t\\+ .��y���\0$t]W�r�8�ps\0��r�J�����ļR��hܪ*j���: #Lr�.�B�#c}K��{��n�{�,��lYn]0D��w�Y�lL�����uqS�������\0� �UY�^�/�������!�����q4�7�*\nKKL_	�1�q���^*`�gq��}E�P�=�06�<��\0x��s�L�QC�0�0�O�����s(�^��U0.^3\n�����*��z�Dm[�C^�0�oA^#�Zm��Ť�<�	��\'�\\�Ph���ֆ�3���.�:�����XWy���\0\\����Ӫb��j�^����kZ�p>L5	�-ωn���2�9X�������%��:�Վ~���6���VIqC�	S�g/��XQbd�������+�a��5�²�^��W�:�<�n�UJ�z��@K�*�*�����\n���.f��.۴�6��R�Q��e�|2��JP;V��T��튷�EN� ��57G>bbo�)허����=TQ�z�30˩�2΢��e1TW�\\��+3c2�ĭ��唅�7��i��NJy-yk���Pr�Q�}v�+PT�o`�\0}�s-�he;[��̱T��Yߪ�+�V��}��~(����K#.|.��Kॲ���\n���u.eN�Y�������q����j���P��U���Ө�@�������AmXY)B�uO>��=�iC��0�*XD��\0�Ha������Ꮟ�Bxx�\n���Z�]&�AY}ʎ�yE$�l�j��F䔗�� �3�.���0��x�,&ۢ)#9��{�z�.����k:ffȲ��/;��� I��dt����d���h�e%}A��K�;�G0Q.χ�A]�{��,y�s\"[�, �\\%��R��b\"�`�XQ�X�fa��WVK��nah���	Z�\\ծ�rC��V�,u��\0�:=ZF�\0�̼�B��W�2�R�v��P٬8�\00��8;�(�Y!����6�bd�-�v��,J��&T��u��V�%���=![��,�neH��ǘ6tW�����{�վ��%���)�ja�¹	�>�B`���	\n��Q�w�3X���?!K��D ��KJ֡|h:�#�Ĺ\0{A��s2���*+�^�NZYGN����*�ǉX���VER.��.ٍG\\^&5��.��El��@R�)���H�[���qQ�s0#��\nn)�8�\"\\���Cj~�Ij�o�牂n/0�2�(!V��ܴi�Ӹ`�pl%���v����jq�V 2u����\0>.T@�Π�?P+X����kŀ�ȳY5���E�)��]�-`�X��PN���y���	Bi�4��ܫ����ع�AH�C,�cMq�N7�Wa��B�A�?w���}B�U\\Բ�����\'Řǃ���@<@*�������m\n����\\oq`���\nM5�\'�7\"c�NS�P���G�8��g\\ ���qm�c�=������1\n��y�Ne���q^�b�Z�j�E�D�6��T�)�11�.jnPC�7�|��s��(���qW��֙f�x�ʛsR�Ej�l�b�}Cq\\<#�y�AS������cs�\n1��Dh�V��� ��4��8�>M:��+p-��WAF5osSj�щwB����_5����a��qPp�ôG$�cLu������Ga\n����jN*���P�.����R�H(���-N�\0�4�F	�����,\"�S��l��%t��~a��Q�.\"�WƸ��M���b��Sx^~�JZ���c[s�٨\0�j�~rK]�,%�uǈ7���kwP�1��<��2�L����]����\'���̼љx�nޣz�g��<=���a����n�C�.?�x�N�Qo��\0^LQa@�--Cy(��.^Rq���P3J�s������U��b�)�G��틞ؿ�A�����t��9j �!Ɉ�Cu�lk��L�ģ�7�����ZH+�\'�+���2@Z�v�oUP�;�9��hL�J҇���8��ۅXSy�#E%�s�q�E�*Jm|�dM�|E������ ��^&N�^�9�������&��ܸ�i3�Q�B��Z������+f�j:P�\n�7�N`\\=�5yw�B�c�\n��;4�{�V 1�#=ŋ.b����G����b��&�Y�C�~#��7���Y�Yn��D s�ٖVM;���R]Kb����\0r���#�N�{�����\\�i�AD��;�/��)m���\0�7n}¶�B��̙�_�����}ʅ���dTj� :>ɉM����%B�4�y�������Ȋ��5��.Z�2|�O�&ب�R�p:��V��,�~쾇���̮ĺ�ԣ՗0��Y2q�1ov�2���0!CvUZr��tL7L%E�P���P��K��&|�n4U�ю�y�uq �,��2�kr�7U�m��)��z��߀/�Q���-W.�e9��-/L�,�Ls3Gh�.\0���� �5�}F��A�lR��TX�q0���c�m1>��x��~�j���SE��#8�d�%��Z�t*E?�l։Y�hݚ�|Y	�9(�K��1���N��Ƥ0mѹ��\nvN��o�\'bu�!7����#D�q�@�SP]#���J�J�4�b����_��<����\0��P�R�)j�Qh�Im�Ġ���*u�A�A�v�}�2�t��E�	F\n9Gl��Cx7��W J�7��ĸo�����1���*��;���@��f�G)���d�2�b�w��**��Gr�jb��f\nV#w5\0�,��2���(�l�2R�m��3��k��*\0\\^e�d���%f��W�\n�3����䅋t�=4^��\0�� ���yNCw�\04 Z9#�2�\0�MOuiL/���U�\'�1\0��,g�p��� �qB��P����I>�\\4a�/0׌(�Qb�:fd}K\n[U��ٸ���w���c�����҅\";EvM=�]��2��|o�䘼~c�T�����⹔����~\"���>��;�T.V���d��;���f*�h���K�\0�937Fql�Y���TsW�Z�wMEʌa3�Ըct|���0�e��gP�s�Ǵ(hט��g�SWU�7�+��=�s,���j�0-���:�͛M�Zfo� �M0n�W��zqR����D�������q�M�6T{	�)1��G�Z |�:?dy�\\V�<f�G��4���aV1m`ᬥ3}b[�ok�p��Զ�0uq:J�:�vt�*	��eX��U�AX���b!O2��a,�\0݈pHq@��Y��Mu�E62�������!��\0eA��q5P�?��_G�K�ΡDͫ�9��x�A���I�P�Ngk��\'�<2<L�*�`lx�F��m/�(���\0��q�4c3@m��A)���3�qM���ET>�~�1�Іb�ud���44�\01;����\0�ܻ8��G5*��^jgH~����bP���cSUt��dNC�̲�\0�ϸ 1b����z��q��)4���=��,s�w8�9���2��o>� �\\Ns�P\"�N������b\n�����E�v��<�������ys���+V|\\\0�.a^ai��	GR�T��f�}�eiV�1v\n,�g�\0��\\��[�E*�h�c�,i��ED���9��������6�F)Ue�\0F�x���=Q��Y�\0�����/�؋\\��<���å�&[rn���\0�\ncX���ı���\00�Ms�ȫ?�oϖ-r��\0i`�3�ϖu�{�\0p怨/1�\0[�� ���\0�?�/	*t+�7\0��fx����i�%��]+��GE��!��H\'0�?W�/P� �����P�(�sjg�cڀ}�:��fU.�p_\n�yP-%�\07�e�D��=9[n�nYI�\"��s1=߹�#M��<�X`���}G\0��؞��U��\nf�US#�&��.���kg�	shԕr�UM���)�E\n�1�8�E����B���`^rN�@-�0��:�~&r&�c���Z0��ߘ���ة\\ʴ �Q9s	,�I� �#\0m\\�����PYFw.��m�W���	�@,߫*.){ŭ�f�QVV館\'�����-��y#-����`�iQ{׈��Jk~)��K\n���`@��b[qq�5&o���E�7s���\\��-DU��\0հω�8��q`���I����dm�Y�m[�50��e�ҭ�-t�e0��Ρ6�+���pb�l��ʰ�A�U�[q�+�k9���wZ���PN���Ŗ�uB���(U���F�F�-Z;{���Y�w����Id��hh��q0�	`\\VMT~�Z���ޞ#�\0���حAU/w���7d��[��\\��Y����Ä�b��R�����W��-̤�@s0+�}�QlV�v�[kqI���:�w�O@��o̫�+j۾�Rk��^}���-�_�T�E������n9�<��0OT�e��n�9��(*���s-p-��&���Ǵy�acQB�h�\\�s���63j�n;��sz���A�4���#V%Ŷ�*,�Z����n����Km�Y��Q�~�4��`]���L\nUx_��7 ����[\0�Q��q��@���J�YAR��kP� �9-��,vf���5-��T�?	p��7	qZ�Y�P-�,䗛��W ~��\0�8��o$���*;�3�q�u�&����c�0(��9nd�*Tt���(�l��E�k��:� ���wP����{�G���AU\\{�L��2�up��o�s��0@�� �eƑ���Ϸ���-m�]��mo�Dx�gAV�\n�i�S�P����j啂���&a�TTj���)����$r��V�J̪�\'p��>�\"2ʖ���2�sbϷn��Z��f�fQ�^+�=�N˶ӟۈ�mҡ����3Cܐ6���_����S�0d�_�\0q��8W��%Thv���czN3�H�7d���]?�nS��![�,^VQ�?���\0䴫�4	�\'�۔�����M^O�~�Bp\0P���6��,A֥#u/�uvè�Q��1S��U-�,\0z\0o�<7,�e�k�]\\��E�vy����%�K�D�A�m����%f�,�dY�-JV79�.�Q>��.��.�������0.���c���ۖ\\@�?1H�Aџq�7t�U�-$Ta�,е���\\\0掖=h�9l��#�{�4��k��b�G0/�	���}@�z�v���n�qU��7���\'A����F����G�]H�+�LP��Y��8����A%��]�1v��!� ����H��~�{�RRw�063�Y����%*\ns�^8�*���(XO�9GS�b>\"=�i�9̾��E�CG�Q�Kn�L��8�2������<���x�$r�J\0�\0���[ph��wn��_�\nF����jZ��.�0��b5��pgf�ۀ�\"���D�\0�M�QY�YU*��3g��c+Ơ�ns.�BX��h��ED;�҄Y���8��A��5\\�o(�e>�wN�0\\[����|���j\"\n���7�8�u��f<\\,]�3�6��v�x�({�r�u)��z�Jbj�*9̾\"ļ��,�⻹dy�\0��)��<K�y���5�0b_�0�-��N��&�d�/��s�KǙC�3]Ʒ%Jթ��%{���1\0�/u�\n��qPs��ALJ�\0��5��X�9^�|��h�J��YN�J�Cpy�t̕�7	��8J�-^e�������Y�-�f]���,0/2�X�\nԬ���x�������.�+Gd��B�Q\n�,�h�XB�QK�ŝ�>]N*ľ���68�M|\nb�*��/�x���%�1x��R��Ȧ�탈e�	��\"ir�4fĠ	���`���ITY��V��ǻ��z��g�B^忙j�3���aK؀4i��YΥL~c���=��h|LVq(�R���W��øe#+��9� ��\'����\'���TZ��1��r���\0�ԓut��M����\0�j#�D����\0�č�\0��� dp�8��<}/�V��̸��G��t���f\'\0y�\0tu}�i-��)��?�8l�����","1805","2020-09-25","2020-09-26","jpg","justificativo.jpg");





CREATE TABLE `justificativoasistenciadia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asistenciaDia_id` int(11) DEFAULT NULL,
  `justificativo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKsdpoolygcb0uadr6goyeodvow` (`asistenciaDia_id`),
  KEY `FKcosqyw65g6la8dfcvaonnx3j9` (`justificativo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

INSERT INTO justificativoasistenciadia VALUES("22","638","13");





CREATE TABLE `materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaAltaMateria` date DEFAULT NULL,
  `fechaBajaMateria` date DEFAULT NULL,
  `nivelMateria` int(11) NOT NULL,
  `nombreMateria` varchar(255) DEFAULT NULL,
  `cargaHorariaMateria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

INSERT INTO materia VALUES("4","2020-08-23","","1","Lengua","16");
INSERT INTO materia VALUES("5","2020-08-23","","2","Lengua","");
INSERT INTO materia VALUES("6","2020-09-01","","1","Matemática","8");
INSERT INTO materia VALUES("7","2020-09-05","","2","Matemática","36");
INSERT INTO materia VALUES("8","2020-09-21","","3","Matemática","6");
INSERT INTO materia VALUES("9","2020-09-21","","1","Biología","8");
INSERT INTO materia VALUES("10","2020-09-22","","3","Ciencias Sociales","6");





CREATE TABLE `modalidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaAltaModalidad` date DEFAULT NULL,
  `fechaBajaModalidad` date DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO modalidad VALUES("1","2020-07-31","","Sistemas");
INSERT INTO modalidad VALUES("2","2020-08-27","","Enonomia");
INSERT INTO modalidad VALUES("3","2020-09-01","","Humanidades");





CREATE TABLE `notificacionprofe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asunto` varchar(255) DEFAULT NULL,
  `fechaHoraNotif` datetime DEFAULT NULL,
  `mensaje` varchar(255) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `profesor_id` int(11) DEFAULT NULL,
  `fechaDesdeNotificacionProfe` date NOT NULL,
  `fechaHastaNotificacionProfe` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKr8sm4xvbauo615nevjvo6ak7t` (`curso_id`),
  KEY `FK8q19xnfemjpbhl93ueu21fr4g` (`profesor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

INSERT INTO notificacionprofe VALUES("4","Mensaje prueba","2020-09-22 18:18:24","mensaje de prueba demo","25","238","0000-00-00","0000-00-00");
INSERT INTO notificacionprofe VALUES("5","Bienvenidos a Lengua ","2020-09-23 20:48:46","El día lunes tendremos la primer clase saludos ","18","226","0000-00-00","0000-00-00");
INSERT INTO notificacionprofe VALUES("6","Mensaje prueba","2020-09-24 21:22:56","Buen comienzo de cursado ","20","238","0000-00-00","0000-00-00");
INSERT INTO notificacionprofe VALUES("7","Evaluacion dia 01/10","2020-09-28 08:08:52","Recuerden que el dia 01/01/2020, tendremos la primera evaluación parcial que incluye los temas vistos hasta la semana pasada.\n\nSaludos \nSamantha ","20","238","0000-00-00","0000-00-00");





CREATE TABLE `parametrolegajo` (
  `id` int(11) NOT NULL,
  `esDNI` int(1) NOT NULL,
  `tieneLetras` int(1) NOT NULL,
  `cantLetras` int(11) NOT NULL,
  `tieneNumeros` tinyint(1) NOT NULL,
  `cantNumeros` int(11) NOT NULL,
  `cantTotalCaracteres` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO parametrolegajo VALUES("1","0","1","2","1","5","7");





CREATE TABLE `paramminimoasistencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaAltaMinimoAsistencia` date DEFAULT NULL,
  `fechaBajaMinimoAsistencia` date DEFAULT NULL,
  `porcentajeAsistencia` float DEFAULT NULL,
  `cursoEstadoAlumno_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKdsdauip557b770enom24gw1h8` (`cursoEstadoAlumno_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO paramminimoasistencia VALUES("2","2020-09-13","","0.85","");





CREATE TABLE `permiso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaDesdePer` date DEFAULT NULL,
  `fechaHastaPer` date DEFAULT NULL,
  `nombrePermiso` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO permiso VALUES("1","2020-07-30","","ALUMNO");
INSERT INTO permiso VALUES("2","2020-07-30","","DOCENTE");
INSERT INTO permiso VALUES("3","2020-07-30","","ADMINISTRADOR");





CREATE TABLE `profesor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apellidoProf` varchar(255) DEFAULT NULL,
  `contraseniaProf` varchar(255) DEFAULT NULL,
  `dniProf` int(11) NOT NULL,
  `emailProf` varchar(255) DEFAULT NULL,
  `fechaAltaProf` date DEFAULT NULL,
  `fechaBajaProf` date DEFAULT NULL,
  `fechaNacProf` date DEFAULT NULL,
  `legajoProf` varchar(255) NOT NULL,
  `nombreProf` varchar(255) DEFAULT NULL,
  `permiso_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK62q9qdgk50ph2cra8pt464rpp` (`permiso_id`)
) ENGINE=MyISAM AUTO_INCREMENT=288 DEFAULT CHARSET=utf8mb4;

INSERT INTO profesor VALUES("232","Barnes","","14467596","","2020-09-20","","","PR90006","Daria","2");
INSERT INTO profesor VALUES("233","Barry","","11537358","","2020-09-20","","","PR90007","Vance","2");
INSERT INTO profesor VALUES("231","Barlow","","20684890","","2020-09-20","","","PR90005","Nash","2");
INSERT INTO profesor VALUES("228","Andrews","","11700237","","2020-09-20","","","PR90002","Arden","2");
INSERT INTO profesor VALUES("229","Anthony","","16529441","","2020-09-20","","","PR90003","Faith","2");
INSERT INTO profesor VALUES("270","Higgins","","20557761","","2020-09-20","","","PR90044","Shad","2");
INSERT INTO profesor VALUES("269","Herman","","17350654","","2020-09-20","","","PR90043","Pearl","2");
INSERT INTO profesor VALUES("268","Hatfield","","10462925","","2020-09-20","","","PR90042","Kasimir","2");
INSERT INTO profesor VALUES("267","Hartman","","21185275","","2020-09-20","","","PR90041","Darrel","2");
INSERT INTO profesor VALUES("266","Hardy","","21262344","","2020-09-20","","","PR90040","Lars","2");
INSERT INTO profesor VALUES("265","Griffin","","23432540","","2020-09-20","","","PR90039","Jaquelyn","2");
INSERT INTO profesor VALUES("264","Good","","23523841","","2020-09-20","","","PR90038","Hayley","2");
INSERT INTO profesor VALUES("263","Gentry","","19947972","","2020-09-20","","","PR90037","Anastasia","2");
INSERT INTO profesor VALUES("262","Franco","","23803239","","2020-09-20","","","PR90036","Prescott","2");
INSERT INTO profesor VALUES("261","Foreman","","19085599","","2020-09-20","","","PR90035","Oliver","2");
INSERT INTO profesor VALUES("260","Fisher","","20574466","","2020-09-20","","","PR90034","Emmanuel","2");
INSERT INTO profesor VALUES("259","Fields","","20752043","","2020-09-20","","","PR90033","Ivana","2");
INSERT INTO profesor VALUES("258","Farley","","20318629","","2020-09-20","","","PR90032","Madonna","2");
INSERT INTO profesor VALUES("257","Drake","","14628685","","2020-09-20","","","PR90031","Hilda","2");
INSERT INTO profesor VALUES("256","Doyle","","13667844","","2020-09-20","","","PR90030","Rashad","2");
INSERT INTO profesor VALUES("255","Daniels","","24602983","","2020-09-20","","","PR90029","Nicole","2");
INSERT INTO profesor VALUES("254","Crane","","24842771","","2020-09-20","","","PR90028","Drake","2");
INSERT INTO profesor VALUES("253","Cotton","","20277607","","2020-09-20","","","PR90027","Savannah","2");
INSERT INTO profesor VALUES("252","Cortez","","12921202","","2020-09-20","","","PR90026","Nadine","2");
INSERT INTO profesor VALUES("251","Collins","","16572676","","2020-09-20","","","PR90025","Price","2");
INSERT INTO profesor VALUES("250","Clarke","","10725176","","2020-09-20","","","PR90024","Hedley","2");
INSERT INTO profesor VALUES("249","Chambers","","11080178","","2020-09-20","","","PR90023","Owen","2");
INSERT INTO profesor VALUES("248","Cervantes","","13206018","","2020-09-20","","","PR90022","Fuller","2");
INSERT INTO profesor VALUES("247","Carlson","","19247224","","2020-09-20","","","PR90021","Garrett","2");
INSERT INTO profesor VALUES("246","Cameron","","24904907","","2020-09-20","","","PR90020","Elvis","2");
INSERT INTO profesor VALUES("245","Bullock","","17032877","","2020-09-20","","","PR90019","Gail","2");
INSERT INTO profesor VALUES("244","Buchanan","","19763883","","2020-09-20","","","PR90018","Abigail","2");
INSERT INTO profesor VALUES("243","Bruce","","14187665","","2020-09-20","","","PR90017","Louis","2");
INSERT INTO profesor VALUES("242","Brown","","15583560","","2020-09-20","","","PR90016","Boris","2");
INSERT INTO profesor VALUES("241","Brooks","","15630879","","2020-09-20","","","PR90015","Ian","2");
INSERT INTO profesor VALUES("240","Bray","","23758230","","2020-09-20","","","PR90014","Drake","2");
INSERT INTO profesor VALUES("239","Brady","","24306617","","2020-09-20","","","PR90013","Lenore","2");
INSERT INTO profesor VALUES("238","Bradshaw","$2y$10$Wmo5Ss7YxiLrTHksBg9rHuY.GfnjicERCIFYdx92eB3Uuf622HeYi","15151583","sbrad@mail.com","2020-09-20","","1987-02-21","PR90012","Samantha","2");
INSERT INTO profesor VALUES("237","Bradford","","24157590","","2020-09-20","","","PR90011","Kathleen","2");
INSERT INTO profesor VALUES("236","Bond","","12618030","","2020-09-20","","","PR90010","Giselle","2");
INSERT INTO profesor VALUES("235","Beard","","19617326","","2020-09-20","","","PR90009","Brock","2");
INSERT INTO profesor VALUES("234","Bauer","","20609060","","2020-09-20","","","PR90008","Len","2");
INSERT INTO profesor VALUES("230","Ballard","","21669268","","2020-09-20","","","PR90004","Petra","2");
INSERT INTO profesor VALUES("226","Aguirre","$2y$10$jUZsqLYkV4YVGB0vVPo9/uDZ0jpKMSOjxIvEjFHDqR1kJ1tWo8v66","14248800","cobyaguirre@mail.com","2020-09-20","","1960-11-18","PR90000","Coby","2");
INSERT INTO profesor VALUES("227","Alvarado","","23234845","","2020-09-20","","","PR90001","Rana","2");
INSERT INTO profesor VALUES("271","Higgins","","11546781","","2020-09-20","","","PR90045","Kalia","2");
INSERT INTO profesor VALUES("272","Hogan","","18531701","","2020-09-20","","","PR90046","Sydnee","2");
INSERT INTO profesor VALUES("273","Holcomb","","15395201","","2020-09-20","","","PR90047","Anastasia","2");
INSERT INTO profesor VALUES("274","Hood","","16763857","","2020-09-20","","","PR90048","Uriah","2");
INSERT INTO profesor VALUES("275","Hopkins","","10892106","","2020-09-20","","","PR90049","Fritz","2");
INSERT INTO profesor VALUES("276","Hubbard","","22865049","","2020-09-20","","","PR90050","Wendy","2");
INSERT INTO profesor VALUES("277","Huffman","","20484134","","2020-09-20","","","PR90051","Bradley","2");
INSERT INTO profesor VALUES("278","Hutchinson","","15838695","","2020-09-20","","","PR90052","Jolie","2");
INSERT INTO profesor VALUES("279","Hyde","","12406334","","2020-09-20","","","PR90053","Warren","2");
INSERT INTO profesor VALUES("280","Jefferson","","16737751","","2020-09-20","","","PR90054","Deborah","2");
INSERT INTO profesor VALUES("281","Johnson","","12809807","","2020-09-20","","","PR90055","Gavin","2");
INSERT INTO profesor VALUES("282","Kaufman","","11865383","","2020-09-20","","","PR90056","Dieter","2");
INSERT INTO profesor VALUES("283","Kent","","18306692","","2020-09-20","","","PR90057","Blaze","2");
INSERT INTO profesor VALUES("284","Kinney","","12295784","","2020-09-20","","","PR90058","Colleen","2");
INSERT INTO profesor VALUES("285","Klein","","11858591","","2020-09-20","","","PR90059","Emi","2");
INSERT INTO profesor VALUES("286","Knapp","","19115260","","2020-09-20","","","PR90060","Lillith","2");
INSERT INTO profesor VALUES("287","Knapp","","19110060","","2020-09-30","2020-09-30","","PR90069","Lillith","2");





CREATE TABLE `programamateria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anioPrograma` int(11) NOT NULL,
  `descripcionPrograma` varchar(255) DEFAULT NULL,
  `fechaHastaPrograma` date DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  `fechaDesdePrograma` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKfqb3t1us027qjp8jctlqi46ui` (`materia_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

INSERT INTO programamateria VALUES("17","2020","Programa Biología 1","2020-09-24","9","2020-09-24");
INSERT INTO programamateria VALUES("16","2020","Programa Biología 1","2020-09-24","9","2020-09-24");
INSERT INTO programamateria VALUES("15","2020","Programa Biología 1","2020-09-24","9","2020-09-24");
INSERT INTO programamateria VALUES("14","2020","Programa Matematica 1","","6","2020-09-23");
INSERT INTO programamateria VALUES("13","2020","Programa Lengua 1","","4","2020-09-20");
INSERT INTO programamateria VALUES("18","2020","Programa Biología 1","2020-09-24","9","2020-09-24");
INSERT INTO programamateria VALUES("19","2020","Programa Biología 1","2020-09-24","9","2020-09-24");
INSERT INTO programamateria VALUES("20","2020","Programa Biología 1","2020-09-24","9","2020-09-24");
INSERT INTO programamateria VALUES("21","2020","Programa Biología 1","2020-09-24","9","2020-09-24");
INSERT INTO programamateria VALUES("22","2020","Programa Biología 1","2020-09-24","9","2020-09-24");
INSERT INTO programamateria VALUES("23","2020","Programa Biología 1","","9","2020-09-24");





CREATE TABLE `temadia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comentarioTema` varchar(255) DEFAULT NULL,
  `fechaTemaDia` datetime DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `temasMateria_id` int(11) DEFAULT NULL,
  `profesor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKjpsvm6kadspqw0h80983xg4er` (`curso_id`),
  KEY `FKlrpqrs0v24025xc081vf16dh1` (`temasMateria_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

INSERT INTO temadia VALUES("8","Explicación y ejemplos, páginas 80 a 90 del libro.","2020-09-21 00:00:00","18","132","226");
INSERT INTO temadia VALUES("9","Paginas 99 a 120 del libro de texto de la materia.\nFalta explicar página 119 a 120.","2020-09-21 00:00:00","18","133","226");
INSERT INTO temadia VALUES("10","solo primeros conceptos","2020-09-23 00:00:00","20","153","238");
INSERT INTO temadia VALUES("11","Primera clase explicación muy general, no profundice mucho","2020-09-24 19:58:52","25","194","238");
INSERT INTO temadia VALUES("12","","2020-09-27 12:54:25","18","136","226");
INSERT INTO temadia VALUES("13","se da el tema completo ","2020-09-28 08:07:00","20","153","238");
INSERT INTO temadia VALUES("14","trabajo practico Nro 1, para hacer ","2020-09-28 08:07:21","20","158","238");
INSERT INTO temadia VALUES("15","","2020-10-01 16:59:32","18","137","226");
INSERT INTO temadia VALUES("16","","2020-10-02 08:09:33","25","194","238");





CREATE TABLE `temasmateria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombreTema` varchar(255) DEFAULT NULL,
  `programaMateria_id` int(11) DEFAULT NULL,
  `unidadTema` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK23mxrw3xvlmkaiyy284c4r0w7` (`programaMateria_id`)
) ENGINE=MyISAM AUTO_INCREMENT=210 DEFAULT CHARSET=utf8mb4;

INSERT INTO temasmateria VALUES("155","Racionalización de denominadores.","14","1");
INSERT INTO temasmateria VALUES("153","Números irracionales.","14","1");
INSERT INTO temasmateria VALUES("154","Radicales. Concepto y representación.","14","1");
INSERT INTO temasmateria VALUES("152","Recreación de los mitos en el género narrativo: la novela.","13","6");
INSERT INTO temasmateria VALUES("151","Mitos argentinos. Valoreación de los mismos. Interpretación . Autores.","13","6");
INSERT INTO temasmateria VALUES("150","Mitos. Definición. Características.","13","6");
INSERT INTO temasmateria VALUES("149","Contexto histórico-social.","13","5");
INSERT INTO temasmateria VALUES("134","Tipologías textuales. Trama descriptiva, narrativa, explicativa, argumentativa y conversacional.","13","1");
INSERT INTO temasmateria VALUES("135","La literatura, tragedia, orígen. Historias trágicas. Características.","13","1");
INSERT INTO temasmateria VALUES("136","El cuento. Características. Esquema básico. Secuencia narrativa.","13","2");
INSERT INTO temasmateria VALUES("137","Reseña literaria. Recursos.","13","2");
INSERT INTO temasmateria VALUES("138","Subjetivemas. Tesis y argumentos.","13","2");
INSERT INTO temasmateria VALUES("139","Literatura precolombina, los mayas. Leyendas y mitos de sus orígenes.","13","3");
INSERT INTO temasmateria VALUES("140","Los mayas como civilización. Elementos mitológicos.","13","3");
INSERT INTO temasmateria VALUES("141","La creación de los hombres.","13","3");
INSERT INTO temasmateria VALUES("142","Lenguaje utilizados.","13","3");
INSERT INTO temasmateria VALUES("143","Lecturas comparadas de otras civilizaciones.","13","3");
INSERT INTO temasmateria VALUES("144","Género lírico. Estructura. Verso y estrofa. Ritma y métrica.","13","4");
INSERT INTO temasmateria VALUES("145","Epica española. Temas. El héroe. Cantares de gesta. Creación de la prosa romance.","13","4");
INSERT INTO temasmateria VALUES("146","Tragedia española.","13","5");
INSERT INTO temasmateria VALUES("147","Carácteristicas.","13","5");
INSERT INTO temasmateria VALUES("148","Autores destacados. La mirada trágica en el texto dramático.","13","5");
INSERT INTO temasmateria VALUES("133","Linealidad y complejidad de los textos. Elipsis. Sustitución pronominal y sinomia. Uso de conectores.","13","1");
INSERT INTO temasmateria VALUES("132","Coherencia y cohesión.","13","1");
INSERT INTO temasmateria VALUES("156","Propiedades de la potenciación y radicación en R.","14","1");
INSERT INTO temasmateria VALUES("157","Operaciones combinadas.","14","1");
INSERT INTO temasmateria VALUES("158","Regularidades numéricas y sucesiones.","14","2");
INSERT INTO temasmateria VALUES("159","Concepto, notación y lenguaje.","14","2");
INSERT INTO temasmateria VALUES("160","Sucesiones en el mundo real.","14","2");
INSERT INTO temasmateria VALUES("161","Semejanza de figuras planas.","14","3");
INSERT INTO temasmateria VALUES("162","Teorema de Thales.","14","3");
INSERT INTO temasmateria VALUES("163","Razones trigonométricas de un triángulo rectángulo.","14","3");
INSERT INTO temasmateria VALUES("164","Uso de la calculadora. ","14","3");
INSERT INTO temasmateria VALUES("165","Teorema del seno y del coseno.","14","3");
INSERT INTO temasmateria VALUES("166","Resolución de triángulos rectángulos y oblicuángulos.","14","3");
INSERT INTO temasmateria VALUES("167","Relaciones entre razones trigonométricas.","14","3");
INSERT INTO temasmateria VALUES("168","Resolución de problemas.","14","3");
INSERT INTO temasmateria VALUES("169","Concepto de funciones.","14","4");
INSERT INTO temasmateria VALUES("170","Lectura de gráficos y dominio.","14","4");
INSERT INTO temasmateria VALUES("171","Funciones cuadráticas.","14","4");
INSERT INTO temasmateria VALUES("172","Cálculo de ceros o raíces.","14","4");
INSERT INTO temasmateria VALUES("173","Gráfica de la parábola.","14","4");
INSERT INTO temasmateria VALUES("174","Intervalos de crecimiento y decrecimiento.","14","4");
INSERT INTO temasmateria VALUES("175","Conjunto de positividad y negatividad.","14","4");
INSERT INTO temasmateria VALUES("176","Ecuación polinómica, canónica y factorizada.","14","4");
INSERT INTO temasmateria VALUES("177","Ecuaciones e inecuaciones.","14","4");
INSERT INTO temasmateria VALUES("178","Sistemas de ecuaciones.","14","4");
INSERT INTO temasmateria VALUES("179","Polinomios.","14","5");
INSERT INTO temasmateria VALUES("180","Operaciones con polinomios.","14","5");
INSERT INTO temasmateria VALUES("181","Regla de Ruffini.","14","5");
INSERT INTO temasmateria VALUES("182","Teorema del resto.","14","5");
INSERT INTO temasmateria VALUES("183","Factorización de polinomios.","14","5");
INSERT INTO temasmateria VALUES("184","Teorema de Gauss.","14","5");
INSERT INTO temasmateria VALUES("185","Casos combinados.","14","5");
INSERT INTO temasmateria VALUES("186","Simplificación.","14","5");
INSERT INTO temasmateria VALUES("187","Combinatoria.","14","6");
INSERT INTO temasmateria VALUES("188","Binomio de Newton.","14","6");
INSERT INTO temasmateria VALUES("189","Probabilidad.","14","6");
INSERT INTO temasmateria VALUES("190","Espacio muestral.","14","6");
INSERT INTO temasmateria VALUES("191","Sucesos incompatibles e independientes.","14","6");
INSERT INTO temasmateria VALUES("192","Probabilidad condicional","14","6");
INSERT INTO temasmateria VALUES("193","Uso de calculadoras.","14","6");
INSERT INTO temasmateria VALUES("194","Caracterización de los seres vivos según criterios de organización, metabolismo y perpetuación","23","1");
INSERT INTO temasmateria VALUES("195","Unidad y diversidad de funciones y estructuras.","23","1");
INSERT INTO temasmateria VALUES("196"," La composición de los organismos.","23","2");
INSERT INTO temasmateria VALUES("197"," La obtención de materiales que aportan materia y energía a los seres vivos.","23","2");
INSERT INTO temasmateria VALUES("198","El ecosistema como modelo de estudio.","23","3");
INSERT INTO temasmateria VALUES("199","Estructura del ecosistema.","23","3");
INSERT INTO temasmateria VALUES("200","Interacciones en el ecosistema.","23","3");
INSERT INTO temasmateria VALUES("201","Ciclos de la materia y flujos de energía.","23","3");
INSERT INTO temasmateria VALUES("202","Cambios en los ecosistemas.","23","3");
INSERT INTO temasmateria VALUES("203","El origen de la vida según la concepción actual.","23","4");
INSERT INTO temasmateria VALUES("204","Aparición de las primeras células: metabolismo y reproducción.","23","4");
INSERT INTO temasmateria VALUES("205","Los seres vivos después del origen: todo ser vivo proviene de otro ser vivo.","23","4");
INSERT INTO temasmateria VALUES("206","Células vegetales y células animales","23","5");
INSERT INTO temasmateria VALUES("207","La nutrición en el nivel celular: localización de los procesos de endocitosis, fotosíntesis y respiración celular.","23","5");
INSERT INTO temasmateria VALUES("208","Unidad y diversidad de funciones y estructuras.","23","6");
INSERT INTO temasmateria VALUES("209","La diversidad biológica como consecuencia de la evolución.","23","6");





CREATE TABLE `tiempolimitecodigo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `minutosLimite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO tiempolimitecodigo VALUES("5","25");





CREATE TABLE `tipoasistencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaAltaTipoAsistencia` date DEFAULT NULL,
  `fechaBajaTipoAsistencia` date DEFAULT NULL,
  `nombreTipoAsistencia` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO tipoasistencia VALUES("1","2020-08-03","","PRESENTE");
INSERT INTO tipoasistencia VALUES("2","2020-08-03","","AUSENTE");
INSERT INTO tipoasistencia VALUES("3","2020-09-01","","JUSTIFICADO");





CREATE TABLE `vigenciasesion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `duracionSesion` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;




