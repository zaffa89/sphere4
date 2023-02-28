import{W as p,ac as M,aa as I,o as t,e as n,d as s,h as N,f as i,w as o,a,B as C,ab as V,n as x,R as H,N as O,a5 as Q,Z as E,O as K,c as y,u as v,C as u,F as D,y as U}from"./app.e0b64a2d.js";import{b as J,c as z,a as W}from"./SecondaryButton.462df016.js";import{_ as F}from"./Button.62640769.js";import{_ as B}from"./Input.02e1f235.js";import{_ as L}from"./InputError.b31e8435.js";import{_ as Z}from"./DangerButton.a2f64e36.js";import{_ as j}from"./Label.56f987b8.js";import"./plugin-vue_export-helper.21dcd24c.js";const X={class:"mt-4"},g={__name:"ConfirmsPassword",props:{title:{type:String,default:"Confirm Password"},content:{type:String,default:"For your security, please confirm your password to continue."},button:{type:String,default:"Confirm"}},emits:["confirmed"],setup(w,{emit:b}){const l=p(!1),e=M({password:"",error:"",processing:!1}),c=p(null),h=()=>{axios.get(route("password.confirmation")).then(r=>{r.data.confirmed?b("confirmed"):(l.value=!0,setTimeout(()=>c.value.focus(),250))})},_=()=>{e.processing=!0,axios.post(route("password.confirm"),{password:e.password}).then(()=>{e.processing=!1,d(),I().then(()=>b("confirmed"))}).catch(r=>{e.processing=!1,e.error=r.response.data.errors.password[0],c.value.focus()})},d=()=>{l.value=!1,e.password="",e.error=""};return(r,m)=>(t(),n("span",null,[s("span",{onClick:h},[N(r.$slots,"default")]),i(J,{show:l.value,onClose:d},{title:o(()=>[a(C(w.title),1)]),content:o(()=>[a(C(w.content)+" ",1),s("div",X,[i(B,{ref_key:"passwordInput",ref:c,modelValue:e.password,"onUpdate:modelValue":m[0]||(m[0]=S=>e.password=S),type:"password",class:"mt-1 block w-3/4",placeholder:"Password",onKeyup:V(_,["enter"])},null,8,["modelValue","onKeyup"]),i(L,{message:e.error,class:"mt-2"},null,8,["message"])])]),footer:o(()=>[i(z,{onClick:d},{default:o(()=>[a(" Cancel ")]),_:1}),i(F,{class:x(["ml-3",{"opacity-25":e.processing}]),disabled:e.processing,onClick:_},{default:o(()=>[a(C(w.button),1)]),_:1},8,["class","disabled"])]),_:1},8,["show"])]))}},Y=s("p",{class:"font-medium"},[a("L'autenticazione a 2 Fattori \xE8 "),s("span",{class:"text-red-500"},"OBBLIGATORIA"),a(" per accedere a Sphere tramite browser")],-1),ee={key:0,class:"text-lg font-medium text-gray-900"},te={key:1,class:"text-lg font-medium text-gray-900"},oe={key:2,class:"text-lg font-medium text-gray-900"},ae=s("div",{class:"mt-3 max-w-xl text-sm text-gray-600"},[s("p",null," Quando l'autenticazione a due fattori \xE8 attiva, ad ogni tentativo di accesso a Sphere tramite browser ti verr\xE0 richiesto un codice di sicurezza. Puoi ottenere il codice dall'applicazione Google Authenticator del tuo telefono. ")],-1),se={key:3},ne={key:0},ie={class:"mt-4 max-w-xl text-sm text-gray-600"},re={key:0,class:"font-semibold"},le=s("b",null,"Google Authenticator",-1),ce=s("b",null,"Google Authenticator",-1),ue={key:1},de=s("b",null,"Setup Key",-1),me=["innerHTML"],fe={key:0,class:"mt-4 max-w-xl text-sm text-gray-600"},pe={class:"font-semibold"},_e=["innerHTML"],ve={key:1,class:"mt-4"},he={key:1},ye=s("div",{class:"mt-4 max-w-xl text-sm text-gray-600"},[s("p",{class:"font-semibold"}," Salva questi codici di recupero in un posto sicuro. Possono essere utilizzati per recuperare l'accesso al tuo account se il dispositivo utilizzato per l'autenticazione a 2 fattori venga perso o sia inutilizzabile. ")],-1),ge={class:"grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg"},we={class:"mt-5"},xe={key:0},be={key:1},$e={__name:"TwoFactorAuthenticationForm",props:{requiresConfirmation:Boolean},setup(w){const b=w,l=p(!1),e=p(!1),c=p(!1),h=p(null),_=p(null),d=p([]),r=H({code:""}),m=O(()=>{var f;return!l.value&&((f=Q().props.user)==null?void 0:f.two_factor_enabled)});E(m,()=>{m.value||(r.reset(),r.clearErrors())});const S=()=>{l.value=!0,K.post("/user/two-factor-authentication",{},{preserveScroll:!0,onSuccess:()=>Promise.all([R(),q(),A()]),onFinish:()=>{l.value=!1,e.value=b.requiresConfirmation}})},R=()=>axios.get("/user/two-factor-qr-code").then(f=>{h.value=f.data.svg}),q=()=>axios.get("/user/two-factor-secret-key").then(f=>{_.value=f.data.secretKey}),A=()=>axios.get("/user/two-factor-recovery-codes").then(f=>{d.value=f.data}),T=()=>{r.post("/user/confirmed-two-factor-authentication",{errorBag:"confirmTwoFactorAuthentication",preserveScroll:!0,preserveState:!0,onSuccess:()=>{e.value=!1,h.value=null,_.value=null}})},G=()=>{axios.post("/user/two-factor-recovery-codes").then(()=>A())},P=()=>{c.value=!0,K.delete("/user/two-factor-authentication",{preserveScroll:!0,onSuccess:()=>{c.value=!1,e.value=!1}})};return(f,$)=>(t(),y(W,null,{title:o(()=>[a(" Autenticazione a 2 fattori ")]),description:o(()=>[a(" Sicurezza aggiuntiva per il tuo account. "),Y]),content:o(()=>[v(m)&&!e.value?(t(),n("h3",ee," L'autenticazione a 2 fattori \xE8 abilitata. ")):v(m)&&e.value?(t(),n("h3",te," Attivazione dell'autenticazione a due fattori ")):(t(),n("h3",oe," Autenticazione a 2 fattori non abilitata. ")),ae,v(m)?(t(),n("div",se,[h.value?(t(),n("div",ne,[s("div",ie,[e.value?(t(),n("p",re,[a(" Per attivare l'autenticazione a due fattori, scarica l'App "),le,a(" da Google Play o Apple Store. Poi utilizza "),ce,a(" per scansionare il QR code qui sotto. Infine inserisci il codice che appare sul tuo telefono. ")])):(t(),n("p",ue,[a(" L'autenticazione a due fattori \xE8 stata attivata. Scansiona il seguente QR code con Google Authenticator oppure utilizza il "),de]))]),s("div",{class:"mt-4",innerHTML:h.value},null,8,me),_.value?(t(),n("div",fe,[s("p",pe,[a(" Setup Key: "),s("span",{innerHTML:_.value},null,8,_e)])])):u("",!0),e.value?(t(),n("div",ve,[i(j,{for:"code",value:"Codice"}),i(B,{id:"code",modelValue:v(r).code,"onUpdate:modelValue":$[0]||($[0]=k=>v(r).code=k),type:"text",name:"code",class:"block mt-1 w-1/2",inputmode:"numeric",autofocus:"",autocomplete:"one-time-code",onKeyup:V(T,["enter"])},null,8,["modelValue","onKeyup"]),i(L,{message:v(r).errors.code,class:"mt-2"},null,8,["message"])])):u("",!0)])):u("",!0),d.value.length>0&&!e.value?(t(),n("div",he,[ye,s("div",ge,[(t(!0),n(D,null,U(d.value,k=>(t(),n("div",{key:k},C(k),1))),128))])])):u("",!0)])):u("",!0),s("div",we,[v(m)?(t(),n("div",be,[i(g,{onConfirmed:T},{default:o(()=>[e.value?(t(),y(F,{key:0,type:"button",class:x(["mr-3",{"opacity-25":l.value}]),disabled:l.value},{default:o(()=>[a(" Conferma ")]),_:1},8,["class","disabled"])):u("",!0)]),_:1}),i(g,{onConfirmed:G},{default:o(()=>[d.value.length>0&&!e.value?(t(),y(z,{key:0,class:"mr-3"},{default:o(()=>[a(" Rigenera codici di recupero ")]),_:1})):u("",!0)]),_:1}),i(g,{onConfirmed:A},{default:o(()=>[d.value.length===0&&!e.value?(t(),y(z,{key:0,class:"mr-3"},{default:o(()=>[a(" Mostra Codici di Recupero ")]),_:1})):u("",!0)]),_:1}),i(g,{onConfirmed:P},{default:o(()=>[e.value?(t(),y(z,{key:0,class:x({"opacity-25":c.value}),disabled:c.value},{default:o(()=>[a(" Annulla ")]),_:1},8,["class","disabled"])):u("",!0)]),_:1}),i(g,{onConfirmed:P},{default:o(()=>[e.value?u("",!0):(t(),y(Z,{key:0,class:x({"opacity-25":c.value}),disabled:c.value},{default:o(()=>[a(" Disabilita ")]),_:1},8,["class","disabled"]))]),_:1})])):(t(),n("div",xe,[i(g,{onConfirmed:S},{default:o(()=>[i(F,{type:"button",class:x({"opacity-25":l.value}),disabled:l.value},{default:o(()=>[a(" Abilita ")]),_:1},8,["class","disabled"])]),_:1})]))])]),_:1}))}};export{$e as default};
