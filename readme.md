## 开发框架

ZQCMS v1.0是使用layui2.4.5+laravel5.7搭建的

在线展示:http://www.xianglong.site

### Zqcms介绍

系统主要是志在更快的开发后台，减少代码冗余，所以本cms基本大部分通过js渲染html，php代码均为模块化写法，只需要配置好你需要的就可以生成页面，使用了模块化的开发模式

### 第三方扩展

eleTree树形组件：[https://github.com/hsiangleev/layuiExtend](https://github.com/hsiangleev/layuiExtend)

formSelects 4.0多选框：[https://github.com/hnzzmsf/layui-formSelects](https://github.com/hnzzmsf/layui-formSelects)

treeGrid树状表格：

[https://gitee.com/beijiyi/tree\_table\_treegrid\_based\_on\_layui](https://gitee.com/beijiyi/tree_table_treegrid_based_on_layui)

Wangeditor富文本：[https://github.com/wangfupeng1988/wangEditor/](https://github.com/wangfupeng1988/wangEditor/)

## 安装

 1、在数据库中创建数据库，并修改env文件中的数据库配置连到你的创建的数据库

 2、运行composer install

 3、运行 php artisan migrate

 4、运行 php artisan db:seed 到此已安装完成

5、默认登录用户15600000000  密码123123

## 功能介绍

 维持了layui原有模块开发方式，在layui基础上继续封装了，使用前建议先看layui文档。

权限控制：权限控制本cms使用了spatie/laravel-permission扩展包开发的。采用：角色赋权，用户分配角色模式

文章管理

广告管理

## 开发说明

### PHP部分

后端功能核心模块BackendBaseController

BackendBaseController包含了权限判断和页面渲染，通用式增删改查、上传等功能，新增功能时候只需编写好需要保存的参数即可

### Js部分

#### dialog 弹窗使用模块

##### confirm(jsonData) 确认框

 参数:jsonData={

message:弹窗信息

success：确定按钮回调

cancel:取消按钮回调

}

###### page(title, url, w, h)

参数：title：弹窗标题

      url:页面路径

      w:弹窗宽度，默认：700px

   h：弹窗高度，默认：300px

###### tips(title, obj)提示弹窗

参数：title:提示内容

      Obj:吸附元素选择器

##### menuTpl: 菜单生成模块

不做过多说明，该模块只是渲染菜单使用

#### inputTpl: 输入框生成模块

调用顺序html再调render

###### html()模版html插入

**      使用jq的append()方法插入**

###### render(jsonData)渲染模板

通过模版生成出来的元素默认是 &quot;属性+Id&quot;  例如如name：zqcms ；该元素id则为：zqcmsId

参数格式JsonData={

 content:[{

}]

}



| jsonData | 属性 | 说明 | 数据类型 | 使用type范围 |
| --- | --- | --- | --- | --- |
| content | label | 名称 | String |   |
|| name | 输入框name属性 | String |   |
||inputType | input的type属性,默认为text | String |   |
|| skin | 属性lay-skin skin:switch（开关风格） primary（原始风格）| String | checkbox |
|| layText | 原layui属性lay-text可自定义开关两种状态的文本 | String | checkbox |
|| value | 默认值 | String/array |   |
|| type | 默认是text，tree：树形组件，select：选择器，formSelect：多选框，editor：富文本，textarea：多行的文本，uploadImg：单张图片，uploadGallery：相册 | String |   |
|| verify | 输入框校验规则,直接使用layui的验证规则即可 | String |   |
|| autocomplete | 设置是否自动完成 | String |   |
|| filter | 事件过滤器即layui的lay-filter属性，默认为空 | String |   |
|| verType | 用于定义异常提示层模式，系统默认tips | String |   
|| remark | 输入框提示标签,默认不显示 | String |   |
|| keyVal | 指定选项的值为选项对象的某个属性值：默认值：id | String | formSelect |
|| keyName | 指定选项标签为选项对象的某个属性值，默认值：name | String | formSelect |
|| keyChildren | 指定选项的子选项为选项对象的某个属性值，默认值：children | String | formSelect |
|| keySel | 指定选择已选择的标记，默认值selected | String | formSelect |
|| linkage | 是否开启联动选择 | bool | formSelect |
|| linkageWidth | 联动多选每级宽度 | number | formSelect |
|| selectMax | 最大选择数量，默认1 | number | formSelect |
|| style | 默认primary， default 浅灰 primary 墨绿 normal 深蓝 warm 屎黄 danger 橘红| String | formSelect |

|| |optionData | 选择框数据，当url属性存在该参数则失效 | Json | formSelect、select |
|| header | 请求头，url属性存在才生效 | Object | formSelect |
|| url | 从接口获取数据 | String | formSelect使用 |
|| uploadUrl | 上传文件路径 | String | uploadImg、uploadGallery |
| formFilter |   | form表单lay-filter的值，默认：editForm | String |   |
| button |   | 是否显示提交按钮 | bool |   |
| view |   | 渲染form表单id，默认：inputContent | String |   |

**     **

#### tabTpl:tab渲染组件

调用顺序html再调render

###### html()模版html插入

**   **  使用jq的append()方法插入

###### render(jsonData)渲染模板

通过模版生成出来的元素默认是 &quot;属性+Id&quot;  例如如name：zqcms ；该元素id则为：zqcmsId

参数格式JsonData={

 content:[{

}]

}

jsonData = {

layFilter: lay-filter属性,

groupData: tab数据

};

| JsonData | 属性 | 说明 | 类型 |
| --- | --- | --- | --- |
|   | layFilter | lay-filter属性 | String |
|   | groupData |  tab数据 | json |

###### inputRender(jsonData)

参数参照inputTpl组件



#### request: 网络请求模块

###### zqajax(jsonData, loading = false, type = 1, shade = false）ajax请求

| 属性 | 说明 | 类型 |
| --- | --- | --- |
| jsonData | 配置参数 | Json |
| loading | 是否开启等待效果 | bool |
| type | 加载效果类型支持值 支持0-2, | Number |
| shade | 是否开启加载效果蒙层 boolean | bool |

**jsonData**

| **属性** | **说明** | **类型** |
| --- | --- | --- |
| headers | 请求头 | Json |
| type | 请求类型 | String |
| url | 请求链接 | String |
| data | 请求数据 | Json |
| dataType | 预期服务器返回的数据类型 | String |
| success | 请求成功回调 | Function |
| error | 请求失败回调 | Function |
| complete | 请求结束回调 | Function |
