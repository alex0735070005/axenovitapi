(this.webpackJsonpreact_app=this.webpackJsonpreact_app||[]).push([[13],{175:function(e,a,t){e.exports={box:"styles_box__1dlOK",tabPanel:"styles_tabPanel__3_QOX"}},179:function(e,a,t){e.exports={root:"styles_root__3b7Xq",tabPanel:"styles_tabPanel__16PyR",tabs:"styles_tabs__p2GYB"}},236:function(e,a,t){"use strict";t.r(a);var n=t(51),l=t(0),r=t.n(l),c=t(238),i=t(233),o=t(82),s=t(222),d=t(234),u=t(175),m=t.n(u),b=function(e){var a=e.children,t=e.value,n=e.index,l=Object(o.a)(e,["children","value","index"]);return r.a.createElement(s.a,Object.assign({className:m.a.tabPanel,component:"div",role:"tabpanel",hidden:t!==n,id:"vertical-tabpanel-".concat(n),"aria-labelledby":"vertical-tab-".concat(n)},l),t===n&&r.a.createElement(d.a,{className:m.a.box},a))},p=t(180),g=t.n(p),h=t(181),f=t.n(h),E=t(230),v=t(231),y=t(227),O=t(228),x=t(229),P=t(242),j=t(214),k=t(241),S=t(232),_=t(219),w=t(226),C=t(251),N=[{id:"username",numeric:!1,disablePadding:!0,label:"Username"},{id:"id",numeric:!0,disablePadding:!1,label:"Id"},{id:"email",numeric:!0,disablePadding:!1,label:"Email"},{id:"verify",numeric:!0,disablePadding:!1,label:"Status"},{id:"role",numeric:!0,disablePadding:!1,label:"Role"},{id:"api_key",numeric:!0,disablePadding:!1,label:"Api key"}],R=function(e){var a=e.classes,t=e.onSelectAllClick,n=e.order,l=e.orderBy,c=e.numSelected,i=e.rowCount,o=e.onRequestSort;return r.a.createElement(w.a,null,r.a.createElement(y.a,null,r.a.createElement(O.a,{padding:"checkbox"},r.a.createElement(k.a,{indeterminate:c>0&&c<i,checked:c===i,onChange:t,inputProps:{"aria-label":"select all desserts"}})),N.map((function(e){return r.a.createElement(O.a,{key:e.id,align:e.numeric?"right":"left",padding:e.disablePadding?"none":"default",sortDirection:l===e.id&&n},r.a.createElement(C.a,{active:l===e.id,direction:n,onClick:(t=e.id,function(e){o(e,t)})},e.label,l===e.id?r.a.createElement("span",{className:a.visuallyHidden},"desc"===n?"sorted descending":"sorted ascending"):null));var t}))))},A=t(105),U=t(218),B=t(40),T=t(220),q=t(252),D=t(177),I=t.n(D),W=t(178),z=t.n(W),H=t(221),J=t(49),X=Object(H.a)((function(e){return{root:{paddingLeft:e.spacing(2),paddingRight:e.spacing(1)},highlight:"light"===e.palette.type?{color:e.palette.secondary.main,backgroundColor:Object(J.e)(e.palette.secondary.light,.85)}:{color:e.palette.text.primary,backgroundColor:e.palette.secondary.dark},title:{flex:"1 1 100%"}}})),F=function(e){var a=X(),t=e.numSelected;return r.a.createElement(U.a,{className:Object(B.a)(a.root,Object(A.a)({},a.highlight,t>0))},t>0?r.a.createElement(s.a,{className:a.title,color:"inherit",variant:"subtitle1"},t,"selected"):r.a.createElement(s.a,{className:a.title,variant:"h6",id:"tableTitle"},"Users"),t>0?r.a.createElement(q.a,{title:"Delete"},r.a.createElement(T.a,{"aria-label":"delete"},r.a.createElement(I.a,null))):r.a.createElement(q.a,{title:"Filter list"},r.a.createElement(T.a,{"aria-label":"filter list"},r.a.createElement(z.a,null))))},G=Object(H.a)((function(e){return{root:{width:"100%"},paper:{width:"100%",marginBottom:e.spacing(2)},table:{minWidth:"100%",width:"100%"},visuallyHidden:{border:0,clip:"rect(0 0 0 0)",height:1,margin:-1,overflow:"hidden",padding:0,position:"absolute",top:20,width:1}}})),K=function(e,a,t){return a[t]<e[t]?-1:a[t]>e[t]?1:0},L=function(e){var a=e.rows,t=G(),l=r.a.useState("desc"),c=Object(n.a)(l,2),i=c[0],o=c[1],s=r.a.useState("id"),d=Object(n.a)(s,2),u=d[0],m=d[1],b=r.a.useState([]),p=Object(n.a)(b,2),g=p[0],h=p[1],f=r.a.useState(0),w=Object(n.a)(f,2),C=w[0],N=w[1],A=r.a.useState(!1),U=Object(n.a)(A,2),B=U[0],T=U[1],q=r.a.useState(10),D=Object(n.a)(q,2),I=D[0],W=D[1];return r.a.createElement("div",{className:t.root},r.a.createElement(j.a,{className:t.paper},r.a.createElement(F,{numSelected:g.length}),r.a.createElement(x.a,null,r.a.createElement(E.a,{className:t.table,"aria-labelledby":"tableTitle",size:B?"small":"medium","aria-label":"enhanced table"},r.a.createElement(R,{classes:t,numSelected:g.length,order:i,orderBy:u,onSelectAllClick:function(e){if(e.target.checked){var t=a.map((function(e){return e.id}));h(t)}else h([])},onRequestSort:function(e,a){o(u===a&&"desc"===i?"asc":"desc"),m(a)},rowCount:a.length}),r.a.createElement(v.a,null,function(e,a){var t=e.map((function(e,a){return[e,a]}));return t.sort((function(e,t){var n=a(e[0],t[0]);return 0!==n?n:e[1]-t[1]})),t.map((function(e){return e[0]}))}(a,function(e,a){return"desc"===e?function(e,t){return K(e,t,a)}:function(e,t){return-K(e,t,a)}}(i,u)).slice(C*I,C*I+I).map((function(e,a){var t,n=(t=e.id,-1!==g.indexOf(t)),l="enhanced-table-checkbox-".concat(a);return r.a.createElement(y.a,{hover:!0,onClick:function(a){return function(e,a){var t=g.indexOf(a),n=[];-1===t?n=n.concat(g,a):0===t?n=n.concat(g.slice(1)):t===g.length-1?n=n.concat(g.slice(0,-1)):t>0&&(n=n.concat(g.slice(0,t),g.slice(t+1))),h(n)}(0,e.id)},role:"checkbox","aria-checked":n,tabIndex:-1,key:e.id,selected:n},r.a.createElement(O.a,{padding:"checkbox"},r.a.createElement(k.a,{checked:n,inputProps:{"aria-labelledby":l}})),r.a.createElement(O.a,{component:"th",id:l,scope:"row",padding:"none"},e.username),r.a.createElement(O.a,{align:"right"},e.id),r.a.createElement(O.a,{align:"right"},e.email),r.a.createElement(O.a,{align:"right"},e.verify?"verify":"not verify"),r.a.createElement(O.a,{align:"right"},e.roles.join(", ")),r.a.createElement(O.a,{align:"right"},e.api_key))}))))),r.a.createElement(P.a,{rowsPerPageOptions:[5,10,25],component:"div",count:a.length,rowsPerPage:I,page:C,onChangePage:function(e,a){N(a)},onChangeRowsPerPage:function(e){W(parseInt(e.target.value,10)),N(0)}})),r.a.createElement(S.a,{control:r.a.createElement(_.a,{checked:B,onChange:function(e){T(e.target.checked)}}),label:"Dense padding"}))},Q=t(72),V={users:[]},Y=function(e,a){switch(a.type){case"SET_USERS":var t=a.payload.users;return Object(Q.a)({},e,{users:t});default:return e}},M=Object(l.createContext)(V),Z=function(e){var a=e.children,t=Object(l.useReducer)(Y,V),c=Object(n.a)(t,2),i=c[0],o=c[1];return r.a.createElement(M.Provider,{value:{store:i,dispatch:o}},a)};var $,ee=t(54),ae=t.n(ee),te=($=function(){var e=Object(l.useContext)(M),a=e.store,t=e.dispatch,n=a.users;return Object(l.useState)((function(){return function(e){return ae.a.get("/admin/users").then((function(a){var t=a.data;e({type:"SET_USERS",payload:{users:t.users}})}))}(t)})),r.a.createElement(L,{rows:n})},function(e){return r.a.createElement(Z,null,r.a.createElement($,e))}),ne=Object(H.a)((function(){return{root:{minWidth:"100px",padding:0,margin:"0 15px 5px 0",border:"1px solid #ddd"}}})),le=function(e){return{id:"vertical-tab-".concat(e),"aria-controls":"vertical-tabpanel-".concat(e)}},re=t(179),ce=t.n(re);a.default=function(){var e=ne(),a=r.a.useState(0),t=Object(n.a)(a,2),l=t[0],o=t[1],s=window.innerWidth>1140?"vertical":"horizontal";return r.a.createElement("div",{className:ce.a.root},r.a.createElement(c.a,{variant:"scrollable",orientation:s,value:l,onChange:function(e,a){o(a)},"aria-label":"Vertical tabs example",className:ce.a.tabs},r.a.createElement(i.a,Object.assign({classes:e,label:"Users",icon:r.a.createElement(g.a,null)},le(0))),r.a.createElement(i.a,Object.assign({classes:e,label:"Analytics",icon:r.a.createElement(f.a,null)},le(1)))),r.a.createElement(b,{className:ce.a.tabPanel,value:l,index:0},r.a.createElement(te,null)),r.a.createElement(b,{className:ce.a.tabPanel,value:l,index:1},"Analytics info"))}}}]);
//# sourceMappingURL=13.3ff994d6.chunk.js.map