-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2025 at 08:14 PM
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
-- Database: `f1academydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `story_id` int(11) DEFAULT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_edited` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `story_id`, `comment_text`, `created_at`, `is_edited`) VALUES
(9, 6, 3, 'new comment edited', '2025-05-11 13:03:54', 1),
(10, 6, 1, 'I will enjoy watching it!', '2025-05-11 13:08:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `support` varchar(100) NOT NULL,
  `dob` date DEFAULT NULL,
  `racing_number` int(2) NOT NULL,
  `main_pic_path` varchar(100) NOT NULL,
  `cover_pic_path` varchar(100) NOT NULL,
  `total_points` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `firstname`, `lastname`, `nationality`, `team_id`, `support`, `dob`, `racing_number`, `main_pic_path`, `cover_pic_path`, `total_points`) VALUES
(1, 'Nina', 'Gademan', 'Netherlands', 1, 'Alpine', '2003-05-14', 3, 'Assets/Drivers/Nina Gademan.png', 'Assets/Drivers/Cover/cover-ninagademan.webp', 87),
(2, 'Doriane', 'Pin', 'France', 1, 'Mercedes', '2004-10-01', 28, 'Assets/Drivers/Doriane Pin.png', 'Assets/Drivers/Cover/cover-dorianepin.webp', 73),
(3, 'Tina', 'Hausmann', 'Switzerland', 1, 'Aston Martin', '2005-07-22', 78, 'Assets/Drivers/Tina Hausmann.png', 'Assets/Drivers/Cover/cover-tinahausmann.webp', 40),
(4, 'Emma', 'Felbermayr', 'Austria', 2, 'Kick Sauber', '2005-03-30', 5, 'Assets/Drivers/Emma Felbermayr.png', 'Assets/Drivers/Cover/cover-emmafelbermayr.webp', 36),
(5, 'Ella', 'Lloyd', 'United Kingdom', 2, 'McLaren', '2004-11-11', 20, 'Assets/Drivers/Ella Lloyd.png', 'Assets/Drivers/Cover/cover-ellalloyd.webp', 28),
(6, 'Chloe', 'Chong', 'United Kingdom', 2, 'Charlotte Tilbury', '2005-02-17', 27, 'Assets/Drivers/Chloe Chong.png', 'Assets/Drivers/Cover/cover-chloechong.webp', 18),
(7, 'Chloe', 'Chambers', 'United States', 3, 'Red Bull Ford', '2004-06-14', 14, 'Assets/Drivers/Chloe Chambers.png', 'Assets/Drivers/Cover/cover-chloechambers.webp', 10),
(8, 'Rafaela', 'Ferreira', 'Brazil', 3, 'Racing Bulls', '2005-09-09', 18, 'Assets/Drivers/Rafaela Ferreira.png', 'Assets/Drivers/Cover/cover-rafaelaferreira.webp', 10),
(9, 'Alisha', 'Palmowski', 'United Kingdom', 3, 'Red Bull', '2004-12-05', 21, 'Assets/Drivers/Alisha Palmowski.png', 'Assets/Drivers/Cover/cover-alishapalmowski.webp', 6),
(10, 'Alba', 'Larsen', 'Denmark', 4, 'Tommy Hilfiger', '2005-08-08', 12, 'Assets/Drivers/Alba Larsen.png', 'Assets/Drivers/Cover/cover-albalarsen.webp', 2),
(11, 'Joanne', 'Ciconte', 'Italy', 4, 'F1 Academy', '2005-04-04', 25, 'Assets/Drivers/Joanne Ciconte.png', 'Assets/Drivers/Cover/cover-joanneciconte.webp', 0),
(12, 'Maya', 'Weug', 'Netherlands', 4, 'Ferrari', '2004-06-01', 64, 'Assets/Drivers/Maya Weug.png', 'Assets/Drivers/Cover/cover-mayaweug.webp', 0),
(13, 'Courtney', 'Crone', 'United States', 5, 'Haas', '2003-11-15', 7, 'Assets/Drivers/Courtney Crone.png', 'Assets/Drivers/Cover/cover-courtneycrone.webp', 0),
(14, 'Aurelia', 'Nobels', 'Belgium', 5, 'Puma', '2005-01-20', 22, 'Assets/Drivers/Aurelia Nobels.png', 'Assets/Drivers/Cover/cover-aurelianobels.webp', 18),
(15, 'Lia', 'Block', 'United States', 5, 'Williams', '2006-05-25', 57, 'Assets/Drivers/Lia Block.png', 'Assets/Drivers/Cover/cover-liablock.webp', 1),
(16, 'Nicole', 'Havrda', 'Canada', 6, 'American Express', '2004-09-30', 2, 'Assets/Drivers/Nicole Havrda.png', 'Assets/Drivers/Cover/cover-nicolehavrda.webp', 4),
(17, 'Aiva', 'Anagnostiadis', 'Greece', 6, 'TAG Heuer', '2005-02-02', 11, 'Assets/Drivers/Aiva Anagnostiadis.png', 'Assets/Drivers/Cover/cover-aivaanagnostiadis.webp', 15);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Description` text NOT NULL,
  `Content` longtext NOT NULL,
  `photo_path` varchar(100) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `Title`, `Description`, `Content`, `photo_path`, `Date`) VALUES
(1, 'F1 ACADEMY Miami Race 2 postponed', 'Due to adverse weather conditions, this afternoon’s F1 ACADEMY Race 2 in Miami has been postponed.', 'The race was scheduled to get underway at 13:05 local time, but following persistent rain at the track and additional formation laps completed behind the Safety Car, it was delayed before then being postponed.\r\n\r\nAs a result, no points will be awarded. However, Chloe Chambers will receive the two points for pole position as the final grid for Race 2 was issued.\r\n\r\n', 'Assets/News/news1/news1.webp', '2025-05-03 20:00:00'),
(2, 'Palmowski and Chambers predict ‘tough’ Race 2 as they aim to deliver back-to-back double podiums for Campos', 'Palmowski and Chambers scored Campos Racing’s second double podium of the year in Miami Race 1, but recognise there’s a bigger prize at play in Race 2', 'Lining up alongside each other in seventh and eighth, the duo both managed to steer clear of trouble early on. Finding her way up into P2, Palmowski tried to apply the pressure on to leader Pin, whilst Chambers put clear air between herself and fourth-placed Weug to earn her fourth podium in five races.\r\n\r\nTheir 15-point haul, including Rafaela Ferreira’s eighth-place finish, have strengthened Campos’ hold over the lead of the Teams’ Standings, with the Spanish team 12 points ahead of MP Motorsport.\r\n\r\nQuizzed as to whether she thought a top-three finish was possible, Palmowski replied: “The podium was always the aim. Although starting from P7, it’s the lowest grid spot that I’ve started from this year, so I knew I’d got my work cut out.\r\n\r\n“I was really surprised by the pace that we had. I think it was really solid, it didn’t drop off towards the end, I think we were in the fight the whole way. Even on to that last lap, we were close to Doriane, so it’s a shame we couldn’t quite get the win, but a great result for the team with Chloe in P3 as well.”\r\n\r\nNow looking to bring home another win after her Shanghai Race 1 victory, Palmowski isn’t expecting a straightforward affair after the events of Race 1 in Miami.\r\n\r\n“Today was a great confidence booster,” she remarked. “I\'ve got a lot of good data in terms of the car set-up as well and how it evolved throughout the race run. I know what more I need from the car, I know what more I need from myself as well.\r\n\r\n“It\'d be great to bring home a 1-2 for the team tomorrow. That\'s the aim, but I know that we can equally fight for the win.”\r\n\r\nShe added: “Hopefully, we’ll just drive off into the distance, that’s the plan. But I’m sure with Safety Cars and anything else, who knows what will be thrown at us. We’ll just keep our head down, focus on ourselves and hopefully bring home a good result.”\r\n\r\nWith the Teams’ title hopes looming over their battle, Palmowski isn’t worried about going side-by-side with Chambers and is determined to race hard but fair.\r\n\r\n“I always like to race everybody with respect, but especially your teammate,” she explained. “Me and Chloe, we\'ve had some wheel-to-wheel really close racing, in that race as well. We both gave each other room and we raced really respectfully, so I see no reason why we can\'t continue that tomorrow.”\r\n\r\nMeanwhile, Chambers is crediting her quest to go from eighth to third to her eye-opening experiences last year, which prevented her getting caught up in the Turn 1 melee at the start.\r\n“I started seventh and eighth last year so I kind of knew what to expect from that point on the grid,” she said. “I literally did the same exact thing at the start as I did last year when I started in P8.\r\n\r\n“Obviously it worked, it was the right choice and it really paid off because I made up a bunch of positions at the start. Then, just had a little bit of work to do from there.”\r\n\r\nShe added: “It’s being smart about it, trying to predict where people are going to go. This track is quite easy to lock-up a front tyre on, so you can expect people to go into Turn 1 trying to make up positions, trying to keep positions and to have a little lock-up here and there.\r\n\r\n“That’s kind of what happened, then everybody pushes out a little bit wide and you can just find the openings and squeeze on through there.”\r\n\r\nWhilst both drivers hunt down the win, it’ll be Chambers in the driving seat starting from pole. Although the circumstances may be different, the Red Bull Ford driver isn’t underestimating the task ahead of her.\r\n\r\n“It’s going to be a tough,” Chambers admitted. “The race pace today wasn’t amazing but it was enough to get up into the podium positions. So, I know the race pace is decent, but we just have to do a couple of changes on the car. I definitely have some more time out there in the car and I think tomorrow, it\'ll be tough, but I feel pretty confident (…) I would love to go for the win.”', 'Assets/News/news2/news2.webp', '2025-05-02 20:00:00'),
(3, 'Pin aiming for perfection in Miami after outsmarting rivals on way to Race 1 victory', 'Doriane Pin says she’s going to need all her wits about her if she hopes to replicate her Race 1 feat on Sunday, after winning from sixth on the grid.', 'From her previous experience, Pin knew that only being fast around the Miami International Autodrome wouldn’t be enough for the win to go her way.\r\n\r\nOutsmarting those around her, the Frenchwoman emerged from the opening corner chaos unscathed, battled her way past polesitter Emma Felbermayr and held her nerve on a late restart to take home the win.\r\n\r\nTurning a P6 start into the top step of the podium, Pin celebrated her success after struggling to keep up with 2024 Champion and two-time Miami race winner Abbi Pulling at the American track last year.\r\n\r\n“It’s pretty special — my first reverse grid win,” she said. “I’m really happy, a good relief! I think we were smart today from Quali to Race 1. We avoided the cars at the start and then the pace was good until the Safety Car.\r\n\r\n“Then it was a bit more tricky, but it was well managed. The Safety Car restart was positive and we won, so I’m really happy. It’s good points for the Standings, fastest lap of the race and good for the team. We worked hard to come back stronger here in Miami after challenging races last year.”\r\n\r\nThat foresight and understanding paid off in her fight with Felbermayr, with Pin opting to yield on the first lap as the Safety Car was deployed mid-move. A back-and-forth battle ensued on the restart, with Pin eventually getting through after a mistake from the Kick Sauber driver sent her wide at Turn 1.\r\n\r\n“I think I was in front before the first Safety Car, but we didn’t have any information,” she explained. “I didn’t want to get any penalty for these kinds of things, but I knew we were faster than her, so I overtook once.\r\n\r\n“Then she kind of braked mega late, but we were much faster. Then we passed (her), I played smart and it paid off. So, (it was) really good and pretty happy to have taken the lead. Obviously, when you’re in front it’s easier, but you still have to be fast and manage.”\r\n\r\nPin’s victory celebrations won’t last too long, as the Mercedes driver has already turned her focus towards Race 2 on Sunday.\r\n\r\nWhilst her nearest title rival, Maya Weug, finds herself stuck in the midfield in P10, Pin has another shot of winning within touching distance.\r\n\r\nLining up in P3, the 21-year-old has less ground to make up but with Campos Racing’s Chloe Chambers and Alisha Palmowski in front she’s expecting an even tougher fight ahead.\r\n\r\n“Today was a really good race start,” she noted. “So, I hope we’re going to have the same one tomorrow or even better. We can maybe have an opportunity at the start, but we have the pace to be in front.\r\n\r\n“Campos are strong, so it’s going to be a close battle but we have the pace. I’m looking forward to it and I hope I will bring (home) a second win to do a perfect weekend.”', 'Assets/News/news3/news3.webp', '2025-05-02 20:00:00'),
(4, 'RACE 1: Pin charges her way through to clinch victory in Miami', 'Doriane Pin put all her experience into practice, turning her P6 start into victory in Race 1 on the Miami streets.', 'Palmowski also made her way through the pack to seal second, with teammate Chloe Chambers following through to deliver a double podium for Campos Racing.\r\n\r\nLining up on reverse grid pole once again, Emma Felbermayr nailed her getaway as chaos unfolded behind her. A lock-up from Rafaela Ferreira left her vulnerable as fifth-placed Ella Lloyd tried to squeeze her way past Lia Block. Misjudging her braking point into Turn 1, the McLaren driver hit Ferreira’s rear, breaking her own front wing and forcing the #20 car into an early retirement.\r\n\r\nBenefitting from the drama, Pin slipped her way into second. Trying to wrestle the lead away from Felbermayr, her efforts were halted by the appearance of the Safety Car on the opening lap to pick up the stricken McLaren car.\r\n\r\nThe Safety Car was back in on Lap 3, and Felbermayr held firm on the restart. But it wouldn’t be long for Pin to chance a move, looking down the inside of the Kick Sauber and emerging out in front down the main straight.\r\n\r\nHowever, the fight wasn’t over as Felbermayr caught Pin off-guard, diving down past the Mercedes driver in Turn 1 and leaving her to fend off Aurelia Nobels.\r\n\r\nHer lead would disappear a lap later, locking up into the same corner and going wide over the kerb, damaging her upper front nose. Opening the door for Pin, a train of cars also followed through, dropping her down to sixth.\r\n\r\nUp ahead, Pin built a 1.2s gap whilst Nobels and Palmowski went side-by-side, but the Red Bull Racing driver managed to swoop past for second.\r\n\r\nThe Safety Car was back out on Lap 8 after Joanne Ciconte’s three-wide battle with Chloe Chong and Nicole Havrda brought her race to an early end. Tagged from behind by Chong at Turn 11, both she and the Charlotte Tilbury driver had to retire, whilst Felbermayr received a black and orange flag, forcing her to box for repairs.\r\n\r\nPin controlled the pace on the restart two laps later, pulling away from Palmowski. Chambers moved on to the podium with a tactical move on Nobels, taking the outside line into Turn 11 which then became the inside for Turn 12.\r\n\r\nThe PUMA driver then found herself fighting fellow Scuderia Ferrari Driver Academy member Weug. Selling Nobels the dummy, Weug got the switchback at the last second to get through to fourth.\r\n\r\nBlock then tried to make her own way past her ART Grand Prix teammate on the penultimate lap, but the Williams driver took to the run-off as she overtook the Brazilian for P5. After giving the place back, Block made another move to regain fifth.\r\n\r\nDespite Palmowski’s pressure, nobody could deny Pin the win and the fastest lap as she took the chequered flag four tenths ahead of the Briton. Chambers completed the top-three ahead of Standings leader Maya Weug.\r\n\r\nNina Gademan was promoted to fifth after Block was handed a five-second time penalty for leaving the track and gaining an advantage in an earlier battle with Tina Hausmann, which demoted her from P5 to P10. Nobels secured her first points of the year in sixth ahead of Tina Hausmann and Ferreira, who completed the points-scoring finishers in P8.', 'Assets/News/news4/news4.webp', '2025-05-02 20:00:00'),
(5, 'Lloyd and Chong penalised following Miami Race 1', 'Following the conclusion of Race 1 at the Miami International Autodrome, Ella Lloyd and Chloe Chong have each been handed penalties for separate incidents.', 'Lloyd has been given a three-place grid drop for causing a collision with Rafaela Ferreira at Turn 1 on the opening lap after locking her tyres approaching the corner and making contact with the Racing Bulls driver\'s rear.\r\n\r\nThe Stewards determined that the McLaren driver was wholly at fault for the collision, but did take into account that this was a Lap 1, Turn 1 incident as a mitigating circumstance.\r\n\r\nChong has also been issued a three-place grid penalty for causing a collision with Joanne Ciconte at Turn 11. During a three-car battle with Ciconte and Nicole Havrda, the Charlotte Tilbury driver attempted an inside pass on the Australian, whilst Havrda attempted an inside pass on both cars.\r\n\r\nAt the entry to the corner and approaching the apex, Chong described achieving an overlap of their front axle to Ciconte\'s rear axle and consequently did not earn the right to the line from the MP Motorsport driver. At the same time, Havrda did overlap their front axle to Chong\'s mirror and therefore, earned the right to room from Chong, but not from the unsighted Ciconte. Ciconte then widened her line to leave additional room for the two cars, but Chong did not\r\nyield the Turn to Car 25 and collided with her.\r\n\r\nConsidering the dynamics of three cars entering the corner, the Stewards deemed the Briton predominantly responsible for the collision.\r\n\r\nAs a result of the penalties, Lloyd will now start Race 2 from P7, with Chong demoted from P14 to P17 on the grid.', 'Assets/News/news5/news5.webp', '2025-05-02 20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `news_photos`
--

CREATE TABLE `news_photos` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_photos`
--

