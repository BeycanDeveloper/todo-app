(function(t){function e(e){for(var n,r,s=e[0],d=e[1],c=e[2],p=0,u=[];p<s.length;p++)r=s[p],Object.prototype.hasOwnProperty.call(a,r)&&a[r]&&u.push(a[r][0]),a[r]=0;for(n in d)Object.prototype.hasOwnProperty.call(d,n)&&(t[n]=d[n]);l&&l(e);while(u.length)u.shift()();return i.push.apply(i,c||[]),o()}function o(){for(var t,e=0;e<i.length;e++){for(var o=i[e],n=!0,s=1;s<o.length;s++){var d=o[s];0!==a[d]&&(n=!1)}n&&(i.splice(e--,1),t=r(r.s=o[0]))}return t}var n={},a={app:0},i=[];function r(e){if(n[e])return n[e].exports;var o=n[e]={i:e,l:!1,exports:{}};return t[e].call(o.exports,o,o.exports,r),o.l=!0,o.exports}r.m=t,r.c=n,r.d=function(t,e,o){r.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:o})},r.r=function(t){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},r.t=function(t,e){if(1&e&&(t=r(t)),8&e)return t;if(4&e&&"object"===typeof t&&t&&t.__esModule)return t;var o=Object.create(null);if(r.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var n in t)r.d(o,n,function(e){return t[e]}.bind(null,n));return o},r.n=function(t){var e=t&&t.__esModule?function(){return t["default"]}:function(){return t};return r.d(e,"a",e),e},r.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},r.p="/";var s=window["webpackJsonp"]=window["webpackJsonp"]||[],d=s.push.bind(s);s.push=e,s=s.slice();for(var c=0;c<s.length;c++)e(s[c]);var l=d;i.push([0,"chunk-vendors"]),o()})({0:function(t,e,o){t.exports=o("56d7")},"56d7":function(t,e,o){"use strict";o.r(e);o("e260"),o("e6cf"),o("cca6"),o("a79d");var n=o("2b0e"),a=function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("v-app",[o("v-app-bar",{attrs:{app:"",color:"primary",dark:""}},[o("div",{staticClass:"d-flex align-center"},[t._v(" TodoList ")]),o("v-spacer"),o("v-tooltip",{attrs:{left:""},scopedSlots:t._u([{key:"activator",fn:function(e){var n=e.on,a=e.attrs;return[o("v-btn",t._g(t._b({attrs:{light:""},on:{click:function(e){return t.addNewTodo()}}},"v-btn",a,!1),n),[o("v-icon",[t._v("mdi-plus")])],1)]}}])},[o("span",[t._v("Add new todo")])])],1),o("v-main",[o("TodoList")],1)],1)},i=[],r=(o("d3b7"),o("3ca3"),o("ddb0"),o("2b3d"),function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("v-card",{staticClass:"list-sortable mx-auto mb-10 mt-10 rounded-lg",attrs:{"max-width":"350",tile:""}},[""!=t.todoList?o("div",[o("draggable",{attrs:{handle:".move-btn",group:"people"},on:{start:function(e){t.drag=!0},end:t.updateTodoListOrder},model:{value:t.todoList,callback:function(e){t.todoList=e},expression:"todoList"}},t._l(t.todoList,(function(e){return o("v-list-item",{key:e.id,staticClass:"list-item"},[o("v-list-item-content",[o("v-menu",{attrs:{"offset-y":"",rounded:""},scopedSlots:t._u([{key:"activator",fn:function(n){var a=n.on,i=n.attrs;return[o("v-btn",t._g(t._b({staticClass:"todo-menu",attrs:{icon:"",color:"primary"}},"v-btn",i,!1),a),[o("v-icon",[t._v("mdi-dots-vertical")])],1),e.status?o("div",[o("v-list-item-subtitle",{staticClass:"mb-2"},[t._v("Completed: "+t._s(e.completed))])],1):o("div",[o("v-list-item-subtitle",{staticClass:"mb-2"},[t._v("Updated: "+t._s(e.updated))]),o("v-list-item-subtitle",{staticClass:"mb-2"},[t._v("Created: "+t._s(e.created))])],1),o("v-list-item-title",{staticClass:"mb-2 relative",class:{completed:e.status}},[t._v(t._s(e.text))]),o("v-btn",{staticClass:"move-btn",attrs:{icon:"",color:"primary"}},[o("v-icon",[t._v("mdi-menu")])],1)]}}],null,!0)},[o("v-list",[0==e.status?o("v-list-item",{attrs:{link:""},on:{click:function(o){return t.completeTodo(e.id)}}},[o("v-list-item-title",[t._v("Complete")])],1):t._e(),0==e.status?o("v-list-item",{attrs:{link:""},on:{click:function(o){return t.updateTodo(e.id)}}},[o("v-list-item-title",[t._v("Update todo")])],1):t._e(),o("v-list-item",{attrs:{link:""},on:{click:function(o){return t.deleteTodo(e.id)}}},[o("v-list-item-title",[t._v("Delete todo")])],1)],1)],1)],1)],1)})),1)],1):o("div",{staticClass:"pa-5"},[t._v(" No todo found! ")])])}),s=[],d=(o("4160"),o("b64b"),o("159b"),new n["a"]),c=o("b76a"),l=o.n(c),p={name:"TodoList",components:{draggable:l.a},data:function(){return{apiUrl:document.getElementById("apiUrl").value,todoList:[]}},methods:{getTodoList:function(){this.todoList=[];var t=this;this.axios.get(this.apiUrl,{params:{action:"getTodoList"}}).then((function(e){""!=Object.keys(e.data)&&Object.keys(e.data).forEach((function(o){t.todoList.push(e.data[o])}))})).catch((function(t){console.log(t)}))},completeTodo:function(t){var e=this,o=new URLSearchParams;o.append("action","complete"),o.append("id",t),this.axios.post(this.apiUrl,o).then((function(t){e.getTodoList(),0==t.data?alert("There was a problem update Todo!"):alert("Mission completed successfully!")})).catch((function(t){console.log(t)}))},updateTodo:function(t){var e=this,o=prompt("What is your new quest content?");if(null!==o&&""!==o){var n=new URLSearchParams;n.append("action","update"),n.append("id",t),n.append("newTodo",o),this.axios.post(this.apiUrl,n).then((function(t){e.getTodoList(),0==t.data&&alert("There was a problem updated Todo!")})).catch((function(t){console.log(t)}))}},deleteTodo:function(t){var e=this,o=confirm("Are you sure you want to delete it? There is no turning back!");if(!0===o){var n=new URLSearchParams;n.append("action","delete"),n.append("id",t),this.axios.post(this.apiUrl,n).then((function(t){e.getTodoList(),0==t.data&&alert("There was a problem delete Todo!")})).catch((function(t){console.log(t)}))}},updateTodoListOrder:function(){var t=new URLSearchParams;t.append("action","updateListOrder"),t.append("todoList",JSON.stringify(this.todoList)),this.axios.post(this.apiUrl,t).then((function(t){0==t.data&&alert("An unexpected problem has occurred!")})).catch((function(t){console.log(t)}))}},created:function(){var t=this;this.getTodoList(),d.$on("newTodoAdded",(function(){t.getTodoList()}))}},u=p,f=(o("ed30"),o("2877")),v=o("6544"),h=o.n(v),m=o("8336"),b=o("b0af"),g=o("132d"),T=o("8860"),y=o("da13"),_=o("5d23"),L=o("e449"),w=Object(f["a"])(u,r,s,!1,null,null,null),x=w.exports;h()(w,{VBtn:m["a"],VCard:b["a"],VIcon:g["a"],VList:T["a"],VListItem:y["a"],VListItemContent:_["a"],VListItemSubtitle:_["b"],VListItemTitle:_["c"],VMenu:L["a"]});var O={name:"App",components:{TodoList:x},data:function(){return{apiUrl:document.getElementById("apiUrl").value}},methods:{addNewTodo:function(){var t=prompt("What is your new quest content?");if(null!==t&&""!==t){var e=new URLSearchParams;e.append("action","add"),e.append("newTodo",t),this.axios.post(this.apiUrl,e).then((function(t){d.$emit("newTodoAdded"),0==t.data&&alert("There was a problem updated Todo!")})).catch((function(t){console.log(t)}))}}}},k=O,V=o("7496"),j=o("40dc"),C=o("f6c4"),S=o("2fa4"),U=o("3a2f"),P=Object(f["a"])(k,a,i,!1,null,null,null),A=P.exports;h()(P,{VApp:V["a"],VAppBar:j["a"],VBtn:m["a"],VIcon:g["a"],VMain:C["a"],VSpacer:S["a"],VTooltip:U["a"]});var M=o("f309");n["a"].use(M["a"]);var I=new M["a"]({}),R=o("bc3a"),$=o.n(R),N=o("2106"),B=o.n(N);n["a"].use(B.a,$.a),n["a"].config.productionTip=!1,new n["a"]({vuetify:I,render:function(t){return t(A)}}).$mount("#app")},"89d2":function(t,e,o){},ed30:function(t,e,o){"use strict";o("89d2")}});
//# sourceMappingURL=app.52debc38.js.map