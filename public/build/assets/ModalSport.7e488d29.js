import{b as s,az as w,o as m,c as v,u as t,S as _,w as n,l,q as E,m as b,U as z,k as u,Z as F,a as U,v as f,y as h}from"./app.91faff10.js";import{a as c}from"./response.70bff4ea.js";import{l as j,D as r,b as p}from"./check-box.3b03f7e3.js";import{b5 as g}from"./check_box.bd4929f9.js";import{_ as d}from"./number-box.75808b5b.js";import{_ as C}from"./radio-group.6a7b6bf0.js";import"./number_box.976ffa07.js";const k=s("div",{class:"fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"},null,-1),M={class:"fixed inset-0 z-50 overflow-y-auto"},S={class:"flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"},A={key:0,class:"flex justify-center items-center"},B=s("svg",{class:"animate-spin h-5 w-5 text-gray-900",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24"},[s("circle",{class:"opacity-25",cx:"12",cy:"12",r:"10",stroke:"currentColor","stroke-width":"4"}),s("path",{class:"opacity-75",fill:"currentColor",d:"M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"})],-1),I=[B],N={key:1},$={class:"flex flex-col gap-1"},T={class:"grid grid-cols-1 sm:grid-cols-2 gap-3"},x={class:"flex flex-col gap-1"},D=s("div",{class:"relative"},[s("div",{class:"absolute inset-0 flex items-center","aria-hidden":"true"},[s("div",{class:"w-full border-t border-gray-300"})]),s("div",{class:"relative flex justify-center"},[s("span",{class:"bg-white px-2 text-sm text-gray-500"},"Dettagli sport")])],-1),V={class:"flex gap-2"},q=s("div",{class:"relative"},[s("div",{class:"absolute inset-0 flex items-center","aria-hidden":"true"},[s("div",{class:"w-full border-t border-gray-300"})]),s("div",{class:"relative flex justify-center"},[s("span",{class:"bg-white px-2 text-sm text-gray-500"},"Anno di riferimento")])],-1),G={key:0,class:"flex justify-between gap-2"},H=s("div",{class:"relative"},[s("div",{class:"absolute inset-0 flex items-center","aria-hidden":"true"},[s("div",{class:"w-full border-t border-gray-300"})]),s("div",{class:"relative flex justify-center"},[s("span",{class:"bg-white px-2 text-sm text-gray-500"},"Federazione / Ente principale")])],-1),L={class:"flex gap-2"},O={class:"flex flex-col gap-1"},P=s("div",{class:"relative"},[s("div",{class:"absolute inset-0 flex items-center","aria-hidden":"true"},[s("div",{class:"w-full border-t border-gray-300"})]),s("div",{class:"relative flex justify-center"},[s("span",{class:"bg-white px-2 text-sm text-gray-500"},"Limiti di et\xE0 MASCHI")])],-1),Y={class:"flex justify-between gap-2"},Z=s("div",{class:"relative"},[s("div",{class:"absolute inset-0 flex items-center","aria-hidden":"true"},[s("div",{class:"w-full border-t border-gray-300"})]),s("div",{class:"relative flex justify-center"},[s("span",{class:"bg-white px-2 text-sm text-gray-500"},"Limiti di et\xE0 FEMMINE")])],-1),J={class:"flex justify-between gap-2"},K=s("div",{class:"relative"},[s("div",{class:"absolute inset-0 flex items-center","aria-hidden":"true"},[s("div",{class:"w-full border-t border-gray-300"})]),s("div",{class:"relative flex justify-center"},[s("span",{class:"bg-white px-2 text-sm text-gray-500"},"Opzioni")])],-1),Q={class:"flex justify-between"},R=s("p",{class:"text-gray-700"},"Sport per atleti disabili",-1),W={class:"flex justify-between"},X=s("p",{class:"text-gray-700"},"Gruppo sanguigno obbligatorio",-1),ee={class:"flex justify-between"},se=s("p",{class:"text-gray-700"},"EEG obbligatorio",-1),ae={class:"flex justify-between"},ie=s("p",{class:"text-gray-700"},"Prenotabile online",-1),te={class:"mt-5 sm:mt-6 flex flex-col sm:flex-row sm:justify-around gap-4"},le=s("button",{class:"opacity-0 absolute bottom-0"},null,-1),oe={props:["sportId"],emits:["update","store","close"],data(){return{fetching:!1,saving:!1,errors:null,sport:null,riferimenti_anno:[{value:1,text:"Compimento anno"},{value:2,text:"Anno solare"},{value:3,text:"Anno sportivo"}]}},computed:{disabledElement(){return this.fetching||this.saving},open(){return this.sportId!==null}},async created(){j("it-IT"),this.sportId==="new"?(this.fetching=!0,await axios.get("api/sphere/sport/create").then(o=>{this.sport=o.data}),this.fetching=!1):(this.fetching=!0,await axios.get(`api/sphere/sport/${this.sportId}/edit`).then(o=>{this.sport=o.data}).catch(o=>{}),this.fetching=!1)},methods:{errorFor(o){return!!(this.errors!==null&&this.errors[o])},errorMessageFor(o){return this.errors!==null&&this.errors[o]?this.errors[o].toString():!1},salvaSport(){this.sport.id?this.update():this.store()},async update(){this.saving=!0,await axios.put(`api/sphere/sport/${this.sport.id}`,this.sport).then(o=>{this.$emit("update",o.data)}).catch(o=>{c(o)&&(this.errors=o.response.data.errors),this.saving=!1}),this.saving=!1},async store(){this.errors=null,this.saving=!0,await axios.post("api/sphere/sport",this.sport).then(o=>{this.$emit("store",o.data)}).catch(o=>{c(o)&&(this.errors=o.response.data.errors),this.saving=!1}),this.saving=!1}}},be=Object.assign(oe,{__name:"ModalSport",setup(o){return(e,a)=>{const y=w("AlertErrors");return m(),v(t(_),{as:"template",show:e.open},{default:n(()=>[l(t(E),{as:"div",class:"relative z-50"},{default:n(()=>[l(t(b),{as:"template",enter:"ease-out duration-300","enter-from":"opacity-0","enter-to":"opacity-100",leave:"ease-in duration-200","leave-from":"opacity-100","leave-to":"opacity-0"},{default:n(()=>[k]),_:1}),s("div",M,[s("div",S,[l(t(b),{as:"template",enter:"ease-out duration-300","enter-from":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95","enter-to":"opacity-100 translate-y-0 sm:scale-100",leave:"ease-in duration-200","leave-from":"opacity-100 translate-y-0 sm:scale-100","leave-to":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"},{default:n(()=>[l(t(z),{class:"relative transform rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl sm:p-6"},{default:n(()=>[e.fetching?(m(),u("div",A,I)):(m(),u("div",N,[l(t(F),{as:"h3",class:"text-lg font-medium leading-6 text-gray-900 text-center"},{default:n(()=>[U(f(e.sport.id?"Impostazioni sport: "+e.sport.nome:"Nuovo sport"),1)]),_:1}),s("div",$,[s("div",T,[s("div",x,[D,l(t(r),{value:e.sport.nome,"onUpdate:value":a[0]||(a[0]=i=>e.sport.nome=i),label:"Nome sport","label-mode":"static",placeholder:"Nome sport","show-clear-button":!0,"is-valid":!e.errorFor("nome"),disabled:e.disabledElement},null,8,["value","is-valid","disabled"]),s("p",null,f(e.errorMessageFor("nome")),1),l(t(r),{value:e.sport.codice_sport,"onUpdate:value":a[1]||(a[1]=i=>e.sport.codice_sport=i),label:"Codice sport","label-mode":"static",placeholder:"Codice sport","show-clear-button":!0,"is-valid":!e.errorFor("codice_sport"),disabled:e.disabledElement},null,8,["value","is-valid","disabled"]),s("div",V,[l(t(r),{value:e.sport.tipo_visita,"onUpdate:value":a[2]||(a[2]=i=>e.sport.tipo_visita=i),label:"Tipo visita",width:"100%","label-mode":"static",placeholder:"A1 , B1 ...","show-clear-button":!0,"is-valid":!e.errorFor("tipo_visita"),disabled:e.disabledElement},null,8,["value","is-valid","disabled"]),l(t(d),{value:e.sport.mesi_scadenza,"onUpdate:value":a[3]||(a[3]=i=>e.sport.mesi_scadenza=i),label:"Mesi di scadenza",width:"100%","label-mode":"static",placeholder:"es: 12","show-clear-button":!0,"is-valid":!e.errorFor("mesi_scadenza"),disabled:e.disabledElement},null,8,["value","is-valid","disabled"])]),q,l(t(C),{value:e.sport.anno_di_riferimento,"onUpdate:value":a[4]||(a[4]=i=>e.sport.anno_di_riferimento=i),items:e.riferimenti_anno,"value-expr":"value","display-expr":"text"},null,8,["value","items"]),e.sport.anno_di_riferimento==3?(m(),u("div",G,[l(t(r),{value:e.sport.inizio_anno_riferimento,"onUpdate:value":a[5]||(a[5]=i=>e.sport.inizio_anno_riferimento=i),label:"Inizio anno sportivo",width:"100%","label-mode":"static",placeholder:"es: 01/07","show-clear-button":!0,"is-valid":!e.errorFor("inizio_anno_riferimento"),disabled:e.disabledElement},null,8,["value","is-valid","disabled"]),l(t(r),{value:e.sport.fine_anno_riferimento,"onUpdate:value":a[6]||(a[6]=i=>e.sport.fine_anno_riferimento=i),label:"Fine anno sportivo",width:"100%","label-mode":"static",placeholder:"es: 30/06","show-clear-button":!0,"is-valid":!e.errorFor("fine_anno_riferimento"),disabled:e.disabledElement},null,8,["value","is-valid","disabled"])])):h("",!0),H,s("div",L,[l(t(r),{value:e.sport.codice_federazione,"onUpdate:value":a[7]||(a[7]=i=>e.sport.codice_federazione=i),label:"Codice Fed. / Ente","label-mode":"static",placeholder:"","show-clear-button":!0,"is-valid":!e.errorFor("codice_federazione"),disabled:e.disabledElement},null,8,["value","is-valid","disabled"]),l(t(r),{value:e.sport.sigla_federazione,"onUpdate:value":a[8]||(a[8]=i=>e.sport.sigla_federazione=i),label:"Sigla Fed. /Ente","label-mode":"static",placeholder:"","show-clear-button":!0,"is-valid":!e.errorFor("sigla_federazione"),disabled:e.disabledElement},null,8,["value","is-valid","disabled"]),l(t(r),{value:e.sport.affiliazione,"onUpdate:value":a[9]||(a[9]=i=>e.sport.affiliazione=i),label:"Affiliazione","label-mode":"static",placeholder:"","show-clear-button":!0,"is-valid":!e.errorFor("affiliazione"),disabled:e.disabledElement},null,8,["value","is-valid","disabled"])])]),s("div",O,[P,s("div",Y,[l(t(d),{value:e.sport.eta_minima_maschi,"onUpdate:value":a[10]||(a[10]=i=>e.sport.eta_minima_maschi=i),label:"Et\xE0 minima",width:"100%","label-mode":"static",placeholder:"es: 8","show-clear-button":!0,"is-valid":!e.errorFor("eta_minima_maschi"),disabled:e.disabledElement},null,8,["value","is-valid","disabled"]),l(t(d),{value:e.sport.eta_massima_maschi,"onUpdate:value":a[11]||(a[11]=i=>e.sport.eta_massima_maschi=i),label:"Et\xE0 massima",width:"100%","label-mode":"static",placeholder:"es: 99","show-clear-button":!0,"is-valid":!e.errorFor("eta_massima_maschi"),disabled:e.disabledElement},null,8,["value","is-valid","disabled"])]),l(t(d),{value:e.sport.eta_minima_tem_maschi,"onUpdate:value":a[12]||(a[12]=i=>e.sport.eta_minima_tem_maschi=i),label:"Et\xE0 minima TEM ( Test Ergometrico Massimale ) obbligatorio","label-mode":"static",placeholder:"es: 40","show-clear-button":!0,"is-valid":!e.errorFor("eta_minima_tem_maschi"),disabled:e.disabledElement},null,8,["value","is-valid","disabled"]),Z,s("div",J,[l(t(d),{value:e.sport.eta_minima_femmine,"onUpdate:value":a[13]||(a[13]=i=>e.sport.eta_minima_femmine=i),label:"Et\xE0 minima","label-mode":"static",placeholder:"es: 8","show-clear-button":!0,"is-valid":!e.errorFor("eta_minima_femmine"),disabled:e.disabledElement},null,8,["value","is-valid","disabled"]),l(t(d),{value:e.sport.eta_massima_femmine,"onUpdate:value":a[14]||(a[14]=i=>e.sport.eta_massima_femmine=i),label:"Et\xE0 massima","label-mode":"static",placeholder:"es: 99","show-clear-button":!0,"is-valid":!e.errorFor("eta_massima_femmine"),disabled:e.disabledElement},null,8,["value","is-valid","disabled"])]),l(t(d),{value:e.sport.eta_minima_tem_femmine,"onUpdate:value":a[15]||(a[15]=i=>e.sport.eta_minima_tem_femmine=i),label:"Et\xE0 minima TEM ( Test Ergometrico Massimale ) obbligatorio","label-mode":"static",placeholder:"es: 50","show-clear-button":!0,"is-valid":!e.errorFor("eta_minima_tem_femmine"),disabled:e.disabledElement},null,8,["value","is-valid","disabled"]),K,s("div",Q,[R,l(t(p),{value:e.sport.disabili,"onUpdate:value":a[16]||(a[16]=i=>e.sport.disabili=i)},null,8,["value"])]),s("div",W,[X,l(t(p),{value:e.sport.richiesto_gruppo_sanguigno,"onUpdate:value":a[17]||(a[17]=i=>e.sport.richiesto_gruppo_sanguigno=i)},null,8,["value"])]),s("div",ee,[se,l(t(p),{value:e.sport.richiesto_eeg,"onUpdate:value":a[18]||(a[18]=i=>e.sport.richiesto_eeg=i)},null,8,["value"])]),s("div",ae,[ie,l(t(p),{value:e.sport.prenotabile_online,"onUpdate:value":a[19]||(a[19]=i=>e.sport.prenotabile_online=i)},null,8,["value"])])])])]),s("div",te,[l(t(g),{width:"100%",text:"Chiudi",type:"danger",icon:"close","styling-mode":"contained",disabled:e.saving,onClick:a[20]||(a[20]=i=>e.$emit("close"))},null,8,["disabled"]),l(t(g),{id:"saveButton",width:"100%",text:e.saving?"Salvataggio...":e.disabledElement?"Non modificabile":"Salva modifiche",icon:"save",type:"success","styling-mode":"contained",disabled:e.disabledElement||e.saving,onClick:a[21]||(a[21]=i=>e.salvaSport())},null,8,["text","disabled"])])]))]),_:1})]),_:1})])]),le,e.errors?(m(),v(y,{key:0,errors:e.errors},null,8,["errors"])):h("",!0)]),_:1})]),_:1},8,["show"])}}});export{be as default};
