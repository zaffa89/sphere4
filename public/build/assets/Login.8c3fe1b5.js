import{a6 as g,d as e,W as x,Z as b,R as w,a5 as v,o as d,e as m,F as _,f as r,u as s,a4 as y,B as k,C as c,a7 as C,a8 as S,w as V,n as f,a9 as B,a3 as M,D as u,G as p,L as R}from"./app.e0b64a2d.js";import{_ as U}from"./ValidationErrors.63039765.js";const j={class:"min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8"},E=g('<div class="absolute top-8 left-1/2 -translate-x-1/2 overflow-hidden z-10"><svg viewBox="0 0 558 558" width="100%" height="558" fill="none" aria-hidden="true" class="animate-spin-slower"><defs><linearGradient id=":R3b9m:" x1="79" y1="16" x2="105" y2="237" gradientUnits="userSpaceOnUse"><stop stop-color="#13B5C8"></stop><stop offset="1" stop-color="#13B5C8" stop-opacity="0"></stop></linearGradient></defs><path opacity=".2" d="M1 279C1 125.465 125.465 1 279 1s278 124.465 278 278-124.465 278-278 278S1 432.535 1 279Z" stroke="#13B5C8"></path><path d="M1 279C1 125.465 125.465 1 279 1" stroke="url(#:R3b9m:)" stroke-linecap="round"></path></svg></div><div class="sm:mx-auto sm:w-full sm:max-w-md"><img class="mx-auto h-12 w-auto" src="/storage/header_logo.png"><h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-white">Entra con il tuo profilo</h2></div>',2),N={class:"mt-8 sm:mx-auto sm:w-full sm:max-w-md z-20"},L={class:"bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10"},P={key:0,class:"mb-4 font-medium text-sm text-green-600"},z={class:"flex justify-end mb-4"},D=e("span",{"aria-hidden":"true",class:"pointer-events-none absolute h-full w-full rounded-md bg-white"},null,-1),F=["onSubmit"],G=e("label",{for:"username",class:"block text-sm font-medium text-gray-700"}," Nome utente ",-1),q={class:"mt-1"},I=e("label",{for:"password",class:"block text-sm font-medium text-gray-700"}," Password ",-1),Z={class:"mt-1"},$={class:"flex items-center justify-between"},A={class:"flex items-center"},J=e("label",{for:"remember-me",class:"ml-2 block text-sm text-gray-900"}," Ricordami ",-1),O={key:0,class:"text-sm"},T=e("a",{href:"#",class:"font-medium text-indigo-600 hover:text-indigo-500"}," Password dimenticata? ",-1),W=[T],X=e("div",null,[e("button",{type:"submit",class:"w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},"Entra")],-1),Q={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(l){const n=x(localStorage.theme=="dark");b(n,i=>{i?(localStorage.setItem("theme","dark"),document.documentElement.classList.add("dark")):(localStorage.setItem("theme","light"),document.documentElement.classList.remove("dark"))});const t=w({username:"solutionmed",password:"password",remember:!1,token:v().props.token}),h=()=>{t.transform(i=>({...i,remember:t.remember?"on":""})).post(route("sphere.login"),{onFinish:()=>t.reset("password")})};return(i,o)=>(d(),m(_,null,[r(s(y),{title:"Accesso"}),e("div",j,[E,e("div",N,[e("div",L,[r(U,{class:"mb-4"}),l.status?(d(),m("div",P,k(l.status),1)):c("",!0),e("div",z,[r(s(C),{class:"h-5 w-5"}),r(s(S),{modelValue:n.value,"onUpdate:modelValue":o[0]||(o[0]=a=>n.value=a),class:"group mx-2 relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"},{default:V(()=>[D,e("span",{"aria-hidden":"true",class:f([n.value?"bg-gray-800":"bg-gray-200","pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out"])},null,2),e("span",{"aria-hidden":"true",class:f([n.value?"translate-x-5":"translate-x-0","pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-gray-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out"])},null,2)]),_:1},8,["modelValue"]),r(s(B),{class:"h-5 w-5"})]),e("form",{class:"space-y-6",onSubmit:M(h,["prevent"])},[e("div",null,[G,e("div",q,[u(e("input",{"onUpdate:modelValue":o[1]||(o[1]=a=>s(t).username=a),id:"username",name:"username",type:"text",autocomplete:"username",required:"",class:"appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"},null,512),[[p,s(t).username]])])]),e("div",null,[I,e("div",Z,[u(e("input",{"onUpdate:modelValue":o[2]||(o[2]=a=>s(t).password=a),id:"password",name:"password",type:"password",autocomplete:"current-password",required:"",class:"appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"},null,512),[[p,s(t).password]])])]),e("div",$,[e("div",A,[u(e("input",{"onUpdate:modelValue":o[3]||(o[3]=a=>s(t).remember=a),id:"remember-me",name:"remember-me",type:"checkbox",class:"h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"},null,512),[[R,s(t).remember]]),J]),l.canResetPassword?(d(),m("div",O,W)):c("",!0)]),X],40,F)])])])],64))}};export{Q as default};
