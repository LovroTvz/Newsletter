-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 06:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newsletter`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(225) NOT NULL,
  `date_creation` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `date_creation`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$oPizAYPy2VjR2tz4K7txxeOdDOn.EuLahW0RV1vQ/5XmcTwQ5Hzj6', '2024-06-12'),
(2, 'Matija Cmok', 'matija@gmail.com', '$2y$10$MUS8xY63868Dd9kZLVRCuuO8a0ggOuwvFRs9ZCqtUxKxxGJ7QC8Mu', '2024-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) NOT NULL,
  `title` varchar(225) NOT NULL,
  `excerpt` tinytext NOT NULL,
  `content` text NOT NULL,
  `author` varchar(120) NOT NULL,
  `publish_date` date NOT NULL DEFAULT current_timestamp(),
  `pictures` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `excerpt`, `content`, `author`, `publish_date`, `pictures`) VALUES
(1, 'Premijer Plenković o prosvjedu ‘teta‘ u dječjem vrtiću u Biogradu: ‘Slažem se s vama, naći ćemo rješenje‘', 'Premijer Andrej Plenković, odgovarajući na pitanja oporbe tijekom saborskog \"aktualca\", pohvalio se najnižom stopom inflacije u svibnju od rujna 2021., ulaganjima u predškolske i školske institucije, a govoreći o prosvjedu odgojiteljica u Biogradu.', 'Premijer Andrej Plenković, odgovarajući na pitanja oporbe tijekom saborskog \"aktualca\", pohvalio se najnižom stopom inflacije u svibnju od rujna 2021., ulaganjima u predškolske i školske institucije, a govoreći o prosvjedu odgojiteljica u Biogradu kazao je kako će se naći rješenje.\r\n\r\nDodao je kako je sa situacijom u Biogradu upoznat.\r\n\r\n\"Ja sam s njima razgovarao, one nisu jedine, situacija je slična u Slunju, Vrsaru, imamo situacije gdje neki lokalni čelnici nisu dogovorili ugovor koji bi im povećao plaću, ministar Radovan Fuchs itekako zna za to, mi ćemo nastojati pronaći rješenje\", rekao je premijer.\r\n\r\nVlada, istaknuo je, već sada intervenira i daje dodatna sredstva onim lokalnim jedinicama koje nemaju dovoljno sredstava za funkcioniranje vrtića.\r\n\r\n\"Moje poštovanje odgojiteljicama, slažem se s vama i naći ćemo rješenje\", ponovio je premijer Plenković.', 'Mate', '2024-06-12', 'plenki.jpg'),
(3, 'Čistoća i Zadarski azil pokreću akciju za potrebe četveronožnih štićenika, evo kako im možete pomoći...', 'Komunalna tvrtka Čistoća u suradnji sa Zadarskim azilom, organizira prikupljanje otpadnog tekstila za potrebe štićenika Azila.', 'Komunalna tvrtka Čistoća u suradnji sa Zadarskim azilom, organizira prikupljanje otpadnog tekstila za potrebe štićenika Azila. Ako imate deke, plahte, tapetiće, ručnike, krpe koje vama više ne trebaju, odvojite ih za one kojima su itekako potrebni, pomozite im i razveselite ih. Njuškice će vam biti zahvalne!\r\n\r\nU razdoblju od 14. do 30. lipnja 2024. samo za njih u reciklažnom dvorištu u Gaženici bit će postavljen spremnik u koji možete donijeti i odložiti navedene, potrebne stvari.\r\n\r\nPomozimo im zajedno da im u njihovom privremenom domu bude ugodno i udobno, zadovoljstvo će biti obostrano.\r\n\r\nI unaprijed veliko vau-vau hvala!\r\n\r\n„Kako odrastate, otkrit ćete da imate dvije ruke: jednu da pomognete sebi, a drugu da pomognete drugima.“  \r\n\r\nAudrey Hepburn', 'Admin', '2024-06-13', 'puppies.webp'),
(4, 'Nepalac Anjaya T., iz Udayapura, s prebivalištem u Dicmu, osuđen na uvjetnu zatvorsku kaznu: u Obrovcu sletio sa mosta na rivu!', 'Na uvjetnu kaznu zatvora s rokom kušnje od dvije godine osuđen je na Općinskom sudu u Zadru 39-godišnji Nepalac Anjaya T.', 'Na uvjetnu kaznu zatvora s rokom kušnje od dvije godine osuđen je na Općinskom sudu u Zadru 39-godišnji Nepalac Anjaya T., iz Udayapura, s prebivalištem u Dicmu, nakon što je prošle godine u Obrovcu sletio sa mosta na betoniranu rivu sa južne strane rijeke Zrmanje.\r\n\r\nNesreća se odigrala 31. listopada 2023. godine u 6,29 sati, na mostu preko rijeke Zrmanje, kada je Anjaya upravljao osobnim vozilom marke Opel tip Vivaro. U optužnici Općinskog državnog odvjetništva u Zadru se navodi kako je  Anjaya lakomisleno u uvjetima mokrog kolnika od kiše, upravljao brzinom od 44 km/h koja nije bila prilagođena uvjetima na cesti, nesvjestan činjenice da se približava oštrom desnom zavoju.\r\n\r\nZbog toga je na križanju Jadranske ulice i ulice Obala Hrvatskog časnika Senada Župana, izgubio nadzor i udario u rub podignutog asfaltiranog nogostupa, a potom i u zaštitnu ogradu mosta koja se od siline udara slomila, pa je automobil sletio sa mosta na betoniranu rivu sa južne strane rijeke Zrmanje,\r\n\r\nU nesreći je njegov suvozač Tilak B. B. zadobio prijelom rebara.\r\n\r\nAnjaya T je optužen za kazneno djelo protiv sigurnosti prometa – izazivanje prometne nesreće da je iz nehaja izazvao opasnost za život ili tijelo ljudi, a kaznenim djelom je prouzročio tešku tjelesnu ozljedu druge osobe.\r\n\r\nU postupku je utvrđeno kako, bez obzira na činjenicu da se Anjaya T. branio šutnjom, iz nalaza provedenog kombiniranog prometnog i sudsko medicinskog vještačenja jasno proizlazi kako je upravljao brzinom koja nije bila prilagođena uvjetima na cesti. Zbog toga je prilikom ulaska u oštri desni zavoj došlo do destabilizacije njegovog vozila, a što je vještak prometne struke naveo kao razlog nastanka ove prometne nesreće budući da je okrivljenik mogao izbjeći nastanak ove prometne nesreće da se kretao brzinom ne većom od 21 km/h, čime bi ova prometna nesreća bila izbjegnuta.', 'Matija Cmok', '2024-06-13', 'Jump.webp'),
(5, 'Isplati li se zadarskim studentima rad preko student servisa ili \"na crno\"? Pitali smo studente i napravili računicu, evo što je bolje...', 'Prošloga ljeta radio sam u jednoj trgovini odjeće u Supernova centru. Zaradio sam malo manje od 400 eura kroz mjesec i pol -kaže nam jedan zadarski student.', 'Prošloga ljeta radio sam u jednoj trgovini odjeće u Supernova centru. Zaradio sam malo manje od 400 eura kroz mjesec i pol -kaže nam jedan zadarski student.\r\n\r\nDoduše, ovaj student je dao prioritet učenju za rok u kolovozu i rujnu pa nije radio u smjeni od 8 sati 6 dana u tjednu, no i za smjene od 6 sati, ovo djeluje vrlo malo.\r\n\r\n- Nemam automobil, a uz troškove javnog prijevoza do Supernove, pa kupovine marende, koja je najčešće bila energetska pločica, nije mi se uopće isplatilo. S druge strane, u istom tom periodu kad god bih uhvatio vremena, iskoristio bih priliku da odradim fizičke poslove također preko student servisa i za dva sata bih zaradio jednako ili više od onoga koliko bih zaradio tamo... Firma za koju sam odrađivao fizičke poslove jest gradska firma, ali svejedno, kad se usporedi, nema puno smisla... - poručuje.\r\n\r\nOd otprilike 5500 studenata na Sveučilištu u Zadru, usluge student servisa trenutno koristi njih 1650, što je oko 30 posto ukupnog broja studenata. S obzirom na prošlogodišnje rezultate, broj studenata zainteresiranih za rad preko sveučilišnog servisa mogao bi se udvostručiti s istekom tekuće godine.', 'Matija Cmok', '2024-06-13', 'zadar.jpg'),
(6, 'Prvi put u Ninu održano natjecanje u pripremi peke! Bilo je teletine i janjetine, ali i bakalara, prisnaca, fažola, pizza... Evo najboljih!', ' Twitter Ispis  Prošlog vikenda u centru Nina održalo se zanimljivo događanje u okviru obilježavanja Dana grada Nina. Za zadnji dan programa organizirana je po prvi put gastro manifestacija “Ninska peka od Liburna do danas”.', 'Prošlog vikenda u centru Nina održalo se zanimljivo događanje u okviru obilježavanja Dana grada Nina. Za zadnji dan programa organizirana je po prvi put gastro manifestacija “Ninska peka od Liburna do danas”. \r\n\r\nU sklopu projekta “Local2local” iz Programa ruralnog razvoja, a koji traje do lipnja 2025. godine, partner u organizaciji događaja LAG Mareta je priskrbila 15 peka s ložištima i ostalom opremom.\r\n\r\nGrad Nin se potrudio priskrbiti natjecateljima sve ostalo potrebno za pripremu jela. Pripremala su se razna jela pod pekom kao što su tradicionalne teletina i janjetina, ali je bilo i bakalara, prisnaca, fažola, pizza i pogača. Uz natjecatelje posjetitelji su mogli okusiti lokalne proizvode prezentirane na pet štandova (slastice, vina i likere).\r\n\r\nKomisija za ocijenjivanje peka su bili posjetitelji koji su se javili za tu ulogu. Svi natjecatelji su dobili poklon pakete s lokalnim proizvodima, a tri najbolje ocijenjena natjecatelja su dobila i novčane nagrade.\r\n\r\nTreće mjesto je pripalo vinariji Poljak, ekipa LAG-a Marinianis je osvojila visoko drugo mjesto, dok je prvo mjesto pripalo udruzi žena “Aenona” iz Nina.\r\n\r\nDogađaj je bio popraćen nastupom grupe Arta, klape Condura i za kraj velikim koncertom Dražena Zečića i benda Banana.', 'Admin', '2024-06-13', 'Bakalar.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `aboutUs` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`aboutUs`) VALUES
('Pozdrav, ova stranica je nastala kao projekt za predmet \"Programiranje web aplikacija\". Obuhvaća osnovne koncepte PHP-a, javascripta i validacije formi te interakcije s bazom.Korištena je PDO veza za spajanje na bazu, a na samim upitima u bazu su provedene SQL injection zaštite. ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
