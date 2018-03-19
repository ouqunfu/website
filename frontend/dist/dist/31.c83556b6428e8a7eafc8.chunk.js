webpackJsonp([31],{269:function(t,e,l){"use strict";function c(t){r||l(967)}Object.defineProperty(e,"__esModule",{value:!0});var o=l(829),i=l.n(o);for(var n in o)"default"!==n&&function(t){l.d(e,t,function(){return o[t]})}(n);var s=l(969),a=l.n(s),r=!1,d=l(1),h=c,u=d(i.a,a.a,!1,h,"data-v-b3c7b1ac",null);u.options.__file="src\\views\\users\\add-role.vue",e.default=u.exports},829:function(t,e,l){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={name:"add-role",data:function(){return{formItem:{parent:"0",isNav:"1",isShow:1},checkAll:!1,checkAllChild:!1,checkAllGroup:[],roleList:[{module:"contents",title:"内容",selected:!1,controller:[{controller:"columns",title:"栏目管理",selected:!1,action:[{action:"lists",title:"栏目列表",selected:!1,fid:1},{action:"add",title:"添加栏目",selected:!1,fid:2},{action:"edit",title:"修改栏目",selected:!1,fid:3},{action:"delete",title:"删除栏目",selected:!1,fid:4},{action:"role",title:"栏目前台权限",selected:!1,fid:5}]},{controller:"content",title:"内容管理",selected:!1,action:[{action:"lists",title:"内容列表",selected:!1,fid:1},{action:"add",title:"添加内容",selected:!1,fid:2},{action:"edit",title:"修改内容",selected:!1,fid:3},{action:"delete",title:"删除内容",selected:!1,fid:4},{action:"check",title:"审核内容",selected:!1,fid:5},{action:"role",title:"内容前台权限",selected:!1,fid:6}]}]},{module:"users",title:"用户",selected:!1,controller:[{controller:"user",title:"用户管理",selected:!1,action:[{action:"lists",title:"用户列表",selected:!1,fid:1},{action:"add",title:"添加用户",selected:!1,fid:2},{action:"edit",title:"修改用户",selected:!1,fid:3},{action:"delete",title:"删除用户",selected:!1,fid:4},{action:"role",title:"用户前台权限",selected:!1,fid:5}]}]}]}},methods:{handleCheckAll:function(t){this.roleList[t].selected=!this.roleList[t].selected;var e=this.roleList[t];this.roleList[t].controller.forEach(function(t){t.selected=!!e.selected,t.action.forEach(function(e){e.selected=!!t.selected},t)},e)},checkControllerChange:function(t,e){this.roleList[t].controller[e].selected=!this.roleList[t].controller[e].selected;var l=this.roleList[t].controller[e];l.action.forEach(function(t){t.selected=!!l.selected},l.selected),this.checkSelectAll(t)},checkSelectAll:function(t){var e=this.roleList[t],l=e.controller.length,c=0;e.controller.forEach(function(t){t.selected&&c++,l+=t.action.length,t.action.forEach(function(t){t.selected&&c++})}),c===l&&(this.roleList[t].selected=!0,this.$set(this.roleList[t],"indeterminate",!1)),0===c&&(this.roleList[t].selected=!1,this.$set(this.roleList[t],"indeterminate",!1)),c<l&&c>0&&this.$set(this.roleList[t],"indeterminate",!0)},checkAllGroupChange:function(t,e,l){var c=this.roleList[t].controller[e].action;this.roleList[t].controller[e].action[l].selected=!c[l].selected,this.checkChildSelectAll(t,e),this.checkSelectAll(t)},checkChildSelectAll:function(t,e){var l=this.roleList[t].controller[e],c=0;l.action.forEach(function(t){t.selected&&c++}),c>0?this.roleList[t].controller[e].selected=!0:0===c&&(this.roleList[t].controller[e].selected=!1)}}}},967:function(t,e,l){var c=l(968);"string"==typeof c&&(c=[[t.i,c,""]]),c.locals&&(t.exports=c.locals);l(17)("0c5c0473",c,!1)},968:function(t,e,l){e=t.exports=l(16)(!1),e.push([t.i,"\n.tooltips-custom[data-v-b3c7b1ac] {\n    padding-top: 5px;\n}\n.checkAll[data-v-b3c7b1ac] {\n    color: #000;\n    background-color: #d2d6de !important;\n    margin: 10px;\n    padding: 5px;\n}\n.checkAllChild[data-v-b3c7b1ac] {\n    margin: 0px 10px 10px;\n    padding: 5px;\n    border-bottom: 1px solid #f4f4f4;\n}\n.checkbox-second[data-v-b3c7b1ac] {\n    margin-left: 10px;\n}\n.cus-checkbox-group[data-v-b3c7b1ac] {\n    display: inline-block;\n    margin-left: 30px;\n}\n",""])},969:function(t,e,l){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var c=function(){var t=this,e=t.$createElement,l=t._self._c||e;return l("div",{staticClass:"home-main"},[l("Card",{attrs:{"dis-hover":""}},[l("Form",{attrs:{model:t.formItem,"label-width":100}},[l("Tabs",{style:{paddingBottom:"40px"},attrs:{animated:!1}},[l("TabPane",{attrs:{label:"基本信息"}},[l("Row",{style:{marginLeft:"50px"},attrs:{gutter:10}},[l("Row",{attrs:{gutter:10}},[l("Col",{attrs:{xs:24,sm:12,md:9}},[l("FormItem",{attrs:{label:"角色名称"}},[l("Input",{attrs:{name:"name",placeholder:""}})],1)],1),t._v(" "),l("Col",{staticClass:"tooltips-custom",attrs:{xs:3,sm:2,md:1}},[l("Tooltip",{attrs:{content:"请填写角色名称！",placement:"left"}},[l("Icon",{attrs:{type:"information-circled"}})],1)],1)],1),t._v(" "),l("Row",{attrs:{gutter:10}},[l("Col",{attrs:{xs:24,sm:12,md:9}},[l("FormItem",{attrs:{label:"状态"}},[l("RadioGroup",{model:{value:t.formItem.isShow,callback:function(e){t.$set(t.formItem,"isShow",e)},expression:"formItem.isShow"}},[l("Radio",{attrs:{label:"1"}},[t._v("启用")]),t._v(" "),l("Radio",{attrs:{label:"0"}},[t._v("禁用")])],1)],1)],1),t._v(" "),l("Col",{staticClass:"tooltips-custom",attrs:{xs:3,sm:2,md:1}},[l("Tooltip",{attrs:{placement:"left"}},[l("Icon",{attrs:{type:"information-circled"}}),t._v(" "),l("div",{attrs:{slot:"content"},slot:"content"},[t._v("\n                                        选择角色是否启用！\n                                    ")])],1)],1)],1)],1)],1),t._v(" "),l("TabPane",{attrs:{label:"权限设置"}},t._l(t.roleList,function(e,c){return l("Row",{attrs:{gutter:10}},[l("Col",{staticClass:"checkAll",attrs:{xs:24,sm:24,md:24}},[l("Checkbox",{attrs:{indeterminate:e.indeterminate,value:e.selected,label:e.module},nativeOn:{click:function(e){e.preventDefault(),t.handleCheckAll(c)}}},[t._v(t._s(e.title)+"\n                            ")])],1),t._v(" "),t._l(e.controller,function(e,o){return l("Col",{staticClass:"checkAllChild",attrs:{xs:24,sm:24,md:24}},[l("Checkbox",{staticClass:"checkbox-second",attrs:{value:e.selected,label:e.controller},on:{"on-change":function(e){t.checkControllerChange(c,o)}}},[t._v(t._s(e.title)+"\n                            ")]),t._v(" "),t._l(e.action,function(e,i){return l("CheckboxGroup",{staticClass:"cus-checkbox-group",on:{"on-change":function(e){t.checkAllGroupChange(c,o,i)}}},[l("Checkbox",{attrs:{value:e.selected,label:e.action}},[t._v(t._s(e.title)+"\n                                ")])],1)})],2)})],2)}))],1),t._v(" "),l("Button",{attrs:{type:"primary",size:"large"}},[t._v("提交")])],1)],1)],1)},o=[];c._withStripped=!0;var i={render:c,staticRenderFns:o};e.default=i}});