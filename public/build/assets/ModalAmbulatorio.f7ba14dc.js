import{d as a,ar as f,o as n,c as d,u as o,H as b,w as r,f as i,I as v,J as u,_ as g,e as m,U as y,a as w,B as x,C as _}from"./app.e0b64a2d.js";import{a as c}from"./response.70bff4ea.js";import{l as k,D as C,b as B}from"./check-box.76fadd22.js";import{b5 as h}from"./check_box.9d1619d3.js";import{D as $}from"./select-box.44b95513.js";import{_ as E}from"./number-box.60e27d35.js";import"./text-area.2fa8fbc0.js";import"./select_box.f7ade88d.js";import"./number_box.9ca8c8f2.js";const j=a("div",{class:"fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"},null,-1),A={class:"fixed inset-0 z-50 overflow-y-auto"},N={class:"flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"},D={key:0,class:"flex justify-center items-center"},S=a("svg",{class:"animate-spin h-5 w-5 text-gray-900",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24"},[a("circle",{class:"opacity-25",cx:"12",cy:"12",r:"10",stroke:"currentColor","stroke-width":"4"}),a("path",{class:"opacity-75",fill:"currentColor",d:"M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"})],-1),I=[S],U={key:1},z={class:"flex flex-col gap-1"},V={class:"flex flex-col gap-1"},F=a("div",{class:"relative"},[a("div",{class:"absolute inset-0 flex items-center","aria-hidden":"true"},[a("div",{class:"w-full border-t border-gray-300"})]),a("div",{class:"relative flex justify-center"},[a("span",{class:"bg-white px-2 text-sm text-gray-500"},"Dati ambulatorio")])],-1),O={class:"flex gap-2 justify-between"},T={class:"flex justify-end items-center gap-2"},H=a("span",{class:"text-gray-700"},"Attivo",-1),M={class:"mt-5 sm:mt-6 flex flex-col sm:flex-row sm:justify-around gap-4"},J=a("button",{class:"opacity-0 absolute bottom-0"},null,-1),q={props:["ambulatorioId"],emits:["update","store","close"],data(){return{fetching:!1,saving:!1,errors:null,ambulatorio:{},strutture:[]}},computed:{disabledElement(){return this.fetching||this.saving},open(){return this.ambulatorioId!==null}},async created(){k("it-IT"),this.ambulatorioId==="new"?(this.fetching=!0,await axios.get("api/sphere/ambulatorio/create").then(t=>{this.ambulatorio=t.data.ambulatorio,this.strutture=t.data.strutture}).catch(t=>{this.$emit("close")}),this.fetching=!1):(this.fetching=!0,await axios.get(`api/sphere/ambulatorio/${this.ambulatorioId}/edit`).then(t=>{this.ambulatorio=t.data.ambulatorio,this.strutture=t.data.strutture}).catch(t=>{this.$emit("close")}),this.fetching=!1)},methods:{errorFor(t){return!!(this.errors!==null&&this.errors[t])},salvaAmbulatorio(){this.ambulatorio.id?this.update():this.store()},async update(){this.errors=null,this.saving=!0,await axios.put(`api/sphere/ambulatorio/${this.ambulatorio.id}`,this.ambulatorio).then(t=>{this.$emit("update",t.data)}).catch(t=>{c(t)&&(this.errors=t.response.data.errors),this.saving=!1}),this.saving=!1},async store(){this.errors=null,this.saving=!0,await axios.post("api/sphere/ambulatorio",this.ambulatorio).then(t=>{this.$emit("store",t.data)}).catch(t=>{c(t)&&(this.errors=t.response.data.errors),this.saving=!1}),this.saving=!1}}},Z=Object.assign(q,{__name:"ModalAmbulatorio",setup(t){return(e,s)=>{const p=f("AlertErrors");return n(),d(o(b),{as:"template",show:e.open},{default:r(()=>[i(o(v),{as:"div",class:"relative z-50"},{default:r(()=>[i(o(u),{as:"template",enter:"ease-out duration-300","enter-from":"opacity-0","enter-to":"opacity-100",leave:"ease-in duration-200","leave-from":"opacity-100","leave-to":"opacity-0"},{default:r(()=>[j]),_:1}),a("div",A,[a("div",N,[i(o(u),{as:"template",enter:"ease-out duration-300","enter-from":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95","enter-to":"opacity-100 translate-y-0 sm:scale-100",leave:"ease-in duration-200","leave-from":"opacity-100 translate-y-0 sm:scale-100","leave-to":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"},{default:r(()=>[i(o(g),{class:"relative transform rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl sm:p-6"},{default:r(()=>[e.fetching?(n(),m("div",D,I)):(n(),m("div",U,[i(o(y),{as:"h3",class:"text-lg font-medium leading-6 text-gray-900 text-center"},{default:r(()=>[w(x(e.ambulatorio.id?"Ambulatorio: "+e.ambulatorio.nome:"Nuovo ambulatorio"),1)]),_:1}),a("div",z,[a("div",V,[F,i(o(C),{value:e.ambulatorio.nome,"onUpdate:value":s[0]||(s[0]=l=>e.ambulatorio.nome=l),label:"Nome ambulatorio","label-mode":"floating",placeholder:"Nome","show-clear-button":!0,"is-valid":!e.errorFor("nome"),disabled:e.disabledElement},null,8,["value","is-valid","disabled"]),i(o($),{value:e.ambulatorio.struttura_id,"onUpdate:value":s[1]||(s[1]=l=>e.ambulatorio.struttura_id=l),"data-source":e.strutture,"value-expr":"id","display-expr":"nome",label:"Struttura","label-mode":"floating",placeholder:"Seleziona struttura",disabled:e.disabledElement,"is-valid":!e.errorFor("struttura_id")},null,8,["value","data-source","disabled","is-valid"]),a("div",O,[i(o(E),{value:e.ambulatorio.ordine,"onUpdate:value":s[2]||(s[2]=l=>e.ambulatorio.ordine=l),placeholder:"Ordine ( in numero )","show-spin-buttons":!0,"is-valid":!e.errorFor("ordine"),label:"Ordine",disabled:e.disabledElement},null,8,["value","is-valid","disabled"]),a("div",T,[H,i(o(B),{value:e.ambulatorio.attivo,"onUpdate:value":s[3]||(s[3]=l=>e.ambulatorio.attivo=l)},null,8,["value"])])])])]),a("div",M,[i(o(h),{width:"100%",text:"Chiudi",type:"danger",icon:"close","styling-mode":"contained",disabled:e.saving,onClick:s[4]||(s[4]=l=>e.$emit("close"))},null,8,["disabled"]),i(o(h),{id:"saveButton",width:"100%",text:e.saving?"Salvataggio...":e.disabledElement?"Non modificabile":"Salva modifiche",icon:"save",type:"success","styling-mode":"contained",disabled:e.disabledElement||e.saving,onClick:s[5]||(s[5]=l=>e.salvaAmbulatorio())},null,8,["text","disabled"])])]))]),_:1})]),_:1})])]),J,e.errors?(n(),d(p,{key:0,errors:e.errors},null,8,["errors"])):_("",!0)]),_:1})]),_:1},8,["show"])}}});export{Z as default};
