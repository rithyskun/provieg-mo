-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 18, 2015 at 06:32 AM
-- Server version: 5.5.41-cll-lve
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `proviegdev-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_createur` int(11) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `language_name` char(35) COLLATE utf8_unicode_ci NOT NULL,
  `language_code` char(7) COLLATE utf8_unicode_ci NOT NULL,
  `country_code` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `visible` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `date_creation`, `id_createur`, `date_modification`, `id_modificateur`, `status`, `language_name`, `language_code`, `country_code`, `visible`) VALUES
(1, 1417517258, 1, 1417517258, 1, 1, 'English', 'en', 'US', 1),
(2, 1417517258, 1, 1417517258, 1, 1, 'ខ្មែរ', 'km', 'KH', 1),
(3, 1417517258, 1, 1417517258, 1, 1, '中文', 'zh', 'CN', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_createur` int(11) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `visible` int(1) NOT NULL DEFAULT '1',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `number` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `date_creation`, `id_createur`, `date_modification`, `id_modificateur`, `status`, `visible`, `price`, `number`) VALUES
(1, 1417575077, 1, 1418627619, 1, 1, 1, '75.00', 10),
(2, 1417575475, 1, 1418630589, 1, 1, 1, '75.00', 20),
(3, 1417575591, 1, 1417575591, 1, 1, 1, '75.00', 30),
(4, 1417575715, 1, 1417575715, 1, 1, 1, '75.00', 40),
(5, 1417575830, 1, 1417575830, 1, 1, 1, '75.00', 50),
(6, 1417575905, 1, 1418632217, 1, 1, 1, '75.00', 60);

-- --------------------------------------------------------

--
-- Table structure for table `product_photo`
--

CREATE TABLE IF NOT EXISTS `product_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_createur` int(11) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `file_id` int(11) NOT NULL DEFAULT '0',
  `main_photo` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `product_photo`
--

INSERT INTO `product_photo` (`id`, `date_creation`, `id_createur`, `date_modification`, `id_modificateur`, `status`, `product_id`, `file_id`, `main_photo`) VALUES
(1, 1417661218, 1, 1417661218, 1, 1, 1, 4, 1),
(2, 1417661284, 1, 1417661284, 1, 1, 2, 5, 1),
(3, 1417661315, 1, 1417661315, 1, 1, 3, 6, 1),
(4, 1417661332, 1, 1417661332, 1, 1, 4, 7, 1),
(5, 1417661360, 1, 1417661360, 1, 1, 5, 8, 1),
(6, 1417661382, 1, 1417661382, 1, 1, 6, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_translate`
--

CREATE TABLE IF NOT EXISTS `product_translate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_createur` int(11) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `language_code` char(7) COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `translation_id` (`product_id`),
  KEY `language_code` (`language_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `product_translate`
--

INSERT INTO `product_translate` (`id`, `date_creation`, `id_createur`, `date_modification`, `id_modificateur`, `status`, `product_id`, `language_code`, `title`, `desc`) VALUES
(1, 1417575077, 1, 1417575128, 1, 1, 1, 'en', 'Phytosynbiotics', '<p class="fr-tag">A new class of food-grade dietary supplements called <strong>phytosynbiotics </strong>has been developed and shown tremendous promise to promote metabolic health by re-balancing blood glucose to non diabetic levels. <strong>Phytosynbiotics </strong>are formulations of plants with known healing properties which have undergone lactic acid fermentation, with production of natural occurring manno-oligosaccharide prebiotics as by products.They are produced when selected plants with healing properities are fermented in a tightly controlled process with specific Lactobacillus probiotics. For example, a phytosynbiotics formulation for glucose management can be produced by co-fermenting lactic acid bacteria with bitter gourd and horse radish tree, plants which are known for their ability to control blood glucose in the body.</p>'),
(2, 1417575475, 1, 1418630060, 1, 1, 2, 'en', 'Prebiotics', '<p class="fr-tag"><strong><u><span style="color: rgb(243, 121, 52);">What are Prebiotics?</span></u></strong></p><p class="fr-tag"><br></p><p class="fr-tag">Scientists have defined Prebiotics as a selectively fermented ingredient that allows specific changes, both in the composition and/or activity in the gastrointestinal microflora that confers benefits upon host well-being and health. Prebiotics are non-digestible foods that make their way through our digestive system and help good bacteria grow and flourish. Prebiotics keep beneficial bacteria healthy. Prebiotics are not bacteria. They are specific nutrients, usually non-absorbable carbohydrates like fructo- and oligo-saccharides, which can be found naturally occurring in whole grains, fruits and legumes. Many prebiotics identified to date are members of the carbohydrate family</p><p class="fr-tag"><br></p><p class="fr-tag"><strong><u><span style="color: #F37934;">Why do Prebiotics Work?</span></u></strong></p><p class="fr-tag"><br></p><p class="fr-tag">Prebiotics are the fertilizer for productive bacterial growth, feeding probiotic bacteria and assisting in its growth. According to OB/GYN Marcelle Pick, "fructooligosaccharides (FOS) and inulin, natural sugars found in bananas, chicory root, onions, leeks, fruit, soybeans, sweet potatoes, asparagus and some whole grains" assist in helping healthy probiotic bacteria through digestive acids, keeping them whole and able to reach their final destination. Additional sources of good Prebiotics include: Endive, Fresh Dandelion Greens, Radicchio and Garlic.</p><p class="fr-tag"><br></p><p class="fr-tag"><strong><u><span style="color: #F37934;">Benefits of Prebiotics.</span></u></strong></p><p class="fr-tag"><br></p><p class="fr-tag"><strong>Prebiotic Benefits</strong></p><p class="fr-tag"><strong><br></strong></p><ul class="fr-tag"><li class="fr-tag"><p class="fr-tag">Increase in levels of good bacteria</p></li><li class="fr-tag"><p class="fr-tag">Reduction in levels of bad bacteria</p></li><li class="fr-tag"><p class="fr-tag">Increase in mineral absorption (for example, calcium)</p></li><li class="fr-tag"><p class="fr-tag">Control or prevention of occasional diarrhea</p></li><li class="fr-tag"><p class="fr-tag">Relief from occasional constipation, particularly in the elderly</p></li><li class="fr-tag"><p class="fr-tag">Provision of up to 10% of daily energy requirements</p></li><li class="fr-tag"><p class="fr-tag">Increase in bioavailability of minerals (for example, calcium and magnesium).</p></li></ul>'),
(3, 1417575591, 1, 1417575591, 1, 1, 3, 'en', 'Probiotics', '<p class="fr-tag">Probiotics are  organisms such as bacteria or yeast that are believed to improve health.  They are available in supplements and foods. The idea of taking live  bacteria or yeast may seem strange at first. After all, we take  antibiotics to fight bacteria. But our bodies naturally teem with such  organisms.</p><p class="fr-tag">The digestive system is home to more  than 500 different types of bacteria. They help keep the intestines  healthy and assist in digesting food. They are also believed to help the  immune system.</p><p class="fr-tag"><br></p><p class="fr-tag"><strong><u><span style="color: #F37934;">How Do Probiotics Work?</span></u></strong></p><p class="fr-tag"><br></p><p class="fr-tag">Researchers  believe that some digestive disorders happen when the balance of  friendly bacteria in the intestines becomes disturbed. This can happen  after an infection or after taking antibiotics. Intestinal problems can  also arise when the lining of the intestines is damaged. Taking  probiotics may help.</p><p class="fr-tag">“Probiotics can improve  intestinal function and maintain the integrity of the lining of the  intestines,” says Stefano Guandalini, MD, professor of pediatrics and  gastroenterology at the University of Chicago Medical Center. These  friendly organisms may also help fight bacteria that cause diarrhea.</p>'),
(4, 1417575715, 1, 1417575715, 1, 1, 4, 'en', 'Momordica charantia', '<p class="fr-tag"><strong><span style="color: #F37934;">Momordica Charantia</span></strong>, also known as <strong><span style="color: #F37934;">Bitter Melon or Bitter Gourd</span></strong>, is a crawling vine that grows well in tropical countries, particularly in the Philippines. </p><p class="fr-tag">The term Momordica Charantia refers to both the plant and its fruit, which is elongated, green and has a rough and rumpled skin.</p><p class="fr-tag">Known for its bitter taste, the Momordica Charantia is at once a staple ingredient in Asian cuisine and a reliable home remedy for various illnesses, particularly diabetes.</p><p class="fr-tag"><br></p><p class="fr-tag"><strong><span style="color: #F37934;">Momordica Charantia</span></strong> has long been a popular part of many Asian vegetable dishes. </p><p class="fr-tag">Though notorious for its bitter taste, <strong><span style="color: #F37934;">Momordica Charantia</span></strong> is rich in iron, potassium, beta-carotene and other nutrients. </p><p class="fr-tag">But aside from its role as a healthy food, <strong><span style="color: #F37934;">Momordica Charantia</span></strong> is especially valued by diabetics for its known anti-diabetes and blood glucose lowering properties.</p>'),
(5, 1417575830, 1, 1417575830, 1, 1, 5, 'en', 'Moringa oleifera', '<p class="fr-tag"><strong><u><span style="color: #F37934;">What is Moringa?</span></u></strong></p><p class="fr-tag"><br></p><p class="fr-tag">For centuries, people in Asia and Africa have had access to moringa oleifera, one of nature’s most nutritious foods. Often called the Tree of Life or Mother’s Best Friend, it provides families–infants, children, parents, and grandparents–with an abundance of minerals, vitamins, calcium, proteins, and beneficial antioxidants and amino acids. This generous and bountiful plant is life sustaining. Living up to its nickname as a ‘Miracle Tree’, Moringa is the basis for many health and nutrition programs funded by various charitable organizations. Experts agree that a Moringa tree contains over 90 bio nutrients, 27 vitamins, 46 antioxidants, all 8 essential amino acids, and minerals, to help in the battle against malnutrition and aid in overcoming a number of illnesses, disabilities, and diseases.</p><p class="fr-tag"><br></p><p class="fr-tag"><strong><u><span style="color: #F37934;">Here are just a few of the many real benefits people discover:</span></u></strong></p><p class="fr-tag"><br></p><ul class="fr-tag"><li class="fr-tag"><p class="fr-tag">Increased physical energy - Tune your body up with naturally occurring nutrients to make your energy last longer</p></li>    <li class="fr-tag"><p class="fr-tag">Mental and emotional balance - Amazingly powerful nutrient compounds help restore stability to the chemicals that govern our thoughts and emotions. You have to experience it to appreciate it!</p></li>    <li class="fr-tag"><p class="fr-tag">Faster recovery - Moringa oleifera''s complete amino profile, along with dozens of vitamins and minerals, makes it a perfect recovery food after grueling workouts and physical strain.</p></li>    <li class="fr-tag"><p class="fr-tag">Nutrient-dense mother''s milk - Increased iron, potassium, Vitamins A, B, C, E, and dozens of other important nutrients are all readily absorbed from Moringa oleifera and transferred from mother''s milk to the growing newborn. No wonder it''s is called ''Mother''s Best Friend'' in cultures across Africa!</p></li>    <li class="fr-tag"><p class="fr-tag">Healthy blood sugar levels - antioxidants and unique regulatingcompounds help control blood sugar and keep the blood free of unhealthy substances.</p></li>  </ul>'),
(6, 1417575905, 1, 1417575905, 1, 1, 6, 'en', 'Microbiome', '<p class="fr-tag">In every human being, and especially in the gut, dwells the microbiome: 100 trillion bacteria of several thousand species. This is 10 times more than the number of cells in the human body. This microbiome maintains health and performs beneficial functions such as food digestion, making vitamins and keeping bad organisms at bay.</p><p class="fr-tag"><br></p><p class="fr-tag">Disrupted microbiomes have been associated with problems such as obesity and malnutrition, diabetes, atherosclerosis and heart disease, multiple sclerosis, asthma and eczema, liver disease, numerous diseases of the intestines including bowel cancer and autism. The active ingredients of the phytosynbiotics help to stablise the upset microbiomes. If the upset microbiome causes illness, stablising it might resolve it.</p><p class="fr-tag"><br></p><p class="fr-tag">Although there is a wide range of medication available to treat T2DM, evidence is showing that T2DM in the majority of patients is still poorly controlled. This failure to achieve optimal glycemic control partly results from the limitations of current therapies, which in most cases target the symptoms of the disease but not its underlying causes. Although control of T2DM can be achieved with the timely use of insulin, the intrusive nature of insulin therapy often leads to non-compliance by diabetic patients.</p><p class="fr-tag"><br></p><p class="fr-tag">New research on the human microbiome is finally providing insight into the underlying causes of T2DM. It is now known that diabetic patients exhibit an intestinal microbiome which is significantly different from healthy microbiomes. Studies have also concluded that stabilising the disrupted microbiomes of obese and diabetic patients can shift the hosts into a healthy state.</p><p class="fr-tag"><br></p><p class="fr-tag">Although still in its infancy, research and development on the human microbiome (The Human Mircobiome Project - http://commonfund.nih.gov/hmp/index) is showing the potential of managing T2DM through the stabilisation of the intestinal microbiome. It is anticipated that in the years to come, new treatments will emerge which offer the promise of even better glycemic control through mechanisms of action that tackle the disease pathophysiology, ie targeting to re-balance the microbiome, not just its symptions.</p>'),
(7, 1417586326, 1, 1417586326, 1, 1, 1, 'zh', '植物合生元 (Phytosynbiotics)', '<p class="fr-tag">新一类的食品级膳食补充品叫植物合生元(Phytosynbiotics) 已经被开发和显示了巨大的潜能，促进新陈代谢，</p><p class="fr-tag"> 通过重新平衡血糖以达到非糖尿病的健康水平。植物合生元 (Phytosynbiotics) 与植物配方</p>'),
(8, 1417586436, 1, 1417590369, 1, 1, 2, 'zh', '预生元/预生菌 (Prebiotics)', '<p class="fr-tag">什么是益生元？科学家们已经确定益生元为选择性发酵成分,无论是在胃肠道菌群的组合物和/或活性微生物，它允许特定的变化，能賦予人体极多好處及</p>'),
(9, 1417586529, 1, 1417590633, 1, 1, 3, 'zh', '益生元/益生菌 (Probiotics)', '<p class="fr-tag">益生菌是生物体例如细菌或酵母被认为有益健康。他们存于补充品和食物内。起初服用活性菌或酵母的想法可能看起来很奇怪。毕竟，我们服用抗生素来</p>'),
(10, 1417586607, 1, 1417586607, 1, 1, 4, 'zh', '苦瓜 (Momordica charantia)', '<p class="fr-tag">苦瓜，也称为苦葫芦，是一种在热带国家生长良好的爬行蔓藤，特别是在菲律宾。苦瓜术语是指植物和果实，其是细长的</p>'),
(11, 1417586649, 1, 1417586649, 1, 1, 5, 'zh', '辣木 (Moringa oleifera)', '<p class="fr-tag">什么是辣木？几个世纪以来，人们在亚洲和非洲能够获得辣木，一个自然界里最有营养的食物。常被称为生命之树或母亲的最佳朋友，它提供了家庭，婴幼儿，儿童，家长和</p>'),
(12, 1417586693, 1, 1417586693, 1, 1, 6, 'zh', '微生物 (Microbiome)', '<p class="fr-tag">每个人特别是在肠道里，居住着微生物：几千种的100万亿个细菌。这是10倍以上人体内细胞的数量。此微生物保持健康和执行有利的</p>'),
(13, 1418355874, 1, 1418627619, 1, 1, 1, 'km', 'Phytosynbiotics', '<p class="fr-tag">ប្រភេទថ្នាំគ្រាប់ថ្មីមួយដែលទើបតែបង្កើតឡើងមានឈ្មោះថា <span style="color: #FBA026;">Phytosynbiotic </span>បានបញ្ចាក់អោយឃើញពីភាពខ្លាំងរបស់ខ្លួននៃសុខភាពការំលាយអាហារតាម រយះការធ្វើអោយមានតុល្យភាពនៃកម្រិតជាតិស្ករក្នុងឈាមដើម្បីជៀសវាងនូវបញ្ហារទឹកនោមផ្អែមដែលត្រូវបានបង្កើតឡើងពីរុក្ខជាតិដែលមានសមត្ថភាព។ ជាពិសេសនៅពេលដែលសមាសភាពរុក្ខជាតិទាំងនោះឆ្លងកាត់ការចំរាញ់រយះពេលយូរក្រោមការចូលរួមពី Probiotic lactobacillus។ ឩទាហរណ៏ការបង្កើត <span style="color: #FBA026;">Phytosynbiotics </span>មួយសម្រាប់គ្រប់គ្រងជាតិស្ករអាចត្រូវបានផលិតឡើងដោយការចំរាញ់រវាងបាតេរីអាសិតលាតិនិងផ្លែម្រះបូកផ្សំនឹងដើមម្រុំដែល សមាសភាពទាំងអស់នេះត្រូវបានគេទទួលស្គាល់ថាមានសមត្ថភាពខ្ពស់ក្នុងការគ្រប់គ្រងជាតិស្ករក្នុងឈាមនៅក្នុងរាងកាយបាន។</p>'),
(14, 1418356374, 1, 1419222753, 1, 1, 2, 'km', 'Prebiotics', '<p class="fr-tag"><span style="color: #FBA026;">តើអ្វីទៅជា&nbsp;Prebiotics ?</span></p><p class="fr-tag"><span style="color: #FBA026;"><br></span></p><p class="fr-tag">ក្រុមវិទ្យាសាស្រ្តបានកំណត់ថាPrebiotics សមាសភាពចំរាញ់មួយដែលជួយអោយមានការផ្លាស់ប្តូរជាវិជ្ជមាននៃការផ្សំឬសកម្មភាពក្នុង Microflora នៃក្រពះពោះវៀនដេលទាំងនេះជួយជាផលប្រយោជន័សំរាប់សុខភាព។Prebiotics ជួយអោយក្រុមបាក់តេរីល្អរីកលូតលាស់និងមានការរីកចំរើនថែមទាំងធ្វើអោយបាតេរីល្អៗទាំងនោះអោយសុខភាពល្អទៀតផង។ Prebiotics មិនមែនជាពពួកបាក់តេរីតេផ្ទុយទៅវិញគីជា Prebiotics សារធាតុចិញ្ចឹមភាគច្រើនជាពពួកកាបូអ៊ីដ្រាតមិនស្រូបមានដូចជាប្រភេទស្ករ Fructo oligo និងSaccharidesដែលជាធម្មតាមាននៅក្នុងគ្រាប់ធញ្ញជាតិផ្លែឈើនិងសណ្តែកកួវែង។ក្រុម Prebiotics ជាច្រើននាពេលបច្ចុប្បន្ននេះបានចាត់ចូលជាសមាជិនៃក្រុមកាបូអ៊ីដ្រាតផងដែរ។</p><p class="fr-tag"><br></p><p class="fr-tag"><span style="color: #FBA026;">ហេតុអ្វីបាន Prebiotics ធ្វើការ ?</span></p><p class="fr-tag"><span style="color: #FBA026;"><br></span></p><p class="fr-tag">Prebiotics គីជាសារធាតុជំនួយសម្រាប់ Probiotic និងការជួយក្នុងកំណើនរបស់ខ្លូន។បើយោងទៅតាម OB/GYN marcel Pick , ជ្រើសយក Fructooligosaccharides (FOS)&nbsp;ដើម្បីបង្កើនការីធំធាត់នៃពពួកបាក់តេរីចិញ្ចឹមបាក់តេរី Probiotic និងជំនួយក្នុងការលូតលាស់របស់ពពួកបាក់តេរិទាំងនោះប្រព័ន្ធរំលាយអាហារគីជាគ្រឹះស្ថានដែលមានបាក់តេរិច្រើនជាង៥០០ប្រភេទពួកគេចិញ្ចឹមថែរក្សាសុខភាពពោះវៀនហើយនិងជួយផ្តល់នូវការរំលាយអាហារពួកគេក៏ជឿរដែលថាវាជាប្រព័ន្ធការពារដែលអាចជួយគេបាន។</p><p class="fr-tag"><br></p><p class="fr-tag"><strong><u><span style="color: #F37934;">Benefits of Prebiotics.</span></u></strong></p><p class="fr-tag"><span style="color: #F37934;"><br></span></p><p class="fr-tag"><strong>អត្ថប្រយោជន៍នៃ Prebiotics</strong></p><p class="fr-tag"><br></p><ul class="fr-tag"><li class="fr-tag"><p class="fr-tag">បង្កើនកម្រិតបាក់តេរីអោយបានល្អ</p></li><li class="fr-tag"><p class="fr-tag">កាត់បន្ថយកម្រិតនៃបាក់តេរីដែលអាក្រក់</p></li><li class="fr-tag"><p class="fr-tag">កាលូតលាស់ក្នុងការស្រូបយកសារធាតុរ៉ែ (ឧទាហរណ៍កាល់ស្យូម)</p></li><li class="fr-tag"><p class="fr-tag">ត្រួតពិនិត្យឬការបង្ការជំងឺរាគរូសម្តងម្កាល</p></li><li class="fr-tag"><p class="fr-tag">សង្គ្រោះពីការទល់លាមកម្តងម្កាលជាពិសេសមនុស្សចាស់</p></li><li class="fr-tag"><p class="fr-tag">ផ្តល់រហូតដល់ទៅ១០%នៃតម្រូវការថាមពលប្រចាំថ្ងៃ</p></li><li class="fr-tag"><p class="fr-tag">បង្កើនភាពសាយភាពនៃការជីកយករ៉ែ (ឧទាហរណ៍កាល់ស្យូមនិងម៉ាញេស្យូម) ។</p></li></ul>'),
(15, 1418370903, 1, 1418631021, 1, 1, 3, 'km', 'Probiotics', '<p class="fr-tag">ប្រព័ន្ធរំលាយអាហារគីជាគ្រឹះស្ថានដែលមានបាក់តេរិច្រើនជាង៥០០ប្រភេទពួកគេចិញ្ចឹមថែរក្សាសុខភាពពោះវៀនហើយនិងជួយផ្តល់នូវការរំលាយអាហារពួកគេក៏ជឿរដែលថាវាជាប្រព័ន្ធការពារដែលអាចជួយគេបាន</p><p class="fr-tag"><br></p><p class="fr-tag"><strong><u><span style="color: #F37934;">តើ&nbsp;Probiotics&nbsp;វាធ្វើការដោយរបៀបណា&nbsp;?</span></u></strong></p><p class="fr-tag"><br></p><p class="fr-tag">អ្នកស្រាវជ្រាវជឿរជាក់ថាមានប្រព័ន្ធរំលាយអាហារខ្លះមានការដំណើរការមិនប្រក្រតីនៅពេលដែលតុល្យភាពក្នុងការទាញយកបាក់តេរីក្នុងពោះវៀនវាក្លាយទៅជាការរំខាន់វាអាចកើតឡើងបន្ទាប់ពីមានដំបៅរីបន្ទាប់ពីការប្រើប្រាស់អងទីបីលាទិចវាអាចកើតមានបញ្ហារពោះវៀននៅពេលទ្រនាប់ខាងក្នុងនៃពោះវៀន</p>'),
(16, 1418370929, 1, 1418631380, 1, 1, 4, 'km', 'Momordica charantia', '<p class="fr-tag">ពាក្យថា <span style="color: #FBA026;">Momordica Charantia </span>សំដៅទៅលើរុក្ខជាតិផ្លែឈើដែលធ្វើអោយលូតលាស់ជាមួយពណ៍បែតងស្រស់បំព្រងហើយធ្វើអោយស្របកមានភាពគ្រើមហើយនិងទន់ដោយដឹងពីរស់ជាតិល្វីរបស់  <span style="color: #FBA026;">Momordica Charantia</span> &nbsp;គេយកវាមកធ្វើជាគ្រឿងផ្សំសំរាបអ្នកអាស៊ីហើយដែលអាចទុក្ខចិត្តបានជាពិសេសសំរាបអ្នកមានទឺកនោមផ្អែម <span style="color: #FBA026;">Momordica Charantia</span> វាបានខ្លាយទៅជាបន្លែរដែលពេញនិយមសំរាប់អ្នកអាស៊ីភាពល្វីខ្លាំងរបស់ Momordica  Charantia វាសំបូរដោយជាតិដែកហើយនិងគ្រឿងផ្សំជាច្រើនទៀតដោយឡែក <span style="color: #FBA026;">Momordica Charantia</span> ក្រៅពីវាធ្វើអោយមានសុភាពល្អគេគិតថាវាអាចការពាជំងឺទឹកនោមផ្អែមនិងបញ្ចុះជាតិស្ករ។</p>'),
(17, 1418370943, 1, 1418631804, 1, 1, 5, 'km', 'Moringa oleifera', '<p class="fr-tag"><strong><u><span style="color: #F37934;">តើ Moringa oleifera ជាអ្វី ?</span></u></strong></p><p class="fr-tag"><br></p><p class="fr-tag">ពេលជាច្រើនសតវត្សប្រជាជនអាស៊ីនិងអាព្រិចបានប្រើរុក្ខជាតិ Moringo Oleifera នេះជារុក្ខជាតិដែលសំបូរដោយសារធាតុបំប៉នជាច្រើនជារើយៗរុក្ខជាតិមួយនេះត្រូវបានគេហៅថា Tree of Life Mother’s Best Friend វាបានផ្តលនៅសាធាតុរ៉េជាច្រើនដូចជាវីតាមីនកាលស្យូមប្រូតេអ៊ីនហើយនិងសារធាតុដែលអាចការពារជំងីមហារីកទៅលើមនុស្សក្នុងគ្រួសារទារកកូនក្មេងដែលឈ្មោះហៅក្រៅរបស់វាគីដើមឈើរវេតមន្តរុក្ខជាតិមួយនឹងវាត្រូវបានគេយកទៅប្រើនៅក្នុងកម្មវិធីសុខភាពនិងអាហាររូបឩត្តមដែលបង្កើតឡើងដោយអង្កការនិងសប្បុរសធម៍អ្នកជំនាញហានអះអាងថារុក្ខជាតិនិងវាផ្ទុកនៅអាហាររូបឩត្តម 90 ប្រភេទវីតាមីន 27 ប្រភេទហើយសារធាតុប្រឆាំងនិងជំងីមហារីកចំនួនមាន 46 ប្រភេទអាមីរូអាស៊ី(Amino) 8 ចំនួននិងសារធាតុរ៉ែភ្ជាប់ជាមួយទៀតពួកវាទាំងនេះអាចជួយក្នុងការប្រយុត្តប្រឆាំងចំពោះបញ្ហារអាហារឩត្តមកាត់បន្ថយនូវជំងឹនាៗនិងការពិការភាពមួយចំនួនទៀត</p><p class="fr-tag"><br></p><p class="fr-tag"><strong><u><span style="color: #F37934;">សារះប្រយោជន៏របស់រុក្ខជាតិនេះដែលមនុស្សបានរកឃើញថាមាន:</span></u></strong></p><p class="fr-tag"><br></p><ul class="fr-tag">  <li class="fr-tag"><p class="fr-tag">បង្កើនថាមពលដល់សារពាងកាយ៖វាធ្វើអោយមានកាកើនឡើននូវសារធាតុចិញ្ចឹមដែលអាចធ្វើអោយអ្នកប្រើប្រាស់ថាមពលបានយូរ</p></li>        <li class="fr-tag"><p class="fr-tag">ធ្វើអោយអារម្មណ៏ផ្លូវចិត្តស្ងប់ស្ងាត់និងមានតុល្យភាព៖សារធាតុនេះវាអាចធ្វើអោយលំនឹងនិងតុលយភាពរបស់សារធាតុគីមឺក្នុងការគ្រប់គ្រងអារម្មណ៏និងការគិត</p></li>        <li class="fr-tag"><p class="fr-tag">វាធ្វើអោយស្តារឡើងវិញដែលបានបាត់បងបានឡើងវិញយ៉ាងឆាប់រហ័ស៖ជាមួយនិងសរធាតុចិញ្ចឹមជាច្រើនវាបានស្តារនូវថាមពលដែលបានបាត់បងដោយភាពនើយហត់ខ្លាំងបានយ៉ាងល្អ</p></li>        <li class="fr-tag"><p class="fr-tag">បង្កើតសារធាតុចិញ្ចឹមដែលទឹកដោះម្តាយវាបានបង្កើតសារធាតុដែកវីតាមីន A, B, C, & Eហើយនិងសារធាតុបំពន់ជាច្រើនដែលទាញចេញពីដែលវាបានបញ្ចូលពីទឹកដោះម្តាយទៅទារកទើបនិងកើតគ្មានអ្វីត្រូវលាក់បាំងទេនៅក្នុងវប្បធម៏អ្នកនៅអាព្រិចដែលគិតថារុក្ខជាតិនេះជាមិត្តដល់ល្អរបស់ម្តាយ</p></li>       <li class="fr-tag"><p class="fr-tag">កំរិតជាតិស្ករក្នុងឈាម៖សារធាតុប្រឆាំងនិងជំងឺមហារីកបានគ្រប់គ្រាន់ជាតិស្ករក្នុងឈាមហើយធ្វើអោយឈាមមានតុល្យភាពនិងស្អាតវាចាកចេញពីសារធាតុគឺមីពុល</p></li></ul>'),
(18, 1418370963, 1, 1418632217, 1, 1, 6, 'km', 'Microbiome', '<p class="fr-tag">នៅក្នុងពោះវៀនមនុស្សគ្រប់គ្នា  មានមេរោគចំនួន១០០ពាន់លានក្បាលនិងរាប់ពាន់ប្រភេទកំពុងតែរស់នៅ។  ចំនួននេះគឺមានច្រើនជាងចំនួនកោសិកាដែលនៅក្នុងខ្លួនមនុស្ស១០ដង។ មេរោគទាំងនេះគឺមានអត្ថប្រយោជន៍ចំពោះសុខភាព  ដូចជា ជួយសំរួលក្នុងការរំលាយអាហារ ការបង្កើតវីតាមីន និង ការបញ្ចេញចោលនូវសារធាតុគីមីពុលមួយចំនូន។ ចំពោះមេរោគដែលអាចផ្តល់ទុក្ខទោស វាអាចផ្តល់ជាជំងឺធាត់ជ្រុល ទឹកនោមផ្អែម  ជំងឺបេះដូង  និងជំងឺផ្សេងៗជាច្រើនទៀតជាពិសេសវាទាក់ទងជាមួយជំងឺមហារីកពោះរៀនដែលអាចធ្វើអោយពោះវៀនមានភាពមិនប្រក្រតី។ សារធាតុដែលបានបញ្ជេញពី Phytosynbiotic បានអោយមានតុល្យភាពរវាងមេរោគដែលមានភាពមិនប្រក្រតី  ប្រសិនបើមានមេរោគណាដែលបង្ករទុក្ខទោសដល់សុខភាពមនុស្ស។ ទោះបីជាមានការផ្តល់ឪសថដើម្បីព្យាបាលជំងឺទឹកនោមផ្អែមT2DM(Diabetes mellitus type 2) បានទូលំទូលាយក៏ដោយ  មានហេតុផលមួយចំនូនដែលអះអាងថាអ្នកដែលមានជំងឺទឹកនោមផ្អែមនិយាយថាជំងឺទឹកនោមផ្អែមមិនងាយព្យាបាលជា។ នេះក៏ដោយសារគេមិនអាចសំរេចបាននូវការកំរិតជាតិស្ករក្នុងការព្យាបាល  ព្រោះថារោគសញ្ញាភាគច្រើនគឺមិនបានលេចឡើងទេក្នុងដំណាក់កាលដំបូងនៃជំងឺ។ទោះបីជាជំងឺទឹកនោមផ្អែមអាចព្យាបាលបានតាមរយះការចាក់បញ្ជូលអាំងស៊ុយលីន  វានៅតែមានភាពមិនប្រក្រតីជារឿយៗដោយសារមិនយល់ស្របពីអ្នកជំងឺ។ របកគំហើញថ្មី ដែលសិក្សាទៅលើមេរោគនៅក្នុងខ្លួនមនុស្សអាចបង្ហាញពីរោគសញ្ញានៃ T2DM បាន។តាមរយះការពិសោធន៍  មេរោគនៅក្នុងពោះរៀនមនុស្សដែលមានជំងឺទឹកនោមផ្អែមគឹមានលក្ខណះខុសគ្នាពីមេរោគរបស់មនុស្សធម្មតា។ការសិក្សាក៏បានធ្វើអោយមានតុល្យភាពក្នុងការកែប្រែមេរោគដែលអាចបង្ករទុក្ខទោសទៅជាមេរោគមានគុណប្រយោជន៍វិញ។ទោះបីជាការស្រាវជ្រាវនេះថ្មី ( The human Microbiome Project) វាបានបង្ហាញពីសមត្ថភាពខ្ពស់ក្នុងការគ្រប់គ្រងកំរិតជាតិស្ករនិងទឹកនោមផ្អែមតាមរយះការធ្វើអោយមានតុល្យភាពរបស់ពពួកមេរោគក្នុងពោះវៀន។ចំពោះការរំពឹងទុកប៉ុន្មានឆ្នាំទៅមុខ ការព្យាបាលជំងឺទឹកផ្អែមដោយកំរិតជាតិស្ករក្នុងឈាមប្រហែលជាអាចប្រព្រឹត្តទៅតាមរយះការព្យាបាលបែបមេកានិច ឧទាហរណ៍ ការធ្វើការផ្លាស់ផ្តូរនិងបង្កើតមេរោគថ្មីដើម្បីធ្វើអោយមានតុល្យភាព។</p>');

-- --------------------------------------------------------

--
-- Table structure for table `report_demande`
--

CREATE TABLE IF NOT EXISTS `report_demande` (
  `id_report` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_createur` int(11) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(11) NOT NULL DEFAULT '0',
  `etat_doc` int(2) NOT NULL DEFAULT '1',
  `referer` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `commentaire` text COLLATE utf8_unicode_ci NOT NULL,
  `user_browser` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_os` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `id_priorite` int(11) NOT NULL,
  PRIMARY KEY (`id_report`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `report_demande_etat`
--

CREATE TABLE IF NOT EXISTS `report_demande_etat` (
  `id_demande_etat` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_createur` int(11) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(11) NOT NULL DEFAULT '0',
  `etat_doc` int(2) NOT NULL DEFAULT '0',
  `id_report` int(11) NOT NULL DEFAULT '0',
  `id_etat` int(11) NOT NULL DEFAULT '0',
  `commentaire` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_demande_etat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `report_discussion`
--

CREATE TABLE IF NOT EXISTS `report_discussion` (
  `id_discussion` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_createur` int(11) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(11) NOT NULL DEFAULT '0',
  `etat_doc` int(2) NOT NULL DEFAULT '1',
  `referer` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_browser` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_os` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `id_priorite` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_discussion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `report_discussion_msg`
--

CREATE TABLE IF NOT EXISTS `report_discussion_msg` (
  `id_discussion_msg` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_createur` int(11) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(11) NOT NULL DEFAULT '0',
  `etat_doc` int(2) NOT NULL DEFAULT '0',
  `id_discussion` int(11) NOT NULL DEFAULT '0',
  `id_etat` int(11) NOT NULL DEFAULT '0',
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `lu` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_discussion_msg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `report_online`
--

CREATE TABLE IF NOT EXISTS `report_online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_createur` int(11) NOT NULL DEFAULT '0',
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(11) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `etat_doc` int(2) NOT NULL DEFAULT '1',
  `page` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `report_online`
--

INSERT INTO `report_online` (`id`, `id_createur`, `date_creation`, `id_modificateur`, `date_modification`, `etat_doc`, `page`) VALUES
(1, 1, 1417517528, 1, 1420698003, 1, '/backend/proviva/proviva_product.php');

-- --------------------------------------------------------

--
-- Table structure for table `report_probleme`
--

CREATE TABLE IF NOT EXISTS `report_probleme` (
  `id_report` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_createur` int(11) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(11) NOT NULL DEFAULT '0',
  `etat_doc` int(2) NOT NULL DEFAULT '1',
  `referer` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `commentaire` text COLLATE utf8_unicode_ci NOT NULL,
  `user_browser` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_os` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `id_priorite` int(11) NOT NULL,
  PRIMARY KEY (`id_report`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `report_probleme_etat`
--

CREATE TABLE IF NOT EXISTS `report_probleme_etat` (
  `id_probleme_etat` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_createur` int(11) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(11) NOT NULL DEFAULT '0',
  `etat_doc` int(2) NOT NULL DEFAULT '0',
  `id_report` int(11) NOT NULL DEFAULT '0',
  `id_etat` int(11) NOT NULL DEFAULT '0',
  `commentaire` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_probleme_etat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `upload_fichier`
--

CREATE TABLE IF NOT EXISTS `upload_fichier` (
  `id_fichier` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_createur` int(11) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(11) NOT NULL DEFAULT '0',
  `etat_doc` int(11) NOT NULL DEFAULT '1',
  `nom_initial` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nom_serveur` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nom_telechargement` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_repertoire` int(11) NOT NULL DEFAULT '0',
  `type_mime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `taille_fichier` int(11) NOT NULL,
  `balise_alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `key_unique` bigint(20) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `id_etat_fichier` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_fichier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `upload_fichier`
--

INSERT INTO `upload_fichier` (`id_fichier`, `date_creation`, `id_createur`, `date_modification`, `id_modificateur`, `etat_doc`, `nom_initial`, `nom_serveur`, `nom_telechargement`, `id_repertoire`, `type_mime`, `taille_fichier`, `balise_alt`, `key_unique`, `titre`, `description`, `id_etat_fichier`) VALUES
(1, 1417661154, 1, 1417661154, 1, 1, 'banner-happiness.jpg', 'banner-happiness-141766115499121093.jpg', 'banner-happiness.jpg', 2, 'image/jpeg', 71336, '', 141766115499121093, '', '', 1),
(2, 1417661154, 1, 1417661154, 1, 1, 'banner-healthylife.jpg', 'banner-healthylife-141766115438105773.jpg', 'banner-healthylife.jpg', 2, 'image/jpeg', 63897, '', 141766115438105773, '', '', 1),
(3, 1417661154, 1, 1417661154, 1, 1, 'banner-live-long-live-happy.jpg', 'banner-live-long-live-happy-141766115423529663.jpg', 'banner-live-long-live-happy.jpg', 2, 'image/jpeg', 74224, '', 141766115423529663, '', '', 1),
(4, 1417661218, 1, 1417661218, 1, 1, 'Phytosynbiotics.jpg', 'phytosynbiotics-141766121832346.jpg', 'phytosynbiotics.jpg', 1, 'image/jpeg', 49899, '', 141766121832346, '', '', 1),
(5, 1417661284, 1, 1417661284, 1, 1, 'Prebiotics.jpg', 'prebiotics-141766128438391.jpg', 'prebiotics.jpg', 1, 'image/jpeg', 54242, '', 141766128438391, '', '', 1),
(6, 1417661314, 1, 1417661314, 1, 1, 'Probitics.jpg', 'probitics-141766131426454.jpg', 'probitics.jpg', 1, 'image/jpeg', 49960, '', 141766131426454, '', '', 1),
(7, 1417661332, 1, 1417661332, 1, 1, 'Momordica charantia.jpg', 'momordica-charantia-141766133216383.jpg', 'momordica-charantia.jpg', 1, 'image/jpeg', 48786, '', 141766133216383, '', '', 1),
(8, 1417661360, 1, 1417661360, 1, 1, 'Moringa oleifera.jpg', 'moringa-oleifera-141766136066285.jpg', 'moringa-oleifera.jpg', 1, 'image/jpeg', 76623, '', 141766136066285, '', '', 1),
(9, 1417661382, 1, 1417661382, 1, 1, 'Microbiome.jpg', 'microbiome-141766138236534.jpg', 'microbiome.jpg', 1, 'image/jpeg', 23884, '', 141766138236534, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `upload_format_image`
--

CREATE TABLE IF NOT EXISTS `upload_format_image` (
  `id_format` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL,
  `id_createur` int(11) NOT NULL,
  `date_modification` bigint(20) NOT NULL,
  `id_modificateur` int(11) NOT NULL,
  `etat_doc` tinyint(4) NOT NULL,
  `nom_format` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url_format` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `largeur` int(11) NOT NULL,
  `hauteur` int(11) NOT NULL,
  PRIMARY KEY (`id_format`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `upload_format_image`
--

INSERT INTO `upload_format_image` (`id_format`, `date_creation`, `id_createur`, `date_modification`, `id_modificateur`, `etat_doc`, `nom_format`, `url_format`, `largeur`, `hauteur`) VALUES
(1, 1417419136, 1, 1417419136, 1, 1, 'Preview photo in back office list', 'mini-admin/', 40, 30),
(2, 1417419136, 1, 1417419136, 1, 1, 'Preview photo in back office detail', 'preview-admin/', 200, 160),
(3, 1417419136, 1, 1417419136, 1, 1, 'Photo product list in front page', 'product-list/', 320, 214),
(4, 1417419136, 1, 1417419136, 1, 1, 'Photo product detail in front page', 'product-detail/', 360, 241);

-- --------------------------------------------------------

--
-- Table structure for table `upload_repertoire`
--

CREATE TABLE IF NOT EXISTS `upload_repertoire` (
  `id_repertoire` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL,
  `id_createur` int(11) NOT NULL,
  `date_modification` bigint(20) NOT NULL,
  `id_modificateur` int(11) NOT NULL,
  `etat_doc` tinyint(1) NOT NULL DEFAULT '1',
  `nom_repertoire` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url_repertoire` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_repertoire`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `upload_repertoire`
--

INSERT INTO `upload_repertoire` (`id_repertoire`, `date_creation`, `id_createur`, `date_modification`, `id_modificateur`, `etat_doc`, `nom_repertoire`, `url_repertoire`) VALUES
(1, 1417419136, 1, 1417419136, 1, 1, 'Photos of the product', 'photos/'),
(2, 1417419136, 1, 1417419136, 1, 1, 'Photos of the banner', 'banners/');

-- --------------------------------------------------------

--
-- Table structure for table `upload_repertoire_format`
--

CREATE TABLE IF NOT EXISTS `upload_repertoire_format` (
  `id_repertoire_format` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL,
  `id_createur` int(11) NOT NULL,
  `date_modification` bigint(20) NOT NULL,
  `id_modificateur` int(11) NOT NULL,
  `etat_doc` tinyint(1) NOT NULL,
  `id_format` int(11) NOT NULL,
  `id_repertoire` int(11) NOT NULL,
  PRIMARY KEY (`id_repertoire_format`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `upload_repertoire_format`
--

INSERT INTO `upload_repertoire_format` (`id_repertoire_format`, `date_creation`, `id_createur`, `date_modification`, `id_modificateur`, `etat_doc`, `id_format`, `id_repertoire`) VALUES
(1, 1417419741, 1, 1417419741, 1, 1, 4, 1),
(2, 1417419741, 1, 1417419741, 1, 1, 3, 1),
(3, 1417419741, 1, 1417419741, 1, 1, 2, 1),
(4, 1417419741, 1, 1417419741, 1, 1, 1, 1),
(5, 1417419784, 1, 1417419784, 1, 1, 2, 2),
(6, 1417419784, 1, 1417419784, 1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `upload_repertoire_mime`
--

CREATE TABLE IF NOT EXISTS `upload_repertoire_mime` (
  `id_repertoire_mime` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL,
  `id_createur` int(11) NOT NULL,
  `date_modification` bigint(20) NOT NULL,
  `id_modificateur` int(11) NOT NULL,
  `etat_doc` tinyint(1) NOT NULL,
  `id_repertoire` int(11) NOT NULL,
  `id_type_mime` int(11) NOT NULL,
  PRIMARY KEY (`id_repertoire_mime`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `upload_repertoire_mime`
--

INSERT INTO `upload_repertoire_mime` (`id_repertoire_mime`, `date_creation`, `id_createur`, `date_modification`, `id_modificateur`, `etat_doc`, `id_repertoire`, `id_type_mime`) VALUES
(1, 1408429055, 1, 1408429055, 1, 1, 1, 1),
(2, 1408429055, 1, 1408429055, 1, 1, 1, 3),
(3, 1408429055, 1, 1408429055, 1, 1, 1, 2),
(4, 1409109183, 1, 1409109183, 1, 1, 2, 1),
(5, 1409109183, 1, 1409109183, 1, 1, 2, 3),
(6, 1409109183, 1, 1409109183, 1, 1, 2, 2),
(7, 1410173060, 1, 1410173060, 1, 1, 3, 1),
(8, 1410173060, 1, 1410173060, 1, 1, 3, 3),
(9, 1410173060, 1, 1410173060, 1, 1, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_infos`
--

CREATE TABLE IF NOT EXISTS `user_infos` (
  `id_user_infos` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL,
  `id_createur` int(11) NOT NULL,
  `date_modification` bigint(20) NOT NULL,
  `id_modificateur` int(11) NOT NULL,
  `etat_doc` tinyint(1) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nickname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_country` int(11) DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_user_infos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `zz_data_adm_image_fichier`
--

CREATE TABLE IF NOT EXISTS `zz_data_adm_image_fichier` (
  `id_adm_image_fichier` int(11) NOT NULL AUTO_INCREMENT,
  `url_adm_image_fichier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_adm_image_fichier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `zz_data_adm_image_fichier`
--

INSERT INTO `zz_data_adm_image_fichier` (`id_adm_image_fichier`, `url_adm_image_fichier`) VALUES
(1, 'ajouter.gif'),
(2, 'modifier.gif'),
(3, 'supprimer.gif'),
(4, 'sitemap.gif');

-- --------------------------------------------------------

--
-- Table structure for table `zz_data_country`
--

CREATE TABLE IF NOT EXISTS `zz_data_country` (
  `id_country` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL,
  `id_createur` int(11) NOT NULL,
  `date_modification` bigint(20) NOT NULL,
  `id_modificateur` int(11) NOT NULL,
  `etat_doc` tinyint(4) NOT NULL,
  `iso` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_country`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=245 ;

--
-- Dumping data for table `zz_data_country`
--

INSERT INTO `zz_data_country` (`id_country`, `date_creation`, `id_createur`, `date_modification`, `id_modificateur`, `etat_doc`, `iso`, `country`) VALUES
(1, 1188392615, 1, 1219834716, 5, 1, 'AD', 'Andorra'),
(2, 1188392615, 1, 1219834716, 5, 1, 'AE', 'United Arab Emirates'),
(3, 1188392615, 1, 1219834716, 5, 1, 'AF', 'Afghanistan'),
(4, 1188392615, 1, 1219834716, 5, 1, 'AG', 'Antigua and Barbuda'),
(5, 1188392615, 1, 1219834716, 5, 1, 'AI', 'Anguilla'),
(6, 1188392615, 1, 1219834716, 5, 1, 'AL', 'Albania'),
(7, 1188392615, 1, 1219834716, 5, 1, 'AM', 'Armenia'),
(8, 1188392615, 1, 1219834716, 5, 1, 'AN', 'Netherlands Antilles'),
(9, 1188392615, 1, 1219834716, 5, 1, 'AO', 'Angola'),
(10, 1188392615, 1, 1219834716, 5, 1, 'AQ', 'Antarctica'),
(11, 1188392615, 1, 1219834716, 5, 1, 'AR', 'Argentina'),
(12, 1188392615, 1, 1219834716, 5, 1, 'AS', 'American Samoa'),
(13, 1188392615, 1, 1219834716, 5, 1, 'AT', 'Austria'),
(14, 1188392615, 1, 1219834716, 5, 1, 'AU', 'Australia'),
(15, 1188392615, 1, 1219834716, 5, 1, 'AW', 'Aruba'),
(16, 1188392615, 1, 1219834716, 5, 1, 'AX', 'Aland Islands'),
(17, 1188392615, 1, 1219834716, 5, 1, 'AZ', 'Azerbaijan'),
(18, 1188392615, 1, 1219834716, 5, 1, 'BA', 'Bosnia and Herzegovina'),
(19, 1188392615, 1, 1219834716, 5, 1, 'BB', 'Barbados'),
(20, 1188392615, 1, 1219834716, 5, 1, 'BD', 'Bangladesh'),
(21, 1188392615, 1, 1219834716, 5, 1, 'BE', 'Belgium'),
(22, 1188392615, 1, 1219834716, 5, 1, 'BF', 'Burkina Faso'),
(23, 1188392615, 1, 1219834716, 5, 1, 'BG', 'Bulgaria'),
(24, 1188392615, 1, 1219834716, 5, 1, 'BH', 'Bahrain'),
(25, 1188392615, 1, 1219834716, 5, 1, 'BI', 'Burundi'),
(26, 1188392615, 1, 1219834716, 5, 1, 'BJ', 'Benin'),
(27, 1188392615, 1, 1219834716, 5, 1, 'BM', 'Bermuda'),
(28, 1188392615, 1, 1219834716, 5, 1, 'BN', 'Brunei Darussalam'),
(29, 1188392615, 1, 1219834716, 5, 1, 'BO', 'Bolivia'),
(30, 1188392615, 1, 1219834716, 5, 1, 'BR', 'Brazil'),
(31, 1188392615, 1, 1219834716, 5, 1, 'BS', 'Bahamas'),
(32, 1188392615, 1, 1219834716, 5, 1, 'BT', 'Bhutan'),
(33, 1188392615, 1, 1219834716, 5, 1, 'BV', 'Bouvet Island'),
(34, 1188392615, 1, 1219834716, 5, 1, 'BW', 'Botswana'),
(35, 1188392615, 1, 1219834716, 5, 1, 'BY', 'Belarus'),
(36, 1188392615, 1, 1219834716, 5, 1, 'BZ', 'Belize'),
(37, 1188392615, 1, 1219834716, 5, 1, 'CA', 'Canada'),
(38, 1188392615, 1, 1219834716, 5, 1, 'CC', 'Cocos Islands'),
(39, 1188392615, 1, 1219834716, 5, 1, 'CD', 'Congo'),
(40, 1188392615, 1, 1219834716, 5, 1, 'CF', 'Central African Republic'),
(41, 1188392615, 1, 1219834716, 5, 1, 'CG', 'Congo'),
(42, 1188392615, 1, 1219834716, 5, 1, 'CH', 'Switzerland'),
(43, 1188392615, 1, 1219834716, 5, 1, 'CI', 'C'),
(44, 1188392615, 1, 1219834716, 5, 1, 'CK', 'Cook Islands'),
(45, 1188392615, 1, 1219834716, 5, 1, 'CL', 'Chile'),
(46, 1188392615, 1, 1219834716, 5, 1, 'CM', 'Cameroon'),
(47, 1188392615, 1, 1219834716, 5, 1, 'CN', 'China'),
(48, 1188392615, 1, 1219834716, 5, 1, 'CO', 'Colombia'),
(49, 1188392615, 1, 1219834716, 5, 1, 'CR', 'Costa Rica'),
(50, 1188392615, 1, 1219834716, 5, 1, 'CU', 'Cuba'),
(51, 1188392615, 1, 1219834716, 5, 1, 'CV', 'Cape Verde'),
(52, 1188392615, 1, 1219834716, 5, 1, 'CX', 'Christmas Island'),
(53, 1188392615, 1, 1219834716, 5, 1, 'CY', 'Cyprus'),
(54, 1188392615, 1, 1219834716, 5, 1, 'CZ', 'Czech Republic'),
(55, 1188392615, 1, 1219834716, 5, 1, 'DE', 'Germany'),
(56, 1188392615, 1, 1219834716, 5, 1, 'DJ', 'Djibouti'),
(57, 1188392615, 1, 1219834716, 5, 1, 'DK', 'Denmark'),
(58, 1188392615, 1, 1219834716, 5, 1, 'DM', 'Dominica'),
(59, 1188392615, 1, 1219834716, 5, 1, 'DO', 'Dominican Republic'),
(60, 1188392615, 1, 1219834716, 5, 1, 'DZ', 'Algeria'),
(61, 1188392615, 1, 1219834716, 5, 1, 'EC', 'Ecuador'),
(62, 1188392615, 1, 1219834716, 5, 1, 'EE', 'Estonia'),
(63, 1188392615, 1, 1219834716, 5, 1, 'EG', 'Egypt'),
(64, 1188392615, 1, 1219834716, 5, 1, 'EH', 'Western Sahara'),
(65, 1188392615, 1, 1219834716, 5, 1, 'ER', 'Eritrea'),
(66, 1188392615, 1, 1219834716, 5, 1, 'ES', 'Spain'),
(67, 1188392615, 1, 1219834716, 5, 1, 'ET', 'Ethiopia'),
(68, 1188392615, 1, 1219834716, 5, 1, 'FI', 'Finland'),
(69, 1188392615, 1, 1219834716, 5, 1, 'FJ', 'Fiji'),
(70, 1188392615, 1, 1219834716, 5, 1, 'FK', 'Falkland Islands'),
(71, 1188392615, 1, 1219834716, 5, 1, 'FM', 'Micronesia'),
(72, 1188392615, 1, 1219834716, 5, 1, 'FO', 'Faroe Islands'),
(73, 1188392615, 1, 1219834716, 5, 1, 'FR', 'France'),
(74, 1188392615, 1, 1219834716, 5, 1, 'GA', 'Gabon'),
(75, 1188392615, 1, 1219834716, 5, 1, 'GB', 'United Kingdom'),
(76, 1188392615, 1, 1219834716, 5, 1, 'GD', 'Grenada'),
(77, 1188392615, 1, 1219834716, 5, 1, 'GE', 'Georgia'),
(78, 1188392615, 1, 1219834716, 5, 1, 'GF', 'French Guiana'),
(79, 1188392615, 1, 1219834716, 5, 1, 'GG', 'Guernsey'),
(80, 1188392615, 1, 1219834716, 5, 1, 'GH', 'Ghana'),
(81, 1188392615, 1, 1219834716, 5, 1, 'GI', 'Gibraltar'),
(82, 1188392615, 1, 1219834716, 5, 1, 'GL', 'Greenland'),
(83, 1188392615, 1, 1219834716, 5, 1, 'GM', 'Gambia'),
(84, 1188392615, 1, 1219834716, 5, 1, 'GN', 'Guinea'),
(85, 1188392615, 1, 1219834716, 5, 1, 'GP', 'Guadeloupe'),
(86, 1188392615, 1, 1219834716, 5, 1, 'GQ', 'Equatorial Guinea'),
(87, 1188392615, 1, 1219834716, 5, 1, 'GR', 'Greece'),
(88, 1188392615, 1, 1219834716, 5, 1, 'GS', 'South Georgia and the South Sandwich Islands'),
(89, 1188392615, 1, 1219834716, 5, 1, 'GT', 'Guatemala'),
(90, 1188392615, 1, 1219834716, 5, 1, 'GU', 'Guam'),
(91, 1188392615, 1, 1219834716, 5, 1, 'GW', 'Guinea-Bissau'),
(92, 1188392615, 1, 1219834716, 5, 1, 'GY', 'Guyana'),
(93, 1188392615, 1, 1219834716, 5, 1, 'HK', 'Hong Kong'),
(94, 1188392615, 1, 1219834716, 5, 1, 'HM', 'Heard Island and McDonald Island'),
(95, 1188392615, 1, 1219834716, 5, 1, 'HN', 'Honduras'),
(96, 1188392615, 1, 1219834716, 5, 1, 'HR', 'Croatia'),
(97, 1188392615, 1, 1219834716, 5, 1, 'HT', 'Haiti'),
(98, 1188392615, 1, 1219834716, 5, 1, 'HU', 'Hungary'),
(99, 1188392615, 1, 1219834716, 5, 1, 'ID', 'Indonesia'),
(100, 1188392615, 1, 1219834716, 5, 1, 'IE', 'Ireland'),
(101, 1188392615, 1, 1219834716, 5, 1, 'IL', 'Israel'),
(102, 1188392615, 1, 1219834716, 5, 1, 'IM', 'Isle of Man'),
(103, 1188392615, 1, 1219834716, 5, 1, 'IN', 'India'),
(104, 1188392615, 1, 1219834716, 5, 1, 'IO', 'British Indian Ocean Territory'),
(105, 1188392615, 1, 1219834716, 5, 1, 'IQ', 'Iraq'),
(106, 1188392615, 1, 1219834716, 5, 1, 'IR', 'Iran'),
(107, 1188392615, 1, 1219834716, 5, 1, 'IS', 'Iceland'),
(108, 1188392615, 1, 1219834716, 5, 1, 'IT', 'Italy'),
(109, 1188392615, 1, 1219834716, 5, 1, 'JE', 'Jersey'),
(110, 1188392615, 1, 1219834716, 5, 1, 'JM', 'Jamaica'),
(111, 1188392615, 1, 1219834716, 5, 1, 'JO', 'Jordan'),
(112, 1188392615, 1, 1219834716, 5, 1, 'JP', 'Japan'),
(113, 1188392615, 1, 1219834716, 5, 1, 'KE', 'Kenya'),
(114, 1188392615, 1, 1219834716, 5, 1, 'KG', 'Kyrgyzstan'),
(115, 1188392615, 1, 1219834716, 5, 1, 'KH', 'Cambodia'),
(116, 1188392615, 1, 1219834716, 5, 1, 'KI', 'Kiribati'),
(117, 1188392615, 1, 1219834716, 5, 1, 'KM', 'Comoros'),
(118, 1188392615, 1, 1219834716, 5, 1, 'KN', 'Saint Kitts and Nevis'),
(119, 1188392615, 1, 1219834716, 5, 1, 'KP', 'North Korea'),
(120, 1188392615, 1, 1219834716, 5, 1, 'KR', 'South Korea'),
(121, 1188392615, 1, 1219834716, 5, 1, 'KW', 'Kuwait'),
(122, 1188392615, 1, 1219834716, 5, 1, 'KY', 'Cayman Islands'),
(123, 1188392615, 1, 1219834716, 5, 1, 'KZ', 'Kazakhstan'),
(124, 1188392615, 1, 1219834716, 5, 1, 'LA', 'Lao'),
(125, 1188392615, 1, 1219834716, 5, 1, 'LB', 'Lebanon'),
(126, 1188392615, 1, 1219834716, 5, 1, 'LC', 'Saint Lucia'),
(127, 1188392615, 1, 1219834716, 5, 1, 'LI', 'Liechtenstein'),
(128, 1188392615, 1, 1219834716, 5, 1, 'LK', 'Sri Lanka'),
(129, 1188392615, 1, 1219834716, 5, 1, 'LR', 'Liberia'),
(130, 1188392615, 1, 1219834716, 5, 1, 'LS', 'Lesotho'),
(131, 1188392615, 1, 1219834716, 5, 1, 'LT', 'Lithuania'),
(132, 1188392615, 1, 1219834716, 5, 1, 'LU', 'Luxembourg'),
(133, 1188392615, 1, 1219834716, 5, 1, 'LV', 'Latvia'),
(134, 1188392615, 1, 1219834716, 5, 1, 'LY', 'Libyan Arab Jamahiriya'),
(135, 1188392615, 1, 1219834716, 5, 1, 'MA', 'Morocco'),
(136, 1188392615, 1, 1219834716, 5, 1, 'MC', 'Monaco'),
(137, 1188392615, 1, 1219834716, 5, 1, 'MD', 'Moldova'),
(138, 1188392615, 1, 1219834716, 5, 1, 'ME', 'Montenegro'),
(139, 1188392615, 1, 1219834716, 5, 1, 'MG', 'Madagascar'),
(140, 1188392615, 1, 1219834716, 5, 1, 'MH', 'Marshall Islands'),
(141, 1188392615, 1, 1219834716, 5, 1, 'MK', 'Macedonia'),
(142, 1188392615, 1, 1219834716, 5, 1, 'ML', 'Mali'),
(143, 1188392615, 1, 1219834716, 5, 1, 'MM', 'Myanmar'),
(144, 1188392615, 1, 1219834716, 5, 1, 'MN', 'Mongolia'),
(145, 1188392615, 1, 1219834716, 5, 1, 'MO', 'Macao'),
(146, 1188392615, 1, 1219834716, 5, 1, 'MP', 'Northern Mariana Islands'),
(147, 1188392615, 1, 1219834716, 5, 1, 'MQ', 'Martinique'),
(148, 1188392615, 1, 1219834716, 5, 1, 'MR', 'Mauritania'),
(149, 1188392615, 1, 1219834716, 5, 1, 'MS', 'Montserrat'),
(150, 1188392615, 1, 1219834716, 5, 1, 'MT', 'Malta'),
(151, 1188392615, 1, 1219834716, 5, 1, 'MU', 'Mauritius'),
(152, 1188392615, 1, 1219834716, 5, 1, 'MV', 'Maldives'),
(153, 1188392615, 1, 1219834716, 5, 1, 'MW', 'Malawi'),
(154, 1188392615, 1, 1219834716, 5, 1, 'MX', 'Mexico'),
(155, 1188392615, 1, 1219834716, 5, 1, 'MY', 'Malaysia'),
(156, 1188392615, 1, 1219834716, 5, 1, 'MZ', 'Mozambique'),
(157, 1188392615, 1, 1219834716, 5, 1, 'NA', 'Namibia'),
(158, 1188392615, 1, 1219834716, 5, 1, 'NC', 'New Caledonia'),
(159, 1188392615, 1, 1219834716, 5, 1, 'NE', 'Niger'),
(160, 1188392615, 1, 1219834716, 5, 1, 'NF', 'Norfolk Island'),
(161, 1188392615, 1, 1219834716, 5, 1, 'NG', 'Nigeria'),
(162, 1188392615, 1, 1219834716, 5, 1, 'NI', 'Nicaragua'),
(163, 1188392615, 1, 1219834716, 5, 1, 'NL', 'Netherlands'),
(164, 1188392615, 1, 1219834716, 5, 1, 'NO', 'Norway'),
(165, 1188392615, 1, 1219834716, 5, 1, 'NP', 'Nepal'),
(166, 1188392615, 1, 1219834716, 5, 1, 'NR', 'Nauru'),
(167, 1188392615, 1, 1219834716, 5, 1, 'NU', 'Niue'),
(168, 1188392615, 1, 1219834716, 5, 1, 'NZ', 'New Zealand'),
(169, 1188392615, 1, 1219834716, 5, 1, 'OM', 'Oman'),
(170, 1188392615, 1, 1219834716, 5, 1, 'PA', 'Panama'),
(171, 1188392615, 1, 1219834716, 5, 1, 'PE', 'Peru'),
(172, 1188392615, 1, 1219834716, 5, 1, 'PF', 'French Polynesia'),
(173, 1188392615, 1, 1219834716, 5, 1, 'PG', 'Papua New Guinea'),
(174, 1188392615, 1, 1219834716, 5, 1, 'PH', 'Philippines'),
(175, 1188392615, 1, 1219834716, 5, 1, 'PK', 'Pakistan'),
(176, 1188392615, 1, 1219834716, 5, 1, 'PL', 'Poland'),
(177, 1188392615, 1, 1219834716, 5, 1, 'PM', 'Saint Pierre and Miquelon'),
(178, 1188392615, 1, 1219834716, 5, 1, 'PN', 'Pitcairn'),
(179, 1188392615, 1, 1219834716, 5, 1, 'PR', 'Puerto Rico'),
(180, 1188392615, 1, 1219834716, 5, 1, 'PS', 'Palestinian'),
(181, 1188392615, 1, 1219834716, 5, 1, 'PT', 'Portugal'),
(182, 1188392615, 1, 1219834716, 5, 1, 'PW', 'Palau'),
(183, 1188392615, 1, 1219834716, 5, 1, 'PY', 'Paraguay'),
(184, 1188392615, 1, 1219834716, 5, 1, 'QA', 'Qatar'),
(185, 1188392615, 1, 1219834716, 5, 1, 'RE', 'R'),
(186, 1188392615, 1, 1219834716, 5, 1, 'RO', 'Romania'),
(187, 1188392615, 1, 1219834716, 5, 1, 'RS', 'Serbia'),
(188, 1188392615, 1, 1219834716, 5, 1, 'RU', 'Russian Federation'),
(189, 1188392615, 1, 1219834716, 5, 1, 'RW', 'Rwanda'),
(190, 1188392615, 1, 1219834716, 5, 1, 'SA', 'Saudi Arabia'),
(191, 1188392615, 1, 1219834716, 5, 1, 'SB', 'Solomon Islands'),
(192, 1188392615, 1, 1219834716, 5, 1, 'SC', 'Seychelles'),
(193, 1188392615, 1, 1219834716, 5, 1, 'SD', 'Sudan'),
(194, 1188392615, 1, 1219834716, 5, 1, 'SE', 'Sweden'),
(195, 1188392615, 1, 1219834716, 5, 1, 'SG', 'Singapore'),
(196, 1188392615, 1, 1219834716, 5, 1, 'SH', 'Saint Helena'),
(197, 1188392615, 1, 1219834716, 5, 1, 'SI', 'Slovenia'),
(198, 1188392615, 1, 1219834716, 5, 1, 'SJ', 'Svalbard and Jan Mayen'),
(199, 1188392615, 1, 1219834716, 5, 1, 'SK', 'Slovakia'),
(200, 1188392615, 1, 1219834716, 5, 1, 'SL', 'Sierra Leone'),
(201, 1188392615, 1, 1219834716, 5, 1, 'SM', 'San Marino'),
(202, 1188392615, 1, 1219834716, 5, 1, 'SN', 'Senegal'),
(203, 1188392615, 1, 1219834716, 5, 1, 'SO', 'Somalia'),
(204, 1188392615, 1, 1219834716, 5, 1, 'SR', 'Suriname'),
(205, 1188392615, 1, 1219834716, 5, 1, 'ST', 'Sao Tome and Principe'),
(206, 1188392615, 1, 1219834716, 5, 1, 'SV', 'El Salvador'),
(207, 1188392615, 1, 1219834716, 5, 1, 'SY', 'Syrian Arab Republic'),
(208, 1188392615, 1, 1219834716, 5, 1, 'SZ', 'Swaziland'),
(209, 1188392615, 1, 1219834716, 5, 1, 'TC', 'Turks and Caicos Islands'),
(210, 1188392615, 1, 1219834716, 5, 1, 'TD', 'Chad'),
(211, 1188392615, 1, 1219834716, 5, 1, 'TF', 'French Southern Territories'),
(212, 1188392615, 1, 1219834716, 5, 1, 'TG', 'Togo'),
(213, 1188392615, 1, 1219834716, 5, 1, 'TH', 'Thailand'),
(214, 1188392615, 1, 1219834716, 5, 1, 'TJ', 'Tajikistan'),
(215, 1188392615, 1, 1219834716, 5, 1, 'TK', 'Tokelau'),
(216, 1188392615, 1, 1219834716, 5, 1, 'TL', 'Timor-Leste'),
(217, 1188392615, 1, 1219834716, 5, 1, 'TM', 'Turkmenistan'),
(218, 1188392615, 1, 1219834716, 5, 1, 'TN', 'Tunisia'),
(219, 1188392615, 1, 1219834716, 5, 1, 'TO', 'Tonga'),
(220, 1188392615, 1, 1219834716, 5, 1, 'TR', 'Turkey'),
(221, 1188392615, 1, 1219834716, 5, 1, 'TT', 'Trinidad and Tobago'),
(222, 1188392615, 1, 1219834716, 5, 1, 'TV', 'Tuvalu'),
(223, 1188392615, 1, 1219834716, 5, 1, 'TW', 'Taiwan'),
(224, 1188392615, 1, 1219834716, 5, 1, 'TZ', 'Tanzania'),
(225, 1188392615, 1, 1219834716, 5, 1, 'UA', 'Ukraine'),
(226, 1188392615, 1, 1219834716, 5, 1, 'UG', 'Uganda'),
(227, 1188392615, 1, 1219834716, 5, 1, 'UM', 'United States Minor Outlying Islands'),
(228, 1188392615, 1, 1219834716, 5, 1, 'US', 'United States'),
(229, 1188392615, 1, 1219834716, 5, 1, 'UY', 'Uruguay'),
(230, 1188392615, 1, 1219834716, 5, 1, 'UZ', 'Uzbekistan'),
(231, 1188392615, 1, 1219834716, 5, 1, 'VA', 'Vatican'),
(232, 1188392615, 1, 1219834716, 5, 1, 'VC', 'Saint Vincent and the Grenadines'),
(233, 1188392615, 1, 1219834716, 5, 1, 'VE', 'Venezuela'),
(234, 1188392615, 1, 1219834716, 5, 1, 'VG', 'Virgin Islands, British'),
(235, 1188392615, 1, 1219834716, 5, 1, 'VI', 'Virgin Islands, U.S.'),
(236, 1188392615, 1, 1219834716, 5, 1, 'VN', 'Viet Nam'),
(237, 1188392615, 1, 1219834716, 5, 1, 'VU', 'Vanuatu'),
(238, 1188392615, 1, 1219834716, 5, 1, 'WF', 'Wallis and Futuna'),
(239, 1188392615, 1, 1219834716, 5, 1, 'WS', 'Samoa'),
(240, 1188392615, 1, 1219834716, 5, 1, 'YE', 'Yemen'),
(241, 1188392615, 1, 1219834716, 5, 1, 'YT', 'Mayotte'),
(242, 1188392615, 1, 1219834716, 5, 1, 'ZA', 'South Africa'),
(243, 1188392615, 1, 1219834716, 5, 1, 'ZM', 'Zambia'),
(244, 1188392615, 1, 1219834716, 5, 1, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `zz_data_etat_fichier`
--

CREATE TABLE IF NOT EXISTS `zz_data_etat_fichier` (
  `id_etat_fichier` int(11) NOT NULL AUTO_INCREMENT,
  `lib_etat_fichier` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id_etat_fichier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `zz_data_etat_fichier`
--

INSERT INTO `zz_data_etat_fichier` (`id_etat_fichier`, `lib_etat_fichier`) VALUES
(1, 'In waiting of validation'),
(2, 'Validated'),
(3, 'None validated');

-- --------------------------------------------------------

--
-- Table structure for table `zz_data_etat_pseudo`
--

CREATE TABLE IF NOT EXISTS `zz_data_etat_pseudo` (
  `id_etat_pseudo` int(11) NOT NULL AUTO_INCREMENT,
  `lib_etat_pseudo` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id_etat_pseudo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `zz_data_etat_pseudo`
--

INSERT INTO `zz_data_etat_pseudo` (`id_etat_pseudo`, `lib_etat_pseudo`) VALUES
(1, 'Nickname not valid'),
(2, 'Nickname validate');

-- --------------------------------------------------------

--
-- Table structure for table `zz_data_etat_report`
--

CREATE TABLE IF NOT EXISTS `zz_data_etat_report` (
  `id_etat_report` int(11) NOT NULL AUTO_INCREMENT,
  `lib_etat_report` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id_etat_report`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `zz_data_etat_report`
--

INSERT INTO `zz_data_etat_report` (`id_etat_report`, `lib_etat_report`) VALUES
(1, 'Pending'),
(2, 'Fixed'),
(3, 'Droped'),
(4, 'Done'),
(5, '<b>Return</b>'),
(6, 'Impossible'),
(7, 'Send'),
(8, 'Archive');

-- --------------------------------------------------------

--
-- Table structure for table `zz_data_etat_user`
--

CREATE TABLE IF NOT EXISTS `zz_data_etat_user` (
  `id_etat_user` int(11) NOT NULL AUTO_INCREMENT,
  `lib_etat_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id_etat_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `zz_data_etat_user`
--

INSERT INTO `zz_data_etat_user` (`id_etat_user`, `lib_etat_user`) VALUES
(1, 'Address email none validation'),
(2, 'Address email  validation');

-- --------------------------------------------------------

--
-- Table structure for table `zz_data_priorite_report`
--

CREATE TABLE IF NOT EXISTS `zz_data_priorite_report` (
  `id_priorite` int(11) NOT NULL AUTO_INCREMENT,
  `lib_priorite` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_priorite`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `zz_data_priorite_report`
--

INSERT INTO `zz_data_priorite_report` (`id_priorite`, `lib_priorite`) VALUES
(1, 'Low-level'),
(2, 'Average'),
(3, 'High');

-- --------------------------------------------------------

--
-- Table structure for table `zz_data_type_connection`
--

CREATE TABLE IF NOT EXISTS `zz_data_type_connection` (
  `id_type_connection` int(11) NOT NULL AUTO_INCREMENT,
  `lib_type_connection` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id_type_connection`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `zz_data_type_connection`
--

INSERT INTO `zz_data_type_connection` (`id_type_connection`, `lib_type_connection`) VALUES
(1, 'Login correct'),
(2, 'login error'),
(3, 'Unlog'),
(4, 'Connected by email link');

-- --------------------------------------------------------

--
-- Table structure for table `zz_data_type_fichier`
--

CREATE TABLE IF NOT EXISTS `zz_data_type_fichier` (
  `id_type_fichier` int(11) NOT NULL AUTO_INCREMENT,
  `lib_type_fichier` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id_type_fichier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `zz_data_type_fichier`
--

INSERT INTO `zz_data_type_fichier` (`id_type_fichier`, `lib_type_fichier`) VALUES
(1, 'Tab (top menu)'),
(2, 'Submenu'),
(3, 'Action'),
(4, 'Ajax'),
(5, 'Button'),
(6, 'Include'),
(7, 'Detail'),
(8, 'Menu Tab in page');

-- --------------------------------------------------------

--
-- Table structure for table `zz_data_type_mime`
--

CREATE TABLE IF NOT EXISTS `zz_data_type_mime` (
  `id_type_mime` int(11) NOT NULL AUTO_INCREMENT,
  `type_mime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_fichier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_type_mime`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `zz_data_type_mime`
--

INSERT INTO `zz_data_type_mime` (`id_type_mime`, `type_mime`, `type_fichier`) VALUES
(1, 'image/gif', 'Image GIF'),
(2, 'image/png', 'Image PNG'),
(3, 'image/jpeg,image/pjpeg', 'Image JPEG'),
(4, 'text/plain', 'Texte brut'),
(5, 'video/mpeg', 'Vid'),
(6, 'audio/mpeg', 'Audio MPEG');

-- --------------------------------------------------------

--
-- Table structure for table `zz_data_type_privilege`
--

CREATE TABLE IF NOT EXISTS `zz_data_type_privilege` (
  `id_type_privilege` int(11) NOT NULL AUTO_INCREMENT,
  `lib_type_privilege` char(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id_type_privilege`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `zz_data_type_privilege`
--

INSERT INTO `zz_data_type_privilege` (`id_type_privilege`, `lib_type_privilege`) VALUES
(1, '1.Read'),
(2, '2.New/create'),
(3, '3.Modify'),
(4, '0.Full access'),
(5, '4.Delete');

-- --------------------------------------------------------

--
-- Table structure for table `_adm_dossier`
--

CREATE TABLE IF NOT EXISTS `_adm_dossier` (
  `id_dossier` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_createur` int(11) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(11) NOT NULL DEFAULT '0',
  `etat_doc` int(2) NOT NULL DEFAULT '1',
  `url_dossier` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id_dossier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `_adm_dossier`
--

INSERT INTO `_adm_dossier` (`id_dossier`, `date_creation`, `id_createur`, `date_modification`, `id_modificateur`, `etat_doc`, `url_dossier`) VALUES
(1, 1202306148, 1, 1202306148, 1, 1, ''),
(2, 1202306148, 1, 1202306148, 1, 1, 'admin/'),
(3, 1202306148, 1, 1202306148, 1, 1, 'reporting/'),
(4, 1202306148, 1, 1202306148, 1, 1, 'upload/'),
(5, 1202306148, 1, 1202306148, 1, 1, 'navigation/'),
(6, 1202306148, 1, 1202306148, 1, 1, 'moderation/'),
(10, 1202306148, 1, 1202306148, 1, 1, 'proviva/');

-- --------------------------------------------------------

--
-- Table structure for table `_adm_fichier`
--

CREATE TABLE IF NOT EXISTS `_adm_fichier` (
  `id_fichier` int(10) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_createur` int(10) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(10) NOT NULL DEFAULT '0',
  `etat_doc` int(1) NOT NULL DEFAULT '1',
  `nom_fichier` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description_fichier` text COLLATE utf8_unicode_ci NOT NULL,
  `intitule_fichier` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `id_dossier` int(11) NOT NULL DEFAULT '0',
  `id_type_fichier` int(11) NOT NULL DEFAULT '0',
  `id_adm_image_fichier` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_fichier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=279 ;

--
-- Dumping data for table `_adm_fichier`
--

INSERT INTO `_adm_fichier` (`id_fichier`, `date_creation`, `id_createur`, `date_modification`, `id_modificateur`, `etat_doc`, `nom_fichier`, `description_fichier`, `intitule_fichier`, `id_dossier`, `id_type_fichier`, `id_adm_image_fichier`) VALUES
(1, 1202306148, 1, 1205297792, 1, 1, 'index', 'Back office home page', 'Home page', 1, 1, NULL),
(2, 1202306148, 1, 1202306148, 1, 1, 'admin', 'Administration center of application home page', 'Administration', 2, 1, NULL),
(3, 1202306148, 1, 1213944948, 5, 1, 'admin_fichier', 'Display files list', 'Files', 2, 2, NULL),
(4, 1202306148, 1, 1215078324, 25, 1, 'admin_fichier_ajout', 'Create file by step. \r\nStep 1: Detail and add entrie in database with a etat_doc=2.\r\n\r\nStep 2 : Link with a existing access right or with a new one.\r\n\r\nStep 3 : Link with others files (father or children)\r\n\r\nStep 4 : Record and display details', 'Create', 2, 3, 1),
(5, 1202306148, 1, 1202306148, 1, 1, 'admin_fichier_modif', 'Modify file details', 'Modify', 2, 3, 2),
(6, 1202306148, 1, 1202306148, 1, 1, 'admin_fichier_suppr', 'Delete file', 'Delete', 2, 3, 3),
(7, 1202306148, 1, 1202306148, 1, 1, 'admin_fichier_detail', 'Display file details', 'File details', 2, 7, NULL),
(9, 1202306148, 1, 1213098623, 5, 1, 'admin_fichier_privilege_ajout', 'Menu list to link access rights to file', 'Add access right', 2, 6, NULL),
(10, 1202306148, 1, 1202306148, 1, 1, 'admin_fichier_privilege_suppr', 'Unlink access right and file', 'Delete', 2, 6, NULL),
(11, 1202306148, 1, 1202306148, 1, 1, 'admin_fichier_arborescence', 'Menu Tab files parent and child in file details', 'Files connection', 2, 8, NULL),
(12, 1202306148, 1, 1213098087, 5, 1, 'admin_fichier_arborescence_ajout', 'Menu list to link father or children to a file', 'Add file', 2, 6, NULL),
(13, 1202306148, 1, 1202306148, 1, 1, 'admin_fichier_arborescence_suppr', 'Unlink parent between files', 'Delete', 2, 6, NULL),
(14, 1202306148, 1, 1205295949, 1, 1, 'admin_user', 'Display users list', 'Users', 2, 2, NULL),
(15, 1202306148, 1, 1202306148, 1, 1, 'admin_user_ajout', 'Create new user', 'Create', 2, 3, 1),
(16, 1202306148, 1, 1214369453, 20, 1, 'admin_user_modif', 'Modify user login name', 'Modify login', 2, 3, 2),
(17, 1202306148, 1, 1202306148, 1, 1, 'admin_user_suppr', 'Delete user and all links', 'Delete', 2, 3, 3),
(18, 1202306148, 1, 1213174463, 5, 1, 'admin_user_detail', 'Display user details', 'User details', 2, 7, NULL),
(19, 1202306148, 1, 1202306148, 1, 1, 'admin_user_groupe', 'Menu Tab groups in user details', 'Groups', 2, 8, NULL),
(20, 1202306148, 1, 1202306148, 1, 1, 'admin_user_histo', 'Menu Tab connections history in user details', 'Connection history', 2, 8, NULL),
(21, 1202306148, 1, 1202306148, 1, 1, 'admin_user_pass', 'Button to clear user password', 'Clear password', 2, 5, NULL),
(22, 1202306148, 1, 1205295578, 1, 1, 'admin_groupe', 'Display groups list', 'Access groups', 2, 2, NULL),
(23, 1202306148, 1, 1202306148, 1, 1, 'admin_groupe_ajout', 'Create new group', 'Create', 2, 3, 1),
(24, 1202306148, 1, 1202306148, 1, 1, 'admin_groupe_modif', 'Modify group details', 'Modify', 2, 3, 2),
(25, 1202306148, 1, 1202306148, 1, 1, 'admin_groupe_suppr', 'Delete group and all links', 'Delete', 2, 3, 3),
(26, 1202306148, 1, 1202306148, 1, 1, 'admin_groupe_detail', 'Display group details', 'Group details', 2, 7, NULL),
(27, 1202306148, 1, 1202306148, 1, 1, 'admin_groupe_privilege', 'Menu Tab access rights in group details', 'Access rights', 2, 8, NULL),
(28, 1202306148, 1, 1202306148, 1, 1, 'admin_groupe_privilege_ajout', 'Menu list to link access right to group access', 'Add access right', 2, 6, NULL),
(29, 1202306148, 1, 1202306148, 1, 1, 'admin_groupe_privilege_suppr', 'Unlink group and access right', 'Delete', 2, 6, NULL),
(30, 1202306148, 1, 1202306148, 1, 1, 'admin_groupe_user', 'Menu Tab users in group details', 'Users', 2, 8, NULL),
(31, 1202306148, 1, 1202306148, 1, 1, 'admin_groupe_user_ajout', 'Menu list to link user to access group', 'Add user', 2, 6, NULL),
(32, 1202306148, 1, 1202306148, 1, 1, 'admin_groupe_user_suppr', 'Unlink user and group', 'Delete', 2, 6, NULL),
(33, 1202306148, 1, 1205296003, 1, 1, 'admin_privilege', 'Display access rights list', 'Access rights', 2, 2, NULL),
(34, 1202306148, 1, 1202306148, 1, 1, 'admin_privilege_ajout', 'Create new access right', 'Create', 2, 3, 1),
(35, 1202306148, 1, 1202306148, 1, 1, 'admin_privilege_modif', 'Modify access right details', 'Modify', 2, 3, 2),
(36, 1202306148, 1, 1202306148, 1, 1, 'admin_privilege_suppr', 'Delete access right and all links', 'Delete', 2, 3, 3),
(37, 1202306148, 1, 1202306148, 1, 1, 'admin_privilege_detail', 'Display access right details', 'Access right details', 2, 7, NULL),
(38, 1202306148, 1, 1202306148, 1, 1, 'admin_privilege_fichier', 'Menu Tab files in access rights details', 'Files', 2, 8, NULL),
(39, 1202306148, 1, 1202306148, 1, 1, 'admin_privilege_fichier_ajout', 'Menu list to link file to access right', 'Add file', 2, 6, NULL),
(40, 1202306148, 1, 1202306148, 1, 1, 'admin_privilege_fichier_suppr', 'Unlink file and access right', 'Delete', 2, 6, NULL),
(41, 1202306148, 1, 1205295645, 1, 1, 'admin_menu', 'Display and specify order for Tab, submenu et Menu Tab in page', 'Order menu', 2, 2, NULL),
(42, 1202306148, 1, 1205129483, 11, 1, 'reporting', 'Reporting zone home page', 'Reporting', 3, 1, NULL),
(43, 1202306148, 1, 1205298348, 1, 1, 'reporting_online', 'Display connected users list right now', 'Online now', 3, 2, NULL),
(44, 1202306148, 1, 1205298088, 1, 1, 'reporting_demande', 'Display request pending list', 'Requests', 3, 2, NULL),
(45, 1202306148, 1, 1205298146, 1, 1, 'reporting_demande_detail', 'Display request details and history', 'Request details and history', 3, 7, NULL),
(46, 1202306148, 1, 1202306148, 1, 1, 'reporting_demande_priorite', 'Button to change request priority', 'Request priority', 3, 5, NULL),
(47, 1202306148, 1, 1205298392, 1, 1, 'reporting_probleme', 'Display bugs pending list', 'Bugs report', 3, 2, NULL),
(48, 1202306148, 1, 1213157531, 20, 1, 'reporting_probleme_detail', 'Display bug details and history', 'Bug details and history', 3, 7, NULL),
(49, 1202306148, 1, 1213246393, 5, 1, 'reporting_probleme_priorite', 'Button to change bug priority', 'Bug priority', 3, 5, NULL),
(50, 1202306148, 1, 1205298289, 1, 1, 'reporting_discussion', 'Display customers messages pending list', 'Members messages', 3, 2, NULL),
(51, 1202306148, 1, 1202306148, 1, 1, 'reporting_discussion_detail', 'Display customer message details and history', 'Customer message details and history', 3, 7, NULL),
(52, 1202306148, 1, 1202306148, 1, 1, 'reporting_discussion_priorite', 'Button to change customer message answer priority', 'Message priority', 3, 5, NULL),
(53, 1202306148, 1, 1205297899, 1, 1, 'upload', 'upload file system center home page', 'Upload center', 4, 1, NULL),
(54, 1202306148, 1, 1205219599, 11, 1, 'upload_repertoire', 'Display upload folders list', 'Upload folders', 4, 2, NULL),
(55, 1202306148, 1, 1202306148, 1, 1, 'upload_repertoire_detail', 'Display upload folder details', 'Upload folder details', 4, 7, NULL),
(56, 1202306148, 1, 1202306148, 1, 1, 'upload_repertoire_ajout', 'Create new upload folder', 'Create', 4, 3, 1),
(57, 1202306148, 1, 1202306148, 1, 1, 'upload_repertoire_modif', 'Modify upload folder details', 'Modify', 4, 3, 2),
(58, 1202306148, 1, 1202306148, 1, 1, 'upload_repertoire_suppr', 'Delete folder and all links', 'Delete', 4, 3, 3),
(59, 1202306148, 1, 1202306148, 1, 1, 'upload_repertoire_format', 'Menu Tab size format in upload folder details', 'Size formats', 4, 8, NULL),
(60, 1202306148, 1, 1202306148, 1, 1, 'upload_repertoire_format_ajout', 'Menu list to link size to folder', 'Add size', 4, 6, NULL),
(61, 1202306148, 1, 1202306148, 1, 1, 'upload_repertoire_format_suppr', 'Unlink size format and folder', 'Delete', 4, 6, NULL),
(62, 1202306148, 1, 1202306148, 1, 1, 'upload_repertoire_mime', 'Menu Tab MIME types in upload folder details', 'Types MIME', 4, 8, NULL),
(63, 1202306148, 1, 1202306148, 1, 1, 'upload_repertoire_mime_ajout', 'Menu list to link MIME type to folder', 'Add MIME type', 4, 6, NULL),
(64, 1202306148, 1, 1202306148, 1, 1, 'upload_repertoire_mime_suppr', 'Unlink MIME type and folder', 'Delete', 4, 6, NULL),
(65, 1202306148, 1, 1202306148, 1, 1, 'upload_repertoire_recreate', 'Create/update thumbnails for image size format', 'Update thumbnails', 4, 3, NULL),
(66, 1202306148, 1, 1205219479, 11, 1, 'upload_fichier', 'Display upload files list', 'Upload files', 4, 2, NULL),
(67, 1202306148, 1, 1202306148, 1, 1, 'upload_fichier_ajout', 'Upload a new file', 'Create', 4, 3, 1),
(68, 1202306148, 1, 1202306148, 1, 1, 'upload_fichier_detail', 'Display upload file details', 'Upload file details', 4, 7, NULL),
(69, 1202306148, 1, 1202306148, 1, 1, 'upload_fichier_modif', 'Modify upload file details', 'Modify', 4, 3, 2),
(70, 1202306148, 1, 1202306148, 1, 1, 'upload_fichier_suppr', 'Delete upload file and all links', 'Delete', 4, 3, 3),
(71, 1202306148, 1, 1205219551, 11, 1, 'upload_format', 'Display size formats list', 'Size formats', 4, 2, NULL),
(72, 1202306148, 1, 1202306148, 1, 1, 'upload_format_ajout', 'Create new size format for images folder', 'Create', 4, 3, 1),
(73, 1202306148, 1, 1202306148, 1, 1, 'upload_format_detail', 'Display size format details', 'Size format details', 4, 7, NULL),
(74, 1202306148, 1, 1202306148, 1, 1, 'upload_format_modif', 'Modify size format details', 'Modify', 4, 3, 2),
(75, 1202306148, 1, 1202306148, 1, 1, 'upload_format_suppr', 'Delete size format and all links', 'Delete', 4, 3, 3),
(76, 1202306148, 1, 1205297857, 1, 1, 'navigation', 'Navigation home page', 'Navigate', 5, 1, NULL),
(78, 1202306148, 1, 1205297642, 1, 1, 'navigation_rubrique_liste', 'Display categories list', 'Categories', 5, 2, NULL),
(79, 1202306148, 1, 1202306148, 1, 1, 'navigation_rubrique_ajout', 'Create new category', 'Create', 5, 3, 1),
(80, 1202306148, 1, 1202306148, 1, 1, 'navigation_rubrique_detail', 'Display category details', 'Category details', 5, 7, NULL),
(81, 1202306148, 1, 1202306148, 1, 1, 'navigation_rubrique_modif', 'Modify category details', 'Modify', 5, 3, 2),
(82, 1202306148, 1, 1202306148, 1, 1, 'navigation_rubrique_suppr', 'Delete category and all links', 'Delete', 5, 3, 3),
(83, 1202306148, 1, 1248679099, 39, 0, 'navigation_rubrique_ordre', 'Display and modify categories order', 'Categories order', 5, 2, NULL),
(84, 1202306148, 1, 1248679526, 39, 0, 'navigation_rubrique_arbo', 'Display categories tree', 'Categories tree', 5, 2, NULL),
(85, 1202306148, 1, 1248679414, 39, 0, 'navigation_rubrique_arbo_modif_fr', 'Menu Tab category tree for French version', 'French', 5, 8, 2),
(86, 1202306148, 1, 1205297826, 1, 1, 'moderation', 'Moderation content home page', 'Moderate', 6, 1, NULL),
(87, 1202306148, 1, 1205301414, 1, 1, 'moderation_pseudo', 'Display nicknames pending list', 'Nicknames pending', 6, 2, NULL),
(95, 1205123726, 11, 1205123726, 11, 1, 'content', 'Content zone home page', 'Content', 7, 1, NULL),
(96, 1205124142, 11, 1220234150, 5, 1, 'content_lantern', 'Display products list', 'Products', 7, 2, NULL),
(97, 1205124453, 11, 1205124453, 11, 1, 'content_lantern_detail', 'Display lantern details', 'Lantern details', 7, 7, NULL),
(98, 1205124648, 11, 1205124648, 11, 1, 'content_lantern_modify', 'Modify lantern details', 'Modify', 7, 3, 2),
(99, 1205124834, 11, 1205124834, 11, 1, 'content_lantern_create', 'Create new lantern', 'Create', 7, 3, 1),
(100, 1205125058, 11, 1205125058, 11, 1, 'content_lantern_delete', 'Delete category and all links', 'Delete', 7, 3, 3),
(101, 1205202067, 11, 1205202315, 11, 1, 'content_lantern_category_create', 'Menu list to link category to lantern', 'Add category', 7, 6, NULL),
(102, 1205202562, 11, 1226293211, 5, 1, 'content_lantern_category', 'Menu Tab categories in lantern detail', 'Categories', 7, 8, NULL),
(103, 1205202698, 11, 1205202698, 11, 1, 'content_lantern_category_delete', 'Unlink category and lantern', 'Delete', 7, 6, NULL),
(104, 1205221380, 11, 1226293372, 5, 1, 'content_lantern_photos', 'Menu Tab photos in lantern details.', 'Photos', 7, 8, NULL),
(105, 1205221707, 11, 1205222041, 11, 1, 'content_lantern_photos_create', 'Menu list to link photo to lantern', 'Add photo', 7, 6, NULL),
(106, 1205221954, 11, 1205221954, 11, 1, 'content_lantern_photos_delete', 'Unlink photo and lantern', 'Delete', 7, 6, NULL),
(107, 1205229490, 12, 1226293268, 5, 1, 'admin_user_cart', 'Menu Tab cart history in user details', 'History Cart', 2, 8, NULL),
(108, 1205289702, 11, 1205289702, 11, 1, 'upload_file_create_module', 'search field and ajax code for including upload file system', 'independant module for upload file', 4, 6, NULL),
(109, 1207026032, 11, 1220234124, 5, 1, 'content_discount', 'Display discount codes list', 'Discount codes', 7, 2, NULL),
(111, 1205306385, 12, 1248675809, 1, 1, 'navigation_category_product_relationship', 'Menu Tab categories ralationship of a categorie', 'Category relationships', 5, 8, NULL),
(112, 1205311315, 12, 1220234244, 5, 1, 'navigation_rubrique_lantern', 'Menu Tab products in a category details', 'Products', 5, 8, NULL),
(114, 1205312254, 12, 1205312254, 12, 1, 'navigation_rubrique_lantern_delete', 'Unlink category and lantern', 'Delete', 5, 6, NULL),
(116, 1205315936, 12, 1205315936, 12, 1, 'navigation_rubrique_lantern_create', 'Menu list to link lantern to category', 'Add lantern', 5, 6, NULL),
(117, 1205826218, 12, 1205826218, 12, 1, 'content_lantern_stock', 'Menu Tab entries stock in a lantern details', 'Entries stock', 7, 8, NULL),
(118, 1205826352, 12, 1205826352, 12, 1, 'content_lantern_stock_create', 'Menu list to link entries stock to lantern', 'Add entrie stock', 7, 6, NULL),
(119, 1205826456, 12, 1205826456, 12, 1, 'content_lantern_stock_delete', 'Unlink entrie stock and lantern', 'Delete', 7, 6, NULL),
(120, 1205900545, 12, 1205900545, 12, 1, 'content_stock', 'Display entries stock list', 'Entries stock', 7, 2, NULL),
(121, 1205914224, 12, 1205914224, 12, 1, 'content_stock_detail', 'Display entrie stock details', 'Entrie stock details', 7, 7, NULL),
(122, 1205975159, 12, 1205975159, 12, 1, 'content_stock_delete', 'Delete entrie stock and all links', 'Delete', 7, 3, 3),
(123, 1207026275, 11, 1207030852, 11, 1, 'content_discount_create', 'Create new discount code.', 'Create', 7, 3, 1),
(124, 1207190133, 11, 1207190133, 11, 1, 'moderation_lantern_info', 'Display lantern information reply by customer list.', 'Latern info by customer', 6, 2, NULL),
(127, 1207190773, 11, 1207190773, 11, 1, 'moderation_lantern_info_detail', 'Display lantern customer information details', 'Lantern customer information details', 6, 7, NULL),
(128, 1207191580, 11, 1207191580, 11, 1, 'moderation_lantern_info_modify', 'Button to validate customer inofrmation on lantern', 'Validate customer information', 6, 5, NULL),
(130, 1207652111, 12, 1213173946, 5, 1, 'admin_user_pdf', 'Menu Tab invoice pdf in user details', 'Invoices', 2, 8, NULL),
(132, 1207888960, 11, 1207894839, 12, 1, 'content_discount_detail', 'Display discount code details', 'Discount code details', 7, 7, NULL),
(133, 1207889071, 11, 1207889071, 11, 1, 'content_discount_delete', 'Delete discount', 'Delete', 7, 3, 3),
(134, 1208773998, 11, 1208773998, 11, 1, 'content_lantern_main_photos', 'Choose main photo for lantern', 'Choose main photo', 7, 6, NULL),
(135, 1209093939, 11, 1209094346, 11, 1, 'content_provider', 'Display providers list', 'Shipping providers', 7, 2, NULL),
(136, 1209095229, 11, 1209095229, 11, 1, 'content_provider_create', 'Create new provider', 'Create', 7, 3, 1),
(137, 1209096222, 11, 1209096222, 11, 1, 'content_provider_detail', 'Display provider details', 'Provider details', 7, 7, NULL),
(138, 1209109401, 11, 1209109401, 11, 1, 'content_provider_logo', 'Menu Tab logo in provider detail', 'Logo', 7, 8, NULL),
(139, 1209111836, 11, 1209111836, 11, 1, 'content_provider_logo_create', 'Menu list to link logo to provider', 'Add logo', 7, 6, NULL),
(140, 1209118840, 11, 1209118840, 11, 1, 'content_provider_logo_delete', 'Unlink logo and provider', 'Delete', 7, 6, NULL),
(141, 1209351565, 12, 1209351565, 12, 1, 'content_provider_modify', 'Modify provider details', 'Modify', 7, 3, 2),
(142, 1209351822, 12, 1209351822, 12, 1, 'content_provider_delete', 'Delete provider and all links', 'Delete', 7, 3, 3),
(143, 1209464798, 12, 1209464798, 12, 1, 'content_provider_country', 'Menu Tab countries in provider details', 'Countries', 7, 8, NULL),
(144, 1209465066, 12, 1209465066, 12, 1, 'content_provider_country_create', 'Menu list to link country to provider', 'Add country', 7, 6, NULL),
(145, 1209465233, 12, 1209465233, 12, 1, 'content_provider_country_delete', 'Unlink country and provider', 'Delete', 7, 6, NULL),
(146, 1212468386, 12, 1213250325, 5, 1, 'webrank_sitemap', 'Display URL list used in Sitemap', 'URL for sitemap', 8, 2, NULL),
(147, 1212549116, 12, 1212555301, 12, 1, 'webrank', 'Webranking zone home page', 'Webranking', 8, 1, NULL),
(148, 1212549263, 12, 1213324881, 5, 1, 'webrank_history_sitemap_list', 'Display history sitemap creation list', 'History sitemap', 8, 2, NULL),
(149, 1212552390, 12, 1213250135, 5, 1, 'webrank_sitemap_create', 'Create sitemap file on server and historise last sitemap file', 'Create', 8, 3, 1),
(151, 1213065410, 20, 1213065410, 20, 1, 'admin_fichier_privilege', 'Menu Tab access rights in file details', 'Access rights', 2, 8, NULL),
(152, 1213068167, 20, 1213078417, 20, 1, 'admin_privilege_groupe', 'Menu Tab groups in access right details', 'Groups', 2, 8, NULL),
(153, 1213079666, 20, 1213098137, 5, 1, 'admin_privilege_groupe_ajout', 'Menu list to link group to access right', 'Add group', 2, 6, NULL),
(154, 1213087282, 20, 1213087282, 20, 1, 'admin_privilege_groupe_suppr', 'Unlink parent between files', 'Delete', 2, 6, NULL),
(155, 1213178342, 20, 1213178342, 20, 1, 'content_provider_country_detail', 'Display country and provider link details', 'Country and provider link', 7, 7, NULL),
(156, 1213233791, 20, 1213326780, 20, 1, 'content_country', 'Display country list', 'Shipping countries', 7, 2, NULL),
(157, 1213234613, 20, 1213234613, 20, 1, 'content_country_create', 'Create new country', 'Create', 7, 3, 1),
(158, 1213235131, 20, 1213235131, 20, 1, 'content_country_detail', 'Display country details', 'Country details', 7, 7, NULL),
(159, 1213235537, 20, 1213235537, 20, 1, 'content_country_modify', 'Modify country detail', 'Modify', 7, 3, 2),
(160, 1213235847, 20, 1213235847, 20, 1, 'content_country_delete', 'Delete country and all links', 'Delete', 7, 3, 3),
(161, 1213243471, 20, 1213243471, 20, 1, 'content_country_provider', 'Menu Tap provider in country details', 'Provider', 7, 8, NULL),
(162, 1213243880, 20, 1213243880, 20, 1, 'content_country_provider_delete', 'Unlink between country and provider', 'Delete', 7, 6, NULL),
(163, 1213244381, 20, 1213244381, 20, 1, 'content_country_provider_create', 'Menu list to link providers to country', 'Attach', 7, 6, NULL),
(164, 1213326546, 20, 1213326889, 20, 1, 'content_country_provider_price_modify', 'Modify shipping price between the country and provider', 'Modify', 7, 3, 2),
(165, 1213590472, 20, 1220234129, 5, 1, 'content_footer_page', 'Display footer page list', 'Footer pages', 7, 2, NULL),
(166, 1213579436, 12, 1213579436, 12, 1, 'webrank_sitemap_category', 'Menu Tab categories URL in sitemate', 'Category', 8, 8, NULL),
(167, 1213585110, 12, 1213585110, 12, 1, 'webrank_sitemap_lantern', 'Menu Tab lantern URL in sitemate', 'Element', 8, 8, NULL),
(168, 1213606959, 20, 1213606959, 20, 1, 'content_footer_page_create', 'Create new footer page', 'Create', 7, 3, 1),
(169, 1213610444, 20, 1213610444, 20, 1, 'content_footer_page_detail', 'Display footer page details', 'Footer page details', 7, 7, NULL),
(170, 1213610872, 20, 1213610872, 20, 1, 'content_footer_page_modify', 'Modify footer page details', 'Modify', 7, 3, 2),
(171, 1213611045, 20, 1213611045, 20, 1, 'content_footer_page_delete', 'Delete footer page', 'Delete', 7, 3, 3),
(173, 1213759232, 20, 1213759232, 20, 1, 'content_page', 'Display pages list', 'Pages', 7, 2, NULL),
(174, 1213759487, 20, 1213759487, 20, 1, 'content_page_create', 'Create new page', 'Create', 7, 3, 1),
(175, 1213759601, 20, 1213759601, 20, 1, 'content_page_detail', 'Display page details', 'Page details', 7, 7, NULL),
(176, 1213759749, 20, 1213759763, 20, 1, 'content_page_modify', 'Modify page details', 'Modify', 7, 3, 2),
(177, 1213759852, 20, 1213759852, 20, 1, 'content_page_delete', 'Delete page', 'Delete', 7, 3, 3),
(178, 1213771974, 20, 1213771974, 20, 1, 'content_page_content', 'Menu Tab content in page details', 'Content', 7, 8, NULL),
(179, 1214211180, 20, 1214211180, 20, 1, 'admin_user_groupe_add', 'Menu list to link groups to user', 'Add group', 2, 6, NULL),
(180, 1214452060, 18, 1220234225, 5, 1, 'content_lantern_stock_menu', 'Menu Tab product stock details', 'Products', 7, 8, NULL),
(181, 1214271639, 20, 1214271639, 20, 1, 'admin_user_groupe_delete', 'Unlink between user and group', 'Delete', 2, 6, NULL),
(182, 1214278524, 20, 1226293469, 5, 1, 'upload_fichier_photo', 'Menu Tab photos in file upload details', 'Photos', 4, 8, NULL),
(183, 1214357218, 20, 1214357218, 20, 1, 'admin_fichier_check', 'Check file has been deleted', 'Check', 2, 3, NULL),
(184, 1214357295, 20, 1214357295, 20, 1, 'admin_fichier_check_delete', 'Delete file', 'Delete', 2, 6, NULL),
(185, 1214358267, 20, 1214358267, 20, 1, 'admin_user_detail_nickname', 'Display user&#039;s nickname', 'Nickname', 2, 6, NULL),
(186, 1214358364, 20, 1214358364, 20, 1, 'admin_user_detail_address', 'Display user&#039;s address', 'Address', 2, 6, NULL),
(187, 1214365070, 20, 1214368583, 20, 1, 'admin_user_info_modif', 'Modify user informations', 'Modify info', 2, 3, 2),
(204, 1214902160, 20, 1248679456, 39, 0, 'navigation_rubrique_arbos_modif', 'Modify all language tree', 'Modify all', 5, 3, NULL),
(205, 1214962897, 20, 1248679373, 39, 0, 'navigation_rubrique_arbo_modif_en', 'Menu Tab categories tree for English version', 'English', 5, 8, NULL),
(208, 1215578483, 20, 1215578483, 20, 1, 'admin_language', 'Display languages list', 'Languages', 2, 2, NULL),
(209, 1215583950, 20, 1215583950, 20, 1, 'admin_language_create', 'Create new language', 'Create', 2, 3, 1),
(210, 1215585859, 20, 1215585859, 20, 1, 'admin_language_detail', 'Display language details', 'Language details', 2, 7, NULL),
(211, 1215590079, 20, 1215590079, 20, 1, 'admin_language_modify', 'Modify language details', 'Modify', 2, 3, 2),
(213, 1215594920, 20, 1215596379, 20, 1, 'admin_language_config_create', 'Create configure file for the language, define REP language', 'Create config', 2, 3, 1),
(219, 1216951469, 18, 1226293432, 5, 1, 'index_user_requests', 'Menu Tab user request on home', 'Users requests', 1, 8, NULL),
(220, 1216961415, 18, 1226293390, 5, 1, 'index_stock_activities', 'Menu Tab stock activities on home', 'Stock activities', 1, 8, NULL),
(221, 1216969851, 18, 1226293415, 5, 1, 'index_user_entries', 'Menu Tab user entries on home', 'User entries', 1, 8, NULL),
(222, 1217387302, 18, 1217387302, 18, 1, 'content_country_free_shipping', 'Menu Tap provider in country free shipping', 'Free shipping', 7, 8, NULL),
(223, 1217404020, 18, 1226292667, 5, 1, 'content_country_list', 'Menu Tab list country', 'Countries', 7, 8, NULL),
(224, 1217405828, 18, 1226293202, 5, 1, 'content_country_list_free_shipping', 'Menu Tab free shipping for countries', 'Free shipping', 7, 8, NULL),
(225, 1221464993, 32, 1226292801, 5, 1, 'content_lantern_content', 'Menu Tab contest in lantern details', 'View in contest', 7, 8, NULL),
(229, 1222931822, 32, 1222931822, 32, 1, 'content_lantern_photos_upload', 'upload photo file to system', 'upload photo', 7, 6, NULL),
(230, 1248315592, 1, 1248315592, 1, 1, 'content_product_keyword', 'Display keyword list', 'Keywords', 7, 2, NULL),
(231, 1248315766, 1, 1248315766, 1, 1, 'content_product_keyword_create', 'Create new keyword', 'Create', 7, 3, 1),
(232, 1248315911, 1, 1248315911, 1, 1, 'content_product_keyword_detail', 'Display keyword details', 'Keyword details', 7, 7, NULL),
(233, 1248316101, 1, 1248316101, 1, 1, 'content_product_keyword_modify', 'Modify keyword details', 'Modify', 7, 3, 2),
(234, 1248316269, 1, 1248316269, 1, 1, 'content_product_keyword_delete', 'Delete keyword', 'Delete', 7, 3, 3),
(235, 1248316467, 1, 1248316467, 1, 1, 'content_product_keyword_product', 'Tab link keyword to product', 'Product', 7, 8, NULL),
(236, 1248316603, 1, 1248316603, 1, 1, 'content_product_keyword_product_add', 'Attach keyword to product', 'Attach', 7, 6, NULL),
(237, 1248316771, 1, 1248316771, 1, 1, 'content_product_keyword_product_delete', 'Unlink product from keyword', 'Delete', 7, 6, NULL),
(238, 1248317511, 1, 1248317511, 1, 1, 'content_lantern_keyword', 'Tab menu keyword for product', 'Keywords', 7, 8, NULL),
(239, 1248317636, 1, 1248317636, 1, 1, 'content_lantern_keyword_add', 'Attach keyword to product', 'Attach', 7, 6, NULL),
(240, 1248317736, 1, 1248317736, 1, 1, 'content_lantern_keyword_delete', 'Unlink keyword from product', 'Delete', 7, 6, NULL),
(241, 1248318267, 1, 1248318267, 1, 1, 'content_lantern_interested', 'Lsit user interested product', 'Interested', 7, 8, NULL),
(242, 1248318521, 1, 1248318521, 1, 1, 'admin_user_interested', 'List product interested by user', 'Interested', 2, 8, NULL),
(243, 1248318859, 1, 1248318859, 1, 1, 'reporting_interested', 'List user interested product', 'Interested product', 3, 2, NULL),
(244, 1248675949, 1, 1248675949, 1, 1, 'navigation_category_product_relationship_create', 'Menu list to link father or children to a category', 'Add category', 5, 6, NULL),
(245, 1248676039, 1, 1248676039, 1, 1, 'navigation_category_product_relationship_delete', 'Unlink parent between categorys', 'Delete', 5, 6, NULL),
(246, 1248745429, 39, 1248745429, 39, 1, 'content_page_relationship', 'Menu Tab page relationships in page details', 'Page relationships', 7, 8, NULL),
(247, 1248745512, 39, 1248745512, 39, 1, 'content_page_relationship_delete', 'Unlink parent between pages', 'Delete', 7, 6, NULL),
(248, 1248745572, 39, 1248745572, 39, 1, 'content_page_relationship_create', 'Menu list to link father or children to a page', 'Add page', 7, 6, NULL),
(249, 1248768854, 39, 1248768854, 39, 1, 'webrank_sitemap_keyword', 'Menu Tab keyword URL in sitemate', 'Keyword', 8, 8, NULL),
(250, 1248771241, 39, 1248832306, 39, 0, 'content_product_origin', 'Display origin list', 'Origins', 7, 2, NULL),
(251, 1248771385, 39, 1248832284, 39, 0, 'content_product_origin_create', 'Create new origin', 'Create', 7, 3, 1),
(252, 1248771534, 39, 1248832254, 39, 0, 'content_product_origin_detail', 'Display origin details', 'Origin details', 7, 7, NULL),
(253, 1248771674, 39, 1248832216, 39, 0, 'content_product_origin_modify', 'Modify origin details', 'Modify', 7, 3, 2),
(254, 1248771779, 39, 1248832190, 39, 0, 'content_product_origin_delete', 'Delete origin', 'Delete', 7, 3, 3),
(255, 1252029844, 39, 1252029844, 39, 1, 'transaction', 'Transaction home page', 'Transaction', 9, 1, NULL),
(256, 1252030221, 39, 1252030221, 39, 1, 'transaction_list', 'Display transactions list of all user', 'Transactions', 9, 2, NULL),
(257, 1274757451, 65, 1274757451, 65, 2, '', '', '', 0, 0, NULL),
(258, 1408434614, 1, 1408434614, 1, 1, 'proviva', 'Proviva home page', 'Proviva', 10, 1, NULL),
(259, 1408435701, 1, 1408435701, 1, 1, 'proviva_product', 'Display product list', 'Product', 10, 2, NULL),
(260, 1408440326, 1, 1408440326, 1, 1, 'proviva_product_detail', 'Display product detail', 'Product detail', 10, 7, NULL),
(261, 1408440603, 1, 1408440603, 1, 1, 'proviva_product_modify', 'Modification the product', 'Modify', 10, 3, 2),
(262, 1408440709, 1, 1408440709, 1, 1, 'proviva_product_delete', 'Delete the product', 'Delete', 10, 3, 3),
(263, 1408441645, 1, 1408441645, 1, 1, 'proviva_product_create', 'Create new product', 'Create', 10, 3, 1),
(264, 1408504482, 1, 1408504482, 1, 1, 'proviva_product_photo', 'Menu tab photo in product detail', 'Photos', 10, 8, NULL),
(265, 1408504663, 1, 1408504663, 1, 1, 'proviva_product_photo_create', 'Menu list to link photo to product', 'Add photo', 10, 6, NULL),
(266, 1408504786, 1, 1408504786, 1, 1, 'proviva_product_photo_delete', 'Unlink photo to product', 'Delete', 10, 6, NULL),
(267, 1408505297, 1, 1408505297, 1, 1, 'proviva_product_main_photo', 'Choose main photo for the product', 'Choose main photo', 10, 6, NULL),
(268, 1408505464, 1, 1408505464, 1, 1, 'proviva_product_photo_upload', 'Upload photo to the system', 'Upload photos', 10, 6, NULL),
(269, 1414378393, 1, 1414378393, 1, 1, 'proviva_product_sitemap', 'Create sitemap', 'Sitemap', 10, 3, 4),
(270, 1417420173, 1, 1417420173, 1, 1, 'proviva_product_translate', 'Menu tab translate in product detail', 'Translate', 10, 8, NULL),
(271, 1417420260, 1, 1417420260, 1, 1, 'proviva_product_translate_delete', 'Unlink translation to product', 'Delete', 10, 6, NULL),
(272, 1417420357, 1, 1417420357, 1, 1, 'proviva_product_translate_create', 'Create other translate for the product', 'Create', 10, 6, NULL),
(273, 1417420531, 1, 1417420531, 1, 1, 'proviva_product_translate_modify', 'Modify translate of the product', 'Modify', 10, 6, NULL),
(274, 1417420615, 1, 1417420615, 1, 1, 'proviva_language', 'Sub menu language', 'Language', 10, 2, NULL),
(275, 1417420686, 1, 1417420686, 1, 1, 'proviva_language_detail', 'To display language detail', 'Detail', 10, 7, NULL),
(276, 1417420771, 1, 1417420771, 1, 1, 'proviva_language_modify', 'Modify the language', 'Modify', 10, 3, 2),
(277, 1417420848, 1, 1417420848, 1, 1, 'proviva_language_delete', 'Delete the language', 'Delete', 10, 3, 3),
(278, 1417421946, 1, 1417421946, 1, 1, 'proviva_language_create', 'Create new language', 'Create', 10, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `_adm_fichier_recursif`
--

CREATE TABLE IF NOT EXISTS `_adm_fichier_recursif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_createur` int(11) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(11) NOT NULL DEFAULT '0',
  `etat_doc` int(2) NOT NULL DEFAULT '1',
  `id_fichier_pere` int(11) NOT NULL DEFAULT '0',
  `id_fichier_fils` int(11) NOT NULL DEFAULT '0',
  `numero` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=335 ;

--
-- Dumping data for table `_adm_fichier_recursif`
--

INSERT INTO `_adm_fichier_recursif` (`id`, `date_creation`, `id_createur`, `date_modification`, `id_modificateur`, `etat_doc`, `id_fichier_pere`, `id_fichier_fils`, `numero`) VALUES
(1, 1202306148, 1, 1202306148, 1, 1, 0, 1, 10),
(2, 1202306148, 1, 1202306148, 1, 1, 1, 2, 20),
(3, 1202306148, 1, 1202306148, 1, 1, 2, 3, 30),
(4, 1202306148, 1, 1202306148, 1, 1, 3, 4, 0),
(5, 1202306148, 1, 1202306148, 1, 1, 3, 7, 0),
(6, 1202306148, 1, 1202306148, 1, 1, 7, 5, 3),
(7, 1202306148, 1, 1202306148, 1, 1, 7, 6, 0),
(8, 1202306148, 1, 1213097535, 5, 0, 7, 8, 2),
(9, 1202306148, 1, 1202306148, 1, 1, 7, 11, 2),
(10, 1202306148, 1, 1213097535, 5, 0, 8, 9, 0),
(11, 1202306148, 1, 1213097535, 5, 0, 8, 10, 0),
(12, 1202306148, 1, 1202306148, 1, 1, 11, 12, 0),
(13, 1202306148, 1, 1202306148, 1, 1, 11, 13, 0),
(14, 1202306148, 1, 1202306148, 1, 1, 2, 14, 20),
(15, 1202306148, 1, 1202306148, 1, 1, 14, 15, 0),
(16, 1202306148, 1, 1202306148, 1, 1, 14, 18, 0),
(17, 1202306148, 1, 1202306148, 1, 1, 18, 16, 0),
(18, 1202306148, 1, 1202306148, 1, 1, 18, 17, 0),
(19, 1202306148, 1, 1202306148, 1, 1, 18, 19, 20),
(20, 1202306148, 1, 1409889697, 1, 0, 18, 20, 10),
(21, 1202306148, 1, 1202306148, 1, 1, 18, 21, 0),
(22, 1202306148, 1, 1202306148, 1, 1, 2, 22, 40),
(23, 1202306148, 1, 1202306148, 1, 1, 22, 23, 0),
(24, 1202306148, 1, 1202306148, 1, 1, 22, 26, 0),
(25, 1202306148, 1, 1202306148, 1, 1, 26, 24, 0),
(26, 1202306148, 1, 1202306148, 1, 1, 26, 25, 0),
(27, 1202306148, 1, 1202306148, 1, 1, 26, 27, 10),
(28, 1202306148, 1, 1202306148, 1, 1, 26, 30, 20),
(29, 1202306148, 1, 1202306148, 1, 1, 27, 28, 0),
(30, 1202306148, 1, 1202306148, 1, 1, 27, 29, 0),
(31, 1202306148, 1, 1202306148, 1, 1, 30, 31, 0),
(32, 1202306148, 1, 1202306148, 1, 1, 30, 32, 0),
(33, 1202306148, 1, 1202306148, 1, 1, 2, 33, 50),
(34, 1202306148, 1, 1202306148, 1, 1, 33, 34, 0),
(35, 1202306148, 1, 1202306148, 1, 1, 33, 37, 0),
(36, 1202306148, 1, 1202306148, 1, 1, 37, 35, 0),
(37, 1202306148, 1, 1202306148, 1, 1, 37, 36, 0),
(38, 1202306148, 1, 1202306148, 1, 1, 37, 38, 1),
(39, 1202306148, 1, 1202306148, 1, 1, 38, 39, 0),
(40, 1202306148, 1, 1202306148, 1, 1, 38, 40, 0),
(41, 1202306148, 1, 1202306148, 1, 1, 2, 41, 60),
(42, 1202306148, 1, 1409885327, 1, 0, 1, 42, 30),
(43, 1202306148, 1, 1202306148, 1, 1, 42, 43, 4),
(44, 1202306148, 1, 1202306148, 1, 1, 42, 44, 2),
(45, 1202306148, 1, 1202306148, 1, 1, 42, 47, 1),
(46, 1202306148, 1, 1202306148, 1, 1, 42, 50, 3),
(47, 1202306148, 1, 1202306148, 1, 1, 44, 45, 0),
(48, 1202306148, 1, 1202306148, 1, 1, 44, 46, 0),
(49, 1202306148, 1, 1202306148, 1, 1, 47, 48, 0),
(50, 1202306148, 1, 1202306148, 1, 1, 47, 49, 0),
(51, 1202306148, 1, 1202306148, 1, 1, 50, 51, 0),
(52, 1202306148, 1, 1202306148, 1, 1, 50, 52, 0),
(53, 1202306148, 1, 1202306148, 1, 1, 1, 53, 30),
(54, 1202306148, 1, 1202306148, 1, 1, 53, 54, 1),
(55, 1202306148, 1, 1202306148, 1, 1, 53, 66, 2),
(56, 1202306148, 1, 1202306148, 1, 1, 53, 71, 3),
(57, 1202306148, 1, 1202306148, 1, 1, 54, 55, 0),
(58, 1202306148, 1, 1202306148, 1, 1, 54, 56, 0),
(59, 1202306148, 1, 1202306148, 1, 1, 55, 57, 1),
(60, 1202306148, 1, 1202306148, 1, 1, 55, 58, 2),
(61, 1202306148, 1, 1202306148, 1, 1, 55, 59, 1),
(62, 1202306148, 1, 1202306148, 1, 1, 55, 62, 2),
(63, 1202306148, 1, 1202306148, 1, 1, 55, 65, 3),
(64, 1202306148, 1, 1202306148, 1, 1, 59, 60, 0),
(65, 1202306148, 1, 1202306148, 1, 1, 59, 61, 0),
(66, 1202306148, 1, 1202306148, 1, 1, 62, 63, 0),
(67, 1202306148, 1, 1202306148, 1, 1, 62, 64, 0),
(68, 1202306148, 1, 1202306148, 1, 1, 66, 67, 0),
(69, 1202306148, 1, 1202306148, 1, 1, 66, 68, 0),
(70, 1202306148, 1, 1202306148, 1, 1, 68, 69, 1),
(71, 1202306148, 1, 1202306148, 1, 1, 68, 70, 2),
(72, 1202306148, 1, 1202306148, 1, 1, 71, 72, 0),
(73, 1202306148, 1, 1202306148, 1, 1, 71, 73, 0),
(74, 1202306148, 1, 1202306148, 1, 1, 73, 74, 1),
(75, 1202306148, 1, 1202306148, 1, 1, 73, 75, 2),
(76, 1202306148, 1, 1409885487, 1, 0, 1, 76, 50),
(77, 1202306148, 1, 1205297278, 1, 0, 76, 77, 1),
(78, 1202306148, 1, 1205297278, 1, 0, 77, 78, 1),
(79, 1202306148, 1, 1248679099, 39, 0, 77, 83, 2),
(80, 1202306148, 1, 1248679526, 39, 0, 77, 84, 3),
(81, 1202306148, 1, 1202306148, 1, 1, 78, 79, 0),
(82, 1202306148, 1, 1202306148, 1, 1, 78, 80, 0),
(83, 1202306148, 1, 1202306148, 1, 1, 80, 81, 1),
(84, 1202306148, 1, 1202306148, 1, 1, 80, 82, 2),
(85, 1202306148, 1, 1248679526, 39, 0, 84, 85, 0),
(86, 1202306148, 1, 1409885352, 1, 0, 1, 86, 40),
(87, 1202306148, 1, 1202306148, 1, 1, 86, 87, 0),
(88, 1202306148, 1, 1205292401, 1, 0, 86, 88, 2),
(89, 1202306148, 1, 1205298426, 1, 0, 42, 89, 6),
(90, 1204010760, 1, 1213097535, 5, 0, 86, 8, 0),
(91, 1204859126, 1, 1205292424, 1, 0, 88, 92, 0),
(92, 1204859878, 1, 1205292454, 1, 0, 88, 94, 0),
(93, 1204859944, 1, 1205292472, 1, 0, 94, 93, 0),
(94, 1204860308, 1, 1205292472, 1, 0, 94, 93, 0),
(95, 1205124126, 11, 1205124126, 11, 1, 95, 96, 10),
(96, 1205124182, 11, 1205124182, 11, 1, 1, 95, 80),
(97, 1205124438, 11, 1205124438, 11, 1, 96, 97, 0),
(98, 1205124640, 11, 1205124640, 11, 1, 97, 98, 0),
(99, 1205124827, 11, 1205124827, 11, 1, 96, 99, 0),
(100, 1205125048, 11, 1205125048, 11, 1, 97, 100, 0),
(101, 1205202056, 11, 1205202355, 11, 0, 97, 101, 0),
(102, 1205202537, 11, 1205202537, 11, 1, 97, 102, 1),
(103, 1205202550, 11, 1205202550, 11, 1, 102, 101, 0),
(104, 1205202691, 11, 1205202691, 11, 1, 102, 103, 0),
(105, 1205221369, 11, 1205221369, 11, 1, 97, 104, 3),
(106, 1205221696, 11, 1205221696, 11, 1, 104, 105, 0),
(107, 1205221943, 11, 1205221943, 11, 1, 104, 106, 0),
(108, 1205229465, 12, 1409889693, 1, 0, 18, 107, 30),
(109, 1205289615, 11, 1205303284, 11, 0, 97, 108, 0),
(110, 1205289637, 11, 1205289637, 11, 1, 67, 108, 0),
(111, 1205290924, 11, 1205290924, 11, 1, 104, 108, 0),
(112, 1205297159, 1, 1248679526, 39, 0, 76, 84, 0),
(113, 1205297181, 1, 1205297181, 1, 1, 76, 78, 0),
(114, 1205297210, 1, 1248679099, 39, 0, 76, 83, 0),
(115, 1205297547, 12, 1205306176, 12, 0, 76, 110, 0),
(116, 1205306375, 12, 1205306375, 12, 1, 80, 111, 0),
(117, 1205311306, 12, 1205311306, 12, 1, 80, 112, 0),
(118, 1205312011, 12, 1205315700, 12, 0, 112, 113, 0),
(119, 1205312247, 12, 1205312247, 12, 1, 112, 114, 0),
(120, 1205315929, 12, 1205315929, 12, 1, 112, 116, 0),
(121, 1205826201, 12, 1205826201, 12, 1, 97, 117, 0),
(122, 1205826345, 12, 1205826345, 12, 1, 117, 118, 0),
(123, 1205826447, 12, 1205826447, 12, 1, 117, 119, 0),
(124, 1205900535, 12, 1408419616, 1, 0, 95, 120, 20),
(125, 1205914210, 12, 1205914210, 12, 1, 120, 121, 0),
(126, 1205975150, 12, 1205975150, 12, 1, 121, 122, 0),
(127, 1207026021, 11, 1408419610, 1, 0, 95, 109, 30),
(128, 1207026266, 11, 1207026266, 11, 1, 109, 123, 0),
(129, 1207189871, 12, 1207888775, 11, 0, 109, 125, 0),
(130, 1207190123, 11, 1409901710, 2, 0, 86, 124, 1),
(131, 1207190357, 12, 1207888775, 11, 0, 125, 126, 0),
(132, 1207190764, 11, 1207190764, 11, 1, 124, 127, 0),
(133, 1207191572, 11, 1207191572, 11, 1, 127, 128, 0),
(134, 1207199092, 12, 1207888775, 11, 0, 125, 125, 0),
(135, 1207205205, 12, 1207888455, 11, 0, 109, 129, 0),
(136, 1207206197, 12, 1207888775, 11, 0, 125, 125, 0),
(137, 1207206248, 12, 1207888775, 11, 0, 125, 129, 0),
(138, 1207652101, 12, 1409889689, 1, 0, 18, 130, 40),
(139, 1207887793, 11, 1207888455, 11, 0, 109, 129, 0),
(140, 1207887936, 11, 1207888775, 11, 0, 125, 129, 0),
(141, 1207888560, 11, 1207888775, 11, 0, 125, 131, 0),
(142, 1207888948, 11, 1207888948, 11, 1, 109, 132, 0),
(143, 1207889060, 11, 1207889060, 11, 1, 132, 133, 0),
(144, 1208773988, 11, 1208773988, 11, 1, 104, 134, 0),
(145, 1209093930, 11, 1408419604, 1, 0, 95, 135, 50),
(146, 1209095219, 11, 1209095219, 11, 1, 135, 136, 0),
(147, 1209096211, 11, 1209096211, 11, 1, 135, 137, 0),
(148, 1209109376, 11, 1209109376, 11, 1, 137, 138, 2),
(149, 1209111829, 11, 1209111829, 11, 1, 138, 139, 0),
(150, 1209118832, 11, 1209118832, 11, 1, 138, 140, 0),
(151, 1209349475, 11, 1209349490, 11, 0, 108, 138, 2),
(152, 1209349501, 11, 1209464417, 11, 0, 138, 108, 0),
(153, 1209351550, 12, 1209351550, 12, 1, 137, 141, 0),
(154, 1209351797, 12, 1209351797, 12, 1, 137, 142, 0),
(155, 1209464790, 12, 1209464790, 12, 1, 137, 143, 1),
(156, 1209465058, 12, 1209536830, 11, 0, 137, 144, 0),
(157, 1209465227, 12, 1209536836, 11, 0, 137, 145, 0),
(158, 1209536864, 11, 1209536864, 11, 1, 143, 144, 0),
(159, 1209536864, 11, 1209536864, 11, 1, 143, 145, 0),
(160, 1212468379, 12, 1213250466, 5, 0, 76, 146, 0),
(161, 1212549108, 12, 1408419263, 1, 0, 1, 147, 60),
(162, 1212549255, 12, 1408419256, 1, 0, 147, 148, 0),
(163, 1212552381, 12, 1212552381, 12, 1, 146, 149, 0),
(164, 1213065403, 20, 1213065403, 20, 1, 7, 151, 1),
(165, 1213068160, 20, 1213068160, 20, 1, 37, 152, 2),
(166, 1213079658, 20, 1213079658, 20, 1, 152, 153, 0),
(167, 1213087275, 20, 1213087275, 20, 1, 152, 154, 0),
(168, 1213097571, 5, 1213097571, 5, 1, 151, 9, 0),
(169, 1213097571, 5, 1213097571, 5, 1, 151, 10, 0),
(170, 1213233784, 20, 1408419606, 1, 0, 95, 156, 40),
(171, 1213234597, 20, 1213234597, 20, 1, 156, 157, 0),
(172, 1213235099, 20, 1213235099, 20, 1, 156, 158, 0),
(173, 1213235530, 20, 1213235530, 20, 1, 158, 159, 0),
(174, 1213235839, 20, 1213235839, 20, 1, 158, 160, 0),
(175, 1213243461, 20, 1213243461, 20, 1, 158, 161, 0),
(176, 1213243872, 20, 1213243872, 20, 1, 161, 162, 0),
(177, 1213244373, 20, 1213244373, 20, 1, 161, 163, 0),
(178, 1213250470, 5, 1408419252, 1, 0, 147, 146, 0),
(179, 1213250500, 5, 1213250506, 5, 0, 146, 146, 0),
(180, 1213250550, 5, 1213250572, 5, 0, 146, 146, 0),
(181, 1213324932, 5, 1213324932, 5, 1, 148, 149, 0),
(182, 1213326539, 20, 1213326539, 20, 1, 155, 164, 0),
(183, 1213579427, 12, 1213579427, 12, 1, 146, 166, 0),
(184, 1213585096, 12, 1213585096, 12, 1, 146, 167, 0),
(185, 1213590464, 20, 1408419612, 1, 0, 95, 165, 23),
(186, 1213606952, 20, 1213606952, 20, 1, 165, 168, 0),
(187, 1213610438, 20, 1213610438, 20, 1, 165, 169, 0),
(188, 1213610864, 20, 1213610864, 20, 1, 169, 170, 0),
(189, 1213611038, 20, 1213611038, 20, 1, 169, 171, 0),
(190, 1213759226, 20, 1408419614, 1, 0, 95, 173, 22),
(191, 1213759479, 20, 1213759479, 20, 1, 173, 174, 0),
(192, 1213759593, 20, 1213759593, 20, 1, 173, 175, 0),
(193, 1213759741, 20, 1213759741, 20, 1, 175, 176, 0),
(194, 1213759844, 20, 1213759844, 20, 1, 175, 177, 0),
(195, 1213771967, 20, 1213771967, 20, 1, 175, 178, 20),
(196, 1214211171, 20, 1214211171, 20, 1, 19, 179, 0),
(197, 1214271632, 20, 1214271632, 20, 1, 19, 181, 0),
(198, 1214278510, 20, 1214278510, 20, 1, 68, 182, 0),
(199, 1214357211, 20, 1409885727, 1, 0, 3, 183, 0),
(200, 1214357287, 20, 1214357287, 20, 1, 183, 184, 0),
(201, 1214358258, 20, 1214358258, 20, 1, 18, 185, 0),
(202, 1214358356, 20, 1214358356, 20, 1, 18, 186, 0),
(203, 1214365062, 20, 1214365062, 20, 1, 18, 187, 0),
(204, 1214452052, 18, 1214453718, 18, 0, 121, 180, 0),
(205, 1214453889, 18, 1214453889, 18, 1, 121, 180, 0),
(206, 1214463836, 18, 1214465774, 18, 0, 180, 188, 0),
(207, 1214816984, 20, 1214817592, 20, 0, 97, 189, 0),
(208, 1214819168, 25, 1215683713, 5, 0, 158, 190, 0),
(209, 1214883584, 25, 1214884104, 25, 0, 158, 191, 0),
(210, 1214883720, 25, 1214884104, 25, 0, 191, 192, 0),
(211, 1214885854, 25, 1214885854, 25, 1, 95, 194, 0),
(212, 1214888107, 25, 1214907793, 25, 0, 95, 198, 0),
(213, 1214899811, 20, 1248679415, 39, 0, 85, 203, 0),
(214, 1214902065, 20, 1248679526, 39, 0, 84, 204, 0),
(215, 1214902109, 20, 1248679526, 39, 0, 84, 204, 0),
(216, 1214902152, 20, 1248679456, 39, 0, 204, 85, 0),
(217, 1214962886, 20, 1248679456, 39, 0, 204, 205, 0),
(218, 1214963387, 20, 1248679456, 39, 0, 204, 205, 0),
(223, 1214987271, 25, 1214987719, 25, 0, 207, 22, 40),
(228, 1214988040, 25, 1214988145, 25, 0, 207, 3, 30),
(229, 1214988162, 25, 1214989203, 25, 0, 207, 3, 30),
(230, 1214988743, 25, 1214988877, 25, 0, 207, 3, 30),
(231, 1214988935, 25, 1214988965, 25, 0, 207, 3, 30),
(232, 1214988970, 25, 1214989104, 25, 0, 207, 3, 30),
(233, 1214989113, 25, 1214989140, 25, 0, 207, 3, 30),
(234, 1214989189, 25, 1214989189, 25, 2, 207, 3, 30),
(237, 1214989691, 25, 1214989729, 25, 0, 2, 207, 0),
(238, 1214993636, 25, 1215052369, 25, 0, 22, 207, 0),
(239, 1214993642, 25, 1214993826, 25, 0, 22, 207, 0),
(240, 1214993816, 25, 1214993823, 25, 0, 22, 207, 0),
(241, 1215047822, 25, 1215047868, 25, 0, 66, 4, 0),
(242, 1215047830, 25, 1215047859, 25, 0, 66, 4, 0),
(243, 1215050622, 25, 1215050634, 25, 0, 95, 3, 30),
(244, 1215050628, 25, 1215050639, 25, 0, 95, 3, 30),
(245, 1215051714, 25, 1215052397, 25, 0, 22, 207, 0),
(246, 1215052356, 25, 1215052429, 25, 0, 207, 41, 60),
(247, 1215054294, 25, 1215400661, 20, 0, 173, 4, 0),
(248, 1215054310, 25, 1215054346, 25, 0, 4, 4, 0),
(249, 1215054481, 25, 1215054628, 25, 0, 4, 4, 0),
(250, 1215065325, 25, 1215066212, 25, 0, 22, 12, 0),
(251, 1215065341, 25, 1215065367, 25, 0, 12, 4, 0),
(252, 1215066094, 25, 1215066124, 25, 0, 12, 7, 0),
(253, 1215066354, 25, 1215066366, 25, 0, 12, 4, 0),
(254, 1215066373, 25, 1215066385, 25, 0, 4, 12, 0),
(255, 1215066413, 25, 1215066433, 25, 0, 4, 207, 0),
(256, 1215066423, 25, 1215066444, 25, 0, 207, 22, 40),
(257, 1215066448, 25, 1215066452, 25, 0, 207, 22, 40),
(258, 1215568183, 25, 1215764492, 5, 0, 97, 99, 0),
(259, 1215578926, 20, 1408419507, 1, 0, 2, 208, 10),
(260, 1215583941, 20, 1215583941, 20, 1, 208, 209, 0),
(261, 1215585852, 20, 1215585852, 20, 1, 208, 210, 0),
(262, 1215590069, 20, 1215590069, 20, 1, 210, 211, 0),
(263, 1215593609, 20, 1215594043, 20, 0, 210, 212, 0),
(264, 1215594726, 20, 1215594726, 20, 1, 208, 213, 0),
(275, 1216951462, 18, 1408423881, 1, 0, 1, 219, 1),
(276, 1216961409, 18, 1408423890, 1, 0, 1, 220, 3),
(277, 1216969843, 18, 1408423887, 1, 0, 1, 221, 2),
(278, 1217387284, 18, 1217387284, 18, 1, 158, 222, 0),
(279, 1217404008, 18, 1217404008, 18, 1, 156, 223, 0),
(280, 1217405821, 18, 1217405821, 18, 1, 156, 224, 0),
(281, 1226292959, 5, 1226292959, 5, 1, 97, 225, 0),
(282, 1226293860, 5, 1226293860, 5, 1, 104, 229, 0),
(283, 1248315584, 1, 1408419593, 1, 0, 95, 230, 0),
(284, 1248315757, 1, 1248315757, 1, 1, 230, 231, 0),
(285, 1248315897, 1, 1248315897, 1, 1, 230, 232, 0),
(286, 1248316092, 1, 1248316092, 1, 1, 232, 233, 0),
(287, 1248316253, 1, 1248316253, 1, 1, 232, 234, 0),
(288, 1248316456, 1, 1248316456, 1, 1, 232, 235, 0),
(289, 1248316591, 1, 1248316591, 1, 1, 235, 236, 0),
(290, 1248316759, 1, 1248316759, 1, 1, 235, 237, 0),
(291, 1248317495, 1, 1248317495, 1, 1, 97, 238, 0),
(292, 1248317627, 1, 1248317627, 1, 1, 238, 239, 0),
(293, 1248317729, 1, 1248317729, 1, 1, 238, 240, 0),
(294, 1248318260, 1, 1248318260, 1, 1, 97, 241, 0),
(295, 1248318512, 1, 1409889684, 1, 0, 18, 242, 50),
(296, 1248318847, 1, 1408419547, 1, 0, 42, 243, 0),
(297, 1248675941, 1, 1248675941, 1, 1, 111, 244, 0),
(298, 1248676030, 1, 1248676030, 1, 1, 111, 245, 0),
(299, 1248745422, 39, 1248745422, 39, 1, 175, 246, 10),
(300, 1248745504, 39, 1248745504, 39, 1, 246, 247, 0),
(301, 1248745566, 39, 1248745566, 39, 1, 246, 248, 0),
(302, 1248768843, 39, 1248768843, 39, 1, 146, 249, 0),
(303, 1248771221, 39, 1248832306, 39, 0, 95, 250, 0),
(304, 1248771373, 39, 1248832306, 39, 0, 250, 251, 0),
(305, 1248771525, 39, 1248832306, 39, 0, 250, 252, 0),
(306, 1248771661, 39, 1248832254, 39, 0, 252, 253, 0),
(307, 1248771764, 39, 1248832254, 39, 0, 252, 254, 0),
(308, 1252029835, 39, 1252029835, 39, 1, 1, 255, 90),
(309, 1252030213, 39, 1252030213, 39, 1, 255, 256, 0),
(310, 1408434600, 1, 1408434600, 1, 1, 1, 258, 50),
(311, 1408435695, 1, 1408435695, 1, 1, 258, 259, 0),
(312, 1408440320, 1, 1408440320, 1, 1, 259, 260, 0),
(313, 1408440596, 1, 1408440596, 1, 1, 260, 261, 0),
(314, 1408440704, 1, 1408440704, 1, 1, 260, 262, 0),
(315, 1408441639, 1, 1408441639, 1, 1, 259, 263, 0),
(316, 1408504476, 1, 1408504476, 1, 1, 260, 264, 0),
(317, 1408504656, 1, 1408504656, 1, 1, 264, 265, 0),
(318, 1408504780, 1, 1408504780, 1, 1, 264, 266, 0),
(319, 1408505004, 1, 1409558275, 1, 0, 264, 108, 0),
(320, 1408505291, 1, 1408505291, 1, 1, 264, 267, 0),
(321, 1408505458, 1, 1408505458, 1, 1, 264, 268, 0),
(322, 1409889749, 1, 1409889749, 1, 1, 18, 20, 0),
(323, 1409889918, 1, 1409889992, 1, 0, 86, 1, 10),
(324, 1409890027, 1, 1409901734, 2, 0, 1, 86, 40),
(325, 1414378386, 1, 1414378386, 1, 1, 259, 269, 0),
(326, 1417420168, 1, 1417420168, 1, 1, 260, 270, 0),
(327, 1417420256, 1, 1417420256, 1, 1, 270, 271, 0),
(328, 1417420352, 1, 1417420352, 1, 1, 259, 272, 0),
(329, 1417420526, 1, 1417420526, 1, 1, 259, 273, 0),
(330, 1417420611, 1, 1417420611, 1, 1, 258, 274, 0),
(331, 1417420682, 1, 1417420682, 1, 1, 274, 275, 0),
(332, 1417420766, 1, 1417420766, 1, 1, 275, 276, 0),
(333, 1417420844, 1, 1417420844, 1, 1, 275, 277, 0),
(334, 1417421899, 1, 1417421899, 1, 1, 274, 278, 0);

-- --------------------------------------------------------

--
-- Table structure for table `_adm_groupe`
--

CREATE TABLE IF NOT EXISTS `_adm_groupe` (
  `id_groupe` int(10) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_createur` int(10) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(10) NOT NULL DEFAULT '0',
  `etat_doc` int(1) NOT NULL DEFAULT '1',
  `intitule_groupe` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description_groupe` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id_groupe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `_adm_groupe`
--

INSERT INTO `_adm_groupe` (`id_groupe`, `date_creation`, `id_createur`, `date_modification`, `id_modificateur`, `etat_doc`, `intitule_groupe`, `description_groupe`) VALUES
(1, 1202306148, 1, 1202306148, 1, 1, 'Administration application', 'Groupe des administrateurs de l&#039;application (poss');

-- --------------------------------------------------------

--
-- Table structure for table `_adm_groupe_privilege`
--

CREATE TABLE IF NOT EXISTS `_adm_groupe_privilege` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_createur` int(10) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(10) NOT NULL DEFAULT '0',
  `etat_doc` int(1) NOT NULL DEFAULT '1',
  `id_groupe` int(10) NOT NULL DEFAULT '0',
  `id_privilege` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=195 ;

--
-- Dumping data for table `_adm_groupe_privilege`
--

INSERT INTO `_adm_groupe_privilege` (`id`, `date_creation`, `id_createur`, `date_modification`, `id_modificateur`, `etat_doc`, `id_groupe`, `id_privilege`) VALUES
(1, 1202306148, 1, 1202306148, 1, 1, 1, 1),
(2, 1202306148, 1, 1213170329, 5, 0, 1, 2),
(3, 1202306148, 1, 1202306148, 1, 1, 1, 3),
(4, 1202306148, 1, 1213237211, 5, 0, 1, 4),
(5, 1202306148, 1, 1202306148, 1, 1, 1, 5),
(6, 1202306148, 1, 1202306148, 1, 1, 1, 6),
(7, 1202306148, 1, 1202306148, 1, 1, 1, 7),
(8, 1202306148, 1, 1213176369, 5, 0, 1, 8),
(9, 1202306148, 1, 1213237006, 5, 0, 1, 9),
(10, 1202306148, 1, 1213338423, 5, 0, 1, 10),
(11, 1202306148, 1, 1213176437, 5, 0, 1, 11),
(12, 1202306148, 1, 1213237262, 5, 0, 1, 12),
(13, 1202306148, 1, 1213339060, 5, 0, 1, 13),
(14, 1202306148, 1, 1202306148, 1, 1, 1, 14),
(15, 1202306148, 1, 1202306148, 1, 1, 1, 15),
(16, 1202306148, 1, 1202306148, 1, 1, 1, 16),
(17, 1202306148, 1, 1202306148, 1, 1, 1, 17),
(18, 1202306148, 1, 1213176230, 5, 0, 1, 18),
(19, 1202306148, 1, 1213179292, 5, 0, 1, 19),
(20, 1202306148, 1, 1213179356, 5, 0, 1, 20),
(21, 1202306148, 1, 1213175961, 5, 0, 1, 21),
(22, 1202306148, 1, 1213179485, 5, 0, 1, 22),
(23, 1202306148, 1, 1213175868, 5, 0, 1, 23),
(24, 1202306148, 1, 1202306148, 1, 1, 1, 24),
(25, 1202306148, 1, 1202306148, 1, 1, 1, 25),
(26, 1202306148, 1, 1213179212, 5, 0, 1, 26),
(27, 1202306148, 1, 1213176477, 5, 0, 1, 27),
(28, 1202306148, 1, 1213236892, 5, 0, 1, 28),
(29, 1202306148, 1, 1213338593, 5, 0, 1, 29),
(30, 1202306148, 1, 1213176316, 5, 0, 1, 30),
(31, 1202306148, 1, 1213237430, 5, 0, 1, 31),
(32, 1202306148, 1, 1213338759, 5, 0, 1, 32),
(33, 1202306148, 1, 1202306148, 1, 1, 1, 33),
(34, 1202306148, 1, 1202306148, 1, 1, 1, 34),
(35, 1202306148, 1, 1213338288, 5, 0, 1, 35),
(36, 1202306148, 1, 1202306148, 1, 1, 1, 36),
(37, 1202306148, 1, 1213179545, 5, 0, 1, 37),
(38, 1202306148, 1, 1213148355, 20, 0, 1, 38),
(39, 1202306148, 1, 1213237087, 5, 0, 1, 39),
(40, 1202306148, 1, 1213338780, 5, 0, 1, 40),
(41, 1202306148, 1, 1202306148, 1, 1, 1, 41),
(42, 1202306148, 1, 1409885164, 1, 0, 1, 42),
(43, 1202306148, 1, 1213246802, 5, 0, 1, 43),
(44, 1202306148, 1, 1213247097, 5, 0, 1, 44),
(45, 1202306148, 1, 1213246772, 5, 0, 1, 45),
(46, 1202306148, 1, 1213330924, 5, 0, 1, 46),
(47, 1202306148, 1, 1213246728, 5, 0, 1, 47),
(48, 1202306148, 1, 1213330310, 5, 0, 1, 48),
(49, 1202306148, 1, 1213330947, 5, 0, 1, 49),
(50, 1202306148, 1, 1213246863, 5, 0, 1, 50),
(51, 1202306148, 1, 1213246893, 5, 0, 1, 51),
(52, 1202306148, 1, 1202306148, 1, 1, 1, 52),
(53, 1202306148, 1, 1202306148, 1, 1, 1, 53),
(54, 1202306148, 1, 1213336941, 5, 0, 1, 54),
(55, 1202306148, 1, 1213336965, 5, 0, 1, 55),
(56, 1202306148, 1, 1213337551, 5, 0, 1, 56),
(57, 1202306148, 1, 1213337621, 5, 0, 1, 57),
(58, 1202306148, 1, 1213338620, 5, 0, 1, 58),
(59, 1202306148, 1, 1213336796, 5, 0, 1, 59),
(60, 1202306148, 1, 1213337404, 5, 0, 1, 60),
(61, 1202306148, 1, 1213338839, 5, 0, 1, 61),
(62, 1202306148, 1, 1213336827, 5, 0, 1, 62),
(63, 1202306148, 1, 1213337524, 5, 0, 1, 63),
(64, 1202306148, 1, 1213338644, 5, 0, 1, 64),
(65, 1202306148, 1, 1213338532, 5, 0, 1, 65),
(66, 1202306148, 1, 1213337015, 5, 0, 1, 66),
(67, 1202306148, 1, 1213337465, 5, 0, 1, 67),
(68, 1202306148, 1, 1213336989, 5, 0, 1, 68),
(69, 1202306148, 1, 1213337576, 5, 0, 1, 69),
(70, 1202306148, 1, 1213338735, 5, 0, 1, 70),
(71, 1202306148, 1, 1213336656, 5, 0, 1, 71),
(72, 1202306148, 1, 1213337434, 5, 0, 1, 72),
(73, 1202306148, 1, 1213336681, 5, 0, 1, 73),
(74, 1202306148, 1, 1213338453, 5, 0, 1, 74),
(75, 1202306148, 1, 1213338805, 5, 0, 1, 75),
(76, 1202306148, 1, 1202306148, 1, 1, 1, 76),
(77, 1202306148, 1, 1213330509, 5, 0, 1, 77),
(78, 1202306148, 1, 1213330476, 5, 0, 1, 78),
(79, 1202306148, 1, 1213330742, 5, 0, 1, 79),
(80, 1202306148, 1, 1213330558, 5, 0, 1, 80),
(81, 1202306148, 1, 1213330837, 5, 0, 1, 81),
(82, 1202306148, 1, 1213331099, 5, 0, 1, 82),
(83, 1202306148, 1, 1213331070, 5, 0, 1, 83),
(84, 1202306148, 1, 1213336573, 5, 0, 1, 84),
(85, 1202306148, 1, 1213330772, 5, 0, 1, 85),
(86, 1202306148, 1, 1409885200, 1, 0, 1, 86),
(87, 1202306148, 1, 1213337912, 5, 0, 1, 87),
(88, 1202984443, 1, 1204870429, 1, 0, 2, 1),
(89, 1202984443, 1, 1204870429, 1, 0, 2, 2),
(90, 1202984443, 1, 1204870429, 1, 0, 2, 3),
(91, 1202984443, 1, 1204870429, 1, 0, 2, 7),
(92, 1202984443, 1, 1204870429, 1, 0, 2, 8),
(93, 1202984443, 1, 1204870429, 1, 0, 2, 11),
(94, 1202984443, 1, 1204870429, 1, 0, 2, 14),
(95, 1202984443, 1, 1204870429, 1, 0, 2, 18),
(96, 1202984443, 1, 1204870429, 1, 0, 2, 19),
(97, 1202984443, 1, 1204870429, 1, 0, 2, 20),
(98, 1202984443, 1, 1204870429, 1, 0, 2, 22),
(99, 1202984443, 1, 1204870429, 1, 0, 2, 26),
(100, 1202984443, 1, 1204870429, 1, 0, 2, 27),
(101, 1202984443, 1, 1204870429, 1, 0, 2, 30),
(102, 1202984443, 1, 1204870429, 1, 0, 2, 33),
(103, 1202984443, 1, 1204870429, 1, 0, 2, 37),
(104, 1202984443, 1, 1204870429, 1, 0, 2, 38),
(105, 1202984443, 1, 1204870429, 1, 0, 2, 42),
(106, 1202984443, 1, 1204870429, 1, 0, 2, 43),
(107, 1202984443, 1, 1204870429, 1, 0, 2, 44),
(108, 1202984443, 1, 1204870429, 1, 0, 2, 45),
(109, 1202984443, 1, 1204870429, 1, 0, 2, 47),
(110, 1202984443, 1, 1204870429, 1, 0, 2, 48),
(111, 1202984443, 1, 1204870429, 1, 0, 2, 50),
(112, 1202984443, 1, 1204870429, 1, 0, 2, 51),
(113, 1202984443, 1, 1204870429, 1, 0, 2, 53),
(114, 1202984443, 1, 1204870429, 1, 0, 2, 54),
(115, 1202984443, 1, 1204870429, 1, 0, 2, 55),
(116, 1202984443, 1, 1204870429, 1, 0, 2, 59),
(117, 1202984443, 1, 1204870429, 1, 0, 2, 62),
(118, 1202984443, 1, 1204870429, 1, 0, 2, 66),
(119, 1202984443, 1, 1204870429, 1, 0, 2, 68),
(120, 1202984443, 1, 1204870429, 1, 0, 2, 71),
(121, 1202984443, 1, 1204870429, 1, 0, 2, 73),
(122, 1202984443, 1, 1204870429, 1, 0, 2, 76),
(123, 1202984443, 1, 1204870429, 1, 0, 2, 77),
(124, 1202984443, 1, 1204870429, 1, 0, 2, 78),
(125, 1202984443, 1, 1204870429, 1, 0, 2, 80),
(126, 1202984443, 1, 1204870429, 1, 0, 2, 84),
(127, 1202984443, 1, 1204870429, 1, 0, 2, 86),
(128, 1203405638, 1, 1204870429, 1, 0, 2, 4),
(129, 1203405638, 1, 1204870429, 1, 0, 2, 9),
(130, 1203405638, 1, 1204870429, 1, 0, 2, 12),
(131, 1203405638, 1, 1204870429, 1, 0, 2, 15),
(132, 1203405638, 1, 1204870429, 1, 0, 2, 23),
(133, 1203405638, 1, 1204870429, 1, 0, 2, 28),
(134, 1203405638, 1, 1204870429, 1, 0, 2, 31),
(135, 1203405638, 1, 1204870429, 1, 0, 2, 34),
(136, 1203405638, 1, 1204870429, 1, 0, 2, 39),
(137, 1203405638, 1, 1204870429, 1, 0, 2, 56),
(138, 1203405638, 1, 1204870429, 1, 0, 2, 60),
(139, 1203405638, 1, 1204870429, 1, 0, 2, 63),
(140, 1203405638, 1, 1204870429, 1, 0, 2, 67),
(141, 1203405638, 1, 1204870429, 1, 0, 2, 72),
(142, 1203405638, 1, 1204870429, 1, 0, 2, 79),
(143, 1203405638, 1, 1203405638, 1, 1, 1, 88),
(144, 1203405638, 1, 1204870429, 1, 0, 2, 88),
(145, 1204864730, 1, 1204864730, 1, 1, 1, 91),
(146, 1204864730, 1, 1213245295, 5, 0, 1, 92),
(147, 1204864730, 1, 1213245122, 5, 0, 1, 93),
(148, 1205129303, 11, 1205129303, 11, 1, 1, 94),
(149, 1205129303, 11, 1213243998, 5, 0, 1, 95),
(150, 1205129303, 11, 1213244289, 5, 0, 1, 96),
(151, 1205129303, 11, 1213245279, 5, 0, 1, 97),
(152, 1205129303, 11, 1213245212, 5, 0, 1, 98),
(153, 1205129303, 11, 1213245314, 5, 0, 1, 99),
(154, 1205826478, 12, 1213244832, 5, 0, 1, 100),
(155, 1207030430, 11, 1213245154, 5, 0, 1, 101),
(156, 1207190468, 11, 1213244055, 5, 0, 1, 103),
(157, 1207190474, 11, 1213244058, 5, 0, 1, 103),
(158, 1207190926, 12, 1213244495, 5, 0, 1, 102),
(159, 1207196774, 11, 1213244094, 5, 0, 1, 104),
(160, 1207196774, 11, 1213245237, 5, 0, 1, 105),
(161, 1207888355, 11, 1213245334, 5, 0, 1, 106),
(162, 1209093979, 11, 1213244027, 5, 0, 1, 107),
(163, 1209095750, 11, 1213245102, 5, 0, 1, 108),
(164, 1209096244, 11, 1213244153, 5, 0, 1, 109),
(165, 1212468412, 12, 1213330270, 5, 0, 1, 110),
(166, 1212549132, 12, 1212549132, 12, 1, 1, 111),
(167, 1212554749, 19, 1213172345, 5, 0, 3, 94),
(168, 1212554749, 19, 1213172345, 5, 0, 3, 95),
(169, 1212554749, 19, 1213172345, 5, 0, 3, 96),
(170, 1212554749, 19, 1213172345, 5, 0, 3, 100),
(171, 1212554749, 19, 1213172345, 5, 0, 3, 102),
(172, 1212554749, 19, 1213172345, 5, 0, 3, 107),
(173, 1212554749, 19, 1213172345, 5, 0, 3, 109),
(174, 1212554750, 19, 1213172345, 5, 0, 3, 110),
(175, 1212554750, 19, 1213172345, 5, 0, 3, 111),
(176, 1213079694, 20, 1213236964, 5, 0, 1, 112),
(177, 1213086360, 20, 1213172345, 5, 0, 3, 38),
(178, 1213087289, 20, 1213172345, 5, 0, 3, 8),
(179, 1213087764, 20, 1213172345, 5, 0, 3, 110),
(180, 1213087890, 20, 1213172345, 5, 0, 3, 110),
(181, 1213092111, 20, 1213172345, 5, 0, 3, 38),
(182, 1213092658, 20, 1213172345, 5, 0, 3, 110),
(183, 1213148309, 20, 1213172345, 5, 0, 3, 38),
(184, 1213148360, 20, 1213179169, 5, 0, 1, 38),
(185, 1213148360, 20, 1213172345, 5, 0, 3, 38),
(186, 1213157239, 20, 1213172345, 5, 0, 3, 38),
(187, 1213177949, 5, 1213177949, 5, 1, 1, 2),
(188, 1213233821, 20, 1213244686, 5, 0, 1, 114),
(189, 1213234641, 20, 1213245181, 5, 0, 1, 115),
(190, 1213235159, 20, 1213244649, 5, 0, 1, 116),
(191, 1213262962, 5, 1215498343, 5, 0, 4, 2),
(192, 1252029948, 39, 1252029948, 39, 1, 1, 124),
(193, 1408434366, 1, 1408434366, 1, 1, 1, 125),
(194, 1409890127, 1, 1409890127, 1, 1, 1, 86);

-- --------------------------------------------------------

--
-- Table structure for table `_adm_privilege`
--

CREATE TABLE IF NOT EXISTS `_adm_privilege` (
  `id_privilege` int(10) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_createur` int(10) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(10) NOT NULL DEFAULT '0',
  `etat_doc` int(1) NOT NULL DEFAULT '1',
  `intitule_privilege` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `id_type_privilege` int(10) NOT NULL DEFAULT '0',
  `description_privilege` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_privilege`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=126 ;

--
-- Dumping data for table `_adm_privilege`
--

INSERT INTO `_adm_privilege` (`id_privilege`, `date_creation`, `id_createur`, `date_modification`, `id_modificateur`, `etat_doc`, `intitule_privilege`, `id_type_privilege`, `description_privilege`) VALUES
(1, 1202306148, 1, 1213337825, 5, 1, 'Home Page Menu', 4, 'Home Page Menu'),
(2, 1202306148, 1, 1214449249, 18, 1, 'Administration Menu', 4, 'Administration Menu'),
(3, 1202306148, 1, 1213176406, 5, 0, 'Liste des fichiers', 1, 'Permet d&#039;acc'),
(4, 1202306148, 1, 1213237218, 5, 0, 'Fichier', 2, 'Permet d&#039;acc'),
(5, 1202306148, 1, 1213338026, 5, 1, 'Access rights and files', 3, 'Access rights and files'),
(6, 1202306148, 1, 1213338986, 5, 1, 'Files', 5, 'Files'),
(7, 1202306148, 1, 1213178776, 5, 1, 'Files', 1, 'Files'),
(8, 1202306148, 1, 1213176375, 5, 0, 'Privil', 1, 'Permet d&#039;acc'),
(9, 1202306148, 1, 1213237011, 5, 0, 'Privil', 2, 'Permet d&#039;ajouter un/des privil'),
(10, 1202306148, 1, 1213338438, 5, 0, 'Privil', 5, 'Permet de supprimer un privil'),
(11, 1202306148, 1, 1213176442, 5, 0, 'Arborescence d&#039;un fichier', 1, 'Permet d&#039;acc'),
(12, 1202306148, 1, 1213237304, 5, 0, 'Arborescence d&#039;un fichier', 2, 'Permet d&#039;acc'),
(13, 1202306148, 1, 1213339075, 5, 0, 'Arborescence d&#039;un fichier', 5, 'Permet d&#039;acc'),
(14, 1202306148, 1, 1213236309, 5, 1, 'Users and groups informations', 1, 'Users and groups informations'),
(15, 1202306148, 1, 1213175688, 5, 1, 'Users and groups', 2, 'Users and groups'),
(16, 1202306148, 1, 1213175487, 5, 1, 'Users and password', 3, 'Users and password'),
(17, 1202306148, 1, 1213339020, 5, 1, 'Users', 5, 'Users'),
(18, 1202306148, 1, 1213176236, 5, 0, 'Detail of user', 1, 'Acces to detail on a user'),
(19, 1202306148, 1, 1213179304, 5, 0, 'Liste des groupes d&#039;un compte utilisateur', 1, 'Permet d&#039;acc'),
(20, 1202306148, 1, 1213179363, 5, 0, 'Historique de connection d&#039;un compte', 1, 'Permet d&#039;acc'),
(21, 1202306148, 1, 1213175967, 5, 0, 'Reinitialiser mot de passe compte utilisateur', 3, 'Permet d&#039;acc'),
(22, 1202306148, 1, 1213179491, 5, 0, 'Liste des groupes', 1, 'Permet d&#039;acc'),
(23, 1202306148, 1, 1213175874, 5, 0, 'Groupe', 2, 'Permet l&#039;ajout d&#039;un groupe'),
(24, 1202306148, 1, 1213237638, 5, 1, 'Users and groups', 3, 'Users and groups'),
(25, 1202306148, 1, 1213338963, 5, 1, 'Groups', 5, 'Groups'),
(26, 1202306148, 1, 1213179230, 5, 0, 'Detail of a group', 1, 'Access to detail of a group'),
(27, 1202306148, 1, 1213176483, 5, 0, 'Privil', 1, 'Permet d&#039;acc'),
(28, 1202306148, 1, 1213236897, 5, 0, 'Privil', 2, 'Permet d&#039;associer un/des privil'),
(29, 1202306148, 1, 1213338599, 5, 0, 'Privil', 5, 'Permet la suppression d&#039;un privil'),
(30, 1202306148, 1, 1213176326, 5, 0, 'Users in group', 1, 'Access to Menu Tab of users in a group'),
(31, 1202306148, 1, 1213237450, 5, 0, 'Comptes utilisateur d&#039;un groupe', 2, 'Permet d&#039;associer des comptes utilisateur '),
(32, 1202306148, 1, 1213338764, 5, 0, 'Comptes utilisateur d&#039;un groupe', 5, 'Permet la suppression d&#039;un utilisateur d&#039;un groupe'),
(33, 1202306148, 1, 1213178859, 5, 1, 'Access rights and groups', 1, 'Access rights and groups'),
(34, 1202306148, 1, 1213237481, 5, 1, 'Access rights and files', 2, 'Access rights and files'),
(35, 1202306148, 1, 1213338294, 5, 0, 'Privil', 3, 'Permet la modification d&#039;un privil'),
(36, 1202306148, 1, 1213339107, 5, 1, 'Access rights', 5, 'Access rights'),
(37, 1202306148, 1, 1213179552, 5, 0, 'Detail of an access right', 1, 'Access to detail of an access right'),
(38, 1202306148, 1, 1213179175, 5, 0, 'Liste des fichiers d&#039;un privil', 1, 'Permet d&#039;acc'),
(39, 1202306148, 1, 1213237096, 5, 0, 'Fichier d&#039;un privil', 2, 'Permet d&#039;associer d&#039;un fichier '),
(40, 1202306148, 1, 1213338789, 5, 0, 'Fichier d&#039;un privil', 5, 'Permet de supprimer un fichier d&#039;un privil'),
(41, 1202306148, 1, 1213338495, 5, 1, 'Menu order', 3, 'Menu order'),
(42, 1202306148, 1, 1213246315, 5, 1, 'Reporting Menu', 4, 'Reporting Menu'),
(43, 1202306148, 1, 1213246809, 5, 0, 'Reporting Menu', 1, 'Reporting Menu'),
(44, 1202306148, 1, 1213247104, 5, 0, 'Liste des demandes de modification', 1, 'Permet d&#039;acc'),
(45, 1202306148, 1, 1213246780, 5, 0, 'Detail of a request', 1, 'Access to request details'),
(46, 1202306148, 1, 1213330932, 5, 0, 'Priorit', 3, 'Permet de changer la priorit'),
(47, 1202306148, 1, 1213246737, 5, 0, 'Liste des probl', 1, 'Permet d&#039;acc'),
(48, 1202306148, 1, 1213330325, 5, 0, 'Detail of a bug report', 1, 'Access to a bug report details'),
(49, 1202306148, 1, 1213330952, 5, 0, 'Priorite d&#039;un probl', 3, 'Permet de modifier la priorit'),
(50, 1202306148, 1, 1213246868, 5, 0, 'Liste des discussions', 1, 'Permet d&#039;acceder '),
(51, 1202306148, 1, 1213246905, 5, 0, 'Discussion', 1, 'Permet d&#039;acc'),
(52, 1202306148, 1, 1213330909, 5, 0, 'Priorit', 3, 'Permet de modifier la priorit'),
(53, 1202306148, 1, 1213336469, 5, 1, 'Upload center Menu', 4, 'Upload center Menu'),
(54, 1202306148, 1, 1213336949, 5, 0, 'Liste des types des r', 1, 'Permet d&#039;acc'),
(55, 1202306148, 1, 1213336971, 5, 0, 'Detail of a folder for upload files on server', 1, 'Access to detail of a folder on server'),
(56, 1202306148, 1, 1213337557, 5, 0, 'R', 2, 'Permet d&#039;ajouter un r'),
(57, 1202306148, 1, 1213337627, 5, 0, 'R', 3, 'Permet de modifier un r'),
(58, 1202306148, 1, 1213338628, 5, 0, 'R', 5, 'Permet de supprimer un r'),
(59, 1202306148, 1, 1213336806, 5, 0, 'Formats d&#039;un r', 1, 'Permet d&#039;acc'),
(60, 1202306148, 1, 1213337413, 5, 0, 'Format d&#039;un r', 2, 'Permet d&#039;ajouter un ou plusieurs formats '),
(61, 1202306148, 1, 1213338847, 5, 0, 'Format d&#039;un r', 5, 'Permet de supprimer un format d&#039;un r'),
(62, 1202306148, 1, 1213336834, 5, 0, 'Types MIME d&#039;un r', 1, 'Permet d&#039;acc'),
(63, 1202306148, 1, 1213337533, 5, 0, 'Types MIME d&#039;un r', 2, 'Permet d&#039;ajouter un ou plusieurs types MIME '),
(64, 1202306148, 1, 1213338649, 5, 0, 'Types MIME d&#039;un r', 5, 'Permet de supprimer un type MIME d&#039;un r'),
(65, 1202306148, 1, 1213338537, 5, 0, 'Miniatures d&#039;un r', 3, 'Permet de recr'),
(66, 1202306148, 1, 1213337021, 5, 0, 'Upload Files', 1, 'Files'),
(67, 1202306148, 1, 1213337472, 5, 0, 'Upload fichier', 2, 'Permet d&#039;acc'),
(68, 1202306148, 1, 1213336998, 5, 0, 'Detail of upload file on server', 1, 'Access to detail of a file upload on server'),
(69, 1202306148, 1, 1213337640, 5, 0, 'Upload fichier', 3, 'Permet de modifier un fichier upload'),
(70, 1202306148, 1, 1213338741, 5, 0, 'Upload fichier', 5, 'Permet de supprimer un fichier upload'),
(71, 1202306148, 1, 1213336661, 5, 0, 'Liste des format d&#039;image', 1, 'Permet d&#039;afficher la liste des formats pour redimensionner une image'),
(72, 1202306148, 1, 1213337444, 5, 0, 'Format d&#039;image', 2, 'Permet d&#039;ajouter un nouveau format d&#039;image'),
(73, 1202306148, 1, 1213336687, 5, 0, 'Detail of file format folder on server', 1, 'Access to detail of a file format folder on server'),
(74, 1202306148, 1, 1213338464, 5, 0, 'Format d&#039;image', 3, 'Permet de modifier les informations d&#039;un format d&#039;image'),
(75, 1202306148, 1, 1213338813, 5, 0, 'Format d&#039;image', 5, 'Permet de supprimer un format d&#039;image'),
(76, 1202306148, 1, 1213330376, 5, 1, 'Navigate Menu', 4, 'Navigate Menu'),
(77, 1202306148, 1, 1213330515, 5, 0, 'Gestion des rubriques', 1, 'Permet d''acc'),
(78, 1202306148, 1, 1213330482, 5, 0, 'Liste des rubriques', 1, 'Permet d&#039;acc'),
(79, 1202306148, 1, 1213330752, 5, 0, 'Rubrique', 2, 'Permet d&#039;ajouter une rubrique'),
(80, 1202306148, 1, 1213330565, 5, 0, 'Detail of a category', 1, 'Access to detail of category'),
(81, 1202306148, 1, 1213330845, 5, 0, 'Rubrique', 3, 'Permet de modifier les informations d&#039;une rubrique'),
(82, 1202306148, 1, 1213331106, 5, 0, 'Rubrique', 5, 'Permet de supprimer une rubrique'),
(83, 1202306148, 1, 1213331076, 5, 0, 'Ordre des rubriques', 3, 'Permet de d'),
(84, 1202306148, 1, 1213336594, 5, 0, 'Arborescence des rubriques', 1, 'Permet d&#039;acc'),
(85, 1202306148, 1, 1213330779, 5, 0, 'Arborescence des rubriques', 3, 'Permet de modifier l&#039;arborescence des rubriques'),
(86, 1202306148, 1, 1214446586, 18, 1, 'Moderate Menu', 4, ''),
(87, 1202306148, 1, 1213337924, 5, 0, 'Validation du pseudo d&#039;un membre', 3, 'Permet de valider le pseudo d&#039;un membre'),
(88, 1202306148, 1, 1205292588, 1, 0, 'read list lamp', 1, 'list of lamp there are id name catogery and description.'),
(89, 1202306148, 1, 1204871754, 1, 0, 'test', 1, 'sokhom #199, st 184 '),
(91, 1204861146, 1, 1212554994, 5, 0, 'Detail of a lantern', 1, 'Access to detail of a lantern'),
(92, 1204861274, 1, 1213245301, 5, 0, 'lamp details', 3, 'modify lamp details'),
(93, 1204861363, 1, 1213245130, 5, 0, 'lamp details', 2, 'create lamp details'),
(94, 1205123529, 11, 1213243956, 5, 1, 'Content Menu', 4, 'Content Menu'),
(95, 1205124079, 11, 1213244003, 5, 0, 'List of lanterns', 1, 'Allow access to list of lanterns'),
(96, 1205124416, 11, 1213244339, 5, 0, 'Detail of lantern', 1, 'Allow to show details of lanterns'),
(97, 1205124575, 11, 1213245284, 5, 0, 'lantern', 3, 'Allow to modify lantern field'),
(98, 1205124773, 11, 1213245220, 5, 0, 'lantern', 2, 'Allow to create lantern'),
(99, 1205124993, 11, 1213245321, 5, 0, 'lantern', 5, 'Allow to delete lantern'),
(100, 1205826177, 12, 1213244854, 5, 0, 'Detail of stock entries', 1, 'Show detail on stock entries'),
(101, 1207026223, 11, 1213245162, 5, 0, 'Discount', 2, 'allow to create new  discount code'),
(102, 1207189765, 12, 1213244608, 5, 0, 'Detail of discount', 1, 'Access to detail of a discount'),
(103, 1207190420, 11, 1213244064, 5, 0, 'list of lantern info', 1, 'allow to access list of lantern information'),
(104, 1207190744, 11, 1213244101, 5, 0, 'Detail of lantern  info', 1, 'allow to access the detail of lantern information'),
(105, 1207191559, 11, 1213245246, 5, 0, 'Modify lantern info', 3, 'allow to modify the lantern information'),
(106, 1207888275, 11, 1213245341, 5, 0, 'delete discount', 5, 'allow to delete code  discount'),
(107, 1209093862, 11, 1213244033, 5, 0, 'content provider', 1, 'allow to access provider'),
(108, 1209094662, 11, 1213245111, 5, 0, 'provider create', 2, 'allow to create provider'),
(109, 1209096183, 11, 1213244162, 5, 0, 'Detail of provider', 1, 'allow to access provider'),
(110, 1212468359, 12, 1213330276, 5, 0, 'sitemap_url_list', 1, 'allow to access sitemap url list'),
(111, 1212549095, 12, 1213250003, 5, 1, 'Webrank Menu', 4, 'Webrank Menu'),
(112, 1213079598, 20, 1213236973, 5, 0, 'Groups of a privilege', 2, 'Use to associate the group to access right'),
(113, 1213083910, 20, 1213172390, 5, 0, 'aa test access right', 1, 'test'),
(114, 1213233739, 20, 1213244694, 5, 0, 'List of country', 1, 'Allow to access country'),
(115, 1213234558, 20, 1213245190, 5, 0, 'Country', 2, 'Allow to create new country'),
(116, 1213235051, 20, 1213244663, 5, 0, 'Details of the country', 1, 'Access to country details'),
(117, 1213235509, 20, 1213245265, 5, 0, 'Modify country details', 3, 'Allow to modify country details'),
(118, 1213235823, 20, 1213245369, 5, 0, 'Country', 5, 'Allow to delete country'),
(119, 1214447028, 18, 1214447116, 18, 0, 'test-chandy', 1, ''),
(120, 1214447208, 18, 1214447208, 18, 0, 'test-chandy', 1, ''),
(121, 1214970181, 25, 1214984382, 25, 0, '', 1, ''),
(122, 1215066509, 25, 1215066515, 25, 0, '', 4, ''),
(123, 1215066541, 25, 1215066544, 25, 0, '', 4, ''),
(124, 1252029804, 39, 1252029804, 39, 1, 'Transaction Menu', 4, ''),
(125, 1408434344, 1, 1408434344, 1, 1, 'Proviva Menu', 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `_adm_privilege_fichier`
--

CREATE TABLE IF NOT EXISTS `_adm_privilege_fichier` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_createur` int(10) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(10) NOT NULL DEFAULT '0',
  `etat_doc` int(1) NOT NULL DEFAULT '1',
  `id_privilege` int(10) NOT NULL DEFAULT '0',
  `id_fichier` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=548 ;

--
-- Dumping data for table `_adm_privilege_fichier`
--

INSERT INTO `_adm_privilege_fichier` (`id`, `date_creation`, `id_createur`, `date_modification`, `id_modificateur`, `etat_doc`, `id_privilege`, `id_fichier`) VALUES
(1, 1202306148, 1, 1202306148, 1, 1, 1, 1),
(2, 1202306148, 1, 1213170305, 5, 0, 2, 2),
(3, 1202306148, 1, 1213176406, 5, 0, 3, 3),
(4, 1202306148, 1, 1213237218, 5, 0, 4, 4),
(5, 1202306148, 1, 1202306148, 1, 1, 5, 5),
(6, 1202306148, 1, 1202306148, 1, 1, 6, 6),
(7, 1202306148, 1, 1202306148, 1, 1, 7, 7),
(8, 1202306148, 1, 1213176375, 5, 0, 8, 8),
(9, 1202306148, 1, 1213237011, 5, 0, 9, 9),
(10, 1202306148, 1, 1213338438, 5, 0, 10, 10),
(11, 1202306148, 1, 1213176442, 5, 0, 11, 11),
(12, 1202306148, 1, 1213237304, 5, 0, 12, 12),
(13, 1202306148, 1, 1213339075, 5, 0, 13, 13),
(14, 1202306148, 1, 1202306148, 1, 1, 14, 14),
(15, 1202306148, 1, 1202306148, 1, 1, 15, 15),
(16, 1202306148, 1, 1202306148, 1, 1, 16, 16),
(17, 1202306148, 1, 1202306148, 1, 1, 17, 17),
(18, 1202306148, 1, 1213176236, 5, 0, 18, 18),
(19, 1202306148, 1, 1213179304, 5, 0, 19, 19),
(20, 1202306148, 1, 1213179363, 5, 0, 20, 20),
(21, 1202306148, 1, 1213175967, 5, 0, 21, 21),
(22, 1202306148, 1, 1213179491, 5, 0, 22, 22),
(23, 1202306148, 1, 1213175874, 5, 0, 23, 23),
(24, 1202306148, 1, 1202306148, 1, 1, 24, 24),
(25, 1202306148, 1, 1202306148, 1, 1, 25, 25),
(26, 1202306148, 1, 1213179230, 5, 0, 26, 26),
(27, 1202306148, 1, 1213176483, 5, 1, 27, 27),
(28, 1202306148, 1, 1213236897, 5, 0, 28, 28),
(29, 1202306148, 1, 1213338599, 5, 0, 29, 29),
(30, 1202306148, 1, 1213176326, 5, 0, 30, 30),
(31, 1202306148, 1, 1213237450, 5, 0, 31, 31),
(32, 1202306148, 1, 1213338764, 5, 0, 32, 32),
(33, 1202306148, 1, 1202306148, 1, 1, 33, 33),
(34, 1202306148, 1, 1202306148, 1, 1, 34, 34),
(35, 1202306148, 1, 1213338294, 5, 0, 35, 35),
(36, 1202306148, 1, 1202306148, 1, 1, 36, 36),
(37, 1202306148, 1, 1213179552, 5, 0, 37, 37),
(38, 1202306148, 1, 1213179175, 5, 0, 38, 38),
(39, 1202306148, 1, 1213237096, 5, 0, 39, 39),
(40, 1202306148, 1, 1213338789, 5, 0, 40, 40),
(41, 1202306148, 1, 1202306148, 1, 1, 41, 41),
(42, 1202306148, 1, 1202306148, 1, 1, 42, 42),
(43, 1202306148, 1, 1213246809, 5, 0, 43, 43),
(44, 1202306148, 1, 1213247104, 5, 0, 44, 44),
(45, 1202306148, 1, 1213246780, 5, 0, 45, 45),
(46, 1202306148, 1, 1213330932, 5, 0, 46, 46),
(47, 1202306148, 1, 1213246737, 5, 0, 47, 47),
(48, 1202306148, 1, 1213330325, 5, 0, 48, 48),
(49, 1202306148, 1, 1213330952, 5, 0, 49, 49),
(50, 1202306148, 1, 1213246868, 5, 0, 50, 50),
(51, 1202306148, 1, 1213246905, 5, 0, 51, 51),
(52, 1202306148, 1, 1213330909, 5, 0, 52, 52),
(53, 1202306148, 1, 1202306148, 1, 1, 53, 53),
(54, 1202306148, 1, 1213336949, 5, 0, 54, 54),
(55, 1202306148, 1, 1213336971, 5, 0, 55, 55),
(56, 1202306148, 1, 1213337557, 5, 0, 56, 56),
(57, 1202306148, 1, 1213337627, 5, 0, 57, 57),
(58, 1202306148, 1, 1213338628, 5, 0, 58, 58),
(59, 1202306148, 1, 1213336806, 5, 0, 59, 59),
(60, 1202306148, 1, 1213337413, 5, 0, 60, 60),
(61, 1202306148, 1, 1213338847, 5, 0, 61, 61),
(62, 1202306148, 1, 1213336834, 5, 0, 62, 62),
(63, 1202306148, 1, 1213337533, 5, 0, 63, 63),
(64, 1202306148, 1, 1213338649, 5, 0, 64, 64),
(65, 1202306148, 1, 1213338537, 5, 0, 65, 65),
(66, 1202306148, 1, 1213337021, 5, 0, 66, 66),
(67, 1202306148, 1, 1213337472, 5, 0, 67, 67),
(68, 1202306148, 1, 1213336998, 5, 0, 68, 68),
(69, 1202306148, 1, 1213337640, 5, 0, 69, 69),
(70, 1202306148, 1, 1213338741, 5, 0, 70, 70),
(71, 1202306148, 1, 1213336661, 5, 0, 71, 71),
(72, 1202306148, 1, 1213337444, 5, 0, 72, 72),
(73, 1202306148, 1, 1213336687, 5, 0, 73, 73),
(74, 1202306148, 1, 1213338464, 5, 0, 74, 74),
(75, 1202306148, 1, 1213338813, 5, 0, 75, 75),
(76, 1202306148, 1, 1408419341, 1, 0, 76, 76),
(77, 1202306148, 1, 1213330515, 5, 0, 77, 77),
(78, 1202306148, 1, 1213330482, 5, 0, 78, 78),
(79, 1202306148, 1, 1213330752, 5, 0, 79, 79),
(80, 1202306148, 1, 1213330565, 5, 0, 80, 80),
(81, 1202306148, 1, 1213330845, 5, 0, 81, 81),
(82, 1202306148, 1, 1213331106, 5, 0, 82, 82),
(83, 1202306148, 1, 1248679099, 39, 0, 83, 83),
(84, 1202306148, 1, 1248679526, 39, 0, 84, 84),
(85, 1202306148, 1, 1248679415, 39, 0, 85, 85),
(86, 1202306148, 1, 1202306148, 1, 1, 86, 86),
(87, 1202306148, 1, 1213337924, 5, 0, 87, 87),
(88, 1202306148, 1, 1205292588, 1, 0, 88, 88),
(89, 1204191707, 1, 1213179175, 5, 0, 38, 2),
(90, 1204191741, 1, 1213179175, 5, 0, 38, 2),
(91, 1204858907, 1, 1205292588, 1, 0, 88, 92),
(92, 1204859534, 1, 1205292472, 1, 0, 89, 93),
(93, 1204859822, 1, 1205292454, 1, 0, 89, 94),
(94, 1204861173, 1, 1212554994, 5, 0, 91, 94),
(95, 1204861287, 1, 1213245301, 5, 0, 92, 93),
(96, 1204861375, 1, 1213245130, 5, 0, 93, 92),
(97, 1205123564, 11, 1205123564, 11, 1, 94, 95),
(98, 1205124079, 11, 1213244003, 5, 0, 95, 96),
(99, 1205124416, 11, 1213244339, 5, 0, 96, 97),
(100, 1205124576, 11, 1213245284, 5, 0, 97, 98),
(101, 1205124773, 11, 1213245220, 5, 0, 98, 99),
(102, 1205124993, 11, 1213245321, 5, 0, 99, 100),
(103, 1205202014, 11, 1213244339, 5, 0, 96, 101),
(104, 1205202510, 11, 1213244339, 5, 0, 96, 102),
(105, 1205202663, 11, 1213244339, 5, 0, 96, 103),
(106, 1205204633, 11, 1213338813, 5, 0, 75, 3),
(107, 1205221230, 11, 1213244339, 5, 0, 96, 104),
(108, 1205221585, 11, 1213244339, 5, 0, 96, 105),
(109, 1205221923, 11, 1213244339, 5, 0, 96, 106),
(110, 1205229438, 12, 1213176236, 5, 0, 18, 107),
(111, 1205289556, 11, 1213337472, 5, 0, 67, 108),
(112, 1205289591, 11, 1213244339, 5, 0, 96, 108),
(113, 1205297493, 12, 1213245220, 5, 0, 98, 110),
(114, 1205306353, 12, 1213330565, 5, 0, 80, 111),
(115, 1205311258, 12, 1213330565, 5, 0, 80, 112),
(116, 1205311970, 12, 1213330565, 5, 0, 80, 113),
(117, 1205312233, 12, 1213330565, 5, 0, 80, 114),
(118, 1205313002, 1, 1213330325, 5, 0, 48, 2),
(119, 1205315870, 12, 1213330565, 5, 0, 80, 116),
(120, 1205826177, 12, 1213244854, 5, 0, 100, 117),
(121, 1205826317, 12, 1213244854, 5, 0, 100, 118),
(122, 1205826426, 12, 1213244854, 5, 0, 100, 119),
(123, 1205900509, 12, 1213244854, 5, 0, 100, 120),
(124, 1205914191, 12, 1213244854, 5, 0, 100, 121),
(125, 1205974854, 12, 1213244854, 5, 0, 100, 122),
(126, 1207026007, 11, 1207026007, 11, 1, 94, 109),
(127, 1207026223, 11, 1213245162, 5, 0, 101, 123),
(128, 1207189765, 12, 1213244608, 5, 0, 102, 125),
(129, 1207190066, 11, 1207190350, 11, 0, 86, 124),
(130, 1207190085, 12, 1213244608, 5, 0, 102, 126),
(131, 1207190190, 12, 1213244608, 5, 0, 102, 126),
(132, 1207190435, 11, 1213244064, 5, 0, 103, 124),
(133, 1207190444, 11, 1213244064, 5, 0, 103, 124),
(134, 1207190744, 11, 1213244101, 5, 0, 104, 127),
(135, 1207191559, 11, 1213245246, 5, 0, 105, 128),
(136, 1207204680, 12, 1213244608, 5, 0, 102, 129),
(137, 1207652071, 12, 1213176236, 5, 0, 18, 130),
(138, 1207888288, 11, 1213245341, 5, 0, 106, 129),
(139, 1207888521, 11, 1213245341, 5, 0, 106, 131),
(140, 1207888876, 11, 1213244608, 5, 0, 102, 132),
(141, 1207889028, 11, 1213245341, 5, 0, 106, 133),
(142, 1208773958, 11, 1208773958, 11, 1, 94, 134),
(143, 1209093862, 11, 1213244033, 5, 0, 107, 135),
(144, 1209094662, 11, 1213245111, 5, 0, 108, 136),
(145, 1209096183, 11, 1213244162, 5, 0, 109, 137),
(146, 1209109325, 11, 1213244162, 5, 0, 109, 138),
(147, 1209111640, 11, 1213244162, 5, 0, 109, 139),
(148, 1209118808, 11, 1213244162, 5, 0, 109, 140),
(149, 1209351377, 12, 1213244162, 5, 0, 109, 141),
(150, 1209351773, 12, 1213244162, 5, 0, 109, 142),
(151, 1209464756, 12, 1213244162, 5, 0, 109, 143),
(152, 1209465030, 12, 1213244162, 5, 0, 109, 144),
(153, 1209465170, 12, 1213244162, 5, 0, 109, 145),
(154, 1212468360, 12, 1213330276, 5, 0, 110, 146),
(155, 1212549095, 12, 1212549095, 12, 1, 111, 147),
(156, 1212549240, 12, 1212549240, 12, 1, 111, 148),
(157, 1212552335, 12, 1213330276, 5, 0, 110, 149),
(158, 1213065377, 20, 1213176375, 5, 0, 8, 151),
(159, 1213066216, 20, 1213338764, 5, 0, 32, 4),
(160, 1213066241, 20, 1213244339, 5, 0, 96, 4),
(161, 1213066698, 20, 1213336594, 5, 0, 84, 4),
(162, 1213067265, 20, 1213067265, 20, 1, 0, 4),
(163, 1213067704, 20, 1213176442, 5, 0, 11, 4),
(164, 1213067705, 20, 1213336594, 5, 0, 84, 4),
(165, 1213068106, 20, 1213179491, 5, 0, 22, 152),
(166, 1213079598, 20, 1213236973, 5, 0, 112, 153),
(167, 1213084040, 20, 1213172390, 5, 0, 113, 4),
(168, 1213084052, 20, 1213172390, 5, 0, 113, 4),
(169, 1213086965, 20, 1213338599, 5, 0, 29, 154),
(170, 1213092142, 20, 1213336594, 5, 0, 84, 4),
(171, 1213092601, 20, 1213234406, 20, 0, 11, 4),
(172, 1213092601, 20, 1213336594, 5, 0, 84, 4),
(173, 1213148019, 20, 1213172390, 5, 0, 113, 4),
(174, 1213148382, 20, 1213176442, 5, 0, 11, 4),
(175, 1213148564, 20, 1213172390, 5, 0, 113, 4),
(176, 1213148564, 20, 1213176442, 5, 0, 11, 4),
(177, 1213152217, 20, 1213172390, 5, 0, 113, 4),
(178, 1213152217, 20, 1213176442, 5, 0, 11, 4),
(179, 1213152217, 20, 1213336594, 5, 0, 84, 4),
(180, 1213156398, 20, 1213172390, 5, 0, 113, 4),
(181, 1213156645, 20, 1213176442, 5, 0, 11, 4),
(182, 1213157213, 20, 1213172390, 5, 0, 113, 4),
(183, 1213157213, 20, 1213176442, 5, 0, 11, 4),
(184, 1213157214, 20, 1213336594, 5, 0, 84, 4),
(185, 1213157214, 20, 1213244033, 5, 0, 107, 4),
(186, 1213172440, 5, 1213172440, 5, 1, 14, 2),
(187, 1213172816, 5, 1213172816, 5, 1, 14, 107),
(188, 1213173921, 5, 1213173921, 5, 1, 14, 18),
(189, 1213173921, 5, 1213173921, 5, 1, 14, 19),
(190, 1213173921, 5, 1213173921, 5, 1, 14, 20),
(191, 1213173921, 5, 1213173921, 5, 1, 14, 130),
(192, 1213174724, 5, 1213174724, 5, 1, 16, 21),
(193, 1213175714, 5, 1213175714, 5, 1, 15, 2),
(194, 1213175795, 5, 1213175795, 5, 1, 15, 23),
(195, 1213177939, 5, 1213177939, 5, 1, 2, 2),
(196, 1213177939, 5, 1213177939, 5, 1, 2, 3),
(197, 1213177939, 5, 1213234400, 20, 0, 2, 4),
(198, 1213177939, 5, 1213177939, 5, 1, 2, 11),
(199, 1213177939, 5, 1213177939, 5, 1, 2, 12),
(200, 1213177939, 5, 1213177939, 5, 1, 2, 13),
(201, 1213177939, 5, 1213177939, 5, 1, 2, 7),
(202, 1213177939, 5, 1213177939, 5, 1, 2, 5),
(203, 1213177940, 5, 1213177940, 5, 1, 2, 151),
(204, 1213177940, 5, 1213177940, 5, 1, 2, 9),
(205, 1213177940, 5, 1213177940, 5, 1, 2, 10),
(206, 1213177940, 5, 1213177940, 5, 1, 2, 6),
(207, 1213177940, 5, 1213177940, 5, 1, 2, 22),
(208, 1213177940, 5, 1213177940, 5, 1, 2, 23),
(209, 1213177940, 5, 1213177940, 5, 1, 2, 26),
(210, 1213177940, 5, 1213177940, 5, 1, 2, 24),
(211, 1213177940, 5, 1213177940, 5, 1, 2, 27),
(212, 1213177940, 5, 1213177940, 5, 1, 2, 28),
(213, 1213177940, 5, 1213177940, 5, 1, 2, 29),
(214, 1213177940, 5, 1213177940, 5, 1, 2, 25),
(215, 1213177940, 5, 1213177940, 5, 1, 2, 30),
(216, 1213177940, 5, 1213177940, 5, 1, 2, 31),
(217, 1213177940, 5, 1213177940, 5, 1, 2, 32),
(218, 1213177940, 5, 1213177940, 5, 1, 2, 41),
(219, 1213177940, 5, 1213177940, 5, 1, 2, 33),
(220, 1213177940, 5, 1213177940, 5, 1, 2, 34),
(221, 1213177940, 5, 1213177940, 5, 1, 2, 37),
(222, 1213177940, 5, 1213177940, 5, 1, 2, 38),
(223, 1213177941, 5, 1213177941, 5, 1, 2, 39),
(224, 1213177941, 5, 1213177941, 5, 1, 2, 40),
(225, 1213177941, 5, 1213177941, 5, 1, 2, 152),
(226, 1213177941, 5, 1213177941, 5, 1, 2, 153),
(227, 1213177941, 5, 1213177941, 5, 1, 2, 154),
(228, 1213177941, 5, 1213177941, 5, 1, 2, 35),
(229, 1213177941, 5, 1213177941, 5, 1, 2, 36),
(230, 1213177941, 5, 1213177941, 5, 1, 2, 14),
(231, 1213177941, 5, 1213177941, 5, 1, 2, 15),
(232, 1213177941, 5, 1213177941, 5, 1, 2, 107),
(233, 1213177941, 5, 1213177941, 5, 1, 2, 18),
(234, 1213177941, 5, 1213177941, 5, 1, 2, 19),
(235, 1213177941, 5, 1213177941, 5, 1, 2, 20),
(236, 1213177941, 5, 1213177941, 5, 1, 2, 16),
(237, 1213177941, 5, 1213177941, 5, 1, 2, 21),
(238, 1213177941, 5, 1213177941, 5, 1, 2, 130),
(239, 1213177941, 5, 1213177941, 5, 1, 2, 17),
(240, 1213178322, 20, 1213244033, 5, 0, 107, 155),
(241, 1213178752, 5, 1213178752, 5, 1, 7, 3),
(242, 1213178804, 5, 1213178804, 5, 1, 7, 2),
(243, 1213178804, 5, 1213178804, 5, 1, 7, 11),
(244, 1213178804, 5, 1213178804, 5, 1, 7, 151),
(245, 1213179057, 5, 1213179057, 5, 1, 33, 151),
(246, 1213179057, 5, 1213179057, 5, 1, 33, 22),
(247, 1213179057, 5, 1213179057, 5, 1, 33, 26),
(248, 1213179057, 5, 1213179057, 5, 1, 33, 27),
(249, 1213179057, 5, 1213179057, 5, 1, 33, 30),
(250, 1213179057, 5, 1213179057, 5, 1, 33, 37),
(251, 1213179057, 5, 1213179057, 5, 1, 33, 38),
(252, 1213179058, 5, 1213179058, 5, 1, 33, 152),
(253, 1213179058, 5, 1213179058, 5, 1, 33, 19),
(254, 1213179063, 5, 1213179063, 5, 1, 33, 2),
(255, 1213233739, 20, 1213244694, 5, 0, 114, 156),
(256, 1213234558, 20, 1213245190, 5, 0, 115, 157),
(257, 1213235051, 20, 1213244663, 5, 0, 116, 158),
(258, 1213235509, 20, 1213245265, 5, 0, 117, 159),
(259, 1213235823, 20, 1213245369, 5, 0, 118, 160),
(260, 1213236360, 5, 1213236360, 5, 1, 14, 22),
(261, 1213236360, 5, 1213236360, 5, 1, 14, 26),
(262, 1213236360, 5, 1213236360, 5, 1, 14, 27),
(263, 1213236360, 5, 1213236360, 5, 1, 14, 30),
(264, 1213236785, 5, 1213236785, 5, 1, 34, 2),
(265, 1213236785, 5, 1213236813, 5, 0, 34, 3),
(266, 1213236785, 5, 1213236785, 5, 1, 34, 4),
(267, 1213236785, 5, 1213236785, 5, 1, 34, 12),
(268, 1213236785, 5, 1213236785, 5, 1, 34, 9),
(269, 1213236785, 5, 1213236785, 5, 1, 34, 28),
(270, 1213236785, 5, 1213236785, 5, 1, 34, 39),
(271, 1213236785, 5, 1213236785, 5, 1, 34, 153),
(272, 1213237129, 5, 1213237218, 5, 0, 4, 2),
(273, 1213237163, 5, 1213237163, 5, 1, 2, 4),
(274, 1213237345, 5, 1213237345, 5, 1, 15, 28),
(275, 1213237380, 5, 1213237380, 5, 1, 15, 31),
(276, 1213237400, 5, 1213237400, 5, 1, 15, 153),
(277, 1213242941, 20, 1213245369, 5, 0, 118, 161),
(278, 1213243417, 20, 1213244162, 5, 0, 109, 161),
(279, 1213243832, 20, 1213245369, 5, 0, 118, 162),
(280, 1213243971, 5, 1213243971, 5, 1, 94, 156),
(281, 1213243971, 5, 1213243971, 5, 1, 94, 157),
(282, 1213243971, 5, 1213243971, 5, 1, 94, 160),
(283, 1213243971, 5, 1213243971, 5, 1, 94, 158),
(284, 1213243971, 5, 1213243971, 5, 1, 94, 159),
(285, 1213243971, 5, 1213243971, 5, 1, 94, 161),
(286, 1213243971, 5, 1213243971, 5, 1, 94, 162),
(287, 1213243971, 5, 1213243971, 5, 1, 94, 123),
(288, 1213243971, 5, 1213243971, 5, 1, 94, 133),
(289, 1213243971, 5, 1213243971, 5, 1, 94, 132),
(290, 1213243971, 5, 1213243971, 5, 1, 94, 96),
(291, 1213243971, 5, 1213243971, 5, 1, 94, 102),
(292, 1213243971, 5, 1213243971, 5, 1, 94, 101),
(293, 1213243972, 5, 1213243972, 5, 1, 94, 103),
(294, 1213243972, 5, 1213243972, 5, 1, 94, 99),
(295, 1213243972, 5, 1213243972, 5, 1, 94, 100),
(296, 1213243972, 5, 1213243972, 5, 1, 94, 97),
(297, 1213243972, 5, 1213243972, 5, 1, 94, 98),
(298, 1213243972, 5, 1213243972, 5, 1, 94, 104),
(299, 1213243972, 5, 1213243972, 5, 1, 94, 105),
(300, 1213243972, 5, 1213243972, 5, 1, 94, 106),
(301, 1213243972, 5, 1213243972, 5, 1, 94, 117),
(302, 1213243972, 5, 1213243972, 5, 1, 94, 118),
(303, 1213243972, 5, 1213243972, 5, 1, 94, 119),
(304, 1213243972, 5, 1213243972, 5, 1, 94, 135),
(305, 1213243972, 5, 1213243972, 5, 1, 94, 143),
(306, 1213243972, 5, 1213243972, 5, 1, 94, 144),
(307, 1213243972, 5, 1213243972, 5, 1, 94, 145),
(308, 1213243972, 5, 1213243972, 5, 1, 94, 155),
(309, 1213243972, 5, 1213243972, 5, 1, 94, 136),
(310, 1213243972, 5, 1213243972, 5, 1, 94, 142),
(311, 1213243972, 5, 1213243972, 5, 1, 94, 137),
(312, 1213243972, 5, 1213243972, 5, 1, 94, 138),
(313, 1213243972, 5, 1213243972, 5, 1, 94, 139),
(314, 1213243973, 5, 1213243973, 5, 1, 94, 140),
(315, 1213243973, 5, 1213243973, 5, 1, 94, 141),
(316, 1213243973, 5, 1213243973, 5, 1, 94, 120),
(317, 1213243973, 5, 1213243973, 5, 1, 94, 122),
(318, 1213243973, 5, 1213243973, 5, 1, 94, 121),
(319, 1213244333, 20, 1213245190, 5, 0, 115, 163),
(320, 1213246352, 5, 1213246352, 5, 1, 42, 44),
(321, 1213246352, 5, 1213246352, 5, 1, 42, 45),
(322, 1213246352, 5, 1213246352, 5, 1, 42, 46),
(323, 1213246353, 5, 1213246353, 5, 1, 42, 50),
(324, 1213246353, 5, 1213246353, 5, 1, 42, 51),
(325, 1213246353, 5, 1213246353, 5, 1, 42, 52),
(326, 1213246353, 5, 1213246353, 5, 1, 42, 43),
(327, 1213246353, 5, 1213246353, 5, 1, 42, 47),
(328, 1213246353, 5, 1213246353, 5, 1, 42, 48),
(329, 1213246353, 5, 1213246353, 5, 1, 42, 49),
(330, 1213250024, 5, 1213250024, 5, 1, 111, 149),
(331, 1213262219, 20, 1213262219, 20, 1, 94, 163),
(332, 1213326512, 20, 1213326512, 20, 1, 94, 164),
(333, 1213330241, 5, 1213330241, 5, 1, 111, 146),
(334, 1213330424, 5, 1213330424, 5, 1, 76, 79),
(335, 1213330424, 5, 1248679526, 39, 0, 76, 84),
(336, 1213330424, 5, 1248679415, 39, 0, 76, 85),
(337, 1213330424, 5, 1213330424, 5, 1, 76, 80),
(338, 1213330424, 5, 1213330424, 5, 1, 76, 111),
(339, 1213330424, 5, 1213330424, 5, 1, 76, 112),
(340, 1213330424, 5, 1213330424, 5, 1, 76, 116),
(341, 1213330424, 5, 1213330424, 5, 1, 76, 114),
(342, 1213330425, 5, 1213330425, 5, 1, 76, 78),
(343, 1213330425, 5, 1213330425, 5, 1, 76, 81),
(344, 1213330425, 5, 1248679099, 39, 0, 76, 83),
(345, 1213330425, 5, 1213330425, 5, 1, 76, 82),
(346, 1213332134, 20, 1213332134, 20, 1, 94, 165),
(347, 1213336503, 5, 1213336503, 5, 1, 53, 66),
(348, 1213336503, 5, 1213336503, 5, 1, 53, 67),
(349, 1213336503, 5, 1213336503, 5, 1, 53, 68),
(350, 1213336503, 5, 1213336503, 5, 1, 53, 69),
(351, 1213336503, 5, 1213336503, 5, 1, 53, 70),
(352, 1213336503, 5, 1213336503, 5, 1, 53, 108),
(353, 1213336503, 5, 1213336503, 5, 1, 53, 71),
(354, 1213336503, 5, 1213336503, 5, 1, 53, 72),
(355, 1213336503, 5, 1213336503, 5, 1, 53, 73),
(356, 1213336504, 5, 1213336504, 5, 1, 53, 74),
(357, 1213336504, 5, 1213336504, 5, 1, 53, 75),
(358, 1213336504, 5, 1213336504, 5, 1, 53, 54),
(359, 1213336504, 5, 1213336504, 5, 1, 53, 56),
(360, 1213336504, 5, 1213336504, 5, 1, 53, 55),
(361, 1213336504, 5, 1213336504, 5, 1, 53, 59),
(362, 1213336504, 5, 1213336504, 5, 1, 53, 60),
(363, 1213336504, 5, 1213336504, 5, 1, 53, 61),
(364, 1213336504, 5, 1213336504, 5, 1, 53, 62),
(365, 1213336504, 5, 1213336504, 5, 1, 53, 63),
(366, 1213336504, 5, 1213336504, 5, 1, 53, 64),
(367, 1213336504, 5, 1213336504, 5, 1, 53, 57),
(368, 1213336504, 5, 1213336504, 5, 1, 53, 65),
(369, 1213336504, 5, 1213336504, 5, 1, 53, 58),
(370, 1213337081, 5, 1220233154, 5, 0, 86, 124),
(371, 1213337081, 5, 1220233147, 5, 0, 86, 127),
(372, 1213337081, 5, 1220233151, 5, 0, 86, 128),
(373, 1213337081, 5, 1213337081, 5, 1, 86, 87),
(374, 1213338133, 5, 1213338133, 5, 1, 5, 3),
(375, 1213338133, 5, 1213338133, 5, 1, 5, 11),
(376, 1213338133, 5, 1213338133, 5, 1, 5, 12),
(377, 1213338133, 5, 1213338133, 5, 1, 5, 13),
(378, 1213338133, 5, 1213338133, 5, 1, 5, 7),
(379, 1213338133, 5, 1213338133, 5, 1, 5, 151),
(380, 1213338133, 5, 1213338133, 5, 1, 5, 9),
(381, 1213338133, 5, 1213338133, 5, 1, 5, 10),
(382, 1213338133, 5, 1213338133, 5, 1, 5, 41),
(383, 1213338133, 5, 1213338133, 5, 1, 5, 33),
(384, 1213338133, 5, 1213338133, 5, 1, 5, 37),
(385, 1213338133, 5, 1213338133, 5, 1, 5, 38),
(386, 1213338133, 5, 1213338133, 5, 1, 5, 39),
(387, 1213338133, 5, 1213338133, 5, 1, 5, 40),
(388, 1213338133, 5, 1213338133, 5, 1, 5, 152),
(389, 1213338133, 5, 1213338133, 5, 1, 5, 153),
(390, 1213338133, 5, 1213338133, 5, 1, 5, 154),
(391, 1213338134, 5, 1213338134, 5, 1, 5, 35),
(392, 1213338244, 5, 1213338244, 5, 1, 24, 2),
(393, 1213338244, 5, 1213338244, 5, 1, 24, 22),
(394, 1213338244, 5, 1213338244, 5, 1, 24, 26),
(395, 1213338244, 5, 1213338244, 5, 1, 24, 27),
(396, 1213338244, 5, 1213338244, 5, 1, 24, 28),
(397, 1213338244, 5, 1213338244, 5, 1, 24, 29),
(398, 1213338244, 5, 1213338244, 5, 1, 24, 30),
(399, 1213338244, 5, 1213338244, 5, 1, 24, 31),
(400, 1213338244, 5, 1213338244, 5, 1, 24, 32),
(401, 1213338244, 5, 1213338244, 5, 1, 24, 14),
(402, 1213338244, 5, 1213338244, 5, 1, 24, 107),
(403, 1213338244, 5, 1213338244, 5, 1, 24, 18),
(404, 1213338244, 5, 1213338244, 5, 1, 24, 19),
(405, 1213338244, 5, 1213338244, 5, 1, 24, 20),
(406, 1213338244, 5, 1213338244, 5, 1, 24, 16),
(407, 1213338244, 5, 1213338244, 5, 1, 24, 21),
(408, 1213338244, 5, 1213338244, 5, 1, 24, 130),
(409, 1213579406, 12, 1213579406, 12, 1, 111, 166),
(410, 1213585057, 12, 1213585057, 12, 1, 111, 167),
(411, 1213606930, 20, 1213606930, 20, 1, 94, 168),
(412, 1213610407, 20, 1213610407, 20, 1, 94, 169),
(413, 1213610848, 20, 1213610848, 20, 1, 94, 170),
(414, 1213611024, 20, 1213611024, 20, 1, 94, 171),
(415, 1213759214, 20, 1213759214, 20, 1, 94, 173),
(416, 1213759459, 20, 1213759459, 20, 1, 94, 174),
(417, 1213759578, 20, 1213759578, 20, 1, 94, 175),
(418, 1213759724, 20, 1213759724, 20, 1, 94, 176),
(419, 1213759829, 20, 1213759829, 20, 1, 94, 177),
(420, 1213771938, 20, 1213771938, 20, 1, 94, 178),
(421, 1214211150, 20, 1214211150, 20, 1, 2, 179),
(422, 1214271604, 20, 1214271604, 20, 1, 2, 181),
(423, 1214278484, 20, 1214278484, 20, 1, 53, 182),
(424, 1214357197, 20, 1214357197, 20, 1, 2, 183),
(425, 1214357269, 20, 1214357269, 20, 1, 2, 184),
(426, 1214358237, 20, 1214358237, 20, 1, 2, 185),
(427, 1214358340, 20, 1214358340, 20, 1, 2, 186),
(428, 1214365029, 20, 1214365029, 20, 1, 2, 187),
(429, 1214452021, 18, 1214452240, 18, 0, 33, 180),
(430, 1214452249, 18, 1214452411, 18, 0, 7, 180),
(431, 1214452707, 18, 1214452707, 18, 1, 94, 180),
(432, 1214463803, 18, 1214465774, 18, 0, 94, 188),
(433, 1214816965, 20, 1214817592, 20, 0, 94, 189),
(434, 1214819154, 25, 1215683713, 5, 0, 94, 190),
(435, 1214883453, 25, 1214884104, 25, 0, 94, 191),
(436, 1214883527, 25, 1214884104, 25, 0, 94, 191),
(437, 1214883677, 25, 1214884070, 25, 0, 94, 192),
(438, 1214884157, 25, 1214884157, 25, 1, 94, 193),
(439, 1214885841, 25, 1214885841, 25, 1, 94, 194),
(440, 1214886243, 25, 1214907752, 25, 0, 94, 195),
(441, 1214887428, 25, 1214887602, 25, 0, 94, 196),
(442, 1214887651, 25, 1214888050, 25, 0, 94, 197),
(443, 1214888094, 25, 1214907793, 25, 0, 94, 198),
(444, 1214892980, 25, 1214893160, 25, 0, 94, 199),
(445, 1214893249, 25, 1214893706, 25, 0, 94, 200),
(446, 1214893758, 25, 1214907774, 25, 0, 94, 202),
(447, 1214899743, 20, 1214904627, 20, 0, 76, 203),
(448, 1214901941, 20, 1248679456, 39, 0, 2, 204),
(449, 1214901969, 20, 1248679456, 39, 0, 76, 204),
(450, 1214962829, 20, 1248679373, 39, 0, 76, 205),
(451, 1214968544, 25, 1215683620, 5, 0, 33, 206),
(452, 1214969804, 25, 1214984386, 25, 0, 2, 207),
(453, 1214969838, 25, 1214984389, 25, 0, 2, 207),
(454, 1214970181, 25, 1214984382, 25, 0, 121, 207),
(455, 1214984417, 25, 1214984582, 25, 0, 2, 207),
(456, 1214986127, 25, 1214986137, 25, 0, 2, 207),
(457, 1214986143, 25, 1214986148, 25, 0, 2, 207),
(458, 1214986174, 25, 1214986864, 25, 0, 94, 207),
(459, 1214986870, 25, 1214989613, 25, 0, 2, 207),
(460, 1214989618, 25, 1214989708, 25, 0, 2, 207),
(461, 1214989702, 25, 1214989711, 25, 0, 2, 207),
(462, 1214989720, 25, 1214989720, 25, 2, 2, 207),
(463, 1214990326, 25, 1214990337, 25, 0, 94, 4),
(464, 1215047768, 25, 1215047805, 25, 0, 94, 4),
(465, 1215050651, 25, 1215050667, 25, 0, 94, 3),
(466, 1215052442, 25, 1215053618, 25, 0, 94, 207),
(467, 1215052446, 25, 1215052488, 25, 0, 94, 207),
(468, 1215053607, 25, 1215053623, 25, 0, 94, 207),
(469, 1215066466, 25, 1215066489, 25, 0, 94, 207),
(470, 1215066509, 25, 1215066515, 25, 0, 122, 207),
(471, 1215066541, 25, 1215066806, 25, 0, 123, 207),
(472, 1215068038, 25, 1215068191, 25, 0, 94, 207),
(473, 1215068182, 25, 1215068211, 25, 0, 94, 207),
(474, 1215068296, 25, 1215068425, 25, 0, 94, 207),
(475, 1215068960, 25, 1215069189, 25, 0, 94, 207),
(476, 1215135184, 25, 1215135446, 25, 0, 94, 207),
(477, 1215135452, 25, 1215135461, 25, 0, 94, 207),
(478, 1215135465, 25, 1215135472, 25, 0, 94, 207),
(479, 1215577600, 20, 1215577600, 20, 1, 2, 208),
(480, 1215583915, 20, 1215583915, 20, 1, 2, 209),
(481, 1215585835, 20, 1215585835, 20, 1, 2, 210),
(482, 1215590051, 20, 1215590051, 20, 1, 2, 211),
(483, 1215593592, 20, 1215594043, 20, 0, 2, 212),
(484, 1215594702, 20, 1215594702, 20, 1, 2, 213),
(492, 1216951450, 18, 1216951450, 18, 1, 1, 219),
(493, 1216961396, 18, 1216961396, 18, 1, 1, 220),
(494, 1216969830, 18, 1216969830, 18, 1, 1, 221),
(495, 1217387242, 18, 1217387242, 18, 1, 94, 222),
(496, 1217403965, 18, 1217403965, 18, 1, 94, 223),
(497, 1217405793, 18, 1217405793, 18, 1, 94, 224),
(498, 1226292872, 5, 1226292872, 5, 1, 94, 225),
(499, 1226293705, 5, 1226293705, 5, 1, 94, 229),
(500, 1248315561, 1, 1248315561, 1, 1, 94, 230),
(501, 1248315724, 1, 1248315724, 1, 1, 94, 231),
(502, 1248315878, 1, 1248315878, 1, 1, 94, 232),
(503, 1248316046, 1, 1248316046, 1, 1, 94, 233),
(504, 1248316216, 1, 1248316216, 1, 1, 94, 234),
(505, 1248316430, 1, 1248316430, 1, 1, 94, 235),
(506, 1248316563, 1, 1248316563, 1, 1, 94, 236),
(507, 1248316732, 1, 1248316732, 1, 1, 94, 237),
(508, 1248317467, 1, 1248317467, 1, 1, 94, 238),
(509, 1248317607, 1, 1248317607, 1, 1, 94, 239),
(510, 1248317711, 1, 1248317711, 1, 1, 94, 240),
(511, 1248318236, 1, 1248318236, 1, 1, 94, 241),
(512, 1248318484, 1, 1248318484, 1, 1, 2, 242),
(513, 1248318828, 1, 1248318828, 1, 1, 42, 243),
(514, 1248675919, 1, 1248675919, 1, 1, 76, 244),
(515, 1248676006, 1, 1248676006, 1, 1, 76, 245),
(516, 1248745398, 39, 1248745398, 39, 1, 94, 246),
(517, 1248745475, 39, 1248745475, 39, 1, 94, 247),
(518, 1248745553, 39, 1248745553, 39, 1, 94, 248),
(519, 1248768800, 39, 1248768800, 39, 1, 111, 249),
(520, 1248771192, 39, 1248832306, 39, 0, 94, 250),
(521, 1248771333, 39, 1248832284, 39, 0, 94, 251),
(522, 1248771504, 39, 1248832254, 39, 0, 94, 252),
(523, 1248771622, 39, 1248832216, 39, 0, 94, 253),
(524, 1248771745, 39, 1248832190, 39, 0, 94, 254),
(525, 1252029804, 39, 1408419367, 1, 0, 124, 255),
(526, 1252030200, 39, 1252030200, 39, 1, 124, 256),
(527, 1408434584, 1, 1408434584, 1, 1, 125, 258),
(528, 1408435686, 1, 1408435686, 1, 1, 125, 259),
(529, 1408440214, 1, 1408440214, 1, 1, 125, 260),
(530, 1408440579, 1, 1408440579, 1, 1, 125, 261),
(531, 1408440690, 1, 1408440690, 1, 1, 125, 262),
(532, 1408441599, 1, 1408441599, 1, 1, 125, 263),
(533, 1408504459, 1, 1408504459, 1, 1, 125, 264),
(534, 1408504638, 1, 1408504638, 1, 1, 125, 265),
(535, 1408504750, 1, 1408504750, 1, 1, 125, 266),
(536, 1408505254, 1, 1408505254, 1, 1, 125, 267),
(537, 1408505437, 1, 1408505437, 1, 1, 125, 268),
(538, 1414378363, 1, 1414378363, 1, 1, 125, 269),
(539, 1417420145, 1, 1417420145, 1, 1, 125, 270),
(540, 1417420236, 1, 1417420236, 1, 1, 125, 271),
(541, 1417420332, 1, 1417420332, 1, 1, 125, 272),
(542, 1417420514, 1, 1417420514, 1, 1, 125, 273),
(543, 1417420600, 1, 1417420600, 1, 1, 125, 274),
(544, 1417420660, 1, 1417420660, 1, 1, 125, 275),
(545, 1417420743, 1, 1417420743, 1, 1, 125, 276),
(546, 1417420828, 1, 1417420828, 1, 1, 125, 277),
(547, 1417421882, 1, 1417421882, 1, 1, 125, 278);

-- --------------------------------------------------------

--
-- Table structure for table `_adm_user`
--

CREATE TABLE IF NOT EXISTS `_adm_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_createur` int(11) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(11) NOT NULL DEFAULT '0',
  `etat_doc` tinyint(1) NOT NULL DEFAULT '0',
  `key_unique` bigint(20) NOT NULL DEFAULT '0',
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `mot_de_passe` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `type_connect` tinyint(4) NOT NULL DEFAULT '0',
  `etat_user` tinyint(4) NOT NULL DEFAULT '0',
  `login_modif` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `_adm_user`
--

INSERT INTO `_adm_user` (`id_user`, `date_creation`, `id_createur`, `date_modification`, `id_modificateur`, `etat_doc`, `key_unique`, `login`, `mot_de_passe`, `type_connect`, `etat_user`, `login_modif`) VALUES
(1, 1417419670, 1, 1417419670, 1, 1, 120230614861087622, 'admin', '824e59a9812f9225692b2665854bb293', 0, 2, ''),
(2, 1417419670, 1, 1417419670, 1, 1, 141378638616762848, 'rithy.skun@ccplglobal.com', 'fd26ff8ba2d44ae62224c41d55c705b4', 0, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `_adm_user_groupe`
--

CREATE TABLE IF NOT EXISTS `_adm_user_groupe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL DEFAULT '0',
  `id_createur` int(11) NOT NULL DEFAULT '0',
  `date_modification` bigint(20) NOT NULL DEFAULT '0',
  `id_modificateur` int(11) NOT NULL DEFAULT '0',
  `etat_doc` int(1) NOT NULL DEFAULT '1',
  `id_groupe` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Dumping data for table `_adm_user_groupe`
--

INSERT INTO `_adm_user_groupe` (`id`, `date_creation`, `id_createur`, `date_modification`, `id_modificateur`, `etat_doc`, `id_groupe`, `id_user`) VALUES
(1, 1202306148, 1, 1202306148, 1, 1, 1, 1),
(30, 1215498511, 5, 1215498511, 5, 1, 1, 5),
(31, 1215498519, 5, 1215498519, 5, 1, 1, 13),
(32, 1248679031, 1, 1248679031, 1, 1, 1, 39),
(33, 1250481659, 1, 1250481659, 1, 1, 1, 65),
(34, 1254792917, 1, 1254792917, 1, 1, 1, 122),
(35, 1409901360, 1, 1409901901, 1, 0, 1, 2),
(36, 1410766797, 1, 1413786196, 1, 0, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `_histo_connection`
--

CREATE TABLE IF NOT EXISTS `_histo_connection` (
  `id_connection` int(11) NOT NULL AUTO_INCREMENT,
  `date_connection` bigint(20) NOT NULL DEFAULT '0',
  `login_connection` char(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `mot_de_passe_connection` char(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ip_connection` char(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `type_connection` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_connection`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `_histo_connection`
--

INSERT INTO `_histo_connection` (`id_connection`, `date_connection`, `login_connection`, `mot_de_passe_connection`, `ip_connection`, `type_connection`) VALUES
(1, 1417575031, 'admin', '824e59a9812f9225692b2665854bb293', '127.0.0.1', 1),
(2, 1417657601, 'admin', '824e59a9812f9225692b2665854bb293', '127.0.0.1', 1),
(3, 1418291429, 'admin', '824e59a9812f9225692b2665854bb293', '127.0.0.1', 1),
(4, 1418355161, 'admin', '824e59a9812f9225692b2665854bb293', '127.0.0.1', 1),
(5, 1418370255, 'admin', '824e59a9812f9225692b2665854bb293', '127.0.0.1', 1),
(6, 1418625381, 'admin', '824e59a9812f9225692b2665854bb293', '127.0.0.1', 1),
(7, 1418629381, 'admin', '0dc759abf265a7c3b0b150142f7a9c79', '127.0.0.1', 2),
(8, 1418629391, 'admin', '824e59a9812f9225692b2665854bb293', '127.0.0.1', 1),
(9, 1418897218, 'admin', '824e59a9812f9225692b2665854bb293', '120.136.28.54', 1),
(10, 1419222076, 'admin', '824e59a9812f9225692b2665854bb293', '120.136.28.54', 1),
(11, 1419223201, 'admin', '', '120.136.28.54', 3),
(12, 1420697987, 'admin', '824e59a9812f9225692b2665854bb293', '120.136.28.54', 1),
(13, 1424228422, 'proviegdb', '824e59a9812f9225692b2665854bb293', '42.115.69.93', 2);

-- --------------------------------------------------------

--
-- Table structure for table `_log`
--

CREATE TABLE IF NOT EXISTS `_log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `adresse_ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
