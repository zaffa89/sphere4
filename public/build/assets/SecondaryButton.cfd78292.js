import{o as i,k as f,l as c,w as n,z as o,b as s,a3 as w,a4 as v,a5 as x,$ as _,c as p,a6 as g,T as m,O as u,a2 as y,s as b,u as $,y as k}from"./app.91faff10.js";import{J as B}from"./InputError.baa0f7fe.js";const S={class:"md:grid md:grid-cols-3 md:gap-6"},C={class:"mt-5 md:mt-0 md:col-span-2"},E={class:"px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg"},U={__name:"ActionSection",setup(e){return(t,a)=>(i(),f("div",S,[c(B,null,{title:n(()=>[o(t.$slots,"title")]),description:n(()=>[o(t.$slots,"description")]),_:3}),s("div",C,[s("div",E,[o(t.$slots,"content")])])]))}},W={class:"fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50","scroll-region":""},T=s("div",{class:"absolute inset-0 bg-gray-500 opacity-75"},null,-1),z=[T],M={__name:"Modal",props:{show:{type:Boolean,default:!1},maxWidth:{type:String,default:"2xl"},closeable:{type:Boolean,default:!0}},emits:["close"],setup(e,{emit:t}){const a=e;w(()=>a.show,()=>{a.show?document.body.style.overflow="hidden":document.body.style.overflow=null});const l=()=>{a.closeable&&t("close")},r=d=>{d.key==="Escape"&&a.show&&l()};v(()=>document.addEventListener("keydown",r)),x(()=>{document.removeEventListener("keydown",r),document.body.style.overflow=null});const h=_(()=>({sm:"sm:max-w-sm",md:"sm:max-w-md",lg:"sm:max-w-lg",xl:"sm:max-w-xl","2xl":"sm:max-w-2xl"})[a.maxWidth]);return(d,O)=>(i(),p(g,{to:"body"},[c(m,{"leave-active-class":"duration-200"},{default:n(()=>[u(s("div",W,[c(m,{"enter-active-class":"ease-out duration-300","enter-from-class":"opacity-0","enter-to-class":"opacity-100","leave-active-class":"ease-in duration-200","leave-from-class":"opacity-100","leave-to-class":"opacity-0"},{default:n(()=>[u(s("div",{class:"fixed inset-0 transform transition-all",onClick:l},z,512),[[y,e.show]])]),_:1}),c(m,{"enter-active-class":"ease-out duration-300","enter-from-class":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95","enter-to-class":"opacity-100 translate-y-0 sm:scale-100","leave-active-class":"ease-in duration-200","leave-from-class":"opacity-100 translate-y-0 sm:scale-100","leave-to-class":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"},{default:n(()=>[u(s("div",{class:b(["mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto",$(h)])},[e.show?o(d.$slots,"default",{key:0}):k("",!0)],2),[[y,e.show]])]),_:3})],512),[[y,e.show]])]),_:3})]))}},N={class:"px-6 py-4"},V={class:"text-lg"},D={class:"mt-4"},J={class:"flex flex-row justify-end px-6 py-4 bg-gray-100 text-right"},q={__name:"DialogModal",props:{show:{type:Boolean,default:!1},maxWidth:{type:String,default:"2xl"},closeable:{type:Boolean,default:!0}},emits:["close"],setup(e,{emit:t}){const a=()=>{t("close")};return(l,r)=>(i(),p(M,{show:e.show,"max-width":e.maxWidth,closeable:e.closeable,onClose:a},{default:n(()=>[s("div",N,[s("div",V,[o(l.$slots,"title")]),s("div",D,[o(l.$slots,"content")])]),s("div",J,[o(l.$slots,"footer")])]),_:3},8,["show","max-width","closeable"]))}},L=["type"],F={__name:"SecondaryButton",props:{type:{type:String,default:"button"}},setup(e){return(t,a)=>(i(),f("button",{type:e.type,class:"inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition"},[o(t.$slots,"default")],8,L))}};export{M as _,U as a,q as b,F as c};
