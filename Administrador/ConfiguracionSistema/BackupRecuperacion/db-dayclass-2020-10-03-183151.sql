

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

INSERT INTO justificativo VALUES("13","1","se acepta por pandemia ","2020-09-28","2020-09-28 08:35:44","����\0JFIF\0\0\0\0\0\0��\0C\0	!\"$\"$��\0C��\0�-\"\0��\0\0\0\0\0\0\0\0\0\0\0\0\0\0��\0\0\0\0\0\0\0\0\0\0\0\0\0��\0\0\0\0��g�Л2N@��
�m�fڵ��t�!z[j\\6�y���M�d=S\0�7�Mp3yj��jK�ة���b��U$\\�w�e\0X���ċJ����)�j�	\'�5��O�#��Vx�=R���92wSt ������+�:���]Ϲ�O#el�\0A�l��/����ǁ*�l���3�1�c���/&���#]	��	�1gr��h7��o7�D��b�





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
INSERT INTO notificacionprofe VALUES("7","Evaluacion dia 01/10","2020-09-28 08:08:52","Recuerden que el dia 01/01/2020, tendremos la primera evaluación parcial que incluye los temas vistos hasta la semana pasada.





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
INSERT INTO temadia VALUES("9","Paginas 99 a 120 del libro de texto de la materia.
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



