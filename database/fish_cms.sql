-- Adminer 4.8.1 MySQL 11.6.1-MariaDB-log dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `fish_cms`;
CREATE DATABASE `fish_cms` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_uca1400_ai_ci */;
USE `fish_cms`;

DROP TABLE IF EXISTS `cms_ad`;
CREATE TABLE `cms_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '广告id',
  `block_id` int(11) NOT NULL DEFAULT 0 COMMENT '广告位置',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '广告标题',
  `pic_url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片链接',
  `link_address` varchar(512) NOT NULL DEFAULT '' COMMENT '广告地址',
  `addtime` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '添加时间',
  `start_time` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '开始时间',
  `end_time` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '结束时间',
  `listorder` smallint(6) NOT NULL DEFAULT 0 COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '状态|0:显示,1:不显示',
  `is_mobile` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否是m版',
  PRIMARY KEY (`id`),
  KEY `block_id` (`id`,`block_id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci COMMENT='平台广告';


DROP TABLE IF EXISTS `cms_ad_block`;
CREATE TABLE `cms_ad_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '区块名称',
  `addtime` int(10) NOT NULL DEFAULT 0 COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='区块名称';


DROP TABLE IF EXISTS `cms_article`;
CREATE TABLE `cms_article` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '分类',
  `tag_ids` varchar(255) NOT NULL DEFAULT '0' COMMENT '标签id  ',
  `admin_id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '管理员id',
  `admin` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键词',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `content` longtext NOT NULL COMMENT '内容',
  `addtime` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '更新时间',
  `is_top` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否置顶 0普通 1置顶 2头条',
  `list_image_url` varchar(255) NOT NULL DEFAULT '' COMMENT '列表显示图片',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '状态 0正常 -1 删除',
  PRIMARY KEY (`id`),
  KEY `cate_id` (`id`,`cate_id`,`is_top`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci COMMENT='平台文章';

INSERT INTO `cms_article` (`id`, `cate_id`, `tag_ids`, `admin_id`, `admin`, `title`, `keywords`, `description`, `content`, `addtime`, `update_time`, `is_top`, `list_image_url`, `status`) VALUES
(1,	2,	'1',	20,	'hepm',	'对话 new是',	'深知禅道',	'default text',	'<p>⁠⁠⁠⁠⁠⁠⁠<span class=\"image-inline ck-widget ck-widget_with-resizer\" contenteditable=\"false\"><img src=\"http://127.0.0.1:2222/ckfinder/files/%E7%A6%85/u%3D32528942%2C2886003757%26fm%3D253%26fmt%3Dauto%26app%3D138%26f%3DJPEG.webp\"><div class=\"ck ck-reset_all ck-widget__resizer\" style=\"display: none;\"><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-left\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left\"></div><div class=\"ck ck-size-view\" style=\"display: none;\"></div></div></span></p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p><span class=\"image-inline ck-widget ck-widget_with-resizer\" contenteditable=\"false\"><img src=\"http://127.0.0.1:2222/ckfinder/files/%E7%A6%85/xm2024.jpg\"><div class=\"ck ck-reset_all ck-widget__resizer\" style=\"display: none;\"><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-left\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left\"></div><div class=\"ck ck-size-view\" style=\"display: none;\"></div></div></span></p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p><span class=\"image-inline ck-widget\" contenteditable=\"false\"><img src=\"http://127.0.0.1:2222/ckfinder/files/%E4%B8%93%E8%BE%91/beyond.jpg\"></span></p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p>:))))((((:</p><p><br data-cke-filler=\"true\"></p><p>作者：风筝<br>链接：https://www.zhihu.com/question/421478442/answer/1480684031<br>来源：知乎<br>著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。<br><br><br><span class=\"image-inline ck-widget ck-widget_with-resizer\" contenteditable=\"false\"><img src=\"http://127.0.0.1:2222/ckfinder/files/%E7%A6%85/u%3D1361346708%2C976085348%26fm%3D253%26fmt%3Dauto%26app%3D138%26f%3DJPEG.webp\"><div class=\"ck ck-reset_all ck-widget__resizer\" style=\"display: none;\"><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-left\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left\"></div><div class=\"ck ck-size-view\" style=\"display: none;\"></div></div></span></p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p><br><br><br><br><br><br><br><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p><mark class=\"marker-yellow\">这是一个正常的过程，比如以前觉得beyond是神，听了更多经典作品后觉得beyond很不错，但没有到神的地步，这也很合理。</mark></p><p><span style=\"color:hsl(240,75%,60%);\">但如果你听了一圈外国乐队后觉得beyond是个垃圾，或者觉得在中国摇滚里面beyond是垃圾，那我认为你听得还不够多</span>，也不能客观评价作品好坏。喜不喜欢beyond是主观问题，不喜欢没人能妨碍你，但无法从客观上找到依据来说明beyond水准的话，将没有说服力。</p><p>我八年前觉得beyond是神，后来学了木吉他，又受枪花影响拿起了电吉他，入坑欧美摇滚大坑，然后受X Japan影响在音乐道路上坚持下去，去钻研音乐制作方面的东西。当我回过头来审视beyond的时候，我仍然认为他们很牛逼，是对作品的客观评价，说是中国摇滚乐队天花板不为过。beyond歌曲旋律性普遍非常强，曲风特别多元化，歌曲数量庞大，写作题材特别广，吉他solo多，长，抓耳，有脍炙人口的流行歌曲广为传唱经久不衰，也有硬核前卫的摇滚作品拓宽艺术性的深度，是非常优秀的乐队。</p><p>至于很多人鄙视beyond的原因，基本上是无脑跟风黑，不愿意多了解热门歌曲以外的歌曲，觉得他们\"不摇滚\"。实际上，beyond\"摇滚\"的歌多了去了，并且你们口中不摇滚的歌曲，已经经过了时间的考验。《光辉岁月》《海阔天空》是华语流行音乐史上的顶级作品，激励影响了无数人，它的价值真不是你们推崇的某些独立小众乐队几首阴间摇滚能比的，搞得好像这种经典已经谁都能来踩一脚似的。\"摇滚\"的歌曲，《永远等待》《<a href=\"https://zhida.zhihu.com/search?content_id=299288710&amp;content_type=Answer&amp;match_order=1&amp;q=%E6%97%A7%E6%97%A5%E7%9A%84%E8%B6%B3%E8%BF%B9&amp;zhida_source=entity\">旧日的足迹</a>》《dead romance》《爸爸妈妈》《<a href=\"https://zhida.zhihu.com/search?content_id=299288710&amp;content_type=Answer&amp;match_order=1&amp;q=myth&amp;zhida_source=entity\">myth</a>》《醒你》《进化论》《雾》等等等等一大堆一大堆，肯定符合你们这些执着于分辨\"伪摇\"\"真摇\"的选手。</p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p>2024.4.13————————以下最新增加回答</p><p>是我在别的问题下写的，不能白写哈哈哈于是干脆复制来好了。</p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p>对Beyond的认识或许可以分四个阶段。</p><p>一：十多年前初听，<a href=\"https://zhida.zhihu.com/search?content_id=299288710&amp;content_type=Answer&amp;match_order=1&amp;q=%E6%B5%B7%E5%85%89&amp;zhida_source=entity\">海光</a>真大喜真好听，旋律好主题又正又有共鸣，经典，传奇，殿堂级乐队！</p><p>二：听更多国外摇滚乐队后，Beyond看来确实一般，枪花的<a href=\"https://zhida.zhihu.com/search?content_id=299288710&amp;content_type=Answer&amp;match_order=1&amp;q=%E5%8D%81%E4%B8%80%E6%9C%88%E9%9B%A8&amp;zhida_source=entity\">十一月雨</a>太牛逼了，飞艇的天梯太强了，Pink Floyd永远滴神，波西米亚<a href=\"https://zhida.zhihu.com/search?content_id=299288710&amp;content_type=Answer&amp;match_order=1&amp;q=%E7%8B%82%E6%83%B3%E6%9B%B2&amp;zhida_source=entity\">狂想曲</a>……<a href=\"https://zhida.zhihu.com/search?content_id=299288710&amp;content_type=Answer&amp;match_order=1&amp;q=%E6%8A%AB%E5%A4%B4%E5%A3%AB&amp;zhida_source=entity\">披头士</a>老鹰涅槃电台头等等等等开始报菜名</p><p>三：流行都是垃圾，没意思。我听<a href=\"https://zhida.zhihu.com/search?content_id=299288710&amp;content_type=Answer&amp;match_order=1&amp;q=%E5%89%8D%E5%8D%AB%E6%91%87%E6%BB%9A&amp;zhida_source=entity\">前卫摇滚</a>的，我听古典爵士的，beyond三子还不错，《再见理想》也很前卫，海光真大喜纯口水歌，流行歌真没意思。</p><p>四：Beyond确实是一支当之无愧的殿堂级乐队。</p><p>早期和三子所谓＂更摇滚＂的作品，的确非常优秀，《永远等待》（05 03live）《旧日的足迹》《Dead romance》《Myth》《雾》《孤单一吻》《进化论》…（早期歌曲最好找后期的现场版，可以弥补早期制作条件简陋的问题）大概可以轻易找出几十首足够前卫足够摇滚的高质量的歌曲。</p><p>所谓饱受诟病的＂伪摇滚＂歌曲，海光真大喜，其实它们完全经受住时间的考验，我必须承认自己有时听海阔天空会感动落泪，光辉岁月前奏一响（尤其91现场）还是鸡皮疙瘩，经典就是经典，才足以在时间这个最高筛选机制大浪淘沙后留下来，技术简单完全不代表写出来简单。</p><p>听歌何必抗拒本能呢，那是迷失初衷的表现，伟大的词曲，编曲，本身就有长久的生命力。我喜欢用生命力这个词来形容beyond，什么款式的歌都有，总有一款你喜欢。一个最常见的误区就是觉得beyond歌很简单，因为你要真的去写歌就知道了，写一首流传三十年的歌曲是什么难度，跟歌曲技术简单与否毫无关系，披头士简单的歌更多。何况beyond太多经久不衰的歌曲。</p><p>即使是跟国外乐队对比，也并非不能比。</p><p>就比如和枪花对比，我当然非常喜欢十一月雨，Estranged，Civil war这几首神作，但我仍然爱听《永远等待》05live，因为我没有找到任何代餐，客观上曲子的高度也非常高，我仍然喜欢海阔天空96版solo，《旧日的足迹》双吉他，《早班火车》，《Myth》《Dead romance》，《<a href=\"https://zhida.zhihu.com/search?content_id=299288710&amp;content_type=Answer&amp;match_order=1&amp;q=%E5%8D%88%E5%A4%9C%E8%BF%B7%E5%A2%99&amp;zhida_source=entity\">午夜迷墙</a>》《长城》《狂人山庄》，像这样的高质量歌曲可以很随便举出大几十首。Beyond的这些歌曲对比起来并不是一种被碾压的关系，而是它们也有充分的自己的特色和亮点。独创性很高，即使有一些模仿的影子，你也无法找到什么真正意义上的替代品。</p><p><br data-cke-filler=\"true\"></p><p>总结来说，我认为当乐队的水平到一定层次，互相之间都没有代餐，都有自己强烈特色，进行比较就失去了意义。就像枪花的长处beyond不一定有，反之亦然。我听披头士 PF 飞艇 KC也不影响我听别的，Beyond的某些特色国外乐队确实不太找得到，比如题材上非常＂多管闲事＂的好习惯，比如有些歌曲给人很多很＂正＂的感觉，比如大量且优质的吉他solo，比如黄家驹的嗓音，比如beyond式怨曲风格等，细挖之下这个乐队有太多东西，代表作又多，故事也多，甚至给人的影响还都很正能量，很浩然正气，在世界上也是比较独一份的存在，这样一个乐队，确实很难不喜欢。</p><p>我不打算再去闲得蛋疼计较歌曲风格，歌曲技术复杂与否，结构复杂与否，我更加关注歌曲的亮点在哪，巧思，制作等等，所谓比较口水简单的歌，可能有些段落旋律确实写得好，所谓非常摇滚的歌，可能依然有一些硬伤。用本能去听歌，而乐理知识只是表达观点的工具而已，你听歌应该是自己生理上喜欢，而不是别人告诉你这歌牛逼因此你才喜欢。所以我也希望变得更加包容，即使对于并不偏爱的某些风格也会听到它一些亮点，客观上会尊重任何真正用心的创作。</p><p><br data-cke-filler=\"true\"></p><p>以上仅代表我个人的变化过程，其实就是看山是山，看山不是山，看山还是山三个阶段，不过幸运的是我个人二阶段时间非常短暂，也就一两个月，随后很快就进入了包容一切的听歌状态。</p><p>图像小部件</p>',	1729244198,	1729244285,	0,	'http://127.0.0.1:2222/ckfinder/files/%E7%A6%85/u%3D1361346708%2C976085348%26fm%3D253%26fmt%3Dauto%26app%3D138%26f%3DJPEG.webp',	0),
(2,	5,	'1',	20,	'hepm',	'运维小白，想问问公司一般需要几个k8s集群?',	'运维小白，想问问公司一般需要几个k8s集群?',	'default text',	'<figure class=\"image ck-widget ck-widget_selected ck-widget_with-resizer\" contenteditable=\"false\"><img src=\"http://127.0.0.1:2222/ckfinder/files/%E7%A6%85/u%3D3020752157%2C459889753%26fm%3D253%26fmt%3Dauto%26app%3D138%26f%3DJPEG.webp\"><div class=\"ck ck-reset_all ck-widget__type-around\"><div class=\"ck ck-widget__type-around__button ck-widget__type-around__button_before\" title=\"在前面插入段落\"><svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 10 8\"><path d=\"M9.055.263v3.972h-6.77M1 4.216l2-2.038m-2 2 2 2.038\"></path></svg></div><div class=\"ck ck-widget__type-around__button ck-widget__type-around__button_after\" title=\"在后面插入段落\"><svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 10 8\"><path d=\"M9.055.263v3.972h-6.77M1 4.216l2-2.038m-2 2 2 2.038\"></path></svg></div><div class=\"ck ck-widget__type-around__fake-caret\"></div></div><div class=\"ck ck-reset_all ck-widget__resizer\" style=\"height:889px;left:0px;top:0px;width:500px;\"><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-left\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left\"></div><div class=\"ck ck-size-view\" style=\"display: none;\"></div></div></figure><p>看钱。</p><p>按业务来算。</p><p>有钱的时候，给研发搭一套，最初级的dev环境来一套，再往上一级的环境再来一套，最后到生产了再来一套，如果生产前想再加一套，这就是5套。</p><p>一个业务，就是5套集群。</p><p>集群全买各种云的，什么aks tke eks blablabla。 周边服务什么数据库日志乱七八糟的一律买saas。</p><p>买多久，当然是三年起步包年，从不关机。</p><p>各家供应商售前小妹的微信加起来，和老板一起看看，研究下谁家最合适，谁家给的售后支持资源最多<strong>(这个很关键，有时候不是你花了钱就会有让你满意的售后的，真生产实践你会发现各家云产品除了虚拟机和数据库，其他的都或多或少会出问题)。</strong></p><p>没钱的时候。</p><p>测试一套，生产一套。</p><p>多个业务共用测试集群。</p><p>测试集群全部用公司机房里的机器搞虚拟机出来自建，就算买云上的集群也是定时开关机。</p><p>当然什么数据库elk各种乱七八糟周边服务中间件之类的也全部自建。</p><p><br><br>作者：布要冲他<br>链接：https://www.zhihu.com/question/1556366121/answer/13627765172<br>来源：知乎<br>著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。</p>',	1730119641,	1730201448,	1,	'http://127.0.0.1:2222/ckfinder/files/%E7%A6%85/u%3D2907497531%2C599108153%26fm%3D253%26fmt%3Dauto%26app%3D138%26f%3DJPEG.webp',	0),
(3,	6,	'1',	20,	'hepm',	'运维小白，想问问公司一般需要几个k8s集群?',	'系统架构设计师可能考的UML知识',	'default text',	'<p>看钱。</p><p>按业务来算。</p><p>有钱的时候，给研发搭一套，最初级的dev环境来一套，再往上一级的环境再来一套，最后到生产了再来一套，如果生产前想再加一套，这就是5套。</p><p>一个业务，就是5套集群。</p><p>集群全买各种云的，什么aks tke eks blablabla。 周边服务什么数据库日志乱七八糟的一律买saas。</p><p>买多久，当然是三年起步包年，从不关机。</p><p>各家供应商售前小妹的微信加起来，和老板一起看看，研究下谁家最合适，谁家给的售后支持资源最多<strong>(这个很关键，有时候不是你花了钱就会有让你满意的售后的，真生产实践你会发现各家云产品除了虚拟机和数据库，其他的都或多或少会出问题)。</strong></p><p>没钱的时候。</p><p>测试一套，生产一套。</p><p>多个业务共用测试集群。</p><p>测试集群全部用公司机房里的机器搞虚拟机出来自建，就算买云上的集群也是定时开关机。</p><p>当然什么数据库elk各种乱七八糟周边服务中间件之类的也全部自建。</p><p><br><br>作者：布要冲他<br>链接：https://www.zhihu.com/question/1556366121/answer/13627765172<br>来源：知乎<br>著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。</p>',	1730119727,	0,	1,	'http://127.0.0.1:2222/ckfinder/files/%E4%B8%93%E8%BE%91/%E4%B8%8D%E6%AD%BB%E4%B9%8B%E8%BA%AB.jpg',	-1),
(4,	6,	'1',	20,	'',	'我的网页admin.php显示PHP版本过低，我在宝塔里下载并且换到了PHP7.2,为什么还是不行?',	'系统架构设计师可能考的UML知识',	'我的网页admin.php显示PHP版本过低，我在宝塔里下载并且换到了PHP7.2,为什么还是不行?',	'<p style=\"margin-left:0px;\">痛苦，干了8年程序了，做的全是垃圾游戏。现在的大环境加上自己的学历不太行，在我这个地方也基本上到头了。</p><p style=\"margin-left:0px;\">为了养家糊口，为了薪水，已经做起了low到地心的一刀999游戏。感觉自己离梦想越来越远</p>',	1730210094,	0,	2,	'http://127.0.0.1:2222/ckfinder/files/%E7%A6%85/16pic_2006245_b.jpg',	0);

DROP TABLE IF EXISTS `cms_article_category`;
CREATE TABLE `cms_article_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `parentid` int(10) unsigned NOT NULL DEFAULT 0,
  `description` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(10) DEFAULT 0 COMMENT '状态|0:正常,-1:删除',
  `addtime` int(10) unsigned DEFAULT 0 COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci COMMENT='文章分类';

INSERT INTO `cms_article_category` (`id`, `name`, `parentid`, `description`, `status`, `addtime`) VALUES
(1,	'禅道',	1,	'禅道',	-1,	0),
(2,	'神之宇宙',	0,	'神之宇宙',	0,	0),
(5,	'神1:)))',	2,	'神1',	0,	0),
(6,	'神2',	6,	'神2',	0,	0);

DROP TABLE IF EXISTS `cms_attach`;
CREATE TABLE `cms_attach` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cate_id` int(11) NOT NULL DEFAULT 0 COMMENT '所属分类',
  `tag_ids` varchar(255) NOT NULL DEFAULT '0' COMMENT '标签id',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '附件名称',
  `file` varchar(255) NOT NULL DEFAULT '' COMMENT '文件路径',
  `width` int(10) NOT NULL DEFAULT 0 COMMENT '宽度',
  `height` int(10) NOT NULL DEFAULT 0 COMMENT '高度',
  `ext` varchar(255) NOT NULL DEFAULT '' COMMENT '文件类型',
  `size` varchar(255) NOT NULL DEFAULT '' COMMENT '文件大小',
  `addtime` int(10) NOT NULL DEFAULT 0 COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci COMMENT='附件';

INSERT INTO `cms_attach` (`id`, `cate_id`, `tag_ids`, `name`, `file`, `width`, `height`, `ext`, `size`, `addtime`) VALUES
(64,	0,	'0',	'喜欢你2.png',	'uploads/20180513/0327ec84ce95520c1b0e5e00b4e5c148.png',	1785,	2525,	'png',	'195864',	1526179030),
(65,	0,	'0',	'遥望1.png',	'uploads/20180513/a1f67ce4e19332bae0ff5b038866e82d.png',	2380,	3366,	'png',	'141074',	1526179030),
(66,	0,	'0',	'遥望1.png',	'uploads/20180513/05e6fe817362a741e6ab46e765a89b9c.png',	2380,	3366,	'png',	'141074',	1526179155),
(67,	0,	'0',	'喜欢你2.png',	'uploads/20180513/7da14e0c014683a3529d383bc00a9991.png',	1785,	2525,	'png',	'195864',	1526179155),
(68,	0,	'流行, 民谣',	'遥望1.png',	'uploads/20180513/2e59eb8e987e55cdc1da09a0e0a33c3c.png',	2380,	3366,	'png',	'141074',	1526180515),
(69,	0,	'1,3',	'遥望1.png',	'uploads/20180513/8f54a59206f9c1673ad37781ebab7fa2.png',	2380,	3366,	'png',	'141074',	1526180823),
(70,	0,	'1,2,3',	'喜欢你.png',	'uploads/20180515/579a0bec3c606beff4ae70e118b2cf7b.png',	1785,	2525,	'png',	'209770',	1526402533),
(71,	0,	'1,2,3',	'喜欢你2.png',	'uploads/20180515/2122f5b9f5ddb4d8e4ddd44cb7473c7b.png',	1785,	2525,	'png',	'195864',	1526402543),
(72,	0,	'1,2,3',	'遥望1.png',	'uploads/20180515/aa88133707ad9b068e632c2ffe97df0b.png',	2380,	3366,	'png',	'141074',	1526402543),
(73,	0,	'1,2,3',	'喜欢你.png',	'uploads/20180515/df833b1e6f42d535501a0ff0b6a08994.png',	1785,	2525,	'png',	'209770',	1526402543),
(74,	0,	'0',	'u=32528942,2886003757&fm=253&fmt=auto&app=138&f=JPEG.webp',	'uploads/undefined/20241018/65dd030653b7fbd39a7143c804023af2.webp',	300,	300,	'webp',	'8996',	1729242667),
(75,	0,	'0',	'16pic_2006245_b.jpg',	'uploads/20241018/15051ade3d068107fb6887eec139bd2d.jpg',	1024,	951,	'jpg',	'144225',	1729243004),
(76,	0,	'0',	'16pic_2006245_b.jpg',	'uploads/20241018/c7fd040dd03cb0e9e2b3a1c370095006.jpg',	1024,	951,	'jpg',	'144225',	1729243313),
(77,	0,	'0',	'16pic_2006245_b.jpg',	'uploads/20241018/11a6c15124b6f5042c6f67187e02736d.jpg',	1024,	951,	'jpg',	'144225',	1729243649),
(78,	0,	'0',	'16pic_2006245_b.jpg',	'uploads/20241018/4d5ea99f7c45c8f584e9a3f4df0df45c.jpg',	1024,	951,	'jpg',	'144225',	1729243721),
(79,	0,	'0',	'xm2024.jpg',	'uploads/20241018/010965ee42c364bd1c6eb11df1639fbf.jpg',	2424,	3196,	'jpg',	'894681',	1729243725),
(80,	0,	'0',	'16pic_2006245_b.jpg',	'uploads/20241018/61f6b3562a3d0d5f874f172eef128097.jpg',	1024,	951,	'jpg',	'144225',	1729243778),
(81,	0,	'0',	'16pic_2006245_b.jpg',	'uploads/20241018/f68deecbb8faedd91c5df76b92163d55.jpg',	1024,	951,	'jpg',	'144225',	1729244134),
(82,	0,	'0',	'16pic_2006245_b.jpg',	'uploads/20241018/acfad2350ebbfe1c2e6d760f93056254.jpg',	1024,	951,	'jpg',	'144225',	1729244142);

DROP TABLE IF EXISTS `cms_attach_cate`;
CREATE TABLE `cms_attach_cate` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL DEFAULT 0 COMMENT '父类id',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '附件分类名称',
  `addtime` int(10) NOT NULL DEFAULT 0 COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci COMMENT='附件分类';

INSERT INTO `cms_attach_cate` (`id`, `pid`, `name`, `addtime`) VALUES
(1,	0,	'摇滚',	1525878527),
(2,	0,	'流行',	1525878531),
(3,	0,	' 民谣',	1525878544);

DROP TABLE IF EXISTS `cms_tag`;
CREATE TABLE `cms_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_uca1400_ai_ci NOT NULL DEFAULT '' COMMENT '标签名称',
  `addtime` int(10) NOT NULL DEFAULT 0 COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='文章标签';

INSERT INTO `cms_tag` (`id`, `name`, `addtime`) VALUES
(1,	'神',	1729242937);

-- 2024-11-02 01:13:26
