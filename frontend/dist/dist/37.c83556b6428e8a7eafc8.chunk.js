webpackJsonp([37],{275:function(t,n,e){"use strict";function a(t){m||e(985)}Object.defineProperty(n,"__esModule",{value:!0});var s=e(835),r=e.n(s);for(var o in s)"default"!==o&&function(t){e.d(n,t,function(){return s[t]})}(o);var l=e(987),i=e.n(l),m=!1,c=e(1),u=a,d=c(r.a,i.a,!1,u,"data-v-73880f95",null);d.options.__file="src\\views\\settings\\add-str-filter.vue",n.default=d.exports},835:function(t,n,e){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),n.default={name:"add-str-filter",data:function(){return{formItem:{parent:"0",isNav:"1",isShow:"1"}}}}},985:function(t,n,e){var a=e(986);"string"==typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);e(17)("65fabe1d",a,!1)},986:function(t,n,e){n=t.exports=e(16)(!1),n.push([t.i,"\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n",""])},987:function(t,n,e){"use strict";Object.defineProperty(n,"__esModule",{value:!0});var a=function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("div",{staticClass:"home-main"},[e("Card",{attrs:{"dis-hover":""}},[e("Form",{attrs:{model:t.formItem,"label-width":100}},[e("Tabs",{style:{paddingBottom:"40px"},attrs:{animated:!1}},[e("TabPane",{attrs:{label:"单条添加"}},[e("Row",{style:{marginLeft:"50px"},attrs:{gutter:10}},[e("Row",{attrs:{gutter:10}},[e("Col",{attrs:{xs:24,sm:12,md:9}},[e("FormItem",{attrs:{label:"敏感词"}},[e("Input",{attrs:{name:"name",placeholder:""}})],1)],1),t._v(" "),e("Col",{staticClass:"tooltips-custom",attrs:{xs:3,sm:2,md:1}},[e("Tooltip",{attrs:{content:"请填写敏感词！",placement:"left"}},[e("Icon",{attrs:{type:"information-circled"}})],1)],1)],1),t._v(" "),e("Row",{attrs:{gutter:10}},[e("Col",{attrs:{xs:24,sm:12,md:9}},[e("FormItem",{attrs:{label:"替换词"}},[e("Input",{attrs:{name:"nickName",placeholder:""}})],1)],1),t._v(" "),e("Col",{staticClass:"tooltips-custom",attrs:{xs:3,sm:2,md:1}},[e("Tooltip",{attrs:{placement:"left"}},[e("Icon",{attrs:{type:"information-circled"}}),t._v(" "),e("div",{attrs:{slot:"content"},slot:"content"},[e("p",[t._v("请填写替换词！")])])],1)],1)],1),t._v(" "),e("Row",{attrs:{gutter:10}},[e("Col",{attrs:{xs:24,sm:12,md:9}},[e("FormItem",{attrs:{label:"敏感级别"}},[e("Select",{attrs:{transfer:""},model:{value:t.formItem.isShow,callback:function(n){t.$set(t.formItem,"isShow",n)},expression:"formItem.isShow"}},[e("Option",{attrs:{value:"1"}},[t._v("一般")]),t._v(" "),e("Option",{attrs:{value:"2"}},[t._v("危险")])],1)],1)],1),t._v(" "),e("Col",{staticClass:"tooltips-custom",attrs:{xs:3,sm:2,md:1}},[e("Tooltip",{attrs:{placement:"left"}},[e("Icon",{attrs:{type:"information-circled"}}),t._v(" "),e("div",{attrs:{slot:"content"},slot:"content"},[e("p",[t._v("一般: 用替换词替换 , 危险: 直接去除。")])])],1)],1)],1)],1)],1),t._v(" "),e("TabPane",{attrs:{label:"批量添加"}},[e("Row",{style:{marginLeft:"50px"},attrs:{gutter:10}},[e("Row",{attrs:{gutter:10}},[e("Col",{attrs:{xs:24,sm:12,md:9}},[e("FormItem",{attrs:{label:"敏感词"}},[e("Input",{attrs:{name:"name",type:"textarea",autosize:{minRows:8,maxRows:12},placeholder:"test,测试,1"}})],1)],1)],1)],1),t._v(" "),e("Row",{style:{marginLeft:"50px"},attrs:{gutter:10}},[e("Row",{attrs:{gutter:10}},[e("Col",{attrs:{xs:24,sm:12,md:9}},[e("FormItem",{attrs:{label:"规则说明"}},[t._v("\n                                    1.内容要求每行一个敏感词条目；"),e("br"),t._v('\n                                    2.请使用英文标点，参数之间用英文","隔开；'),e("br"),t._v("\n                                    3.敏感级别由数字 1,2代替，1--一般；2--敏感。\n                                ")])],1)],1)],1)],1)],1),t._v(" "),e("Button",{attrs:{type:"primary",size:"large"}},[t._v("提交")])],1)],1)],1)},s=[];a._withStripped=!0;var r={render:a,staticRenderFns:s};n.default=r}});