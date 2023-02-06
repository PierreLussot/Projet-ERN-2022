-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2022 at 03:37 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projetern2022`
--

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id` int(11) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `libelle` varchar(150) NOT NULL,
  `date_creation` datetime NOT NULL,
  `ordre` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `titre`, `libelle`, `date_creation`, `ordre`) VALUES
(1, 'PHP', 'php', '2022-08-19 18:24:13', 3),
(2, 'HTML', 'html', '2022-08-01 12:34:13', 1),
(3, 'CSS', 'css', '2022-08-21 16:25:57', 2);

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `id` int(255) NOT NULL,
  `id_forum` int(255) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `contenu` longtext NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_modification` datetime NOT NULL,
  `id_utilisateur` int(255) NOT NULL,
  `statut` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`id`, `id_forum`, `titre`, `contenu`, `date_creation`, `date_modification`, `id_utilisateur`, `statut`) VALUES
(1, 1, 'Mon premier topic', 'Bonjour,\r\nVoici mon premier topic,\r\nj\'en suis content !                                                                                                                       \r\n                                     au revoir', '2022-08-01 07:03:40', '2022-08-27 09:16:44', 20, 0),
(2, 1, 'Mon deuxieme topic', 'Bonjour\r\nvoici mon deuxieme topic\r\nbonne journée', '2022-08-16 15:06:22', '2022-08-21 15:06:22', 20, 0),
(3, 2, 'mon troisième topic', 'Mon troisième topic noir et blanc.', '2022-08-09 15:06:22', '2022-08-19 23:06:22', 20, 0),
(6, 3, 'GROS PROBLEME !', 'Je ne comprends pas !!!!\r\nJe ne comprends pas !!!!\r\nJe ne comprends pas !!!!\r\nJe ne comprends pas !!!!\r\nJe ne comprends pas !!!!', '2022-08-23 17:57:33', '2022-08-28 08:58:05', 20, 0),
(7, 2, 'Test pour html', 'html', '2022-08-23 18:00:00', '2022-08-23 18:00:00', 20, 0),
(8, 3, 'Titre de tutu', 'dur le sass', '2022-08-24 16:33:21', '2022-08-27 12:13:20', 9, 0),
(11, 2, 'Le HTML c\'est cool', 'Je suis le commentaire du HTML', '2022-09-03 11:21:18', '2022-09-03 11:21:18', 20, 0),
(12, 3, 'Petit blocage', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin bibendum ultricies metus, sed euismod dolor eleifend eget. Suspendisse ut orci magna. Proin et dolor nunc. Sed congue mattis justo sit amet dignissim. Ut pharetra nisi at nisl volutpat lobortis. Nunc venenatis mattis nisi quis venenatis. Proin elementum tempus nisi, in blandit ligula aliquet feugiat. Aliquam volutpat enim quis nibh molestie lobortis. Maecenas fermentum orci eget lacus imperdiet varius. Aenean consectetur metus in quam pharetra, sed dictum dolor efficitur. Nunc sit amet vestibulum neque. Nullam sed tortor a metus pharetra mollis quis in ante. Etiam ut pharetra nunc.', '2022-09-03 11:28:45', '2022-09-03 11:28:45', 13, 0),
(13, 2, 'Voila', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin bibendum ultricies metus, sed euismod dolor eleifend eget. Suspendisse ut orci magna. Proin et dolor nunc. Sed congue mattis justo sit amet dignissim. Ut pharetra nisi at nisl volutpat lobortis. Nunc venenatis mattis nisi quis venenatis. Proin elementum tempus nisi, in blandit ligula aliquet feugiat. Aliquam volutpat enim quis nibh molestie lobortis. Maecenas fermentum orci eget lacus imperdiet varius. Aenean consectetur metus in quam pharetra, sed dictum dolor efficitur. Nunc sit amet vestibulum neque. Nullam sed tortor a metus pharetra mollis quis in ante. Etiam ut pharetra nunc.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Proin bibendum ultricies metus, sed euismod dolor eleifend eget. Suspendisse ut orci magna. Proin et dolor nunc. Sed congue mattis justo sit amet dignissim. Ut pharetra nisi at nisl volutpat lobortis. Nunc venenatis mattis nisi quis venenatis. Proin elementum tempus nisi, in blandit ligula aliquet feugiat. Aliquam volutpat enim quis nibh molestie lobortis. Maecenas fermentum orci eget lacus imperdiet varius. Aenean consectetur metus in quam pharetra, sed dictum dolor efficitur. Nunc sit amet vestibulum neque. Nullam sed tortor a metus pharetra mollis quis in ante. Etiam ut pharetra nunc.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Proin bibendum ultricies metus, sed euismod dolor eleifend eget. Suspendisse ut orci magna. Proin et dolor nunc. Sed congue mattis justo sit amet dignissim. Ut pharetra nisi at nisl volutpat lobortis. Nunc venenatis mattis nisi quis venenatis. Proin elementum tempus nisi, in blandit ligula aliquet feugiat. Aliquam volutpat enim quis nibh molestie lobortis. Maecenas fermentum orci eget lacus imperdiet varius. Aenean consectetur metus in quam pharetra, sed dictum dolor efficitur. Nunc sit amet vestibulum neque. Nullam sed tortor a metus pharetra mollis quis in ante. Etiam ut pharetra nunc.', '2022-09-03 11:29:34', '2022-09-03 11:29:34', 13, 0),
(14, 1, 'Pour les fans de PHP', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vulputate nunc eros, at iaculis purus ultrices et. Fusce non felis ultrices quam iaculis hendrerit. Sed sit amet facilisis augue. Phasellus id feugiat purus. Aenean varius non augue laoreet vulputate. Aliquam vitae neque eu massa fermentum porta sit amet eget erat. Interdum et malesuada fames ac ante ipsum primis in faucibus.\r\n\r\nVestibulum tellus sem, elementum posuere sapien ac, aliquet facilisis magna. In ultrices orci nec lorem vulputate eleifend. Etiam id elit a velit vehicula faucibus. Donec ut consequat nunc, porta ultrices enim. Morbi iaculis et eros eget euismod. Sed gravida arcu neque, eget fringilla velit pharetra ac. Duis eget ultricies lorem. Phasellus laoreet, ipsum in iaculis faucibus, urna ante tincidunt libero, et sodales enim ipsum in nulla.\r\n\r\nPhasellus eu dui condimentum mauris rutrum interdum. Suspendisse potenti. Pellentesque aliquet porttitor nulla, nec congue arcu tristique vitae. Proin non sagittis massa, et placerat mi. Ut pulvinar metus in consectetur porta. Donec consequat massa eget ipsum convallis ultricies. Phasellus sed efficitur velit. Nullam eget rutrum ipsum, id semper ex. Nullam venenatis augue et mi placerat finibus. Suspendisse a nisi euismod est ullamcorper sollicitudin. Etiam vel semper nunc. Praesent cursus eget nunc sit amet egestas. Donec a lectus quis eros elementum iaculis id eget diam.\r\n\r\nInteger felis velit, imperdiet ut sapien dictum, pulvinar vulputate nunc. Quisque dictum, odio a venenatis hendrerit, enim magna blandit metus, at suscipit nisl urna ut augue. Nulla facilisi. Pellentesque nec faucibus justo. Maecenas luctus venenatis ipsum, non condimentum dui aliquam vitae. Sed et odio vitae orci varius consectetur eget at nisi. Nam eleifend lorem in odio ornare iaculis non nec libero. Etiam est massa, egestas sed ante congue, auctor accumsan velit. Ut placerat nisi elementum ligula aliquet lobortis at vitae felis. Integer vestibulum quam vel magna pellentesque, quis rutrum massa pretium. Proin in gravida eros. Nulla sed magna dictum, euismod eros et, blandit tellus.\r\n\r\nEtiam placerat justo vitae ultrices sodales. Fusce eu mollis ipsum. Nunc at consequat urna, vitae scelerisque augue. Maecenas vel eros ut ex bibendum cursus. Pellentesque scelerisque orci sit amet orci dapibus venenatis. Etiam nibh eros, porttitor a faucibus sed, bibendum at orci. Aliquam semper at lorem sit amet iaculis.\r\n\r\nSuspendisse egestas vehicula feugiat. Quisque at nibh eu libero volutpat interdum a varius sem. Ut nulla mauris, faucibus at finibus eu, lobortis quis dolor. Suspendisse mauris justo, pharetra tristique dui vel, commodo faucibus arcu. Aliquam consectetur accumsan odio, sit amet placerat massa. Maecenas ut dignissim sapien. Maecenas accumsan sapien quis rutrum finibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas ut neque at lacus auctor venenatis a nec nisl. Praesent pretium ipsum sit amet nunc efficitur sollicitudin. Vestibulum vitae lorem sit amet libero ornare interdum. Curabitur nec velit tempor, laoreet ligula quis, tristique tellus.\r\n\r\nDonec eget eros nulla. Ut efficitur mi leo. Quisque pretium erat id consectetur ullamcorper. Morbi eget est tortor. Aliquam sed congue neque. Integer iaculis fringilla elit, in tincidunt nunc aliquam id. Aenean rutrum augue et porta luctus. Proin fringilla vulputate quam, vitae ullamcorper ipsum rutrum et. Nam est diam, vestibulum nec orci id, eleifend bibendum erat. Sed iaculis dapibus velit sed commodo. Pellentesque efficitur sagittis mattis.\r\n\r\nInteger vel dolor luctus risus finibus efficitur nec vel enim. Curabitur laoreet sed lacus a gravida. Phasellus cursus dui ac libero venenatis dapibus. Quisque nec mi eu leo venenatis tincidunt id ac metus. Nullam nec placerat risus. Aliquam ultricies, elit et facilisis interdum, est dui venenatis lacus, ac congue lectus orci id lorem. Nullam sollicitudin risus sed purus aliquet placerat. Aliquam arcu enim, accumsan vitae pharetra dignissim, tincidunt quis ex. Suspendisse potenti. Nullam vitae lobortis dui, ac porta arcu. Integer semper turpis vitae hendrerit elementum. Aenean fermentum ligula eu nisi ornare aliquet. Nunc quis bibendum arcu. Vivamus elementum, enim sit amet ornare iaculis, ligula tortor iaculis sapien, ac efficitur erat sapien tempus erat. Mauris eget eleifend magna.\r\n\r\nQuisque at orci sit amet turpis ultrices dictum. Ut pretium tempor nisi ac molestie. Ut tortor eros, consectetur quis sagittis sit amet, venenatis sit amet magna. Suspendisse augue ante, vestibulum sed tincidunt ut, auctor ac lorem. Maecenas faucibus arcu non orci commodo hendrerit. Nullam at lacinia lacus. Fusce aliquet neque libero, vitae vehicula turpis congue ac. Vivamus volutpat dui quis ipsum laoreet congue. Nullam ac nisi tincidunt, feugiat nunc eget, ornare nulla. Morbi dapibus, risus nec tempus venenatis, arcu leo volutpat est, non congue tortor nisl non est. Donec pharetra ultricies turpis vitae varius. Nulla felis magna, congue eget tempus vel, euismod varius risus.\r\n\r\nUt odio eros, feugiat ut elit ut, vehicula sollicitudin diam. Vestibulum tincidunt, odio eu eleifend commodo, tellus justo rutrum arcu, vitae congue enim nunc in tellus. Vestibulum quam dolor, dapibus a porta quis, bibendum eget felis. Vivamus dignissim viverra nibh, id hendrerit mauris varius sed. Quisque semper tristique lectus. In auctor sed orci in auctor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Cras efficitur ultricies sapien sit amet porttitor. Ut at rhoncus metus, sed tincidunt ante. Cras maximus libero dignissim, feugiat est in, consequat mauris. Nunc arcu sapien, laoreet tincidunt pulvinar et, placerat vel sem. Nunc molestie magna at tellus feugiat pretium. In eu commodo nulla. Sed eu ante a ante volutpat vehicula eget non massa. Quisque sed nunc sed massa sodales posuere vitae lobortis quam.\r\n\r\nUt dui mi, varius eu nulla quis, placerat consectetur ligula. Mauris at rhoncus eros. Integer bibendum dolor ut dictum pulvinar. Morbi et ex at nisl accumsan ornare sed ut lacus. Nulla vulputate orci ac nunc dignissim, vulputate placerat mauris pellentesque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin porta, tortor at consectetur mollis, ex sem elementum magna, in tincidunt mauris risus vel tellus. Sed luctus at nisl a pellentesque. Mauris nec ante ac turpis vestibulum ultrices ultrices a nunc. Ut pharetra mauris hendrerit, porta eros ut, suscipit sapien. Vestibulum accumsan volutpat condimentum. Morbi ipsum nibh, rutrum tristique ante at, congue vehicula nulla. Quisque eget consequat massa. Suspendisse potenti. Donec placerat auctor efficitur. Nunc eget sapien dignissim, rutrum purus vel, consequat enim.\r\n\r\nQuisque varius erat vel nulla maximus ullamcorper. Vivamus a malesuada purus. Pellentesque tincidunt libero at neque finibus faucibus. Nam fermentum iaculis finibus. Morbi malesuada iaculis orci non laoreet. Quisque posuere non tortor ac rutrum. Etiam non aliquet lorem. Suspendisse facilisis, urna sed placerat vestibulum, purus velit lacinia tortor, dapibus laoreet libero velit et ante.\r\n\r\nQuisque a est sollicitudin, varius leo eget, placerat sem. Nulla sit amet dolor erat. Donec lorem sem, ullamcorper in aliquet vel, convallis ac diam. Mauris nec mauris ac elit viverra suscipit. Sed mollis viverra urna sed sagittis. Etiam ut viverra justo. Nunc efficitur risus eros, sit amet efficitur nisi vulputate nec. Suspendisse convallis id massa at pretium. Donec at est fringilla, iaculis elit quis, cursus augue. Vestibulum lorem urna, condimentum sit amet blandit vitae, lacinia nec risus. Vivamus lorem magna, malesuada id efficitur nec, egestas eu turpis. Nulla viverra, neque non tristique tincidunt, felis risus porttitor felis, eu tempor arcu ex non ante. Nunc efficitur posuere laoreet. Vestibulum tellus nunc, dictum vel nibh sit amet, tristique fringilla tortor. Cras quis felis euismod, tempus sapien vitae, maximus ante.\r\n\r\nMaecenas facilisis augue nisi, vitae viverra turpis tristique non. Vivamus imperdiet pellentesque cursus. Curabitur varius interdum ipsum sit amet facilisis. Suspendisse lobortis faucibus dignissim. Donec facilisis lobortis posuere. Sed condimentum arcu quis nisi sollicitudin finibus. Nullam gravida orci sed placerat malesuada. Praesent mattis, leo suscipit facilisis placerat, enim leo efficitur nulla, vel aliquet quam diam egestas libero.\r\n\r\nDonec ac semper libero. Nam eget faucibus tortor. Aenean fermentum elit lorem, quis finibus ante dignissim ac. Donec facilisis eros at lectus sollicitudin, maximus elementum nisl condimentum. Cras tincidunt quam eget enim rhoncus consequat. Morbi ornare risus vel nunc facilisis, nec aliquam lorem lacinia. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam volutpat viverra tempor. Nulla aliquet ligula in orci luctus dignissim.', '2022-09-03 12:08:23', '2022-09-03 12:08:43', 21, 0),
(16, 2, 'Quisque a est sollicitud', 'Quisque a est sollicitudin, varius leo eget, placerat sem. Nulla sit amet dolor erat. Donec lorem sem, ullamcorper in aliquet vel, convallis ac diam. Mauris nec mauris ac elit viverra suscipit. Sed mollis viverra urna sed sagittis. Etiam ut viverra justo. Nunc efficitur risus eros, sit amet efficitur nisi vulputate nec. Suspendisse convallis id massa at pretium. Donec at est fringilla, iaculis elit quis, cursus augue. Vestibulum lorem urna, condimentum sit amet blandit vitae, lacinia nec risus. Vivamus lorem magna, malesuada id efficitur nec, egestas eu turpis. Nulla viverra, neque non tristique tincidunt, felis risus porttitor felis, eu tempor arcu ex non ante. Nunc efficitur posuere laoreet. Vestibulum tellus nunc, dictum vel nibh sit amet, tristique fringilla tortor. Cras quis felis euismod, tempus sapien vitae, maximus ante.🦾🦾', '2022-09-03 12:26:24', '2022-09-03 12:26:24', 16, 0),
(17, 3, 'CSS flexbox tuto', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eget magna vel massa euismod mattis. Proin accumsan eleifend odio sed tempus. Suspendisse potenti. Suspendisse finibus lorem et interdum porta. Praesent eget commodo justo, eu egestas quam. Mauris id scelerisque est, ut vehicula orci. Integer eget felis et libero finibus facilisis. Aliquam quis orci quis nunc placerat tempor non eu diam. Donec tincidunt varius felis, iaculis luctus ex semper id. Phasellus dolor felis, lobortis in ante sed, scelerisque tempus ligula. Fusce ullamcorper, urna in sollicitudin faucibus, arcu nulla feugiat mi, in dictum enim tortor vitae dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse tempor mi eros, vel aliquet felis efficitur nec. Donec tincidunt, lorem non egestas auctor, libero eros pretium nibh, eu vestibulum lacus metus at ex.\r\n\r\nFusce facilisis, ligula sed viverra hendrerit, lacus libero pretium nibh, vitae ornare nisi quam vel justo. Aenean eu tincidunt quam. Vivamus vitae neque sed elit pretium placerat. Ut eget nulla ultricies, mattis quam vitae, placerat dolor. Etiam tristique gravida posuere. Sed fringilla justo libero, ut aliquet erat lacinia ac. In ut tortor molestie, tristique nunc sed, interdum odio. Nunc cursus venenatis nisl, molestie iaculis lorem iaculis id. Fusce congue ipsum ac nibh elementum aliquet.\r\n\r\nIn hac habitasse platea dictumst. Proin posuere ipsum non bibendum venenatis. Donec faucibus faucibus purus vel tempus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque suscipit lorem eu convallis accumsan. Quisque molestie erat nec tempus auctor. Curabitur consectetur blandit ex id semper.\r\n\r\nVestibulum quis nulla id odio vehicula maximus. Vivamus sagittis malesuada dolor nec dictum. Pellentesque dolor velit, tempor sit amet felis vitae, vulputate aliquet ante. Praesent a diam interdum ligula posuere sodales. Vestibulum quis lorem ex. Nullam nec aliquam turpis. Cras a lacinia enim. Fusce ullamcorper nunc et sapien malesuada, id hendrerit nunc sagittis.\r\n\r\nProin est lectus, tempus sed lobortis sed, dictum et risus. In sed lacinia metus. Pellentesque sed quam metus. Quisque ullamcorper tortor nec odio venenatis egestas. Aenean vestibulum massa sed dui tincidunt porta. Duis vitae eros mattis, suscipit odio vitae, fringilla ipsum. Curabitur ligula libero, egestas sit amet efficitur eu, congue quis dui.  🤩', '2022-09-05 19:16:07', '2022-09-05 19:16:26', 22, 0);

-- --------------------------------------------------------

--
-- Table structure for table `topic_commentaire`
--

CREATE TABLE `topic_commentaire` (
  `id` int(11) NOT NULL,
  `id_topic` int(255) NOT NULL,
  `id_utilisateur` int(255) NOT NULL,
  `contenu` longtext NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_modification` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topic_commentaire`
--

INSERT INTO `topic_commentaire` (`id`, `id_topic`, `id_utilisateur`, `contenu`, `date_creation`, `date_modification`) VALUES
(1, 1, 13, 'Hello petit petit', '2022-08-17 10:04:19', '2022-08-27 10:01:42'),
(2, 1, 7, 'Je suis le commentaire    de yuyu', '2022-08-25 09:58:20', '2022-08-27 09:06:08'),
(4, 8, 20, 'Je suis là !!', '2022-08-27 10:02:28', '2022-08-27 12:47:52'),
(5, 8, 20, 'hello', '2022-08-27 12:47:41', '2022-08-27 12:47:41'),
(6, 1, 20, 'je suis de retour', '2022-08-27 13:52:12', '2022-08-27 13:52:12'),
(19, 2, 20, 'Je suis le commentaire 1   =)', '2022-08-28 11:52:09', '2022-08-30 18:33:18'),
(26, 2, 20, '😀😁😂🤣😃😅😆', '2022-08-30 18:38:43', '2022-08-30 18:38:43'),
(27, 2, 20, 'test', '2022-09-03 10:34:44', '2022-09-03 10:34:44'),
(28, 2, 20, 'zzzzzz', '2022-09-03 10:35:01', '2022-09-03 10:35:01'),
(29, 2, 20, 'zzzzzz', '2022-09-03 10:35:05', '2022-09-03 10:35:05'),
(31, 2, 13, 'Bonne réponse.', '2022-09-03 11:27:20', '2022-09-03 11:27:20'),
(32, 7, 13, 'C\'est bien cela', '2022-09-03 11:27:50', '2022-09-03 11:27:50'),
(33, 1, 13, 'It is a long-established fact that a reader will be distracted by the readable content of a page when looking at its layout. 🦾', '2022-09-03 12:02:18', '2022-09-03 12:05:10'),
(34, 2, 21, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc. ☺🙂🙂', '2022-09-03 12:06:18', '2022-09-03 12:06:18'),
(35, 7, 21, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2022-09-03 12:06:48', '2022-09-03 12:06:48'),
(36, 1, 21, 'Quisque varius erat vel nulla maximus ullamcorper. Vivamus a malesuada purus. Pellentesque tincidunt libero at neque finibus faucibus. Nam fermentum iaculis finibus.', '2022-09-03 12:09:11', '2022-09-03 12:09:11'),
(40, 16, 12, 'Maecenas facilisis augue nisi, vitae viverra turpis tristique non', '2022-09-03 12:26:53', '2022-09-03 12:26:53'),
(41, 14, 12, 'Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée à titre provisoire pour calibrer une mise en page, le texte définitif venant remplacer le faux-texte dès qu\'il est prêt ou que la mise en page est achevée. Généralement, on utilise un texte en faux latin, le Lorem ipsum ou Lipsum. 🤓', '2022-09-03 12:34:59', '2022-09-03 12:34:59'),
(42, 14, 22, 'Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée à titre provisoire pour calibrer  😁', '2022-09-05 19:14:51', '2022-09-05 19:15:12');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mdp` text NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_connexion` datetime NOT NULL,
  `role` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `pseudo`, `mail`, `mdp`, `date_creation`, `date_connexion`, `role`) VALUES
(7, 'Yuri', 'yuri@gmail.com', '$2y$10$W3w/eSL5mgbzTZWxHWNRbecCjiOgniqI9w3Sq8EF.SkAEPNdeWMYq', '2022-08-18 19:34:16', '2022-08-18 19:34:16', 3),
(8, 'Lulu', 'lulu@gmail.com', '$2y$10$zAunX3rrQMDphMNGz1cJWOO88UDpzotAU6f12UwSAWSICpuHelOey', '2022-08-18 19:57:17', '2022-11-09 18:11:27', 0),
(9, 'Tutu', 'tutu@gmail.com', '$2y$10$AlnbB4f1OoQCxm.leQeGMezJ3VYJVqsfLzw94qyK8ItsgUxwAu1zO', '2022-08-19 08:30:29', '2022-08-24 18:08:47', 2),
(12, 'Eeee', 'eeee@gmail.com', '$2y$10$bat0pRrOSyLjOn/oEH3Dbes3t1JVC659/UvHynJrOkUBMlJlHKBRy', '2022-08-19 08:36:58', '2022-09-03 12:09:40', 0),
(13, 'Rrrr', 'rrrr@gmail.com', '$2y$10$Le8QXziyUXLplgVvMSU.4evXJmBp2Bk7ltPticA9OeIB6uzqCV9r6', '2022-08-19 09:40:58', '2022-09-03 11:09:42', 0),
(14, 'Tttt', 'tttt@gmail.com', '$2y$10$fe41Ziza.Kqpr6CbQPo/Ju.405rDK0vtvQPQGFB/m3xLnGs.7vLbC', '2022-08-19 12:31:50', '2022-08-19 12:31:50', 0),
(16, 'Iiii', 'iiii@gmail.com', '$2y$10$UivCTVcWI2gFnLj.afgw7uwHaD/CcesRLiENu1vs5QqDZ0N0b748a', '2022-08-19 12:55:42', '2022-09-03 12:09:05', 0),
(18, 'Gggg', 'gggg@gmail.com', '$2y$10$Bnb5l2TG3AR1RzctDx48T.Q71zxbZ9DqL4/ml9iGEybvNXGIH8fPy', '2022-08-19 14:41:54', '2022-08-28 09:08:09', 3),
(19, 'Qqqq', 'qqqq@gmail.com', '$2y$10$dgfYJl0FRu00H1I1xI7inOGlmsEyGzsR6PT15a.00CP86dMbwN1h6', '2022-08-21 11:58:48', '2022-08-21 11:58:48', 0),
(20, 'Pierre', 'Pierre@gmail.com', '$2y$10$rJDsSOQaUOCCC.LvC1v.zOJhA5j4OFIlhhnVBShCNGHjuOMlMdvF.', '2022-08-21 12:01:21', '2022-11-18 11:11:48', 0),
(21, 'Lucas', 'lucas@gmail.com', '$2y$10$uNyVT80MxUo6RTRypIwda.0D/5UEDkiascYUgAEIWsIE2r5VtvyLO', '2022-08-30 18:53:24', '2022-09-03 12:09:45', 0),
(22, 'Immane', 'Immane@gmail.com', '$2y$10$FfnEYcZ1AVVMac7fePHO4eOHI8e85ykVf1vERLP14ivKhpr3s.vYC', '2022-09-05 19:13:57', '2022-09-05 19:09:15', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topic_commentaire`
--
ALTER TABLE `topic_commentaire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `topic_commentaire`
--
ALTER TABLE `topic_commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
