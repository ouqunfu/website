webpackJsonp([66],{267:function(n,t,e){"use strict";function a(n){c||e(961)}Object.defineProperty(t,"__esModule",{value:!0});var o=e(827),s=e.n(o);for(var l in o)"default"!==l&&function(n){e.d(t,n,function(){return o[n]})}(l);var r=e(963),i=e.n(r),c=!1,u=e(1),m=a,d=u(s.a,i.a,!1,m,"data-v-77c93560",null);d.options.__file="src\\views\\contents\\add-tag.vue",t.default=d.exports},827:function(n,t,e){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={name:"add-tag",data:function(){return{formItem:{parent:"0",isNav:"1",isShow:"0"},selectVar:"",buttonData:[{title:"year（文章的年份，四位数字，形如2004。）",content:"年：%year%",value:"%year%",isSelect:!1},{title:"monthnum（月份，形如05。）",content:"月：%monthnum%",value:"%monthnum%",isSelect:!1},{title:"day（日期，形如28。）",content:"日：%day%",value:"%day%",isSelect:!1},{title:"hour（小时，形如15。）",content:"时：%hour%",value:"%hour%",isSelect:!1},{title:"minute（分钟，形如43。）",content:"分：%minute%",value:"%minute%",isSelect:!1},{title:"second（秒数，形如33。）",content:"秒：%second%",value:"%second%",isSelect:!1},{title:"post_id（内容的唯一ID，形如423。）",content:"ID：%post_id%",value:"%post_id%",isSelect:!1},{title:"postname（清理过的内容标题（别名）。）",content:"name：%postname%",value:"%postname%",isSelect:!1},{title:"category（分类别名，嵌套的子分类在URL中会显示为嵌套的文件夹。）",content:"分类：%category%",value:"%category%",isSelect:!1},{title:"tag（标签名。）",content:"标签：%tag%",value:"%tag%",isSelect:!1},{title:"author（清理过的作者姓名。）",content:"作者：%author%",value:"%author%",isSelect:!1},{title:"page（分页的页码。）",content:"分页：%page%",value:"%page%",isSelect:!1}]}}}},961:function(n,t,e){var a=e(962);"string"==typeof a&&(a=[[n.i,a,""]]),a.locals&&(n.exports=a.locals);e(17)("7bf6e86d",a,!1)},962:function(n,t,e){t=n.exports=e(16)(!1),t.push([n.i,"\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n",""])},963:function(n,t,e){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=function(){var n=this,t=n.$createElement,e=n._self._c||t;return e("div",{staticClass:"home-main"},[e("Card",{attrs:{"dis-hover":""}},[e("Form",{attrs:{model:n.formItem,"label-width":100}},[e("Row",{style:{marginLeft:"100px"}},[e("Row",{attrs:{gutter:10}},[e("Col",{attrs:{xs:24,sm:12,md:9}},[e("FormItem",{attrs:{label:"名称"}},[e("Input",{attrs:{name:"name",placeholder:""}})],1)],1),n._v(" "),e("Col",{staticClass:"tooltips-custom",attrs:{xs:3,sm:2,md:1}},[e("Tooltip",{attrs:{content:"请填写标签名称！",placement:"left"}},[e("Icon",{attrs:{type:"information-circled"}})],1)],1)],1),n._v(" "),e("Row",{attrs:{gutter:10}},[e("Col",{attrs:{xs:24,sm:12,md:9}},[e("FormItem",{attrs:{label:"别名"}},[e("Input",{attrs:{name:"name",placeholder:""}})],1)],1),n._v(" "),e("Col",{staticClass:"tooltips-custom",attrs:{xs:3,sm:2,md:1}},[e("Tooltip",{attrs:{placement:"left"}},[e("Icon",{attrs:{type:"information-circled"}}),n._v(" "),e("div",{attrs:{slot:"content"},slot:"content"},[e("p",[n._v("“别名”是在URL中使用的别称，它可以令URL"),e("br"),n._v("更美观。\n                                    通常使用小写，只能包含字母，"),e("br"),n._v("数字和连字符（-）。")])])],1)],1)],1),n._v(" "),e("Row",{attrs:{gutter:10}},[e("Col",{attrs:{xs:24,sm:12,md:9}},[e("FormItem",{attrs:{label:"描述"}},[e("Input",{attrs:{type:"textarea",autosize:{minRows:5,maxRows:8}}})],1)],1),n._v(" "),e("Col",{staticClass:"tooltips-custom",attrs:{xs:3,sm:2,md:1}},[e("Tooltip",{attrs:{placement:"left"}},[e("Icon",{attrs:{type:"information-circled"}}),n._v(" "),e("div",{attrs:{slot:"content"},slot:"content"},[n._v("\n                                请填写标签描述！\n                            ")])],1)],1)],1),n._v(" "),e("Button",{attrs:{type:"primary",size:"large"}},[n._v("提交")])],1)],1)],1)],1)},o=[];a._withStripped=!0;var s={render:a,staticRenderFns:o};t.default=s}});