INSERT INTO `news_photos` (`id`, `news_id`, `image_path`, `caption`) VALUES
(1, 2, 'Assets/News/news2/img1.webp', 'Palmowski closed to within four tenths of race winner Pin'),
(2, 2, 'Assets/News/news2/img2.webp', 'Chambers made her one dry lap count by scoring pole position for Race 2 in Qualifying'),
(3, 3, 'Assets/News/news3/img1.webp', 'Pin had to fight her way past reverse grid polesitter Emma Felbermayr for the lead'),
(4, 3, 'Assets/News/news3/img2.webp', 'The Race 1 podium finishers all line up inside the top-three for Race 2'),
(5, 4, 'Assets/News/news4/img1.webp', 'Pin and Felbermayr fought over the lead in the early stages'),
(6, 4, 'Assets/News/news4/img2.webp', 'Pin becomes a five-time winner in F1 ACADEMY with her Race 1 victory in Miami');

-- --------------------------------------------------------

--
-- Table structure for table `race_events`
--

CREATE TABLE `race_events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `cover_path` varchar(100) NOT NULL,
  `circuit_path` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `race_events`
--

INSERT INTO `race_events` (`id`, `name`, `location`, `cover_path`, `circuit_path`, `start_date`, `end_date`) VALUES
(1, 'Shanghai International Circuit', 'China', 'Assets/Races/Cover/Shanghai.jpg', 'Assets/Races/Shanghai.webp', '2025-03-21', '2025-03-23'),
(2, 'Jeddah Corniche Circuit', 'Saudi Arabia', 'Assets/Races/Cover/Jeddah.webp', 'Assets/Races/Jeddah.webp', '2025-04-18', '2025-04-20'),
(3, 'Miami International Autodrome', 'USA', 'Assets/Races/Cover/Miami.webp', 'Assets/Races/Miami.webp', '2025-05-02', '2025-05-04'),
(4, 'Circuit Gilles Villeneuve', 'Canada', 'Assets/Races/Cover/Montreal.webp', 'Assets/Races/Montreal.webp', '2025-06-13', '2025-06-15'),
(5, 'Circuit Zandvoort', 'Netherlands', 'Assets/Races/Cover/Zandvoot.avif', 'Assets/Races/Zandvoot.webp', '2025-08-29', '2025-08-31'),
(6, 'Marina Bay Street Circuit', 'Singapore', 'Assets/Races/Cover/Singapore.webp', 'Assets/Races/Singapore.webp', '2025-10-03', '2025-10-05'),
(7, 'Las Vegas Strip Circuit', 'USA', 'Assets/Races/Cover/LasVegas.jpeg', 'Assets/Races/LasVegas.webp', '2025-11-20', '2025-11-22');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `type` enum('Practice','Qualifying','Race') NOT NULL,
  `session_number` int(2) DEFAULT NULL,
  `date_time` datetime NOT NULL,
  `result_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`result_json`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `event_id`, `type`, `session_number`, `date_time`, `result_json`) VALUES
