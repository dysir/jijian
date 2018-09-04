/*
Navicat MySQL Data Transfer

Source Server         : 192.168.1.116
Source Server Version : 50634
Source Host           : 192.168.1.116:3306
Source Database       : jijian

Target Server Type    : MYSQL
Target Server Version : 50634
File Encoding         : 65001

Date: 2018-09-04 17:12:06
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `create_log`
-- ----------------------------
DROP TABLE IF EXISTS `create_log`;
CREATE TABLE `create_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authname` varchar(255) DEFAULT NULL COMMENT '推荐权限名',
  `dirname` varchar(255) DEFAULT NULL COMMENT '推荐目录名',
  `table` varchar(255) DEFAULT NULL COMMENT '多个表名逗号隔开',
  `file` text COMMENT '多个文件名逗号隔开',
  `ctime` datetime DEFAULT NULL,
  `status` tinyint(2) DEFAULT '1' COMMENT '状态1正常  9 移除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of create_log
-- ----------------------------
INSERT INTO create_log VALUES ('13', '', '/test_goods/index', '', '/data/websideadmin/application/views/test_goods/index.php,/data/websideadmin/application/controllers/Test_goods.php,/data/websideadmin/application/models/Test_goods_model.php', '2018-04-24 14:12:52', '9');
INSERT INTO create_log VALUES ('14', '', '/dp_topic/index', '', '/data/jijian/application/admin/views/dp_topic/index.php,/data/jijian/application/admin/controllers/Dp_topic.php,/data/jijian/application/admin/models/Dp_topic_model.php', '2018-08-30 09:32:54', '1');
INSERT INTO create_log VALUES ('15', '', '/dp_article_description/index', '', '/data/jijian/application/admin/views/dp_article_description/index.php,/data/jijian/application/admin/controllers/Dp_article_description.php,/data/jijian/application/admin/models/Dp_article_description_model.php', '2018-09-01 08:51:45', '1');

-- ----------------------------
-- Table structure for `dp_article_centent`
-- ----------------------------
DROP TABLE IF EXISTS `dp_article_centent`;
CREATE TABLE `dp_article_centent` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章表',
  `article_id` bigint(14) NOT NULL COMMENT '文章表id 随机',
  `content` text,
  `markdown` text,
  `ctime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_id` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dp_article_centent
-- ----------------------------
INSERT INTO dp_article_centent VALUES ('10', '8172957631613', '<h2>1. JS的立即执行函数</h2><p>需要立即执行的代码放在一个匿名函数中并立即执行，可以隔离作用域<br/></p><pre class=\"brush:php;toolbar:false\">(functino(){\n\n&nbsp;&nbsp;&nbsp;&nbsp;//代码\n&nbsp;&nbsp;&nbsp;&nbsp;\n})()</pre><p>之所以用圆括号把function(){}括起来是因为js解释器会将function解释为函数声明，而函数声明不能直接跟着()，我们需要将其转换为函数表达式。然后()代表执行函数</p><h2>2. JS的闭包</h2><p>闭包其实并不复杂，就是普通的函数，因为js拥有两个特性</p><ol class=\" list-paddingleft-2\" style=\"list-style-type: decimal;\"><li><p>js函数可以访问 父级作用域</p></li><li><p>js函数返回值可以是函数<br/></p></li></ol><pre class=\"brush:php;toolbar:false\">function&nbsp;s1()\n{\n\n	var&nbsp;n=0;\n\n	function&nbsp;s2()\n	{\n\n		n+=1;\n\n		console.log(n);\n\n	}\n\n	return&nbsp;s2;\n\n}\n\nvar&nbsp;s3&nbsp;=&nbsp;s1();\n\ns3();&nbsp;//1\n\ns3();&nbsp;//2</pre><p>函数s1 返回值是函数s2&nbsp;</p><p>s1 执行一次完毕之后 ，初始化的 n不会被销毁</p><p>所以s2 每次执行都 n 会被叠加<br/></p><p><br/></p><h2>3. JS this</h2><p>函数中的this指向调用该函数对象的作用域，而非函数本身</p><pre class=\"brush:php;toolbar:false\">function&nbsp;s1()\n{\n	console.log(window==this);\n}\n\ns1();&nbsp;//true\n\nvar&nbsp;o&nbsp;=&nbsp;{\n\n	f:function()\n	{\n		console.log(o==this);\n	}\n\n}\n\no.f();&nbsp;//true\n\nfunction&nbsp;s2()\n{\n	this.f&nbsp;=&nbsp;function(){\n		return&nbsp;this;\n	}\n}\n\nvar&nbsp;o2&nbsp;=&nbsp;new&nbsp;s2();\n\nconsole.log(o2&nbsp;==&nbsp;o2.f());&nbsp;//true</pre><p>s1的调用等价于 window.s1 ，所以s1中的this指向全局对象window</p><p>构造函数s2中的this指向他的实例 o2 ，所以等价</p><h2>4. apply, call</h2><p>改变函数中this的指向</p><pre class=\"brush:php;toolbar:false\">function&nbsp;s1()\n{\n	this.name&nbsp;=&nbsp;&quot;s1&quot;;\n}\n\nfunction&nbsp;s2()\n{\n	this.name&nbsp;=&nbsp;&quot;s2&quot;;\n	this.fn&nbsp;=&nbsp;function()\n	{\n		console.log(this.name);\n	}\n}\n\nvar&nbsp;o1&nbsp;=&nbsp;new&nbsp;s1;\n\nvar&nbsp;o2&nbsp;=&nbsp;new&nbsp;s2;\n\no2.fn.call(o1);&nbsp;//&nbsp;输出&nbsp;s1\n\n\n//可以实现继承\nfunction&nbsp;s3()\n{\n	this.f3=function()\n	{\n		console.log(&quot;f3&quot;);\n	};\n}\n\nfunction&nbsp;s4()\n{\n	this.f4=function()\n	{\n		console.log(&quot;f4&quot;);\n	};\n}\n\n\nfunction&nbsp;f5()\n{\n	s3.call(this);\n	s4.call(this);\n}\n\nvar&nbsp;o5&nbsp;=&nbsp;new&nbsp;f5;\n\no5.f3();&nbsp;//输出&nbsp;f3\n\no5.f4();&nbsp;//输出&nbsp;f4</pre><p>实例o2的方法fn中的this 被指向 s1 的 实例 o1的上下文，所以输出s1&nbsp;</p><p>也可以实现继承</p><p>apply方法与call方法类似。两者唯一的不同点在于，apply方法使用数组指定参数，而call方法每个参数单独需要指定</p><h2>5. 模块化编程</h2><p>JavaScript并非模块化编程语言，至少ES6落地之前都不是。</p><p>然而对于一个复杂的Web应用，模块化编程是一个最基本的要求。</p><p>这时，可以使用立即执行函数来实现模块化，</p><p>正如很多JS库比如jQuery以及我们Fundebug都是这样实现的。</p><pre class=\"brush:php;toolbar:false\">var&nbsp;module&nbsp;=&nbsp;(function()&nbsp;{&nbsp;\n\n&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;N&nbsp;=&nbsp;5;&nbsp;\n&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;print(x)&nbsp;{&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;console.log(&quot;The&nbsp;result&nbsp;is:&nbsp;&quot;&nbsp;+&nbsp;x);&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;\n&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;add(a)&nbsp;{&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;x&nbsp;=&nbsp;a&nbsp;+&nbsp;N;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;print(x);&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;\n&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;{&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;description:&nbsp;&quot;This&nbsp;is&nbsp;description&quot;,&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;add:&nbsp;add&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;};\n&nbsp;&nbsp;&nbsp;&nbsp;\n})();&nbsp;\n&nbsp;\n&nbsp;\nconsole.log(module.description);&nbsp;//&nbsp;输出&quot;this&nbsp;is&nbsp;description&quot;&nbsp;&nbsp;\n&nbsp;\nmodule.add(5);&nbsp;//&nbsp;输出“The&nbsp;result&nbsp;is:&nbsp;10”</pre><p>所谓模块化，就是根据需要控制模块内属性与方法的可访问性，即私有或者公开。</p><p>在代码中，module为一个独立的模块，N为其私有属性，print为其私有方法，decription为其公有属性，add为其共有方法。</p><p><br/></p>', null, '2017-08-29 16:13:43');
INSERT INTO dp_article_centent VALUES ('11', '18090108413930', '<h3 id=\"h3-fa\"><a name=\"fa\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>fa</h3><p><h1><br>fdsaf<br>fdaf<br></h1></p>\n<pre><code>fdsalkfjl\nfdas\nfun\nchangefdksljlc\n</code></pre><ul>\n<li>fdsf</li><li>fsd</li></ul>\n', '###fa\n<h1>\nfdsaf\nfdaf\n</h1>\n```\nfdsalkfjl\nfdas\nfun\nchangefdksljlc\n```\n- fdsf\n- fsd\n', '2018-09-01 08:41:29');
INSERT INTO dp_article_centent VALUES ('12', '18090108487177', '<h3 id=\"h3-fa\"><a name=\"fa\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>fa</h3><p><h1><br>fdsaf<br>fdaf<br></h1></p>\n<pre><code>fdsalkfjl\nfdas\nfunc\n</code></pre>', '###fa\n<h1>\nfdsaf\nfdaf\n</h1>\n```\nfdsalkfjl\nfdas\nfunc\n```', '2018-09-01 08:48:23');
INSERT INTO dp_article_centent VALUES ('13', '18090408483864', '<p><h2><br>1.JS的立即执行函数<br></h2><br>需要立即执行的代码放在一个匿名函数中并立即执行，可以隔离作用域</p>\n<pre><code>(function(){\n     //代码\n})\n</code></pre><p>之所以用圆括号把function(){}括起来是因为js解释器会将function解释为函数声明，而函数声明不能直接跟着()，我们需要将其转换为函数表达式。然后()代表执行函数</p>\n<p><h2><br>2.JS的闭包<br></h2><br>闭包其实并不复杂，就是普通的函数，因为js拥有两个特性</p>\n<ul>\n<li>js函数可以访问 父级作用域</li><li>js函数返回值可以是函数<pre><code>function s1()\n{\n  var n=0;\n  function s2()\n  {\n      n+=1;\n      console.log(n);\n  }\n  return s2;\n}\nvar s3 = s1();\ns3(); //1\ns3(); //2\n</code></pre></li><li>函数s1 返回值是函数s2 </li><li>s1 执行一次完毕之后 ，初始化的 n不会被销毁</li><li>所以s2 每次执行都 n 会被叠加<br><h2><br>3.JS this<br></h2><br>函数中的this指向调用该函数对象的作用域，而非函数本身<pre><code>function s1()\n{\n  console.log(window==this);\n}\ns1(); //true\nvar o = {\n  f:function()\n  {\n      console.log(o==this);\n  }\n}\no.f(); //true\nfunction s2()\n{\n  this.f = function(){\n      return this;\n  }\n}\nvar o2 = new s2();\nconsole.log(o2 == o2.f()); //true\n</code></pre>s1的调用等价于 window.s1 ，所以s1中的this指向全局对象window<br>构造函数s2中的this指向他的实例 o2 ，所以等价</li></ul>\n<p><h2><br>4.apply, call<br></h2><br>改变函数中this的指向</p>\n<pre><code>function s1()\n{\n    this.name = &quot;s1&quot;;\n}\nfunction s2()\n{\n    this.name = &quot;s2&quot;;\n    this.fn = function()\n    {\n        console.log(this.name);\n    }\n}\nvar o1 = new s1;\nvar o2 = new s2;\no2.fn.call(o1); // 输出 s1\n//可以实现继承\nfunction s3()\n{\n    this.f3=function()\n    {\n        console.log(&quot;f3&quot;);\n    };\n}\nfunction s4()\n{\n    this.f4=function()\n    {\n        console.log(&quot;f4&quot;);\n    };\n}\nfunction f5()\n{\n    s3.call(this);\n    s4.call(this);\n}\nvar o5 = new f5;\no5.f3(); //输出 f3\no5.f4(); //输出 f4\n</code></pre><p>实例o2的方法fn中的this 被指向 s1 的 实例 o1的上下文，所以输出s1<br>也可以实现继承<br>apply方法与call方法类似。两者唯一的不同点在于，apply方法使用数组指定参数，而call方法每个参数单独需要指定</p>\n<p><h2><br>5.模块化编程<br></h2><br>JavaScript并非模块化编程语言，至少ES6落地之前都不是。<br>然而对于一个复杂的Web应用，模块化编程是一个最基本的要求。<br>这时，可以使用立即执行函数来实现模块化，<br>正如很多JS库比如jQuery以及我们Fundebug都是这样实现的</p>\n<pre><code>var module = (function() {\n    var N = 5;\n    function print(x) {\n        console.log(&quot;The result is: &quot; + x);\n    }\n    function add(a) {\n        var x = a + N;\n        print(x);\n    }\n    return {\n        description: &quot;This is description&quot;,\n        add: add\n    };\n})();\nconsole.log(module.description); // 输出&quot;this is description&quot;\nmodule.add(5); // 输出“The result is: 10”\n</code></pre><p>所谓模块化，就是根据需要控制模块内属性与方法的可访问性，即私有或者公开。</p>\n<p>在代码中，module为一个独立的模块，N为其私有属性，print为其私有方法，decription为其公有属性，add为其共有方法。</p>\n', '<h2>\n1.JS的立即执行函数\n</h2>\n需要立即执行的代码放在一个匿名函数中并立即执行，可以隔离作用域\n```\n(function(){\n 	//代码\n})\n```\n之所以用圆括号把function(){}括起来是因为js解释器会将function解释为函数声明，而函数声明不能直接跟着()，我们需要将其转换为函数表达式。然后()代表执行函数\n<h2>\n2.JS的闭包\n</h2>\n闭包其实并不复杂，就是普通的函数，因为js拥有两个特性\n- js函数可以访问 父级作用域\n- js函数返回值可以是函数\n```\nfunction s1()\n{\n	var n=0;\n	function s2()\n	{\n		n+=1;\n		console.log(n);\n	}\n	return s2;\n}\nvar s3 = s1();\ns3(); //1\ns3(); //2\n```\n- 函数s1 返回值是函数s2 \n- s1 执行一次完毕之后 ，初始化的 n不会被销毁\n- 所以s2 每次执行都 n 会被叠加\n<h2>\n3.JS this\n</h2>\n函数中的this指向调用该函数对象的作用域，而非函数本身\n```\nfunction s1()\n{\n	console.log(window==this);\n}\ns1(); //true\nvar o = {\n	f:function()\n	{\n		console.log(o==this);\n	}\n}\no.f(); //true\nfunction s2()\n{\n	this.f = function(){\n		return this;\n	}\n}\nvar o2 = new s2();\nconsole.log(o2 == o2.f()); //true\n```\ns1的调用等价于 window.s1 ，所以s1中的this指向全局对象window\n构造函数s2中的this指向他的实例 o2 ，所以等价\n\n<h2>\n4.apply, call\n</h2>\n改变函数中this的指向\n```\nfunction s1()\n{\n	this.name = \"s1\";\n}\nfunction s2()\n{\n	this.name = \"s2\";\n	this.fn = function()\n	{\n		console.log(this.name);\n	}\n}\nvar o1 = new s1;\nvar o2 = new s2;\no2.fn.call(o1); // 输出 s1\n//可以实现继承\nfunction s3()\n{\n	this.f3=function()\n	{\n		console.log(\"f3\");\n	};\n}\nfunction s4()\n{\n	this.f4=function()\n	{\n		console.log(\"f4\");\n	};\n}\nfunction f5()\n{\n	s3.call(this);\n	s4.call(this);\n}\nvar o5 = new f5;\no5.f3(); //输出 f3\no5.f4(); //输出 f4\n```\n实例o2的方法fn中的this 被指向 s1 的 实例 o1的上下文，所以输出s1 \n也可以实现继承\napply方法与call方法类似。两者唯一的不同点在于，apply方法使用数组指定参数，而call方法每个参数单独需要指定\n<h2>\n5.模块化编程\n</h2>\nJavaScript并非模块化编程语言，至少ES6落地之前都不是。\n然而对于一个复杂的Web应用，模块化编程是一个最基本的要求。\n这时，可以使用立即执行函数来实现模块化，\n正如很多JS库比如jQuery以及我们Fundebug都是这样实现的\n```\nvar module = (function() {\n    var N = 5;\n    function print(x) {\n        console.log(\"The result is: \" + x);\n    }\n    function add(a) {\n        var x = a + N;\n        print(x);\n    }\n    return {\n        description: \"This is description\",\n        add: add\n    };\n})();\nconsole.log(module.description); // 输出\"this is description\"\nmodule.add(5); // 输出“The result is: 10”\n```\n所谓模块化，就是根据需要控制模块内属性与方法的可访问性，即私有或者公开。\n\n在代码中，module为一个独立的模块，N为其私有属性，print为其私有方法，decription为其公有属性，add为其共有方法。', '2018-09-04 08:48:35');

-- ----------------------------
-- Table structure for `dp_article_description`
-- ----------------------------
DROP TABLE IF EXISTS `dp_article_description`;
CREATE TABLE `dp_article_description` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章表',
  `article_id` bigint(14) NOT NULL COMMENT '文章表id 随机',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `description` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `uid` bigint(20) DEFAULT NULL COMMENT '作者id',
  `uname` varchar(255) DEFAULT NULL COMMENT '作者名',
  `mtime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `ctime` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `comment_num` int(11) DEFAULT '0' COMMENT '评论数',
  `status` int(2) DEFAULT '1' COMMENT '1 未发布 2  发布 9  删除',
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_id` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dp_article_description
-- ----------------------------
INSERT INTO dp_article_description VALUES ('11', '8172957631613', 'JavaScript的一些难点', '1. JS的立即执行函数需要立即执行的代码放在一个匿名函数中并立即执行，可以隔离作用域(functino(){\n\n&nbsp;&nbsp;&nbsp;&nbsp;//代码\n&nbsp;&nbsp;&nbsp;&nbsp;\n})()之所以用圆括号把function(){}括起来是因为js解释器会将function解释为函数声明，而函数声明不能直接跟着()，我们需要将其转换为函数表达式。然后()代表执', '', '704171333275843', '冰山之下', '2018-09-04 16:51:43', '2017-08-29 16:13:43', '0', '9');
INSERT INTO dp_article_description VALUES ('12', '18090108413930', 'fdfsa11', 'fafdsaffdaf\nfdsalkfjl\nfdas\nfun\nchangefdksljlc\n\nfdsffsd', null, '38', '管理员', '2018-09-04 16:51:39', '2018-09-01 08:41:29', '0', '9');
INSERT INTO dp_article_description VALUES ('13', '18090108487177', 'fdfsa', 'fafdsaffdaf\nfdsalkfjl\nfdas\nfunc\n', null, '38', '管理员', '2018-09-03 18:02:50', '2018-09-01 08:48:23', '0', '9');
INSERT INTO dp_article_description VALUES ('14', '18090408483864', 'JavaScript的一些难点', '1.JS的立即执行函数需要立即执行的代码放在一个匿名函数中并立即执行，可以隔离作用域\n(function(){\n     //代码\n})\n之所以用圆括号把function(){}括起来是因为js解释器会将function解释为函数声明，而函数声明不能直接跟着()，我们需要将其转换为函数表达式。然后()代表执行函数\n2.JS的闭包闭包其实并不复杂，就是普通的函数，因为js拥有两个特性\n\njs函数可以', null, '38', '管理员', '2018-09-04 16:52:30', '2018-09-04 08:48:35', '0', '2');

-- ----------------------------
-- Table structure for `dp_article_link`
-- ----------------------------
DROP TABLE IF EXISTS `dp_article_link`;
CREATE TABLE `dp_article_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章表',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `tid` int(11) DEFAULT NULL,
  `ahtml` text,
  `amarkdown` text,
  `uid` bigint(20) DEFAULT NULL COMMENT '作者id',
  `mtime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `ctime` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dp_article_link
-- ----------------------------

-- ----------------------------
-- Table structure for `dp_article_topic`
-- ----------------------------
DROP TABLE IF EXISTS `dp_article_topic`;
CREATE TABLE `dp_article_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) DEFAULT NULL COMMENT '分类Id',
  `article_id` bigint(14) NOT NULL COMMENT '文章表id',
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dp_article_topic
-- ----------------------------
INSERT INTO dp_article_topic VALUES ('7', '6', '8172957631613');
INSERT INTO dp_article_topic VALUES ('12', '6', '18090108413930');
INSERT INTO dp_article_topic VALUES ('14', '6', '18090408483864');

-- ----------------------------
-- Table structure for `dp_article_user`
-- ----------------------------
DROP TABLE IF EXISTS `dp_article_user`;
CREATE TABLE `dp_article_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) DEFAULT NULL COMMENT '全局唯一',
  `nickname` varchar(20) DEFAULT NULL,
  `ctime` timestamp NULL DEFAULT NULL,
  `type` int(2) DEFAULT NULL COMMENT '类型 1 普通用户 2 发布者用户',
  `description` varchar(255) DEFAULT NULL,
  `wxcode` varchar(255) DEFAULT NULL COMMENT '微信二维码地址',
  `zfbcode` varchar(255) DEFAULT NULL COMMENT '支付宝二维码地址',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='准备弃用';

-- ----------------------------
-- Records of dp_article_user
-- ----------------------------

-- ----------------------------
-- Table structure for `dp_topic`
-- ----------------------------
DROP TABLE IF EXISTS `dp_topic`;
CREATE TABLE `dp_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类表',
  `name` varchar(20) DEFAULT NULL,
  `ctime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='分类';

-- ----------------------------
-- Records of dp_topic
-- ----------------------------
INSERT INTO dp_topic VALUES ('6', 'JavaScript', null);
INSERT INTO dp_topic VALUES ('7', 'java', '2018-08-30 10:08:58');

-- ----------------------------
-- Table structure for `oplog`
-- ----------------------------
DROP TABLE IF EXISTS `oplog`;
CREATE TABLE `oplog` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '自增ID，无特殊用途',
  `username` varchar(32) DEFAULT '',
  `uri` varchar(16) DEFAULT '' COMMENT '请求的uri',
  `mark` varchar(256) DEFAULT '' COMMENT '操作描述',
  `mark_ext` text COMMENT '此操作带有的参数等',
  `ip` varchar(16) DEFAULT '',
  `ctime` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `ux_user_1` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='日志表';

-- ----------------------------
-- Records of oplog
-- ----------------------------
INSERT INTO oplog VALUES ('1', 'admin', '/m/log/index', '访问日志', '', '192.168.1.127', '2018-06-26 11:16:50');
INSERT INTO oplog VALUES ('2', 'superadmin', '/m/auth/login', 'superadmin登录了', '', '192.168.1.99', '2018-07-19 16:15:51');
INSERT INTO oplog VALUES ('3', 'admin', '/m/auth/login', 'admin登录了', '', '192.168.1.99', '2018-07-19 16:25:09');
INSERT INTO oplog VALUES ('4', 'admin', '/m/auth/login', 'admin登录了', '', '192.168.1.99', '2018-08-02 18:46:49');
INSERT INTO oplog VALUES ('5', 'admin', '/m/auth/login', 'admin登录了', '', '192.168.1.99', '2018-08-29 17:12:16');
INSERT INTO oplog VALUES ('6', 'admin', '/m/auth/login', 'admin登录了', '', '192.168.1.99', '2018-08-29 17:12:17');
INSERT INTO oplog VALUES ('7', 'admin', '/admin.php/m/aut', 'admin登录了', '', '192.168.1.99', '2018-08-29 10:31:52');
INSERT INTO oplog VALUES ('8', 'admin', '/admin.php/m/aut', 'admin登录了', '', '192.168.1.99', '2018-08-30 03:22:22');
INSERT INTO oplog VALUES ('9', 'admin', '/admin.php/m/aut', 'admin登录了', '', '192.168.1.99', '2018-08-30 09:31:20');
INSERT INTO oplog VALUES ('10', 'admin', '/admin.php/m/log', '访问日志', '', '192.168.1.99', '2018-08-31 09:40:48');
INSERT INTO oplog VALUES ('11', 'admin', '/admin.php/m/log', '访问日志', '', '192.168.1.99', '2018-09-01 06:25:42');
INSERT INTO oplog VALUES ('12', 'admin', '/admin.php/m/aut', 'admin登录了', '', '192.168.1.99', '2018-09-01 06:47:42');

-- ----------------------------
-- Table structure for `plat_config`
-- ----------------------------
DROP TABLE IF EXISTS `plat_config`;
CREATE TABLE `plat_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID，无特殊用途',
  `cname` varchar(32) DEFAULT '配置名称',
  `ckey` varchar(32) DEFAULT '' COMMENT '配置的key',
  `cvalue` varchar(32) DEFAULT '' COMMENT '配置的值，可以是任何结构',
  `mark` varchar(256) DEFAULT '' COMMENT '注解',
  `type` tinyint(3) DEFAULT '0' COMMENT '1:系统配置不可删',
  `ctime` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `mtime` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_ckey_1` (`ckey`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='平台配置表';

-- ----------------------------
-- Records of plat_config
-- ----------------------------
INSERT INTO plat_config VALUES ('1', '开启谷歌验证码登录', 'login_code', '2', '谷歌验证码是个动态验证码，可以有效提高网站登录的安全。cvalue:1代表开启，2：代表关闭', '1', null, null);
INSERT INTO plat_config VALUES ('2', '测试配置', 'xxx', 'ssss', '支持json配置，cvalue框是textarea', '0', null, null);

-- ----------------------------
-- Table structure for `plat_menu`
-- ----------------------------
DROP TABLE IF EXISTS `plat_menu`;
CREATE TABLE `plat_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID，无特殊用途',
  `mname` varchar(32) DEFAULT '菜单名称',
  `desription` varchar(255) DEFAULT '',
  `url` varchar(128) DEFAULT '' COMMENT '菜单的地址',
  `icon` varchar(50) DEFAULT '' COMMENT '菜单前的图标',
  `parent` tinyint(11) NOT NULL COMMENT '0 为一级目录  否则为二级目录ID',
  `sort` mediumint(11) DEFAULT '0' COMMENT '排序',
  `type` tinyint(2) DEFAULT '1' COMMENT '1 目录 2 权限',
  `status` tinyint(2) DEFAULT '1' COMMENT '1显示2不显示',
  `action` varchar(255) DEFAULT NULL COMMENT '自定义权限名 默认 class_function',
  `system` int(255) DEFAULT '2' COMMENT '1 系统目录 访问权限内置，不可被分配 2 普通目录',
  `ctime` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `mtime` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_mname_1` (`mname`),
  UNIQUE KEY `action` (`action`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COMMENT='平台菜单表';

-- ----------------------------
-- Records of plat_menu
-- ----------------------------
INSERT INTO plat_menu VALUES ('1', '后台管理', '', 'manage', 'icon-home', '0', '2', '1', '1', 'manage', '1', null, '2017-10-31 15:33:18');
INSERT INTO plat_menu VALUES ('2', '用户操作', '', '/m/user/index', 'icon-user', '1', '1', '1', '1', '/m/user/index', '1', null, '2017-11-01 15:56:10');
INSERT INTO plat_menu VALUES ('3', '目录管理', '', '/m/manage/navigation', 'icon-folder-alt', '1', '3', '1', '1', '/m/manage/navigation', '1', null, '2017-11-01 15:56:10');
INSERT INTO plat_menu VALUES ('57', '权限组管理', '', '/m/group/index', 'icon-users', '1', '2', '1', '1', '/m/group/index', '1', '2017-10-16 02:55:47', '2017-11-01 15:56:10');
INSERT INTO plat_menu VALUES ('58', '配置管理', '', '/m/config/index', 'icon-globe', '1', '4', '1', '1', '/m/config/index', '1', '2017-10-16 15:44:04', '2017-11-01 15:56:10');
INSERT INTO plat_menu VALUES ('60', '平台日志', '', '/m/log/index', 'icon-tag', '0', '3', '1', '1', '/m/log/index', '1', '2017-10-19 17:36:40', '2017-11-03 16:49:01');
INSERT INTO plat_menu VALUES ('61', '笔记管理', '', '', 'icon-basket-loaded', '0', '1', '1', '1', null, '2', '2017-10-27 15:53:29', '2018-08-31 02:16:11');
INSERT INTO plat_menu VALUES ('69', '欢迎使用', '', '/Welcome/index', 'icon-home', '0', '0', '1', '1', null, '2', '2017-10-31 14:23:46', '2017-10-31 14:23:46');
INSERT INTO plat_menu VALUES ('70', '模板创建', '', '/m/createtemp/index', 'icon-emoticon-smile', '1', '5', '1', '1', '/m/createtemp/index', '1', '2017-11-01 15:55:55', '2017-11-01 16:11:27');
INSERT INTO plat_menu VALUES ('71', '分类管理', '', '/dp_topic/index', 'icon-list', '61', '0', '1', '1', '/dp_topic/index', '2', '2018-08-30 09:39:25', '2018-08-30 09:39:25');
INSERT INTO plat_menu VALUES ('73', '文章编辑', '', '/dp_article', 'icon-social-tumblr', '61', '0', '1', '1', 'dp_article', '2', '2018-08-31 05:55:41', '2018-08-31 05:57:34');
INSERT INTO plat_menu VALUES ('74', '文章列表', '', '/dp_article_description/index', 'icon-map', '61', '0', '1', '1', '/dp_article_description/index', '2', '2018-09-01 08:53:15', '2018-09-01 08:53:15');

-- ----------------------------
-- Table structure for `test_goods`
-- ----------------------------
DROP TABLE IF EXISTS `test_goods`;
CREATE TABLE `test_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品管理表 测试用',
  `name` varchar(255) DEFAULT NULL COMMENT '商品名',
  `price` int(11) DEFAULT NULL COMMENT '单位分',
  `num` int(11) DEFAULT '0' COMMENT '库存',
  `status` tinyint(2) DEFAULT '1' COMMENT '状态 1 正常 2 下架 3 删除',
  `mtime` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `ctime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test_goods
-- ----------------------------
INSERT INTO test_goods VALUES ('3', '商品3', '1000', '19', '1', '2017-11-11 17:19:31', '2017-11-11 17:19:30');
INSERT INTO test_goods VALUES ('4', '商品4', '1000', '5', '1', '2017-11-06 15:47:28', '2017-11-06 15:47:28');
INSERT INTO test_goods VALUES ('5', '商品5', '1000', '93', '1', '2017-10-28 15:47:28', '2017-10-28 15:47:28');
INSERT INTO test_goods VALUES ('6', '商品6', '1000', '94', '1', '2017-11-06 15:47:28', '2017-11-06 15:47:28');
INSERT INTO test_goods VALUES ('7', '商品7', '1000', '23', '1', '2017-10-31 15:47:28', '2017-10-31 15:47:28');
INSERT INTO test_goods VALUES ('8', '商品8', '1000', '30', '1', '2017-11-01 15:47:28', '2017-11-01 15:47:28');
INSERT INTO test_goods VALUES ('9', '商品9', '1000', '26', '1', '2017-11-01 15:47:28', '2017-11-01 15:47:28');
INSERT INTO test_goods VALUES ('10', '商品10', '1000', '23', '1', '2017-11-03 15:47:28', '2017-11-03 15:47:28');
INSERT INTO test_goods VALUES ('11', '商品11', '1000', '50', '1', '2017-10-31 15:47:28', '2017-10-31 15:47:28');
INSERT INTO test_goods VALUES ('12', '商品12', '1000', '24', '1', '2017-10-28 15:47:28', '2017-10-28 15:47:28');
INSERT INTO test_goods VALUES ('13', '商品13', '1000', '70', '1', '2017-11-05 15:47:29', '2017-11-05 15:47:29');
INSERT INTO test_goods VALUES ('14', '商品14', '1000', '48', '1', '2017-11-01 15:47:29', '2017-11-01 15:47:29');
INSERT INTO test_goods VALUES ('15', '商品15', '1000', '32', '1', '2017-11-02 15:47:29', '2017-11-02 15:47:29');
INSERT INTO test_goods VALUES ('16', '商品16', '1000', '100', '1', '2017-10-30 15:47:29', '2017-10-30 15:47:29');
INSERT INTO test_goods VALUES ('17', '商品17', '1000', '7', '1', '2017-11-03 15:47:29', '2017-11-03 15:47:29');
INSERT INTO test_goods VALUES ('18', '商品18', '1000', '90', '1', '2017-11-02 15:47:29', '2017-11-02 15:47:29');
INSERT INTO test_goods VALUES ('19', '商品19', '1000', '60', '1', '2017-11-01 15:47:29', '2017-11-01 15:47:29');
INSERT INTO test_goods VALUES ('20', '商品20', '1000', '42', '1', '2017-10-29 15:47:29', '2017-10-29 15:47:29');

-- ----------------------------
-- Table structure for `test_order`
-- ----------------------------
DROP TABLE IF EXISTS `test_order`;
CREATE TABLE `test_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单管理 测试用',
  `order_id` varchar(32) DEFAULT NULL COMMENT '订单id',
  `gid` int(11) DEFAULT NULL COMMENT 'goods表id',
  `price` int(11) DEFAULT NULL COMMENT '商品原价',
  `pay` int(11) DEFAULT NULL COMMENT '实付金额 单位分',
  `status` tinyint(2) DEFAULT NULL COMMENT '订单状态 1 已创建未付款 2 已付款  9 已取消',
  `pay_time` timestamp NULL DEFAULT NULL COMMENT '支付时间',
  `ctime` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `mtime` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test_order
-- ----------------------------
INSERT INTO test_order VALUES ('1', '9001201710271513909505', '5', '1000', '1000', '2', '2017-10-31 15:41:20', '2017-10-31 16:08:44', '2017-10-31 15:41:20');
INSERT INTO test_order VALUES ('2', '9001201710271544984048', '2', '1000', '1000', '1', null, '2017-11-04 15:41:20', '2017-11-04 15:41:20');
INSERT INTO test_order VALUES ('3', '9001201710271513829270', '7', '1000', '1000', '2', '2017-11-06 15:41:20', '2017-11-06 16:07:05', '2017-11-06 15:41:20');
INSERT INTO test_order VALUES ('4', '9001201710271554161390', '1', '1000', '1000', '2', '2017-10-31 15:41:20', '2017-10-31 16:27:55', '2017-10-31 15:41:20');
INSERT INTO test_order VALUES ('5', '9001201710271545282285', '7', '1000', '1000', '1', null, '2017-10-31 15:41:20', '2017-10-31 15:41:20');
INSERT INTO test_order VALUES ('6', '9001201710271563080673', '6', '1000', '1000', '1', null, '2017-11-02 15:41:20', '2017-11-02 15:41:20');
INSERT INTO test_order VALUES ('7', '9001201710271588459825', '1', '1000', '1000', '1', null, '2017-11-03 15:41:20', '2017-11-03 15:41:20');
INSERT INTO test_order VALUES ('8', '9001201710271578669070', '18', '1000', '1000', '2', '2017-10-28 15:41:20', '2017-10-28 15:58:50', '2017-10-28 15:41:20');
INSERT INTO test_order VALUES ('9', '9001201710271564966965', '5', '1000', '1000', '2', '2017-11-02 15:41:20', '2017-11-02 16:37:45', '2017-11-02 15:41:20');
INSERT INTO test_order VALUES ('10', '9001201710271557690653', '8', '1000', '1000', '2', '2017-11-05 15:41:20', '2017-11-05 16:34:57', '2017-11-05 15:41:20');
INSERT INTO test_order VALUES ('11', '9001201710271585040897', '20', '1000', '1000', '1', null, '2017-11-02 15:41:20', '2017-11-02 15:41:20');
INSERT INTO test_order VALUES ('12', '9001201710271567601824', '10', '1000', '1000', '1', null, '2017-10-29 15:41:20', '2017-10-29 15:41:20');
INSERT INTO test_order VALUES ('13', '9001201710271581393086', '1', '1000', '1000', '2', '2017-11-05 15:41:20', '2017-11-05 16:01:26', '2017-11-05 15:41:20');
INSERT INTO test_order VALUES ('14', '9001201710271549420726', '3', '1000', '1000', '2', '2017-10-29 15:41:20', '2017-10-29 16:24:16', '2017-10-29 15:41:20');
INSERT INTO test_order VALUES ('15', '9001201710271544553389', '2', '1000', '1000', '1', null, '2017-11-04 15:41:20', '2017-11-04 15:41:20');
INSERT INTO test_order VALUES ('16', '9001201710271551504210', '9', '1000', '1000', '2', '2017-10-30 15:41:20', '2017-10-30 16:23:37', '2017-10-30 15:41:20');
INSERT INTO test_order VALUES ('17', '9001201710271540437685', '18', '1000', '1000', '2', '2017-10-28 15:41:20', '2017-10-28 16:10:26', '2017-10-28 15:41:20');
INSERT INTO test_order VALUES ('18', '9001201710271567384415', '14', '1000', '1000', '1', null, '2017-11-06 15:41:20', '2017-11-06 15:41:20');
INSERT INTO test_order VALUES ('19', '9001201710271515735556', '9', '1000', '1000', '1', null, '2017-11-01 15:41:20', '2017-11-01 15:41:20');
INSERT INTO test_order VALUES ('20', '9001201710271540830097', '4', '1000', '1000', '2', '2017-11-02 15:41:20', '2017-11-02 16:27:21', '2017-11-02 15:41:20');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '自增ID，无特殊用途',
  `username` varchar(32) DEFAULT '',
  `password` varchar(128) DEFAULT '' COMMENT '密码',
  `nick_name` varchar(64) DEFAULT '' COMMENT '用户称呼',
  `gcode` varchar(16) DEFAULT '' COMMENT '谷歌验证码密码',
  `user_group` varchar(64) DEFAULT '' COMMENT '用户所在组,多个以","隔开',
  `user_level` tinyint(3) DEFAULT '0' COMMENT '用户管理级别 8：最高级管理员，1为普通级别，不可以分配权限',
  `user_right` text COMMENT '用户单独权限配置，多个以“,”隔开',
  `status` smallint(6) NOT NULL DEFAULT '2' COMMENT '用户状态  2:正常，3 锁定',
  `salt` varchar(32) DEFAULT '',
  `zfbcode` varchar(255) DEFAULT NULL,
  `wxcode` varchar(255) DEFAULT NULL,
  `ctime` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `mtime` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_user_1` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COMMENT='平台用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO user VALUES ('38', 'admin', 'a9a960043a8992663726170966fa049a85e43d37', '管理员', 'mjxxcmtxo55gqmrx', '', '8', null, '2', '91coxs08968eui35', null, null, '2017-11-11 17:16:10', '2017-11-11 17:16:10');

-- ----------------------------
-- Table structure for `user_group`
-- ----------------------------
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID，无特殊用途',
  `gname` varchar(32) DEFAULT '' COMMENT '权限组名称',
  `ctime` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `mtime` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_gname_1` (`gname`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='用户权限组';

-- ----------------------------
-- Records of user_group
-- ----------------------------
INSERT INTO user_group VALUES ('7', '测试_客服', '2017-10-31 11:33:17', '2017-10-31 11:33:17');
INSERT INTO user_group VALUES ('8', '测试_商品管理', '2017-10-31 11:34:14', '2017-10-31 11:34:14');
INSERT INTO user_group VALUES ('9', '测试_店长', '2017-10-31 11:35:38', '2017-10-31 11:35:38');

-- ----------------------------
-- Table structure for `user_group_right`
-- ----------------------------
DROP TABLE IF EXISTS `user_group_right`;
CREATE TABLE `user_group_right` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '自增ID，无特殊用途',
  `ugid` int(11) DEFAULT '0' COMMENT '权限组id',
  `pmid` int(11) DEFAULT '0' COMMENT '权限id 关联表 plat_menu',
  `ctime` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `mtime` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_ugp_1` (`ugid`,`pmid`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='权限组对应的权限';

-- ----------------------------
-- Records of user_group_right
-- ----------------------------
INSERT INTO user_group_right VALUES ('23', '7', '62', null, null);
INSERT INTO user_group_right VALUES ('24', '7', '63', null, null);
INSERT INTO user_group_right VALUES ('25', '8', '62', null, null);
INSERT INTO user_group_right VALUES ('26', '8', '64', null, null);
INSERT INTO user_group_right VALUES ('27', '8', '65', null, null);
INSERT INTO user_group_right VALUES ('28', '8', '67', null, null);
INSERT INTO user_group_right VALUES ('29', '9', '62', null, null);
INSERT INTO user_group_right VALUES ('30', '9', '64', null, null);
INSERT INTO user_group_right VALUES ('31', '9', '65', null, null);
INSERT INTO user_group_right VALUES ('32', '9', '66', null, null);
INSERT INTO user_group_right VALUES ('33', '9', '67', null, null);
INSERT INTO user_group_right VALUES ('34', '9', '63', null, null);
INSERT INTO user_group_right VALUES ('35', '9', '60', null, null);
