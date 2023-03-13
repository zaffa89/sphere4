import{b as t,o as d,c as N,w as e,z as x,$ as L,O as U,k as u,a0 as z,_ as J,u as a,a1 as b,r as $,l as o,a as n,F as w,p as C,v as h,y as g,s as A}from"./app.91faff10.js";import{_ as W}from"./ActionMessage.7c5d9094.js";import{_ as E,a as O,b as T,c as P}from"./SecondaryButton.cfd78292.js";import{_ as S}from"./Button.c5a44296.js";import{_ as R}from"./DangerButton.96411cc5.js";import{_ as Y}from"./FormSection.0e925b31.js";import{_ as q}from"./Input.3226e1fa.js";import{_ as G}from"./InputError.baa0f7fe.js";import{_ as B}from"./Label.6e6e483e.js";import{J as H}from"./SectionBorder.26bdf340.js";import"./plugin-vue_export-helper.21dcd24c.js";const K={class:"bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4"},Q={class:"sm:flex sm:items-start"},X=t("div",{class:"mx-auto shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"},[t("svg",{class:"h-6 w-6 text-red-600",stroke:"currentColor",fill:"none",viewBox:"0 0 24 24"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"})])],-1),Z={class:"mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"},ee={class:"text-lg"},se={class:"mt-2"},te={class:"flex flex-row justify-end px-6 py-4 bg-gray-100 text-right"},oe={__name:"ConfirmationModal",props:{show:{type:Boolean,default:!1},maxWidth:{type:String,default:"2xl"},closeable:{type:Boolean,default:!0}},emits:["close"],setup(i,{emit:y}){const r=()=>{y("close")};return(c,p)=>(d(),N(E,{show:i.show,"max-width":i.maxWidth,closeable:i.closeable,onClose:r},{default:e(()=>[t("div",K,[t("div",Q,[X,t("div",Z,[t("h3",ee,[x(c.$slots,"title")]),t("div",se,[x(c.$slots,"content")])])])]),t("div",te,[x(c.$slots,"footer")])]),_:3},8,["show","max-width","closeable"]))}},le=["value"],I={__name:"Checkbox",props:{checked:{type:[Array,Boolean],default:!1},value:{type:String,default:null}},emits:["update:checked"],setup(i,{emit:y}){const r=i,c=L({get(){return r.checked},set(p){y("update:checked",p)}});return(p,f)=>U((d(),u("input",{"onUpdate:modelValue":f[0]||(f[0]=m=>z(c)?c.value=m:null),type:"checkbox",value:i.value,class:"rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"},null,8,le)),[[J,a(c)]])}},ne={class:"col-span-6 sm:col-span-4"},ae={key:0,class:"col-span-6"},ie={class:"mt-2 grid grid-cols-1 md:grid-cols-2 gap-4"},re={class:"flex items-center"},ce={class:"ml-2 text-sm text-gray-600"},de={key:0},ue={class:"mt-10 sm:mt-0"},me={class:"space-y-6"},pe={class:"flex items-center"},fe={key:0,class:"text-sm text-gray-400"},ve=["onClick"],_e=["onClick"],ke=t("div",null," Please copy your new API token. For your security, it won't be shown again. ",-1),he={key:0,class:"mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500"},ge={class:"grid grid-cols-1 md:grid-cols-2 gap-4"},ye={class:"flex items-center"},xe={class:"ml-2 text-sm text-gray-600"},De={__name:"ApiTokenManager",props:{tokens:Array,availablePermissions:Array,defaultPermissions:Array},setup(i){const r=b({name:"",permissions:i.defaultPermissions}),c=b({permissions:[]}),p=b(),f=$(!1),m=$(null),_=$(null),V=()=>{r.post(route("api-tokens.store"),{preserveScroll:!0,onSuccess:()=>{f.value=!0,r.reset()}})},D=v=>{c.permissions=v.abilities,m.value=v},F=()=>{c.put(route("api-tokens.update",m.value),{preserveScroll:!0,preserveState:!0,onSuccess:()=>m.value=null})},j=v=>{_.value=v},M=()=>{p.delete(route("api-tokens.destroy",_.value),{preserveScroll:!0,preserveState:!0,onSuccess:()=>_.value=null})};return(v,l)=>(d(),u("div",null,[o(Y,{onSubmitted:V},{title:e(()=>[n(" Create API Token ")]),description:e(()=>[n(" API tokens allow third-party services to authenticate with our application on your behalf. ")]),form:e(()=>[t("div",ne,[o(B,{for:"name",value:"Name"}),o(q,{id:"name",modelValue:a(r).name,"onUpdate:modelValue":l[0]||(l[0]=s=>a(r).name=s),type:"text",class:"mt-1 block w-full",autofocus:""},null,8,["modelValue"]),o(G,{message:a(r).errors.name,class:"mt-2"},null,8,["message"])]),i.availablePermissions.length>0?(d(),u("div",ae,[o(B,{for:"permissions",value:"Permissions"}),t("div",ie,[(d(!0),u(w,null,C(i.availablePermissions,s=>(d(),u("div",{key:s},[t("label",re,[o(I,{checked:a(r).permissions,"onUpdate:checked":l[1]||(l[1]=k=>a(r).permissions=k),value:s},null,8,["checked","value"]),t("span",ce,h(s),1)])]))),128))])])):g("",!0)]),actions:e(()=>[o(W,{on:a(r).recentlySuccessful,class:"mr-3"},{default:e(()=>[n(" Created. ")]),_:1},8,["on"]),o(S,{class:A({"opacity-25":a(r).processing}),disabled:a(r).processing},{default:e(()=>[n(" Create ")]),_:1},8,["class","disabled"])]),_:1}),i.tokens.length>0?(d(),u("div",de,[o(H),t("div",ue,[o(O,null,{title:e(()=>[n(" Manage API Tokens ")]),description:e(()=>[n(" You may delete any of your existing tokens if they are no longer needed. ")]),content:e(()=>[t("div",me,[(d(!0),u(w,null,C(i.tokens,s=>(d(),u("div",{key:s.id,class:"flex items-center justify-between"},[t("div",null,h(s.name),1),t("div",pe,[s.last_used_ago?(d(),u("div",fe," Last used "+h(s.last_used_ago),1)):g("",!0),i.availablePermissions.length>0?(d(),u("button",{key:1,class:"cursor-pointer ml-6 text-sm text-gray-400 underline",onClick:k=>D(s)}," Permissions ",8,ve)):g("",!0),t("button",{class:"cursor-pointer ml-6 text-sm text-red-500",onClick:k=>j(s)}," Delete ",8,_e)])]))),128))])]),_:1})])])):g("",!0),o(T,{show:f.value,onClose:l[3]||(l[3]=s=>f.value=!1)},{title:e(()=>[n(" API Token ")]),content:e(()=>[ke,v.$page.props.jetstream.flash.token?(d(),u("div",he,h(v.$page.props.jetstream.flash.token),1)):g("",!0)]),footer:e(()=>[o(P,{onClick:l[2]||(l[2]=s=>f.value=!1)},{default:e(()=>[n(" Close ")]),_:1})]),_:1},8,["show"]),o(T,{show:m.value!=null,onClose:l[6]||(l[6]=s=>m.value=null)},{title:e(()=>[n(" API Token Permissions ")]),content:e(()=>[t("div",ge,[(d(!0),u(w,null,C(i.availablePermissions,s=>(d(),u("div",{key:s},[t("label",ye,[o(I,{checked:a(c).permissions,"onUpdate:checked":l[4]||(l[4]=k=>a(c).permissions=k),value:s},null,8,["checked","value"]),t("span",xe,h(s),1)])]))),128))])]),footer:e(()=>[o(P,{onClick:l[5]||(l[5]=s=>m.value=null)},{default:e(()=>[n(" Cancel ")]),_:1}),o(S,{class:A(["ml-3",{"opacity-25":a(c).processing}]),disabled:a(c).processing,onClick:F},{default:e(()=>[n(" Save ")]),_:1},8,["class","disabled"])]),_:1},8,["show"]),o(oe,{show:_.value!=null,onClose:l[8]||(l[8]=s=>_.value=null)},{title:e(()=>[n(" Delete API Token ")]),content:e(()=>[n(" Are you sure you would like to delete this API token? ")]),footer:e(()=>[o(P,{onClick:l[7]||(l[7]=s=>_.value=null)},{default:e(()=>[n(" Cancel ")]),_:1}),o(R,{class:A(["ml-3",{"opacity-25":a(p).processing}]),disabled:a(p).processing,onClick:M},{default:e(()=>[n(" Delete ")]),_:1},8,["class","disabled"])]),_:1},8,["show"])]))}};export{De as default};
