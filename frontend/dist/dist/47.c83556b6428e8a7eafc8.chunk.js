webpackJsonp([47],{1021:function(n,t,e){var a=e(1022);"string"==typeof a&&(a=[[n.i,a,""]]),a.locals&&(n.exports=a.locals);e(17)("1b0fe240",a,!1)},1022:function(n,t,e){t=n.exports=e(16)(!1),t.push([n.i,"\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n",""])},1023:function(n,t,e){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=function(){var n=this,t=n.$createElement,e=n._self._c||t;return e("div",{staticClass:"home-main"},[e("Row",{attrs:{gutter:10}},[e("Col",{attrs:{md:24,lg:24}},[e("Card",{attrs:{"dis-hover":""}},[e("Row",{style:{marginBottom:"10px"},attrs:{gutter:10}},[e("a",{attrs:{href:"#/functions/add-notice"}},[e("Button",{attrs:{type:"primary"}},[n._v("添加公告")])],1)]),n._v(" "),e("Row",{style:{marginBottom:"10px"},attrs:{gutter:10}},[e("Table",{attrs:{loading:n.loading,border:"",columns:n.columns,data:n.data}}),n._v(" "),e("div",{staticStyle:{margin:"10px 0 10px 0",overflow:"hidden"}},[e("div",{staticStyle:{float:"left"}},[e("a",{attrs:{href:"javascript:void(0)"}},[e("Button",[n._v("删除")])],1)]),n._v(" "),e("div",{staticStyle:{float:"right"}},[e("Page",{attrs:{total:100,current:1,"show-total":""}})],1)])],1)],1)],1)],1)],1)},i=[];a._withStripped=!0;var o={render:a,staticRenderFns:i};t.default=o},287:function(n,t,e){"use strict";function a(n){d||e(1021)}Object.defineProperty(t,"__esModule",{value:!0});var i=e(847),o=e.n(i);for(var r in i)"default"!==r&&function(n){e.d(t,n,function(){return i[n]})}(r);var s=e(1023),l=e.n(s),d=!1,c=e(1),u=a,f=c(o.a,l.a,!1,u,"data-v-15cabfae",null);f.options.__file="src\\views\\functions\\notice-list.vue",t.default=f.exports},847:function(n,t,e){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={name:"notice-list",data:function(){var n=this;return{loading:!1,columns:[{type:"selection",width:60,align:"center"},{title:"ID",key:"id",width:100},{title:"标题",key:"name"},{title:"内容",key:"alias"},{title:"操作",key:"action",render:function(t,e){return t("div",[t("Button",{props:{type:"default",size:"small"},style:{marginRight:"5px"},on:{click:function(){n.show(e.index)}}},"查看"),t("Button",{props:{type:"default",size:"small"},style:{marginRight:"5px"},on:{click:function(){}}},"编辑"),t("Button",{props:{type:"default",size:"small"},on:{click:function(){n.remove(e.index)}}},"删除")])}}],data:[{id:1,name:"John Brown11",alias:"111"},{id:2,name:"John Brown222",alias:"222"},{id:3,name:"John Brown333",alias:"333"},{id:4,name:"John Brown444",alias:"44"}]}},methods:{show:function(n){this.$Modal.info({title:"User Info",content:"Name："+this.data[n].name+"<br>Age："+this.data[n].age+"<br>Address："+this.data[n].address})},remove:function(n){this.data.splice(n,1)}}}}});