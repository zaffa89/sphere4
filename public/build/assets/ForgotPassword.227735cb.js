import{d as t,R as c,o as m,e as l,F as u,f as s,u as e,a4 as _,w as i,B as f,C as p,a3 as b,n as g,a as v}from"./app.d1109b7e.js";import{J as w,_ as x}from"./AuthenticationCardLogo.bc4634f2.js";import{_ as V}from"./Button.434d1007.js";import{_ as h}from"./Input.89377d6a.js";import{_ as y}from"./Label.b37dc091.js";import{_ as C}from"./ValidationErrors.e76af4b3.js";import"./plugin-vue_export-helper.21dcd24c.js";const N=t("div",{class:"mb-4 text-sm text-gray-600"}," Password dimenticata? Nessun problema. Inserisci il tuo indirizzo email, riceverai le istruzioni per ripristinare la tua password. ",-1),$={key:0,class:"mb-4 font-medium text-sm text-green-600"},k=["onSubmit"],z={class:"flex items-center justify-end mt-4"},q={__name:"ForgotPassword",props:{status:String},setup(o){const a=c({email:""}),n=()=>{a.post(route("password.email"))};return(B,r)=>(m(),l(u,null,[s(e(_),{title:"Forgot Password"}),s(w,null,{logo:i(()=>[s(x)]),default:i(()=>[N,o.status?(m(),l("div",$,f(o.status),1)):p("",!0),s(C,{class:"mb-4"}),t("form",{onSubmit:b(n,["prevent"])},[t("div",null,[s(y,{for:"email",value:"Email"}),s(h,{id:"email",modelValue:e(a).email,"onUpdate:modelValue":r[0]||(r[0]=d=>e(a).email=d),type:"email",class:"mt-1 block w-full",required:"",autofocus:""},null,8,["modelValue"])]),t("div",z,[s(V,{class:g({"opacity-25":e(a).processing}),disabled:e(a).processing},{default:i(()=>[v(" Invia mail di ripristino ")]),_:1},8,["class","disabled"])])],40,k)]),_:1})],64))}};export{q as default};