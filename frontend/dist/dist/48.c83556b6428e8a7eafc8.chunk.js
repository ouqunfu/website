webpackJsonp([48],{1024:function(n,t,e){var a=e(1025);"string"==typeof a&&(a=[[n.i,a,""]]),a.locals&&(n.exports=a.locals);e(17)("2603864d",a,!1)},1025:function(n,t,e){t=n.exports=e(16)(!1),t.push([n.i,"\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n",""])},1026:function(n,t,e){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=function(){var n=this,t=n.$createElement,e=n._self._c||t;return e("div",{staticClass:"home-main"},[e("Row",{attrs:{gutter:10}},[e("Col",{attrs:{md:24,lg:24}},[e("Card",{attrs:{"dis-hover":""}},[e("Row",{style:{marginBottom:"10px"},attrs:{gutter:10}},[e("Table",{attrs:{loading:n.loading,border:"",columns:n.columns,data:n.data}}),n._v(" "),e("div",{staticStyle:{margin:"10px 0 10px 0",overflow:"hidden"}},[e("div",{staticStyle:{float:"left"}},[e("a",{attrs:{href:"javascript:void(0)"}},[e("Button",[n._v("删除")])],1)]),n._v(" "),e("div",{staticStyle:{float:"right"}},[e("Page",{attrs:{total:100,current:1,"show-total":""}})],1)])],1)],1)],1)],1)],1)},i=[];a._withStripped=!0;var s={render:a,staticRenderFns:i};t.default=s},288:function(n,t,e){"use strict";function a(n){d||e(1024)}Object.defineProperty(t,"__esModule",{value:!0});var i=e(848),s=e.n(i);for(var l in i)"default"!==l&&function(n){e.d(t,n,function(){return i[n]})}(l);var o=e(1026),r=e.n(o),d=!1,c=e(1),u=a,f=c(s.a,r.a,!1,u,"data-v-3619710e",null);f.options.__file="src\\views\\functions\\message-list.vue",t.default=f.exports},848:function(n,t,e){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={name:"message-list",data:function(){var n=this;return{loading:!1,columns:[{type:"selection",width:60,align:"center"},{title:"ID",key:"id",width:100},{title:"用户",key:"name"},{title:"时间",key:"alias"},{title:"标题",key:"alias"},{title:"电话",key:"alias"},{title:"邮箱",key:"alias"},{title:"QQ",key:"alias"},{title:"内容",key:"alias"},{title:"回复",key:"alias"},{title:"操作",key:"action",render:function(t,e){return t("div",[t("Button",{props:{type:"default",size:"small"},style:{marginRight:"5px"},on:{click:function(){}}},"回复"),t("Button",{props:{type:"default",size:"small"},on:{click:function(){n.remove(e.index)}}},"删除")])}}],data:[{id:1,name:"John Brown11",alias:"111"}]}},methods:{show:function(n){this.$Modal.info({title:"User Info",content:"Name："+this.data[n].name+"<br>Age："+this.data[n].age+"<br>Address："+this.data[n].address})},remove:function(n){this.data.splice(n,1)}}}}});