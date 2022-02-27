-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2017 at 01:38 PM
-- Server version: 5.5.36
-- PHP Version: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `medsilo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(6) NOT NULL,
  `username` varchar(225) CHARACTER SET latin1 NOT NULL,
  `password` varchar(512) CHARACTER SET latin1 NOT NULL,
  `nowlog` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastlog` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `nowlog`, `lastlog`, `created`) VALUES
(466308, 'medsilo', '7a31292f48a8255a1881d71e79b4e5c2', '2017-08-17 08:42:52', '2017-08-01 08:02:21', '2014-08-17 08:01:28');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `catid` int(6) NOT NULL,
  `category` varchar(128) CHARACTER SET latin1 NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catid`, `category`, `added`) VALUES
(177038, 'Anti-Allergics / Anti-Cough', '2016-06-08 17:00:54'),
(184022, 'Nutritional / Supplements', '2016-06-08 17:01:42'),
(198710, 'Antihelmintics', '2016-06-08 17:01:22'),
(303029, 'Antibiotics', '2016-06-08 16:59:35'),
(787041, 'Analgesic / Anti-Inflammatory', '2016-06-08 17:00:06'),
(823035, 'G.I.T', '2016-06-08 17:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE IF NOT EXISTS `enquiries` (
  `eid` int(6) NOT NULL,
  `ename` varchar(225) CHARACTER SET latin1 NOT NULL,
  `email` varchar(225) CHARACTER SET latin1 NOT NULL,
  `ephone` bigint(12) NOT NULL,
  `enquiry` text CHARACTER SET latin1 NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`eid`, `ename`, `email`, `ephone`, `enquiry`, `added`) VALUES
(205785, 'Bharani', 'bharaniamarnath@gmail.com', 9876543210, 'Hello', '2017-08-18 10:55:21'),
(498553, 'Bharani Amarnath', 'bharaniamarnath@gmail.com', 9876543210, 'Test Enquiry', '2017-08-17 10:20:29'),
(765117, 'Bharani Amarnath', 'bharaniamarnath@gmail.com', 9876543210, 'Test Enquiry Again', '2017-08-17 10:39:58');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `imageid` int(8) NOT NULL,
  `pid` int(6) NOT NULL,
  `link` varchar(512) CHARACTER SET latin1 NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`imageid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`imageid`, `pid`, `link`, `added`) VALUES
