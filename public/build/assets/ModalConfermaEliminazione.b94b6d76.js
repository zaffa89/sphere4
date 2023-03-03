import{d as e,W as u,o as c,c as f,u as s,H as p,w as a,f as o,I as y,J as r,_ as g,g as x,au as h,U as v,a as _,B as d}from"./app.ff11f486.js";const b=e("div",{class:"fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"},null,-1),w={class:"fixed inset-0 z-10 overflow-y-auto"},$={class:"flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"},k={class:"absolute top-0 right-0 hidden pt-4 pr-4 sm:block"},C=e("span",{class:"sr-only"},"Close",-1),j={class:"sm:flex sm:items-start"},S={class:"mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"},z={class:"mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"},B={class:"mt-2"},A={class:"text-sm text-gray-500"},N={class:"text-sm text-gray-500"},V={class:"mt-5 sm:mt-4 sm:flex sm:flex-row-reverse"},E={props:{title:{type:String,default:"Attenzione"},text:{type:String,default:"Sei sicuro di voler eliminare questo elemento?"},description:{type:String,default:null}},emits:["close","delete"]},q=Object.assign(E,{__name:"ModalConfermaEliminazione",setup(l){const m=u(!0);return(n,t)=>(c(),f(s(p),{as:"template",show:m.value},{default:a(()=>[o(s(y),{as:"div",class:"relative z-10",onClose:t[3]||(t[3]=i=>n.$emit("close"))},{default:a(()=>[o(s(r),{as:"template",enter:"ease-out duration-300","enter-from":"opacity-0","enter-to":"opacity-100",leave:"ease-in duration-200","leave-from":"opacity-100","leave-to":"opacity-0"},{default:a(()=>[b]),_:1}),e("div",w,[e("div",$,[o(s(r),{as:"template",enter:"ease-out duration-300","enter-from":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95","enter-to":"opacity-100 translate-y-0 sm:scale-100",leave:"ease-in duration-200","leave-from":"opacity-100 translate-y-0 sm:scale-100","leave-to":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"},{default:a(()=>[o(s(g),{class:"relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6"},{default:a(()=>[e("div",k,[e("button",{type:"button",class:"rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2",onClick:t[0]||(t[0]=i=>n.$emit("close"))},[C,o(s(x),{class:"h-6 w-6","aria-hidden":"true"})])]),e("div",j,[e("div",S,[o(s(h),{class:"h-6 w-6 text-red-600","aria-hidden":"true"})]),e("div",z,[o(s(v),{as:"h3",class:"text-lg font-medium leading-6 text-gray-900"},{default:a(()=>[_(" Attenzione ")]),_:1}),e("div",B,[e("p",A,d(l.text),1),e("p",N,d(l.description),1)])])]),e("div",V,[e("button",{type:"button",class:"inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm",onClick:t[1]||(t[1]=i=>n.$emit("delete"))}," Elimina "),e("button",{type:"button",class:"mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm",onClick:t[2]||(t[2]=i=>n.$emit("close"))}," Annulla ")])]),_:1})]),_:1})])])]),_:1})]),_:1},8,["show"]))}});export{q as default};
