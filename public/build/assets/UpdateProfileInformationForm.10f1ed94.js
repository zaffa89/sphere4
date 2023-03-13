import{a1 as V,r as k,o as _,c as h,w as i,a as r,b as l,l as e,u as a,k as g,N as x,a8 as b,O as w,a2 as y,y as N}from"./app.91faff10.js";import{_ as U}from"./FormSection.0e925b31.js";import{_ as m}from"./Input.3226e1fa.js";import{_ as u}from"./InputError.baa0f7fe.js";import{_ as c}from"./Label.6e6e483e.js";import"./plugin-vue_export-helper.21dcd24c.js";const C={class:"col-span-6 sm:col-span-4"},$={class:"col-span-6 sm:col-span-4"},z={class:"col-span-6 sm:col-span-4"},B={key:0},E={class:"text-sm mt-2 text-red-600"},P={class:"mt-2 font-medium text-sm text-green-600"},F={__name:"UpdateProfileInformationForm",props:{user:Object},setup(d){const n=d,o=V({_method:"PUT",username:n.user.username,email:n.user.email,telefono:n.user.telefono}),f=k(null),v=()=>{f.value=!0};return(p,s)=>(_(),h(U,null,{title:i(()=>[r(" Profilo utente ")]),description:i(()=>[]),form:i(()=>[l("div",C,[e(c,{for:"username",value:"Nome utente"}),e(m,{id:"username",modelValue:a(o).username,"onUpdate:modelValue":s[0]||(s[0]=t=>a(o).username=t),type:"text",class:"mt-1 block w-full",autocomplete:"username",disabled:""},null,8,["modelValue"]),e(u,{message:a(o).errors.username,class:"mt-2"},null,8,["message"])]),l("div",$,[e(c,{for:"telefono",value:"Telefono"}),e(m,{id:"telefono",modelValue:a(o).telefono,"onUpdate:modelValue":s[1]||(s[1]=t=>a(o).telefono=t),type:"text",class:"mt-1 block w-full",autocomplete:"telefono",disabled:""},null,8,["modelValue"]),e(u,{message:a(o).errors.telefono,class:"mt-2"},null,8,["message"])]),l("div",z,[e(c,{for:"email",value:"Email"}),e(m,{id:"email",modelValue:a(o).email,"onUpdate:modelValue":s[2]||(s[2]=t=>a(o).email=t),type:"email",class:"mt-1 block w-full",disabled:""},null,8,["modelValue"]),e(u,{message:a(o).errors.email,class:"mt-2"},null,8,["message"]),p.$page.props.jetstream.hasEmailVerification&&d.user.email_verified_at===null?(_(),g("div",B,[l("p",E,[r(" Questo indirizzo email non \xE8 stato verificato. "),e(a(x),{href:p.route("verification.send"),method:"post",as:"button",class:"underline text-gray-600 hover:text-gray-900",onClick:b(v,["prevent"])},{default:i(()=>[r(" Clicca qui per ricevere una mail di verifica. ")]),_:1},8,["href","onClick"])]),w(l("div",P," Un link di verifica \xE8 stato inviato al tuo indirizzo email. ",512),[[y,f.value]])])):N("",!0)])]),_:1}))}};export{F as default};