(128230, 230895, 'images/gallery/128230.jpg', '2016-06-16 03:50:21'),
(210773, 773155, 'images/gallery/210773.jpg', '2016-06-16 03:52:12'),
(256950, 950539, 'images/gallery/256950.jpg', '2016-06-16 03:52:36'),
(269204, 204518, 'images/gallery/269204.jpg', '2016-06-16 03:51:31'),
(270119, 119990, 'images/gallery/270119.jpg', '2016-06-16 03:53:20'),
(322937, 937326, 'images/gallery/322937.jpg', '2016-06-16 03:50:47'),
(337180, 180783, 'images/gallery/337180.jpg', '2016-06-16 03:53:40'),
(341293, 293072, 'images/gallery/341293.jpg', '2016-06-16 03:49:01'),
(420773, 773155, 'images/gallery/420773.jpg', '2016-06-16 03:52:01'),
(512181, 181222, 'images/gallery/512181.jpg', '2016-06-16 03:51:05'),
(521746, 746319, 'images/gallery/521746.jpg', '2016-06-16 03:49:19'),
(533549, 549118, 'images/gallery/533549.jpg', '2016-06-16 03:49:40'),
(717151, 151846, 'images/gallery/717151.jpg', '2016-06-16 03:52:54'),
(756453, 453289, 'images/gallery/756453.jpg', '2016-06-16 03:48:03'),
(765778, 778969, 'images/gallery/765778.jpg', '2016-06-16 03:45:40');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `pid` int(6) NOT NULL,
  `pname` varchar(128) CHARACTER SET latin1 NOT NULL,
  `pcategory` varchar(128) CHARACTER SET latin1 NOT NULL,
  `ptype` varchar(56) CHARACTER SET latin1 NOT NULL,
  `pcombination` varchar(512) CHARACTER SET latin1 NOT NULL,
  `pdescription` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `pindication` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `pimage` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pname`, `pcategory`, `ptype`, `pcombination`, `pdescription`, `pindication`, `pimage`, `created`) VALUES
(119990, 'Zithrosil-250', 'Antibiotics', 'Tablet', 'Azithromycin 250 mg', 'Azithromycin is used to treat lung and other respiratory infections, such as bronchitis, sinusitis, community acquired pneumonia, some cases of chronic obstructive pulmonary disease, and whooping cough.', 'Acute Sinusitis.\r\nStreptococcal Tonsillitis.\r\nAcute Laryngitis.\r\nPneumonia.\r\nAcute Bronchitis.\r\nChronic Laryngitis.\r\nInfective Dermatitis.\r\nUrinary Tract infections.', 'images/products/119990.jpg', '2016-06-08 17:57:54'),
(126071, 'Dropsil', 'Anti-Allergics / Anti-Cough', 'Syrup', 'Dextromethorphan Hydrobromide 10 mg + Phenylephrine HCl 5 mg + Chlorpheniramine 2 mg', 'Dextromethorphan Hydrobromide is a drug of the morphinan class with sedative, dissociative and stimulant properties. It is a cough suppressant._Phenylephrine is a decongestant that shrinks blood vessels in the nasal passages and it is used to treat nasal and sinus congestion.', 'Relief of Coughs.\r\nSinusitis.\r\nCommon Cold.\r\nChronic Bronchitis.\r\nEmphysema.', 'images/products/126071.jpg', '2017-05-13 10:42:15'),
(151846, 'Ximed-O', 'Antibiotics', 'Tablet', 'Cefixime 200 mg + Ofloxacin 200 mg', 'Cefixime is an oral third generation Cephalosporin antibiotic. It is used to treat Gonorrhea, Tonsilitis and Pharyngitis.\r\n_Ofloxacin is a quinolone antibiotic. It is used to treat certain kinds of bacterial infections.', 'Typhoid Fever.\r\nUrinary Tract infection.\r\nSurgical Prophylaxis.\r\nRespiratory Tract infection.\r\nNosocomial infection.\r\nSoft Tissue infections.\r\nIntra-Abdominal infections.\r\nSkin and skin structure infections.\r\nBone and joint infections.', 'images/products/151846.jpg', '2016-06-08 18:00:06'),
(180783, 'Zithrosil-500', 'Antibiotics', 'Tablet', 'Azithromycin 500 mg', 'Azithromycin is used to treat lung and other respiratory infections, such as bronchitis, sinusitis, community acquired pneumonia, some cases of chronic obstructive pulmonary disease, and whooping cough.', 'Acute Sinusitis.\r\nStreptococcal Tonsillitis.\r\nAcute Laryngitis.\r\nPneumonia.\r\nAcute Bronchitis.\r\nChronic Laryngitis.\r\nInfective Dermatitis\r\nUrinary Tract infections.', 'images/products/180783.jpg', '2016-06-08 17:56:10'),
(181222, 'Panosil-40', 'G.I.T', 'Capsule', 'Pantoprazole 40mg', 'Pantoprazole is a Proton Pump inhibitor drug effective even in resistant Acid peptic disorders.', 'Gastric and Duodenal Ulcer.\r\nReflux Oesophagitis.\r\nZollinger-Ellison-Syndrome.\r\nBloating, Belching, Nausea.\r\nHeartburn and Stomach Ache.', 'images/products/181222.jpg', '2016-06-08 18:14:00'),
(204518, 'Parasil-AC', 'Analgesic / Anti-Inflammatory', 'Tablet', 'Paracetamol  325mg + Aceclofenac 100mg', 'Paracetamol (Acetaminophen) is a pain reliever and a fever reducer.\r\n_Aceclofenac is a non-steroidal anti-inflammatory drug (NSAID) analog of Diclofenac.', 'Acute Muscle Spasm.\r\nLow Back Pain.\r\nMuscle Spasm associated with Spondylosis.\r\nMuscular Cramp.\r\nTraumatic Injury.', 'images/products/204518.jpg', '2016-06-08 18:07:22'),
(230895, 'Oflasil-OZ', 'Antibiotics', 'Tablet', 'Ofloxacin 200 mg + Ornidazole 500 mg', 'Ofloxacin is a synthetic antibiotic of the fluoroquinolone drug class considered to be a second-generation fluoroquinolone.\r\n_Ornidazole is used for certain infections that are caused by anaerobic bacteria, amoebic and parasitic infections.', 'Mixed diarrhea.\r\nPostoperative infections.\r\nUpper and Lower respiratory tract.\r\nLung emphysema.\r\nBiliary infections.\r\nGynecological infections.\r\nDiabetic foot infections.', 'images/products/230895.jpg', '2016-06-08 17:52:17'),
(243382, 'M-Gel', 'G.I.T', 'Suspension', 'Magaldrate 400 mg + Simethicone 20 mg', '<b>Magaldrate</b>_\r\nNeutralizes and reduces stomach acid relieving Heartburn and Indigestion._\r\n<b>Simethicone</b>_\r\nRelieving pressure, Bloating, and gas in the Digestive tract._', 'Duodenal Ulcer.\r\nDyspepsia.\r\nGastroesophageal Reflux.\r\nHeartburn.\r\nStomach Ulcer.\r\nGastro-Intestinal Hemorrhage.', 'images/products/243382.jpg', '2017-05-13 10:47:00'),
(274793, 'Parasil-250', 'Analgesic / Anti-Inflammatory', 'Suspension', 'Paracetamol 250 mg', 'Paracetamol also known as acetaminophen or APAP, is a medication used to treat pain and fever._It is typically used for mild to moderate pain.', 'Pains of all kinds.\r\nFever.\r\nTeething Pain.\r\nColds.\r\nInfluenza.\r\nDysmenorrhoea.', 'images/products/274793.jpg', '2017-05-13 10:52:20'),
(290911, 'Eldaben', 'Antihelmintics', 'Tablet', 'Albendazole 400 mg + Ivermectin 6 mg', 'Albendazole is a medication used for the treatment of a variety of parasitic worm infestations.\r\n_Ivermectin is a medication that is effective against many types of parasites.', 'Treatment of Onchocerciasis, Strongyloidiasis, Ascariasis, Trichuriasis, Filariasis, Enterobiasis. \r\nEpidermal parasitic skin diseases, including Scabies.\r\nIt is effective against Flatworms, Flukes, Fasciolosis, Tapeworms, Cysticercosis, Echinococcosis, Nematodes and Hookworms.', 'images/products/290911.jpg', '2016-07-01 06:56:32'),
(293072, 'Domiral-SR', 'G.I.T', 'Capsule', 'Rabeprazole Sodium 20 mg + Domperidone 30 mg', 'Rabeprazole Sodium is a proton pump inhibitor to reduce stomach acid. It is used in combination with antibiotics to treat bacterial infections in the stomach.\r\n_Domperidone belongs to the group of medications called Dopamine Antagonists. It is used to treat slowed movement in the gastrointestinal tract associated with Diabetes and Gastritis.', 'Dyspepsia.\r\nChronic Gastritis.\r\nGERD.\r\nNausea associated with Acid Peptic disorders.\r\nPost-operative nausea and vomiting.', 'images/products/293072.jpg', '2016-06-08 18:18:54'),
(335366, 'Panosil-DSR', 'G.I.T', 'Capsule', 'Pantoprazole 40 mg + Domperidone 30 mg', 'Pantoprazole is a Proton Pump inhibitor drug effective even in resistant Acid Peptic disorders.\r\n_Domperidone possesses both Prokinetic & Antiemetic properties due to its inhibitory action on D2 receptors.', 'Gastric and Duodenal Ulcer.\r\nReflux Oesophagitis.\r\nZollinger-Ellison-Syndrome.\r\nBloating, Belching, Nausea.\r\nHeartburn and Stomach Ache.', 'images/products/335366.jpg', '2016-06-08 18:11:02'),
(402379, 'Ridsil', 'Anti-Allergics / Anti-Cough', 'Syrup', 'Terbutaline Sulphate 1.25 mg + Guaiphenesin 50 mg +  Bromhexine HCl 2 mg + Menthol 0.5 mg', 'Terbutaline Sulphate - Beta-adrenergic receptor agonist used for the prevention and reversal of bronchospasm._\r\nGuaiphenesin - Reduce chest congestion caused by the common cold, infections, or allergies._\r\nBromhexine Hcl - Mucolytic (expectorant) agent used in the treatment of respiratory disorders associated with viscid or excessive mucus._\r\nMenthol - Relieving minor pain caused by conditions such as arthritis, bursitis, tendonitis, muscle strains or sprains, backache, bruising, and cramping.', 'Asthma, Bronchitis and Emphysema.\r\nChronic Obstructive Pulmonary disease.\r\nChest Congestion.\r\nCommon Cold.\r\nRespiratory Disorders.', 'images/products/402379.jpg', '2017-05-13 11:12:38'),
(453289, 'Cal-Sil 500', 'Nutritional / Supplements', 'Tablet', 'Calcium 500 mg + Vitamin D3', 'Calcium is essential for your body\\''s overall nutrition and health. Calcium makes up approximately 2 percent of your total body weight and contributes to many basic body functions. _Vitamin D3 is used for preventing and treating Rickets, Osteoporosis, Osteomalacia, Bone loss in people with a condition called Hyperparathyroidism and inherited diseases.', 'Vitamin D and Calcium deficiency correction in the elderly. Vitamin and Calcium supplement as an adjunct to specific therapy for Osteoporosis. Patients at high risk of Vitamin D and Calcium combined deficiencies.', 'images/products/453289.jpg', '2016-06-08 18:21:56'),
(468924, 'Parasil-125', 'Analgesic / Anti-Inflammatory', 'Suspension', 'Paracetamol 125 mg', 'Paracetamol also known as acetaminophen or APAP, is a medication used to treat pain and fever._It is typically used for mild to moderate pain.', 'Pains of all kinds.\r\nFever.\r\nTeething Pain.\r\nColds.\r\nInfluenza.\r\nDysmenorrhoea.', 'images/products/468924.jpg', '2017-05-13 10:50:35'),
(549118, 'Gynorubin-XT', 'Nutritional / Supplements', 'Capsule', 'Ferrous Ascorbate 100 mg + Folic Acid 1.5 mg', 'Ferrous Ascorbate is a synthetic form of Iron and Vitamin C. Exogenous administration of Folic Acid is essential for normal Erythropoiesis process.\r\n_Folic Acid is vital for the biosynthesis of purines and thymidylate of nucleic acids.', 'Iron deficiency called Anemia.\r\nTo prevent Neural Tube defects.\r\nTo prevent Colon Cancer or Cervical Cancer.\r\nIt is also used to prevent Heart Disease and Stroke.\r\nPost Surgical.\r\nMennoraghia.', 'images/products/549118.jpg', '2016-06-08 18:23:33'),
(614449, 'Amsilo-CV', 'Antibiotics', 'Tablet', 'Amoxycillin 500 mg + Clavulanic Acid 125 mg', 'Amoxycillin is a penicillin antibiotic that fights against bacteria. It is used to treat infection such as Tonsillitis, Bronchitis, Pneumonia, Gonorrhea and infections of the ear, nose, throat, skin or urinary tract. Clavulanic Acid is a beta-lactam antibiotic, with Potassium Clavulanate, a beta-lactamase inhibitor. This combination results in an antibiotic with an increased spectrum of action and restored efficacy against Amoxicillin-Resistant bacteria that produce beta-lactamase.', 'Lower Respiratory Tract Infections. Acute Bacterial Otitis Media. Sinusitis. Urinary Tract Infections. Skin and Skin Structure Infections.', 'images/products/614449.jpg', '2016-07-09 12:53:25'),
(723365, 'C P Cold and Flu', 'Anti-Allergics / Anti-Cough', 'Tablet', 'Paracetamol 325 mg + Phenylephrine HCl 5  mg + Caffeine 30 mg + Diphenhydramine HCl 25 mg', 'Paracetamol produces analgesia by elevation of the pain threshold and exerts antipyretic effect. _Phenylephrine A sympathomimetic decongestant that reduces the nasal congestion due to increased nasal blood flow. _Diphenhydramine is an inverse agonist of the histamine H1 receptor. It can reduce the intensity of allergic symptoms. _Caffeine acts as a central nervous system stimulant, temporarily warding off drowsiness and restoring alertness.', 'Cold & Cough. Hay Fever. Allergies. Urticaria and Sinus Headache.', 'images/products/723365.jpg', '2016-07-01 07:00:04'),
(746319, 'Enzite', 'Anti-Allergics / Anti-Cough', 'Tablet', 'Levocetirizine Dihydrochloride 5mg', 'Levocetirizine is a third-generation non-sedative antihistamine, developed from the second-generation antihistamine cetirizine.', 'Allergic Rhinitis - Seasonal and Perennial.\r\nPrevent Asthma attack.\r\nItchy, Runny and Stuffy Nose.\r\nNasal Congestion.', 'images/products/746319.jpg', '2016-06-08 18:20:21'),
(773155, 'Parasil-SP', 'Analgesic / Anti-Inflammatory', 'Tablet', 'Paracetamol  325 mg + Aceclofenac 100 mg + Serratiopeptidase 15 mg', 'Paracetamol is a pain reliever and a fever reducer.\r\n_Aceclofenac is a non-steroidal anti-inflammatory drug (NSAID) analog of Diclofenac. \r\n_Serratiopeptidase improves the circulation at the inflammatory focus by breaking down abnormal exudates and protein and by promoting the absorption of the decomposed products through the blood and lymphatic vessels.', 'Chronic Arthritis - Osteoarthritis.\r\nSoft Tissue Inflammation.\r\nPost-operative pain and Inflammation.\r\nSports and other injuries.\r\nDysmenorrhea.\r\nOncology pain.', 'images/products/773155.jpg', '2016-06-08 18:09:02'),
(897947, 'Enzite-M', 'Anti-Allergics / Anti-Cough', 'Tablet', 'Montelukast 10 mg + Levocetirizine Dihydrochloride 5 mg', 'Montelukast is a selective and orally active leukotriene receptor antagonist. It inhibits the cysteinyl leukotriene type-1 receptor (CysLT1).\r\n_Levocetirizine is a third-generation non-sedative antihistamine, developed from the second-generation antihistamine cetirizine.', 'Allergic Rhinitis - Seasonal and Perennial.\r\nPrevent Asthma attack.\r\nItchy, Runny and Stuffy Nose.\r\nNasal Congestion.', 'images/products/897947.jpg', '2016-07-01 06:52:59'),
(937326, 'Omilac', 'G.I.T', 'Capsule', 'Omeprazole 20 mg', 'Omeprazole is a selective and irreversible proton pump inhibitor. It suppresses stomach acid secretion.', 'Gastro-Esophageal Reflux disease.\r\nDuodenal Ulcer.\r\nHeartburns.\r\nGastric Ulcer.\r\nToo much acid in the stomach caused by a growth in the Pancreas.\r\nUlcers caused by medicines.\r\nUlcers which are infected with bacteria.', 'images/products/937326.jpg', '2016-06-08 18:17:22'),
(950539, 'Ximed', 'Antibiotics', 'Tablet', 'Cefixime 200 mg', 'Cefixime is an oral third generation cephalosporin antibiotic. It is used to treat Gonorrhea, Tonsilitis and Pharyngitis.', 'Typhoid Fever.\r\nUrinary Tract infection.\r\nSurgical Prophylaxis.\r\nRespiratory Tract infection.\r\nNosocomial infection.\r\nSoft Tissue infections.\r\nIntra-Abdominal infections.\r\nSkin and skin structure infections.\r\nBone and joint infections.', 'images/products/950539.jpg', '2016-06-08 18:02:03');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