(1, 1, 'Practice', 1, '2025-03-21 10:00:00', '[{\"driver_id\": 2, \"position\": 1, \"lap_time\": \"2:04.198\"},\n    {\"driver_id\": 12, \"position\": 2, \"lap_time\": \"2:04.297\"},\n    {\"driver_id\": 7, \"position\": 3, \"lap_time\": \"2:04.448\"},\n    {\"driver_id\": 1, \"position\": 4, \"lap_time\": \"2:04.603\"},\n    {\"driver_id\": 4, \"position\": 5, \"lap_time\": \"2:04.698\"},\n    {\"driver_id\": 3, \"position\": 6, \"lap_time\": \"2:04.812\"},\n    {\"driver_id\": 6, \"position\": 7, \"lap_time\": \"2:04.915\"},\n    {\"driver_id\": 5, \"position\": 8, \"lap_time\": \"2:05.023\"},\n    {\"driver_id\": 9, \"position\": 9, \"lap_time\": \"2:05.110\"},\n    {\"driver_id\": 8, \"position\": 10, \"lap_time\": \"2:05.207\"},\n {\"driver_id\": 10, \"position\": 11, \"lap_time\": \"2:06.207\"},\n {\"driver_id\": 13, \"position\": 12, \"lap_time\": \"2:06.307\"},\n {\"driver_id\": 11, \"position\": 13, \"lap_time\": \"2:06.507\"},\n {\"driver_id\": 14, \"position\": 14, \"lap_time\": \"2:07.607\"},\n {\"driver_id\": 16, \"position\": 15, \"lap_time\": \"2:07.807\"},\n {\"driver_id\": 17, \"position\": 16, \"lap_time\": \"2:07.907\"},\n {\"driver_id\": 15, \"position\": 17, \"lap_time\": \"2:08.937\"}]'),
(2, 1, 'Qualifying', 1, '2025-03-21 14:00:00', '[{\"driver_id\": 14, \"position\": 1, \"lap_time\": \"2:03.379\"},\r\n    {\"driver_id\": 1, \"position\": 2, \"lap_time\": \"2:03.781\"},\r\n    {\"driver_id\": 5, \"position\": 3, \"lap_time\": \"2:03.890\"},\r\n    {\"driver_id\": 2, \"position\": 4, \"lap_time\": \"2:04.000\"},\r\n    {\"driver_id\": 11, \"position\": 5, \"lap_time\": \"2:04.112\"},\r\n    {\"driver_id\": 13, \"position\": 6, \"lap_time\": \"2:04.223\"},\r\n    {\"driver_id\": 3, \"position\": 7, \"lap_time\": \"2:04.334\"},\r\n    {\"driver_id\": 4, \"position\": 8, \"lap_time\": \"2:04.445\"},\r\n    {\"driver_id\": 6, \"position\": 9, \"lap_time\": \"2:04.556\"},\r\n    {\"driver_id\": 8, \"position\": 10, \"lap_time\": \"2:04.667\"},\r\n{\"driver_id\": 10, \"position\": 11, \"lap_time\": \"2:05.667\"},\r\n{\"driver_id\": 9, \"position\": 12, \"lap_time\": \"2:06.667\"},\r\n{\"driver_id\": 7, \"position\": 13, \"lap_time\": \"2:07.667\"},\r\n{\"driver_id\": 12, \"position\": 14, \"lap_time\": \"2:08.667\"},\r\n{\"driver_id\": 15, \"position\": 15, \"lap_time\": \"2:10.667\"},\r\n{\"driver_id\": 16, \"position\": 16, \"lap_time\": \"2:11.667\"},\r\n{\"driver_id\": 17, \"position\": 17, \"lap_time\": \"2:11.867\"}]\r\n'),
(3, 1, 'Race', 1, '2025-03-22 13:00:00', '[{\"driver_id\": 2, \"position\": 1, \"points\": 25},\r\n    {\"driver_id\": 14, \"position\": 2, \"points\": 18},\r\n    {\"driver_id\": 17, \"position\": 3, \"points\": 15},\r\n    {\"driver_id\": 1, \"position\": 4, \"points\": 12},\r\n    {\"driver_id\": 3, \"position\": 5, \"points\": 10},\r\n    {\"driver_id\": 5, \"position\": 6, \"points\": 8},\r\n    {\"driver_id\": 4, \"position\": 7, \"points\": 6},\r\n    {\"driver_id\": 16, \"position\": 8, \"points\": 4},\r\n    {\"driver_id\": 6, \"position\": 9, \"points\": 2},\r\n    {\"driver_id\": 15, \"position\": 10, \"points\": 1},\r\n    {\"driver_id\": 9, \"position\": 11, \"points\": 0},\r\n    {\"driver_id\": 7, \"position\": 12, \"points\": 0},\r\n    {\"driver_id\": 10, \"position\": 13, \"points\": 0},\r\n    {\"driver_id\": 11, \"position\": 14, \"points\": 0},\r\n    {\"driver_id\": 8, \"position\": 15, \"points\": 0},\r\n    {\"driver_id\": 13, \"position\": 16, \"points\": 0},\r\n    {\"driver_id\": 12, \"position\": 17, \"points\": 0}]'),
(4, 1, 'Race', 2, '2025-03-22 13:00:00', '[\n  {\"driver_id\": 1, \"position\": 1, \"points\": 25},\n  {\"driver_id\": 2, \"position\": 2, \"points\": 18},\n  {\"driver_id\": 3, \"position\": 3, \"points\": 15},\n  {\"driver_id\": 4, \"position\": 4, \"points\": 12},\n  {\"driver_id\": 5, \"position\": 5, \"points\": 10},\n  {\"driver_id\": 6, \"position\": 6, \"points\": 8},\n  {\"driver_id\": 7, \"position\": 7, \"points\": 6},\n  {\"driver_id\": 8, \"position\": 8, \"points\": 4},\n  {\"driver_id\": 9, \"position\": 9, \"points\": 2},\n  {\"driver_id\": 10, \"position\": 10, \"points\": 1},\n{\"driver_id\": 11, \"position\": 11, \"points\": 0},\n{\"driver_id\": 12, \"position\": 12, \"points\": 0},\n{\"driver_id\": 13, \"position\": 13, \"points\": 0},\n{\"driver_id\": 14, \"position\": 14, \"points\": 0},\n{\"driver_id\": 15, \"position\": 15, \"points\": 0},\n{\"driver_id\": 16, \"position\": 16, \"points\": 0},\n{\"driver_id\": 17, \"position\": 17, \"points\": 0}\n]\n'),
(5, 2, 'Practice', 1, '2025-04-18 10:00:00', '[{\"driver_id\": 17, \"position\": 1, \"lap_time\": \"2:04.198\"},\n    {\"driver_id\": 14, \"position\": 2, \"lap_time\": \"2:04.297\"},\n    {\"driver_id\": 15, \"position\": 3, \"lap_time\": \"2:04.448\"},\n    {\"driver_id\": 16, \"position\": 4, \"lap_time\": \"2:04.603\"},\n    {\"driver_id\": 11, \"position\": 5, \"lap_time\": \"2:04.698\"},\n    {\"driver_id\": 10, \"position\": 6, \"lap_time\": \"2:04.812\"},\n    {\"driver_id\": 12, \"position\": 7, \"lap_time\": \"2:04.915\"},\n    {\"driver_id\": 13, \"position\": 8, \"lap_time\": \"2:05.023\"},\n    {\"driver_id\": 1, \"position\": 9, \"lap_time\": \"2:05.110\"},\n    {\"driver_id\": 3, \"position\": 10, \"lap_time\": \"2:05.207\"},\n{\"driver_id\": 2, \"position\": 11, \"lap_time\": \"2:05.207\"},\n{\"driver_id\": 4, \"position\": 12, \"lap_time\": \"2:05.207\"},\n{\"driver_id\": 5, \"position\": 13, \"lap_time\": \"2:05.207\"},\n{\"driver_id\": 7, \"position\": 14, \"lap_time\": \"2:05.207\"},\n{\"driver_id\": 6, \"position\": 15, \"lap_time\": \"2:05.207\"},\n{\"driver_id\": 8, \"position\": 16, \"lap_time\": \"2:05.207\"},\n{\"driver_id\": 9, \"position\": 17, \"lap_time\": \"2:05.207\"}]'),
(6, 2, 'Qualifying', 1, '2025-04-18 14:00:00', '[{\"driver_id\": 14, \"position\": 1, \"lap_time\": \"2:03.379\"},\r\n    {\"driver_id\": 1, \"position\": 2, \"lap_time\": \"2:03.781\"},\r\n    {\"driver_id\": 5, \"position\": 3, \"lap_time\": \"2:03.890\"},\r\n    {\"driver_id\": 2, \"position\": 4, \"lap_time\": \"2:04.000\"},\r\n    {\"driver_id\": 11, \"position\": 5, \"lap_time\": \"2:04.112\"},\r\n    {\"driver_id\": 13, \"position\": 6, \"lap_time\": \"2:04.223\"},\r\n    {\"driver_id\": 3, \"position\": 7, \"lap_time\": \"2:04.334\"},\r\n    {\"driver_id\": 4, \"position\": 8, \"lap_time\": \"2:04.445\"},\r\n    {\"driver_id\": 6, \"position\": 9, \"lap_time\": \"2:04.556\"},\r\n    {\"driver_id\": 8, \"position\": 10, \"lap_time\": \"2:04.667\"},\r\n{\"driver_id\": 10, \"position\": 11, \"lap_time\": \"2:05.667\"},\r\n{\"driver_id\": 9, \"position\": 12, \"lap_time\": \"2:06.667\"},\r\n{\"driver_id\": 7, \"position\": 13, \"lap_time\": \"2:07.667\"},\r\n{\"driver_id\": 12, \"position\": 14, \"lap_time\": \"2:08.667\"},\r\n{\"driver_id\": 15, \"position\": 15, \"lap_time\": \"2:10.667\"},\r\n{\"driver_id\": 16, \"position\": 16, \"lap_time\": \"2:11.667\"},\r\n{\"driver_id\": 17, \"position\": 17, \"lap_time\": \"2:11.867\"}]\r\n'),
(7, 2, 'Race', 1, '2025-04-19 13:00:00', '[{\"driver_id\": 1, \"position\": 1, \"points\": 25},\n    {\"driver_id\": 4, \"position\": 2, \"points\": 18},\n    {\"driver_id\": 3, \"position\": 3, \"points\": 15},\n    {\"driver_id\": 2, \"position\": 4, \"points\": 12},\n    {\"driver_id\": 5, \"position\": 5, \"points\": 10},\n    {\"driver_id\": 6, \"position\": 6, \"points\": 8},\n    {\"driver_id\": 8, \"position\": 7, \"points\": 6},\n    {\"driver_id\": 7, \"position\": 8, \"points\": 4},\n    {\"driver_id\": 9, \"position\": 9, \"points\": 2},\n    {\"driver_id\": 10, \"position\": 10, \"points\": 1},\n{\"driver_id\": 12, \"position\": 11, \"points\": 0},\n{\"driver_id\": 11, \"position\": 12, \"points\": 0},\n{\"driver_id\": 14, \"position\": 13, \"points\": 0},\n{\"driver_id\": 15, \"position\": 14, \"points\": 0},\n{\"driver_id\": 13, \"position\": 15, \"points\": 0},\n{\"driver_id\": 17, \"position\": 16, \"points\": 0},\n{\"driver_id\": 16, \"position\": 17, \"points\": 0}\n]'),
(9, 2, 'Race', 2, '2025-04-20 23:49:02', '[\r\n  {\"driver_id\": 1, \"position\": 1, \"points\": 25},\r\n  {\"driver_id\": 2, \"position\": 2, \"points\": 18},\r\n  {\"driver_id\": 3, \"position\": 3, \"points\": 15},\r\n  {\"driver_id\": 4, \"position\": 4, \"points\": 12},\r\n  {\"driver_id\": 5, \"position\": 5, \"points\": 10},\r\n  {\"driver_id\": 6, \"position\": 6, \"points\": 8},\r\n  {\"driver_id\": 7, \"position\": 7, \"points\": 6},\r\n  {\"driver_id\": 8, \"position\": 8, \"points\": 4},\r\n  {\"driver_id\": 9, \"position\": 9, \"points\": 2},\r\n  {\"driver_id\": 10, \"position\": 10, \"points\": 1},\r\n{\"driver_id\": 11, \"position\": 11, \"points\": 0},\r\n{\"driver_id\": 12, \"position\": 12, \"points\": 0},\r\n{\"driver_id\": 13, \"position\": 13, \"points\": 0},\r\n{\"driver_id\": 14, \"position\": 14, \"points\": 0},\r\n{\"driver_id\": 15, \"position\": 15, \"points\": 0},\r\n{\"driver_id\": 16, \"position\": 16, \"points\": 0},\r\n{\"driver_id\": 17, \"position\": 17, \"points\": 0}\r\n]\r\n'),
(16, 3, 'Practice', 1, '2025-05-02 10:00:00', '[\r\n  {\"driver_id\": 17, \"position\": 1, \"lap_time\": \"2:03.981\"},\r\n  {\"driver_id\": 9, \"position\": 2, \"lap_time\": \"2:04.027\"},\r\n  {\"driver_id\": 14, \"position\": 3, \"lap_time\": \"2:04.099\"},\r\n  {\"driver_id\": 6, \"position\": 4, \"lap_time\": \"2:04.122\"},\r\n  {\"driver_id\": 13, \"position\": 5, \"lap_time\": \"2:04.176\"},\r\n  {\"driver_id\": 10, \"position\": 6, \"lap_time\": \"2:04.244\"},\r\n  {\"driver_id\": 11, \"position\": 7, \"lap_time\": \"2:04.312\"},\r\n  {\"driver_id\": 15, \"position\": 8, \"lap_time\": \"2:04.379\"},\r\n  {\"driver_id\": 5, \"position\": 9, \"lap_time\": \"2:04.453\"},\r\n  {\"driver_id\": 8, \"position\": 10, \"lap_time\": \"2:04.519\"},\r\n  {\"driver_id\": 1, \"position\": 11, \"lap_time\": \"2:04.607\"},\r\n  {\"driver_id\": 4, \"position\": 12, \"lap_time\": \"2:04.688\"},\r\n  {\"driver_id\": 2, \"position\": 13, \"lap_time\": \"2:04.777\"},\r\n  {\"driver_id\": 16, \"position\": 14, \"lap_time\": \"2:04.845\"},\r\n  {\"driver_id\": 12, \"position\": 15, \"lap_time\": \"2:04.912\"},\r\n  {\"driver_id\": 3, \"position\": 16, \"lap_time\": \"2:05.021\"},\r\n  {\"driver_id\": 7, \"position\": 17, \"lap_time\": \"2:05.142\"}\r\n]\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `story_pic_path` varchar(100) NOT NULL,
  `type` enum('story','interview','main-story','report') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `title`, `content`, `author_id`, `created_at`, `story_pic_path`, `type`) VALUES
