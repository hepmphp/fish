-- Adminer 4.8.1 MySQL 5.7.23-log dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `fish_admin`;
CREATE DATABASE `fish_admin` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `fish_admin`;

DROP TABLE IF EXISTS `cms_ad`;
CREATE TABLE `cms_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '广告id',
  `block_id` int(11) NOT NULL DEFAULT '0' COMMENT '广告位置',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '广告标题',
  `pic_url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片链接',
  `link_address` varchar(512) NOT NULL DEFAULT '' COMMENT '广告地址',
  `addtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `start_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  `end_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  `listorder` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态|0:显示,1:不显示',
  `is_mobile` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否是m版',
  PRIMARY KEY (`id`),
  KEY `block_id` (`id`,`block_id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='平台广告';

TRUNCATE `cms_ad`;

DROP TABLE IF EXISTS `cms_ad_block`;
CREATE TABLE `cms_ad_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '区块名称',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='区块名称';

TRUNCATE `cms_ad_block`;

DROP TABLE IF EXISTS `cms_article`;
CREATE TABLE `cms_article` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类',
  `tag_ids` varchar(255) NOT NULL DEFAULT '0' COMMENT '标签id  ',
  `admin_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员id',
  `admin` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键词',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `content` longtext NOT NULL COMMENT '内容',
  `addtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `is_top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否置顶 0普通 1置顶 2头条',
  `list_image_url` varchar(255) NOT NULL DEFAULT '' COMMENT '列表显示图片',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态 0正常 -1 删除',
  PRIMARY KEY (`id`),
  KEY `cate_id` (`id`,`cate_id`,`is_top`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='平台文章';

TRUNCATE `cms_article`;
INSERT INTO `cms_article` (`id`, `cate_id`, `tag_ids`, `admin_id`, `admin`, `title`, `keywords`, `description`, `content`, `addtime`, `update_time`, `is_top`, `list_image_url`, `status`) VALUES
(1,	0,	'1',	20,	'hepm',	'对话',	'深知禅道',	'default text',	'<p>⁠⁠⁠⁠⁠⁠⁠<span class=\"image-inline ck-widget ck-widget_with-resizer\" contenteditable=\"false\"><img src=\"http://127.0.0.1:2222/ckfinder/files/%E7%A6%85/u%3D32528942%2C2886003757%26fm%3D253%26fmt%3Dauto%26app%3D138%26f%3DJPEG.webp\"><div class=\"ck ck-reset_all ck-widget__resizer\" style=\"display: none;\"><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-left\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left\"></div><div class=\"ck ck-size-view\" style=\"display: none;\"></div></div></span></p><p><br data-cke-filler=\"true\"></p><p><span class=\"image-inline ck-widget ck-widget_with-resizer\" contenteditable=\"false\"><img src=\"http://127.0.0.1:2222/ckfinder/files/%E7%A6%85/xm2024.jpg\"><div class=\"ck ck-reset_all ck-widget__resizer\" style=\"display: none;\"><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-left\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left\"></div><div class=\"ck ck-size-view\" style=\"display: none;\"></div></div></span></p><p><br data-cke-filler=\"true\"></p><p><span class=\"image-inline ck-widget ck-widget_with-resizer\" contenteditable=\"false\"><img src=\"http://127.0.0.1:2222/ckfinder/files/%E4%B8%93%E8%BE%91/beyond.jpg\"><div class=\"ck ck-reset_all ck-widget__resizer\" style=\"display: none;\"><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-left\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left\"></div><div class=\"ck ck-size-view\" style=\"display: none;\"></div></div></span></p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p>:))))((((:</p><p><br data-cke-filler=\"true\"></p><p>作者：风筝<br>链接：https://www.zhihu.com/question/421478442/answer/1480684031<br>来源：知乎<br>著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。<br><br><br><span class=\"image-inline ck-widget ck-widget_with-resizer\" contenteditable=\"false\"><img src=\"http://127.0.0.1:2222/ckfinder/files/%E7%A6%85/u%3D1361346708%2C976085348%26fm%3D253%26fmt%3Dauto%26app%3D138%26f%3DJPEG.webp\"><div class=\"ck ck-reset_all ck-widget__resizer\" style=\"display: none;\"><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-left\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left\"></div><div class=\"ck ck-size-view\" style=\"display: none;\"></div></div></span></p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p><br><br><br><br><br><br><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p><mark class=\"marker-yellow\">这是一个正常的过程，比如以前觉得beyond是神，听了更多经典作品后觉得beyond很不错，但没有到神的地步，这也很合理。</mark></p><p><span style=\"color:hsl(240,75%,60%);\">但如果你听了一圈外国乐队后觉得beyond是个垃圾，或者觉得在中国摇滚里面beyond是垃圾，那我认为你听得还不够多</span>，也不能客观评价作品好坏。喜不喜欢beyond是主观问题，不喜欢没人能妨碍你，但无法从客观上找到依据来说明beyond水准的话，将没有说服力。</p><p>我八年前觉得beyond是神，后来学了木吉他，又受枪花影响拿起了电吉他，入坑欧美摇滚大坑，然后受X Japan影响在音乐道路上坚持下去，去钻研音乐制作方面的东西。当我回过头来审视beyond的时候，我仍然认为他们很牛逼，是对作品的客观评价，说是中国摇滚乐队天花板不为过。beyond歌曲旋律性普遍非常强，曲风特别多元化，歌曲数量庞大，写作题材特别广，吉他solo多，长，抓耳，有脍炙人口的流行歌曲广为传唱经久不衰，也有硬核前卫的摇滚作品拓宽艺术性的深度，是非常优秀的乐队。</p><p>至于很多人鄙视beyond的原因，基本上是无脑跟风黑，不愿意多了解热门歌曲以外的歌曲，觉得他们\"不摇滚\"。实际上，beyond\"摇滚\"的歌多了去了，并且你们口中不摇滚的歌曲，已经经过了时间的考验。《光辉岁月》《海阔天空》是华语流行音乐史上的顶级作品，激励影响了无数人，它的价值真不是你们推崇的某些独立小众乐队几首阴间摇滚能比的，搞得好像这种经典已经谁都能来踩一脚似的。\"摇滚\"的歌曲，《永远等待》《<a href=\"https://zhida.zhihu.com/search?content_id=299288710&amp;content_type=Answer&amp;match_order=1&amp;q=%E6%97%A7%E6%97%A5%E7%9A%84%E8%B6%B3%E8%BF%B9&amp;zhida_source=entity\">旧日的足迹</a>》《dead romance》《爸爸妈妈》《<a href=\"https://zhida.zhihu.com/search?content_id=299288710&amp;content_type=Answer&amp;match_order=1&amp;q=myth&amp;zhida_source=entity\">myth</a>》《醒你》《进化论》《雾》等等等等一大堆一大堆，肯定符合你们这些执着于分辨\"伪摇\"\"真摇\"的选手。</p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p>2024.4.13————————以下最新增加回答</p><p>是我在别的问题下写的，不能白写哈哈哈于是干脆复制来好了。</p><p><br data-cke-filler=\"true\"></p><p><br data-cke-filler=\"true\"></p><p>对Beyond的认识或许可以分四个阶段。</p><p>一：十多年前初听，<a href=\"https://zhida.zhihu.com/search?content_id=299288710&amp;content_type=Answer&amp;match_order=1&amp;q=%E6%B5%B7%E5%85%89&amp;zhida_source=entity\">海光</a>真大喜真好听，旋律好主题又正又有共鸣，经典，传奇，殿堂级乐队！</p><p>二：听更多国外摇滚乐队后，Beyond看来确实一般，枪花的<a href=\"https://zhida.zhihu.com/search?content_id=299288710&amp;content_type=Answer&amp;match_order=1&amp;q=%E5%8D%81%E4%B8%80%E6%9C%88%E9%9B%A8&amp;zhida_source=entity\">十一月雨</a>太牛逼了，飞艇的天梯太强了，Pink Floyd永远滴神，波西米亚<a href=\"https://zhida.zhihu.com/search?content_id=299288710&amp;content_type=Answer&amp;match_order=1&amp;q=%E7%8B%82%E6%83%B3%E6%9B%B2&amp;zhida_source=entity\">狂想曲</a>……<a href=\"https://zhida.zhihu.com/search?content_id=299288710&amp;content_type=Answer&amp;match_order=1&amp;q=%E6%8A%AB%E5%A4%B4%E5%A3%AB&amp;zhida_source=entity\">披头士</a>老鹰涅槃电台头等等等等开始报菜名</p><p>三：流行都是垃圾，没意思。我听<a href=\"https://zhida.zhihu.com/search?content_id=299288710&amp;content_type=Answer&amp;match_order=1&amp;q=%E5%89%8D%E5%8D%AB%E6%91%87%E6%BB%9A&amp;zhida_source=entity\">前卫摇滚</a>的，我听古典爵士的，beyond三子还不错，《再见理想》也很前卫，海光真大喜纯口水歌，流行歌真没意思。</p><p>四：Beyond确实是一支当之无愧的殿堂级乐队。</p><p>早期和三子所谓＂更摇滚＂的作品，的确非常优秀，《永远等待》（05 03live）《旧日的足迹》《Dead romance》《Myth》《雾》《孤单一吻》《进化论》…（早期歌曲最好找后期的现场版，可以弥补早期制作条件简陋的问题）大概可以轻易找出几十首足够前卫足够摇滚的高质量的歌曲。</p><p>所谓饱受诟病的＂伪摇滚＂歌曲，海光真大喜，其实它们完全经受住时间的考验，我必须承认自己有时听海阔天空会感动落泪，光辉岁月前奏一响（尤其91现场）还是鸡皮疙瘩，经典就是经典，才足以在时间这个最高筛选机制大浪淘沙后留下来，技术简单完全不代表写出来简单。</p><p>听歌何必抗拒本能呢，那是迷失初衷的表现，伟大的词曲，编曲，本身就有长久的生命力。我喜欢用生命力这个词来形容beyond，什么款式的歌都有，总有一款你喜欢。一个最常见的误区就是觉得beyond歌很简单，因为你要真的去写歌就知道了，写一首流传三十年的歌曲是什么难度，跟歌曲技术简单与否毫无关系，披头士简单的歌更多。何况beyond太多经久不衰的歌曲。</p><p>即使是跟国外乐队对比，也并非不能比。</p><p>就比如和枪花对比，我当然非常喜欢十一月雨，Estranged，Civil war这几首神作，但我仍然爱听《永远等待》05live，因为我没有找到任何代餐，客观上曲子的高度也非常高，我仍然喜欢海阔天空96版solo，《旧日的足迹》双吉他，《早班火车》，《Myth》《Dead romance》，《<a href=\"https://zhida.zhihu.com/search?content_id=299288710&amp;content_type=Answer&amp;match_order=1&amp;q=%E5%8D%88%E5%A4%9C%E8%BF%B7%E5%A2%99&amp;zhida_source=entity\">午夜迷墙</a>》《长城》《狂人山庄》，像这样的高质量歌曲可以很随便举出大几十首。Beyond的这些歌曲对比起来并不是一种被碾压的关系，而是它们也有充分的自己的特色和亮点。独创性很高，即使有一些模仿的影子，你也无法找到什么真正意义上的替代品。</p><p><br data-cke-filler=\"true\"></p><p>总结来说，我认为当乐队的水平到一定层次，互相之间都没有代餐，都有自己强烈特色，进行比较就失去了意义。就像枪花的长处beyond不一定有，反之亦然。我听披头士 PF 飞艇 KC也不影响我听别的，Beyond的某些特色国外乐队确实不太找得到，比如题材上非常＂多管闲事＂的好习惯，比如有些歌曲给人很多很＂正＂的感觉，比如大量且优质的吉他solo，比如黄家驹的嗓音，比如beyond式怨曲风格等，细挖之下这个乐队有太多东西，代表作又多，故事也多，甚至给人的影响还都很正能量，很浩然正气，在世界上也是比较独一份的存在，这样一个乐队，确实很难不喜欢。</p><p>我不打算再去闲得蛋疼计较歌曲风格，歌曲技术复杂与否，结构复杂与否，我更加关注歌曲的亮点在哪，巧思，制作等等，所谓比较口水简单的歌，可能有些段落旋律确实写得好，所谓非常摇滚的歌，可能依然有一些硬伤。用本能去听歌，而乐理知识只是表达观点的工具而已，你听歌应该是自己生理上喜欢，而不是别人告诉你这歌牛逼因此你才喜欢。所以我也希望变得更加包容，即使对于并不偏爱的某些风格也会听到它一些亮点，客观上会尊重任何真正用心的创作。</p><p><br data-cke-filler=\"true\"></p><p>以上仅代表我个人的变化过程，其实就是看山是山，看山不是山，看山还是山三个阶段，不过幸运的是我个人二阶段时间非常短暂，也就一两个月，随后很快就进入了包容一切的听歌状态。</p><p>图像小部件</p>',	1729244198,	1729244285,	0,	'http://127.0.0.1:2222/ckfinder/files/%E7%A6%85/u%3D1361346708%2C976085348%26fm%3D253%26fmt%3Dauto%26app%3D138%26f%3DJPEG.webp',	0),
(2,	5,	'1',	20,	'hepm',	'运维小白，想问问公司一般需要几个k8s集群?',	'运维小白，想问问公司一般需要几个k8s集群?',	'default text',	'<figure class=\"image ck-widget ck-widget_selected ck-widget_with-resizer\" contenteditable=\"false\"><img src=\"http://127.0.0.1:2222/ckfinder/files/%E7%A6%85/u%3D3020752157%2C459889753%26fm%3D253%26fmt%3Dauto%26app%3D138%26f%3DJPEG.webp\"><div class=\"ck ck-reset_all ck-widget__type-around\"><div class=\"ck ck-widget__type-around__button ck-widget__type-around__button_before\" title=\"在前面插入段落\"><svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 10 8\"><path d=\"M9.055.263v3.972h-6.77M1 4.216l2-2.038m-2 2 2 2.038\"></path></svg></div><div class=\"ck ck-widget__type-around__button ck-widget__type-around__button_after\" title=\"在后面插入段落\"><svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 10 8\"><path d=\"M9.055.263v3.972h-6.77M1 4.216l2-2.038m-2 2 2 2.038\"></path></svg></div><div class=\"ck ck-widget__type-around__fake-caret\"></div></div><div class=\"ck ck-reset_all ck-widget__resizer\" style=\"height:889px;left:0px;top:0px;width:500px;\"><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-left\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left\"></div><div class=\"ck ck-size-view\" style=\"display: none;\"></div></div></figure><p>看钱。</p><p>按业务来算。</p><p>有钱的时候，给研发搭一套，最初级的dev环境来一套，再往上一级的环境再来一套，最后到生产了再来一套，如果生产前想再加一套，这就是5套。</p><p>一个业务，就是5套集群。</p><p>集群全买各种云的，什么aks tke eks blablabla。 周边服务什么数据库日志乱七八糟的一律买saas。</p><p>买多久，当然是三年起步包年，从不关机。</p><p>各家供应商售前小妹的微信加起来，和老板一起看看，研究下谁家最合适，谁家给的售后支持资源最多<strong>(这个很关键，有时候不是你花了钱就会有让你满意的售后的，真生产实践你会发现各家云产品除了虚拟机和数据库，其他的都或多或少会出问题)。</strong></p><p>没钱的时候。</p><p>测试一套，生产一套。</p><p>多个业务共用测试集群。</p><p>测试集群全部用公司机房里的机器搞虚拟机出来自建，就算买云上的集群也是定时开关机。</p><p>当然什么数据库elk各种乱七八糟周边服务中间件之类的也全部自建。</p><p><br><br>作者：布要冲他<br>链接：https://www.zhihu.com/question/1556366121/answer/13627765172<br>来源：知乎<br>著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。</p>',	1730119641,	1730201448,	1,	'http://127.0.0.1:2222/ckfinder/files/%E7%A6%85/u%3D2907497531%2C599108153%26fm%3D253%26fmt%3Dauto%26app%3D138%26f%3DJPEG.webp',	0),
(3,	6,	'1',	20,	'hepm',	'运维小白，想问问公司一般需要几个k8s集群?',	'系统架构设计师可能考的UML知识',	'default text',	'<p>看钱。</p><p>按业务来算。</p><p>有钱的时候，给研发搭一套，最初级的dev环境来一套，再往上一级的环境再来一套，最后到生产了再来一套，如果生产前想再加一套，这就是5套。</p><p>一个业务，就是5套集群。</p><p>集群全买各种云的，什么aks tke eks blablabla。 周边服务什么数据库日志乱七八糟的一律买saas。</p><p>买多久，当然是三年起步包年，从不关机。</p><p>各家供应商售前小妹的微信加起来，和老板一起看看，研究下谁家最合适，谁家给的售后支持资源最多<strong>(这个很关键，有时候不是你花了钱就会有让你满意的售后的，真生产实践你会发现各家云产品除了虚拟机和数据库，其他的都或多或少会出问题)。</strong></p><p>没钱的时候。</p><p>测试一套，生产一套。</p><p>多个业务共用测试集群。</p><p>测试集群全部用公司机房里的机器搞虚拟机出来自建，就算买云上的集群也是定时开关机。</p><p>当然什么数据库elk各种乱七八糟周边服务中间件之类的也全部自建。</p><p><br><br>作者：布要冲他<br>链接：https://www.zhihu.com/question/1556366121/answer/13627765172<br>来源：知乎<br>著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。</p>',	1730119727,	0,	1,	'http://127.0.0.1:2222/ckfinder/files/%E4%B8%93%E8%BE%91/%E4%B8%8D%E6%AD%BB%E4%B9%8B%E8%BA%AB.jpg',	-1),
(4,	6,	'1',	20,	'',	'我的网页admin.php显示PHP版本过低，我在宝塔里下载并且换到了PHP7.2,为什么还是不行?',	'系统架构设计师可能考的UML知识',	'我的网页admin.php显示PHP版本过低，我在宝塔里下载并且换到了PHP7.2,为什么还是不行?',	'<p style=\"margin-left:0px;\">痛苦，干了8年程序了，做的全是垃圾游戏。现在的大环境加上自己的学历不太行，在我这个地方也基本上到头了。</p><p style=\"margin-left:0px;\">为了养家糊口，为了薪水，已经做起了low到地心的一刀999游戏。感觉自己离梦想越来越远</p>',	1730210094,	0,	2,	'http://127.0.0.1:2222/ckfinder/files/%E7%A6%85/16pic_2006245_b.jpg',	0);

DROP TABLE IF EXISTS `cms_article_category`;
CREATE TABLE `cms_article_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0',
  `description` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(10) DEFAULT '0' COMMENT '状态|0:正常,-1:删除',
  `addtime` int(10) unsigned DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章分类';

TRUNCATE `cms_article_category`;
INSERT INTO `cms_article_category` (`id`, `name`, `parentid`, `description`, `status`, `addtime`) VALUES
(1,	'禅道',	1,	'禅道',	-1,	0),
(2,	'神之宇宙',	0,	'神之宇宙',	0,	0),
(5,	'神1:)))',	2,	'神1',	0,	0),
(6,	'神2',	6,	'神2',	0,	0);

DROP TABLE IF EXISTS `cms_attach`;
CREATE TABLE `cms_attach` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cate_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属分类',
  `tag_ids` varchar(255) NOT NULL DEFAULT '0' COMMENT '标签id',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '附件名称',
  `file` varchar(255) NOT NULL DEFAULT '' COMMENT '文件路径',
  `width` int(10) NOT NULL DEFAULT '0' COMMENT '宽度',
  `height` int(10) NOT NULL DEFAULT '0' COMMENT '高度',
  `ext` varchar(255) NOT NULL DEFAULT '' COMMENT '文件类型',
  `size` varchar(255) NOT NULL DEFAULT '' COMMENT '文件大小',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='附件';

TRUNCATE `cms_attach`;
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
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '父类id',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '附件分类名称',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='附件分类';

TRUNCATE `cms_attach_cate`;
INSERT INTO `cms_attach_cate` (`id`, `pid`, `name`, `addtime`) VALUES
(1,	0,	'摇滚',	1525878527),
(2,	0,	'流行',	1525878531),
(3,	0,	' 民谣',	1525878544);

DROP TABLE IF EXISTS `cms_tag`;
CREATE TABLE `cms_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '标签名称',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='文章标签';

TRUNCATE `cms_tag`;
INSERT INTO `cms_tag` (`id`, `name`, `addtime`) VALUES
(1,	'神',	1729242937);

DROP TABLE IF EXISTS `ga_admin_group`;
CREATE TABLE `ga_admin_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '分组名称',
  `comment` varchar(255) NOT NULL DEFAULT '' COMMENT '分组说明',
  `mids` text COMMENT '用户组权限id',
  `allow_mutil_login` tinyint(4) NOT NULL DEFAULT '1' COMMENT '允许多人登录 0否 1是',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户分组';

TRUNCATE `ga_admin_group`;
INSERT INTO `ga_admin_group` (`id`, `name`, `comment`, `mids`, `allow_mutil_login`, `addtime`) VALUES
(1,	'超级管理员',	'超级管理员',	'29,35,46,66,65',	1,	0),
(2,	'运营人员(查询)',	'运营人员(查询)',	'1,5,6,7,8,9,10,11',	1,	1510747472),
(3,	'运营人员(查询+充值)',	'运营人员(查询+充值)',	'7,11,10,9,8',	1,	1510748173),
(4,	'运营人员(查询+充值)',	'运营人员(查询+充值)',	'7,11,10,9,8,1,6,5,4,3,2',	1,	1510748299),
(5,	'查询+游戏服',	'查询+游戏服',	'7,11,10,9,8,1,6,5,4,3,2',	1,	1510748371),
(6,	'外联11',	'外联11',	'1,4,5,6,7,8,9,10,11,13,14,19,20',	1,	1510748387),
(7,	'分组测试',	'123456',	'',	1,	1511182035),
(8,	'sogou',	'sogou',	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,25,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,110,111',	1,	1512972626),
(9,	'客服',	'客服',	'21,23,49,50,54,55,57,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,126,127,128,129,130,131,136,138,139,140,141,143',	1,	1513301166),
(10,	'测试分组',	'分组测试',	'init',	1,	0),
(11,	'外联',	'外联',	'init',	1,	0),
(12,	'测试分组',	'分组测试测试',	'init',	1,	0),
(13,	'测试分组1',	'分组测试的',	'24,73,80,81,82,83,84,85,86,87,88,89,90,91,92,102,103,104,105,106,107,108,109,112,113,114,115,118,119,120,121,122,134,135,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,182,183,184,185,203,204,205,206,207',	1,	0),
(14,	'神',	'鱼神',	'1,2,3,4,5,6,7,8,9,10,11',	1,	1729606608);

DROP TABLE IF EXISTS `ga_admin_log`;
CREATE TABLE `ga_admin_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户id',
  `platform_id` int(10) NOT NULL DEFAULT '0' COMMENT '平台id',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `ip` varchar(16) NOT NULL DEFAULT '' COMMENT 'ip地址',
  `m` varchar(50) NOT NULL DEFAULT '' COMMENT '控制器',
  `a` varchar(50) NOT NULL DEFAULT '' COMMENT '方法',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `log_type` tinyint(3) NOT NULL DEFAULT '1' COMMENT '日志类型 1添加2修改3删除4登录成功5登录失败',
  `info` varchar(255) NOT NULL DEFAULT '' COMMENT '操作说明',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '登录状态 1成功0失败',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员操作日志';

TRUNCATE `ga_admin_log`;
INSERT INTO `ga_admin_log` (`id`, `user_id`, `platform_id`, `username`, `ip`, `m`, `a`, `addtime`, `log_type`, `info`, `status`) VALUES
(987,	0,	0,	'sysadmin',	'192.168.71.21',	'',	'',	1515667133,	5,	'密码错误',	0),
(988,	0,	0,	'sysadmin',	'192.168.71.21',	'',	'',	1515667140,	4,	'登录成功',	1),
(989,	0,	0,	'sysadmin',	'192.168.71.21',	'',	'',	1515723846,	5,	'密码错误',	0),
(990,	0,	0,	'sysadmin',	'192.168.71.21',	'',	'',	1515723852,	4,	'登录成功',	1),
(991,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515757667,	4,	'登录成功',	1),
(992,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515768652,	5,	'密码错误',	0),
(993,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515768704,	5,	'密码错误',	0),
(994,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515768840,	5,	'密码错误',	0),
(995,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515768846,	5,	'密码错误',	0),
(996,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515768851,	5,	'密码错误',	0),
(997,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515768880,	5,	'密码错误',	0),
(998,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515768894,	5,	'密码错误',	0),
(999,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515768900,	5,	'密码错误',	0),
(1000,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515768911,	5,	'密码错误',	0),
(1001,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515768948,	5,	'密码错误',	0),
(1002,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515768977,	4,	'登录成功',	1),
(1003,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515768985,	4,	'登录成功',	1),
(1004,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515823365,	5,	'密码错误',	0),
(1005,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515823370,	5,	'密码错误',	0),
(1006,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515823656,	5,	'密码错误',	0),
(1007,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515823666,	4,	'登录成功',	1),
(1008,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515851684,	4,	'登录成功',	1),
(1009,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515854475,	5,	'密码错误',	0),
(1010,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515854479,	4,	'登录成功',	1),
(1011,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515918902,	4,	'登录成功',	1),
(1012,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515919078,	4,	'登录成功',	1),
(1013,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515919519,	5,	'密码错误',	0),
(1014,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515919525,	5,	'密码错误',	0),
(1015,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515919564,	5,	'密码错误',	0),
(1016,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515919566,	5,	'密码错误',	0),
(1017,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515919572,	5,	'密码错误',	0),
(1018,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515919577,	5,	'密码错误',	0),
(1019,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515919585,	5,	'密码错误',	0),
(1020,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515919616,	5,	'密码错误',	0),
(1021,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515919623,	5,	'密码错误',	0),
(1022,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515919636,	4,	'登录成功',	1),
(1023,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515920156,	5,	'密码错误',	0),
(1024,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515920231,	4,	'登录成功',	1),
(1025,	0,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1515938977,	4,	'登录成功',	1),
(1026,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1516023496,	4,	'登录成功',	1),
(1027,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1516023853,	4,	'登录成功',	1),
(1028,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1516027778,	4,	'登录成功',	1),
(1029,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1523719497,	4,	'登录成功',	1),
(1030,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524061495,	5,	'密码错误',	0),
(1031,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524061500,	5,	'密码错误',	0),
(1032,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524061529,	5,	'密码错误',	0),
(1033,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524061587,	5,	'密码错误',	0),
(1034,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524061595,	5,	'密码错误',	0),
(1035,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524061714,	5,	'密码错误',	0),
(1036,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524061793,	4,	'登录成功',	1),
(1037,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524233545,	4,	'登录成功',	1),
(1038,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524324586,	4,	'登录成功',	1),
(1039,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524325143,	4,	'登录成功',	1),
(1040,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524325604,	4,	'登录成功',	1),
(1041,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524403544,	4,	'登录成功',	1),
(1042,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524404866,	4,	'登录成功',	1),
(1043,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524404923,	4,	'登录成功',	1),
(1044,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524405057,	4,	'登录成功',	1),
(1045,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524405069,	4,	'登录成功',	1),
(1046,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524405078,	4,	'登录成功',	1),
(1047,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524405111,	4,	'登录成功',	1),
(1048,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524405145,	4,	'登录成功',	1),
(1049,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524405257,	4,	'登录成功',	1),
(1050,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524405290,	4,	'登录成功',	1),
(1051,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524405498,	4,	'登录成功',	1),
(1052,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524579928,	4,	'登录成功',	1),
(1053,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524660792,	4,	'登录成功',	1),
(1054,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524755142,	4,	'登录成功',	1),
(1055,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1524757466,	4,	'登录成功',	1),
(1056,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1525188343,	4,	'登录成功',	1),
(1057,	1,	1000,	'zhangshan',	'127.0.0.1',	'm',	'a',	1525621288,	1,	'',	0),
(1058,	1,	1000,	'zhangshan',	'127.0.0.1',	'm',	'a',	1525621300,	1,	'',	0),
(1059,	1,	1000,	'zhangshan',	'127.0.0.1',	'm',	'a',	1525621303,	1,	'',	0),
(1060,	1,	1000,	'aaaaaaaaaa',	'127.0.0.1',	'm',	'a',	1525621304,	1,	'',	0),
(1061,	1,	1000,	'zhangshan',	'127.0.0.1',	'm',	'a',	1525621315,	1,	'',	0),
(1062,	1,	1000,	'zhangshan',	'127.0.0.1',	'm',	'a',	1525621316,	1,	'',	0),
(1063,	1,	1000,	'zhangshan',	'127.0.0.1',	'm',	'a',	1525621317,	1,	'',	0),
(1064,	1,	1000,	'zhangshan',	'127.0.0.1',	'm',	'a',	1525621318,	1,	'',	0),
(1065,	1,	1000,	'zhangshan',	'127.0.0.1',	'm',	'a',	1525621340,	1,	'',	0),
(1066,	1,	1000,	'zhangshan',	'127.0.0.1',	'm',	'a',	1525621355,	1,	'',	0),
(1067,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1525704277,	4,	'登录成功',	1),
(1068,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1525787289,	4,	'登录成功',	1),
(1069,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1525874800,	4,	'登录成功',	1),
(1070,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1525963429,	4,	'登录成功',	1),
(1071,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1526133183,	4,	'登录成功',	1),
(1072,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1526173145,	4,	'登录成功',	1),
(1073,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1526200024,	4,	'登录成功',	1),
(1074,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1526226012,	4,	'登录成功',	1),
(1075,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1526396433,	4,	'登录成功',	1),
(1076,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1526473436,	4,	'登录成功',	1),
(1077,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1526564064,	4,	'登录成功',	1),
(1078,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1526649575,	4,	'登录成功',	1),
(1079,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1526651715,	4,	'登录成功',	1),
(1080,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1526651750,	4,	'登录成功',	1),
(1081,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1526655596,	4,	'登录成功',	1),
(1082,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1526655627,	4,	'登录成功',	1),
(1083,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1526830647,	4,	'登录成功',	1),
(1084,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1526912204,	4,	'登录成功',	1),
(1085,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1527006987,	4,	'登录成功',	1),
(1086,	1,	0,	'sysadmin',	'192.168.71.21',	'',	'',	1527037383,	4,	'登录成功',	1),
(1087,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1729242387,	4,	'登录成功',	1),
(1088,	1,	0,	'sysadmin',	'127.0.0.1',	'cms/cms-article-category',	'create',	1729242825,	1,	'array (\n  \'id\' => \'\',\n  \'CmsArticleCategory\' => \n  array (\n    \'name\' => \'禅道\',\n    \'parent_id\' => \'\',\n    \'description\' => \'禅道\',\n  ),\n)',	0),
(1089,	1,	0,	'sysadmin',	'127.0.0.1',	'cms/cms-tag',	'create',	1729242937,	1,	'array (\n  \'id\' => \'\',\n  \'CmsTag\' => \n  array (\n    \'name\' => \'神\',\n  ),\n)',	0),
(1090,	1,	0,	'sysadmin',	'127.0.0.1',	'cms/cms-article',	'create',	1729244113,	1,	'array (\n)',	0),
(1091,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1729244730,	4,	'登录成功',	1),
(1092,	1,	0,	'sysadmin',	'127.0.0.1',	'',	'',	1729602375,	4,	'登录成功',	1);

DROP TABLE IF EXISTS `ga_admin_menu`;
CREATE TABLE `ga_admin_menu` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` int(6) unsigned DEFAULT '0' COMMENT '菜单上一级id',
  `top_menu_id` int(11) DEFAULT '0',
  `model` varchar(255) DEFAULT NULL COMMENT '控制器',
  `action` varchar(255) DEFAULT NULL COMMENT '方法',
  `data` char(50) DEFAULT NULL COMMENT '业务数据',
  `status` tinyint(1) DEFAULT '0' COMMENT '菜单状态 -1 隐藏  0正常',
  `name` varchar(50) DEFAULT NULL COMMENT '菜单名称',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `listorder` smallint(6) unsigned DEFAULT '0' COMMENT '排序ID',
  `level` tinyint(4) DEFAULT '0' COMMENT '菜单级别 0 1 2 3 4 依次递增',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `parentid` (`parentid`),
  KEY `model` (`model`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台菜单';

TRUNCATE `ga_admin_menu`;
INSERT INTO `ga_admin_menu` (`id`, `parentid`, `top_menu_id`, `model`, `action`, `data`, `status`, `name`, `remark`, `listorder`, `level`) VALUES
(1,	0,	1,	'admin/user',	'index',	'',	0,	'系统设置',	'一级菜单',	101,	0),
(2,	1,	1,	'admin/menu',	'index',	'',	0,	'菜单列表',	'',	1,	1),
(3,	2,	1,	'admin/menu',	'create',	'',	-1,	'菜单添加',	'',	2,	2),
(4,	2,	1,	'admin/menu',	'update',	'',	-1,	'菜单修改',	'',	3,	2),
(5,	2,	1,	'admin/menu',	'delete',	'',	-1,	'菜单删除',	'',	4,	2),
(6,	2,	1,	'admin/menu',	'index',	'',	0,	'菜单列表',	'',	1,	2),
(7,	2,	1,	'admin/menu',	'ajax_get_config_menu',	'',	-1,	'获取菜单',	'',	0,	2),
(8,	1,	1,	'admin/group',	'index',	'',	0,	'用户组',	'',	2,	1),
(9,	8,	1,	'admin/group',	'index',	'',	0,	'用户组列表',	'',	0,	2),
(10,	8,	1,	'admin/group',	'create',	'',	-1,	'用户组添加',	'',	0,	2),
(11,	8,	1,	'admin/group',	'update',	'',	-1,	'用户组修改',	'',	0,	2),
(12,	8,	1,	'admin/group',	'delete',	'',	-1,	'用户组删除',	'',	0,	2),
(13,	8,	1,	'admin/group',	'edit_permission',	'',	-1,	'编辑权限',	'',	0,	2),
(14,	8,	1,	'admin/group',	'menu',	'',	-1,	'获取菜单',	'',	0,	2),
(15,	1,	1,	'admin/user',	'index',	'',	0,	'用户管理',	'',	3,	1),
(16,	15,	1,	'admin/user',	'index',	'',	0,	'用户列表',	'',	0,	2),
(17,	15,	1,	'admin/user',	'create',	'',	-1,	'用户添加',	'',	0,	2),
(18,	15,	1,	'admin/user',	'update',	'',	-1,	'用户修改',	'',	0,	2),
(19,	15,	1,	'admin/user',	'delete',	'',	-1,	'用户删除',	'',	0,	2),
(20,	15,	1,	'admin/user',	'edit_password',	'',	-1,	'修改密码',	'',	0,	2),
(21,	15,	1,	'admin/user',	'edit_permission',	'',	-1,	'权限修改',	'',	0,	2),
(22,	0,	22,	'developer',	'index',	'',	0,	'开发工具',	'',	100,	0),
(23,	22,	22,	'gii',	'',	'',	0,	'开发工具',	'',	0,	1),
(24,	23,	22,	'gii',	'',	'',	0,	'gii',	'',	2,	2),
(25,	23,	22,	'developer',	'index',	'',	0,	'开发工具',	'',	1,	2),
(26,	23,	22,	'developer',	'preview',	'',	-1,	'表单生成预览',	'',	2,	2),
(27,	23,	22,	'developer',	'create_js',	'',	-1,	'生成js',	'',	2,	2),
(28,	0,	28,	'cms/article',	'index',	'',	0,	'CMS',	'cms',	3,	0),
(29,	28,	28,	'cms/attach',	'index',	'',	0,	'附件管理',	'0',	0,	1),
(30,	29,	28,	'cms/attach',	'index',	'',	0,	'附件列表',	'备注',	0,	2),
(31,	30,	28,	'cms/attach',	'add',	'',	0,	'附件添加',	'附件',	0,	3),
(32,	29,	28,	'cms/attach/cate',	'index',	'0',	-1,	'附件分类管理',	'cms',	0,	2),
(33,	32,	28,	'cms/attach/cate',	'add',	'',	0,	'添加',	'附件分类',	0,	3),
(34,	32,	28,	'cms/attach/cate',	'search',	'',	-1,	'附件下拉搜索',	'',	1,	3),
(35,	28,	28,	'cms/ad',	'index',	'',	0,	'广告管理',	'cms',	0,	1),
(36,	35,	28,	'cms/ad',	'index',	'',	0,	'广告管理',	'cms',	0,	2),
(37,	35,	28,	'cms/ad/block',	'index',	'',	0,	'广告区块',	'cms',	0,	2),
(38,	36,	28,	'cms/ad',	'index',	'',	0,	'广告列表',	'cms',	1,	3),
(39,	36,	28,	'cms/ad',	'create',	'',	0,	'广告添加',	'cms',	1,	3),
(40,	36,	28,	'cms/ad',	'update',	'',	0,	'广告修改',	'cms',	1,	3),
(41,	36,	28,	'cms/ad',	'delete',	'',	0,	'广告删除',	'cms',	1,	3),
(42,	37,	28,	'cms/ad/block',	'index',	'',	0,	'区块列表',	'cms',	0,	3),
(43,	37,	28,	'cms/ad/block',	'create',	'',	0,	'区块添加',	'cms',	0,	3),
(44,	37,	28,	'cms/ad/block',	'update',	'',	0,	'区块修改',	'cms',	0,	3),
(45,	37,	28,	'cms/ad/block',	'delete',	'',	0,	'区块删除',	'cms',	0,	3),
(46,	28,	28,	'cms/article',	'index',	'',	0,	'资讯管理',	'cms',	0,	1),
(47,	51,	28,	'cms/article',	'index',	'',	0,	'资讯列表',	'cms',	0,	2),
(48,	51,	28,	'cms/article',	'create',	'',	0,	'资讯添加',	'cms',	0,	2),
(49,	51,	28,	'cms/article',	'update',	'',	0,	'资讯修改',	'cms',	0,	2),
(50,	51,	28,	'cms/article',	'delete',	'',	0,	'资讯删除',	'cms',	0,	2),
(51,	46,	28,	'cms/article',	'index',	'',	0,	'资讯管理',	'cms',	0,	2),
(52,	46,	28,	'cms/article_category',	'index',	'',	0,	'分类管理',	'cms',	0,	2),
(53,	46,	28,	'cms/tag',	'index',	'',	0,	'标签管理',	'cms',	0,	2),
(54,	52,	28,	'cms/article_category',	'index',	'',	0,	'分类列表',	'cms',	0,	3),
(55,	52,	28,	'cms/article_category',	'create',	'',	0,	'分类添加',	'cms',	0,	3),
(56,	52,	28,	'cms/article_category',	'update',	'',	0,	'分类修改',	'cms',	0,	3),
(57,	52,	28,	'cms/article_category',	'delete',	'',	0,	'分类删除',	'cms',	0,	3),
(58,	53,	28,	'cms/tag',	'index',	'',	0,	'标签列表',	'cms',	0,	3),
(59,	53,	28,	'cms/tag',	'create',	'',	0,	'标签添加',	'cms',	0,	3),
(60,	53,	28,	'cms/tag',	'update',	'',	0,	'标签修改',	'cms',	0,	3),
(61,	53,	28,	'cms/tag',	'delete',	'',	0,	'标签删除',	'cms',	4,	3),
(62,	22,	0,	'admin/developer',	'index',	'a=1&b=2',	0,	'生成数据',	'a=1&b=2',	0,	0),
(63,	62,	0,	'admin/developer',	'create',	'a=1&b=2',	0,	'生成数据添加',	'',	0,	0),
(64,	62,	0,	'admin/developer',	'update',	'a=1&b=2',	0,	'生成数据修改',	'',	0,	0),
(65,	65,	0,	'admin/developer',	'index',	'a=1&b=2',	-1,	'测试菜单~',	'a=1&b=2',	0,	0),
(66,	0,	0,	'admin/developer',	'index',	'a=1&b=2',	0,	'测试菜单列表',	'a=1&b=2',	0,	0),
(67,	1,	0,	'admin/user',	'welcome',	'0',	0,	'欢迎页0',	'',	0,	2),
(68,	67,	0,	'admin/user',	'welcome',	'0',	0,	'欢迎页:)',	'0',	0,	1),
(69,	69,	0,	'admin/user',	'welcome',	'0',	0,	'欢迎页:(',	'0',	0,	0);

DROP TABLE IF EXISTS `ga_admin_user`;
CREATE TABLE `ga_admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL COMMENT '用户名',
  `realname` varchar(255) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `salt` varchar(6) NOT NULL COMMENT '密码盐',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态|0:正常,1:删除',
  `mids` text NOT NULL COMMENT '用户菜单权限',
  `platform_id` int(10) NOT NULL DEFAULT '0' COMMENT '平台id',
  `group_id` int(10) NOT NULL DEFAULT '0' COMMENT '分组id',
  `last_session_id` varchar(32) NOT NULL DEFAULT '' COMMENT '上一次登录的session_id',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台用户表';

TRUNCATE `ga_admin_user`;
INSERT INTO `ga_admin_user` (`id`, `username`, `realname`, `email`, `password`, `salt`, `create_time`, `update_time`, `status`, `mids`, `platform_id`, `group_id`, `last_session_id`, `last_login_time`) VALUES
(1,	'sysadmin',	'系统管理',	'',	'3885662a78b79c45ade750345fe0b679',	'i4BeVr',	1479393090,	1730214179,	0,	'12',	1000,	1,	'7hj9dfbac0k219gn9djaulaim9',	1729602375),
(2,	'test',	'test',	'',	'c51f62115947f3689e5f440819ae7032',	'v6KJ4v',	1510814911,	1729588760,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	61000,	1,	'emklcqulrtkgk1266soo8m07s2',	1513322025),
(3,	'xhd',	'xhd',	'',	'b8dd2d160aac9e9da4add8b4143b0d9a',	'BSmWrr',	1511182801,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	1,	1,	'ta9asqvhjv9d5a7eg64i7m4i62',	1515205636),
(4,	'wenbin',	'wenbin',	'',	'4173033fd3a048645eff75ee6f00a5f6',	'z4TGpO',	1511837805,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	0,	1,	'fonqs26aiifh1hv4fap9rqlu87',	1511847554),
(5,	'hy',	'煌业',	'',	'2d4fbd0e5de3383dce284a4daa37f870',	'eFz1AS',	1512023369,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	0,	1,	'j6o9paooko4b5k6anushgsfsp3',	1512026218),
(6,	'sgcs01',	'搜狗',	'',	'ea873c023d1fc817ba62998d138ae60b',	'qSH8x8',	1512972690,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,25,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,110,111',	61001,	8,	'o122mo5bu0gao5m9432nidgs82',	1512973328),
(7,	'sgcs02',	'搜狗2',	'',	'60ab9bf435858eef829dc1d800632a47',	'hTJl7h',	1512972818,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,25,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,110,111',	1,	8,	'sqmpe54vq5c46hmves1u6rhb24',	1512976570),
(8,	'sgcs03',	'sgcs03',	'',	'262c4136ba79f25b1fded92521036a50',	'h4GNFW',	1512977468,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,25,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,110,111',	0,	8,	'',	0),
(9,	'sgcs04',	'sgcs04',	'',	'042199e9ed782d37b7a5d95a45e7bd8c',	'4cIthv',	1513300705,	0,	0,	'',	0,	8,	'',	0),
(11,	'sgcs5',	'sgcs5',	'',	'dd8a512d181c3096f63a3a31ec1b6c4a',	'Lxg5f2',	1513300990,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,25,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,110,111',	0,	8,	'',	0),
(12,	'sgcs6',	'sgcs6',	'',	'79f45218475d8569e2ff404500906bb8',	'SV0N4r',	1513301078,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,25,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,110,111',	61000,	8,	'',	0),
(13,	'kf01',	'kf01',	'',	'a7bf4f47674dd67890d31f750c8e186f',	'BTmlXi',	1513301818,	0,	0,	'21,23,49,50,54,55,57,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,126,127,128,129,130,131,136,138,139,140,141,143',	61000,	9,	'lond7eengs1s9673d8m5vc7qv5',	1513303206),
(14,	'kfcs02',	'客服测试',	'',	'887c8173d7a5aa94961f68042c2dbec5',	'HWLdG2',	1513303636,	0,	0,	'21,23,45,46,49,50,54,61,62,69,70',	61000,	9,	'44o9rg009hnp1pqre84iqr5vt4',	1513303728),
(15,	'37wankf',	'37玩客服',	'',	'ab6563cd13838180d697989aa74eab34',	'xm8XYx',	1514253266,	0,	0,	'21,23,49,50,54,55,57,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,126,127,128,129,130,131,136,138,139,140,141,143',	61000,	9,	'3g7trif0qu2g3rjulbesebdst6',	1514255623),
(16,	'test201801',	'test201801',	'',	'3fc4c7da26591658aedd935684f82da8',	'yJKwOy',	1515578711,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	61000,	1,	'',	0),
(17,	'test201801',	'test201801',	'',	'be5e214206d7c34589524ca824a397b6',	'X0eLAL',	1515578975,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	61000,	1,	'',	0),
(18,	'test201801',	'test20180',	'',	'',	'cQgx5D',	1515579064,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	61000,	1,	'',	0),
(20,	'hepm',	'hepm',	'',	'f2160f0825c0a19f406941d818f141a3',	'oA862F',	1729344040,	1730202998,	-1,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	0,	0,	'',	0),
(21,	'root',	'root',	'',	'30b37d634a6eb95bd32b885bfd46a7c0',	'BxBaZd',	1729782466,	0,	0,	'1',	0,	1,	'',	0);

DROP TABLE IF EXISTS `ga_platform`;
CREATE TABLE `ga_platform` (
  `id` varchar(20) NOT NULL DEFAULT '' COMMENT '平台id',
  `sign` varchar(20) NOT NULL DEFAULT '' COMMENT '标识',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '平台名称',
  `ip_list` varchar(10000) NOT NULL DEFAULT '' COMMENT 'ip列表 用,分隔',
  `domain` varchar(255) NOT NULL DEFAULT '' COMMENT '域名'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='平台';

TRUNCATE `ga_platform`;
INSERT INTO `ga_platform` (`id`, `sign`, `name`, `ip_list`, `domain`) VALUES
('61001',	'youwo',	'游喔',	'',	''),
('1000',	'全部平台',	'全部平台',	'',	''),
('61000',	'sogou',	'搜狗',	'',	'');

-- 2024-10-29 15:58:14
