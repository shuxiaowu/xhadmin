/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : cms

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-05-07 23:21:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cd_access`
-- ----------------------------
DROP TABLE IF EXISTS `cd_access`;
CREATE TABLE `cd_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分组ID',
  `purviewval` varchar(128) DEFAULT NULL COMMENT '分组对应权限值',
  `group_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1481 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_access
-- ----------------------------
INSERT INTO `cd_access` VALUES ('1476', '/admin/FormData/index/extend_id/28.html', '2');
INSERT INTO `cd_access` VALUES ('1474', '/admin/FormData/delete/extend_id/27.html', '2');
INSERT INTO `cd_access` VALUES ('1475', '/admin/FormData/view/extend_id/27.html', '2');
INSERT INTO `cd_access` VALUES ('1473', '/admin/FormData/update/extend_id/27.html', '2');
INSERT INTO `cd_access` VALUES ('1472', '/admin/FormData/add/extend_id/27.html', '2');
INSERT INTO `cd_access` VALUES ('1471', '/admin/FormData/index/extend_id/27.html', '2');
INSERT INTO `cd_access` VALUES ('1470', '/admin/FormData/view/extend_id/25.html', '2');
INSERT INTO `cd_access` VALUES ('1469', '/admin/FormData/delete/extend_id/25.html', '2');
INSERT INTO `cd_access` VALUES ('1468', '/admin/FormData/update/extend_id/25.html', '2');
INSERT INTO `cd_access` VALUES ('1467', '/admin/FormData/add/extend_id/25.html', '2');
INSERT INTO `cd_access` VALUES ('1466', '/admin/FormData/index/extend_id/25.html', '2');
INSERT INTO `cd_access` VALUES ('1465', '/admin/FormData', '2');
INSERT INTO `cd_access` VALUES ('1463', '/admin/Base/password', '2');
INSERT INTO `cd_access` VALUES ('1464', '/admin/Base/delCache', '2');
INSERT INTO `cd_access` VALUES ('1462', '/admin/Base/password', '2');
INSERT INTO `cd_access` VALUES ('1461', '/admin/Sys', '2');
INSERT INTO `cd_access` VALUES ('1460', '/admin/DoHtml/index', '2');
INSERT INTO `cd_access` VALUES ('1458', '/admin/DoHtml/dolist', '2');
INSERT INTO `cd_access` VALUES ('1459', '/admin/DoHtml/doview', '2');
INSERT INTO `cd_access` VALUES ('1457', '/admin/DoHtml/doindex', '2');
INSERT INTO `cd_access` VALUES ('1456', '/admin/DoHtml', '2');
INSERT INTO `cd_access` VALUES ('1455', '/admin/Position/delete', '2');
INSERT INTO `cd_access` VALUES ('1454', '/admin/Position/update', '2');
INSERT INTO `cd_access` VALUES ('1453', '/admin/Position/add', '2');
INSERT INTO `cd_access` VALUES ('1452', '/admin/Position/index', '2');
INSERT INTO `cd_access` VALUES ('1451', '/admin/Position', '2');
INSERT INTO `cd_access` VALUES ('1450', '/admin/Frament/delete', '2');
INSERT INTO `cd_access` VALUES ('1448', '/admin/Frament/add', '2');
INSERT INTO `cd_access` VALUES ('1449', '/admin/Frament/update', '2');
INSERT INTO `cd_access` VALUES ('1446', '/admin/Frament', '2');
INSERT INTO `cd_access` VALUES ('1447', '/admin/Frament/index', '2');
INSERT INTO `cd_access` VALUES ('1445', '/admin/Content/setStatus', '2');
INSERT INTO `cd_access` VALUES ('1444', '/admin/Content/delPosition', '2');
INSERT INTO `cd_access` VALUES ('1442', '/admin/Content/move', '2');
INSERT INTO `cd_access` VALUES ('1443', '/admin/Content/setPosition', '2');
INSERT INTO `cd_access` VALUES ('1439', '/admin/Content/delete', '2');
INSERT INTO `cd_access` VALUES ('1441', '/admin/Content/updateSort', '2');
INSERT INTO `cd_access` VALUES ('1440', '/admin/Content/update', '2');
INSERT INTO `cd_access` VALUES ('1438', '/admin/Content/add', '2');
INSERT INTO `cd_access` VALUES ('1437', '/admin/Content/index', '2');
INSERT INTO `cd_access` VALUES ('1436', '/admin/Content', '2');
INSERT INTO `cd_access` VALUES ('1435', '/admin/Catagory/setSort', '2');
INSERT INTO `cd_access` VALUES ('1434', '/admin/Catagory/updateSort', '2');
INSERT INTO `cd_access` VALUES ('1433', '/admin/Catagory/delete', '2');
INSERT INTO `cd_access` VALUES ('1432', '/admin/Catagory/update', '2');
INSERT INTO `cd_access` VALUES ('1431', '/admin/Catagory/add', '2');
INSERT INTO `cd_access` VALUES ('1430', '/admin/Catagory/index', '2');
INSERT INTO `cd_access` VALUES ('1429', '/admin/Catagory', '2');
INSERT INTO `cd_access` VALUES ('1428', '/admin/Cms', '2');
INSERT INTO `cd_access` VALUES ('1427', '/admin/Member/batchUpdate', '2');
INSERT INTO `cd_access` VALUES ('1426', '/admin/Member/updatePassword', '2');
INSERT INTO `cd_access` VALUES ('1425', '/admin/Member/start', '2');
INSERT INTO `cd_access` VALUES ('1424', '/admin/Member/forbidden', '2');
INSERT INTO `cd_access` VALUES ('1423', '/admin/Member/delete', '2');
INSERT INTO `cd_access` VALUES ('1422', '/admin/Member/backRecharge', '2');
INSERT INTO `cd_access` VALUES ('1421', '/admin/Member/recharge', '2');
INSERT INTO `cd_access` VALUES ('1420', '/admin/Member/add', '2');
INSERT INTO `cd_access` VALUES ('1419', '/admin/Member/viewMember', '2');
INSERT INTO `cd_access` VALUES ('1418', '/admin/Member/index', '2');
INSERT INTO `cd_access` VALUES ('1417', '/admin/Member', '2');
INSERT INTO `cd_access` VALUES ('1477', '/admin/FormData/add/extend_id/28.html', '2');
INSERT INTO `cd_access` VALUES ('1478', '/admin/FormData/update/extend_id/28.html', '2');
INSERT INTO `cd_access` VALUES ('1479', '/admin/FormData/delete/extend_id/28.html', '2');
INSERT INTO `cd_access` VALUES ('1480', '/admin/FormData/view/extend_id/28.html', '2');

-- ----------------------------
-- Table structure for `cd_catagory`
-- ----------------------------
DROP TABLE IF EXISTS `cd_catagory`;
CREATE TABLE `cd_catagory` (
  `class_id` int(10) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(250) DEFAULT NULL,
  `subtitle` varchar(250) DEFAULT NULL COMMENT '副标题',
  `type` tinyint(4) DEFAULT NULL,
  `list_tpl` varchar(250) DEFAULT NULL,
  `detail_tpl` varchar(250) DEFAULT NULL,
  `pic` varchar(250) DEFAULT NULL,
  `keyword` varchar(250) DEFAULT NULL,
  `description` text,
  `jumpurl` varchar(250) DEFAULT NULL,
  `sortid` int(9) DEFAULT NULL,
  `pid` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `filename` varchar(32) DEFAULT NULL COMMENT '生成文件名',
  `module_id` smallint(5) DEFAULT NULL,
  `upload_config_id` tinyint(9) DEFAULT NULL COMMENT '上传配置',
  PRIMARY KEY (`class_id`),
  UNIQUE KEY `class_id` (`class_id`),
  KEY `class_name` (`class_name`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_catagory
-- ----------------------------
INSERT INTO `cd_catagory` VALUES ('7', '公司简介', '', '1', 'about', '', '', '', '', '', '1', '0', '10', '/html/gongsijianjie', 'index.html', '0', '3');
INSERT INTO `cd_catagory` VALUES ('8', '产品中心', '', '2', 'pic', 'viewproduct', '', '', '', '', '2', '0', '10', '/html/chanpinzhongxin', 'index.html', '0', null);
INSERT INTO `cd_catagory` VALUES ('9', '新闻资讯', '', '2', 'list', 'view', '', '', '', '', '9', '0', '10', '/html/xinwenzixun', 'index.html', '24', null);
INSERT INTO `cd_catagory` VALUES ('10', '人才招聘', '', '1', 'about', '', '', '', '', '', '2', '0', '10', '/html/rencaizhaopin', 'index.html', '0', null);
INSERT INTO `cd_catagory` VALUES ('11', '在线留言', '', '1', 'gustbook', '', '', '', '', '/about/11', '11', '0', '10', '/html/zaixianliuyan', 'index.html', '0', null);
INSERT INTO `cd_catagory` VALUES ('12', '联系我们', '', '1', 'about', '', '', '', '', '', '12', '0', '10', '/html/lianxiwomen', 'index.html', '0', null);
INSERT INTO `cd_catagory` VALUES ('13', 'intel网卡', '', '2', 'pic', 'viewproduct', '', '', '', '', '15', '8', '10', '/html/intelwangka', 'index.html', '23', null);
INSERT INTO `cd_catagory` VALUES ('14', 'bcm网卡', '', '2', 'pic', 'viewproduct', '', '', '', '', '16', '8', '10', '/html/bcmwangka', 'index.html', '24', null);
INSERT INTO `cd_catagory` VALUES ('15', '惠普HP网卡系列', '', '2', 'pic', 'viewproduct', '', '', '', '', '14', '8', '10', '/html/huipuHPwangkaxilie', 'index.html', '0', null);
INSERT INTO `cd_catagory` VALUES ('16', 'IBM网卡', '', '2', 'pic', 'viewproduct', '', '', '', '', '13', '8', '10', '/html/IBMwangka', 'index.html', '0', null);
INSERT INTO `cd_catagory` VALUES ('17', '光纤模块系列', '', '2', 'pic', 'viewproduct', '', '', '', '', '17', '8', '10', '/html/guangxianmokuaixilie', 'index.html', '0', null);
INSERT INTO `cd_catagory` VALUES ('19', 'banner', '', '1', '', '', '', '', '', '', '19', '0', '10', '/html/banner', 'index.html', '0', '4');
INSERT INTO `cd_catagory` VALUES ('20', '测试栏目', '', '2', 'pic', 'viewproduct', '', '', '', '', '20', '16', '10', '/html/IBMwangka/ceshilanmu', 'index.html', '0', null);
INSERT INTO `cd_catagory` VALUES ('21', '在测试', '', '2', 'pic', 'viewproduct', '', '', '', '', '21', '20', '10', '/html/IBMwangka/ceshilanmu/zaiceshi', 'index.html', '0', null);

-- ----------------------------
-- Table structure for `cd_config`
-- ----------------------------
DROP TABLE IF EXISTS `cd_config`;
CREATE TABLE `cd_config` (
  `name` varchar(50) NOT NULL,
  `data` varchar(250) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_config
-- ----------------------------
INSERT INTO `cd_config` VALUES ('cnzz', '<script type=\"text/javascript\" src=\"https://s22.cnzz.com/z_stat.php?id=1273547893&web_id=1273547893\"></script>');
INSERT INTO `cd_config` VALUES ('copyright', 'Copyright 2005-2019 寒塘冷月 技术支持  All rights reserved ');
INSERT INTO `cd_config` VALUES ('default_themes', 'index');
INSERT INTO `cd_config` VALUES ('description', 'HBA光纤卡、万兆网卡、光纤网卡、10G网卡、HCA卡、阵列卡、NAS网络存储器、服务器、存储配件专业供应商');
INSERT INTO `cd_config` VALUES ('email_pwd', '123456');
INSERT INTO `cd_config` VALUES ('email_user', '274363574@qq.com');
INSERT INTO `cd_config` VALUES ('filepath', '/html');
INSERT INTO `cd_config` VALUES ('file_size', '50M');
INSERT INTO `cd_config` VALUES ('file_type', 'gif,png,jpg,jpeg,PNG,JPG,doc,docx,xls,xlsx,csv,pdf.rar,zip,txt,mp4,flv');
INSERT INTO `cd_config` VALUES ('images_size', '10M');
INSERT INTO `cd_config` VALUES ('index_name', 'index.html');
INSERT INTO `cd_config` VALUES ('keyword', '光纤卡，10G网卡，HCA卡，SAS卡，HBA卡，万兆网卡，Qlogic，emulex，intel，LSI，阵列卡，硬盘，交换机');
INSERT INTO `cd_config` VALUES ('mobil_domain', 'm.xhcms.me');
INSERT INTO `cd_config` VALUES ('mobil_status', '1');
INSERT INTO `cd_config` VALUES ('mobil_themes', 'mobil');
INSERT INTO `cd_config` VALUES ('off_msg', '站点维护升级中!');
INSERT INTO `cd_config` VALUES ('port', '25');
INSERT INTO `cd_config` VALUES ('site_logo', '/uploads/admin/15569621469008.png');
INSERT INTO `cd_config` VALUES ('site_status', '1');
INSERT INTO `cd_config` VALUES ('site_title', 'xhcms建站系统');
INSERT INTO `cd_config` VALUES ('smtp', 'smtp.qq.com');
INSERT INTO `cd_config` VALUES ('status', '1');
INSERT INTO `cd_config` VALUES ('sub_title', '副标题');
INSERT INTO `cd_config` VALUES ('url_type', '2');
INSERT INTO `cd_config` VALUES ('water_logo', '/uploads/admin/15569623345163.jpg');
INSERT INTO `cd_config` VALUES ('water_status', '1');

-- ----------------------------
-- Table structure for `cd_config_upload`
-- ----------------------------
DROP TABLE IF EXISTS `cd_config_upload`;
CREATE TABLE `cd_config_upload` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `upload_replace` tinyint(1) DEFAULT NULL,
  `thumb_status` tinyint(1) DEFAULT NULL,
  `water_status` tinyint(1) DEFAULT NULL,
  `thumb_type` tinyint(1) DEFAULT NULL,
  `thumb_width` varchar(10) DEFAULT NULL,
  `thumb_height` varchar(10) DEFAULT NULL,
  `water_position` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='网站配置';

-- ----------------------------
-- Records of cd_config_upload
-- ----------------------------
INSERT INTO `cd_config_upload` VALUES ('3', '默认配置', '0', '1', '0', '2', '100', '100', '5', '1');
INSERT INTO `cd_config_upload` VALUES ('4', 'banner水印', '0', '0', '1', '0', '', '', '9', '1');

-- ----------------------------
-- Table structure for `cd_content`
-- ----------------------------
DROP TABLE IF EXISTS `cd_content`;
CREATE TABLE `cd_content` (
  `content_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `class_id` tinyint(4) DEFAULT NULL,
  `pic` varchar(250) DEFAULT NULL,
  `detail` text,
  `status` tinyint(4) DEFAULT NULL,
  `position` varchar(250) DEFAULT NULL,
  `jumpurl` varchar(250) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  `keyword` varchar(250) DEFAULT NULL,
  `description` text,
  `views` varchar(250) DEFAULT '1',
  `sortid` varchar(250) DEFAULT NULL,
  `author` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`content_id`),
  KEY `title` (`title`),
  KEY `class_id` (`class_id`),
  KEY `create_time` (`create_time`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_content
-- ----------------------------
INSERT INTO `cd_content` VALUES ('13', '公司简介', '7', '/uploads/admin/15562037555202.jpg', '<p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: \" microsoft=\"\" yahei=\"\" arial=\"\" helvetica=\"\" sans-serif=\"\"><span style=\"color: rgb(51, 51, 51); font-family: &quot;Microsoft YaHei&quot;, SimHei, sans-serif; font-size: 16px;\">深圳市宇科飞讯电子有限公司办公室地址位于中国个经济特区，鹏城深圳，深圳 深圳市福田区福虹路华强花园11栋602，于2014年03月03日在深圳市市场监督管理局注册成立，注册资本为100万元，在公司发展壮大的5年里，我们始终为客户提供好的产品和技术支持、健全的售后服务，我公司主要经营计算机软硬件、安防设备、五金制品、网络通讯产品、电子产品及配件、电子元器件和集成电路的技术开发与销售，国内贸易（不含专营、专控、专卖商品）。，我们有好的产品和专业的销售和技术团队，我公司属于深圳电子加工公司行业，如果您对我公司的产品服务有兴趣，期待您在线留言或者来电咨询</span><br/><br/></p>', '10', '1,2', '', '1552822307', '', '', '', '13', '');
INSERT INTO `cd_content` VALUES ('16', 'Emulex第五代FC HBA实现230万IOPS！', '20', '', '<p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">几年前，每秒输入/输出操作数（IOPS）突破10万次都可以说是惊人的事件；但是就在最近，Storage Switzerland与博科、戴尔、Violin Memory（闪存厂商）和Emulex合作进行了实验室测试，在广泛采用现有组件搭建的简单的存储区域网络（SAN）上， 实现了230万IOPS！<br /><br />测试环境在16Gb光纤通道基础架构上采用了4台Dell PowerEdge R910服务器，每台服务器都配有4个Emulex LightPulse第五代光纤通道（FC）LPe16002B主机总线适配器（HBA）。这些板卡用于把服务器连接到一个博科第五代FC 6520交换机上，然后这台交换机再连接到Violin 6616 Flash Memory SAN阵列。安装整套设备仅需一个标准机架，而且机架空间还有空余。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">利用快闪存储设备（本例中使用的是4个Violin Flash Memory SAN阵列），我们可以获得快得多的IOPS速度，因为快闪存储的速度最高可比传统存储产品快90%。通过功能强大的新型服务器（本例中采用了4台Dell PowerEdge R910），我们能够真正提高处理事务的速度，把阵列充分利用起来。但是数据是如何从服务器传输到存储系统的呢？当然是通过HBA(Host Bus Adapter)和交换机。Storage Switzerland认为，需要一种周到全面的方式才能搭建出真正高性能的SAN，而我们Emulex认为，SAN的性能高低取决于它最薄弱的链路环节。试想，我们总不能把浇花用的水管接到消防栓上还指望用它扑灭熊熊大火吧！</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">大型数据中心SAN的连接介质大都运行在50万IOPS的数据速率上，因此230万的IOPS目前看来似乎难以想象。但我们必须基于整体角度考虑，为什么对于当今的数据要求和应用来说，230万IOPS不是一个高得多余（“为什么我需要那么快的SAN”）的指标。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">原因之一是“虚拟化”。现在的服务器比过去强大了许多，据估计，每台物理服务器上平均用VMware等监管程序运行着25个虚拟机（VM），实际上我们在服务器上通常看到的密度会更高。在这种VM环境下，如果没有足够强大的HBA，就极有可能产生I/O瓶颈。云应用也在推动I/O性能要求提高。随着越来越多的数据中心实施混合云环境，送入SAN的整体数据量会明显增加。最后，大数据解决方案的发展也需要速度更快的存储产品和更高的I/O性能。就是这些原因最终会迫使我们向16GFC基础架构和快闪存储阵列配置迁移。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">但目前许多数据中心还在使用8GFC基础架构（存储系统、交换机以及HBA），而且尚未准备升级到16GFC，它们也可能会选择把钱花在快闪阵列或者服务器侧的快闪缓存上。那么如果基础架构没有改变，升级到16GFC HBA（特别是Emulex第五代产品）有什么好处呢？</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">理由：首先，Emulex第五代光纤通道HBA能够与8GFC环境无缝结合，实现真正的性能提升，还可以把IOPS提高到原来的5倍（超过120万），同时把延时降到只有8GFC的一半。其次，所有第五代FC HBA都支持PCIe 3.0，这直接提升了运行速度，而且PCIe 3.0在所有新服务器上都是标准配置，既然是这样，为什么不把PCIe 3.0的优点充分利用起来呢？第三，因为无需购买16GFC交换机或存储系统，因此这是最简单、投资最少的升级SAN性能的方法。第四，它是面向未来的，而将来则不可避免地要向16GFC基础架构迁移。此外，Emulex第五代FC HBA还100%向后兼容，用户完全不必担心兼容问题。</p>', '10', '', '', '1552822476', '', '', '1', '16', '');
INSERT INTO `cd_content` VALUES ('17', 'Emulex为戴尔PowerEdge提供高性能虚拟化和可扩展性', '9', '', '<p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">Emulex公司日前宣布推出用于Dell PowerEdge机架、刀片和塔式平台的高性能万兆以太网（10GbE）连接产品，即全新OneConnect OCe14000系列万兆以太网融合网络适配器（CNA）。OCe14000系列万兆以太网CNA专为虚拟化、企业和云数据中心而进行了优化，可以提供无状态TCP硬件卸载能力。它通过单一源I/O虚拟化（Single-Root I/O Virtualization，SR-IOV）来提高虚拟化可扩展性，并通过FCoE和iSCSI硬件卸载优化CPU利用率。同时，它可使用戴尔交换独立的网络分区（switch independent network partitioning，NPAR）技术来优化带宽分配，并且通过Emulex叠加网络（Overlay Network，OVN）卸载技术来加速云网络。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">Emulex营销及企业发展高级副总裁Shaun Walsh表示：“Emulex OCe14000 10GbE CNA专门针对戴尔服务器平台进行了优化，以其实现差异化。其设计目标是解决企业、云和虚拟化应用（包括软件定义网络采用的新技术）面临的诸多问题。为戴尔产品配备最新Emulex万兆以太网产品使我们的合作更紧密，从而能够在网络领域内开发出差异化的端到端解决方案。这些新解决方案还获得了用于所有Dell Force10交换机产品的认证，因此用户可以使用戴尔服务器、存储系统和交换机搭建出完整的解决方案。OCe14000 10GbE CNA的推出使戴尔客户有更多Emulex产品可供选择，完善了我们目前的互连产品种类，这些产品中还包括了LightPulse&reg;第五代光纤通道主机总线适配器（HBA）。”</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">Emulex OneConnect 10GbE CNA技术可以实现非常高的虚拟机（VM）密度，通过OVN卸载技术支持安全的混合云，并提供了开放式应用程序接口（API），通过它能够与新一代SDN解决方案进行集成。经过验证，OneConnect 万兆以太网CNA不仅可以用作Dell PowerEdge平台的出厂预装选件，而且还可以用于完善其他戴尔融合式基础架构平台，如支持FCoE的Dell S5000网络交换机，以及Dell Compellent和Dell EqualLogic存储阵列。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">戴尔服务器解决方案执行总监Brian Payne表示：“Emulex OneConnect 10GbE CNA是需要高密度性能的Dell PowerEdge客户的理想选择，能够为云、融合式基础架构和虚拟化部署提供良好支持。借助更高带宽、更低延时、存储卸载，以及高效简化数据中心内部和数据中心之间的VM迁移等优势，这一全新适配器产品系列能够全面满足我们客户的存储和网络需求。”</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">Emulex OneConnect万兆以太网CNA提供了一整套强大的特性和能力，包括：</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">通过Dell NPAR NIC分区技术优化带宽：Dell NPAR技术允许在每个网络适配器卡端口上创建多种PCI功能。作为一款CNA，Emulex OneConnect 万兆以太网CNA上的每个端口都可以配置成4个NIC功能，或者3个NIC功能和1个iSCSI（或FCoE）存储功能。NPAR是虚拟服务器环境的理想选择，因为它可以对带宽分配进行优化，从而支持I/O密集型应用、虚拟化服务器，以及服务器管理功能。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">系统管理简单灵活：Emulex OneConnect万兆以太网CNA兼容集成式Dell Remote Access Controller （iDRAC），iDRAC配备有Lifecycle Controller系统管理解决方案。iDRAC7采用了Lifecycle Controller技术，使管理员能够从任意地点对戴尔服务器进行部署、监控、管理、配置、更新、故障排查和修复，而无需使用代理。使用OneCommand Manager从单一控制台就可以控制、配置和管理适配器。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">高性能虚拟化：Emulex OneConnect万兆以太网CNA采用了高效、可扩展的硬件卸载技术，可以卸载虚拟网络开销。用于VMware VirtualWire连接时，与标准NIC相比可以把CPU利用率降低最高50%1，因此可以提高每台服务器支持的VM数。Emulex OneConnect万兆以太网CNA在处理小数据包时可提供4倍的网络性能2，轻松扩展事务密集型应用和集群应用。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">开放式支持软件定义网络：Emulex SURF开放式API提供了必要的工具来实施SDN技术，该技术可根据OpenStack和OpenFlow等下一代应用和新行业标准进行优化。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">快速、安全、可扩展的混合云连接：在支持新OVN标准，如Microsoft Hyper-V网络虚拟化所采用的Network Virtualization using Generic Routing Encapsulation (NVGRE)和VMware NSX中使用的Virtual Extensible LAN （VXLAN）时，与仅采用软件实现的解决方案相比，Emulex Virtual Network Exceleration（VNeX）卸载技术可以提供高出70%的性能1。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">通过FCoE和iSCSI硬件卸载提高存储连接灵活性：Emulex OneConnect万兆以太网CNA支持FCoE卸载，它使用了与Emulex LightPulse光纤通道HBA相同的Emulex驱动程序，而且经过了实践验证。Emulex OneConnect万兆以太网CNA还支持硬件iSCSI卸载，可以通过数据中心桥接（DCB）以太网fabric传输存储流量，其性能大大优于基于软件发起端和标准NIC的解决方案。</p>', '10', '', '', '1552822493', '', '', '4', '17', '');
INSERT INTO `cd_content` VALUES ('18', 'Emulex为惠普ProLiant交付16GFC夹层HBA', '9', '', '<p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">近日， Emulex宣布为惠普推出HP-LPe1605双通道第五代16Gb光纤通道（16GFC）夹层卡，它是面向HP BladeSystem C-Class Gen8平台的完美解决方案。这种卡基于8核心设计的Emulex LightPulse 第五代光纤通道（FC）HBA技术，能够提供最高的性能，安装管理更简单，具有无可匹敌的可扩展性和行业领先的虚拟化支持能力。HP-LPe1605拥有强大的管理工具，能够无缝集成到HP Storage Essentials （SE）、System Insight Manager（SIM）中，并且支持HP ProLiant Gen8 ProActive Insight Architecture，可以为多种多样的应用和环境提供最高性能。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">Emulex功能丰富的开发和管理工具可以简化HBA部署和设备管理帮助降低管理成本，保护IT投资。此外，在博科Gen 5 FC环境下Emulex ClearLinkTM 技术可以进行电缆和链路故障诊断。以下是这种新夹层卡适配器的主要特性和优势：</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"><strong>主要优势</strong></p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">• 完美适用于高带宽云部署和存储密集型应用，吞吐速度16GFC，延时更低，单端口每秒I/O操作数（IOPS）最高120万。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">• 在8GFC模式下，与其他8Gb FC适配器相比可以提供更高的IOPS和更低延时。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">• 卓越的质量和吞吐速度诊断功能，可以确保高可靠性和数据可用性。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">• 支持HP ProLiant Gen8 ProActive Insight架构。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">• 高效的安装流程和强大的互操作性，可以简化SAN软硬件的部署和升级。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"><strong>主要特性</strong></p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">• 单端口120万IOPS，比其他第五代HBA高20%。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">• 8核心ASIC能够支持最高的虚拟机（VM）密度，可以实现8192个并行登录/开放交换——最高可达其他适配器的4倍。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">• 支持1024个Message Signal Interrupts Extended（MSI-X），提高了主机利用率和应用性能。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">• 在配备了NPIV以及高达255个虚拟端口时，SAN可为虚拟服务器交付最佳性能。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">• 可以在SAN上的任意地点通过强大的管理应用高效集中管理Emulex HBA。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">• 最新支持基于预启动UEFI的配置，包括UEFI安全启动。</p>', '10', '', '', '1552822505', '', '', '2', '18', '');
INSERT INTO `cd_content` VALUES ('19', 'Emulex宣布最新产品将支持OCP开放计算项目', '9', '', '<p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">新工作负载，以及客户使用基础架构的方式已经再次发生变化，甚至网络流量围绕数据中心进行传输的基本框架也在改变，因此我们的架构解决方案也必须与时俱进，以便帮助最新的IBM System x3850/x3950 X6服务器、存储和网络中心组件全面实现，并平衡投资回报（ROI）。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">Emulex本季度的动作非同凡响，我们推出了自己的新OneConnect OCe14000系列万兆和四万兆以太网（10/40GbE）网络适配器和融合网络适配器（CNA），这些产品都基于新一代的Emulex Engine（XE）100系列I/O控制器。我们对行业最新的发展趋势和方向进行了深入研究，认识到了哪些趋势将在未来几年流行不衰，以及它们将对采用Emulex技术的IBM及我们的最终客户产生什么的影响。Emulex希望了解现实，而且有能力把握现实。Emulex的卓越产品可以改变客户设计解决方案的方式，更好地为企业负载、web级应用、虚拟环境和软件定义网络（SDN）部署提供支持。全新Emulex Virtual Fabric Adapter (VFA) 5 for IBM System x在三个维度上提高了性能：带宽更高、延时更低、每秒I/O操作数（IOPS）更快，从而能够解决流量和全球存储爆炸性增长的难题。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">2009年以来，Emulex VFA技术一直在帮助企业降低系统成本和复杂度，并提高性能。此次新推出的Emulex VFA5 for IBM System x继往开来，新增加了多项功能和特性，将再次彻底改变游戏，就像Emulex在2009年推出VFA技术时一样。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">Emulex VFA5 for IBM System x专门为满足企业、云服务提供商和电信公司的需求进行了优化，具有一系列强大的功能和特性，包括：</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">高性能虚拟化：Emulex VFA5采用了高效、可扩展的硬件卸载技术来卸载虚拟网络开销。在用于VMware VirtualWire连接时，与标准NIC相比它可提供高出50%的CPU利用率，因此可以增加每台服务器支持的虚拟机（VM）数量。此外，VFA 5在处理小数据包时可把网络性能真正提高4倍，从而满足扩展事务密集型应用和集群应用的性能需求。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">快速、安全、可扩展的混合云连接：与新Virtual Network Fabric标准的软件实现方式相比，Emulex Virtual Network Exceleration™（VNeX）卸载技术可提供高出70%的性能。新Virtual Network Fabric标准包括Microsoft Hyper-V网络虚拟化使用的NVGRE，以及VMware的NSX所使用的VXLAN （Virtual Extensible LAN，虚拟可扩展局域网)。它们都通过实现灵活的虚拟工作负载移动性来克服传统数据中心网络的限制，将虚拟机部署或网络重配时间从数天缩短到几分钟。与Microsoft Dynamic VMQ或VMware NetQueue一同使用时，Emulex VFA5可提供业内最先进的平台来提高虚拟机密度。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">使用先进的RoCE架构实现应用交付：Emulex VFA5基于低延时RoCE（RDMA over Converged Ethernet）架构，可帮助企业IT及云数据中心优化面向VDI、大数据、下一代NoSQL、内存数据库（in-memory databases）及传统企业IT工作负载的应用交付。这些新适配器将支持Windows Server SMB Direct和Linux NFS协议。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">块协议性能更高：相对于上一代VFA，Emulex VFA5把整体块协议每秒I/O操作数（IOPS）提高了50%，并继承了Emulex久经验证的企业级存储可靠性。</p>', '10', '', '', '1552822533', '', '', '5', '19', '');
INSERT INTO `cd_content` VALUES ('20', 'PMC亮相IDF 展示12G SAS分层存储方案', '9', '', '<span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">引领大数据连接、传送以及存储，提供创新半导体及软件解决方案的PMC公司出席在深圳举办的2014 IDF英特尔开发者论坛。此次，PMC将在 1层展示大厅的159 展台展出其带有maxCache Plus分层软件的Adaptec by PMC 8系列RAID卡</span><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">及6G SAS 配置的7系列RAID 以及HBA 卡。</span><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif; text-align: center;\"><img alt=\"PMC亮相IDF 展示12G SAS分层存储方案\" src=\"http://image20.it168.com/201404_800x800/1789/fbf6f4e720f56de4.jpg\" border=\"1\" style=\"padding: 0px; margin: 0px; border: 0px;\" /></p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif; text-align: center;\">maxCache Plus软件</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">数据中心需要高密度、灵活度以及优异的性能以满足现今大数据应用，而这些都是传统数据中心解决方案无法提供的。Adaptec by PMC将动态展示配备在8系列RAID卡上的maxCache Plus分层存储如何将性能提升50倍，这对于存储系统管理者满足当前需求至关重要。展示的形式将由两个对照组形成，让参观者对maxCache有更直观的认识。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">8系列中的maxCache Plus在管理与其连接的PCIe闪存卡、 SSD以及HDD的同时，可以实现对不同存储介质的分层，以确保关键应用和热数据优先使用高性能的存储介质，由此显著提升IOPS.它的加入也使得混合阵 列能够在RAID卡层完成分层，充分体现8系列的灵活性。演示中将会展示一款由12Gb/s SAS SSD和HDD组成的两层存储解决方案。其中性能分层是采用Seagate的1200 12Gb/s SAS SSD，而通过maxCache Plus驱动SSD加速第二层的Seagate 企业级Constellation.2 SATA HDD。Adaptec maxCache Plus的分层功能及冗余存储池均由Adaptec的maxView Storage Manager(存储管理员)进行管理。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">　　PMC也将推出出全新的12Gb/s 的4端口RAID卡(ASR-8405将于5月上市), 适用于较高密度、更快性能和更多配置的存储环境，可直接实现更快的数据交付和接入。富于创新的8系列卡能够帮助数据中心的架构师从存储资产中获得最高价值和性能表现。</p>', '10', '', '', '1552822562', '', '', '5', '20', '');
INSERT INTO `cd_content` VALUES ('21', 'LSI增强MgaRAID闪存卡更贴近超大规模环境', '9', '', '<p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">LSI已经将MegaRAID闪存卡的闪存容量从1.6TB翻了一番，并将端口数增加到16个，这样强大的小闪卡就可以用于在超大规模环境中加速服务器。</p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">连接PCIe的Nytro MegaRAID闪存卡将一个RAID控制器与板载闪存及缓存软件结合，提供对热数据的更快速访问。LSI表示，这个闪存卡用于“对磁盘数量和容量有较高要求的横向扩展服务器和存储环境”，提到了云和托管公司，以及类似的超大规模环境。</p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">MegaRAID 8140-8e8i PCIe闪存加速卡有4个闪存模块和16个SAS/SATA接口：这是目前可用端口数的4倍。该卡“将一个扩展器集成到架构中，提供横向扩展的服务器环境，最多可连接236个SAS和SATA设备，通过8个外置和内置的端口”。</p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">LSI表示，该卡的闪存能够以三种方式分区：</p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">- 针对数据量提供具有闪存速度的主存储</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">- 通过为定义容量运用RAID来提供数据保护</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">- 提供启动盘——LSI表示这样可以针对容量用途释放硬盘插槽</p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">高级缓存统计工具（Advanced Cache Statistics）提供了“诊断”功能，旨在确保产品环境实现理想的缓存优势，基于其应用和工作负载，并且提供了：</p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">- 从缓存完成的I/O数量</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">- 写入到缓存的热数据量</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">- 总I/O量，针对读取和写入，由主机发出</p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif; text-align: center;\"><a href=\"http://img.zdnet.com.cn/3/55/liXQNYaoC2ABo.jpg\" style=\"color: rgb(51, 51, 51); text-decoration-line: none;\"><img alt=\"LSI增强MgaRAID闪存卡更贴近超大规模环境\" src=\"http://img.zdnet.com.cn/3/55/liXQNYaoC2ABo.jpg\" border=\"0\" style=\"padding: 0px; margin: 0px; border: 0px;\" /></a></p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif; text-align: center;\"><span style=\"color: rgb(255, 0, 0);\">LSI Nytro MegaRAID 8140-8e8i闪存卡</span></p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">LSI表示，这项报告功能让用户可以在他们的设置环境中测量缓存的有效性。</p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">自从2012年月首次推出该产品，到目前为止LSI已经累计出货10万块Nytro PCIe闪存卡。LSI Nytro MegaRAID 8140-8e8i闪存卡应该是从2014年第二季度开始通过OEM和其他渠道合作伙伴生产出货。</p>', '10', '', '', '1552822591', '', '', '6', '21', '');
INSERT INTO `cd_content` VALUES ('22', '英特尔收购QLogic旗下InfiniBand业务', '9', '', '<p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">英特尔公司(INTC)周一宣布，已同意以1.25亿美元现金收购网络设备制造商QLogic Corp(QLGC)的InfiniBand部门，以加强其网络及高性能计算能力。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">英特尔表示，此项交易预计将于第一季度完成，并且表示，“此项收购旨在加强英特尔的网络资产组合，并提供可升级的高性能计算架构技术。”</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">该公司表示，预计大量InfiniBand员工将加入英特尔。</p><p style=\"padding: 5px 0px; margin: 0px; line-height: 24px; font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">QLogic表示，预计此项交易不会对其每股盈利产生影响。</p>', '10', '', '', '1552822615', '', '', '16', '22', '');
INSERT INTO `cd_content` VALUES ('23', '概论高清、网络化视频存储要求', '9', '', '<p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\">对于视频监控而言，图像清晰度无疑是最关键的特性。图像越清晰，细节越明显，观看 体验越好，智能等应用业务的准确度也越高。所以图像清晰度是视频监控永恒的追求。然而作为高清的视频，动辄几G到几十G的文件大小，这么大的视频文件，而 且有如潮水般的涌现，不仅对存储容量，对读写性能、可靠性等都提出了更高要求。因此，选择什么样的存储系统和方案，往往成为影响视频读写速度的关键。</span><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span></p><p>高清、网络化视频存储要求</p><p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span></p><p>1、在了解高清存储系统之前，必须知道什么是高清?</p><p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span></p><p>在高清视频标准中，视频从最低标准到较高标准依次为720线非交错式，即720p逐行扫描;1080线交错式，即1080i隔行扫描;1080线非交错式，即1080p逐行扫描，屏幕纵横比为16:9，如果是视音频同步的HDTV，标准输出为杜比5.1声道数字格式。</p><p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span></p><p>高 清视频有常见的三种分辨率，分别是：720P(1280×720P)逐行，美国的部分高清电视台主要采用这种格式;1080i(1920×1080i)隔 行;1080P(1920×1080P)逐行。网络视频高清资源以720P和1080i最为常见，其中作为视频监控系统的高清部分，已产品化的设备标准普 遍采用720P和1080P的拍摄标准。</p><p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span></p><p>2、视频存储要求之大容量，即高清的文件到底有多大?</p><p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span></p><p>高 清视频在经过不同的编码处理以后，依据码率不同，而有不同的要求。一般码率在6-20Mb之间，压缩效率、压缩方式不同，所获得的最终文件大小约 为：3-10GB/小时，因此便产生了对于存储大容量的要求。当然一般意义上的视频，压缩模式不同，占用的存储空间非常小，这里主要讨论一下高清视频的存 储容量。</p><p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span></p><p>高 清视频的一种应用是提供这些高清网络视频资源下载的高清网站，规模比较小的站点片库中也会有成百上千部电影，这一类的网站在互联网上多如牛毛，而每个站点 存储系统的净容量要求至少在几十T，加上某些站点要建立多个文件映射和下载种子以提高综合流量，容量就不仅仅是几十个T了。</p><p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span></p><p>另 一种应用是高清视频监控，虽然出于经济性考虑，此种应用中高清监控视频压缩率会比较高。目前720P高清视频摄像资料每小时视频录像可压缩到3GB左右容 量，但由于采集的是高清视频，而一般的监控系统摄像路数都是几百乃至上千路，所以这种应用将需要更多的存储设备和更大的存储容量。以此为例，按一个月保存 时间要求计算，可以得到这样一个数据：</p><p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span></p><p>3GB/小时×24小时×30天×1路=2.16T</p><p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span></p><p>每存储一路视频需要2T以上的净容量，那么计算一个拥有500路高清视频摄像，需要保存30天的监控系统所需的最少存储容量是1PB。</p><p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span></p><p>3、视频存储要求之高性能</p><p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span></p><p>众 所周知，除了BT分布式下载结构的网站，支持高清视频的效果大多是以服务端大数据流量为代价的。以每路数据流为20Mb的高清视频为例，在千兆单点服务模 式，最多可以容纳50路高清视频同时播放。当然这个是理论值，实际上还要考虑网络在处理数据撞包等任务时，消耗网络带宽资源之类的因素。因此，在高清视频 网站考虑服务时，首先要考虑向服务器提供高清视频数据的存储系统，扩大存储系统的带宽，速度才能得到有效的提升。在高清视频监控系统中，存储的传输速率要 求会随着监控系统的规模呈正比增长。</p><p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span></p><p>4、视频存储要求之可靠性</p><p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span></p><p>从 高清视频文件对用户的重要性来讲有几个不同的层次：一般安全性用户、中度安全性用户、重要视频数据用户。作为一般安全性用户，主要是指一些以分布式下载的 高清电影网站，他们对于高清数据安全性要求相对不高。偶尔存储系统离线，并不会对整个体系造成太大影响，但是对于数据的完整性要求比较高。</p><p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span></p><p>中度安全性用户，如一些大型高清视频在线网站、交互网站等，要求高清视频数据具有实时性、交互性特点的，以及关键性的高清视频数据存储，都属于中度安全要求的用户。他们对于高清视频存储安全性的要求，是实时性和可恢复性。</p><p><span style=\"font-family: &quot;Microsoft Yahei&quot;, Arial, Helvetica, sans-serif;\"></span></p><p>重要视频数据用户，比如高清视频监控图像、媒体资讯制作内容等都属于重要视频数据类型，这类用户对高清视频存储安全的要求是实时性、冗余性和不间断性。</p>', '10', '', '', '1552822634', '', '', '90', '23', '');
INSERT INTO `cd_content` VALUES ('24', '人才招聘', '10', '', '内容建设中', '10', '', '', '1552823087', '', '', '', '24', '');
INSERT INTO `cd_content` VALUES ('25', '联系我们', '12', '', '<p><strong>深圳XXXX电子有限公司</strong></p><p>地址：深圳市福田区深南中路3037南光捷佳大厦605</p><p>联系人：XXXX</p><p>电话：0755-12345677</p><p>网址：<a href=\"http://www.xhadmin.cn\" target=\"_blank\">www.xhadmin.com</a></p>', '10', '', '', '1552823105', '', '', '', '25', '');
INSERT INTO `cd_content` VALUES ('27', 'banner2', '19', '/uploads/admin/15569698539938.jpg', '', '10', '', '', '1552827574', '', '', '', '27', '');
INSERT INTO `cd_content` VALUES ('28', 'banner3', '19', '/uploads/admin/15569698472241.jpg', '', '10', '', '', '1552827584', '', '', '', '28', '');
INSERT INTO `cd_content` VALUES ('29', 'LSI 9380-8i8e 阵列卡', '13', '/uploads/admin/1552831685383.jpg', '', '0', '1', '', '1552831666', '', '', '1', '29', '');
INSERT INTO `cd_content` VALUES ('30', 'LSI 9361-24i 阵列卡', '13', '/uploads/admin/15528317119183.jpg', '', '10', '', '', '1552831689', '', '', '', '30', '');
INSERT INTO `cd_content` VALUES ('31', 'LSI 9361-16i 阵列卡', '13', '/uploads/admin/15528317381629.jpg', '', '10', '', '', '1552831720', '', '', '4', '31', '');
INSERT INTO `cd_content` VALUES ('33', 'LSI 9286-8e 外接阵列卡', '13', '/uploads/admin/15528317842911.jpg', '', '10', '', '', '1552831766', '', '', '', '33', '');
INSERT INTO `cd_content` VALUES ('34', '3Ware 9750-8i 阵列卡', '13', '/uploads/admin/15528318038134.jpg', '', '10', '', '', '1552831792', '', '', '1', '34', '');
INSERT INTO `cd_content` VALUES ('35', 'LSI 9380-4i4e 内外接卡', '13', '/uploads/admin/1552831826716.jpg', '', '10', '', '', '1552831812', '', '', '', '35', '');
INSERT INTO `cd_content` VALUES ('36', 'LSI 9271-8i 阵列卡', '13', '/uploads/admin/15563752017288.jpg', '', '10', '', '', '1552831842', '', '', '5', '36', '');
INSERT INTO `cd_content` VALUES ('57', '产品标题', '13', '/uploads/admin/15566168606277.jpg', '', '10', '', '', '1555993345', '', '', '', '57', '');
INSERT INTO `cd_content` VALUES ('58', '产品标题', '13', '/uploads/admin/15566168606277.jpg', '', '10', '', '', '1555997683', '', '', '', '58', '');
INSERT INTO `cd_content` VALUES ('60', '产品标题', '13', '/uploads/admin/15566168606277.jpg', '', '10', '', '', '1555997860', '', '', '', '60', '');
INSERT INTO `cd_content` VALUES ('61', '产品标题', '13', '/uploads/admin/15566168606277.jpg', '', '10', '', '', '1555997903', '', '', '2', '61', '');
INSERT INTO `cd_content` VALUES ('62', '产品标题', '13', '/uploads/admin/15566168606277.jpg', '', '10', '', '', '1555997926', '', '', '3', '62', '');
INSERT INTO `cd_content` VALUES ('64', '产品标题', '13', '/uploads/admin/15569700405098.jpg', '', '10', '', '', '1555997987', '', '', '5', '64', '');
INSERT INTO `cd_content` VALUES ('65', '产品标题', '13', '/uploads/admin/15569700405098.jpg', '', '10', '', '', '1555998191', '', '', '8', '65', '');
INSERT INTO `cd_content` VALUES ('66', '产品标题', '13', '/uploads/admin/15569700405098.jpg', '', '10', '1', '', '1555998214', '', '', '66', '66', '');
INSERT INTO `cd_content` VALUES ('68', '测试信息1', '13', '/uploads/admin/15569700405098.jpg', '<p>当时都是多所</p>', '10', '', '', '1514766819', '', '', '5', '68', '');
INSERT INTO `cd_content` VALUES ('72', '测试标题', '13', '/uploads/admin/15569700405098.jpg', '', '10', ',1', '', '1556683144', '', '', '3', '72', 'admin');

-- ----------------------------
-- Table structure for `cd_ext_baoming`
-- ----------------------------
DROP TABLE IF EXISTS `cd_ext_baoming`;
CREATE TABLE `cd_ext_baoming` (
  `data_id` int(10) NOT NULL AUTO_INCREMENT,
  `A` varchar(250) DEFAULT NULL,
  `mobil` varchar(250) DEFAULT NULL,
  `school` varchar(250) DEFAULT NULL,
  `scool` varchar(250) DEFAULT NULL,
  `sfz` varchar(250) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  `addr` varchar(250) DEFAULT NULL,
  `relname` varchar(250) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `province` varchar(250) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `district` varchar(250) DEFAULT NULL,
  `files` text,
  PRIMARY KEY (`data_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_ext_baoming
-- ----------------------------
INSERT INTO `cd_ext_baoming` VALUES ('1', '吴城', '13545028472', '鄂东高中', '564', '/uploads/admin/15561220267621.jpg', '1556072684', '鄂城区泽林镇', '张三', '1', '吉林省', '松原市', '宁江区', '/uploads/admin/15562858351069.xls');
INSERT INTO `cd_ext_baoming` VALUES ('2', '何英敏', '13545028475', '鄂东高中', '123', '/uploads/admin/15561716326606.png', '1556172684', '湖北武汉光谷', '刘明', '2', '安徽省', '六安市', '金寨县', null);
INSERT INTO `cd_ext_baoming` VALUES ('3', '赵莎莎', '13545028471', '鄂东高中', '561', '/uploads/admin/15561726081670.png', '1556112684', '湖北武汉', '王五', '1', '山东省', '聊城市', '高唐县', null);
INSERT INTO `cd_ext_baoming` VALUES ('4', '张三', '13545028471', '鄂东高中', '564', '/uploads/admin/1556172682792.png', '1556142684', '湖北武汉', '李四', '2', '江苏省', '扬州市', '宝应县', null);
INSERT INTO `cd_ext_baoming` VALUES ('6', '艾一方', '13545028477', '鄂东高中', '56', '', '1556206290', '湖北武汉南湖', '李毅', '1', '河南省', '周口市', '鹿邑县', null);

-- ----------------------------
-- Table structure for `cd_ext_book`
-- ----------------------------
DROP TABLE IF EXISTS `cd_ext_book`;
CREATE TABLE `cd_ext_book` (
  `data_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `qq` varchar(250) DEFAULT NULL,
  `content` text,
  `create_time` int(10) DEFAULT NULL,
  `ip` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`data_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_ext_book
-- ----------------------------
INSERT INTO `cd_ext_book` VALUES ('1', 'heyingmin', '872977817@qq.com', '67766767', '留言详细内容内容', '1556518666', null);
INSERT INTO `cd_ext_book` VALUES ('2', '吴城', '274363574@qq.com', '67766767', '前台提交的测试内容无需写提交过程，关联上模型即可提交', '1556208000', null);
INSERT INTO `cd_ext_book` VALUES ('5', '寒塘冷月', '274363574@qq.com', '67766767', '测试内容', '1556712215', '127.0.0.1');
INSERT INTO `cd_ext_book` VALUES ('7', '张三', '2743635574@qq.com', '274363574', '留言内容', '1557241851', '127.0.0.1');
INSERT INTO `cd_ext_book` VALUES ('8', '李四', '323232@qq.com', '274363574', '测试内容', '1557241851', '127.0.0.1');

-- ----------------------------
-- Table structure for `cd_ext_case`
-- ----------------------------
DROP TABLE IF EXISTS `cd_ext_case`;
CREATE TABLE `cd_ext_case` (
  `data_id` int(10) NOT NULL AUTO_INCREMENT,
  `content_id` int(100) DEFAULT NULL,
  `price` varchar(250) DEFAULT NULL,
  `des` varchar(250) DEFAULT NULL,
  `images` text,
  `files` text,
  `thumb` varchar(250) DEFAULT NULL,
  `markt_price` decimal(10,2) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `flah` varchar(250) DEFAULT NULL,
  `wb` text,
  `datetime` int(10) DEFAULT NULL,
  `xheditor` text,
  `ueditor` text,
  `money` decimal(10,2) DEFAULT NULL,
  `color` varchar(250) DEFAULT NULL,
  `zb` varchar(250) DEFAULT NULL,
  `province` varchar(250) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `district` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`data_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_ext_case
-- ----------------------------
INSERT INTO `cd_ext_case` VALUES ('2', '68', '325', '描述信息测试1111', '/uploads/admin/15561097503003.jpg|/uploads/admin/15561097505970.jpg|', '/uploads/admin/15560342884390.xls', '/uploads/admin/15560344448657.jpg', '0.00', '2', '1,2', '测试内容1123', '1556121600', '<img src=\"/uploads/admin/201904241108376973.jpg\" alt=\"\" />测试内容', '<p>sdsdsdsd</p>', '12.00', '#e50e0e', null, '湖北省', '鄂州市', '');
INSERT INTO `cd_ext_case` VALUES ('6', '29', null, '', '', '', '/uploads/admin/15561972834250.jpg', '0.00', '0', '1', '文本测试', '1555084800', 'dsdsds', '<p>dfdf</p>', '0.00', '', null, '江西省', '宜春市', '铜鼓县');
INSERT INTO `cd_ext_case` VALUES ('7', '36', null, '', '', '', '', '0.00', '0', '', '', '0', '', '', '0.00', '', null, '', '', '');
INSERT INTO `cd_ext_case` VALUES ('8', '66', null, '描述信息测试1111', '/uploads/admin/15566161319954.jpg|/uploads/admin/15566161316825.jpg|', '', '/uploads/admin/15566161242802.jpg', '0.00', '1', '', '测试内容文本域', '1558972800', '编辑器内容1', '<p><span style=\"font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);\">编辑器内容2</span></p>', '0.00', '#999999', null, '湖北省', '恩施土家族苗族自治州', '来凤县');
INSERT INTO `cd_ext_case` VALUES ('9', '65', null, '', '', '', '', '0.00', '0', '', '', '0', '', '', '0.00', '', null, '', '', '');
INSERT INTO `cd_ext_case` VALUES ('10', '64', null, '', '', '', '', '0.00', '0', '', '', '0', '', '', '0.00', '', null, '', '', '');
INSERT INTO `cd_ext_case` VALUES ('11', '62', null, '', '', '', '', '0.00', '0', '', '', '0', '', '', '0.00', '', null, '', '', '');
INSERT INTO `cd_ext_case` VALUES ('12', '61', null, '', '', '', '', '0.00', '0', '', '', '0', '', '', '0.00', '', null, '', '', '');
INSERT INTO `cd_ext_case` VALUES ('13', '60', null, '', '', '', '', '0.00', '0', '', '', '0', '', '', '0.00', '', null, '', '', '');
INSERT INTO `cd_ext_case` VALUES ('14', '58', null, '', '', '', '', '0.00', '0', '', '', '0', '', '', '0.00', '', null, '', '', '');
INSERT INTO `cd_ext_case` VALUES ('15', '57', null, '', '', '', '', '0.00', '0', '', '', '0', '', '', '0.00', '', null, '', '', '');
INSERT INTO `cd_ext_case` VALUES ('16', '72', null, '描述信息测试1111', '', '', '/uploads/admin/15566831357955.jpg', '10.00', '2', '', '测试内容', '1556683117', '', '', '0.00', '', null, '', '', '');

-- ----------------------------
-- Table structure for `cd_ext_feedbook`
-- ----------------------------
DROP TABLE IF EXISTS `cd_ext_feedbook`;
CREATE TABLE `cd_ext_feedbook` (
  `data_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) DEFAULT NULL,
  `mobil` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `qq` varchar(250) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `thumb` varchar(250) DEFAULT NULL,
  `images` text,
  `sex` tinyint(4) DEFAULT NULL,
  `detail` text,
  `time` int(10) DEFAULT NULL,
  PRIMARY KEY (`data_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_ext_feedbook
-- ----------------------------
INSERT INTO `cd_ext_feedbook` VALUES ('2', '何应敏', '13545028471', '274363574@qq.com', '274363574', '湖北武汉', '', '', '2', '<p>测试内容</p>', '1555257600');
INSERT INTO `cd_ext_feedbook` VALUES ('3', '赵莎莎', '13545028471', '274363574@qq.com', '274363574', '鄂城区泽林镇', '/uploads/admin/15561193383506.jpg', '/uploads/admin/15561193421265.jpg|/uploads/admin/15561193423887.jpg|', '1', '<p>测试内容</p>', '1556208000');
INSERT INTO `cd_ext_feedbook` VALUES ('4', '艾一方', '13545028471', '274363574@qq.com', '67766767', '鄂城区泽林镇', '/uploads/admin/15561191894447.jpg', '/uploads/admin/15561191945719.jpg|/uploads/admin/15561191943400.jpg|/uploads/admin/15561191932511.jpg|', '2', '<p>测试内容</p>', '1546302770');

-- ----------------------------
-- Table structure for `cd_ext_pro`
-- ----------------------------
DROP TABLE IF EXISTS `cd_ext_pro`;
CREATE TABLE `cd_ext_pro` (
  `data_id` int(10) NOT NULL AUTO_INCREMENT,
  `content_id` int(100) DEFAULT NULL,
  `images` text,
  `thumb` varchar(250) DEFAULT NULL,
  `copyfrom` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`data_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_ext_pro
-- ----------------------------
INSERT INTO `cd_ext_pro` VALUES ('1', '69', '/uploads/admin/15561974668031.jpg|', '/uploads/admin/15560893258682.jpg', 'admin');
INSERT INTO `cd_ext_pro` VALUES ('2', '14', '/uploads/admin/15561975022371.jpg|', '/uploads/admin/15561975053977.jpg', null);
INSERT INTO `cd_ext_pro` VALUES ('3', '70', '/uploads/admin/15562952088667.jpg|/uploads/admin/15562952071453.jpg|', '/uploads/admin/15562952174067.jpg', 'admin');
INSERT INTO `cd_ext_pro` VALUES ('4', '23', '/uploads/admin/15565176699707.jpg|', '/uploads/admin/15565179374615.jpg', '');

-- ----------------------------
-- Table structure for `cd_ext_test`
-- ----------------------------
DROP TABLE IF EXISTS `cd_ext_test`;
CREATE TABLE `cd_ext_test` (
  `data_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `description` text,
  `thumb` varchar(250) DEFAULT NULL,
  `content` text,
  `create_time` int(10) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`data_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_ext_test
-- ----------------------------
INSERT INTO `cd_ext_test` VALUES ('1', '这是一条测试信息表单是后台生成的', '表单无需开发开后生成  内置17种表单输入框', '/uploads/admin/15562888622480.jpg', '进入模型管理即可自定义表单 内置17种输入框', '1556288888', '0');

-- ----------------------------
-- Table structure for `cd_extend`
-- ----------------------------
DROP TABLE IF EXISTS `cd_extend`;
CREATE TABLE `cd_extend` (
  `extend_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `table_name` varchar(250) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `sortid` tinyint(4) DEFAULT NULL COMMENT '排序',
  `action` varchar(50) DEFAULT NULL COMMENT '操作方法',
  `orderby` varchar(50) DEFAULT NULL COMMENT '默认排序',
  PRIMARY KEY (`extend_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_extend
-- ----------------------------
INSERT INTO `cd_extend` VALUES ('23', '测试模型 所有字段测试', 'case', '10', '1', '100', '', '');
INSERT INTO `cd_extend` VALUES ('24', '产品', 'pro', '10', '1', '100', null, null);
INSERT INTO `cd_extend` VALUES ('25', '测试表单', 'feedbook', '10', '2', '100', 'add,update,delete,view,dumpData', '');
INSERT INTO `cd_extend` VALUES ('27', '在线报名', 'baoming', '10', '2', '100', 'add,update,delete,view,dumpData', 'scool desc');
INSERT INTO `cd_extend` VALUES ('28', '自建表单', 'test', '10', '2', '101', 'add,update,delete,view', '');
INSERT INTO `cd_extend` VALUES ('29', '用户留言', 'book', '10', '2', '100', 'update,delete,view,dumpData,importData', '');

-- ----------------------------
-- Table structure for `cd_field`
-- ----------------------------
DROP TABLE IF EXISTS `cd_field`;
CREATE TABLE `cd_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `extend_id` int(9) NOT NULL COMMENT '模块ID',
  `name` varchar(64) NOT NULL COMMENT '字段名称',
  `field` varchar(32) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '表单类型1输入框 2下拉框 3单选框 4多选框 5上传图片 6编辑器 7时间',
  `list_show` tinyint(4) NOT NULL COMMENT '列表显示',
  `align` varchar(12) DEFAULT NULL,
  `is_search` tinyint(4) DEFAULT NULL COMMENT '是否搜索',
  `config` varchar(255) DEFAULT NULL COMMENT '下拉框或者单选框默认值',
  `note` varchar(255) DEFAULT NULL COMMENT '提示信息',
  `message` varchar(255) DEFAULT NULL COMMENT '错误提示',
  `validate` varchar(32) DEFAULT NULL COMMENT '验证方式',
  `rule` mediumtext COMMENT '验证规则',
  `sortid` mediumint(9) DEFAULT '0' COMMENT '排序号',
  `default_value` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `extend_id` (`extend_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=672 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_field
-- ----------------------------
INSERT INTO `cd_field` VALUES ('619', '23', '缩略图', 'thumb', '8', '1', null, null, '', '', '', '', '', '1', '', '1');
INSERT INTO `cd_field` VALUES ('615', '23', '价格', 'price', '1', '1', null, null, '', '', '', '', '', '2', '', '0');
INSERT INTO `cd_field` VALUES ('616', '23', '描述', 'des', '1', '1', null, null, '', '', '', '', '', '3', '', '1');
INSERT INTO `cd_field` VALUES ('617', '23', '图集', 'images', '9', '1', null, null, '', '', '', '', '', '4', '', '1');
INSERT INTO `cd_field` VALUES ('618', '23', '附件', 'files', '10', '1', null, null, '', '', '', '', '', '5', '', '1');
INSERT INTO `cd_field` VALUES ('620', '23', '市场价', 'markt_price', '13', '1', null, null, '', '', '', '', '', '6', '10', '1');
INSERT INTO `cd_field` VALUES ('621', '23', '性别', 'sex', '2', '1', null, null, '男|1,女|2', '', '', '', '', '7', '2', '1');
INSERT INTO `cd_field` VALUES ('622', '23', '标识', 'flah', '4', '1', null, null, '推荐|1,置顶|2', '', '', '', '', '8', '', '1');
INSERT INTO `cd_field` VALUES ('623', '23', '文本域', 'wb', '6', '1', null, null, '', '', '', '', '', '9', '', '1');
INSERT INTO `cd_field` VALUES ('624', '23', '日期', 'datetime', '7', '1', null, null, '', '', '', '', '', '10', '', '1');
INSERT INTO `cd_field` VALUES ('625', '23', 'xheditor', 'xheditor', '11', '1', null, null, '', '', '', '', '', '11', '', '1');
INSERT INTO `cd_field` VALUES ('626', '23', '百度编辑器', 'ueditor', '16', '1', null, null, '', '', '', '', '', '12', '', '1');
INSERT INTO `cd_field` VALUES ('627', '23', '货币', 'money', '13', '1', null, null, '', '', '', '', '', '13', '', '1');
INSERT INTO `cd_field` VALUES ('629', '23', '颜色选择器', 'color', '18', '1', null, null, '', '', '', '', '', '14', '', '1');
INSERT INTO `cd_field` VALUES ('631', '23', '三级联动', 'province|city|district', '17', '1', null, null, '', '', '', '', '', '15', '', '1');
INSERT INTO `cd_field` VALUES ('635', '24', '图集', 'images', '9', '1', '', '1', '', '', '', 'notEmpty', '', '636', '', '1');
INSERT INTO `cd_field` VALUES ('636', '24', '缩略图', 'thumb', '8', '1', null, null, '', '', '', '', '', '654', '', '1');
INSERT INTO `cd_field` VALUES ('637', '25', '姓名', 'username', '1', '1', '', '1', '', '', '', 'notEmpty', '', '637', '', '1');
INSERT INTO `cd_field` VALUES ('638', '25', '电话', 'mobil', '1', '1', '', '1', '', '', '', '', '', '638', '', '1');
INSERT INTO `cd_field` VALUES ('639', '25', '邮箱', 'email', '1', '1', '', '1', '', '', '', '', '', '639', '', '1');
INSERT INTO `cd_field` VALUES ('640', '25', 'qq', 'qq', '1', '1', '', '1', '', '', '', '', '', '640', '', '1');
INSERT INTO `cd_field` VALUES ('641', '25', '住址', 'address', '1', '1', '', '0', '', '', '', '', '', '641', '', '1');
INSERT INTO `cd_field` VALUES ('642', '25', '缩略图', 'thumb', '8', '1', 'center', '0', '', '', '', '', '', '642', '', '1');
INSERT INTO `cd_field` VALUES ('643', '25', '图集', 'images', '9', '0', '', '0', '', '', '', '', '', '643', '', '1');
INSERT INTO `cd_field` VALUES ('644', '25', '性别', 'sex', '2', '1', 'center', '1', '男|1|primary,女|2|success', '', '', '', '', '644', '1', '1');
INSERT INTO `cd_field` VALUES ('647', '25', '日期', 'time', '7', '1', '', '0', '', '', '', '', '', '647', '', '1');
INSERT INTO `cd_field` VALUES ('645', '0', '详情', 'detail', '11', '0', null, null, '', '', '', '', '', '645', '', '1');
INSERT INTO `cd_field` VALUES ('646', '25', '详情', 'detail', '16', '0', '', '0', '', '', '', '', '', '646', '', '1');
INSERT INTO `cd_field` VALUES ('648', '27', '姓名', 'A', '1', '1', '', '1', '', '', '', 'notEmpty', '', '648', '', '1');
INSERT INTO `cd_field` VALUES ('649', '27', '电话', 'mobil', '1', '1', 'center', '1', '', '', '手机号格式错误', '', '/^1[34578]\\d{9}$/', '649', '', '1');
INSERT INTO `cd_field` VALUES ('650', '27', '高中就读学校', 'school', '1', '1', 'center', '1', '', '', '', '', '', '650', '', '1');
INSERT INTO `cd_field` VALUES ('651', '27', '高考成绩', 'scool', '1', '1', 'center', '1', 'primary', '', '', '', '', '651', '', '1');
INSERT INTO `cd_field` VALUES ('652', '27', '身份证', 'sfz', '8', '0', '', '1', '', '', '', '', '', '652', '', '1');
INSERT INTO `cd_field` VALUES ('653', '27', '创建时间', 'create_time', '12', '1', '', '1', '', '', '', '', '', '660', '', '1');
INSERT INTO `cd_field` VALUES ('654', '24', '来源', 'copyfrom', '1', '1', '', '1', '', '', '', '', '', '635', '', '1');
INSERT INTO `cd_field` VALUES ('666', '29', '姓名', 'username', '1', '1', '', '1', '', '', '', 'notEmpty', '', '666', '', '1');
INSERT INTO `cd_field` VALUES ('655', '27', '家庭住址', 'addr', '1', '1', '', '1', '', '', '', '', '', '655', '', '1');
INSERT INTO `cd_field` VALUES ('656', '27', '父母姓名', 'relname', '1', '1', '', '0', '', '', '', '', '', '656', '', '1');
INSERT INTO `cd_field` VALUES ('657', '27', '性别', 'sex', '3', '1', '', '1', '男|1,女|2', '', '', '', '', '657', '', '1');
INSERT INTO `cd_field` VALUES ('658', '27', '省市区', 'province|city|district', '17', '1', '', '1', '', '', '', '', '', '658', '', '1');
INSERT INTO `cd_field` VALUES ('659', '27', '附件', 'files', '10', '1', '', '0', '', '', '', '', '', '659', '', '1');
INSERT INTO `cd_field` VALUES ('660', '28', '标题', 'title', '1', '1', '', '1', '', '', '', '', '', '660', '', '1');
INSERT INTO `cd_field` VALUES ('661', '28', '描述', 'description', '6', '1', '', '1', '', '', '', '', '', '661', '', '1');
INSERT INTO `cd_field` VALUES ('662', '28', '缩略图', 'thumb', '8', '1', '', '0', '', '', '', '', '', '662', '', '1');
INSERT INTO `cd_field` VALUES ('663', '28', '内容', 'content', '11', '0', '', '0', '', '', '', '', '', '663', '', '1');
INSERT INTO `cd_field` VALUES ('664', '28', '创建时间', 'create_time', '12', '1', '', '1', '', '', '', '', '', '664', '', '1');
INSERT INTO `cd_field` VALUES ('665', '28', '状态', 'status', '3', '1', '', '1', '正常|10|primary,禁用|0|danger', '', '', '', '', '665', '', '1');
INSERT INTO `cd_field` VALUES ('667', '29', '电子邮件', 'email', '1', '1', '', '1', '', '', '', '', '', '667', '', '1');
INSERT INTO `cd_field` VALUES ('668', '29', 'qq', 'qq', '1', '1', '', '1', '', '', '', '', '', '668', '', '1');
INSERT INTO `cd_field` VALUES ('669', '29', '留言内容', 'content', '6', '1', '', '1', '', '', '', '', '', '669', '', '1');
INSERT INTO `cd_field` VALUES ('670', '29', '留言时间', 'create_time', '12', '1', '', '1', '', '', '', '', '', '671', '', '1');
INSERT INTO `cd_field` VALUES ('671', '29', 'IP', 'ip', '20', '1', '', '0', '', '', '', '', '', '670', '', '1');

-- ----------------------------
-- Table structure for `cd_frament`
-- ----------------------------
DROP TABLE IF EXISTS `cd_frament`;
CREATE TABLE `cd_frament` (
  `frament_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `pic` varchar(250) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`frament_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_frament
-- ----------------------------
INSERT INTO `cd_frament` VALUES ('1', '首页简介', null, '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;深圳市XXXX电子有限公司办公室地址位于中国个经济特区，鹏城深圳，深圳深圳市福田区福虹路华强花园11栋602，于2014年03月03日在深圳市市场监督管理局注册...<a href=\"/html/gongsijianjie\">详细&gt;&gt;</a></p>');
INSERT INTO `cd_frament` VALUES ('2', '底部版权', null, '<span style=\"color: rgb(25, 25, 25); font-family: \" microsoft=\"\" yahei=\"\" arial=\"\" helvetica=\"\" sans-serif=\"\" text-align:=\"\" center=\"\">Copyright 2005-2019 武汉XXXXX电子有限公司 技术支持:寒塘冷月 qq:274363574 All rights reserved</span><br />');
INSERT INTO `cd_frament` VALUES ('3', '首页联系我们', null, '<div style=\"padding-left:20px;\"><p><strong>XX有好数电子商务有限公司</strong></p><p>地址：江苏南京市玄武区东大科技园1号楼</p><p>邮编：210018</p><p>电话：025 8472087119</p><p>网址：<a href=\"http://www.xhadmin.com\" target=\"_blank\">www.xhadmin.com</a></p></div>');

-- ----------------------------
-- Table structure for `cd_group`
-- ----------------------------
DROP TABLE IF EXISTS `cd_group`;
CREATE TABLE `cd_group` (
  `group_id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(36) DEFAULT NULL COMMENT '分组名称',
  `status` tinyint(4) DEFAULT NULL COMMENT '状态 10正常 0禁用',
  `role` tinyint(4) DEFAULT NULL COMMENT '角色类别 1超级管理员 2普通管理员',
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_group
-- ----------------------------
INSERT INTO `cd_group` VALUES ('1', '超级管理员', '10', '1');
INSERT INTO `cd_group` VALUES ('2', '运营人员', '10', '2');

-- ----------------------------
-- Table structure for `cd_hook`
-- ----------------------------
DROP TABLE IF EXISTS `cd_hook`;
CREATE TABLE `cd_hook` (
  `hook_id` int(10) NOT NULL AUTO_INCREMENT,
  `hook_name` varchar(250) DEFAULT NULL,
  `description` text,
  `status` tinyint(4) DEFAULT NULL,
  `sortid` varchar(250) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`hook_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_hook
-- ----------------------------
INSERT INTO `cd_hook` VALUES ('3', 'view_big_pic', '图片预览', '10', '3', '1555249194');

-- ----------------------------
-- Table structure for `cd_link`
-- ----------------------------
DROP TABLE IF EXISTS `cd_link`;
CREATE TABLE `cd_link` (
  `link_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `jumpurl` varchar(250) DEFAULT NULL,
  `catagory_id` tinyint(4) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  `sortid` varchar(250) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`link_id`),
  KEY `catagory_id` (`catagory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_link
-- ----------------------------
INSERT INTO `cd_link` VALUES ('8', '百度', 'http://www.baidu.com', '2', '1556094364', '100', '1', '10');
INSERT INTO `cd_link` VALUES ('9', '新浪', 'http://www.baidu.com', '1', '1556094375', '100', '1', '10');
INSERT INTO `cd_link` VALUES ('10', '腾讯', 'http://www.baidu.com', '1', '1556094394', '102', '2', '10');

-- ----------------------------
-- Table structure for `cd_link_catagory`
-- ----------------------------
DROP TABLE IF EXISTS `cd_link_catagory`;
CREATE TABLE `cd_link_catagory` (
  `catagory_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `sortid` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`catagory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_link_catagory
-- ----------------------------
INSERT INTO `cd_link_catagory` VALUES ('1', '默认分类', '100');
INSERT INTO `cd_link_catagory` VALUES ('2', '底部链接', '2');

-- ----------------------------
-- Table structure for `cd_log`
-- ----------------------------
DROP TABLE IF EXISTS `cd_log`;
CREATE TABLE `cd_log` (
  `log_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `username` varchar(250) DEFAULT NULL,
  `event` varchar(250) DEFAULT NULL,
  `ip` varchar(250) DEFAULT NULL,
  `time` int(10) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_log
-- ----------------------------
INSERT INTO `cd_log` VALUES ('4', '1', 'admin', '用户登录', '127.0.0.1', '1556096526');
INSERT INTO `cd_log` VALUES ('5', '6', 'zhaosha', '用户登录', '127.0.0.1', '1556102140');
INSERT INTO `cd_log` VALUES ('6', '1', 'admin', '用户登录', '127.0.0.1', '1556102187');
INSERT INTO `cd_log` VALUES ('27', '2', 'test01', '用户登录', '127.0.0.1', '1556366799');
INSERT INTO `cd_log` VALUES ('28', '1', 'admin', '用户登录', '127.0.0.1', '1556366828');
INSERT INTO `cd_log` VALUES ('29', '1', 'admin', '用户登录', '127.0.0.1', '1556437027');
INSERT INTO `cd_log` VALUES ('30', '1', 'admin', '用户登录', '127.0.0.1', '1556437360');
INSERT INTO `cd_log` VALUES ('31', '1', 'admin', '用户登录', '127.0.0.1', '1556441797');
INSERT INTO `cd_log` VALUES ('32', '2', 'test01', '用户登录', '127.0.0.1', '1556515814');
INSERT INTO `cd_log` VALUES ('33', '1', 'admin', '用户登录', '127.0.0.1', '1556515848');
INSERT INTO `cd_log` VALUES ('34', '2', 'test01', '用户登录', '127.0.0.1', '1556515885');
INSERT INTO `cd_log` VALUES ('35', '1', 'admin', '用户登录', '127.0.0.1', '1556515994');
INSERT INTO `cd_log` VALUES ('36', '2', 'test01', '用户登录', '127.0.0.1', '1556516392');
INSERT INTO `cd_log` VALUES ('37', '1', 'admin', '用户登录', '127.0.0.1', '1556516540');
INSERT INTO `cd_log` VALUES ('38', '1', 'admin', '用户登录', '127.0.0.1', '1556516580');
INSERT INTO `cd_log` VALUES ('39', '2', 'test01', '用户登录', '127.0.0.1', '1556516730');
INSERT INTO `cd_log` VALUES ('40', '1', 'admin', '用户登录', '127.0.0.1', '1556516771');
INSERT INTO `cd_log` VALUES ('41', '1', 'admin', '用户登录', '127.0.0.1', '1556614256');
INSERT INTO `cd_log` VALUES ('42', '1', 'admin', '用户登录', '127.0.0.1', '1556614332');
INSERT INTO `cd_log` VALUES ('43', '2', 'test01', '用户登录', '127.0.0.1', '1556622005');
INSERT INTO `cd_log` VALUES ('44', '1', 'admin', '用户登录', '127.0.0.1', '1556622126');
INSERT INTO `cd_log` VALUES ('45', '1', 'admin', '用户登录', '127.0.0.1', '1556774819');
INSERT INTO `cd_log` VALUES ('46', '2', 'test01', '用户登录', '127.0.0.1', '1556774949');
INSERT INTO `cd_log` VALUES ('47', '1', 'admin', '用户登录', '127.0.0.1', '1556774978');
INSERT INTO `cd_log` VALUES ('48', '2', 'test01', '用户登录', '127.0.0.1', '1556788360');
INSERT INTO `cd_log` VALUES ('49', '1', 'admin', '用户登录', '127.0.0.1', '1556788939');
INSERT INTO `cd_log` VALUES ('50', '1', 'admin', '用户登录', '127.0.0.1', '1556813470');
INSERT INTO `cd_log` VALUES ('51', '1', 'admin', '用户登录', '127.0.0.1', '1556855061');
INSERT INTO `cd_log` VALUES ('52', '1', 'admin', '用户登录', '127.0.0.1', '1557145343');
INSERT INTO `cd_log` VALUES ('53', '1', 'admin', '用户登录', '127.0.0.1', '1557192329');

-- ----------------------------
-- Table structure for `cd_member`
-- ----------------------------
DROP TABLE IF EXISTS `cd_member`;
CREATE TABLE `cd_member` (
  `m_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `mobil` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `headimgurl` varchar(250) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  `relname` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `province` varchar(250) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `district` varchar(250) DEFAULT NULL,
  `color` varchar(250) DEFAULT NULL,
  `longitude` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_member
-- ----------------------------
INSERT INTO `cd_member` VALUES ('8', 'zhangsan', '1', '13545098710', '274363574@qq.com', '/uploads/admin/15569700014027.jpg', '10', '1554822476', '张三', null, '111.00', '内蒙古自治区', '鄂尔多斯市', '杭锦旗', '', '');
INSERT INTO `cd_member` VALUES ('9', 'lisi', '2', '13545089761', '274363574@qq.com', '/uploads/admin/15569700014027.jpg', '10', '1554779499', '李四', null, '0.00', '山东省', '德州市', '夏津县', null, null);
INSERT INTO `cd_member` VALUES ('10', '梦笑曾经', '1', '13545028471', '274363574@qq.com', '/uploads/admin/15569700014027.jpg', '10', '1554822464', '张三', null, '102.00', '安徽省', '亳州市', '谯城区', '#565656', '{\"longitude\":114.290324,\"latitude\":30.5825,\"address\":\"湖北省武汉市江岸区大智街街道港澳中心武汉帝盛酒店\"}');
INSERT INTO `cd_member` VALUES ('11', '寒塘冷月', '1', '13545028471', '274363574@qq.com', '/uploads/admin/15569700014027.jpg', '10', '1554866985', '吴城', '7f6ffaa6bb0b408017b62254211691b5', '8.00', '江西省', '吉安市', '遂川县', '#f61e1e', '{\"longitude\":114.297834,\"latitude\":30.588522,\"address\":\"湖北省武汉市江岸区一元街街道武汉市中医医院\"}');

-- ----------------------------
-- Table structure for `cd_node`
-- ----------------------------
DROP TABLE IF EXISTS `cd_node`;
CREATE TABLE `cd_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `val` varchar(255) NOT NULL,
  `pid` int(4) NOT NULL,
  `sortid` int(4) NOT NULL,
  `status` tinyint(4) DEFAULT '10' COMMENT '状态',
  `is_menu` tinyint(4) DEFAULT NULL,
  `icon` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=264 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_node
-- ----------------------------
INSERT INTO `cd_node` VALUES ('136', '会员管理', '/admin/Member', '0', '1', '10', '1', 'fa fa-user');
INSERT INTO `cd_node` VALUES ('137', '添加', '/admin/Member/add', '136', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('138', '修改', '/admin/Member/update', '138', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('139', '充值', '/admin/Member/recharge', '136', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('140', '回收', '/admin/Member/backRecharge', '136', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('177', '会员列表', '/admin/Member/index', '136', '98', '10', null, null);
INSERT INTO `cd_node` VALUES ('141', '删除', '/admin/Member/delete', '136', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('142', '禁用', '/admin/Member/forbidden', '136', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('143', '启用', '/admin/Member/start', '136', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('144', '重置密码', '/admin/Member/updatePassword', '136', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('145', '批量修改', '/admin/Member/batchUpdate', '136', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('146', '查看数据', '/admin/Member/viewMember', '136', '99', '10', null, null);
INSERT INTO `cd_node` VALUES ('147', 'cms管理', '/admin/Cms', '0', '2', '10', '1', '');
INSERT INTO `cd_node` VALUES ('148', '栏目管理', '/admin/Catagory', '147', '100', '10', '1', '');
INSERT INTO `cd_node` VALUES ('149', '内容管理', '/admin/Content', '147', '100', '10', '1', '');
INSERT INTO `cd_node` VALUES ('150', '碎片管理', '/admin/Frament', '147', '100', '10', '1', '');
INSERT INTO `cd_node` VALUES ('151', '推荐位置管理', '/admin/Position', '147', '100', '10', '1', '');
INSERT INTO `cd_node` VALUES ('152', '友情链接管理', '/admin/Linkcatagory', '152', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('153', '友情链接管理分类', '/admin/Linkcatagory', '250', '100', '10', '1', '');
INSERT INTO `cd_node` VALUES ('154', '友情连接管理', '/admin/Link', '250', '100', '10', '1', '');
INSERT INTO `cd_node` VALUES ('155', '添加', '/admin/Link/add', '154', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('156', '修改', '/admin/Link/update', '154', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('157', '删除', '/admin/Link/delete', '154', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('158', '添加', '/admin/Linkcatagory/add', '153', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('159', '修改', '/admin/Linkcatagory/update', '153', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('160', '删除', '/admin/Linkcatagory/delete', '153', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('161', '添加', '/admin/Position/add', '151', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('162', '修改', '/admin/Position/update', '151', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('163', '删除', '/admin/Position/delete', '151', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('164', '添加', '/admin/Frament/add', '150', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('165', '修改', '/admin/Frament/update', '150', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('166', '删除', '/admin/Frament/delete', '150', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('167', '添加', '/admin/Content/add', '149', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('168', '修改', '/admin/Content/update', '168', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('169', '删除', '/admin/Content/delete', '149', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('170', '修改', '/admin/Content/update', '149', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('171', '设置排序', '/admin/Content/updateSort', '149', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('172', '文章移动', '/admin/Content/move', '149', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('173', '设置推荐位', '/admin/Content/setPosition', '149', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('174', '删除推荐位', '/admin/Content/delPosition', '149', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('175', '文章发布草稿', '/admin/Content/setStatus', '149', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('176', '文章列表', '/admin/Content/index', '149', '99', '10', null, null);
INSERT INTO `cd_node` VALUES ('179', '碎片列表', '/admin/Frament/index', '150', '99', '10', null, null);
INSERT INTO `cd_node` VALUES ('180', '友情链接管理列表', '/admin/Linkcatagory/index', '153', '99', '10', null, null);
INSERT INTO `cd_node` VALUES ('181', '友情链接列表', '/admin/Link/index', '154', '99', '10', null, null);
INSERT INTO `cd_node` VALUES ('182', '设置排序', '/admin/Link/updateSort', '154', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('183', '栏目列表', '/admin/Catagory/index', '148', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('184', '添加', '/admin/Catagory/add', '148', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('185', '修改', '/admin/Catagory/update', '148', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('186', '删除', '/admin/Catagory/delete', '148', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('187', '设置排序', '/admin/Catagory/updateSort', '148', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('188', '移动排序', '/admin/Catagory/setSort', '148', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('189', '模型管理', '/admin/Extend', '0', '4', '10', '1', '');
INSERT INTO `cd_node` VALUES ('190', '字段管理', '/admin/Field', '0', '5', '10', null, null);
INSERT INTO `cd_node` VALUES ('191', '模型列表', '/admin/Extend/index', '189', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('192', '添加', '/admin/Extend/add', '189', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('193', '修改', '/admin/Extend/update', '189', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('194', '删除', '/admin/Extend/delete', '189', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('195', '设置排序', '/admin/Extend/updateSort', '189', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('196', '字段列表', '/admin/Field/index', '190', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('197', '添加', '/admin/Field/add', '190', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('198', '修改', '/admin/Field/update', '190', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('199', '删除', '/admin/Field/delete', '190', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('200', '设置排序', '/admin/Field/updateSort', '190', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('201', '上下移动排序', '/admin/Field/setSort', '190', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('202', '插件管理', '/admin/Chajian', '0', '100', '10', '1', '');
INSERT INTO `cd_node` VALUES ('203', '钩子管理', '/admin/Hook', '202', '100', '10', '1', '');
INSERT INTO `cd_node` VALUES ('204', '插件管理', '/admin/Plugins', '202', '100', '10', '1', '');
INSERT INTO `cd_node` VALUES ('205', '添加', '/admin/Hook/add', '203', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('206', '修改', '/admin/Hook/update', '203', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('207', '钩子列表', '/admin/Hook/index', '203', '99', '10', null, null);
INSERT INTO `cd_node` VALUES ('208', '删除', '/admin/Hook/delete', '203', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('209', '插件列表', '/admin/Plugins/index', '204', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('210', '添加', '//admin/Plugins/add', '204', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('211', '修改', '/admin/Plugins/update', '204', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('212', '删除', '/admin/Plugins/delete', '204', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('213', '系统管理', '/admin/Sys', '0', '100', '10', '1', 'fa fa-cogs');
INSERT INTO `cd_node` VALUES ('214', '用户管理', '/admin/User', '213', '100', '10', '1', 'fa fa-user-secret nav-icon');
INSERT INTO `cd_node` VALUES ('215', '分组管理', '/admin/Group', '213', '100', '10', '1', 'fa fa-user nav-icon');
INSERT INTO `cd_node` VALUES ('216', '操作节点', '/admin/Node', '213', '100', '10', '1', '');
INSERT INTO `cd_node` VALUES ('217', '登录日志', '/admin/Log', '213', '100', '10', '1', 'glyphicon glyphicon-log-in nav-icon');
INSERT INTO `cd_node` VALUES ('218', '系统配置', '/admin/Config', '213', '100', '10', '1', 'glyphicon glyphicon-cog nav-icon');
INSERT INTO `cd_node` VALUES ('219', '修改密码', '/admin/Base/password', '213', '100', '10', '1', 'fa fa-lock nav-icon');
INSERT INTO `cd_node` VALUES ('220', '数据备份', '/admin/Backup', '213', '100', '10', '1', 'fa fa-share nav-icon');
INSERT INTO `cd_node` VALUES ('221', '用户列表', '/admin/User/index', '214', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('222', '添加', '/admin/User/add', '214', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('223', '修改', '/admin/User/update', '214', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('224', '删除', '/admin/User/delete', '214', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('225', '修改密码', '/admin/User/updatePassword', '214', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('226', '分组列表', '/admin/Group/index', '215', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('227', '添加', '/admin/Group/add', '215', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('228', '修改', '/admin/Group/update', '215', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('229', '删除', '/admin/Group/delete', '215', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('230', '禁用', '/admin/Group/forbidden', '215', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('231', '启用', '/admin/Group/start', '215', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('232', '设置权限', '/admin/Base/auth', '215', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('233', '禁用', '/admin/User/forbidden', '214', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('234', '启用', '/admin/User/start', '214', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('235', '节点列表', '/admin/Node/index', '216', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('236', '添加', '/admin/Node/add', '216', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('237', '修改', '/admin/Node/update', '216', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('238', '删除', '/admin/Node/delete', '216', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('239', '日志列表', '/admin/Log/index', '217', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('240', '配置列表', '/admin/Config/index', '218', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('241', '修改密码', '/admin/Base/password', '219', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('242', '备份列表', '/admin/Backup/index', '220', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('243', '新建备份', '/admin/Backup/backupData', '220', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('244', '删除', '/admin/Backup/delete', '220', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('245', '数据列表', '/admin/Back/table', '220', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('246', '下载数据', '/admin/Backup/download', '220', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('247', '删除', '/admin/Log/delete', '217', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('250', '功能管理', '/admin/Function', '0', '3', '10', '1', '');
INSERT INTO `cd_node` VALUES ('251', '推荐位列表', '/admin/Position/index', '151', '99', '10', null, null);
INSERT INTO `cd_node` VALUES ('252', '静态化身成', '/admin/DoHtml', '0', '6', '10', '1', '');
INSERT INTO `cd_node` VALUES ('253', '生成首页', '/admin/DoHtml/doindex', '252', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('254', '生成列表页', '/admin/DoHtml/dolist', '252', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('255', '生成详情页', '/admin/DoHtml/doview', '252', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('256', '静态生成首页', '/admin/DoHtml/index', '252', '100', '10', null, null);
INSERT INTO `cd_node` VALUES ('257', '清除缓存', '/admin/Base/delCache', '213', '100', '10', '1', '');
INSERT INTO `cd_node` VALUES ('258', '表单管理', '/admin/FormData', '0', '3', '10', '1', '');
INSERT INTO `cd_node` VALUES ('259', '上传配置', '/admin/UploadConfig', '250', '100', '10', '1', 'fa fa-upload');
INSERT INTO `cd_node` VALUES ('260', '配置列表', '/admin/UploadConfig/index', '259', '100', '10', null, '');
INSERT INTO `cd_node` VALUES ('261', '添加配置', '/admin/UploadConfig/add', '259', '100', '10', '2', '');
INSERT INTO `cd_node` VALUES ('262', '修改配置', '/admin/UploadConfig/update', '259', '100', '10', '2', '');
INSERT INTO `cd_node` VALUES ('263', '删除配置', '/admin/UploadConfig/delete', '259', '100', '10', '2', '');

-- ----------------------------
-- Table structure for `cd_plugins`
-- ----------------------------
DROP TABLE IF EXISTS `cd_plugins`;
CREATE TABLE `cd_plugins` (
  `plugins_id` int(10) NOT NULL AUTO_INCREMENT,
  `plugins_name` varchar(250) DEFAULT NULL,
  `plugins_dir` varchar(250) DEFAULT NULL,
  `description` text,
  `version` varchar(250) DEFAULT NULL,
  `author` varchar(250) DEFAULT NULL,
  `hook_name` varchar(250) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`plugins_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_plugins
-- ----------------------------
INSERT INTO `cd_plugins` VALUES ('1', '图片预览', 'viewbigpic', '列表以及表单鼠标移动上去放大显示图片', '1.0.0', 'xhadmin', 'view_big_pic', '10', '3');

-- ----------------------------
-- Table structure for `cd_position`
-- ----------------------------
DROP TABLE IF EXISTS `cd_position`;
CREATE TABLE `cd_position` (
  `position_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `sortid` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_position
-- ----------------------------
INSERT INTO `cd_position` VALUES ('1', '推荐', '100');
INSERT INTO `cd_position` VALUES ('2', '热点', '100');

-- ----------------------------
-- Table structure for `cd_user`
-- ----------------------------
DROP TABLE IF EXISTS `cd_user`;
CREATE TABLE `cd_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(24) DEFAULT NULL COMMENT '姓名',
  `user` varchar(24) DEFAULT NULL COMMENT '登录用户名',
  `pwd` varchar(32) DEFAULT NULL COMMENT '登录密码',
  `group_id` tinyint(4) DEFAULT NULL COMMENT '所属分组ID',
  `type` tinyint(4) DEFAULT NULL COMMENT '账户类型 1超级管理员 2普通管理员',
  `note` varchar(128) DEFAULT NULL COMMENT '备注',
  `status` tinyint(4) DEFAULT NULL COMMENT '10正常 0禁用',
  `create_time` int(10) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cd_user
-- ----------------------------
INSERT INTO `cd_user` VALUES ('1', '寒塘冷月', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '1', '1', '超级管理员', '10', '1504862392');
INSERT INTO `cd_user` VALUES ('2', '张三', 'test01', 'e10adc3949ba59abbe56e057f20f883e', '2', '2', '运营人员', '10', '1527127947');
INSERT INTO `cd_user` VALUES ('4', '何应敏', 'chengdie', 'e10adc3949ba59abbe56e057f20f883e', '2', '2', '运营账户', '10', '1552301820');