(1, 'F1: The Academy documentary series to launch on Netflix in May', 'F1 ACADEMY has announced that F1: The Academy, the highly anticipated documentary series produced by Reese Witherspoon’s Hello Sunshine, will launch globally on Netflix on May 28, 2025.\r\n\r\nThe adrenaline-fueled docuseries follows female drivers as they battle it out during the 2024 season of the F1 ACADEMY RACING SERIES.\r\n\r\nThrough exclusive, behind-the-scenes access, F1: The Academy highlights the drama of the races, as well as the personal stories and high stakes for these incredible drivers and the teams around them, as they break barriers in one of the most demanding sports in the world.\r\n\r\nFeaturing seven episodes, the series is executively-produced by F1 ACADEMY\'s Managing Director Susie Wolff alongside Ian Holmes and Isabelle Stewart for F1, with Reese Witherspoon, Sara Rea and Sarah Lazenby as Executive Producers for Hello Sunshine. The showrunner is Lisa Keane.\r\n\r\n', 1, '2025-05-06 14:10:52', 'Assets/Stories/story1/story1.webp', 'main-story'),
(2, 'Champions of the Future Academy Program\r\n', 'The Champions of the Future Academy Program is a new global series aiming to increase female participation and inclusion in national and international karting competitions by breaking down the barriers to entry.\r\n\r\nTo do this, COTFA will include cost control measures, such as a limit on entry fees and a chassis and engine lottery. This will decrease the financial requirements for competitors and ensure that all are competing in equal equipment – allowing them to showcase their talent and abilities.\r\n\r\nThrough a selection process, F1 ACADEMY will identify the top three female karters in each age category who have showcased the most potential. These nine karters will be supported to participate in the series with an F1 ACADEMY-branded kart and race suit, and receive financial support with entry fees. In addition, F1 ACADEMY will provide the drivers with guidance and development support to maximise their potential alongside promotion and visibility to aid their long-term journey.\r\n\r\nThe series will be comprised of three mixed gender categories, Minis (ages 8-11), Juniors (ages 11-14) and Seniors (ages 14+), will compete in six double-header race weekends, with at least one race taking place outside of Europe.\r\n\r\nTalent identification will be a key focus to help create a pipeline of identified talent amongst young girls aged 8-15, with the goal of entering F1 ACADEMY.\r\n\r\nF1 ACADEMY and COTFA will collaboratively identify up and coming talent within karting and look to capture promising drivers who show the skills and traits needed to progress through the junior levels.\r\n\r\ncofta will be racing in:\r\nRound 1: Kartódromo Internacional Algarve, Portimao, Portugal (February 28 - March 2)\r\nRound 2: Kartodromo Internacional Lucas Guerrero, Valencia, Spain (April 11-13)\r\nRound 3: Pista Azzurra, Jesolo, Italy (July 4-6)\r\nRound 4: Pannónia-Ring Kart Center, Ostffyasszonyfa, Hungary (September 19-21)\r\nRound 5: Lusail International Karting Circuit, Doha, Qatar (November 24-26)\r\nRound 6: Al Forsan International Sports Resort, Al Forsan, United Arab Emirates (December 1-3)', 1, '2025-05-06 14:15:00', 'Assets/Stories/story2/story2.webp', 'story'),
(3, 'ART searching for consistency after unlucky opening rounds says Team Manager Soullier', 'ART Grand Prix have endured a torrid start to the 2025 season with their Team Manager Pierre Soullier admitting that luck hasn’t been on their side after the French outfit left Jeddah empty-handed.\r\n\r\nThe team were left ruing their misfortune after Lia Block crashed out early on in Qualifying around the Jeddah Corniche Circuit — having missed Qualifying in Shanghai following a crash with Rafaela Ferreira in Practice.\r\n\r\nNeither PUMA’s Aurelia Nobels or Courtney Crone were able to qualify inside the top-10 and things went from bad to worse in Race 1, with Haas driver Crone tagging teammate Block and being handed a 10-second penalty for the incident. Points also eluded them in Race 2, as Nobels had to settle for 11th.\r\n\r\nLeft with only two points on the board courtesy of Block’s P9 finish in Race 2 in Shanghai, ART sit a lowly fifth in the Teams’ Standings. One point ahead of newcomers Hitech TGR, they have an 89-point deficit to leaders Campos Racing which has left Soullier lamenting their disappointing run.\r\n\r\n“Honestly, from the beginning of the season it’s not (been) easy,” he admitted. “It’s the second difficult weekend. We are missing luck, but it’s a great team effort to make the three cars run throughout the weekend.\r\n\r\n“The pace was better during the races, we made a little step. The end of the weekend was encouraging and now we are focused on Miami. Last year it was a good weekend for us, so we want to get back on top. We keep a good mindset and we will fight back for sure.”\r\n\r\nQuestioned whether the pace was there to fight with the leading teams, Soullier remarked: It’s inconsistent for now. We’ve shown that when everything is aligned, we are able to do good things and have good pace.”\r\n\r\nHe added: “It’s mainly the consistency, avoiding mistakes and trying to align everything because if we mix all the best sectors and all the best corners from the three drivers, the lap is good.”\r\n\r\nFortunately, the return to Miami arrives at a perfect time for a team needing to reset. The team earned their sole podium of the 2024 campaign courtesy of Bianca Bustamante’s P2 finish in Race 2. The American circuit is on that their trio have all raced on before, with Crone making her F1 ACADEMY debut there as the Wild Card entry.\r\n\r\nAnxious to avoid finishing at the bottom of the Teams’ Standings for the second consecutive season, Soullier is optimistic that Round 3 could be the turning point ART desperately need.\r\n\r\n“We are excited, it was a good weekend last year,” he said. “We want to produce another good weekend so we will produce a strong car for Miami. It’s the home race for two of our drivers, so I’m hoping that everything will (come full) circle and we will put everything together.”\r\n\r\n', 1, '2025-05-06 14:15:00', 'Assets/Stories/story3/story3.webp', 'interview'),
(4, '‘Get back to where we actually belong’ – Nobels filled with renewed confidence on return to Miami', 'Aurelia Nobels has endured a testing start to her sophomore F1 ACADEMY season, but the PUMA driver is determined to put those difficulties behind her in Miami.\r\n\r\nAcross the first two rounds, Nobels has suffered back-to-back retirements in Shanghai following contact from teammate Lia Block in Race 1 and being left with nowhere to go after Joanne Ciconte was sent spinning in Race 2.\r\n\r\nWhile the Brazilian took the chequered flag in both Jeddah races, Nobels admits she was frustrated that she had no points to show for her efforts.\r\n\r\n“It was definitely a tough start to the season,” Nobels began. “I wasn’t expecting at all to not score points in both first rounds. I was quite unlucky in China (after) not doing any laps in the races.\r\n\r\n“Then in Jeddah, in the second race I did a very good start and I was already in the points in the first lap, but I had to avoid Emma who spun in front of me and I ended up losing four to five positions. It\'s very frustrating because I thought I did a good job, I had a good start.\r\n\r\nAurelia Nobels has endured a testing start to her sophomore F1 ACADEMY season, but the PUMA driver is determined to put those difficulties behind her in Miami.\r\n\r\nAcross the first two rounds, Nobels has suffered back-to-back retirements in Shanghai following contact from teammate Lia Block in Race 1 and being left with nowhere to go after Joanne Ciconte was sent spinning in Race 2.\r\n\r\nWhile the Brazilian took the chequered flag in both Jeddah races, Nobels admits she was frustrated that she had no points to show for her efforts.\r\n\r\n“It was definitely a tough start to the season,” Nobels began. “I wasn’t expecting at all to not score points in both first rounds. I was quite unlucky in China (after) not doing any laps in the races.\r\n\r\n“Then in Jeddah, in the second race I did a very good start and I was already in the points in the first lap, but I had to avoid Emma who spun in front of me and I ended up losing four to five positions. It\'s very frustrating because I thought I did a good job, I had a good start.\r\n\r\n“I was aggressive on the first laps, I did the job and (then) having to avoid someone in front of me and losing all of this was really hard. But the pace is still not there, it’s still not where we want to be. With the team we\'re working really hard to get back to where we actually belong.”\r\n\r\nCrucially, Nobels isn’t putting her point-less outings down to one factor, with her lack of Qualifying pace putting her outside the top-10 and leaving her at the mercy of the scramble for positions at the back of the pack.\r\n\r\n“It’s more a combination of things,” she explained. “In the races, it’s more about luck. In China and Jeddah, I didn’t have any luck (either) having to avoid or someone crashing into me. Qualifying it’s more about missing pace.\r\n\r\n“In China, we weren’t really set with the set-up, so I wasn’t feeling comfortable with the car. Jeddah was already much better, but I was missing some pace (as) I didn’t adapt well to the grip. Now for Miami, I worked really hard in the sim and I’m pretty confident, I had a lot of pace there last year and a lot of potential.”\r\n\r\nFortunately for Nobels, Miami proved to be a happier hunting ground for ART Grand Prix last season, with Bianca Bustamante scoring their only podium of the campaign. Although points eluded the Ferrari junior on her last visit to the American circuit, she believes there’s untapped potential she can unlock.\r\n\r\nShe concluded: “For all the girls who are in their second year, it’s kind of an advantage because we all know the track and we have only two Free Practices. For the rookies, it’s not going to be easy. In Jeddah and China, we had three days of testing so (we had) a lot of time to learn the track, so I do think we have an advantage.\r\n\r\n“I’m pretty confident because I had the pace last year and now with the team we’re set with the set-up. I’ve worked on myself so I think we have a good chance to score good points.”', 1, '2025-05-01 14:15:01', 'Assets/Stories/story4/story4.webp', 'interview'),
(5, 'Gademan expecting to fight for top-three in Miami Qualifying as she overcomes injury setbacks', 'Nina Gademan’s performance in Free Practice 2 might have been an unexpected surprise, but the Alpine driver says it’s raised her hopes of putting herself in top-three contention in Qualifying.\r\n\r\nStill on the road to recovery after her high-impact crash during Jeddah in-season testing, Gademan knew that getting up to pace in Miami was going to be a challenge. Nevertheless, she benefited from the additional Practice session, clocking in a P3-worthy time in the latter stages.\r\n\r\nAlthough lacking some pace on her first runs, Gademan was satisfied with her efforts even if she believes more was still left to be unlocked.\r\n\r\n“I think it was a decent start,” she said. “We were starting on used tyres, still missing a little bit so trying out some different stuff in Sector 1. Then we found the right bits on the last lap, so the used tyres were not too bad, but still missing a little bit.\r\n\r\n“Then we put the new tyres on and I just put everything together (from) what I’d tested before earlier in the run. Not a clean lap because I feel like there’s still some time in there. I’m happy to be P3, even with the pain still going on (…) A really solid session, I didn’t expect to be P3 as I still felt like there was some time in there from my side.”\r\n\r\nCompeting in her rookie F1 ACADEMY campaign, Gademan is one of 11 first timers around the Miami International Autodrome. Relishing the chance to test out her skills across the demanding track, the Alpine driver is expecting it to become even more testing as the track evolves across the weekend.\r\n\r\n“I really like the track,” she said. “I liked Jeddah as well, they’ve got their own specific things. Jeddah was really high-speed and this track has got high-speed, hard braking zones, the really technical section with the chicane and long straights, which are good for overtaking. It’s been a really enjoyable track to drive on so far.”\r\n\r\nShe added: “F1 Sprint Qualifying is now, so there’ll be a lot of grip, but then it takes a little bit of time if we’re on it tomorrow morning. There’s a bit of time in between, but I expect the track will be even quicker tomorrow morning, so we’ll have to find some time in there as well.”\r\n\r\nBuoyed by her performance, Gademan is now setting her sights high ahead of tomorrow morning’s Qualifying session to put herself in podium contention.\r\n\r\n“Surprisingly being P3, which I didn’t expect, definitely top-three for tomorrow is the aim,” the Dutch driver asserted. “Even though with the injury going on and it hurting my performance, still performing like this makes me quite confident, not only mentally as well, that I can do this.”', 1, '2025-05-02 14:15:01', 'Assets/Stories/story5/story5.webp', 'interview'),
(6, '‘It’s a shame we couldn’t get a podium’ – Palmowski laments car changes in underwhelming Jeddah outing', 'Alisha Palmowski left Round 2 eager to move forward after the frustrating weekend saw her miss out on a double podium finish, although her strong points haul sealed her spot as the top rookie in the series so far.\r\n\r\nAfter claiming a remarkable victory on her debut in Shanghai, the Red Bull Racing driver was set on replicating that success in Jeddah. P3 in Race 1 was an assured first step, but she was unable to improve on her Qualifying position of P4 in Race 2.\r\n\r\nNevertheless, Palmowski equalled her tally from Round 1, to establish herself as the current lead rookie, as she sits 11 points behind second-year driver and her Campos Racing teammate Chloe Chambers in the Standings.\r\n\r\nAsked whether she was happy with how Race 2 panned out, the 18-year-old replied: “I don’t know whether I’d use the word happy! I think ‘solid’, it’s been a solid weekend, solid performance today, good points.\r\n\r\n“It’s a shame we couldn’t get a podium in the end, it was just such a tricky race. We made a change to the car for today compared to yesterday and we didn’t quite get the balance exactly right, but it was just so close between the top three.\r\n\r\n“I could see Doriane (Pin) was having snaps of oversteer in places similar to me so we both struggled a little bit compared to Chloe and Maya (Weug) who were obviously extremely fast. Difficult weekend but solid points, and I think I’ve made a step forward in terms of driving as well, so lots learned, lots to analyse ahead of Miami, but overall positive.”\r\n\r\nIt was a tense battle for all of the podium positions as the order was not decided until the chequered flag, when Chambers’ five-second penalty for forcing Weug off track was applied.\r\n\r\nPalmowski confirmed that, at the point the penalty was announced, she was within five seconds of her teammate and was encouraged by her engineer to close the gap down.\r\n\r\n“It was just a case of pushing as hard as you can, be as fast as you can, try and remain within that five seconds,” the Briton said. “We just lacked overall pace. Similar to Doriane, there was just nothing left to give.\r\n\r\n“I was trying to do a Qualifying lap every lap but we just lacked a little bit overall. It’s a shame, but it is my teammate so I’m glad for Chloe that she managed to keep a podium in the end.”\r\n\r\nPalmowski will have another chance to return to the top three next time out in Miami, where she is hopeful she can close the gap to her nearest rivals and continue building on her already impressive rookie season.\r\n\r\n“The guys ahead of me are all second-year drivers so they have a lot more experience than I do,” she explained. “They know how to handle situations better, but overall it’s a good place to be in P4.\r\n\r\n“I think we can definitely be in the fight for the top three. I think I need to just keep learning, keep gaining confidence. Looking forward to Miami. No prior testing obviously, just the two Free Practice sessions so that will be a different dynamic for a lot of the rookies who have no experience around Miami.\r\n\r\n“A lot of work next week in terms of preparation on the simulator at Red Bull to make sure we’re ready to go. The team (Campos) have got amazing data from last year from the likes of Chloe.\r\n\r\n“I’m sure I’ll be able to learn from her. We’ll compare data, do a lot of sim work. It’s even more important than it normally is so I’m looking forward to the challenge. I think the less testing the better for me to be honest. One of my strengths is normally learning a track and getting to grips with it quite quickly.”', 1, '2025-04-24 14:18:17', 'Assets/Stories/story6/story6.webp', 'interview'),
(7, 'STANDOUT STARS: Who lit up the streets of Jeddah across Round 2?\r\n', 'Maya Weug stands tall at the top of the Drivers’ Standings for the first time as she snatched victory and a double podium in Jeddah.\r\n\r\nThe Ferrari junior wasn’t the only F1 ACADEMY driver to bring the heat to Saudi Arabia, so let’s take a look who lit up the streets in Round 2…\r\n\r\nMAYA WEUG\r\nAfter Shanghai, Weug remarked that her five-point deficit to Doriane Pin “sounds like nothing, but it feels like a lot”. Now the Ferrari driver has turned the tables, scoring back-to-back podiums — including the win in Race 2 — to hold a seven-point advantage over the Mercedes junior.\r\n\r\nDisappointed to miss out on pole position or a front row spot in Qualifying after topping Practice, Weug’s strong pace was quickly apparent in Race 1 as she went from P6 on the grid to P2 at a track known to be difficult to overtake around.\r\n\r\nAiming to go one step further in Race 2, Weug fought hard with polesitter Chloe Chambers for the win and was the beneficiary of the Red Bull Ford driver’s five-second penalty for forcing her off-track during their battle. Promoted to the victory, it was a moment of redemption for Weug after missing out on converting her pole to a win in Shanghai and extends her four-race podium streak.\r\n\r\nCHLOE CHAMBERS\r\nAlthough the win wasn’t to be, Chloe Chambers can still take positives from her time in Jeddah. Qualifying on pole for the first time in her F1 ACADEMY career at a track she qualified eighth and sixth at the previous year shows the jump she’s made in her one-lap pace, arguably one of her weak points across the 2024 campaign.\r\n\r\nLacking the speed to make up more than one place in the reverse grid Race 1, Sunday’s race was a much more formidable showing. Aggressiveness in her battle with Weug stands her in good stead for the fights to come, but she needs to be careful to avoid costly penalties as a result.\r\n\r\nGoing over half a second quicker than third-place Pin in each of the final four laps allowed her to build that crucial five-second buffer and retain P2 by 0.065s.\r\n\r\nMP MOTORSPORT\r\nMP Motorsport enjoyed the largest haul across the weekend, with their trio scoring 49 points. Whilst Weug was the big winner, their rookies Alba Larsen and Joanne Ciconte both acquitted themselves well.\r\n\r\nLarsen qualified inside the top five for the second consecutive weekend and delivered back-to-back P5 finishes to keep the Tommy Hilfiger driver fifth in the Standings. Ciconte missed out on a top-10 spot in Qualifying but managed a hectic Race 2 to deliver her first points of the year in ninth.\r\n\r\nOutscoring Teams’ Standings leaders Campos Racing by eight points, the Dutch squad now hold a two-point deficit heading into Round 3.\r\n\r\nELLA LLOYD\r\nElla Lloyd was dissatisfied by her P7 Qualifying performance, which put her on the front row for Race 1. Yet the McLaren driver made the most out of the situation, snatching the lead from Rodin Motorsport teammate Emma Felbermayr with a lightning getaway.\r\n\r\nHolding firm despite a Safety Car restart and untroubled by the pressure from Weug and Alisha Palmowski, Lloyd looked in full control to bag what she hopes will be the first of many wins in her rookie season.\r\n\r\nAdmitting that the win was “not from where I want it”, a reverse grid victory might have been a consolation prize. But the manner in which she won it will make her rivals take note.\r\n\r\nTINA HAUSMANN\r\nAfter a point-less trip to China, Tina Hausmann will be happy to have gotten 11 points on the board. The Aston Martin driver qualified inside the top six but slipped down off the provisional podium in Race 1 to finish P6.\r\n\r\nCrucially for her after Round 1’s frustrations, Hausmann steered clear of trouble around the Jeddah Corniche Circuit to finish sixth once again and move up to seventh in the Standings, with the podium now in her sights.', 1, '2025-04-27 14:18:17', 'Assets/Stories/story7/story7.webp', 'report');

-- --------------------------------------------------------

--
-- Table structure for table `story_photos`
--

CREATE TABLE `story_photos` (
  `id` int(11) NOT NULL,
  `story_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `caption` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `story_photos`
--

INSERT INTO `story_photos` (`id`, `story_id`, `image_path`, `caption`) VALUES
(1, 3, 'Assets/Stories/story3/img1.webp', 'Block is the only ART driver to have scored points in the first two rounds'),
(2, 4, 'Assets/Stories/story4/img1.webp', 'Nobels is yet to score a point after two challenging opening rounds\r\n'),
(3, 4, 'Assets/Stories/story4/img2.webp', 'The PUMA driver is confident that she can return to form in Miami'),
(4, 5, 'Assets/Stories/story5/img1.webp', 'The Alpine driver finished three tenths off pacesetter Maya Weug in FP2'),
(5, 6, 'Assets/Stories/story6/img1.webp', 'Palmowski finished a second behind third-place Pin in Race 2'),
(6, 6, 'Assets/Stories/story6/img2.webp', 'Three top-four finishes in the past four races have left Palmowski fourth in the Standings'),
(7, 7, 'Assets/Stories/story7/img1.webp', 'Chambers secured her first F1 ACADEMY pole in Jeddah'),
(8, 7, 'Assets/Stories/story7/img2.webp', 'Larsen\'s 14-point haul means she\'s the second-highest rookie in the Standings after Palmowski');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `total_points` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `logo`, `total_points`) VALUES
(1, 'PREMA Racing', 'Assets/Teams/PREMA Racing.webp', 160),
(2, 'Rodin Motorsport', 'Assets/Teams/Rodin Motorsport.webp', 76),
(3, 'Campos Racing', 'Assets/Teams/Campos Racing.webp', 46),
(4, 'MP Motorsport', 'Assets/Teams/MP Motorsport.webp', 20),
(5, 'ART Grand Prix', 'Assets/Teams/ART Grand Prix.webp', 8),
(6, 'Hitech TGR', 'Assets/Teams/Hitech TGR.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_of_birth` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `role`, `created_at`, `date_of_birth`) VALUES
(1, 'Elene', 'nemstsveridze', 'elene.nemstsveridze@gau.edu.ge', '$2y$10$ZWolELGXK1D0ONw4GALaTui7Kl4tzxdkKf79yt4TGH5xQUoWxizP.', 'admin', '2025-05-04 13:20:05', '0000-00-00'),
(6, 'Tako', 'Qartvelishvili', 'takoqartvelishvili@gmail.com', '$2y$10$05GnkYjV5DBxoqnZFhIjG.ZddGIEgH4dck8dkOexRN8FiaQW5Qu96', 'user', '2025-05-11 11:45:14', '2005-01-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `news_id` (`story_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_photos`
--
ALTER TABLE `news_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`);

--
-- Indexes for table `race_events`
--
ALTER TABLE `race_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `story_photos`
--
ALTER TABLE `story_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `story_id` (`story_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `news_photos`
--
ALTER TABLE `news_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `race_events`
--
ALTER TABLE `race_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `story_photos`
--
ALTER TABLE `story_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `news_photos`
--
ALTER TABLE `news_photos`
  ADD CONSTRAINT `news_photos_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `race_events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `story_photos`
--
ALTER TABLE `story_photos`
  ADD CONSTRAINT `story_photos_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
